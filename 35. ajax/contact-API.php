<?php
	
	// Eerst kijken of het een ajaxrequest is of niet
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	{
		// kijken of beide velden iets bevatten. In dit geval empty omdat $_POST in dit geval altijd geset is, ook als er niets werd meegegeven
		if(!empty($_POST["email"]) && !empty($_POST["boodschap"]))  
		{
			$ajaxMessage["type"] = "success";
		}
		else
		{
			$ajaxMessage["type"] = "error";
		}

		//waarden omzetten naar JSON zodat deze makkelijker te interpreteren zijn.
		$jsonData = json_encode($ajaxMessage);
		// Dit teruggeven
		echo $jsonData;
	}
?>