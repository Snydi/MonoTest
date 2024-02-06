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
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
