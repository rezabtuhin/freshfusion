<x-user-layout title="Compare Food" orders="{{ $count }}">
    <h1 class="mb-6 text-3xl font-extrabold">Comparison</h1>
    <div class="grid grid-cols-2 gap-5">
        <div>
            <div class="mb-4">
                <select id="food_1" name="food_1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a Food</option>
                    @foreach($foods as $food)
                        <option value="{{ $food->id }}">{{ $food->name }} - ({{\App\Models\User::find($food->vendor)->name}})</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center justify-center" id="loading_1" style="display: none;">
                <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            </div>
            <div class="border border-gray-800" id="food_1_details_div" style="display: none;">
                <div id="f-image-1" class="flex items-center justify-center p-5">
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Name
                            </th>
                            <td id="f-name-1" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Vendor
                            </th>
                            <td id="f-vendor-1" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Category
                            </th>
                            <td id="f-category-1" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Price
                            </th>
                            <td id="f-price-1" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Availability
                            </th>
                            <td id="f-availability-1" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Description
                            </th>
                            <td id="f-description-1" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Ingredients
                            </th>
                            <td class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">
                                <ol id="f-ingredients-1"></ol>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <div class="mb-4">
                <select id="food_2" name="food_2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a Food</option>
                    @foreach($foods as $food)
                        <option value="{{ $food->id }}">{{ $food->name }} - ({{\App\Models\User::find($food->vendor)->name}})</option>
                    @endforeach
                </select>
            </div>
            <div class="border border-gray-800" id="food_2_details_div" style="display: none;">
                <div id="f-image-2" class="flex items-center justify-center p-5">
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <tbody>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Name
                            </th>
                            <td id="f-name-2" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Vendor
                            </th>
                            <td id="f-vendor-2" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Category
                            </th>
                            <td id="f-category-2" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Price
                            </th>
                            <td id="f-price-2" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Availability
                            </th>
                            <td id="f-availability-2" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Description
                            </th>
                            <td id="f-description-2" class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">

                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="w-[35%] max-w-[35%] bg-gray-300 font-bold text-black text-[18px]">
                                Ingredients
                            </th>
                            <td class="px-6 py-4 w-[75%] max-w-[75%] text-black text-[18px]" style="word-break: break-word">
                                <ol id="f-ingredients-2"></ol>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
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
            $('#food_1').change(function (){
                const food_id = $(this).val();
                if(food_id !== "Choose a Food") {
                    var imageUrl = window.location.origin;
                    $.ajax({
                        url: '/fetch-food-data',
                        method: 'GET',
                        dataType: 'json',
                        data: {
                            food_id: food_id
                        },
                        success: function (data) {
                            $('#food_1_details_div').fadeOut();
                            setTimeout(function () {
                                $('#food_1_details_div').fadeIn();
                                $('#f-image-1').html(`<img src="` + imageUrl + data.image + `" width="350" class="rounded-xl">`);
                                $('#f-name-1').html(data.name);
                                $('#f-vendor-1').html(data.vendor);
                                $('#f-category-1').html(data.category);
                                $('#f-price-1').html(data.price);
                                $('#f-availability-1').html(data.availability);
                                $('#f-description-1').html(data.description);
                                $('#f-ingredients-1').empty();
                                data.ingredients.forEach(function (item, index) {
                                    $('#f-ingredients-1').append("<li>" + parseInt(index + 1) + ". " + item + "</li>").hide().fadeIn();
                                });
                            }, 500);
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
                else{
                    $('#food_1_details_div').fadeOut();
                }
            })

            $('#food_2').change(function (){
                const food_id = $(this).val();
                var imageUrl = window.location.origin;
                if(food_id !== "Choose a Food") {
                    $.ajax({
                        url: '/fetch-food-data',
                        method: 'GET',
                        dataType: 'json',
                        data: {
                            food_id: food_id
                        },
                        success: function (data) {
                            $('#food_2_details_div').fadeOut();
                            setTimeout(function (){
                                $('#food_2_details_div').fadeIn()
                                $('#f-image-2').html(`<img src="` + imageUrl + data.image + `" width="350" class="rounded-xl">`)
                                $('#f-name-2').html(data.name);
                                $('#f-vendor-2').html(data.vendor);
                                $('#f-category-2').html(data.category);
                                $('#f-price-2').html(data.price);
                                $('#f-availability-2').html(data.availability);
                                $('#f-description-2').html(data.description);
                                $('#f-ingredients-2').empty();
                                data.ingredients.forEach(function (item, index) {
                                    $('#f-ingredients-2').append(
                                        "<li>" + parseInt(index + 1) + ". " + item + "</li>"
                                    );
                                });
                            }, 500);
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
                else{
                    $('#food_2_details_div').fadeOut();
                }
            })
        })
    </script>
</x-user-layout>
