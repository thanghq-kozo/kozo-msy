<?php

namespace App\Repositories\Eloquents;

use App\Entities\Contract;
use App\Repositories\ContractRepository;
use App\Validators\ContractValidator;
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
}
