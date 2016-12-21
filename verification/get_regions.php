<?php
include_once 'connect.php';
$country_id = @intval($_GET['country_id']);

$regs=mysql_query("SELECT name, region_id  FROM region WHERE country_id=".$country_id);
 
if ($regs) {
    $num = mysql_num_rows($regs);      
    $i = 0;
    while ($i < $num) {
       $regions[$i] = mysql_fetch_assoc($regs);   
       $i++;
    }     
    $result = array('regions'=>$regions);  
}
else {
	$result = array('type'=>'error');
}
print json_encode($result);
?>