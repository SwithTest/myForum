<?php 
	
	include "./core/Config/includes.php";
	include "./partials/header.php";

	include "./core/Classes/subject.class.php";

	if(isset($_POST['title']) && isset($_POST['content'])) {

		if(!empty($_POST['title']) && !empty($_POST['content'])) {
			$d['title'] = htmlspecialchars($_POST['title']);
			$d['content'] = htmlspecialchars($_POST['content']);
			$d['category_id'] = $_GET['id'];
			$sujet = new Subject($d['title'],$d['content']);
			if($sujet->validate()){
				$bdd->create('subject',$d);
				$bdd->up('categories',$d['category_id']);

			}else{
				$erreur = "Veuillez verifier vos entrées";
			}

		}else {
			$erreur = "Veuillez verifier vos entrées";
		}
	}
?>

<h1>Ajouter un sujet</h1>
<?php 
	if (isset($erreur)) {
		echo($erreur);
	}
?>
<form action="#" method="post">
	<label for="title">Titre du sujet</label>
	<input type="text" id="title" name="title" /></br>
	<label for="content">Contenu</label>
	<textarea id="content" name="content" rows="10" cols="50"></textarea>
	</br>
	<input type="submit" value="Créer">
</form>

<?php include "./partials/footer.php"; ?>