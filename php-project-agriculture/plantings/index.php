<?php
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/sample_data.php';
$root = '../'; $page_title = 'Planting Records'; $active = 'plantings';

$search = (string) trim($_GET['search'] ?? '');
$filter = (string) trim($_GET['filter'] ?? '');
$sort   = (string) ($_GET['sort'] ?? 'planting_id');
$dir    = ($_GET['dir'] ?? 'asc') === 'desc' ? 'desc' : 'asc';

$columns = [
    ['planting_id', 'ID'],
    ['farm_name', 'Farm'],
    ['crop_name', 'Crop'],
    ['planting_date', 'Planted'],
    ['area_planted', 'Area (ha)'],
    ['status', 'Status'],
];
$filter_options = array_unique(array_column($plantings, 'status'));
sort($filter_options);

// search + filter
$rows = array_values(array_filter($plantings, function ($r) use ($search, $filter) {
    if ($filter !== '' && (string) $r['status'] !== $filter) return false;
    return $search === '' || stripos(implode(' ', $r), $search) !== false;
}));

// sorting
usort($rows, function ($a, $b) use ($sort, $dir) {
    $cmp = $a[$sort] <=> $b[$sort];
    return $dir === 'desc' ? -$cmp : $cmp;
});

// pagination
$per_page = 5;
$total    = count($rows);
$pages    = max(1, (int) ceil($total / $per_page));
$page     = min($pages, max(1, (int) ($_GET['page'] ?? 1)));
$rows     = array_slice($rows, ($page - 1) * $per_page, $per_page);
$query    = fn($extra) => '?' . http_build_query(array_merge(['search' => $search, 'filter' => $filter, 'sort' => $sort, 'dir' => $dir], $extra));

include '../includes/header.php';
?>
<div class="flex flex-wrap items-center justify-between gap-2 mb-4">
    <h1 class="text-2xl font-bold">Planting Records</h1>
    <a href="create.php" class="flex items-center gap-1 bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded text-sm">
        <?php icon('plus', 'w-4 h-4'); ?> Add Planting
    </a>
</div>

<form method="GET" class="bg-white p-4 rounded-lg shadow mb-4 flex flex-wrap gap-2">
    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search..." class="flex-1 min-w-[180px] p-2 border rounded">
    <select name="filter" class="p-2 border rounded">
        <option value="">All Status</option>
        <?php foreach ($filter_options as $opt): ?>
            <option value="<?= htmlspecialchars($opt) ?>" <?= $filter === (string) $opt ? 'selected' : '' ?>><?= htmlspecialchars($opt) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">Search</button>
    <a href="index.php" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">Reset</a>
</form>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left">
            <tr>
                <?php foreach ($columns as [$key, $label]): ?>
                    <th class="p-3">
                        <a href="<?= $query(['sort' => $key, 'dir' => ($sort === $key && $dir === 'asc') ? 'desc' : 'asc', 'page' => 1]) ?>" class="hover:text-green-700">
                            <?= $label ?> <?= $sort === $key ? ($dir === 'asc' ? '&uarr;' : '&darr;') : '' ?>
                        </a>
                    </th>
                <?php endforeach; ?>
                <th class="p-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!$rows): ?>
            <tr><td colspan="<?= count($columns) + 1 ?>" class="p-6 text-center text-gray-500">No records found.</td></tr>
        <?php endif; ?>
        <?php foreach ($rows as $row): ?>
            <tr class="border-t hover:bg-gray-50">
                <?php foreach ($columns as [$key, $label]): ?>
                    <td class="p-3"><?= htmlspecialchars($row[$key]) ?></td>
                <?php endforeach; ?>
                <td class="p-3">
                    <div class="flex justify-center gap-2">
                        <a href="view.php?id=<?= $row['planting_id'] ?>" title="View" class="text-blue-600 hover:text-blue-800"><?php icon('eye'); ?></a>
                        <a href="edit.php?id=<?= $row['planting_id'] ?>" title="Edit" class="text-yellow-600 hover:text-yellow-800"><?php icon('pencil'); ?></a>
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a href="delete.php?id=<?= $row['planting_id'] ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this record?')" class="text-red-600 hover:text-red-800"><?php icon('trash'); ?></a>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="flex flex-wrap items-center justify-between gap-2 mt-4 text-sm">
    <span class="text-gray-500">Showing <?= count($rows) ?> of <?= $total ?> record(s)</span>
    <div class="flex gap-1">
        <?php if ($page > 1): ?><a href="<?= $query(['page' => $page - 1]) ?>" class="px-3 py-1 bg-white border rounded hover:bg-gray-100">Prev</a><?php endif; ?>
        <?php for ($i = 1; $i <= $pages; $i++): ?>
            <a href="<?= $query(['page' => $i]) ?>" class="px-3 py-1 border rounded <?= $i === $page ? 'bg-green-700 text-white' : 'bg-white hover:bg-gray-100' ?>"><?= $i ?></a>
        <?php endfor; ?>
        <?php if ($page < $pages): ?><a href="<?= $query(['page' => $page + 1]) ?>" class="px-3 py-1 bg-white border rounded hover:bg-gray-100">Next</a><?php endif; ?>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
