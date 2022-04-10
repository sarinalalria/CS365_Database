<!DOCTYPE html>
<?php 
    session_start();

    if (isset($_SESSION['email']))
    {
        echo $_SESSION['email'];
        echo "<br >";
    }
?>
<?php include_once "data_connect.php";?>
<html>
    <head lang="en">
        <title>Payment</title>
        <link rel="stylesheet" type="text/css" href="purchaseCSS.css">


    </head>

    <body>
        <?php
            if (!isset($_SESSION['email']))
            {
                echo "You need to log in to make a purchase! <br >";
                exit;
            }

            if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
                $number = $_REQUEST['number'];
                $expiration = $_REQUEST['expiration'];
                $code = $_REQUEST['code'];
                $cardholder = $_REQUEST['cardholder'];
                $zip = $_REQUEST['zip'];
                
                $payment_record = "INSERT INTO paymenttype(type) VALUES('card')";
                $payment_result = $conn->query($payment_record);
                
                $row_Check = "SELECT * FROM paymenttype";
                $row_Result = $conn->query($row_Check);

                if ($row_Result->num_rows > 0)
                {
                    
                    echo "payment successful!";
                }
                else
                {
                    echo "Error";
                }
            }

        ?>

        <div class="wrap">
            <div class="form-box">
                <div class="PurchaseSign">
                    <h1>Credit Card Info</hi>
                    <form id="credit_card" action="" method="post" class="input-group">
                        <input type="text" name="number" class="input-field" placeholder="DDDD DDDD DDDD DDDD" required autocomplete="on" autofocus>
                        <input type="text" name="expiration" class="input-field" placeholder="MM/YY" required autocomplete="off">
                        <input type="text" name="code" class="input-field" placeholder="3 digit CVC" required autocomplete="off">
                        <input type="text" name="cardholder" class="input-field" placeholder="Cardholder Name" required autocomplete="on">
                        <input type="text" name="zip" class="input-field" placeholder="5 digit Zip Code" required autocomplete="on">
                        <button type="submit" name="submit" class="submit-btn">Order Now</button>
                    </form>
                </div>
            </div>
        </div>


    </body>
</html>