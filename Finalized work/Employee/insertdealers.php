<?php
    session_start(); 
    include "./authenticateEmployee.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Add Dealers</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif; }

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
    <div class="w3-twothird w3-container" style="">
    <br>
      <?php 
    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
       $name = $_REQUEST["name"];
       $phone = $_REQUEST["phone"];
       $website = $_REQUEST["website"];
       $street = $_REQUEST["street"];
       $city = $_REQUEST["city"];
       $state = $_REQUEST["state"];
       $zip = $_REQUEST["zip"];

       
       $check = "Select * from dealers where name = '".$name."' ";
       $result1 = $conn->query($check);
       if($result1->num_rows > 0){
           echo "Dealer already exists. Please enter different dealer";
       }
       else{
        $sql = "Insert into dealers (name, phone, website, street, city, stateid, zip) Values('".$name."', '".$phone."', '".$website."', '".$street."', '".$city."', '".$state."', '".$zip."') ";
        
        $result = $conn->query($sql);
        if($result){
            echo "Record Successfully Added";
        }else{
            echo "Record was not added";
        }
       }
}
  

?>
<h1 class="w3-text-teal"><br>Add Other Dealers Nearby </h1>
<center>
<form action="" method="POST">
<table class="w3-table w3-center" style="width:100%;" >
<th class="w3-blue w3-center" colspan="3">Add Dealers Nearby</th>
<tr><td class="w3-center" colspan="2">Name: </td><td class="w3-center" colspan="2"><input name="name" value=""></td></tr>
<tr><td class="w3-center" colspan="2">Phone: </td><td class="w3-center" colspan="2"><input name="phone" value=""></td></tr>
<tr><td class="w3-center" colspan="2">Website: </td><td class="w3-center" colspan="2"><input name="website" value=""></td></tr>
<tr><td class="w3-center" colspan="2">Street: </td><td class="w3-center" colspan="2"><input name="street" value=""></td></tr>
<tr><td class="w3-center" colspan="2">City: </td><td class="w3-center" colspan="2"><input name="city" value=""></td></tr>

<tr><td class="w3-center" colspan="2">State: </td><td class="w3-center" colspan="2"><select name="state"><option value=""></option>

<?php

$sql = "Select stateid, name, abbr from states";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
                echo "<option value='".$row["stateid"]."'> " . $row["name"]. "</option>";
             }
    } 
    else 
    {
        echo "No record found";
    }  
  
?>

</select></td></tr>


<tr><td class="w3-center" colspan="2">Zip: </td><td class="w3-center" colspan="2"><input name="zip" value=""></td></tr>

<tr><td class="w3-center" colspan="2">Country: </td><td class="w3-center" colspan="2" ><input name="country_code" value="USA"></td></tr>

<tr><td colspan="3"><input class="goToPage-btn" type="submit" name="submit" value="Submit Data"></td></tr>


</table>

</form>
</center>
<?php
   $sql = "SELECT * FROM dealers";
   $result = $conn->query($sql);
       echo "<br><br><table class='w3-table-all' border='1px'>";
        echo "<tr class='w3-blue'><th class='w3-center' align='left'>name</th><th class='w3-center' align='left'>phone</th>
        <th class='w3-center' align='left'>website</th><th class='w3-center' align='left'>street</th><th class='w3-center' align='left'>city</th>
        <th class='w3-center' align='left'>state</th><th class='w3-center' align='left'>zip</th></tr>";
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
                  $state="";
                  $sqlstate= "Select * from states where stateid=".$row["stateid"];
                  $resultsstate = $conn->query($sqlstate);
                  while($rowstate = $resultsstate->fetch_assoc()){
                    $state = $rowstate["name"];
                  }
           
                  
                   echo "<tr><td> " .$row["name"]. " </td><td > " .$row["phone"]."</td>
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


<!-- END MAIN -->
</div>




</body>
</html>