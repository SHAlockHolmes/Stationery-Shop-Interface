<?php
include "db_connect.php";
session_start();

$uid=$_SESSION['user_id'];

$sql = "SELECT * from cia_cd c JOIN cia_login l ON (c.user_id = l.user_id) JOIN cia_country ct ON (c.pincode = ct.pincode) WHERE c.user_id like '$uid' ";
$result = oci_parse($conn, $sql);
$r = oci_execute($result);
$row = oci_fetch_array($result);

?>


<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<?php include('templates/navbar.php'); ?>
<body>
	<h4 class="center">My Account</h4>
	<div class="container">
		<div class="row">
			<div class="col s4">
				<div class="card z-depth-0">
					<div class="card-content center">
						<h5><?php echo "First Name: " ?></h5>
						<h6><?php echo htmlspecialchars($row[1])?></h6>
					</div>
				</div>
			</div>
			<div class="col s4">
				<div class="card z-depth-0">
					<div class="card-content center">
						<h5><?php echo "Last Name:" ?></h5>
						<h6><?php echo htmlspecialchars($row[2])?></h6>
					</div>
				</div>
			</div>
			<div class="col s4">
				<div class="card z-depth-0">
					<div class="card-content center">
						<h5><?php echo "Phone no:" ?></h5>
						<h6><?php echo htmlspecialchars($row[3])?></h6>
					</div>
				</div>
			</div>
			<div class="col s6">
				<div class="card z-depth-0">
					<div class="card-content center">
						<h5><?php echo "Address" ?></h5>
						<h6><?php echo htmlspecialchars($row[4]),", ",htmlspecialchars($row[5]),", ", htmlspecialchars($row[6]),","?>
						</h6>
						<h6><?php echo htmlspecialchars($row[13]), ", ",htmlspecialchars($row[14]),", ",htmlspecialchars($row[15]), " - ", htmlspecialchars($row[12])?></h6>
					</div>
				</div>
			</div>
			<div class="col s6">
				<div class="card z-depth-0">
					<div class="card-content center">
						<h5><?php echo "Email ID:" ?></h5>
						<h6><?php echo htmlspecialchars($row[10])?></h6>
					</div>
				</div>
			</div>
			<a href="updateMA.php">
			<div class="center">                            
            <input type="submit" name="submit" value="Update Info" class="btn brand z-depth-0">
        	</a>
            <a href="deleteAcc.php">			                           
            <input type="submit" name="DAsubmit" value="DELETE ACCOUNT" class="btn red z-depth-0">
        </a>
        </div> 
		</div>
	</div>
</body>
	
<?php include('templates/footer.php'); ?>
</html>
