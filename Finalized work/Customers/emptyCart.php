<?php
    session_start(); 
    include "./authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Empty Cart</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>


.goToPage-btn{
    width: 35%; 
    margin: 20px 0;
    padding: 20px 30px; 
    cursor: pointer; 
    display: block; 
    background: black;
    border: 0; 
    outline: none; 
    border-radius: 10px;
    color: white; 
}
.cart{
    width: 50%; 
    margin: 5px 0;
    padding: 20px 30px; 
    background: #89CFF0;
    border: 0; 
    outline: none; 
    border-radius: 10px;
    color: black;  
}
tr td {
  padding: 5px;
  font-weight: bold;
}
</style>
</head>
<body>

<!-- Navbar -->
<?php include "./customerNavbar.php";?>



  <br><br>  
<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->


<?php
//echo $_SESSION["customerid"];
$sql = "delete from BuyCarCart where customerid=".$_SESSION["customerid"]." and cartid=".$_REQUEST["cartid"];
$result = $conn->query($sql);				
if($result){
               header("Location: buyACar.php");
			}
				

?>




</body>
</html>