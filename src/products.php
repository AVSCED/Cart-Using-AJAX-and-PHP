<?php
// Start the session
session_start();
if (isset($_POST['resetData'])) {
    session_destroy();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>
		Products
	</title>
	<link href="style.css" type="text/css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<div id="header">
		<?php
		include './header.php';
		?>
	</div>
	<div id="main">
		<div id="products">
         <!-- To Display the Products Dynamically. -->

		 <!-- Dynamic Display part ends in this part itself -->
		</div>
	</div>
	<br><p id="billAmmount"></p><br>
	<table id="cart">
		<!-- To display the cart Items -->
	</table>
	
	<form action="" method="POST">
            <p style="margin-left:2% ">Reset data:
                <button style="margin-left:2% " type=submit name="resetData">&#9850;</button>
            </p>
            <hr>
        </form>
	<div id="footer">
		<?php
		include './footer.php';
		?>
	</div>
</body>
<script src="./cartScript.js"></script>
</html>