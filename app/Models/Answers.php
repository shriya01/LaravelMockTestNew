<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Answers
 * @package                LaravelMockTest
 * @subpackage             CategoryController
 * @category               Model
 * @DateOfCreation         10 Dec 2018
 * @ShortDescription       This class handles answer related database queries and operations 
 */
class Answers extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id','answer'
    ];

    /**
     * @DateOfCreation  `   24-Jan-2019
     * @ShortDescription    This function retrieves the availble answers from database
     * @return              View
     */
    public function getAnswers($id)
    {
        return DB::table('answers')
               ->join('question_sets', 'answers.question_id', '=', 'question_sets.id')
               ->where('question_id',$id)
               ->get();
    }
}
