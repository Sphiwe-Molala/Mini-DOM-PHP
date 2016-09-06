<?php
	/*	
		description: class that represents a html element
		version: 1.0.0
	*/
	class HTMLElement{


		/**
			*@var bool $singleTag, specifies if html element is single tagged or otherwise
		*/		
		protected $singleTag = false;


		/**
			*@var string $className, the class of this instance, html attribute
		*/
		protected $className = null;


		/**
			*@var string $id, the id of this instance, html attribute
		*/
		protected $id = null;


		/**
			*@var string $name, the name of this instance, html attribute
		*/
		protected $name = null;


		/**
			*@var string $tagName, the tag name of this instance
		*/
		protected $tagName = null;


		/**
			*@var string $type, specifies type of element, used mostly by instances of HTMLInputElement
		*/
		protected $type = null;


		/**
			*@var string $disabled, specifies if element is disabled
		*/	
		protected $disabled = null;


		/**
			*@var array $childElements, list of elements that are children to this instance
		*/
		protected $childElements = null;


		/**
			*@var HTMLElement $parentElement, parent element of this instance
		*/
		protected $parentElement = null;


		/**
			*@var array $dataset, stores all data attributes, key as attibute and value as value of attribute
		*/
		protected $dataset = array();


		/**
			*@var CSSStyleDeclaration $style, style object of this instance
		*/
		public $style = null;


		/**
			*@var int $elementTrackId, used as a count variable for instantiated HTMLElements
		*/
		static $elementTrackId = 0;


		/**
			*@var int $trackId, id used to trace or track this instance
		*/
		protected $trackId = null;


		/**
			*@var array $htmlAttributes, list of members that are actuall html element attributes
		*/
		protected $htmlAttributes = array( "className", "id", "name", "dataset", "href", "rel", "type");




		/**
			*Arguments sent to this functions carry values that will be presented as HTML attributes values
			*@param string, $tagname , the tagname of the element object being instantiated
			*@param string, $id , the id of the element object being instantiated, (optional)
			*@param string, $className , the class of the element object being instantiated, (optional)
			*@param string, $name , the name of the element object being instantiated, (optional)
		*/
		protected function __construct( $tagname, $id = null, $classname=null, $name=null ){

			$this->setTagName($tagname);

			$this->trackId = HTMLElement::$elementTrackId++;

			if ( HTMLDocument::isTagRegitered( $tagname ) )
				HTMLDocument::registerTag( $tagname );
			$this->setId($id);
			$this->setClassName($classname);
			$this->setName($name);

			HTMLDocument::appendChild($this);

			$this->style = new CSSStyleDeclaration();

		}

		/**
			*Sets the value of @var $tagName
			*@param string, $tagname, the tagname of any instance of this class
			*@return void
		*/
		protected function setTagName($tagname){
			$this->tagName = $tagname;
		}

		/**
			*Get the value of @var $tagName
			*@return string, value of @var $tagName
		*/
		public function getTagName(){
			return $this->tagName;
		}


		/**
			*Refer to HTMLDocument class defination
		*/
		public function getElementsByTagName($tagname){

			return HTMLDocument::getElementsByTagName( $tagname , $this-> getChildren() );

		}

		/**
			*Refer to HTMLDocument class defination
		*/
		public function getElementsByClassName($classname){

			return HTMLDocument::getElementsByClassName( $classname , $this-> getChildren() );

		}

		/**
			*Refer to HTMLDocument class defination
		*/
		public function getElementById($id){

			return HTMLDocument::getElementById( $id , $this-> getChildren() );

		}

		/**
			*Checks if sent text is a html attribute, refers to HTMLElement::htmlAttributes
			*@return bool
		*/
		public function isHTMLAttribute( $attribute ) {

			return in_array( $attribute, $this->htmlAttributes ); 

		}

		/**
			*Sets a data attribute
			*@param string $attribute
			*@param string $value
		*/
		public function setDataAttribute( $attribute, $value ) {

			if ( !is_array( $this->dataset ) )

				$this->dataset = [];

				$this->dataset[ $attribute ] = $value;

		}

		/**
			*Removes a data attribute
		*/
		public function removeDataAttribute( $attribute ) {

			if ( is_array( $this->dataset ) )

				unset( $this->dataset[ $attribute ] );

		}

		/**
			*Writes any html attribute that has a value, along with its value, into a string. Writes it as it would appear on a hand written/typed tag. Attributes are searched through members of this class
			*@param string, $text , any string to concatinate the attributes with (optional)
			*@return string, html attributes and values, along with any other information that might have been sent as argument
		*/
		protected function writeHTMLAttr($text = ""){

			foreach ($this as $member => $value) {

				if ( $this->isHTMLAttribute( $member ) ) {

					if ( $this->{$member} === null )

						continue;

					if ( is_array( $this->{$member} ) ) {

						foreach ( $this->{$member} as $subattr => $value ) {//code will need to be moved to own function if new attrwithattributes is introduced
							
							switch ( $member ) {

								case "dataset" :
									$text .= " data-" . $subattr . " = '". $value."'";	
								break;

							}				
						
						}

					} else {

						$text .= " ".$member." = '". $this->{$member}."'";

					}

				}

			}

			$text .= " style ='" . $this->style->toString() . "'";

			return $text;
			
		}

		/**
			*Presents the html element in its normal html format, with all attributes if any specified
			*@param bool $childElementsOnly, does not include tags of this instance if true
			*@return string, html version of any instance of this class
		*/
		public function toString( $childElementsOnly = false ) {

			$text = "";
			if ( !$childElementsOnly ) {
			
				$text = "<".strtolower($this->tagName);
				$text .= " ".$this->writeHTMLAttr($text)." ".(($this ->singleTag)?"/":"").">";//{return;}

			}

			if (!$this ->singleTag){
				if ($this->childElements !== null){
					foreach ($this->childElements as $key => $element) {
						$text .= $element->toString();
					}
				}
				if ( !$childElementsOnly )
					$text .= "</".strtolower($this->tagName).">";
			}
			return $text;
		}

		/**
			* Echos html version of any instance of this class
			*@return void
		*/
		public function __e(){
			echo $this->toString();
		}

		/**
			*Echos any element(s) it receives as argument
			*@return void
		*/
		public static function ___e( $elements = array() ){
			if (!is_array($elements)) $elements = array( $elements );
			foreach ($elements as $key => $element) {
				if (is_a($element,"HTMLElement"))
					$element -> __e();
			}
		}

		/**
			*Gets all children of any instance of this class
			*@return array, instances of the HTMLElement class
		*/
		public function getChildren(){
			return $this->childElements === null?array(): $this->childElements;
		}

		/**
			*Check if any instance of this class has children
			*@return bool, true if instance has children, false if otherwise
		*/
		public function hasChildren(){
			return (bool) count($this->childElements);
		}

		/**
			*Appends or adds an element to the list of any instance of this class' children
			*@param HTMLElement, the element to be appended
			*@return mixed, returns void if appending was attempted on a single tagged element, returns the calling instance on success for easy access of the same object the first call was made by
		*/
		public function appendChild( $element ){

			if ($this ->singleTag){return;}


			if ( $element -> getTrackId() == $this->getTrackId() ) {

				throw new Exception("Cannot append element to itself");
				
			}
			
			if ($element ->getParentElement() !== null){

				if (is_a($element ->getParentElement(), "HTMLDocument")){

					$element -> getParentElement() -> removeChild( $element );

				}
			}else{//if parentElement is null, $element is direct child of the document

				HTMLDocument::removeChild($element);

			}

			if (is_array($this->childElements))

				$this->childElements[] = $element;

			else

				$this->childElements = array($element);

			$element ->setParentElement($this);

			return $this;
		}

		/**
			*Appends multiple children to this instance
			*@param array $elements, elements to be appended to this instance
		*/
		public function appendChildren($elements = array()){

			if ($this ->singleTag){return;}

			if (!is_array($elements)){

				return;

			}

			foreach ($elements as $key => $element) {

				$this -> appendChild($element);

			}

			return $this;
		}

		/**
			*Removes element sent as argument from list of this instance's child elements
			*@param HTMLElement, element to be removed
		*/
		public function removeChild( $element ){

			if ( is_array( $this->childElements ) && is_a( $element, "HTMLElement" ) ) {

				foreach ($this->childElements as $key => $__element) {

					if ($element->getTrackId() == $__element->getTrackId()){
						//array_splice($this->childElements,$key ,1);
						$this->childElements = array_diff_key($this->childElements, array($key=>""));//array_splice could not do the work, for reasons I failed to spot
						$element ->setParentElement = null;
						HTMLDocument::appendChild($element);

						return true;
					}

				}

			}

			return false;
		}

		/**
			*Gets the track id
			*@return int
		*/
		public function getTrackId(){
			return $this->trackId;
		}

		/**
			*Copies the style object sent as argument to the style object of this instance
			*@param mixed $styleorelement, instance of CSSStyleDeclaration or HtmlElement to copy from
		*/
		public function copyStyle( $styleorelement ) {

			$style = $styleorelement;

			if ( is_a( $styleorelement, "HTMLElement" ) )

				$style = $styleorelement -> style;

			
			if ( !is_a( $style, "CSSStyleDeclaration" ) )
			
				return;

			if ( !is_a($this->style, "CSSStyleDeclaration") )

				$this -> style = new CSSStyleDeclaration();


			foreach ($style as $member => $value) {
				
				$this -> style -> { $member } = $value;

			}

		}

		/**
			*Sets the id of the element
			*@param string $id
		*/
		public function setId($id){$this->id = $id;}

		/**
			*Sets the className of the element
			*@param string $className
		*/
		public function setClassName($className){$this->className = $className;}

		/**
			*Sets the name of the element
			*@param string $name
		*/
		public function setName($name){$this->name = $name;}

		/**
			*Sets matching members of this instance
			*@return HTMLElement, this instance to allow easy access
		*/
		public function setAttributes($attributes){

			foreach ($attributes as $attrib => $value) {

				if (property_exists($this, $attrib))

					$this->set__($attrib,$value);

			}

			return $this;

		}

		/**
			*Sets this instance as a single tagged element
		*/
		protected function singleTag(){

			$this->singleTag = true;

		}

		/**
			*Registers or adds sent argument as html attribute
			*@param mixed, attibute or attributes to add to the html attributes list
		*/
		protected function addHtmlAttribute( $attribute ) {

			if ( is_array( $attribute ) ){

				$this->htmlAttributes = array_merge( $attribute, $this->htmlAttributes );

			}else

				$this->htmlAttributes[] = $attribute;

		}

		/**
			*Sets text to this instance
			*@param string $text
			*@param bool $html, if true characters will be converted to htmlentities
		*/
		public function __setText($text,$html = false){

			$textObj = new HTMLTextElement();

			$textObj -> setText( $text, $html );

			$this -> appendChild( $textObj );

		}

		/**
			*Sets html text
			*@param string $text
		*/
		public function __setHTMLText($text){

			$this -> __setText( $text, true );

		}

		/**
			*Gets value of a member sent as argument
			*@param string $member, member name whose value is to be returned
			*@return mixed, false if member does not exist
		*/
		public function get__( $member = "" ) {

			if ( !$this -> has__($member) )

				return false;

			else

				return $this -> {$member};

		}

		/**
			*Checks if this instance has the member sent as argument
			*@param string $member
			*@return bool
		*/
		public function has__($member = ""){

			if (empty($member))

				return false;

			return property_exists($this, $member);

		}

		/**
			*Sets a value of member
			*@param string $member
			*@param string $value
		*/
		public function set__( $member, $value ) {

			if ($member == "innerText")

				$this->__setText($value);

			else if ($member == "innerHTML")

				return $this;
				//$this->__setText($value,true);

			if ( $this->has__( $member ) )

				$this -> {$member} = $value;

			return $this;
		}

		/**
			*Gets parent Element of this instance
			*@return HTMLElement
		*/
		public function getParentElement(){

			return $this ->parentElement;

		}

		/**
			*Sets parent Element for this instance
			*@param HTMLElement $parentElement
		*/
		public function setParentElement( $parentElement ) {

			if ( is_a( $parentElement, "HTMLElement") ){

				if ( $parentElement -> getTrackId() == $this->getTrackId() ) {

					throw new Exception("Cannot make element parent of its own");
					
				}

				$this ->parentElement = $parentElement;
				
			}


		}

	}



?>