<!DOCTYPE html>
<?php 
    session_start();

    if (isset($_SESSION['email']) && isset($_SESSION['password']))
    {
        echo $_SESSION['email'];
        echo "<br >";
        echo $_SESSION['password'];
    }
?>
<?php include_once "data_connect.php";?>
<html>
<head lang="en">
    <title>Purchase</title>
    <span id="logo"></span>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    <?php 
        if (!isset($_SESSION['email']) && !isset($_SESSION['password']))
        {
            echo "<script>alert('You need to login first')</script>";
          //  header("Location: loginPage.php");
        }

        

    ?>
</body>
</html>