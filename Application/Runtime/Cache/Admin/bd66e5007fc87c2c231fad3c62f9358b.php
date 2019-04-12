<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>编辑管理员</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
</head>

<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/">首页</a></li>
        <li><a href="/index.php/adminuser/index">管理员列表</a></li>
        <li><a href="javascript:void(0)">编辑管理员</a></li>
    </ul>
</div>

<div class="formbody">

    <div class="formtitle"><span>基本信息</span></div>

    <ul class="forminfo">
        <input type="hidden" name="mg_id" id="mg_id" value="<?php echo ($mginfo["mg_id"]); ?>"/>
        <li><label>人员名称</label><input name="mg_name" id="mg_name" type="text" class="dfinput" value="<?php echo ($mginfo["mg_name"]); ?>"/><i>简洁明了，不易过长</i><span class="errorinfo"></span></li>
        <li>
            <label>所属角色</label>
            <select name="mg_role_id" id="mg_role_id" class="dfinput">
                <option value="0">请选择</option>
                <?php if(is_array($rolelist)): $i = 0; $__LIST__ = $rolelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if($mginfo['mg_role_id'] == $vo['role_id']): ?><option value="<?php echo ($vo["role_id"]); ?>" selected="selected"><?php echo ($vo["role_name"]); ?></option>
                        <?php else: ?>
                        <option value="<?php echo ($vo["role_id"]); ?>"><?php echo ($vo["role_name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </select>
            <span class="errorinfo"></span>
        </li>
        <li>
            <label>重置密码</label>
            <input type="password" name="mg_pwd" id="mg_pwd" class="dfinput" value=""/><i>为空则不改变密码</i><span class="errorinfo"></span>
        </li>
        <li>
            <label>状　　态</label>
            <div style="position: relative;top:10px;">
                <input type="radio" name="mg_status"  value="1" <?php if(($mginfo['mg_status']) == "1"): ?>checked="checked"<?php endif; ?>/>开启
                &nbsp;&nbsp;
                <input type="radio" name="mg_status"  value="0" <?php if(($mginfo['mg_status']) == "0"): ?>checked="checked"<?php endif; ?>/>关闭
            </div>
        </li>
        <li><label>&nbsp;</label><input name="" type="button" class="btn" value="确认保存" onclick="submitedi();"/></li>
    </ul>


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
</body>
<script>
    function submitedi(){
        var mg_name=$('#mg_name').attr('value');
        var mg_role_id=$('#mg_role_id').attr('value');
        var mg_status=$('input[name="mg_status"]:checked').attr('value');
        var mg_id=$('#mg_id').attr('value');
        var mg_pwd=$('#mg_pwd').attr('value');
        if(mg_name==""){$('#mg_name').parent().find('.errorinfo').html('人员名称不能为空');return;}
        if(mg_role_id==0){$('#mg_role_id').parent().find('.errorinfo').html('所属角色必须选择');return;}
        if(mg_pwd!=""){
            if(mg_pwd.length<6){$('#mg_pwd').parent().find('.errorinfo').html('密码不能短于6位');return;}
        }
        $.post("/index.php/adminuser/edi",{'mg_id':mg_id,'mg_name':mg_name,'mg_role_id':mg_role_id,'mg_status':mg_status,'mg_pwd':mg_pwd},function(data){
            if(data==1){
                showtip('修改成功');
                location.reload();
            }
            if(data==0){
                showtip('修改失败');
            }

        })
    }
</script>
</html>