<x-app-user-layout>
    <x-slot name="header">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <!-- component -->
<div class="bg-white p-8 rounded-md w-full">
	<div class=" flex items-center justify-between pb-6">
		<div>
			<h2 class="text-gray-600 font-semibold">Productos Agregados</h2>
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
					<button id="btnVaciar" class="bg-red-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Vaciar Carrito</button>
				</div>
		</div>
		</div>
		<div>
			<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
				<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
					<table class="min-w-full leading-normal">
						<thead>
							<tr>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Nombre
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Stock
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Precio
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Cantidad
								</th>
								<th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Total
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    
                                </th>
							</tr>
						</thead>
						<tbody id="tableContent">
							{{-- <tr>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<div class="flex items-center">
										<div class="flex-shrink-0 w-10 h-10">
											<img class="w-full h-full rounded-full"
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2.2&w=160&h=160&q=80"
                                                alt="" />
                                        </div>
											<div class="ml-3">
												<p class="text-gray-900 whitespace-no-wrap" id="productName">
													
												</p>
											</div>
										</div>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap" id="productPrice"></p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<p class="text-gray-900 whitespace-no-wrap" id="productStock">
										
									</p>
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<input type="number" name="cantidad" id="inputCantidad" class="rounded-md border border-[#e0e0e0] bg-white px-6 text-base text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									Total
								</td>
								<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
									<x-jet-button class="btnEliminar">Remover</x-jet-button>
								</td>
							</tr> --}}
							
						</tbody>
					</table>
					<div
						class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
						<span id="cartTotal" class=" text-gray-900">
                            
                        </span>
						{{-- <div class="inline-flex mt-2 xs:mt-0">
							<button
                                class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-l">
                                Prev
                            </button>
							&nbsp; &nbsp;
							<button
                                class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-r">
                                Next
                            </button>
						</div> --}}
					</div>
				</div>
			</div>
		</div>

		{{-- --}}

		<!-- component -->
<div class="leading-loose">
	<form id="formCheckout" class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" method="POST" action="/orders">
		@csrf
	  <p class="text-gray-800 font-medium">Informacion del Pedido</p>
	  {{-- <div class="">
		<label class="block text-sm text-gray-00" for="cus_name">Name</label>
		<input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="cus_name" name="cus_name" type="text" required="" placeholder="Your Name" aria-label="Name">
	  </div>
	  <div class="mt-2">
		<label class="block text-sm text-gray-600" for="cus_email">Email</label>
		<input class="w-full px-5  py-4 text-gray-700 bg-gray-200 rounded" id="cus_email" name="cus_email" type="text" required="" placeholder="Your Email" aria-label="Email">
	</div> --}}
	<div class="mt-2">
	  <label class=" block text-sm text-gray-600" for="type">Tipo de Pedido</label>
	  <select class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="type" name="type">
		<option value="tienda">Recoger en Tienda</option>
		<option value="envio">Enviar a tu dirección</option>
	  </select>
	</div>
	  <div class="mt-2">
		<label class="block text-sm text-gray-600" for="shipping_address">Direccion Completa</label>
		<input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="shipping_address" name="shipping_address" type="text" placeholder="Dirección">
	  </div>
	  {{-- <div class="mt-2">
		<label class="hidden text-sm block text-gray-600" for="cus_email">City</label>
		<input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email" name="cus_email" type="text" required="" placeholder="City" aria-label="Email">
	  </div>
	  <div class="inline-block mt-2 w-1/2 pr-1">
		<label class="hidden block text-sm text-gray-600" for="cus_email">Country</label>
		<input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email" name="cus_email" type="text" required="" placeholder="Country" aria-label="Email">
	  </div>
	  <div class="inline-block mt-2 -mx-1 pl-1 w-1/2">
		<label class="hidden block text-sm text-gray-600" for="cus_email">Zip</label>
		<input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_email"  name="cus_email" type="text" required="" placeholder="Zip" aria-label="Email">
	  </div> --}}
	  {{-- <p class="mt-4 text-gray-800 font-medium">Payment information</p>
	  <div class="">
		<label class="block text-sm text-gray-600" for="cus_name">Card</label>
		<input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" id="cus_name" name="cus_name" type="text" required="" placeholder="Card Number MM/YY CVC" aria-label="Name">
	  </div> --}}
	  <div class="mt-4">
		<button id="btnPagar" class="px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" type="submit">Hacer pedido</button>
	  </div>
	</form>
  </div>
	</div>
</x-app-user-layout>