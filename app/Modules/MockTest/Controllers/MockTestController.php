<?php

namespace App\Modules\MockTest\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MockTest;
use App\Models\Section;
use App\Models\Examination;
use Validator,DB;

/**
 * Mock Test Controller
 * @package                LaravelMockTest
 * @subpackage             MockTestController
 * @category               Controller
 * @DateOfCreation         10 Dec 2018
 * @ShortDescription       This class handles mock set related operations 
 */
class MockTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMockTestList()
    {
        $data['mock_tests'] = DB::table('mock_tests')->distinct('test_name')->select('test_name')->get();
        return view("MockTest::view",$data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMockTest($id=NULL)
    {
        if (!empty($id)) {
            $mocktests = MockTest::where('id',$id)->select('examination_name','id')->get()->toArray();
            return view('MockTest::add', ['mocktests'=>$mocktests]);
        } else {
        	$data['sections'] = Section::get();
        	$data['examinations'] = Examination::get();
            return view("MockTest::add",$data);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mocktest)
    {
        $test_name =  str_replace("_", "", strtoupper($mocktest)); 
        $this->mockTestObj = new  MockTest;
        $data['users'] = $this->mockTestObj->getMockTests($test_name);
        $data['mocktest'] = $mocktest;
        return view('MockTest::index',$data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postMockTest(Request $request,$id=NULL)
    {
        $rules = array(
            'test_name'                   => 'required|unique:mock_tests',
            'examination_name'            => 'required',
            'section'                     => 'required',
            'max_question'                => 'required'  
        );
         if(!empty($id)){
            $rules['test_name']     = 'required|unique:mock_tests,test_name,'.$id.',id';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $sections = $request->section;
            $max_questions = $request->max_question;
            foreach ($sections as $key => $value) {
                $formData = [
                    'examination_id'=>$request->examination_name,
                    'section_id'    => $value,
                    'max_question'  => $max_questions[$key],
                    'test_name'     => strtoupper($request->test_name)
                ];
                MockTest::create($formData);
            }
            return redirect('mock-test')->with('status','Mock Test Added Successfully');
        }
    }
}
