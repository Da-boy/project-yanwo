<?php
//by Hao.Dongfang
define('INIT_NO_USERS', true);

require(EC_PATH . '/includes/init.php');

GZ_Api::authSession();

include_once(EC_PATH . '/includes/lib_transaction.php');
include_once(EC_PATH . '/includes/lib_payment.php');
include_once(EC_PATH . '/includes/lib_order.php');
include_once(EC_PATH . '/includes/lib_clips.php');

$order_id = _POST('order_id', 0);

if (!$order_id) {
	GZ_Api::outPut(101);
}

$user_id = $_SESSION['user_id'];

/* 订单详情 */
$order = get_order_detail($order_id, $user_id);

if ($order === false)
{
	GZ_Api::outPut(8);
}

//支付方式信息
$payment_info = array();
$payment_info = payment_info($order['pay_id']);

if ($payment_info['pay_code'] == 'upmp')
{
	if (file_exists(GZ_PATH . "/Library/pay/upmp")) {
		require_once(GZ_PATH . "/Library/pay/upmp/upmp_config.php");
		require_once(GZ_PATH . "/Library/pay/upmp/lib/upmp_service.php");
		require_once(GZ_PATH . '/Library/log.func.php');
		
		$payment  = get_payment($payment_info['pay_code']);
		$upmp_account = $payment['upmp_account'];
		define('UPMP_SECURITY_KEY', $payment['upmp_security_key']);
		
		// 订单列表
		$order_goods_list = order_goods($order_id);
		if (!empty($order_goods_list)) {
			$desc = '购买';
			$desc .= '【' . $order_goods_list[0]['goods_name'] . '】';
			$desc .= '等' . count($order_goods_list) . '种商品';
		}
		
		$order['order_desc'] = $desc;
		
		//需要填入的部分
		$req['version']     		= upmp_config::$version; // 版本号
		$req['charset']     		= upmp_config::$charset; // 字符编码
		$req['transType']   		= "01"; // 交易类型
		$req['merId']       		= $upmp_account; // 商户代码
		$req['backEndUrl']      	= notify_url(); // 通知URL
		$req['frontEndUrl']     	= $GLOBALS['ecs']->url() . 'respond.php?code=' . $payment_info['pay_code']; // 前台通知URL(可选)
		$req['orderDescription']	= $order['order_desc'];// 订单描述(可选)
		$req['orderTime']   		= date("YmdHis"); // 交易开始日期时间yyyyMMddHHmmss
		$req['orderTimeout']   		= ""; // 订单超时时间yyyyMMddHHmmss(可选)
		$req['orderNumber'] 		= $order['order_sn']; //订单号(商户根据自己需要生成订单号)
		$req['orderAmount'] 		= $order['order_amount'] * 100; // 订单金额
		$req['orderCurrency'] 		= "156"; // 交易币种(可选)
		
		// 保留域填充方法
		$reqReserved['orderSnLog'] 	= $order['order_sn'] . $order['log_id'];
		$req['reqReserved'] 		= UpmpService::buildReserved($reqReserved); // 请求方保留域(可选，用于透传商户信息)
		
		$merReserved['test']   		= "test";
		$req['merReserved']   		= UpmpService::buildReserved($merReserved); // 商户保留域(可选)
		
		// 获取银联支付的TN
		$resp = array ();
		$validResp = UpmpService::trade($req, $resp);
		
		// 商户的业务逻辑
		if ($validResp){
			// 服务器应答签名验证成功
			// print_r($resp);
			rc_log("upmp trade success", $resp);
		
			if ($resp['respCode'] == '00') {
				$order['pay_upmp_tn'] = $resp['tn'];
			}
			else {
				$order['pay_error'] = $resp[respMsg];
			}
		}
		else
		{
			// 服务器应答签名验证失败
			// print_r($resp);
		
			rc_log("upmp trade fail", $resp);
		}
	}
}

GZ_Api::outPut(array('data' => $order));

/**
 * 取得返回信息地址
 * @param   string  $code   支付方式代码
 */
function notify_url($code)
{
	return $GLOBALS['ecs']->url() . 'notify/upmp.php';
}

?>
