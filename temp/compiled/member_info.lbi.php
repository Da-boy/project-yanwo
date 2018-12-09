<?php if ($this->_var['user_info']): ?>
<li class="fore1" id="loginbar"><?php echo $this->_var['user_info']['username']; ?>，<?php echo $this->_var['lang']['welcome']; ?>！<a href="user.php?act=logout" class="link-logout">[退出]</a></li>
<?php else: ?>
<li class="fore1" id="loginbar"><span><a href="user.php">[请登录]</a> <a href="user.php?act=register" class="link-regist">[免费注册]</a></span></li>
<?php endif; ?>        
            
