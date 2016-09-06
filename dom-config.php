<?php

	/**
		*Registering Tags
	*/

	HTMLDocument::registerTag( "A" );
	HTMLDocument::registerTag( "AREA" );
	HTMLDocument::registerTag( "AUDIO" );
	HTMLDocument::registerTag( "BODY" );
	HTMLDocument::registerTag( "BUTTON" );
	HTMLDocument::registerTag( "CANVAS" );
	HTMLDocument::registerTag( "DIV" );
	HTMLDocument::registerTag( "FORM" );
	HTMLDocument::registerTag( "FOOTER" );
	HTMLDocument::registerTag( "H" );
	HTMLDocument::registerTag( "HEAD" );
	HTMLDocument::registerTag( "HTML" );
	HTMLDocument::registerTag( "IMG" );
	HTMLDocument::registerTag( "INPUT" );
	HTMLDocument::registerTag( "LABEL" );
	HTMLDocument::registerTag( "LINK" );
	HTMLDocument::registerTag( "P" );
	HTMLDocument::registerTag( "SCRIPT" );
	HTMLDocument::registerTag( "TEXT" );
	HTMLDocument::registerTag( "TITLE" );


	/**
		*Registering tags whose names appear differently in class definations
	*/

	HTMLDocument::registerUniqueFromClassDefTagName( "P", "Paragraph" );
	HTMLDocument::registerUniqueFromClassDefTagName( "IMG", "Image" );
	HTMLDocument::registerUniqueFromClassDefTagName( "H", "Heading" );
	HTMLDocument::registerUniqueFromClassDefTagName( "A", "Anchor" );
?>