<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Idea extends Model
{
    use HasFactory,Searchable;

    public function toSearchableArray(): array
{
    return [
        'id' => $this->id,
        'idea' => $this->idea,
        'user_id' =>$this->user_id,
    ];
}

    protected $fillable = [
        'idea'  ,'user_id'
      ];

    protected $withCount = [
        'likes'
      ];

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

    //old search
    // public function scopeSearch(Builder $query,$search=''){
    //    $query ->where('idea','like','%'.$search.'%');
    // }
}
