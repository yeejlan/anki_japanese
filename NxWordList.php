<?php

class NxWordList {

	var $file = '';
	var $wordMap = array();
	var $wordMapInit = false;

	public function __construct($file) {
		$this->file = $file;
		$this->initWordMap();
	}

	public function dump() {
		print_r($this->wordMap);
	}

	public function getWordList() {
		return $this->wordMap;
	}

	public function normalizeWord($word) {
		$arr = explode('、', $word);
		$word = $arr[0];
		$arr = explode('・', $word);
		$word = $arr[0];		
		$arr = explode(',', $word);
		$word = $arr[0];
		return trim($word);
	}
	
	private function initWordMap() {
		if(!$this->wordMapInit) {
			$contentArr = file($this->file);
			$wordList = array();
			foreach($contentArr as $line) {
				$wordList[] = explode("\t", $line);
			}
			$this->wordMap = $wordList;
			$this->wordMapInit = true;
		}
	}

}


//$n5 = new NxWordList('words/VocabList.N5.txt');
//print_r($n5->getWordList());
