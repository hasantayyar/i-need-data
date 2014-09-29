#!/usr/bin/env php
<?php
ini_set("max_execution_time", "0");
ini_set("memory_limit", "2G");
ini_set('implicit_flush', 1);
set_time_limit(0);


require './../../lib/ganon.php';

$base = "http://www.kitapyurdu.com";
fetch($base,$m);

function fetch($base,$db)
{
	$alphas = range('a', 'z');
	$alphas = array_merge(array(
		'%F6',
		'%FC',
		'%FE',
		'%FD'
	) , $alphas);
	foreach($alphas as $alpha) {
		$link = $base . '/yazar/default.asp?session=87666E24-522B-4055-8B2A-83B6BAD7BBF2&LogID=&arama=ad&option=' . $alpha;
		echo "Processing $link\n\n";
		$html = file_get_dom($link);
		if (!empty($html)) {
			$authors = $html('tr td font a');
			$html->clear();
			unset($html);
			for($i=0;$i<count($authors);++$i){
				$author = $authors[$i];
				if (stristr($author->href, 'yazar')) {
					$url = $base . $author->href;
					echo $url . "\n";
					$db->authorlinks->insert(array('name'=>$author->getPlainText(), 'url'=>$url));
				}
				unset($author);
			}
			unset($authors);
		}
		sleep(1);
	}
}
