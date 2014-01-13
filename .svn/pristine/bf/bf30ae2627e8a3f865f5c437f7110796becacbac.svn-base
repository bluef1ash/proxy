$(function() {
	$("select[name=cate-one]").change(function(){
		//取出当前对象
		var obj = $(this);
		if(obj.index()<2){
			var entitle = obj.val();
			//异步发送
			$.post(APP +　"/Upload/get_cate", {entitle : entitle} , function(data){
				if(data){
					var option = "";
					$.each(data, function(i, k){
						option += '<option value="' + k.entitle + '">' + k.cntitle + "</option>";
				});
					obj.next().html(option).show();
				} else {
					obj.next().html("").hide();
				}
			}, "json" );
		}
		//cateID = obj.val();
	});
	var userunion = $("input[name=userunion]");
	//上传验证
	$("form[name=upload]").submit(function() {
		var cateTwo = $("select[name=cate-two]");
		if(cateTwo.firstChild() && !cateTwo.val()){
			$.dialog({
			    "msg" : "请选择分类！",
	    		"type" : "error",
	    		"timeout" : 2
			});
			return false;
		}
		if(!$("input[name=vname]").val()){
			$.dialog({
			    "msg" : "请输入影片名称！",
	    		"type" : "error",
	    		"timeout" : 2
			});
			return false;
		}
		if (!userunion.val() || userunion.val() == "请输入频道ID") {
			$.dialog({
			    "msg" : "请输入频道ID！",
	    		"type" : "error",
	    		"timeout" : 2
			});
		}
		if (!/\d{1,10}/ig.test(userunion.val())) {
			$.dialog({
			    "msg" : "频道ID只能为10位以内数字！",
	    		"type" : "error",
	    		"timeout" : 2
			});
		}
		return true;
	});
	userunion.focus(function(){
		$(this).val("");
	});
	userunion.blur(function(){
		var val = $(this).val();
		if(val == ""){
			$(this).val("请输入频道ID");
		}
	});
})