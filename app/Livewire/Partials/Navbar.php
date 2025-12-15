<?php

namespace App\Livewire\Partials;

use Livewire\Attributes\On;
use App\Helpers\CartManagement;
use Livewire\Component;

class Navbar extends Component
{
    public int $total_count = 0;

    public function mount()
    {
        // Safely count cart items from cookie
        $this->total_count = count(CartManagement::getCartItemsFromCookie());
    }

    #[On('update-cart-count')]
    public function updateCartCount(int $total)
    {
        $this->total_count = $total;
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
