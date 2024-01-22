<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Client extends Model
{

    public static function getAllClients()
    {
       return DB::table('clients')
            ->select('*')
            ->get();
    }
    use HasFactory;
    public $timestamps = false;
}
