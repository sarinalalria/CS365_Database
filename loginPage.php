<!DOCTYPE html>
<?php include_once "data_connect.php"; ?>
<?php 
    session_start();
?>
<html>
<head>
    <title>Login Page</title> 
    <link rel="stylesheet" href="loginCSS.css">
</head>
<body>
    <?php
        if (isset($_SESSION['email']) && isset($_SESSION['password']))
        {
            // session_start();
            echo $_SESSION['email'];
            echo "<br >";
            echo $_SESSION['password'];
            echo "<br >";
            echo "You are already logged in";
            exit;
        }

        else
        {
          if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            $email = $_REQUEST["loginid"];
            $password = $_REQUEST["password"];

           $check = "Select * from customers where loginid = '".$email."' and password = '".$password."' ";
           $result1 = $conn->query($check);

           if($result1->num_rows > 0){
          // $sql = "Insert into customers (last_name, first_name, street, city, stateid, zip, loginid, password) Values('".$last_name."', '".$first_name."', '".$street."', '".$city."', '".$state."', '".$zip."', '".$email."','".$password."') ";
            
            //$result = $conn->query($sql);
            if($row = $result1->fetch_assoc()){ 
                echo "record successfully login";
              //  session_start();
                $_SESSION['email'] = $row['loginid'];
                $_SESSION['password'] = $row['password'];

                // $_SESSION['email'] = $result1_array[$email];
                // $_SESSION['password'] = $result1_array[$password];
                // session_start();
                header ('Location: index.php');
            }
            else{

                echo "Email or password combination is wrong.";
            }   
           }
           else{
            echo "Email or password combination is wrong.";
           }
        }  
     }
    ?>
    <div class="wrap">
        <div class="form-box">
            <div class="LoginSign" >
                <h1> Log In Here</h1>
            </div>
            <form id="login" action="" method="post" class="input-group">
                <input name="loginid" type="email" class="input-field" placeholder="Email" required>
                <input name="password" type="text" class="input-field" placeholder="Enter Password" required>
                <button type="submit" class="submit-btn">Log in</button>
            </form>
            <div class="RegisterSign">
                <h3>Don't have an account? <a href="register.php"> Sign up here!</a></h3>
            </div>
        </div>
    </div>



</body>
</html>