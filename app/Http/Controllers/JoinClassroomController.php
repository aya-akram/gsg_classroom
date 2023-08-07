<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Scopes\UserClassroomScope;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JoinClassroomController extends Controller
{

    public function create($id){
        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)->active()->findOrFail($id);
        try{
             $this->exists($classroom,Auth::id());

        }catch(Exception $e){
            return redirect()->route('classrooms.show',$id);

        }


        return view('classrooms.join', compact('classroom'));

    }
    public function store(Request $request,$id){
        $request->validate([
            'role' => 'in:student,teacher'
        ]);
        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)->active()->findOrFail($id);
        try{
            $classroom->join(Auth::id(),$request->input('role','student'));

       }catch(Exception $e){
           return redirect()->route('classrooms.show',$id);

       }
        return redirect()->route('classrooms.show',$id);


    }

    protected function exists(Classroom $classroom,$user_id){
        // $exists= DB::table('classroom_user')
        // ->where('classroom_id', $classroom_id)
        // ->where('user_id', $user_id)
        // ->dd()
        // ->exists();

        // //TO do
        // //Change the above query to use the relationship
        // if($exists){
        //     throw new Exception('user already joind the classroom');

        // }
        // $classroom = Classroom::find($classroom_id);
        // dd($classroom);

        $exists = $classroom->users()->where('id','=', $user_id)->exists();
        if($exists){
            throw new Exception('user already joined the classroom');
        }
        }
    }

