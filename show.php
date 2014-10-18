<?php 
	
	include('./core/Config/includes.php');
	include('./partials/header.php');

	$reponses = $bdd->where(null,'subject_id','=',$_GET['id'],'reponses');
	$sujet = $bdd->where(null,'id','=',$_GET['id'],'subjects');

?>

<header>
	<h1>Mon forum</h1>
</header>
<div class="container">
	<h2 class="head"><?php echo $sujet->title; ?></h2>
	<p class="content"><?php echo $sujet->content; ?></p>
	
	<?php echo lien("./process/addResponse","New answer",['id'=>$_GET['id']],['id'=>'add']); ?>
	
	<ul>
		<?php foreach($reponses as $v): ?>
			<li>
				<p><?php echo $v->content; ?></p>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<?php include "./partials/footer.php"; ?>