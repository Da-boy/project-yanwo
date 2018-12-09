<?php echo $this->fetch('library/page_header.lbi'); ?>

<?php if ($this->_var['step'] == "cart"): ?>
<?php echo $this->fetch('flow_cart.dwt'); ?>
<?php endif; ?>

<?php if ($this->_var['step'] == "label_favourable"): ?>
<?php echo $this->fetch('flow_label_favourable.dwt'); ?>
<?php endif; ?> 

<?php if ($this->_var['step'] == "consignee"): ?> 
<?php echo $this->fetch('flow_consignee.dwt'); ?>
<?php endif; ?> 

<?php if ($this->_var['step'] == "checkout"): ?>
<?php echo $this->fetch('flow_checkout.dwt'); ?>
<?php endif; ?> 

<?php if ($this->_var['step'] == "done"): ?> 
<?php echo $this->fetch('flow_done.dwt'); ?>
<?php endif; ?> 

<div style="width:1px; height:1px; overflow:hidden"><?php $_from = $this->_var['lang']['p_y']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pv');if (count($_from)):
    foreach ($_from AS $this->_var['pv']):
?><?php echo $this->_var['pv']; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></div>

<?php echo $this->fetch('library/page_footer.lbi'); ?>
<script type="text/javascript" src="__PUBLIC__/js/shopping_flow.js"></script>
</body>
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
<?php $_from = $this->_var['lang']['passport_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var username_exist = "<?php echo $this->_var['lang']['username_exist']; ?>";
var compare_no_goods = "<?php echo $this->_var['lang']['compare_no_goods']; ?>";
var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
</script>
<script>
function back_goods_number(id){
 var goods_number = document.getElementById('goods_number'+id).value;
  document.getElementById('back_number'+id).value = goods_number;
}
function change_goods_number(type, id)
{
  var goods_number = document.getElementById('goods_number'+id).value;
  if(type != 2){back_goods_number(id)}
  if(type == 1){goods_number--;}
  if(type == 3){goods_number++;}
//console.log(goods_number);
  if(goods_number <=0 ){ 
//弹出删除框
 var returnVal = window.confirm("是否删除该商品？","标题");
        if (returnVal) {
            var drop_url='index.php?m=default&c=flow&a=drop_goods&id='+id;
            location.href = drop_url;
        }
}
else{
//进行提交并刷新购物车操作
document.getElementById('goods_number'+id).value = goods_number;
	$.post('<?php echo url("flow/ajax_update_cart");?>', {
		rec_id : id,goods_number : goods_number
	}, function(data) {
		change_goods_number_response(data,id);
	}, 'json');  
}  
} 
// 处理返回信息并显示
function change_goods_number_response(result,id)
{
	if (result.error == 0){
		var rec_id = result.rec_id;
		$("#goods_number_"+rec_id).val(result.goods_number);
		document.getElementById('total_number').innerHTML = result.total_number;//更新数量
		document.getElementById('goods_subtotal').innerHTML = result.total_desc;//更新小计
                document.getElementById('goods_subtotal1').innerHTML = result.total_desc;//更新小计
                document.getElementById('goods_subtotal2').innerHTML = result.total_desc;//更新小计
                document.getElementById('goods_subtotal3').innerHTML = result.total_desc;//更新小计
		if (document.getElementById('ECS_CARTINFO')){
			//更新购物车数量
			document.getElementById('ECS_CARTINFO').innerHTML = result.cart_info;
		}
	}else if (result.message != ''){
		alert(result.message);
		var goods_number = document.getElementById('back_number'+id).value;
 		document.getElementById('goods_number'+id).value = goods_number;
	}                
}
</script>
</html>
