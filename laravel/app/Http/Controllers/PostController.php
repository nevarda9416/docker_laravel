<?php

namespace App\Http\Controllers;

use App\Services\Api\PostService;
use App\Http\Requests\Api\PostCreateRequest;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    protected $service;

    public function __construct(PostService $service)
    {
        $this->service = $service;
    }

    public function store(PostCreateRequest $request)
    {
        $params = $request->all();
        $item = $this->service->create($params);
        return $this->responseSuccess(compact('item'));
    }

    public function update(PostCreateRequest $request, $id)
    {
        $params = $request->all();
        $item = $this->service->update($id, $params);
        if ($item) {
            return $this->responseSuccess();
        }
        return $this->responseError('api.code.common.update_failed');
    }

    public function destroy(Request $request, $id)
    {
        $result = $this->service->delete($id);
        if ($result) {
            return $this->responseSuccess();
        }
        return $this->responseError('api.code.common.delete_failed');
    }
}
