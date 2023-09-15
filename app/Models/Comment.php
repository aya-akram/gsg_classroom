<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id', 'commentable_type', 'commentable_id',
        'content','ip' ,'user_agent'
    ];


    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name' =>'Delated User'
        ]);
    }

    public function commentable(){
        return $this->morphTo();
    }
}
