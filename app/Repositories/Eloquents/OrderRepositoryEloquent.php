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

    public function ordersRemind()
    {
        $rentDay = date('Y-m-d', strtotime('-25 day', strtotime(Carbon::now()->format('Y-m-d'))));
        return $this->model
            ->select('email', 'customer_id')
            ->whereDate('fulfillments_update_at', $rentDay)
            ->where('count', '<', 10)
            ->where('status', '=', 'success')
            ->get();
    }

    public function updateCount()
    {
        $rentDay = date('Y-m-d', strtotime('+1 day', strtotime(Carbon::now()->format('Y-m-d'))));
        return $this->model
            ->where('count', '<', 10)
            ->where('status', '=', 'success')
            ->whereDate('fulfillments_update_at', $rentDay)
            ->update(['count' => DB::raw('count+1')]);
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function updateStatus(array $ids)
    {
        return $this->model
            ->whereIn('id', $ids)
            ->update(['status' => 'canceled']);
    }
}
