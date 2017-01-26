<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function scopeNotComment($query){
        return $query->whereNull('parent_id');
    }

    public function comments(){
        return $this->hasMany('App\Post', 'parent_id');
    }

    public function likes(){
        return $this->morphMany('App\Like', 'like');
    }
}
