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
        if(Auth::user())
        {
            return redirect('dashboard')->with('error', 'Je bent al ingelogd!');
        }
        else
        {
		    return view('registreer');
        }
	}

	public function postRegistreer()
	{
        $input = Input::all();
		$rules = array('emailadres' => 'required|unique:users|email', 'paswoord' => 'required');
        $messages = array('required' => 'Gelieve het veld :attribute niet open te laten',
                          'unique' => 'Dit emailadres bestaat al, gelieve naar de login-pagina te gaan');
        $validator = Validator::make($input, $rules, $messages);

        if($validator->fails())
        {
            return redirect('/registreer')
            ->withInput()
            ->withErrors($validator);
        }

        $password = $input["paswoord"];
        $password = Hash::make($password);
        $user = new User;
        $user->emailadres = $input['emailadres'];
        $user->password = $password;
        $user->save();     

        $credentials = array('emailadres' => $input['emailadres'], 
                             'password'   => $input['paswoord']);

        if(Auth::attempt($credentials))
        {
            return redirect('/dashboard');
        } 

        
	}
}