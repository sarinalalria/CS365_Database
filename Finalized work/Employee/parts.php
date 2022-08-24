<?php
    session_start(); 
    include "./authenticateEmployee.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Add parts</title>
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
    <?php 
    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
       $name = $_REQUEST["name"];
      
       
        $sql  = "Insert into parts(name) Values('".$name."') ";
        $result = $conn->query($sql);
        if($result){
            echo "Record Successfully Added";
        }else{
            echo "Record was not added";
        }
       }

  

?>
      <h1 class="w3-text-teal"><br>Add Parts </h1>

<form action="" method="POST">
<table class="w3-table">

<tr class="w3-blue"><th colspan="3" class="w3-center">Parts </th></tr>
<tr><td class="w3-center" colspan="2">Name: </td><td colspan="3" ><input name="name" value=""></td></tr>       

<tr><td colspan="3"><input class="goToPage-btn" type="submit" name="submit" value="Submit Data"></td></tr>
</table>

</form>


<?php
   include "data_connect.php";
   $sql = "CALL parts";
   $result = $conn->query($sql);
       echo "<br><br><table class='w3-table-all'border='1px'>";
        echo "<tr class='w3-blue'><th class='w3-center' align='left'>Name</th>";
   if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
                   echo "<tr><td class='w3-center'> " . $row["name"] ."</td></tr>";
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