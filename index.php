<?php 
	
	include "./core/Config/includes.php";
	include "./partials/header.php";

	// On récupère le title, description, id et le nombre de sujet de toutes les catégories
	$categories = $bdd->find(['title','description','id','count'],"categories");

	// On récupère l'id, le title, le content, et l'id de la catégorie des sujets
	$subjects = $bdd->find(['id','title','content','category_id'],'subjects');

?>

<header>
	<h1>My Forum</h1>
</header>
<div class="container">
	<ul id="forum">
		<?php foreach($categories as $v): ?>
			<li class="category">
				<h2>
				<?php echo lien("subject",utf8_encode($v->title),['id'=>$v->id]); ?>
					<span class="count">Total<?php echo " ".$v->count; ?> sujets</span>
				</h2>
				<h3><?php echo utf8_encode($v->description); ?></h3>
				<ul class="subjects">
					<?php foreach($subjects as $s) {
						if($s->category_id == $v->id) {
								echo "<li><h4>".lien('show',$s->title,['id'=>$s->id])."</h4>
									<span>".cut($s->content,50)."</span>
								</li>";
							}
						}
					?>
				</ul>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<?php include "./partials/footer.php"; ?>