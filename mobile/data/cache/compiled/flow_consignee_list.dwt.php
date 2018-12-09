<?php echo $this->fetch('library/page_header.lbi'); ?>
<div id="page">
  <header id="header">
    <div class="header_l header_return">
	    <a href="<?php echo url('flow/checkout');?>">
	        <span></span>
			<i></i>
	    </a>
	</div>
    <h1>选择收货地址</h1>
    <div class="header_r header_search"> <a class="new-a-jd" onClick="showSearch()"><span></span></a></div>
    <div id="search_box">
      <?php echo $this->fetch('library/page_menu.lbi'); ?> </div>
     </div>
  </header>
  <div class="header-px"></div>
</div>
<div>
  <div style="display:block;color:red;margin-left:0.5em;" id="errorMessage" class="err_msg"></div>
	  <div class="new-ct" id="J_ItemList">
		  <div class="addr-add" style="display:none;"> 
		     <a class="btn-addr" href="<?php echo url('flow/consignee');?>">+<?php echo $this->_var['lang']['add_address']; ?></a> 
		  </div>
		  <div style="display:block;color:red;" id="errorMessage" class="err_msg"></div>
		  <div class="addr-info single_item"></div>
		  <a href="javascript:;" style="text-align:center" class="get_more"></a>
	  </div>
	  <a class="dizhi-btn" href="<?php echo url('flow/consignee');?>">新增收货地址</a>
  </div>



<?php echo $this->fetch('library/page_footer.lbi'); ?> 
<script type="text/javascript" src="__PUBLIC__/js/jquery.more.js"></script> 
<script type="text/javascript">
get_asynclist("<?php echo url('flow/consignee_list');?>" , '__TPL__/images/loader.gif');
</script>
<script type="text/javascript">
function select_address(id){
 var type=document.getElementById('address_'+id).getAttribute('value');
var url="index.php?m=default&c=flow&a=checkout";
if(type==1){
location.href = url;
}else{
$.get('index.php?m=default&c=flow&a=change_address&address='+id, {
	}, function(data) {
 if (data.error==1)
  {
    alert(data.content);
    location.href = "./";
  }else{
  location.href = url;
  }
	}, 'json'); 
}
}
</script>
</body></html>