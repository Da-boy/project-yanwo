<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>



<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<?php if ($this->_var['cat_style']): ?>
<link href="<?php echo $this->_var['cat_style']; ?>" rel="stylesheet" type="text/css" />
<?php endif; ?>

<?php echo $this->smarty_insert_scripts(array('files'=>'jquery-1.9.1.min.js,jquery.json.js')); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,global.js,compare.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?> <?php echo $this->smarty_insert_scripts(array('files'=>'jd_category.js')); ?> <?php echo $this->fetch('library/ur_here.lbi'); ?>

<div class="w main">
  <div class="right-extra">
  <?php if ($this->_var['hot_goods']): ?>
    <div id="i-right" class="m">  <?php echo $this->fetch('library/recommend_hot.lbi'); ?>   <?php $this->assign('articles',$this->_var['articles_11']); ?><?php $this->assign('articles_cat',$this->_var['articles_cat_11']); ?><?php echo $this->fetch('library/cat_articles.lbi'); ?>  </div>
      <?php endif; ?> 
     
    <?php if ($this->_var['brands']['1'] || $this->_var['price_grade']['1'] || $this->_var['filter_attr_list']): ?>
    <div id="select" class="m">
      <div class="mt">
        <h1><?php echo $this->_var['cat_info']['cat_name']; ?> -<strong>&nbsp;<?php echo $this->_var['lang']['goods_filter']; ?></strong></h1>
      </div>
      <div class="mc attrs">
        <div class="attrsBox"> 
          <?php if ($this->_var['brands']['1']): ?>
          <div class="prop-attrs">
            <div class="attr">
              <div class="a-key"><?php echo $this->_var['lang']['brand']; ?>：</div>
              <div class="a-values">
                <div class="v-fold">
                  <ul class="f-list">
                    <?php $_from = $this->_var['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'brand');if (count($_from)):
    foreach ($_from AS $this->_var['brand']):
?> 
                    <?php if ($this->_var['brand']['selected']): ?>
                    <li><a href="javascript:void(0);" class="curr"><?php echo $this->_var['brand']['brand_name']; ?></a></li>
                    <?php else: ?>
                    <li><a href="<?php echo $this->_var['brand']['url']; ?>"><?php echo $this->_var['brand']['brand_name']; ?></a></li>
                    <?php endif; ?> 
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?> 
          
          <?php if ($this->_var['price_grade']['1']): ?>
          <div class="prop-attrs">
            <div class="attr">
              <div class="a-key"><?php echo $this->_var['lang']['price']; ?>：</div>
              <div class="a-values">
                <div class="v-fold">
                  <ul class="f-list">
                    <?php $_from = $this->_var['price_grade']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'grade');if (count($_from)):
    foreach ($_from AS $this->_var['grade']):
?> 
                    <?php if ($this->_var['grade']['selected']): ?>
                    <li><a href="javascript:void(0);" class="curr"><?php echo $this->_var['grade']['price_range']; ?></a></li>
                    <?php else: ?>
                    <li><a href="<?php echo $this->_var['grade']['url']; ?>"><?php echo $this->_var['grade']['price_range']; ?></a></li>
                    <?php endif; ?> 
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?> 
          
          <?php $_from = $this->_var['filter_attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'filter_attr_0_16016300_1498198305');if (count($_from)):
    foreach ($_from AS $this->_var['filter_attr_0_16016300_1498198305']):
?>
          <div class="prop-attrs">
            <div class="attr">
              <div class="a-key"><?php echo htmlspecialchars($this->_var['filter_attr_0_16016300_1498198305']['filter_attr_name']); ?>：</div>
              <div class="a-values">
                <div class="v-fold">
                  <ul class="f-list">
                    <?php $_from = $this->_var['filter_attr_0_16016300_1498198305']['attr_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'attr');if (count($_from)):
    foreach ($_from AS $this->_var['attr']):
?> 
                    <?php if ($this->_var['attr']['selected']): ?>
                    <li><a href="javascript:void(0);" class="curr"><?php echo $this->_var['attr']['attr_value']; ?></a></li>
                    <?php else: ?>
                    <li><a href="<?php echo $this->_var['attr']['url']; ?>"><?php echo $this->_var['attr']['attr_value']; ?></a></li>
                    <?php endif; ?> 
                    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
        </div>
        <div id="moreProp" class="mb">
          <div class="attr-extra">
            <div>更多选项<b></b></div>
          </div>
        </div>
        <div id="lessProp" class="mb hide">
          <div class="attr-extra open">
            <div>收起<b></b></div>
          </div>
        </div>
    	<div id="advanced" style="margin-bottom: 10px;" class="mb"></div>
      </div>
    </div>
    <?php endif; ?> 

     
    <?php echo $this->fetch('library/goods_list.lbi'); ?> <?php echo $this->fetch('library/pages.lbi'); ?> </div>
  <div class="left">
    <div id="sortlist_cat" class="m">
      <div class="mt">
        <h2><?php echo $this->_var['cat']['name']; ?></h2>
      </div>
      <div class="mc"> 
        <?php $_from = $this->_var['categories_left']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'cat');$this->_foreach['categories_left'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['categories_left']['total'] > 0):
    foreach ($_from AS $this->_var['cat']):
        $this->_foreach['categories_left']['iteration']++;
?>
        
        <div class="item  <?php if ($this->_var['cat']['status'] == 1): ?>current<?php endif; ?>">
          <h3><b></b><?php echo $this->_var['cat']['name']; ?></h3>
          <ul>
            <?php $_from = $this->_var['cat']['cat_id']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'child');if (count($_from)):
    foreach ($_from AS $this->_var['child']):
?>
            <li><a href="<?php echo $this->_var['child']['url']; ?>"><?php echo $this->_var['child']['name']; ?></a></li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </ul>
        </div>
        
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
      </div>
    </div>
    
    <div id="ad_left" class="m m0 hide"></div>
     <?php echo $this->fetch('library/recommend_best.lbi'); ?>  
    
    
    <div id="finalbuy" class="hide m m0"></div>
    <?php echo $this->fetch('library/top10.lbi'); ?> 
    
    <div id="alsobuy" class="hide m m0"></div>
    <div id="da211x261-1" class="m"></div>
  </div>
  <span class="clr"></span>
  <div id="Collect_Tip" class="Tip360 w260"></div>
</div>

<div class="w">
  <div id="product-track">
    <div class="right">
            	<?php echo $this->fetch('library/browse_related.lbi'); ?> 
    </div>
    <div class="left">
      	<?php echo $this->fetch('library/history.lbi'); ?> 
    </div>
    <span class="clr"></span></div>
</div>
<?php echo $this->fetch('library/help.lbi'); ?> <?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>