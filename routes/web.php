<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    // Create a test product if one doesn't exist
    $product = Product::create(
        [
            'name' => 'Test Product',
            'price' => 100.00,
            'is_active' => true,
            'stock' => 10,
            'sku' => 'TEST1234',
            'description' => 'Test product for debugging'
        ]
    );

    echo "<h1>Product Change Tracking Debug</h1>";
    echo "<pre>";

    echo "=== 1. Change a field (price) ===\n";
    $product->update(['price' => 123]);
    echo "getChanges(): ";
    var_dump($product->getChanges());

    echo "=== 2. Update with the same value (no actual change) ===\n";
    $currentIsActive = $product->is_active;
    echo "Current is_active value: " . ($currentIsActive ? 'true' : 'false') . "\n";
    $product->update(['is_active' => $currentIsActive]);
    echo "getChanges(): ";
    var_dump($product->getChanges());
    echo "Expected: [] (empty array)\n";
    echo "getDirty(): ";
    var_dump($product->getDirty());
    echo "Expected: [] (empty array)\n\n";

    echo "=== 3. Fresh the model ===\n";
    $product = $product->fresh();
    echo "getChanges(): ";
    var_dump($product->getChanges());
    echo "Expected: [] (empty array)\n\n";

    echo "=== 4. Update another field (name) ===\n";
    $product->update(['name' => '123']);
    echo "getChanges(): ";
    var_dump($product->getChanges());
    echo "Expected: ['name' => '123', 'updated_at' => '...']\n";
    echo "Should NOT contain 'price' key from previous changes\n\n";

    echo "=== FINAL STATE ANALYSIS ===\n";
    echo "getChanges(): ";
    var_dump($product->getChanges());
    echo "getDirty(): ";
    var_dump($product->getDirty());
    echo "wasChanged(): " . ($product->wasChanged() ? 'true' : 'false') . "\n";
    echo "wasChanged('name'): " . ($product->wasChanged('name') ? 'true' : 'false') . "\n";
    echo "wasChanged('price'): " . ($product->wasChanged('price') ? 'true' : 'false') . "\n";

    echo "</pre>";
    $product->delete();
});