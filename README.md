# Mini-DOM-PHP

#Usage
```php
  
  require_once 'dom-load.php';

  $div = new HTMLDivElement();//Creates a div element
  $div -> setId( "the-almighty-div" );//set an id (html attribute) for this div
  $div -> setClassName( "col-sm-6" );//set a class (html attribute) for this div
  
  //All elements are instances of HTMLElement and all HTMLElements have an instance of CSSStyleDeclaration as member. style
  //set some styles for our div
  $div -> style -> set__( array( "fontSize" => "20px", "padding" => "4px", "margin-bottom" => "10em") );
  
  //create a div using the HTMLDocument class
  $div2 = HTMLDocument::createElement( "div", array( "id" => "the=other-almighty", "className" => "col-md-12" ) );
  
  //some styles for the div
  $div2 -> style -> backgroundColor = "#12b422";
  
  //Make the first div child of the second
  $div2 -> appendChild( $div );
  
  //set some text
  $div2 -> __setText( "Awesome Text" );
  
  //unlike __setText, this will not print tags as text
  $div2 -> __setHTMLText( "<div>Awesome Text 2</div>" );
  
  $div2 -> __setText( "<div>Awesome Text 3</div>" );
  
  $div3 = HTMLDocument::createElement( "div","last-div" );
  $div3 -> copyStyle( $div );// or $div3 -> copyStyle( $div -> style );
  $div3 -> style -> borderRadius = "5px";
  //lets echo our div
  $div2 -> __e();
  $div3 -> __e();//output is as shown below

```
```html
  <div id = "the-other-almighty" class = "col-md-12" style = "background-color:#12b422;">
    <div id = "the-almighty-div" class = "col-sm-6" style = "font-size:20px;padding:4px;margin-bottom:10em;">
    </div>
    "Awesome Text"
    <div>Awesome Text 2</div>
    "<div>Awesome Text 3</div>"
  </div>
  <div id = "last-div" style = "font-size:20px;padding:4px;margin-bottom:10em;border-radius:5px;">
  </div>
```
