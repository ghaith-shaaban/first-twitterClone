<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use  HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'bio'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'password'=>'hashed',
    ];

    public function ideas(){
        return $this->hasMany(idea::class,'user_id','id')->orderBY('created_at','DESC');
    }

    public function comments(){
        return $this->hasMany(comment::class,'user_id','id')->latest();
    }

    public function following(){
        return $this->belongsToMany(user::class,'follower_user','follower_id','user_id')->withTimestamps();
    }

    public function follower(){
        return $this->belongsToMany(user::class,'follower_user','user_id','follower_id')->withTimestamps();
    }

    public function follows(user $user){
        return $this->following()->where('user_id',$user->id)->exists();
    }

    public function liked(idea $idea){
        return $this->likes()->where('idea_id',$idea->id)->exists();
    }

    public function likes(){
        return $this->BelongsToMany(idea::class,'idea_like','user_id','idea_id')->withTimestamps();
    }

}
