<?php
require './../lib/ganon.php';

$base = "http://www.kitapyurdu.com";
fetch($base);

function fetch($base)
{
	$file_path = __DIR__.'/_data/authors.txt';
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
			foreach($authors as $author) {
				if (stristr($author->href, 'yazar')) {
					$url = $base . $author->href;
					echo $url . "\n";
					file_put_contents($file_path, $url."\n", FILE_APPEND);
				}
			}
		}
	}
}
