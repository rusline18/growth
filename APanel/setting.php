<?php 
	session_start();

	if (!isset($_SESSION['id'])) {
		header('Location: ../verification/autorization.php');
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Личный кабинет</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="officStyle.css">
</head>
<body>
	<?php 
	require('nav.php'); 
	require('menu.php') 
	?>
		<div>
			
		</div>
	</div>
	<footer>
		
	</footer>
</body>
</html>