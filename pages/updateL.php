<?php 
include "db_connect.php";
session_Start();

$uid=$_SESSION['user_id'];

$errors = array('username'=>'', 'password'=>'', 'email'=>'', 'cpassword'=>'');

$sql = "SELECT username, email_id, password from cia_login where user_id like '$uid' ";
$result = oci_parse($conn, $sql);
$r=oci_execute($result);
$row=oci_fetch_array($result);

$username = $row[0];
$email = $row[1];
$password = $row[2];
$cpassword = $row[2];


if(isset($_POST['submit']))
{
	if(!empty($_POST['email']))
		$email = $_POST['email'];

	if(!empty($_POST['password']))
		$password = $_POST['password'];

	if(!empty($_POST['cpassword']))
		$cpassword = $_POST['cpassword'];

	if($password == $cpassword)
	{

		$lsql="UPDATE cia_login set email_id='$email', password='$password' where user_id like '$uid'";
		$lresult = oci_parse($conn,$lsql);
		oci_execute($lresult);
		if($lresult)
		{
			header('Location: shopby.php?success');
		}
		else
			echo 'ERROR IN UPDATION';
		}
		else
		{
			$errors['password'] = 'password not matching';
			$errors['cpassword'] = 'password not matching';
		}
		
	}


?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>
<?php include('templates/navbar.php'); ?>
<body>

<section class="container grey-text">
	<h4 class="center">Update Login</h4>
	<form class="white" method="POST">
		<label>Username:</label>
		<input type="text" name="username" value="<?php echo htmlspecialchars($username)?>" readonly >
		<div class="red-text"><?php echo $errors['username'] ?></div>

		<label>Email ID:</label>
		<input type="text" name="email" value="<?php echo htmlspecialchars($email)?>" required>
		<div class="red-text"><?php echo $errors['email'] ?></div>

		<label>Password:</label>
		<input type="password" name="password" value="<?php echo htmlspecialchars($password)?>" required>
		<div class="red-text"><?php echo $errors['password'] ?></div>

		<label>Re Confrim Password:</label>
		<input type="password" name="cpassword" value="<?php echo htmlspecialchars($cpassword)?>" required>
		<div class="red-text"><?php echo $errors['cpassword'] ?></div>

		<div class="center">
			<input type="submit" name="submit" value="Update Login" class="btn brand z-depth-0">
		</div>
	</form>
		</div>
</section>
</body>

<?php include('templates/footer.php'); ?>
</html>
