<?php
namespace App\Services;
use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Repositories\ProductRepository;

class ProductService extends BaseService
{
    public function getRepo()
    {
        return ProductRepository::class;
    }        
}