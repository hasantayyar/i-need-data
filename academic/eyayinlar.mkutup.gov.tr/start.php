<?php
include '../lib/ganon.php';

$base = "http://eyayinlar.mkutup.gov.tr";
$startUrl = "http://eyayinlar.mkutup.gov.tr/cgi-bin/WebObjects/Makale";


$html = url_get_dom( $startUrl );
$articlesLinkDom = $html('table[id="mmenu"] tr td a',1);
$articlesLink = $articlesLinkDom->href;

// link is dynamically generated in every session
echo $base.$articlesLink;
