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
        return $this->orderRepository->all()->sortByDesc('id');
    }

    public function insert(array $attributes)
    {
        return $this->orderRepository->insert($attributes);
    }
}
