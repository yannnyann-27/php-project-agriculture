<?php
// PROTOTYPE ONLY: sample arrays that stand in for the Supabase tables.
// Later these get replaced by the Model classes in /models.
$farmers   = [
    ['farmer_id' => 1, 'first_name' => 'Juan', 'last_name' => 'Dela Cruz', 'contact_number' => '09171234567', 'address' => 'Barangay Lahug, Cebu City', 'date_registered' => '2024-01-15'],
    ['farmer_id' => 2, 'first_name' => 'Maria', 'last_name' => 'Santos', 'contact_number' => '09281234567', 'address' => 'Barangay Pajo, Lapu-Lapu City', 'date_registered' => '2024-02-03'],
    ['farmer_id' => 3, 'first_name' => 'Pedro', 'last_name' => 'Reyes', 'contact_number' => '09391234567', 'address' => 'Barangay Tabunok, Talisay City', 'date_registered' => '2024-02-20'],
    ['farmer_id' => 4, 'first_name' => 'Ana', 'last_name' => 'Villanueva', 'contact_number' => '09451234567', 'address' => 'Barangay Lahug, Cebu City', 'date_registered' => '2024-03-11'],
    ['farmer_id' => 5, 'first_name' => 'Jose', 'last_name' => 'Garcia', 'contact_number' => '09561234567', 'address' => 'Barangay Mactan, Lapu-Lapu City', 'date_registered' => '2024-04-05'],
    ['farmer_id' => 6, 'first_name' => 'Rosa', 'last_name' => 'Mendoza', 'contact_number' => '09671234567', 'address' => 'Barangay Tabunok, Talisay City', 'date_registered' => '2024-05-18'],
    ['farmer_id' => 7, 'first_name' => 'Carlos', 'last_name' => 'Bautista', 'contact_number' => '09781234567', 'address' => 'Barangay Pajo, Lapu-Lapu City', 'date_registered' => '2024-06-09'],
];

$farms     = [
    ['farm_id' => 1, 'farmer_id' => 1, 'farmer_name' => 'Juan Dela Cruz', 'farm_name' => 'Dela Cruz Farm', 'location' => 'Lahug, Cebu City', 'area_hectares' => 2.5, 'soil_type' => 'Loam', 'irrigation_type' => 'Irrigated'],
    ['farm_id' => 2, 'farmer_id' => 2, 'farmer_name' => 'Maria Santos', 'farm_name' => 'Santos Farm', 'location' => 'Pajo, Lapu-Lapu City', 'area_hectares' => 1.8, 'soil_type' => 'Clay', 'irrigation_type' => 'Rainfed'],
    ['farm_id' => 3, 'farmer_id' => 3, 'farmer_name' => 'Pedro Reyes', 'farm_name' => 'Reyes Farm', 'location' => 'Tabunok, Talisay City', 'area_hectares' => 3.2, 'soil_type' => 'Sandy Loam', 'irrigation_type' => 'Drip'],
    ['farm_id' => 4, 'farmer_id' => 4, 'farmer_name' => 'Ana Villanueva', 'farm_name' => 'Villanueva Farm', 'location' => 'Lahug, Cebu City', 'area_hectares' => 1.2, 'soil_type' => 'Loam', 'irrigation_type' => 'Irrigated'],
    ['farm_id' => 5, 'farmer_id' => 5, 'farmer_name' => 'Jose Garcia', 'farm_name' => 'Garcia Farm', 'location' => 'Mactan, Lapu-Lapu City', 'area_hectares' => 4.0, 'soil_type' => 'Clay Loam', 'irrigation_type' => 'Sprinkler'],
    ['farm_id' => 6, 'farmer_id' => 6, 'farmer_name' => 'Rosa Mendoza', 'farm_name' => 'Mendoza Farm', 'location' => 'Tabunok, Talisay City', 'area_hectares' => 2.0, 'soil_type' => 'Sandy', 'irrigation_type' => 'Rainfed'],
];

$crops     = [
    ['crop_id' => 1, 'crop_name' => 'Rice', 'variety' => 'IR64', 'crop_category' => 'Cereal', 'growing_period_days' => 120, 'recommended_season' => 'Wet Season'],
    ['crop_id' => 2, 'crop_name' => 'Corn', 'variety' => 'Sweet Corn', 'crop_category' => 'Cereal', 'growing_period_days' => 75, 'recommended_season' => 'Dry Season'],
    ['crop_id' => 3, 'crop_name' => 'Tomato', 'variety' => 'Diamante Max', 'crop_category' => 'Vegetable', 'growing_period_days' => 90, 'recommended_season' => 'Dry Season'],
    ['crop_id' => 4, 'crop_name' => 'Eggplant', 'variety' => 'Long Purple', 'crop_category' => 'Vegetable', 'growing_period_days' => 100, 'recommended_season' => 'All Year'],
    ['crop_id' => 5, 'crop_name' => 'Banana', 'variety' => 'Cavendish', 'crop_category' => 'Fruit', 'growing_period_days' => 300, 'recommended_season' => 'All Year'],
    ['crop_id' => 6, 'crop_name' => 'Mango', 'variety' => 'Carabao', 'crop_category' => 'Fruit', 'growing_period_days' => 1460, 'recommended_season' => 'Dry Season'],
];

$plantings = [
    ['planting_id' => 1, 'farm_id' => 1, 'farm_name' => 'Dela Cruz Farm', 'crop_id' => 1, 'crop_name' => 'Rice (IR64)', 'planting_date' => '2026-06-10', 'area_planted' => 2.0, 'seed_quantity' => 40, 'expected_harvest_date' => '2026-10-08', 'status' => 'Growing'],
    ['planting_id' => 2, 'farm_id' => 2, 'farm_name' => 'Santos Farm', 'crop_id' => 2, 'crop_name' => 'Corn (Sweet Corn)', 'planting_date' => '2026-08-01', 'area_planted' => 1.0, 'seed_quantity' => 15, 'expected_harvest_date' => '2026-10-15', 'status' => 'Harvested'],
    ['planting_id' => 3, 'farm_id' => 3, 'farm_name' => 'Reyes Farm', 'crop_id' => 3, 'crop_name' => 'Tomato (Diamante Max)', 'planting_date' => '2026-07-20', 'area_planted' => 1.5, 'seed_quantity' => 2, 'expected_harvest_date' => '2026-10-18', 'status' => 'Harvested'],
    ['planting_id' => 4, 'farm_id' => 4, 'farm_name' => 'Villanueva Farm', 'crop_id' => 4, 'crop_name' => 'Eggplant (Long Purple)', 'planting_date' => '2026-08-15', 'area_planted' => 0.8, 'seed_quantity' => 1, 'expected_harvest_date' => '2026-11-23', 'status' => 'Growing'],
    ['planting_id' => 5, 'farm_id' => 5, 'farm_name' => 'Garcia Farm', 'crop_id' => 1, 'crop_name' => 'Rice (IR64)', 'planting_date' => '2026-09-01', 'area_planted' => 3.0, 'seed_quantity' => 60, 'expected_harvest_date' => '2026-12-30', 'status' => 'Planted'],
    ['planting_id' => 6, 'farm_id' => 6, 'farm_name' => 'Mendoza Farm', 'crop_id' => 5, 'crop_name' => 'Banana (Cavendish)', 'planting_date' => '2026-03-05', 'area_planted' => 1.2, 'seed_quantity' => 500, 'expected_harvest_date' => '2027-01-01', 'status' => 'Growing'],
    ['planting_id' => 7, 'farm_id' => 1, 'farm_name' => 'Dela Cruz Farm', 'crop_id' => 2, 'crop_name' => 'Corn (Sweet Corn)', 'planting_date' => '2026-05-12', 'area_planted' => 1.0, 'seed_quantity' => 15, 'expected_harvest_date' => '2026-07-26', 'status' => 'Harvested'],
    ['planting_id' => 8, 'farm_id' => 3, 'farm_name' => 'Reyes Farm', 'crop_id' => 4, 'crop_name' => 'Eggplant (Long Purple)', 'planting_date' => '2026-09-20', 'area_planted' => 0.5, 'seed_quantity' => 1, 'expected_harvest_date' => '2026-12-29', 'status' => 'Planted'],
];

$harvests  = [
    ['harvest_id' => 1, 'planting_id' => 2, 'planting_label' => 'PL-2 Santos Farm / Corn (Sweet Corn)', 'crop_name' => 'Corn (Sweet Corn)', 'harvest_date' => '2026-10-14', 'quantity_kg' => 1850.5, 'selling_price_per_kg' => 18.0, 'quality_grade' => 'Grade A', 'remark_id' => 1, 'remark_description' => 'Good Harvest'],
    ['harvest_id' => 2, 'planting_id' => 3, 'planting_label' => 'PL-3 Reyes Farm / Tomato (Diamante Max)', 'crop_name' => 'Tomato (Diamante Max)', 'harvest_date' => '2026-10-17', 'quantity_kg' => 2200.0, 'selling_price_per_kg' => 32.5, 'quality_grade' => 'Grade A', 'remark_id' => 1, 'remark_description' => 'Good Harvest'],
    ['harvest_id' => 3, 'planting_id' => 7, 'planting_label' => 'PL-7 Dela Cruz Farm / Corn (Sweet Corn)', 'crop_name' => 'Corn (Sweet Corn)', 'harvest_date' => '2026-07-25', 'quantity_kg' => 1400.0, 'selling_price_per_kg' => 17.0, 'quality_grade' => 'Grade B', 'remark_id' => 2, 'remark_description' => 'Acceptable Quality'],
    ['harvest_id' => 4, 'planting_id' => 2, 'planting_label' => 'PL-2 Santos Farm / Corn (Sweet Corn)', 'crop_name' => 'Corn (Sweet Corn)', 'harvest_date' => '2026-10-20', 'quantity_kg' => 300.0, 'selling_price_per_kg' => 15.0, 'quality_grade' => 'Grade C', 'remark_id' => 3, 'remark_description' => 'Low Yield'],
    ['harvest_id' => 5, 'planting_id' => 3, 'planting_label' => 'PL-3 Reyes Farm / Tomato (Diamante Max)', 'crop_name' => 'Tomato (Diamante Max)', 'harvest_date' => '2026-10-22', 'quantity_kg' => 150.0, 'selling_price_per_kg' => 25.0, 'quality_grade' => 'Grade C', 'remark_id' => 5, 'remark_description' => 'Damaged Harvest'],
    ['harvest_id' => 6, 'planting_id' => 7, 'planting_label' => 'PL-7 Dela Cruz Farm / Corn (Sweet Corn)', 'crop_name' => 'Corn (Sweet Corn)', 'harvest_date' => '2026-08-02', 'quantity_kg' => 500.0, 'selling_price_per_kg' => 16.5, 'quality_grade' => 'Grade B', 'remark_id' => 4, 'remark_description' => 'Poor Quality'],
];

// Lookup / dropdown options: [value stored in DB, label shown to user]
$options   = ['farmer_id' => [
    [1, 'Juan Dela Cruz'],
    [2, 'Maria Santos'],
    [3, 'Pedro Reyes'],
    [4, 'Ana Villanueva'],
    [5, 'Jose Garcia'],
    [6, 'Rosa Mendoza'],
    [7, 'Carlos Bautista'],
], 'farm_id' => [
    [1, 'Dela Cruz Farm'],
    [2, 'Santos Farm'],
    [3, 'Reyes Farm'],
    [4, 'Villanueva Farm'],
    [5, 'Garcia Farm'],
    [6, 'Mendoza Farm'],
], 'crop_id' => [
    [1, 'Rice (IR64)'],
    [2, 'Corn (Sweet Corn)'],
    [3, 'Tomato (Diamante Max)'],
    [4, 'Eggplant (Long Purple)'],
    [5, 'Banana (Cavendish)'],
    [6, 'Mango (Carabao)'],
], 'planting_id' => [
    [1, 'PL-1 Dela Cruz Farm / Rice (IR64)'],
    [2, 'PL-2 Santos Farm / Corn (Sweet Corn)'],
    [3, 'PL-3 Reyes Farm / Tomato (Diamante Max)'],
    [4, 'PL-4 Villanueva Farm / Eggplant (Long Purple)'],
    [5, 'PL-5 Garcia Farm / Rice (IR64)'],
    [6, 'PL-6 Mendoza Farm / Banana (Cavendish)'],
    [7, 'PL-7 Dela Cruz Farm / Corn (Sweet Corn)'],
    [8, 'PL-8 Reyes Farm / Eggplant (Long Purple)'],
], 'remark_id' => [
    [1, 'Good Harvest'],
    [2, 'Acceptable Quality'],
    [3, 'Low Yield'],
    [4, 'Poor Quality'],
    [5, 'Damaged Harvest'],
], 'soil_type' => [
    ['Loam', 'Loam'],
    ['Clay', 'Clay'],
    ['Sandy', 'Sandy'],
    ['Sandy Loam', 'Sandy Loam'],
    ['Clay Loam', 'Clay Loam'],
], 'irrigation_type' => [
    ['Irrigated', 'Irrigated'],
    ['Rainfed', 'Rainfed'],
    ['Drip', 'Drip'],
    ['Sprinkler', 'Sprinkler'],
], 'crop_category' => [
    ['Cereal', 'Cereal'],
    ['Vegetable', 'Vegetable'],
    ['Fruit', 'Fruit'],
    ['Root Crop', 'Root Crop'],
], 'recommended_season' => [
    ['Wet Season', 'Wet Season'],
    ['Dry Season', 'Dry Season'],
    ['All Year', 'All Year'],
], 'status' => [
    ['Planted', 'Planted'],
    ['Growing', 'Growing'],
    ['Harvested', 'Harvested'],
    ['Failed', 'Failed'],
], 'quality_grade' => [
    ['Grade A', 'Grade A'],
    ['Grade B', 'Grade B'],
    ['Grade C', 'Grade C'],
]];

function find_row(array $rows, string $key, int $id) {
    foreach ($rows as $r) {
        if ((int) $r[$key] === $id) return $r;
    }
    return null;
}
