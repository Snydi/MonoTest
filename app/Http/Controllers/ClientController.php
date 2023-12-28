<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    function index()
    {
        $clients = DB::table('clients')
            ->join('cars', 'clients.id', '=', 'cars.client_id')
            ->select('clients.name', 'cars.brand', 'cars.plate')->paginate(10);
        return view('client.index',['clients'=>$clients]);
    }
}


