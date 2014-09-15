<?php
include __DIR__.'/app/bootstrap.php';
require './../lib/ganon.php';
$cursor = $db->authorlinks->find();
$i=0;
foreach( $cursor as $author ){
	$url = $author['url'];
        ++$i;
	echo("Processing $url - $i\r\n");
	fetch($url,$db);
	usleep(200);
}


function fetch($link,$db)
{ 
	$base = "http://www.kitapyurdu.com";
 	$html = file_get_dom($link);
 	$books = $html('tr td b a[href^="/kitap"]');
	foreach($books as $book) { 
		$url = $base . $book->href;
		$parentRow = $book->parent->parent;
		$data= array(
			'url' => $url,
			'title' => $book->getPlainText(),
			'author' => $parentRow('a[href^="/yazar"]',0)->getPlainText(),
			); 
		$db->booklinks->insert($data);
		unset($book);
	}
	unset($books);
	sleep(1);
}
