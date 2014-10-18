<?php 
	
	include "./core/Config/includes.php";
	include "./partials/header.php";

	$subjects = $bdd->where(null,'category_id','=',$_GET['id'],'subjects');

?>

<header>
	<h1>My Forum</h1>
</header>

<div class="container">
	<a href=<?php echo"addSubject.php?id=".$_GET['id'] ?> id="add">New subject</a>
	<ul id="forum">
		<?php foreach($subjects as $v): ?>
			<li class="category">
				<h2>
					<?php echo "<a href='show.php?id=".$v->id."'>". $v->title; ?></a>
					<span class="count">Total<?php echo " ".$v->count; ?> réponses</span>
				</h2>
				<p><?php echo cut($v->content, 50); ?></p>
			</li>
		<?php endforeach; ?>
	</ul>
</div>

<?php include "./partials/footer.php"; ?>