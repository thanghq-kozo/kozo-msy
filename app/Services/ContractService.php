<?php

namespace App\Services;

use App\Repositories\ContractRepository;
use Brick\Math\BigInteger;

class ContractService
{
    protected $contractRepository;

    public function __construct(ContractRepository $contractRepository)
    {
        $this->contractRepository = $contractRepository;
    }

    public function all() {
        return $this->contractRepository->allDesc();
    }

    public function insert(array $attributes)
    {
        return $this->contractRepository->insert($attributes);
    }

    public function updateStatus(array $ids)
    {
        return $this->contractRepository->updateStatus($ids);
    }

    public function findByField($field, $value, $columns = ['*'])
    {
        return $this->contractRepository->findByField($field, $value, $columns);
    }
    public function getOrdersRemind()
    {
        return $this->contractRepository->ordersRemind();
    }

    public function updateCount()
    {
        return $this->contractRepository->updateCount();
    }
}
