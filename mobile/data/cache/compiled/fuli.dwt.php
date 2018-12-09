<?php echo $this->fetch('library/page_header.lbi'); ?>
<a class="back" onclick="javascript:history.go(-1);"></a>
<div class="blackbox">
    <img src="themes/99yanwo/image/fuli/click.png" class="black-img">
</div>
<div class="fuli_bg">
	<img src="<?php echo $this->_var['image']; ?>" />
	<a class="share1" href="<?php echo url('fuli/rule');?>">奖励规则 ></a>
    <div class="share-link">点击邀请好友</div>
    <a class="share3"  href="<?php echo url('fuli/income');?>">您已成功邀请

<?php if ($this->_var['inv_num']): ?>
<?php echo $this->_var['inv_num']; ?>
<?php else: ?>
0
<?php endif; ?>
人，累计获得优惠券
<?php if ($this->_var['bonus_num']): ?>
<?php echo $this->_var['bonus_num']; ?>
<?php else: ?>
0
<?php endif; ?>
张 ></a>
</div>
<?php echo $this->fetch('library/nav_footer.lbi'); ?>
<script type="text/javascript">
$(".share-link").click(function(){
    $(".blackbox").show();
});
$(".blackbox").click(function(){
    $(".blackbox").hide();
});
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
      'onMenuShareAppMessage',
      'hideAllNonBaseMenuItem',
      'showMenuItems'      
    ]
  });
  wx.ready(function () {
    // 在这里调用 API
	wx.checkJsApi({
    jsApiList: [        
		'onMenuShareAppMessage'
    ],
   success: function (res) {
         //alert(JSON.stringify(res));
         //alert(JSON.stringify(res.checkResult.getLocation));
        if (res.checkResult.getLocation == false) {
            alert('你的微信版本太低，不支持微信JS接口，请升级到最新的微信版本！');
            return;
        }else{
      
	wx.hideAllNonBaseMenuItem({
      success: function () {
        //alert('已隐藏所有非基本菜单项');
           wx.showMenuItems({
      menuList: [        
        'menuItem:share:appMessage' // 发送给朋友        
      ],
      success: function (res) {
        //alert('已显示“阅读模式”，“分享到朋友圈”，“复制链接”等按钮');
      },
      fail: function (res) {
        alert(JSON.stringify(res));
      }
   	 });
    
      }
    });
        		
	wx.onMenuShareAppMessage({
      title: '99°燕窝——现煮现炖及时送￥100新人礼包，快来体验！',
      desc: '产自燕窝黄金三大区-泰国春蓬府；现煮及時送，保证燕窝最新鲜品质和口感。',
      link: 'http://mp.99yanwo.com/mobile/index.php?m=default&c=sell&a=index&type=hongbao&fuserid='+<?php echo $this->_var['fuserid']; ?>,
      imgUrl: 'http://mp.99yanwo.com/mobile/themes/99yanwo/image/youhui60.png',
      trigger: function (res) {
        // 不要尝试在trigger中使用ajax异步请求修改本次分享的内容，因为客户端分享操作是一个同步操作，这时候使用ajax的回包会还没有返回
        //alert('用户点击发送给朋友');
      },
      success: function (res) {
        //alert('已分享');
        $(".blackbox").hide();
      },
      cancel: function (res) {
        //alert('已取消');
      },
      fail: function (res) {
        //alert(JSON.stringify(res));
      }
    });
    
	
		
		}
    }
});

  });
</script>

</body>
</html>