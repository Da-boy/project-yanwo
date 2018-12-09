<div class="bigImg" id="vertical">
<div id="preview">
  <div id="spec-n1" class="jqzoom"> <a href="<?php echo $this->_var['pictures']['0']['img_url']; ?>" class="MagicZoomPlus" id="Zoomer" rel="hint-text: ; selectors-effect: false; selectors-class: img-hover; zoom-distance: 10;zoom-width: 400; zoom-height: 400;" onclick="window.open('gallery.php?id=<?php echo $this->_var['goods']['goods_id']; ?>'); return false;"><img id="midimg" src="<?php echo $this->_var['goods']['goods_img']; ?>" title="<?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?>" width="350" height="350"></a> </div>
  <div id="spec-list" > <a href="javascript:;" class="spec-control prev" id="spec-forward"></a> <a href="javascript:;" class="spec-control next" id="spec-backward"></a>
    <div class="spec-items">
      <ul class="lh">
        
        <?php if ($this->_var['pictures']): ?> 
        <?php $_from = $this->_var['pictures']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'picture');if (count($_from)):
    foreach ($_from AS $this->_var['picture']):
?>
        <li><a href="<?php if ($this->_var['picture']['img_url']): ?><?php echo $this->_var['picture']['img_url']; ?><?php else: ?><?php echo $this->_var['picture']['thumb_url']; ?><?php endif; ?>" rel="zoom-id: Zoomer" rev="<?php if ($this->_var['picture']['img_url']): ?><?php echo $this->_var['picture']['img_url']; ?><?php else: ?><?php echo $this->_var['picture']['thumb_url']; ?><?php endif; ?>"> <img alt="<?php echo $this->_var['goods']['goods_name']; ?>" src="<?php if ($this->_var['picture']['thumb_url']): ?><?php echo $this->_var['picture']['thumb_url']; ?><?php else: ?><?php echo $this->_var['picture']['img_url']; ?><?php endif; ?>" width="50" height="50" /></a> </li>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?> 
        <?php endif; ?>
      </ul>
    </div>
  </div>
  <div id="short-share">
    <div id="view-bigimg" class="fl"><b></b><a href="gallery.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" target="_blank">查看大图</a></div>
    <div id="share-list" class="share-list">
      <div class="share-bd"> <em class="share-hd">分享到：</em>
        <ul class="share-list-item clearfix">
          <div class="bdsharebuttonbox">
            <li><a href="javascript:;" id="site-sina" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博">新浪微博</a></li>
            <li><a href="javascript:;" id="site-qzone" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博">腾讯微博</a></li>
            <li><a href="javascript:;" id="site-renren" class="bds_renren" data-cmd="renren" title="分享到人人网">人人网</a></li>
            <li><a href="javascript:;" id="site-kaixing" class="bds_kaixin001" data-cmd="kaixin001" title="分享到开心网">开心网</a></li>
            <li><a href="javascript:;" id="site-douban" class="bds_douban" data-cmd="douban" title="分享到豆瓣">豆瓣</a></li>
          </div>
        </ul>
      </div>
      <div class="share-ft"><b></b></div>
    </div>
    <div class="clb"></div>
  </div>
</div>
