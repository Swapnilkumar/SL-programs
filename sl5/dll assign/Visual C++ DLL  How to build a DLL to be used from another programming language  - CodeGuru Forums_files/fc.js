//  Copyright (c) 2010 QuinStreet Inc. All Rights Reserved.
//  prod:45
if(typeof zzPage_obj=='undefined'){
zzPage_obj=new Object();
}
function F5(i7){
var t3=i7.toString().match(/function\s+(\w*)/)[1];
if((t3==null)||(t3.length==0)){
return "anonymous();";
}
else{
return t3+"();";
}}
function U5(){
var t6="";
for(var a=arguments.caller;a!=null;a=a.caller){
t6+=F5(a.callee);
if(a.caller==a)break;
}
return t6;
}
function U1(){
var v1="";var t3="anonymous();";var b6=0;
window.onerror=null;
for(var i=0;i<arguments.length;i++){
v1+='a'+i+'='+arguments[i]+';';
if(i==2){
b6=escape(arguments[i]);
}}
v1=U5()+v1;
if(navigator.cookieEnabled){
v1=v1+'c='+navigator.cookieEnabled+';';
}
v1=v1+"C="+document.cookie+";";
if(document.cookie.indexOf('QUADERROR')==-1){
var b0=new Object();
U4('QUADERROR',b6,259200000,b0);
var m7=new Image();
m7.src='http://l1.cdn.qnsr.com/log/ERR.gif?v=./ar/lite/e1/v45/;'+v1+'b='+navigator.userAgent+';'+Math.random();
}
window.onerror=U1;
return true;
}
function F4(i2,k7,b0){
if(!b0.v3[i2]||k7){
var r0=document.cookie;var t2=new Array();var g4=new Array();
t2=r0.split(';');
var f7=(t2!=null)?t2.length:0;
for(var i=0;i<f7;i++){
t2[i]=t2[i].replace(/^\s/,'');
g4=t2[i].split('=');
b0.v3[g4[0]]=g4[1];
}}
if(b0.v3[i2]){return b0.v3[i2];}
else{return '';}
}
function U4(i1,m6,k4,b0){
if(b0.v2.indexOf('OPT_OUT')==-1){
var t4=new Date();var t0;
if(typeof k4=='undefined'||k4==-1){
t0="Thu,01-Jan-1970 00:00:01 GMT";
}
else{
t4.setTime(t4.getTime()+k4);
t0=t4.toGMTString();
}
if((typeof b0.t1!='undefined')&&(b0.t1==1)){
document.cookie=i1+'='+m6+';expires='+t0+';path=/;';
}
else{
document.cookie=i1+'='+m6+';expires='+t0+';domain=.qnsr.com;path=/;';
}}}
function zz_lc_ChkFCapCookie(m5,b3,i1,b0){
var i0;var r0=F4(i1,true,b0);var i;var m1;var y2=0;var b2=new Date();
if(r0!=""){
i0=r0.split(":");
for(i=0;i<i0.length;i++){
m1=i0[i].split(",");
if(m1[0]==m5){
y2=1;
if(b2.valueOf()<m1[2]&&b3>m1[1]){
return 1;
}
else{
return-1;
}}}}
if(!y2){
return 0 
}}
function zz_lc_SetFCapCookie(i5,k5,g5,b3,i1,b0){
var b2=new Date();var r0;var i0;var y2=0;var r2=0;var f4=1000 * 60 * 60 * 24 * g5;var t0=new Date(b2.valueOf()+f4);var i;var i3="";var m1;var k1;
m1=i5+""+k5;
var g3=0;
r0=F4(i1,true,b0);
var t8=N4(r0);
if(r0!=t8){
r0=t8;
g3=1;
}
if(r0!=""){
i0=r0.split(":");
for(i=0;i<i0.length;i++){
if(i0[i]!=""){
k1=i0[i].split(",");
if(k1[0]==m1){
y2=1;
i3
+=m1+","+(parseInt(k1[1])+1)+","+t0.valueOf()+":";
g3=1;
}
else{
i3+=i0[i]+":";
}}}
r2=F7(r0);
}
if(!y2){
i3+=m1+",1,"+t0.valueOf()+":";
g3=1;
}
if(r2<t0.valueOf()){
f4=t0.valueOf()-b2.valueOf();
}
if(g3){
U4(i1,i3,f4,b0);
}}
function zzChkFCapCookie(m5,b3,i1,b0){
if(typeof b0!='undefined'){
return zz_lc_ChkFCapCookie(m5,b3,i1,b0);
}}
function zzSetFCapCookie(i5,k5,g5,b3,i1,b0){
if(typeof b0!='undefined'){
return zz_lc_SetFCapCookie(i5,k5,g5,b3,i1,b0);
}}
function N4(r3){
var i0;var i;var k1;var b2=new Date();var r0="";
if(r3!=""){
i0=r3.split(":");
for(i=0;i<i0.length;i++){
k1=i0[i].split(",");
if(k1[2]>=b2.valueOf()){
r0+=i0[i]+":";
}}}
return r0;
}
function F7(r3){
var i0;var i;var k1;var r2=0;
i0=r3.split(":");
for(i=0;i<i0.length;i++){
k1=i0[i].split(";");
if(k1[3]>r2){
r2=k1[2];
}}
return r2;
}
function zzSetGeoCookiesIframe(b0){
if((typeof b0.zzSet_geo!='undefined'||typeof b0.zzSet_rich!='undefined')&&(b0.zzSet_geo==1||b0.zzSet_rich==1)){
var zzRandom=F1();
if(b0.v2.indexOf('OPT_OUT')==-1){
if(b0.zzSet_geo==1){
var f5=new Image();
f5.src='http://o1.qnsr.com/init/'+F1()+'/g.gif';
}
if(b0.zzSet_rich==1){
if(document.all&&!b0.y1&&!b0.b4){
b0.g0=U3(b0);
}
else{
b0.g0=N2();
}
U4('QUADIDX',g0,15552000000,b0);
}}
b0.zzSet_geo=0;
b0.zzSet_rich=0;
}}
function zzSetGeoCookiesPublisherDomain(b0){
if((typeof b0.zzSet_geo!='undefined'||typeof b0.zzSet_rich!='undefined')&&(b0.zzSet_geo==1||b0.zzSet_rich==1)){
var zzRandom=F1();
if(b0.v2.indexOf('OPT_OUT')==-1){
if(b0.zzSet_geo==1){
document.write("<SC"+"RIPT LANGUAGE='JavaScript' SRC='http://o1.qnsr.com/init/"+zzRandom+"/g.js'><\/SCR"+"IPT>");
}
if(b0.zzSet_rich==1){
if(document.all&&!b0.y1&&!b0.b4){
b0.g0=U3(b0);
}
else{
b0.g0=N2();
}
U4('QUADIDX',g0,15552000000,b0);
}}
b0.zzSet_geo=0;
b0.zzSet_rich=0;
}}
function zzSetGeoCookies(b0){
if((typeof b0.t1!='undefined')&&(b0.t1==1)){
zzSetGeoCookiesPublisherDomain(b0);
}
else{
zzSetGeoCookiesIframe(b0);
}}
function N1(d3){
return d3 & 255;
}
function F3(d3){
return(d3>>14)& 1023;
}
function F2(d3){
return(d3>>8)& 63;
}
function zzIndexOfList(ll,obj){
for(var i=0;i<ll.length;i++){
if(ll[i]==obj){
return i;
}}
return-1;
}
function F1(){
var y4=(Math.random()* 9876543210);
y4=y4.toString().split('.');
return parseInt(y4[0]);
}
function U3(b0){
var v8=(!b0.y1&&(b0.r1.indexOf('msie 5')!=-1)||(b0.r1.indexOf('msie 6')!=-1)||(b0.r1.indexOf('msie 7')!=-1)||(b0.r1.indexOf('msie 8')!=-1));
document.writeln('<SCR'+'IPT LANGUAGE="VBS'+'cript">');
document.writeln('on error resume next\n');
document.writeln('For i=4 to 11');
document.writeln('If Not(IsObject(CreateObject("ShockwaveFlash.ShockwaveFlash." & i)))Then');
document.writeln('Else');
document.writeln('zzFlashVersion=i');
document.writeln('End If');
document.writeln('Next');
document.writeln('</scr'+'ipt>');
var d5=navigator.javaEnabled();
g0=1;
if(d5){g0 |=2;}
if(zzFlashVersion){
g0 |=((zzFlashVersion-4)<<4);
g0 |=8;
}
return g0;
}
function N2(){
var d5=navigator.javaEnabled();
g0=1;
if(navigator.mimeTypes&&
navigator.mimeTypes["application/x-shockwave-flash"]&&
navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin){
if(navigator.plugins&&navigator.plugins["Shockwave Flash"]){
var y7=navigator.plugins["Shockwave Flash"].description;
try{
zzFlashVersion=y7.match(/(\d+)\./)[1];
}
catch(e1){
}}}
if(d5){g0 |=2;}
if(zzFlashVersion&&zzFlashVersion>=4){
g0 |=((zzFlashVersion-4)<<4);
g0 |=8;
}
return g0;
}
var d2='';
function zzrnd(ii){
return(Math.floor((Math.random()* 10000000000006)% ii));
}
function N3(d2){
var b5='';var r9='';var i4='';var k3=d2.split(':');
zzChosenCamps='';
zzChosenComp='';
zzChosenAds='';
zzRndCamp=0;
if(k3.length==3){
i4=k3[0];
if(i4!=''){
zzChosenCamps=i4.split('~');
zzRndCamp=parseInt(Math.random()* zzChosenCamps.length);
}
zzChosenComp=k3[1];
b5=k3[2];
if(b5!=''){
zzChosenAds=b5.split('~');
}}}
function N9(i2,r7,b0){
b0.r4=new Array();
b0.m3=0;
b0.m4=0;
if(b0.m3<1||r7){
var m2=''+window.location.search;var k2=new Array();var v7='';var d9='';
m2=m2.replace(/^\?/,'');
if(i2=='l'){
var g6="";
b0.m4=m2.indexOf(";l=http");
if(b0.m4!=-1){
g6=m2.substring(b0.m4+3,m2.length);
b0.m3=0;
}
return g6;
}
else{
k2=m2.split(';');
b0.m3=k2.length;
for(var i=0;i<b0.m3;i++){
if(k2[i].length>2){
v7=k2[i].split('=');
b0.r4[k2[i].substring(0,1)]=k2[i].substring(2,k2[i].length);
}}}}
if(b0.r4[i2]){return b0.r4[i2];}
else{return '';}
}
function U9(){
var k0=F0('p',false);var f0=F0('y',false);var zzSection=F0('s',false);var zzKeyword=F0('q',false);var d0=254;var v6=0;var m0=0;var zzSet_geo=0;var zzSet_rich=0;var d2=F0('d',false);
N3(d2);
var zzTrd=F0('l',true);var zzParam='';var zzRef='';
zzStr='';
var zzCountry=0;var zzMetro=0;var zzState=0;var zzFlash=0;var zzFlashVersion=0;var zzRandom=N0();var zzD=window.document;
if(zzTrd!=""){
zzTrd=unescape(zzTrd);
}
if(k0!=""){
zzParam=k0;
k0='&p='+escape(k0);
}
if(f0!=""){
f0=f0.replace(/;/g,'QQQQ');
f0=f0.replace(/&.*/,'');
var d4=f0;
f0='&y='+escape(f0);
zzRef=d4;
}
if(zzKeyword!=""){
zzKeyword=unescape(zzKeyword);
var y3=zzKeyword.replace(/&/g,'zzazz');var g7='&q='+escape(y3);
zzKeyword=';q='+escape(zzKeyword);
var zzPat=zzKeyword;}
d0=U0('qsg',false);
if(isNaN(parseInt(d0))){d0=254;}
d0=parseInt(d0);
m0=parseInt(N1(d0));
zzCountry=m0;
if(d0>255){
if(m0==27||m0==172){
zzMetro=F3(d0);
zzState=F2(d0);
}}
if(d0==254){
zzSet_geo=1;
}
zd_IDX=U0('QUADIDX',false);
if(zd_IDX==''){
zzSet_rich=1;
}
else{
zzFlash=(zd_IDX & 0x8);
zzFlashVersion=4+((zd_IDX & 0x70)>>4);
}}
function N7(b0){
var i6;
if((typeof b0.t1!='undefined')&&(b0.t1==1)){
i6=1;
}
else{
i6=0;
}
if(b0.y0!=""){
b0.y0=unescape(b0.y0);
b0.y3=b0.y0.replace(/&/g,'zzazz');
b0.g7='&q='+escape(b0.y3);
b0.y0=';q='+escape(b0.y0);
b0.zzPat=b0.y0;
}
if(!i6){
if(b0.zzTrd!=""){
b0.zzTrd=';l='+b0.zzTrd;
}}
if(b0.k0!=""){
b0.zzParam=b0.k0;
b0.zzParam=b0.zzParam.replace(/;/g,'&');
if(!i6){
b0.k0=';p='+escape(b0.zzParam);
}
else{
b0.k0='&p='+escape(b0.zzParam);
}}
if(document.URL){
b0.f0=document.URL;
b0.f0=b0.f0.replace(/;/g,'QQQQ');
b0.f0=b0.f0.replace(/&.*/,'');
b0.d4=b0.f0;
if(!i6){
b0.f0=';y='+escape(b0.f0);
}
else{
b0.f0='&y='+escape(b0.f0);
}
b0.zzRef=b0.d4;
}
if(typeof zzcompete!='undefined'){
N3(zzcompete.chosencampstr+':'+zzcompete.chosencomp+':'+zzcompete.chosenadstr);
}
b0.g2=b0.f2 * 256;
b0.d0=F4('qsg',false,b0);
if(isNaN(parseInt(b0.d0))){b0.d0=254;}
b0.d0=parseInt(b0.d0);
b0.m0=parseInt(N1(b0.d0));
b0.zzCountry=b0.m0;
if(b0.d0>255){
if(b0.m0==27||b0.m0==172){
b0.zzMetro=F3(b0.d0);
b0.zzState=F2(b0.d0);
}}
if(b0.d0==254){
b0.zzSet_geo=1;
}
b0.zzStr=b0.zzStr+'e=i;s='+b0.zzSection+b0.zzKeyword+';g='+
b0.zzCountry+';w='+b0.zzState+';m='+b0.zzMetro+';z='+F1();
b0.zd_IDX=F4('QUADIDX',false,b0);
if(b0.zd_IDX==''){
b0.zzSet_rich=1;
}
else{
b0.zzFlash=(b0.zd_IDX & 0x8);
b0.zzFlashVersion=4+((b0.zd_IDX & 0x70)>>4);
}
d2=';d=::';
if(typeof zzcompete!='undefined'){
d2=';d='+zzcompete.chosencampstr+':'+zzcompete.chosencomp+':'+zzcompete.chosenadstr;
}}
function U8(b0){
N7(b0);
if(document.layers){
b0.f0='n='+b0.f1+
';c='+b0.g1+
';s='+b0.v0+
';x='+b0.g2+
';u=j;z='+b0.F1()+';'
document.write("<a href='http://o1.qnsr.com/cgi/r?"+b0.f0+b0.k0+";y="+
zzRef+zzTrd+"'><img border='0' width='"+b0.b1+"' height='"+b0.d1+
"' src='http://o1.qnsr.com/cgi/x?"+b0.f0+"'></a>");
}
else{
b0.g2+=1;
if((typeof b0.t1!='undefined')&&(b0.t1==1)){
b0.f0='http://e1.cdn.qnsr.com/cgi/d/'+
b0.g2+
'/0/'+
b0.f1+'/'+
b0.g1+
'/i0.js?'+
';z='+F1();
document.write('<scr'+'ipt language="JavaScript" src="'+b0.f0+'"><\/sc'+'ript>');
if((typeof b0.zzSet_geo!='undefined'||typeof b0.zzSet_rich!='undefined')&&
(b0.zzSet_geo==1||b0.zzSet_rich==1)){
zzSetGeoCookies(b0);
}}
else{
b0.f0='http://e1.cdn.qnsr.com/cgi/d/'+
b0.g2+
'/0/'+
b0.f1+'/'+
b0.g1+
'/i0.html?'+
b0.k0+
b0.f0+
';s='+b0.v0+
b0.y0+
d2+
';z='+F1()+
b0.zzTrd+
';fc.js=1;';
document.write("<iframe src='"+b0.f0+"' frameborder=0 marginheight=0 marginwidth=0 scrolling='no' allowTransparency='true' width="
+b0.b1+" height="+b0.d1+"></iframe>");
}}}
function F8(b0){
b0.v6=0;
b0.g1=0;
b0.v3=new Array();
b0.m0=0;
b0.d0=254;
b0.d1=0;
b0.g2=0;
b0.y0="";
b0.y3='';
b0.f1=0;
b0.v2=F4('QIDA',true,b0);
b0.k0='';
b0.v0=0;
b0.f2=0;
b0.f0='';
b0.b1=0;
b0.r1=navigator.userAgent.toLowerCase();
b0.y1=(b0.r1.indexOf('mac')!=-1);
b0.b4=(b0.r1.indexOf('opera')!=-1);
b0.zzChosenAds='';
b0.zzChosenCamps='';
b0.zzChosenComp='';
b0.zzCountry=0;
b0.zzD=window.document;
b0.zzFlash=0;
b0.zzFlashVersion=0;
b0.zzKeyword='';
b0.zzMetro=0;
b0.zzParam='';
b0.zzPat='';
b0.zzRandom=F1();
b0.zzRef='';
b0.zzRndCamp=0;
b0.zzSection=b0.v0;
b0.zzSet_geo=0;
b0.zzSet_rich=0;
b0.zzState=0;
b0.zzStr='';
b0.zzTrd='';
b0.zz_old_error_handler=null;
}
function zzfocrender(r6,d6,y5,y6,b1,d1,k0,r5,b7){
zzflcrender(r6,d6,y5,y6,b1,d1,k0,r5,b7,1);
}
function zzflcrender(r6,d6,y5,y6,b1,d1,k0,r5,b7,t1){
var b0=new Object();
F8(b0);
if(!b0.y1){
zz_old_error_handler=window.onerror;
window.onerror=U1;
}
if(typeof r6!='undefined')b0.f1=r6;
if(typeof d6!='undefined'){b0.v0=d6;b0.zzSection=d6;}
if(typeof y5!='undefined')b0.g1=y5;
if(typeof y6!='undefined')b0.f2=y6;
if(typeof d1!='undefined')b0.d1=d1;
if(typeof b1!='undefined')b0.b1=b1;
if(typeof k0!='undefined')b0.k0=k0;
if(typeof r5!='undefined'){b0.zflag_trd=r5;b0.zzTrd=r5;}
if(typeof b7!='undefined')b0.y0=b7;
if(typeof t1!='undefined')b0.t1=t1;
var b8=parseInt(y5.replace(/\/.*/,''));
b8=((parseInt(r6)* 1000000)+b8);
zzPage_obj[b8]=b0;
U8(b0);
if(!b0.y1){
window.onerror=zz_old_error_handler;
}}
var zzBrowserDetect={
init:function(){
if(!this.alreadyLookedup){
this.zzbrowser=this.searchString(this.dataBrowser)||"An unknown browser";
this.zzversion=this.searchVersion(navigator.userAgent)
||this.searchVersion(navigator.appVersion)
||"an unknown version";
var str=''+this.zzversion;
this.zzbrowser=this.zzbrowser+" "+str.replace(/(\d).*/,'$1.x');
this.zzOS=this.searchString(this.dataOS)||"an unknown OS";
this.alreadyLookedup=1;
}
},
searchString:function(data){
for(var i=0;i<data.length;i++){
var v5=data[i].string;var i9=data[i].prop;
this.versionSearchString=data[i].versionSearch||data[i].identity;
if(v5){
if(v5.indexOf(data[i].subString)!=-1)
return data[i].identity;
}
else if(i9)
return data[i].identity;
}
},
searchVersion:function(v5){
var k8=v5.indexOf(this.versionSearchString);
if(k8==-1)return;
return parseFloat(v5.substring(k8+this.versionSearchString.length+1));
},
dataBrowser:[
{
string:navigator.userAgent,
subString:"Chrome",
identity:"Chrome"
},
{string:navigator.userAgent,
subString:"OmniWeb",
versionSearch:"OmniWeb/",
identity:"OmniWeb"
},
{
string:navigator.vendor,
subString:"Apple",
identity:"Safari",
versionSearch:"Version"
},
{
prop:window.opera,
identity:"Opera"
},
{
string:navigator.vendor,
subString:"iCab",
identity:"iCab"
},
{
string:navigator.vendor,
subString:"KDE",
identity:"Konqueror"
},
{
string:navigator.userAgent,
subString:"KONQUEROR",
identity:"Konqueror"
},
{
string:navigator.userAgent,
subString:"AOLBROWSER",
identity:"AOL"
},
{
string:navigator.userAgent,
subString:"WEBTV",
identity:"WebTV"
},
{
string:navigator.userAgent,
subString:"Firefox",
identity:"Firefox"
},
{
string:navigator.vendor,
subString:"Camino",
identity:"Camino"
},
{
string:navigator.userAgent,
subString:"Netscape",
identity:"Netscape"
},
{
string:navigator.userAgent,
subString:"MSIE",
identity:"MS Explorer",
versionSearch:"MSIE"
},
{
string:navigator.userAgent,
subString:"MICROSOFT INTERNET EXPLORER",
identity:"MS Explorer"
},
{
string:navigator.userAgent,
subString:"Gecko",
identity:"Mozilla",
versionSearch:"rv"
},
{
string:navigator.userAgent,
subString:"Mozilla",
identity:"Netscape",
versionSearch:"Mozilla"
},
{
string:navigator.userAgent,
subString:"Lynx",
identity:"Text-only"
},
{
string:navigator.userAgent,
subString:"ELinks",
identity:"Text-only"
},
{
string:navigator.userAgent,
subString:"galeon",
identity:"Galeon"
}
],
dataOS:[
{
string:navigator.userAgent,
subString:"Windows NT 6.0",
identity:"Windows Vista"
},
{
string:navigator.userAgent,
subString:"Windows_XP",
identity:"Windows XP"
},
{
string:navigator.userAgent,
subString:"Windows NT 5.1",
identity:"Windows XP"
},
{
string:navigator.platform,
subString:"Mac",
identity:"Macintosh"
},
{
string:navigator.userAgent,
subString:"iPhone",
identity:"iPhone/iPod"
},
{
string:navigator.userAgent,
subString:"AMIGA-AWEB",
identity:"Amiga"
},
{
string:navigator.userAgent,
subString:"HP-UX",
identity:"Unix"
},
{
string:navigator.userAgent,
subString:"LINUX",
identity:"Unix"
},
{
string:navigator.userAgent,
subString:"Windows NT 5.0",
identity:"Windows 2000"
},
{
string:navigator.userAgent,
subString:"Windows_NT 5.0",
identity:"Windows 2000"
},
{
string:navigator.userAgent,
subString:"Windows_2000",
identity:"Windows 2000"
},
{
string:navigator.userAgent,
subString:"Windows ME",
identity:"Windows ME"
},
{
string:navigator.userAgent,
subString:"WIN 9X",
identity:"Windows ME"
},
{
string:navigator.userAgent,
subString:"WIN95",
identity:"Windows 95"
},
{
string:navigator.userAgent,
subString:"Windows 95",
identity:"Windows 95"
},
{
string:navigator.userAgent,
subString:"Windows_95",
identity:"Windows 95"
},
{
string:navigator.userAgent,
subString:"WIN98",
identity:"Windows 98"
},
{
string:navigator.userAgent,
subString:"Windows 98",
identity:"Windows 98"
},
{
string:navigator.userAgent,
subString:"Windows_98",
identity:"Windows 98"
},
{
string:navigator.userAgent,
subString:"WINNT",
identity:"Windows NT"
},
{
string:navigator.userAgent,
subString:"Windows NT",
identity:"Windows NT"
},
{
string:navigator.userAgent,
subString:"Windows_NT",
identity:"Windows NT"
}
]
};
