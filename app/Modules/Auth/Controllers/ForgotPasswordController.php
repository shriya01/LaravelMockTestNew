<?php
namespace App\Modules\Auth\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Validator,Config,Crypt,Mail;
use App\Models\Users;
use App\Models\EmailTokens;

/**
 * @DateOfCreation         08 Jan 2019
 * @ShortDescription       This controller deals with the forgot password functionality.
 * @return                 View
 */
class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    /**
    * @DateOfCreation         08 Jan 2019
    * @ShortDescription       Load the forgot password view
    * @return                 View
    */
    public function getForgotPassword()
    {
        return view('Auth::forgotpassword');
    }
    /**
    * @DateOfCreation      08 Jan 2019
    * @ShortDescription    Send a reset link to the given user.
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
    */
    public function sendResetLinkEmail(Request $request)
    {
        $rules = ['email'    => 'required|email'];
        // Set validator
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            // Redirect our user back to the form with the errors from the validator
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {
            $userData = Users::where(['email' => $request->input('email')])->first();
            if (!empty($userData)) {
                $user_id= $userData->id;
                // Send welcome email here
                $userToken = $this->alphanumericString(Config::get('constants.TOKEN_LENGTH'));
                $userToken = $userToken['result'];
                $resetPassword = EmailTokens::create([
                        'user_id'    => $user_id,
                        'user_token' => $userToken,
                        'email_type' => Config::get('constants.PASSWORD_RESET'),
                        ]);
                $user_id = Crypt::encrypt($user_id);
                $verifyUrl = url('user/reset-password/'.$user_id.'/'.$resetPassword->user_token);
                $mailVarify = ["verifyUrl" => $verifyUrl];
                Mail::send('emails.password', $mailVarify, function ($message) use ($userData) {
                    $message->to($userData['email'])->subject(trans('Auth::messages.RESET_EMAIL_SUBJECT'));
                });
                return redirect("/")->with(array("message"=> trans('Auth::messages.SEND_EMAIL_LINK')));
            } else {
                return redirect()->back()->with('status', trans('Auth::messages.USER_NOT_EXIST'));
            }
        }
    }
    /**
    * @DateOfCreation         08 Jan 2019
    * @ShortDescription       This function is used to tell user that they are registered but not
    *                         verified yet
    * @param  Request $request
    * @param  [type]  $user
    */
    protected function registered(Request $request, $user)
    {
        return redirect('/')->with('status', trans('Auth::messages.USER_PASSWORD_RESET_LINK'));
    }


    /**
     * @DateOfCreation        08 Jan 2019
     * @ShortDescription      This function is used to generate alphanumeric string
     * @param                 Integer $length (Default length is 6)
     * @return                Generated alphanumeric string
     */
    public function alphanumericString($length = 6) {
        $alphaNumericString = '';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < $length; $i++) {
            $alphaNumericString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return ['code' => '1000','message' => __('messages.1014'),'result' => $alphaNumericString];
    }
}
