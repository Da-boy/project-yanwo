<?php echo $this->fetch('library/page_header.lbi'); ?>
<div id="page">
  <header id="header">
  <div class="header_l header_return"> <a onClick="javascript:history.go(-1);"><span></span></a></div>
  <h1>登录/注册</h1>
  <div class="header_r header_search"> <a class="new-a-jd" onClick="showSearch()"><span></span></a></div>
  <div id="search_box">
    <?php echo $this->fetch('library/page_menu.lbi'); ?>
  </div>
</header>
<div class="header-px"></div>
</div>
<section class="wrap" style="border-bottom:0;">
  <div id="leftTabBox" class="loginBox InfoBox" style="background:#fafafa;">
    <div class="bd" <?php if ($this->_var['action'] == 'register'): ?> style="display:none" <?php endif; ?>>
        <div class="table_box mt20">
          <form name="formLogin" action="<?php echo url('user/login');?>" method="post" onSubmit="return userLogin()">
          	<span class="new-input-span mb15"><input placeholder="<?php echo $this->_var['lang']['username']; ?>/<?php echo $this->_var['lang']['mobile']; ?>/<?php echo $this->_var['lang']['email']; ?>" name="username" type="text"  class="inputBg" id="username" /></span>
            <span class="new-input-span mb15"><input placeholder="<?php echo $this->_var['lang']['label_password']; ?>"  name="password" type="password" class="inputBg" /></span>
            <dl>
              <dd>
            <span><input placeholder="<?php echo $this->_var['lang']['no_code']; ?>"  name="captcha" class="inputBg captcha"  id="captcha" type="text" /></span><img class="pull-right" src="<?php echo url('public/captcha', array('rand'=>$this->_var['rand']));?>" alt="captcha" style="height:34px;vertical-align: middle; margin-left:5px;" onClick="this.src='<?php echo url('public/captcha');?>&t='+Math.random()"  />
             </dd>
            </dl>
            <dl>
              <dd>
                <input type="checkbox" value="1" name="remember" id="remember" style="vertical-align:middle; zoom:150%;" /><label for="remember"> <?php echo $this->_var['lang']['remember']; ?></label>
              </dd>
            </dl>
            <dl>
              <dd>
                <input type="hidden" name="act" value="act_login" />
                <input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
                <input type="submit" name="submit"  value="立即登陆" class="c-btn4" />
              </dd>
            </dl>
          </form>
          <div class="login-register">
            <div class="new-tbl-type">
            	<div class="new-tbl-cell"><a href="<?php echo url('user/register');?>" class="fl"><?php echo $this->_var['lang']['free_registered']; ?></a></div>
            	<div class="new-tbl-cell"><a href="<?php echo url('user/get_password_phone');?>" class="fr"><?php echo $this->_var['lang']['get_password']; ?></a></div>
            </div>
          </div>
          <div class="hezuo">
            <p class="t"><?php echo $this->_var['lang']['third_login']; ?></p>
            <p class="b">
              <a href="<?php echo url('user/third_login',array('type'=>'qq'));?>"><img src="__TPL__/images/quicklogin/qq.png"></a> 
              <a href="<?php echo url('user/third_login',array('type'=>'qq'));?>"><img src="__TPL__/images/quicklogin/weibo.png"></a> 
              <a href="<?php echo url('user/third_login',array('type'=>'qq'));?>"><img src="__TPL__/images/quicklogin/renren.png"></a>
            </p>
          </div>
        </div>
    </div>
  </div>
</section>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
<div style="width:1px; height:1px; overflow:hidden"><?php $_from = $this->_var['lang']['p_y']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pv');if (count($_from)):
    foreach ($_from AS $this->_var['pv']):
?><?php echo $this->_var['pv']; ?><?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></div>
<script type="text/javascript">
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
<?php $_from = $this->_var['lang']['passport_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var username_exist = "<?php echo $this->_var['lang']['username_exist']; ?>";
</script>
</body>
</html>
