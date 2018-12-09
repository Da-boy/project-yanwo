<?php

/**
 * ECTouch Open Source Project
 * ============================================================================
 * Copyright (c) 2012-2014 http://ectouch.cn All rights reserved.
 * ----------------------------------------------------------------------------
 * 文件名称：IndexController.class.php
 * ----------------------------------------------------------------------------
 * 功能描述：ECTouch首页控制器
 * ----------------------------------------------------------------------------
 * Licensed ( http://www.ectouch.cn/docs/license.txt )
 * ----------------------------------------------------------------------------
 */

/* 访问控制 */
defined('IN_ECTOUCH') or die('Deny Access');

class FuliController extends CommonController {

    /**
     * 首页信息
     */
    public function index() {
        
        //获取微信js-sdk相关配置
        $wxinfo = $this->get_config('gh_5ff542fc305b');
        $config['token'] = $wxinfo['token'];
        $config['appid'] = $wxinfo['appid'];
        $config['appsecret'] = $wxinfo['appsecret'];
        $wechat=new Wechat($config);
        $signPackage=$wechat->getSignPackage();
        $this->assign('signPackage',$signPackage);

        //获取分享红包的用户id
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0){
            $this->assign('fuserid', $_SESSION['user_id']);
            //获取用户邀请人数，
            $inv_num=model('Users')->get_invitee_count($_SESSION['user_id']);
            //获取优惠券数量(因邀请用户所得)
            $bonus_num=model('Users')->get_invitee_bonus_count($_SESSION['user_id']);

            //获取优惠劵数量（所有）
            //$bonus_num=model('Users')->get_all_bonus_count($_SESSION['user_id']);
            $this->assign('inv_num', $inv_num);
            $this->assign("bonus_num",$bonus_num);
            //购物车数量
            $cart_now_number=insert_cart_info_number();
            $this->assign('cart_now_number',$cart_now_number);
            //获取内页大图
            $image = $this->model->table('touch_ad')
                ->field('ad_code')
                ->where('position_id = 6')
                ->getOne();
            if($image){
                $this->assign('image',$image);
            }
            $this->display('fuli.dwt');
        }else{
            $this->redirect(url('index.php?m=default&c=user&a=login', array(
                'referer' => urlencode(url($this->action))
            )));
        }
        

    }
    public function city100(){
        $this->display('city100.dwt');
    }
    public function car_no(){
        $this->display('cart-no.dwt');
    }
    public function content(){
        $this->display('content.dwt');
    }
    public function contact(){
        $this->display('contact.dwt');
    }
    public function water(){
        //公共底部状态值
        $menu_status=$this->getConName();
        $this->assign('menu_status',$menu_status);
        $this->display('water.dwt');
    }
    public function share(){
        // 获得新人专享商品
        $goods = model('Goods')->get_goods_info(153);  
        $this->assign('goods', $goods);
        //判读当前用户是否已购买专享产品
         if($_SESSION['user_id']){
             
        $user_id=$_SESSION['user_id'];
         $this->assign('user_id',$user_id);
        $good_id=153;
        $order = model('Order')->get_order_by_goods_user($user_id,$good_id);
        //已购买  返回false  未购买返回 true
        if(!empty($order)){
         $is_new=false;   
        }else{
         $is_new=true;   
        }
        }else{
           $is_new=true;   
        }
        
        $this->assign('is_new', $is_new);
        //购物车数量
      $cart_now_number=insert_cart_info_number();
      $this->assign('cart_now_number',$cart_now_number);
      if($_SESSION['user_id']){
          $res = model('Users')->get_new_user_vouchers($user_id);
          if(!empty($res)){
              $this->assign('is_receive',1);
          }else{
              $this->assign('is_receive',0);
          }
      }else{
          $this->assign('is_receive',0);
      }
      $this->display('fuli-share.dwt');
    }

//    /*
//     * 领取新人优惠券操作
//     */
//    public function receive_new_user_vouchers(){
//        $user_id = $_POST['user_id'];
//        // 初始化返回数组
//        $result = array(
//            'error' => 0,
//            'message' => '',
//        );
//        $res = model('Users')->add_user_bonus($user_id);
//        //查询当前用户是否领了优惠券
//        $row = model('user_bonus')->where('bonus_type_id=1 AND user_id ='.$user_id);
//        if(!empty($row)){
//            $result['error']=0;
//            $result['message']='优惠劵领取成功！';
//        }
//        die(json_encode($result));
//    }

    /*
 * 领取新人优惠券操作
 */
    public function receive_new_user_vouchers(){
         // 初始化返回数组
        $result = array(
            'error' => false,
            'message' => '',
        );
        $user_id = $_POST['user_id'];
        if(empty($user_id)){
            $result['error']=false;
            $result['message']='参数错误！';
            die(json_encode($result));
        }

        //是否已领取过
        $row = model('Users')->get_new_user_vouchers($user_id);
        if(!empty($row)){
            $result['error']=false;
            $result['message']='优惠券已领取，不能重复领取！';
            die(json_encode($result));
        }else{
            $res = model('Users')->new_add_user_bonus($user_id);
            if(!$res){
                $result['error']=true;
                $result['message']='优惠劵领取成功！';
                die(json_encode($result));
            }else{
                $result['error']=false;
                $result['message']='优惠劵领取失败，请稍候重试！';
                die(json_encode($result));
            }
        }

       
    }

    /*
* 获取优惠劵列表
*/
    /*public function vouchers_list(){
        $user_id=$_SESSION['user_id'];
        $row = model('Users')->user_vouchers_list($user_id);
        $this->assign('vouchers_list',$row);
        $this->display('fuli-share.dwt');
    }*/
    /*
     * 收益统计
     */
    public function income(){
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0){
            //获取分享所获得的红包
            $sql = 'SELECT count(bonus_id) as count FROM '. $this->model->pre .'user_bonus where bonus_type_id=2 AND invitee_id <>0 and user_id ='.$_SESSION['user_id'];
            $row = $this->model->query($sql);
            //var_dump(intval($row[0]['count']));exit;
            if(intval($row[0]['count'])>=0){
                $this->assign('bonus_num',intval($row[0]['count']));
                //计算总额
                //获取此类红包每一个抵现金额
                $sql1 = 'select type_money from '. $this->model->pre .'bonus_type where type_id = 2';
                $row1 = $this->model->query($sql1);
                $price = $row1[0]['type_money'];
                $all_money = intval($row[0]['count'])*$price;
                $this->assign('all_money',$all_money);
            }
            $this->display('fuli-income.dwt');
        }else{
            $this->redirect(url('index.php?m=default&c=user&a=login', array(
                'referer' => urlencode(url($this->action))
            )));
        }


    }
    public function show() {
        $this->display('fuli_show.dwt');
    }
    public function rule() {
        $this->display('fuli_rule.dwt');
    }
    /**
     * 获取公众号配置
     *
     * @param string $orgid
     * @return array
     */
    private function get_config($orgid)
    {
        $config = $this->model->table('wechat')
        ->field('id, token, appid, appsecret')
        ->where('orgid = "' . $orgid . '" and status = 1')
        ->find();
        if (empty($config)) {
            $config = array();
        }
        return $config;
    }
    

}
