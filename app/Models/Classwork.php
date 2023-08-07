<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classwork extends Model
{
    use HasFactory;
    const TYPE_ASSIGNEMT = 'assignment';
    const TYPE_MATERIAL ='material';
    const TYPE_QUESTION = 'question';
    const STATUS_PUBLISHED ='published';
    const STATUS_DRAFT = 'draft';
    protected $fillable =[
        'classroom_id', 'user_id', 'topic_id', 'title',
        'description' , 'type', 'status', 'published_at' , 'options'

    ];

    public function classroom(): BelongsTo {
        return $this->belongsTo(Classroom::class,'classroom_id','id');

    }

    public function topic()  {
        return $this->belongsTo(Topic::class);

    }
    function users() {
        return $this->belongsToMany(User::class)
        ->withPivot(['grade','subimtted_at','status','created_at'])
        ->using(ClassworkUser::class);

    }
}
