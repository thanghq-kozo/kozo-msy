<?php

namespace App\Http\Controllers;

use App\Helpers\CommonResponse;
use App\Helpers\HandleException;
use App\Helpers\ResponseHelper;
use App\Services\ContractService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ContractController extends Controller
{
    protected $contractService;

    public function __construct(ContractService $contractService)
    {
        $this->contractService = $contractService;
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
}
