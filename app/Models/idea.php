<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class idea extends Model
{
    use HasFactory;
    protected $fillable = [
        'idea'  ,'user_id'  ];

        protected $withCount = [
            'likes'  ];
    public function comments(){
        return $this->hasMany(comment::class,'idea_id','id');
    }

    public function user(){
        return $this->belongsTo(user::class,'user_id','id');
    }

    public function likes(){
        return $this->BelongsToMany(user::class,'idea_like','idea_id','user_id')->withTimestamps();
    }

    public function liked(user $user){
        return $this->likes()->where('user_id',$user['id'])->exists();
    }

    public function scopeSearch(Builder $query,$search=''){
       $query ->where('idea','like','%'.$search.'%');
    }
}
