<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            margin-bottom: 20px;
        }
        .title {
            font-size: 20px;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background: #f3f4f6;
        }
        .right {
            text-align: right;
        }
    </style>
</head>

<body>

<div class="header">
    <div class="title">Invoice</div>
    <p>
        Order #: {{ $order->id }}<br>
        Date: {{ $order->created_at->format('d M Y') }}
    </p>
</div>

<h4>Billing / Shipping</h4>
<p>
    {{ $order->address->first_name }} {{ $order->address->last_name }}<br>
    {{ $order->address->street_address }}<br>
    {{ $order->address->city }},
    {{ $order->address->state }},
    {{ $order->address->zip_code }}<br>
    Phone: {{ $order->address->phone }}
</p>

<h4>Order Items</h4>

<table>
    <thead>
        <tr>
            <th>Product</th>
            <th class="right">Price</th>
            <th class="right">Qty</th>
            <th class="right">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->items as $item)
        <tr>
            <td>{{ $item->product->name ?? 'Product removed' }}</td>
            <td class="right">{{ Number::currency($item->unit_amount, 'PHP') }}</td>
            <td class="right">{{ $item->quantity }}</td>
            <td class="right">{{ Number::currency($item->total_amount, 'PHP') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<br>

<table>
    <tr>
        <td>Subtotal</td>
        <td class="right">
            {{ Number::currency($order->grand_total - $order->shipping_amount, 'PHP') }}
        </td>
    </tr>
    <tr>
        <td>Shipping ({{ $order->shipping_method }})</td>
        <td class="right">
            {{ Number::currency($order->shipping_amount, 'PHP') }}
        </td>
    </tr>
    <tr>
        <th>Total</th>
        <th class="right">
            {{ Number::currency($order->grand_total, 'PHP') }}
        </th>
    </tr>
</table>

</body>
</html>

