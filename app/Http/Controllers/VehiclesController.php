<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicles;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

abstract class VehicleAbstract {
    abstract public function setPower($power);
    abstract public function getPower();
    abstract public function getTires();
}

class Sedan extends VehicleAbstract {
    public $vehicletype = 'Sedan';
    protected $power;
    public function getTires(){
        return '4';
    }
    public function setPower($power){
        $this->power = $power;
    }
    public function getPower(){
        return $this->power;
    }
}

class Motorcycle extends VehicleAbstract {
    public $vehicletype = 'Motorcycle';
    protected $power;
    public function getTires(){
        return '2';
    }
    public function setPower($power){
        $this->power = $power;
    }
    public function getPower(){
        return $this->power;
    }
}

class VehiclesController extends Controller
{
    public function index(){
        $vehicles = Vehicles::latest()->get();
        return response([
        'status'=> 200,
        'vehicles'=>$vehicles,
        ]);
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'vehicletype'=>'required|max:1',
            'power'=>'required|max:10',
        ]);
        
        if($validator->fails()){

            return response([
                'status'=> 422,
                'message'=> 'Error in validation',
            ]);

        }else{

            $request->vehicletype == '1'? $vehicle = new Sedan : $vehicle = new Motorcycle;

            $tires = $vehicle->getTires();
            $vehicle->setPower($request->power);
            $power = $vehicle->getPower();

            Vehicles::insert([
                'vehicle_type' => $vehicle->vehicletype,
                'vehicle_power' => $power,
                'vehicle_tires' => $tires,
                'created_at' => Carbon::now(),
            ]);

            return response([
                'status'=> 200,
                'message'=>'Vehicle Added Successfully!',
            ]);
        }

    }
}
