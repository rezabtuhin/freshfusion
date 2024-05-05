@php use App\Models\Cart; @endphp
<x-user-layout title="My Orders" orders="{{ $count }}">
    @if(count($pendingOrders) == 0 && count($receivedOrders) == 0)
        <h1 class="text-2xl text-center font-extrabold mb-3">Nothing to show</h1>
    @endif
    @if(count($pendingOrders) > 0)
        <h1 class="text-3xl font-extrabold mb-3">Pending Orders</h1>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Order Token
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Items
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Order Taken By
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Current Status
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Vendor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Received?
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($pendingOrders as $order)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $order->order_token }}
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $foods = Cart::where('order_token', $order->id)->get();
                            @endphp
                            <details>
                                <summary>Expand to view</summary>
                                <ol class="list-decimal">
                                    @foreach($foods as $food)
                                        <li>Name: {{ \App\Models\Food::find($food->food_id)->name }} - Quantity:
                                            {{ $food->quantity }}</li>
                                    @endforeach
                                </ol>
                            </details>
                        </td>
                        <td class="px-6 py-4">
                            @if($order->order_taken_by)
                                <p>Name: {{ \App\Models\User::find($order->order_taken_by)->name }}</p>
                                <p>Phone: {{ \App\Models\User::find($order->order_taken_by)->phone }}</p>
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($order->current_status)
                                {{ $order->current_status }}
                            @else
                                In queue
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ \App\Models\User::find($order->vendor)->name }}
                        </td>
                        <td class="px-6 py-4">
                            <form class="max-w-sm mx-auto">
                                @csrf
                                <input id="default-checkbox" data-order-id="{{ $order->order_token }}" type="checkbox" value="" @if($order->current_status != 'Delivered') disabled @endif class="checkbox-trigger w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <script>
                    $(document).ready(function() {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('.checkbox-trigger').change(function() {
                            const orderId = $(this).data('order-id');
                            if ($(this).prop('checked')) {
                                $.ajax({
                                    url: '{{ url('/receive-order') }}',
                                    method: 'PUT',
                                    data: {
                                        order_token: orderId,
                                    },
                                    success: function(response) {
                                        location.reload();
                                    },
                                    error: function(xhr, status, error) {
                                        console.error(xhr.responseText);
                                    }
                                });
                            }
                        });
                    });
                </script>
            </table>
        </div>
    @endif

    @if(count($receivedOrders) > 0)
        <h1 class="text-3xl font-extrabold mt-9 mb-5">Received Orders</h1>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Order Token
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Items
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Delivery Man
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Current Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Vendor
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Received?
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($receivedOrders as $order)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">
                                {{ $order->order_token }}
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $foods = Cart::where('order_token', $order->id)->get();
                                @endphp
                                <details>
                                    <summary>Expand to view</summary>
                                    <ol class="list-decimal">
                                        @foreach($foods as $food)
                                            <li>Name: {{ \App\Models\Food::find($food->food_id)->name }} - Quantity:
                                                {{ $food->quantity }}</li>
                                        @endforeach
                                    </ol>
                                </details>
                            </td>
                            <td class="px-6 py-4">
                                @if($order->order_taken_by)
                                    <p>Name: {{ \App\Models\User::find($order->order_taken_by)->name }}</p>
                                    <p>Phone: {{ \App\Models\User::find($order->order_taken_by)->phone }}</p>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($order->current_status)
                                    {{ $order->current_status }}
                                @else
                                    In queue
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ \App\Models\User::find($order->vendor)->name }}
                            </td>
                            <td class="px-6 py-4">
                                Received
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    @endif
</x-user-layout>
