<x-app-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editing Order') }}
        </h2>
    </x-slot>
    @php
        $cero = 0;   
        $uno = 1;   
        $dos = 2;   
        $tres = 3;   
        $tienda = 'Tienda';   
        $envio = 'Envio';   
    @endphp
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                
                <form method="POST" action="/admin/orders/{{ $order->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="mb-6">
                        <label for="type" class="block mb-2 text-sm font-medium text-black-700">Tipo envio</label>
                        <select id="type" name="type" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                        @if(empty($order))
                            <option value="tienda" @selected(old('type') == 'tienda')>Toys</option>
                            <option value="envio" @selected(old('type') == 'envio')>Material</option>
                        @else
                            <option value="tienda" @selected($order->type == $tienda)>Tienda</option>
                            <option value="envio" @selected($order->type == $envio)>Envio</option>
                        @endif
                        </select>
                        @error('type')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                        @enderror
                    </div>

                <div class="mb-6">
                    <label for="shipping_address" class="block mb-2 text-sm font-medium text-black-700">Dirección de Envio</label>
                    <input type="text" name="shipping_address" id="shipping_address" value="{{old('shipping_address') ?? $order->shipping_address}}" maxlength="255" placeholder="Shipping Address" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" >

                    @error('shipping_address')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                </div>
                
                <div class="mb-6">
                    <label for="status" class="block mb-2 text-sm font-medium text-black-700">Estado del pedido</label>
                    <select id="status" name="status" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" required>
                    @if(empty($order))
                    <option value="0" @selected(old('status') == '0')>Creado</option>
                        <option value="1" @selected(old('status') == '1')>Confirmado y preparando</option>
                        <option value="2" @selected(old('status') == '2')>
                            @if(old('status') == "Tienda")
                            Listo para recoger
                            @else
                                Enviando
                                @endif
                        </option>
                        <option value="3" @selected(old('status') == '3')>Recibido</option>
                        @else
                        <option value="0" @selected($order->status == $cero)>Creado</option>
                        <option value="1" @selected($order->status == $uno)>Confirmado y preparando</option>
                        <option value="2" @selected($order->status == $dos)>
                            @if($order->type == "Tienda")
                            Listo para recoger
                            @else
                            Enviando
                            @endif
                        </option>
                        <option value="3" @selected($order->status == $tres)>Recibido</option>
                        @endif
                    </select>
                    @error('status')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{$message}}!</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="date" class="block mb-2 text-sm font-medium text-black-700">Fecha estimada:</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                          <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input value="{{$order->date}}" datepicker datepicker-format="yyyy/mm/dd" type="text" name="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Selecciona la fecha">
                      </div>
                    {{-- <input type="text" name="shipping_address" id="shipping_address" value="{{old('shipping_address') ?? $order->shipping_address}}" maxlength="255" placeholder="Shipping Address" required class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" > --}}

                    @error('date')
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