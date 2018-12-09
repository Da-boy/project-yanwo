document.write('<script src="http://libs.baidu.com/jquery/2.0.3/jquery.min.js"></script>');
function sendSms(){
    var mobile = document.getElementById(mobile_field).value;
    var seccode = document.getElementById('seccode').value;
    var flag = document.getElementById('flag').value;
    //Ajax.call('sms/sms.php?act=send&flag='+flag, 'mobile=' + mobile + '&seccode=' + seccode, sendSmsResponse, 'POST', 'JSON');
	$.ajax({
		type: "POST",
		url: 'sms/sms.php?act=send&flag='+flag,
		data: 'mobile=' + mobile + '&seccode=' + seccode,
		async: false, //设为false就是同步请求
		cache: false,
		dataType: 'json',
		success: function (result) {
			sendSmsResponse(result);
		}
	});
}
function sendSmsResponse(result){
    if(result.code==2){
        RemainTime();
        alert('手机验证码已经成功发送');
    }else{
        if(result.msg){
            alert(result.msg);
        }else{
            alert('手机验证码发送失败');
        }
    }
}
function register2(){
    var mobile = document.getElementById(mobile_field).value;
    if (mobile_field != ''){
        var mobile_code = document.getElementById("mobile_code").value;
        if(mobile_code.length == ''){
            alert('请填写手机验证码');
            return false;
        }
        //var result = Ajax.call('sms/sms.php?act=check', 'mobile=' + mobile + '&mobile_code=' + mobile_code, null, 'POST', 'JSON', false);
		var result;
		$.ajax({
			type: "POST",
			url: 'sms/sms.php?act=check',
			data: 'mobile=' + mobile + '&mobile_code=' + mobile_code,
			async: false, //设为false就是同步请求
			cache: false,
			dataType: 'json',
			success: function (data) {
				result = data;
			}
		});
		if (result.code==2){
			return register();
		}else{
			alert(result.msg);
			return false;
		}
    }
    return register();			
}

var iTime = 59;
var Account;
function RemainTime(){
  document.getElementById('zphone').disabled = true;
  var iSecond,sSecond="",sTime="";
  if (iTime >= 0){
    iSecond = parseInt(iTime%60);
    if (iSecond >= 0){
      sSecond = iSecond + "秒";
    }
    sTime=sSecond;
    if(iTime==0){
      clearTimeout(Account);
      sTime='获取手机验证码';
      iTime = 59;
      document.getElementById('zphone').disabled = false;
    }else{
      Account = setTimeout("RemainTime()",1000);
      iTime=iTime-1;
    }
  }else{
    sTime='没有倒计时';
  }
  document.getElementById('zphone').value = sTime;
}