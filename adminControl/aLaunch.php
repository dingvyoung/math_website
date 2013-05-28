<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="acss/alaunch.css" />
<title>发布新闻</title>
</head>

<body>
<?php
	include("adminHead.php");	
?>
<div id="content">
	<?php include('aLLeft.php'); ?>
    <div id="right"><center>
    	发布新文章操作指南</center>
<left>1.请输入文章标题，注意：文章标题不能为空，不得超过三十个汉字。<br />
      2.请输入文章内容，可以直接从word文件复制粘贴。文章内容不能为空。<br />
      3.添加图片请点击“图片”按钮<img src="aimg/tianjiatupian.png" alt="添加图片" /><br /><br />
      点击之后会弹出如下对话框<img src="aimg/tupiantanchu.png" /><br /><br />
      请选择“本地上传”<img src="aimg/bendishangchuan.png" alt="本地上传"/><br /><br />
      请点击“浏览“按钮<img src="aimg/liulantupian.png" alt="浏览本地图片" /><br /><br />
      请选择要上传的图片<img src="aimg/xuanzetupian.png" alt="选择图片" /><br /><br />
     <font style="color:#F00">请注意图片必须是以下格式('gif', 'jpg', 'jpeg', 'png', 'bmp')之一；注意图片的宽个高大图片请根据实际情况按照网页图片标准填写640(宽)*480(高)，小图片请填写480(宽)*320(高)。请一定记得填写。图片有三种对齐方式，默认居中对齐。图片的说明请填写该图片的相关情况。</font>例：<img src="aimg/tianxietupian.png" alt="填写图片属性" /><br />
       最后点击“确定”。<br />
       4.添加附件片请点击“插入文件”按钮<img src="aimg/tianjiafujian.png" alt="添加附件" /><br />
        弹出如下对话框<img src="aimg/shangchuanwenjian.png" alt="上传文件" /><br /><br />
        请点击”上传“按钮，然后选择需要上传的文件。注意文件必须是以下格式(doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2')，文件大小最好不要超过4M。同样请注意填写文件说明。最后点击”确定“。
        
        
  </left>      
    </div>
</div>
<?php
	include('adminFoot.php');
?>
</body>
</html>