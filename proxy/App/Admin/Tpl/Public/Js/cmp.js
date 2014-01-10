var list_xml;
//cmp加载完成回调函数
function cmp_loaded() {
	var cmpo = CMP.get("cmp");
	if (!cmpo && !list_xml) {
		return;
	}
	cmpo.list_xml(list_xml, false);
	cmpo.sendEvent("view_play", cmpo.list().length);
}
function play (url,xml) {
	var vars;
	if(url){
		vars = {
	        api : "cmp_loaded",
			url : "config/6400.xml",
			lists : url
	    }; 
	}else{
		list_xml = xml;
		vars = {
	        api : "cmp_loaded",
			url : "config/6400.xml"
	    };
	}
	players(CMP4,vars);
}
function players(player_x,vars){
	var htm = CMP.create("cmp", "100%", "100%", player_x, vars, {
		wmode: "transparent"
	});
	$.modal({
		width: 626,
		height: 500,
		button: true,
		content: htm
	});
}