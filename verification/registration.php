<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Регистрация</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<script src="../js/jquery-3.1.1.js"></script>
	<script src='../js/selects.js'></script>
	<?php
include_once("connect.php");
if (isset($_POST['submit'])) 
    {
        $msg='';
        if (!empty($_POST['email']) && isset($_POST['email'])&& !empty($_POST['password'])&& isset($_POST['password'])) {
        	 $LastName = htmlspecialchars($_POST['LastName']);
                $name     = htmlspecialchars($_POST['name']);
                $floor     = $_POST['floor'];
                $email    = mysql_real_escape_string($_POST['email']);
                $password = md5 ($_POST['password']);
                $phone    = $_POST['phone'];
                $data     = $_POST['data'];
                $country  = $_POST['country'];
                $region   = $_POST['region'];
                $city     = $_POST['city'];
                $rdate    = date ("Y-m-d H:i:s");
                $secret="GrowthKazan";
                $activation= md5($email.$secret);

                $sql=mysql_query("SELECT id FROM user WHERE email='$email'");
                if (mysql_num_rows($sql)<1)
                {
                    $sql="INSERT INTO user (LastName, name, floor, email, password, phone, data, country, region, city, rdate, activation) VALUES ('$LastName', '$name', '$floor', '$email', '$password', '$phone', '$data', '$country', '$region', '$city', '$rdate', '$activation')";
                    $result=mysql_query($sql) or die(mysql_error());

                    include '../sendmail.php';
                    $to=$email;
                    $subject = "Проверка E-mail";
                    $body= "Здравствуйте! Вы только, что зарегистрировались на сайте wwww.pergrowth.ru. Пожалуйста перейдите по сслыки для активации вашей учетной записи <a href='http://site/Proekt/verification/activation.php?code=$activation'>http://site/Proekt/verification/activation.php?code=$activation</a>.";
                    SendMail($to, $subject, $body);
                    $msg="Регистрация прошла успешно! Пройдите активацию через email.";
                }
            else
            {
            $msg="<font color='red'>Данный email уже занят.</font>";
            }
        }
        else
    	{
    		$msg="Не валидный email";
	    }
	}
?>
</head>
<body>
	<?php require_once('../main.php'); ?>
<div id="container">
	<div id="RegistrForm">
	 <?php echo "<div>$msg</div>" ?>
		<form action="" method="POST" name="registration">
			<div>
				<span>Фамилия</span>
				<input type="text" name="LastName" value="<?= $LastName ?>" id="LastName" required>
			</div>
			<br>
			<div>
				<span>Имя</span>
				<input type="text" name="name" value="<?= $name ?>" id="name" required>
			</div>
			<br>
			<div>
				<span>Пол</span>
				<select name="floor">
					<option value="0">Выберите пол</option>
					<option value="men">Мужчина</option>
					<option value="women">Женщина</option>
				</select>
			</div>
			<div>
				<span>E-mail</span>
				<input type="email" name="email" id="email" required>
			</div>
			<br>
			<div>
				<span>Пароль</span>
				<input type="password" name="password" id="password" required pattern=".{3,}">
			</div>
			<br>
			<div>
				<span>Телефон</span>
				<input type="tel" name="phone" id="phone" value="<?= $phone ?>">
			</div>
			<br>
			<div>
				<span>Дата рождение</span>
				<input type="date" name="data" value="<?= $data ?>" id="data">
			</div>
			<br>
			<br>
			<table>
			<tr>
				<td>
				Страна:<br />
					<select name="country" id="country_id" class="StyleSelectBox">
						<option value="0">- выберите страну -</option>
						<option value="3159">Россия</option>
					</select></td><td>
				Регион: <br>
					<select name="region" id="region_id" disabled="true" class="StyleSelectBox">
						<option value="0">- Выберите регион -</option>
					</select></td><td>
				Город: <br>
					<select name="city" id="city_id" disabled="true" class="StyleSelectBox">
						<option value="0">- Выберите город -</option>
					</select>
			</tr>
			</table>
		</td>
			<button type="submit" name="submit">Зарегестрироваться</button>
		</form>
		</div>
	</div>
	<footer>
		<div>
			&copy; Copyraite <a href="index.php">Growth</a> <? echo date('Y');?> год.
		</div>
	</footer>
</body>
</html>