<nav class="w3-sidebar w3-bar-block w3-collapse w3-large w3-theme-l5 w3-animate-left" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-right w3-xlarge w3-padding-large w3-hover-black w3-hide-large" title="Close Menu">
    <i class="fa fa-remove"></i>
  </a>
  <h4 class="w3-bar-item"><b>Employee Side <br>ADD to Database</b></h4>
  <a href="manufacturer.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Add Manufacturer</a>
    <a  href="manufacturersubbrand.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Add Manufacturer Sub-Brand</a>
    <a  href="cars.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Add Car</a>
    <a href="parts.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Add Parts</a>
    <a href="partstype.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Add Parts Type</a>
    <a href="insertdealers.php" class="w3-bar-item w3-button w3-hide-small w3-hover-white">Add Other Dealers</a>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>

<style>
.w3-sidebar {
  z-index: 3;
  width: 250px;
  top: 101px;
  bottom: 0;
  height: inherit;
  background: #87cefb;
  
}



</style>