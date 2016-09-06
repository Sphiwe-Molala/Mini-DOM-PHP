<?php
	/*	
		description: class that represents a div element
		version: 1.0.0
	*/
	class HTMLDivElement extends HTMLElement{
		protected $align = null;
		function __construct(){
			$this->addHtmlAttribute( "align" );
			parent::__construct("DIV");
		}
	}
	
?>