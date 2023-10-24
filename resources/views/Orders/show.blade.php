<x-app-layout>
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Numero de orden -->
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6 flex items-center justify-between">
            <p class="text-gray-700">
                <span class="font-semibold">Número de Orden: </span> {{ $order->id }}
            </p>
            
            {{--Mostrar orden solo en orden sin pagar--}}
            @if ($order->status == 1)
            <a href="{{ route('orders.payment', $order) }}" class="focus:outline-none text-white bg-red-700 hover:bg-red-500 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-90">
                Ir a pagar
            </a>
            @endif
        </div>
        

        <!-- Stauts de la orden -->
        <div class="bg-white rounded-lg shadow-lg px-12 py-8 mb-6 flex items-center">

            <div class="relative mb-2">{{-- Se imprime un color diferente dependiendo del status de la orden--}}
                {{-- Azul, cuando la orden fue recibida y no esta cancelada --}}
                <div class="{{ ($order->status >= 2 && ($order->status != 5)) ? 'bg-blue-500' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>

                <div class="absolute -left-1.5 mt-2 font-semibold">
                    <p>Recibido</p>
                </div>
            </div>

            {{-- Cuando fue enviado --}}
            <div class="{{ ($order->status >= 3 && ($order->status != 5)) ? 'bg-blue-500' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

            <div class="relative mb-2">
                <div class="{{ ($order->status >= 3 && ($order->status != 5)) ? 'bg-blue-500' : 'bg-gray-400' }} rounded-full h-12 w-12 bg-blue-500 flex items-center justify-center">
                    <i class="fas fa-truck text-white"></i>
                </div>

                <div class="absolute -left-0.5 mt-2 font-semibold">
                    <p>Enviado</p>
                </div>
            </div>

            {{-- Cuando fue entregado --}}
            <div class="{{ ($order->status >= 4 && ($order->status != 5)) ? 'bg-blue-500' : 'bg-gray-400' }} h-1 flex-1 mx-2"></div>

            <div class="relative mb-2">
                <div class="{{ ($order->status >= 4 && ($order->status != 5)) ? 'bg-blue-500' : 'bg-gray-400' }} rounded-full h-12 w-12 flex items-center justify-center">
                    <i class="fas fa-check text-white"></i>
                </div>

                <div class="absolute -right-4 mt-2 font-semibold">
                    <p>Entregado</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-6 text-gray-700">
                <div>
                    <p class="text-lg font-semibold">Envío</p>

                    @if ($order->shipping_type == 1)
                        {{-- Recoger en tienda --}}
                        <p>Los productos deben ser recogidos en tienda</p>
                        <p>C. Othón Blanco, Guadalajara, Jal., Mexico</p>
                    @else
                        {{-- Mandar a domicilio --}}
                        <p>Los productos serán enviados a {{ $order->address }} </p>
                        <p>{{ $order->country->name }} - {{ $order->state->name }}</p>
                    @endif
                </div>

                <div>
                    <p class="text-lg font-semibold">Datos de contacto</p>
                    <p>Recibe: {{ $order->contact }}</p>
                    <p>Telefono: {{ $order->phone }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg p-6 text-gray-700 mb-6">
            <p class="text-xl font-semibold mb-6">Resumen</p>

            <div class="overflow-x-auto">
                <table class="min-w-full border rounded-xl">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2">Informacion</th>
                            <th class="px-4 py-2">Precio</th>
                            <th class="px-4 py-2">Cantidad</th>
                            <th class="px-4 py-2">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($items as $item)
                            <tr>
                                <td class="px-4 py-2">
                                    <div class="flex items-center">
                                        <img class="h-15 w-20 object-cover mr-4" src="{{ $item->options->image }}"
                                            alt="">
                                        <article>
                                            <h1 class="font-semibold text-gray-800">
                                                {{ $item->name }}
                                            </h1>
                                            <div class="text-xs text-gray-600">
                                                @isset($item->options->color)
                                                    Color: {{ $item->options->color->name }}
                                                @endisset

                                                @isset($item->options->size)
                                                    - {{ $item->options->size }}
                                                @endisset
                                            </div>
                                        </article>
                                    </div>
                                </td>

                                <td class="px-4 py-2 text-center">
                                    ${{ $item->price }}
                                </td>

                                <td class="px-4 py-2 text-center">
                                    {{ $item->qty }}
                                </td>

                                <td class="px-4 py-2 text-center">
                                    ${{ $item->price * $item->qty }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>