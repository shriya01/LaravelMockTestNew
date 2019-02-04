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

    public function getdirections()
    {
        return DB::table('direction_set')->get();
    }
}
