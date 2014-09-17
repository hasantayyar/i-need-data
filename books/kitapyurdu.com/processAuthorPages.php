<?php
header( 'Content-Type: text/html; charset=UTF-8' );
include __DIR__.'/app/bootstrap.php';
require './../lib/ganon.php';
$cursor = $db->authorlinks->find();
$i=0;
foreach( $cursor as $author ){
	$url = $author['url'];
	++$i;
	if(isset($argv[1]) && $i <$argv[1]) continue;
	echo("Processing $url - $i \n");
	fetch($url,$db); 
	usleep(100);
}


function fetch($link,$db)
{ 
	$base = "http://www.kitapyurdu.com";
 	$html = url_get_dom($link);
 	if(!$html){
 		return FALSE;
 	}
 	$books = $html('tr td b a[href^="/kitap"]');
	foreach($books as $book) { 
		if(!is_object($book)){
			continue;
		}
		$url = $base . $book->href;
		$parentRow = $book->parent->parent;
		if(!is_object($parentRow)){
			continue;
		}
		$author = $parentRow('a[href^="/yazar"]',0);
		if(!is_object($author)){
			continue;
		}
		$data= array(
			'url' => $url,
			'title' => convertEncoding($book->getPlainText()),
			'author' => convertEncoding($author->getPlainText()),
			); 
		$db->booklinks->insert($data);
	}
}
