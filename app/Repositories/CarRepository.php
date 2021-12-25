<?php
namespace App\Repositories;

use App\Models\Entities\Car;

class CarRepository{
    private $car;
    public function __construct(Car $car){
        $this->car = $car;
    }

    public function getAll(){
        return $this->car->all();
    }

    public function getById($id){
        return $this->car->find($id);
    }

    public function addOne($data){
        $car= new Car();
        $car->name = $data['name'];
        $car->save();
    }
    
}