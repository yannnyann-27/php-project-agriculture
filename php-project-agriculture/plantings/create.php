<?php
require_once __DIR__ . '/../includes/auth_check.php';
require_once __DIR__ . '/../includes/sample_data.php';
$root = '../'; $page_title = 'Add Planting'; $active = 'plantings';

$fields = [
    ['farm_id', 'Farm', 'select'],
    ['crop_id', 'Crop', 'select'],
    ['planting_date', 'Planting Date', 'date'],
    ['area_planted', 'Area Planted (ha)', 'number'],
    ['seed_quantity', 'Seed Quantity', 'number'],
    ['expected_harvest_date', 'Expected Harvest Date', 'date'],
    ['status', 'Status', 'select'],
];
$errors = [];
$data   = $row ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($fields as [$name, $label, $type]) {
        $value = (string) trim($_POST[$name] ?? '');
        $data[$name] = $value;

        if ($value === '') {
            $errors[$name] = "$label is required.";
        } elseif ($type === 'number' && (!is_numeric($value) || (float) $value <= 0)) {
            $errors[$name] = "$label must be a number greater than 0.";
        } elseif ($type === 'date' && !strtotime($value)) {
            $errors[$name] = "$label must be a valid date.";
        }
    }
    if (!isset($errors['planting_date'], $errors['expected_harvest_date']) && ($data['expected_harvest_date'] ?? '') < ($data['planting_date'] ?? '')) {
        $errors['expected_harvest_date'] = "Expected harvest date cannot be before the planting date.";
    }
    if (!$errors) {
        // PROTOTYPE: the Model's create() will be called here
        $_SESSION['flash'] = ['type' => 'success', 'msg' => 'Planting added successfully.'];
        header("Location: index.php");
        exit;
    }
}

include '../includes/header.php';
?>
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">Add Planting</h1>
    <?php if ($errors): ?>
        <div class="mb-4 p-3 rounded bg-red-100 border border-red-400 text-red-800 text-sm">Please fix the errors below.</div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded-lg shadow grid sm:grid-cols-2 gap-4">
        <?php foreach ($fields as [$name, $label, $type]): ?>
            <div>
                <label class="block text-sm font-medium mb-1"><?= $label ?></label>
                <?php if ($type === 'select'): ?>
                    <select name="<?= $name ?>" class="w-full p-2 border rounded <?= isset($errors[$name]) ? 'border-red-500' : '' ?>">
                        <option value="">-- Select <?= $label ?> --</option>
                        <?php foreach ($options[$name] as [$val, $text]): ?>
                            <option value="<?= htmlspecialchars($val) ?>" <?= (string) ($data[$name] ?? '') === (string) $val ? 'selected' : '' ?>><?= htmlspecialchars($text) ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php else: ?>
                    <input type="<?= $type === 'number' ? 'number' : $type ?>" <?= $type === 'number' ? 'step="0.01" min="0"' : '' ?> name="<?= $name ?>" value="<?= htmlspecialchars($data[$name] ?? '') ?>" class="w-full p-2 border rounded <?= isset($errors[$name]) ? 'border-red-500' : '' ?>">
                <?php endif; ?>
                <?php if (isset($errors[$name])): ?><p class="text-xs text-red-600 mt-1"><?= htmlspecialchars($errors[$name]) ?></p><?php endif; ?>
            </div>
        <?php endforeach; ?>

        <div class="sm:col-span-2 flex gap-2 justify-end">
            <a href="index.php" class="bg-gray-200 hover:bg-gray-300 px-4 py-2 rounded">Cancel</a>
            <button type="submit" class="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded">Save Planting</button>
        </div>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
