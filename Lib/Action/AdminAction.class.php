<?php
class AdminAction extends Action{
	
	public function index(){
		session_start();
		if(isset($_SESSION['admin'])){
			if($_SESSION['admin']==false){
				Header('Location:index.php?m=Admin&a=login');
			}
		}
		else{
			Header('Location:index.php?m=Admin&a=login');
		}
		$this->assign('username',$_SESSION['name']);
		$header = $this->fetch('Admin:header');
        $this->assign('header', $header);
        $left = $this->fetch('Admin:left');
        $this->assign('left',$left);
		
		$this->display();
	}
	
	public function login(){
		session_start();
		if(isset($_SESSION['admin'])){
			if($_SESSION['admin']==true){
				Header('Location:index.php?m=Admin');
			}
		}
		$error_msg = "";
		if(isset($_POST['submit'])){
			$password = md5($_POST['password']);
			$username = $_POST['username'];
			$user = M('user');
			$result = $user->where('username=\''.$username.'\'')->select();
			if($result == NULL){
				$error_msg = "用户不存在！";
			}else{
				if($result[0]['password']==$password){
					$_SESSION['admin'] = true;
					$_SESSION['name'] = $username;
					Header('Location:index.php?m=Admin');
				}
				else{
					$error_msg = "密码错误！";
				}
			}
		}
		$this->assign('error_msg',$error_msg);
		$this->display();
	}
	
	public function logout(){
		session_start();
		session_unset();
		header('Location:index.php');
	}
	
	public function list_article(){
		session_start();
		if(isset($_SESSION['admin'])){
			if($_SESSION['admin']==false){
				Header('Location:index.php?m=Admin&a=login');
			}
		}
		else{
			Header('Location:index.php?m=Admin&a=login');
		}
		$this->assign('username',$_SESSION['name']);
		$header = $this->fetch('Admin:header');
        $this->assign('header', $header);
        $left = $this->fetch('Admin:left');
        $this->assign('left',$left);
		
		$this->display();
	}
	
	public function modify_article(){
		session_start();
		if(isset($_SESSION['admin'])){
			if($_SESSION['admin']==false){
				Header('Location:index.php?m=Admin&a=login');
			}
		}
		else{
			Header('Location:index.php?m=Admin&a=login');
		}
		$this->assign('username',$_SESSION['name']);
		$header = $this->fetch('Admin:header');
        $this->assign('header', $header);
        $left = $this->fetch('Admin:left');
        $this->assign('left',$left);
		
		$this->display();
	}
	
	public function add_article(){
		session_start();
		if(isset($_SESSION['admin'])){
			if($_SESSION['admin']==false){
				Header('Location:index.php?m=Admin&a=login');
			}
		}
		else{
			Header('Location:index.php?m=Admin&a=login');
		}
		$this->assign('username',$_SESSION['name']);
		$header = $this->fetch('Admin:header');
        $this->assign('header', $header);
        $left = $this->fetch('Admin:left');
        $this->assign('left',$left);
		
		$this->display();
	}
	
	public function list_flash(){
		session_start();
		if(isset($_SESSION['admin'])){
			if($_SESSION['admin']==false){
				Header('Location:index.php?m=Admin&a=login');
			}
		}
		else{
			Header('Location:index.php?m=Admin&a=login');
		}
		$this->assign('username',$_SESSION['name']);
		$header = $this->fetch('Admin:header');
        $this->assign('header', $header);
        $left = $this->fetch('Admin:left');
        $this->assign('left',$left);
		
		$flash = M('flash');
		$result = $flash->select();
		$this->assign('flash',$result);
		$this->display();
	}
	
	public function modify_flash(){
		session_start();
		if(isset($_SESSION['admin'])){
			if($_SESSION['admin']==false){
				Header('Location:index.php?m=Admin&a=login');
			}
		}
		else{
			Header('Location:index.php?m=Admin&a=login');
		}
		$this->assign('username',$_SESSION['name']);
		$header = $this->fetch('Admin:header');
        $this->assign('header', $header);
        $left = $this->fetch('Admin:left');
        $this->assign('left',$left);
        
        $id = $_GET['id'];
		//上传图片
		if(isset($_POST['submit'])){
			if(isset($_FILES['uploadfile']['name'])&&$_FILES['uploadfile']['name']<>''){
				// This is the temporary file created by PHP  
				$uploadedfile = $_FILES['uploadfile']['tmp_name'];
				// Create an Image from it so we can do the resize
				$src = imagecreatefromjpeg($uploadedfile);
				// Capture the original size of the uploaded image
				list($width,$height)=getimagesize($uploadedfile);
				// set the size of image
				$newwidth=360;  
				$newheight=220;
				$tmp=imagecreatetruecolor($newwidth,$newheight);
				// this line actually does the image resizing, copying from the original
				// image into the $tmp image
				imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
				// now write the resized image to disk.
				$filename = "./Common/flash/".time().$_FILES['uploadfile']['name'];
				imagejpeg($tmp,$filename,100);
				// NOTE: PHP will clean up the temp file it created when the request
				imagedestroy($src);
				imagedestroy($tmp);
				// has completed.
				$data['path'] = $filename;
			}
			$image = M('flash');
			$data['description'] = $_POST['description'];
			$data['link'] = $_POST['link'];
			$image->where('id='.$id)->save($data);
			Header('Location:index.php?m=Admin&a=list_flash');
		}
		$flash = M('flash');
		$result = $flash->where('id='.$id)->select();
		$this->assign('flash',$result);
		$this->display();
	}
}
?>
