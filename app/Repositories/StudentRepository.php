<?php
namespace App\Repositories;

use App\Models\Hobby;
use App\Models\Location;
use App\Models\Phone;
use App\Models\Student;

class StudentRepository{

    private $student;
    public $studentName;
    
    public function __construct(Student $student){
        $this->student = $student;
        $this->studentName = '王小明';
    }

    public function set_name($name){
        $this->studentName = $name;
    }

    public function getAll(){
        // $data = $this->student->all();
        // $data = $this->student->with('phoneRelation')->with('locationRelation')->with('hobbyRelation')->get();
        // $data = student::with('phoneRelation')->all();
        // dd($data);
        return $this->student->with('phoneRelation')->with('locationRelation')->with('hobbyRelation')->get();
    }

    public function getPaginate($page){
        // return $this->student->with('phoneRelation')->with('locationRelation')->with('hobbyRelation')->paginate($page);
        return $this->student::with('phoneRelation')->with('locationRelation')->with('hobbyRelation')->paginate($page);
    }

    public function getById($id){
        return $this->student->find($id);
    }

    public function addOne($input){
        $student= new Student;
        // dd($student);
        if (isset($input['photo'])) {
            $input['photo']->storeAs('images', $input['photo']->getClientOriginalName(), 'public');
            $student->photo = $input['photo']->getClientOriginalName();
        }
        $student->name = $input['name'];
        $student->chinese = $input['chinese'];
        $student->english = $input['english'];
        $student->math = $input['math'];
        $student->save();

        // $phone = new Phone();
        // $phone->phone = $input['phone'];
        // $phone->student_id = $student->id;
        // $phone->save();

        // $location = new Location();
        // $location->name = $input['location'];
        // $location->student_id = $student->id;
        // $location->save();

        // $hobby_tmp = [];
        // foreach ($input['hobby'] as $value) {
        //     $hobby_tmp[] = [
        //         'hobby' => $value,
        //         'student_id' => $student->id,
        //     ];
        // }
        // Hobby::upsert($hobby_tmp, ['hobby'], ['student_id']);
        return $student->id;
    }
    
    public function updateOne($input,$id){
        $student = $this->student->find($id);
        // dd($input);
        if (isset($input['photo'])) {
            $input['photo']->storeAs('images', $input['photo']->getClientOriginalName(), 'public');
            $student->photo = $input['photo']->getClientOriginalName();
        }
        $student->name = $input['name'];
        $student->chinese = $input['chinese'];
        $student->english = $input['english'];
        $student->math = $input['math'];
        $student->save();

        // $phone = Phone::where('student_id', $id)->first() ?? new Phone();
        // $phone->student_id = $student->id;
        // $phone->phone = $input['phone'];
        // $phone->save();

        // $location = Location::where('student_id', $id)->first() ?? new Location();
        // $location->student_id = $student->id;
        // $location->name = $input['location'];
        // $location->save();

        // Hobby::where('student_id', $id)->delete();
        // $hobby_tmp = [];
        // foreach ($input['hobby'] as $value) {
        //     $hobby_tmp[] = [
        //         'hobby' => $value,
        //         'student_id' => $student->id,
        //     ];
        // }
        // Hobby::upsert($hobby_tmp, ['hobby'], ['student_id']);
    }

    public function deleteOne($id){
        Student::destroy($id);
        // Phone::where('student_id', $id)->delete();
        // Location::where('student_id', $id)->delete();
        // Hobby::where('student_id', $id)->delete();
    }
}