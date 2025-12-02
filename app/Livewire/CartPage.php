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
    public $cart_items = [];
    public $grand_total;

    public function mount()
    {
        $this->cart_items = CartManagement::getCartItemsFromCookie();
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function increaseQty($product_id)
    {
        $this->cart_items = CartManagement::incrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

        // Update total quantity in Navbar
        $total_count = CartManagement::getTotalQuantity($this->cart_items);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
    }

    public function decreaseQty($product_id)
    {
        $this->cart_items = CartManagement::decrementQuantityToCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

        // Update total quantity in Navbar
        $total_count = CartManagement::getTotalQuantity($this->cart_items);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);
    }

    public function removeItem($product_id)
    {
        $this->cart_items = CartManagement::removeCartItem($product_id);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);

        // Update total quantity in Navbar
        $total_count = CartManagement::getTotalQuantity($this->cart_items);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        // Show alert
        LivewireAlert::title('Success')
            ->text('Product removed from cart!')
            ->success()
            ->toast()
            ->position('bottom-end')
            ->timer(3000)
            ->show();
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
