<?php
/**
 *  log.func.php 日志函数库
 *
 * @copyright			(C) 2010-2013 ROYALCMS
 * @license				http://www.royalcms.cn/license/
 * @lastmodify			2013-08-30
 */

function rc_debug($promot = null, $info = "", $writer = 'file') {
	$debug_on = true;
	
	if ($debug_on) {
		rc_log($promot, $info, $writer, "rc_debug");		
	}
}

function rc_error($promot = null, $info = "", $writer = 'file') {
	rc_log($promot, $info, $writer,"rc_error");
}

function rc_log($promot = null, $info = "", $writer = 'file',$logfile="rc_log") {
	$log_on = true;
	
	$output = date("Y-m-d H:i:s");
	if ($log_on) {
		
		if (! is_null ( $promot )) {
			$output = $output . " :: " . $promot;
		}
		
		if (is_array ( $info ) || is_object ( $info )) {
			$output = $output  . " : " .  var_dump_ret( $info, true );
		} else {
			$output = $output  . " : " .  $info;
		}
		$output = $output . "\n";
		
		if ($writer == 'file') {
			writelog($logfile,$output);
		} else {
			print_r ( $output );
		}
	}

}

function writelog($file, $log) {
	$yearmonth = date('Ym');
	$logdir = GZ_PATH.'/logs/';
	$logfile = $logdir.$yearmonth.'_'.$file.'.log';
	if(@filesize($logfile) > 2048000) {
		$dir = opendir($logdir);
		$length = strlen($file);
		$maxid = $id = 0;
		while($entry = readdir($dir)) {
			if(strexists($entry, $yearmonth.'_'.$file)) {
				$id = intval(substr($entry, $length + 8, -4));
				$id > $maxid && $maxid = $id;
			}
		}
		closedir($dir);

		$logfilebak = $logdir.$yearmonth.'_'.$file.'_'.($maxid + 1).'.log';
		@rename($logfile, $logfilebak);
	}
	if($fp = @fopen($logfile, 'a')) {
		@flock($fp, 2);
		$log = is_array($log) ? $log : array($log);
		foreach($log as $tmp) {
			fwrite($fp,$tmp);
		}
		fclose($fp);
	}
}

function var_dump_ret($mixed = null) {
 	ob_start();
 	var_dump($mixed);
 	$content = ob_get_contents();
 	ob_end_clean();
 	return $content;
}

function strexists($string, $find) {
	return !(strpos($string, $find) === FALSE);
}

// End line