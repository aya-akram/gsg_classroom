<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests\TopicRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class TopicsController extends Controller
{
    public function index($classroom)
    {

        $topics = Topic::where('classroom_id', '=' , $classroom)->get();
        // $topics  = Topic::orderBy('id', 'DESC')->get();
        return view('topics.index', [
            'topics' => $topics,
            'classroom' => $classroom
        ]);

    }
   public function create($classroom) {
    // return view()->make('topics.create');
    return view()->make('topics.create',[

        'classroom' => $classroom,
        'topic' => new Topic()
    ]);

    }
    public function store(TopicRequest $request,$classroom)  {
        $validated = $request->validated();
        $request['classroom_id'] = $classroom;
        $topic= Topic::create($validated);
        return redirect()->route('classrooms.topics.index',['classroom' => $classroom]);

    }
    public function show($classroom, Topic $topic)
    {
        return View::make('topics.show')->with([
            'topic' => $topic,
            'classroom' => $classroom
        ]);
    }

public function edit($classroom, Topic $topic) {
    $classroomModel = Classroom::findOrFail($classroom);

    return view('topics.edit',[
        'topic' => $topic,
        'classroom' => $classroomModel
    ]);
}




    // public function update(TopicRequest $request, $id)
    // {
    //     $validated = $request->validated();

    //     $topic = Topic::find($id);
    //     $topic->update($validated);


    //     return Redirect::route('topics.index');
    // }
    public function update(TopicRequest $request, $classroom, Topic $topic)
{
    $validated = $request->validated();
    $topic->update($validated);
    return Redirect::route('classrooms.topics.index', $classroom);
}

    public function destroy($classroom, Topic $topic)
    {
        $topic->delete();

        return redirect(route('classrooms.topics.index', $classroom));
    }


    public function trashed() {
        $topics = Topic::onlyTrashed()
        ->latest('deleted_at')
        ->get();
        return view('topics.trashed',compact('topics'));
    }
    public function restore($id) {
        $topics = Topic::onlyTrashed()->findOrFail($id);
        $classroom = $topics->classroom_id; // assuming you have a classroom_id field in Topic model
        $topics->restore();

        return redirect()
            ->route('classrooms.topics.index',$classroom)
            ->with('success',"Classroom ({$topics->name}) restored");
    }


    public function forceDelete($id){
        $topics = Topic::withTrashed()->findOrFail($id);
        $topics->forceDelete();
        // Topic::delateCoverImage($topics->covr_image_path);
        return redirect()
        ->route('topics.trashed')
        ->with('success',"Classroom {{$topics->name}} deleted forrver");


    }

}
