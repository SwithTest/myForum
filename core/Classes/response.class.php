<?php

class Response {
	
	private $db, $id, $author_id, $category_id, $content;

	public function __construct(array $data, $db) {
		$this->db = $db;
		$this->content = $data['content'];
		//$this->author_id = $data['author_id'];
		$this->category_id = $data['category_id'];
	}
	
	public function validate(){
		$valid = false;
		//validation du contenu
		if(strlen($this->content) > 20) {
			$valid = true;
		}
		return $valid;
	}

	public function create(){
		$this->db->query("INSERT INTO reponses (content) VALUES ('dqzdozd')");
	}

}