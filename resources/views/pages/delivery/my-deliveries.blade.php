@php use App\Models\Cart; @endphp
<x-delivery-layout title="My Deliveries | Delivery Man">
    @if(count($pendingDeliveries) < 1 && count($doneDeliveries) < 1)
        <div class="relative overflow-x-auto">
            <h1 class="text-2xl text-center font-medium">Nothing to show</h1>
        </div>
    @else
        <div class="relative overflow-x-auto rounded-t-lg ">
            @if(count($pendingDeliveries) > 0)
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
                                Customer
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Delivered?
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Received By Customer?
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Cancel?
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($pendingDeliveries as $pendingDelivery)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th class="px-6 py-4 font-medium">
                                {{ $pendingDelivery->order_token }}
                            </th>
                            <td class="px-6 py-4 text-gray-800">
                                @php
                                    $foods = Cart::where('order_token', $pendingDelivery->id)->get();
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
                                @if($pendingDelivery->order_by)
                                    <p>Name: {{ \App\Models\User::find($pendingDelivery->order_by)->name }}</p>
                                    <p>Phone: {{ \App\Models\User::find($pendingDelivery->order_by)->phone }}</p>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <form class="max-w-sm mx-auto">
                                    @csrf
                                    <input id="default-checkbox" type="checkbox" value="" data-order-id="{{ $pendingDelivery->id }}" @if($pendingDelivery->current_status != 'Picked') disabled @endif @if($pendingDelivery->current_status == 'Delivered') checked disabled @endif class="checkbox-trigger w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                @if($pendingDelivery->delivered == 0) Not Yet @else Yes @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($pendingDelivery->current_status != 'Delivered' && $pendingDelivery->current_status != 'Picked')
                                    <a href="/me/cancel/{{$pendingDelivery->order_token}}" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancel</a>
                                @endif
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
                                        url: '{{ url('/me/update-order') }}',
                                        method: 'PUT',
                                        data: {
                                            id: orderId,
                                            current_status: 'Delivered'
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
            @endif
            @if(count($doneDeliveries) > 0 )
                <h1 class="font-extrabold text-3xl mb-5 mt-9">Delivered Orders</h1>
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
                            Customer
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Delivered?
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Received By Customer?
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($doneDeliveries as $doneDelivery)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th class="px-6 py-4 font-medium">
                                {{ $doneDelivery->order_token }}
                            </th>
                            <td class="px-6 py-4 text-gray-800">
                                @php
                                    $foods = Cart::where('order_token', $doneDelivery->id)->get();
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
                                @if($doneDelivery->order_by)
                                    <p>Name: {{ \App\Models\User::find($doneDelivery->order_by)->name }}</p>
                                    <p>Phone: {{ \App\Models\User::find($doneDelivery->order_by)->phone }}</p>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                Yes
                            </td>
                            <td class="px-6 py-4">
                                Yes
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    @endif
</x-delivery-layout>
