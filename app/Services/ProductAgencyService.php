<?php
namespace App\Services;
use App\Services\BaseService;
use Illuminate\Http\Request;
use App\Repositories\ProductAgencyRepository;

class ProductAgencyService extends BaseService
{
    public function getRepo()
    {
        return ProductAgencyRepository::class;
    }        
}