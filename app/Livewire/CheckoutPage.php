<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Helpers\CartManagement;
use App\Models\Order;
use App\Models\Address;
use App\Mail\OrderPlaced;
use Stripe\Stripe;
use Stripe\Checkout\Session;

#[Title('Checkout')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $zip_code;
    public $region;
    public $shipping_fee = 0;
    public $payment_method;

    public function mount()
    {
        if (count(CartManagement::getCartItemsFromCookie()) === 0) {
            return redirect('/products');
        }
    }

    /* ===============================
       🔥 LIVEWIRE REACTIVE FIX
    =============================== */
    public function updatedRegion()
    {
        $this->shipping_fee = $this->calculateShipping();
    }

    protected function calculateShipping()
    {
        return match ($this->region) {
            'luzon'    => 100,
            'visayas'  => 200,
            'mindanao' => 300,
            default    => 0,
        };
    }

    public function getCanSubmitProperty()
    {
        return $this->first_name &&
            $this->last_name &&
            $this->phone &&
            $this->street_address &&
            $this->city &&
            $this->state &&
            $this->zip_code &&
            $this->region &&
            $this->payment_method;
    }

    public function placeOrder()
    {
        $this->validate([
            'first_name'     => 'required',
            'last_name'      => 'required',
            'phone'          => 'required',
            'street_address' => 'required',
            'city'           => 'required',
            'state'          => 'required',
            'zip_code'       => 'required',
            'region'         => 'required|in:luzon,visayas,mindanao',
            'payment_method' => 'required|in:cod,stripe',
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();
        if (empty($cart_items)) return redirect('/products');

        $subtotal = CartManagement::calculateGrandTotal($cart_items);
        $this->shipping_fee = $this->calculateShipping();
        $grand_total = $subtotal + $this->shipping_fee;

        $order = Order::create([
            'user_id'         => Auth::id(),
            'grand_total'     => $grand_total,
            'payment_method'  => $this->payment_method,
            'payment_status'  => 'pending',
            'status'          => 'new',
            'currency'        => 'PHP',
            'shipping_amount' => $this->shipping_fee,
            'shipping_method' => ucfirst($this->region),
        ]);

        Address::create([
            'order_id'       => $order->id,
            'first_name'     => $this->first_name,
            'last_name'      => $this->last_name,
            'phone'          => $this->phone,
            'street_address' => $this->street_address,
            'city'           => $this->city,
            'state'          => $this->state,
            'zip_code'       => $this->zip_code,
        ]);

        $order->items()->createMany($cart_items);

        if ($this->payment_method === 'stripe') {
            Stripe::setApiKey(config('services.stripe.secret'));

            $line_items = [];
            foreach ($cart_items as $item) {
                $line_items[] = [
                    'price_data' => [
                        'currency' => 'php',
                        'unit_amount' => (int) ($item['unit_amount'] * 100),
                        'product_data' => [
                            'name' => $item['name'],
                        ],
                    ],
                    'quantity' => $item['quantity'],
                ];
            }

            $session = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => Auth::user()->email,
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('success'),
                'cancel_url' => route('cancel'),
            ]);

            CartManagement::clearCartItems();
            return redirect($session->url);
        }

        Mail::to(Auth::user()->email)->send(new OrderPlaced($order));
        CartManagement::clearCartItems();

        return redirect()->route('success');
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $subtotal = CartManagement::calculateGrandTotal($cart_items);

        return view('livewire.checkout-page', [
            'cart_items'   => $cart_items,
            'subtotal'     => $subtotal,
            'shipping_fee' => $this->shipping_fee,
            'total'        => $subtotal + $this->shipping_fee,
        ]);
    }
}
