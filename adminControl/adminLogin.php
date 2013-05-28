<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员登陆</title>
</head>  

<style> 
#box{
	width:504px;
	height:350px;
	background:url(aimg/adminlogin.png);
	background-repeat:no-repeat;
	}

a{
	color:#FFF;
	text-decoration:none;}
a:hover{
	color:#CCC;
	text-decoration:none;}
 .button{
	 width:60px;
	 height:45px;
	 background-color:#09F;
	 border:#FFF thin inset;
	 font-size:24px;
	 }
</style>
    
<body>
<?php
	include('adminConnect.php');
	session_start();
	$user='';
	$pwd='';
	function AdminLogin($user,$pwd){
		$slt = "SELECT * FROM `userinfo` WHERE `username` = "."'$user'";
		$log = mysql_query($slt) or die(mysql_error());
		$row = mysql_fetch_row($log);
		if($row[5] == $pwd){
			$_SESSION['admin'] = $user;
			$_SESSION['id'] = $row[0];
			
			echo "<script language=\"javascript\">location.href='adminHome.php';</script>";
 
		}
		else{
			echo "<script language=\"javascript\">alert('用户名或密码错误！！！');</script>";
			echo "<script language=\"javascript\">history.back(0);</script>";
		}
	}
	if(isset($_POST['login']))
			AdminLogin($_POST['user'],MD5($_POST['pwd']));
?>
	<center>
    <br /><br /><br /><br /><br /> 
	<div>
	<br /><br /><br /><br /><br />
<?php 
	if(!isset($_SESSION['admin'])){
?>
    <form id="login" name="login" action="adminLogin.php" method="post">
        <font style="font-size:16px; color:#036; font-weight:600">用户：</font>
        <input type="text" name="user" style="width:150px; height:20px;" /><br /><br />
        <font style="font-size:16px; color:#036; font-weight:600">密码：</font>
        <input type="password" name="pwd" style="width:150px; height:20px;" /><br /><br />
        <input type="submit" name="login" value="登录" class="button"/>&nbsp;&nbsp;&nbsp;
    </form>
<?php	
	}
	else {
		if(@$_GET['action'] == 'quit') {
			session_destroy();
			echo "<script language=\"javascript\">location.href='adminLogin.php';</script>";
		}
	}
?>
	</div>
	</center>	
</body>
</html>