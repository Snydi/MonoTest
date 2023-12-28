<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        $clients = DB::table('clients')
            ->leftJoin('cars', 'clients.id', '=', 'cars.client_id')
            ->select('clients.id', 'clients.name', 'cars.brand', 'cars.plate')->paginate(10);
        return view('client.index',['clients'=>$clients]);
    }
    public function create()
    {
        return view('client.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'alpha|min:3',
            'sex' => 'required',
            'phone' => 'required|phone', //использовал библиотеку
            'address' => '',
        ]);
        DB::table('clients')->insert([
            'name' => $request->name,
            'sex' => $request->sex,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return redirect('/clients');
    }
    public function edit($id) //переводит на страницу редактирования с заполненной формой
    {
        $client = DB::table('clients')
            ->where('id', $id)
            ->select('*')
            ->get();
        $cars = DB::table('cars')
            ->where('client_id', $id)
            ->select('*')
            ->get();
        return view('client.edit', ['client' => $client, 'cars' => $cars]);
    }
    public function update(Request $request, $id) //непосредственно вносит изменения в базу
    {
        $request->validate([
            'name' => 'alpha|min:3',
            'sex' => 'required',
            'phone' => 'required|phone', //использовал библиотеку
            'address' => '',
        ]);
        DB::table('clients')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'sex' => $request->sex,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
        return redirect('/clients');
    }
    public function destroy($id)
    {
        DB::table('clients')
            ->where('id', $id)
            ->delete();
        return redirect('/clients');
    }

}


