<?php

namespace App\Models;

use ClassworkType;
use Illuminate\Database\Eloquent\Builder;
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
    protected $casts = [
        'options' => 'json',
        'classroom_id' => 'integer',
        'published_at' => 'datetime',
        // 'type' =>' app\Enums\ClassworkType::class',
    ];
    protected static function booted(){
        static::creating(function(Classwork $classwork){
            if(!$classwork->published_at){
                $classwork->published_at = now();
            }
        });
    }
    public function scopeFilter(Builder $builder,$filters){
        $builder->when($filters['search'] ?? '',function($builder,$value){
            $builder->where(function($builder) use($value){
                $builder->where('title','LIKE',"%{$value}%")
                ->orWhere('description','LIKE',"%{$value}%");
            });
        })
        ->when($filters['type'] ?? '',function($builder,$value){
            $builder->where('type','=',"%{$value}%");
        });
    }
    public function getPublishedDateAttribute(){
        if($this->published_at){
            return $this->published_at->format('Y-m-d');
        }
    }

    public function classroom(): BelongsTo {
        return $this->belongsTo(Classroom::class,'classroom_id','id');

    }

    public function topic()  {
        return $this->belongsTo(Topic::class);

    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    function users() {
        return $this->belongsToMany(User::class)
        ->withPivot(['grade','submitted_at','status','created_at'])
        ->using(ClassworkUser::class);

    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }
    public function submissions(){
        return $this->hasMany(Submission::class);
    }
}
