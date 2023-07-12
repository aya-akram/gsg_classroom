<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class TopicsController extends Controller
{
    public function index(Request $request)
    {

        $topics  = Topic::orderBy('id', 'DESC')->get();
        return view('topics.index', compact('topics'));
    }
   public function create() {
    return view()->make('topics.create');

    }
    public function store(Request $request)  {
        $topics = Topic::create($request->all());
        return redirect()->route('topics.index');

    }
    public function show(Request $request, string $id)
    {

        $topics = Topic::findOrFail($id);

        return View::make('topics.show')->with([
            'topic' => $topics,

        ]);

    }
   public function edit($id) {
        $topic = Topic::find($id);
        return view('topics.edit',[
            'topic' => $topic,
        ]);

    }

    public function update(Request $request, $id)
    {
        $topic = Topic::find($id);
        $topic->update($request->all());


        return Redirect::route('topics.index');
    }

    public function destroy($id)
    {
        Topic::destroy($id);

        return redirect(route('topics.index'));
    }

}
