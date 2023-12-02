<?php

namespace App\Exceptions;

use Exception;

class SnappyServiceException extends Exception
{
    public function render($request)
    {
        $message = config('app.debug') ? $this->getMessage() : 'Internal server error';
        return response()->json([
            'message' => $message,
        ], 500);
    }
}
