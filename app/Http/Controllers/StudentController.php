<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //直接引入Model
        // $students = Student::all()->diff(Student::where('name', 'like', '%chang180%')->get());
        $students = Student::all();

        //引入DB
        // $students = DB::table('students')->get();

        //SQL查询
        // $students=DB::select('select * from students');
        // dd($students);

        return view('student.index')->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input=$request->all();
        // $input=$request->except('_token');
        // dd($input);
        //資料寫入
        $student = new Student();
        $student->name = $request->name;
        $student->chinese = $request->chinese;
        $student->english = $request->english;
        $student->math = $request->math;
        $student->save();
        // $students = Student::all();
        // return view('student.index')->with('students', $students);
        return redirect('/students');
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student=Student::where('id',$id)->first();
        return view('student.edit')->with('student', $student);
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
        // dd($request->all(),$id);
        $student=Student::find($id);
        $student->name = $request->name;
        $student->chinese = $request->chinese;
        $student->english = $request->english;
        $student->math = $request->math;
        $student->save();
        return redirect('/students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student=Student::find($id);
        $student->delete();
        // dd($id);
        // Student::destroy($id);
        return redirect('/students');
    }
}
