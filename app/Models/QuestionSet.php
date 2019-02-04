<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class QuestionSet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_id','category_id','option_A','option_B','option_C','option_D','option_E','question','correct_option_value'
    ];
}
