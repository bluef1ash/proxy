var validate = {
	username : false,
	pwd		 : false,
	pwded    : false,
	verify   : false,
	userunion: false,
	loginUsername : false,
	loginPwd : false
};
var msg = "";
//验证注册表单
$(function(){
	//点击更换验证码图片
	$("#verify-img").click(function() {
		$(this).attr("src", WEB + "/Index/Register/code/" + Math.random());
	});
	var alterpassword = $("form[name=alterpassword]");
	alterpassword.submit(function() {
		var isOk = validate.username && validate.pwd && validate.pwded && valdate.userunion && validate.verify;
		if(isOk)
			return true;
		//点击提交按钮依次触发失去焦点再次验证
		$("input[name=pwd]", alterpassword).trigger("blur");
		$("input[name=pwded]", alterpassword).trigger("blur");
		$("input[name=userunion]", alterpassword).trigger("blur");
		$("input[name=verify]", alterpassword).trigger("blur");
		return false;
	});
	//验证密码
	$("input[name=pwd]", alterpassword).blur(function(){
		var pwd = $(this).val();
		var span = $(this).parent().next();
		//不能为空
		if(pwd == ""){
			msg = "密码不能为空！";
			span.html(msg).addClass("error");
			validate.pwd = false;
			return;
		}
		//正则判断
		if(!/^\w{6,20}$/g.test(pwd)){
			msg = "密码必须由6-20个字母，数字，或者下划线组成！";
			span.html(msg).addClass("error");
			validate.pwd = false;
			return;
		}
		msg = "";
		validate.pwd = true;
		span.html(msg).removeClass("error");

	});
	//确认密码
	$("input[name=pwded]", alterpassword).blur(function(){
		var pwded = $(this).val();
		var span = $(this).parent().next();
		//确认密码不能为空
		if(pwded == ""){
			msg = "请确认密码！";
			span.html(msg).addClass("error");
			validate.pwded = false;
			return;
		}
		//两次密码是否相同
		if(pwded != $("input[name=pwd]", alterpassword).val()){
			msg = "两次密码不一致！";
			span.html(msg).addClass("error");
			validate.pwded = false;
			return;
		}
		msg = "";
		span.html(msg).removeClass("error");
		validate.pwded = true;
	});
	//验证验证码
	$("input[name=verify]", alterpassword).blur(function() {
		var verify = $(this).val();
		var span = $(this).next().next();
		//不能为空
		if(verify == ""){
			msg = "请输入验证码！";
			span.html(msg).addClass("error");
			validate.verify = false;
			return;
		}
		//异步验证码判断
		$.post(WEB + "/Register/ajax_code", {verify : verify}, function(status){
			if(status) {
				msg = "";
				span.html(msg).removeClass("error");
				validate.verify = true;
			} else {
				msg = "验证码错误！";
				span.html(msg).addClass("error");
				validate.verify = false;
			}
		}, "json");
	});
	//验证所在频道
	$("input[name=userunion]", alterpassword).blur(function() {
		var union = $(this).val();
		var span = $(this).parent().next();
		if(union==""){
			msg = "请输入所在频道的ID！";
			span.html(msg).addClass("error");
			validate.userunion = false;
			return;
		}
		//正则判断
		if(!/^\d{3,10}$/g.test(union)){
			msg = "所在频道的ID必须由3-10个数字组成！";
			span.html(msg).addClass("error");
			validate.userunion = false;
			return;
		}
		msg = "";
		validate.userunion = true;
		span.html(msg).removeClass("error");
	});
});