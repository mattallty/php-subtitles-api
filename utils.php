<?php
function dice_coefficient($str1, $str2) {
	$intersection = 0;
	$length1 = strlen($str1) - 1;
	$length2 = strlen($str2) - 1;
	if($length1 < 1 || $length2 < 1) return 0;
	$bigrams2 = array();
	for($i = 0; $i < $length2; $i++) {
		$bigrams2[] = substr($str2, i, 2);
	}
	for($i = 0; $i < $length1; $i++) {
    	$bigram1 = substr($str1, $i, 2);
		for($j = 0; $j < $length2; $j++) {
			if($bigram1 == $bigrams2[$j]) {
				$intersection++;
				$bigrams2[$j] = null;
				break;
			}
		}
	} 
	return (2.0 * $intersection) / ($length1 + $length2);  
}