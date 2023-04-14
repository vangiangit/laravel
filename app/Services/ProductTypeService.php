<?php
namespace App\Services;
use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Repositories\ProductTypeRepository;

class ProductTypeService extends BaseService
{
    public function getRepo()
    {
        return ProductTypeRepository::class;
    }        

}