<?php
header( 'Content-Type: text/html; charset=UTF-8' );
include __DIR__.'/app/bootstrap.php';
require './../lib/ganon.php';
$cursor = $db->booklinks->find();
$i=0;
foreach( $cursor as $book ){
	$url = $book['url'];
	++$i;
	echo("Processing $url - $i \n");
	fetch($url,$db); 
	usleep(200);
}


function fetch($link,$db)
{ 
	$base = "http://www.kitapyurdu.com";
 	$html = url_get_dom($link);
 	if(!$html){
 		return FALSE;
 	}
 	$authorsDom = $html('[itemprop="description"]',0);	
	if(!is_object($authorsDom)){
		// @todo log fail
		return FALSE;
	}
 	$authorsPlain = $authorsDom->getPlainText();
 	$authors = explode('/',$authorsPlain);

 	
	usleep(200);
}
