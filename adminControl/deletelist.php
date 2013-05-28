<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="text/css" rel="stylesheet" href="acss/deletelist.css" />
<title>更新新闻</title>
</head>

<body>
<?php
	include("adminHead.php");
	include('adminConnect.php');
?>
<div id="content">
<?php include('aDLeft.php'); ?>
	<div id="right">
    <?php
        $sort_id = $_GET['sortid'];
		$querySql ="select * from `article` where `sortid` ='".$sort_id."'";
	    //查询，获得数据信息
		$query=mysql_query($querySql);
		//获得条数
		$num=mysql_num_rows($query);	
		if($num<1)echo "<script language=\"javascript\">alert('NO Record');location.href='adminHome.php'</script>";
		//$count = 0;
		//假设每页显示10条信息							
		$pageSize=10;	
		//当前页码地址，页码跳转地址
		$page='';																											
		if(isset($_GET['page']))
		{	
			$page=intval($_GET['page']);
		}
		else if(!$page){ $page=1; }
					
		$firstPage = 1;			
		//最后一页的数值就是总页数，CEIL表示取尽量大的值，进一取值。
		$lastPage = ceil($num/$pageSize);		
		//判断当前页数是否为最后一页							
		$page = min($lastPage,$page);	
		//定义上一页为当前页减一								    
		$prePage=($page==1) ? 1 : ($page-1);		
		//定义下一页为当前页加一，但要考虑当前页是否为最后一页(返回第一页)										
		$nextPage=($page==$lastPage) ? 1 : ($page+1);	
		//查询下一页的起点					
		$count=(($page==1) ? 0 : (($page-1)*$pageSize));
		$pagesql = "SELECT * FROM `article` WHERE `sortid` ='".$sort_id."' ORDER BY `article`.`articleid` DESC LIMIT $count,$pageSize";
		$pageres = mysql_query($pagesql) or die(mysql_error());
		while($pagerow = mysql_fetch_array($pageres))
		{?>
			<a href="../article.php?articleid=<?php echo $pagerow['articleid']; ?>"><?php echo $pagerow['title'];?></a>
            <a  style="color:#F3C;" href = "javascript:location.href='delete.php?sortid=<?php echo $sort_id;?>&articleid=<?php echo $pagerow['articleid'];?>';">删除</a><br /><br />
		<?php
        }							
	?>
    <strong>
    	本页显示第<b><?php echo ($num ? ($count+1) : 0) ;?></b>--<b><?php echo min($count+$pageSize,$num); ?></b>条记录，共<?php echo $num; ?>条记录。<a href="updatelist.php?sortid=<?php echo $sort_id;?>&page=<?php echo $firstPage;?>">首页</a>&nbsp;<a href="updatelist.php?sortid=<?php echo $sort_id;?>&page=<?php echo $prePage?>">上一页</a>&nbsp;<a href="deletelist.php?sortid=<?php echo $sort_id;?>&page=<?php echo $nextPage; ?>">下一页</a>&nbsp;<a href="deletelist.php?sortid=<?php echo $sort_id;?>&page=<?php echo $lastPage; ?>">尾页</a>
    </strong>
    </div>
</div>
<?php
	include('adminFoot.php');
?>
</body>
</html>