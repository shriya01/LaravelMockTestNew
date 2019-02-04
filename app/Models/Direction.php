<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    public function getdirections($id = null)
    {
        $query =  DB::table('direction_set')->get();
        if(!empty($id))
        {
            $query =  DB::table('direction_set')->where('id',$id)->get();
        }
        return $query;
    }

    public function insertData($insert_array)
    {
        return DB::table('direction_set')->insert($insert_array);
    }

     public function updateData($insert_array,$where_array)
    {
        return DB::table('direction_set')->where($where_array)->update($insert_array);
    }
}
