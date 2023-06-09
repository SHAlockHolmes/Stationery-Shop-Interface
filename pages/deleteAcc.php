<?php 
include "db_connect.php";
session_Start();

$uid=$_SESSION['user_id'];

if(isset($_POST['del']))
{
	$rsql = "DELETE from cia_review where user_id like '$uid'";
	$rr = oci_parse($conn, $rsql);
	oci_execute($rr);

	$lsql = "DELETE from cia_login where user_id like '$uid'";
	$lr = oci_parse($conn, $lsql);
	oci_execute($lr);

	$csql = "DELETE from cia_cd where user_id like '$uid'";
	$cr = oci_parse($conn, $csql);
	oci_execute($cr);
	if($cr)
	{
		header("Location: logout.php");
		$uid='';
	}
	else
		echo 'error';

	


}
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<?php include('templates/navbar.php'); ?>
<body>

<section class="container grey-text">
	<h4 class="center">Are you sure you want to delete your Account?</h4>
	<h6 class="red-text center">This action cannot be undone</h6>
		<div class="row">
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
