@extends('layouts.master')

@section('content')
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
                            <button
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 hover:bg-primary/90 h-10 px-4 py-2 bg-white text-gray-800">
                                جزئیات
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
