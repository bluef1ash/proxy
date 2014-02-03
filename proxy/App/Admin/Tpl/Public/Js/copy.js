$(function(){
	$(".copy").each(function(){//给每个a标签加上copy样式
		var copyButton = "copy";
	    var textInput = "becopied";
        var thisId = this.id.replace(copyButton, "");
		var ptr = $(this).parents("tr");
		var dates = /(\d{4}-\d{2})-\d{2}\s+\d{2}:\d{2}:\d{2}/ig.exec(ptr.children("td:nth-child(8)").html())[1].replace("-", "") + "/";
		var url = ptr.children("td:nth-child(7)").html() + dates + ptr.children("td:nth-child(3)").html();
		var userunion = ptr.children("td:nth-child(5)").html();
		$(this).zclip({
	        path : PUBLIC + "/js/ZeroClipboard.swf",
	        copy : "[flash]" + prefix + player_file + "?&url=config/" + userunion + ".xml&lists=" + LIST_WEBSITE + url.replace(/<wbr>/ig,"") + LIST_FIX + "&.swf|626|500[/flash]",
	        afterCopy:function(){
	           $.dialog({
				    "message" : "复制成功！",
		    		"type" : "success",
		    		"timeout" : 2
				})
	        }//beforeCopy afterCopy 是可选项
    	});
	});
});