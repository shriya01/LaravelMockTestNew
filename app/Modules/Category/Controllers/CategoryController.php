<?php
namespace App\Modules\Category\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Validator,Crypt;
/**
 * Category Controller
 * @package                LaravelMockTest
 * @subpackage             CategoryController
 * @category               Controller
 * @DateOfCreation         10 Dec 2018
 * @ShortDescription       This class handles category related operations 
 */
class CategoryController extends Controller
{
    /**
     * @DateOfCreation  `   24-Jan-2019
     * @ShortDescription    This function displays the availble categories
     * @return              View
     */
    public function index()
    {
        $this->categoryObj = new Category;
        $data['categories'] = $this->categoryObj->getCategories()->toArray();
        return view("Category::index",$data);
    }

    /**
     * @DateOfCreation  `   24-Jan-2019
     * @ShortDescription    This function displays the availble categories
     * @return              View
     */
    public function getCategory($id=null)
    {
        $data['sections'] = Section::get();
        if (!empty($id)) {
            $id = Crypt::decrypt($id);
            $data['categories'] = Category::where('id',$id)->select('category_name','section_id','id')->get()->toArray();
            $data['sections'] = Section::get();
            return view("Category::add",$data);
        } else {
            return view("Category::add",$data);
        }
    }

    /**
     * @DateOfCreation  `   24-Jan-2019
     * @ShortDescription    This function displays the availble categories
     * @return              View
     */
    public function postCategory(Request $request)
    {
        $rules = array(
            'section_name'             => 'required',
            'category_name'            => 'required|unique:categories',
        );
         if(!empty($request->id)){
            $id = Crypt::decrypt($request->id);
            $rules['category_name']     = 'required|unique:categories,category_name,'.$id.',id';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
           return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
           $formData = [
            'section_id' => $request->section_name,
           'category_name'=>$request->category_name
           ];
           if(empty($id)){
             Category::create($formData); 
           }
           else{
              Category::where('id',$id)->update($formData);
           }
           return redirect('categories')->with('status','Category Added Successfully');
        }
    }
}
