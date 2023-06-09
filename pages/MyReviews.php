<?php
include "db_connect.php";
session_start();

$revid='';

$uid=$_SESSION['user_id'];

$sql = "SELECT r.review_id, r.review, r.rating, p.product_name, p.brand, p.price from cia_review r JOIN cia_login l ON (r.user_id = l.user_id) JOIN cia_product p ON (r.product_id = p.product_id) WHERE r.user_id like '$uid' ";
$result = oci_parse($conn, $sql);
$r = oci_execute($result);

if(isset($_POST['submit']))
{
	echo 'YES??';
	$revid=$_POST['revid'];
	$_SESSION['revid']=$revid;
	header('Location: updateR.php');
	exit();
}
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<?php include('templates/navbar.php'); ?>
<body>
	<h4 class="center">My Review</h4>
		<div class="container">
			<div class="row">
				<div class="col s12">
				<?php while(($rrow = oci_fetch_assoc($result))!=false) { ?>
					<div class="card z-depth-0">
						<div class="card-content center">
							<span class="blue-text text-darken-2">
								<a href="add.php">
								<?php echo htmlspecialchars($rrow["PRODUCT_NAME"]),", Brand: ", htmlspecialchars($rrow["BRAND"]), ", Price: Rs.", htmlspecialchars($rrow["PRICE"]), ", Review id: ", htmlspecialchars($rrow["REVIEW_ID"]); 
								?>
								</a>
							</span>
							<h5><?php echo htmlspecialchars($rrow["REVIEW"]),"\t", htmlspecialchars($rrow["RATING"]),"/5 stars"?></h5>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<section class="container grey-text">
		    	<h4 class="center">Update a review</h4>
		    	<form class="white" method="POST">
		    		<label>Review ID:</label>
					<input type="text" name="revid" required>
					<div class="center">                            
            		<input type="submit" name="submit" value="Go to update" class="btn brand z-depth-0">
        			</div>
		    	</form>
	    	</section>
			</div>
		</div>
		
	</body>
	
<?php include('templates/footer.php'); ?>
</html>
