window.onload=function(){
	//轮播图
	//通过一张图片获取它等比例缩放的高
	var img_one=document.getElementById('img_one');
	//容器和li的宽
	// $('#con,#con ul li').css({width:document.body.scrollWidth+'px'});
	$('#con,#con ul li').css({width:document.body.clientWidth+'px'});

	//容器和li的高
	$('#con,#con ul li').css('height',img_one.offsetHeight+'px');

	var Uliw=$('#con ul li').width();
	var liLeng=$('#con ul li').length;

	for(var i=1; i<liLeng; i++){
		if(i==1){
			$('#con ol').append('<li class="oli"></li>');
		}else{
			$('#con ol').append('<li></li>');
		}
	}


	var oliLeng=$('#con ol li').length;
	var set=setInterval(nextplay,2000);
	var i=0;

	$('#con ul').css({width:Uliw*liLeng+'px'});

	$('#con ol li').mouseover(function(){
		i=$(this).index();
		$('#con ol li').removeClass('oli');
		$(this).addClass('oli');
		$('#con ul').animate({left:'-'+(Uliw*i)+'px'},500);
	});

	function nextplay(){
		i++;
		if(i>(liLeng-1)){
			$('#con ul').css({left:0}).stop().animate({left:'-'+(Uliw)+'px'},500);
			$('#con ol li').removeClass('oli');
			$('#con ol li').eq(i-(liLeng-1)).addClass('oli');
			i=1;
		}else{
			$('#con ul').stop().animate({left:'-'+(Uliw*i)+'px'},500);
			$('#con ol li').removeClass('oli');
			$('#con ol li').eq(i).addClass('oli');
			if(i==(liLeng-1)){
				$('#con ol li').removeClass('oli');
				$('#con ol li').eq(i-(liLeng-1)).addClass('oli');
			}
		}
	}


	$('#next').click(function(){
		nextplay();
	});

	$('#prev').click(function(){
		i--;
		if(i<0){
			$('#con ul').css({left:'-'+(Uliw*(liLeng-1))+'px'}).stop().animate({left:'-'+(Uliw*(liLeng-2))+'px'},500);
			$('#con ol li').removeClass('oli');
			$('#con ol li').eq(oliLeng-1).addClass('oli');
			i=liLeng-2;
		}else{
			$('#con ul').stop().animate({left:'-'+(Uliw*i)+'px'},500);
			$('#con ol li').removeClass('oli');
			$('#con ol li').eq(i).addClass('oli');
		}
	});

	$('#con').mouseover(function(){
		$('#con a').css({display:'block'});
		clearInterval(set);
	});
	$('#con').mouseout(function(){
		$('#con a').css({display:'none'});
		set=setInterval(nextplay,2000);
	});
}