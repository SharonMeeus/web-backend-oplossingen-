<?php

	class HTMLBuilder
	{
		public $header, $body, $footer;

		public function __construct($header, $body, $footer)
		{
			// de links die worden meegegeven in de variabele header, body en footer van deze klas steken.
			$this->header = $header;
			$this->body = $body;
			$this->footer = $footer;
		}

		public function buildHeader()
		{
			$CssLinks = $this->getCssLinks(); // Dit eerst laden alvorens de header, zodat deze variabele herkend wordt.
			include $this->header; // header toevoegen (evt met include_once).
		}

		public function getCssLinks()
		{
			$css = "";

			foreach(glob('css/*.css') as $filename) // elk bestand met de extensie css in de map css zoeken
			{
				
				$css = $css . "<link rel='stylesheet' type='text/css' href='css/" . basename($filename) . "'/>" . "\n"; //glob geeft het hele pad, maar je wil enkel de filename → basename
			}

			return $css;
		}

		public function buildBody()
		{
			include $this->body; // header toevoegen (evt met include_once).
		}

		public function buildFooter()
		{
			$JsLinks = $this->getJSLinks(); // Dit eerst laden alvorens de header, zodat deze variabele herkend wordt.
			include $this->footer; // header toevoegen (evt met include_once).
		}

		public function getJSLinks()
		{
			$js = "";

			foreach(glob('js/*.js') as $filename) // elk bestand met de extensie js in de map js zoeken
			{
				$js = $js . "<script type='text/javascript' src='js/" . basename($filename) . "'></script>" . "\n"; //glob geeft het hele pad, maar je wil enkel de filename → basename
			}

			return $js;
		}

		

	}

?>