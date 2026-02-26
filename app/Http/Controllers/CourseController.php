<?php

namespace App\Http\Controllers;

use App\Models\resource;
use App\Models\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Courses::orderBy('id', 'desc')->paginate(10);
        return view('course-mange', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator=$request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'enrolment_key' => 'required|string|unique:courses,enrolment_key',
            'capacity' => 'required|integer|min:1',
            'place' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'teacher' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'duration'=> 'required|string|max:255',
        ]);

            Courses::create($validator);
            return redirect()->route('course-mange')->with('success', 'Course created successfully!');

        
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Courses $courses)
    {   
        $courses = Courses::get();
            return view('course-details', compact('courses'));

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, resource $resource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(resource $resource)
    {
        //
    }
}
