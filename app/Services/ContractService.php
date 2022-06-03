<?php

namespace App\Services;

use App\Repositories\ContractRepository;

class ContractService
{
    protected $contractRepository;

    public function __construct(ContractRepository $contractRepository)
    {
        $this->contractRepository = $contractRepository;
    }

    public function all() {
        return $this->contractRepository->with(['order'])->allDesc();
    }

    public function insert(array $attributes)
    {
        return $this->contractRepository->insert($attributes);
    }

    public function updateStatus(array $ids)
    {
        return $this->contractRepository->updateStatus($ids);
    }
}
