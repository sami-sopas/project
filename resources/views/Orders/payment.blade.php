<x-app-layout>
    <div class="container py-8 ">
        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mb-6">
            <p class="text-gray-700">
                <span class="font-semibold">Número de Orden: </span> {{$order->id}}
            </p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
            <div class="grid grid-cols-2 gap-6 text-gray-700">
                <div>
                    <p class="text-lg font-semibold">Envío</p>

                    @if ($order->shipping_type == 1) {{-- Recoger en tienda --}}
                        <p>Los productos deben ser recogidos en tienda</p>
                        <p>C. Othón Blanco, Guadalajara, Jal., Mexico</p>
                    @else {{-- Mandar a domicilio --}}
                        <p>Los productos serán enviados a {{ $order->address }} </p>
                        <p>{{$order->country->name}} - {{$order->state->name}}</p>
                    @endif
                </div>

                <div>
                    <p class="text-lg font-semibold">Datos de contacto</p>
                    <p>Recibe: {{$order->contact}}</p>
                    <p>Telefono: {{$order->phone}}</p>
                </div>
            </div>
        </div>

        <div class="bg-white shadow-lg p-6 text-gray-700 mb-6">
            <p class="text-xl font-semibold mb-6">Resumen</p>
        
            <div class="overflow-x-auto">
                <table class="min-w-full border rounded-xl">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2"></th>
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
                                        <img
                                            class="h-15 w-20 object-cover mr-4"
                                            src="{{ $item->options->image }}"
                                            alt="">
                                        <article>
                                            <h1 class="font-semibold text-gray-800">
                                                {{ $item->name }}
                                            </h1>
                                            <div class="text-xs text-gray-600">
                                                @isset ($item->options->color)
                                                    Color: {{ $item->options->color }}
                                                @endisset
        
                                                @isset ($item->options->size)
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

        <div class="bg-white rounded-lg shadow-lg p-6 flex justify-between items-center">
            <div>
                img aqui
            </div>
            <div class="text-gray-700">
                <p class="text-sm font-semibold mb-2">
                    Envio: {{$order->shipping_cost}} $
                </p>
                <p class="text-sm font-semibold mb-2">
                    Subtotal: {{$order->total - $order->shipping_cost}} $
                </p>
                <p class="text-lg font-semibold">
                    Total: {{$order->total}} $
                </p>
            </div>
        </div>
        
    </div>
</x-app-layout>