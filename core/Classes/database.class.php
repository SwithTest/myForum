<?php 
/**
*  CLASSE QUI FAIT (POUR LE MOMENT) TOUTES LES INTERACTIONS AVEC LA BASE DE DONNÉE
*/

class Database {

	protected $db;

	function connect(){
		$con = null;
		 try{
            $con = new PDO('mysql:host=localhost;dbname=learning', 'root', 'root');
            $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // a suppr une fois dev fini
        }catch (Exception $e){
            echo "Impossible de se connecter à la base de donnée";
            echo $e->getMessage();
            die();
        }
		$this->db = $con;
	}

    /*
    * Simple query 
    * @params $fields : les champs que l'on veut récuperer laisser null si on veut tout récupérer 
    * @params $table : la table sur la quelle on fait la recherche
    * @params $limite : on devine non ?
    */
    public function find(array $fields=null,$table,$limite=null){

        if($fields==null){ $fields = "*"; }else{$fields = implode(",", $fields);}
        if($limite==null){$limite = '';}else{$limite = "LIMIT $limite";}
        $select = $this->db->query("SELECT $fields FROM $table $limite ");
        $data = $select->fetchAll();
        return $data;
    }

    /*
    * Recupère le premier enregistrement en base
    * @params $fields : les champs que l'on veut récuperer laisser null si on veut tout récupérer 
    * @params $table : la table sur la quelle on fait la recherche
    */
    public function first($fields=null,$table){

        if($fields==null){ $fields = "*"; }else{$fields = implode(",", $fields);
        $select = $this->db->query("SELECT $fields FROM $table");
        $data = $select->fetch();
        return $data;
    }

    /*
    * Recupère le dernier enregistrement en base
    * @params $fields : les champs que l'on veut récuperer laisser null si on veut tout récupérer 
    * @params $table : la table sur la quelle on fait la recherche
    */
    public function last($fields=null,$table){

        if($fields==null){ $fields = "*"; }
        $select = $this->db->query("SELECT $fields FROM $table ORDER BY id DESC");
        $data = $select->fetch();
        return $data;
    }

    /*
    * Recupère des entrées selon une condition
    * @params $data :  tableau des champs que l'on veut récuperer laisser null si on veut tout récupérer 
    * @params $field : le champ sur lequel porte la condition
    * @params $symbole : le symbole de la condition (=,!=...)
    * @params $value : valeur verifiée pour la condition
    * @params $limite : comme son nom l'indique
    */
    public function where(array $data=null,$field, $symbole,$value,$table,$limite=null){
        if($data==null){ $data = "*"; }else{$data = implode(",", $data);}
        if($limite==null){$limite = '';}else{$limite = "LIMIT $limite";}
        $select = $this->db->query("SELECT $data FROM $table WHERE $field $symbole $value $limite");
        if($select->rowCount() == 1){
            $data = $select->fetch();
        }else{
            $data = $select->fetchAll();
        }
        return $data;
    }

    /*
    * Créer un nouvel enregistrement en base 
    * @params $model :  la table sur la quelle on fait l'enregistrement 
    * @params $data : tableau des donnée à sauvegarder
    */
    public function create($model,$data) {
        if($model == "subject") {
            $title = ($data['title']);
            $content = $data['content'];
            $category_id = $data['category_id'];
            $this->db->query("INSERT INTO subjects (title,content,category_id) VALUES ('$title', '$content',$category_id)");
        }
        if($model == "reponses") {
            $content = $data['content'];
            $category_id = $data['category_id'];
            $id = $data['id'];
            $this->db->query("INSERT INTO reponses (content,category_id,subject_id) VALUES ('$content',$category_id,$id)");
        }
    }

    /*
    * incrémentation du nombe de réponse ou sujet quand on fait un nouvel enregistrement
    */
    public function up($model,$id){
         $this->db->query("UPDATE $model SET count = count +1 WHERE id=$id");
    }
	
}   