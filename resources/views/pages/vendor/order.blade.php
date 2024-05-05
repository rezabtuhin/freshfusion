@php use App\Models\Cart; @endphp
<x-vendor-layout title="Orders">
    @if(count($pendingOrders) < 1 && count($receivedOrders) < 1)
        <div class="relative overflow-x-auto">
            <h1 class="text-2xl text-center font-medium">Nothing to show</h1>
        </div>
    @else
        <div class="relative overflow-x-auto rounded-t-lg ">
            @if(count($pendingOrders) > 0)
                <h1 class="font-extrabold text-3xl mb-5">Pending Orders</h1>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pendingOrders as $pendingOrder)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th class="px-6 py-4 font-medium">
                                {{ $pendingOrder->order_token }}
                            </th>
                            <td class="px-6 py-4 text-gray-800">
                                @php
                                    $foods = Cart::where('order_token', $pendingOrder->id)->get();
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
                                @if($pendingOrder->order_taken_by)
                                    <p>{{ \App\Models\User::find($pendingOrder->order_taken_by)->name }}</p>
                                    <p>{{ \App\Models\User::find($pendingOrder->order_taken_by)->phone }}</p>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <form class="max-w-sm mx-auto">
                                    @csrf
                                    <select id="status" name="current_status" data-order-id="{{ $pendingOrder->id }}" data-previous-status="{{ $pendingOrder->current_status }}" class="status-select bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option @if(!$pendingOrder->current_status) selected @endif>Choose an option</option>
                                        @php
                                            if ($pendingOrder->order_taken_by){
                                                $statuses = array('In Progress', 'Picked');
                                            }
                                            else{
                                                $statuses = array('In Progress');
                                            }
                                        @endphp
                                        @foreach($statuses as $status)
                                            @if($pendingOrder->current_status === $status)
                                                <option value="{{ $status}}" selected>{{ $pendingOrder->current_status}}</option>
                                            @else
                                                <option value="{{ $status}}">{{ $status}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <script>
                    $(document).ready(function() {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $('.status-select').change(function() {
                            const orderId = $(this).data('order-id');
                            const newStatus = $(this).val();
                            console.log(orderId, newStatus)
                            if (newStatus === 'Choose an option') {
                                alert('Please select a valid status.');
                                return;
                            }
                            const previousStatus = $(this).data('previous-status');
                            if (newStatus === previousStatus) {
                                alert('Please select a different status.');
                                return;
                            }
                            $(this).data('previous-status', newStatus);
                            $.ajax({
                                url: '{{ url('/vendor/update') }}',
                                method: 'PUT',
                                data: {
                                    id: orderId,
                                    current_status: newStatus
                                },
                                success: function(response) {
                                    if (newStatus === 'Picked') {
                                        location.reload();
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        });
                    });
                </script>
            @endif
            @if(count($receivedOrders) > 0)
                <h1 class="font-extrabold text-3xl my-5">Old Orders</h1>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($receivedOrders as $receivedOrder)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th class="px-6 py-4 font-medium">
                                {{ $receivedOrder->order_token }}
                            </th>
                            <td class="px-6 py-4 text-gray-800">
                                @php
                                    $foods = Cart::where('order_token', $receivedOrder->id)->get();
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
                                @if($receivedOrder->order_taken_by)
                                    <p>{{ \App\Models\User::find($pendingOrder->order_taken_by)->name }}</p>
                                    <p>{{ \App\Models\User::find($pendingOrder->order_taken_by)->phone }}</p>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($receivedOrder->current_status == 'Picked')
                                    Delivery man picked up the order.
                                @elseif($receivedOrder->delivered == 1)
                                    Customer received the food.
                                @endif
                            </td>
                    @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    @endif
</x-vendor-layout>
