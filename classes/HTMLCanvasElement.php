<?php
	/*	
		description: class that represents a canvas element
		version: 1.0.0
	*/
	class HTMLCanvasElement extends HTMLElement{
		protected $width = 300;
		protected $height = 150;
		function __construct(){
			$this->addHtmlAttribute( [ "width", "height" ] );
			parent::__construct("CANVAS");
		}
		function setWidth($width){$this->width = $width;}
		function setHeight($height){$this->height = $height;}
		function getWidth(){return $this->width;}
		function getHeight(){return $this->height;}
	}
	
?>