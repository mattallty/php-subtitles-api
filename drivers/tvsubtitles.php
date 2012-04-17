<?php
/**
 * TVSubtitles.net driver
 * 
 * @author Matthias ETIENNE <matt@allty.com>
 */
class Subtitles_TVSubtitles {
	
	const URL_SHOW_SEARCH = 'http://www.tvsubtitles.net/search.php';
	const URL_SHOW_SEASON = 'http://www.tvsubtitles.net/tvshow-%s-%s.html';
    const URL_SHOW_EPISODE= 'http://www.tvsubtitles.net/episode-%s.html';
	
	public function search($type, $query, $lang = '') {
		
	}
}
?>