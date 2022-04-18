<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Mail\MailRemind;
use App\Services\OrderService;
use App\Services\UserService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    protected $orderService;
    protected $userService;

    public function __construct(OrderService $orderService, UserService $userService)
    {
        $this->orderService = $orderService;
        $this->userService = $userService;
    }

    public function index(): JsonResponse
    {
        return ResponseHelper::send($this->orderService->all());
    }

    public function getOrdersRemind(): JsonResponse
    {
        $orders = json_decode(json_encode($this->orderService->getOrdersRemind()), true);
        foreach ($orders as $order) {
            $user = json_decode(json_encode($this->userService->getUserById($order['customer_id'])), true);
            $mailData = [
                'last_name' => $user[0]['last_name'],
            ];
            try {
                Mail::to('thanghorit@gmail.com')->send(new MailRemind($mailData));
            } catch (Exception $e) {
                Log::error($e);
            }
        }
        return ResponseHelper::send($this->orderService->getOrdersRemind());
    }

    public function updateCount(): JsonResponse
    {
        return ResponseHelper::send($this->orderService->updateCount());
    }
}
