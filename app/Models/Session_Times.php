<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Session_Times extends Model
{
    use HasFactory;

    protected $table = 'session__times';
    public $timestamps = true;

    protected $fillable = [
        'movie_id',
        'cinema_id',
        'date_time',
        'created_at',
        'updated_at'
    ];

    /* Function to get moview show for cinema */

    public function scopegetMovies(Builder $builder, $cinema_id)
    {
       return $builder->join('movies', 'movies.id', '=', 'session__times.movie_id')
            ->select('session__times.id', 'movies.title', 'session__times.date_time')->where('session__times.cinema_id', $cinema_id)->orderBy('session__times.date_time', 'DESC')->paginate(5);
    }

    /* Function to format session date and time */

    public function getdateTimeAttribute($value) {
        return date('m/d/Y H:i:s', strtotime(trim($value)));
    }
}
