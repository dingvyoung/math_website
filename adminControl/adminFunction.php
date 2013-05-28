<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php
	include('adminConnect.php');
	//print_r($_REQUEST);
	$querySql ="select * from `article` where `sortid` ='".$_REQUEST['sortid']."'";
	$query=mysql_query($querySql);//查询，获得数据信息
	$Num=mysql_num_rows($query);								//获得条数
	$PageSize=10;												//假设每页显示五条信息
	$Url= '';													//当前页码地址，页码跳转地址
	$Page = '';
	if(isset($_GET['Page']))
	{
		$Page=intval($_GET['Page']);
	}
	else if(!$Page){ $Page=1; }
	if(!$Url){ $Url=$_SERVER["REQUEST_URI"]; }				//获取地址
	$Par_Url=PARSE_URL($Url);								//分析地址
	$Query_Url=$Par_Url["query"];
	if($Query_Url)
	{
		//正则替换
		$Query_Url=preg_replace("/(^|$)Page=$Page/","",$Query_Url);  
		 //PHP替换str_replace($str1,$str2,$str)是将$str中的$str1替换成$str2，并返回新字符串
		$Url=str_replace($Par_Url["query"],$Query_Url,$Url);	
		 //页码跳转,一种协议，GET方法 
		if($Query_Url){ $Url.="?Page"; }		 
		else  { $Url.="Page"; }
	}
	else{ $Url.="?Page"; }
	//最后一页的数值就是总页数，CEIL表示取尽量大的值，进一取值。
	$LastPage = ceil($Num/$PageSize);		
	//判断当前页数是否为最后一页							
	$Page = min($LastPage,$Page);	
	//定义上一页为当前页减一								    
	$PrePage=$Page-1;		
	//定义下一页为当前页加一，但要考虑当前页是否为最后一页(返回第一页)										
	$NextPage=($Page==$LastPage) ? 0 : ($Page+1);	
	//查询下一页的起点					
	$Count=($Page-1)*$PageSize;		
	//注意加空格								
	$Show="本页显示第<B>".($Num ? ($Count+1) : 0)."</B>--<B>".MIN($Count+$PageSize,$Num)."</B> 条记录，共  $Num  条记录";			
	//制作导航条中必须判断$Num是否为0，后面需判断是否到了最后一页的记录
	if($LastPage<=1){ return false; } 								//如果只有一页或没有就跳出
	$Show.="<a href='$Url=1'>首页</a>";								//制作首页的超链接，即把地址设为1
		if($PrePage)
			{ 	//制作上一页的超链接
				$Show.="<a href='$Url=$PrePage'> 上一页 </a>"; 
			}			
		  else
		    { $Show.=" 上一页 "; }
		if($NextPage)
			{	//制作下一页的超链接
				$Show.="<a href='$Url=$NextPage'> 下一页 </a>";
			}			
		  else
		    { $Show.="下一页"; }
			//制作尾页的超链接
	$Show.="<a href='$Url=$LastPage'>尾页</a>";					
	//下面制作下拉列菜单,列出所有页面
	//选择菜单,并循环列出下拉列菜单
	$Show.="到第<select name='topage' size='1' onchange='window.location=\"$Url=\"+this.value'>\n";
		for( $yema=1;$yema <= $LastPage; $yema++)
		{
			if($yema==$Page){ $Show.="<option value='$yema' selected>$yema</option>\n"; }//使用选择option标签
			else		    { $Show.="<option value='$yema'>$yema</option>";}
		}
		$Show.="</select>页,共 $LastPage 页！";
		echo $Show."<br />";echo "<br />";
		
	?>
</body>
</html>