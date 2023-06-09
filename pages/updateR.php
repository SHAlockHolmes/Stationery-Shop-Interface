<?php 
include "db_connect.php";
session_Start();

$uid=$_SESSION['user_id'];
$revid = $_SESSION['revid'];

$review = $rating = '';

$errors = array('review'=>'', 'rating'=>'');
echo $revid;

$sql = "SELECT review, rating from cia_review where review_id like '$revid' ";
$result = oci_parse($conn, $sql);
$r=oci_execute($result);
$row=oci_fetch_array($result);

$review=$row[0];
$rating=$row[1];

if(isset($_POST['submit']))
{
	if(empty($_POST['review']))
		;
	else
		$review = $_POST['review'];

	if(empty($_POST['rating']))
		;
	else
		$rating = $_POST['rating'];	
	echo $review;
	echo $rating;
	$usql="UPDATE cia_review set review='$review', rating='$rating' where review_id like '$revid'";
	$uresult = oci_parse($conn,$usql);
	        oci_execute($uresult);
	if($uresult)
	{
		echo 'WE DID IT';
		$revid='';
		header('Location: MyReviews.php?success');
	}
	else
		echo 'WHYYYY';
	
}



?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<?php include('templates/navbar.php'); ?>
<body>

<section class="container grey-text">
	<h4 class="center">Update your Review</h4>
	<form class="white" method="POST">
		<label>Review:</label>
		<input type="text" name="review" value="<?php echo htmlspecialchars($review)?>" required >
		<div class="red-text"><?php echo $errors['review'] ?></div>

		<label>Rating out of 5:</label>
		<input type="text" name="rating" value="<?php echo htmlspecialchars($rating)?>" required>
		<div class="red-text"><?php echo $errors['rating'] ?></div>

		<div class="center">
			<input type="submit" name="submit" value="Update Review" class="btn brand z-depth-0">
		</div>
	</form>
		<div class="center">                           
        <a href="deleteR.php">			                           
            <input type="submit" name="DAsubmit" value="DELETE REVIEW" class="btn red z-depth-0">
        </a>
    </div>
</section>
</body>

<?php include('templates/footer.php'); ?>
</html>
