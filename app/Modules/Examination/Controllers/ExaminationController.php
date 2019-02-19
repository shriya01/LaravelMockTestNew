<?php

namespace App\Modules\Examination\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Examination;
use Crypt,Exception;
use App\Models\MockTest;
use App\Models\QuestionSet;

use Validator,DB,Carbon;

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
     * @DateOfCreation      31 January 2019
     * @ShortDescription    Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->mochtestObj = new MockTest();
        $this->questionsSetObj = new QuestionSet;
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
        $rules['examination_name']     = 'required|unique:examinations,examination_name,'.$id.',id';
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
        $data['test'] = DB::table('mock_tests')->distinct('test_name')->select('test_name','examination_id')->where('examination_id',$id)->get();
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
        $test_name = ucwords($test_name);
        $test_name = str_replace('-', ' ', $test_name);
        $data['test'] = $this->mochtestObj->selectMockTestData($test_name);
        $total_questions = 0; $total_time = 0; $total_marks=0;
        foreach ($data['test'] as $key => $value) {
            $total_questions +=  $value->max_question;
            $total_time +=  $value->max_time;
            $total_marks += $value->max_marks;
        }
        $data['total_time'] = $total_time;
        $data['total_questions'] = $total_questions;
        $data['total_marks'] = $total_marks;
        $data['test_name'] = strtoupper($test_name);
        return view("Examination::user.testInstructions",$data);
    }

    /**
     * @DateOfCreation      1 January 2019
     * @ShortDescription    This function displays list of test of the examination
     * @param               $id
     * @return              View
     */
    public function importantInstructions()
    {
        echo '
        <div class="panel-heading"><b>Other Important Instructions</b></div>
        <div class="panel-body">
        <h4><b>Read the following Instruction carefully:</b></h4>
        <ul>
         <li><h4>This test comprises of multiple-choice questions.</h4></li>
        <li><h4>Each question will have only one of the available options as the correct answer.</h4></li>
        <li><h4>You are advised not to close the browser window before submitting the test.</h4></li>
        <li><h4>In case, if the test does not load completely or becomes unresponsive, click on browser refresh button to reload.</h4></li>
        </ul>
        <h4><b>Marking Scheme:</b></h4>
        <ul>
        <li><h4>1 mark(s) will be awarded for each correct answer.</h4></li>
        <li><h4>0.25 mark(s) will be deducted for every wrong answer.</h4></li>
        <li><h4>No marks will be deducted/awarded for un-attempted questions</h4></li>
        </ul>
        <h5>
        <b>Choose your default Language</b>
        <select id="drop">
        <option value="">Select your Language</option>
        <option value="english">English</option>
        <option value="hindi"> Hindi</option>
        </select>
        <span>Please note that all question will appear in your default language. This language can not be changed after-words.</span>
        </h5>
        <h5 class="pad10">
        <input type="checkbox" name="" value="" id="checkbeforeexam" class="checkboxset">&nbsp; I have read and understood all the instructions. I understand that using unfair means of any sort for any advantage will lead to immediate disqualification. The decision of ixambee.com will be final in these matters.
        </h5>
        <a href="#" class="pull-left btn btn-primary  btn-sm mr-2" align="left"><<--Previous</a>
        <a id="loadQuestion" class="pull-right btn btn-primary  btn-sm mr-2" align="right">I an ready to begin--->>></a>
        </div>
       
        ';
    } 

    /**
     * @DateOfCreation      13 Feb 2019
     * @ShortDescription    This function displays list of question of the examination
     * @param               $id
     * @return              View
     */
    public function loadQuestions(Request $request)
    {
        $test_name =  $request->test_name;
        $mock_tests = MockTest::get()->where('test_name',$test_name);
        $i=1;
        $array = [];
        foreach ($mock_tests as $key => $value){
            /*$questions =  $value->questions;
            $questions = json_decode($questions,true);
            foreach ($questions as $key => $value) {
                $questions_array = QuestionSet::get()->where('id',$value)->toArray();
                $key_new =  $key+1;
                $output  = '';
                $output .= "<button style='width:50px;' type='button' class='btn btn-sm btn-default question_switch' value=".$value.">$i</button>";
                if( $key%5 == 0 )
                {
                   echo "<br />";                                    
                }
                echo $output;
                $i++;*/
                array_push($array, ['section_id'=>$value->section_id]);

            }

            echo json_encode($array);
        
    }

    /**
     * @DateOfCreation      14 Feb 2019
     * @ShortDescription    This function loads the specified question
     * @param               Request $request s
     * @return              View
     */
    public function loadQuestionByID(Request $request)
    {
        $id = $request->id;
        $questions = $this->questionsSetObj->getQuestionsById($id);
        foreach ($questions as $key => $value) {
            $output = '';
            $output.= '<h3>Directions : '.$value->direction_set_name.'</h3>';
            $output.= '<h4>Question : '.$value->question.'</h4>';
            for($column="A"; $column <= "E"; $column++){
                $columnName = "option_".$column;        
                $output.= '<input type="checkbox">'.$value->$columnName.'</input><br/>';
            }
            echo $output;
        }
    }

    public function loadQuestionBySection(Request $request)
    {
        $test_name =  $request->test_name;
        $section_id = $request->section_id;
        $whereArray = ['test_name' => $test_name, 'section_id'=> $section_id];
        $mock_tests = DB::table('mock_tests')
                            ->where($whereArray)
                            ->get();
        $i=1;
        foreach ($mock_tests as $key => $value){
            $questions =  $value->questions;
            $questions = json_decode($questions,true);
            foreach ($questions as $key => $value) {
                $questions_array = QuestionSet::get()->where('id',$value)->toArray();
                $key_new =  $key+1;
                $output  = '';
                $output .= "<button style='width:50px;' type='button' class='btn btn-sm btn-default question_switch' value=".$value.">$i</button>";
                if( $key%5 == 0 )
                {
                   echo "<br />";                                    
                }
                echo $output;
                $i++;
            }
        }
    }
}
