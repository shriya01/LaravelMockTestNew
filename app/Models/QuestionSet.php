<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class QuestionSet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_id','category_id','option_A','option_B','option_C','option_D','option_E','question','correct_option_value','direction_set_id'
    ];

    public function getQuestions($category_id)
    {
    	return  DB::table('question_sets')
    	->join('sections', 'question_sets.section_id', '=', 'sections.id')
		->join('answers', 'answers.question_id', '=', 'question_sets.id')
        ->join('direction_set', 'question_sets.direction_set_id', '=', 'direction_set.id')
        ->leftJoin('answer_image', 'answer_image.question_id', '=', 'question_sets.id')
        ->leftJoin('direction_image', 'direction_image.direction_set_id', '=', 'direction_set.id')
        ->orderBy('question_sets.id', 'desc')
        ->where('question_sets.category_id',$category_id)
    	->get()->toArray();

    }

    public function getQuestionsById($id)
    {
        return  DB::table('question_sets')
        ->join('sections', 'question_sets.section_id', '=', 'sections.id')
        ->join('answers', 'answers.question_id', '=', 'question_sets.id')
        ->join('direction_set', 'question_sets.direction_set_id', '=', 'direction_set.id')
        ->leftJoin('direction_image', 'direction_image.direction_set_id', '=', 'direction_set.id')
        ->orderBy('question_sets.id', 'desc')
        ->where('question_sets.id',$id)
        ->get()->toArray();

    }
}
