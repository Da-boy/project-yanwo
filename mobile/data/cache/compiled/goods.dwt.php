<?php echo $this->fetch('library/page_header.lbi'); ?>
<header id="header">
  <div class="header_l header_return">
    <a onclick="javascript:history.go(-1);">
        <span></span>
        <i></i>
    </a>
  </div>
  <h1>
	99度现炖及時送燕窝
  </h1>
</header>
<div class="header-px"></div>
<div id="addBox" style="display: none;">        </div>
<div class="blackbox">
    <div class="inner"> 
        <div class="cartitle">添加成功</div>
        <div class="content_name">
            <p>商品已成功加入购物车</p>
        </div>
        <div id="mcart_confirm_popup_btns" class="btn_box">
            <a class="btn btn_cancel">再逛逛</a>
            <a onClick="addToCart_quick(<?php echo $this->_var['goods']['goods_id']; ?>)" class="btn btn_confirm">去购物车</a>
        </div>
    </div>
</div>
 
<section class="goods_slider">
  <div class="slideBox">
    <div class="bd">
        <div class="owl-carousel">
            <?php if ($this->_var['pictures']): ?>
            <?php $_from = $this->_var['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'picture');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['picture']):
        $this->_foreach['no']['iteration']++;
?>
            <?php if ($this->_foreach['no']['iteration'] > 0): ?>
            <div class="item">
                <img src="<?php echo $this->_var['picture']['img_url']; ?>" alt="<?php echo $this->_var['picture']['img_desc']; ?>" />
            </div>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <?php endif; ?>
        </div>
    </div>
  </div>
  <div class="detail-price">
    <h2 class="detail-title1"><?php echo $this->_var['goods']['goods_name']; ?></h2>
    <h5 class="detail-title2">GMP HACCP 国际质量体系双重认证</h5>
    <?php if ($this->_var['goods']['is_promote'] && $this->_var['goods']['gmt_end_time']): ?> 
    <span class="Text"><?php echo $this->_var['goods']['promote_price']; ?></span> 
    <?php else: ?> 
    <span class="Text" id="ECS_GOODS_AMOUNT"><?php echo $this->_var['goods']['shop_price_formated']; ?></span>
    <?php endif; ?> 
    <?php if ($this->_var['goods']['is_collect'] == '1'): ?> 
    <!--<a class="btn-sc Yishoucang" id="collect_box" href="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>)"><span></span></a>--> 
    <?php else: ?> 
    <!--<a class="btn-sc" id="collect_box" href="javascript:collect(<?php echo $this->_var['goods']['goods_id']; ?>)"><span></span></a>--> 
    <?php endif; ?> 
  </div>
  <div class="detail-info">
    <img src="themes/99yanwo/image/good/goods-logo.png">
    <div class="detail-p">
        <p>
            <span style="color:#fc2c47;">掌柜说：</span>
            选用泰王国岛屿可溯源的优质燕窝原料，采用泰王国皇室古法水洗，不使用任何化学处理方式，纯手工清洗挑毛，保持燕窝营养价值，选用进口康宁厨具和农夫山泉婴幼儿水小火慢炖均衡释放黄金燕窝酸，锁住燕窝营养不流失，晶莹剔透，纵享丝滑
        </p>
        <p><span class="detail-icon detail-icon1"></span>关注99度燕窝微信号：yanwo99du，有任何问题欢迎随时联系，朋友圈常常会有福利哦~</p>
    </div>
  </div>
  <ul class="detail-ul">
    <li><span class="detail-icon detail-icon2"></span>海外直采</li>
    <li><span class="detail-icon detail-icon3"></span>PICC承保</li>
    <li><span class="detail-icon detail-icon4"></span>极速发货</li>
    <li><span class="detail-icon detail-icon5"></span>售后无忧</li>
  </ul>
  <p class="detail-xiala">继续拖动，查看图文详情</p>
</section>

<section>
  <div id="tab1" class="">
    <div class="desc wrap">
	  <?php if ($this->_var['goods']['mobile_desc']): ?>
		<?php echo $this->_var['goods']['mobile_desc']; ?>
	  <?php else: ?>
		<?php echo $this->_var['goods']['goods_desc']; ?>
	  <?php endif; ?>
    </div>
  </div>
</section>
<div class="Secton10 Secton10-v1" style="padding-bottom:4rem;border-bottom:0;border-top:0;display:none;">
  <section class="goodsBuy radius5" style="margin-bottom:0; padding-left:0;">
    <input id="goodsBuy-open" type="checkbox">
    <label class="info Info" for="goodsBuy-open">
        <div class="ProProperty">
          <?php if ($this->_var['goods']['goods_number'] != "" && $this->_var['cfg']['SHOW_GOODSNUMBER']): ?>
          <?php if ($this->_var['goods']['goods_number'] == 0): ?>
          <?php echo $this->_var['lang']['goods_number']; ?><span><?php echo $this->_var['lang']['stock_up']; ?> </span><i class="icon-arr"></i>
          <?php else: ?>
          <?php echo $this->_var['lang']['goods_number']; ?><span><?php echo $this->_var['goods']['goods_number']; ?> <?php echo $this->_var['goods']['measure_unit']; ?> </span><i class="icon-arr"></i>
          <?php endif; ?>
          <?php endif; ?>
        </div>
    </label>
    <label class="info Info" for="goodsBuy-open">
        <div class="ProProperty"><?php echo $this->_var['lang']['please_select']; ?>：<span><?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');$this->_foreach['spec'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['spec']['total'] > 0):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
        $this->_foreach['spec']['iteration']++;
?><?php if ($this->_foreach['spec']['iteration'] > 1): ?> / <?php endif; ?><?php echo $this->_var['spec']['name']; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></span><!--<i class="icon-arr"></i>--></div>
        <div class="selected"></div>
    </label>
    <form action="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
      <div class="fields">
        <ul class="ul2">
           
          <?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');if (count($_from)):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
?>
          <li>
            <h2><?php echo $this->_var['spec']['name']; ?>：</h2>
            <div class="items"> 
               
              <?php if ($this->_var['spec']['attr_type'] == 1): ?> 
              <?php if ($this->_var['cfg']['GOODSATTR_STYLE'] == 1): ?> 
              <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
              <input type="radio" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" id="spec_value_<?php echo $this->_var['value']['id']; ?>" <?php if ($this->_var['key'] == 0): ?>checked<?php endif; ?> onclick="changePrice()" />
              <label for="spec_value_<?php echo $this->_var['value']['id']; ?>"><?php echo $this->_var['value']['label']; ?></label>
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />
              <?php else: ?>
              <select name="spec_<?php echo $this->_var['spec_key']; ?>" onchange="changePrice()">
                <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
                <option label="<?php echo $this->_var['value']['label']; ?>" value="<?php echo $this->_var['value']['id']; ?>"><?php echo $this->_var['value']['label']; ?> <?php if ($this->_var['value']['price'] > 0): ?><?php echo $this->_var['lang']['plus']; ?><?php elseif ($this->_var['value']['price'] < 0): ?><?php echo $this->_var['lang']['minus']; ?><?php endif; ?><?php if ($this->_var['value']['price'] != 0): ?><?php echo $this->_var['value']['format_price']; ?><?php endif; ?></option>
                <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              </select>
              <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />
              <?php endif; ?> 
              <?php else: ?> 
              <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
              <input type="checkbox" name="spec_<?php echo $this->_var['spec_key']; ?>" value="<?php echo $this->_var['value']['id']; ?>" id="spec_value_<?php echo $this->_var['value']['id']; ?>" onclick="changePrice()" />
              <label for="spec_value_<?php echo $this->_var['value']['id']; ?>"> <?php echo $this->_var['value']['label']; ?> [<?php if ($this->_var['value']['price'] > 0): ?><?php echo $this->_var['lang']['plus']; ?><?php elseif ($this->_var['value']['price'] < 0): ?><?php echo $this->_var['lang']['minus']; ?><?php endif; ?> <?php echo $this->_var['value']['format_price']; ?>] </label>
              <br />
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />
              <?php endif; ?> 
            </div>
          </li>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
          
        </ul>
        <ul class="quantity">
          <h2><?php echo $this->_var['lang']['number']; ?>:</h2>
          <div class="items" style="position:relative;"> <span class="ui-number radius5"> 
            <?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['is_gift'] == 0 && $this->_var['goods']['parent_id'] == 0): ?>
            <button type="button" class="decrease" onclick="changenum(- 1)">-</button>
            <input class="num" name="number" id="goods_number" autocomplete="off" value="1" min="1" max="<?php echo $this->_var['goods']['goods_number']; ?>" type="number" readonly />
            <button type="button" class="increase" onclick="changenum(1)">+</button>
            <?php else: ?> 
            <?php echo $this->_var['goods']['goods_number']; ?> 
            <?php endif; ?> 
            </span>
             <?php if ($this->_var['goods']['goods_id'] == 145): ?> 
	        <span style="position: absolute;top: 0;left: 0;"> 
            <input value="仅限一份" type="text" readonly="readonly" style="width: 6rem;height: 31px;border: 1px solid #999;border-radius: 3px;text-align: center;font-size: 0.7rem;color: #545454;">
            </span>
            <?php endif; ?> 
          </div>
        </ul>
      </div>
    </form>
  </section>
</div>
<div class="tbl-type detail-tbn2">
    <div class="tbl-cell" style="width:16%;">
      <a href="<?php echo url('flow/cart');?>">
          <img src="themes/99yanwo/image/good/cart.png" style="width:1.5rem;vertical-align: top;">
          <?php if ($this->_var['cart_now_number'] > 0): ?>
                  <div class="sell_circle" id="total_ge" style="display:block;"><?php echo $this->_var['cart_now_number']; ?></div>
          <?php else: ?>
                  <div class="sell_circle" id="total_ge" style="display:none;">0</div>
          <?php endif; ?>
      </a>
    </div>
  <div class="tbl-cell" style="width:80%;">
    <a  class="btn-buy"><?php echo $this->_var['lang']['buy_now']; ?></a>
  </div>
</div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
<script type="text/javascript">
/*头部搜索点击关闭或者弹出搜索框*/
function showSearch( ){
	document.getElementById("search_box").style.display="block";
}
function closeSearch(){
	document.getElementById("search_box").style.display="none";
}
</script>
<script type="text/javascript">
var goods_id = <?php echo $this->_var['goods_id']; ?>;
var goodsattr_style = <?php echo empty($this->_var['cfg']['GOODSATTR_STYLE']) ? '1' : $this->_var['cfg']['GOODSATTR_STYLE']; ?>;
var gmt_end_time = <?php echo empty($this->_var['promote_end_time']) ? '0' : $this->_var['promote_end_time']; ?>;
<?php $_from = $this->_var['lang']['goods_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var goodsId = <?php echo $this->_var['goods_id']; ?>;
var now_time = <?php echo $this->_var['now_time']; ?>;


onload = function(){
  changePrice();
  fixpng();
  try {onload_leftTime();}
  catch (e) {}
}

/**
 * 点选可选属性或改变数量时修改商品价格的函数
 */
function changePrice()
{
  var attr = getSelectedAttributes(document.forms['ECS_FORMBUY']);
  var qty = document.forms['ECS_FORMBUY'].elements['number'].value;
  $.get('<?php echo url("goods/price");?>', {'id':goodsId,'attr':attr,'number':qty}, function(data){
    changePriceResponse(data);
  }, 'json');
}

/**
 * 接收返回的信息
 */
function changePriceResponse(res)
{
  if (res.err_msg.length > 0)
  {
    alert(res.err_msg);
  }
  else
  {
    document.forms['ECS_FORMBUY'].elements['number'].value = res.qty;

    if (document.getElementById('ECS_GOODS_AMOUNT'))
	
      document.getElementById('ECS_GOODS_AMOUNT').innerHTML = res.result;
  }
}
// 筛选商品属性
jQuery(function($) {
	$(".info").click(function(){
		$('.goodsBuy .fields').slideToggle("fast");
	});
})
function changenum(diff) {
	var num = parseInt(document.getElementById('goods_number').value);
	var goods_number = num + Number(diff);
	if( goods_number >= 1){
		document.getElementById('goods_number').value = goods_number;//更新数量
		changePrice();
	}
}

</script>
<script language=JavaScript>   
    $(window).scroll(function(){
      var scrollTop = $(this).scrollTop();
      var scrollHeight = $(document).height();
      var windowHeight = $(this).height();
        if((scrollTop + windowHeight) / scrollHeight >= 0.95){
            $(".good_bg").show();
            $('.detail-xiala').addClass("detail-xiala1");
        }
    });
$(".btn-buy").click(function(){
    $(".blackbox").show();
});
$(".btn_cancel").click(function(){
    $(".blackbox").hide();
});
</script>
<script type="text/javascript" src="__TPL__/js/owl.carousel.min.js"></script>
<script>
    $(document).ready(function() {
        $(".owl-carousel").owlCarousel({
            center: true,
            items : 1,
            <?php if ($this->_foreach['no']['iteration'] > 1): ?>loop:true, <?php endif; ?>
            dots:true,
            autoplay:true
        });
    });
</script>
</body>
</html>