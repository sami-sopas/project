<x-app-layout>
<div>

  <!--
    - HEADER
    YA LO MANDAMOS A LLAMAR DESDE AL APP.BLADE
  -->


  <!--
    - MAIN
  -->

  <div>

    <!--
      - BANNER / SLIDER
       SE VOLVIO UN COMPONENTE OMG!
    -->
    <x-slider/>


    <!--
      - CATEGORY
    -->

    <div class="category">
    
      <div class="container ">


      </div>

    </div>





    <!--
      - LISTADOS DE PRODUCTOS
    -->

    <div class="product-container">

      <div class="container">

        <div class="product-box">
          <!--
            - PRODUCT GRID
          -->

          <div class="product-main">

            <!-- Seccion para mostrar los productos mas nuevo, mas vendido etc -->
            <div class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
              <div class="max-w-screen-xl mx-auto px-4 py-2.5">
                @livewire('product-list')
              </div>
            </div>

            
        </div>

      </div>

    </div>


  </div>





  <!--
    - FOOTER
    YA SE INCLUYE EN UN COMPONENTE EN EL APP.BLADE
  -->

</div>
</x-app-layout>