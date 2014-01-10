$(function(){
	if($("input[name=collection]").attr("checked")){
		$("#collection_type").css("display","inline");
		if(window.sessionStorage){
			var xml=$("#editxml");
			if(xml.val() != ""){
				var arr=/(<m[\s\S]*)<\/list>/ig.exec(xml.val());
				if ($("input[name=ctype]:radio:checked").val() == "odd") {
					var collect_value = arr[1];
				}else {
					var collect_value = '<m label="' + vname + "\">\n" + arr[1] + "</m>\n";
				}
				sessionStorage.getItem("collection")?sessionStorage.collection+=collect_value:sessionStorage.collection=collect_value;
				xml.val("<\?xml version=\"1.0\" encoding=\"utf-8\" ?>\n<list>\n"+sessionStorage.getItem("collection")+"</list>");
				$("#editxml").show().autosize();
			}
		}else{
			$.dialog({
			    "msg" : "您的浏览器不支持这功能，请升级浏览器！",
	    		"type" : "error",
	    		"timeout" : 2
			});
		}
	}else{
		if (window.sessionStorage) {
			sessionStorage.removeItem("collection");
		}else {
			$.dialog({
				"msg" : "您的浏览器不支持这功能，请升级浏览器！",
				"type" : "error",
				"timeout" : 2
			});
		}
		$("#collection_type").css("display","none");
	}
	$("input[name=collection]").click(function(){
		$(this).attr("checked") ? $("#collection_type").css("display","inline") : $("#collection_type").css("display","none");
	});
	$("#delete_tmp").click(function(){
		if(window.sessionStorage){
			$("input[name=collection]").attr("checked",false);
			$("#collection_type").css("display","none");
			sessionStorage.removeItem("collection");
			$.dialog({
				"msg" : "清除成功！",
				"type" : "success",
				"timeout" : 2
			});
		}
	});
});