<style>

/* Full-width input fields */
.input_conn {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}


button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 20%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>

<?php
if (!isset($_SESSION["logged"])) {
  $_SESSION["logged"]= 0;
}
if ($_SESSION["logged"] ==0) {
  ?>
  
<button onclick="document.getElementById('id01').style.display='block'" class="btn btn-outline-light me-2" style="width:auto;">Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="?action=login" method="post" style="min-width: 300px;">

    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal" >&times;</span>
    </div>

    <div class="container" >
      <div style="text-align: start;">
        <label for="uname" style="color: black;"><b>Username</b></label>
        <input class="input_conn" type="text" placeholder="Enter Username" name="uname" required>

        <label for="psw" style="color: black;"><b>Password</b></label>
        <input class="input_conn" type="password" placeholder="Enter Password" name="psw" required>

        <button  type="submit" class="btn btn-primary d-flex  justify-content-center">Login</button>
        <span class="psw" style="color: black;">Forgot <a href="?page=mdr">password?</a></span>

      </div>
    </div>

  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
}
</script>

<?php
}
elseif($_SESSION["logged"] ==1)
{
  ?>
  <button onclick="location.replace('?action=disconnect')" class="btn btn-outline-light me-2" style="width:auto;">Disconnect</button>

  <?php
}
?>