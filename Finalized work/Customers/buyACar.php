<?php
    session_start(); 
    include "./authentication.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "data_connect.php"; ?>
<head>
<title>Buy A Car</title>
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
.buycar{
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


  <br><br>
<!-- Main content: shift it to the right by 250 pixels when the sidebar is visible -->
<div class="w3-main" style="margin-left:0px;">

  <div class="w3-row w3-padding-64">
    <center><h1 style="font-weight: bold; font-size: 45px;"> BUY A CAR</h1></center>
<?php	
$sql = "Select * from BuyCarCart where customerid=".$_SESSION["customerid"];
$result = $conn->query($sql);				
if($result){
                if ($result->num_rows > 0) {
?>					
					<div class="w3-panel w3-red">
					<h3>Warning!</h3>
						<p>There is already an item in your cart. You cannot start another transaction before you cancel your previous purchase. Please <a href="buyCarCart.php">CLICK HERE</a> to go to your cart.</p>
					</div>  
<?php					
				}
}
?>			
				
      <div class="cardetails" style="padding:20px;">
        <form action="buyCarCart.php" method="POST">
        <table class="buycar">
        <tr><td>Manufacturer: </td><td><select name="manufacturerid" id="manufacturerid" onchange="filtercars();"><option value="">Pick Manufacturer </option>

        <?php
        $manufid = $_REQUEST["manufid"];
        $sql = "Select manufacturerid, name from manufacturer";

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
        <tr><td>Manufacturer Sub-brand: </td><td><select name="manufacturer_subbrandid" id="manufacturer_subbrandid" onchange="filtercolor();"><option value="">Pick Manufacturer Sub-Brand </option>

        <?php
        $manufsubid = $_REQUEST["manufsubid"];
        $sql = "Select  manufacturer_subbrandid, name from manufacturer_subbrand where manufacturerid=".$manufid;

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

        </select> <input type='hidden' name='manufacturer_subbrandid' value='<?php echo $manufsubid;?>'></td></tr>


        <tr><td>Color: </td><td><select name="colorid" id="colorsid" onchange="filterseattype();"><option value="" disabled selected hidden>Pick Color</option>

        <?php
        $colorspicid = $_REQUEST["colorspicid"];
        $sql = "Select c.colorsid, c.name from colors c, manufacturer_brand mb where c.colorsid=mb.colorsid and manufacturer_subbrandid=".$manufsubid;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row["colorsid"]."'";
                        if($row["colorsid"]==$colorspicid){
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

        </select><input type='hidden' name='colorsid' value='<?php echo $colorspicid;?>'></td></tr>

        <tr><td>Engine Type: </td><td><select name="enginetypeid" id="enginetypeid" onchange="filterenginetype();"><option value="">Pick Engine Type</option>

        <?php
        $enginetypeid = $_REQUEST["enginetypeid"];
        $sql = "Select DISTINCT et.enginetypeid, et.name, et.cylinders from engine_type et, manufacturer_brand mb where et.enginetypeid = mb.enginetypeid and mb.manufacturer_subbrandid=".$manufsubid;

        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["enginetypeid"]."'";
            if($row["enginetypeid"]==$enginetypeid){
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

        </select><input type='hidden' name='enginetypeid' value='<?php echo $enginetypeid;?>'></td></tr>

        <tr><td>Seat Type: </td><td><select name="seattypeid" id="seattypeid" onchange="seats();"><option value="">Pick Seat Type</option>

        <?php
        
        $seattypeid = $_REQUEST["seattypeid"];
        $sql = "Select st.seattypeid, st.name from seat_type st, manufacturer_brand mb where st.seattypeid = mb.seattypeid and mb.colorsid=".$colorspicid." and mb.manufacturer_subbrandid=".$manufsubid. " and mb.enginetypeid=".$enginetypeid;
        
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["seattypeid"]."'";
            if($row["seattypeid"]==$seattypeid){
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
       </select> <input type='hidden' name='seattypeid' value='<?php echo $seattypeid;?>'></td></tr>

        <tr><td>Model Year: </td><td><select name="modelyearid" id="modelyearid" onchange="modelyear();"><option value="">Pick Model Year</option>

        <?php
        $modelyearid = $_REQUEST["modelyearid"];
        $sql = "Select my.modelyearid, my.year from modelyear my, manufacturer_brand mb where my.modelyearid = mb.modelyearid and mb.colorsid=".$colorspicid." and mb.manufacturer_subbrandid=".$manufsubid." and mb.seattypeid=".$seattypeid." and mb.enginetypeid=".$enginetypeid." ORDER BY year DESC";
        //echo $sql;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            echo "<option value='".$row["modelyearid"]."'";
            if($row["modelyearid"]==$modelyearid){
                echo " selected";
            } 
            echo "> " . $row["year"]. "</option>";
            }
           
        } 
            else 
        {
                echo "No record found";
        }  
        
        ?>
</select> <input type='hidden' name='modelyearid' value='<?php echo $modelyearid;?>'></td></tr>

        <tr><td>Price: </td>
             <?php
                $sql = "Select mb.price from manufacturer_brand mb,manufacturer_subbrand msub,colors c,engine_type et,seat_type st,modelyear my where mb.manufacturer_subbrandid=msub.manufacturer_subbrandid and mb.colorsid=c.colorsid
                and mb.enginetypeid=et.enginetypeid
                and mb.seattypeid=st.seattypeid
                and mb.modelyearid=my.modelyearid and mb.manufacturer_subbrandid=".$manufsubid." and mb.colorsid=".$colorspicid." and mb.enginetypeid=".$enginetypeid." and mb.modelyearid=".$modelyearid." and mb.seattypeid=".$seattypeid;
                //echo $sql;
                $result = $conn->query($sql);
                if($result){
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    echo "<td>$".$row["price"]. "</td>";
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

        <tr><td> </td><td><input class="goToPage-btn" type="submit" name="submit" id="submitbutton" value="Add to Cart" style="padding:5px;" disabled></td></tr>
            
       
        </table>

        </form>
    </div>   

    </div>
    
</div>  


<!-- END MAIN -->
</div>


<script>
    function filtercars(){
        var manuid = document.getElementById("manufacturerid");
        var manufid= manuid.options[manuid.selectedIndex].value;
        document.location='buyACar.php?manufid='+manufid;
    }
 
    function filtercolor(){
        var manuid = document.getElementById("manufacturerid");
        var manufid= manuid.options[manuid.selectedIndex].value;
        var manusubid = document.getElementById("manufacturer_subbrandid");
        var manufsubid= manusubid.options[manusubid.selectedIndex].value;
        document.location='buyACar.php?manufid='+manufid+'&manufsubid='+manufsubid;
    }

    function filterseattype(){
        var manuid = document.getElementById("manufacturerid");
        var manufid= manuid.options[manuid.selectedIndex].value;
        var manusubid = document.getElementById("manufacturer_subbrandid");
        var manufsubid= manusubid.options[manusubid.selectedIndex].value;
        var colorid = document.getElementById("colorsid");
        var colorspicid= colorid.options[colorid.selectedIndex].value;
        document.location='buyACar.php?manufid='+manufid+'&manufsubid='+manufsubid+'&colorspicid='+colorspicid;
    }

    function filterenginetype(){
        var manuid = document.getElementById("manufacturerid");
        var manufid= manuid.options[manuid.selectedIndex].value;
        var manusubid = document.getElementById("manufacturer_subbrandid");
        var manufsubid= manusubid.options[manusubid.selectedIndex].value;
        var colorid = document.getElementById("colorsid");
        var colorspicid= colorid.options[colorid.selectedIndex].value;
        var engineid = document.getElementById("enginetypeid");
        var enginetypeid= engineid.options[engineid.selectedIndex].value;
        document.location='buyACar.php?manufid='+manufid+'&manufsubid='+manufsubid+'&colorspicid='+colorspicid+'&enginetypeid='+enginetypeid;
    }

    function seats(){
        var manuid = document.getElementById("manufacturerid");
        var manufid= manuid.options[manuid.selectedIndex].value;
        var manusubid = document.getElementById("manufacturer_subbrandid");
        var manufsubid= manusubid.options[manusubid.selectedIndex].value;
        var colorid = document.getElementById("colorsid");
        var colorspicid= colorid.options[colorid.selectedIndex].value;
        var engineid = document.getElementById("enginetypeid");
        var enginetypeid= engineid.options[engineid.selectedIndex].value;
        var seatid = document.getElementById("seattypeid");
        var seattypeid= seatid.options[seatid.selectedIndex].value;
        document.location='buyACar.php?manufid='+manufid+'&manufsubid='+manufsubid+'&colorspicid='+colorspicid+'&enginetypeid='+enginetypeid+'&seattypeid='+seattypeid;
        
    }

    function modelyear(){
        var manuid = document.getElementById("manufacturerid");
        var manufid= manuid.options[manuid.selectedIndex].value;
        var manusubid = document.getElementById("manufacturer_subbrandid");
        var manufsubid= manusubid.options[manusubid.selectedIndex].value;
        var colorid = document.getElementById("colorsid");
        var colorspicid= colorid.options[colorid.selectedIndex].value;
        var engineid = document.getElementById("enginetypeid");
        var enginetypeid= engineid.options[engineid.selectedIndex].value;
        var seatid = document.getElementById("seattypeid");
        var seattypeid= seatid.options[seatid.selectedIndex].value;
        var modelyear = document.getElementById("modelyearid");
        var modelyearid= modelyear.options[modelyear.selectedIndex].value;
        document.location='buyACar.php?manufid='+manufid+'&manufsubid='+manufsubid+'&colorspicid='+colorspicid+'&enginetypeid='+enginetypeid+'&seattypeid='+seattypeid+'&modelyearid='+modelyearid;
        
    }
    
    </script>

    <script>
        setTimeout("document.getElementById('submitbutton').disabled=false;", 3000);
       
    </script>
</body>
</html>