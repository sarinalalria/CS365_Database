<!DOCTYPE html>
<?php
    session_start(); 

?>
<?php include "data_connect.php"; ?>
<html>
<head>
    <title>Login Page</title> 
    <link rel="stylesheet" href="loginEmployeeCSS.css">
</head>
<body>
    <?php
          if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            $email = $_REQUEST["loginid"];
            $password = $_REQUEST["password"];
     
           $check = "Select * from employees where loginid = '".$email."' and password = '".$password."' ";
           $result1 = $conn->query($check);
           if($result1->num_rows > 0){
          // $sql = "Insert into customers (last_name, first_name, street, city, stateid, zip, loginid, password) Values('".$last_name."', '".$first_name."', '".$street."', '".$city."', '".$state."', '".$zip."', '".$email."','".$password."') ";
            
            //$result = $conn->query($sql);


            if($result1){
                while($row = $result1->fetch_assoc()){
                    echo "record successfully login";
                    $_SESSION["name"] = $row["loginid"];
                    $_SESSION["employeeid"] = $row["employeeid"];
                    header("location:currentCarInventory.php");
                }
            }
            else{

                echo "Email or password combination is wrong.";
            }   
           }
           else{
            echo "Email or password combination is wrong.";
           }
           
     }
       
    ?>

    <div class="wrap">
        <div class="form-box">
            <div class="LoginSign" >
                <h1> Employee Login</h1>
            </div>
            <form id="login" method="POST" action=" "  class="input-group">
                <input name="loginid" type="email" class="input-field" placeholder="Email" required>
                <input name="password" type="text" class="input-field" placeholder="Enter Password" required>
                <button type="submit"  class="submit-btn">Log in</button>
            </form>
            <div class="RegisterSign">
                <h3>Don't have an account? <a href="registerEmployee.php"> Sign up here!</a></h3>
            </div>
        </div>
    </div>



</body>
</html>