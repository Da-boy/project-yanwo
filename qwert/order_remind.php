<?php

/**
 * WOIMAI 订单管理
 * ============================================================================
 * 版权所有 2005-2010 woimai.com，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: yehuaixiao $
 * $Id: order.php 17219 2011-01-27 10:49:19Z yehuaixiao $
 */

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require_once(ROOT_PATH . 'includes/lib_order.php');
require_once(ROOT_PATH . 'includes/lib_goods.php');

/*------------------------------------------------------ */
//-- 音乐修改页面
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'edit')
{
    //获取当前音乐
    $sql = "select file_name from ".$GLOBALS['ecs']->table('remind_music')." where m_id = 1";
    $rs = $GLOBALS['db']->getRow($sql);
    if(!empty($rs)){
        $smarty->assign('file_name', $rs['file_name']);
    }
    $smarty->display('order_remind.htm');
}

elseif ($_REQUEST['act'] == 'toedit')
{
    //print_r($_FILES);exit;
    if(is_uploaded_file($_FILES['music']['tmp_name'])) {
        $upfile = $_FILES["music"];
//获取数组里面的值
        $name = $upfile["name"];//上传文件的文件名
        $type = $upfile["type"];//上传文件的类型
        $size = $upfile["size"];//上传文件的大小
        $tmp_name = $upfile["tmp_name"];//上传文件的临时存放路径
//判断是否为音乐
        if($type !='audio/mp3'){
            $link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
            sys_msg('上传类型不符', 0, $link);
            die();
        }else{
            if ($_FILES["music"]["error"] > 0)
            {
                $link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
                sys_msg('上传错误，请重试！', 0, $link);
                die();
            }
            else
            {
                //先删除原文件
                //获取当前音乐
                $sql = "select music_name from ".$GLOBALS['ecs']->table('remind_music')." where m_id = 1";
                $rs = $GLOBALS['db']->getRow($sql);
                if(!empty($rs)){
                    $music_name = $rs['music_name'];
                    //删除文件
                    if(file_exists(ROOT_PATH."qwert/music/".$music_name)){
                        unlink(ROOT_PATH."qwert/music/".$music_name);
                    }
                }
                $dir = date('Ymd',time());
                $temp = explode(".", $_FILES["music"]["name"]);
                $music_name = date('YmdHis',time()).'.'.$temp[1];
                $end_dir = $dir.'/'.$music_name;
                if(!file_exists(ROOT_PATH."qwert/music/".$dir)){
                    mkdir(ROOT_PATH."qwert/music/".$dir);
                }

                move_uploaded_file($_FILES["music"]["tmp_name"], ROOT_PATH."qwert/music/".$end_dir);
                if(!file_exists(ROOT_PATH."qwert/music/".$end_dir)){
                    $link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
                    sys_msg('上传错误，请重试！', 0, $link);
                    die();
                }else{
                    //存入表中
                   $sql = "update " . $ecs->table('remind_music') . " set music_name = '$end_dir',file_name = '$name' WHERE m_id = 1";
                    $result = $db->query($sql);
                    if($result){
                        // 提示信息
                        $link[0]['text'] = $_LANG['go_back'];
                        $link[0]['href'] = 'order_remind.php?act=edit';
                        sys_msg('上传成功，跳转中。。。', 0, $link);
                    }
                }
            }

        }
    }
}elseif ($_REQUEST['act'] == 'download'){
    //获取当前音乐文件名
    $sql = "select music_name from ".$GLOBALS['ecs']->table('remind_music')." where m_id = 1";
    $rs = $GLOBALS['db']->getRow($sql);
    if(!empty($rs)){
        $music_name = $rs['music_name'];
        //删除文件
        if(file_exists(ROOT_PATH."qwert/music/".$music_name)){
            $file_xls=ROOT_PATH."qwert/music/".$music_name;
        }
    }
    $example_name=basename($file_xls);  //获取文件名
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.mb_convert_encoding($example_name,"gb2312","utf-8"));  //转换文件名的编码
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_xls));
    ob_clean();
    flush();
    readfile($file_xls);
}

?>