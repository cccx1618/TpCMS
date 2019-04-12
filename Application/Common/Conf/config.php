<?php
return array(
	//'配置项'=>'配置值'
    'LOAD_EXT_CONFIG' => 'db_config,route_config,url_config',       //加载扩展配置
    'SHOW_PAGE_TRACE' =>true,
    //数据缓存
    'DATA_CACHE_TYPE' => 'Memcache',                  //把默认缓存改为memcache缓存方式
    'MEMCACHE_HOST'   => 'tcp://127.0.0.1:11211',  //memcache服务器地址和端口，这里为本机。
    'DATA_CACHE_TIME' => '0' ,                        //过期的秒数。0为永久有效

    //页面资源路径
    'TMPL_PARSE_STRING' => array(
        'STATIC_ADMIN_CSS' => __ROOT__ . '/Public/Admin/css',
        'STATIC_ADMIN_JS'  => __ROOT__ . '/Public/Admin/js',
        'STATIC_ADMIN_IMG' => __ROOT__ . '/Public/Admin/images',
    ),

);