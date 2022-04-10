<!DOCTYPE html>
<?php include_once "data_connect.php";?>
<?php 
    session_start();

    if (isset($_SESSION['email']))
    {
        echo $_SESSION['email'];
        echo "<br >";
    }
?>
<html>
<head lang="en">
    <title>Purchase</title>
    <span id="logo"></span>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
    
    <?php 
        if (!isset($_SESSION['email']))
        {
            echo "<script>alert('You need to login first')</script>";
            exit;
        }
    ?>

    <section>
        <article style="color: maroon">
            <u style="font-size: 37px;">CARS:</u>
            <ul>
                
            </ul>
        </article>
    </section>

    <section>
        <article style="color: maroon">
            <u style="font-size: 37px;">PARTS:</u>
            <ul>

            </ul>
        </article>  
    </section>



</body>
</html>