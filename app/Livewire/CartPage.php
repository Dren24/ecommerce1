<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

class CartPage extends Component
{
    #[Title('Cart Page')]
    public array $cart_items = [];
    public float $grand_total = 0;

    public function mount()
    {
        $this->refreshCart();
    }

    private function refreshCart(): void
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

        $this->dispatch(
            'update-cart-count',
            total_count: CartManagement::getTotalQuantity($this->cart_items)
        )->to(Navbar::class);
    }

    public function increaseQty(int $product_id): void
    {
        CartManagement::incrementQuantityToCartItem($product_id);
        $this->refreshCart();
    }

    public function decreaseQty(int $product_id): void
    {
        CartManagement::decrementQuantityToCartItem($product_id);
        $this->refreshCart();
    }

    public function removeItem(int $product_id): void
    {
        CartManagement::removeCartItem($product_id);
        $this->refreshCart();

        LivewireAlert::title('Removed')
            ->text('Product removed from cart')
            ->success()
            ->toast()
            ->position('bottom-end')
            ->timer(2500)
            ->show();
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
