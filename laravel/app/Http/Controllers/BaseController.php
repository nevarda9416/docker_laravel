<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function __construct() {}

    public function responseError($apiKeyCode, $errors = [], $customData = [])
    {
        return api_error($apiKeyCode, $errors, $customData);
    }

    public function responseSuccess($data = [], $statusCode = 200)
    {
        return api_success($data, $statusCode);
    }

    public function response404()
    {
        return abort(Response::HTTP_NOT_FOUND);
    }
}
