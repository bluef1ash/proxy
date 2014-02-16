String.prototype.trim2 = function()
{
    return this.replace(/(^\s*)|(\s*$)/g, "");
}
function F(objid){
	return document.getElementById(objid).value;
}
function G(objid){
	return document.getElementById(objid);
}
var msgA=["msg1","msg2","msg3","msg4"];
var c=["c1","c2","c3","c4"];
var slen=[50,20000,20000,60];//允许最大字数
var num="";
var isfirst=[0,0,0,0,0,0];
function isEmpty(strVal){
	if( strVal == "" )
		return true;
	else
		return false;
}
function isBlank(testVal){		
    var regVal=/^\s*$/;
    return (regVal.test(testVal))
}
function chLen(strVal){
	strVal=strVal.trim2();
	var cArr = strVal.match(/[^\x00-\xff]/ig);
    return strVal.length + (cArr == null ? 0 : cArr.length);   	
}
function check(i){
	var iValue=F("c"+i);
	var iObj=G("msg"+i);
	var n=(chLen(iValue)>slen[i-1]);
	if((isBlank(iValue)==true)||(isEmpty(iValue)==true)||n==true){		
		iObj.style.display ="block";
	}else{		
		iObj.style.display ="none";
	}
}
function checkAll(){
	for(var i=0;i<msgA.length; i++){
		check(i+1);		
		if(G(msgA[i]).style.display=="none"){
			continue;
		}else{
			alert("填写错误,请查看提示信息！");
			return;
		}
	}
	G("form1").submit();	
}
function clearValue(i){
	G(c[i-1]).style.color="#000";
	keyUp();	
	if(isfirst[i]==0){
		G(c[i-1]).value="";
	}
	isfirst[i]=1;
}
function keyUp(){
	var obj=G("c2");
	var str=obj.value;	
	str=str.replace(/\r/gi,"");
	str=str.split("\n");
	n=str.length;
	line(n);
}
function line(n){
	var lineobj=G("li");
	for(var i=1;i<=n;i++){
		if(document.all){
			num+=i+"\r\n";
		}else{
			num+=i+"\n";
		}
	}
	lineobj.value=num;
	num="";
}
function autoScroll(){
	var nV = 0;
	if(!document.all){
		nV=G("c2").scrollTop;
		G("li").scrollTop=nV;
		setTimeout("autoScroll()",20);
	}	
}
if(!document.all){
window.addEventListener("load",autoScroll,false);
}