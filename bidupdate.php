<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title> approval </title>

<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<script src="http://code.jquery.com/jquery-latest"></script>
<style>
body{
    background-color: #f2f2f2;
}

#menu {
  position:fixed;
  top:0px;
  width:100%; 
  color: #FFFFFF;
  z-index:9999;

}



.navbar {
    overflow: hidden;
    background-color: #333;
    font-family: Arial;
}

.navbar a {
    float: right;
    font-size: 16px;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.dropdown {
    float: right;
    overflow: hidden;
}

.dropdown .dropbtn {
    cursor: pointer;
    font-size: 16px;    
    border: none;
    outline: none;
    color: white;
    padding: 14px 16px;
    background-color: inherit;
    font: inherit;
    margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn, .dropbtn:focus {
    background-color: red;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    float: none;
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.show {
    display: block;
}
</style>
</head>
<body>
<div class="navbar" id="menu">

  <a href="#" style="float: left"><strong>BUYNSELL NITC</strong></a>
  <div class="dropdown">
     <a href="index1.php" style="background-color: #45a049;">Signout</a>
     
  <a href="confirmsale.php">Account</a>
  <a href="about.php">About</a>
  <a href="sell.php">Sell</a>
  <a href="opensale.php">Open Sale</a>
   <a href="upcoming.php">Upcoming Items</a>
  <a href="auction.php">Auction Sale</a>
  <a href="homepage.php" style="color:orange">Home</a>
</div>
</div>
<br><br>
<br>
<br>

<?php

$conn = new mysqli("localhost", "root", "Hello@123", "se");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sellerid = $_SESSION['username'];
$option=mysqli_real_escape_string($conn, $_POST['itemid']);
$bid=mysqli_real_escape_string($conn, $_POST['bid']);
$hbid=mysqli_real_escape_string($conn, $_POST['hicupr']);
$currentdate=date("Y-m-d h:i:sa");


if($bid>$hbid){

$sql = "UPDATE auctionsale SET currentprice=$bid WHERE itemid=$option";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error updating record: " . $conn->error;
}

$sql4 = "UPDATE auctionsale SET bidwinner='$sellerid' WHERE itemid=$option";

if ($conn->query($sql4) === TRUE) {
    echo "";
} else {
    echo "Error updating record: " . $conn->error;
}

$sql1 = " INSERT INTO bidrecord(itemid,bidamount,time,bidderid) VALUES ('$option','$bid','$currentdate','$sellerid')";

if ($conn->query($sql1) === TRUE) {
    echo "Bid Recorded!";
} else {
    echo "Error updating record: " . $conn->error;
}

}

else{
	echo "Entered Bid is invalid";
}

?>
<footer style="position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #333;
    color: white;
    text-align: center;"
  <center>
  
  Logged in as :
    <?php
     echo $_SESSION['username'];
     ?>
  
  </center>
</footer>
</body>
</html>