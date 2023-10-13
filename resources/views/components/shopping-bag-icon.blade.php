@props(['size' => 35, 'color' => 'gray'])

@php
    switch ($color) {
        case 'gray':
            $color = '#6b6b6b';
            break;
        
        case 'white':   
            $color = '#ffffff';
            break;

        case 'black':   
            $color = '	#000000';
            break;
        
        default:
            $color = '#6b6b6b';
            break;
    }
@endphp

<svg 
    fill="{{$color}}" 
    height="{{$size}}" 
    width="{{$size}}" 
    version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-43.48 -43.48 570.06 570.06" xml:space="preserve" transform="rotate(0)" stroke="#6b6b6b" stroke-width="7.2465">

    <g id="SVGRepo_bgCarrier" stroke-width="0"/>
    
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="44.44520000000001"/>
    
    <g id="SVGRepo_iconCarrier"> <g> <path d="M434.55,418.7l-27.8-313.3c-0.5-6.2-5.7-10.9-12-10.9h-58.6c-0.1-52.1-42.5-94.5-94.6-94.5s-94.5,42.4-94.6,94.5h-58.6 c-6.2,0-11.4,4.7-12,10.9l-27.8,313.3c0,0.4,0,0.7,0,1.1c0,34.9,32.1,63.3,71.5,63.3h243c39.4,0,71.5-28.4,71.5-63.3 C434.55,419.4,434.55,419.1,434.55,418.7z M241.55,24c38.9,0,70.5,31.6,70.6,70.5h-141.2C171.05,55.6,202.65,24,241.55,24z M363.05,459h-243c-26,0-47.2-17.3-47.5-38.8l26.8-301.7h47.6v42.1c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h141.2v42.1 c0,6.6,5.4,12,12,12s12-5.4,12-12v-42.1h47.6l26.8,301.8C410.25,441.7,389.05,459,363.05,459z"/> </g> </g>
</svg>