<?php
    session_start(); 
    include "./authenticateEmployee.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>parts transactions</title>
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
      <h1 class="w3-text-teal"><br>Current Parts Transactions </h1>
  
      <?php
   $sql = "Select ptrans.partstransactionid,p.name as parttype,pt.name as partname,msub.name as subbrandname, cus.first_name, cus.last_name, ptrans.transactiondate, ptrans.quantity,ptrans.itemprice, ptrans.salestax, ptrans.totalamount, ptype.type
   from part_type pt, parts p, manufacturer m, manufacturer_subbrand msub, partstransaction ptrans, paymenttype ptype, customers cus
   where pt.manufacturer_subbrandid=msub.manufacturer_subbrandid
    and pt.manufacturerid=m.manufacturerid and pt.partsid=p.partsid 
    and pt.parttypeid=ptrans.parttypeid
    and ptype.paytypeid=ptrans.paytypeid
    and cus.customerid=ptrans.customerid";

   $result = $conn->query($sql);
       echo "<br><br><table class='w3-table-all' border='1px'>";
        echo "<tr class='w3-blue'><th class='w3-center' align='left'>ID</th><th class='w3-center' align='left'>Part Type</th><th class='w3-center' align='left'>Subbrand</th><th class='w3-center' align='left'>Customer's First Name</th><th class='w3-center' align='left'>Customer's Last Name</th>
        <th class='w3-center' align='left'>Transaction Date</th><th class='w3-center' align='left'>Quantity</th><th class='w3-center' align='left'>Base Price</th><th class='w3-center' align='left'>Sales Tax</th><th class='w3-center' align='left'>Total Amount</th>
        <th class='w3-center' align='left'>Payment Type</th></tr>";
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {

        
                  
                   echo "<tr><td> " . $row["partstransactionid"]. " </td><td> " . $row["parttype"]. " </td><td> " . $row["subbrandname"]. " </td><td> " . $row["first_name"]. " </td>
                   <td> " . $row["last_name"]. " </td><td> " . $row["transactiondate"]. " </td><td> " . $row["quantity"]. " </td>
                   <td> " . $row["itemprice"]. " </td><td> " . $row["salestax"]. " </td><td> " . $row["totalamount"]. " </td><td> " . $row["type"]. " </td></tr>";
                   
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