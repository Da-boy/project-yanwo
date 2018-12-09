<?php echo $this->fetch('library/page_header.lbi'); ?>
<div id="page">
  <header id="header">
    <div class="header_l header_return"> <a onClick="javascript:history.go(-1);"><span></span></a></div>
    <h1><?php echo $this->_var['lang']['label_regist']; ?></h1>
    <div class="header_r header_search"> <a class="new-a-jd" onClick="showSearch()"><span></span></a></div>
    <div id="search_box"> <?php echo $this->fetch('library/page_menu.lbi'); ?></div>
  </header>
  <div class="header-px"></div>
</div>
<section class="wrap" style="border-bottom:0;">
  <div id="leftTabBox" class="loginBox InfoBox" style="background:#fafafa;">
    <div class="bd"> 
      <?php if ($this->_var['enabled_sms_signin'] == 1): ?>
      <form action="<?php echo url('user/register');?>" method="post" name="formUser" onsubmit="return register2();">
        <input type="hidden" name="seccode" id="seccode" value="<?php echo $this->_var['sms_security_code']; ?>" />
        <input type="hidden" name="flag" id="flag" value="register" />
        <div class="table_box mt20 pt10"> <span class="new-input-span mb15">
          <input placeholder="<?php echo $this->_var['lang']['mobile']; ?>" class="inputBg" name="mobile" id="mobile_phone" type="text" />
          </span> <span class="new-input-span mb15">
          <input placeholder="<?php echo $this->_var['lang']['password']; ?>" class="inputBg" name="password" id="mobile_pwd" type="password" />
          </span> <span class="new-input-span mb15">
          <input placeholder="<?php echo $this->_var['lang']['label_confirm_password']; ?>" class="inputBg" name="confirm_password" id="confirm_mobile_pwd" type="password" />
          </span> <span class="new-input-span" style="position:relative;">
          <input placeholder="<?php echo $this->_var['lang']['no_code']; ?>" class="inputBg" name="mobile_code" id="mobile_code" type="text" />
          <input id="zphone" name="sendsms" type="button" value="<?php echo $this->_var['lang']['get_code']; ?>" onClick="sendSms();" class="c-btn4" style="position:absolute; top:0; right:0; width:115px;" />
          </span>
          <dl>
            <dd>
              <input id="agreement" name="agreement" type="checkbox" value="1" checked="checked" style="vertical-align:middle; zoom:150%;" />
              <label for="agreement"> <?php echo $this->_var['lang']['agreement']; ?></label>
            </dd>
          </dl>
          <dl>
            <dd>
              <input name="act" type="hidden" value="act_register" />
              <input name="enabled_sms" type="hidden" value="1" />
              <input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
              <input name="Submit" type="submit" value="<?php echo $this->_var['lang']['next']; ?>" class="c-btn4" />
            </dd>
          </dl>
        </div>
      </form>
      <?php else: ?> 
      <?php if ($this->_var['shop_reg_closed'] == 0): ?>
      <form action="<?php echo url('user/register');?>" method="post" name="formUser" onsubmit="return register();">
        <input type="hidden" name="seccode" id="seccode" value="<?php echo $this->_var['sms_security_code']; ?>" />
        <input type="hidden" name="flag" id="flag" value="register" />
        <div class="table_box">
          <dl>
            <dd>
              <input placeholder="<?php echo $this->_var['lang']['no_username']; ?>" class="inputBg" name="username" id="username" type="text" />
            </dd>
          </dl>
          <dl>
            <dd>
              <input placeholder="<?php echo $this->_var['lang']['no_emaill']; ?>" class="inputBg" name="email" id="email" type="text" />
            </dd>
          </dl>
          <dl>
            <dd>
              <input placeholder="<?php echo $this->_var['lang']['no_password']; ?>" class="inputBg" name="password" id="password1" type="password" />
            </dd>
          </dl>
          <dl>
            <dd>
              <input placeholder="<?php echo $this->_var['lang']['label_confirm_password']; ?>" class="inputBg" name="confirm_password" id="confirm_password" type="password" />
            </dd>
          </dl>
          <?php if ($this->_var['enabled_captcha']): ?>
          <dl>
            <dd>
              <input placeholder="<?php echo $this->_var['lang']['no_code']; ?>" class="inputBg" name="captcha" id="captcha" type="text" />
            </dd>
            <dd> <img src="<?php echo url('public/captcha', array('rand'=>$this->_var['rand']));?>" alt="captcha" style="height:34px;vertical-align: middle; margin-left:5px;" onClick="this.src='<?php echo url('public/captcha');?>&t='+Math.random()"  /> </dd>
          </dl>
          <?php endif; ?>
          <dl>
            <dd>
              <input id="agreement" name="agreement" type="checkbox" value="1" checked="checked" style="vertical-align:middle; zoom:200%;" />
              <label for="agreement"> <?php echo $this->_var['lang']['agreement']; ?></label>
            </dd>
          </dl>
          <dl>
            <dd>
              <input name="act" type="hidden" value="act_register" />
              <input name="enabled_sms" type="hidden" value="0" />
              <input type="hidden" name="back_act" value="<?php echo $this->_var['back_act']; ?>" />
              <input name="Submit" type="submit" value="<?php echo $this->_var['lang']['next']; ?>" class="c-btn3" />
            </dd>
          </dl>
        </div>
      </form>
      <?php else: ?>
      <ul class="radius10 itemlist">
        <div style="margin:1rem auto; text-align:center">
          <p style="font-size:0.8rem; font-weight:bold; color: red;">网站已经关闭注册功能！</p>
          <div class="blank"></div>
          <p class="info"><a href="<?php echo $this->_var['site_url']; ?>mobile"><?php echo $this->_var['lang']['back_home_lnk']; ?></a></p>
        </div>
      </ul>
      <?php endif; ?> 
      
      <?php endif; ?> 
      <?php if ($this->_var['need_rechoose_gift']): ?>
      <?php echo $this->_var['lang']['gift_remainder']; ?>
      <?php endif; ?> </div>
  </div>
</section>
<?php echo $this->fetch('library/page_footer.lbi'); ?> 