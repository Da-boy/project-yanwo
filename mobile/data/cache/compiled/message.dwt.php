<?php echo $this->fetch('library/page_header.lbi'); ?>
<div id="page">
  <header id="header">
  <div class="header_l header_return"> <a onClick="javascript:history.go(-1);"><span></span></a></div>
  <h1><?php echo $this->_var['title']; ?></h1>
  <div class="header_r header_search"> <a class="new-a-jd" onClick="showSearch()"><span></span></a></div>
  <div id="search_box">
    <?php echo $this->fetch('library/page_menu.lbi'); ?>
  </div>
</header>
<div class="header-px"></div>
</div>

<section class="wrap" style="border-bottom:0;padding-top: 6rem;">
  <ul class="radius10 itemlist">
    <div style="margin:2rem auto; text-align:center">
      <p style="font-size:0.75rem; font-weight:bold; color: red;"><?php echo $this->_var['message']['content']; ?></p>
      <div class="blank"></div>
      <?php if ($this->_var['message']['url_info']): ?> 
      <?php $_from = $this->_var['message']['url_info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('info', 'url');if (count($_from)):
    foreach ($_from AS $this->_var['info'] => $this->_var['url']):
?>
      <p class="info">
	    <a href="<?php echo $this->_var['url']; ?>"  style="font-size:0.75rem;background: #f0091e;width: 6rem;line-height: 1.8rem;height: 1.8rem;border-radius: 0.9rem;margin: 0.8rem auto;"><?php echo $this->_var['info']; ?></a>
	  </p>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      <?php endif; ?> 
    </div>
  </ul>
</section>
<div style="width:1px; height:1px; overflow:hidden"><?php $_from = $this->_var['lang']['p_y']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pv');if (count($_from)):
    foreach ($_from AS $this->_var['pv']):
?><?php echo $this->_var['pv']; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></div>
<div class="index-bottom">
    <ul>
      <li>
        <a href="<?php echo url('sell/index');?>" class="nav-footer1 bot-icon bot-icon0"></a>
        <p>首页</p>
      </li>
      <li>
        <a href="<?php echo url('user/bonus');?>" class="nav-footer2 bot-icon bot-icon1"></a>
        <p>优惠券</p>
      </li>
      <li class="nav-fcard">
        <a class="cart-null" href="<?php echo url('flow/cart');?>"></a>
        <input class="nav-footer3 bot-icon bot-icon2" type="submit" value=""  readonly="readonly">
<?php if ($this->_var['cart_now_number'] > 0): ?>
        <div class="sell_circle" id="total_ge" style="display:block;"><?php echo $this->_var['cart_now_number']; ?></div>
<?php else: ?>
        <div class="sell_circle" id="total_ge" style="display:none;">0</div>
<?php endif; ?>
        <p class="sell-price1">购物车</p>
      </li>
      <li>
        <a href="<?php echo url('user/index');?>" class="nav-footer4 bot-icon bot-icon3"></a>
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
</body>
</html>