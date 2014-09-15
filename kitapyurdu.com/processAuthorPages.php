<?php
include __DIR__.'/app/bootstrap.php';
$cursor = $db->authors->find();
foreach( $cursor as $author ){
	$url = $author['url'];
	echo "Processing $url \n";
}

