<?php
	/*	
		description: class that represents a script element
		version: 1.0.0
	*/
	class HTMLScriptElement extends HTMLElement{
		protected $href = null;
		protected $src = null;
		function __construct(){
			$this->type = "text/javascript";//default
			$this->addHtmlAttribute( [ "src", "href" ] );
			parent::__construct("SCRIPT");
		}
	}
	
?>