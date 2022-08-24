<?php
    session_start(); 
    include "./authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Buy Parts</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.goToPage-btn{
    width: 35%; 
    margin: 20px 0;
    padding: 10px 30px; 
    cursor: pointer; 
    display: block; 
    background: black;
    border: 0; 
    outline: none; 
    border-radius: 10px;
    color: white; 
}
.buyparts{
    width: 100%; 
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


<br>
<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:0px">

  <div class="w3-row w3-padding-64">
    <br>

    <center><h1 style="font-weight: bold; font-size: 45px;"> BUY PARTS </h1></center>
	
	<?php	
$sql = "Select * from BuyPartsCart where customerid=".$_SESSION["customerid"];
$result = $conn->query($sql);				
if($result){
                if ($result->num_rows > 0) {
?>					
					<div class="w3-panel w3-red">
					<h3>Warning!</h3>
						<p>There is already an item in your cart. You cannot start another transaction before you cancel your previous purchase. Please <a href="buyPartCart.php">CLICK HERE</a> to go to your cart.</p>
					</div>  
<?php					
				}
}
?>	
	
	
    <div class="partdetails" style="padding:20px;"> 
    <form action="buyPartCart.php" method="POST">
        <table class="buyparts">
        <tr><td>Parts: </td><td><select name="partsid" id="partsid" onchange="filterparts();"><option value="">Pick parts </option>

            <?php
            $partsid = $_REQUEST["partsid"];
            $sql = "Select partsid, name, manufacturerid, manufacturer_brandid from parts";

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                echo "<option value='".$row["partsid"]."'";
                if($row["partsid"]==$partsid){
                    echo " selected";
                }
                echo "> " . $row["name"]. "</option>";
                }
            } 
                else 
            {
                    echo "No record found";
            }  
        
            ?>
            </select><input type='hidden' name='partsid' value='<?php echo $partsid;?>'></td></tr>

            <tr><td>Manufacturer: </td><td><select name="manufacturerid" id="manufacturerid" onchange="filtermanufacturer();"><option value="">Pick Manufacturer </option>

            <?php
            $manufid = $_REQUEST["manufid"];
            $sql = "Select DISTINCT m.manufacturerid, m.name from manufacturer m, part_type pt where m.manufacturerid = pt.manufacturerid and pt.partsid=".$partsid;

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                echo "<option value='".$row["manufacturerid"]."' ";
                if($row["manufacturerid"]==$manufid){
                    echo " selected";
                    
                }
                echo "> " . $row["name"]. "</option>";
                }
            
            } 
                else 
            {
                    echo "No record found";
            }  

            ?>
            </select></td></tr>
            <tr><td>Manufacturer Sub-brand: </td><td><select name="manufacturer_subbrandid" id="manufacturer_subbrandid" onchange="filtersubbrand();"><option value="">Pick Manufacturer Sub-Brand </option>

                <?php
                $manufsubid = $_REQUEST["manufsubid"];
                $sql = "Select sub.manufacturer_subbrandid, sub.name from manufacturer_subbrand sub, part_type pt where sub.manufacturer_subbrandid = pt.manufacturer_subbrandid and pt.manufacturerid=".$manufid. " and pt.partsid=".$partsid;

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    echo "<option value='".$row["manufacturer_subbrandid"]."'";
                    if($row["manufacturer_subbrandid"]==$manufsubid){
                        echo " selected";
                    }
                    echo "> " . $row["name"]. "</option>";
                    }
                
                } 
                    else 
                {
                        echo "No record found";
                }  

                ?>

                </select><input type='hidden' name='manufacturer_subbrandid' value='<?php echo $manufsubid;?>'></td></tr>




        <tr><td>Part Type: </td><td><select name="parttypeid" id="parttypeid" onchange="filterparttype();"><option value="">Pick Part Type</option>

        <?php
        $parttypeid = $_REQUEST["parttypeid"];
        $sql = "Select pt.parttypeid, pt.name from part_type pt where pt.manufacturerid=".$manufid. " and pt.manufacturer_subbrandid=".$manufsubid. " and pt.partsid=".$partsid;

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["parttypeid"]."'";
            if($row["parttypeid"]==$parttypeid){
                echo " selected";
            }
            echo "> " . $row["name"]. "</option>";
            }
           
        } 
            else 
        {
                echo "No record found";
        }  

        ?>

        </select><input type='hidden' name='parttypeid' value='<?php echo $parttypeid;?>'></td></tr>

        <tr><td>Quantity: </td><td><select name="iteminstock" id="iteminstock" onchange="filterquantity();"><option value="">Pick Quantity</option>

            <?php
            $numberofitems = $_REQUEST["numberofitems"];
           
            $sql = "Select pt.parttypeid, pt.name, pt.iteminstock from part_type pt where pt.manufacturerid=".$manufid. " and pt.manufacturer_subbrandid=".$manufsubid. " and pt.partsid=".$partsid. " and pt.parttypeid=".$parttypeid;

            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                //echo "<option value='".$row["parttypeid"]."'";
                $quantityinstock = $row["iteminstock"];
                }
                //echo "> " . $row["iteminstock"]. "</option>";
            }
            echo "<option value='0'> 0 </option>";

            for($i=1; $i<=$quantityinstock; $i++)
            {
            
            echo "<option value='".$i."'";
            if($i==$numberofitems){
                echo " selected";
            }
            echo ">".$i."</option>";
            }
            
            ?> 
                
            
         

        </select><input type='hidden' name='numberofitems' value='<?php echo $numberofitems;?>'> <td></tr>

        <tr><td>Price: </td>
        <?php
                $sql = "Select SUM(".$numberofitems. " * (Select pt.price)) as qty from part_type pt, parts p, manufacturer m, manufacturer_subbrand msub
                where pt.manufacturer_subbrandid=msub.manufacturer_subbrandid 
                and pt.manufacturerid=m.manufacturerid
                and pt.partsid=p.partsid
                and pt.manufacturerid=".$manufid. " and pt.manufacturer_subbrandid=".$manufsubid. " and pt.partsid=".$partsid. " and pt.parttypeid=".$parttypeid;
                //echo $sql;
                $result = $conn->query($sql);
                if($result){
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    echo "<td>$".$row["qty"]. "</td>";
                ?>
                
                <?php
                    }
                } 
                    else 
                {
                        echo "No record found";
                } 
                }


            ?>
    
    
    
        </tr>
        
        
        <tr><td> </td><td><input class="goToPage-btn" type="submit" name="submit" value="Add to Cart" style="padding:5px"></td></tr>


        </table>

        </form>



    </div>

    </div> 
    
<!-- END MAIN -->
</div>

<script>
  function filterparts(){
        var part = document.getElementById("partsid");
        var partsid= part.options[part.selectedIndex].value;
        document.location='buyParts.php?partsid='+partsid;
    }
</script>
<script>
    function filtermanufacturer(){
        var part = document.getElementById("partsid");
        var partsid= part.options[part.selectedIndex].value;
        var manuid = document.getElementById("manufacturerid");
        var manufid= manuid.options[manuid.selectedIndex].value;
        document.location='buyParts.php?partsid='+partsid+'&manufid='+manufid;
    }
</script>
 <script>
    function filtersubbrand(){
        var part = document.getElementById("partsid");
        var partsid= part.options[part.selectedIndex].value;
        var manuid = document.getElementById("manufacturerid");
        var manufid= manuid.options[manuid.selectedIndex].value;
        var manusubid = document.getElementById("manufacturer_subbrandid");
        var manufsubid= manusubid.options[manusubid.selectedIndex].value;
        document.location='buyParts.php?partsid='+partsid+'&manufid='+manufid+'&manufsubid='+manufsubid;
       
    }
</script>
    <script>
    function filterparttype(){
        var part = document.getElementById("partsid");
        var partsid= part.options[part.selectedIndex].value;
        var manuid = document.getElementById("manufacturerid");
        var manufid= manuid.options[manuid.selectedIndex].value;
        var manusubid = document.getElementById("manufacturer_subbrandid");
        var manufsubid= manusubid.options[manusubid.selectedIndex].value;
        var parttype = document.getElementById("parttypeid");
        var parttypeid= parttype.options[parttype.selectedIndex].value;
        document.location='buyParts.php?partsid='+partsid+'&manufid='+manufid+'&manufsubid='+manufsubid+'&parttypeid='+parttypeid;
       
    }
    </script>
    <script>
    function filterquantity(){
        var part = document.getElementById("partsid");
        var partsid= part.options[part.selectedIndex].value;
        var manuid = document.getElementById("manufacturerid");
        var manufid= manuid.options[manuid.selectedIndex].value;
        var manusubid = document.getElementById("manufacturer_subbrandid");
        var manufsubid= manusubid.options[manusubid.selectedIndex].value;
        var parttype = document.getElementById("parttypeid");
        var parttypeid= parttype.options[parttype.selectedIndex].value;
        var stock = document.getElementById("iteminstock");
        var numberofitems= stock.options[stock.selectedIndex].value;
        
        var quantityinstock = "<?php echo $quantityinstock; ?>";
        if(quantityinstock == "0"){
            alert("Sorry we do not have any quantity in stock");
        }
        else{
    
            document.location='buyParts.php?partsid='+partsid+'&manufid='+manufid+'&manufsubid='+manufsubid+'&parttypeid='+parttypeid+'&numberofitems='+numberofitems;
        }
    }
    

</script>

<script>

</script>

</body>
</html>