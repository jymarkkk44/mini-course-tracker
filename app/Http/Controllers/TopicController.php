<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    public function store(Request $request)
    {
        Topic::create($request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string',
            'time_spent' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
        ]));

        return redirect('/');
    }
    public function destroy(Topic $topic)
{
    $topic->delete();
    return back()->with('success', 'Topic deleted!');
}
public function edit(Topic $topic)
{
    return view('topics.edit', compact('topic'));
}

public function update(Request $request, Topic $topic)
{
    $request->validate([
        'title' => 'required',
        'status' => 'required',
        'time_spent' => 'nullable|numeric|min:0',
    ]);

    $topic->update($request->only('title', 'status', 'time_spent'));
    return redirect('/')->with('success', 'Topic updated!');
}


}
