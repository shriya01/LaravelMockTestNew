<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class MockTest extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section_id','examination_id','test_name','max_question','max_time','max_marks','is_switchable','negative_marks'
    ];

    /**
     * @DateOfCreation      4-March-2019
     * @ShortDescription    This function retrieves the availble mock test based on name
     * @param               $test_name [Name of the test]
     * @return              Database Collection Object 
     */
    public function getMockTests($mock_tests)
    {
        return DB::table('mock_tests')
               ->join('sections', 'mock_tests.section_id', '=', 'sections.id')
               ->select('mock_tests.section_id','section_name','mock_tests.test_id as id','max_question')
               ->where('test_name',$mock_tests)
               ->get();
    }

    /**
     * @DateOfCreation      4-March-2019
     * @ShortDescription    This function retrieves the availble mock test based on name
     * @param               $test_name [Name of the test]
     * @return              Database Collection Object 
     */
    public function selectMockTestData($test_name)
    {
       return $sectionsName = DB::table('mock_tests')
                            ->Join('sections', 'mock_tests.section_id', '=', 'sections.id')
                            ->select('section_id', 'section_name', 'max_question', 'max_time','test_id','max_marks')
                            ->where('mock_tests.test_name',$test_name)
                            ->get();                      
    }

    /**
     * @DateOfCreation      4-March-2019
     * @ShortDescription    This function retrieves the availble mock test in database based on filters
     * @param               $where_array [Array of conditions to filter data]
     * @return              Database Collection Object
     */
    public function getTestByFilters($whereArray)
    {
        return DB::table('mock_tests')
                            ->where($whereArray)
                            ->get();
    }
}
