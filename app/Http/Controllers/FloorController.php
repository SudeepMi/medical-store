<?php

namespace App\Http\Controllers;

use App\Http\Requests\Floor\CreateFloorReqest;
use App\Models\Floor;


class FloorController extends Controller
{
    private $floor;

    public function __construct(Floor $floor)
    {
        $this->floor = $floor;
    }

    public function create(){
        return view('floor.create');
    }
    public function store(CreateFloorReqest $request){

        //Store
        $floor = $this->floor->create($request->only('name','display_order'));
        if ($floor){
            $this->create_log('add','floor');
        }
        return redirect()->back();
    }
}
