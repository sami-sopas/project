<x-admin-layout>

    {{-- Usando este componente de livewire modificaremos el status de las ordenes--}}
    @livewire('status-order' ,['order' => $order])


</x-admin-layout>