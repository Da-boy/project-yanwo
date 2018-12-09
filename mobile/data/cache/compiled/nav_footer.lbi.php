<div class="index-bottom">
    <ul>
      <li>
<?php if ($this->_var['menu_status'] == 1): ?>
        <a href="<?php echo url('sell/index');?>" class="nav-footer1 bot-icon bot-icon4"></a>
<?php else: ?>
        <a href="<?php echo url('sell/index');?>" class="nav-footer1 bot-icon bot-icon0"></a>
<?php endif; ?>
        <p>首页</p>
      </li>
      <li>
<?php if ($this->_var['menu_status'] == 2): ?>
        <a href="<?php echo url('user/bonus');?>" class="nav-footer2 bot-icon bot-icon5"></a>
<?php else: ?>
 <a href="<?php echo url('user/bonus');?>" class="nav-footer2 bot-icon bot-icon1"></a>
<?php endif; ?>
        <p>优惠券</p>
      </li>
      <li class="nav-fcard">
        <a class="cart-null" href="<?php echo url('flow/cart');?>"></a>
<?php if ($this->_var['menu_status'] == 3): ?>
        <a class="nav-footer3 bot-icon bot-icon6"></a>
<?php else: ?>
        <a class="nav-footer3 bot-icon bot-icon2"></a>
<?php endif; ?>
<?php if ($this->_var['cart_now_number'] > 0): ?>
        <div class="sell_circle" id="total_ge" style="display:block;"><?php echo $this->_var['cart_now_number']; ?></div>
<?php else: ?>
        <div class="sell_circle" id="total_ge" style="display:none;">0</div>
<?php endif; ?>
        <p class="sell-price1">购物车</p>
      </li>
      <li>
<?php if ($this->_var['menu_status'] == 4): ?>
        <a href="<?php echo url('user/index');?>" class="nav-footer4 bot-icon bot-icon7"></a>
<?php else: ?>
<a href="<?php echo url('user/index');?>" class="nav-footer4 bot-icon bot-icon3"></a>
<?php endif; ?>
        <p>我的</p>
      </li>
    </ul>
    <div class="fenxiang">
      <a href="<?php echo url('fuli/index');?>">
          <img src="themes/99yanwo/image/footer/fenxiang-anniu.png">
      </a>
    </div>
  <div class="fenxiang-back"></div>
</div>
