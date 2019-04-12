<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>权限管理</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/css/other.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".click").click(function(){
                $(".tip").fadeIn(200);
            });

            $(".tiptop a").click(function(){
                $(".tip").fadeOut(200);
            });

            $(".sure").click(function(){
                $(".tip").fadeOut(100);
            });

            $(".cancel").click(function(){
                $(".tip").fadeOut(100);
            });

        });
    </script>


</head>


<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/">首页</a></li>
        <li><a href="/index.php/auth/index">权限管理</a></li>
    </ul>
</div>

<div class="rightinfo">

    <div class="tools">

        <ul class="toolbar">
            <li><a href="/index.php/auth/add"><span><img src="/Public/Admin/images/t01.png" /></span>添加</a></li>
            <!--<li class="click"><span><img src="/Public/Admin/images/t02.png" /></span>修改</li>-->
            <!--<li onclick="showtip('确认批量删除吗？','/index.php/auth/delete');"><span><img src="/Public/Admin/images/t03.png" /></span>批量删除</li>-->
            <!--<li><span><img src="/Public/Admin/images/t04.png" /></span>统计</li>-->
        </ul>


      <!--  <ul class="toolbar1">
            <li><span><img src="/Public/Admin/images/t05.png" /></span>设置</li>
        </ul>-->

    </div>


    <table class="tablelist">
        <thead>
        <tr>
            <th>权限名称</th>
            <th>权限控制器</th>
            <th>权限方法</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($authlist)): $i = 0; $__LIST__ = $authlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
            <td><?php echo ($vo["auth_name"]); ?></td>
            <td><?php echo ($vo["auth_controller"]); ?></td>
            <td><?php echo ($vo["auth_action"]); ?></td>
            <td><a onclick="del(<?php echo ($vo["auth_id"]); ?>);" class="tablelink actionlink"> 删除</a></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>

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
    <div id="messagebg" style="position:fixed;z-index: 10001;display: none;width:100%;height:100%;left:0;top:0;background:#000;filter:alpha(opacity=50);-moz-opacity:0.5;-khtml-opacity: 0.5; opacity: 0.5;"></div>
<div id="messagetip" style="width:340px;height:200px;position:fixed;z-index: 10002;background: #fff;display: none;margin-right:20px;border-radius:4px;">
    <div class="tiptop"><span>提示信息</span><a onclick="closeconfirm();"></a></div>
    <div id="message" style="line-height: 30px;text-align: center;margin-top: 45px;font-size: 14px;color:#4D4D4D"></div>
    <div>
        <div class="but" style="float: left;width:110px;height: 30px;line-height: 30px;text-align: center;background: #388EC0;color: white;margin-left:42px;cursor: pointer;border-radius:4px;font-size:16px;margin-top:40px;"><a  style="display: block;color:#fff;font-size:16px;" onclick="confirmtrue()">确定</a></div>
        <div class="but" onclick="closeconfirm();" style="width:110px;height: 30px;line-height: 30px;text-align: center;float: left;background: #C9D0D3;color: white;margin-left:34px;cursor: pointer;border-radius:4px;font-size:16px;margin-top:40px;">关闭</div>
        <div style="clear:both; font-size: 0; height: 0; line-height: 0;"></div>
        <input type="hidden" name="param" id="param" value="">
    </div>
</div>


<script>
    function showconfirm(message,n){
        $("#message").html(message);
        var width=$(window).width();
        var height=$(window).height();
        var newwidth=width-300;
        var newheight=height-150;
        var marginleft=newwidth/2+"px";
        var margintop=(newheight/2)-100+"px";
        $("#messagetip").css({"top":margintop,"left":marginleft});
        $("#messagetip").css("display","block");
        $("#messagebg").css("display","block");
        $("#param").attr('value',n);                      //为即将进行的操作赋值参数
    }

    function closeconfirm(){
        $("#messagetip").css("display","none");
        $("#messagebg").css("display","none");
    }

    function confirmtrue(){
        $("#messagetip").css("display","none");
        $("#messagebg").css("display","none");
        var n=$("#param").attr('value');
        deltrue(n);
    }

</script>
</div>

<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');

    function del(n){
       showconfirm('您确定执行当前操作吗',n);
    }

    function deltrue(n){
        $.post('/index.php/auth/del',{'id':n},function(data){
            if(data==1){
                showtip('操作成功');
                location.reload();
            }
            if(data==0){
                showtip('操作失败');
            }
            if(data==2){
                showtip('此记录有子级，无法删除');
            }
        })
    }
</script>

</body>

</html>