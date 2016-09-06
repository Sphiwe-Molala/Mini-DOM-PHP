<?php
	/*	
		description: class that represents a link element
		version: 1.0.0
	*/
	class HTMLLinkElement extends HTMLElement{
		protected $href = null;
		protected $rel = null;
		function __construct(){
			$this->singleTag();
			$this->rel = "stylesheet";//default
			$this->type = "text/css";

			$this->addHtmlAttribute( "href" );
			parent::__construct("LINK");
		}
	}
	
?>