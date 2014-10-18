<?php 
	/*
		Permet d'ajouter une réponse 
	*/
	include('../core/Config/includes.php');
	include('../partials/header.php');

	// On charge la class Reponse
	include('../core/Classes/response.class.php');


	$sujet = $bdd->where(null,'id','=',$_GET['id'],'subjects');

	if(isset($_POST['content'])) {

		if(!empty($_POST['content'])) {
			$d['content'] = htmlspecialchars($_POST['content']);
			$d['category_id'] = $sujet->category_id;
			$d['id'] = $_GET['id'];
			$reponse = new Response($d,$bdd); // On créer un nouvel objet de type réponse
			if($reponse->validate()){ // Si ce nouvel objet est valide (content > 20 caractères)
				$reponse->create(); //truc peter pour le moment ^^
				$bdd->create('reponses',$d); //  on créer un nouvel enregistrement en base de donnée
				$bdd->up('subjects',$d['id']); //truc peter pour le moment ^^
				header("Location:show.php?id=".$_GET['id']);
			}else{
				$erreur = "Veuillez verifier vos entrées";
			}

		}else {
			$erreur = "Veuillez verifier vos entrées";
		}
	}
?>

<?php 
	if (isset($erreur)) {
		echo($erreur);
	}
?>
<header>
	<h1>My Forum</h1>
</header>
<div class="container">
	<h2>Répondre</h2>
	<form action="#" method="post">
		<label for="content">Contenu</label>
		<textarea id="content" name="content" rows="10" cols="50"></textarea>
		</br>
		<input type="submit" value="Créer">
	</form>
</div>

<?php include('../partials/footer.php'); ?>