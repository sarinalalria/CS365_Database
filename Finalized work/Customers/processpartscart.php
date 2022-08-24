<?php
    session_start(); 
    include "./authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Process Cart for Parts</title>
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

$payid = $_REQUEST["paytypeid"];
$partprice = $_REQUEST["partprice"];
$salestax = $_REQUEST["statetax"];
$totalprice = $_REQUEST["totalpaid"];
$cardnumber = $_REQUEST["cardnumber"];
$partscartid = $_REQUEST["partscartid"];
$qty=$_REQUEST["quantity"];
$salestax=number_format($salestax,2,".","");
$partprice=number_format($partprice,2,".","");
$totalprice=number_format($totalprice,2,".","");
$customerid=$_SESSION["customerid"];
$parttypeid=$_REQUEST["parttypeid"];

$sql = "insert into partstransaction (quantity,itemprice,salestax,totalamount,paytypeid,CCNumber,partscartid,customerid,parttypeid) values($qty,$partprice,$salestax,$totalprice,$payid,$cardnumber,$partscartid,$customerid,$parttypeid)";
$result = $conn->query($sql);
if($result){

?>
<br><br>  
<div class="w3-main" style="margin-left:0px;">
  <div class="w3-row w3-padding-64">
    <center><h1 style="font-weight: bold; font-size: 45px;">Part Order Summary</h1>
      <div class="cartitem" style="padding:20px;">
        <form action="processcart.php" method="POST">
        <table class="cart" border="0px">
        <?php
                $sql = "Select  p.name as parttype,pt.name as partname,msub.name as subbrandname,pt.price,pt.parttypeid,ptran.itemprice,ptran.transactiondate from part_type pt, parts p, manufacturer m, manufacturer_subbrand msub,partstransaction ptran where pt.manufacturer_subbrandid=msub.manufacturer_subbrandid and pt.manufacturerid=m.manufacturerid and pt.partsid=p.partsid  and ptran.parttypeid=pt.parttypeid and ptran.customerid=$customerid and pt.parttypeid=".$parttypeid." order by ptran.transactiondate DESC LIMIT 1";
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
						$price=$row["itemprice"];
						$parttypeid=$row["parttypeid"];	
						$parttype=$row["parttype"];	
						$partname = $row["partname"];
						$tdate =$row["transactiondate"];
						$sbn =$row["subbrandname"];
               
					echo "<tr><td>Item: $parttypeid - $tdate </td><td>Sales Amount</td></tr>";
					echo "<tr><td>$sbn<br>$parttype<br>$partname</td><td valign=top>$$price</td></tr>";	
                    }
                } 
                    else 
                {
                        echo "No record found";
                } 
                }
				echo "<tr><td>Sales Tax</td><td>$$salestax</td></tr>";
				echo "<tr><td>Total Amount Charged</td><td>$$totalprice</td></tr>";
            ?>
            </td></tr></table>
<center><div class="w3-panel w3-pale-green">
  <h3>Thank you for your business <?php echo $_SESSION["fname"]; ?>.<br><a href="homePage.php">Return Home</a></h3>
  <p></p>
</div>   
    </div>   
    </div> 
</div>  
</div>
<?php

}else{
?><br><br><br><br><br>
<div class="w3-panel w3-red">
  <h3>Error occured while processing your request.<br></h3>
  <p>Please go back to your cart and try again. <a href="buyPartCart.php">Click Here To Try Again</a></p>
  
</div>   
<?php
}
?>





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
document.getElementById("tax").innerHTML=statetax+'%';
document.getElementById("total").innerHTML=parseFloat(price)+parseFloat((price*(statetax/100)));
document.getElementById("total").innerHTML='$'+document.getElementById("total").innerHTML;	


document.getElementById("carprice").value=price;
document.getElementById("statetax").value=parseFloat((price*(statetax/100)));
document.getElementById("totalpaid").value=parseFloat(price)+parseFloat((price*(statetax/100)));

}
</script>

<script>
function checkform(){
var cardnumber = document.getElementById("cardnumber").value;
var month = document.getElementById("month").value;
var year = document.getElementById("year").value;
var cvv = document.getElementById("cvv").value;
cardnumber=cardnumber.replace(/ /gi,'');
month=month.replace(/ /gi,'');
year=year.replace(/ /gi,'');
cvv=cvv.replace(/ /gi,'');

if(cardnumber.length<16 || cardnumber.length>16){
	alert("Please enter a valid 16 digit card number without any spaces or dashes.");
	return false;
}
if(month.length<2 || month.length>2 || month>12){
	alert("Please enter a valid 2 digit month");
	return false;
}

if(year.length<4 || year.length>4){
	alert("Please enter a valid 4 digit year");
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