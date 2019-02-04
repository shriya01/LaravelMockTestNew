<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{

   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_id','category_name'
    ];

    public function getCategories()
    {
        return DB::table('categories')
               ->join('sections', 'categories.section_id', '=', 'sections.id')
               ->select('categories.section_id','section_name','category_name','categories.id')
               ->get();
    }

}
