<?php

namespace App\Repositories\Eloquents;

use App\Entities\Contract;
use App\Repositories\ContractRepository;
use App\Validators\ContractValidator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ContractRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContractRepositoryEloquent extends BaseRepository implements ContractRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contract::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function allDesc()
    {
        return $this->model->select('*')->where('next_billing', '<>', null)->orderBy('id','DESC')->with(['order:id_order,order_name,order_token'])->get();
    }

    public function insert(array $data)
    {
        return $this->model->insert($data);
    }

    public function updateStatus(array $ids)
    {
        return $this->model
            ->whereIn('id', $ids)
            ->update(['status' => 'CANCELLED']);
    }

    public function ordersRemind()
    {
        $rentDay = date('Y-m-d', strtotime('+5 day', strtotime(Carbon::now()->format('Y-m-d'))));
        return $this->model
            ->select('customer_id')
            ->whereDate('next_billing', $rentDay)
            ->where('count', '<', 12)
            ->where('status', '=', 'ACTIVE')
            ->get();
    }

    public function updateCount()
    {
        $rentDay = date('Y-m-d', strtotime('+32 day', strtotime(Carbon::now()->format('Y-m-d'))));
        return $this->model
            ->where('count', '<', 12)
            ->where('status', '=', 'ACTIVE')
            ->whereDate('next_billing', '<', $rentDay)
            ->update(['count' => DB::raw('count+1')]);
    }
}
