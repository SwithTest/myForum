<?php

// VOIR reponse.class.php même fonctionnement ^^

class Subject {
	
	private $title;
	private $content;

	public function __construct($title,$content) {
		$this->title = $title;
		$this->content = $content;
	}
	
	public function validate(){
		$valid = false;
		$validTitle = false;
		$validContent = false;
		
		//validation du titre 
		if(strlen($this->title) > 5) {
			$validTitle = true;
		}
		//validation du contenu
		if(strlen($this->content) > 20) {
			$validContent = true;
		}
		$valid = $validContent + $validTitle;
		return $valid;
	}

}