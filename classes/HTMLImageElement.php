<?php
	/*	
		description: class that represents an image element
		version: 1.0.0
	*/
	class HTMLImageElement extends HTMLElement{
		protected $align = null;
		protected $alt = null;
		protected $height = null;
		protected $width = null;
		protected $src = null;
		function __construct(){
			$this->singleTag();
			$this->addHtmlAttribute( [ "src", "alt", "height", "width", "align"] );
			parent::__construct("IMG");
		}
		function setWidth($width){$this->width = $width;}
		function setAlt($alt){$this->alt = $alt;}
		function setHeight($height){$this->height = $height;}
		function setAlign($align){$this->align = $align;}
		function setSrc($src){$this->src = $src;}
		function getWidth($width){return $this->width;}
		function getAlt($alt){return $this->alt;}
		function getHeight($height){return $this->height;}
		function getAlign($align){return $this->align;}
		function getSrc($src){return $this->src;}
	}

?>