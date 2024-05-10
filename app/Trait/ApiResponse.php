<?php

namespace App\Trait;

trait ApiResponse {
    public function successResponse($data, $message, $statusCode){
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => $message
        ], $statusCode);

    }

    public function failResponse($data, $message, $statusCode){
        return response()->json([
            'status' => false,
            'data' => $data,
            'message' => $message
        ], $statusCode);

    }
}
