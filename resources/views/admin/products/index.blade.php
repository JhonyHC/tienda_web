<x-app-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>


    
        <!-- component -->
<div class="bg-white p-8 rounded-md w-full">
	<div class=" flex items-center justify-between pb-6">
		<div>
			<h2 class="text-gray-600 font-semibold">Todos los Productos</h2>
			{{-- <span class="text-xs">All products item</span> --}}
		</div>
		<div class="flex items-center justify-between">
			{{-- <div class="flex bg-gray-50 items-center p-2 rounded-md">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
					fill="currentColor">
					<path fill-rule="evenodd"
						d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
						clip-rule="evenodd" />
				</svg>
				<input class="bg-gray-50 outline-none ml-1 block " type="text" name="" id="" placeholder="search...">
          </div> --}}
				<div class="lg:ml-40 ml-10 space-x-8">
					{{-- <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">New Report</button> --}}
					<button id="btnAgregar" class="bg-red-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Agregar Producto</button>
				</div>
		</div>
		</div>
		<div>
			<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
				<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
					<table class="min-w-full leading-normal">
						<thead>
							<tr>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Name
								</th>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Price
								</th>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Category
								</th>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Description
								</th>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Stock
								</th>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Edit
								</th>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Delete
								</th>
							</tr>
						</thead>
						<tbody id="tableContent">
                            @if(count($products) > 0)
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex items-center space-x-3">
                                            <div class="inline-flex w-10 h-10"> <img class='w-10 h-10 object-cover rounded-full' alt='User avatar' src='https://i.imgur.com/siKnZP2.jpg' /> </div>
                                            <p class="text-gray-900 whitespace-no-wrap"><a href="products/{{$product->id}}">{{ $product->name}}</a></p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap" id="">
                                                {{$product->price}}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap" id="">
                                                {{$product->category}}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap" id="">
                                                {{$product->description}}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap" id="">
                                                {{$product->stock}}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <x-jet-button class="btn productos"><a href="products/{{ $product->id }}/edit">Update</a></x-jet-button>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <x-jet-button class="btn productos">
                                                <form action="products/{{ $product->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="text-sm" type="submit" value="Delete">
                                                </form>
                                            </x-jet-button>
                                        </td>
                                        
                                    </tr>

                                    
                                @endforeach

                            @else
                                <p>No hay productos</p>
                            @endif
							
						</tbody>
					</table>
				</div>
			</div>
		</div>

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
            </div>
        </div>
    </div> --}}
</x-app-admin-layout>

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