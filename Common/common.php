<?php
	function getSortName($id){
		$name = "未知";
		switch($id){
			case 9:$name = "综合信息";break;
			case 10:$name = "本科教学";break;
			case 11:$name = "学生工作";break;
			case 12:$name = "学术信息";break;
			case 13:$name = "人事党务";break;
			case 15:$name = "ACM/ICPC";break;
			case 16:$name = "数学建模";break;
			case 17:$name = "校友风采";break;
			case 18:$name = "考研深造";break;
			case 19:$name = "就业工作";break;
			case 20:$name = "出国留学";break;
			case 22:$name = "研究生培养";break;
			case 28:$name = "师资队伍";break;
			case 33:$name = "学院概况";break;
			case 41:$name = "继续教育";break;
			default:$name = "未知";
		}
		return $name;
	}
	
	function getMailtoName($id){
		$name = "未知";
		switch($id){
			case 19:$name = "学生科";break;
			case 20:$name = "教务科";break;
			case 21:$name = "研究生科";break;
			case 22:$name = "人事党务";break;
			case 34:$name = "学院办公室";break;
			case 32:$name = "专业学位与继教";break;
			case 31:$name = "网站管理员";break;
			default:$name = "未知";
		}
		return $name;
	}
?>
