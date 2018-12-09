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
require(GZ_PATH . '/Library/pay/alipay/lib/alipay_notify_wap.class.php');

rc_log('POST info:', json_encode($_POST));
// rc_log('Post all headers', json_encode(getallheaders()));

$payment  = get_payment('alipay_wap');

//合作身份者id，以2088开头的16位纯数字
$alipay_config['partner']		= $payment['alipay_partner'];

//安全检验码，以数字和字母组成的32位字符
//如果签名方式设置为“MD5”时，请设置该参数
$alipay_config['key']			= $payment['alipay_key'];

//商户的私钥（后缀是.pen）文件相对路径
//如果签名方式设置为“0001”时，请设置该参数
// $alipay_config['private_key_path']	= GZ_PATH . '/Library/pay/alipay/key/rsa_private_key.pem';

//支付宝公钥（后缀是.pen）文件相对路径
//如果签名方式设置为“0001”时，请设置该参数
// $alipay_config['ali_public_key_path']= GZ_PATH . '/Library/pay/alipay/key/alipay_public_key.pem';

//签名方式 不需修改
$alipay_config['sign_type']    = 'MD5';

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset']= 'utf-8';

//ca证书路径地址，用于curl中ssl校验
//请保证cacert.pem文件在当前文件夹目录中
// $alipay_config['cacert']    = GZ_PATH . '/Library/pay/alipay/key/cacert.pem';

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport']    = 'http';

//计算得出通知验证结果
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {
	//验证成功
	rc_log("Go to Verify success!!!");
	
	//解密（如果是RSA签名需要解密，如果是MD5签名则下面一行清注释掉）
	//$notify_data = $alipayNotify->decrypt($_POST['notify_data']);
	$notify_data = $_POST['notify_data'];
	rc_log("notify data", $notify_data);
	
	//解析notify_data
	//注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
	$doc = new DOMDocument();
	$doc->loadXML($notify_data);
	
	if( ! empty($doc->getElementsByTagName( "notify" )->item(0)->nodeValue) ) {
		//商户订单号
		$out_trade_no = $doc->getElementsByTagName( "out_trade_no" )->item(0)->nodeValue;
		//支付宝交易号
		$trade_no = $doc->getElementsByTagName( "trade_no" )->item(0)->nodeValue;
		//交易状态
		$trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;
		//subject
		$subject = $doc->getElementsByTagName( "subject" )->item(0)->nodeValue;
		//total fee
		$total_fee = $doc->getElementsByTagName( "total_fee" )->item(0)->nodeValue;
		
		//获取订单ID
		$order_sn = str_replace($subject, '', $out_trade_no);
		$order_sn = trim($order_sn);
		
		/* 检查支付的金额是否相符 */
		if (!check_money($order_sn, $total_fee))
		{
			echo "fail";
			rc_log("order fail!!!");
			die();
		}
	
		if ($trade_status == 'TRADE_FINISHED')
		{
			/* 改变订单状态 */
			order_paid($order_sn);
		
			echo "success";
			
			rc_log("order TRADE_FINISHED!!!");
		}
		elseif ($trade_status == 'TRADE_SUCCESS')
		{
			/* 改变订单状态 */
			order_paid($order_sn, 2);
		
			echo "success";
			
			rc_log("order TRADE_SUCCESS!!!");
		}
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