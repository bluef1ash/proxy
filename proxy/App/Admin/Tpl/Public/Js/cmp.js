//cmp加载完成回调函数
function cmp_loaded() {
	var cmpo = CMP.get("cmp");
	if (!cmpo)
		return;
	cmpo.sendEvent("view_play", cmpo.list().length);
}
function play (url, vname) {
	vars = {
        api : "cmp_loaded",
		lists : url
    };
	var htm = CMP.create("cmp", "100%", "100%", CMP4, vars, {wmode : "transparent"});
	$.modal({
		width: 626,
		height: 500,
		title: "正在播放：" + vname,
		button: true,
		button_cancel: "关闭",
		content: htm
	});
}