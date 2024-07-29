<?php

namespace App\Http\Controllers;

use App\Traits\ResponseTrait;

abstract class Controller
{
    use ResponseTrait;
    public function sendResponse($result, $message)
    {
        return response()->json(self::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return response()->json(self::makeError($error), $code);
    }

    public function sendSuccess($message)
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}
