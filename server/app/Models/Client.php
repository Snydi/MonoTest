<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{
    use HasFactory;
    public $timestamps = false;

    public static function getAllClients()
    {
       return DB::table('clients')
            ->select('*')
            ->get();
    }
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
    public static function createClient($request)
    {
        DB::table('clients')->insert([
            'name' => $request->name,
            'sex' => $request->sex,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    }
    public static function updateClient($request,$id)
    {
        DB::table('clients')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'sex' => $request->sex,
                'phone' => $request->phone,
                'address' => $request->address,
                ]);
    }
    public static function deleteClient($id)
    {
        DB::table('clients')
            ->where('id', $id)
            ->delete();
    }
}
