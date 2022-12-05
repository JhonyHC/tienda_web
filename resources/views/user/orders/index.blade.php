<x-app-user-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders') }}
        </h2>
    </x-slot>

        <!-- component -->
<div class="bg-white p-8 rounded-md w-full">
		
<div id="accordion-collapse" data-accordion="collapse">
    <h2 id="accordion-collapse-heading-1">
      <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
        <span>Tus ordenes</span>
        <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </h2>
    <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
      <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
        {{-- <p class="mb-2 text-gray-500 dark:text-gray-400">Las ordenes eliminadas se borraran permanentemente en un mes.</p> --}}
        <div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    @if(count($orders) > 0)
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
								<th
                                class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Opciones
                                </th>
							</tr>
						</thead>
						<tbody id="tableContent">
                            {{-- @if(count($orders) > 0) --}}
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
                                                @if($order->type == "Tienda")
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
                                                        @if($order->type == "Tienda")
                                                            Listo para recoger
                                                        @else
                                                            Enviando
                                                        @endif
                                                        @break
                                                    @case(3)
                                                        @if($order->type == "Tienda")
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
                                        </td>
                                        <td orderid="{{$order->id}}" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            @if($order->status < 2)
                                                <x-jet-button class="btn cancelar">
                                                    <form action="orders/{{ $order->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" value="Cancelar Orden">
                                                    </form>
                                                </x-jet-button>
                                            @endif
                                            @if($order->status == 3)
                                            <x-jet-button class="btn archivar mt-2">
                                                <form method="POST" action="archivar/orders/{{ $order->id }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="submit" value="Archivar Orden">
                                                </form>
                                            </x-jet-button>
                                            @endif
                                        </td>
                                    </tr>

                                    
                                @endforeach

                                </tbody>
                            </table>
                            @else
                                <p class="mb-2 text-gray-500 dark:text-gray-400">Sin Ordenes</p>
                            @endif
							
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
		</div>
    </div>



    <h2 id="accordion-collapse-heading-2">
      <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-collapse-body-2" aria-expanded="true" aria-controls="accordion-collapse-body-2">
        <span>Ordenes canceladas</span>
        <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </h2>
    <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
      <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
        <p class="mb-2 text-gray-500 dark:text-gray-400">Las ordenes canceladas se borraran permanentemente en un mes.</p>
        <div>
            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    @if(count($deletedOrders) > 0)
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
									Total
								</th>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Detalles
                                </th>
								<th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Opciones
                                </th>
							</tr>
						</thead>
						<tbody id="tableContent">
                            
                                @foreach ($deletedOrders as $order)
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
                                                @if($order->type == "Tienda")
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
                                                        @if($order->type == "Tienda")
                                                            Listo para recoger
                                                        @else
                                                            Enviando
                                                        @endif
                                                        @break
                                                    @case(3)
                                                        @if($order->type == "Tienda")
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
                                                    ${{$order->total}}
                                            </p>
                                        </td>
                                        <td orderid="{{$order->id}}" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <x-jet-button class="btn productos">Productos</x-jet-button>
                                        </td>
                                        <td orderid="{{$order->id}}" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <x-jet-button class="btn cancelar mt-2">
                                                <form method="POST" action="recuperar/orders/{{ $order->id }}" method="post">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="submit" value="Recuperar Orden">
                                                </form>
                                            </x-jet-button>
                                            <x-jet-button class="btn cancelar mt-2">
                                                <form action="eliminar/orders/{{ $order->id }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Eliminar">
                                                </form>
                                            </x-jet-button>
                                        </td>
                                    </tr>

                                    
                                @endforeach

                            </tbody>
                        </table>
            @else
                <p class="mb-2 text-gray-500 dark:text-gray-400"> No tienes ordenes eliminadas</p>
            @endif
							

                                    @foreach ($deletedOrders as $order)  
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



      </div>
    </div>
    <h2 id="accordion-collapse-heading-3">
        <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-collapse-body-3" aria-expanded="false" aria-controls="accordion-collapse-body-3">
          <span>Ordenes archivadas</span>
          <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
      </h2>
      <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
        <div class="p-5 font-light border border-t-0 border-gray-200 dark:border-gray-700">
            <p class="mb-2 text-gray-500 dark:text-gray-400">Aqui puedes archivar tus ordenes recibidas y canceladas.</p>
            <div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        @if(count($archivedOrders) > 0)
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
                                        Total
                                    </th>
                                    <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Detalles
                                    </th>
                                    <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Opciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody >
                                
                                    @foreach ($archivedOrders as $order)
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
                                                    @if($order->type == "Tienda")
                                                        Recoger en tienda
                                                    @else
                                                    {{$order->shipping_address}}
                                                    @endif
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap" id="">
                                                    Archivado
                                                </p>
                                            </td>
                                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <p class="text-gray-900 whitespace-no-wrap" id="">
                                                        ${{$order->total}}
                                                </p>
                                            </td>
                                            <td orderid="{{$order->id}}" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <x-jet-button class="btn productos">Productos</x-jet-button>
                                            </td>
                                            <td orderid="{{$order->id}}" class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                                <x-jet-button class="btn cancelar mt-2">
                                                    <form action="eliminar/orders/{{ $order->id }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" value="Eliminar permanentemente">
                                                    </form>
                                                </x-jet-button>
                                            </td>
                                        </tr>
    
                                        
                                    @endforeach
    
                                </tbody>
                            </table>
                @else
                    <p class="mb-2 text-gray-500 dark:text-gray-400"> No tienes ordenes eliminadas</p>
                @endif
                                
    
                                        @foreach ($archivedOrders as $order)  
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
        </div>
      </div>
    {{-- <h2 id="accordion-collapse-heading-2">
      <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-collapse-body-2" aria-expanded="false" aria-controls="accordion-collapse-body-2">
        <span>Is there a Figma file available?</span>
        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </h2>
    <div id="accordion-collapse-body-2" class="hidden" aria-labelledby="accordion-collapse-heading-2">
      <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700">
        <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is first conceptualized and designed using the Figma software so everything you see in the library has a design equivalent in our Figma file.</p>
        <p class="text-gray-500 dark:text-gray-400">Check out the <a href="https://flowbite.com/figma/" class="text-blue-600 dark:text-blue-500 hover:underline">Figma design system</a> based on the utility classes from Tailwind CSS and components from Flowbite.</p>
      </div>
    </div>
    <h2 id="accordion-collapse-heading-3">
      <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-collapse-body-3" aria-expanded="false" aria-controls="accordion-collapse-body-3">
        <span>What are the differences between Flowbite and Tailwind UI?</span>
        <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
      </button>
    </h2>
    <div id="accordion-collapse-body-3" class="hidden" aria-labelledby="accordion-collapse-heading-3">
      <div class="p-5 font-light border border-t-0 border-gray-200 dark:border-gray-700">
        <p class="mb-2 text-gray-500 dark:text-gray-400">The main difference is that the core components from Flowbite are open source under the MIT license, whereas Tailwind UI is a paid product. Another difference is that Flowbite relies on smaller and standalone components, whereas Tailwind UI offers sections of pages.</p>
        <p class="mb-2 text-gray-500 dark:text-gray-400">However, we actually recommend using both Flowbite, Flowbite Pro, and even Tailwind UI as there is no technical reason stopping you from using the best of two worlds.</p>
        <p class="mb-2 text-gray-500 dark:text-gray-400">Learn more about these technologies:</p>
        <ul class="pl-5 text-gray-500 list-disc dark:text-gray-400">
          <li><a href="https://flowbite.com/pro/" class="text-blue-600 dark:text-blue-500 hover:underline">Flowbite Pro</a></li>
          <li><a href="https://tailwindui.com/" rel="nofollow" class="text-blue-600 dark:text-blue-500 hover:underline">Tailwind UI</a></li>
        </ul>
      </div>
    </div> --}}
  </div>
  </div>
  

		{{-- --}}
</x-app-user-layout>