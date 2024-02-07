<?php
namespace App\Repositories;
use App\Models\ApiRequest;

class ApiRequestRepository
{
    public static function store($route, $method)
    {
         ApiRequest::create([
            'route' => $route,
            'method' => $method,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public static function searchRoute($request)
    {
        return ApiRequest::where('route', 'LIKE', '%'.$request->route.'%')->select('*')->get();
    }
    public static function sortByMethod($request)
    {
       return ApiRequest::where('method', '=', strtoupper($request->method))->select('*')->get();
    }
}
