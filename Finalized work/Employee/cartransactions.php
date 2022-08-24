<?php
    session_start(); 
    include "./authenticateEmployee.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Car Transactions</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif;}

}
</style>
</head>
<body>

<!-- Navbar -->
<?php include "./navbar.php";?>

<!-- Sidebar -->
<?php include "./sidebar.php";?>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:300px">

  <div class="w3-row w3-padding-64">
    <div class="w3-twothird w3-container">
    <br>
      <h1 class="w3-text-teal"><br>Current Cars Transactions </h1>
  
      <?php
   $sql = "Select tr.transactionid,mn.name as manuf,msub.name as subbrand,c.name as color,et.name as enginetype,
   st.name as seattype,my.year as modelyear,pt.type,cus.first_name,cus.last_name,tr.transactiondate,mb.price,tr.salestax,tr.totalamount
   from manufacturer mn,manufacturer_brand mb,manufacturer_subbrand msub,colors c,engine_type et,seat_type st,modelyear my,transaction tr,customers cus,
   paymenttype pt where mb.manufacturer_subbrandid=msub.manufacturer_subbrandid 
   and mb.colorsid=c.colorsid and msub.manufacturerid=mn.manufacturerid and mb.enginetypeid=et.enginetypeid
   and mb.seattypeid=st.seattypeid and mb.modelyearid=my.modelyearid and tr.manufacturer_brandid=mb.manufacturer_brandid
   and cus.customerid=tr.customerid and pt.paytypeid=tr.paytypeid
   order by cus.last_name,cus.first_name,tr.transactiondate";

   $result = $conn->query($sql);
       echo "<br><br><table class='w3-table-all' border='1px'>";
        echo "<tr class='w3-blue'><th class='w3-center' align='left'>ID</th><th class='w3-center' align='left'>Manufacturer</th><th class='w3-center' align='left'>Subbrand</th><th class='w3-center' align='left'>Color</th><th class='w3-center' align='left'>Engine Type</th><th class='w3-center' align='left'>Seat Type</th><th class='w3-center' align='left'>Model Year</th><th class='w3-center' align='left'>Payment Type</th><th class='w3-center' align='left'>Customer's First Name</th><th class='w3-center' align='left'>Customer's Last Name</th><th class='w3-center' align='left'>Transaction Date</th><th class='w3-center' align='left'>Base Price</th><th class='w3-center' align='left'>Sales Tax</th><th class='w3-center' align='left'>Total Amount</th>";
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {

        
                  
                   echo "<tr><td> " . $row["transactionid"]. " </td><td> " . $row["manuf"]. " </td><td> " . $row["subbrand"]. " </td><td> " . $row["color"]. " </td>
                   <td> " . $row["enginetype"]. " </td><td> " . $row["seattype"]. " </td><td> " . $row["modelyear"]. " </td>
                   <td> " . $row["type"]. " </td><td> " . $row["first_name"]. " </td><td> " . $row["last_name"]. " </td><td> " . $row["transactiondate"]. " </td>
                   <td> " . $row["price"]. " </td><td> " . $row["salestax"]. " </td><td> " . $row["totalamount"]. " </td></tr>";
                   
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