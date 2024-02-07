<?php
namespace App\Repositories;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientRepository
{
    public static function getClientsWithCars()
    {
        return DB::table('clients')
            ->leftJoin('cars', 'clients.id', '=', 'cars.client_id')
            ->select('clients.id', 'clients.name', 'cars.brand', 'cars.plate')->paginate(10);
    }
    public static function store($request)
    {
        return Client::create([
            'name' => $request->name,
            'sex' => $request->sex,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    }
    public static function edit($id)
    {
        $client = Client::find($id);
        $data ["client"] = $client;
        $data ["cars"] = $client->cars;
        return $data;
    }
    public static function update($request, $id)
    {
        $client = Client::find($id);
        $client->name = $request->name;
        $client->sex = $request->sex;
        $client->phone = $request->phone;
        $client->address = $request->address;
        $client->save();
    }
    public static function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
    }
}
