<x-app-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing Product: ' . $product->name) }}
        </h2>
    </x-slot>
    @php
        $toys = 'toys';   
        $material = 'material';   
        $clothes = 'clothes';   
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                
                <form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-black-700">Name</label>
                    <input type="text" name="name" id="name" value="{{old('name') ?? $product->name}}" maxlength="50" placeholder="Product Name" required class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" >

                    @error('name')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                  </div>

                  <div class="mb-6">
                    <label for="price" class="block mb-2 text-sm font-medium text-black-700">Price</label>
                    <input type="number" step="0.01" name="price" id="price" value="{{old('price') ?? $product->price}}" min="1" max="9999" placeholder="Product Price" required class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">

                    @error('price')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                  </div>
                  
                  <div class="mb-6">
                    <label for="category" class="block mb-2 text-sm font-medium text-black-700">Category</label>
                    <select id="category" name="category" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                    <option value="" @selected($product->category == '')>Option</option>
                    <option value="toys" @selected($product->category == $toys)>Toys</option>
                    <option value="material" @selected($product->category == $material)>Material</option>
                    <option value="clothes" @selected($product->category == $clothes)>Clothes</option>
                    </select>
                    @error('category')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                  </div>
                  <div class="mb-6">
                    <label for="description" class="block mb-2 text-sm font-medium text-black-700">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" placeholder="Product Description...">{{old('description') ?? $product->description}}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                </div>
                <div class="mb-6">
                  <label for="stock" class="block mb-2 text-sm font-medium text-black-700">Stock</label>
                  <input type="number" type="number" name="stock" id="stock" value="{{old('stock') ?? $product->stock}}" placeholder="Product Stock" min="0" max="999" required class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">

                  @error('stock')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                </div>
                <div class="mb-6">
                  
                <label class="block mb-2 text-sm font-medium text-black-700" for="image">Foto producto</label>
                <input class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" id="image" type="file" name="image">
                <div class="mt-1 text-sm text-gray-700 ">Trata que la imagen tenga relación 1:1</div>
                    <img class="w-60 mr-6 mb-6" src="{{$product->image ? asset('storage/'. $product->image) : asset('storage/images/no-image.jpg')}}" alt="image">

                  @error('image')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                </div>
            

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Actualizar</button>
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
    @php
     $toys = 'toys';   
     $material = 'material';   
     $clothes = 'clothes';   
    @endphp
<div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h1>Edit Product</h1>
                        <p>Fill the fields.</p>
                        <form method="POST" action="/products/{{ $product->id }}" class="requires-validation" novalidate>
                            @csrf
                            @method('PATCH')
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="name" id="name" value="{{old('name') ?? $product->name}}" placeholder="Product Name" required>
                                <!-- <div class="valid-feedback">Username field is valid!</div>
                                <div class="invalid-feedback">Username field cannot be blank!</div> -->
                                @error('name')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" type="number" name="price" id="price" value="{{old('price') ?? $product->price}}" placeholder="Product Price" required>
                                <!-- <div class="valid-feedback">Username field is valid!</div>
                                <div class="invalid-feedback">Username field cannot be blank!</div> -->
                                @error('price')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <select class="form-select mt-3" name="category" required>
                                    <option disabled value="" @selected($product->category == '')>Option</option>
                                    <option value="toys" @selected($product->category == $toys)>Toys</option>
                                    <option value="material" @selected($product->category == $material)>Material</option>
                                    <option value="clothes" @selected($product->category == $clothes)>Clothes</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                                <!-- <div class="valid-feedback">You selected a position!</div>
                                <div class="invalid-feedback">Please select a position!</div> -->
                            </div> --}}

                        {{--     <div class="col-md-12 mb-3">
                               <input class="form-control" type="text" name="description" placeholder="Description" value="{{old('description') ?? $product->description}}">
                               <!-- <div class="valid-feedback">Username field is valid!</div>
                               <div class="invalid-feedback">Username field cannot be blank!</div> -->
                               @error('description')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <input class="form-control" type="number" name="stock" id="stock" value="{{old('stock') ?? $product->stock}}" placeholder="Product Stock" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{$message}}!</div>
                                @enderror
                            </div> --}}

                           <!-- <div class="col-md-12">
                                <select class="form-select mt-3" required>
                                      <option selected disabled value="">Position</option>
                                      <option value="jweb">Junior Web Developer</option>
                                      <option value="sweb">Senior Web Developer</option>
                                      <option value="pmanager">Project Manager</option>
                               </select>
                                <div class="valid-feedback">You selected a position!</div>
                                <div class="invalid-feedback">Please select a position!</div>
                           </div> -->


                           <!-- <div class="col-md-12">
                              <input class="form-control" type="password" name="password" placeholder="Password" required>
                               <div class="valid-feedback">Password field is valid!</div>
                               <div class="invalid-feedback">Password field cannot be blank!</div>
                           </div>
 -->

                           <!-- <div class="col-md-12 mt-3">
                            <label class="mb-3 mr-1" for="gender">Gender: </label>

                            <input type="radio" class="btn-check" name="gender" id="male" autocomplete="off" required>
                            <label class="btn btn-sm btn-outline-secondary" for="male">Male</label>

                            <input type="radio" class="btn-check" name="gender" id="female" autocomplete="off" required>
                            <label class="btn btn-sm btn-outline-secondary" for="female">Female</label>

                            <input type="radio" class="btn-check" name="gender" id="secret" autocomplete="off" required>
                            <label class="btn btn-sm btn-outline-secondary" for="secret">Secret</label>
                               <div class="valid-feedback mv-up">You selected a gender!</div>
                                <div class="invalid-feedback mv-up">Please select a gender!</div>
                            </div> -->

                        <!-- <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                          <label class="form-check-label">I confirm that all data are correct</label>
                         <div class="invalid-feedback">Please confirm that the entered data are all correct!</div>
                        </div> -->
                  

                          {{--   <div class="form-button mt-3">
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