<?php
namespace App\Modules\Auth\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Config;
use App\Models\Users;
use App\Models\EmailTokens;
use Crypt,Mail;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
 * @DateOfCreation         07 Jan 2019
 * @ShortDescription       This controller deals with the register functionality.
 * @return                 View
 */
class RegisterController extends Controller
{
    use RegistersUsers;
    
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * @DateOfCreation         07 Jan 2019
     * @ShortDescription       This function displays the registration form.
     * @return                 View
     */
    public function getRegister()
    {
        return view('Auth::register');
    }

    /**
     * @DateOfCreation         07 Jan 2019
     * @ShortDescription       This function handles the submission of the register form 
     * @param                  Illuminate\Http\Request  $request [Request Array Contains The Form Data]
     * @return                 View
     */
    public function postRegister(Request $request)
    {
        $rules = array(
            'first_name'            => 'required|min:3|max:50',
            'last_name'             => 'required|min:3|max:50',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|same:password_confirmation',
            'password_confirmation' => 'required|same:password'
        );
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        } else {

            //Insert Data Into Database Start
                $userData = array(
                    'first_name' => $request->input("first_name"),
                    'last_name' => $request->input("last_name"),
                    'user_id' => Config::get('constants.USER_ROLE'),
                    'email' => $request->input("email"),
                    'password' => bcrypt($request->input("password")),
                    'signup_type'   => 'Web',
                    'user_created_at' => date('Y-m-d H:i:s'),
                    'user_updated_at'   => date('Y-m-d H:i:s'),
                    'user_status' => Config::get('constants.ACTIVE_STATUS')
                );
            //Insert Data Into Database End
                
            $user = Users::create($userData);
            $userToken = $this->alphanumericString(Config::get('constants.TOKEN_LENGTH'));
            $userToken = $userToken['result'];
            $verifyUser = EmailTokens::create([
                'user_id' => $user->id,
                'user_token'  => $userToken,
            ]);
            $user_id= $verifyUser->user_id;
            $user_id = Crypt::encrypt($user_id);
            $verifyUrl = url('user/verify/'.$user_id.'/'.$verifyUser->user_token);
            $mailVarify = array( "verifyUrl" => $verifyUrl);
            Mail::send('emails.verifyUser', $mailVarify, function($message) use ($userData)
            {
                $message->to($userData['email'])->subject(trans('Auth::messages.REG_EMAIL_SUBJECT'));
            });
            if ($response = $this->registered($request, $userData)) {
                return $response;
            }
        }
    }

    /**
     * @DateOfCreation        07 Jan 2019
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

    /**
     * @DateOfCreation        07 Jan 2019
     * @ShortDescription      This function is used to tell user that they are registered but not
     *                        verified yet
     * @param1                Illuminate\Http\Request  $request [Request Array Contains The Form Data]
     * @param2                [type]  $user
     * @return                Response    
     */
    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/')->with('status', trans('Auth::messages.USER_VERIFY_SUCCESS'));
    }

    /**
     * @DateOfCreation         07 Jan 2019
     * @ShortDescription       This function checks whether the user is verified or not
     * @param1                 [string]  $user_id    [Encrypted Id Of User]
     * @param2                 [string]  $token      [Token To verify]
     * @return                 [type]        [description]
     */
    public function verifyUser($user_id, $user_token)
    {
        $userId = Crypt::decrypt($user_id);
        $verifyUser = EmailTokens::where('user_token', $user_token)->where('status','=',Config::get('constants.DEACTIVE_STATUS'))->first();
        if (!empty($verifyUser)) {
            $userData = [
                    'status'  => Config::get('constants.ACTIVE_STATUS'),
                ]; 
            $statusUpdate = [
                    'verify_email'  => Config::get('constants.ACTIVE_STATUS'),
                    'updated_at'    => date('Y-m-d H:i:s'),
                ]; 
            $userToken = $verifyUser->user_token;
            $updateStatus = EmailTokens::where(array('user_token' => $userToken))->update($userData);
            $updateUser = Users::where(array('id' => $userId))->update($statusUpdate);
            $status = trans('Auth::messages.EMAIL_VERIFY_SUCCESS');         
        } 
        else{
            $status = trans('Auth::messages.ALREADY_VERIFY_USER');
        }
        return redirect('/')->with('status', $status);
    }
}
