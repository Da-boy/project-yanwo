<?php echo $this->fetch('library/page_header.lbi'); ?>
<a class="back" onclick="javascript:history.go(-1);"></a>
<div class="blackbox">
    <img src="themes/99yanwo/image/fuli/click.png" class="black-img">
</div>
<div id="addBox" style="display: none;">        </div>
<div class="new_bg">
    <div>
    <img src="themes/99yanwo/image/fuli/share-img1.png">
        <?php if ($this->_var['is_receive'] == 1): ?>
           <div class="new-head">
                <p>您的100元优惠券已领取</p>
                <p class="new-head2">现炖及時送 3小时极速送达</p>
           </div>
        <?php else: ?>
           <div class="new-head">
               <p>【新人专享】您的100元未领取</p>
               <input type="button" onclick="new_user_get_vouchers(<?php echo $this->_var['user_id']; ?>)" value="点击领取">
           </div>
        <?php endif; ?>
        <a class="new-youhui"  href="<?php echo url('user/bonus');?>">我的优惠券 ></a>
    </div>
    <p class="new-title1">产自燕窝三大黄金产区之一</p>
    <p class="new-title2">来自東经99度的轻奢味道</p>
    <ul class="new-content1" style="margin-top:1rem;padding:0 4%;position:relative">
        <li class="sell_imgicon">
          <img src="<?php echo $this->_var['goods']['goods_thumb']; ?>" />
        </li>
        <li class="sell-info">
            <p class="sell-p1" style="margin-top:0.2rem;"><?php echo $this->_var['goods']['goods_name']; ?></p>
            <p class="sell-p2" style="color:#ff2741;">限天津市内六区，不参加店内其他活动</p>
             <div class="sell-tag">
                <span>新人专享</span>
                <span>限每人一份</span>
            </div>
             <div class="sell-del">
               <span>原价</span><?php echo $this->_var['goods']['market_price']; ?>
               <div class="though"></div>
            </div>
            <div class="sell-money-fir">
                <span>抢鲜价</span>
                <span><?php echo $this->_var['goods']['shop_price_formated']; ?></span>
            </div>
        </li>
        <a class="new-link" href="/mobile/index.php?m=default&c=goods&a=index&id=<?php echo $this->_var['goods']['goods_id']; ?>"></a>
          <form action="javascript:addToCart_quick(<?php echo $this->_var['goods']['goods_id']; ?>)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY153" class="demoform">
              <input type="submit"  value=""  class="new-buy"/>
          </form>
    </ul>
    <!--<p class="new-title2">领券后可购买</p>
    <ul class="new-content2">
        <li><img src="themes/99yanwo/image/sell/img1.jpg" /></li>
        <li><img src="themes/99yanwo/image/sell/img2.jpg" /></li>
        <li><img src="themes/99yanwo/image/sell/img3.jpg" /></li>
    </ul>-->
<?php echo $this->fetch('library/nav_footer.lbi'); ?>
<div id="prompt_box" style="display:none">
    <span>已经享受该优惠信息！</span>
</div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
<script type="text/javascript">
/*弹框弹出方法*/
function showBom(){
document.getElementById('prompt_box').style.display = 'block';
setTimeout(function(){$("#prompt_box").animate({opacity:"0"},1500);},3000);
}

/* *
 * 新人领取优惠券操作
 */
function new_user_get_vouchers(userId) {
        console.log(userId);
        if(!userId){
            var url = 'index.php?m=default&c=user&a=login';
            window.location.href = url;
        }else{
            $.ajax({
                url:'index.php?m=default&c=fuli&a=receive_new_user_vouchers',
                type:'POST', //GET
                async:true,    //或false,是否异步
                data:{
                    user_id:userId
                },
                timeout:5000,    //超时时间
                dataType:'json',    //返回的数据格式：json/xml/html/script/jsonp/text
                success:function(data){
                if(data.error ==true){
                    var addAlert = document.getElementById("addBox");
                    addAlert.innerHTML = data.message;
                    addAlert.style.display="block";
                    var t = setTimeout("hide()",2000);
                    location.reload();
                }else {
                    var addAlert = document.getElementById("addBox");
                    addAlert.innerHTML = data.message;
                    addAlert.style.display="block";
                    var t = setTimeout("hide()",2000);
                }

                },
                error:function(xhr,textStatus){
                    console.log('错误')
                },
                complete:function(){
                    console.log('结束')
                }
            })
        }
}
function hide(){
    var addAlert = document.getElementById("addBox");
    addAlert.style.display='none';
}
</script>
</body>
</html>