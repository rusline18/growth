<header>
	<div id="logo">
		<a href="office.php">Growth</a>
	</div>
	<div id="nav">
	<?php 
		echo "<div id='navLogeout'>
				<form method='post' action='/verification/login.php'>
				<input type='submit' name='logeout' value='Выход'>
				</form>
				</div>
			<div id='navName'>
				Здравствуйте, ".$_SESSION['name']." ".$_SESSION['LastName']."!
			</div>
			";?>
	</div>
	</header>