<?php

require_once 'NxWordList.php';
require_once 'HnkVoice.php';
require_once 'JpnChn.php';


$nxWord = new NxWordList('words/VocabList.N5.txt');
$wordList = $nxWord->getWordList();
$hnkDict = new HnkVoice(false);
$chnDict = new JpnChn(false);

$hnk_hits = $hnk_missing = 0;
$chn_hits = $chn_missing = 0;

$outputMap = array();
for($i=0; $i<count($wordList); $i++) {
	$one = $wordList[$i];
	$word = $one[0];
	if($word == ''){
		$word = $one[1];
	} 
	$key = normalizeWord($word);
	$kana = $one[1];
	$english = trim($one[2]);

	$audio = $hnkDict->getMp3($key);
	if($audio) {
		$hnk_hits ++;
		$audio = "[sound:{$audio}]";
	}else{
		$hnk_missing ++;
		$audio = '';
		//echo "$word [$key] ", PHP_EOL;
	}



	$chinese = $chnDict->getChn($key);
	if($chinese){
		$chn_hits ++;
	}else{
		$chn_missing ++ ;
		$chinese = '';
	}

	$outputMap[] = array(
			'word' => $word,
			'kana' => $kana,
			'english' => $english,
			'chinese' => $chinese,
			'audio' => $audio,
		);

	echo "{$word}\t{$kana}\t{$english}\t{$chinese}\t$audio\r\n";
}

//print_r($outputMap);
//echo "hnk_hits ={$hnk_hits} hnk_missing = {$hnk_missing};  chn_hits = {$chn_hits} chn_missing = {$chn_missing}",PHP_EOL;



function normalizeWord($word) {
	$arr = explode('/', $word);
	$word = $arr[0];	
	$arr = explode('、', $word);
	$word = $arr[0];
	$arr = explode('・', $word);
	$word = $arr[0];		
	$arr = explode(',', $word);
	$word = $arr[0];
	return trim($word);
}


