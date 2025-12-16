<div class="min-h-screen bg-slate-100 dark:bg-slate-950">
    <div class="max-w-7xl mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">
            My Orders
        </h1>

        <div class="bg-white dark:bg-slate-900 rounded-xl shadow overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-slate-50 dark:bg-slate-800">
                    <tr class="text-xs uppercase text-gray-500 dark:text-gray-400">
                        <th class="px-6 py-3 text-left">Order #</th>
                        <th class="px-6 py-3 text-left">Date</th>
                        <th class="px-6 py-3 text-left">Order Status</th>
                        <th class="px-6 py-3 text-left">Payment</th>
                        <th class="px-6 py-3 text-left">Amount (PHP)</th>
                        <th class="px-6 py-3 text-right">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse ($orders as $order)

                        @php
                            $orderStatusColors = [
                                'new' => 'bg-blue-500',
                                'processing' => 'bg-yellow-500',
                                'shipped' => 'bg-indigo-500',
                                'delivered' => 'bg-green-600',
                                'cancelled' => 'bg-red-500',
                            ];

                            $paymentStatusColors = [
                                'pending' => 'bg-yellow-500',
                                'paid' => 'bg-green-600',
                                'failed' => 'bg-red-500',
                            ];
                        @endphp

                        <tr wire:key="order-{{ $order->id }}">
                            <td class="px-6 py-4 font-medium text-gray-800 dark:text-gray-200">
                                #{{ $order->id }}
                            </td>

                            <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-white text-xs px-3 py-1 rounded-full
                                    {{ $orderStatusColors[$order->status] ?? 'bg-gray-500' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <span class="text-white text-xs px-3 py-1 rounded-full
                                    {{ $paymentStatusColors[$order->payment_status] ?? 'bg-gray-500' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 font-semibold text-gray-800 dark:text-gray-200">
                                {{ Number::currency($order->grand_total, 'PHP') }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('myorders.show', $order->id) }}"
                                   class="inline-flex items-center px-4 py-2 rounded-lg
                                          bg-indigo-600 hover:bg-indigo-700 text-white text-sm">
                                    View
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                You have no orders yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $orders->links() }}
        </div>

    </div>
</div>
