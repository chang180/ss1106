<?php
namespace App\Repositories;

use App\Models\Hobby;

class HobbyRepository{

    private $hobby;
    
    public function __construct(Hobby $hobby){
        $this->hobby = $hobby;
    }

    public function getAll(){
        return $this->hobby->paginate(env('PAGINATE_ALL'));
    }

    public function getById($id){
        return $this->hobby->find($id);
    }

    public function addOne($data,$id){
        $hobby= new $this->hobby;
        $hobby_tmp = [];
        foreach ($data as $value) {
            $hobby_tmp[] = [
                'hobby' => $value,
                'student_id' => $id,
            ];
        }
        Hobby::upsert($hobby_tmp, ['hobby'], ['student_id']);
    }
    
    public function updateOne($data,$id){
        Hobby::where('student_id', $id)->delete();
        $hobby = Hobby::where('student_id', $id)->first() ?? new $this->hobby;
        $hobby_tmp = [];
        foreach ($data as $value) {
            $hobby_tmp[] = [
                'hobby' => $value,
                'student_id' => $id,
            ];
        }
        Hobby::upsert($hobby_tmp, ['hobby'], ['student_id']);
        $hobby->save();
    }

    public function deleteOne($id){
        Hobby::where('student_id', $id)->delete();
    }
}