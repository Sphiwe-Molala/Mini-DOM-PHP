<?php
	/*	
		description: class that represents a canvas element
		version: 1.0.0
	*/
	class HTMLTextElement extends HTMLElement{
		protected $text = null;
		protected $html = null;
		function __construct(){
			parent::__construct("TEXT");
		}
		function setText($text,$html){
			$this->html = $html;
			$this->text = $text;
		}
		function getText(){
			return $this->text;
		}
		function toString(){
			if (!$this->html)
				return htmlentities($this->getText());
			else
				return $this->getText();
		}
	}
	
?>