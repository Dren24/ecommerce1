<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;
    public Product $product;

    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
    }

    public function incrementQty()
    {
        $this->quantity++;
    }

    public function decrementQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        // ✅ USE selling_price ONLY
        if ($this->product->selling_price <= 0) {
            LivewireAlert::warning()
                ->title('Unavailable')
                ->text('This product has no price.')
                ->toast()
                ->position('top-end')
                ->show();
            return;
        }

        $total_count = CartManagement::addItemsToCart(
            $this->product->id,
            $this->quantity
        );

        $this->dispatch('update-cart-count', total_count: $total_count)
            ->to(Navbar::class);

        LivewireAlert::success()
            ->title('Added to cart')
            ->toast()
            ->position('top-end')
            ->show();
    }

    #[Title('Product Detail Page')]
    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => $this->product,
        ]);
    }
}
