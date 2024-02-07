<?php
namespace App\Repositories;
use App\Models\Car;

class CarRepository
{
    public static function getCarsInParking()
    {
        return Car::where('in_parking', '=', '1')->select('*')->get();
    }
    public static function store($request, $client_id)
    {
        Car::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'color' => $request->color,
            'plate' => $request->plate,
            'in_parking' => $request->in_parking,
            'client_id' => $client_id,
        ]);
    }
    public static function update($request, $id)
    {
        $car = Car::find($id);
        $car->brand = $request->brand;
        $car->model  = $request->model;
        $car->color  = $request->color;
        $car->plate  = $request->plate;
        $car->in_parking  = $request->in_parking;
        $car->save();
    }
    public static function destroy($id)
    {
        $car = Car::find($id);
        $car->delete();
    }



}
