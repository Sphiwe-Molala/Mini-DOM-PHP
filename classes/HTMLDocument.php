<?php
	/*
		description: class that represents a html document
		version: 1.0.0
		recommendations: Only echo with this class on empty html files (No hand written tags)
	*/
	class HTMLDocument{
		protected function __construct(){}//prevent instantiation

		public static $body = null;

		public static $head = null;

		public static $images = null;

		public static $links = null;

		public static $scripts = null;

		public static $styleSheets = null;

		public static $title = null;

		public static $childElements = null;

		public static $base_attributes = array("id","className","name");

		public static $registeredTags = [];

		public static $registeredUniqueFromClassNameTags = [];

		public $htmlElement = null;


		/**
			*Creates a html element
			*@param string $tagname,the tag name of the element to be created
			*@param mixed $idorarray, id of the element or an array containing attributes for the created element
			*@param string $classname, class name of the element 
			*@param string $name, name of the element
		*/
		public static function createElement( $tagname, $idorarray = null, $classname = null, $name = null ) {

			$tagname = strtoupper($tagname);

			foreach (self::$registeredTags as $key => $tag) {

				if ($tagname == $tag){

					if ( self::hasUniqueTagNameInClassDef( $tag ) )

						$tag = self::getUniqueTagName($tag);

					$class = 'HTML'.ucwords( strtolower($tag) )."Element";
					$object = new $class();

					if (is_array($idorarray)){

						$object -> setAttributes($idorarray);

					}else{

						$object -> setId($idorarray);
						$object -> setClassName($classname);
						$object -> setName($name);

					}

					return $object;
				}

			}

		}

		/**
			*Creates a document object with the html,title,head and body tags as its children
			*@param $attribs, attributes of children elements that are created with the document this method creates
			*@return HTMLDocument
		*/
		public static function createDocument( $attribs = "" ){
			$html = new HTMLHtmlElement();
			$title = new HTMLTitleElement();
			$head = new HTMLHeadElement();
			$body = new HTMLBodyElement();

			$elements = array($html,$title,$head,$body);
			if (is_array($attribs)){

				foreach ($attribs as $key => $__attrbs) {

					switch($key){
						case "title":
							if (!is_array($__attrbs))
								$title -> __setText($__attrbs);
							else{								
								foreach ($__attrbs as $attrb => $value){
									if ($title -> has__($attrb)){
										$title -> set__($attrb,$value);
									}
								}
							}
						break;
						default://
							foreach ($elements as $subkey => $element) {
								if (strtoupper($key) != $element->getTagName()) continue;
								foreach ($__attrbs as $attrb => $value){
									if ($element -> has__($attrb)){
										$element -> set__($attrb,$value);
									}
								}
							}
						break;
					}

				}
			}

			$head -> appendChild($title);
			$html -> appendChildren(array($head,$body));
			$document = new HTMLDocument();
			$document -> setHTMLElement($html);
			$document -> setBodyElement($body);
			$document -> setHeadElement($head);
			return $document;
		}

		/**
			*Appends element sent as argument to this instance
			*@param HTMLElement, element to be set as child of this instance
			*@return void
		*/
		public static function appendChild( $element ){

			if ( is_array( self::$childElements ) ){

				self::$childElements[] = $element;

			}else

				self::$childElements = array( $element );

			$element ->setParentElement(null);//direct child of document must have null parentElement
		}

		/**
			*Removes element from list of direct document children
			*Usage of this functions is not recommended, the framework itself only calls it when there will shortly be an assignment of the removed element (@param) to another element...i.e, only the Document element should have no parent
			*@param HTMLElement, HTML element object to be removed as child of the document
			*@return bool, true if removal was successful, false if otherwise
		*/	
		public static function removeChild( $element ){

			if ( is_array( self::$childElements ) ) {

				foreach (self::$childElements as $key => $__element) {

					if ($element->getTrackId() == $__element->getTrackId()){

						self::$childElements = array_diff_key(self::$childElements, array($key=>""));

						$element ->setParentElement(null);

						return true;
					}

				}

			}

			return false;
		}

		/**
			*Echos or print document
		*/
		public function __e(){

			$this -> htmlElement -> __e();

		}

		/**
			*Sets html element for this instance
		*/
		public function setHTMLElement( $html ){
			
			$this -> htmlElement = $html;
		
		}

		/**
			*Sets body element for this instance
		*/
		public function setBodyElement( $body ) {
			
			$this -> body = $body;

		}

		/**
			*Sets head element for this instance
		*/
		public function setHeadElement( $head ) {

			$this -> head = $head;

		}

		/**
			*Gets first encounterred element with matching id, searches all elements that are children of the document if second argument is empty array
			*@param string $id, id to search through elements with
			*@param array $elements, HTMLElement instances to search through
			*@return mixed, null on failure or instance of HTMLElement if found
		*/
		public static function getElementById( $id , $elements = array() ) {

			if ( !is_array( $elements )  )

				return null;

			if (!count($elements))

				$elements = self::$childElements;

			foreach ($elements as $key => $element) {

				if (is_a($element,"HTMLElement")){

					if ($id == $element-> get__("id")){

						return $element;

					}

					if ($element->hasChildren()){

						$elementschildElements = self::getElementById( $id , $element->getChildren() );

						if ($elementschildElements !== null)

							return $elementschildElements;

					}

				}

			}

			return null;
		}

		/**
			*Gets list of elements with matching tag name, searches all elements that are children of the document if second argument is empty array
			*@param string $tagName, tagname to search through elements with
			*@param array $elements, HTMLElement instances to search through
			*@return mixed, null on failure or instances of HTMLElement if found
		*/
		public static function getElementsByTagName( $tagName , $elements = array() ) {

			if ( !is_array( $elements )  )

				return null;

			$results = array();

			if (!count($elements))

				$elements = self::$childElements;

			foreach ($elements as $key => $element) {

				if (is_a($element,"HTMLElement")){

					if ( $tagName == $element-> getTagName() ){

						$results[] = $element;

					}

					if ( $element->hasChildren() ){

						$elementschildElements = self::getElementsByTagName( $tagName , $element->getChildren() );

						if ($elementschildElements !== null) {

							$results = array_merge( $elementschildElements );

						}
					}
				}
			}

			if ( count( $results ) )

				return $results;

			else

				return null;
		}

		/**
			*Gets list of elements with matching class name, searches all elements that are children of the document if second argument is empty array
			*@param string $className, class name to search through elements with
			*@param array $elements, HTMLElement instances to search through
			*@return mixed, null on failure or instances of HTMLElement if found
		*/
		public static function getElementsByClassName( $className , $elements = array() ) {

			if ( !is_array( $elements )  )

				return null;

			$results = array();

			if (!count($elements))

				$elements = self::$childElements;


			foreach ($elements as $key => $element) {

				if (is_a($element,"HTMLElement")){

					if ($className == $element-> get__("className")){

						$results[] = $element;

					}

					if ( $element->hasChildren() ){

						$elementschildElements = self::getElementsByClassName( $className , $element->getChildren() );

						if ($elementschildElements !== null) {

							$results = array_merge( $results, $elementschildElements );

						}
					}
				}
			}

			if ( count( $results ) )

				return $results;

			else

				return null;
		}

		/**
			* Checks if tag is registerred
			*@param string $tag, tag name to be checked if is registered
			*@return bool, true if registered
		*/
		public static function isTagRegitered( $tag ) {

			return in_array( strtoupper( $tag ), self::$registeredTags );

		}

		/**
			*Registers tag
		*/
		public static function registerTag( $tag ) {

			self::$registeredTags[] = strtoupper( $tag );

		}

		/**
			*Registers tags whose names appear diffently if class definations, i.e 'a', HTMLAnchorElement
			*@param string $tag, tag to register, e.g 'a' or 'p'
			*@param string $tagInClassDef, tag/element name as it appears in the class defination, e.g Anchor or Paragraph
		*/
		public static function registerUniqueFromClassDefTagName( $tag, $tagInClassDef ) {

			self::$registeredUniqueFromClassNameTags[ $tagInClassDef ] = $tag;

		}


		/**
			* Checks if tag appears differently in class defination, refers to registered tags
			*@param string $tag, tag name to check
			*@return bool, true if tag appears differently
		*/
		public static function hasUniqueTagNameInClassDef( $tag ) {

			return isset( self::$registeredUniqueFromClassNameTags[ $tag ] );

		}
		
		/**
			*Gets the tag name that appears in a class defination of the tag sent as argument, refers to registered tags
			*@param string $tag
			*@return mixed, null of not found or tag/element name appearing in class defination
		*/
		public static function getUniqueTagName( $tag ) {

			if ( hasUniqueTagNameInClassName( $tag ) )

				return self::$registeredUniqueFromClassNameTags[ $tag ];

			else

				return null;

		}

	}
?>