<?php 
	session_start();

	if (!isset($_SESSION['id'])) {
		header('Location: ../verification/autorization.php');
		exit();
	}
	require_once '../verification/connect.php';
	require_once 'function.php';

	$sql="SELECT idScore, score FROM score WHERE idUser='".$_SESSION["id"]."'";
	$query=mysql_query($sql);

	if ($_POST['categval']) {
		$return = selectSubcat();
		exit($return);
	}

	$categoria = selectCateg();
	$organization=selectOrganiz();
	sendTransaction();
		if (isset($_POST['week'])) {
			$dateStart = new DateTime("last monday");
			$dateEnd = new DateTime("next monday");
		} elseif (isset($_POST['month'])) {
			$dateStert = new DateTime("mignight first day of this month");
			$dateEnd = new DateTime("mignight first day of next month");
		} else {
			$dateStart = new DateTime("first day of january");
			$dateEnd = new DateTime("first day of january next year");
		}
	$transactions = filter($dateStart, $dateEnd);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Личный кабинет</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="officStyle.css">
	<link rel="stylesheet" type="text/css" href="/datatable/css/jquery.dataTables.css">
	<script src='/js/jquery-3.1.1.js'></script>
	<script src='/js/selectedCat.js'></script>
	<script src='/js/function.js'></script>
	<script src='/datatable/jquery.dataTables.js'></script>
</head>
<body>
	<?php 
	require('nav.php'); 
	require('menu.php') 
	?>
	<div id="RighColumn">
		<h1>Транзакции</h1>
		<div id="addBox">
			<a href="#openModal" id="addText">Добавить</a>
			<div id="openModal" class="modalDialog">
				<!--Модальное окно-->
				<div>
					<a href="#close" title="Закрыть" class="close">X</a>
					<h2><center>Добавить операцию</center></h2>
					<form method="POST" action="transactions.php">
						<div>
							<label>Счет: </label>
							<select name="account" id="account">
							<?php 
								$i=1;
								while ($row=mysql_fetch_assoc($query)) {
									echo "<option value=".$row['idScore'].">".$row['score']."</option>";
									$i++;
								}
							?>
							</select>
							<label>Тип операции: </label>
							<select name="typ">
								<option value="Доход">Доход</option>
								<option value="Расход">Расходы</option>
								<option value="Перевод">Перевод</option>
							</select>
						</div>
						<div id="categoria">
							<div id="divCateg">
								<select class="left" name="сategoria" id="idCateg" required>
									<option value="0">Выберите категорию</option>
									<?php foreach ($categoria as $categ): ?>
										<option value="<?=$categ['idCateg']?>"><?=$categ['category']?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div id="divSubcat">
								<select class="right" name="subcategory" id="idSubCat" disabled required>
								</select>
							</div>
						</div>
						<div id="organizationBox">
							<select name="organization">
								<?php foreach ($organization as $organ): ?>
									<option value="<?=$organ['idOrg']?>"><?=$organ['organization']?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div id="dataBox">
							<label>Дата и время: </label>
							<input type="date" name="data" id="data">
						</div>
						<div>
							<label id="sum">Введите сумму: </label><input type="text" name="sum" size="8" required>
						</div>
						<br>
						<div id="message">
							<label>Комментарий: </label>
							<textarea name="message" rows="-3" cols="40"></textarea>
						</div>
						<div id="add">
							<input type="submit" class="add" name="add" value="Добавить">
						<a href="#close" class="cancel">Отменить</a>
						</div>	
					</form>
				</div>
			</div>
			<div id="controls">
				<form id="form1" method="POST" action="function.php">
				<!--Фильтр-->
					<div id="filter">
						<div>
							<select name="date" id="select">
								<option value="" selected="selected">Период</option>
								<option value="week" id="week">Неделя</option>
								<option value="month" id="month">Месяц</option>
								<option value="year">Год</option>
							</select>
							<output><script>dateInput()</script></output>
							<!-- <input type="date" name="fromDate">
							<input type="date" name="beforeDate"> -->							
						</div>
						<div><input type="submit" name="filter" value="Фильтровать"></div>
					</div>
					<table cellpadding="2" cellspacing="0" border="0" id="table_id" class="display">
					<thead>
						<tr>
							<th><input type="checkbox" name="cb_all"></th>
							<th>Дата</th>
							<th>Тип</th>
							<th>Счет</th>
							<th>Категория</th>
							<th>Подкатегория</th>
							<th>Организация</th>
							<th>Сумма</th>
							<th>Комментарий</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($transactions as $transact): ?>
						<tr>
							<td><input type="checkbox" name="cb" class ="qwe"></td>
							<td><?=date('d.m', strtotime($transact['data']))?></td>
							<td><?=$transact['typ']?></td>
							<td><?=$transact['score']?></td>
							<td><?=$transact['category']?></td>
							<td><?=$transact['subcategory']?></td>
							<td><?=$transact['organization']?></td>
							<td><?=$transact['Sum']?></td>
							<td><?=$transact['comment']?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
					</table>
				</form>
				<script>
					allCheckbox()
					sorter()
				</script>
			</div>
		</div>
	</div>
</body>
</html>