
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>function</title>
</head>

<body>
<?php
	//include('adminConnect.php');
	include('../connect.php');
	function PageAlgorithm($count,$pageSize,$sortid)
    {
		$querySql ="select * from `article` where `sortid` ='".$sortid."'";
	    //查询，获得数据信息
		$query=mysql_query($querySql);
		//获得条数
		$num=mysql_num_rows($query);	
		$count = 0;
		//假设每页显示10条信息							
		$pageSize=10;	
		//当前页码地址，页码跳转地址											
		$url= '';													
		$currentPage = '';							
		if(isset($_GET['currentPage']))
		{	
			$currentPage=intval($_GET['currentPage']);
		}
		else if(!$currentPage){ $currentPage=1; }
		
		if(!$url){ $url=$_SERVER["REQUEST_URI"]; }				//获取地址
		
		echo $url."<br>";

		//最后一页的数值就是总页数，CEIL表示取尽量大的值，进一取值。
		$lastPage = ceil($num/$pageSize);		
		//判断当前页数是否为最后一页							
		$currentPage = min($lastPage,$currentPage);	
		//定义上一页为当前页减一								    
		$prePage=$currentPage-1;		
		//定义下一页为当前页加一，但要考虑当前页是否为最后一页(返回第一页)										
		$nextPage=($currentPage==$lastPage) ? 0 : ($currentPage+1);	
		//查询下一页的起点					
		$count=($currentPage-1)*$pageSize;		
		//注意加空格								
		$Show="本页显示第<B>".($num ? ($count+1) : 0)."</B>--<B>".min($count+$pageSize,$num)."</B> 条记录，共  $num  条记录";			
		//制作导航条中必须判断$num是否为0，后面需判断是否到了最后一页的记录
		if($lastPage<=1){ return false; } 								//如果只有一页或没有就跳出
		$Show.="<a href=$url&amp;currenPage=1>首页</a>";								//制作首页的超链接，即把地址设为1
		if($prePage)
			{ 	//制作上一页的超链接
				$Show.="<a href=\"$url&amp;currenPage=$prePage\"> 上一页 </a>"; 
			}			
		  else
		    { $Show.=" 上一页 "; }
		if($nextPage)
			{	//制作下一页的超链接
				$Show.="<a href=\"$url&amp;currenPage=$nextPage\"> 下一页 </a>";
			}			
		  else
		    { $Show.="下一页"; }
			//制作尾页的超链接
		$Show.="<a href='$url=$lastPage'>尾页</a>共 $lastPage 页！";					
		//下面制作下拉列菜单,列出所有页面
		//选择菜单,并循环列出下拉列菜单
		echo $Show."<br />";echo "<br />";  
		
	}
?>
</body>
</html>