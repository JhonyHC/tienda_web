<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($product->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @isset($product)
                    {{-- <h1>{{ $product->name }}</h1> --}}
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
    </div>


</x-app-layout>
