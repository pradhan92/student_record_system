<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students = Student::all();
        //return response()->json($students);
        //data is formatted by the resource
        return StudentResource::collection($students);
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
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->address=$request->address;
        $student->phone=$request->phone;
        $student->gender=$request->gender;
        $student->course_id=$request->course_id;
        if ($request->hasFile('image')){
            $file=$request->image;
            $newName= time() . '' . $file->getClientOriginalName();
            $file->move("image", $newName);
            $student->image="images/$newName";
        }
        $student->save();
        return response()->json(['message' => 'Student Created Successfully']);

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
        $student = Student::find($id);
        return response()->json($student);
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
        $student = Student::find($id);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->address=$request->address;
        $student->phone=$request->phone;
        $student->gender=$request->gender;
        $student->course_id=$request->course_id;
        if ($request->hasFile('image')){
            $file=$request->image;
            $newName= time() . '' . $file->getClientOriginalName();
            $file->move("image", $newName);
            $student->image="images/$newName";
        }
        $student->update();
        return response()->json(['message'=>'Student Updated Successfully']);
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
        $student = Student::find($id);
        $student->delete();
        return response()->json(['message' => 'Student Deleted Successfully']);
    }
}
