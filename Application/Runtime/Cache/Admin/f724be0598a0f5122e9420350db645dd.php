<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加权限</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
</head>

<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="/">首页</a></li>
        <li><a href="/index.php/auth/index">权限列表</a></li>
        <li><a href="/index.php/auth/add">添加权限</a></li>
    </ul>
</div>

<div class="formbody">

    <div class="formtitle"><span>基本信息</span></div>

    <ul class="forminfo">
        <li><label>权限名称</label><input name="auth_name" id="auth_name" type="text" class="dfinput" /><i>简洁明了，不易过长</i><span class="errorinfo"></span></li>
        <li><label>权限控制器</label><input name="auth_controller" id="auth_controller" type="text" class="dfinput" /><span class="errorinfo"></span></li>
        <li><label>权限方法</label><input name="auth_action" id="auth_action" type="text" class="dfinput" /><span class="errorinfo"></span></li>
        <li>
            <label>父级权限</label>
            <select name="pid" id="pid" class="dfinput">
               <option value="0">请选择</option>
               <?php if(is_array($authlist)): $i = 0; $__LIST__ = $authlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["auth_id"]); ?>"><?php echo ($vo["auth_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </li>
        <li><label>&nbsp;</label><input name="" type="button" class="btn" value="确认保存" onclick="submitadd();"/></li>
    </ul>


</div>

</body>
<script>
    function submitadd(){
        var auth_name=$('#auth_name').attr('value');
        var auth_controller=$('#auth_controller').attr('value');
        var auth_action=$('#auth_action').attr('value');
        var pid=$('#pid').attr('value');
        if(auth_name==""){$('#auth_name').parent().find('.errorinfo').html('权限名称不能为空');return;}
        $.post("/index.php/auth/add",{'auth_name':auth_name,'auth_controller':auth_controller,'auth_action':auth_action,'pid':pid},function(data){
            if(data==1){
                alert("操作成功");
                location.reload();
            }
            if(data==0){
                alert('操作失败')
            }

        })
    }
</script>
</html>