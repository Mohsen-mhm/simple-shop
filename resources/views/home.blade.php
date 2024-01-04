<x-app-layout>
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                @foreach(\App\Models\Product::all() as $product)
                    <div class="relative group overflow-hidden rounded-lg bg-gray-800 text-white">
                        <a class="absolute inset-0 z-10" href="{{ route('product.single', $product->slug) }}">
                            <span class="sr-only">{{ $product->name }}</span>
                        </a>
                        <img src="./storage/images/products/{{ $product->image->image }}" alt="{{ $product->name }}"
                             class="object-cover w-full h-60" width="200"
                             height="200" style="aspect-ratio: 400 / 300; object-fit: cover;"/>
                        <div class="p-4">
                            <h3 class="font-semibold text-lg md:text-xl">{{ $product->name }}</h3>
                            <p class="text-sm">{{ $product->title }}</p>
                            <h4 class="font-semibold text-base md:text-lg">{{ $product->price }} تومان</h4>
                            @if($product->quantity)
                                <button
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                    جزئیات
                                </button>
                            @else
                                <button
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                    اتمام موجودی
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
