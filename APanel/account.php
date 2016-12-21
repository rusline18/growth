<?php 
	session_start();

	if (!isset($_SESSION['id'])) {
		header('Location: ../verification/autorization.php');
		exit();
	}
	require ('../verification/connect.php');
	$sql="SELECT * FROM score WHERE idUser='".$_SESSION["id"]."'";
	$query=mysql_query($sql) or die(mysql_error());
?>
<!DOCTYPE html>
<html>
<head>
	<title>Личный кабинет</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="officStyle.css">
</head>
<body>
	<?php require('nav.php'); ?>
	<div id='container'> 
		<?php require('menu.php'); ?>
		<div id="RighColumn">
			<h1>Счета</h1>
			<div id="addBox">			
			<!-- Модальное окно -->
			<a href="#openModal" id="addText">Добавить</a>
				<div id="openModal" class="modalDialog">
					<div>
						<a href="#close" title="Закрыть" class="close">X</a>
						<h2><center>Добавить Счет</center></h2>
							<form method="POST" action="addAccount.php">
								<div>
									<div id="accountBox">
										<label>Название счета: </label>
										<input type="text" name="score" required>
										<label>Валюта: </label>
										<select name="currency">
											<option value="Рубль">Рубли</option>
											<option value="Доллар">Доллары</option>
											<option value="Евро">Евро</option>
										</select>
									</div>
									<label>Вид счета</label>
									<select name="typ">
										<option value="Наличные">Наличные</option>
										<option value="Дебетовая карта">Дебетовая карта</option>
										<option value="Кредитная карта">Кредитная карта</option>
										<option value="Вклад">Вклад</option>
									</select>
									<div id="add">
										<input type="submit" name="add" class="add" value="Добавить">
									<a href="#close" class="cancel">Отменить</a>
									</div>
								</div>
							</form>
					</div>
				</div>
			<!-- Закрытие модального окна -->
				<div>
					<table id="tableAccount">
						<tr>
							<th><input type="checkbox" name="checkbox"></th>
							<th>Счет</th>
							<th>Валюта</th>
							<th>Тип</th>
						</tr>
						<?php while ($rows=mysql_fetch_array($query)) {?>
							<tr>
							<td><input type="checkbox" name="checkbox"></td>
							<td><?php echo $rows['score']; ?></td>
							<td><?php echo $rows['currency']; ?></td>
							<td><?php echo $rows['typ']; ?></td>
						</tr>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</div>
	<footer>
		
	</footer>
</body>
</html>