<?php
    session_start(); 
    include "./authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Nearby Dealers</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

<!-- Navbar -->
<?php include "./customerNavbar.php";?>


  <br>
<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:0px">

  <div class="w3-row w3-padding-64">
    
    <br>
    <center><h1 style="font-weight: bold; font-size: 45px">DEALERS NEARBY </h1>
      <br><br>
      <?php
        $sql = "CALL getdealers";
        $result = $conn->query($sql);
            echo "<br><br><table border='1px'>";
              echo "<th align='left'>name</th><th align='left'>phone</th>
              <th align='left'>website</th><th align='left'>street</th><th align='left'>city</th>
              <th align='left'>state</th><th align='left'>zip</th>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                        $state="";
						include "data_connect.php";
                        $sqlstate= "Select * from states where stateid=".$row["stateid"];
                        $resultsstate = $conn->query($sqlstate);
                        while($rowstate = $resultsstate->fetch_assoc()){
                          $state = $rowstate["name"];
                        }
                
                        
                        echo "<tr><td> " .$row["name"]. " </td><td> " .$row["phone"]."</td>
                        <td> " .$row["website"]. " </td><td> " .$row["street"]."</td>
                        <td> " .$row["city"]. " </td><td> " .$state."</td>
                        <td> " .$row["zip"]. "</tr>";
                        
                      }
            } 
            else 
            {
                echo "No record found";
            }   
        
            echo "</table>";
        $conn->close();
      ?>

</center>
  </div>  


<!-- END MAIN -->
</div>

<style>
table {
  border-collapse: separate;
  border-spacing: 0 15px;
  border: 0px;
}

th {
  background-color: #4287f5;
  color: white;
}
th,
td {
  width: 150px;
  text-align: center;
  border: 1px solid black;
  padding: 5px;
}
</style>
</body>
</html>