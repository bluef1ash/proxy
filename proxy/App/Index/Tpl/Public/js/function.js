function dialog (obj) {
	obj.removeClass('hidden').css( {
		left : ( $( window ).width() - obj.width() ) / 2,
		top : $( document ).scrollTop() + ( $( window ).height() - obj.height() ) / 2
	} ).fadeIn();
	$( '#background' ).css( {
		opacity : 0.3,
    	filter : 'Alpha(Opacity = 30)',
		height : $( document ).height()
	} ).removeClass('hidden').show();
}
$.fn.autosize = function(){
	$(this).height('0px');
	var setheight = $(this).get(0).scrollHeight;
	if($(this).attr("_height") != setheight)
		$(this).height(setheight+"px").attr("_height",setheight);
	else
		$(this).height($(this).attr("_height")+"px");
}
function re (value) {
	var val = escape($("#"+value).val());
	location = APP+"/Index/parse?url="+val;
}
function curl (url) {
	var web = APP+"/Common/url?url="+url;
	window.open(web);
}
/*
function copy (id,text) {
	$("#"+id).zclip({
        path:PUBLIC+'/js/ZeroClipboard.swf',
        copy:text,
        beforeCopy:function(){//some code复制前执行
        },
        afterCopy:function(){
           $.dialog({
			    "msg":"复制成功！",
	    		"type":"success",
	    		"timeout":2,
	   			"close_handler":function(){}
			})
        }//beforeCopy afterCopy 是可选项
    });
}
*/