<?php
	/*	
		description: class that represents a canvas element
		version: 1.0.0
	*/
	class HTMLFormElement extends HTMLElement{
		protected $action = "";
		protected $enctype = null;
		protected $method = null;
		function __construct(){
			$this->addHtmlAttribute( [ "action", "enctype", "method" ] );
			parent::__construct("FORM");
		}
		function setAction($width){$this->action = $action;}
		function setEnctype($height){$this->enctype = $enctype;}
		function setMethod($method){$this->method = $method;}
		function getAction(){return $this->action;}
		function getEnctype(){return $this->enctype;}
		function getMethod(){return $this->method;}
		function reset(){}
	}
	
?>