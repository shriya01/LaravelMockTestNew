<?php

namespace App\Modules\Directions\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Direction;
use Crypt,DB;

class DirectionsController extends Controller
{

public function __construct()
{
    $this->directionObj = new Direction;
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data['directions'] = $this->directionObj->getdirections()->toArray();
        return view("Directions::index",$data);
    }

    public function getDirection($id = null)
    {
        if(!empty($id))
        {

            $data['id'] = $id;
            $id = Crypt::decrypt($id);
            $data['directions'] = $this->directionObj->getdirections($id)->toArray();
  
            return view("Directions::add",$data);
        }
        return view("Directions::add");
    }

    public function postDirection(Request $request)
    {
        
        $insertData = ['direction_set_name' => $request->direction_guideline_name, 'directions' => $request->direction_guidelines];
        if(empty($request->id))
        {
            $this->directionObj->insertData($insertData);
            return redirect('directions')->with('status','Directions Added Successfully');
        }
        else
        {
            $id =  Crypt::decrypt($request->id);
            $whereArray = ['id'=>$id];
            $this->directionObj->updateData($insertData,$whereArray);
            return redirect('directions')->with('status','Directions Updated Successfully');
        }
       
    }
}
