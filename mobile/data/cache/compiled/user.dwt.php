<?php echo $this->fetch('library/page_header.lbi'); ?>
<div class="user_bg">
    <ul class="user_head">
        <li class="user_head1"><img src="<?php echo $this->_var['info']['headimgurl']; ?>" /></li>
        <li class="user_head2">
            <p class="user_head2_name"><?php echo $this->_var['info']['nickname']; ?></p>
        </li>
    </ul>
    <a class="uesr-dingdan" href="<?php echo url('user/order_list');?>">我的订单</a>
    <a class="uesr-img" class="bor0" href="<?php echo $this->_var['small_link']; ?>">
        <img src="<?php echo $this->_var['small_img']; ?>">
    </a>
    <ul class="user-ul1 user-ul2">
        <li>
            <a class="bor0" href="<?php echo url('fuli/index');?>">
                <div class="user_icon user_icon4"></div>
                <p>邀请好友</p>
            </a>
        </li>
        <li>
            <a href="<?php echo url('user/money');?>">
                <div class="user_icon user_icon5"></div>
                <p>余额</p>
            </a>
        </li>
        <li>
            <a href="<?php echo url('user/bonus');?>">
                <div class="user_icon user_icon6"></div>
                <p>优惠券</p>
            </a>
        </li>
        <li>
            <a href="<?php echo url('user/jifen');?>">
                <div class="user_icon user_icon7"></div>
                <p>积分</p>
            </a>
        </li>
        <li>
            <a class="bor0" href="<?php echo url('user/address_list');?>">
                <div class="user_icon user_icon8"></div>
                <p>管理地址</p>
            </a>
        </li>
        <li>
            <a href="<?php echo url('user/card');?>">
                <div class="user_icon user_icon9"></div>
                <p>套餐卡</p>
            </a>
        </li>
        <li>
            <a onclick="WeixinJSBridge.call('closeWindow');">
                <div class="user_icon user_icon11"></div>
                <p>客服</p>
            </a>
        </li>
        <li>
            <a href="<?php echo url('fuli/water');?>">
                <div class="user_icon user_icon10"></div>
                <p>关于99度燕窝</p>
            </a>
        </li>
    </ul>
    <?php echo $this->fetch('library/nav_footer.lbi'); ?>
</div>
</html>
