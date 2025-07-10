<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductChangeTrackingTest extends TestCase
{

    protected Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        // Create a test product
        $this->product = Product::factory()->create([
            'name' => 'Test Product',
            'price' => 100.00,
            'is_active' => true,
            'stock' => 10
        ]);
    }

    public function test_it_returns_empty_changes_when_updating_with_same_value()
    {
        // First, make a change to establish some changes
        $this->product->update(['price' => 123]);
        $firstChanges = $this->product->getChanges();

        dump('Initial changes after price update:', $firstChanges);

        // 2. Update with the same value (no actual change)
        $currentIsActive = $this->product->is_active;
        $this->product->update(['is_active' => $currentIsActive]);

        $changesAfterSameValue = $this->product->getChanges();

        dump('Changes after same value:', $changesAfterSameValue);

        // This should be empty since we didn't actually change anything
        $this->assertEmpty($changesAfterSameValue, 'getChanges() should be empty when updating with same value');

        dump('2. After updating with same is_active value:', $changesAfterSameValue);
        dump('2. getDirty():', $this->product->getDirty());
    }

}