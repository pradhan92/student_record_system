<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $courses = Course::with('students')->get();
        //return response()->json($courses);
        //data is formatted by the resource
        return CourseResource::collection($courses);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $course = new Course();
        $course -> name = $request -> name;
        $course -> fee = $request -> fee;
        $course -> duration = $request -> duration;
        $course->save();
        return response()->json(['message' => 'Course created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $course = Course::find($id);
        //return response()->json(['course' => $course]);
        return response()->json($course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $course = Course::find($id);
        $course -> name = $request -> name;
        $course -> fee = $request -> fee;
        $course -> duration = $request -> duration;
        $course->update();
        return response()->json(['message' => 'Course updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $course = Course::find($id);
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }
}
