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

    public function mount($slug)
    {
        $this->slug = $slug;
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

    public function addToCart($product_id)
    {
        // FIX ❗ Correct function name. No "WithQty"
        $total_count = CartManagement::addItemsToCart($product_id, $this->quantity);

        // Update navbar cart count
        $this->dispatch('update-cart-count', total_count: $total_count)
            ->to(Navbar::class);

        // FIX ❗ Updated Alert syntax to LivewireAlert v4
        LivewireAlert::title('Success')
            ->text('Product added to cart successfully!')
            ->success()
            ->toast()
            ->position('top-end')
            ->timer(3000)
            ->show();
    }

    #[Title('Product Detail Page')]
    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}
