<div id="top_head">
	<div id="head_left">
    <?php
		include('adminJudge.php');
		echo $_SESSION['admin'];
	?>
  	&nbsp;&nbsp;欢迎您使用MathWeb后台管理系统</div>  
    <div id="head_center">
    	<a href="adminHome.php" target="_blank">回主页</a>
    </div>
    <div id="head_right">
    	<a  style="color:#F3C;" href = "javascript:location.href='adminLogin.php?action=quit';">退出</a>
    </div>
</div>
