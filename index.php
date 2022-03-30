<!DOCTYPE html>
<?php include_once "data_connect.php"; ?>
<?php 
    // if (isset($_SESSION['email']) && isset($_SESSION['password']))
    // {
    //     echo $_SESSION['email'];
    //     echo "<br >";
    //     echo $_SESSION['password'];
    // }
        session_start();
        if (isset($_SESSION['email']) && isset($_SESSION['password']))
        {
            echo $_SESSION['email'];
            echo "<br >";
            echo $_SESSION['password'];
        }
        // echo $_SESSION['email'];
        // echo $_SESSION['password'];
?>
<html>
    <head lang="en">
        <title>Claim a Car</title>
        <link rel="stylesheet" type="text/css" href="style.css">

    </head>

    <body>
        <?php

        ?>
        <header>
            <h2>Claim a Car</h2>
        </header>

        <div style="position: fixed; width: 250px; font-size: 30px; font-weight: bold;">
            <div style="position: absolute; top: -180px; right: -1150px; width: 100px; text-align:right;">
                <a href="loginPage.php">Login</a>
            </div> 
        </div>

        <div style="position: fixed; width: 250px; font-size: 30px; font-weight: bold;">
            <div style="position: absolute; top: -180px; right: 22px; width: 100px; text-align:right;">
                <a href="transaction.php">Purchase</a>
            </div> 
        </div>

        <div style="position: fixed; width: 250px; font-size: 30px; font-weight: bold;">
            <div style="position: absolute; top: -180px; right: -544px; width: 100px; text-align:right;">
                <a href="logout.php">Logout</a>
            </div> 
        </div>

        <section>
            <article style="color: green">
                Car info here
            </article>
        </section>

        <section>
            <article style="color: green">
                Dealer info here
            </article>
        </section>


    </body>
</html>