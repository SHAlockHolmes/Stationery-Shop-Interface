<?php
session_Start();
include "db_connect.php";

if(isset($_POST['username']) && isset($_POST['password']))
{
	
	function validate($data)
	{
		$data = trim($data);
    	$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}
	$username = validate($_POST['username']);
	$password = validate($_POST['password']);

	if(empty($username))
	{
		echo 'Username is required <br />';
	}

	 else if (empty($password))
	{
		echo 'Password is required <br />';
	}
	
	$sql = "SELECT * from cia_login WHERE username like '$username' AND password like '$password' ";
	$result = oci_parse($conn, $sql);
	oci_execute($result);

	if(oci_num_rows($result) == 0)
	{
		$row = oci_fetch_array($result);
		if($row)
		{
			if ($row[0] === $username && $row[3] === $password) //hmm
			{
				echo "Logged in";
				$_SESSION['username'] = $row[0];
				$_SESSION['email_id'] = $row[2];
				$_SESSION['user_id'] = $row[1];
				header("Location: shopby.php?logged in");
				exit();
			}
		}
		else
		{
		echo 'Invalid username or password';
		}

	}	
}

?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<section class="container grey-text">
	<h4 class="center">Login</h4>
	<form class="white" action="login.php" method="POST">
		<label>Username:</label>
		<input type="text" name="username" placeholder ="Username" required>
		<label>password</label>
		<input type="password" name="password" placeholder="Password" required>
		<div class="center">
			<button type="submit">Login</button>
		</div>
	</form>
</section>

<?php include('templates/footer.php'); ?>
</html>
