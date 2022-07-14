<?php

namespace App\Http\Controllers;

use App\Helpers\CommonResponse;
use App\Helpers\HandleException;
use App\Helpers\ResponseHelper;
use App\Services\OrderService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(): JsonResponse
    {
        return ResponseHelper::send($this->orderService->all());
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
                    'order_name' => $data['order_name'],
                    'order_token' => $data['order_token'] ?? null,
                    'line_item_id' => $data['line_item_id'],
                    'product_id' => $data['product_id'],
                    'variant_id' => $data['variant_id'],
                    'email' => $data['email'] ?? null,
                    'contact_email' => $data['contact_email'] ?? null,
                    'order_status_url' => $data['order_status_url'] ?? null,
                    'referring_site' => $data['referring_site'] ?? null,
                    'customer_id' => $data['customer_id'] ?? null,
                    'status' => $data['status'] ?? null,
                    'quantity' => $data['quantity'] ?? null,
                    'fulfillments_update_at' => $data['fulfillments_update_at'] ?? null,
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
