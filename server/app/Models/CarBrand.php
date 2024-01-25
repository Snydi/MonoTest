<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CarBrand extends Model
{
    use HasFactory;
    public static function getSearchedBrands($brand)
    {
        return DB::table('car_brands')
            ->where('name', 'LIKE', '%'.$brand.'%')
            ->select('*')
            ->get();
    }
}
