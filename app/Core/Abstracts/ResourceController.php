<?php

namespace App\Core\Abstracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class ResourceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Handeling userJsonResponse.
     * @param  mixed   $data
     * @param  integer $statusCode
     * @return JsonResponse
     */
    public function userJsonResponse($data, int $statusCode = 200) : JsonResponse
    {
        return response()->json([
            "payload" => $data,
        ], $statusCode);
    }

    /**
     * Handeling apiJsonResponse.
     * @param  mixed   $data
     * @param  integer $statusCode
     * @return JsonResponse
     */
    public function apiJsonResponse($data, int $statusCode = 200) : JsonResponse
    {
        return response()->json([
            "payload" => $data,
        ], $statusCode);
    }
}
