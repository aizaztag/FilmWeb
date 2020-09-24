<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['name', 'description' , 'release_date' , 'rating' ,'ticket_price' , 'country' , 'genre' , 'photo' , 'slug'];

    public function comments()
    {
        return $this->hasMany(Comment::class,'film_id','id');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}
