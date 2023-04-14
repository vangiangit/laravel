<?php

namespace App\Services;

use App\Repositories\Item\ItemImageRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
class AjaxService extends BaseService
{
    public function getRepo()
    {
        return ProductRepository::class;
    }
    public function uploadMultiImage($request, $config)
    {
        $json = [
            'success' => false,
            'id' => 0
        ];

        $config = $this->getConfigMultiImage($config);
        if (empty($config))
            goto func_return;

        try {
            $image = $this->uploadImages($request, 'file', $config['image_storage'], $config['image_size']);

            $attributes = [
                'path' => $image
            ];

            if (intval($config['id']))
                $attributes[$config['field']] = $config['id'];
            else
                $attributes['tmp'] = csrf_token();

            switch ($config['table']) {
                case 'cat_images':
                    $attributes['position'] = $config['position'];
                    break;
            }

            $id = DB::table($config['table'])->insertGetId($attributes);

            if ($id) {
                // action when upload success
                switch ($config['table']) {
                    case 'item_images':
                        // delete all data in item_images table with type = 1 and item_id = id
                        $itemImageRepos = new ItemImageRepository();
                        // delete all data in item_images table with type = 1
                        $itemImageRepos->delete(array(
                            ['item_id', '=', $config['id']],
                            ['type', '=', 1]
                        ));
                        break;
                }
                $json = [
                    'success' => true,
                    'id' => $id
                ];
            }
        } catch (\Exception $err) {
            // app('Log')->info($err->getMessage());
            return $json;
        }

        func_return:
        return $json;
    }

    public function loadMultiImage($request, $config)
    {
        $file_list = [];
        $config = $this->getConfigMultiImage($config);
        if (empty($config))
            goto func_return;

        try {
            if ($config['id'])
                $where = [
                    [$config['field'], '=', $config['id']]
                ];
            else
                $where = [
                    ['tmp', '=', csrf_token()]
                ];

            switch ($config['table']) {
                case 'cat_images':
                    $where[] = ['position', '=', $config['position']];
                    break;
                case 'item_images':
                    $where[] = ['type', '=', 1];
                    break;
            }

            $images = DB::table($config['table'])->where($where)->get();

            foreach ($images as $img) {
                $file_path = Storage::disk('public_uploads')->path('') . '/' . $img->path;
                $size = filesize($file_path);
                $name = pathinfo($file_path, PATHINFO_FILENAME);
                $file_list[] = array('id' => $img->id, 'name' => $name, 'size' => $size, 'path' => str_replace('/original/', '/original/',Storage::disk('public_uploads')->url('').$img->path));
            }
        } catch (\Exception $err) {
//            app('Log')->info($err->getMessage());
            return [];
        }
        func_return:
        return $file_list;
    }

    public function deleteMultiImage($request, $config)
    {
        $config = $this->getConfigMultiImage($config);
        if (empty($config))
            goto func_return;

        try {
            $id = $request->input('id');
            $image = DB::table($config['table'])->where('id', $id)->first();

            @unlink(Storage::disk('public_uploads')->path('') . '/' . $image->path);

            DB::table($config['table'])->where('id', $id)->delete();

            switch ($config['table']) {
                case 'cat_images':
                    DB::table('item_images')->where('path', $image->path)->delete();
                    break;
            }

        } catch (\Exception $err) {
            // app('Log')->info($err->getMessage());
            return false;
        }
        func_return:
        return true;
    }

    protected function getConfigMultiImage($config)
    {
        $return = [];

        try {
            $config = Crypt::decryptString($config);
            $config = json_decode($config, true);
            if (!is_null($config) && array_key_exists('table', $config) && array_key_exists('field', $config) && array_key_exists('id', $config) && array_key_exists('image_storage', $config) && array_key_exists('image_size', $config))
                $return = $config;
        } catch (\Exception $err) {
            // app('Log')->info($err->getMessage());
            return [];
        }
        return $return;
    }
}
