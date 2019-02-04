<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
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

    public function getAnswers($id)
    {
        return DB::table('answers')
               ->join('question_sets', 'answers.question_id', '=', 'question_sets.id')
               ->where('question_id',$id)
               ->get();
    }
}
