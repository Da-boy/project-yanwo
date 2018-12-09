<?php
/**
 * Created by PhpStorm.
 * User: DemonHunter
 * Date: 2017/6/20
 * Time: 15:31
 */
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');



        $sql = "select * from ".$GLOBALS['ecs']->table('lucky');
        $arr=$db->getAll($sql);

//var_dump($arr);
$smarty->assign('arr',$arr);
$smarty->display('luck.html');
