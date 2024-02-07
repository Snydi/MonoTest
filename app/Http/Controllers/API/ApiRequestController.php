<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\ApiRequestRepository;
use Illuminate\Http\Request;

class ApiRequestController extends Controller
{
    public function search(Request $request)
    {
       return ApiRequestRepository::searchRoute($request);
    }
    public function sort(Request $request)
    {
       return ApiRequestRepository::sortByMethod($request);
    }
}
