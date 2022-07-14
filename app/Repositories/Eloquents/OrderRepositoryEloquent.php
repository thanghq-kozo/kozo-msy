<?php

namespace App\Repositories\Eloquents;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderRepository;
use App\Entities\Order;
use Prettus\Repository\Exceptions\RepositoryException;

/**
 * Class OrderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Order::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        try {
            $this->pushCriteria(app(RequestCriteria::class));
        } catch (RepositoryException $e) {
        }
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }
}
