<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="acss/aupdate.css" />
<title>发布新闻</title>
</head>
<script charset="utf-8" src="editor/kindeditor.js"></script>
<script charset="utf-8" src="editor/lang/zh_CN.js.js"></script>
<script>
	var editor;
	var parameters = {
		width : '760px',
		height: '570px',		
		fitlemode:true,
		resizeType:0,
		pasteType:1,
		syncType:"form",
		allowFileManager:true,
		autoSetDataMode:true,
		uploadJson : 'editor/php/upload_json.php',
		fileManagerJson : 'editor/php/file_manager_json.php',
		afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=news]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=news]')[0].submit();
					});
				}
		};	
    KindEditor.ready(function(K) {
    	editor = K.create('textarea[name="ucontent"]',parameters);	
		});
</script>
<script type="text/javascript" language="javascript">
	function checkPost()
	{
		editor.sync();
		if(document.news.utitle.value == "")
		{
			alert("帖子标题不得为空");
			document.news.utitle.focus();
			return false;
		}
		if(document.news.utitle.value.length < 2 || document.news.utitle.value.length > 40)
		{
			alert("标题的长度不能小于2或大于40");
			document.news.utitle.focus();
			return false;	
		}
		if(document.news.ucontent.value == "")
		{
			alert("帖子内容不能为空");
			document.news.ucontent.focus();
			return false;	
		}
	}
</script>
<body>
<?php
	include('adminHead.php');
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
	$asql = "SELECT * FROM `article` WHERE `articleid`='".$article_id."'";
	$aque = mysql_query($asql);
	$ares = mysql_fetch_array($aque);
	$source = $ares['source'];
	//print_r($ares);
?>
<div id="content">
	<?php include('aULeft.php'); ?>
    <div id="right">
    <form id="news" name="news" action="" method="post" onsubmit="return checkPost();" >
    	新闻标题<input id="utitle" name="utitle" size="40" type="text" value="<?php echo $ares['title'];?>"/><br />
        新闻内容<textarea id="ucontent" name="ucontent" style="visibility:hidden;">
        		<?php echo $ares['content'];?>
                </textarea><center>  
        <input id="updt" name="updt" value="Update" type="submit"/>
        <input id="reset" name="reset" type="reset" value="resetAll" /></center>
    </form>
    </div>
</div>
<?php
	$sortid = $_GET['sortid'];
	if(isset($_POST['updt']))
	{
		//print_r($_POST);
		$usql = "UPDATE `article` SET `title`= '".$_POST['utitle']."',`content` = '".$_POST['ucontent']."' "
								."WHERE `articleid` = '".$article_id."'";
		if(($userdpt == $source)||($userdpt=="网站管理员"))
		{
			$ures = mysql_query($usql);
			if($ures)echo "<script language=\"javascript\">alert('update successfully');location.href='adminHome.php'</script>";
		}
		else
		{
			echo "<script language=\"javascript\">alert('无权限更新此文章');location.href='adminHome.php'</script>";
		}
				
	}	
	include('adminFoot.php');
?>
</body>
</html>