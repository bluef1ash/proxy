var cmpo;
var list_xmls;
//cmp加载完成回调函数
function cmp_loaded() {
	cmpo = CMP.get("cmp");
	if (!cmpo)
		return;
	list_xml(false);
}
function list_xml(append){
	var xml = list_xmls;
	if(xml){
		cmpo.list_xml(xml, append);
	}
    cmpo.sendEvent("view_play",1);
}
function play(url, xml){
	if (url) {
		var vars = {
			api: "cmp_loaded",
			lists: url
		};
	}else {
		list_xmls = xml;
		var vars = {
			api: "cmp_loaded",
			list_delete : 1
		};
	}
	var htm = CMP.create("cmp", "100%", "100%", CMP4, vars, {wmode: "transparent"});
	$.modal({
		width: 626,
		height: 500,
		title: "正在播放：" + vname,
		button: true,
		button_cancel: "关闭",
		content: htm
	});
}
