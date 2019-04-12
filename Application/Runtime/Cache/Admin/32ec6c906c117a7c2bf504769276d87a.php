<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>欢迎登录后台管理系统</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>
    <script src="/Public/Admin/js/cloud.js" type="text/javascript"></script>

    <script language="javascript">
        $(function(){
            $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
            $(window).resize(function(){
                $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
            })
        });
    </script>

</head>

<body style="background-color:#1c77ac; background-image:url(/Public/Admin/images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">

<div id="mainBody">
    <div id="cloud1" class="cloud"></div>
    <div id="cloud2" class="cloud"></div>
</div>

<div class="logintop">
    <span>欢迎登录后台管理界面平台</span>
   <!-- <ul>
        <li><a href="#">回首页</a></li>
        <li><a href="#">帮助</a></li>
        <li><a href="#">关于</a></li>
    </ul>-->
</div>

<div class="loginbody">
    <span class="systemlogo"></span>
    <div class="loginbox">
        <ul>
            <li><input name="mg_name" id="mg_name" type="text" class="loginuser"placeholder="管理员名称"/></li>
            <li><input name="mg_pwd"  id="mg_pwd" type="text" class="loginpwd" placeholder="密码"/></li>
            <li><input name="" type="button" class="loginbtn" value="登录"  onclick="loginaction()"  /><label><input name="" type="checkbox" value="" checked="checked" />记住密码</label><label></label></li>
        </ul>
    </div>
</div>
<div id="messagebg_tipinfo" style="position:fixed;z-index: 10001;display: none;width:100%;height:100%;left:0;top:0;background:#000;filter:alpha(opacity=50);-moz-opacity:0.5;-khtml-opacity: 0.5; opacity: 0.5;"></div>
<div id="messagetip_tipinfo" style="width:340px;height:200px;position:fixed;z-index: 10002;background: #fff;display: none;margin-right:20px;border-radius:4px;">
    <div class="tiptop"><span>提示信息</span><a onclick="closetip();"></a></div>
    <div id="message_tipinfo" style="line-height: 30px;text-align: center;margin-top: 45px;font-size: 14px;color:#4D4D4D;"></div>
    <div>
        <div class="but" onclick="closetip();" style="width:120px;height: 30px;line-height: 30px;text-align: center;float: left;background: #C9D0D3;color: white;margin-left:110px;;cursor: pointer;border-radius:4px;font-size:16px;margin-top:40px;">知道了</div>
        <div style="clear:both; font-size: 0; height: 0; line-height: 0;"></div>
    </div>
</div>


<script>
    function showtip(message){
        $("#message_tipinfo").html(message);
        var width=$(window).width();
        var height=$(window).height();
        var newwidth=width-300;
        var newheight=height-150;
        var marginleft=newwidth/2+"px";
        var margintop=(newheight/2)-100+"px";
        $("#messagetip_tipinfo").css({"top":margintop,"left":marginleft});
        $("#messagetip_tipinfo").css("display","block");
        $("#messagebg_tipinfo").css("display","block");

    }

    function closetip(){
        $("#messagetip_tipinfo").css("display","none");
        $("#messagebg_tipinfo").css("display","none");
    }
</script>
<!--<div class="loginbm">版权所有  2013  <a href="http://www.uimaker.com">uimaker.com</a>  仅供学习交流，勿用于任何商业用途</div>-->
<script>
   function loginaction(){
       var mg_name=$('#mg_name').attr('value');
       var mg_pwd=$('#mg_pwd').attr('value');

       $.post('/index.php/login/index',{mg_name:mg_name,mg_pwd:mg_pwd},function(data){
            if(data==-1) showtip('用户名或密码不得为空');
            if(data==-2) showtip('密码不正确');
            if(data==0) showtip('该管理员信息不存在或已被关闭');
            if(data==1){
                window.location.href="/index.php/Index/index";
            }
       })
   }
</script>
</body>
</html>