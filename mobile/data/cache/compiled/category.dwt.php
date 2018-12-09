<?php echo $this->fetch('library/page_header.lbi'); ?>
<div id="page" style="right: 0px; left: 0px; display: block;">
  <header id="header">
    <div class="header_l header_return"><a href="javascript:history.go(-1);"><span></span></a></div>
    <div id="search_box2">
      <div class="search_box" id="searchBox"><?php echo $this->_var['lang']['no_keywords']; ?></div>
    </div>
    <div class="header_r header_search"> <a class="new-a-jd" onClick="showSearch()"><span></span></a></div>
    <div id="search_box"> <?php echo $this->fetch('library/page_menu.lbi'); ?> </div>
    <div class="search_box search_2" >
      <div class="search_2Box">
        <form method="post" action="<?php if ($this->_var['id']): ?><?php echo url('category/index', array('id'=>$this->_var['id'] ));?><?php else: ?><?php echo url('category/index');?><?php endif; ?>" name="searchForm" id="searchForm_id">
          <a href="#" class="new-a-cancel"><?php echo $this->_var['lang']['is_cancel']; ?></a>
          <div class="search_2BoxCon">
            <input placeholder="<?php echo $this->_var['lang']['no_keywords']; ?>" name="keywords" type="text" id="keywordBox" style="color:#c3c2c2;" />
            <a href="javascript:void(0);" target="_self" class="new-s-close new-s-close-v1"></a>
            <button class="new-s-srch" type="submit" onclick="return check('keywordBox')"><span></span></button>
          </div>
        </form>
      </div>
    </div>
  </header>
  <div class="header-px"></div>
  <?php echo $this->fetch('library/goods_list.lbi'); ?> </div>
<?php echo $this->fetch('library/page_footer.lbi'); ?> 
<script type="text/javascript">
$(".filter-inner span.new-bar:first").css("display", "none");
get_asynclist('<?php echo url('category/asynclist', array('id'=>$this->_var['id'], 'brand'=>$this->_var['brand_id'], 'price_min'=>$this->_var['price_min'], 'price_max'=>$this->_var['price_max'], 'filter_attr'=>$this->_var['filter_attr'], 'page'=>$this->_var['page'], 'sort'=>$this->_var['sort'], 'order'=>$this->_var['order'], 'keywords'=>$this->_var['keywords']));?>' , '__TPL__/images/loader.gif');
</script> 

<form class="hold-height" action="<?php echo url('category/index');?>" id="filter_from">
  <div style="position: absolute; width: 190px; height:100%; right: 0px; top: -28px; z-index: 9999; overflow: hidden; -webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1); display: none;" id="filterbar">
    <div class="new-tab-type">
      <div class="new-srch-pop" id="slidebar" style="-webkit-transition: -webkit-transform 0.4s;-webkit-transform-origin: 0px 0px; -webkit-transform-style: preserve-3d;-webkit-transform: translate(190px, 0);">
        <div class="attrExtra">
          <input type="hidden" name="category" value="<?php echo $this->_var['category']; ?>"/>
        </div>
        <div class="new-pop-ul new-p-re" id="filter_prop">
          <ul class="new-ul-lst">
             
            <?php if ($this->_var['brands']['1'] || $this->_var['price_grade']['1'] || $this->_var['filter_attr_list']): ?> 
            <?php if ($this->_var['brands']['1']): ?>
            <li class="new-ul-li"> <a href="javascript:void(0)" onclick="showHideFilter(this)" class="new-li-a"><?php echo $this->_var['lang']['brand']; ?></a>
              <div class="new-pop-sel" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1);">
                <ul>
                  <?php $_from = $this->_var['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?>
                  <li><a href="javascript:void(0);" onclick="selectExpandSort(this)" data="<?php echo $this->_var['brand']['brand_id']; ?>"  <?php if ($this->_var['brand']['selected']): ?>class="on" <?php endif; ?> ><span><?php echo $this->_var['brand']['brand_name']; ?></span></a></li>
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
              </div>
              <input type="hidden" name="brand" value="<?php echo $this->_var['brand_id']; ?>" />
            </li>
            <?php endif; ?> 
            
            <?php if ($this->_var['price_grade']['1']): ?>
            
            <li class="new-ul-li"> <a href="javascript:void(0)" onclick="showHideFilter(this)" class="new-li-a on"><?php echo $this->_var['lang']['price']; ?></a>
              <div class="new-pop-sel" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1); display:none;" >
                <ul>
                  
                  <?php $_from = $this->_var['price_grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'grade');if (count($_from)):
    foreach ($_from AS $this->_var['grade']):
?>
                  
                  <li><a href="javascript:void(0);" onclick="selectExpandSort(this)" data="<?php echo $this->_var['grade']['start']; ?>|<?php echo $this->_var['grade']['end']; ?>"  <?php if ($this->_var['grade']['selected']): ?>class="on" <?php endif; ?> ><span><?php echo $this->_var['grade']['price_range']; ?></span></a></li>
                  
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
              </div>
              <input type="hidden" name="price_min" value="<?php echo $this->_var['price_min']; ?>" />
              <input type="hidden" name="price_max" value="<?php echo $this->_var['price_max']; ?>" />
            </li>
            <?php endif; ?> 
            
            <?php $_from = $this->_var['filter_attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'filter_attr_0_89795300_1499381795');if (count($_from)):
    foreach ($_from AS $this->_var['filter_attr_0_89795300_1499381795']):
?>
            <li class="new-ul-li"> <a href="javascript:void(0)" onclick="showHideFilter(this)" class="new-li-a on"><?php echo htmlspecialchars($this->_var['filter_attr_0_89795300_1499381795']['filter_attr_name']); ?></a>
              <div class="new-pop-sel" style="-webkit-transform-origin: 0px 0px; opacity: 1; -webkit-transform: scale(1, 1); display:none;">
                <ul>
                  
                  <?php $_from = $this->_var['filter_attr_0_89795300_1499381795']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
    foreach ($_from AS $this->_var['attr']):
?>
                  
                  <li><a href="javascript:void(0);" onclick="selectExpandSort(this)" data="<?php echo $this->_var['attr']['attr_id']; ?>" class="filter_attr <?php if ($this->_var['attr']['selected']): ?>on<?php endif; ?>"               ><span><?php echo $this->_var['attr']['attr_value']; ?></span></a></li>
                  
                  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                </ul>
              </div>
            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            <input type="hidden" name="filter_attr" value="<?php echo $this->_var['filter_attr']; ?>"/>
            <?php endif; ?> 
            
            
          </ul>
        </div>
      </div>
    </div>
  </div>
</form>

</body></html>