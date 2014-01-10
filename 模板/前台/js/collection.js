// JavaScript Document
$(function(){
	var update=document.collect.update;
	var collection=document.collect.collection;
	var collection_typeSpan=document.getElementById("collection_type");
	var collection_type=document.collect.collection_type;
	var delete_tmp=document.getElementById("delete_tmp");
	//采集合集start
	if(collection.checked){
		collection_typeSpan.style.display="inline";
		if(window.sessionStorage){
			var xml=document.getElementById("xmlText");
			if(xml.value!=""){
				var preg=new RegExp(/(<m[\s\S]*)<\/list>/ig);
				var arr=preg.exec(xml.value);
				alert(arr[1]);
				if(collection_type[0].checked)
					var collect_value=arr[1];
				else if(collection_type[1].checked)
					var collect_value="<m label=\"<?php if($vName)echo $vName?>\">\n"+arr[1]+"</m>\n";
				sessionStorage.getItem("collection")?sessionStorage.collection+=collect_value:sessionStorage.collection=collect_value;
				xml.value="<\?xml version=\"1.0\" encoding=\"gbk\" ?>\n<list>\n"+sessionStorage.getItem("collection")+"</list>";
			}
		}else{
			alert("您的浏览器不支持这功能，请升级浏览器");
		}
	}else{
		window.sessionStorage?sessionStorage.removeItem("collection"):alert("您的浏览器不支持这功能，请升级浏览器");
		collection_typeSpan.style.display="none";
	}
	collection.onclick=function(){
		collection.checked?collection_typeSpan.style.display="inline":collection_typeSpan.style.display="none";
	}
	delete_tmp.onclick=function(){
		if(window.sessionStorage){
			collection.checked=false;
			collection_typeSpan.style.display="none";
			sessionStorage.removeItem("collection");
			alert("缓存清除成功！");
		}
	}
	//采集合集end
});