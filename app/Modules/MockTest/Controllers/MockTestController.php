<?php

namespace App\Modules\MockTest\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MockTest;
use App\Models\Section;
use App\Models\Category;
use App\Models\QuestionSet;
use App\Models\Direction;

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
        public function __construct()
    {
        $this->directionObj = new Direction;
    }
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
        $data['test_name'] = $test_name;
        $data['sections'] = Section::get();
        $data['examinations'] = Examination::get();
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
            'max_question'                => 'required',
            'max_time'                    => 'required',
            'max_marks'                   => 'required',
            'is_switchable'               => 'required'  
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
            $max_time = $request->max_time;
            $max_marks = $request->max_marks;
            foreach ($sections as $key => $value) {
                $formData = [
                    'examination_id'=>$request->examination_name,
                    'section_id'    => $value,
                    'max_question'  => $max_questions[$key],
                    'max_time'      => $max_time[$key],
                    'max_marks'      => $max_marks[$key],
                    'test_name'     => strtoupper($request->test_name),
                    'is_switchable'               => $request->is_switchable,
                    'negative_marks'               => $request->negative_marks
                ];
                MockTest::create($formData);
            }
            return redirect('mock-test')->with('status','Mock Test Added Successfully');
        }
    }

    public function getCategoriesBySection(Request $request)
    {
        $id =  $request->id;
        $output = '';
        $data['sections'] = Category::get()->where('section_id',$id)->toArray();
        $output .='<option value="">Select Categories</option>';
        foreach($data['sections'] as $row => $value)
        {
          $output .= '<option value="'.$value['id'].'">'.$value['category_name'].'</option>';
        }
        echo $output;
    }

    /**
    * @DateOfCreation       24 Jan 2019
    * @ShortDescription This function displays question list.
    * @param                $id [Section Id]
    * @return               View
    */
    public function showQuestionsByCategory(Request $request)
    {
        $section_id = $request->section_id;
        $id = $request->category_id;
        $questions = QuestionSet::get()->where('section_id',$section_id)->where('category_id',$id);
        $data['directions'] =  $this->directionObj->getdirections(['category_id'=>$id]);
        $output = '';
        $output .='<button id="ques">Add Selected Question</button>
        <table width="50%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
        <tr>
        <th></th>
        <th>Question</th>
        </thead><tbody>';
        if(isset($questions)){                   
            foreach($questions as $key){
                $output.='<tr class="odd gradeX">';
                $output.='<td width="10%"><input type="checkbox" class="check" value='.$key->id.' name="questions[]"></td>';
                $output .= '<td width="90%">'.$key->question.'</td>';
                $output.="</tr>";
            }
        }
        $output.=" </tbody>
        </table>
        ";
        echo $output;
    }

    /**
     * @DateOfCreation       24 Jan 2019
     * @ShortDescription This function displays question list.
     * @param                $id [Section Id]
     * @return               View
     */
    public function addQuestions(Request $request)
    {
        $questions = $request->questions;
        $questions_array =  (explode(" ",$questions));
        $questions_json =  json_encode($questions_array);
        $formData = [
                      'test_name' =>$request->test_name,
                      'questions' => $questions_json 
                    ];
        $request->section_id;
        MockTest::where(['test_name'=>$request->test_name,'section_id'=>$request->section_id])->update($formData);
    }
}
