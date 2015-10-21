<?php
	session_start();
	session_destroy();
	header("Location: opdracht-sessions-deel1-registratiepagina.php");
?>