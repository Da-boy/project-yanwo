﻿<?php

/**
 * ECTouch Open Source Project
 * ============================================================================
 * Copyright (c) 2012-2014 http://ectouch.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：wxpay.php
 * ----------------------------------------------------------------------------
 * 功能描述：微信支付插件
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */

/* 访问控制 */
if (! defined('IN_ECTOUCH')) {
    die('Deny Access');
}

$payment_lang = ROOT_PATH . 'plugins/payment/language/' . C('lang') . '/' . basename(__FILE__);

if (file_exists($payment_lang)) {
    include_once ($payment_lang);
    L($_LANG);
}

/* 模块的基本信息 */
if (isset($set_modules) && $set_modules == TRUE) {
    $i = isset($modules) ? count($modules) : 0;
    /* 代码 */
    $modules[$i]['code'] = basename(__FILE__, '.php');
    /* 描述对应的语言项 */
    $modules[$i]['desc'] = 'wxpay_desc';
    /* 是否支持货到付款 */
    $modules[$i]['is_cod'] = '0';
    /* 是否支持在线支付 */
    $modules[$i]['is_online'] = '1';
    /* 作者 */
    $modules[$i]['author'] = 'ECTOUCH TEAM';
    /* 网址 */
    $modules[$i]['website'] = 'http://mp.weixin.qq.com/';
    /* 版本号 */
    $modules[$i]['version'] = '2.5';
    /* 配置信息 */
    $modules[$i]['config'] = array(
        // 微信公众号身份的唯一标识
        array(
            'name' => 'wxpay_appid',
            'type' => 'text',
            'value' => ''
        ),
        // JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
        array(
            'name' => 'wxpay_appsecret',
            'type' => 'text',
            'value' => ''
        ),
        // 商户支付密钥Key
        array(
            'name' => 'wxpay_key',
            'type' => 'text',
            'value' => ''
        ),
        // 受理商ID
        array(
            'name' => 'wxpay_mchid',
            'type' => 'text',
            'value' => ''
        )
    );
    
    return;
}

/**
 * 微信支付类
 */
class wxpay
{

    var $parameters; // cft 参数
    var $payment; // 配置信息
    /**
     * 生成支付代码
     *
     * @param array $order
     *            订单信息
     * @param array $payment
     *            支付方式信息
     */
    function get_code($order, $payment)
    {
        // 配置参数
        $this->payment = $payment;
        // 网页授权获取用户openid
        if (! isset($_SESSION['openid']) || empty($_SESSION['openid'])) {
            return false;
        }
        
        // 设置必填参数
        // 根目录url
        $root_url = str_replace('mobile', '', __URL__);
        
        $this->setParameter("openid", "$_SESSION[openid]"); // 商品描述
        $this->setParameter("body", $order['order_sn']); // 商品描述
        $this->setParameter("out_trade_no", $order['order_sn'] . 'O' . $order['log_id']); // 商户订单号
        $this->setParameter("total_fee", $order['order_amount'] * 100); // 总金额
        $this->setParameter("notify_url", $root_url . 'notify_wap_wxpay.php'); // 通知地址
        $this->setParameter("trade_type", "JSAPI"); // 交易类型
        $prepay_id = $this->getPrepayId();
        $jsApiParameters = $this->getParameters($prepay_id);
        // wxjsbridge
        $js = '<script language="javascript">
        function jsApiCall(){WeixinJSBridge.invoke("getBrandWCPayRequest",' . $jsApiParameters . ',function(res){if(res.err_msg == "get_brand_wcpay_request:ok"){location.href="' . return_url(basename(__FILE__, '.php'), array(
            'type' => 0,
            'status' => 1
        )) . '"}else{location.href="' . return_url(basename(__FILE__, '.php'), array(
            'type' => 0,
            'status' => 0
        )) . '"}});}function callpay(){if (typeof WeixinJSBridge == "undefined"){if( document.addEventListener ){document.addEventListener("WeixinJSBridgeReady", jsApiCall, false);}else if (document.attachEvent){document.attachEvent("WeixinJSBridgeReady", jsApiCall);document.attachEvent("onWeixinJSBridgeReady", jsApiCall);}}else{jsApiCall();}}
            </script>';
        
//         $button = '<div style="text-align:center"><button class="btn btn-primary" type="button" onclick="callpay()">微信安全支付</button></div>' . $js;
        
        $button = '<div class="wxpay-btn"><div class="wxpay-anniu"></div>
<button class="btn btn-primary sell-bottom-img" type="button" onclick="callpay()"></button></div>' . $js;
        
        return $button;
    }

    /**
     * 响应操作
     */
    function callback($data)
    {
        if ($data['status'] == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 响应操作
     */
    function notify($data)
    {
        if (! empty($data['postStr'])) {
            $payment = model('Payment')->get_payment($data['code']);
            $postdata = json_decode(json_encode(simplexml_load_string($data['postStr'], 'SimpleXMLElement', LIBXML_NOCDATA)), true);
            /* 检查插件文件是否存在，如果存在则验证支付是否成功，否则则返回失败信息 */
            // 微信端签名
            $wxsign = $postdata['sign'];
            unset($postdata['sign']);
            
            foreach ($postdata as $k => $v) {
                $Parameters[$k] = $v;
            }
            // 签名步骤一：按字典序排序参数
            ksort($Parameters);
            
            $buff = "";
            foreach ($Parameters as $k => $v) {
                $buff .= $k . "=" . $v . "&";
            }
            $String;
            if (strlen($buff) > 0) {
                $String = substr($buff, 0, strlen($buff) - 1);
            }
            // 签名步骤二：在string后加入KEY
            $String = $String . "&key=" . $payment['wxpay_key'];
            // 签名步骤三：MD5加密
            $String = md5($String);
            // 签名步骤四：所有字符转为大写
            $sign = strtoupper($String);
            // 验证成功
            if ($wxsign == $sign) {
                // 交易成功
                if ($postdata['result_code'] == 'SUCCESS') {
                    // 获取log_id
                    $out_trade_no = explode('O', $postdata['out_trade_no']);
                    $order_sn = $out_trade_no[1]; // 订单号log_id
                    //$order_sn = substr($out_trade_no[0],0,13); // 订单号wang20160506修改
                                                  // 改变订单状态
//                     if ($data['status'] == 1){
//                         $order_sn = $data['order_sn']; // 订单号log_id
//                         // 改变订单状态
//                     }                              
                    if(substr($order_sn,0,4)=="CZDD"){
                        //如果是用户中心充值订单则进行充值并赠送159燕窝券
                        $amount=1000;
                        $sql = "INSERT INTO " .$ecs->table('user_account').
                        " VALUES ('', '$_SESSION ['user_id']', 'system', '$amount', '".gmtime()."', '".gmtime()."', '自助充值，单号：'.$order_sn.', '', '0', '微信支付', '1')";
                        $db->query($sql);
                        $id = $db->insert_id();                        
                        // 更新会员余额数量
                        if($id>0){
                        $change_desc = $amount > 0 ? $_LANG['surplus_type_0'] : $_LANG['surplus_type_1'];
                        $change_type = $amount > 0 ? ACT_SAVING : ACT_DRAWING;
                        log_account_change($_SESSION ['user_id'], $amount, 0, 0, 0, $change_desc, $change_type);
                        }
                        //赠送159燕窝券
                        $data['bonus_type_id'] =6;//测试红包，需要手动更改
                        $data['bonus_sn'] = 0;
                        $data['user_id'] = $_SESSION['user_id'];
                        $data['used_time'] = 0;
                        $data['order_id'] = 0;
                        $data['emailed'] = 0;
                        $data['use_start_date'] = local_gettime();
                        $data['use_end_date'] = local_strtotime('+1 week');
                        //var_dump($data);
                        model('Base')->model->table('user_bonus')->data($data)->insert();
                        
                    }else {
                        model('Payment')->order_paid($order_sn, 2);
                        
                        // 修改订单信息(openid，tranid)
                        model('Base')->model->table('pay_log')
                            ->data('openid = "' . $postdata['openid'] . '", transid = "' . $postdata['transaction_id'] . '"')
                            ->where('log_id = ' . $order_sn)
                            ->update();
    
                        if ($_SESSION ['user_id'] > 0) {
                            /* 取得用户信息 */
                            $user = model('Order')->user_info($_SESSION ['user_id']);
                            //取得订单信息
                            $order_info = model('Base')->model->table('order_info')
                                ->where('order_sn = "' . $order_sn . '"')
                                ->select();
                            if(!empty($order_info)){
                                $order = $order_info[0];
                                /* 计算并发放积分 */
                                $integral = model('Order')->integral_to_give($order);
                                if($integral) {
                                    model('ClipsBase')->log_account_change($_SESSION ['user_id'], 0, 0, 0, intval($integral), sprintf(L('order_gift_integral'), $order_sn));
                                }
                            }


                            //判断是否存在卡类商品，若存在，则存入表中（新加2017.4.12）
                            $now_order_id = model('Base')->model->table('order_info')
                                ->field('order_id')
                                ->where('order_sn = "' . $order_sn . '"')
                                ->getOne();

                            if(!empty($now_order_id)){//订单存在
                                //获取订单下的商品
                                $now_order_id = intval($now_order_id);
                                $row = model('Base')->model->table('order_goods')->where('order_id="'.$now_order_id.'"')->select();

                                if(!empty($row)){
                                    foreach($row as $key => $value){
                                        $goods_id = $value['goods_id'];
                                        //查询商品是否是卡类商品
                                        $numrow = model('Base')->model->table('goods')
                                            ->field('week_num,total_num')
                                            ->where('goods_id = "' . $goods_id . '"')
                                            ->select();

                                        if(!empty($numrow) && intval($numrow[0]['week_num'])>0){
                                            //添加到数据库
                                            $card_info['user_id'] = $_SESSION['user_id'];
                                            $card_info['order_id'] = $now_order_id;
                                            $card_info['goods_id'] = $goods_id;
                                            $card_info['goods_name'] = $value['goods_name'];
                                            $card_info['goods_number'] = $value['goods_number'];
                                            $card_info['week_num'] = $numrow[0]['week_num'];
                                            $card_info['total_num'] = intval($numrow[0]['total_num'])*intval($value['goods_number']);
                                            $card_info['remain_num'] = intval($numrow[0]['total_num'])*intval($value['goods_number']);
                                            $card_info['add_time'] = gmtime();
                                            model('Base')->model->table('order_goods_card')->data($card_info)->insert();

                                        }
                                    }
                                }

                            }
                        }
                    
                    /* 如果需要，微信通知 wanglu */
                    $order_id = model('Base')->model->table('order_info')
                        ->field('order_id')
                        ->where('order_sn = "' . $out_trade_no[0] . '"')
                        ->getOne();
                    $order_url = __HOST__ . url('user/order_detail', array(
                        'order_id' => $order_id
                    ));
                    $order_url = urlencode(base64_encode($order_url));
                    send_wechat_message('pay_remind', '', $out_trade_no[0] . ' 订单已支付', $order_url);
               }
             }
                $returndata['return_code'] = 'SUCCESS';
            } else {
                $returndata['return_code'] = 'FAIL';
                $returndata['return_msg'] = '签名失败';
            }
        } else {
            $returndata['return_code'] = 'FAIL';
            $returndata['return_msg'] = '无数据返回';
        }
        // 数组转化为xml
        $xml = "<xml>";
        foreach ($returndata as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
        $xml .= "</xml>";
        
        echo $xml;
        exit();
    }

    function trimString($value)
    {
        $ret = null;
        if (null != $value) {
            $ret = $value;
            if (strlen($ret) == 0) {
                $ret = null;
            }
        }
        return $ret;
    }

    /**
     * 作用：产生随机字符串，不长于32位
     */
    public function createNoncestr($length = 32)
    {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i ++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    /**
     * 作用：设置请求参数
     */
    function setParameter($parameter, $parameterValue)
    {
        $this->parameters[$this->trimString($parameter)] = $this->trimString($parameterValue);
    }

    /**
     * 作用：生成签名
     */
    public function getSign($Obj)
    {
        foreach ($Obj as $k => $v) {
            $Parameters[$k] = $v;
        }
        // 签名步骤一：按字典序排序参数
        ksort($Parameters);
        
        $buff = "";
        foreach ($Parameters as $k => $v) {
            $buff .= $k . "=" . $v . "&";
        }
        $String;
        if (strlen($buff) > 0) {
            $String = substr($buff, 0, strlen($buff) - 1);
        }
        // echo '【string1】'.$String.'</br>';
        // 签名步骤二：在string后加入KEY
        $String = $String . "&key=" . $this->payment['wxpay_key'];
        // echo "【string2】".$String."</br>";
        // 签名步骤三：MD5加密
        $String = md5($String);
        // echo "【string3】 ".$String."</br>";
        // 签名步骤四：所有字符转为大写
        $result_ = strtoupper($String);
        // echo "【result】 ".$result_."</br>";
        return $result_;
    }

    /**
     * 作用：以post方式提交xml到对应的接口url
     */
    public function postXmlCurl($xml, $url, $second = 30)
    {
        // 初始化curl
        $ch = curl_init();
        // 设置超时
        curl_setopt($ch, CURLOP_TIMEOUT, $second);
        // 这里设置代理，如果有的话
        // curl_setopt($ch,CURLOPT_PROXY, '8.8.8.8');
        // curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        // 设置header
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        // 要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        // post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
        // 运行curl
        $data = curl_exec($ch);
        curl_close($ch);
        // 返回结果
        if ($data) {
            curl_close($ch);
            return $data;
        } else {
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error" . "<br>";
            echo "<a href='http://curl.haxx.se/libcurl/c/libcurl-errors.html'>错误原因查询</a></br>";
            curl_close($ch);
            return false;
        }
    }

    /**
     * 获取prepay_id
     */
    function getPrepayId()
    {
        // 设置接口链接
        $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
        try {
            // 检测必填参数
            if ($this->parameters["out_trade_no"] == null) {
                throw new Exception("缺少统一支付接口必填参数out_trade_no！" . "<br>");
            } elseif ($this->parameters["body"] == null) {
                throw new Exception("缺少统一支付接口必填参数body！" . "<br>");
            } elseif ($this->parameters["total_fee"] == null) {
                throw new Exception("缺少统一支付接口必填参数total_fee！" . "<br>");
            } elseif ($this->parameters["notify_url"] == null) {
                throw new Exception("缺少统一支付接口必填参数notify_url！" . "<br>");
            } elseif ($this->parameters["trade_type"] == null) {
                throw new Exception("缺少统一支付接口必填参数trade_type！" . "<br>");
            } elseif ($this->parameters["trade_type"] == "JSAPI" && $this->parameters["openid"] == NULL) {
                throw new Exception("统一支付接口中，缺少必填参数openid！trade_type为JSAPI时，openid为必填参数！" . "<br>");
            }
            $this->parameters["appid"] = $this->payment['wxpay_appid']; // 公众账号ID
            $this->parameters["mch_id"] = $this->payment['wxpay_mchid']; // 商户号
            $this->parameters["spbill_create_ip"] = $_SERVER['REMOTE_ADDR']; // 终端ip
            $this->parameters["nonce_str"] = $this->createNoncestr(); // 随机字符串
            $this->parameters["sign"] = $this->getSign($this->parameters); // 签名
            $xml = "<xml>";
            foreach ($this->parameters as $key => $val) {
                if (is_numeric($val)) {
                    $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
                } else {
                    $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
                }
            }
            $xml .= "</xml>";
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
        // $response = $this->postXmlCurl($xml, $url, 30);
        $response = Http::curlPost($url, $xml, 30);
        $result = json_decode(json_encode(simplexml_load_string($response, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        $prepay_id = $result["prepay_id"];
        return $prepay_id;
    }

    /**
     * 作用：设置jsapi的参数
     */
    public function getParameters($prepay_id)
    {
        $jsApiObj["appId"] = $this->payment['wxpay_appid'];
        $timeStamp = time();
        $jsApiObj["timeStamp"] = "$timeStamp";
        $jsApiObj["nonceStr"] = $this->createNoncestr();
        $jsApiObj["package"] = "prepay_id=$prepay_id";
        $jsApiObj["signType"] = "MD5";
        $jsApiObj["paySign"] = $this->getSign($jsApiObj);
        $this->parameters = json_encode($jsApiObj);
        
        return $this->parameters;
    }
}