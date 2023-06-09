<?php

/*if(isset($_GET['submit'])){
	echo $_GET['name'];
	echo $_GET['era']; //$_ means global variables
}**/

if(isset($_POST['submit'])){
	echo htmlspecialchars($_POST['name']);
	echo htmlspecialchars($_POST['era']); //$_ means global variables
}

?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<?php include('templates/navbar.php'); ?>

<section class="container grey-text">
	<h4 class="centre">Add a composer</h4>
	<form class="white" action="add.php" method="POST">
		<label>Composer:</label>
		<input type="text" name="name">
		<label>Era:</label>
		<input type="text" name="era">
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
		</div>
</section>

<?php include('templates/footer.php'); ?>
</html>

