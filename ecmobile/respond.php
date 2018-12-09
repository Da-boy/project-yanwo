<?php

/**
 * ECMOBILE 支付响应页面
 */
error_reporting(E_ALL);

define('IN_ECS', true);

define('GZ_PATH', dirname(__FILE__));
define('EC_PATH', dirname(GZ_PATH));

require(EC_PATH . '/includes/init.php');
require(EC_PATH . '/includes/lib_payment.php');
require(EC_PATH . '/includes/lib_order.php');
require(GZ_PATH . '/Library/log.func.php');

rc_log('GET respond info:', json_encode($_GET));
rc_log('POST respond info:', json_encode($_POST));

/* 支付方式代码 */
$pay_code = !empty($_REQUEST['code']) ? trim($_REQUEST['code']) : '';

//获取首信支付方式
if (empty($pay_code) && !empty($_REQUEST['v_pmode']) && !empty($_REQUEST['v_pstring']))
{
    $pay_code = 'cappay';
}

//获取快钱神州行支付方式
if (empty($pay_code) && ($_REQUEST['ext1'] == 'shenzhou') && ($_REQUEST['ext2'] == 'ecshop'))
{
    $pay_code = 'shenzhou';
}

/* 参数是否为空 */
if (empty($pay_code))
{
    $msg = $_LANG['pay_not_exist'];
}
else
{
    /* 检查code里面有没有问号 */
    if (strpos($pay_code, '?') !== false)
    {
        $arr1 = explode('?', $pay_code);
        $arr2 = explode('=', $arr1[1]);

        $_REQUEST['code']   = $arr1[0];
        $_REQUEST[$arr2[0]] = $arr2[1];
        $_GET['code']       = $arr1[0];
        $_GET[$arr2[0]]     = $arr2[1];
        $pay_code           = $arr1[0];
    }

    /* 判断是否启用 */
    $sql = "SELECT COUNT(*) FROM " . $ecs->table('payment') . " WHERE pay_code = '$pay_code' AND enabled = 1";
    if ($db->getOne($sql) == 0)
    {
        $msg = $_LANG['pay_disabled'];
    }
    else
    {
        $plugin_file = EC_PATH . '/includes/modules/payment/' . $pay_code . '.php';

        /* 检查插件文件是否存在，如果存在则验证支付是否成功，否则则返回失败信息 */
        if (file_exists($plugin_file))
        {
            /* 根据支付方式代码创建支付类的对象并调用其响应操作方法 */
            include_once($plugin_file);

            $payment = new $pay_code();
            $msg     = (@$payment->respond()) ? $_LANG['pay_success'] : $_LANG['pay_fail'];
        }
        else
        {
            $msg = $_LANG['pay_not_exist'];
        }
    }
}

$position = assign_ur_here();

$respond =<<<respond
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />
    <title>{$position["title"]}</title>
    
    <style type="text/css">
        body,html,div,p,h2,span{
            margin:0px;
            padding:0px;
        }
    </style>
    <script type="text/javascript">
    	function goback() {
    		if (/android/i.test(navigator.userAgent)){
			    // todo : android
			    window.ecmoban.back();
			}
			
			if (/ipad|iphone|mac/i.test(navigator.userAgent)){
			    // todo : ios
			    window.location.href="objc://payback";
			}
    	}
    </script>
</head>
<body>
    <div style="width:100%;overflow: hidden;margin:0px;padding:0px 0px;text-align: center;">
        <h2 style="background:#ccc;line-height:40px;height:40px;">提示信息</h2>
        <p style="font-size:20px; line-height:25px;min-height:100px;padding-top:20px;">{$msg}</p>
        <a style="font-size:18px;" href="#" onclick="goback()">返回</a>
    </div>
</body>
</html>
respond;

echo $respond;
 
?>