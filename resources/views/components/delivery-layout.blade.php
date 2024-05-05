@php
    use App\Models\Order;use Illuminate\Support\Facades\Auth;
    $pendingDelivery = Order::where('order_taken_by', Auth::user()->id)
                    ->where('delivered', 0)
                    ->count();
@endphp

<x-layout title="{{ $title }}">
    <nav class="fixed top-0 z-50 w-full bg-gray-300 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                            aria-controls="logo-sidebar" type="button"
                            class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                  d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <a href="/vendor/create" class="flex ms-2 md:me-24">
                        <h1 class="lg:text-5xl md:text-4xl sm:text-3xl text-3xl text-center" style="
                            font-family: 'Righteous', sans-serif;
                            font-weight: 800;
                            font-style: normal;">
                            <span class="text-blue-600">Fresh</span>Fusion
                        </h1>
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div>
                            <h1 class="font-semibold text-[18px] bg-blue-300 p-4 rounded-[50%]">
                                @php
                                    $name = Auth::user()->name;
                                    $words = explode(' ', $name);
                                    $newString = '';
                                    foreach ($words as $word) {
                                        $newString .= strtoupper(substr($word, 0, 1));
                                        if (strlen($newString) >= 2) {
                                            break;
                                        }
                                    }
                                @endphp
                                {{ $newString }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
           class="bg-gray-200 fixed top-0 left-0 z-40 w-64 h-screen pt-28 transition-transform -translate-x-full border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
           aria-label="Sidebar">
        <div class="bg-gray-200 h-full px-3 pb-4 overflow-y-auto dark:bg-gray-800">
            <ul class="space-y-2 font-medium">
                @php
                    $url = request()->url();
                    $path = basename(parse_url($url, PHP_URL_PATH));
                @endphp
                <li>
                    <a href="/me/dashboard"
                       class="{{ $path == 'dashboard' ? 'bg-gray-50' : ''}} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                             viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                  d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="ms-3">Home</span>
                    </a>
                </li>
                <li>
                    <a href="/me/deliveries"
                       class="{{ $path == 'deliveries' ? 'bg-gray-50' : ''}} flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <svg
                            class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                  d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                  clip-rule="evenodd"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Deliveries</span>
                        @if(isset($pendingDelivery) && $pendingDelivery > 0)
                            <span id="cart-item"
                                  class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">{{ $pendingDelivery }}</span>
                        @endif
                    </a>
                </li>
                <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full flex items-center justify-start p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg
                                class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                            </svg>
                            <span class="flex ms-3 whitespace-nowrap">Sign Out</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        <div class="p-4 mt-20">
            {{ $slot }}
        </div>
    </div>
</x-layout>
