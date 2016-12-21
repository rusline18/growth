<?php 
include_once '../verification/connect.php';
$idCateg = @intval($_GET['idCateg']);

$regs=mysql_query("SELECT name, idSubCat FROM subcategory WHERE idCateg=".$idCateg.);
if ($regs) {
	$num = mysql_num_rows($regs);
	$i=0;
	while ($i < $num) 
	{
		$subcategory[$i]=mysql_fetch_assoc($regs);
		$i++;
	}
	$result = array('subcategory'=>$subcategory);
}
else
{
	$result=array('type'=>'error');
}
print json_encode($result);
?>