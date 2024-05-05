<x-user-layout title="Enter your location" orders="{{ $count }}">

    <form class="mx-auto" action="/place-order" method="POST">
        @csrf
        <div class="flex">
            <div class="w-full space-y-2">
                <input type="search" name="location" id="location-search" class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700  dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" placeholder="Enter your pickup location" required />
                <div class="flex justify-center">
                    <button type="submit" class="flex items-center justify-center gap-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 hover:cursor-pointer">
                        <span>Payment</span>
                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </form>

{{--    <script>--}}
{{--        $(document).ready(function (){--}}
{{--            var autocomplete;--}}
{{--            autocomplete = new google.maps.places.Autocomplete((document.getElementById('location-search')),{--}}
{{--                types: ['geocode']--}}
{{--            })--}}

{{--            google.maps.event.addListener(autocomplete, 'place_changed', function (){--}}
{{--                var near_place = autocomplete.getPlace()--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
</x-user-layout>
