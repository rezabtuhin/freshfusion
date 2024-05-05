@php use App\Models\User; @endphp
<x-user-layout title="Home" orders="{{ $count }}">
    <h1 class="mb-5 text-5xl font-extrabold">Trending Now</h1>
    <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-5S gap-5 w-full">
        @foreach($foods as $food)
            <a href="/food/{{ $food->id }}">
                <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-2">
                        <img class="rounded-lg" src="{{ asset($food->image) }}" alt="product image"/>
                    </div>
                    <div class="px-5 pb-5">
                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $food->name }}</h5>
                        <p>{{ User::find($food->vendor)->name }}</p>
                        <div class="flex items-center justify-between">
                            <span class="text-3xl font-bold text-gray-900 dark:text-white">৳ {{ $food->price_per_quantity }}</span>
                            <span class={{ $food->availability == '1' ? "text-green-500" : "text-red-500"}}>{{ $food->availability == '1' ? "Available" : "Not Available" }}</span>
                        </div>
                    </div>
                </div>
            </a>
    @endforeach
    </div>
    {{ $foods->links() }}
</x-user-layout>
