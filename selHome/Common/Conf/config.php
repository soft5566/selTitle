<?php
return array(
	//'配置项'=>'配置值'

    'DEFAULT_MODULE'        => 'Home', //默认模块
//    'URL_MODEL'              => '2', //URL模式
    'SESSION_AUTO_START'    => true, //是否开启session


    // 是否开启模板编译缓存,设为false则每次都会重新编译
    'TMPL_CACHE_ON' => false,

    // 显示页面Trace信息
    // 'SHOW_PAGE_TRACE' =>true,

    //自定义success和error的提示页面模板
    'TMPL_ACTION_SUCCESS'=>'public:dispatch_jump',
    'TMPL_ACTION_ERROR'=>'public:dispatch_jump',

);