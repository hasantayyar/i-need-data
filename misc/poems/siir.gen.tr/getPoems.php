#!/usr/bin/env php
<?php
header( 'Content-Type: text/html; charset=UTF-8' );
include __DIR__.'/bootstrap.php';
require __DIR__.'/../../../lib/ganon.php';
$i=0;
$urls = file('poet_links.txt');
foreach( $urls as $url ){
	++$i;
	echo("Processing ".$url ." - ". $i ."\n");
	fetch($url,$db); 
	usleep(100);
}


function fetch($url,$db)
{ 
	$base = 
 	$html = url_get_dom($url);
 	if(!$html){
 		return FALSE;
 	}
 	$poems = $html('blockquote a');
	foreach($poems as $link){
	  $poemLink = $link->href;
	  // @todo get poem content save to mongodb 
	}
	unset($html);
	unset($poemPage);
}
