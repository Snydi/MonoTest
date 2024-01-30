<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ApiRequest;
use Illuminate\Http\Request;

class ApiRequestController extends Controller
{
    public function search(Request $request)
    {
       return ApiRequest::searchRoute($request);
    }
    public function sort(Request $request)
    {
       return ApiRequest::sortByMethod($request);
    }
}
