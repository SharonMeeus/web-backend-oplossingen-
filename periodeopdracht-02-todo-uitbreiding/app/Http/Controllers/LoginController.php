<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	public function getLogin()
	{
		return view('login');
	}

	public function postLogin()
	{
		$rules = array('emailadres' => 'required', 'password' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails())
		{
			return redirect('/login')
            ->withInput()
            ->withErrors($validator);
		}

		$auth = Auth::attempt(array(

			'emailadres' => Input::get('emailadres'),
			'password'=> Input::get('password')

		), false);

		if(!$auth)
		{
			return redirect('/login')
            ->withInput()
            ->withErrors('Je hebt een onjuist emailadres of wachtwoord ingegeven...');
		}

		return redirect('/dashboard');


	}

	public function getLogout()
	{
		Auth::logout();
		return redirect('/home');
	}
}