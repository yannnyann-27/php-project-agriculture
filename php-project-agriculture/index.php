<?php
require_once __DIR__ . '/includes/auth_check.php';
require_once __DIR__ . '/includes/sample_data.php';
$root = ''; $page_title = 'Dashboard'; $active = 'dashboard';

$cards = [
    ['Farmers',  count($farmers),   'farmers/index.php',   'users',    'bg-green-100 text-green-700'],
    ['Farms',    count($farms),     'farms/index.php',     'home',     'bg-blue-100 text-blue-700'],
    ['Crops',    count($crops),     'crops/index.php',     'sun',      'bg-yellow-100 text-yellow-700'],
    ['Plantings', count($plantings), 'plantings/index.php', 'calendar', 'bg-purple-100 text-purple-700'],
    ['Harvests', count($harvests),  'harvests/index.php',  'archive',  'bg-orange-100 text-orange-700'],
];

$status_count = array_count_values(array_column($plantings, 'status'));
$total_kg     = array_sum(array_column($harvests, 'quantity_kg'));
$recent_plantings = array_slice(array_reverse($plantings), 0, 5);
$recent_harvests  = array_slice(array_reverse($harvests), 0, 5);
$status_colors = ['Planted' => 'bg-blue-500', 'Growing' => 'bg-yellow-500', 'Harvested' => 'bg-green-500', 'Failed' => 'bg-red-500'];

include 'includes/header.php';
?>
<h1 class="text-2xl font-bold mb-4">Dashboard</h1>

<div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
    <?php foreach ($cards as [$label, $count, $href, $ico, $color]): ?>
        <a href="<?= $href ?>" class="bg-white p-4 rounded-lg shadow hover:shadow-md transition">
            <div class="inline-flex p-2 rounded <?= $color ?>"><?php icon($ico, 'w-6 h-6'); ?></div>
            <p class="text-3xl font-bold mt-2"><?= $count ?></p>
            <p class="text-sm text-gray-500">Total <?= $label ?></p>
        </a>
    <?php endforeach; ?>
</div>

<div class="grid lg:grid-cols-3 gap-4 mb-6">
    <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="font-semibold mb-3">Plantings by Status</h2>
        <?php foreach ($status_count as $status => $n): ?>
            <div class="mb-3">
                <div class="flex justify-between text-sm"><span><?= htmlspecialchars($status) ?></span><span><?= $n ?></span></div>
                <div class="w-full bg-gray-200 rounded h-2">
                    <div class="<?= $status_colors[$status] ?? 'bg-gray-500' ?> h-2 rounded" style="width: <?= ($n / count($plantings)) * 100 ?>%"></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="bg-white p-4 rounded-lg shadow flex flex-col justify-center items-center">
        <p class="text-sm text-gray-500">Total Harvested Quantity</p>
        <p class="text-4xl font-bold text-green-700"><?= number_format($total_kg, 2) ?></p>
        <p class="text-sm text-gray-500">kilograms</p>
    </div>

    <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="font-semibold mb-3">Quick Actions</h2>
        <div class="flex flex-col gap-2">
            <a href="plantings/create.php" class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-3 py-2 rounded text-sm"><?php icon('plus', 'w-4 h-4'); ?> New Planting</a>
            <a href="harvests/create.php" class="flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-3 py-2 rounded text-sm"><?php icon('plus', 'w-4 h-4'); ?> New Harvest</a>
            <a href="reports/index.php" class="flex items-center gap-2 bg-gray-700 hover:bg-gray-800 text-white px-3 py-2 rounded text-sm"><?php icon('chart', 'w-4 h-4'); ?> View Reports</a>
        </div>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-4">
    <div class="bg-white p-4 rounded-lg shadow overflow-x-auto">
        <h2 class="font-semibold mb-3">Recent Planting Records</h2>
        <table class="w-full text-sm">
            <thead><tr class="text-left border-b"><th class="py-2">Farm</th><th>Crop</th><th>Date</th><th>Status</th></tr></thead>
            <tbody>
            <?php foreach ($recent_plantings as $row): ?>
                <tr class="border-b">
                    <td class="py-2"><?= htmlspecialchars($row['farm_name']) ?></td>
                    <td><?= htmlspecialchars($row['crop_name']) ?></td>
                    <td><?= htmlspecialchars($row['planting_date']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="bg-white p-4 rounded-lg shadow overflow-x-auto">
        <h2 class="font-semibold mb-3">Recent Harvest Records</h2>
        <table class="w-full text-sm">
            <thead><tr class="text-left border-b"><th class="py-2">Crop</th><th>Date</th><th>Qty (kg)</th><th>Grade</th></tr></thead>
            <tbody>
            <?php foreach ($recent_harvests as $row): ?>
                <tr class="border-b">
                    <td class="py-2"><?= htmlspecialchars($row['crop_name']) ?></td>
                    <td><?= htmlspecialchars($row['harvest_date']) ?></td>
                    <td><?= number_format($row['quantity_kg'], 2) ?></td>
                    <td><?= htmlspecialchars($row['quality_grade']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
