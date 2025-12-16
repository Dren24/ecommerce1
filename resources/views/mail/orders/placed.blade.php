<x-mail::message>
# Order Placed Successfully 🎉

Thank you for your order.

**Order Number:** {{ $order->id }}  
**Total Amount:** ₱{{ number_format($order->grand_total, 2) }}  
**Payment Method:** {{ strtoupper($order->payment_method) }}

<x-mail::button :url="$url">
View Order
</x-mail::button>

Thanks,  
{{ config('app.name') }}
</x-mail::message>
