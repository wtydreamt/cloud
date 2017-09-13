<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	private $logininfo;
	private $admin;
    public function __construct(){
    	parent::__construct();
    	$this->logininfo=c("LOGIN");
    	$this->admin=cookie("admin");
    }
    public function index(){
		   if($this->admin){
		   	  $this->display("release");
		   }else{
		   	  $this->display("login");
		   }
    }

    public function login(){
    		$data=I();
    		$user=trim($data['user']);
    		$pwd =trim($data['pwd']);
    		if($user!=$this->logininfo['name']){
    			echo "<script>
    			alert('登录名不正确');
    			window.location.href='http://lei.x-cloud.cc'
    			</script>";die;
    		}    		
    		if(md5($pwd)!=$this->logininfo['pwd']){
    			echo "<script>
    			alert('密码不正确');
    			window.location.href='http://lei.x-cloud.cc'
    			</script>";die;
    		}
    		cookie("admin",$user);
    		echo "<script>
    			window.location.href='http://lei.x-cloud.cc'
    			</script>";
    }
}