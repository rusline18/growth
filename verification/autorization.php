<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Авторизация</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<div id="autorLogo"><a href="../index.php">Growth</a></div>
	<div id="autor">
		<div id="autorForm">
			<p>Войти</p>
				<form method="POST" action="login.php">
					<input type="text" name="email" placeholder="email" required><br>
					<input type="password" name="password" placeholder="password" required><br>
					<button type="submit" name="submit">Вход</button><br>
					<a href="registration.php">Регистрация</a><br>
					<a href="lostpass.php">Забыли пароль</a><br>
				</form>
		</div>
	</div>
</body>
</html>