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
        if (isset($_SESSION['email']))
        {
            echo $_SESSION['email'];
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
            $row = $result1->fetch_assoc();
            if($row){ 
                echo "record successfully login";
                $_SESSION['email'] = $row['loginid'];
                header ('Location: index.php');
            }
            else{
                echo "<script>alert('Email or password combination is wrong')</script>";
            }   
           }
           else{
            echo "<script>alert('Email or password combination is wrong')</script>";
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
                <input name="loginid" type="email" class="input-field" placeholder="Email" required autocomplete="on" autofocus>
                <input name="password" type="password" class="input-field" placeholder="Enter Password" required autocomplete="on">
                <button type="submit" class="submit-btn">Log in</button>
            </form>
            <div class="RegisterSign">
                <h3>Don't have an account? <a href="register.php"> Sign up here!</a></h3>
            </div>
        </div>
    </div>



</body>
</html>