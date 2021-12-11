<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\Location;
use App\Models\Phone;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request);
        // dd($request->session()->get('current_page'));
        //直接引入Model
        // $students = Student::all()->diff(Student::where('name', 'like', '%chang180%')->get());
        // $students = Student::all();
        // $students = Student::with('phone')->with('location')->get();
        $students = Student::with('phoneRelation')->with('locationRelation')->with('hobbyRelation')->paginate(8);
        // dd($students);
        $data = array(
            'students' => $students,
        );
        // dd($data['students'][0]['hobbyRelation'][0]);

        //引入DB
        // $students = DB::table('students')->get();

        //SQL查询
        // $students=DB::select('select * from students');
        // dd($students);

        return view('student.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request);
        // dd($request->session()->get('current_page'));
        //直接引入Model
    
        // dd($request->last_page);
        return view('student.create')->with(['last_page' => $request->last_page]);
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
        // dd($request->last_page);
        $file=$request->file('photo');
        
        // dd($file->getClientOriginalName());
        $file->storeAs('images', $file->getClientOriginalName(), 'public');
        //資料寫入
        $student = new Student();
        $student->photo = $file->getClientOriginalName();
        $student->name = $request->name;
        $student->chinese = $request->chinese;
        $student->english = $request->english;
        $student->math = $request->math;
        $student->save();

        $phone = new Phone();
        $phone->phone = $request->phone;
        $phone->student_id = $student->id;
        $phone->save();

        $location = new Location();
        $location->name = $request->location;
        $location->student_id = $student->id;
        $location->save();

        // dd($request->hobby);
        foreach ($request->hobby as $value) {
            if (!empty($value)) {
                $hobby = new Hobby();
                $hobby->hobby = $value;
                $hobby->student_id = $student->id;
                $hobby->save();
            }
        }

        // $students = Student::all();
        // return view('student.index')->with('students', $students);
        // return redirect('/students');
        return redirect('/students?page=' . $request->last_page);
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
    public function edit(Request $request, $id)
    {
        // dd($request->current_page);
        $student = Student::where('id', $id)->with('phoneRelation')->with('locationRelation')->with('hobbyRelation')->first();
        return view('student.edit')->with(['student' => $student, 'page' => $request->current_page]);
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
        // dd($request->hobby);
        // dd($id);

        $file=$request->file('photo');
        $file->storeAs('images', $file->getClientOriginalName(), 'public');

        $student = Student::find($id);
        $student->photo = $file->getClientOriginalName();
        $student->name = $request->name;
        $student->chinese = $request->chinese;
        $student->english = $request->english;
        $student->math = $request->math;
        $student->save();

        $phone = Phone::where('student_id', $id)->first() ?? new Phone();
        // dd($phone);
        $phone->student_id = $student->id;
        $phone->phone = $request->phone;
        $phone->save();

        $location = Location::where('student_id', $id)->first() ?? new Location();
        // dd($location);
        $location->student_id = $student->id;
        $location->name = $request->location;
        $location->save();

        Hobby::where('student_id', $id)->delete();
        foreach ($request->hobby as $value) {
            if (!empty($value)) {
                $hobby = new Hobby();
                $hobby->student_id = $student->id;
                $hobby->hobby = $value;
                $hobby->save();
            }
        }
        // dd($request);

        return redirect('/students?page=' . $request->page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $student = Student::with('phoneRelation')->with('locationRelation')->with('hobbyRelation')->find($id);
        // dd($request->current_page);

        Student::destroy($id);
        Phone::where('student_id', $id)->delete();
        Location::where('student_id', $id)->delete();
        Hobby::where('student_id', $id)->delete();
        return redirect('/students?page=' . $request->current_page);
    }

    /** 檔案上傳
     * 
     * 
     */

    public function createFile(Request $request)
    {
        $input=$request->all();
        $student = Student::find($input['id']);
        $photo=$student->photo;
        // dd($photo);
        // dd($input);
        return view('student.create-file')->with(['student_id' => $input['id'], 'page' => $input['current_page'],'photo'=>$photo]);
    }

    /** 儲存檔案
     * 
     * 
     */

    public function storeFile(Request $request)
    {
        $input=$request->all();
        $file = $request->file('file');
        // dd($file);
        if($file){
            $student = Student::find($input['student_id']);
            $student->photo = $file->getClientOriginalName();
            $student->save();
            
            // dd($file->hashName());
            $file->storeAs('images', $file->getClientOriginalName(), 'public');
        }

        return redirect('/students?page=' . $request->page);
    }
}
