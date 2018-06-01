<?php 
session_start();//不可随意开启，否则可能会影响验证码显示效果
// 设置页面内容是html编码格式是utf-8
header("content-type:text/html;charset=utf-8");
// 设置中国时区
date_default_timezone_set("PRC");
// 设置根路径，dirname(__FILE__)文件所在层路径
define("ROOT",dirname(__FILE__));
// 设置包含路径，get_include_path获取当前的 include_path 配置选项
set_include_path(".".PATH_SEPARATOR.ROOT."/lib".PATH_SEPARATOR.ROOT."/core".PATH_SEPARATOR.ROOT."/configs".PATH_SEPARATOR.get_include_path());
require_once 'mysql.func.php';
require_once 'image.func1.php';
require_once 'common.func.php';
require_once 'string.func1.php';
require_once 'page.func.php';
require_once "configs.php";
require_once 'admin.inc.php';
require_once 'cate.inc.php';
require_once 'pro.inc.php';
require_once 'album.inc.php';
require_once 'upload.func.php';
require_once 'user.inc.php';
// 连接数据库,运行时必须要连接数据库
connect();
