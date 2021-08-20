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
        if ($value == '1') {
            return 'G';
        } else if ($value == '2') {
            return 'PG';
        } else if ($value == '3') {
            return 'M';
        } else if ($value == '4') {
            return 'MA 15+';
        } else if ($value == '5') {
            return 'R 18+';
        } else {
            return 'X 18+';
        }
    }

}
