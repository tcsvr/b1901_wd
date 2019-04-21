	//滚动条事件改变导航背景色
	var head_scroll=document.getElementById('head_scroll');

	document.onscroll=function(){
		var scroll_top=document.body.scrollTop || document.documentElement.scrollTop;
		if(scroll_top>$('#con').height()){
			head_scroll.style.background='rgba(21,24,27,1)';
		}
		if(scroll_top<$('#con').height()){
			head_scroll.style.background='rgba(21,24,27,0.3)';
		}
		
	}
