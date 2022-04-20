<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Shop.
 *
 * @package namespace App\Entities;
 */
class Shop extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'shop_url',
        'session_id',
        'domain_id',
        'access_token',
        'state',
        'isOnline',
        'onlineAccessInfo',
        'scope'
    ];
}
