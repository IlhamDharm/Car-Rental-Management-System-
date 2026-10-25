<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GlobalSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_global_search_finds_active_products(): void
    {
        // Buat product dummy
        $product = Product::create([
            'name' => 'Toyota Avanza Terbaru',
            'sku' => 'TOY-AVN-01',
            'type' => 'MPV',
            'brand' => 'Toyota',
            'model' => 'Avanza',
            'capacity' => 7,
            'transmission' => 'Manual',
            'fuel_type' => 'Bensin',
            'location' => 'Surabaya',
            'description' => 'Mobil keluarga yang sangat nyaman dan irit.',
            'price' => 350000,
            'stock' => 5,
            'image' => null,
            'is_active' => true,
            'is_booked' => false,
            'is_featured' => false,
        ]);

        $response = $this->get('/search?q=Avanza');

        $response->assertStatus(200);
        $response->assertViewHas('products');
        $response->assertSee('Toyota Avanza Terbaru');
    }

    public function test_global_search_finds_website_elements(): void
    {
        $response = $this->get('/search?q=bayar');

        $response->assertStatus(200);
        $response->assertViewHas('matchedElements');

        $matchedElements = $response->viewData('matchedElements');
        $this->assertNotEmpty($matchedElements);
        $this->assertEquals('Pembayaran (Payment)', $matchedElements[0]['title']);
    }
}
