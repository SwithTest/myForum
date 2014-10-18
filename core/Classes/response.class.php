<?php

class Response {
	
	// Variable des objets Response
	private $db, $id, $author_id, $category_id, $content;

	// fonction appellée dès qu'on créer un instance de la classe
	public function __construct(array $data, $db) {
		$this->db = $db; // marche pas pour le moment
		$this->content = $data['content']; // en gros on dit que le contenu de l'objet c'est le contenu qu'on envoie en argument
		//$this->author_id = $data['author_id'];
		$this->category_id = $data['category_id']; // idem mais pour l'id de catégory
	}
	
	/*
	* Fonction qui vérifie qu'on a plus de 20 caractères dans le contenu
	*/
	public function validate(){
		$valid = false;
		//validation du contenu
		if(strlen($this->content) > 20) {
			$valid = true;
		}
		return $valid;
	}

	// est sensé remplacer celui dans database.class.php ^^
	public function create(){
		$this->db->query("INSERT INTO reponses (content) VALUES ('dqzdozd')");
	}

}