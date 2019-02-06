<?php
namespace App\Modules\Directions\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Direction;
use Crypt,DB,Validator;

/**
 * DirectionsController Controller
 * @package                LaravelMockTest
 * @subpackage             QuestionSetsController
 * @category               Controller
 * @DateOfCreation         14-Jan-2019
 * @ShortDescription       This class handles direction guidelines related operations 
 */
class DirectionsController extends Controller
{
    public function __construct()
    {
        $this->directionObj = new Direction;
    }

    /**
     * @DateOfCreation  `   5-Feb-2019
     * @ShortDescription    This function displays the availble directions
     * @return              View
     */
    public function index()
    {
        
        $data['directions'] = $this->directionObj->getdirections()->toArray();
        return view("Directions::index",$data);
    }

    /**
     * @DateOfCreation  `   5-Feb-2019
     * @ShortDescription    This function displays the form to add direction
     * @return              View
     */
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

    /**
     * @DateOfCreation  `   5-Feb-2019
     * @ShortDescription    This function handles submission of the add direction form
     * @param               Request $request [ Request Array Containing Request ]
     * @return              View
     */
    public function postDirection(Request $request)
    {  
        $rules = array(
            'direction_guideline_name'             => 'required',
            'direction_guidelines'                   => 'required', 
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
                $directionSetData = ['direction_set_name' => $request->direction_guideline_name, 'directions' => $request->direction_guidelines];
                if($request->has('direction_image')){
                        $file = $request->file('direction_image');
                        $fileName =  $file->getClientOriginalName();
                        $destinationPath = public_path('images');
                        $uploadedFile = $file->move($destinationPath, $fileName);
                        
                }
                if(empty($request->id))
                {
                    $id = DB::table('direction_set')->insertGetId($directionSetData);
                    if(isset($fileName))
                    {
                        $directionImageData = [
                            'image_name'=> $fileName,
                            'direction_set_id'=>$id
                        ];
                        $id = DB::table('direction_image');

                    }
                    return redirect('directions')->with('status','Directions Added Successfully');
                }
                else
                {
                    $id =  Crypt::decrypt($request->id);
                    $whereArray = ['id'=>$id];
                    $this->directionObj->updateData($directionSetData,$whereArray);
                    if(isset($fileName))
                    {
                        $directionImageData = [
                            'image_name'=> $fileName,
                            'direction_set_id'=>$id
                        ];
                        $id = DB::table('direction_image')->update($directionImageData);

                    }
                    return redirect('directions')->with('status','Directions Updated Successfully');
                }
        }
    }
}
