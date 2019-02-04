<?php

namespace App\Modules\Profile\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator,Auth,Config;
use App\Models\Users;
class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProfileData()
    {
        $user = Auth::user();
        $data = [
                    'first_name' => $user->first_name, 
                    'last_name' => $user->last_name, 
                    'dob' => $user->date_of_birth, 
                    'qualification' => $user->qualification, 
                    'city' => $user->city,
                    'state' => $user->state, 
                    'pincode' => $user->pincode, 
                    'contact_number' => $user->contact_number 
                ];
        return view('Profile::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postProfileData(Request $request)
    {
        $user = Auth::user();
        $rules = [
            'first_name'        => 'required',
            'last_name'         => 'required',
            'dob'               =>'required|date',
            'qualification'     =>'required',
            'city'              =>'required',
            'state'             => 'required',
            'pincode'           => 'required|regex:"^\d{6}(?:[-\s]\d{4})?$"',
            'contact_number'    => 'required|regex:"^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$"'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }
        else
        {
            $inputData = [
                'first_name'        => $request->input('first_name'),
                'last_name'         => $request->input('last_name'),
                'user_id'           => Config::get('constants.USER_ROLE'),
                'date_of_birth'     => $request->input('dob'),
                'qualification'     => $request->input('qualification'),
                'city'              => $request->input('city'),
                'state'             => $request->input('state'),
                'pincode'           => $request->input('pincode'),
                'contact_number'    => $request->input('contact_number'),
            ];
            Users::where('email',$user->email)->update($inputData);
            return redirect('home')->with('status','your Profile updated successfully');
        }
    }
}
