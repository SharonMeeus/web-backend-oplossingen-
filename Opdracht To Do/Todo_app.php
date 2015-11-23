<?php 

	$input_todo = $_POST("input_todo");
	$todo_list = array();
	$done_list = array();

	// Als er iets is ingevuld in input_todo → dit toevoegen aan array
	if(isset($input_todo) && $input_todo != "")
	{
		$todo = $_POST("input_todo");
		array_push($todo_list, $todo);
	}

	



?>