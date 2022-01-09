<?php
namespace App\Repositories;

use App\Models\Phone;

class PhoneRepository{

    private $phone;
    
    public function __construct(Phone $phone){
        $this->phone = $phone;
    }

    public function getAll(){
        return $this->phone->paginate(env('PAGINATE_ALL'));
    }

    public function getById($id){
        return $this->phone->find($id);
    }

    public function addOne($data,$id){
        $phone= new $this->phone;
        $phone->phone = $data;
        $phone->student_id = $id;
        $phone->save();
    }
    
    public function updateOne($data,$id){
        $phone = Phone::where('student_id', $id)->first() ?? new $this->phone;
        $phone->student_id = $id;
        $phone->phone = $data;
        $phone->save();
    }

    public function deleteOne($id){
        Phone::where('student_id', $id)->delete();
    }
    
}