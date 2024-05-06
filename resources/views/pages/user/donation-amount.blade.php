<x-user-layout title="Donation | Amount" orders="{{ $count }}">
    <form class="max-w-md mx-auto h-96 flex items-center justify-center bg-pink-700 p-4" action="/amount/donation" method="POST">
        @csrf
        <div>
            <img src="{{ asset('/storage/images/bkash_payment_logo.png') }}">
            <h1 class="text-center py-4 text-white">Enter the amount</h1>
            <div class="flex items-center">
                <div id="dropdown-phone-button" data-dropdown-toggle="dropdown-phone" class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg" type="button">
                    <p class="font-bold">৳</p>
                </div>
                <div class="relative w-full">
                    <input type="text" name="amount" id="phone-input" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-0 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="300" required />
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
</x-user-layout>
