<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); //Relacionar 1 orden con un usuario
            $table->enum('status',[ //El significado esta en Order.php
            Order::PENDING,
            Order::RECEIVED,
            Order::SENT,
            Order::DELIVERED,
            Order::CANCELED,])->default(Order::PENDING);
            $table->enum('shipping_type',[1,2]); //1: Recoger en tienda 2: Enviar a domicilio
            $table->float('shipping_cost'); //Costo de envio
            $table->float('total'); //Total de la orden
            $table->json('content'); //Contenido de la orden(productos) del usuario

            //LLaves foraneas para pais y estado
            $table->foreignId('country_id')->constrained();
            $table->foreignId('state_id')->constrained(); 
            
            $table->string('address'); //Direccion del cliente
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
