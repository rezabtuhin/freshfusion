@php use Carbon\Carbon; @endphp
<x-user-layout title="Donation" orders="{{ $count }}">
    <div class="p-4 mb-10 flex items-center gap-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
        <svg class="flex-shrink-0 inline w-8 h-8 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <p class="text-2xl">Donated money will directly save into the <span class="text-blue-600 font-bold">Fresh</span>Fusion account, and will be distributed to those who are in need at the end of each month. Contact us at <a class="text-blue-600 underline" href = "mailto:admin@freshfusion.com">admin@freshfusion.com</a> for further enquiries.</p>
    </div>
    <form class="max-w-md mx-auto h-96 flex items-center justify-center bg-pink-700 p-4" action="/otp/donation" method="POST">
        @csrf
        <div>
            <img src="{{ asset('/storage/images/bkash_payment_logo.png') }}">
            <h1 class="text-center py-4 text-white">Enter your bkash number</h1>
            <div class="flex items-center">
                <div id="dropdown-phone-button" data-dropdown-toggle="dropdown-phone" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg" type="button">
                    +880
                </div>
                <div class="relative w-full">
                    <input type="text" name="phone" id="phone-input" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="1778798873" required />
                </div>
            </div>
            <button type="submit" class="w-full mt-4 flex items-center justify-center gap-3 text-white bg-pink-900 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 hover:cursor-pointer">
                <span>Continue</span>
                <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                </svg>
            </button>
        </div>
    </form>


    @if(isset($donations) && count($donations) > 0)
    <div class="relative overflow-x-auto mt-10">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Transaction ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Number
                </th>
                <th scope="col" class="px-6 py-3">
                    Amount
                </th>
                <th scope="col" class="px-6 py-3">
                    Donated at
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($donations as $donation)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $donation->transaction_id }}
                    </th>
                    <td class="px-6 py-4">
                        +880{{ $donation->number }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $donation->amount }}
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $dateTime = Carbon::parse($donation->created_at);
                            $readableDateTime = $dateTime->format('F j, Y g:i A');
                        @endphp
                        {{ $readableDateTime }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p class="text-center text-2xl mt-10 font-black border">You haven't made any donations</p>
    @endif


</x-user-layout>
