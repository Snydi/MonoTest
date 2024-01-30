<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Car extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function getCarsInParking()
    {
        return DB::table('cars')
            ->where('in_parking', '=', '1')
            ->select('*')
            ->get();

    }
    public static function getCarsByClientId($id)
    {
        return DB::table('cars')
            ->where('client_id', $id)
            ->select('*')
            ->get();
    }
    public static function createCar($request, $client_id)
    {
        DB::table('cars')->insert([
            'brand' => $request->brand,
            'model' => $request->model,
            'color' => $request->color,
            'plate' => $request->plate,
            'in_parking' => $request->in_parking,
            'client_id' => $client_id,
        ]);
    }
    public static function updateCar($request, $id)
    {
        DB::table('cars')
            ->where('id', $id)
            ->update([
                'brand' => $request->brand,
                'model' => $request->model,
                'color' => $request->color,
                'plate' => $request->plate,
                'in_parking' => $request->in_parking,
            ]);
    }
    public static function deleteCar($id)
    {
        DB::table('cars')
            ->where('id', $id)
            ->delete();
    }
}
