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

class SongController extends CommonController {

    /**
     * 首页信息
     */
    public function index() {
       if($_SESSION['city']&&$_SESSION['city']!='')
           $city=false;
       else 
           $city=true;
                   
        $this->assign('city', $city);
               

         //公共底部状态值
                $menu_status=$this->getConName();
                $this->assign('menu_status',$menu_status);

                 $this->display('song.dwt');
    }
    
    /**
     * ajax获取城市
     */
    public function ajax_city() {
        $city=isset($_REQUEST['city'])?$_REQUEST['city']:'';        
        $_SESSION['city']=$city;
        model('users')->update_user_city($city);
    }
    
    /**
     * 送燕窝正式页
     */
    public function sell() {
        if($_SESSION['user_id']){
            $info = model('ClipsBase')->get_user_default($_SESSION ['user_id']);
            $this->assign('info', $info);            
        }
        
        $this->display('song_sell.dwt');
    }
    /**
     * 赠送信息
     */
    public function shake() {
        $this->display('song_shake.dwt');
    }
    public function add()
    {

        if ( $_POST['user_name']==false|| $_POST['user_mobile']==false|| $_POST['user_address']==false) {
            echo "输入信息不能为空";
            die();
        }
            $re = $this->model->table('lucky')->where("lucky_phone" . "=" . $_POST['user_mobile'])->count();
            if ($re) {

                echo "同一个手机号不能重复领取";
                die();
            } else {
                $lucky = array();
                $lucky['lucky_name'] = $_POST['user_name'];
                $lucky['lucky_phone'] = $_POST['user_mobile'];
                $lucky['lucky_address'] = $_POST['user_address'];
                $result = $this->model->table('lucky')
                    ->data($lucky)
                    ->insert();
                if ($result) {
                    echo "1";

                } else {
                    echo "您输入的信息有误,请重新输入";

                }
            }

        }

}
