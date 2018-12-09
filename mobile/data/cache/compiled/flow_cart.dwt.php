<header id="header">
  <div class="header_l header_return">
    <a  href="<?php echo url('sell/index');?>">
        <span></span>
        <i></i>
    </a>
  </div>
  <h1><?php echo $this->_var['lang']['shopping_cart']; ?></h1>
</header>
<div class="header-px"></div>
<?php if ($this->_var['goods_list']): ?>
<div class="flow-bg" style="display:block;">
    <form>
        <ul class="flow-all">
            <li>
            <?php if ($this->_var['total']['is_all_check'] == 0): ?>
                <input type="checkbox" id="flow1" class="allselect" checked  value="1" onclick="change_check_status_all()">
            <?php else: ?>
                <input type="checkbox" id="flow1" class="allselect"  value="0" onclick="change_check_status_all()">
            <?php endif; ?>
                <label for="flow1" class="flow-label1"></label>
            </li>
            <li>3小时达</li>
            <li style="color:#f0091e;float: right;margin-right: 1rem;">免运费</li>
        </ul>
        <ul class="flow-cart">
 <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['goods']):
?>
            <li>
                <div class="flow-radio">
<?php if ($this->_var['goods']['check_status'] == 0): ?>
                    <input type="checkbox" id="rec_<?php echo $this->_var['goods']['rec_id']; ?>" checked="true"  name="rec_id" value="<?php echo $this->_var['goods']['rec_id']; ?>" onClick="change_check_status(<?php echo $this->_var['goods']['rec_id']; ?>,<?php echo $this->_var['goods']['check_status']; ?>)">
<?php else: ?>
                    <input type="checkbox" id="rec_<?php echo $this->_var['goods']['rec_id']; ?>"  name="rec_id" value="<?php echo $this->_var['goods']['rec_id']; ?>" onClick="change_check_status(<?php echo $this->_var['goods']['rec_id']; ?>,<?php echo $this->_var['goods']['check_status']; ?>)">
<?php endif; ?>                    
<label for="rec_<?php echo $this->_var['goods']['rec_id']; ?>" class="flow-label"></label>
                </div>
                <a class="flow-content" href="<?php echo url('goods/index',array('id'=>$this->_var['goods']['goods_id']));?>">
                    <div class="flow-img"><img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" alt=""></div>
                    <ul>
                        <li class="flow-p1"><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></li>
                        <li class="flow-p2">限量优惠</li>
                        <li class="flow-p3">原价<span><?php echo $this->_var['goods']['market_price']; ?></span><div class="flow-though"></div></li>
                        <li class="flow-p4">抢鲜价<span><?php echo $this->_var['goods']['goods_price']; ?></span><!--<input type="text" value="99" readonly class="flow-value">--></li>
                    </ul>
                </a>
                <div class="flow-card">
<?php if ($this->_var['goods']['goods_id'] > 0 && $this->_var['goods']['is_gift'] == 0 && $this->_var['goods']['parent_id'] == 0): ?>
<?php if ($this->_var['goods']['goods_id'] == 145 || $this->_var['goods']['goods_id'] == 153): ?>
                        <input type="text" class="flow_bottom1" value="" readonly="readonly" onClick="change_goods_number('1',<?php echo $this->_var['goods']['rec_id']; ?>)" />
                        <input type="hidden" id="back_number<?php echo $this->_var['goods']['rec_id']; ?>" value="<?php echo $this->_var['goods']['goods_number']; ?>" />
                        <input name="<?php echo $this->_var['goods']['rec_id']; ?>"  id="goods_number<?php echo $this->_var['goods']['rec_id']; ?>" value="<?php echo $this->_var['goods']['goods_number']; ?>"  class="flow_bottom2" readonly="readonly" />
                        <input type="text" class="flow_bottom3 sell-bot-addClass" value="" readonly="readonly"/>
<?php else: ?>
                        <input type="text" class="flow_bottom1" value="" readonly="readonly" onClick="change_goods_number('1',<?php echo $this->_var['goods']['rec_id']; ?>)" />
                        <input type="hidden" id="back_number<?php echo $this->_var['goods']['rec_id']; ?>" value="<?php echo $this->_var['goods']['goods_number']; ?>" />
                        <input name="<?php echo $this->_var['goods']['rec_id']; ?>"  id="goods_number<?php echo $this->_var['goods']['rec_id']; ?>" value="<?php echo $this->_var['goods']['goods_number']; ?>"  class="flow_bottom2" readonly="readonly" />
                        <input type="text" class="flow_bottom3" value="" readonly="readonly" onClick="change_goods_number('3',<?php echo $this->_var['goods']['rec_id']; ?>)"/>
<?php endif; ?>
<?php else: ?>
<input type="text" class="flow_bottom2" readonly value="<?php echo $this->_var['goods']['goods_number']; ?>"/>
 <?php endif; ?> 
                </div>
            </li>
 <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </ul>
    </form>
    <div class="flow-tol">
        <ul>
            <li>
                <span>限时优惠价</span>
                <span class="flow-price total" id="goods_subtotal"><?php echo $this->_var['total']['goods_price']; ?></span>
            </li>
            <li>
                <span>已选商品数量</span>
                <span class="flow-price total" id="total_number"><?php echo $this->_var['total']['total_number']; ?></span>
            </li>
            <li>
                <span>商品实付</span>
                <span class="flow-price total" id="goods_subtotal1"><?php echo $this->_var['total']['goods_price']; ?></span>
            </li>
            <li>
                <span>运费</span>
                <span class="flow-price">免邮</span>
            </li>
        </ul>
        <p class="flow-p">合计<span class="total" id="goods_subtotal2"><?php echo $this->_var['total']['goods_price']; ?></span></p>
    </div>
    <div class="flow-fix">
        <ul>
            <li class="flow-tot">
            <?php if ($this->_var['total']['is_all_check'] == 0): ?>
                <input type="checkbox" id="flow2" checked  value="1" onclick="change_check_status_all()">
            <?php else: ?>
                <input type="checkbox" id="flow2" value="0" onclick="change_check_status_all()">
            <?php endif; ?>
                <label for="flow2" class="flow-label1" style="margin-top: 0.3rem"></label>
            </li>
            <li class="flow-select">全选</li>
            <li>
                <p>合计<span class="total" id="goods_subtotal3"><?php echo $this->_var['total']['goods_price']; ?></span></p>
                <div class="total-more">限时优惠价,免邮</div>
            </li>       
            <li style="float: right;background-color:#f0091e;">
                <a href="<?php echo url('flow/checkout');?>" type="button" class="flow-sub"><?php echo $this->_var['lang']['check_out']; ?></a>
            </li>
        </ul>
    </div>
</div>
  <?php else: ?>
<div class="nocart" style="display:block;">
	<img src="themes/99yanwo/image/sell/cart-no.png" />
    <p>你还没有添加任何商品</p>
    <?php echo $this->fetch('library/nav_footer.lbi'); ?>
</div>
  <?php endif; ?>
<script src="__TPL__/js/jquery.1.4.2-min.js" type="text/javascript"></script>
<script src="__TPL__/js/Calculation.js" type="text/javascript"></script>
<script type="text/javascript">
/*
*变更单个购物车商品状态的方法
*/
function change_check_status(id,type){
  var rec=document.getElementById('rec_'+id);
//var rec_status=rec.getAttribute("checked");
//console.log(rec_status);
if(type==0){
//修改状态为，未选择
$.get('index.php?m=default&c=flow&a=change_status&type=1&id='+id, {
	}, function(data) {
		if(data.status==true){
           // rec.setAttribute("checked",false);
            var cart_url="index.php?m=default&c=flow&a=cart";
            location.href = cart_url;
}else{
           rec.setAttribute("checked",true); 
}
	}, 'json'); 

}else{
//修改状态为已选择
$.get('index.php?m=default&c=flow&a=change_status&type=0&id='+id, {
	}, function(data) {
		if(data.status==true){
            rec.setAttribute("checked",true);
            var cart_url="index.php?m=default&c=flow&a=cart";
            location.href = cart_url;
}else{
           //rec.setAttribute("checked",false); 
}
	}, 'json'); 
}
}
/*
*变更购物车所有商品状态的方法
*/
function change_check_status_all(){
 var type=document.getElementById('flow1').getAttribute('value');
$.get('index.php?m=default&c=flow&a=change_status_all&type='+type, {
	}, function(data) {
	if(data.status==true){
            var cart_url="index.php?m=default&c=flow&a=cart";
            location.href = cart_url;
}else{
          var cart_url="index.php?m=default&c=flow&a=cart";
            location.href = cart_url;
}
	}, 'json'); 
}


</script>
