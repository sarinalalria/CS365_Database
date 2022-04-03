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
        <header>
            <h2>Claim a Car</h2>
        </header>

        <div style="position: absolute; width: 250px; font-size: 30px; font-weight: bold;">
            <div style="position: absolute; top: -180px; right: -1150px; width: 100px; text-align:right;">
                <a href="loginPage.php">Login</a>
            </div> 
        </div>

        <div style="position: absolute; width: 250px; font-size: 30px; font-weight: bold;">
            <div style="position: absolute; top: -180px; right: 22px; width: 100px; text-align:right;">
                <a href="transaction.php">Purchase</a>
            </div> 
        </div>

        <div style="position: absolute; width: 250px; font-size: 30px; font-weight: bold;">
            <div style="position: absolute; top: -180px; right: -544px; width: 100px; text-align:right;">
                <a href="logout.php">Logout</a>
            </div> 
        </div>

        <section>
            <article style="color: maroon">
                <u style="font-size: 37px;">CARS:</u>
                <ul>
                <?php
                    $sql = "SELECT * FROM manufacturer_subbrand";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0)
                    {
                        while ($row = $result->fetch_assoc())
                        {
                            echo "<li>".$row['name']."</li>";
                        }
                    }
                ?>
                </ul>
            </article>
        </section>

        <section>
            <article style="color: maroon">
            <u style="font-size: 37px;">DEALERS:</u>
                <ul>
                <?php
                        $sql = "SELECT * FROM dealers";
                        $result = $conn->query($sql);
                
                        if ($result->num_rows > 0)
                        {
                            while ($row = $result->fetch_assoc())
                            {
                                echo "<li>".$row['name']."</li>";
                            }
                        }
                ?>
                </ul>
            </article>
        </section>


    </body>
</html>