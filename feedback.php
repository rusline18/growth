<?php 
if (isset($_POST['submit'])) 
	{
	$name=htmlspecialchars($_POST['name']);
	$email=htmlspecialchars($_POST['email']);
	$subject=htmlspecialchars($_POST['subject']);
	$message=htmlspecialchars($_POST['message']);

	mail('info@pergrowth.ru', 'Обратная связь', "Имя: $name\n Эл.почта: $email\n Тема сообщения: $subject\n Сообщение: $message\n");
	$msg='<font color="green">Ваше письмо отправлено, мы Вам ответим в ближайшее время</font>';
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Проект</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php require_once('main.php'); ?>
	<div id="container_feedback">
		<?php echo "$msg";	?>
		<form method="post">
			<input type="text" name="name" placeholder="Введите имя"><br>
			<input type="email" name="email" placeholder="Введите email"><br>
			<input type="text" name="subject" placeholder="Введите тему сообщения"><br>
			<textarea cols="60" name="message" rows="10" placeholder="Сообщение"></textarea>
			<button type="submit" name="submit">Отправить</button>
		</form>
		
	</div>
	<footer>
		<div>
			&copy; Copyraite <a href="index.php">Growth</a> <? echo date('Y');?> год.
		</div>
	</footer>
</body>
</html>