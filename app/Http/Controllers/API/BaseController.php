<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($result, $message = '') {
        return response()->json([
            'success' => true,
            'data' => $result,
            'message' => $message
        ], 200);
    }

    public function sendError($error, $errorMessage = [], $code = 404) {
        $response = [
            'success' => false,
            'message' => $error
        ];

        if(!empty($errorMessage)) {
            $response['data'] = $errorMessage;
        }

        return response()->json($response, $code);

    }
}
