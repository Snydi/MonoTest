<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function getClientById($id)
    {
        return DB::table('clients')
            ->where('id', $id)
            ->select('*')
            ->get();
    }

    public static function getClientsWithCars()
    {
        return DB::table('clients')
            ->leftJoin('cars', 'clients.id', '=', 'cars.client_id')
            ->select('clients.id', 'clients.name', 'cars.brand', 'cars.plate')->paginate(10);
    }

    public function cars()
    {
       return $this->hasMany(Car::class);
    }

}
