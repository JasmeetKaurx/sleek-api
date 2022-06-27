<?php

namespace App\Traits;

trait Response
{
    public function success($data, $message, $statusCode)
    {
        return response()->json([
            'data' => $data,
            'status' => 'success',
            'message' => $message,
        ], $statusCode);
    }

    public function error($data, $message, $statusCode)
    {
        return response()->json([
            'data' => $data,
            'status' => 'error',
            'message' => $message,
        ], $statusCode);
    }
}
