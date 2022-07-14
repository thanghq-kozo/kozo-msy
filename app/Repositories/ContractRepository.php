<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ContractRepository.
 *
 * @package namespace App\Repositories;
 */
interface ContractRepository extends RepositoryInterface
{
    public function allDesc();
    public function insert(array $data);
    public function updateStatus(array $ids);
    public function ordersRemind();
    public function updateCount();
}
