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
    <h1>登录</h1>
</header> 
<div class="hui-wrap">
<form action="<?php echo U('login');?>" method="post" class="jh">
    <div class="hui-form-items">
            <span class="kl-frspn" >登录名  :  </span><input type="text" name="user" class="hui-input hui-input-clear wide-xs4 hi_wc" >
    </div>
    <div class="hui-form-items">
            <span class="kl-frspn" >密码&nbsp&nbsp&nbsp&nbsp:  </span><input type="password" name="pwd" class="hui-input hui-input-clear wide-xs4 hi_wc" >
    </div>  
    <button type="submit" class="hui-button  hui-c"  id="rz_submit">登录</button>
</form>
</div>
</body>
</html>