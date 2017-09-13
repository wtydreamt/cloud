<?php
namespace Home\Model;
use Think\Model;
class Login_logModel extends  Model
{

	 protected $tableName = "login_log";
/*
*字段映射
 */
	 protected $_map = array(         
	 'serial'      =>'l_number',         
	 'hour'        =>'l_time',
	 'wechat'      =>'l_wei',
	 );
}
?> 