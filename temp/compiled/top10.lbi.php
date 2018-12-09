<div id="weekRank" class="m rank">
  <div class="mt">
    <h2>一周销量排行</h2>
  </div>
  <div class="mc">
    <ul class="tabcon">
      <?php $_from = $this->_var['top_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');$this->_foreach['top_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['top_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods']):
        $this->_foreach['top_goods']['iteration']++;
?>
      <li class="<?php if ($this->_foreach['top_goods']['iteration'] < 4): ?>fore<?php echo $this->_foreach['top_goods']['iteration']; ?><?php endif; ?><?php if ($this->_foreach['top_goods']['iteration'] == 1): ?> fore<?php endif; ?>"><span><?php echo $this->_foreach['top_goods']['iteration']; ?></span>
        <div class="p-img" style="<?php if ($this->_foreach['top_goods']['iteration'] == 1): ?>display: block;<?php endif; ?>"><a target="_blank" href="<?php echo $this->_var['goods']['url']; ?>"><img alt="<?php echo htmlspecialchars($this->_var['goods']['name']); ?>" src="<?php echo $this->_var['goods']['thumb']; ?>" width="50" height="50"></a></div>
        <div class="p-name"><a target="_blank" href="<?php echo $this->_var['goods']['url']; ?>"><?php echo $this->_var['goods']['short_name']; ?></a></div>
        <div class="p-price" style="<?php if ($this->_foreach['top_goods']['iteration'] == 1): ?>display: block;<?php endif; ?>"><strong><?php echo $this->_var['goods']['price']; ?></strong></div>
      </li>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
  </div>
</div>
