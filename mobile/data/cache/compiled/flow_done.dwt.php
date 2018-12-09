<div id="page">
  <header id="header">
    <div class="header_l header_return">
     <a class="header-go" href="<?php echo url('user/order_list');?>">
       <span></span>
       <i></i>
     </a>
    </div>
    <h1>订单详情</h1>
  </header>
  <div class="header-px"></div>
</div>
<div class="sell_dingdan_bg" style="padding-bottom: 0;">
    <div  class="sell_dingdan_content4">
        <div class="sell_dingdan_content4_main">
            <p class="sell_dingdan_content4_main_p1">订 单 号：</p>
            <p class="sell_dingdan_content4_main_p2"><?php echo $this->_var['order']['order_sn']; ?></p>
        </div>
    </div>
</div>

<section class="order_box padd1 radius10" style="padding-top:0;padding-bottom:0;">
  <div class="table_box table_box3">
    <div class="Info InfoBox">
      <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
        <dl class="goods-dl">
          <dd class="goods-dd1">
            <div class="goods-img">
              <ul>
                  <li><a><img alt="<?php echo $this->_var['goods']['goods_name']; ?>" src="http://mp.99yanwo.com/<?php echo $this->_var['goods']['original_img']; ?>"/></a></li>
              </ul>
              <p>3小时达</p>
            </div>
            <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['extension_code'] == 'package_buy'): ?>
            <a href="javascript:void(0)" onClick="setSuitShow(<?php echo $this->_var['goods']['goods_id']; ?>)" >
                <?php echo $this->_var['goods']['goods_name']; ?>
                <span style="color:#FF0000;">（<?php echo $this->_var['lang']['remark_package']; ?>）</span>
            </a>
            <?php else: ?>
            <a href="<?php echo url('goods/index',array('id'=>$this->_var['goods']['goods_id']));?>"><?php echo $this->_var['goods']['goods_name']; ?></a>
            <?php if ($this->_var['goods']['parent_id'] > 0): ?>
            <span style="color:#FF0000">（<?php echo $this->_var['lang']['accessories']; ?>）</span>
            <?php elseif ($this->_var['goods']['is_gift']): ?>
            <span style="color:#FF0000">（<?php echo $this->_var['lang']['largess']; ?>）</span>
            <?php endif; ?>
            <?php endif; ?>
            <?php if ($this->_var['goods']['is_shipping']): ?>
                <span style="color:#FF0000;font-size:0.5rem;">
                    (<?php echo $this->_var['lang']['free_goods']; ?>)
                </span>
            <?php endif; ?>
        </dd>
        <dd class="goods-dd2" style="text-align:right;">
           <p class="goods-red">抢鲜价<?php echo $this->_var['goods']['formated_subtotal']; ?></p>
           <p>x <?php echo $this->_var['goods']['goods_number']; ?></p>
        </dd>
        </dl>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </div>
    <div class="totle">
      <div class="InfoBox" style="border-top:0.4rem solid #f0f0f0;border-bottom:0.4rem solid #f0f0f0;">
        <?php echo $this->fetch('library/order_total.lbi'); ?>
      </div>
     </div>
  </div>
</section>
<section class="order_box padd1" style=" padding-top: 1.2rem;padding-bottom: 3rem;">
     <?php if ($this->_var['pay_id'] == 1): ?>
        <input type="radio" name="payment" value="1" id="yuepay" style="display:none;">
        <label for="yuepay" class="pay-yue">
            <img src="themes/99yanwo/image/dingdan/icon1.png">
            <p>余额支付</p>
        </label>
    <?php elseif ($this->_var['pay_id'] == 4): ?>
        <input type="radio" name="payment" value="4" id="wxpay" style="display:none;" checked>
        <label for="wxpay" class="pay-wx">
            <img src="themes/99yanwo/image/dingdan/icon2.png">
            <p>微信支付</p>
        </label>
    <?php endif; ?>
</section>
<section class="content">
  <div id="J_plugin_cart">
    <div class="bcont">
      <div id="J_allGoods">
        <div class="cont">
          <section class="order on">
            <h6 class="pay-tip radius5" style="display:none;"><?php echo $this->_var['lang']['remember_order_number']; ?>: <font style="color:red"><?php echo $this->_var['order']['order_sn']; ?></font></h6>
           
            <?php if ($this->_var['virtual_card']): ?>
            <div  style="text-align:center;overflow:hidden;border:1px solid #E2C822; background:#FFF9D7;margin:10px;padding:10px 50px 30px; margin:10px;"> 
              <?php $_from = $this->_var['virtual_card']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'vgoods');if (count($_from)):
    foreach ($_from AS $this->_var['vgoods']):
?>
              <h3 style="color:#2359B1; font-size:12px;"><?php echo $this->_var['vgoods']['goods_name']; ?></h3>
              <?php $_from = $this->_var['vgoods']['info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'card');if (count($_from)):
    foreach ($_from AS $this->_var['card']):
?>
              <ul style="list-style:none;padding:0;margin:0;clear:both">
                <?php if ($this->_var['card']['card_sn']): ?>
                <li style="margin-right:50px;float:left;"> <strong><?php echo $this->_var['lang']['card_sn']; ?>:</strong><span style="color:red;"><?php echo $this->_var['card']['card_sn']; ?></span> </li>
                <?php endif; ?> 
                <?php if ($this->_var['card']['card_password']): ?>
                <li style="margin-right:50px;float:left;"> <strong><?php echo $this->_var['lang']['card_password']; ?>:</strong><span style="color:red;"><?php echo $this->_var['card']['card_password']; ?></span> </li>
                <?php endif; ?> 
                <?php if ($this->_var['card']['end_date']): ?>
                <li style="float:left;"> <strong><?php echo $this->_var['lang']['end_date']; ?>:</strong><?php echo $this->_var['card']['end_date']; ?> </li>
                <?php endif; ?>
              </ul>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
            </div>
            <?php endif; ?>
            <p style="text-align:center; margin-bottom:20px; display:none;"><?php echo $this->_var['order_submit_back']; ?></p>
          </section>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="sell_dingdan_bottom">
   <p class="sell_dingdan_bottom1"><?php echo $this->_var['total']['amount_formated']; ?></p>
    <?php if ($this->_var['pay_id'] == 1): ?>
        <a class="pay-yuebtn">余额支付</a>
    <?php elseif ($this->_var['pay_id'] == 4): ?>
    <table align="center" border="0" cellpadding="15" cellspacing="0" style="width:23%;border-collapse:inherit; display:block;float:right;" class="radius5 sell-bottom-img wx-zhifu">
      <?php if ($this->_var['pay_online']): ?>
      
      <tr>
        <td align="center"><?php echo $this->_var['pay_online']; ?></td>
      </tr>
      <?php endif; ?>
    </table>
  <?php endif; ?>
  <div class="clearfix"></div>
  <script>
      var pay_id = <?php echo $this->_var['pay_id']; ?>;
      if(pay_id ==4){
          window.onload = function(){
              callpay();
          }
      }
      /*else if(pay_id ==1){
          window.onload = function(){
              balance_pay();
          }

      }*/
  </script>
</div>