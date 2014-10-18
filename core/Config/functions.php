<?php 

// FONCTIONS UTILES PARTOUT 

	/*
	* Permet de réduire le nombre de caractères d'une chaine
	*/
	function cut($string,$limit) {
		return substr($string, 0, $limit);
	}

	/*
	* Génère un lien plus pratique que de faire des concaténation à chaque fois...
	*/
	function lien($lien,$name,array $params = null,array $options = null) {
		$return = "<a href='$lien.php";

		if($params != null) {
			$return .= "?";
			if(isset($params['id'])) {
				$id = $params['id'];
				$return .= "id=$id";
			}
		}

		if($options != null) {
			if(isset($options['id'])) {
				$id = $options['id'];
				$return .= "' id=$id";
			}
			if(isset($options['class'])) {
				$class = $options['class'];
				$return .= " class=$class";
			}

			$return .= " >$name</a>";
			return $return;
		}

		$return .= "' >$name</a>";
		return $return;

	}

?>