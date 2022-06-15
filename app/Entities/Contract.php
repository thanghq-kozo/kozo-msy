<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ContractController.
 *
 * @package namespace App\Entities;
 */
class Contract extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contract_id',
        'billing_interval',
        'billing_interval_count',
        'billing_min_cycles',
        'billing_max_cycles',
        'currency_code',
        'customer_id',
        'delivery_interval',
        'delivery_interval_count',
        'delivery_price',
        'status',
        'origin_order_id',
        'product_title',
        'quantity',
        'product_id',
        'variant_id',
        'current_price'
    ];

    public function order(): HasOne
    {
        return $this->hasOne(Order::class, 'origin_order_id', 'id_order');
    }
}
