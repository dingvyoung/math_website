<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>
<?php
	session_start();
	if(!isset($_SESSION['admin']))
	{
		echo "<script language=\"javascript\">alert('无权限');</script>";
		echo "<script language=\"javascript\">location.href='adminLogin.php';</script>";
	}
	else
	{
		;	
	}
?>
</body>
</html>