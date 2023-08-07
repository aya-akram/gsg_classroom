<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Scopes\UserClassroomScope;
use App\Observers\ClassroomObserver;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    use HasFactory, SoftDeletes;
    public static string $disk = 'public';
    protected $fillable =[
        'name','section','subject','room','user_id','theme','cover_image_path','code'
    ];

    protected static function booted(){
        // static::addGlobalScope('user',function(Builder $query){
        //     $query->where('user_id','=',Auth::id());
        // });
        static::observe(ClassroomObserver::class);

        static::addGlobalScope(new UserClassroomScope);

           // **action at model** //
        // Creating, Created, Updating, Updated, Saving, Saved
        // Deleting, Deleted, Restoring, Restored, ForceDeleting, ForceDeleted
        // Retrived

        // static::creating(function (Classroom $classroom){
        //     $classroom->code= Str::random(8);
        //     $classroom->user_id = Auth::id();
        // });
        // static::forceDeleted(function(Classroom $classroom){
        //     static::delateCoverImage($classroom->cover_image_path);
        // });
        // static::deleted(function(Classroom $classroom){
        //     $classroom->status = 'deleted';
        //     $classroom->save();
        // });
        // static::restored(function(Classroom $classroom){
        //     $classroom->status = 'active';
        //     $classroom->save();
        // });
    }

    public function classworks(): HasMany{
        return $this->hasMany(Classwork::class,'classroom_id','id');
    }
    public function topics(): HasMany{
        return $this->hasMany(Topic::class,'classroom_id','id');
    }
    public function users(){
        return $this->belongsToMany(User::class, //Related model
        'classroom_user',// pivot table
        'classroom_id',//FK for current model to the pivot table
        'user_id',// FK for related model to the pivot table
        'id',// PK for current model
        'id'// PK for related model
    )->withPivot(['role','created_at']);
    // ->as('join');
    }
    public function teachers(){
        return $this->users()->wherePivot('role','=','teacher');
    }
    public function students(){
        return $this->users()->wherePivot('role','=','student');
    }
    public function getRouteKeyName()
    {
        return 'id';
    }
  public static function uploadCoverImage($file) {

    $path= $file->store('/covers',[
        'disk' => static::$disk
    ]);
    return $path;
    }
    public static function delateCoverImage($path) {
        if($path && Storage::disk(Classroom::$disk)->exists($path)){
            return  Storage::disk(Classroom::$disk)->delete($path);

        }

    }

        //local scope
        public function scopeActive(Builder $query) {
            $query->where('status' , '=' , 'active');

        }
        public function scopeRecent(Builder $query) {
            $query->orderBy('updated_at','DESC');

        }
        public function scopeStatus(Builder $query, $status){
            $query->where('status','=',$status);
        }

      public  function join($user_id, $role='student') {
        $exists = $this->users()->where('id','=', $user_id)->exists();
        if($exists){
            throw new Exception('user already joined the classroom');
        }
        return   $this->users()->attach($user_id,[
            'role' =>$role,
            'created_at' => now()

        ]);//Insert
    //    return  DB::table('classroom_user')->insert([
    //         'classroom_id' => $this->id,
    //         'user_id'  => $user_id,
    //         'role' => $role,
    //         'created_at' => now()
    //     ]);

        }
//Model Accessors
        // get{ATTRIBUTENAME}Attribute
        public function getNameAttribute($value){
            return strtoupper($value);

        }

        // $classroom->cover_image_url
        public function getCoverImageUrlAttribute(){
            if($this->cover_image_path){
                return asset('storage/'.$this->cover_image_path );
            //    return Storage::disk('public')->url($this->cover_image_path);
            }
            return 'https://placehold.co/800x300';
        }

        public function getUrlAttribute(){
            return route('classrooms.show',$this->id);
        }

}
