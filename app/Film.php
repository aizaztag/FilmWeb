<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = ['name', 'description' , 'release_date' , 'rating' ,'ticket_price' , 'country' , 'genre' , 'photo' , 'slug'];

    /*films has many comments*/
    public function comments()
    {
        return $this->hasMany(Comment::class,'film_id','id');
    }

    /*slugify*/
    public function setSlugAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value).(rand(10,1000));
;

    }
}
