<!DOCTYPE html>
<html>
<head>
  <title>ProjectCurrently</title>
 
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <%= csrf_meta_tags %>
</head>
<body>

	<?php include ('navbar.php');?>

	<div class="container">
	  <%= yield %>
	</div>

	<?php include ('footer.php');?>

</body>
</html>
