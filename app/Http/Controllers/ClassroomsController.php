<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
// use Illuminate\View\View as BaseView;

class ClassroomsController extends Controller
{
    //Actions
   public function index(Request $request):RedirectResponse {
    $name="aya";
    $title= "Developer";
    // return respnse:view redirect json_data file string

    return Redirect::away('https://google.com');
    return view('classrooms.index',compact('name','title'));


    }

    public function create(){
        return view()->make('classrooms.create');
    }

    public function show($id,$edit = false){
        // return view('classrooms.show')->with([
        //     'id' => $id,
        //     'edit' => $edit
        // ]);
        return View::make('classrooms.show')->with([
            'id' => $id,
            'edit' => $edit
        ]);

    }
    public function edit($id) {
        $id=1;
        return view('classrooms.edit', compact('id'));
    }


}
