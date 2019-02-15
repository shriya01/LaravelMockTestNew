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
class AnswerImage extends Model
{
	protected $table = 'answer_image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id','answer_image'
    ];
}
