<?php

namespace App\Console\Commands;

use App\Services\ThermalPrinterService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ProcessPrint extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-print';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://cms.thedowntownrestaurant.com/api/print-orders');

        if ($response->successful()) {
            $orders = $response->json();
            $printerService = new ThermalPrinterService('192.168.1.100', 9100);
            foreach ($orders as $order) {
                $printerService->printReceipt($order);
            }
        }
    }
}
