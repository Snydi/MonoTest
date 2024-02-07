<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\CarBrandRepository;
use Illuminate\Http\Request;

class CarBrandController extends Controller
{
    public function searchBrands(Request $request)
    {
       return CarBrandRepository::getSearchedBrands($request->brand);
    }
}
