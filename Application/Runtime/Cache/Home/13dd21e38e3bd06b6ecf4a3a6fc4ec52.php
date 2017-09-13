<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>行云科技</title>
<link rel="stylesheet" type="text/css" href="/Public/static/css/hui.css" />
<style>
.hui-input{height:40px;line-height:22px;float:left;width:62%;border:0;padding-left:6px;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:0;border:0;background:#fff;border:1px solid #ccc}
</style>
</head>
<body>
<div class="load" id="load">
    <div class="zzsc2"></div>
</div>
<header class="hui-header">
    <h1>录入产品信息</h1>
</header> 
<div class="hui-wrap">
<form action="<?php echo U(login);?>" method="post" class="jh">
    <div class="hui-form-items">
            <span class="kl-frspn" >产品名  :  </span><input type="text" name="user" class="hui-input hui-input-clear wide-xs4 hi_wc" >
    </div>
    <div class="hui-form-items">
            <span class="kl-frspn" >用户&nbsp&nbsp  :  </span><input type="text" name="user" class="hui-input hui-input-clear wide-xs4 hi_wc" >
    </div>  
    <div class="hui-form-items">
            <span class="kl-frspn" >订单号  :  </span><input type="text" name="user" class="hui-input hui-input-clear wide-xs4 hi_wc" >
    </div>      
    <div class="hui-form-items">
            <span class="kl-frspn" >序列号  :  </span><textarea name="" id="number" cols="143" rows="50"></textarea>
    </div>  

    <button type="button" class="hui-button  hui-c"  id="rz_submit">提交</button>
</form>
</div>
</body>
</html>
<script src="/Public/static/js/jquery-2.0.3.min.js"></script>
<script>
$(function(){
	$("#rz_submit").click(function(){
		var number=$("#number").val();
		var send={serial:"jfsdkjflasd",hour:"2017",wechat:"weixin"}
		var url="<?php echo U('Product/LoginLog');?>";
		$.post(url,send,function(msg){
			alert(msg)
		})
	})
	$("#number").keydown(function(e){
		   if (e.keyCode == 13) {  
				var number=$("#number").val();
				var number=number.replace(/\s+/g, "");
				var length=number.length;
				var n=length/38;
				alert(n);
           }
		
	})
})
</script>