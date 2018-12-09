<?php echo $this->fetch('library/page_header.lbi'); ?>
<div class="zhifu-no">
    <div class="pay-no-img">
        <img src="__TPL__/image/zhifu/zhifu-no-icon.png" />
    </div>
	<h2 class="pay-no-title">支付失败，请查看订单详情</h2>
    <h3 class="pay-no-title1">订单信息</h2>
    <p class="pay-no-p1">该订单会为您保存12小时（从下单之日算起），12小时之内如果未付款，系统将自动取消该订单。</p>
    <div class="pay-no">
        <a href="<?php echo url('user/order_list');?>">重新支付</a>
        <a href="<?php echo url('user/order_list');?>">查看订单</a>
    </div>
</div>
<p class="pay-no-info">
    <span>!</span>
    安全提醒：99度燕窝不会以任何理由要求您提供银行卡信息或支付额外费用，请谨防钓鱼链接或诈骗电话。
</p>
<script>
$("body").css('background-color','#f0f0f0');
</script>
</body>
</html>