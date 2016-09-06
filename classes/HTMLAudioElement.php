<?php
	/*	
		description: class that represents a media element
		version: 1.0.0
	*/
	class HTMLAudioElement extends HTMLElement{
		function __construct($src = ""){
			$this-> setSrc($src);
			$this->addHtmlAttribute( "src" );
			parent::__construct("AUDIO");
		}
	}
	
?>
