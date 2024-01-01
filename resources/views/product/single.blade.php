<x-app-layout>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <div class="lg:w-4/5 mx-auto flex flex-wrap">
                <img alt="ecommerce" class="lg:w-1/2 w-full lg:h-auto h-64 object-cover object-center rounded"
                     src="/storage/images/products/{{ $product->image->image }}">
                <div class="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <h1 class="text-white text-3xl title-font font-medium mb-1">{{ $product->name }}</h1>

                    <p class="leading-relaxed text-gray-400">{{ $product->title }}</p>
                    <form action="{{ route('addToCart', $product->id) }}" method="POST">
                        <div class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5">
                            <div class="flex justify-center items-center">
                                <span class="ml-3 text-gray-200">رنگ</span>
                                <ul class="flex flex-wrap mr-2 w-full gap-6">
                                    @foreach(json_decode($product->colors) as $color)
                                        <li>
                                            <input type="radio" id="{{ $color }}" name="color" value="{{ $color }}"
                                                   class="hidden peer" required>
                                            <label for="{{ $color }}"
                                                   class="inline-flex items-center justify-between w-full p-3 bg-{{ $color }}-500 border-{{ $color }}-500 rounded-full cursor-pointer peer-checked:border-2 peer-checked:border-white peer-checked:bg-{{ $color }}-700 hover:bg-{{ $color }}-600"></label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="flex">
                            <span
                                class="title-font font-medium text-xl text-yellow-500">{{ $product->price }} تومان</span>
                            @csrf
                            <button type="submit"
                                    class="flex mr-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded transition">
                                افزودن به سبد خرید
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
