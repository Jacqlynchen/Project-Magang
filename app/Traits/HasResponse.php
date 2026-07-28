<?php

namespace App\Traits;

trait HasResponse
{
    public static function response(
        mixed $data = null, 
        bool $success = true,
        string $message = '',
        int $code = 200
    ) {
        return response()->json([
            'success' => $success,      
            'message' => $message,
            'data'    => $data
        ], $code);
    }
}