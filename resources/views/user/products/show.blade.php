<x-app-user-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($product->name) }}
        </h2>
    </x-slot> --}}

    <div class="min-w-screen min-h-screen bg-yellow-100 flex items-center p-5 lg:p-10 overflow-hidden relative">
        <div class="w-full max-w-6xl rounded bg-white shadow-xl p-10 lg:p-20 mx-auto text-gray-800 relative md:text-left">
            <div class="md:flex items-center -mx-10">
                <div class="w-full md:w-1/2 px-10 mb-10 md:mb-0">
                    <div class="relative">
                        <img src="{{$product->image ? asset('storage/'. $product->image) : asset('storage/images/no-image.jpg')}}" class="w-full relative z-10" alt="">
                        <div class="border-4 border-yellow-200 absolute top-10 bottom-10 left-10 right-10 z-0"></div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 px-10">
                    <div class="mb-10">
                        <h1 class="font-bold uppercase text-2xl mb-5">{{ $product->name }}</h1>
                        <p class="text-sm">{{ $product->description }} </p>
                        <div class="flex mt-4">
                            <div>
                                <p tabindex="0" class="focus:outline-none text-xs text-gray-600 px-2 bg-yellow-100 py-1">{{ ucfirst($product->category) }}</p>
                            </div>
                            <div class="pl-2">
                                <p tabindex="0" class="focus:outline-none text-xs text-gray-600 px-2 bg-yellow-100 py-1">Stock {{ $product->stock }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="inline-block align-bottom mr-5">
                            <span class="text-2xl leading-none align-baseline">$</span>
                            <span class="font-bold text-5xl leading-none align-baseline">{{ number_format((int)$product->price) }}</span>
                            <span class="text-2xl leading-none align-baseline">.{{ (number_format($product->price - (int)$product->price,2))*100 }}</span>
                        </div>
                        <div class="inline-block align-bottom">
                            <button id="{{ $product->id }}" name="{{$product->name}}" class="btnCarrito bg-yellow-300 opacity-75 hover:opacity-100 text-yellow-900 hover:text-gray-900 rounded-full px-10 py-2 font-semibold"><i class="mdi mdi-cart -ml-2 mr-2"></i> Agregar al Carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--     <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @isset($product)
                    <div>
                        <p>Price: <b>{{ $product->price }}</b></p>
                        <p>Category: <b>{{ $product->category }}</b></p>
                        <p>Description: <b>{{ $product->description }}</b></p>
                        <p>Stock: <b>{{ $product->stock }}</b></p>
                    </div>
                @endisset

                @empty($product)
                    <h1>Error, el producto no existe</h1>
                @endempty

                <div>
                    <x-jet-button><a href="/products">Volver</a></x-jet-button>
                </div>
            </div>
        </div>
    </div> --}}


</x-app-user-layout>
