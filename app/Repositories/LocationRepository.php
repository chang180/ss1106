<?php
namespace App\Repositories;

use App\Models\Location;

class LocationRepository{

    private $location;
    
    public function __construct(Location $location){
        $this->location = $location;
    }

    public function getAll(){
        return $this->location->paginate(env('PAGINATE_ALL'));
    }

    public function getById($id){
        return $this->location->find($id);
    }

    public function addOne($data,$id){
        $location= new $this->location;
        $location->name = $data;
        $location->student_id = $id;
        $location->save();
    }
    
    public function updateOne($data,$id){
        // dd($data);
        $location = Location::where('student_id', $id)->first() ?? new $this->location;
        $location->name = $data;
        $location->student_id = $id;
        // dd($location);
        $location->save();
    }
    
    public function deleteOne($id){
        Location::where('student_id', $id)->delete();
    }
}