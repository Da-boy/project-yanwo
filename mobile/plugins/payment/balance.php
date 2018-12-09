<?php

/**
 * ECTouch Open Source Project
 * ============================================================================
 * Copyright (c) 2012-2014 http://ectouch.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：balance.php
 * ----------------------------------------------------------------------------
 * 功能描述：余额支付插件
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */

/* 访问控制 */
defined('IN_ECTOUCH') or die('Deny Access');

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
    $modules[$i]['desc'] = 'balance_desc';
    /* 是否货到付款 */
    $modules[$i]['is_cod'] = '0';
    /* 是否支持在线支付 */
    $modules[$i]['is_online'] = '1';
    /* 作者 */
    $modules[$i]['author'] = 'ECSHOP TEAM';
    /* 网址 */
    $modules[$i]['website'] = 'http://www.ecshop.com';
    /* 版本号 */
    $modules[$i]['version'] = '1.0.0';
    /* 配置信息 */
    $modules[$i]['config'] = array();
    return;
}

/**
 * 余额支付插件类
 */
class balance
{

    /**
     * 提交函数
     */
//    function get_code()
//    {
//        return '';
//    }

    /**
     * 处理函数
     */
//    function response()
//    {
//        return;
//    }

    /**
     * 提交函数
     */
    function get_code($order)
    {
        //获取订单id
        $order_sn = $order['order_sn'];

        /* 取得用户信息 */
        $user = model('Order')->user_info($order ['user_id']);

        /* 计算并发放积分 */
        $integral = model('Order')->integral_to_give($order);
        model('ClipsBase')->log_account_change($order ['user_id'], 0, 0, intval($integral ['rank_points']), intval($integral ['custom_points']), sprintf(L('order_gift_integral'), $order ['order_sn']));

        /* 发放红包 */
        //model('Order')->send_order_bonus($order ['order_id']);

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

       $server = $_SERVER['HTTP_HOST'];
        $url = 'index.php?m=default&c=respond&a=balance_pay';
        Header("Location: $url");
        // 配置参数
        // 网页授权获取用户openid
        /*if (! isset($_SESSION['openid']) || empty($_SESSION['openid'])) {
            return false;
        }
        $js = '<script language="javascript">
        function balance_pay(){
            setTimeout(function(){
              location.href="index.php?m=default&c=respond&a=balance_pay";
          },2000);
        }
            </script>';
        $button = '<div class="wxpay-btn"><div class="wxpay-anniu"></div>
<button class="btn btn-primary sell-bottom-img" type="button" onclick="callpay()"></button></div>' . $js;
        return $button;*/
//
//        $order_sn = $order['order_sn'];
//        $order_id = $order['order_id'];
//        //查询此订单是否在订单表和订单商品表存在
//        /*$sql = "select count(order_id) as num from " . $this->model->pre . "order_info where order_sn ='{$order_sn}'";
//        $sql1 = "select count(rec_id) as num from " . $this->model->pre . "order_goods where order_sn ='{$order_id}'";
//        $num = $this->model->query($sql);
//        $num1 = $this->model->query($sql1);*/
//       $row = model('Base')->model->table('order_info')
//            ->field('order_id')
//            ->where('order_sn = "' .$order_sn . '"')
//            ->select();
//
//        $row1 = model('Base')->model->table('order_goods')
//            ->field('rec_id')
//            ->where('order_id = "' .$order_id . '"')
//            ->select();
//        if(!empty($row) && !empty($row1)){
//
//            $result = true;
//        }else{
//
//            $result = false;
//        }
//
//        $this->response($result);
    }

    function callback($data)
    {

            return true;

    }

    /**
     * 处理函数
     */
    function response($result)
    {

        return;
    }
}

?>