<?php

namespace App\Http\Controllers;

use App\Exports\PhonesExport;
use App\Models\Student;
use Illuminate\Http\Request;

use App\Exports\StudentsExport;
use App\Repositories\StudentRepository;
use App\Repositories\HobbyRepository;
use App\Repositories\PhoneRepository;
use App\Repositories\LocationRepository;

use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    private $StudentRepository;
    private $HobbyRepository;
    private $PhoneRepository;
    private $LocationRepository;

    public function __construct(
        StudentRepository $StudentRepository,
        HobbyRepository $HobbyRepository,
        PhoneRepository $PhoneRepository,
        LocationRepository $LocationRepository
        ){
        $this->StudentRepository = $StudentRepository;
        $this->HobbyRepository = $HobbyRepository;
        $this->PhoneRepository = $PhoneRepository;
        $this->LocationRepository = $LocationRepository;
    }

    // public function __construct(
    //     private StudentRepository $StudentRepository,
    //     private HobbyRepository $HobbyRepository,
    //     private PhoneRepository $PhoneRepository,
    //     private LocationRepository $LocationRepository
    // ) {
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->StudentRepository->set_name('王大明');
        // dd($this->StudentRepository->studentName);
        // $data=$this->StudentRepository->getAll();
        $paginate = env('PAGINATE_ALL');
        $students = $this->StudentRepository->getPaginate($paginate);
        // dd($students);
        $data = array(
            'students' => $students,
            'lastpage' => $students->lastPage(),
        );
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
        // dd($request);
        // $input=$request->all();
        // $input= new Collection($request->except('_token'));
        $input = $request->except('_token');
        // dd($input);
        // $file = $request->file('photo');
        $student_id = $this->StudentRepository->addOne($input);
        $this->HobbyRepository->addOne($input['hobby'], $student_id);
        $this->PhoneRepository->addOne($input['phone'], $student_id);
        $this->LocationRepository->addOne($input['location'], $student_id);

        // dd($request->last_page);

        // dd($file->getClientOriginalName());

        //資料寫入
        // $student = new Student();
        // if ($file) {
        //     $file->storeAs('images', $file->getClientOriginalName(), 'public');
        //     $student->photo = $file->getClientOriginalName();
        // }

        // $student->name = $request->name;
        // $student->chinese = $request->chinese;
        // $student->english = $request->english;
        // $student->math = $request->math;
        // $student->save();

        // $phone = new Phone();
        // $phone->phone = $request->phone;
        // $phone->student_id = $student->id;
        // $phone->save();

        // $location = new Location();
        // $location->name = $request->location;
        // $location->student_id = $student->id;
        // $location->save();

        // $hobby_tmp = [];
        // foreach ($request->hobby as $value) {
        //     $hobby_tmp[] = [
        //         'hobby' => $value,
        //         'student_id' => $student->id,
        //     ];
        // }
        // Hobby::upsert($hobby_tmp, ['hobby'], ['student_id']);


        $lastpage = Student::paginate(env('PAGINATE_ALL'))->lastpage();

        // $students = Student::all();
        // return view('student.index')->with('students', $students);
        // return redirect('/students');
        return redirect('/students?page=' . $lastpage);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $page
     * @return \Illuminate\Http\Response
     */
    public function show($page)
    {
        return redirect('/students?page=' . $page);
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
        // dd($student);
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
        $input = $request->except('_token');
        // dd($input);
        $this->StudentRepository->updateOne($input, $id);
        $this->HobbyRepository->updateOne($input['hobby'], $id);
        $this->PhoneRepository->updateOne($input['phone'], $id);
        $this->LocationRepository->updateOne($input['location'], $id);


        // $file = $request->file('photo');
        // $student = Student::find($id);

        // if ($file) {
        //     $file->storeAs('images', $file->getClientOriginalName(), 'public');
        //     $student->photo = $file->getClientOriginalName();
        // }
        // $student->name = $request->name;
        // $student->chinese = $request->chinese;
        // $student->english = $request->english;
        // $student->math = $request->math;
        // $student->save();

        // $phone = Phone::where('student_id', $id)->first() ?? new Phone();
        // dd($phone);
        // $phone->student_id = $student->id;
        // $phone->phone = $request->phone;
        // $phone->save();

        // $location = Location::where('student_id', $id)->first() ?? new Location();
        // dd($location);
        // $location->student_id = $student->id;
        // $location->name = $request->location;
        // $location->save();

        //一對多的儲存，通常是先刪除原本的資料，再新增，因為一般這種關係的資料比較不重要，比對欄位再存的方式反而浪費時間
        // Hobby::where('student_id', $id)->delete();
        // 多筆資料存法, 一筆一筆存較沒效率
        // foreach ($request->hobby as $value) {
        //     if (!empty($value)) {
        //         $hobby = new Hobby();
        //         $hobby->student_id = $student->id;
        //         $hobby->hobby = $value;
        //         $hobby->save();
        //     }
        // }

        //可使用upsert一次儲存，較有效率：
        // dd($request->hobby);
        // $tmp_hobby = [];
        // foreach ($request->hobby as $value) {
        //     if (!empty($value)) {
        //         $tmp_hobby[] = ['hobby' => $value, 'student_id' => $student->id];
        //     }
        // }
        // dd($tmp_hobby);
        // Hobby::upsert($tmp_hobby, ['hobby'], ['student_id']);
        return redirect('/students?page=' . $request->page);
        // echo "Success"; //開發中可先不導頁，方便debugbar看資料
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // $student = Student::with('phoneRelation')->with('locationRelation')->with('hobbyRelation')->find($id);

        // Student::destroy($id);
        // Phone::where('student_id', $id)->delete();
        // Location::where('student_id', $id)->delete();
        // Hobby::where('student_id', $id)->delete();
        // 圖片使用原檔名，有可以刪到不同筆資料使用的同張圖，若要刪除圖片，需要修改檔名規則

        $this->StudentRepository->deleteOne($id);
        $this->HobbyRepository->deleteOne($id);
        $this->PhoneRepository->deleteOne($id);
        $this->LocationRepository->deleteOne($id);
        //刪到該頁最後一項時，回到有資料的最後頁
        $lastpage = (int)ceil(Student::all()->count() / env('PAGINATE_ALL'));
        $current_page = ($request->current_page > $lastpage) ? $lastpage : $request->current_page;
        // dd($current_page,$lastpage,$request->current_page);

        return redirect('/students?page=' . $current_page);
    }

    /** 檔案上傳
     * 
     * 
     */

    public function createFile(Request $request)
    {
        $input = $request->all();
        $student = Student::find($input['id']);
        $photo = $student->photo;
        // dd($photo);
        // dd($input);
        return view('student.create-file')->with(['student_id' => $input['id'], 'page' => $input['current_page'], 'photo' => $photo]);
    }

    /** 儲存檔案
     * 
     * 
     */

    public function storeFile(Request $request)
    {
        $input = $request->all();
        $file = $request->file('file');
        // dd($file);
        if ($file) {
            $student = Student::find($input['student_id']);
            $student->photo = $file->getClientOriginalName();
            $student->save();

            // dd($file->hashName());
            $file->storeAs('images', $file->getClientOriginalName(), 'public');
        }

        return redirect('/students?page=' . $request->page);
    }

    /** 輸出 excel
     * 
     */
    public function export()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    /** 輸出 phones
     * 
     */
    public function export_phones()
    {
        return Excel::download(new PhonesExport, 'phones.xlsx');
    }
}
