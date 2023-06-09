<?php 
include "db_connect.php";
session_Start();

$uid=$_SESSION['user_id'];
$revid = $_SESSION['revid'];

$sql = "SELECT r.review_id, r.review, r.rating, p.product_name, p.brand, p.price from cia_review r JOIN cia_login l ON (r.user_id = l.user_id) JOIN cia_product p ON (r.product_id = p.product_id) WHERE r.review_id like '$revid' ";
$result = oci_parse($conn, $sql);
$r = oci_execute($result);
$row=oci_fetch_array($result);

if(isset($_POST['del']))
{
	echo 'PLEASE';
	$dsql = "DELETE from cia_review where review_id like '$revid'";
	$dresult= oci_parse($conn, $dsql);
	oci_execute($dresult);
	if($dresult)
	{
	$revid='';
	header("Location: MyReviews.php");
	}
	
}


echo $revid
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<?php include('templates/navbar.php'); ?>
<body>

<section class="container grey-text">
	<h4 class="center">Are you sure you want to delete your review?</h4>
	<h6 class="red-text center">This action cannot be undone</h6>
		<div class="row">
			<div class="col s12">
				<div class="card z-depth-0">
					<div class="card-content center">
						<span class="blue-text text-darken-2">
							<a href="add.php">
							<?php echo htmlspecialchars($row[3]),", Brand: ", htmlspecialchars($row[4]), ", Price: Rs.", htmlspecialchars($row[5]), ", Review id: ", htmlspecialchars($revid); 
							?>
							</a>
						</span>
						<h5><?php echo htmlspecialchars($row[1]),"\t", htmlspecialchars($row[2]),"/5 stars"?></h5>
					</div>
				</div>
			</div>
			<div class="center"> 
				<form method="POST">
					<input type="hidden">
					<input type="submit" name="del" value="CONFIRM" class="btn red z-depth-0">
				</form>
	   		</div>
		</div>
		
</section>
</body>

<?php include('templates/footer.php'); ?>
</html>
