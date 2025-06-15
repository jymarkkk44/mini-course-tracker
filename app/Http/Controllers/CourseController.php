<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('topics')->get();
        return view('courses.index', compact('courses'));
    }

    public function store(Request $request)
    {
        Course::create($request->validate([
            'title' => 'required|string|max:255',
        ]));

        return redirect('/');
    }
    public function destroy(Course $course)
{
    $course->delete();
    return back()->with('success', 'Course deleted!');
}
public function edit(Course $course)
{
    return view('courses.edit', compact('course'));
}

public function update(Request $request, Course $course)
{
    $request->validate(['title' => 'required']);
    $course->update(['title' => $request->title]);
    return redirect('/')->with('success', 'Course updated!');
}


}

