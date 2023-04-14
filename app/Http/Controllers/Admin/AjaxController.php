<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AjaxService;

class AjaxController extends Controller
{
    public function uploadMultiImage(Request $request, $config){
        $json = [];
        try {
            $service = new AjaxService();
            $json = $service->uploadMultiImage($request, $config);
        } catch (\Exception $err) {
            //app('Log')->info($err->getMessage());
        }
        echo json_encode($json);
    }

    public function loadMultiImage(Request $request, $config){
        $json = [];
        try {
            $service = new AjaxService();
            $json = $service->loadMultiImage($request, $config);
            //app('Log')->info($json);
        } catch (\Exception $err) {
            //app('Log')->info($err->getMessage());
        }
        echo json_encode($json);
    }

    public function deleteMultiImage(Request $request, $config){
        $json = [];
        try {
            $service = new AjaxService();
            $json = $service->deleteMultiImage($request, $config);
            //app('Log')->info($json);
        } catch (\Exception $err) {
            //app('Log')->info($err->getMessage());
        }
        echo json_encode($json);
    }
}
