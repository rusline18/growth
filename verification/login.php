<?php 
session_start();
include_once('connect.php');
$email = $_POST['email']; 
$password = $_POST['password']; 

$email = stripslashes($email);
$email = htmlspecialchars($email);
$password = stripslashes($password);
$password = htmlspecialchars($password);
 
$email = trim($email);
$password = trim($password);
$password = md5($password);
$user = mysql_query("SELECT * FROM user WHERE email='$email' AND password='$password' AND status='1'");
$id_user = mysql_fetch_assoc($user);
if (empty($id_user['id']))
{
    if (isset($_POST['logeout'])) 
    {
    	unset($_SESSION['email']);
    	unset($_SESSION['id']);
    	unset($_SESSION['name']);
    	unset($_SESSION['LastName']);
        session_destroy();
        header('Location: /index.php');
    }
    exit ("Извините, введённый вами логин или пароль неверный.");
}
else 
{
	// $NameUser=$id_user['name'];
	// $FamilyUser=$id_user['LastName'];

	// $base='ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz0123456789';
	// $maxCode='12';
	// $max=strlen($base)-1;
	// $vcode='';
	// for ($i=0; $i < $maxCode; $i++) { 
	// 	$vcode.=$base{mt_rand(0, $max)};
	// 	$idCode=hash('md5', $vcode);

	// 	session_start();
	//     $_SESSION['idCode']='$idCode';
	//     $_SESSION['NameUser']='$NameUser';
	//     $_SESSION['FamilyUser']='$FamilyUser';

	//     $qUoUs=mysql_query("UPDATE user SET idCode='$idCode' WHERE email='$email'");
	// }
	//      if (isset($_POST['logeout'])) 
 //    {
 //    	unset($_SESSION['email']);
 //    	unset($_SESSION['id']);
 //    	unset($_SESSION['name']);
 //    	unset($_SESSION['LastName']);
 //        session_destroy();
 //        header('Location: /index.php');
 //    }
 //    exit ("Извините, введённый вами логин или пароль неверный.");
	// 	    }
    $_SESSION['email'] = $email;
    $_SESSION['id']=$id_user['id'];
    $_SESSION['name']=$id_user['name'];
    $_SESSION['LastName']=$id_user['LastName'];
}
header('Location: /APanel/office.php');
mysql_close();
?>