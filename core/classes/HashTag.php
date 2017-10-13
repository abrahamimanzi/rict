<?php
class HashTag
{
	public static function gethashtags($text){
		//Match the hashtags
		preg_match_all('/(^|[^a-z0-9_])#([a-z0-9_]+)/i', $text, $matchedHashtags);
		$hashtag = '';
		// For each hashtag, strip all characters but alpha numeric
		if(!empty($matchedHashtags[0])) {
			foreach($matchedHashtags[0] as $match) {
				$hashtag .= preg_replace("/[^a-z0-9]+/i", "", $match).',';
			}
		}
		//to remove last comma in a string
		return rtrim($hashtag, ',');
	}
}
