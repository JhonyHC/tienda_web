<x-app-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

        <div tabindex="0" class="focus:outline-none">
            <!-- Remove py-8 -->
            <div class="mx-auto container py-8">
                <div class="flex flex-wrap items-center lg:justify-between justify-center">
                    @if (count($products) > 0)
                        @foreach($products as $product)
                        <!-- Card 1 -->
                        <div tabindex="0" class="focus:outline-none mx-2 w-72 xl:mb-0 mb-8">
                            <div>
                                <a href="/products/{{$product->id}}">
                                <img alt="image" src="{{$product->image ? asset('storage/'. $product->image) : asset('storage/images/no-image.jpg')}}" tabindex="0" class="focus:outline-none w-full h-44" />
                                </a>
                            </div>
                            <div class="bg-white">
                                {{-- <div class="flex items-center justify-between px-4 pt-4">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" tabindex="0" class="focus:outline-none" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M9 4h6a2 2 0 0 1 2 2v14l-5-3l-5 3v-14a2 2 0 0 1 2 -2"></path>
                                        </svg>
                                    </div>
                                    <div class="bg-yellow-200 py-1.5 px-6 rounded-full">
                                        <p tabindex="0" class="focus:outline-none text-xs text-yellow-700">Featured</p>
                                    </div>
                                </div> --}}
                                <div class="p-4">
                                    <div class="flex items-center">
                                        <h2 tabindex="0" class="focus:outline-none text-lg font-semibold"><a href="/products/{{ $product->id}}">{{ $product->name}}</a></h2>
                                        {{-- <div class="bg-yellow-200 py-1.5 px-6 rounded-full">
                                            <p tabindex="0" class="focus:outline-none text-xs text-yellow-700"> {{ $product->price }}</p>
                                        </div> --}}
                                        <p tabindex="0" class="focus:outline-none text-xs text-gray-600 pl-5"> ${{ $product->price}}</p>
                                    </div>
                                    <p tabindex="0" class="focus:outline-none text-xs text-gray-600 mt-2">{{ $product->description }}</p>
                                    <div class="flex mt-4">
                                        <div>
                                            <p tabindex="0" class="focus:outline-none text-xs text-gray-600 px-2 bg-gray-200 py-1">{{ ucfirst($product->category) }}</p>
                                        </div>
                                        <div class="pl-2">
                                            <p tabindex="0" class="focus:outline-none text-xs text-gray-600 px-2 bg-gray-200 py-1">Stock {{ $product->stock }}</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between py-4">
                                        <x-jet-button id="{{ $product->id }}" class="btnCarrito">Agregar al carrito</x-jet-button> 
                                        {{-- <h2 tabindex="0" class="focus:outline-none text-indigo-700 text-xs font-semibold">Bay Area, San Francisco</h2>
                                        <h3 tabindex="0" class="focus:outline-none text-indigo-700 text-xl font-semibold"></h3> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Card 1 Ends -->
                        @endforeach
                    @else
                    <p>No Products Registered</p>
                    @endif
                </div>
            </div>
        </div>

        
        <script>
            if (!window.ShadyDOM) window.ShadyDOM = { force: true, noPatch: true };
        </script>









</x-app-user-layout>

{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    @isset($createdProduct)
        <h2>New Product Added</h2>
        <b>{{ $createdProduct->name }}</b>
    @endisset

    <h1>Products List</h1>
    <div>
        <a href="/products/create">Create Product</a>
        <br><br><br>
    </div>

    @if (count($products) > 0)
    <table border="dashed" style="text-align: center;">
        <thead>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Description</th>
            <th>Stock</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><a href="/products/{{ $product->id}}">{{ $product->name}}</a></td>
                <td>{{ $product->price}}</td>
                <td>{{ $product->category}}</td>
                <td>{{ $product->description}}</td>
                <td>{{ $product->stock}}</td>
                <td><a href="/products/{{ $product->id }}/edit">Update</a></td>
                <td>
                    <form action="/products/{{ $product->id }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <ul>
    </ul>
    @else
        <p>No Products Registered</p>
    @endif
</body>
</html> --}}