<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistreerController extends Controller
{
	public function getRegistreer()
	{
		return view('registreer');
	}

	public function postRegistreer()
	{
        $input = Input::all();
		$rules = array('emailadres' => 'required|unique:users|email', 'password' => 'required');
        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return redirect('/registreer')
            ->withInput()
            ->withErrors($validator);
        }

        $password = $input["password"];
        $password = Hash::make($password);
        $user = new User;
        $user->emailadres = $input['emailadres'];
        $user->password = $password;
        $user->save();     

        $credentials = array('emailadres' => $input['emailadres'], 
                             'password'   => $input['password']);

        if(Auth::attempt($credentials))
        {
            return redirect('/dashboard');
        } 

        
	}
}