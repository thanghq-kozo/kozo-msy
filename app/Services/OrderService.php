<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function all()
    {
        return $this->orderRepository->all();
    }

    public function getOrdersRemind()
    {
        return $this->orderRepository->ordersRemind();
    }

    public function updateCount()
    {
        return $this->orderRepository->updateCount();
    }

    public function insert(array $attributes)
    {
        return $this->orderRepository->insert($attributes);
    }

    public function updateStatus(array $ids)
    {
        return $this->orderRepository->updateStatus($ids);
    }
}
