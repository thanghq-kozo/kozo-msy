<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Order.
 *
 * @package namespace App\Entities;
 */
class Order extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_order',
        'line_item_id',
        'product_id',
        'variant_id',
        'email',
        'contact_email',
        'order_status_url',
        'referring_site',
        'customer_id',
        'quantity',
        'count',
        'status',
        'fulfillments_update_at'
    ];
}
