<?php
/**
 * Created by PhpStorm.
 * User: 吴义敏
 * Date: 2016/5/27
 * Time: 9:20
 * Des:模块子域名配置文件
 */
return array(
    'MODULE_ALLOW_LIST'    =>    array('Home','Admin'),  //模块列表
    'DEFAULT_MODULE'       =>    'Home',                 //默认访问的模块

    'APP_SUB_DOMAIN_DEPLOY'   =>    1,                  // 开启子域名或者IP配置
    'APP_SUB_DOMAIN_RULES'    =>    array(              //子域名规则
        'web.tpcms.com' =>array('Home','sitename=home'),
        'admin.tpcms.com' =>array('Admin','sitename=admin'),
    ),
);