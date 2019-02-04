<?php

namespace App\Modules\Examination\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Examination;
use Crypt,Exception;
use App\Models\MockTest;
use Validator,DB;

/**
 * ExaminationController
 *
 * @package                LaravelMockTest
 * @category               Controller
 * @DateOfCreation         31 January 2019
 * @ShortDescription       ExaminationController contains examination module related functions
 */
class ExaminationController extends Controller
{

    /**
     * @DateOfCreation      26 nov 2018
     * @ShortDescription    Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->mochtestObj = new MockTest();
    }
    /**
     * @DateOfCreation         31 January 2019
     * @ShortDescription       This function loads the list of available examinations admin side
     * @return                 View
     */
    public function getExaminationList()
    {
        $data['examinations']= Examination::get()->where('is_deleted',2)->toArray();
        return view("Examination::index",$data);
    }

    /**
     * @DateOfCreation         31 January 2019
     * @ShortDescription       This function loads the list of available examinations user side
     * @return                 View
     */
    public function getExamsListUserSide()
    {
        $data['examinations']= Examination::get()->toArray();
        return view("Examination::user.list",$data);
    }

    /**
     * @DateOfCreation      31 January 2019
     * @ShortDescription    This function displays the form to add examination
     * @param               $id
     * @return              View
     */
    public function getExamination($id=NULL)
    {
        if (!empty($id)) {
            $id = Crypt::decrypt($id);
            $examinations = Examination::where('id',$id)->select('examination_name','id')->get()->toArray();
            return view('Examination::add', ['examinations'=>$examinations]);
        } else {
            return view("Examination::add");
        }
    }

    /**
    * @DateOfCreation      31 January 2019
    * @ShortDescription    This function handles add examination form submission
    * @param               Request $request Array containing request data
    * @param               $id
    * @return              View
    */
    public function postExamination(Request $request,$id=NULL)
    {
        $rules = array(
            'examination_name'            => 'required|unique:examinations',
        );
         if(!empty($id)){
            $id = Crypt::decrypt($id);
            //$rules['examination_name']     = 'required|unique:examinations,examination_name,'.$id.',id';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $request->examination_name = preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $request->examination_name);
            $formData = [
                'examination_name'=> strtoupper($request->examination_name)
            ];
            try{
                if(empty($id)){
                    Examination::create($formData);
                    return redirect('examination')->with('status','examination Added Successfully');
                }
                else{
                    Examination::where('id',$id)->update($formData);
                    return redirect('examination')->with('status','examination Updated Successfully');
                }
            }catch(Exception $e){
               return redirect()->back()->with("error",' The examination name has already been taken ');
            }            
        }
    }

    /**
    * @DateOfCreation      31 January 2019
    * @ShortDescription    This function displays the examination detail of specified id
    * @param               $id
    * @return              View
    */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $examinations = Examination::where('id',$id)->select('examination_name','id')->get()->toArray();
        return view('Examination::show', ['examinations'=>$examinations]);
    }

    /**
    * @DateOfCreation      31 January 2019
    * @ShortDescription    This function displays list of test of the examination
    * @param               $id
    * @return              View
    */
    public function showTest($id)
    {
        $data['test'] = DB::table('mock_tests')->distinct('test_name')->select('test_name','examination_id')->get();
        return view("Examination::user.testList",$data);
    } 

     /**
    * @DateOfCreation      1 January 2019
    * @ShortDescription    This function displays list of test of the examination
    * @param               $id
    * @return              View
    */
    public function testInstructions($test_name)
    {
        $data['test'] = $this->mochtestObj->selectSectionName($test_name);
        return view("Examination::user.testInstructions",$data);
    }

   /**
    * @DateOfCreation      1 January 2019
    * @ShortDescription    This function displays list of test of the examination
    * @param               $id
    * @return              View
    */
    public function importantInstructions($examination_id, $section_id)
    {
        return view("Examination::user.importantInstructions");
    } 
}
