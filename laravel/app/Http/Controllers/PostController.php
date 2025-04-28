<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\BaseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PostController extends BaseController
{
    /**
     * Summary of service
     */
    protected $service;

    /**
     * Summary of __construct
     */
    public function __construct(BaseService $service)
    {
        $this->service = $service;
    }

    /**
     * Summary of index
     */
    public function index(Request $request): Collection
    {
        return Post::createMany([
            [
                'title' => 'Example Post',
                'content' => 'This is an example post.',
            ],
            [
                'title' => 'Example Post',
                'content' => 'This is an example post 2.',
            ],
            [
                'title' => 'Example Post',
                'content' => 'This is an example post 3.',
            ],
        ]);
    }

    /**
     * Summary of store
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $item = $this->service->create($params);

        return $this->responseSuccess(compact('item'));
    }

    /**
     * Summary of update
     *
     * @param  mixed  $id
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        $item = $this->service->update($id, $params);
        if ($item) {
            return $this->responseSuccess();
        }

        return $this->responseError('api.code.common.update_failed');
    }

    /**
     * Summary of destroy
     *
     * @param  mixed  $id
     */
    public function destroy(Request $request, $id)
    {
        $result = $this->service->delete($id);
        if ($result) {
            return $this->responseSuccess();
        }

        return $this->responseError('api.code.common.delete_failed');
    }
}
