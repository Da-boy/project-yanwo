$(function(){
	/*首页顶部幻灯片切换*/
	
	if(screen.width > 1210 && $(window).width() > 1210)
	{
		$("#slide").slide({titCell:".slide-controls-w span",mainCell:".slide-items-w",titOnClassName:"curr",autoPlay:true});
	}
	else
	{
		$("#slide").slide({titCell:".slide-controls-s span",mainCell:".slide-items-s",titOnClassName:"curr",autoPlay:true});
	}
	
	/*首页顶部幻灯片下方左右滚动切换*/
	
	$("#mscroll").slide({prevCell:"#mscroll-ctrl-prev",nextCell:"#mscroll-ctrl-next",effect:"leftLoop",mainCell:"#mscroll-list ul",autoPlay:true,vis:3,scroll:3});
	
	
	/*活动发货单订单投票切换*/
	
	$("#txtMarquee-top").slide({mainCell:"#brtup1ul",autoPlay:true,effect:"topMarquee",vis:3,interTime:50});
	
	$("#virtuals-2014").slide({titCell:".mt li",mainCell:".mc",titOnClassName:"current"});
	
	$("#showcase .sc-list .item .s-img img").mouseenter(function(){
		$(this).stop(true,false).animate({left:"-10px"},30);
	})
	$("#showcase .sc-list .item .s-img img").mouseleave(function(){
		$(this).stop(true,false).animate({left:"0px"},30);
	})
	
	/*分类下商品分类标题滑动效果*/
	
	$(".plist .tab-item .smt").mouseenter(function(){
		var l = $(this).css("left");
		$(this).parents(".plist").find(".tab-arrow").stop(true,false).animate({left:l},500);
		$(this).parents(".plist").find(".tab-item").removeClass("curr");
		$(this).parent().addClass("curr");
	})

	/*分类下商品分类内容切换效果*/
	
	$(".cat_goods").each(function(){
		var a = $(this).val();
		$("#cat_slide_"+a).slide({titCell:".slide-controls span",effect:"leftLoop",delayTime:200,mainCell:".slide-items",titOnClassName:"curr"});
		$("#brand_slide_"+a).slide({titCell:".slide-controls span",effect:"leftLoop",delayTime:200,mainCell:".slide-items",titOnClassName:"curr"});
	})
	
	
	$("#share").slide({mainCell:".mc ul",autoPage:true,effect:"top",autoPlay:true,vis:2});
	
	$("#index_comment").slide({mainCell:".mc ul",autoPage:true,effect:"top",autoPlay:true,vis:2});

})