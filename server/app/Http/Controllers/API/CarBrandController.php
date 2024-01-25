<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CarBrand;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    public function searchBrands(Request $request)
    {
       return CarBrand::getSearchedBrands($request->brand);
    }
}
