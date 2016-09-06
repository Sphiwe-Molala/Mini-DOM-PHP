<?php
	/*	
		description: class that represents an input element
		version: 1.0.0
	*/
	class HTMLInputElement extends HTMLElement{
		protected $placeholder = null;
		protected $value = null;
		protected $checked = null;
		protected $height = null;
		protected $width = null;
		protected $min = null;
		protected $max = null;
		protected $align = null;
		function __construct($type = ""){
			$this->addHtmlAttribute( [ "align", "placeholder", "height", "width", "min", "max", "align", "value" ] );
			if(empty($type))
				$type = "";
			$this->type = $type;
			parent::__construct("INPUT");
		}
		function setWidth($width){$this->width = $width;}
		function setAlt($alt){$this->alt = $alt;}
		function setHeight($height){$this->height = $height;}
		function setAlign($align){$this->align = $align;}
		function setValue($value){$this->value = $value;}
		function setChecked($checked){$this->checked = $checked;}
		function setMin($min){$this->min = $min;}
		function setMax($max){$this->max = $max;}
		function setPlaceholder($placeholder){$this->placeholder = $placeholder;}

		function getWidth($width){return $this->width;}
		function getAlt($alt){return $this->alt = $alt;}
		function getHeight($height){return $this->height;}
		function getAlign($align){return $this->align;}
		function getValue($value){return $this->value;}
		function getChecked($checked){return $this->checked;}
		function getMin($min){return $this->min;}
		function getMax($max){return $this->max;}
		function getPlaceholder($placeholder){return $this->placeholder;}
	}
	
?>