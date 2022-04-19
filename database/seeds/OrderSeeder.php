<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            ['id_order' => 4331974820037, 'line_item_id' => 11030456533189, 'product_id' => 7120074014917, 'variant_id' => 41244326133957, 'email' => 'zzmrandyzz@outlook.com', 'contact_email' => 'zzmrandyzz@outlook.com', 'order_status_url' => 'https://kozocom.myshopify.com/61150822597/orders/d82c1b6e933237c110771745fb39aed4/authenticate?key=2abedc2dc2397923e03fb6a5704f6c15', 'referring_site' => '', 'customer_id' => 5903195013317, 'status' => 'success', 'quantity' => 1, 'fulfillments_update_at' => '2022-04-18 18:14:46','created_at' => date("Y-m-d H:i:s")],
            ['id_order' => 4331974820037, 'line_item_id' => 11030456565957, 'product_id' => 7120074047685, 'variant_id' => 41244326363333, 'email' => 'nguyenphuongvi1991@gmail.com', 'contact_email' => 'nguyenphuongvi1991@gmail.com', 'order_status_url' => 'https://kozocom.myshopify.com/61150822597/orders/d82c1b6e933237c110771745fb39aed4/authenticate?key=2abedc2dc2397923e03fb6a5704f6c15', 'referring_site' => '', 'customer_id' => 5903195013317, 'status' => 'success', 'quantity' => 1, 'fulfillments_update_at' => '2022-04-19 03:23:25','created_at' => date("Y-m-d H:i:s")],
            ['id_order' => 4331974820037, 'line_item_id' => 11030456598725, 'product_id' => 7120074145989, 'variant_id' => 41244327051461, 'email' => 'vi91.nguyen@gmail.com', 'contact_email' => 'vi91.nguyen@gmail.com', 'order_status_url' => 'https://kozocom.myshopify.com/61150822597/orders/d82c1b6e933237c110771745fb39aed4/authenticate?key=2abedc2dc2397923e03fb6a5704f6c15', 'referring_site' => '', 'customer_id' => 5903195013317, 'status' => 'success', 'quantity' => 2, 'fulfillments_update_at' => '2022-04-21 03:23:25','created_at' => date("Y-m-d H:i:s")],
            ['id_order' => 4322793488581, 'line_item_id' => 11009955168453, 'product_id' => 7120074080453, 'variant_id' => 41244326592709, 'email' => 'nguyenphuongvi1991@gmail.com', 'contact_email' => 'nguyenphuongvi1991@gmail.com', 'order_status_url' => 'https://kozocom.myshopify.com/61150822597/orders/3222cec42c011f9d43340f809ea81145/authenticate?key=147f451227391a0e74b104952db43d81', 'referring_site' => '', 'customer_id' => 5903195013317, 'status' => 'success', 'quantity' => 1, 'fulfillments_update_at' => '2022-04-29 03:23:25','created_at' => date("Y-m-d H:i:s")],
            ['id_order' => 4323289956549, 'line_item_id' => 11010999713989, 'product_id' => 7120074113221, 'variant_id' => 41244326822085, 'email' => 'zzmrandyzz@gmail.com', 'contact_email' => 'zzmrandyzz@gmail.com', 'order_status_url' => 'https://kozocom.myshopify.com/61150822597/orders/772dc1fada6375a3144fb02e0cf604ac/authenticate?key=3807ac22be8d1cd6514fec14fa7f5127', 'referring_site' => 'https://kozocom.myshopify.com/products/classic-leather-jacket', 'customer_id' => 5903195013317, 'status' => 'success', 'quantity' => 1, 'fulfillments_update_at' => '2022-05-01 03:23:25','created_at' => date("Y-m-d H:i:s")],
            ['id_order' => 4330960421061, 'line_item_id' => 11028049592517, 'product_id' => 7120074080453, 'variant_id' => 41244326592709, 'email' => 'zzmrandyzz@yahoo.com', 'contact_email' => 'zzmrandyzz@yahoo.com', 'order_status_url' => 'https://kozocom.myshopify.com/61150822597/orders/c8c962e9d0a1c44e818bac126e0a07e9/authenticate?key=240d70dbb8cdb21b4ffba44a26ea0271', 'referring_site' => '', 'customer_id' => 5903195013317, 'status' => 'success', 'quantity' => 1, 'fulfillments_update_at' => '2022-05-03 03:23:25','created_at' => date("Y-m-d H:i:s")],
        ]);
    }
}
