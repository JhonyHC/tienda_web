<x-app-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                
                <form method="POST" action="/admin/products" enctype="multipart/form-data">
                    @csrf
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-black-700">Name</label>
                    <input type="text" name="name" id="name" value="{{old('name') ?? ''}}" maxlength="50" placeholder="Product Name" required class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" >

                    @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                  </div>

                  <div class="mb-6">
                    <label for="price" class="block mb-2 text-sm font-medium text-black-700">Price</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{old('price') ?? ''}}" min="1" max="9999" placeholder="Product Price" required class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">

                    @error('price')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                  </div>
                  
                  <div class="mb-6">
                    <label for="category" class="block mb-2 text-sm font-medium text-black-700">Category</label>
                    <select id="category" name="category" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                    <option value="">Option</option>
                    <option value="toys" @selected(old('category') == 'toys')>Toys</option>
                    <option value="material" @selected(old('category') == 'material')>Material</option>
                    <option value="clothes" @selected(old('category') == 'clothes')>Clothes</option>
                    </select>
                    @error('category')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                  </div>
                  <div class="mb-6">
                    <label for="description" class="block mb-2 text-sm font-medium text-black-700">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" placeholder="Product Description..." value="{{old('description') ?? ''}}"></textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                </div>
                <div class="mb-6">
                  <label for="stock" class="block mb-2 text-sm font-medium text-black-700">Stock</label>
                  <input type="number" type="number" name="stock" id="stock" value="{{old('stock') ?? ''}}" placeholder="Product Stock" min="0" max="999" required class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">

                  @error('stock')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                </div>
                <div class="mb-6">
                  
                <label class="block mb-2 text-sm font-medium text-black-700" for="image">Foto producto</label>
                <input class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" id="image" type="file" name="image">
                <div class="mt-1 text-sm text-gray-700 ">Trata que la imagen tenga relación 1:1</div>


                  @error('image')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                </div>
            

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
            </form>
  
            </div>
        </div>
    </div>
</x-app-admin-layout>
    {{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
</head>
<body>
<div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h1>Product</h1>
                        <p>Fill the fields.</p>
                        <form method="POST" action="/products" class="requires-validation" novalidate>
                            @csrf
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="name" id="name" value="{{old('name') ?? ''}}" placeholder="Product Name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" type="number" name="price" id="price" value="{{old('price') ?? ''}}" placeholder="Product Price" required>
                                @error('price')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <select class="form-select mt-3" name="category" required>
                                      <option value="">Option</option>
                                      <option value="toys" @selected(old('category') == 'toys')>Toys</option>
                                      <option value="material" @selected(old('category') == 'material')>Material</option>
                                      <option value="clothes" @selected(old('category') == 'clothes')>Clothes</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                               <input class="form-control" type="text" name="description" placeholder="Description" value="{{old('description') ?? ''}}">
                               @error('description')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" type="number" name="stock" id="stock" value="{{old('stock') ?? ''}}" placeholder="Product Stock" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div>
                  

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </form>
                        <p><a href="/products">Volver</a></p>
                    </div>
                </div>
            </div>
        </div>
    
</body>
</html> --}}