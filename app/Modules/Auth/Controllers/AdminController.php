<?php
namespace App\Modules\Auth\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,Validator,Config;
use App\Models\Users;

/**
 * @DateOfCreation         07 Jan 2019
 * @ShortDescription       This controller deals with the login functionality.
 * @return                 View
 */
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    /**
     * @DateOfCreation         07 Jan 2019
     * @ShortDescription       Load the login view
     * @return                 View
     */
    public function getLogin()
    {
        if (!empty(Auth::user()) &&  Auth::user()->user_id == Config::get('constants.ADMIN_ROLE')){
            return redirect('dashboard');
        }
        return view('Auth::adminlogin');
    }

    /**
     * @DateOfCreation         07 Jan 2019
     * @ShortDescription       Handle a login request to the application
     * @param                  Illuminate\Http\Request  $request
     * @return                 Response
     */
    public function postLogin(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $inputData = array(
                'email'=>$request->input('email'),
                'password'=>$request->input('password'),
                'user_id'=>Config::get('constants.ADMIN_ROLE')
            );
        }
        if (Auth::attempt($inputData)) {
            return redirect("dashboard")->with(array("message"=>__('messages.login_success')));
        } else {
            $checkData = ['email'=> $inputData['email'],'user_id'=>Config::get('constants.ADMIN_ROLE')];
            if(Users::where($checkData)->count()>0){
                $validator->getMessageBag()->add('password', __('messages.wrong_password'));
            } else {
                $validator->getMessageBag()->add('email', __('messages.account_not_exist'));
            }
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }
}
