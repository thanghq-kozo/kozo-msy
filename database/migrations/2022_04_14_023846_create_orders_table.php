<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOrdersTable.
 */
class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->Increments('id');
            $table->bigInteger('id_order')->unique();
            $table->string('email')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('order_status_url')->nullable();
            $table->text('referring_site')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->string('status')->nullable();
            $table->integer('count')->default(0);
            $table->timestamp('fulfillments_update_at')->nullable();
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
        Schema::drop('orders');
    }
}
