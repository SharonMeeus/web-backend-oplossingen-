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
		if(Auth::user())
        {
            return redirect('dashboard')->with('error', 'Je bent al ingelogd!');
        }
        else
        {
			return view('login');
		}
	}

	public function postLogin()
	{
		$rules = array('emailadres' => 'required', 'paswoord' => 'required');
		$messages = array('required' => 'Gelieve het veld :attribute niet open te laten');
		$validator = Validator::make(Input::all(), $rules, $messages);

		if($validator->fails())
		{
			return redirect('/login')
            ->withInput()
            ->withErrors($validator);
		}

		$auth = Auth::attempt(array(

			'emailadres' => Input::get('emailadres'),
			'password'=> Input::get('paswoord')

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
		if(!Auth::user())
        {
            return redirect('login')->with('error', 'Gelieve eerst in te loggen');
        }
        else
        {
			Auth::logout();
			return redirect('/home');
		}
	}
}