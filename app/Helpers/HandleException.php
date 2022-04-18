<?php

namespace App\Helpers;

use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

class HandleException {
    public static function catchQueryException(QueryException $e): JsonResponse
    {
        $errorCode = $e->errorInfo[1];
        switch ($errorCode) {
            case 1062:
                return CommonResponse::existedResponse();
            case 1048:
                return CommonResponse::invalidResponse();
            case 1452:
                return CommonResponse::notFoundResponse();
            case 1292:
                return ResponseHelper::send(
                    [],
                    Status::NG,
                    HttpCode::BAD_REQUEST,
                    ["Invalid datetime format"]
                );
            default:
                return CommonResponse::unknownResponse($errorCode);
        }
    }
}
