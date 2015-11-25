<?php 

	function __autoload($className) {
	  require_once('classes/' . $className . '.php');
	}

	$myHTMLBuilder = new HTMLBuilder("html/header.partial.php", "html/body.partial.php", "html/footer.partial.php");

	$myHTMLBuilder->buildHeader();
	$myHTMLBuilder->buildBody();


?>