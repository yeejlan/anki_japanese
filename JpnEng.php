<?php

class JpnEng {

	var $file = 'dict/jpn_eng.txt';
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

	public function getEngArr($key) {
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
				$arr = explode("\t", $line, 3);
				$key = trim($arr[0]);
				$value = trim($arr[1]);
				$wordList[$key] = $value;
			}
			$this->wordMap = $wordList;
			$this->wordMapInit = true;
		}
	}

}


$eng = new JpnEng(false);
var_dump($eng->getEngArr('暑い'));

//string(20) "【形】  天气热"
