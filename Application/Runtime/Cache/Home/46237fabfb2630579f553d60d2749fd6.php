<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<title>行云科技</title>

</head>
<body>
<div class="load" id="load">
 	<div class="zzsc2"></div>
</div>
<header class="hui-header">
	<h1>产品激活</h1>
</header> 
<div class="hui-wrap">
<form action="" method="post" class="jh">
	<div class="hui-form-items">
			<span class="kl-frspn" >激活序号  :  </span><input type="text" id="sn" value="<?php echo ($sn); ?>" class="hui-input hui-input-clear wide-xs4 hi_xlh"  placeholder="32位" >
		</div>
	<div class="hui-form-items">
			<span class="kl-frspn" >您的学校  :  </span><input type="text" id="school" class="hui-input hui-input-clear wide-xs4 hi_name" >
	</div>
	<div class="hui-form-items">
			<span class="kl-frspn" >您的专业  :  </span><input type="text" id="major" class="hui-input hui-input-clear wide-xs4 hi_school" >
	</div>
	<div class="hui-form-items">
			<span class="kl-frspn" >联系电话  :  </span><input type="text" id="phone" class="hui-input hui-input-clear wide-xs4 hi_wc" >
	</div>
	<div class="hui-form-items">
			<span class="kl-frspn" >您的邮箱  :  </span><input type="text" id="mailbox" class="hui-input hui-input-clear wide-xs4 hi_wc" >
	</div>	
	<button type="button" class="hui-button  hui-c"  id="rz_submit">提交审核</button>
</form>
</div>

</body>
</html>
<script src="/Public/static/js/jquery-2.0.3.min.js"></script>
<script>
$(function(){
	$("#rz_submit").click(function(){
		var school=$("#school").val();
		var major=$("#major").val();
		var phone=$("#phone").val();
		var mailbox=$("#mailbox").val();
		var sn=$("#sn").val();
		var url="<?php echo U('Product/activation');?>";
		var send={school:school,major:major,phone,mailbox:mailbox,sn:sn}
		$.post(url,send,function(msg){
			alert(msg)
		})

	})
})
</script>