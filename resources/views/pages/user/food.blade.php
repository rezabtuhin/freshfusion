@php
    use App\Models\Category;
    use App\Models\User;
@endphp
<x-user-layout title="{{ $food->name }}" orders="{{ $count }}">
    <div class="banner-image h-96"
         style="
            background-image: url('{{ asset($food->image) }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            ">
    </div>
    <div class="border-b-gray-800 border-b mb-5">
        @if($food->availability == "1")
            <div class="my-6 flex items-center justify-between">
                <h1 class="text-2xl font-semibold">Availability: Available</h1>
                <div>
                    <form class="max-w-xs mx-auto flex items-center gap-3" method="POST" id="add-item">
                        @csrf
                        <div class="flex items-center max-w-[8rem]">
                            <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-12 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="M1 1h16"/>
                                </svg>
                            </button>
                            <input type="text" name="quantity" id="quantity-input" data-input-counter
                                   aria-describedby="helper-text-explanation"
                                   class="bg-gray-50 border-x-0 border-gray-300 h-12 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="0" required/>
                            <button type="button" id="increment-button" data-input-counter-increment="quantity-input"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-12 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="M9 1v16M1 9h16"/>
                                </svg>
                            </button>
                        </div>
                        <div class="flex items-center max-w-[8rem] pt-1.5">
                            <button type="submit"
                                    class="h-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-3 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Add to cart
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <h1 class="text-2xl font-semibold my-6 ">Availability: Not available</h1>
        @endif
    </div>

    <div>
        <div class="mb-5">
            <div class="flex items-center justify-between">
                <h1 class="text-5xl font-medium">{{ $food->name }}</h1>
                <h1>
                    @if($food->discount > 0)
                        <p>
                            <span class="line-through text-red-600 text-2xl">৳{{ $food->price_per_quantity }}</span> &nbsp; <span class="text-4xl">৳{{ $food->price_per_quantity - $food->discount }}</span>
                        </p>
                    @else
                        <p>
                            <span class="text-4xl">৳{{ $food->price_per_quantity - $food->discount }}</span>
                        </p>
                    @endif
                </h1>
            </div>
            <kbd
                class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">{{ User::find($food->vendor)->name }}</kbd>
            <kbd
                class="px-2 py-1.5 text-xs font-semibold text-gray-800 bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-600 dark:text-gray-100 dark:border-gray-500">{{ Category::find($food->category)->name }}</kbd>
        </div>
        <p class="text-[16px] mb-5">{{ $food->description }}</p>

        <h1 class="text-3xl font-medium">Ingredients</h1>
        <div class="my-5">
            @foreach($ingredients as $ingredient)
                <div class="flex items-center gap-5 mb-4">
                    <svg class="w-9 h-9 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 21a9 9 0 1 1 0-18c1.052 0 2.062.18 3 .512M7 9.577l3.923 3.923 8.5-8.5M17 14v6m-3-3h6"/>
                    </svg>
                    <span class="text-[20px]">
                        {{ $ingredient }}
                    </span>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        $(document).ready(function (e){
            $('#add-item').submit(function (e){
                e.preventDefault();
                let formData = $(this).serialize();
                formData += '&food=' + {{ $food->id }};
                $.ajax({
                    method: 'POST',
                    url: '{{ url('/food/add_to_cart') }}',
                    data: formData,
                    success: function(response) {
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
                            title: "Item added to you cart!"
                        });
                        document.getElementById('add-item').reset();
                        if ($('#cart-item').length === 0){
                            $('#cart-link').append(
                                `
                                <span id="cart-item" class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">`+response+`</span>
                                `
                            )
                        }
                        else{
                            $('#cart-item').html(response);
                        }
                    },
                    error: function(xhr, status, error) {
                        const response = JSON.parse(xhr.responseText);
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
                            title: response.message
                        });
                    }
                })
            })
        })
    </script>
</x-user-layout>
