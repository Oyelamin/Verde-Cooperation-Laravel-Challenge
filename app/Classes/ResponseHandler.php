<?php


namespace App\Classes;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class ResponseHandler
{

    /**
     * @param array $responseData
     * @param int $status
     * @param Request|null $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function successResponse($responseData = [], $status = Meta::SUCCESSFUL)
    {
        $response = [
            'message' => 'success',
            'data' => $responseData,
            'status' => $status,
            'success' => true
        ];
        return response()->json($response, $status);
    }

    /**
     * @param null $message
     * @param int $status
     * @param Request|null $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function errorResponse($message = null, $status = Meta::SERVER_ERROR)
    {
        $errorData = [
            'message' => $message,
            'status' => $status,
            'error' => true
        ];
        return response()->json($errorData, $status);
    }
}
