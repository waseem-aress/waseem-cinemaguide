<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinemas extends Model
{
    use HasFactory;
    protected $table = 'cinemas';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'address',
        'geo_lat_long',
        'seating_capacity',
        'created_at',
        'updated_at'
    ];

    

    // public function session_times()
    // {
    //     return $this->belongsToMany(Session_Times::class, 'session__times');
    // }

    public function session_times()
    {
        return $this->hasMany(Session_Times::class, 'session__times');
    }
}
