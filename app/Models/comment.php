<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
        protected $fillable = [
        'content'  ];

    public function user(){
        return $this->belongsTo(user::class,'user_id','id');
    }

    public function idea(){
        return $this->belongsTo(idea::class,'idea_id','id');
    }
}
