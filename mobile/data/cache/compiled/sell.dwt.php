<?php echo $this->fetch('library/page_header.lbi'); ?>
<?php if ($this->_var['isdisplay'] == 1): ?>
<div class="blackbox" style="display:block;">
	<div class="fuli-ling">
		<img src="themes/99yanwo/image/fuli/index-fuli.jpg">
		<!--<div class="fuli-info">
			<div class="fuli-info-img"><img src="<?php echo $this->_var['info']['headimgurl']; ?>"></div>
			<p class="fuli-name"><?php echo $this->_var['info']['nickname']; ?></p>
		</div>-->
		<input type="button" class="fuli-input" value="" onclick="receive_bonus(<?php echo $this->_var['fuserid']; ?>)">
	</div>	
</div>
<div class="tanchu-info" id="tanchu_message" style="display:none"></div>
<?php endif; ?>
<?php if ($this->_var['guanzhu']): ?>
	<div class="tanchu-banner" >
		<img src="themes/99yanwo/image/sell/tanchu-banner.png" / >
		<div class="close"></div>
	</div>
<?php endif; ?>
<div id="addBox" style="display: none;">        </div>
<div class="index_header" style="background-color:white;">
	<ul class="index_head">
        <li>
             <img src="themes/99yanwo/image/sell/time3.png" / >
        </li>
    </ul>
</div>
<div style="height:1.6rem;width:100%;"></div>
<div id="focus" class="focus region">
  <div class="hd">
    <ul>
    </ul>
  </div>
  <div class="bd">
      <?php 
$k = array (
  'name' => 'ads',
  'id' => '1',
  'num' => '3',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
  </div>
</div>

<div class="sell_bg">
	<ul class="sell-icon">
		<!--<li>
		  <a href="<?php echo url('fuli/share');?>"><img src="themes/99yanwo/image/sell/icon1.png" /></a>
		  新人专享
		</li>
		<li>
		  <a href="<?php echo url('fuli/index');?>"><img src="themes/99yanwo/image/sell/icon2.png" /></a>
		  <p class="sell-act">送iphone7</p>
		  邀请有礼
		</li>
		<li>
		  <a href="<?php echo url('user/jifen');?>"><img src="themes/99yanwo/image/sell/icon3.png" /></a>
		  积分换礼
		</li>
		<li>
		  <a href="<?php echo url('user/order_list');?>"><img src="themes/99yanwo/image/sell/icon4.png" /></a>
		  我买过的
		</li>-->
        <?php $_from = $this->_var['ad_row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'ad');if (count($_from)):
    foreach ($_from AS $this->_var['ad']):
?>
            <li>
                <a href="<?php echo $this->_var['ad']['ad_link']; ?>"><img src="<?php echo $this->_var['ad']['ad_code']; ?>" /></a>
                <?php echo $this->_var['ad']['ad_name']; ?>
            </li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</ul>
	<div class="font-hour">
	    <div class="shell">
          <div id="font-hour">
            <a href="javascript:">每天上午10点准时开抢</a>
            <a href="javascript:">每天晚上9点准时开抢</a>
          </div>
        </div>
	</div>
    <div class="sell-title" id="time">距离活动结束</div>
	<ul class="arr-time">
      <li><span id="time1">06</span>时</li>
      <li><span id="time2">06</span>分</li>
      <li><span id="time3">06</span>秒</li>
      <li><span id="timer1">0</span></li>
    </ul>
    <div class="sell_main">
        <form action="javascript:bool =1;addToCart_quick(<?php echo $this->_var['qg']['goods_id']; ?>)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY145" class="demoform">
			<ul class="sell_main-ul1" style="margin-top:0.4rem;border-bottom:2px solid #f0f0f0">
             	<li class="sell_imgicon">
				   <a href="/mobile/index.php?m=default&c=goods&a=index&id=<?php echo $this->_var['qg']['goods_id']; ?>" id="qianggou">
				     <img src="<?php echo $this->_var['qg']['goods_thumb']; ?>" />
				     <div class="sell-black1" id="ZT"></div>
				   </a>
				</li>

				<li class="sell-info">
                  <a  href="/mobile/index.php?m=default&c=goods&a=index&id=<?php echo $this->_var['qg']['goods_id']; ?>">
					<p class="sell-p1" style="margin-top:0.2rem;"><?php echo $this->_var['qg']['goods_name']; ?></p>
                  </a>
					<p class="sell-p2" style="color:#ff2741;">限天津市内六区</p>
                     <div class="sell-tag">
                        <span>限时优惠</span>
                    </div>
                    <div class="sell-del">
					   <span>原价</span><?php echo $this->_var['qg']['market_price']; ?>
					   <div class="though"></div>
					</div>
					<div class="sell-money-fir">
					    <span>抢鲜价</span>
                        <span><?php echo $this->_var['qg']['shop_price_formated']; ?></span>
                    </div>
					<div class="sell-div2">
						<p class="sell-p7" style="display:none;">还剩<input type="text" value="<?php echo $this->_var['qg']['goods_number']; ?>" readonly="readonly"  id="nunber"/>份</p>
						<p class="sell-p9">已有<?php echo $this->_var['qg']['sale_number']; ?>人购买</p>
					</div>
				</li>
                <li class="sell-cart" >
				  <input type="button"  value="" id="div1" onclick="addToCart_quick(<?php echo $this->_var['qg']['goods_id']; ?>);"/>
				</li>       
            </ul>
        </form>
		
        <div class="main-title">
		  <div class="sell-title sell-title1">热销明星</div>
		  <a><img src="<?php echo $this->_var['small_banner']; ?>" /></a>
		</div>
          <table style="width:100%" id="tab">           
            
            <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
                <tr>
       		    <td>
                  <a class="sell_main-1" href="<?php echo $this->_var['goods']['url']; ?>">
					<ul class="sell_main-ul1">
						<li class="sell_imgicon">
						  <img src="<?php echo $this->_var['goods']['thumb']; ?>"/>
						</li>
						<li class="sell-info">	
							<div class="sell-p11"><?php echo $this->_var['goods']['name']; ?></div>
							<p class="sell-p2">GMP HACCP 国际质量体系双重认证</p>
							<div class="sell-tag">
                                <?php if ($this->_var['goods']['little_label']): ?>
                                <span><?php echo $this->_var['goods']['little_label']; ?></span>
                                <?php else: ?>
                                <span>优惠</span>
                                <?php endif; ?>

                            </div>
                            <div class="sell-div5">
                                <div class="sell-absolute">

                                    <?php $_from = $this->_var['goods']['attr_row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
    foreach ($_from AS $this->_var['attr']):
?>
                                    <label><?php echo $this->_var['attr']['attr_value']; ?></label>
                                    <input type="radio" name="spec_13" value="<?php echo $this->_var['attr']['attr_price']; ?>" id="spec_value_27" >
                                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                                    <!--<label>原味</label>
                                  <input type="radio" name="spec_13" value="27" id="spec_value_27" >
                                  <label for="spec_value_27">冰糖</label>
                                  <input type="radio" name="spec_13" value="28" id="spec_value_28" >
                                  <label for="spec_value_28">蜂蜜</label>
                                  <input type="hidden" name="spec_list" value="2">-->
                                </div>
                            </div>
							 <div class="sell-money">
								 <span><?php echo $this->_var['goods']['shop_price']; ?></span>
							 </div>
							 <p class="sell-p9">已有<?php echo $this->_var['goods']['sale_number']; ?>人购买</p>
						</li>
					</ul>
                </a>

<?php if ($this->_var['goods']['is_cart'] == 0): ?>
				<div class="sell-card">
					<p class="sell-p8 sell-show" style="margin-top:0;display:block; " onclick="addToCart_new(<?php echo $this->_var['goods']['id']; ?>)">
					    <a></a>
					</p>
					<div class="sell_main_bottom" style="display:none;">
						<a class="sell_main_bottom1" onclick="deleteToCart_new(<?php echo $this->_var['goods']['id']; ?>)"></a>
						<input name="number" id="goods_number<?php echo $this->_var['goods']['id']; ?>" value="<?php echo $this->_var['goods']['cart_number']; ?>"  class="sell_main_bottom2" readonly="readonly" type="text" />
						<a class="sell_main_bottom3" onclick="addToCart_new(<?php echo $this->_var['goods']['id']; ?>)"></a>
					</div>
			    </div>
<?php else: ?>
<div class="sell-card">
					<p class="sell-p8 sell-show" style="margin-top:0;  display:none;" onclick="addToCart_new(<?php echo $this->_var['goods']['id']; ?>)">
					    <a></a>
					</p>
					<div class="sell_main_bottom" style="display:block;">
						<a class="sell_main_bottom1" onclick="deleteToCart_new(<?php echo $this->_var['goods']['id']; ?>)"></a>
						<input name="number" id="goods_number<?php echo $this->_var['goods']['id']; ?>" value="<?php echo $this->_var['goods']['cart_number']; ?>"  class="sell_main_bottom2" readonly="readonly" type="text" />
						<a class="sell_main_bottom3" onclick="addToCart_new(<?php echo $this->_var['goods']['id']; ?>)"></a>
					</div>
			    </div>
<?php endif; ?>
              </td>
            </tr>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>   
        </table>
        <div class="sell-bot">
            <a class="sell-top">
                <img src="themes/99yanwo/image/sell/top.png" />
                返回顶部
            </a>
            <div class="sell-bot-phone">
                4001-099-365
            </div>
            <div class="sell-bot-info">
                <p>微信号：yanwo99du</p>
                <p>关于我们</p>
            </div>
            <p class="conright">©2017 九十九度（天津）科技有限公司 版权所有，并保留所有权利</p>
        </div>
<?php echo $this->fetch('library/nav_footer.lbi'); ?>
  </div>
</div>

<?php echo $this->fetch('library/page_footer.lbi'); ?>
<script src="__TPL__/js/jquery.cookie.js" type="text/javascript"></script>
<script src="__TPL__/js/swipe.js" type="text/javascript"></script>
<script language="javascript">
	/*banner滚动图片*/
		TouchSlide({
			slideCell : "#focus",
			titCell : ".hd ul", // 开启自动分页 autoPage:true ，此时设置 titCell 为导航元素包裹层
			mainCell : ".bd ul",
			effect : "leftLoop",
			autoPlay : true, // 自动播放
			autoPage : true, // 自动分页
			switchLoad : "_src" // 切换加载，真实图片路径为"_src"
		});
	/*弹出评论层并隐藏其他层*/
	function openSearch(){
		 //document.getElementById("search_box").style.display = "none";
			$("#search_box").show();
	}
	function closeSearch(){
			$("#search_box").hide();
	}
</script>
<script>
var box=document.getElementById("font-hour"),can=true;
box.innerHTML+=box.innerHTML;
new function (){
 var stop=box.scrollTop%18==0&&!can;
 if(!stop)box.scrollTop==parseInt(box.scrollHeight/2)?box.scrollTop=0:box.scrollTop++;
 setTimeout(arguments.callee,box.scrollTop%18?10:3000);
};
$(".close").click(
		function(){
					$(".tanchu-banner").hide();
			}
);
$('.fuli-input').click(function(){
    $('.blackbox').hide();
});


//点击购物车列表后，变换为加减号效果
 function change_cart_tab(goodsId){
var a=$("#goods_number"+goodsId);
aa=parseInt(a.val())
if(aa==0){
	a.parent().siblings(".sell-show").hide();
	a.parent(".sell_main_bottom").show();
        a.val(aa+1) ;    
}else{
 a.val(aa+1) ;
}
};
//点击购物车减号的效果
function change_cart_tab1(goodsId){
var a=$("#goods_number"+goodsId);
aa=parseInt(a.val())-1;
if(aa==0){
        a.val(aa) ;
        a.parent().siblings(".sell-show").show();
	a.parent(".sell_main_bottom").hide();
}else{
 a.val(aa);
}
}

var btn=document.getElementById("div1");
var number=document.getElementById("nunber");
var num=number.value;
if(num>0){
	document.getElementById("ZT").innerHTML="抢购中";
}
else{
	document.getElementById("ZT").innerHTML="抢光了";
}

$('.sell-top').click(function(){
    window.scrollTo(0,0);
});


</script>
<script>
function addAlert(){
    var addAlert = document.getElementById("addBox");
    addAlert.style.display="block";
    var t = setTimeout("hide()",2000);
}
function hide(){
    var addAlert = document.getElementById("addBox");
    addAlert.style.display='none';
}
function  old_receive_bonus(fuserid){
   $.get('index.php?m=default&c=sell&a=youhui_new&fuserid='+fuserid, function(data) {
	 var message=document.getElementById('tanchu_message');
    console.log(data);
          if (message) {
            message.innerHTML = data.message;
                message.style.display="block";
        }
	}, 'json');

}

function  receive_bonus(fuserid){
    	$.ajax({
               url:'index.php?m=default&c=sell&a=youhui_new',
               type:'POST', //GET
               async:true,    //或false,是否异步
               data:{
                   fuserid:fuserid
               },
               timeout:5000,    //超时时间
               dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
               success:function(data){
               if(data.error ==true){
                   alert(data.message);
                   location.reload();
               }else {
                   alert(data.message);
               }


               },
               error:function(xhr,textStatus){
                   console.log('错误')
               },
               complete:function(){
                   console.log('结束')
               }
           })
}
</script>
<script>
    var now = new Date();//当前时间
    var isjx=0;
    function GetServerTime(){
        var d2= now.getFullYear()+"/"+now.getMonth()+"/"+now.getDate()+" 21:00:00";//设置每天的21:00 为节点
        var d3= now.getFullYear()+"/"+now.getMonth()+"/"+now.getDate()+" 23:00:00";//设置每天的23:00 为节点
        var d4= now.getFullYear()+"/"+now.getMonth()+"/"+now.getDate()+" 10:00:00";//设置每天的10:00 为节点

        var urodz2 = new Date(d2);
        var urodz3 = new Date(d3);
        var urodz4 = new Date(d4);
        now.setTime(now.getTime()+250);


        var days2 = (urodz2 - now) / 1000 / 60 / 60 / 24;
        var daysRound2 = Math.floor(days2);
        var hours2 = (urodz2 - now) / 1000 / 60 / 60 - (24 * daysRound2);
        var hoursRound2 = Math.floor(hours2);
        var minutes2 = (urodz2 - now) / 1000 /60 - (24 * 60 * daysRound2) - (60 * hoursRound2);
        var minutesRound2 = Math.floor(minutes2);
        var seconds2 = (urodz2 - now) / 1000 - (24 * 60 * 60 * daysRound2) - (60 * 60 * hoursRound2) - (60 * minutesRound2);
        var secondsRound2 = Math.round(seconds2);

        var days3 = (urodz3 - now) / 1000 / 60 / 60 / 24;
        var daysRound3 = Math.floor(days3);
        var hours3 = (urodz3 - now) / 1000 / 60 / 60 - (24 * daysRound3);
        var hoursRound3 = Math.floor(hours3);
        var minutes3 = (urodz3 - now) / 1000 /60 - (24 * 60 * daysRound3) - (60 * hoursRound3);
        var minutesRound3 = Math.floor(minutes3);
        var seconds3 = (urodz3 - now) / 1000 - (24 * 60 * 60 * daysRound3) - (60 * 60 * hoursRound3) - (60 * minutesRound3);
        var secondsRound3 = Math.round(seconds3);

        var days4 = (urodz4 - now) / 1000 / 60 / 60 / 24;
        var daysRound4 = Math.floor(days4);
        var hours4 = (urodz4 - now) / 1000 / 60 / 60 - (24 * daysRound4);
        var hoursRound4 = Math.floor(hours4);
        var minutes4 = (urodz4 - now) / 1000 /60 - (24 * 60 * daysRound4) - (60 * hoursRound4);
        var minutesRound4 = Math.floor(minutes4);
        var seconds4 = (urodz4 - now) / 1000 - (24 * 60 * 60 * daysRound4) - (60 * 60 * hoursRound4) - (60 * minutesRound4);
        var secondsRound4 = Math.round(seconds4);

		var parseTime = parseFloat(now.toTimeString().substr(0,2)+ now.toTimeString().substr(3,3).substr(0,2)+now.toTimeString().substr(6,7) );
        //hm
        var addTimer = function(){
            var list = [], interval;

            return function(id,timeStamp){
                if(!interval){
                    interval = setInterval(go,1);
                }
                list.push({ele:document.getElementById(id),time:timeStamp});
            };

            function go() {
                for (var i = 0; i < list.length; i++) {
                    list[i].ele.innerHTML = changeTimeStamp(list[i].time);
                    if (!list[i].time)
                        list.splice(i--, 1);
                }
            }

            //传入unix时间戳，得到倒计时
            function changeTimeStamp(timeStamp){
                var distancetime = new Date(timeStamp*1000).getTime() - new Date().getTime();
                if(distancetime > 0){
                    var ms = Math.floor(distancetime%1000/100);
                    document.getElementById('timer1').innerHTML = ms;
                    return ms;
                }

            }
        }();
        //判断从晚上9点到晚上11点
        if((parseTime < 230000)&& (parseTime>=210000)){
            document.getElementById("time1").innerHTML = hoursRound3;
            document.getElementById("time2").innerHTML = minutesRound3;
            document.getElementById("time3").innerHTML = secondsRound3;
			if(hoursRound3<10){
                document.getElementById("time1").innerHTML = "0"+hoursRound3;
            }
            if(minutesRound3<10){
                document.getElementById("time2").innerHTML = "0"+minutesRound3;
            }
            if(secondsRound3<10){
                document.getElementById("time3").innerHTML = "0"+secondsRound3;
            }
			if(secondsRound3>=60){
                document.getElementById("time3").innerHTML = secondsRound3-1;
            }

            addTimer("timer1",22207700142);
			document.getElementById("ZT").innerHTML="抢购中";
			document.getElementById("time").innerHTML="距离结束时间";
            document.getElementById("nunber").value="<?php echo $this->_var['goods_socre']; ?>";
        }
		//判断从10点到21点
         else if((parseTime < 210000)&& (parseTime>=100000)){
            document.getElementById("time1").innerHTML = hoursRound2;
            document.getElementById("time2").innerHTML = minutesRound2;
            document.getElementById("time3").innerHTML = secondsRound2;
			if(hoursRound2<10){
                document.getElementById("time1").innerHTML = "0"+hoursRound2;
            }
            if(minutesRound2<10){
                document.getElementById("time2").innerHTML = "0"+minutesRound2;
            }
            if(secondsRound2<10){
                document.getElementById("time3").innerHTML = "0"+secondsRound2;
            }
			if(secondsRound2>=60){
                document.getElementById("time3").innerHTML = secondsRound2-1;
            }


            addTimer("timer1",22207700142);
			document.getElementById("ZT").innerHTML="抢购中";
			document.getElementById("time").innerHTML="距离结束时间";
            document.getElementById("nunber").value="<?php echo $this->_var['goods_socre']; ?>";
        }
		//判断从0点到10点
         else if((parseTime < 100000)&& (parseTime>=0)){
            document.getElementById("time1").innerHTML = hoursRound4;
            document.getElementById("time2").innerHTML = minutesRound4;
            document.getElementById("time3").innerHTML = secondsRound4;
			if(hoursRound4<10){
                document.getElementById("time1").innerHTML = "0"+hoursRound4;
            }
            if(minutesRound4<10){
                document.getElementById("time2").innerHTML = "0"+minutesRound4;
            }
            if(secondsRound4<10){
                document.getElementById("time3").innerHTML = "0"+secondsRound4;
            }
			if(secondsRound4>=60){
                document.getElementById("time3").innerHTML = secondsRound4-1;
            }


            addTimer("timer1",22207700142);
			document.getElementById("ZT").innerHTML="未开抢";
			document.getElementById("time").innerHTML="距离开始时间";
            document.getElementById("nunber").value="<?php echo $this->_var['goods_socre']; ?>";
            document.getElementById("qianggou").href = "#";
            document.getElementById("div1").style.display="none";
        }
		else  {
		    document.getElementById("time1").innerHTML = "00";
            document.getElementById("time2").innerHTML = "00";
            document.getElementById("time3").innerHTML = "00";
			document.getElementById("ZT").innerHTML="抢完了";
			//document.getElementById("div1").style.display="none";
			document.getElementById("qianggou").href = "#";
			document.getElementById("time").innerHTML="活动10点准时开始";
			document.getElementById("nunber").value="0";
			clearInterval(timer);
        }
    }
    var timer=setInterval("GetServerTime()",250);
</script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
  /*
   * 注意：
   * 1. 所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
   * 2. 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
   * 3. 常见问题及完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
   *
   * 开发中遇到问题详见文档“附录5-常见错误及解决办法”解决，如仍未能解决可通过以下渠道反馈：
   * 邮箱地址：weixin-open@qq.com
   * 邮件主题：【微信JS-SDK反馈】具体问题
   * 邮件内容说明：用简明的语言描述问题所在，并交代清楚遇到该问题的场景，可附上截屏图片，微信团队会尽快处理你的反馈。
   */
  wx.config({
    debug: false,
    appId: '<?php echo $this->_var['signPackage']['appId']; ?>',
    timestamp: <?php echo $this->_var['signPackage']['timestamp']; ?>,
    nonceStr: '<?php echo $this->_var['signPackage']['nonceStr']; ?>',
    signature: '<?php echo $this->_var['signPackage']['signature']; ?>',
    jsApiList: [
      // 所有要调用的 API 都要加到这个列表中
	  'checkJsApi',
      //'openLocation',
      'onMenuShareAppMessage'
      //'getLocation'
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
	wx.checkJsApi({
    jsApiList: [
        //'getLocation',
		'onMenuShareAppMessage'
    ],
   success: function (res) {

	wx.onMenuShareAppMessage({
      title: '99°燕窝——现煮现炖及时送，来自泰国的轻奢食品！',
      desc: '现煮及時送 保证燕窝最新鲜品质和口感，产自燕窝黄金三大区-泰国春蓬府！',
      link: 'http://mp.99yanwo.com/mobile/index.php',
      imgUrl: 'http://mp.99yanwo.com/mobile/themes/99yanwo/image/icon.png',
      trigger: function (res) {
        // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
        //alert('用户点击发送给朋友');
      },
      success: function (res) {
        //alert('已分享');
      },
      cancel: function (res) {
        //alert('已取消');
      },
      fail: function (res) {
        //alert(JSON.stringify(res));
      }
    });
		}

});

  });
</script>
</body>
</html>