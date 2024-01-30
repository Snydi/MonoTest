<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ApiRequest extends Model
{
    use HasFactory;

    public static function addRequest($route, $method)
    {
        DB::table('api_requests')->insert([
            'route' => $route,
            'method' => $method,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    public static function searchRoute($request)
    {
        return DB::table('api_requests')
            ->where('route', 'LIKE', '%'.$request->route.'%')
            ->select('*')
            ->get();
    }
    public static function sortByMethod($request)
    {
         return DB::table('api_requests')
            ->where('method', '=', strtoupper($request->method))
            ->select('*')
            ->get();
    }
}
