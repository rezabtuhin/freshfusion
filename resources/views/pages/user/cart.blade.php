<x-user-layout title="My Cart" orders="{{ $count }}">
    @if(count($carts) == 0)
        <div class="relative overflow-x-auto">
            <h1 class="text-2xl text-center font-medium">You don't have any items in your cart</h1>
        </div>
    @else
        <div id="cart-container">
            <div id="cart-table">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table id="cart-table" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-16 py-3">
                                <span class="sr-only">Image</span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Food
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Supplier
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Qty
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Price
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($carts as $cart)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="p-4">
                                <img src="{{asset($cart->image)}}" class="w-16 md:w-28 rounded-xl max-w-full max-h-full" alt="{{ $cart->food_name }}">
                            </td>
                            <td class="px-6 py-4">
                                <h1 class="font-semibold text-gray-900 dark:text-white">{{ $cart->food_name }}</h1>
                                <kbd
                                    class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">{{ $cart->category_name }}</kbd>
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $cart->user_name }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <button class="quantity-btn inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button" data-operation="decrease">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                        </svg>
                                    </button>
                                    <div>
                                        <input type="number" value="{{ $cart->quantity }}" data-cart-id="{{ $cart->cart_id }}" data-price-per-quantity="{{ $cart->price_per_quantity - $cart->discount }}" data-discount="{{ $cart->discount }}" id="first_product" class="quantity-input bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1" required />
                                    </div>
                                    <button class="quantity-btn inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button" data-operation="increase">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                <span class="total-price">
                                    {{ ($cart->quantity * $cart->price_per_quantity) - ($cart->quantity * $cart->discount) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <button class="remove-item-btn font-medium text-red-600 dark:text-red-500 hover:underline" data-cart-id="{{ $cart->cart_id }}">Remove</button>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="my-7">
                    <a href="/location" class="flex items-center justify-center gap-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 hover:cursor-pointer">
                        <span>Checkout</span>
                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                        </svg>

                    </a>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function (){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.quantity-btn').click(function() {
                    const operation = $(this).data('operation');
                    const input = $(this).closest('tr').find('.quantity-input');
                    let currentValue = parseInt(input.val());
                    if (operation === 'increase') {
                        input.val(currentValue + 1);
                    } else if (operation === 'decrease') {
                        if(currentValue > 1){
                            input.val(currentValue - 1);
                        }
                        else{
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                },
                            });
                            Toast.fire({
                                icon: "error",
                                title: "Item can't be Zero or less. You can remove item if you want."
                            });
                            return;
                        }
                    }
                    const cartId = input.data('cart-id');
                    const newQuantity = parseInt(input.val());
                    $.ajax({
                        url: '/update-cart',
                        method: 'PUT',
                        data: {
                            cart_id: cartId,
                            quantity: newQuantity
                        },
                        success: function(response) {
                            const totalPrice = newQuantity * parseFloat(input.data('price-per-quantity')) - newQuantity * parseFloat(input.data('discount'));
                            input.closest('tr').find('.total-price').text(totalPrice);
                        },
                        error: function(xhr, status, error) {
                            // console.error(xhr.responseText);
                        }
                    });
                });
                $('.remove-item-btn').click(function() {
                    const cartId = $(this).data('cart-id');
                    if (confirm('Are you sure you want to remove this item?')) {
                        const button = $(this);
                        $.ajax({
                            url: '/remove-cart-item/' + cartId,
                            method: 'DELETE',
                            success: function(response) {
                                button.closest('tr').remove();
                                if ($('tbody tr').length === 0) {
                                    $('#cart-table').remove();
                                    $('#cart-container').html('<h1 class="text-2xl text-center font-medium">You don\'t have any items in your cart</h1>');
                                }
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.onmouseenter = Swal.stopTimer;
                                        toast.onmouseleave = Swal.resumeTimer;
                                    },
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: "Item removed successfully."
                                });
                                if(parseInt(response.message) === 0){
                                    $('#cart-item').remove();
                                }
                                else{
                                    $('#cart-item').html(response.message)
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(xhr.responseText);
                            }
                        });
                    }
                });
            })
        </script>

{{--        {{ $cart }}--}}
    @endif
</x-user-layout>
