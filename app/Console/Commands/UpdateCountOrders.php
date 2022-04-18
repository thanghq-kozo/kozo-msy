<?php

namespace App\Console\Commands;

use App\Http\Controllers\OrderController;
use Illuminate\Console\Command;

class UpdateCountOrders extends Command
{
    protected $orderController;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateCountOrders:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(OrderController $orderController)
    {
        $this->orderController = $orderController;
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->orderController->updateCount();
    }
}
