<?php 
	include("connect.php");
	session_start();
	$msg="";
	if (!empty($_GET['code']) && isset($_GET['code'])) {
		$code=mysql_real_escape_string($_GET['code']);
		$c=mysql_query("SELECT id FROM user WHERE activation='$code'");

		if (mysql_num_rows($c) > 0) {
			$sql==mysql_query("SELECT id FROM user WHERE activation='$code' AND status='0'");

			if (mysql_num_rows($c)==1) {
				mysql_query("UPDATE user SET status='1', activation='' WHERE activation='$code'");
				$msg="Ваш аккаунт активирован";
			}
			else{
				$msg= "Ваш акканут уже активирован";
			}
		}
		else{
			$msg="Неверный код активации";
		}
	}
?>
<?php echo $msg; ?>

