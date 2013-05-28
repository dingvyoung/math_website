<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="acss/adminCommon.css" />
<link type="text/css" rel="stylesheet" href="acss/adminHomePage.css" />
<title>后台系统主页</title>
</head>

<body>
<?php
	include("adminHead.php");	
?>
<div id="content"><center>
<h1>请选择相关操作</h1><br />
	<div id="operate_up"><a href="aLaunch.php">发布文章</a></div>
    <div id="operate_middle"><a href="aUpdate.php">更新文章</a></div>
    <div id="operate_middle"><a target="_blank" href="http://www.math.uestc.edu.cn/index.php?m=Admin&a=list_flash">首页图片</a></div>
    <div id="operate_down"><a href="aDelete.php">删除文章</a></div>
    各位老师好，有任何问题请email至1171045253#qq.com或者电话15196602475 。数学学院09级周同学为您服务。
</center>
</div>
<?php
	include('adminFoot.php');
?>
</body>
</html>
