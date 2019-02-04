<?php
namespace App\Modules\Auth\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,Validator,Config;
use Session;
class HomeController extends Controller
{
    /**
     * @DateOfCreation         07 Jan 2019
     * @ShortDescription       Load the login view for admin
     * @return                 View
     */
    public function index()
    {
        return view("Auth::home");
    }
    
    /**
     * @DateOfCreation         07 Jan 2019
     * @ShortDescription       This function helps user to logout of the application
     * @return                 Response
     */
    public function getLogout()
    {
        Session::flush();
        //Auth::logout();
        return redirect('home');
    }
       
}
