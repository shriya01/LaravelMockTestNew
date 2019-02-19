<?php
namespace App\Modules\QuestionSets\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\QuestionSet;
use App\Models\Direction;
use App\Models\AnswerImage;
use App\Models\Category;

use Validator,Crypt,PDF,DB;
use App\Models\Answers;

/**
* Question Sets Controller
* @package                LaravelMockTest
* @subpackage             QuestionSetsController
* @category               Controller
* @DateOfCreation         10 Dec 2018
* @ShortDescription       This class handles question set related operations 
*/
class QuestionSetsController extends Controller
{
	public function __construct()
	{
		$this->directionObj = new Direction;
				$this->questionObj = new QuestionSet;

	}
	
	/**
	 * @DateOfCreation 		24 Jan 2019
	 * @ShortDescription	This function displays question list.
	 * @param 				$id [Section Id]
	 * @return 				View
	 */
	public function index($section_id,$id)
	{
		$data['id'] = $id;
		$data['section_id'] = $section_id;
		$id = Crypt::decrypt($id);
		$section_id = Crypt::decrypt($section_id);
		$data['questions'] = QuestionSet::get()->where('section_id',$section_id)->where('category_id',$id);
		$data['directions'] =  $this->directionObj->getdirections(['category_id'=>$id]);
		return view("QuestionSets::index",$data);
	}

	/**
	 * @DateOfCreation 		24 Jan 2019
	 * @ShortDescription	This function displays question list.
	 * @param 				$id [Section Id]
	 * @return 				View
	 */
	public function questions()
	{
		$data['questions'] = QuestionSet::get();
		$data['categories'] = Category::get();
		return view("QuestionSets::view",$data);
	}

	/**
	 * @DateOfCreation 		24 Jan 2019
	 * @ShortDescription	This function displays a form to add question
	 * @param 				$id [Section Id]
	 * @return 				View
	 */
	public function getQuestion($id,$section_id,$question_id = null)
	{
		$data['id'] = $id;
		$data['section_id'] = $section_id;
		if(!empty($question_id))
		{
			$data['question_id'] =  $question_id;
			$question_id = Crypt::decrypt($question_id);
			$data['questions'] = $this->questionObj->getQuestionsById($question_id);
		}
		else
		{
			$data['directions'] =  $this->directionObj->getdirections(['category_id'=>Crypt::decrypt($id) ]);
		}
		return view("QuestionSets::add",$data);	
	}

	/**
	 * @DateOfCreation 		24 Jan 2019
	 * @ShortDescription	This function handles the submit event of add question form 
	 * @param 				Request $request
	 * @return 				Response
	 */
	public function postQuestion(Request $request)
	{
		$option_array = [];
		$values_array = [];
		for($column="A"; $column <= "E"; $column++){
			$columnName = "option_".$column;
			$values = $request->$columnName;
			array_push($option_array, $values);
		}
		$correct_option = $request->correct_option_value;
		$rules = array(
			'question'             => 'required|unique:question_sets',
			'id'                   => 'required', 
			'correct_option_value' => 'required',
			'answer'			   => 'required',
		);
		if(!empty($request->question_id))
		{
			$id = Crypt::decrypt($request->question_id);
			$rules['question']     = 'required|unique:question_sets,question,'.$id.',id';
		}
		for($column="A"; $column <= "E"; $column++){
			$columnName = "option_".$column;		
			$rules[$columnName] = 'required';
		}
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator->errors());
		} else {
			if(in_array($correct_option,$option_array)){				
				$formData = [  
					'question' => $request->question,
					'correct_option_value' => $correct_option,
					'category_id'		=> Crypt::decrypt($request->id),
					'section_id'=>Crypt::decrypt($request->section_id),
					
				];
				$i=0;
				for($column="A"; $column <= "E"; $column++){
					$columnName = "option_".$column;		
					$formData[$columnName] = $option_array[$i];
					$i++;
				}
				if(empty($id))
				{
					$formData['direction_set_id']	= $request->directions;
					$id = QuestionSet::create($formData)->id;
				}
				else
				{
					QuestionSet::where('id',$id)->update($formData);
				}
				$formData = [
					'answer'=> $request->answer,
					'question_id'=>$id
				];
				$answers = Answers::where('question_id',$id)->get()->toArray();
				if(empty($answers)){
					Answers::create($formData);
				}
				else
				{
					Answers::where('question_id',$id)->update($formData);
				}
				if($request->has('image')){
                    $file = $request->file('image');
                    $fileName =  $file->getClientOriginalName().date('y-m-d');
                    $destinationPath = public_path('images');
                    $uploadedFile = $file->move($destinationPath, $fileName);
                    	$answer_images = AnswerImage::where('question_id',$id)->get()->toArray();
					$formData = [
						'answer_image'=> $fileName,
						'question_id'=>$id
					];
					if(empty($answer_images))
					{
						AnswerImage::create($formData);
					}
                }
                if(!empty($request->question_id))
                {
					return redirect()->route('showQuestion',['section_id'=>$request->section_id,'id'=>$request->id,])->with('status','Question Updated Successfully');
                }
				return redirect()->route('showQuestion',['section_id'=>$request->section_id,'id'=>$request->id,])->with('status','Question Added Successfully');
			}
			else
			{
				return redirect()->back()->with('error','Correct Option must be from the above options');
			}
		}
	}

	/**
	 * @DateOfCreation    17 oct 2018
	 * @ShortDescription  This function generate pdf send email receipt and provide download
	 *                    and open option depends on operating system
	 * @param integer     $flat_number [flat number]
	 * @param integer     $month [month]
	 * @param integer     $email_send [whether to send email or not,default not send]
	 * @return            Response
	 */
	public function generateAndEmailPDF(Request $request)
	{
		$rules = array(
			'category_name' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);
		if ($validator->fails()) {
			return redirect()->back()->withInput()->withErrors($validator->errors());
		} else {
			$this->questionObj = new QuestionSet;
			$result = $this->questionObj->getQuestions($request->category_name);
			$data['result'] = $result;
			$pdf = PDF::loadView('pdf.questionPdf', $data);
			$file_path = $pdf->save(public_path('files/questions.pdf'));
			$pdf = $pdf->download('questions.pdf');
			return $pdf;
		}	
	}
}

