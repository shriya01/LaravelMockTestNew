<?php

namespace App\Modules\Dashboard\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth,Session;

class DashboardController extends Controller
{
    /**
     * @DateOfCreation       14-Jan-2019
     * @ShortDescription     This function initializes object of the class.
     */
    public function __construct()
    {
        if (!empty(Auth::user()) &&  Auth::user()->user_id != Config::get('constants.ADMIN_ROLE')){
            return redirect('admin');
        }
    }

    /**
     * @DateOfCreation       14-Jan-2019
     * @ShortDescription     This function display the dashboard page.
     * @return              \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Dashboard::index");
    }

    /**
     * @DateOfCreation         20 Dec 2018
     * @ShortDescription       change the language according to the input 
     * @return                 Response
     */
    public function postChangeLanguage($local) 
    {
        Session::put('locale', $local);
        return redirect()->back();
    }
}
