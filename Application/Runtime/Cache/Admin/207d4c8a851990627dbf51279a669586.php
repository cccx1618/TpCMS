<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>编辑角色</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
</head>

<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/">首页</a></li>
        <li><a href="/index.php/role/index">角色列表</a></li>
        <li><a href="javascript:void(0)">编辑角色</a></li>
    </ul>
</div>

<div class="formbody">

    <div class="formtitle"><span>基本信息</span></div>

    <ul class="forminfo">
        <input type="hidden" id="role_id" name="role_id" value="<?php echo ($roleinfo["role_id"]); ?>"/>
        <li><label>角色名称</label><input name="role_name" id="role_name" type="text" class="dfinput" value="<?php echo ($roleinfo["role_name"]); ?>"/><i>简洁明了，不易过长</i><span class="errorinfo"></span></li>
        <li><label>职责描述</label><textarea name="role_info" id="role_info" class="dfinput"><?php echo ($roleinfo["role_info"]); ?></textarea></li>
        <li>
            <label>拥有权限</label>
            <div  style="width:337px;height:300px;margin-left: 86px;padding:5px;border: 1px solid #CED9DF;OVERFLOW: scroll; scrollbar-face-color:#70807d; scrollbar-arrow-color:#ffffff; scrollbar-highlight-color:#ffffff; scrollbar-3dlight-color:#70807d; scrollbar-shadow-color:#ffffff; scrollbar-darkshadow-color:#70807d; scrollbar-track-color:#ffffff;">
                <ul>
                    <?php if(is_array($authlist)): $i = 0; $__LIST__ = $authlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $str=str_repeat("　　",$vo['auth_level']); ?>
                        <li><?php echo ($str); ?><input onchange="checkaction(<?php echo ($vo["auth_id"]); ?>);" type="checkbox" name="roleauth" class="auth_<?php echo ($vo["auth_id"]); ?>" title="<?php echo ($vo["auth_controller"]); ?>-<?php echo ($vo["auth_action"]); ?>" value="<?php echo ($vo["auth_id"]); ?>"/><?php echo ($vo["auth_name"]); ?></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </li>
        <li><label>&nbsp;</label><input name="" type="button" class="btn" value="确认保存" onclick="submitedi();"/></li>
    </ul>
</div>
<input type="hidden" id="auth_ids" value="<?php echo ($roleinfo["role_auth_ids"]); ?>"/>
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
</body>
<script>
    $(function(){
        var data=$('#auth_ids').attr('value');
        var idsarr=data.split(',');
        for(var i=0;i<idsarr.length;i++){
            $('.auth_'+idsarr[i]).attr('checked','checked');
        }
    })
</script>
<script>
    function submitedi(){
        var role_id=$('#role_id').attr('value');
        var role_name=$('#role_name').attr('value');
        var role_info=$('#role_info').attr('value');
        var role_auth_ids= "";
        var role_auth_ca= "";
        $('input:checkbox[name=roleauth]:checked').each(function(i){
            if(0==i){
                role_auth_ids = $(this).val();
                role_auth_ca = $(this).attr('title');
            }else{
                role_auth_ids += (","+$(this).val());
                role_auth_ca += (","+$(this).attr('title'));
            }
        });
        if(role_name==""){$('#role_name').parent().find('.errorinfo').html('角色名称不能为空');return;}
        $.post("/index.php/role/edi",{'role_id':role_id,'role_name':role_name,'role_info':role_info,'role_auth_ids':role_auth_ids,'role_auth_ca':role_auth_ca},function(data){
            if(data==1){
                showtip('编辑成功');
            }
            if(data==0){
                showtip('编辑失败');
            }

        })
    }

    function checkaction(n){
        var classname=".auth_"+n;
        if($(classname).attr('checked')){
            $.post('/index.php/role/checkaction',{'auth_id':n},function(data){
                var idsarr=data.split(',');
                for(var i=0;i<idsarr.length;i++){
                    $('.auth_'+idsarr[i]).attr('checked','checked');
                }
            })
        }else{
            $.post('/index.php/role/checkaction',{'auth_id':n},function(data){
                var idsarr=data.split(',');
                for(var i=0;i<idsarr.length;i++){
                    $('.auth_'+idsarr[i]).attr('checked','');
                }
            })
        }
    }
</script>
</html>