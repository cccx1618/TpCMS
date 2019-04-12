<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/Public/Admin/js/jquery.js"></script>

    <script type="text/javascript">
        $(function(){
            //导航切换
            $(".menuson li").click(function(){
                $(".menuson li.active").removeClass("active")
                $(this).addClass("active");
            });

            $('.title').click(function(){
                var $ul = $(this).next('ul');
                $('dd').find('ul').slideUp();
                if($ul.is(':visible')){
                    $(this).next('ul').slideUp();
                }else{
                    $(this).next('ul').slideDown();
                }
            });
        })
    </script>


</head>

<body style="background:#f0f9fd;">

<dl class="leftmenu">
    <?php if(is_array($authlist)): $i = 0; $__LIST__ = $authlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><dd>
        <?php if($vo['auth_level'] == 0): ?><div class="title">
            <span><img src="/Public/Admin/images/leftico01.png" /></span><?php echo ($vo["auth_name"]); ?>
        </div><?php endif; ?>
        <ul class="menuson">
            <?php if(is_array($authlist)): $i = 0; $__LIST__ = $authlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vob): $mod = ($i % 2 );++$i; if($vob['pid'] == $vo['auth_id']): ?><li><cite></cite><a href="/index.php/<?php echo ($vob["auth_controller"]); ?>/<?php echo ($vob["auth_action"]); ?>" target="rightFrame"><?php echo ($vob["auth_name"]); ?></a><i></i></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </dd><?php endforeach; endif; else: echo "" ;endif; ?>
</dl>

</body>
</html>