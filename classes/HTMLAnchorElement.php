<?php
	/*	
		description: class that represents an anchor element
		version: 1.0.0
	*/
	class HTMLAnchorElement extends HTMLElement{
		protected $href = "";
		function __construct(){
			$this->addHtmlAttribute( "href" );
			parent::__construct("A");
		}
		public function getHref(){
			return $href;
		}
	}

?>