<?php
include "db_connect.php";
session_Start();

$uid = $_SESSION['user_id'];

$fname = $lname = $ad1 = $ad2 = $street = $city= $country = $state = '';
$phno = $pcode = '';
$c=1;

$errors = array('fname' => '', 'lname'=> '', 'ad1' => '', 'ad2' => '', 'street' => '', 'city' => '', 'country' => '', 'state' => '', 'phno' => '', 'pcode' => '');

if(isset($_POST['submit'])){

    if(empty($_POST['fname']))
        $errors['fname'] = 'first name is required';
    else {
        if (preg_match('/^[a-zA-Z\s]+$/',trim('$fname') ))
            $errors['fname'] = 'Enter valid first name';
        else
            $fname = $_POST['fname'];
    }

    if(empty($_POST['lname']))
        $errors['lname'] = 'Last name is required';
    else {
        if (preg_match('/^[a-zA-Z\s]+$/',trim('$lname') ))
            $errors['lname'] = 'Enter valid last name';
        else
            $lname = $_POST['lname'];
    }

    if(empty($_POST['phno']))
        $errors['phno'] = 'Phone number is required.';
    else
        $phno=(int)$_POST['phno'];


    if (empty($_POST['ad2']) && empty($_POST['ad1']))
    {
        $errors['ad1'] = 'At least one address line is required';
        $errors['ad2'] = 'At least one address line is required';
    }
    else{
        if(isset($_POST['ad1']))
            $ad1=$_POST['ad1'];
        if(isset($_POST['ad2']))
            $ad2=$_POST['ad2'];
    }

    if(empty($_POST['street']))
        $errors['street'] = 'Street is required';
    else
        $street=$_POST['street'];

    if(empty($_POST['pcode']))
        $errors['pcode'] = 'Pincode is required';
    else {
        $pcode = (int)$_POST['pcode'];
        $psql = "SELECT * FROM cia_country WHERE pincode like '$pcode' ";
        $pr = oci_parse($conn, $psql);
        oci_execute($pr);
        $prow=oci_fetch_row($pr);
        if($prow)
            $errors['pcode'] = 'No need to enter city, state and country';
        else
        {
            if(empty($_POST['city']))
                $errors['city'] = 'City is required';

            if(empty($_POST['state']))
                $errors['state'] = 'State is required';
            
            if(empty($_POST['country']))
                $errors['country'] = 'Country is required';
            
           if(isset($_POST['city']) && isset($_POST['state']) && isset($_POST['country']))
           {
                $city=$_POST['city'];
                $state=$_POST['state'];
                $country=$_POST['country'];

                $csql="INSERT INTO cia_country VALUES ($pcode, '$city', '$state', '$country')";
                $cr = oci_parse($conn,$csql);
                oci_execute($cr);
                if($cr)
                    echo 'creation done';
                else
                    echo 'sorry some error';

           }            
        }
        $sql = "UPDATE cia_cd set first_name = '$fname', last_name = '$lname', phone_no = $phno, adline1 = '$ad1', adline2='$ad2', street='$street', pincode='$pcode' where user_id like '$uid' ";
        $result = oci_parse($conn,$sql);
        oci_execute($result);
        if($result)
            header('Location: MyAccount.php');
        else
            echo 'Sorry there was an error';
    }
}

?>
<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<section class="container grey-text">
    <h4 class="center">New Account Details</h4>
    <form class="white" action="cdcreate.php" method="POST">

        <label>First Name:</label>
        <input type="text" name="fname" value="<?php echo htmlspecialchars($fname)?>">
        <div class="red-text"><?php echo $errors['fname'] ?></div>

        <label>Last Name:</label>
        <input type="text" name="lname" value="<?php echo htmlspecialchars($lname)?>">
        <div class="red-text"><?php echo $errors['lname'] ?></div>
        
        <label>Phone Number:</label>
        <input type="text" name="phno" value="<?php echo htmlspecialchars($phno)?>">
        <div class="red-text"><?php echo $errors['phno'] ?></div>
        
        <label>Address Line 1:</label> 
        <input type="text" name="ad1" value="<?php echo htmlspecialchars($ad1)?>">
        <div class="red-text"><?php echo $errors['ad1'] ?></div>
        
        <label>Address Line 2</label> 
        <input type="text" name="ad2" value="<?php echo htmlspecialchars($ad2)?>">
        <div class="red-text"><?php echo $errors['ad2'] ?></div>

        <label>Street</label> 
        <input type="text" name="street" value="<?php echo htmlspecialchars($street)?>">
        <div class="red-text"><?php echo $errors['street'] ?></div>

        <label>Pincode</label> 
        <input type="text" name="pcode" value="<?php echo htmlspecialchars($pcode)?>">
        <div class="red-text"><?php echo $errors['pcode'] ?></div>

        <label>City</label> 
        <input type="text" name="city" value="<?php echo htmlspecialchars($city)?>">
        <div class="red-text"><?php echo $errors['city'] ?></div>

        <label>State</label>
        <input type="text" name="state" value="<?php echo htmlspecialchars($state)?>">
        <div class="red-text"><?php echo $errors['state'] ?></div>

        <label>Country</label>
        <input type="text" name="country" value="<?php echo htmlspecialchars($country)?>">
        <div class="red-text"><?php echo $errors['country'] ?></div>

        <div class="center">                            
            <input type="submit" name="submit" value="Confirm Details" class="btn brand z-depth-0">
        </div>
</section>

<?php include('templates/footer.php'); ?>
</html>

