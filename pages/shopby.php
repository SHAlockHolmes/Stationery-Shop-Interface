<?php
include "db_connect.php";
session_start();
if($_SESSION['user_id'])
$uid=$_SESSION['user_id'];
else
$uid='';

$sql = "SELECT category_name from cia_category ";
$result = oci_parse($conn, $sql);
$r = oci_execute($result);

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<?php if ($uid)
include('templates/navbar.php'); ?>
<body>
	<h4 class="center">Shop by category</h4>
	
		<div class="container">
			<div class="row">
				<?php while(($rrow = oci_fetch_assoc($result))!=false) { ?>
				<div class="col s4">
					<div class="card z-depth-0">
						<div class="card-content center">
						<h5><?php echo htmlspecialchars($rrow["CATEGORY_NAME"])?></h5>
						</div>
					</div>				
				</div>
				<?php } ?>
			</div>
		</div>
		
		
</body>	
<?php include('templates/footer.php'); ?>
</html>
