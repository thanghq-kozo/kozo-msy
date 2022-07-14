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
            $table->bigInteger('id_order');
            $table->string('order_name');
            $table->text('order_token');
            $table->bigInteger('line_item_id');
            $table->bigInteger('product_id');
            $table->bigInteger('variant_id');
            $table->date('delivery_date')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_email')->nullable();
            $table->text('order_status_url')->nullable();
            $table->text('referring_site')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('status')->nullable();
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
