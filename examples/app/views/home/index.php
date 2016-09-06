<?php require_once __DIR__ . '/../../../../dom-load.php'; ?>


<?php

	$body = HTMLDocument::createElement( "body" );

	$codeDemoContainer = new HTMLDivElement();

	$codeDemoContainer -> __setHTMLText( 
		'$body <span class = "r">=</span> <span class = "b">HTMLDocument</span><span class = "r">::</span>createElement( <span class = "br">"body"</span> );<br>' .
		'$div <span class = "r">=</span> <span class = "r">new</span> <span class = "b">HTMLDivElement</span>();<br>' . 
		'$div <span class = "r">-></span> style <span class = "r">-></span> fontSize <span class = "r">=</span> <span class = "br">"40px"</span>;<br>' . 
		'$div <span class = "r">-></span> style <span class = "r">-></span> fontFamily <span class = "r">=</span> <span class = "br">"Arial"</span>;<br>' . 
		'$div <span class = "r">-></span> style <span class = "r">-></span> textAlign <span class = "r">=</span> <span class = "br">"center"</span>;<br>' . 
		'$div <span class = "r">-></span> style <span class = "r">-></span> padding <span class = "r">=</span> <span class = "br">"30px"</span>;<br>' . 
		'$div <span class = "r">-></span> style <span class = "r">-></span> marginBottom <span class = "r">=</span> <span class = "br">"15px"</span>;<br>' . 
		'$div <span class = "r">-></span> __setText( <span class = "br">"The Mini DOM"</span> );<br>' . 

		'$div1 <span class = "r">=</span> <span class = "b">HTMLDocument</span><span class = "r">::</span>createElement( <span class = "br">"div"</span> ,array( <span class = "br">"id"</span> <span class = "r">=></span> <span class = "br">"div-1"</span>, <span class = "br">"className"</span> <span class = "r">=></span> <span class = "br">"div-class"</span> ) );<br>' . 
		'$div1 <span class = "r">-></span> style <span class = "r">-></span> set__( [ <span class = "br">"borderRadius"</span> <span class = "r">=></span> <span class = "br">"40px"</span>, <span class = "br">"backgroundColor"</span> <span class = "r">=></span> <span class = "br">"rgb(45,12,43)"</span>, <span class = "br">"padding"</span> <span class = "r">=></span> <span class = "br">"50px"</span>, <span class = "br">"marginBottom"</span> <span class = "r">=></span> <span class = "br">"20px"</span> ] );<br>' . 

		'$div2 <span class = "r">=</span> <span class = "b">HTMLDocument</span><span class = "r">::</span>createElement( <span class = "br">"div"</span> ,array( <span class = "br">"id"</span> <span class = "r">=></span> <span class = "br">"div-2"</span>, <span class = "br">"className"</span> <span class = "r">=></span> <span class = "br">"div-class"</span> ) );<br>' . 
		'$div2 <span class = "r">-></span> copyStyle( $div1 );<br>' . 
		'$div2 <span class = "r">-></span> style -> width = <span class = "br">"300px"</span>;<br>' . 

		'$button <span class = "r">=</span> <span class = "r">new</span> <span class = "b">HTMLButtonElement</span>();<br>' . 

		'$button <span class = "r">-></span> setId( <span class = "br">"div-3"</span> );<br>' . 

		'$button <span class = "r">-></span> style <span class = "r">-></span> set__( [ <span class = "br">"display"</span> <span class = "r">=></span> <span class = "br">"block"</span>, <span class = "br">"width"</span> <span class = "r">=></span> <span class = "br">"200px"</span>,<span class = "br">"margin"</span> <span class = "r">=></span> <span class = "br">"auto"</span>, <span class = "br">"borderRadius"</span> <span class = "r">=></span> <span class = "br">"10px"</span>, <span class = "br">"padding"</span> <span class = "r">=></span> <span class = "br">"20px"</span>, <span class = "br">"backgroundColor"</span> <span class = "r">=></span> <span class = "br">"rgb(45,12,60)"</span>, <span class = "br">"color"</span> <span class = "r">=></span> <span class = "br">"#fff"</span> ] );<br>' . 
		'$button <span class = "r">-></span> __setText(<span class = "br">"Dont Press Me"</span>);<br>' . 

		'$body <span class = "r">-></span> appendChild( $div ) <span class = "r">-></span> appendChild( $div1 ) <span class = "r">-></span> appendChild( $div2 ) <span class = "r">-></span> appendChild( $button );<br>'

	,true );$codeDemoContainer -> style -> fontFamily = "Arial";$codeDemoContainer -> style -> backgroundColor = "#000";$codeDemoContainer -> style -> color = "#fff";$codeDemoContainer -> style -> padding = "10px";

	$div = new HTMLDivElement();
	$div -> style -> fontSize = "40px";
	$div -> style -> fontFamily = "Arial";
	$div -> style -> textAlign = "center";
	$div -> style -> padding = "30px";
	$div -> style -> marginBottom = "15px";
	$div -> __setText( "The Mini DOM" );

	$div1 = HTMLDocument::createElement( "div" ,array( "id" => "div-1", "className" => "div-class" ) );
	$div1 -> style -> set__( [ "borderRadius" => "40px", "backgroundColor" => "rgb(45,12,43)", "padding" => "50px", "marginBottom" => "20px" ] );

	$div2 = HTMLDocument::createElement( "div" ,array( "id" => "div-2", "className" => "div-class" ) );
	$div2 -> copyStyle( $div1 );
	$div2 -> style -> width = "300px";

	$button = new HTMLButtonElement();

	$button -> setId( "div-3" );

	$button -> style -> set__( [ "display" => "block", "width" => "200px","margin" => "auto", "borderRadius" => "10px", "padding" => "20px", "backgroundColor" => "rgb(45,12,60)", "color" => "#fff" ] );
	$button -> __setText("Don't Press Me");

	$body -> appendChild( $codeDemoContainer ) -> appendChild( $div ) -> appendChild( $div1 ) -> appendChild( $div2 ) -> appendChild( $button );

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Mini DOM(PHP) Examples</title>
		<style type="text/css">
			.b{
				color:rgb(0,150,255);
			}

			.r{
				color:rgb(200,40,90);
			}

			.br{
				color:rgb(200,160,10);
			}
		</style>
	</head>
	<?php
		$body -> __e();
	?>
</html>