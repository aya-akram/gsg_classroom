<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassworkController extends Controller
{
    protected function getType(Request $request){
        $type= $request->query('type');
        $allowed_types = [
            Classwork::TYPE_ASSIGNEMT, Classwork::TYPE_MATERIAL, Classwork::TYPE_QUESTION
        ];
        if(!in_array($type,$allowed_types)){
            $type = Classwork::TYPE_ASSIGNEMT;
        }
        return $type;

    }
    /**
     * Display a listing of the resource.
     */
    public function index(Classroom $classroom)
    {
        // $classworks= Classwork::where('classroom_id','=',$classroom->id)
        // ->where('type' ,'=',Classwork::TYPE_ASSIGNEMT)
        // ->get();
        $classworks = $classroom->classworks()
        ->with('topic') //Eager load
        ->orderBy('published_at')
        ->get();
        // $assignment = $classroom->classworks()
        // ->where('type' ,'=',Classwork::TYPE_ASSIGNEMT)
        // ->get();
        return view('classworks.index',[
            'classroom' =>$classroom,
            'classworks'=> $classworks->groupBy('topic_id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request,Classroom $classroom)
    {
        $type=$this->getType($request);
        return view('classworks.create',compact('classroom','type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Classroom $classroom)
    {
        $type=$this->getType($request);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable','string'],
            'topic_id' =>['nullable','int','exists:topics,id']
        ]);
        $request->merge([
            'user_id' => Auth::id(),
            'type' =>$type
            // 'classroom_id' => $classroom->id
        ]);
        $classwork = $classroom->classworks()->create($request->all());
        //$classwork = Classwork::create($request->all());
        $classwork->users()->attach($request->input('students'));
        return redirect()
             ->route('classrooms.classworks.index',$classroom->id)
            ->with('success', 'Classwork created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classwork $classwork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,Classroom $classroom,Classwork $classwork)
    {
        $type=$this->getType($request);

        $assigned = $classwork->users()->pluck('id')->toArray();
        return view('classworks.edit',compact('classroom','type','assigned'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classwork $classwork)
    {
        $classwork->update($request->all());
        $classwork->users()->sync($request->input('students'));
        return back()
       ->with('success', 'Classwork updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classwork $classwork)
    {
        //
    }
}
