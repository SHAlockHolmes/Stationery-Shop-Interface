<?php
include "db_connect.php";
session_Start();
$email = $username = $password ='';
$errors = array('email'=> '', 'username'=> '', 'password' => '');

if(isset($_POST['submit'])){

    if(empty($_POST['email']))
    {
        $errors['email'] = 'An Email ID is required';
    } else {
        $email = $_POST['email'];
        $esql = "SELECT email_id from cia_login WHERE email_id like '$email' ";
        $er = oci_parse($conn,$esql);
        oci_execute($er);
        $erow=oci_fetch_row($er);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email ID must be a valid email address';
        }
        else if ($erow)
        {
            $errors['email'] = 'Email ID already registered';
        }
    }

    if(empty($_POST['username'])){
        $errors['username'] = 'An username is required';
    } else {
        $username = $_POST['username'];
        $usql = "SELECT username from cia_login WHERE username like '$username' ";
        $ur = oci_parse($conn,$usql);
        oci_execute($ur);

        $urow=oci_fetch_row($ur);
        if (preg_match('/^[a-zA-Z\s]+$/',trim('$username') ))
            $errors['username'] = 'Invalid username, no spaces';
        else if ($urow)
            $errors['username'] = 'Username is already taken';
    }

    if(empty($_POST['password'])){
        $errors['password'] = 'An password is required';
    } else {
        $password = $_POST['password'];
        $psql = "SELECT password from cia_login WHERE password like '$password' ";
        $pr = oci_parse($conn,$psql);
        oci_execute($pr);

        $prow=oci_fetch_row($pr);

        if (preg_match('/^[a-zA-Z]+$/',trim('$password') ))
            $errors['password'] = 'Invalid password only numbers and letters';
        else if ($prow)
            $errors['password'] = 'Please enter a unique password';
    }

    if (array_filter($errors))
    {

    } else {
        $uid = "NU".strval(rand(1000,9999));

        $_SESSION['user_id'] = $uid;
        $cdsql = "INSERT INTO cia_cd VALUES ('$uid','','',0,'','','',0 )";
        $cdr = oci_parse($conn,$cdsql);
        oci_execute($cdr);

        $sql = "INSERT INTO cia_login VALUES ('$username', '$uid', '$email', '$password')";
        $result = oci_parse($conn,$sql);
        oci_execute($result);
        
        if($result)
            header ('Location: cdcreate.php');
        else
            echo 'Sorry there was an error';

        
    }
}

?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">Create an Account</h4>
    <form class="white" action="AccCreation.php" method="POST">
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo htmlspecialchars($email)?>">
        <div class="red-text"><?php echo $errors['email'] ?></div>
        <label>Username:</label>        
        <input type="text" name="username" value="<?php echo htmlspecialchars($username) ?>">
        <div class="red-text"><?php echo $errors['username'] ?></div>
        <label>Password:</label>
        <input type="password" name="password" value="<?php echo htmlspecialchars($password)?>">
        <div class="red-text"><?php echo $errors['password'] ?></div>
        <div class="center">
            <input type="submit" name="submit" value="Sign Up!" class="btn brand z-depth-0">
        </div>
</section>

<?php include('templates/footer.php'); ?>
</html>

