<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller {
    public function Reg(){
        $sn=I("SN");
        $this->assign("sn",$sn);
        $this->display("test");
    }
    public function downloads(){
        $file_name = I("filename");
        $file_sub_path =$_SERVER['DOCUMENT_ROOT'].__ROOT__.'Public/static/download/';
        if(!file_exists($file_sub_path.$file_name)){
            echo "文件不存在请检查文件名及后缀是否正确";die;
        }
        $file = fopen($file_sub_path.$file_name,"r");
        //返回的文件类型
        Header("Content-type: application/octet-stream");
        //按照字节大小返回
        Header("Accept-Ranges: bytes");
        //返回文件的大小
        Header("Accept-Length: ".filesize($file_dir.$file_name));
        //这里对客户端的弹出对话框，对应的文件名
        Header("Content-Disposition: attachment; filename=".$file_dir.$file_name);
        //修改之前，一次性将数据传输给客户端
        echo fread($file, filesize($file_dir.$file_name));
        //修改之后，一次只传输1024个字节的数据给客户端
        //向客户端回送数据
        $buffer=2048;//
        //判断文件是否读完
        while (!feof($file)) {
            //将文件读入内存
            $file_data=fread($file,$buffer);
            //每次向客户端回送1024个字节的数据
            echo $file_data;
        }
        fclose($file);      
    }
    public function productquery(){
        $sn=I("code");
        $sn=strtoupper($sn);
        $arr=M("product")->where(array("number"=>$sn))->field("status,number")->find();
        $json=array();
        if($arr){
            $key="ADLAB83359";
            $str=md5($sn.$key);
            if($arr['status']=="0"){
                $json=array("data"=>"ok","status"=>"false","code"=>$str);
            }else{
                $json=array("data"=>"ok","status"=>"true","code"=>$str);
            }
            
        }else{
               $json=array("data"=>"no","status"=>"fasle","code"=>"");
        }
        echo json_encode($json);
    }

    public function activation(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Max-Age: 1000');        
        $data=I();
        $sn=$data['sn'];
        $sn=strtoupper($data['sn']);
        unset($data['sn']); 
        $arr=M("product")->where(array("number"=>$sn,"school"=>$data['school']))->field("status,number")->find();
            if(!$arr){
                echo "序列号不存在或对应的学校单位不一致";die;
            }else{
                if($arr['status']=="1"){
                    echo "产品已激活";die;
                }
            }            
        $res=M("activation_user")->add($data);
        if(!$res){
            echo "网络繁忙稍后再试";die;
        }else{
            $updata=array("activation_time"=>date("Y-m-d H:i:s"),"status"=>"1","aid"=>$res);
            $save=M("product")->where(array("number"=>$sn))->save($updata);

            // echo M("product")->getLastSql();die;
            if($save){
                echo "激活成功";die;
            }else{
                echo "激活失败";die;
            }
        }
    }
/**
 * 检测请求方式 
 * @param request 请求方式错误信息 类型 string  true 是成功  其他为错误信息
 * @param method  接口请求方式     POST string
 * @param status  数据存储状态     类型 string  true 成功 false 失败
 */
    public function LoginLog(){
        header('Content-type:text/html;charset=utf-8');
        if($_SERVER['REQUEST_METHOD']=="POST"){
                    $data=I();
                    $message=array();
                    $res_data=$this->testing($data);
                    if(empty($res_data['data'])){
                                    $message['request']="true";
                                    $message['method'] ="POST";
                                    $message['status'] ="fasle";
                                    $message['param']  ="false";
                                    $message['error']  ="空的请求参数";
                    }else if(!empty($res_data['error'])){
                                    $message['request']="true";
                                    $message['method'] ="POST";
                                    $message['status'] ="fasle";
                                    $message['param']  ="false";
                                    $message['error']  ="错误的请求参数:".implode("、",$res_data['error']);                         
                    }else{
                        $res=M("login_log")->add($res_data['data']);
                        if($res){
                            $message['request']="true";
                            $message['method'] ="POST";
                            $message['status'] ="true";
                            $message['param']  ="true";
                            $message['error']  ="0";
                        }else{
                            $message['request']="true";
                            $message['method'] ="POST";
                            $message['status'] ="false";
                            $message['param']  ="true";
                            $message['error']  ="网络繁忙稍后再试";                
                        }                        
                    }           

            }else{
                        $message['request']="false";
                        $message['method'] ="POST";
                        $message['status'] ="false";
                        $message['param']  ="";
                        $message['error']  ="错误的请求类型";
            }                        

        echo json_encode($message);

    }
    public function testing($data){
        $arr=array();
        $error=array();
        foreach($data as $key=>$val){
            switch($key) {
                case 'number'     :   
                      $arr['l_number']=$val;break;
                case 'ltime'      :   
                      $arr['l_time']=$val;break;  
                case 'wechat'     :   
                      $arr['l_wei']=$val;break;  
                default:
                      $error[]=$key;
            }            
        }
        $res["data"]=$arr;
        $res["error"]=$error;
        return $res;
    }
    public function ProductAdd(){
        $data=I();
        $number=explode("\n",$data['number']);
        // $time=date("Y/m/d");
        $arr=array();
        foreach($number as $k=>$n){
            $arr[]=array("number"=>$n,"product"=>$data['product'],"school"=>$data['school'],"order"=>$data['order'],"deliver_time"=>$data['deliver_time']);
        }
        $res=M("product")->addAll($arr);
        if($res){
            echo "录入成功";
        }else{
            echo "录入失败";
        }
    }
  }
// http://www.x-cloud.cc/Prouduct/Reg?SN=ADLabN+32位Md5码

// data  状态为ok代表有数据 为no时是没有数据 参数类型 strign
// status 状态为true 为激活状态  false 为未激活  参数类型 string
// code  当data 为ok  并且 status 为true 时返回 加密的密文   
// 加密格式 
// $key="ADLAB83359";
// $sn ="序列号";
// 密文 $str=md5($sn.$key);
// ADLABN508846BB8E3EDC3DC80F1778CA7F9DA3

// http://www.test.com/Product/LoginLog   登录行为数据存储请求
// 请求方式 post
// 请求参数 number 序列号
//          ltime  登录时间
//          wechat 微信号
// 参数格式 json
