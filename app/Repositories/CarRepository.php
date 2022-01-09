<?php
namespace App\Repositories;

use App\Models\Entities\Car;


class CarRepository{

    private $car;
    
    public function __construct(Car $car){
        $this->car = $car;
    }

    public function getAll(){
        return $this->car->paginate(env('PAGINATE_ALL'));
    }

    public function getById($id){
        return $this->car->find($id);
    }

    public function addOne($data){
        $car= new $this->car;
        $car->name = $data['name'];
        $car->save();
    }
    
    public function delAll($ids){
        // foreach($ids as $id){
        //     $this->car->find($id)->delete();
        // }
        $this->car->whereIn("id", $ids)->delete();
        return $ids;
    }
}