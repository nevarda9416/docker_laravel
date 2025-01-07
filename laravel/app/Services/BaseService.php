<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BaseService
{
    protected $model;

    public function create($params)
    {
        return $this->model->create($params);
    }

    public function update($id, $params)
    {
        $model = $this->find($id);
        $model->update($params);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->find($id);
        return $model ? $model->delete() : true;
    }

    public function find($id, $width = null)
    {
        $query = $this->model;
        if ($width) {
            $query = $query->with($width);
        }
        return $query->find($id);
    }

    public function deleteMore($ids)
    {
        return $this->model->destroy($ids);
    }

    public function deleteList($params)
    {
        try {
            DB::beginTransaction();
            foreach ($params['ids'] as $id) {
                $this->delete($id);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::debug($exception->getMessage());
            return false;
        }
    }

    protected function uploadFile($param, $field, $folder)
    {
        list($extension, $content) = explode('.', $param[$field]);
        $tmpExtension = explode('/', $extension);
        $fileName = Carbon::now()->timestamp . '.' . $tmpExtension[1];
        $content = explode(',', $content[1]);
        Storage::put('public/' . $folder . '/' . $fileName, base64_decode($content));
        return $fileName;
    }
}
