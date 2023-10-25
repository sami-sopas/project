<?php

namespace App\Console;

use App\Models\Order;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        //EN LOCAL ESTO FUNCIONA CON ESTE COMANDO php artisan schedule:work
        //EN PRODUCCION YA TENDRIAMOS QUE USAR UN CRON

        //Cada minuto se verifican las ordenes creadas hace 1 hora
        $schedule->call(function () {

            //Buscar ordenes creadas hace 1 hora
            $time = now()->subMinutes(1);

            $orders = Order::where('status', 1)->where('created_at', '<=', $time)->get();

            foreach ($orders as $order) {
                $items = json_decode($order->content);

                foreach ($items as $item) {
                    //Recuperar cantidad de items en caso de no pagar la orden
                    increase($item);
                }
            }

            //Cambiar status de la orden a cancelado
            $order->status = 5;

            $order->save();

        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
