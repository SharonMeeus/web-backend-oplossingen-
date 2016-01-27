<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Todo;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ToDoController extends Controller
{

	public function getTodos()
    {
        if(!Auth::user())
        {
            return redirect('login')->with('error', 'Gelieve eerst in te loggen');
        }
        else
        {
        	$todos = Auth::user()->todos;
            $dos = 0;
            $dones = 0;
            foreach ($todos as $todo) 
            {
                if(!$todo->done)
                {
                    $dos++;
                }
                else
                {
                    $dones++;
                }
            }

            return view('todos', array('todos' => $todos, "dos" => $dos, 'dones' => $dones));
        }
    }

    public function postIndex()
    {
    	$id = Input::get('id');

    	$todo = Todo::findOrFail($id);

        if($todo->user_id == Auth::user()->id)
        {
    	   $todo->mark();
        }

    	return redirect('/todos');
    }

    public function getNew()
    {
        if(!Auth::user())
        {
            return redirect('login')->with('error', 'Gelieve eerst in te loggen');
        }
        else
        {
            return view('new');
        }
    }

    public function postNew()
    {
        $rules = array('name' => 'required|min:3|max:255');
        $messages = array('required' => 'Gelieve een todo in te geven (min 3 karakters)',
                          'min' => 'Gelieve minstens 3 karakters in te geven',
                          'max' => 'Gelieve niet meer dan 255 karakters in te geven');
        $validator = Validator::make(Input::all(), $rules, $messages);

        if($validator->fails())
        {
            return redirect('todos/new')
            ->withInput()
            ->withErrors($validator);
        }

        $todo = new Todo;
        $todo->nametodo = Input::get('name');
        $todo->user_id = Auth::user()->id;
        $todo->save();

        return redirect('/todos');
    }

    public function getDelete(Todo $task)
    {
        if(!Auth::user())
        {
            return redirect('login')->with('error', 'Gelieve eerst in te loggen');
        }
        else
        {
            if($task->user_id == Auth::user()->id)
            {
                $task->delete();
            }

            return redirect('/todos');
        }
    }
}