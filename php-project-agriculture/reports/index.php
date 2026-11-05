<?php
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/sample_data.php';
$root = '../'; $page_title = 'Reports'; $active = 'reports';

$tabs = [
    'farmers'   => 'Farmers & Their Farms',
    'crops'     => 'Crops Planted per Farm',
    'status'    => 'Plantings by Status',
    'harvests'  => 'Harvest Records',
];
$report = $_GET['report'] ?? 'farmers';
if (!isset($tabs[$report])) $report = 'farmers';
$from = (string) ($_GET['from'] ?? '');
$to   = (string) ($_GET['to'] ?? '');

$in_range = fn($date) => ($from === '' || $date >= $from) && ($to === '' || $date <= $to);
$plantings_f = array_values(array_filter($plantings, fn($p) => $in_range($p['planting_date'])));
$harvests_f  = array_values(array_filter($harvests, fn($h) => $in_range($h['harvest_date'])));

$total_kg    = array_sum(array_column($harvests_f, 'quantity_kg'));
$total_value = array_sum(array_map(fn($h) => $h['quantity_kg'] * $h['selling_price_per_kg'], $harvests_f));

include '../includes/header.php';
?>
<div class="flex flex-wrap items-center justify-between gap-2 mb-4">
    <h1 class="text-2xl font-bold">Reports</h1>
    <button type="button" onclick="window.print()" class="bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded text-sm">Print Report</button>
</div>

<div class="flex flex-wrap gap-2 mb-4">
    <?php foreach ($tabs as $key => $label): ?>
        <a href="?report=<?= $key ?>&from=<?= urlencode($from) ?>&to=<?= urlencode($to) ?>" class="px-4 py-2 rounded text-sm <?= $report === $key ? 'bg-green-700 text-white' : 'bg-white hover:bg-gray-50 border' ?>"><?= $label ?></a>
    <?php endforeach; ?>
</div>

<?php if ($report !== 'farmers'): ?>
<form method="GET" class="bg-white p-4 rounded-lg shadow mb-4 flex flex-wrap items-end gap-2">
    <input type="hidden" name="report" value="<?= $report ?>">
    <div><label class="block text-xs mb-1">From</label><input type="date" name="from" value="<?= htmlspecialchars($from) ?>" class="p-2 border rounded"></div>
    <div><label class="block text-xs mb-1">To</label><input type="date" name="to" value="<?= htmlspecialchars($to) ?>" class="p-2 border rounded"></div>
    <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">Filter</button>
    <a href="?report=<?= $report ?>" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">Reset</a>
</form>
<?php endif; ?>

<div class="bg-white rounded-lg shadow overflow-x-auto">
<table class="w-full text-sm">
<?php if ($report === 'farmers'): ?>
    <thead class="bg-gray-50 text-left"><tr><th class="p-3">Farmer</th><th>Address</th><th>Farm</th><th>Location</th><th>Area (ha)</th></tr></thead>
    <tbody>
    <?php foreach ($farms as $r): $fm = find_row($farmers, 'farmer_id', $r['farmer_id']); ?>
        <tr class="border-t"><td class="p-3"><?= htmlspecialchars($r['farmer_name']) ?></td><td><?= htmlspecialchars($fm['address']) ?></td><td><?= htmlspecialchars($r['farm_name']) ?></td><td><?= htmlspecialchars($r['location']) ?></td><td><?= $r['area_hectares'] ?></td></tr>
    <?php endforeach; ?>
    </tbody>

<?php elseif ($report === 'crops'): ?>
    <thead class="bg-gray-50 text-left"><tr><th class="p-3">Farm</th><th>Crop</th><th>Planting Date</th><th>Area (ha)</th><th>Status</th></tr></thead>
    <tbody>
    <?php foreach ($plantings_f as $r): ?>
        <tr class="border-t"><td class="p-3"><?= htmlspecialchars($r['farm_name']) ?></td><td><?= htmlspecialchars($r['crop_name']) ?></td><td><?= $r['planting_date'] ?></td><td><?= $r['area_planted'] ?></td><td><?= htmlspecialchars($r['status']) ?></td></tr>
    <?php endforeach; ?>
    </tbody>

<?php elseif ($report === 'status'): ?>
    <thead class="bg-gray-50 text-left"><tr><th class="p-3">Status</th><th>No. of Plantings</th><th>Total Area (ha)</th></tr></thead>
    <tbody>
    <?php foreach (array_column($options['status'], 0) as $st):
        $subset = array_filter($plantings_f, fn($p) => $p['status'] === $st); ?>
        <tr class="border-t"><td class="p-3"><?= $st ?></td><td><?= count($subset) ?></td><td><?= array_sum(array_column($subset, 'area_planted')) ?></td></tr>
    <?php endforeach; ?>
    </tbody>

<?php else: ?>
    <thead class="bg-gray-50 text-left"><tr><th class="p-3">Planting</th><th>Date</th><th>Qty (kg)</th><th>Price/kg</th><th>Est. Value</th><th>Grade</th><th>Remarks</th></tr></thead>
    <tbody>
    <?php foreach ($harvests_f as $r): ?>
        <tr class="border-t"><td class="p-3"><?= htmlspecialchars($r['planting_label']) ?></td><td><?= $r['harvest_date'] ?></td><td><?= number_format($r['quantity_kg'], 2) ?></td><td><?= number_format($r['selling_price_per_kg'], 2) ?></td><td><?= number_format($r['quantity_kg'] * $r['selling_price_per_kg'], 2) ?></td><td><?= htmlspecialchars($r['quality_grade']) ?></td><td><?= htmlspecialchars($r['remark_description']) ?></td></tr>
    <?php endforeach; ?>
    </tbody>
<?php endif; ?>
</table>
</div>

<?php if ($report === 'harvests'): ?>
<div class="grid sm:grid-cols-2 gap-4 mt-4">
    <div class="bg-white p-4 rounded-lg shadow"><p class="text-sm text-gray-500">Total Harvested Quantity</p><p class="text-2xl font-bold text-green-700"><?= number_format($total_kg, 2) ?> kg</p></div>
    <div class="bg-white p-4 rounded-lg shadow"><p class="text-sm text-gray-500">Estimated Harvest Value</p><p class="text-2xl font-bold text-green-700">&#8369;<?= number_format($total_value, 2) ?></p></div>
</div>
<?php endif; ?>
<?php include '../includes/footer.php'; ?>
