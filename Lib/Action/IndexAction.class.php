<?php

class IndexAction extends Action {
	
   public function index() {
		Load('extend');
		$flash = M('flash');
        $list = $flash->select();
        $this->assign('flash',$list);
		
		//加载部件
        $header = $this->fetch('Index:header');
        $this->assign('header', $header);
        $flash = $this->fetch('Index:flash');
        $this->assign('flash', $flash);
        $left = $this->fetch('Index:left');
        $this->assign('left',$left);
        $footer = $this->fetch('Index:footer');
        $this->assign('footer',$footer);
        
        //分类新闻
        $article = M('article');
        $list = $article->limit(8)->order('launch_time DESC')->where('sortid=9')->select();
        $this->assign('zhxx',$list);
        $list = $article->limit(5)->order('launch_time DESC')->where('sortid=10')->select();
        $this->assign('bkjx',$list);
        $list = $article->limit(5)->order('launch_time DESC')->where('sortid=22')->select();
        $this->assign('yjspy',$list);
        $list = $article->limit(5)->order('launch_time DESC')->where('sortid=12')->select();
        $this->assign('xsxx',$list);
        $list = $article->limit(5)->order('launch_time DESC')->where('sortid=11')->select();
        $this->assign('xsgz',$list);
        $list = $article->limit(5)->order('launch_time DESC')->where('sortid=13')->select();
        $this->assign('rsdw',$list);
        $list = $article->limit(5)->order('launch_time DESC')->where('sortid=41')->select();
        $this->assign('jxjy',$list);
        
        //加载页面
        $this->display();
    }
	
	
	//新闻列表
	public function article_list() {
		Load('extend');
		//加载部件
		$header = $this->fetch('Index:header');
        $this->assign('header', $header);
        $left = $this->fetch('Index:left');
        $this->assign('left',$left);
        $footer = $this->fetch('Index:footer');
        $this->assign('footer',$footer);
        
        $id = 9;
        if(isset($_GET['id'])){
			$id = floor($_GET['id']);
		}
		
		$page = 1;
		if(isset($_GET['page'])){
			$page = $_GET['page'];
		}
		$sort['name'] = getSortName($id);
		$sort['id'] = $id;
		$this->assign('sort',$sort);
		
		$article = M('article');
		$count = $article->where('sortid='.$id)->count();
		import("ORG.Util.Page");//分页
		$p = new Page($count, 20);
		$page = $p->show();
		
		$list = $article->where('sortid='.$id)->limit($p->firstRow.','.$p->listRows)->order('launch_time DESC')->select();
		if($list==NULL){
			Header('Location:index.php?a=error&eid=1');
		}
		$this->assign('page',$page);
		$this->assign('list',$list);
        //加载页面
        $this->display();
	}
	
	// 新闻显示
	public function article() {
		//加载部件
		$header = $this->fetch('Index:header');
        $this->assign('header', $header);
        $left = $this->fetch('Index:left');
        $this->assign('left',$left);
        $footer = $this->fetch('Index:footer');
        $this->assign('footer',$footer);
        
        $id = 1;
        if(isset($_GET['id'])){
			$id = floor($_GET['id']);
		}
		//获得文章
		$article = M('article');
		$list = $article->where('articleid='.$id)->select();
		$this->assign('list',$list[0]);
		
		//获得分类名称
		$sort['name'] = getSortName($list[0]['sortid']);
		$sort['id'] = $list[0]['sortid'];
		$this->assign('sort',$sort);
		
		//更新点击量
		$data['click'] = $list[0]['click']+1;
		$article->where('articleid='.$id)->save($data);
		
        //加载页面
        $this->display();
	}
	
	// 留言板
	public function message() {
		Load('extend');
		//加载部件
		$header = $this->fetch('Index:header');
        $this->assign('header', $header);
        $left = $this->fetch('Index:left');
        $this->assign('left',$left);
        $footer = $this->fetch('Index:footer');
        $this->assign('footer',$footer);
        
        $notice = "";
		if(isset($_GET['ok']))$notice = "留言成功，等待管理员回复";
        if(isset($_POST['submit'])){
			$message = M('messageboard');
			$data['name'] = $_POST['name'];
			$data['mailto'] = $_POST['mailto'];
			$data['title'] = $_POST['title'];
			$data['context'] = $_POST['context'];
			$data['mtime'] = time();
			$message->data($data)->add();
			Header('Location:index.php?a=message&ok=1');
		}
		else{
			//加载页面
			$message = M('messageboard');
			$count = $message->where('reply<>\'\'')->count();
			import("ORG.Util.Page");//分页
			$p = new Page($count, 5);
			$page = $p->show();
			$list = $message->where('reply<>\'\'')->order('mtime DESC')->limit($p->firstRow.','.$p->listRows)->select();
			$i = 0;
			foreach($list as $value){
				$list[$i]['mailto'] = getMailtoName($value['mailto']);
				$i++;
			}
			$this->assign('list',$list);
			$this->assign('page',$page);
			$this->assign('notice',$notice);
			$this->display();
		}
	}
	
	//错误信息
	public function error() {
		//加载部件
		$header = $this->fetch('Index:header');
        $this->assign('header', $header);
        $left = $this->fetch('Index:left');
        $this->assign('left',$left);
        $footer = $this->fetch('Index:footer');
        $this->assign('footer',$footer);
        
        $eid = 1;
        if(isset($_GET['eid'])){
			$eid = $_GET['eid'];
		}
		switch($eid){
			case 1:$error_msg = "访问的页面不存再";break;
			case 2:$error_msg = "";break;
			default:$error_msg = "";
		}
		$this->assign('error_msg',$error_msg);
        //加载页面
        $this->display();
	}
	
}
?>
