$(function(){
	$(".copy").each(function(){//给每个a标签加上copy样式
		var copyButton = "copy";
	    var textInput = "becopied";
        var thisId = this.id.replace(copyButton,"");
		var ptr = $(this).parents("tr");
		var url = ptr.children("td:nth-child(6)").html()+"/"+ptr.children("td:nth-child(3)").html();
		$(this).zclip({
	        path:PUBLIC+"/js/ZeroClipboard.swf",
	        copy:"[flash]http://afp.qiyi.com/main/c?db=qiyiafp&bid=1,1,1&cid=1,1,1&sid=0&url=http://player.qlyewu.com/cmp.swf?&url=config/6400.xml&lists="+LIST_WEBSITE+url.replace(/<wbr>/ig,"")+LIST_FIX+"&.swf|626|500[/flash]",
	        beforeCopy:function(){},//some code复制前执行
	        afterCopy:function(){
	           $.dialog({
				    "msg":"复制成功！",
		    		"type":"success",
		    		"timeout":2,
		   			"close_handler":function(){}
				})
	        }//beforeCopy afterCopy 是可选项
    	});
	});
});