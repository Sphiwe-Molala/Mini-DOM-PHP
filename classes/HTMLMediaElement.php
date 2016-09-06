<?php
	/*	
		description: class that represents a media element
		version: 1.0.0
	*/
	class HTMLMediaElement extends HTMLElement{
		protected $volume = "";
		protected $src = "";
		protected $loop = "";
		function __construct($tagname){
			$this->addHtmlAttribute( ["volume", "src", "loop"] );
			parent::__construct($tagname);
		}

		function setSrc($src){
			$this->src = $src;
		}
	}
?>