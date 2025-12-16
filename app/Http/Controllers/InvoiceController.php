<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function download(Order $order)
    {
        $order->load(['items.product', 'address']);

        $shipping = $order->shipping_amount ?? 0;
        $subtotal = max($order->grand_total - $shipping, 0);

        $pdf = Pdf::loadView('pdf.invoice', [
            'order'       => $order,
            'order_items' => $order->items,
            'address'     => $order->address,
            'shipping'    => $shipping,
            'subtotal'    => $subtotal,
        ]);

        return $pdf->download('invoice-order-' . $order->id . '.pdf');
    }
}
