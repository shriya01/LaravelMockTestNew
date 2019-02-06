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
class Package extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'package_name','package_type','package_price','package_validity'
    ];

    /**
     * @DateOfCreation  `   24-Jan-2019
     * @ShortDescription    This function retrieves the availble answers from database
     * @return              View
     */
    public function getPackages()
    {
        return DB::table('packages')->get();
    }
}
