<?php
namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\ProductAgency;

class ProductAgencyRepository extends BaseRepository
{
    public function getModel()
    {
        return ProductAgency::class;
    }
}