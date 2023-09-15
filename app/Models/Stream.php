<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stream extends Model
{
    use HasFactory,HasUuids;
    public $incrementing =false;
    public $keyType = 'string';
    protected $fillable =[
        'classroom_id','user_id','content','link'
    ];

    protected static function booted()
    {
        // static::creating(function (Stream $stream){
        //    $stream->id = Str::uuid();

        // });
    }
    // public function uniqueIds(){
    //     return [
    //         'id'
    //     ];
    // }
    public function getUpdatedAtColumn()
    {

    }
    // public function setUpdatedAt($value)
    // {

    //     return $this;

    // }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function classroom(){
        return $this->belongsTo(Classroom::class);
    }
}
