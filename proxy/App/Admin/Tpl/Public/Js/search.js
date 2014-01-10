$(function(){
	var search = $("form[name=search]");
	var word = $("input[type=text][name=word]",search);
	word.focus(function(){
		if($(this).val() == "请输入搜索内容")
			$(this).val("");
	});
	word.blur(function(){
		if($(this).val() == "")
			$(this).val("请输入搜索内容");
	});
	search.submit(function(){
		if(word.val() == "请输入搜索内容"){
			$.dialog({
			    "msg":"请输入搜索内容！",
	    		"type":"error",
	    		"timeout":2,
	   			"close_handler":function(){}
			});
			return false;
		}
	});
});