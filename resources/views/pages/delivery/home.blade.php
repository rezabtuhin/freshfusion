@php
    use App\Models\Order;use App\Models\User;use Illuminate\Support\Facades\Auth;
    $pendingDelivery = Order::where('order_taken_by', Auth::user()->id)
                        ->where('delivered', 0)
                        ->count();
@endphp
<x-delivery-layout title="Home | Delivery Man">
    <h1 class="mb-5 text-5xl font-extrabold">Open Orders Now</h1>
    <div class="grid grid-cols-1  sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($onGoingOrders as $onGoingOrder)
            <div
                class="flex flex-col items-center justify-between bg-white border border-gray-200 rounded-lg shadow md:flex-row hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                <div class="flex flex-col justify-between p-4 leading-normal">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ User::find($onGoingOrder->vendor)->name }}</h5>
                    <p class="mb-3 font-normal text-gray-500 flex items-center gap-1">
                        <svg class="w-6 h-6 text-gray-500 dark:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z"/>
                        </svg>
                        <span>{{ $onGoingOrder->location }}</span>
                    </p>
                    <span class="mt-3">
                        <a @if($pendingDelivery == 0) href="/me/accept/{{$onGoingOrder->order_token}}" @endif class="p-4 @if($pendingDelivery == 0) bg-green-600 @else bg-green-400 @endif text-white font-bold">
                            Accept
                        </a>
                    </span>
                </div>
                <img class="object-cover rounded-lg w-44" src="{{ asset(User::find($onGoingOrder->vendor)->banner) }}"
                     alt="">
            </div>
        @endforeach
    </div>
</x-delivery-layout>
