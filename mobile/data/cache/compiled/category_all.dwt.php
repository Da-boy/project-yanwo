<?php echo $this->fetch('library/page_header.lbi'); ?>
<header id="header">
  <div class="header_l header_return"> <a href="javascript:history.go(-1);"><span></span></a></div>
  <h1>商品分类</h1>
  <div class="header_r header_search"> <a class="new-a-jd" onClick="showSearch()"><span></span></a></div>
  <div id="search_box">
    <?php echo $this->fetch('library/page_menu.lbi'); ?>
  </div>
</header>
<div class="header-px"></div>
<div class="new-cate-srch">
	<div class="new-srch-box">
    	<form method="post" action="<?php if ($this->_var['id']): ?><?php echo url('category/index', array('id'=>$this->_var['id'] ));?><?php else: ?><?php echo url('category/index');?><?php endif; ?>" name="searchForm" id="searchForm_id">
        	<input placeholder="<?php echo $this->_var['lang']['no_keywords']; ?>" name="keywords" type="text" id="keywordBox" class="new-srch-input" style="color:#999999;" />
            <a href="javascript:void(0);" target="_self" class="new-s-close"></a>
        	<button class="new-s-srch" type="submit" onclick="return check('keywordBox')"><span></span></button>
      	</form>
    </div>
</div>
<div class="clist">
  <ul class="new-category-lst">
    <?php $_from = $this->_var['category']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['no'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['no']['iteration']++;
?>
    <li class="crow level1">
      <div class="crow_row">
        <div class="crow_icon"><span class="icon"></span></div>
        <div class="crow_title"> <?php if ($this->_var['cat']['cat_id']): ?> <span><?php echo htmlspecialchars($this->_var['cat']['name']); ?></span> <?php else: ?> <span><a href="<?php echo $this->_var['cat']['url']; ?>"><?php echo htmlspecialchars($this->_var['cat']['name']); ?></a></span> <?php endif; ?> </div>
        <div>&nbsp;</div>
      </div>
      <ul class="clist_sub clearfix" style="opacity: 1; display: none;">
        <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');$this->_foreach['no1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['no1']['total'] > 0):
    foreach ($_from AS $this->_var['child']):
        $this->_foreach['no1']['iteration']++;
?>
        <?php if ($this->_foreach['no1']['iteration'] % 3 == 1): ?>
        <li class="new-category2-li"> 
        <?php endif; ?>
        <a href="<?php echo $this->_var['child']['url']; ?>"><span class="new-bar"></span><?php echo htmlspecialchars($this->_var['child']['name']); ?></a>
        <?php if ($this->_foreach['no1']['iteration'] % 3 == 0 || ($this->_foreach['no1']['iteration'] == $this->_foreach['no1']['total'])): ?>
        </li>
		<?php endif; ?>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
    </li>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
</div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>