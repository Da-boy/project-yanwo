<?php

/**
 * ECTouch Open Source Project
 * ============================================================================
 * Copyright (c) 2012-2014 http://ectouch.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：FlowControoller.class.php
 * ----------------------------------------------------------------------------
 * 功能描述：购物流程控制器
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */

/* 访问控制 */
defined('IN_ECTOUCH') or die('Deny Access');

class RechargeController extends CommonController {
    public function index(){
        if (empty($_SESSION['user_id'])) {
            $url = __HOST__ . $_SERVER['REQUEST_URI'];
            $this->redirect(url('login', array(
                'referer' => urlencode($url)
            )));
            exit();
        }
        
        $order['order_sn']="CZDD".date('Ymd'). mt_rand(10000, 99999);
        $order['iscz']=0;
        $order ['pay_name'] = "微信支付";
        $order['order_amount']=1000;
        $order['pay_id']=4;
        $total['amount_formated']=1000;
        if ($order ['order_amount'] > 0) {
            $payment = model('Order')->payment_info($order['pay_id']);
        
            include_once (ROOT_PATH . 'plugins/payment/' . $payment ['pay_code'] . '.php');
        
            $pay_obj = new $payment ['pay_code'] ();
        
        
        
            $pay_online = $pay_obj->get_code($order, unserialize_config($payment ['pay_config']));
        
        
            $this->assign('pay_online', $pay_online);
        }
        
        
       
        $this->display('chongzhi.dwt');
    }
    public function recharge(){
        $order['order_sn']="CZDD".date('Ymd'). mt_rand(10000, 99999);
        $order['iscz']=0;
        $order ['pay_name'] = "微信支付";
        $order['order_amount']=$_POST['number'];
        $order['pay_id']=4;
        $total['amount_formated']=$_POST['number'];
        if ($order ['order_amount'] > 0) {
            $payment = model('Order')->payment_info($order['pay_id']);

            include_once (ROOT_PATH . 'plugins/payment/' . $payment ['pay_code'] . '.php');

            $pay_obj = new $payment ['pay_code'] ();



            $pay_online = $pay_obj->get_code($order, unserialize_config($payment ['pay_config']));



            $order ['pay_desc'] = $payment ['pay_desc'];


            /*  $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
             if( preg_match('/micromessenger/', $ua)){
                 if(!isset($_SESSION["openid"])||empty($_SESSION["openid"])){//openid为空
                     include_once (ROOT_PATH . 'plugins/payment/wxpay.php');
                     $payObj = new wxpay();
                     if(isset($_GET['state']) && $_GET['state']=="getOpenid"){
                         $code=$_GET["code"];
                         //$pay_online = $pay_obj->get_code($order, unserialize_config($payment ['pay_config']));
                         //todo
                         $payObj->getOpenidByCode($code);
                     }else{
                         $p["state"]="getOpenid";
                         $p["redirect_uri"]=__URL__;
                         $payObj->redirtUrlForOpenid($p);
                     }
                 }
             } */
            $this->assign('pay_online', $pay_online);
        }
        $order['order_amount']=$_POST['number']."元";
        $result="你在99°燕窝充值的".$_POST['number']."元已经受理，请支付。";
        $this->assign('step',"done");
        $this->assign('total',$total);
        $this->assign('message',$result);
        $this->assign('order', $order);
        $this->display('flow.dwt');
    }
}