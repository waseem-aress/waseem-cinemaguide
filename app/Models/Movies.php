<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Movies extends Model
{
    use HasFactory;
    protected $table = 'movies';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'parental_rating',
        'movie_length',
        'poster',
        'created_at',
        'updated_at'
    ];

    public function cinemas()
    {
        return $this->belongsToMany(Cinemas::class, 'session__times', 'cinema_id', 'id');
    }

    public function getparentalRatingAttribute($value) {

        switch ($value) {
            case '1';
            return 'G';
            break;
            case '2';
            return 'PG';
            break;
            case '3';
            return 'M';
            break;
            case '4';
            return 'MA 15+';
            break;
            case '5';
            return 'R 18+';
            break;
            default:
            return 'X 18+';
          }
    }

}
