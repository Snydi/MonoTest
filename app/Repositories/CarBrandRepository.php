<?php
namespace App\Repositories;
use App\Models\CarBrand;
class CarBrandRepository
{
    public static function getSearchedBrands($brand)
    {
        return CarBrand::where('name', 'LIKE', $brand.'%')->select('name')->get();
    }
}
