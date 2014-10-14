<?php
header( 'Content-Type: text/html; charset=UTF-8' );

mb_internal_encoding('UTF-8');
iconv_set_encoding('input_encoding', 'UTF-8');
iconv_set_encoding('internal_encoding', 'UTF-8');

try {
     $m = new Mongo(); // connect
     $db = $m->selectDB("poems_tr");
} catch(MongoConnectionException $e) {
     echo 'db error';
     exit();
} 

function convertEncoding($str){
	return utf8_encode($str); 
}
