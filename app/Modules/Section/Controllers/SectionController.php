<?php
namespace App\Modules\Section\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Validator,Auth,Crypt,Exception;

/**
 * SectionController
 *
 * @package                LaravelMockTest
 * @category               Controller
 * @DateOfCreation         30 January 2019
 * @ShortDescription       SectionController contains section module related functions
 */
class SectionController extends Controller
{
    /**
     * @DateOfCreation         30 January 2019
     * @ShortDescription       This function loads the list of available sections
     * @return                 View
     */
    public function getSectionList()
    {
        $data['sections']= Section::get()->where('is_deleted',2)->toArray();
        return view("Section::view",$data);
    }

    /**
     * @DateOfCreation      30 January 2019
     * @ShortDescription    This function displays the form to add section
     * @param               $id
     * @return              View
     */
    public function getSection($id=NULL){
        if (!empty($id)) {
            $id = Crypt::decrypt($id);
            $sections = Section::where('id',$id)->select('section_name','id')->get()->toArray();
            return view('Section::add', ['sections'=>$sections]);
        } else {
            return view("Section::add");
        }
    }

    /**
     * @DateOfCreation      30 January 2019
     * @ShortDescription    This function handles add section form submission
     * @param               Request $request Array containing request data
     * @param               $id
     * @return              View
     */
    public function postSection(Request $request,$id=NULL)
    {
        $rules = array(
            'section_name'            => 'required|unique:sections',
        );
         if(!empty($id)){
            $id = Crypt::decrypt($id);
            $rules['section_name']     = 'required|unique:sections,section_name,'.$id.',id';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $request->section_name = preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $request->section_name);
            $formData = [
                'section_name'=>$request->section_name
            ];
            try{
                if(empty($id)){
                    Section::create($formData);
                    return redirect('section')->with('status','Section Added Successfully');
                }
                else{
                    Section::where('id',$id)->update($formData);
                    return redirect('section')->with('status','Section Updated Successfully');
                }
            }catch(Exception $e){
               return redirect()->back()->with("error",' The section name has already been taken ');
            }            
        }   
    }
    
    /**
     * @DateOfCreation      30 January 2019
     * @ShortDescription    This function displays the section detail of specified id
     * @param               $id
     * @return              View
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $sections = Section::where('id',$id)->select('section_name','id')->get()->toArray();
        return view('Section::show', ['sections'=>$sections]);
    }
}