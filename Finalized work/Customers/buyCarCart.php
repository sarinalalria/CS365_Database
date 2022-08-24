<?php
    session_start(); 
    include "./authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Cart for Buy Car</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>


.goToPage-btn{
    width: 35%; 
    margin: 20px 0;
    padding: 20px 30px; 
    cursor: pointer; 
    display: block; 
    background: black;
    border: 0; 
    outline: none; 
    border-radius: 10px;
    color: white; 
}
.cart{
    width: 50%; 
    margin: 5px 0;
    padding: 20px 30px; 
    background: #89CFF0;
    border: 0; 
    outline: none; 
    border-radius: 10px;
    color: black;  
}
tr td {
  padding: 5px;
  font-weight: bold;
}
</style>
</head>
<body>

<!-- Navbar -->
<?php include "./customerNavbar.php";?>

<?php
$manufsub = $_REQUEST["manufacturer_subbrandid"];
$colors = $_REQUEST["colorsid"];
$enginetype = $_REQUEST["enginetypeid"];
$seattype = $_REQUEST["seattypeid"];
$modelyear = $_REQUEST["modelyearid"];

?>

  <br><br>  
<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->


<?php
//echo $_SESSION["customerid"];
$sql = "Select * from BuyCarCart where customerid=".$_SESSION["customerid"];
$result = $conn->query($sql);				
if($result){
                if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$cartid=$row["cartid"];
						}
				}
				else{
				
						$sqlinsert="insert into BuyCarCart (manufacturer_brandid,manufacturerName,manufacturerSubBrand,color,engineType,seatType,modelYear,price,customerid) Select mb.manufacturer_brandid,mn.name as manuf,msub.name as subbrand,c.name as color,et.name as enginetype,st.name as seattype,my.year as modelyear,mb.price,'".$_SESSION["customerid"]."' from manufacturer mn,manufacturer_brand mb,manufacturer_subbrand msub,colors c,engine_type et,seat_type st,modelyear my where mb.manufacturer_subbrandid=msub.manufacturer_subbrandid and mb.colorsid=c.colorsid and msub.manufacturerid=mn.manufacturerid
                and mb.enginetypeid=et.enginetypeid
                and mb.seattypeid=st.seattypeid
                and mb.modelyearid=my.modelyearid and mb.manufacturer_subbrandid=".$manufsub." and mb.colorsid=".$colors." and mb.enginetypeid=".$enginetype." and mb.modelyearid=".$modelyear." and mb.seattypeid=".$seattype;
				$resultinsert = $conn->query($sqlinsert);
						if($result){
							header("Location: buyCarCart.php");
						}else{echo "An Error Occurred.";}
					}
			}
				

?>


<div class="w3-main" style="margin-left:0px;">

  <div class="w3-row w3-padding-64">
    <center><h1 style="font-weight: bold; font-size: 45px;">BUY CAR CART</h1>
      <div class="cartitem" style="padding:20px;">
        <form action="processcarcart.php" method="POST">
        <table class="cart" border="0px">
        <?php
                $sql = "select * from BuyCarCart where customerid=".$_SESSION["customerid"];
                //echo $sql;
                $result = $conn->query($sql);
                if($result){
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        
                        $manu="";
						$manuf="";
                        $carcolor="";
						$seattype="";
						$enginetype="";
						$modelyear="";
						$price=0;
						$manubrandid=$row["manufacturer_brandid"];
						
						$manuf = $row["manufacturerName"];
                        $manu = $row["manufacturerSubBrand"];
						$carcolor = $row["color"];
						$enginetype=$row["engineType"];
						$seattype=$row["seatType"];
						$modelyear=$row["modelYear"];
						$price=$row["price"];
					echo "<input type='hidden' name='manubrandid' value='".$manubrandid."'>";
					echo "<tr><td>Manufacturer:</td><td>$manuf</td></tr>";
					echo "<tr><td>Model Type :</td><td>$manu</td></tr>";
					echo "<tr><td>Color :</td><td>$carcolor</td></tr>";
					echo "<tr><td>Engine Type : </td><td>$enginetype</td></tr>";
					echo "<tr><td>Seat Type : </td><td>$seattype</td></tr>";
					echo "<tr><td>Model Year : </td><td>$modelyear</td></tr>";
					echo "<tr><td>Price : </td><td><span id='price'>$price</span></td></tr>";
					echo "<tr><td>Tax : </td><td><span id='tax'></span></td></tr>";
					echo "<tr><td>Total : </td><td><span id='total'></span></td></tr>";	
                    }
                } 
                    else 
                {
                        echo "No record found";
                } 
                }


            ?>

            </td></tr>

             <tr><td>State: </td><td><select name="state" id="state" onchange="getsalestax();"><option value="" selected>Pick Your State of Residency </option>

                <?php
                $sql = "Select * from states";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["salesTax"]."' ";
                    echo "> " . $row["name"]. "</option>";
                    }
                
                } 
                    else 
                {
                        echo "No record found";
                }  

                ?>
                </td></tr>

           



            <tr><td> Payment Option </td><td><select name="paytypeid" id="paytypeid" onchange="paytype();"><option value="">Pick Payment Option </option>

                <?php
                $sql = "Select paytypeid, type from paymenttype";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["paytypeid"]."' ";
                    echo "> " . $row["type"]. "</option>";
                    }
                
                } 
                    else 
                {
                        echo "No record found";
                }  

                ?></select>
				
				
				
                </td></tr>
				<tr><td>Card Number: </td> <td> <input type=text value="" name="cardnumber" id="cardnumber"></td></tr>
				<tr><td>Expiry Date: </td> <td> 
				
				
				
				<select name="month" id="month"><option value="">Choose Month</option>
				<?php
				$sql = "Select name from month";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["name"]."' ";
                    echo "> " . $row["name"]. "</option>";
                    }
                
                } 
				?>
				</select>
				
				/
				
				
				<select name="year" id="year"><option value="">Choose Year</option>
				<?php
				$sql = "Select name from year";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["name"]."' ";
                    echo "> " . $row["name"]. "</option>";
                    }
                
                } 
				?>
				</select>
				
				
				
				<tr><td>CVV: </td> <td> <input type=text value="" name="cvv" id="cvv" size="4" placeholder="CVV"></td></tr>
        </table>
						<input type="hidden" name="payid" id="payid" value="">
						<input type="hidden" name="carprice" id="carprice" value="0">
						<input type="hidden" name="statetax" id="statetax" value="0">
						<input type="hidden" name="totalpaid" id="totalpaid" value="0">
						<input type="hidden" name="cartid" id="cartid" value="<?php echo $cartid; ?>">	
							
        
        <tr><td> </td><td><input class="goToPage-btn" type="submit" name="payment" id="payment" value="Submit Payment" style="padding:5px;" onclick="return checkform();"></form></td></tr>
        <tr><td> </td><td><input class="goToPage-btn" type="submit" name="Cancel" id="Cancel" value="Cancel" style="padding:5px;" onclick="emptycart();"></td></tr>

        </center>

        
        
    </div>   
    </div>
    
</div>  

<!-- END MAIN -->
</div>
<form action="emptyCart.php" method="post" name="emptyCart">
		<input type="hidden" name="cartid" value="<?php echo $cartid; ?>">
</form>
<script>
function emptycart(){
	var cartid="<?php echo $cartid; ?>";
	var answer = confirm("Are you sure that you want to cancel this transaction?");
	if(answer){
		document.emptyCart.submit();
	}
}
</script>

<script>
function getsalestax(){
var state = document.getElementById("state");
var statetax= state.options[state.selectedIndex].value;
var price=document.getElementById("price").innerHTML;

var salestax=price*(statetax/100);
salestax=salestax.toFixed(2);


document.getElementById("tax").innerHTML= parseFloat(salestax) + ' @ '+statetax+'%';
document.getElementById("total").innerHTML=parseFloat(price)+parseFloat(salestax);
document.getElementById("total").innerHTML='$'+document.getElementById("total").innerHTML;	


document.getElementById("carprice").value=price;
document.getElementById("statetax").value=parseFloat(salestax);
document.getElementById("totalpaid").value=parseFloat(price)+parseFloat(salestax);

}
</script>

<script>
function checkform(){
var cardnumber = document.getElementById("cardnumber").value;
var month = document.getElementById("month");
var year = document.getElementById("year");
var state = document.getElementById("state");
var paytypeid = document.getElementById("paytypeid");
var cvv = document.getElementById("cvv").value;
cardnumber=cardnumber.replace(/ /gi,'');
cvv=cvv.replace(/ /gi,'');
monthval=month.options[month.selectedIndex].value;
yearval=year.options[year.selectedIndex].value;
paytypeidval=paytypeid.options[paytypeid.selectedIndex].value;
stateval=state.options[state.selectedIndex].value;
if(cardnumber.length<16 || cardnumber.length>16){
	alert("Please enter a valid 16 digit card number without any spaces or dashes.");
	return false;
}
if(monthval==""){
	alert("Please select card expiry month from dropdown list");
	return false;
}

if(yearval==""){
	alert("Please select expiry year from dropdown list");
	return false;
}
if(paytypeidval==""){
	alert("Please select your payment type");
	return false;
}
if(stateval==""){
	alert("Please select your state of residency");
	return false;
}
if(cvv.length<3 || cvv.length>4){
	alert("Please enter a valid CVV");
	return false;
}

return true;
}
</script>
<script>
function paytype(){
var paytype = document.getElementById("paytypeid");
var paytypeid= paytype.options[paytype.selectedIndex].value;
document.getElementById("payid").value=paytypeid;
}
</script>
</body>
</html>