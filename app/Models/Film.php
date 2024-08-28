<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $table = 'films';
    protected $fillable = ['title', 'sinopsis', 'year', 'poster', 'genre_id'];

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id', 'id');
    }

    public function perans()
    {
        return $this->hasMany(Peran::class, 'film_id');
    }

    public function kritiks()
    {
        return $this->hasMany(Kritik::class, 'film_id');
    }
}
