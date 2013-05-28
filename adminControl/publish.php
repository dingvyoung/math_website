<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="acss/adminEdit.css" />
<title>发布新闻</title>
</head>
<script charset="utf-8" src="editor/kindeditor.js"></script>
<script charset="utf-8" src="editor/lang/zh_CN.js.js"></script>
<script>
	var editor;
	var parameters = {
		width : '760px',
		height: '555px',		
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
    	editor = K.create('textarea[name="ncontent"]',parameters);	
		});
</script>
<script type="text/javascript" language="javascript">
	function checkPost()
	{
		editor.sync();
		if(document.news.ntitle.value == "")
		{
			alert("帖子标题不得为空");
			document.news.ntitle.focus();
			return false;
		}
		if(document.news.ntitle.value.length < 2 || document.news.ntitle.value.length > 40)
		{
			alert("标题的长度不能小于2或大于40");
			document.news.ntitle.focus();
			return false;	
		}
		if(document.news.ncontent.value == "")
		{
			alert("帖子内容不能为空");
			document.news.ncontent.focus();
			return false;	
		}
	}
</script>
<body>
<?php
	include('adminHead.php');
	include('adminConnect.php');	
	$userid = $_SESSION['id'];
	$user_sql = "SELECT * FROM `userinfo` where `userid`='$userid'";
	$user_res = mysql_query($user_sql);
	$user_info = mysql_fetch_array($user_res);
	//print_r($user_info);
	$source = $user_info['userdepartment'];
	$author = $user_info['username'];
	$sortid = $_GET['sortid'];
	include('../config/config.php');
	//print_r($SORT_LIST);
	//echo $SORT_LIST[$sortid];
?>
<div id="content">
	<?php include('aLLeft.php'); ?>
    <div id="right">
    <form id="news" name="news" action="" method="post" onsubmit="return checkPost();" >
    	标题<input id="ntitle" name="ntitle" size="60" type="text" />&nbsp;<?php echo "[发布".$SORT_LIST[$sortid]."类新闻或文章]<br>"; ?>
        新闻内容<textarea id="ncontent" name="ncontent" style="visibility:hidden;"></textarea><center>  
        <input id="publish" name="publish" value="发布" type="submit"/>
        <input id="reset" name="reset" type="reset" value="重置" /></center>
    </form>
    </div>
</div>
<?php
	
	if(isset($_POST['publish']))
	{
		//print_r($_POST);
		$pubtime = time();
		$insql = "INSERT INTO `article`(`articleid`,`sortid`,`title`,`source`,`author`,`userid`,`content`,`publish_time`)".
								"VALUES('','$sortid','$_POST[ntitle]','$source','$author','$userid','$_POST[ncontent]','$pubtime')";
		$res = mysql_query($insql);
		if($res)echo "<script language=\"javascript\">location.href='adminHome.php'</script>";
				
	}	
	include('adminFoot.php');
?>
</body>
</html>