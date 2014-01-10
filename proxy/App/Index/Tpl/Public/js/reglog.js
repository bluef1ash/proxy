$(function(){
	//注册出弹框
	$( ".register" ).click( function () {
		var obj = $( "#register" );
		dialog( obj );
		obj.find( "input[type=submit]" ).hover( function () {
			$( this ).addClass( "reg-btn-cur" );
		}, function () {
			$( this ).removeClass( "reg-btn-cur" );
		} );
		document.getElementById("reg-uname").focus();
		return false;
	} );
	$( "#login-now" ).click( function () {
		$( "#register" ).fadeOut();
		dialog( $( "#login" ) );

		return false;
	} );
	//登录弹出框
	$( ".login" ).click( function () {
		var obj = $( "#login" );
		dialog( obj );
		obj.find( "input[type=submit]" ).hover( function () {
			$( this ).addClass( "login-btn-cur" );
		}, function () {
			$( this ).removeClass( "login-btn-cur" );
		} );
		document.getElementById("login-acc").focus();
		return false;
	} );
	$( "#regis-now" ).click( function () {
		$( "#login" ).fadeOut();
		dialog( $( "#register" ) );

		return false;
	} );
	//关闭弹出框
	$( ".close-window" ).click( function () {
		$( this ).parent().parent().fadeOut();
		$( "#background" ).hide();

		return false;
	} );
});