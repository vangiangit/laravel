<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\ProductType;

class ProductTypeRepository extends BaseRepository
{
    public function getModel()
    {
        return ProductType::class;
    }
}