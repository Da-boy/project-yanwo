$(function(){
	
	$("#slide").slide({titCell:".slide-controls span",mainCell:".slide-items",titOnClassName:"curr",autoPlay:true});
	
	$("#bargain .cat-tab-item").mouseenter(function(){
		$("#bargain .cat-tab-item").removeClass("curr");
		$(this).addClass("curr");
	})
	
	
	
  setInterval(function(){
      $(".endtime").each(function(){
        var obj = $(this);
        var endTime = new Date(parseInt(obj.attr('value')) * 1000);
		var show_day =  obj.attr('showday');
        var nowTime = new Date();
        var nMS=endTime.getTime() - nowTime.getTime() + 28800000;
        var myD=Math.floor(nMS/(1000 * 60 * 60 * 24));
		var myH_show=Math.floor(nMS/(1000*60*60) % 24);
        var myH=Math.floor(nMS/(1000*60*60));
        var myM=Math.floor(nMS/(1000*60)) % 60;
        var myS=Math.floor(nMS/1000) % 60;
        var myMS=Math.floor(nMS/100) % 10;
		var a = myH+myM+myS+myMS;
        if(a>0){
			if(show_day == 'show')
			{
		
				var str = '<span>还剩：</span><span class="num">'+myD+'</span>天<span class="num">'+myH_show+'</span>小时<span class="num">'+myM+'</span>分<span class="num">'+myS+'</span>秒'
				//var str = '还剩<strong class="tcd-d">'+myD+'</strong>天<strong class="tcd-h">'+myH_show+'</strong>小时<strong class="tcd-m">'+myM+'</strong>分<strong class="tcd-s">'+myS+'</strong>秒';
			}
			else
			{
		
				var str = '剩余<b>'+myH+'</b>小时<b>'+myM+'</b>分<b>'+myS+'</b>秒';
			}
        }else{
			var str = "已结束！";	
		}
		obj.html(str);
      });
    }, 100);
	
	$(".scroll").slide({mainCell:".con ul",autoPage:true,effect:"left",vis:9,scroll:6,prevCell:"#prev1",nextCell:"#next1",pnLoop:false});
	
	$(".top1 .tab li").mouseenter(function(){
		$(this).parent().find("li").removeClass("curr");
		$(this).addClass("curr");
		var a = $(this).parent().find("li").index($(this));
		$(this).parents(".top1").find(".tabcon").addClass("hide");
		$(this).parents(".top1").find(".tabcon").eq(a).removeClass("hide");
	})
	
	$("#sortlist_cat .item h3").click(function(){
		if($(this).parent().hasClass("current"))
		{
			$(this).parent().removeClass("current")
		}
		else
		{
			$(this).parent().addClass("current")
		}
	})
	
	var a = 0;
	$("#select .prop-attrs").each(function(){
		a+=$(this).height();
	});
	
	if(a <= 96)
	{
		$(".attrsBox").height("auto")
		$("#moreProp").hide();	
	}
	else
	{
		$("#advanced").addClass("hide");	
	}

	
	$("#moreProp .attr-extra").click(function(){
		if(!$(this).hasClass("open"))
		{
			$(".attrsBox").height("auto");
			$(this).addClass("open");
			$("#moreProp .attr-extra").html("<div>收起<b></b></div>");	
		}
		else
		{
			$(".attrsBox").height(96);
			$(this).removeClass("open");
			$("#moreProp .attr-extra").html("<div>更多选项<b></b></div>");	
		}
	})
	
	$("#maybe-like .mc").slide({mainCell:"#guess-scroll ul",effect:"leftLoop",vis:5,scroll:5});

})