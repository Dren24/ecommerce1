<?php

namespace App\Livewire;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Order Details')]
class MyOrderDetailPage extends Component
{
    public Order $order;

    public $order_items;
    public $address;

    // ✅ MUST MATCH ROUTE PARAM {order}
    public function mount(Order $order)
    {
        // Security: user can only see their own orders
        abort_if($order->user_id !== Auth::id(), 403);

        $this->order = $order;
        $this->order_items = $order->items()->with('product')->get();
        $this->address = $order->address;
    }

    public function render()
    {
        return view('livewire.my-order-detail-page');
    }
}
