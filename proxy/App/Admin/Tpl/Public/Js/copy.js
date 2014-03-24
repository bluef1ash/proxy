$(function(){
	$(".copy").each(function(){//给每个a标签加上copy样式
		var copyButton = "copy";
	    var textInput = "becopied";
        var thisId = this.id.replace(copyButton, "");
		var ptr = $(this).parents("tr");
		var vid = ptr.children("td:nth-child(1)").html();
		var userunion = ptr.children("td:nth-child(4)").html();
		$(this).zclip({
	        path : PUBLIC + "/Js/ZeroClipboard.swf",
	        copy : "[flash]" + prefix + player_file + "?url=config/" + userunion + ".xml&lists=lists={Sjlb}" + vid + LIST_FIX + "&.swf|626|500[/flash]",
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