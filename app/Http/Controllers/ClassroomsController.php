<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Classroom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
// use Illuminate\View\View as BaseView;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ClassroomRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Validation\ValidationException;

class ClassroomsController extends Controller
{
    //Actions
    public function index(Request $request)
    {
        // dd($request->user());
        // dd(Auth::guard('admin'))

        // $name="aya";
        // $title= "Developer";
        // return respnse:view redirect json_data file string

        // return Redirect::away('https://google.com');
        // $classroom = Classroom::all(); //collection
        $classrooms = Classroom::active()
        ->recent()
        ->orderBy('created_at', 'DESC')->get();
        // session();//return session object
      $success=  session('success'); // return value of success in the session
    //   Session::reflash();
    //   session()->get('success');
    //   Session::get('success');

    //   Session::put('success','ss!');
    //   Session::flash('success','ss!');

    //   Session::remove('success');


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
        // $validated['code'] = Str::random(8);
        // $validated['user_id'] = Auth::id();
        DB::beginTransaction();
        try{
            $classroom = Classroom::create($validated);
            $classroom->join(Auth::id(),'teacher');


            DB::commit();
        }catch(QueryException  $e){
            DB::rollBack();
            return back()->with('error',$e->getMessage())
            ->withInput();
        }

        // $classroom = new Classroom($request->all());
        // $classroom->save();

        // $classroom = new Classroom();
        // $classroom->fill($request->all())->save();
        //PRG: POST REDIRECT GET
        return redirect()->route('classrooms.index')->with('success','Classroom created');
    }

    public function show(Classroom $classroom)
    {
        $invitation_link = URL::signedRoute('classrooms.join', [
           'classroom' => $classroom->id,
           'code' => $classroom->code,
        ]);
        // return view('classrooms.show')->with([
        //     'id' => $id,
        //     'edit' => $edit
        // ]);
        // $classroom = Classroom::where('id', '=', $id)->first();
        // $classroom = Classroom::withTrashed()->findOrFail($classroom);
        // if(!$classroom){
        //     abort(404);
        // }
        return View::make('classrooms.show')->with([
            'classroom' => $classroom,
            'invation_link' => $invitation_link

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



        return Redirect::route('classrooms.index')         //->with('success','Classroom updated');
        ->with('success','Classroom updated');
        // Session::flash('success','Classroom updated');
        // Session::flash('error','Classroom updated');
        //->with('success','Classroom updated');
        //->with('error','Classroom updated');
    }


    public function destroy(Classroom $classroom)
    {
        // $count =  Classroom::destroy($id);
        // Classroom::where('id','=',$id)->delete();

        // $classroom=Classroom::find($id);
                    //  Storage::disk(Classroom::$disk)->delete($classroom->cover_image_path);
            $classroom->delete();
            // Classroom::delateCoverImage($classroom->cover_image_path);
         //flash message
        return redirect(route('classrooms.index'))->with('success','Classroom delated');
    }

    public function trashed() {
        $classrooms = Classroom::onlyTrashed()
        ->latest('deleted_at')
        ->get();
        return view('classrooms.trashed',compact('classrooms'));
    }

    public function restore($id) {
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        $classroom->restore();

        return redirect()
        ->route('classrooms.index')
        ->with('success',"Classroom ({$classroom->name}) restored");

    }

    public function forceDelete($id){
        $classroom = Classroom::withTrashed()->findOrFail($id);
        $classroom->forceDelete();
        // Classroom::delateCoverImage($classroom->covr_image_path);
        return redirect()
        ->route('classrooms.trashed')
        ->with('success',"Classroom {{$classroom->name}} deleted forrver");


    }

}
