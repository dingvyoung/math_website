<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="acss/adelete.css" />
<title>更新新闻</title>
</head>

<body>
<?php
	include("adminHead.php");	
	include('adminConnect.php');
	$userid = $_SESSION['id'];
	$user_sql = "SELECT * FROM `userinfo` where `userid`='".$userid."'";
	$user_res = mysql_query($user_sql);
	$user_info = mysql_fetch_array($user_res);
	//print_r($user_info);
	$userdpt = $user_info['userdepartment'];
	$author = $user_info['username'];
	//print_r($_GET);
	$article_id = $_GET['articleid'];
	$adsql = "SELECT * FROM `article` WHERE `articleid`='".$article_id."'";
	$adque = mysql_query($adsql);
	$adres = mysql_fetch_array($adque);
	$dsource = $adres['source'];
	//print_r($adres);
	//print_r($ares);
?>
<div id="content">
	<?php include('aDLeft.php'); ?>
    <div id="right">
    <?php
    	//print_r($_GET);
		$newsid = $_GET['articleid'];
		if($userdpt == $dsource)
		{
			$dsql = "DELETE FROM `mathweb`.`article` WHERE `article`.`articleid`='".$newsid."'";
			$dres = mysql_query($dsql)or die(mysql_error());
			if($dres)echo "<script language=\"javascript\">alert('delete successfully');location.href='adminHome.php'</script>";
		}
		else
		{
			echo "<script language=\"javascript\">alert('您无权限删除此文章');location.href='adminHome.php'</script>";
		}
		
	?>
    </div>
</div>
<?php
	include('adminFoot.php');
?>
</body>
</html>