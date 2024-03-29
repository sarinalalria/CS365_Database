<html>
<?php include "data_connect.php"; ?>
<head>
    <title>Employee Register Page</title> 
    <link rel="stylesheet" href="registerEmployeeCSS.css">
</head>
<body>

<?php 
    if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
       $first_name = $_REQUEST["first_name"];
       $last_name = $_REQUEST["last_name"];
       $street = $_REQUEST["street"];
       $city = $_REQUEST["city"];
       $state = $_REQUEST["state"];
       $zip = $_REQUEST["zip"];
       $email = $_REQUEST["email"];
       $password = $_REQUEST["password"];

      $check = "Select * from employees where loginid = '".$email."' ";
      $result1 = $conn->query($check);
      if($result1->num_rows > 0){
          echo "Email already exists. Please select a different email";
      }
      else{
       $sql = "Insert into employees (last_name, first_name, street, city, stateid, zip, loginid, password) Values('".$last_name."', '".$first_name."', '".$street."', '".$city."', '".$state."', '".$zip."', '".$email."','".$password."') ";
       
       $result = $conn->query($sql);
       if($result){
           echo "record successfully added";
           header("location:loginEmployee.php");

       }else{
           echo "Bad";
       }
      }
}
  


?>

    <div class="wrap">
        <div class="form-box">
            <div class="RegisterSign" >
                <h1> Employee Register Here</h1>
            </div>
            <form id="register" action="" method="post" class="input-group">
                <input type="text" name="first_name" class="input-field" placeholder="First Name" required>
                <input type="text" name="last_name" class="input-field" placeholder="Last Name" required>
                <input type="text" name="street" class="input-field" placeholder="Street Name" required>
                <input type="text" name="city" class="input-field" placeholder="City" required>
                <select name="state"><option placeholder="State" value="" disabled selected hidden>Pick State</option>


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
                    $conn->close();
                ?>  
                
                </select>

                <input name="zip" type="text" class="input-field" placeholder="ZipCode" required>
                <input name="email" type="email" class="input-field" placeholder="Email" required>
                <input name="password" type="password" class="input-field" placeholder="Enter Password" required>
                <button type="submit" name="submit" class="submit-btn">Register</button>
            </form>
            <div class="LoginSign">
                <h3>Have an account already? <a href="loginEmployee.php"> Login here!</a></h3>
            </div>
        </div>
    </div>



</body>
</html>