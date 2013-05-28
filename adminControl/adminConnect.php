<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
	$host="localhost";
	$user="root";
	$ps="CdMathDb2012";
	//$ps="mathkinglimited";
	$db="mathweb";
	$conn=mysql_connect($host,$user,$ps)or die(mysql_error());
	mysql_select_db($db,$conn);
	/*
	$result=mysql_select_db($db,$conn);
	if($result)echo "lianjiechenggong";
	*/
	mysql_query("set names 'UTF8'");



?>
</body>
</html>
