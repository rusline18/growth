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
function dateView()
{
	$month_ru = array(1=>"Январь",2=>"Февраль",3=>"Марта",4=>"Апрель",5=>"Май",6=>"Июнь",7=>"Июль",8=>"Август",9=>"Сентябрь",10=>"Октябрь",11=>"Ноябрь",12=>"Декабрь"); 
	if ($_POST['fromDate'] == 0 && $_POST['beforeDate']==0) {
		echo "<span>".$month_ru[date("n")]." ".date("Y")."</span>";
	} else {
		echo "<span>".date("d",strtotime($_POST["fromDate"]))." ".$month_ru[date("n", strtotime($_POST["fromDate"]))]." ".date("Y",strtotime($_POST["fromDate"]))." - ".date("d",strtotime($_POST["beforeDate"]))." ".$month_ru[date("n", strtotime($_POST["beforeDate"]))]." ".date("Y",strtotime($_POST["beforeDate"]))."</span>";
	}
}

//Фильтры
function filter($dateStart, $dateEnd, $typ, $categ, $account, $organ = null)
{
	session_start();
	$idUser=$_SESSION['id'];
	$where = [];
	$where[] = isset($_POST['fromDate']) ? "transactions.data >='$fromDate'" : "transactions.data >= '".date('Y-m-01')."'";
	$where[] = isset($_POST['fromDate']) ? "t.data <'$dateEnd'" : "t.data < '".date('Y-m-31')."'";
	if(!empty($_POST['filterTyp'])) $where[]="t.typ ='$typ'";
	if(!empty($_POST['filterCateg'])) $where[]="t.idCateg ='$categ'";
	if(!empty($_POST['filterAccount'])) $where[]="t.idScore ='$account'";
	if(!empty($_POST['filterOrganiz'])) $where[]="t.idOrg ='$organ'";
	$sqlTrans="SELECT transactions.typ, transactions.data, transactions.Sum,transactions.comment, score.score, Categoria.category, subcategory.subcategory, organization.organization  
	FROM transactions
		LEFT JOIN score ON score.idScore = transactions.idScore
		LEFT JOIN Categoria ON Categoria.idCateg = transactions.idCateg 
		LEFT JOIN subcategory  ON subcategory.idSubCat = transactions.idSubCat 
		LEFT JOIN organization ON organization.idOrg = transactions.idOrg 
	WHERE 
		transactions.idUser='$idUser' AND ( ".implode(' OR ', $where)." ) ORDER BY transactions.data ASC";
	$queryTrans=mysql_query($sqlTrans) or die(mysql_error());
	$transactions=array();
	while($rowTrans = mysql_fetch_array($queryTrans))
	{
		$transactions[]=$rowTrans;
	}
	mysql_close();
	return $transactions;
}
?>
