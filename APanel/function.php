<?php
function addAccount()
{
	session_start();
		require_once "../verification/connect.php";
		if (isset($_POST['add'])) {
			$account=htmlspecialchars($_POST['score']);
			$currency=$_POST['currency'];
			$typ=$_POST['typ'];
			$idUser=$_SESSION['id'];

			$sql="INSERT INTO score (idUser, score, currency, typ) VALUES ('$idUser','$account', '$currency', '$typ')";
			$result=mysql_query($sql) or die(mysql_error());
			mysql_close();
			header("Location: /APanel/account.php");
		}
		$msg="Счет не дабавлен";
}
function selectCateg()
{
	$query = 'SELECT idCateg, category FROM Categoria ORDER BY idCateg ASC';
	$res=mysql_query($query);
	$categoria = array();
	while ($row = mysql_fetch_assoc($res)) 
	{
		$categoria[]=$row;
	}
	return $categoria;
}

function selectSubcat(){
	$categval = (int)$_POST['categval'];
	$query="SELECT idSubCat, subcategory FROM subcategory WHERE idCateg = '$categval'";
	$res = mysql_query($query);
	$return = '<option>Выберите подкатегория</option>';
	while ($row = mysql_fetch_assoc($res)) {
		$return .= "<option value='{$row['idSubCat']}'>{$row['subcategory']}</option>";
	}
	return $return;
}

function selectOrganiz()
{
	$queryOrg='SELECT idOrg, organization FROM organization';
	$resOrg=mysql_query($queryOrg);
	$organization=array();
	while($rowOrg=mysql_fetch_assoc($resOrg))
	{
		$organization[]=$rowOrg;
	}
	return $organization;
}

// Отправка форм
function sendTransaction()
{
	session_start();
	require "../verification/connect.php";

	if (isset($_POST['add'])) 
	{
		$data=$_POST['data'];
		$typ=htmlspecialchars($_POST['typ']);
		$account=$_POST['account'];
		$categoria=$_POST['сategoria'];
		$subcategory=$_POST['subcategory'];
		$organization=$_POST['organization'];
		$sum=htmlspecialchars($_POST['sum']);
		$message=htmlspecialchars($_POST['message']);
		$idUser=$_SESSION['id'];


		$sql="INSERT INTO transactions (idUser,  idScore, typ, idCateg, idSubCat, idOrg, data,  Sum, comment) VALUES ('$idUser', '$account', '$typ', '$categoria', '$subcategory', '$organization','$data', '$sum', '$message')";
		$result=mysql_query($sql) or die(mysql_error());
		mysql_close();
		header("Location: transactions.php");
	}
}
//Фильтры
function filter($dateStart, $dateEnd = null)
{
	session_start();
	$idUser=$_SESSION['id'];
	require_once "../verification/connect.php";
	if (isset($_POST['filter'])) {
		$dateStart = $_POST['fromDate'];
		$dateEnd = $_POST['beforeDate'];
	} else {
		$dateStart = date('Y-m-01');
		$dateEnd = date('Y-m-31');
	}
	$sqlTrans="SELECT transactions.typ, transactions.data, transactions.Sum,transactions.comment, score.score, Categoria.category, subcategory.subcategory, organization.organization  
	FROM transactions 
		LEFT JOIN score ON score.idScore = transactions.idScore
		LEFT JOIN Categoria ON Categoria.idCateg = transactions.idCateg 
		LEFT JOIN subcategory  ON subcategory.idSubCat = transactions.idSubCat 
		LEFT JOIN organization ON organization.idOrg = transactions.idOrg 
	WHERE 
		transactions.idUser='$idUser' AND transactions.data>='$dateStart' AND transactions.data < '$dateEnd' ORDER BY transactions.data ASC";
	$queryTrans=mysql_query($sqlTrans) or die(mysql_error());
	$transactions=array();
	while($rowTrans = mysql_fetch_array($queryTrans))
	{
		$transactions[]=$rowTrans;
	}
	mysql_close();
	return $transactions;
}