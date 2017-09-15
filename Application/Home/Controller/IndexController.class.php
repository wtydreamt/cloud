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
              $res=M("product_name")->select();
              $this->assign("product",$res);
		   	  $this->display("release");
		   }else{
		   	  $this->display("login");
		   }
    }

    public function login(){
            $host=$_SERVER['SERVER_NAME'];
    		$data=I();
    		$user=trim($data['user']);
    		$pwd =trim($data['pwd']);
    		if($user!=$this->logininfo['name']){
    			echo "<script>
    			alert('登录名不正确');
    			window.location.href=".$host."
    			</script>";die;
    		}    		
    		if(md5($pwd)!=$this->logininfo['pwd']){
    			echo "<script>
    			alert('密码不正确');
    			window.location.href=".$host."
    			</script>";die;
    		}
    		cookie("admin",$user);
    		echo "<script>
    			window.location.href=".$host."
    			</script>";
    }

    public function addproduct(){
        $name=I("name");
        $res=M("product_name")->where(array("name"=>$name))->find();
        if($res){
            echo "此产品名已存在";die;
        }else{
            $res_add=M("product_name")->add(array("name"=>$name));
            if($res_add){
                echo "ok";
            }else{
                echo "添加失败";
            }
        }

    }
}