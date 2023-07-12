<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
// use Illuminate\View\View as BaseView;
use Illuminate\Support\Str;

class ClassroomsController extends Controller
{
    //Actions
    public function index(Request $request)
    {
        // $name="aya";
        // $title= "Developer";
        // return respnse:view redirect json_data file string

        // return Redirect::away('https://google.com');
        // $classroom = Classroom::all(); //collection
        $classrooms = Classroom::orderBy('created_at', 'DESC')->get();
        return view('classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        return view()->make('classrooms.create');
    }
    public function store(Request $request)
    {
        // echo $request['name']; //use object to array
        // dd($request->all());
        // $classroom = new Classroom();
        // $classroom->name = $request->post('name');
        // $classroom->section = $request->post('section');
        // $classroom->subject = $request->post('subject');
        // $classroom->room = $request->post('room');
        // $classroom->code = Str::random(8);
        // $classroom->save();// insert

        //Method 2: Mass assignment
        // $data= $request->all();
        // $data['code'] = Str::random(8);

        $request->merge([
            'code' => Str::random(8),
            'user_id' => Str::random(1),

        ]);
        $classroom = Classroom::create($request->all());
        // $classroom = new Classroom($request->all());
        // $classroom->save();

        // $classroom = new Classroom();
        // $classroom->fill($request->all())->save();
        //PRG: POST REDIRECT GET
        return redirect()->route('classrooms.index');
    }

    public function show(Request $request, string $id)
    {
        // return view('classrooms.show')->with([
        //     'id' => $id,
        //     'edit' => $edit
        // ]);
        // $classroom = Classroom::where('id', '=', $id)->first();
        $classroom = Classroom::findOrFail($id);
        // if(!$classroom){
        //     abort(404);
        // }
        return View::make('classrooms.show')->with([
            'classroom' => $classroom,

        ]);
    }
    public function edit($id)
    {
        $classroom = Classroom::find($id);
        return view('classrooms.edit', [
            'classroom' => $classroom,
        ]);
    }

    public function update(Request $request, $id)
    {
        $classroom = Classroom::find($id);
        // $classroom->name = $request->post('name');
        // $classroom->section = $request->post('section');
        // $classroom->subject = $request->post('subject');
        // $classroom->room = $request->post('room');
        // $classroom->save();// update

        //Mass assignment
        $classroom->update($request->all());

        // $classroom->fill($request->all())->save();

        return Redirect::route('classrooms.index');
    }

    public function destroy($id)
    {
        $count =  Classroom::destroy($id);
        // Classroom::where('id','=',$id)->delete();

        // $classroom=Classroom::find($id);
        // $classroom->delete();
        return redirect(route('classrooms.index'));
    }
}
