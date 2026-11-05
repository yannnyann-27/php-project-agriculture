<?php
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/sample_data.php';
$root = '../'; $page_title = 'View Farm'; $active = 'farms';

$id  = (int) ($_GET['id'] ?? 0);
$row = find_row($farms, 'farm_id', $id);
if (!$row) {
    $_SESSION['flash'] = ['type' => 'error', 'msg' => 'Record not found.'];
    header("Location: index.php");
    exit;
}
include '../includes/header.php';
?>
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Farm Details</h1>
    <dl class="bg-white p-6 rounded-lg shadow grid sm:grid-cols-2 gap-4 text-sm">
        <?php foreach ($row as $key => $value): ?>
            <div>
                <dt class="text-gray-500"><?= htmlspecialchars(ucwords(str_replace('_', ' ', $key))) ?></dt>
                <dd class="font-medium"><?= htmlspecialchars($value) ?></dd>
            </div>
        <?php endforeach; ?>
    </dl>
    <div class="flex gap-2 mt-4">
        <a href="index.php" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">Back</a>
        <a href="edit.php?id=<?= $row['farm_id'] ?>" class="flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded"><?php icon('pencil', 'w-4 h-4'); ?> Edit</a>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
