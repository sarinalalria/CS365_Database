<?php
    session_start(); 
    include "./authenticateEmployee.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Add part type</title>
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
    
    <h1 class="w3-text-teal"><br>Add Parts_type </h1>
    <?php 
    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
       $manufacturer = $_REQUEST["manufacturerid"];
       $manufacturersubbrand = $_REQUEST["manufacturer_subbrandid"];
       $parts = $_REQUEST["partsid"];
       $name = $_REQUEST["name"];
       $price = $_REQUEST["price"];
       $quantity = $_REQUEST["iteminstock"];

       
        $sql  = "Insert into part_type(partsid, name, price, iteminstock, manufacturerid, manufacturer_subbrandid) Values('".$parts."','".$name."','".$price."','".$quantity."','".$manufacturer."','".$manufacturersubbrand."') ";
        $result = $conn->query($sql);
        if($result){
            echo "Record Successfully Added";
        }else{
            echo "Record was not added";
        }
       }

  

?>
<form action="" method="POST">
<table class="w3-table">
<tr class="w3-blue"><th colspan="3" class="w3-center">Part Type </th></tr>
<tr><td>Manufacturer: </td><td><select name="manufacturerid"><option value="">Pick Manufacturer </option>

<?php

$sql = "Select manufacturerid, name from manufacturer";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<option value='".$row["manufacturerid"]."'> " . $row["name"]. "</option>";
    }
} 
    else 
{
        echo "No record found";
}  

?>

<tr><td>Manufacturer Sub - Brand: </td><td><select name="manufacturer_subbrandid"><option value="">Pick Manufacturer Sub-Brand </option>

<?php

$sql = "Select distinct manufacturer_subbrandid, name from manufacturer_subbrand";

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
<tr><td>Parts: </td><td><select name="partsid"><option value="">Pick parts </option>

<?php

$sql = "Select partsid, name, manufacturerid, manufacturer_brandid from parts";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "<option value='".$row["partsid"]."'> " . $row["name"]. "</option>";
    }
} 
    else 
{
        echo "No record found";
}  
//"Select partsid, name from parts";
?>

</select></td></tr>

<tr><td> Name: </td><td><input name="name" value=""></td></tr>
<tr><td>Price: </td><td><input name="price" value=""></td></tr>
<tr><td>Quantity: </td><td><input name="iteminstock" value=""></td></tr>

<tr><td colspan="2"><input class="goToPage-btn" type="submit" name="submit" value="Submit Data"></td></tr>


</table>

</form>

<?php
   
   $sql = "Select pt.parttypeid,p.name as parttype,pt.name as partname,msub.name as subbrandname,pt.price, pt.iteminstock,m.name as manufacturername from part_type pt, parts p, manufacturer m, manufacturer_subbrand msub where pt.manufacturer_subbrandid=msub.manufacturer_subbrandid and pt.manufacturerid=m.manufacturerid and pt.partsid=p.partsid";
   $result = $conn->query($sql);
       echo "<br><br><table class='w3-table-all' border='1px'>";
        echo "<tr class='w3-blue'><th class='w3-center' align='left'>ID</th><th class='w3-center' align='left'>Part Type</th><th class='w3-center' align='left'>Part Name</th><th class='w3-center' align='left'>Price</th>
        <th  class='w3-center' align='left'>Quantity In Stock </th><th  class='w3-center' align='left'>Manufacturer</th><th  class='w3-center' align='left'>Subbrand</th><tr>";
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {

                  $part="";
                  $part = $row["parttype"];
                  
                  $manu="";
                  $manu = $row["manufacturername"];
                  
                  
                  $manusub="";
                  $manusub = $row["subbrandname"];
                  
                  
                   echo "<tr><td> " . $row["parttypeid"]. " </td><td> " . $part. " </td><td> " . $row["partname"]. " </td>
                   <td> " . $row["price"]. " </td><td> " . $row["iteminstock"]. " </td>
                   <td> " . $manu. " </td><td> " .$manusub ."</td></tr>";
                   
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