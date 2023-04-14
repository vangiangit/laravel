<?php
namespace App\Services;

use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Storage;

abstract class BaseService
{
    protected $repo;

    public function __construct()
    {
        $this->setRepo();
    }

    abstract public function getRepo();

    public function setRepo()
    {
        $repo = app()->make(
            $this->getRepo()
        );

        if (!$repo instanceof BaseRepository) {
            throw new \Exception("Class {$this->repo()} must be an instance of App\\Repositories\\BaseRepository");
        }

        $this->repo = $repo;
    }

    /**
     * @param int $id
     */
    public function find($id)
    {
        return $this->repo->find($id);
    }

    public function create($attributes = [])
    {
        return $this->repo->create($attributes);
    }

    public function upsert($attributes = [])
    {
        return $this->repo->upsert($attributes);
    }

    public function getAll()
    {
        return $this->repo->getAll();
    }

    public function update($attributes = [], $id)
    {
        return $this->repo->update($attributes, $id);
    }

    /**
     *
     */
    public function uploadImages($request, $file = 'image', $storage = '', $size = [], $name = '', $isThump = true)
    {
        $image = '';
        if($request->hasFile($file) && $request->file($file)->isValid()){
            try{
                if(trim($name) != ''){
                    $extension = $request->file($file)->extension();
                    $filename = Str::slug(trim($name), '-').'.'.$extension;
                }else
                    $filename = time().'-'.$request->file($file)->getClientOriginalName();

                $image = $file = $request->$file->storeAs($storage.'/original', $filename, 'public_uploads');

                if(!empty($size) && $isThump == true)
                    foreach($size as $s){
                        $original = Storage::disk('public_uploads')->path('').'/'.$file;
//                        Helpers::resizeImage($original, str_replace('/original/', '/'.$s['size'].'/', $original), $s['width'], $s['height']);
                    }
            }catch (\Exception $err) {
//                app('Log')->info($err->getMessage());
                goto function_return;
            }
        }
        function_return:
        return $image;
    }
}
