<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['comment' , 'film_id'];

    /*comments to films*/
    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
