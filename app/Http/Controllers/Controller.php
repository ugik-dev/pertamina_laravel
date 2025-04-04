<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    public function responseError($message = '', $status = 400, $data = null)
    {
        return $this->responseSuccess($data, $message, true, $status);
    }

    public function responseSuccess($data, $message = '', $error = false, $status = 200)
    {
        return response()->json(
            [
                'error' => $error,
                'message' => $message,
                'data' => $data,
            ],
            $status
        );
    }
}
