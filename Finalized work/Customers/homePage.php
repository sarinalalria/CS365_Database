<?php
    session_start(); 
    include "./authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Claim A Car HomePage</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>


.goToPage-btn{
    width: 75%; 
    margin: 20px 0;
    padding: 10px 30px; 
    cursor: pointer; 
    display: block; 
    background: linear-gradient(to right, #378ac2, #808080);
    border: 0; 
    outline: none; 
    border-radius: 10px;
    color: white; 
}
</style>
</head>
<body>

<!-- Navbar -->
<?php include "./customerNavbar.php";?>


  
<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:0px">

  <div class="w3-row w3-padding-64">
    
    <br>
      <h3 style="color: Black; padding: 30px 0px 0px 0px;"><center>WELCOME TO </h3> </center>
      <center><h1 style="font-weight: bold;";><i> CLAIM A CAR</i> </h1></center>
      <br><br>
      <center> <h4> Here at Claim A Car, you can buy a car or you can buy parts for your car. </h4></center>
      
      <center> <h4> Find the best for you only at Claim A Car! </h4> </center>

      <br>
      <center>  
      <form action="buyACar.php" class="inline">
        <button class="goToPage-btn"> BUY A CAR</button>
     </form>
     
     <form action="buyParts.php" class="inline">
        <button class="goToPage-btn">BUY PARTS </button>
     </center>   
</div>  
   
<?php

   

?>

<!-- END MAIN -->
</div>


</body>
</html>