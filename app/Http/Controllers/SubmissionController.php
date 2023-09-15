<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Classwork;
use App\Models\Submission;
use App\Rules\ForbiddenFile;
use Illuminate\Http\Request;
use App\Models\ClassworkUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class SubmissionController extends Controller
{
    public function store(Request $request,Classwork $classwork){
        Gate::authorize('submissions.create',[$classwork]);

        $request->validate([
            'files' => 'required|array',
            'files.*' => ['file',new ForbiddenFile('text/x-php','')]
        ]);
        $assigned= $classwork->users()->where('id',Auth::id())->exists();
        if(!$assigned){
            abort(403);
        }
        DB::beginTransaction();
        try{
            $data=[];
        foreach($request->file('files') as $file){

            $data[]=[
                'user_id' =>Auth::id(),
                'classwork_id' =>$classwork->id,
                'content' =>$file->store("submissions/{$classwork->id}"),
                'type' => 'file',
                'created_at' => now(),
                'updated_at' => now()

            ];

        }
        // $user= Auth::user();
        Submission::insert($data);

        ClassworkUser::where([
            'user_id' =>Auth::id(),
            'classwork_id' =>$classwork->id,
        ])->update([
            'status' =>'submitted'
        ]);
        DB::commit();
        }catch(Throwable $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage());


    }
        return back()->with('success','Work submitted');
    }

    public function file(Submission $submission)
    {
        $user=Auth::user();

        // Check if user is classroom teacher
        /*
        SELECT * FROM classroom_user
        WHERE user_id =?
        AND role = teacher
        AND EXISTS (
            SELECT 1 FROM classworks WHERE classworks.classroom_id = classroom_user.classroom_id
            AND EXISTS (
                SELECT 1 from submissions where submissions.classwork_id = classworks.id id =?


            )
        )
        */
        $collection=DB::select('SELECT * FROM classroom_user
        WHERE user_id =?
        AND role = ?
        AND EXISTS (
            SELECT 1 FROM classworks WHERE classworks.classroom_id = classroom_user.classroom_id
            AND EXISTS (
                SELECT 1 from submissions where submissions.classwork_id = classworks.id AND id =?


            )
        )',[$user->id,'teacher',$submission->id]);
        // dd($collection);
        $isteacher=$submission->classwork->classroom->teachers()->where('id',$user->id)->exists();
        $isOwner = $submission->user_id == $user->id;
        if( !$isteacher && !$isOwner ){
            abort(403);
        }
        return response()->file(storage_path('app/'.$submission->content));

    }
}
