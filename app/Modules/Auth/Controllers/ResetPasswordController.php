<?php

namespace App\Modules\Auth\Controllers;
use App\Http\Controllers\Controller;
use Crypt,Config,Validator;
use App\Models\EmailTokens;
use App\Models\Users;
use Illuminate\Http\Request;

/**
 * @DateOfCreation         08 Jan 2019
 * @ShortDescription       This controller deals with the reset password functionality.
 * @return                 View
 */
class ResetPasswordController extends Controller
{
    /**
     * @DateOfCreation         08 Jan 2019
     * @ShortDescription       This functions loads the reset password blade
     * @return                 View
     */
    public function resetPassword($user_id, $user_token){
        $userId = Crypt::decrypt($user_id);
        $verifyUser = EmailTokens::where('user_token', $user_token)->where('status','=',Config::get('constants.DEACTIVE_STATUS'))->first();
        if (!empty($verifyUser)) {
            $userData = ['user_token' => $user_token, 'user_id' => Crypt::encrypt($userId)];
        return view('Auth::resetPassword', ['data' => $userData]);
        }
       else
       {
        return redirect("/")->with(array("message"=> trans('Auth::messages.EXPIRE')));
       }
    }

    /**
     * @DateOfCreation         06 Dec 2018
     * @ShortDescription       This controller deals with the reset password form submission.
     * @param  \Illuminate\Http\Request  $request
     * @return                 View
     */
    public function postResetPassword(Request $request)
    {
        $userId = Crypt::decrypt($request->input("user_id"));
        $userToken = $request->input("token");

        $rules = array(
            'password'  => 'required',
            'password_confirmation'  => 'required|same:password'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {    
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        else
        {                  
            $verifyUser = EmailTokens::where('user_token', $userToken)->where('status','=',Config::get('constants.DEACTIVE_STATUS'))->first();         
            if (!empty($verifyUser)) {
                $userData = ['status'  => Config::get('constants.ACTIVE_STATUS'),]; 
                $statusUpdate = ['password' => bcrypt($request->input('password')),]; 
                // Update  email_tokens table
                $updateStatus = EmailTokens::where(array('user_token' => $userToken))->update($userData);
                // Update users table
                $updateUser = Users::where(array('id' => $userId))->update($statusUpdate);
                return redirect("/")->with(array("message"=> trans('Auth::messages.PASSWORD_UPDATE_SUCCESSFULLY')));
            }
            else 
            {
                return redirect("/")->with(array("message"=> trans('Auth::messages.EXPIRE')));
            }
        }     
    }
}
