<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->Increments('id');
            $table->bigInteger('contract_id')->nullable();
            $table->string('billing_interval');
            $table->integer('billing_interval_count');
            $table->integer('billing_min_cycles')->nullable();
            $table->integer('billing_max_cycles')->nullable();
            $table->string('currency_code');
            $table->bigInteger('customer_id')->nullable();
            $table->string('delivery_interval');
            $table->integer('delivery_interval_count');
            $table->decimal('delivery_price', $precision = 18, $scale = 2)->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('origin_order_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
