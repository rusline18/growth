<!DOCTYPE html>
<html>
<head>
	<title>Восстановление пароля</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<?php 
		include_once('connect.php');
		$email=mysql_real_escape_string($_POST['email']);
		$password=mysql_real_escape_string($_POST['password']);
		$query="SELECT 'id' FROM user WHERE email='$email' LIMIT 1";
		$sql=mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($sql)==1) {
			$simvols = array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','i','j','k','l','m','n','o','p','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','I','J','K','L','M','N','O','P','R','S','T','U','V','W','X','Y','Z',);
			for ($key=0; $key < 6; $key++) { 
				shuffle($simvols);
				$string=$string.$simvols[1];
			}
			$password=md5($string);
			$query="UPDATE user SET password='$password' WHERE email='$email'";
			$sql=mysql_query($query) or die(mysql_error());
			$query="SELECT email FROM user WHERE email='$email' LIMIT 1";
			$sql=mysql_query($query) or die(mysql_error());

			$row=mysql_fetch_assoc($sql);
			$email= $row['email'];
			include '../sendmail.php';
			$to=$email;
			$subject="Запрос на восстановление пароля";
			$body= "Здравствуйте $email ваш новый пароль: $string";
			SendMail($to, $subject, $body);
		}
	?>
</head>
<body>
<?php require_once('../main.php'); ?>
	<div id="container">
		<div id="boxPass">
			<p><h1>Восстановление пароля</h1></p>
			<div id="">
				<form method="POST" action="" name="lostpass" id="passEmail">
					<p>Email: <input type="email" name="email"></p>
					<p>
					<button type="submit" name="submit">Восстановить</button>
					</p>
				</form>
			</div>
		</div>
	</div>
	<footer>
		<div>
			&copy; Copyraite <a href="index.php">Growth</a> <? echo date('Y');?> год.
		</div>
	</footer>
</body>
</html>