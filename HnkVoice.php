<?php

class HnkVoice {

	var $file = 'dict/hnk_voice.txt';
	var $wordMap = array();
	var $wordMapInit = false;

	public function __construct($file) {
		if($file) {
			$this->file = $file;
		}
		$this->initWordMap();
	}

	public function dump() {
		print_r($this->wordMap);
	}

	public function getMp3($key) {
		if(isset($this->wordMap[$key])) {
			return $this->wordMap[$key];
		}
		return false;
	}

	public function getWordList() {
		return $this->wordMap;
	}
	
	private function initWordMap() {
		if(!$this->wordMapInit) {
			$contentArr = file($this->file);
			$wordList = array();
			foreach($contentArr as $line) {
				$arr = explode("\t", $line, 2);
				$key = trim($arr[0]);
				$value = trim($arr[1]);
				$wordList[$key] = $value;
			}
			$this->wordMap = $wordList;
			$this->wordMapInit = true;
		}
	}

}


//$hnk = new HnkVoice(false);
//echo $hnk->getMp3('暑い');
