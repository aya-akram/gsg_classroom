<?php

namespace App\Http\Controllers\Api\v1;

use Throwable;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\ClassroomResource;
use App\Http\Resources\ClassroomCollection;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Auth::guard('sanctum')->user()->tokencan('classrooms.create')){
            abort(403);
        }
        $classrooms = Classroom::with('user:id,name','topics')
        ->withCount('students as students')
        ->paginate(4);
        return new ClassroomCollection($classrooms);

        // return ClassroomResource::collection($classrooms);
        // return Response::json($classrooms,200,[
        //     'x-test' => 'test'
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Auth::guard('sanctum')->user()->tokencan('classrooms.read')){
            abort(403);
        }
        // try{
        $request->validate([
            'name' => ['required']
        ]);
    // }catch(Throwable $e){
    //     return Response::json([
    //         'message' => $e->getMessage(),
    //     ],422);
    // }
        $classroom = Classroom::create($request->all());
        return [
            'code' => 100,
            'message' => __('Classroom crated.'),
            'classroom' => $classroom
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        if(!Auth::guard('sanctum')->user()->tokencan('classrooms.read')){
            abort(403);
        }
        return $classroom->load('user')->loadCount('students');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        if(!Auth::guard('sanctum')->user()->tokencan('classrooms.update')){
            abort(403);
        }
        $request->validate([
            'name' => ['sometimes','required',Rule::unique('classrooms','name')->ignore($classroom->id)],
            'section' =>['sometimes','required']
        ]);
        $classroom->update($request->all());
        return [
            'code' => 100,
            'message' => __('Classroom updated.'),
            'classroom' => $classroom
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Auth::guard('sanctum')->user()->tokencan('classrooms.delete')){
            abort(403,'you cant delete this classroom');
        }
        Classroom::destroy($id);
        return Response::json([],204);
    }

}
