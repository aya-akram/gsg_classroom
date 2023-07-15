<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
// use Illuminate\View\View as BaseView;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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
        // session();//return session object
      $success=  session('success'); // return value of success in the session
    //   Session::reflash();
    //   session()->get('success');
    //   Session::get('success');

    //   Session::put('success','ss!');
    //   Session::flash('success','ss!');

      Session::remove('success');


        return view('classrooms.index', compact('classrooms','success'));
    }

    public function create()
    {
        return view()->make('classrooms.create',[
            'classroom' => new Classroom()
        ]);
    }
    public function store(ClassroomRequest $request)
    {

        $validated = $request->validated();

        // }catch(ValidationException $e){
        //     return redirect()->back()
        //     ->withInput()
        //     ->withErrors($e->errors());

        // }

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

        if($request->hasFile('cover_image')){
            $file= $request->file('cover_image'); //Uploaded file
            $path= Classroom::uploadCoverImage($file);
            // $request->merge([
            //     'cover_image_path' => $path
            // ]);
            $validated['cover_image_path'] =$path;

        }
        // $request->merge([
        //     'code' => Str::random(8),
        //     'user_id' => Str::random(1),

        // ]);
        $validated['code'] = Str::random(8);
        $classroom = Classroom::create($validated);
        // $classroom = new Classroom($request->all());
        // $classroom->save();

        // $classroom = new Classroom();
        // $classroom->fill($request->all())->save();
        //PRG: POST REDIRECT GET
        return redirect()->route('classrooms.index')->with('success','Classroom created');
    }

    public function show(Classroom $classroom)
    {
        // return view('classrooms.show')->with([
        //     'id' => $id,
        //     'edit' => $edit
        // ]);
        // $classroom = Classroom::where('id', '=', $id)->first();
        // $classroom = Classroom::findOrFail($id);
        // if(!$classroom){
        //     abort(404);
        // }
        return View::make('classrooms.show')->with([
            'classroom' => $classroom,

        ]);
    }
    public function edit(Classroom $classroom)
    {
        // $classroom = Classroom::find($id);
        return view('classrooms.edit', [
            'classroom' => $classroom,
        ]);
    }

    public function update(ClassroomRequest $request, $id)
    {
        $classroom = Classroom::find($id);
        // $classroom->name = $request->post('name');
        // $classroom->section = $request->post('section');
        // $classroom->subject = $request->post('subject');
        // $classroom->room = $request->post('room');
        // $classroom->save();// update

       $validated = $request->validated();
        //Mass assignment
        if($request->hasFile('cover_image')){
            $file= $request->file('cover_image'); //Uploaded file
            //solution 1
            // $name = $classroom->cover_image_path ?? (Str::random(40) . '.' .$file->getClientOriginalExtension());
            // $path= $file->storeAs('/covers',basename($name ),[
            //     'disk' => 'public'
            // ]);
            //solution2
            // $path = $file->store('/covers',[
            //     'disk' =>Classroom::$disk
            // ]);
            $path=Classroom::uploadCoverImage($file);
            // $request->merge([
            //     'cover_image_path' => $path
            // ]);
            $validated['cover_image_path']=$path;
        }
        $old = $classroom->cover_image_path;
        $classroom->update($validated);
        if($old && $old != $classroom->cover_image_path){
            // Storage::disk(Classroom::$disk)->delete($old);
            Classroom::delateCoverImage($old);
        }
        // $data = $request->except('cover_image_path');
        // if($request->hasFile('cover_image')){
        //     $file= $request->file('cover_image'); //Uploaded file
        //     $path= $file->store('/covers','public');
        //     $request->merge([
        //         'cover_image_path' => $path
        //     ]);
        // }

        // if($old_image && $new_image){
        //     Storage::disk('public')->delete($old_image);
        // }
        // $classroom->update($request->all());


        // $classroom->fill($request->all())->save();

        return Redirect::route('classrooms.index')->with('success','Classroom updated');
    }


    public function destroy(Classroom $classroom)
    {
        // $count =  Classroom::destroy($id);
        // Classroom::where('id','=',$id)->delete();

        // $classroom=Classroom::find($id);
                    //  Storage::disk(Classroom::$disk)->delete($classroom->cover_image_path);
            $classroom->delete();
            Classroom::delateCoverImage($classroom->cover_image_path);
        //flash message
        return redirect(route('classrooms.index'))->with('success','Classroom delated');
    }
}
