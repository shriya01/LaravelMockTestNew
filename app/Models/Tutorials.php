<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Tutorials extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_id','tutorial_name','is_deleted'
    ];

      public function getTutorials()
    {
        return DB::table('tutorials')
               ->join('sections', 'tutorials.section_id', '=', 'sections.id')
               ->get();
    }
}
