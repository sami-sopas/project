<!-- Componente anonimo, no tendra logica y solo sirve para reuitlizarlo -->
<!-- Solo recibira el tamaño que tendra el icono de este componente -->
@props(['size' => 35, 'color' => 'gray']) <!-- Aqui es donde recibe la variable, si no recibe nada
                                            el valor por defecto sera 35 -->

@php
    switch($color) {
        case 'gray':
            $col = '#000000';
        break;

        case 'white':
            $col = '#ffffff';
        break;

        default:
            $col = '#000000';
        break;
    }
@endphp

<svg xmlns="http://www.w3.org/2000/svg"
     x="0px" 
     y="0px" 
     width="{{$size}}"
     height="{{$size}}" 
     viewBox="0,0,256,256">
    <g fill-opacity="0.52157" 
    fill="{{$col}}" 
    fill-rule="nonzero" 
    stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M21,3c-9.37891,0 -17,7.62109 -17,17c0,9.37891 7.62109,17 17,17c3.71094,0 7.14063,-1.19531 9.9375,-3.21875l13.15625,13.125l2.8125,-2.8125l-13,-13.03125c2.55469,-2.97656 4.09375,-6.83984 4.09375,-11.0625c0,-9.37891 -7.62109,-17 -17,-17zM21,5c8.29688,0 15,6.70313 15,15c0,8.29688 -6.70312,15 -15,15c-8.29687,0 -15,-6.70312 -15,-15c0,-8.29687 6.70313,-15 15,-15z"></path></g></g>
</svg>