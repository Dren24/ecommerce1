<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px;
        }
        th {
            background: #f2f2f2;
        }
        .right {
            text-align: right;
        }
    </style>
</head>
<body>

<h2>Invoice</h2>

<p>
<strong>Order #:</strong> {{ $order->id }}<br>
<strong>Date:</strong> {{ $order->created_at->format('d M Y') }}<br>
<strong>Customer:</strong> {{ $address->first_name }} {{ $address->last_name }}<br>
<strong>Phone:</strong> {{ $address->phone }}
</p>

<p>
<strong>Shipping Address:</strong><br>
{{ $address->street_address }}<br>
{{ $address->city }}, {{ $address->state }}, {{ $address->zip_code }}
</p>

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
@foreach($order_items as $item)
<tr>
    <td>{{ $item->product->name ?? 'Product' }}</td>
    <td class="right">{{ number_format($item->unit_amount, 2) }}</td>
    <td class="right">{{ $item->quantity }}</td>
    <td class="right">{{ number_format($item->total_amount, 2) }}</td>
</tr>
@endforeach
</tbody>
</table>

<table>
<tr>
    <td class="right">Subtotal</td>
    <td class="right">{{ number_format($subtotal, 2) }}</td>
</tr>
<tr>
    <td class="right">Shipping</td>
    <td class="right">{{ number_format($shipping, 2) }}</td>
</tr>
<tr>
    <td class="right"><strong>Total</strong></td>
    <td class="right"><strong>{{ number_format($order->grand_total, 2) }}</strong></td>
</tr>
</table>

</body>
</html>
