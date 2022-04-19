<?php

namespace App\Http\Controllers;

use App\Helpers\CommonResponse;
use App\Helpers\HandleException;
use App\Helpers\ResponseHelper;
use App\Mail\MailRemind;
use App\Services\OrderService;
use App\Services\UserService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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

    public function create(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $listData = $request['orders'];
            $orders = [];
            foreach ($listData as $data) {
                $order = [
                    'id_order' => $data['id_order'],
                    'line_item_id' => $data['line_item_id'],
                    'product_id' => $data['product_id'],
                    'variant_id' => $data['variant_id'],
                    'email' => $data['email'],
                    'contact_email' => $data['contact_email'],
                    'order_status_url' => $data['order_status_url'],
                    'referring_site' => $data['referring_site'],
                    'customer_id' => $data['customer_id'],
                    'status' => $data['status'],
                    'quantity' => $data['quantity'],
                    'fulfillments_update_at' => $data['fulfillments_update_at'],
                    'created_at' => Carbon::now()
                ];
                array_push($orders, $order);
            }
            $dataInsert = $this->orderService->insert($orders);
            DB::commit();
            return ResponseHelper::send($dataInsert);
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error($e);
            return HandleException::catchQueryException($e);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error($e);
            return CommonResponse::unknownResponse($e);
        }
    }
}
