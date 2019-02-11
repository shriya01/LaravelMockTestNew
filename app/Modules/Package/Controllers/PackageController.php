<?php
namespace App\Modules\Package\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Validator,Crypt;

/**
 * Package Controller 
 * @package                LaravelMockTest
 * @subpackage             PackageController
 * @category               Controller
 * @DateOfCreation         6-Feb-2019
 * @ShortDescription       This class handles package related operations 
 */
class PackageController extends Controller
{
    public function __construct()
    {
    	$this->packageObj = new Package;
    }

    /**
     * @DateOfCreation  `   6-Feb-2019
     * @ShortDescription    This function displays the availble packages
     * @return              View
     */
    public function index()
    {
    	$data['packages'] = $this->packageObj->getPackages();
        return view("Package::index",$data);
    }

    /**
     * @DateOfCreation  `   6-Feb-2019
     * @ShortDescription    This function displays the form to add package
     * @return              View
     */
    public function getPackage($id = null)
    {
        if (!empty($id)) {
            $id = Crypt::decrypt($id);
            $data['packages'] = Package::where('id',$id)->get()->toArray();
            return view("Package::add",$data);
        } else {
            return view("Package::add");
        }
    }

    /**
     * @DateOfCreation  `   6-Feb-2019
     * @ShortDescription    This function handles submission of the add package form
     * @param               Request $request [ Request Array Containing Request ]
     * @return              View
     */
    public function postPackage(Request $request)
    {
        $rules = array(
            'package_name'             => 'required|unique:packages',
            'package_type'            => 'required',
            'package_price'            => 'required|numeric',
            'package_validity'            => 'required|numeric',
        );
         if(!empty($request->id)){
            $id = Crypt::decrypt($request->id);
            $rules['package_name']     = 'required|unique:packages,package_name,'.$id.',id';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
           return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
           $formData = [
           'package_name'             => $request->package_name,
            'package_type'            => $request->package_type,
            'package_price'            => $request->package_price,
            'package_validity'            => $request->package_validity,
           ];
           if(empty($id)){
             Package::create($formData); 
           }
           else{
              Package::where('id',$id)->update($formData);
           }
           return redirect('packages')->with('status','Package Added Successfully');
        }
    }
}
