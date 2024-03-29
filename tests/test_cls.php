<?php
/*
class foo {
	public function __construct() {
		echo "I'm ".get_class($this)."\n";
	}
}

function createClass($classname, $extending) {
	eval('class '.$classname.' extends '.$extending.' {}');
}

createClass('bar', 'foo');

$foo = new foo();
$bar = new bar();
*/

/**
 * 
 */
function getBestSimilarString($original, $possibilities) {
	$r = array();
	foreach ($possibilities as $str) {
		$r[$str] = similar_text($original, $str);
	}
	return max($r);
}

function sortByBestSimilarString($a, $b) {
	global $__str_to_match;
	$a1 = similar_text($__str_to_match, $a['title']);
	$b1 = similar_text($__str_to_match, $b['title']);
	echo "a1 = $a1 et b1 = $b1\n";
	return ($b1 < $a1) ? -1 : (($b1 > $a1) ? 1 : 0);
}

$__str_to_match = $search = "game of thrones";
$filename 	= "http://www.tvsubtitles.net/search.php?q=".urlencode($search);
$doc		= new DOMDocument();

@$doc->loadHTML(file_get_contents($filename));

$xpath 		= new DOMXpath($doc);
$elements 	= $xpath->query("/html/body/div/div[3]/div/ul/li");
$ret 		= array();

foreach($elements as $el) 
{
	$id = (int)preg_replace("@/(.*)-([0-9]+)(.*)@", '$2', $xpath->query("div/a", $el)->item(0)->getAttribute('href'));
	$title = $xpath->query("div/a", $el)->item(0)->textContent;
	$langs = array();
	$imgs = $xpath->query('div/img', $el);
	foreach($imgs as $img) {
		$langs[] = strtoupper($img->getAttribute('alt'));
	}
	$ret[(string)$id] = array(
		'id' => $id,
		'title' => $title,
		'languages' => $langs
	);
}
uasort($ret, "sortByBestSimilarString");
var_dump($ret);
?>