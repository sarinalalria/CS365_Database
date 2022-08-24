<?php
    session_start(); 
    include "./authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Cart for Buy Parts</title>
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
$partsid = $_REQUEST["partsid"];
$manufsub = $_REQUEST["manufacturer_subbrandid"];
$quant = $_REQUEST["numberofitems"];
$parttypeid = $_REQUEST["parttypeid"];
$customerid=$_SESSION["customerid"];
?>
<?php
$sql = "Select * from BuyPartsCart where customerid=".$_SESSION["customerid"];
$result = $conn->query($sql);				
if($result){
                if ($result->num_rows > 0) {
						while($row = $result->fetch_assoc()) {
							$partscartid=$row["partscartid"];
							$parttypeid=$row["partstypeid"];
							$quant=$row["quantity"];
						}
				}
				else{
				
						$sqlinsert="insert into BuyPartsCart (partstypeid,partName,parttype,subbrandname,price,customerid,quantity) Select $parttypeid,p.name as parttype,pt.name as partname,msub.name as subbrandname,pt.price,$customerid,$quant from part_type pt, parts p, manufacturer m, manufacturer_subbrand msub where pt.manufacturer_subbrandid=msub.manufacturer_subbrandid and pt.manufacturerid=m.manufacturerid and pt.partsid=p.partsid  and pt.parttypeid=".$parttypeid;
						
						$resultinsert = $conn->query($sqlinsert);
						if($resultinsert){ 
							header("Location: buyPartCart.php");
						}else{echo "<br><br><br><br><br><br><br>An Error Occurred.";}
					}
			}
				

?>

  <br><br>
<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:0px;">

  <div class="w3-row w3-padding-64">
    <center><h1 style="font-weight: bold; font-size: 45px;">BUY PARTS CART</h1>
      <div class="cartitem" style="padding:20px;">
        <form action="processpartscart.php" method="POST">
        <table class="cart" border="0px">
        <?php
                $sql = "Select p.name as parttype,pt.name as partname,msub.name as subbrandname,pt.price from part_type pt, parts p, manufacturer m, manufacturer_subbrand msub where pt.manufacturer_subbrandid=msub.manufacturer_subbrandid and pt.manufacturerid=m.manufacturerid and pt.partsid=p.partsid  and pt.parttypeid=".$parttypeid;
      
                $result = $conn->query($sql);
                if($result){
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
					$price=$row["price"]*$quant;
					echo "<tr><td style='width:100px'> Part </td><td style='width:100px'>".$row["parttype"]."</td></tr>";
					echo "<tr><td style='width:100px'> Part Type</td><td style='width:100px'>".$row["partname"]."</td></tr>";
					echo "<tr><td style='width:100px'> Manufacturer Brand</td><td style='width:100px'>".$row["subbrandname"]."</td></tr>";
					echo "<tr><td style='width:100px'> Quantity</td><td style='width:100px'>".$quant."</td></tr>";
					echo "<tr><td style='width:100px'> Price</td><td style='width:100px'>".$price."</td></tr>";
						
					} 
				}
				}

            ?>
			<tr><td style='width:100px'> Tax</td><td style='width:100px'><span id='tax'></span></td></tr>
			<tr><td style='width:100px'> Total</td><td style='width:100px'><span id='total'></span></td></tr>
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
          
    



            <tr><td> Payment Option </td><td><select name="paytypeid" id="paytypeid"><option value="">Pick Payment Option </option>
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

                    ?>
                    </td></tr>
					
					<tr><td>Card Number: </td> <td> <input type=text value="" name="cardnumber" id="cardnumber"></td></tr>
				<tr><td>Expiry Date: </td> <td> 
				
				<select name="month" id="month"><option value="">Choose Month</option>
				<?php
				$sql = "CALL getmonth";

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
				include "data_connect.php";
				$sql = "CALL getyear";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["name"]."' ";
                    echo "> " . $row["name"]. "</option>";
                    }
                
                } 
				?>
				</select>
				
				
				</td></tr>
				<tr><td>CVV: </td> <td> <input type=text value="" name="cvv" id="cvv" size="4" placeholder="CVV"></td></tr>
        </table>
						
						<input type="hidden" name="parttypeid" id="parttypeid" value="<?php echo $parttypeid; ?>">
						<input type="hidden" name="partprice" id="partprice" value="<?php echo $price; ?>">
						<input type="hidden" name="statetax" id="statetax" value="0">
						<input type="hidden" name="totalpaid" id="totalpaid" value="0">
						<input type="hidden" name="partscartid" id="partscartid" value="<?php echo $partscartid; ?>">
						<input type="hidden" name="quantity" id="quantity" value="<?php echo $quant; ?>">

        </table>

      
       <tr><td> </td><td><input class="goToPage-btn" type="submit" name="payment" id="payment" value="Submit Payment" style="padding:5px;" onclick="return checkform();"></form></td></tr>
        <tr><td> </td><td><input class="goToPage-btn" type="submit" name="Cancel" id="Cancel" value="Cancel" style="padding:5px;" onclick="emptycart();"></td></tr>

        </center>

        
        
    </div>   
    </div>
    
</div>  
<form action="emptyCartParts.php" method="post" name="emptyCart">
		<input type="hidden" name="partscartid" value="<?php echo $partscartid; ?>">
</form>
<!-- END MAIN -->
</div>
<script>
function emptycart(){
	var cartid="<?php echo $partscartid; ?>";
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
var price=<?php echo $price; ?>;

var salestax=price*(statetax/100);
salestax=salestax.toFixed(2);


document.getElementById("tax").innerHTML= parseFloat(salestax) + ' @ '+statetax+'%';
document.getElementById("total").innerHTML=parseFloat(price)+parseFloat(salestax);
document.getElementById("total").innerHTML='$'+document.getElementById("total").innerHTML;	


//document.getElementById("carprice").value=price;
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
</body>
</html>