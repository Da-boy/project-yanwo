<?php
/**
 * ECMOBILE 支付响应页面
 */
error_reporting(E_ALL);

define('IN_ECS', true);

define('GZ_PATH', dirname(dirname(__FILE__)));
define('EC_PATH', dirname(GZ_PATH));

require(EC_PATH . '/includes/init.php');
require(EC_PATH . '/includes/lib_payment.php');
require(EC_PATH . '/includes/lib_order.php');

require(GZ_PATH . '/Library/log.func.php');
require(GZ_PATH . '/Library/pay/alipay/lib/alipay_notify_mobile.class.php');

rc_log('POST info:', json_encode($_POST));
//rc_log('Post all headers', json_encode(getallheaders()));

$payment  = get_payment('alipay_mobile');

//合作身份者id，以2088开头的16位纯数字
$alipay_config['partner']		= $payment['alipay_partner'];

//商户的私钥
$alipay_config['private_key_path']	= $payment['rsa_private_key'];

//支付宝公钥
$alipay_config['ali_public_key_path']=  GZ_PATH . '/Library/pay/alipay/key/alipay_public_key.pem'; // $payment['rsa_public_key'];

//签名方式 不需修改
$alipay_config['sign_type']    = strtoupper('RSA');

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset']= strtolower('utf-8');

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
$alipay_config['cacert']    = GZ_PATH . '/Library/pay/alipay/key/cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport']    = 'http';

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {
	//验证成功
	rc_log("Go to Verify success!!!");
	
	//商户订单号
	$out_trade_no = $_POST['out_trade_no'];
	$subject = $_POST['subject'];

	//支付宝交易号
	$trade_no = $_POST['trade_no'];

	//交易状态
	$trade_status = $_POST['trade_status'];
	
	//交易总价
	$total_fee = $_POST['total_fee'];
	
	//获取订单ID
	$order_sn = str_replace($subject, '', $out_trade_no);
	$order_sn = trim($order_sn);
	
	/* 检查支付的金额是否相符 */
	if (!check_money($order_sn, $total_fee))
	{
		echo "fail";
		die();
	}
	
	if ($trade_status == 'TRADE_FINISHED')
	{
		/* 改变订单状态 */
		order_paid($order_sn);
	
		echo "success";
	}
	elseif ($trade_status == 'TRADE_SUCCESS')
	{
		/* 改变订单状态 */
		order_paid($order_sn, 2);
	
		echo "success";
	}
	
}
else {
	//验证失败
	rc_log("Verify fail!!!");
	
	echo "fail";
}

if (!function_exists('getallheaders'))
{
	function getallheaders()
	{
		foreach ($_SERVER as $name => $value)
		{
			if (substr($name, 0, 5) == 'HTTP_')
			{
				$headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
			}
		}
		return $headers;
	}
}

?>