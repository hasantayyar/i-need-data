#!/usr/bin/env php
<?php
header( 'Content-Type: text/html; charset=UTF-8' );
include __DIR__.'/app/bootstrap.php';
require './../../lib/ganon.php';
$cursor = $db->booklinks->find();
$i=0;

fetch("http://www.kitapyurdu.com/kitap/default.asp?id=658453",$db); die();
foreach( $cursor as $book ){
	$url = $book['url'];
	++$i;
	echo("Processing $url - $i \n");
	fetch($url,$db); 
	usleep(200);
}


function fetch($link,$db)
{ 
	$data = array();
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
 	$authorsPlain = convertEncoding($authorsDom->getPlainText());
 	$data['authors'] = explode('/',$authorsPlain);
	unset($authorsDom);
	$brandDom = $html('[itemprop="brand"]',0);
	if(is_object($brandDom)){
		$data['brand'] = convertEncoding($brandDom->getPlainText());
	}
	$descDom = $html('[class="kitapyazi"]',0);
	if(is_object($descDom)){
		$data["desc"] = str_replace( array("SİTE:www.kitapyurdu.com","SÝTE:www.kitapyurdu.com"),"",convertEncoding($descDom->getPlainText()));
	}
	$infoDom = $html('table tr td span[class="normalkucuk"]',0);
	if(is_object($infoDom)){
		$data['info'] = $infoDom->getPlainText();
	}
	print_r($data);
 	$html->clear();
	unset($html);
}
