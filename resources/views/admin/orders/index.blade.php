<x-admin-layout>
    <div class="container py-12">

        <!-- Cuadros de ordenes informativos -->
        <section class="grid grid-cols-4 gap-6 text-white font-semibold">
           
            <a href="{{ route('admin.orders.index') . '?status=2'}}" class="bg-gray-500 bg-opacity-80 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{ $received }}
                </p>
                <p class="uppercase text-center">Recibido</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-credit-card"></i>
                </p>
            </a>

            <a href="{{ route('admin.orders.index') . '?status=3'}}" class="bg-yellow-400 bg-opacity-80 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{ $sent }}
                </p>
                <p class="uppercase text-center">Enviado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-truck"></i>
                </p>
            </a>

            <a href="{{ route('admin.orders.index') . '?status=4'}}" class="bg-pink-500 bg-opacity-80 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{ $delivered }}
                </p>
                <p class="uppercase text-center">Entregado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-check-circle"></i>
                </p>
            </a>

            <a href="{{ route('admin.orders.index') . '?status=5'}}" class="bg-green-500 bg-opacity-80 rounded-lg px-12 pt-8 pb-4">
                <p class="text-center text-2xl">
                    {{ $canceled }}
                </p>
                <p class="uppercase text-center">Cancelado</p>
                <p class="text-center text-2xl mt-2">
                    <i class="fas fa-times-circle"></i>
                </p>
            </a>
        </section>

        {{-- Mostrar pedidos --}}
        @if ($orders->count())
        <section class="bg-white shadow-md rounded-lg px-12 py-8 mt-12 font-semibold text-gray-800">
            <h1 class="text-2xl mb-4">Pedidos recientes</h1> 
            <hr class="mb-4 border-t border-gray-300">

            <ul>
                @foreach ($orders as $order)
                    <li>
                        <a href="{{ route('admin.orders.show',$order) }}" class="flex items-center py-2 px-4 hover:bg-gray-100 rounded-lg">
                            <span class="w-12 text-center">
                                @switch($order->status)
                                    @case(1)
                                        <i class="fas fa-business-time text-red-500 opacity-50"></i>
                                        @break
                                    @case(2)
                                        <i class="fas fa-credit-card text-gray-500 opacity-50"></i>
                                        @break
                                    @case(3)
                                    <i class="fas fa-truck text-yellow-400 opacity-50"></i>
                                        @break
                                    @case(4)
                                    <i class="fas fa-check-circle text-pink-500 opacity-50"></i>
                                        @break
                                    @case(5)
                                    <i class="fas fa-times-circle text-green-500 opacity-50"></i>
                                        @break
                                 
                                    @default
                                        
                                @endswitch
                            </span>

                            <span>
                                Orden: {{$order->id}}
                                <br>
                                Fecha: {{$order->created_at->format('d/m/y')}}
                            </span>

                            <div class="ml-auto">
                                <span class="font-bold">
                                    @switch($order->status)
                                        @case(1)
                                            Pendiente
                                            @break
                                        @case(2)
                                            Recibido
                                            @break
                                        @case(3)
                                            Enviado
                                            @break
                                        @case(4)
                                            Entregado
                                            @break
                                        @case(5)
                                            Cancelado
                                            @break
                                        @default
                                            
                                    @endswitch
                                </span>

                                <br>

                                <span class="text-sm">
                                    {{$order->total}} $
                                </span>
                            </div>

                            <span>
                                <i class="fas fa-angle-right ml-6"></i>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
        @else
            <div class="bg-white shadow-md rounded-lg px-12 py-8 mt-12 font-semibold text-gray-800">
                <span class="font-bold text-lg">
                    No hay pedidos inge
                </span>
            </div>
        @endif

    </div>

</x-admin-layout>