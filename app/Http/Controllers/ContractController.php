<?php

namespace App\Http\Controllers;

use App\Helpers\CommonResponse;
use App\Helpers\HandleException;
use App\Helpers\ResponseHelper;
use App\Mail\MailRemind;
use App\Services\ContractService;
use App\Services\UserService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContractController extends Controller
{
    protected $contractService;
    protected $userService;

    public function __construct(ContractService $contractService, UserService $userService)
    {
        $this->contractService = $contractService;
        $this->userService = $userService;
    }
    public function index(): JsonResponse
    {
        return ResponseHelper::send($this->contractService->all());
    }

    public function create(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $listData = $request['contracts'];
            $contracts = [];
            foreach ($listData as $data) {
                $contract = [
                    'contract_id' => $data['contract_id'],
                    'billing_interval' => $data['billing_interval'],
                    'billing_interval_count' => $data['billing_interval_count'],
                    'billing_min_cycles' => $data['billing_min_cycles'] ?? null,
                    'billing_max_cycles' => $data['billing_max_cycles'] ?? null,
                    'currency_code' => $data['currency_code'],
                    'customer_id' => $data['customer_id'],
                    'delivery_interval' => $data['delivery_interval'],
                    'delivery_interval_count' => $data['delivery_interval_count'],
                    'delivery_price' => $data['delivery_price'] ?? null,
                    'status' => $data['status'],
                    'origin_order_id' => $data['origin_order_id'],
                    'created_at' => Carbon::now()
                ];
                array_push($contracts, $contract);
            }

            $dataInsert = $this->contractService->insert($contracts);
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

    public function updateStatus(Request $request): JsonResponse
    {
        return ResponseHelper::send($this->contractService->updateStatus($request['ids']));
    }

    public function getContractByIdOrder($id): JsonResponse
    {
        return ResponseHelper::send($this->contractService->findByField('origin_order_id', $id));
    }

    public function getOrdersRemind()
    {
        $contracts = json_decode(json_encode($this->contractService->getOrdersRemind()), true);
        foreach ($contracts as $contract) {
            $user = json_decode(json_encode($this->userService->getUserById($contract['customer_id'])), true);
            $mailData = [
                'last_name' => $user[0]['last_name'],
            ];
            try {
                Mail::to('thanghorit@gmail.com')->send(new MailRemind($mailData));
            } catch (Exception $e) {
                Log::error($e);
            }
        }
        return ResponseHelper::send($this->contractService->getOrdersRemind());
    }

    public function updateCount(): JsonResponse
    {
        return ResponseHelper::send($this->contractService->updateCount());
    }
}
