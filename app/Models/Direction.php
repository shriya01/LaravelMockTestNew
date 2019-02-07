<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

/**
 * Direction
 * @package                LaravelMockTest
 * @subpackage             Direction
 * @category               Model
 * @DateOfCreation         7 feb 2019
 * @ShortDescription       This class handles direction_set table related database queries and operations 
 */
class Direction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_id','tutorial_name','is_deleted'
    ];

    /**
     * @DateOfCreation      7-feb-2019
     * @ShortDescription    This function retrieves the availble direction_set from database
     * @param               $where_array [Array of conditions to filter data]
     * @return              View
     */
    public function getdirections($where_array = null)
    {
        $query =  DB::table('direction_set')->get();
        if(!empty($where_array))
        {
            $query =  DB::table('direction_set')->where($where_array)->get();
        }
        return $query;
    }

    /**
     * @DateOfCreation      7-feb-2019
     * @ShortDescription    This function retrieves the availble answers from database
     * @return              View
     */
    public function insertData($insert_array)
    {
        return DB::table('direction_set')->insert($insert_array);
    }

    /**
     * @DateOfCreation      7-feb-2019
     * @ShortDescription    This function retrieves the availble answers from database
     * @return              View
     */
    public function updateData($insert_array,$where_array)
    {
        return DB::table('direction_set')->where($where_array)->update($insert_array);
    }
}
