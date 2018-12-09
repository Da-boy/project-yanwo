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

class SellController extends CommonController {
    private $weObj = '';
    
    

    /**
     * 首页信息
     *
     */
    public function __construct()
    {
        parent::__construct();
        //获取微信js-sdk相关配置
        $wxinfo = $this->get_config('gh_5ff542fc305b');
        $config['token'] = $wxinfo['token'];
        $config['appid'] = $wxinfo['appid'];
        $config['appsecret'] = $wxinfo['appsecret'];
        $this->weObj=new Wechat($config);
        
        
    }
    public function index() {
        // 获得每日促销的商品的信息 每日抢鲜价59.9 每日99份
        $goods = model('Goods')->get_goods_info(145);   
        //获取各商品虚假销售量
        $sale_arr=$this->get_goods_sale_number();
        //获取商品规格信息
        $goods_other=$this->get_goods_other();
        $goods['other']=$goods_other[$goods['goods_id']];
        $goods['sale_number']=$sale_arr[$goods['goods_id']];
        $this->assign("qg",$goods);
        //获取精品商品列表
            $hot_goods = model('Index')->new_goods_list("best");
            
            //获取购物车列表信息
            $cart_goods = model('Order')->get_cart_goods();
            //获取加入购物车的商品数量
            $cartData=array();
            if(!empty($cart_goods['goods_list'])){
                foreach($cart_goods['goods_list'] as $value){
                    $temp['id']=$value['goods_id'];
                    $temp['number']=$value['goods_number'];
                    $cartData[]=$temp;
                } 
            }
            
            //购物车数据和商品数据合并处理
            $goods_list=array();
            foreach($hot_goods as $value){
                $value['other']=$goods_other[$value['id']];
                $value['sale_number']=$sale_arr[$value['id']];
                $value['is_cart']=0;
                $value['cart_number']=0;
                if(!empty($cartData)){
                    foreach($cartData as $val){
                        if($val['id']==$value['id']){
                            $value['is_cart']=1;
                            $value['cart_number']=$val['number'];
                        }
                    }
                }
               
              $goods_list[]=$value;
            }
           $this->assign("goods_list",$goods_list);
            //微信相关
        $signPackage=$this->weObj->getSignPackage();
        $this->assign('signPackage',$signPackage);
        //获取用户默认收货地址
        if($_SESSION['user_id']){
            // 获取收货人信息
            $consignee = model('Order')->get_consignee($_SESSION ['user_id']);
            $this->assign('consignee', $consignee);
            //获取是否关注
            $where['ect_uid'] = $_SESSION ['user_id'];
            $where['subscribe'] = 1;
            $rs = $this->model->table('wechat_user')
            ->where($where)
            ->count();
            if ($rs == 0) {
                $this->assign('guanzhu', 1);
            }             
        }else{
            $this->assign('guanzhu', 1);
        }
        if(isset($_GET["guanzhu"])){
        $this->assign('guanzhu', 1);
        }
        //处理邀请人信息
        if(isset($_GET["fuserid"])){
            //邀请人入库处理
            $fuserid=$_GET["fuserid"];
           $re= model('Users')->set_inviter_id($_SESSION ['user_id'],$fuserid);
           //判断是否提示
           $inviter_id=model('Users')->get_inviter_id($_SESSION ['user_id']);
           if($inviter_id==$fuserid &&$fuserid!=$_SESSION ['user_id']){
            $this->assign('isdisplay', 1);
            $this->assign('fuserid',$_GET["fuserid"]);
            $info = model('ClipsBase')->get_user_default($_SESSION ['user_id']);  
            $this->assign('info', $info);   
           }else{
             $this->assign('isdisplay', 0);   
           }
            //$this->assign('guanzhu', 0);
        } 
        $city=isset($_SESSION['city'])?$_SESSION['city']:'天津';
        $this->assign('city',$city);
        //购物车数量
      $cart_now_number=insert_cart_info_number();
      $this->assign('cart_now_number',$cart_now_number);
      //公共底部状态值
      $menu_status=$this->getConName();
      $this->assign('menu_status',$menu_status);
     // var_dump($menu_status);
     // exit();
        //获取标签图片
        $ad_row = $this->model->table('touch_ad')

            ->where('position_id = 3')
            ->order('ad_id asc')
            ->select();
        if(!empty($ad_row)){
            $this->assign('ad_row',$ad_row);
        }
        //获取小banner图
        $small_banner = $this->model->table('touch_ad')
            ->field('ad_code')
            ->where('position_id = 4')
            ->getOne();
        if($small_banner){
            $this->assign('small_banner',$small_banner);
        }
        $this->display('sell.dwt');
    }
    
    public function youhui(){
        //发红包，领取优惠券
        if($_SESSION['user_id']&& $_SESSION['user_id'] > 0){
            if($_SESSION['user_id']==$_GET["fuserid"]){
                //$this->alert('亲，红包不能自己发给自己的！',url('sell/index'),false);
                $this->assign('hbts', '亲，红包不能自己发给自己的！');
                $this->assign('ishbts', 1);
                $this->assign('isdisplay', 1);
                ecs_header("refresh:2;url=" . url('sell/index') . "\n");
            }else{
                    $num = model('Base')->model->table('user_bonus')->where('user_id = "'.$_SESSION['user_id'].'"')->count();
                        if($num <= 0 ){
                            $data['bonus_type_id'] = 5;//测试红包，20160824修改成新人礼包
                            $data['bonus_sn'] = 0;
                            $data['user_id'] = $_SESSION['user_id'];
                            $data['used_time'] = 0;
                            $data['order_id'] = 0;
                            $data['emailed'] = 0;
                            $data['fuserid'] =$_GET["fuserid"];
                            $data['use_start_date'] = local_gettime();
                            $data['use_end_date'] = local_strtotime('+1 week');
                            model('Base')->model->table('user_bonus')->data($data)->insert();
                            
                            $data['bonus_type_id'] = 5;//测试红包，20160824修改成新人礼包
                            $data['bonus_sn'] = 0;
                            $data['user_id'] = $_SESSION['user_id'];
                            $data['used_time'] = 0;
                            $data['order_id'] = 0;
                            $data['emailed'] = 0;
                            $data['fuserid'] =$_GET["fuserid"];
                            $data['use_start_date'] = local_gettime();
                            $data['use_end_date'] = local_strtotime('+1 week');
                            model('Base')->model->table('user_bonus')->data($data)->insert();
                            
                            $data['bonus_type_id'] = 7;//测试红包，20160824修改成新人礼包
                            $data['bonus_sn'] = 0;
                            $data['user_id'] = $_SESSION['user_id'];
                            $data['used_time'] = 0;
                            $data['order_id'] = 0;
                            $data['emailed'] = 0;
                            $data['fuserid'] =$_GET["fuserid"];
                            $data['use_start_date'] = local_strtotime('+1 week');
                            $data['use_end_date'] = local_strtotime('+2 week');
                            model('Base')->model->table('user_bonus')->data($data)->insert();
                            
                            $data['bonus_type_id'] = 7;//测试红包，20160824修改成新人礼包
                            $data['bonus_sn'] = 0;
                            $data['user_id'] = $_SESSION['user_id'];
                            $data['used_time'] = 0;
                            $data['order_id'] = 0;
                            $data['emailed'] = 0;
                            $data['fuserid'] =$_GET["fuserid"];
                            $data['use_start_date'] = local_strtotime('+1 week');
                            $data['use_end_date'] = local_strtotime('+2 week');
                            model('Base')->model->table('user_bonus')->data($data)->insert();
                            
                            
                           //$this->alert('￥60红包已飞入您的账户中！请不要忘记在购物中使用！',url('sell/index').'&guanzhu=1',false);
                           //ecs_header("Location: " . url('user/login') . "\n");
                           $this->assign('hbts', '￥100新人礼包已飞入您的账户中！请不要忘记在购物中使用！');
                           $this->assign('ishbts', 1);
                           $this->assign('isdisplay', 1);
                           //$this->assign('furl',url('sell/index').'&guanzhu=1');
                           ecs_header("refresh:2;url=" . url('sell/index') . "&guanzhu=1\n");
                        }else {
                            $this->assign('hbts', '感谢您的支持，新人礼包只有新用户可以领取！');
                            $this->assign('ishbts', 1);
                            $this->assign('isdisplay', 1);
                            //$this->assign('furl',url('sell/index').'&guanzhu=1');
                            ecs_header("refresh:2;url=" . url('sell/index') . "&guanzhu=1\n");
                            
                        }
//                         else{
//                             $num=model('Base')->model->table('user_bonus')->where('user_id = "'.$_SESSION['user_id'].'" and fuserid="'.$_GET["fuserid"].'"')->count();
//                             if($num<=0){
//                             $data['bonus_type_id'] = 4;//测试红包，需要手动更改
//                             $data['bonus_sn'] = 0;
//                             $data['user_id'] = $_SESSION['user_id'];
//                             $data['used_time'] = 0;
//                             $data['order_id'] = 0;
//                             $data['emailed'] = 0;
//                             $data['fuserid'] =$_GET["fuserid"];
//                             $data['use_start_date'] = local_gettime();
//                             $data['use_end_date'] = local_strtotime('+1 week');
//                             //var_dump($data);
//                             model('Base')->model->table('user_bonus')->data($data)->insert();
//                             //$this->alert('￥50红包已飞入您的账户中！请不要忘记在购物中使用！',url('sell/index'),false);
//                             $this->assign('hbts', '￥20红包优惠券已飞入您的账户中！请不要忘记在购物中使用！');
//                             $this->assign('ishbts', 1);
//                             $this->assign('isdisplay', 1);
//                             ecs_header("refresh:2;url=" . url('sell/index') . "\n");
                          
//                             }else {
//                                 //$this->alert('您已经领取我发的红包！',url('sell/index'),false);
//                                 $this->assign('hbts', '您已经领取我发的红包！');
//                                 $this->assign('ishbts', 1);                               
//                                 $this->assign('isdisplay', 1);
//                                 ecs_header("refresh:2;url=" . url('sell/index') . "\n");
                                
//                             }
                            
//                         }  
                    }                    
                    $this->assign('guanzhu', 0);
                    $this->display('sell.dwt');
        }else {
            //ecs_header("Location: " . url('user/login') . "\n");
            $url = __HOST__ . $_SERVER['REQUEST_URI'];
            $this->redirect(url('user/login', array(
                'referer' => urlencode($url)
            )));
            exit();
        }
       
        
    }
    /*
     * 用于邀请有礼赠送优惠券功能
     */
     public function youhui_new(){
         // 初始化返回数组
        $result = array(
            'error' => false,
            'message' => '',
        );
        //发红包，领取优惠券
        if($_SESSION['user_id']&& $_SESSION['user_id'] > 0){
            if($_SESSION['user_id']==$_POST["fuserid"]){
                //$this->alert('亲，红包不能自己发给自己的！',url('sell/index'),false);
                $result = array(
                    'error' => false,
                    'message' => '亲，红包不能自己发给自己的！',
            );
             die(json_encode($result));   
            }else{
                //判断是否已经领取过
                $num = model('Base')->model->table('user_bonus')->where('user_id = "'.$_SESSION['user_id'].'" AND bonus_type_id=2')->count();
                if($num<=0){
                    model("Users")->add_invitee_bonus($_SESSION['user_id']);
                      $result = array(
                    'error' => true,
                    'message' => '￥80邀请礼包已飞入您的账户中！请不要忘记在购物中使用！',
            );
             die(json_encode($result));   
                }else{
                     $result = array(
                    'error' => false,
                    'message' => '感谢您的支持，￥80邀请礼包已领取过，不可重复领取！',
            );
             die(json_encode($result));   
                }    
                    }                    
        }else {
            //ecs_header("Location: " . url('user/login') . "\n");
            $url = __HOST__ . $_SERVER['REQUEST_URI'];
            $this->redirect(url('user/login', array(
                'referer' => urlencode($url)
            )));
            exit();
        }
       
        
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
    
    public function content() {
        $this->display('content.dwt');
    }
	
  public function get_goods_sale_number(){
      $arr=array(
          145=>10128,
          146=>8928,
          147=>6569,
          148=>3217,
          149=>2458,
          150=>1280,
          151=>5678,
          152=>4326,
          154=>2658,
          155=>3255,
          156=>20
      );
      $starttime=strtotime("2017-03-12 00:00:00");
      $nowtime=time(); 
      $time_length=  floor(($nowtime-$starttime)/(3600*6));
      $redata=array();
      foreach ($arr as $key=>$value){
          $value=$value+$time_length+model('GoodsBase')->get_sales_count($key);
          $redata[$key]=$value;
      }    
      return $redata;
  }
  public function get_goods_other(){
      $arr=array(
          145=>"100ml",
          146=>'100ml',
          147=>'200ml',
          148=>'8*100ml',
          149=>'24*100ml',
          150=>'24*4*100ml',
          151=>'100ml',
          152=>'300ml',
          153=>'100ml'
      );
      return $arr;
  }
}
