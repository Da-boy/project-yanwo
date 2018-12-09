<?php echo $this->fetch('library/page_header.lbi'); ?>
<header id="header">
  <div class="header_l header_return">
     <a onClick="javascript:history.go(-1);">
       <span></span>
       <i></i>
     </a>
   </div>
  <h1>优惠券</h1>
</header>
<div class="header-px"></div>
<div class="user_youhui_bg">
    <div class="user_youhui_content">
         <?php if ($this->_var['isdisplay']): ?>
        <div>
            <div class="user_youhui_content_img"><img src="__TPL__/image/user/youhui_icon1.png"/></div>
            <p  class="user_youhui_content-p">当前没有可用优惠券</p>
        </div>
         <?php endif; ?>
        <div class="youhui-content">
            <?php $_from = $this->_var['bonus_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'bonus');if (count($_from)):
    foreach ($_from AS $this->_var['bonus']):
?>
            <ul>
                <li class="youhui-icon">满减券</li>
                <li class="youhui-li1">
                    <p><span>￥</span><?php echo $this->_var['bonus']['bonus_money_formated']; ?></p>
                </li>
                <li class="youhui-li2">
                    <p>99度燕窝<?php echo $this->_var['bonus']['bonus_money_formated']; ?>元优惠券</p>
                    <p>订单满<?php echo $this->_var['bonus']['min_goods_amount']; ?>元</p>
                    <p>有效期至：<?php echo $this->_var['bonus']['use_end_date']; ?></p>
                </li>
            </ul>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </div>
        <a href="<?php echo url('user/bonusgq');?>" class="ck-youhuigq">查看过期优惠券</a>
    </div>
<?php echo $this->fetch('library/nav_footer.lbi'); ?>
</div>
<script language="javascript">
$("body").css("background-color","#f0f0f0");
var oUl = $(".youhui-content ul").length;
//alert(oUl);
if(oUl == 0){
$(".youhui-content").css("min-height","0");
}
</script>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body></html>