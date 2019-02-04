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
class LoginController extends Controller
{
    public function __construct()
    {
       $this->middleware('guest');
    }
    /**
     * @DateOfCreation         07 Jan 2019
     * @ShortDescription       Load the login view
     * @return                 View
     */
    public function getLogin()
    {
        return view('Auth::login');
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
            );
        }
        if (Auth::attempt($inputData)) {
            return redirect("home")->with(array("message"=>__('messages.login_success')));
        } else {
            $checkData = ['email'=> $inputData['email'],'user_id'=>Config::get('constants.USER_ROLE')];
            if(Users::where($checkData)->count()>0){
                $validator->getMessageBag()->add('password', __('messages.wrong_password'));
            } else {
                $validator->getMessageBag()->add('email', __('messages.account_not_exist'));
            }
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
    }
    
    /**
     * @DateOfCreation         07 Jan 2019
     * @ShortDescription       This function helps user to logout of the application
     * @return                 Response
     */
    public function loginWithGoogle(Request $request)
    {
        // get data from request
        $code = $request->get('code');
        
        // get google service
        $googleService = \OAuth::consumer('Google');
        
        // check if code is valid
        
        // if code is provided get user data and sign in
        if ( ! is_null($code))
        {
            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken($code);
            
            // Send a request with it
            $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);
        
            //Insert Data Into Database Start
                $userData = array(
                    'first_name' => $result['given_name'],
                    'last_name' => $result['family_name'],
                    'user_id' => Config::get('constants.USER_ROLE'),
                    'email' => $result['email'],
                    'password' => bcrypt('Google'.$result['email']),
                    'signup_type'   => 'Google',
                    'user_created_at' => date('Y-m-d H:i:s'),
                    'user_updated_at'   => date('Y-m-d H:i:s'),
                    'user_status' => Config::get('constants.ACTIVE_STATUS')
                );
            //Insert Data Into Database End

            $inputData = array(
                'email'=>$result['email'],
                'password'=>'Google'.$result['email'],
            );
            $checkData = ['email'=> $result['email'],'signup_type'=>'Google'];
            if(Users::where($checkData)->count()==0){
                Users::create($userData);
            }
            if (Auth::attempt($inputData)) {
                return redirect("home")->with(array("message"=>__('messages.login_success')));
            }
        }
        // if not ask for permission first
        else
        {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri()."&prompt=select_account";
            
            // return to google login url
            return redirect((string)$url);
        }
    }

    
    /**
     * @DateOfCreation         07 Jan 2019
     * @ShortDescription       This function helps to login with github
     * @return                 Response
     */
    public function loginWithGithub(Request $request)
    {
        // Get data from request
        $code = $request->get('code');

        // Get GitHub service
        $githubService = \OAuth::consumer('GitHub');

        // check if code is valid
        // if code is provided get user data and sign in
        if ( ! is_null($code))
        {
            // This was a callback request from google, get the token
            $token = $githubService->requestAccessToken($code);
            // Send a request with it
            $result = json_decode($githubService->request('user/emails'), true);

            //Insert Data Into Database Start
                $userData = array(
                    'first_name' => '',
                    'last_name' => '',
                    'user_id' => Config::get('constants.USER_ROLE'),
                    'email' => $result[0],
                    'password' => bcrypt('Github'.$result[0]),
                    'signup_type'   => 'Github',
                    'user_created_at' => date('Y-m-d H:i:s'),
                    'user_updated_at'   => date('Y-m-d H:i:s'),
                    'user_status' => Config::get('constants.ACTIVE_STATUS')
                );
            //Insert Data Into Database End

            $inputData = array(
                'email'=>$result[0],
                'password'=>'Github'.$result[0],
                'signup_type'   => 'Github',
            );
            $checkData = ['email'=> $result[0],'signup_type'=>'Github'];
            if(Users::where($checkData)->count()==0){
                Users::create($userData);
            }
            if (Auth::attempt($inputData)) {
                return redirect("home")->with(array("message"=>__('messages.login_success')));
            }
        }
        // if not ask for permission first
        else
        {
            // get GithubService authorization
            $url = $githubService->getAuthorizationUri()."&prompt=select_account";
            // return to google login url
            return redirect((string)$url);
        }
    }
    
    /**
     * @DateOfCreation         07 Jan 2019
     * @ShortDescription       This function helps to login with facebook
     * @return                 Response
     */
    public function loginWithFacebook(Request $request)
    {
        // get data from request
        $code = $request->get('code');

        // get fb service
        $fb = \OAuth::consumer('Facebook');

        // check if code is valid
        // if code is provided get user data and sign in
        if ( ! is_null($code))
        {
            // This was a callback request from facebook, get the token
            $token = $fb->requestAccessToken($code);

            // Send a request with it
            $result = json_decode($fb->request('/me?locale=en_US&fields=name,email'), true);

            //Insert Data Into Database Start
                $userData = array(
                    'first_name' => $result['name'],
                    'last_name' => '',
                    'user_id' => Config::get('constants.USER_ROLE'),
                    'email' => $result['email'],
                    'password' => bcrypt('Facebook'.$result['email']),
                    'signup_type'   => 'Facebook',
                    'user_created_at' => date('Y-m-d H:i:s'),
                    'user_updated_at'   => date('Y-m-d H:i:s'),
                    'user_status' => Config::get('constants.ACTIVE_STATUS')
                );
            //Insert Data Into Database End

            $inputData = array(
                'email'=>$result['email'],
                'password'=>'Facebook'.$result['email'],
                'signup_type'   => 'Facebook',
            );
            $checkData = ['email'=> $result['email'],'signup_type'=>'Facebook'];
            if(Users::where($checkData)->count()==0){
                Users::create($userData);
            }
            if (Auth::attempt($inputData)) {
                return redirect("home")->with(array("message"=>__('messages.login_success')));
            }  
        }
        else
        {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
            return redirect((string)$url);
        }
    }


}
