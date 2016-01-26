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
    	$todos = Auth::user()->todos;

        return view('todos', array('todos' => $todos));
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
        return view('new');
    }

    public function postNew()
    {
        $rules = array('name' => 'required|min:3|max:255');
        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails())
        {
            return redirect('new')
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
        if($task->user_id == Auth::user()->id)
        {
            $task->delete();
        }

        return redirect('/todos');
    }
}