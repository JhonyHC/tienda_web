<x-app-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

        <!-- component -->
<div class="bg-white p-8 rounded-md w-full">
	<div class=" flex items-center justify-between pb-6">
		<div>
			<h2 class="text-gray-600 font-semibold">Tus ordenes</h2>
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
					<button id="btnVaciar" class="bg-red-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">Sepa xd</button>
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
									Fecha creacion
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Tipo de Pedido
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Direccion de entrega
								</th>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Estado
								</th>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Fecha estimada
								</th>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Total
								</th>
								<th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Detalles
                                </th>
							</tr>
						</thead>
						<tbody id="tableContent">
                            @if(count($orders) > 0)
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap" id="">{{$order->created_at}}</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap" id="">
                                                {{$order->type}}
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap" id="">
                                                @if($order->type == "tienda")
                                                    Recoger en tienda
                                                @else
                                                {{$order->shipping_address}}
                                                @endif
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap" id="">
                                                @switch($order->status)
                                                @case(0)
                                                        Creado
                                                        @break
                                                    @case(1)
                                                    Confirmado
                                                        @break
                                                    @case(2)
                                                        @if($order->type == "tienda")
                                                            Listo para recoger
                                                        @else
                                                        Enviando
                                                        @endif
                                                        @break
                                                    @case(3)
                                                        @if($order->type == "tienda")
                                                        Recibido
                                                        @else
                                                        Recibido
                                                        @endif
                                                        @break
                                                    @case(4)
                                                        Pedido cancelado por el usuario
                                                        @break
                                                    @case(5)
                                                        Pedido cancelado por el administrador
                                                        @break
                                                        @endswitch
                                                    </p>
                                                </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap" id="">
                                                @if($order->date == NULL)
                                                    Por confirmar
                                                @else
                                                    {{$order->date}}
                                                @endif
                                            </p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap" id="">
                                                    ${{$order->total}}
                                            </p>
                                        </td>
                                        <td orderid="{{$order->id}}" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <x-jet-button class="btn productos">Productos</x-jet-button>

                                            @if($order->status < 2)
                                                <x-jet-button class="btn cancelar">Cancelar</x-jet-button>
                                            @endif
                                            @if($order->status == 4 || $order->status == 5)
                                                <x-jet-button class="btn archivar">Archivar</x-jet-button>
                                            @endif
                                        </td>
                                    </tr>

                                    
                                @endforeach

                            @else
                                <p>No tienes ordenes</p>
                            @endif
							
						</tbody>
					</table>
                                    @foreach ($orders as $order)  
                                    <div class="fixed z-10 inset-0 invisible overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" id="modal{{$order->id}}">
                                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>
                                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                                <div class="contenedor bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                                    <table class="min-w-full leading-normal">
                                                        <thead>
                                                            <tr>
                                                                <th
                                                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                    Nombre
                                                                </th>
                                                                <th
                                                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                    Cantidad
                                                                </th>
                                                                <th
                                                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                    Precio
                                                                </th>
                                                                {{-- <th
                                                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                    Cantidad
                                                                </th>
                                                                <th
                                                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                Total
                                                                </th>
                                                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                                    
                                                                </th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tableContent">
                                                            @foreach($order->products as $product)
                                                            <tr>
                                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                                    <p class="text-gray-900 whitespace-no-wrap">{{$product->name}}</p>
                                                                </td>
                                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                                    <p class="text-gray-900 whitespace-no-wrap">{{$product->pivot->quantity}}</p>
                                                                </td>
                                                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                                    <p class="text-gray-900 whitespace-no-wrap">${{$product->price}}</p>
                                                                </td>
                                                            </tr>
                                                            @if($loop->last)
                                                                <tr>
                                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                                        <p class="text-gray-900 whitespace-no-wrap"></p>
                                                                    </td>
                                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                                        <p class="text-gray-900 whitespace-no-wrap">Total:</p>
                                                                    </td>
                                                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                                        <p class="text-gray-900 whitespace-no-wrap">${{$order->total}}</p>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                            
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
                                                            
                                                    </table>    
                                                </div>
                                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                    <button orderid={{$order->id}} type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm btn closeModal">
                                                        Volver
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
				</div>
			</div>
		</div>

		{{-- --}}
</x-app-layout>