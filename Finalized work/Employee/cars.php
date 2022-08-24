<?php
    session_start(); 
    include "./authenticateEmployee.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Add Car</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
.goToPage-btn{
    width: 100%; 
    margin: 20px 0;
    padding: 10px 30px; 
    cursor: pointer; 
    display: block; 
    background: black;
    border: 0; 
    outline: none; 
    border-radius: 10px;
    color: white; 
}
</style>
</head>
<body>

<!-- Navbar -->
<?php include "./navbar.php";?>

<!-- Sidebar -->
<?php include "./sidebar.php";?>


<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:300px">

  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
    <br>
    <h1 class="w3-text-teal"><br>Add Car</h1>

      <?php 
    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
       $manufacturer = $_REQUEST["manufacturer_subbrandid"];
       $colorid = $_REQUEST["colorid"];
       $enginetypeid = $_REQUEST["enginetypeid"];
       $seattypeid = $_REQUEST["seattypeid"];
       $price = $_REQUEST["price"];
       $quanity = $_REQUEST["quantity"];
       $modelyearid = $_REQUEST["modelyearid"];

       
        $sql  = "Insert into manufacturer_brand(manufacturer_subbrandid, colorsid, enginetypeid, seattypeid, price, quantity_instock, modelyearid) Values('".$manufacturer."', '".$colorid."', '".$enginetypeid."', '".$seattypeid."', '".$price."', '".$quanity."', '".$modelyearid."') ";
        $result = $conn->query($sql);
        if($result){
            echo "Record Successfully Added";
        }else{
            echo "Record was not added";
        }
       }

  

?>

<form action="" method="POST">
<table class='w3-table'>
<tr class="w3-blue"><th colspan="2" class="w3-center">Cars </th></tr>
<tr><td>Manufacturer Sub-brand: </td><td><select name="manufacturer_subbrandid"><option value="">Pick Manufacturer Sub-Brand </option>

<?php

$sql = "Select  manufacturer_subbrandid, name from manufacturer_subbrand";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<option value='".$row["manufacturer_subbrandid"]."'> " . $row["name"]. "</option>";
    }
} 
    else 
{
        echo "No record found";
}  

?>

</select></td></tr>


<tr><td>Color: </td><td><select name="colorid"><option value="" disabled selected hidden>Pick Color</option>

<?php

$sql = "Select colorsid, name from colors";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
                echo "<option value='".$row["colorsid"]."'> " . $row["name"]. "</option>";
             }
    } 
    else 
    {
        echo "No record found";
    }  
   
?>

</select></td></tr>

<tr><td>Engine Type: </td><td><select name="enginetypeid"><option value="">Pick Engine Type</option>

<?php

$sql = "Select enginetypeid, name, cylinders from engine_type";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<option value='".$row["enginetypeid"]."'> " . $row["name"]. "</option>";
    }
} 
    else 
{
        echo "No record found";
}  
   
?>

</select></td></tr>

<tr><td>Seat Type: </td><td><select name="seattypeid"><option value="">Pick Seat Type</option>

<?php

$sql = "Select seattypeid, name from seat_type";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<option value='".$row["seattypeid"]."'> " . $row["name"]. "</option>";
    }
} 
    else 
{
        echo "No record found";
}  

?>

<tr><td>Price: </td><td><input name="price" value=""></td></tr>
<tr><td>Quantity: </td><td><input name="quantity" value=""></td></tr>

<tr><td>Model Year: </td><td><select name="modelyearid"><option value="">Pick Model Year</option>

<?php

$sql = "Select modelyearid, year from modelyear ORDER BY year DESC";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<option value='".$row["modelyearid"]."'> " . $row["year"]. "</option>";
    }
} 
    else 
{
        echo "No record found";
}  
  
?>

<tr><td colspan="2"><input class="goToPage-btn" type="submit" name="submit" value="Submit Data"></td></tr>


</table>

</form>

<?php
   $sql = "Select mb.manufacturer_brandid,mn.name as manuf,msub.name as subbrand,c.name as color,et.name as enginetype,st.name as seattype,my.year as modelyear,mb.price,mb.quantity_instock from manufacturer mn,manufacturer_brand mb,manufacturer_subbrand msub,colors c,engine_type et,seat_type st,modelyear my where mb.manufacturer_subbrandid=msub.manufacturer_subbrandid and mb.colorsid=c.colorsid and msub.manufacturerid=mn.manufacturerid 
   and mb.enginetypeid=et.enginetypeid and mb.seattypeid=st.seattypeid and mb.modelyearid=my.modelyearid";

   $result = $conn->query($sql);
       echo "<br><br><table class='w3-table-all' border='1px'>";
        echo "<tr class='w3-blue'><th class='w3-center' align='left'>ID</th><th class='w3-center'  >Subbrand</th><th class='w3-center'  align='left'>Colors</th><th class='w3-center' align='left'>Seat Type</th><th class='w3-center' align='left'>Engine Type</th><th class='w3-center' align='left'>Model Year</th><th class='w3-center'  align='left'>Price</th><th class='w3-center' align='left'>Quantity</th>";
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {

                  $carcolor="";
                  $carcolor = $row["color"];
                  
                  $manu="";
                  $manu = $row["subbrand"];
                  

                  $seat="";
                  $seat = $row["seattype"];
                  

                  $year="";
                  $year = $row["modelyear"];
                  
                  $engine="";
                  $engine = $row["enginetype"];
                  

           
                  
                   echo "<tr><td> " . $row["manufacturer_brandid"]. " </td><td> " . $manu. " </td><td> " .$carcolor ."</td><td> " .$seat ."</td><td> " . $engine. " </td><td> " .$year ."</td><td> " .$row['price'] ."</td><td> " .$row['quantity_instock'] ."</td></tr>";
                   
                }
       } 
       else 
       {
           echo "No record found";
       }   
   
       echo "</table>";
   $conn->close();
?>



<!-- END MAIN -->
</div>



</body>
</html>