<?php
    session_start(); 
    include "./authenticateEmployee.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Current Parts Inventory</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}
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
      <h1 class="w3-text-teal"><br>Current Parts Inventory </h1>
  
      <?php
   
   $sql = "Select pt.parttypeid,p.name as parttype,pt.name as partname,msub.name as subbrandname,pt.price, pt.iteminstock,m.name as manufacturername from part_type pt, parts p, manufacturer m, manufacturer_subbrand msub where pt.manufacturer_subbrandid=msub.manufacturer_subbrandid and pt.manufacturerid=m.manufacturerid and pt.partsid=p.partsid";
   $result = $conn->query($sql);
       echo "<br><br><table class='w3-table-all' border='1px'>";
        echo "<tr class='w3-blue'><th class='w3-center' align='left'>parttypeid</th><th class='w3-center' align='left'>partsid</th><th class='w3-center' align='left'>name</th><th class='w3-center' align='left'>price</th>
        <th  class='w3-center' align='left'>iteminstock</th><th  class='w3-center' align='left'>manufacturerid</th><th  class='w3-center' align='left'>manufacturer_subbrandid</th><tr>";
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