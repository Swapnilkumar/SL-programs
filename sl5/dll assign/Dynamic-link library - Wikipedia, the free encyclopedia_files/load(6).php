mediaWiki.loader.implement("jquery.autoEllipsis",function($,mw){
(function($){

var cache={};

var matchTextCache={};
$.fn.autoEllipsis=function(options){
options=$.extend({
'position':'center',
'tooltip':false,
'restoreText':false,
'hasSpan':false,
'matchText':null
},options);
$(this).each(function(){
var $this=$(this);
if(options.restoreText){
if(!$this.data('autoEllipsis.originalText')){
$this.data('autoEllipsis.originalText',$this.text());
}else{
$this.text($this.data('autoEllipsis.originalText'));
}
}

var $container=$this;

var $trimmableText=null;

var $protectedText=null;
if(options.hasSpan){
$trimmableText=$this.children(options.selector);
}else{
$trimmableText=$('<span />')
.css('whiteSpace','nowrap')
.text($this.text());
$this
.empty()
.append($trimmableText);
}
var text=$container.text();
var trimmableText=$trimmableText.text();
var w=$container.width();
var pw=$protectedText?$protectedText.width():0;

if(!(text in cache)){
cache[text]={};
}
if(options.matchText&&!(text in matchTextCache)){
matchTextCache[text]={};
}
if(options.matchText&&!(options.matchText in matchTextCache[text])){
matchTextCache[text][options.matchText]={};
}
if(!options.matchText&&w in cache[text]){
$container.html(cache[text][w]);
if(options.tooltip)
$container.attr('title',text);
return;
}
if(options.matchText&&options.matchText in matchTextCache[text]&&w in matchTextCache[text][options.matchText]){
$container.html(matchTextCache[text][options.matchText][w]);
if(options.tooltip)
$container.attr('title',text);
return;
}
if($trimmableText.width()+pw>w){
switch(options.position){
case'right':

var l=0,r=trimmableText.length;
do{
var m=Math.ceil((l+r)/2);
$trimmableText.text(trimmableText.substr(0,m)+'...');
if($trimmableText.width()+pw>w){

r=m-1;
}else{
l=m;
}
}while(l<r);
$trimmableText.text(trimmableText.substr(0,l)+'...');
break;
case'center':

var i=[Math.round(trimmableText.length/ 2 ), Math.round( trimmableText.length /2)];
var side=1;
while($trimmableText.outerWidth()+pw>w&&i[0]>0){
$trimmableText.text(trimmableText.substr(0,i[0])+'...'+trimmableText.substr(i[1]));

if(side==0){

i[0]--;
side=1;
}else{

i[1]++;
side=0;
}
}
break;
case'left':

var r=0;
while($trimmableText.outerWidth()+pw>w&&r<trimmableText.length){
$trimmableText.text('...'+trimmableText.substr(r));
r++;
}
break;
}
}
if(options.tooltip){
$container.attr('title',text);
}
if(options.matchText){
$container.highlightText(options.matchText);
matchTextCache[text][options.matchText][w]=$container.html();
}else{
cache[text][w]=$container.html();
}
});
};
})(jQuery);
},{},{});
mediaWiki.loader.implement("jquery.checkboxShiftClick",function($,mw){
(function($){
jQuery.fn.checkboxShiftClick=function(text){
var prevCheckbox=null;
var $box=this;

$box.click(function(e){

if(prevCheckbox!==null&&e.shiftKey){

$box.slice(
Math.min($box.index(prevCheckbox),$box.index(e.target)),
Math.max($box.index(prevCheckbox),$box.index(e.target))+1
).attr({checked:e.target.checked?'checked':''});
}

prevCheckbox=e.target;
});
return $box;
};
})(jQuery);
},{},{});
mediaWiki.loader.implement("jquery.client",function($,mw){
(function($){
$.client=new(function(){

var profile,that=this;


this.profile=function(){

if(typeof profile==='undefined'){


var uk='unknown';

var x='x';

var wildUserAgents=['Opera','Navigator','Minefield','KHTML','Chrome','PLAYSTATION 3'];

var userAgentTranslations=[

[/(Firefox|MSIE|KHTML,\slike\sGecko|Konqueror)/,''],

['Chrome Safari','Chrome'],

['KHTML','Konqueror'],

['Minefield','Firefox'],

['Navigator','Netscape'],

['PLAYSTATION 3','PS3'],
];


var versionPrefixes=[
'camino','chrome','firefox','netscape','netscape6','opera','version','konqueror','lynx',
'msie','safari','ps3'
];

var versionSuffix='(\\/|\\;?\\s|)([a-z0-9\\.\\+]*?)(\\;|dev|rel|\\)|\\s|$)';

var names=[
'camino','chrome','firefox','netscape','konqueror','lynx','msie','opera','safari','ipod',
'iphone','blackberry','ps3'
];

var nameTranslations=[];

var layouts=['gecko','konqueror','msie','opera','webkit'];

var layoutTranslations=[['konqueror','khtml'],['msie','trident'],['opera','presto']];

var layoutVersions=['applewebkit','gecko'];

var platforms=['win','mac','linux','sunos','solaris','iphone'];

var platformTranslations=[['sunos','solaris']];


function translate(source,translations){
for(var i=0;i<translations.length;i++){
source=source.replace(translations[i][0],translations[i][1]);
}
return source;
};

var userAgent=navigator.userAgent,match,name=uk,layout=uk,layoutversion=uk,platform=uk,version=x;
if(match=new RegExp('('+wildUserAgents.join('|')+')').exec(userAgent)){

userAgent=translate(userAgent,userAgentTranslations);
}

userAgent=userAgent.toLowerCase();

if(match=new RegExp('('+names.join('|')+')').exec(userAgent)){
name=translate(match[1],nameTranslations);
}
if(match=new RegExp('('+layouts.join('|')+')').exec(userAgent)){
layout=translate(match[1],layoutTranslations);
}
if(match=new RegExp('('+layoutVersions.join('|')+')\\\/(\\d+)').exec(navigator.userAgent.toLowerCase())){
layoutversion=parseInt(match[2]);
}
if(match=new RegExp('('+platforms.join('|')+')').exec(navigator.platform.toLowerCase())){
platform=translate(match[1],platformTranslations);
}
if(match=new RegExp('('+versionPrefixes.join('|')+')'+versionSuffix).exec(userAgent)){
version=match[3];
}


if(name.match(/safari/)&&version>400){
version='2.0';
}

if(name==='opera'&&version>=9.8){
version=userAgent.match(/version\/([0-9\.]*)/i)[1]||10;
}

profile={
'name':name,
'layout':layout,
'layoutVersion':layoutversion,
'platform':platform,
'version':version,
'versionBase':(version!==x?new String(version).substr(0,1):x),
'versionNumber':(parseFloat(version,10)||0.0)
};
}
return profile;
};

this.test=function(map){
var profile=that.profile();
var dir=jQuery('body').is('.rtl')?'rtl':'ltr';

if(typeof map[dir]!=='object'||typeof map[dir][profile.name]==='undefined'){

return true;
}
var name=map[dir][profile.name];
for(var condition in name){
var op=name[condition][0];
var val=name[condition][1];
if(val===false){
return false;
}else if(typeof val=='string'){
if(!(eval('profile.version'+op+'"'+val+'"'))){
return false;
}
}else if(typeof val=='number'){
if(!(eval('profile.versionNumber'+op+val))){
return false;
}
}
}
return true;
}
})();
$(document).ready(function(){
var profile=$.client.profile();
$('html')
.addClass('client-'+profile.name)
.addClass('client-'+profile.name+'-'+profile.versionBase)
.addClass('client-'+profile.layout)
.addClass('client-'+profile.platform);
});
})(jQuery);
},{},{});
mediaWiki.loader.implement("jquery.collapsibleTabs",function($,mw){
(function($){
$.fn.collapsibleTabs=function(options){

if(!this.length)return this;

var $settings=$.extend({},$.collapsibleTabs.defaults,options);
this.each(function(){
var $this=$(this);

$.collapsibleTabs.instances=($.collapsibleTabs.instances.length==0?
$this:$.collapsibleTabs.instances.add($this));

$this.data('collapsibleTabsSettings',$settings);

$this.children($settings.collapsible).each(function(){
$.collapsibleTabs.addData($(this));
});
});

if(!$.collapsibleTabs.boundEvent){
$(window)
.delayedBind('500','resize',function(){$.collapsibleTabs.handleResize();});
}

$.collapsibleTabs.handleResize();
return this;
};
$.collapsibleTabs={
instances:[],
boundEvent:null,
defaults:{
expandedContainer:'#p-views ul',
collapsedContainer:'#p-cactions ul',
collapsible:'li.collapsible',
shifting:false,
expandCondition:function(eleWidth){
return($('#left-navigation').position().left+$('#left-navigation').width())
<($('#right-navigation').position().left-eleWidth);
},
collapseCondition:function(){
return($('#left-navigation').position().left+$('#left-navigation').width())
>$('#right-navigation').position().left;
}
},
addData:function($collapsible){
var $settings=$collapsible.parent().data('collapsibleTabsSettings');
$collapsible.data('collapsibleTabsSettings',{
'expandedContainer':$settings.expandedContainer,
'collapsedContainer':$settings.collapsedContainer,
'expandedWidth':$collapsible.width(),
'prevElement':$collapsible.prev()
});
},
getSettings:function($collapsible){
var $settings=$collapsible.data('collapsibleTabsSettings');
if(typeof $settings=='undefined'){
$.collapsibleTabs.addData($collapsible);
$settings=$collapsible.data('collapsibleTabsSettings');
}
return $settings;
},
handleResize:function(e){
$.collapsibleTabs.instances.each(function(){
var $this=$(this),data=$.collapsibleTabs.getSettings($this);
if(data.shifting)return;

if($this.children(data.collapsible).length>0&&data.collapseCondition()){
$this.trigger("beforeTabCollapse");

$.collapsibleTabs.moveToCollapsed($this.children(data.collapsible+':last'));
}


if($(data.collapsedContainer+' '+data.collapsible).length>0
&&data.expandCondition($.collapsibleTabs.getSettings($(data.collapsedContainer).children(
data.collapsible+":first")).expandedWidth)){

$this.trigger("beforeTabExpand");
$.collapsibleTabs
.moveToExpanded(data.collapsedContainer+" "+data.collapsible+':first');
}
});
},
moveToCollapsed:function(ele){
var $moving=$(ele);
var data=$.collapsibleTabs.getSettings($moving);
var dataExp=$.collapsibleTabs.getSettings(data.expandedContainer);
dataExp.shifting=true;
$moving
.remove()
.prependTo(data.collapsedContainer)
.data('collapsibleTabsSettings',data);
dataExp.shifting=false;
$.collapsibleTabs.handleResize();
},
moveToExpanded:function(ele){
var $moving=$(ele);
var data=$.collapsibleTabs.getSettings($moving);
var dataExp=$.collapsibleTabs.getSettings(data.expandedContainer);
dataExp.shifting=true;

$moving.remove().insertAfter(data.prevElement).data('collapsibleTabsSettings',data);
dataExp.shifting=false;
$.collapsibleTabs.handleResize();
}
};
})(jQuery);
},{},{});
mediaWiki.loader.implement("jquery.cookie",function($,mw){





jQuery.cookie=function(key,value,options){

if(arguments.length>1&&(value===null||typeof value!=="object")){
options=jQuery.extend({},options);
if(value===null){
options.expires=-1;
}
if(typeof options.expires==='number'){
var days=options.expires,t=options.expires=new Date();
t.setDate(t.getDate()+days);
}
return(document.cookie=[
encodeURIComponent(key),'=',
options.raw?String(value):encodeURIComponent(String(value)),
options.expires?'; expires='+options.expires.toUTCString():'',
options.path?'; path='+options.path:'',
options.domain?'; domain='+options.domain:'',
options.secure?'; secure':''
].join(''));
}

options=value||{};
var result,decode=options.raw?function(s){return s;}:decodeURIComponent;
return(result=new RegExp('(?:^|; )'+encodeURIComponent(key)+'=([^;]*)').exec(document.cookie))?decode(result[1]):null;
};
},{},{});
mediaWiki.loader.implement("jquery.delayedBind",function($,mw){(function($){

function encodeEvent(event){
return event.replace(/-/g,'--').replace(/ /g,'-');
}
$.fn.extend({

delayedBind:function(timeout,event,data,callback){
var encEvent=encodeEvent(event);
return this.each(function(){
var that=this;


if(!($(this).data('_delayedBindBound-'+encEvent+'-'+timeout))){
$(this).data('_delayedBindBound-'+encEvent+'-'+timeout,true);
$(this).bind(event,function(){
var timerID=$(this).data('_delayedBindTimerID-'+encEvent+'-'+timeout);

if(typeof timerID!='undefined')
clearTimeout(timerID);
timerID=setTimeout(function(){
$(that).trigger('_delayedBind-'+encEvent+'-'+timeout);
},timeout);
$(this).data('_delayedBindTimerID-'+encEvent+'-'+timeout,timerID);
});
}

$(this).bind('_delayedBind-'+encEvent+'-'+timeout,data,callback);
});
},

delayedBindCancel:function(timeout,event){
var encEvent=encodeEvent(event);
return this.each(function(){
var timerID=$(this).data('_delayedBindTimerID-'+encEvent+'-'+timeout);
if(typeof timerID!='undefined')
clearTimeout(timerID);
});
},

delayedBindUnbind:function(timeout,event,callback){
var encEvent=encodeEvent(event);
return this.each(function(){
$(this).unbind('_delayedBind-'+encEvent+'-'+timeout,callback);
});
}
});
})(jQuery);
},{},{});
mediaWiki.loader.implement("jquery.highlightText",function($,mw){
(function($){
$.highlightText={

splitAndHighlight:function(node,pat){
var patArray=pat.split(" ");
for(var i=0;i<patArray.length;i++){
if(patArray[i].length==0)continue;
$.highlightText.innerHighlight(node,patArray[i]);
}
return node;
},

innerHighlight:function(node,pat){

if(node.nodeType==3){



var pos=node.data.search(new RegExp("\\b"+$.escapeRE(pat),"i"));
if(pos>=0){

var spannode=document.createElement('span');
spannode.className='highlight';

var middlebit=node.splitText(pos);

middlebit.splitText(pat.length);

var middleclone=middlebit.cloneNode(true);

spannode.appendChild(middleclone);

middlebit.parentNode.replaceChild(spannode,middlebit);
}

}else if(node.nodeType==1&&node.childNodes&&!/(script|style)/i.test(node.tagName)
&&!(node.tagName.toLowerCase()=='span'&&node.className.match(/\bhighlight/))){
for(var i=0;i<node.childNodes.length;++i){

$.highlightText.innerHighlight(node.childNodes[i],pat);
}
}
}
};
$.fn.highlightText=function(matchString){
return $(this).each(function(){
var $this=$(this);
$this.data('highlightText',{originalText:$this.text()});
$.highlightText.splitAndHighlight(this,matchString);
});
};
})(jQuery);
},{},{});
mediaWiki.loader.implement("jquery.placeholder",function($,mw){
(function($){
jQuery.fn.placeholder=function(){
return this.each(function(){

if(this.placeholder&&'placeholder'in document.createElement(this.tagName)){
return;
}
var placeholder=this.getAttribute('placeholder');
var $input=jQuery(this);

if(this.value===''||this.value==placeholder){
$input.addClass('placeholder').val(placeholder);
}
$input

.blur(function(){
if(this.value===''){
this.value=placeholder;
$input.addClass('placeholder');
}else{
$input.removeClass('placeholder');
}
})

.focus(function(){
if($input.hasClass('placeholder')){
this.value='';
$input.removeClass('placeholder');
}
});

this.form&&$(this.form).submit(function(){



if($input.hasClass('placeholder')){
$input
.val('')
.removeClass('placeholder');
}
});
});
};
})(jQuery);
},{},{});
mediaWiki.loader.implement("jquery.suggestions",function($,mw){
(function($){
$.suggestions={

cancel:function(context){
if(context.data.timerID!=null){
clearTimeout(context.data.timerID);
}
if(typeof context.config.cancel=='function'){
context.config.cancel.call(context.data.$textbox);
}
},

restore:function(context){
context.data.$textbox.val(context.data.prevText);
},

update:function(context,delayed){

function maybeFetch(){
if(context.data.$textbox.val()!==context.data.prevText){
context.data.prevText=context.data.$textbox.val();
if(typeof context.config.fetch=='function'){
context.config.fetch.call(context.data.$textbox,context.data.$textbox.val());
}
}
}

if(context.data.timerID!=null){
clearTimeout(context.data.timerID);
}
if(delayed){

context.data.timerID=setTimeout(maybeFetch,context.config.delay);
}else{
maybeFetch();
}
$.suggestions.special(context);
},
special:function(context){

if(typeof context.config.special.render=='function'){

setTimeout(function(){

$special=context.data.$container.find('.suggestions-special');
context.config.special.render.call($special,context.data.$textbox.val());
},1);
}
},

configure:function(context,property,value){

switch(property){
case'fetch':
case'cancel':
case'special':
case'result':
case'$region':
context.config[property]=value;
break;
case'suggestions':
context.config[property]=value;

if(typeof context.data!=='undefined'){
if(context.data.$textbox.val().length==0){

context.data.$container.hide();
}else{

context.data.$container.show();

var newCSS={
'top':context.config.$region.offset().top+context.config.$region.outerHeight(),
'bottom':'auto',
'width':context.config.$region.outerWidth(),
'height':'auto'
};
if(context.config.positionFromLeft){
newCSS['left']=context.config.$region.offset().left;
newCSS['right']='auto';
}else{
newCSS['left']='auto';
newCSS['right']=$('body').width()-(context.config.$region.offset().left+context.config.$region.outerWidth());
}
context.data.$container.css(newCSS);
var $results=context.data.$container.children('.suggestions-results');
$results.empty();
var expWidth=-1;
var $autoEllipseMe=$([]);
var matchedText=null;
for(var i=0;i<context.config.suggestions.length;i++){
var text=context.config.suggestions[i];
var $result=$('<div />')
.addClass('suggestions-result')
.attr('rel',i)
.data('text',context.config.suggestions[i])
.mousemove(function(e){
context.data.selectedWithMouse=true;
$.suggestions.highlight(
context,$(this).closest('.suggestions-results div'),false
);
})
.appendTo($results);

if(typeof context.config.result.render=='function'){
context.config.result.render.call($result,context.config.suggestions[i]);
}else{

if(context.config.highlightInput){
matchedText=context.data.prevText;
}
$result.append($('<span />')
.css('whiteSpace','nowrap')
.text(text)
);


var $span=$result.children('span');
if($span.outerWidth()>$result.width()&&$span.outerWidth()>expWidth){

expWidth=$span.outerWidth()+(context.data.$container.width()-$span.parent().width());
}
$autoEllipseMe=$autoEllipseMe.add($result);
}
}

if(expWidth>context.data.$container.width()){
var maxWidth=context.config.maxExpandFactor*context.data.$textbox.width();
context.data.$container.width(Math.min(expWidth,maxWidth));
}

$autoEllipseMe.autoEllipsis({hasSpan:true,tooltip:true,matchText:matchedText});
}
}
break;
case'maxRows':
context.config[property]=Math.max(1,Math.min(100,value));
break;
case'delay':
context.config[property]=Math.max(0,Math.min(1200,value));
break;
case'maxExpandFactor':
context.config[property]=Math.max(1,value);
break;
case'submitOnClick':
case'positionFromLeft':
case'highlightInput':
context.config[property]=value?true:false;
break;
}
},

highlight:function(context,result,updateTextbox){
var selected=context.data.$container.find('.suggestions-result-current');
if(!result.get||selected.get(0)!=result.get(0)){
if(result=='prev'){
if(selected.is('.suggestions-special')){
result=context.data.$container.find('.suggestions-result:last')
}else{
result=selected.prev();
if(selected.length==0){

if(context.data.$container.find('.suggestions-special').html()!=""){
result=context.data.$container.find('.suggestions-special');
}else{
result=context.data.$container.find('.suggestions-results div:last');
}
}
}
}else if(result=='next'){
if(selected.length==0){

result=context.data.$container.find('.suggestions-results div:first');
if(result.length==0&&context.data.$container.find('.suggestions-special').html()!=""){

result=context.data.$container.find('.suggestions-special');
}
}else{
result=selected.next();
if(selected.is('.suggestions-special')){
result=$([]);
}else if(
result.length==0&&
context.data.$container.find('.suggestions-special').html()!=""
){

result=context.data.$container.find('.suggestions-special');
}
}
}
selected.removeClass('suggestions-result-current');
result.addClass('suggestions-result-current');
}
if(updateTextbox){
if(result.length==0||result.is('.suggestions-special')){
$.suggestions.restore(context);
}else{
context.data.$textbox.val(result.data('text'));


context.data.$textbox.change();
}
context.data.$textbox.trigger('change');
}
},

keypress:function(e,context,key){
var wasVisible=context.data.$container.is(':visible');
var preventDefault=false;
switch(key){

case 40:
if(wasVisible){
$.suggestions.highlight(context,'next',true);
context.data.selectedWithMouse=false;
}else{
$.suggestions.update(context,false);
}
preventDefault=true;
break;

case 38:
if(wasVisible){
$.suggestions.highlight(context,'prev',true);
context.data.selectedWithMouse=false;
}
preventDefault=wasVisible;
break;

case 27:
context.data.$container.hide();
$.suggestions.restore(context);
$.suggestions.cancel(context);
context.data.$textbox.trigger('change');
preventDefault=wasVisible;
break;

case 13:
context.data.$container.hide();
preventDefault=wasVisible;
selected=context.data.$container.find('.suggestions-result-current');
if(selected.size()==0||context.data.selectedWithMouse){


$.suggestions.cancel(context);
context.config.$region.closest('form').submit();
}else if(selected.is('.suggestions-special')){
if(typeof context.config.special.select=='function'){
context.config.special.select.call(selected,context.data.$textbox);
}
}else{
if(typeof context.config.result.select=='function'){
$.suggestions.highlight(context,selected,true);
context.config.result.select.call(selected,context.data.$textbox);
}else{
$.suggestions.highlight(context,selected,true);
}
}
break;
default:
$.suggestions.update(context,true);
break;
}
if(preventDefault){
e.preventDefault();
e.stopImmediatePropagation();
}
}
};
$.fn.suggestions=function(){

var returnValue=null;
var args=arguments;
$(this).each(function(){

var context=$(this).data('suggestions-context');
if(typeof context=='undefined'||context==null){
context={
config:{
'fetch':function(){},
'cancel':function(){},
'special':{},
'result':{},
'$region':$(this),
'suggestions':[],
'maxRows':7,
'delay':120,
'submitOnClick':false,
'maxExpandFactor':3,
'positionFromLeft':true,
'highlightInput':false
}
};
}


if(args.length>0){
if(typeof args[0]=='object'){

for(var key in args[0]){
$.suggestions.configure(context,key,args[0][key]);
}
}else if(typeof args[0]=='string'){
if(args.length>1){

$.suggestions.configure(context,args[0],args[1]);
}else if(returnValue==null){

returnValue=(args[0]in context.config?undefined:context.config[args[0]]);
}
}
}

if(typeof context.data=='undefined'){
context.data={

'timerID':null,

'prevText':null,

'visibleResults':0,

'mouseDownOn':$([]),
'$textbox':$(this),
'selectedWithMouse':false
};

var newCSS={
'top':Math.round(context.data.$textbox.offset().top+context.data.$textbox.outerHeight()),
'width':context.data.$textbox.outerWidth(),
'display':'none'
};
if(context.config.positionFromLeft){
newCSS['left']=context.config.$region.offset().left;
newCSS['right']='auto';
}else{
newCSS['left']='auto';
newCSS['right']=$('body').width()-(context.config.$region.offset().left+context.config.$region.outerWidth());
}
context.data.$container=$('<div />')
.css(newCSS)
.addClass('suggestions')
.append(
$('<div />').addClass('suggestions-results')


.mousedown(function(e){
context.data.mouseDownOn=$(e.target).closest('.suggestions-results div');
})
.mouseup(function(e){
var $result=$(e.target).closest('.suggestions-results div');
var $other=context.data.mouseDownOn;
context.data.mouseDownOn=$([]);
if($result.get(0)!=$other.get(0)){
return;
}
$.suggestions.highlight(context,$result,true);
context.data.$container.hide();
if(typeof context.config.result.select=='function'){
context.config.result.select.call($result,context.data.$textbox);
}
context.data.$textbox.focus();
})
)
.append(
$('<div />').addClass('suggestions-special')


.mousedown(function(e){
context.data.mouseDownOn=$(e.target).closest('.suggestions-special');
})
.mouseup(function(e){
var $special=$(e.target).closest('.suggestions-special');
var $other=context.data.mouseDownOn;
context.data.mouseDownOn=$([]);
if($special.get(0)!=$other.get(0)){
return;
}
context.data.$container.hide();
if(typeof context.config.special.select=='function'){
context.config.special.select.call($special,context.data.$textbox);
}
context.data.$textbox.focus();
})
.mousemove(function(e){
context.data.selectedWithMouse=true;
$.suggestions.highlight(
context,$(e.target).closest('.suggestions-special'),false
);
})
)
.appendTo($('body'));
$(this)

.attr('autocomplete','off')
.keydown(function(e){

context.data.keypressed=(e.keyCode==undefined)?e.which:e.keyCode;
context.data.keypressedCount=0;
switch(context.data.keypressed){


case 40:
e.preventDefault();
e.stopImmediatePropagation();
break;
case 38:
case 27:
case 13:
if(context.data.$container.is(':visible')){
e.preventDefault();
e.stopImmediatePropagation();
}
}
})
.keypress(function(e){
context.data.keypressedCount++;
$.suggestions.keypress(e,context,context.data.keypressed);
})
.keyup(function(e){


if(context.data.keypressedCount==0){
$.suggestions.keypress(e,context,context.data.keypressed);
}
})
.blur(function(){


if(context.data.mouseDownOn.length>0){
return;
}
context.data.$container.hide();
$.suggestions.cancel(context);
});
}

$(this).data('suggestions-context',context);
});
return returnValue!==null?returnValue:$(this);
};
})(jQuery);
},{"all":".suggestions{overflow:hidden;position:absolute;top:0px;left:0px;width:0px;border:none;z-index:99;padding:0;margin:-1px -1px 0 0} html \x3e body .suggestions{margin:-1px 0 0 0}.suggestions-special{position:relative;background-color:Window;font-size:0.8em;cursor:pointer;border:solid 1px #aaaaaa;padding:0;margin:0;margin-top:-2px;display:none;padding:0.25em 0.25em;line-height:1.25em}.suggestions-results{background-color:white;background-color:Window;font-size:0.8em;cursor:pointer;border:solid 1px #aaaaaa;padding:0;margin:0}.suggestions-result{color:black;color:WindowText;margin:0;line-height:1.5em;padding:0.01em 0.25em;text-align:left}.suggestions-result-current{background-color:#4C59A6;background-color:Highlight;color:white;color:HighlightText}.suggestions-special .special-label{font-size:0.8em;color:gray;text-align:left}.suggestions-special .special-query{color:black;font-style:italic;text-align:left}.suggestions-special .special-hover{background-color:silver}.suggestions-result-current .special-label,.suggestions-result-current .special-query{color:white;color:HighlightText}.autoellipsis-matched,.highlight{font-weight:bold}\n\n/* cache key: enwiki:resourceloader:filter:minify-css:3:8d395f27880b6ffcab73b1c74b0217ea */"},{});
mediaWiki.loader.implement("jquery.tabIndex",function($,mw){
(function($){

jQuery.fn.firstTabIndex=function(){
var minTabIndex=0;
jQuery(this).find('[tabindex]').each(function(){
var tabIndex=parseInt(jQuery(this).attr('tabindex'));
if(tabIndex>minTabIndex){
minTabIndex=tabIndex;
}
});
return minTabIndex;
};

jQuery.fn.lastTabIndex=function(){
var maxTabIndex=0;
jQuery(this).find('[tabindex]').each(function(){
var tabIndex=parseInt(jQuery(this).attr('tabindex'));
if(tabIndex>maxTabIndex){
maxTabIndex=tabIndex;
}
});
return maxTabIndex;
};
})(jQuery);
},{},{});
mediaWiki.loader.implement("mediawiki.language",function($,mw){
(function($,mw){
mw.language={

'procPLURAL':function(template){
if(template.title&&template.parameters&&mw.language.convertPlural){

if(template.parameters.length==0){
return'';
}

var count=mw.language.convertNumber(template.title,true);

return mw.language.convertPlural(parseInt(count),template.parameters);
}

if(template.parameters[0]){
return template.parameters[0];
}
return'';
},

'convertPlural':function(count,forms){
if(!forms||forms.length==0){
return'';
}
return(parseInt(count)==1)?forms[0]:forms[1];
},

'preConvertPlural':function(forms,count){
while(forms.length<count){
forms.push(forms[forms.length-1]);
}
return forms;
},

'convertNumber':function(number,integer){
if(!mw.language.digitTransformTable){
return number;
}

var transformTable=mw.language.digitTransformTable;

if(integer){
if(parseInt(number)==number){
return number;
}
var tmp=[];
for(var i in transformTable){
tmp[transformTable[i]]=i;
}
transformTable=tmp;
}
var numberString=''+number;
var convertedNumber='';
for(var i=0;i<numberString.length;i++){
if(transformTable[numberString[i]]){
convertedNumber+=transformTable[numberString[i]];
}else{
convertedNumber+=numberString[i];
}
}
return integer?parseInt(convertedNumber):convertedNumber;
},

'digitTransformTable':null
};
})(jQuery,mediaWiki);
},{},{});
mediaWiki.loader.implement("mediawiki.legacy.ajax",function($,mw){

window.sajax_debug_mode=false;
window.sajax_request_type='GET';

window.sajax_debug=function(text){
if(!sajax_debug_mode)return false;
var e=document.getElementById('sajax_debug');
if(!e){
e=document.createElement('p');
e.className='sajax_debug';
e.id='sajax_debug';
var b=document.getElementsByTagName('body')[0];
if(b.firstChild){
b.insertBefore(e,b.firstChild);
}else{
b.appendChild(e);
}
}
var m=document.createElement('div');
m.appendChild(document.createTextNode(text));
e.appendChild(m);
return true;
};

window.sajax_init_object=function(){
sajax_debug('sajax_init_object() called..');
var A;
try{



A=new XMLHttpRequest();
}catch(e){
try{
A=new ActiveXObject('Msxml2.XMLHTTP');
}catch(e){
try{
A=new ActiveXObject('Microsoft.XMLHTTP');
}catch(oc){
A=null;
}
}
}
if(!A){
sajax_debug('Could not create connection object.');
}
return A;
};

window.sajax_do_call=function(func_name,args,target){
var i,x,n;
var uri;
var post_data;
uri=wgServer+
((wgScript==null)?(wgScriptPath+'/index.php'):wgScript)+
'?action=ajax';
if(sajax_request_type=='GET'){
if(uri.indexOf('?')==-1){
uri=uri+'?rs='+encodeURIComponent(func_name);
}else{
uri=uri+'&rs='+encodeURIComponent(func_name);
}
for(i=0;i<args.length;i++){
uri=uri+'&rsargs[]='+encodeURIComponent(args[i]);
}

post_data=null;
}else{
post_data='rs='+encodeURIComponent(func_name);
for(i=0;i<args.length;i++){
post_data=post_data+'&rsargs[]='+encodeURIComponent(args[i]);
}
}
x=sajax_init_object();
if(!x){
alert('AJAX not supported');
return false;
}
try{
x.open(sajax_request_type,uri,true);
}catch(e){
if(window.location.hostname=='localhost'){
alert("Your browser blocks XMLHttpRequest to 'localhost', try using a real hostname for development/testing.");
}
throw e;
}
if(sajax_request_type=='POST'){
x.setRequestHeader('Method','POST '+uri+' HTTP/1.1');
x.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
}
x.setRequestHeader('Pragma','cache=yes');
x.setRequestHeader('Cache-Control','no-transform');
x.onreadystatechange=function(){
if(x.readyState!=4){
return;
}
sajax_debug('received ('+x.status+' '+x.statusText+') '+x.responseText);




if(typeof(target)=='function'){
target(x);
}else if(typeof(target)=='object'){
if(target.tagName=='INPUT'){
if(x.status==200){
target.value=x.responseText;
}

}else{
if(x.status==200){
target.innerHTML=x.responseText;
}else{
target.innerHTML='<div class="error">Error: '+x.status+
' '+x.statusText+' ('+x.responseText+')</div>';
}
}
}else{
alert('bad target for sajax_do_call: not a function or object: '+target);
}
return;
};
sajax_debug(func_name+' uri = '+uri+' / post = '+post_data);
x.send(post_data);
sajax_debug(func_name+' waiting..');
delete x;
return true;
};

window.wfSupportsAjax=function(){
var request=sajax_init_object();
var supportsAjax=request?true:false;
delete request;
return supportsAjax;
};
},{},{"watch":"Watch","unwatch":"Unwatch","watching":"Watching...","unwatching":"Unwatching...","tooltip-ca-watch":"Add this page to your watchlist","tooltip-ca-unwatch":"Remove this page from your watchlist"});
mediaWiki.loader.implement("mediawiki.legacy.mwsuggest",function($,mw){

if(!mw.config.exists('wgMWSuggestTemplate')){
mw.config.set('wgMWSuggestTemplate',mw.config.get('wgServer')+mw.config.get('wgScriptPath')
+"/api.php?action=opensearch\x26search={searchTerms}\x26namespace={namespaces}\x26suggest");
}

window.os_map={};

window.os_cache={};

window.os_cur_keypressed=0;
window.os_keypressed_count=0;

window.os_timer=null;

window.os_mouse_pressed=false;
window.os_mouse_num=-1;

window.os_mouse_moved=false;

window.os_search_timeout=250;

window.os_autoload_inputs=new Array('searchInput','searchInput2','powerSearchText','searchText');
window.os_autoload_forms=new Array('searchform','searchform2','powersearch','search');

window.os_is_stopped=false;

window.os_max_lines_per_suggest=7;

window.os_animation_steps=6;

window.os_animation_min_step=2;

window.os_animation_delay=30;

window.os_container_max_width=2;

window.os_animation_timer=null;

window.os_enabled=true;


window.os_use_datalist=false;

window.os_Timer=function(id,r,query){
this.id=id;
this.r=r;
this.query=query;
};

window.os_Results=function(name,formname){
this.searchform=formname;
this.searchbox=name;
this.container=name+'Suggest';
this.resultTable=name+'Result';
this.resultText=name+'ResultText';
this.toggle=name+'Toggle';
this.query=null;
this.results=null;
this.resultCount=0;
this.original=null;
this.selected=-1;
this.containerCount=0;
this.containerRow=0;
this.containerTotal=0;
this.visible=false;
this.stayHidden=false;
};

window.os_AnimationTimer=function(r,target){
this.r=r;
var current=document.getElementById(r.container).offsetWidth;
this.inc=Math.round((target-current)/os_animation_steps);
if(this.inc<os_animation_min_step&&this.inc>=0){
this.inc=os_animation_min_step;
}
if(this.inc>-os_animation_min_step&&this.inc<0){
this.inc=-os_animation_min_step;
}
this.target=target;
};


window.os_MWSuggestInit=function(){
if(!window.os_enabled){
return;
}
for(var i=0;i<os_autoload_inputs.length;i++){
var id=os_autoload_inputs[i];
var form=os_autoload_forms[i];
element=document.getElementById(id);
if(element!=null){
os_initHandlers(id,form,element);
}
}
};

window.os_MWSuggestTeardown=function(){
for(var i=0;i<os_autoload_inputs.length;i++){
var id=os_autoload_inputs[i];
var form=os_autoload_forms[i];
element=document.getElementById(id);
if(element!=null){
os_teardownHandlers(id,form,element);
}
}
};

window.os_MWSuggestDisable=function(){
window.os_MWSuggestTeardown();
window.os_enabled=false;
}

window.os_initHandlers=function(name,formname,element){
var r=new os_Results(name,formname);
var formElement=document.getElementById(formname);
if(!formElement){

return;
}

os_hookEvent(element,'keyup',os_eventKeyup);
os_hookEvent(element,'keydown',os_eventKeydown);
os_hookEvent(element,'keypress',os_eventKeypress);
if(!os_use_datalist){

os_hookEvent(element,'blur',os_eventBlur);
os_hookEvent(element,'focus',os_eventFocus);



element.setAttribute('autocomplete','off');
}

os_hookEvent(formElement,'submit',os_eventOnsubmit);
os_map[name]=r;

if(document.getElementById(r.toggle)==null){


}
};
window.os_teardownHandlers=function(name,formname,element){
var formElement=document.getElementById(formname);
if(!formElement){

return;
}
os_unhookEvent(element,'keyup',os_eventKeyup);
os_unhookEvent(element,'keydown',os_eventKeydown);
os_unhookEvent(element,'keypress',os_eventKeypress);
if(!os_use_datalist){

os_unhookEvent(element,'blur',os_eventBlur);
os_unhookEvent(element,'focus',os_eventFocus);



element.removeAttribute('autocomplete');
}

os_unhookEvent(formElement,'submit',os_eventOnsubmit);
};
window.os_hookEvent=function(element,hookName,hookFunct){
if(element.addEventListener){
element.addEventListener(hookName,hookFunct,false);
}else if(window.attachEvent){
element.attachEvent('on'+hookName,hookFunct);
}
};
window.os_unhookEvent=function(element,hookName,hookFunct){
if(element.removeEventListener){
element.removeEventListener(hookName,hookFunct,false);
}else if(element.detachEvent){
element.detachEvent('on'+hookName,hookFunct);
}
}


window.os_eventKeyup=function(e){
var targ=os_getTarget(e);
var r=os_map[targ.id];
if(r==null){
return;
}

if(os_keypressed_count==0){
os_processKey(r,os_cur_keypressed,targ);
}
var query=targ.value;
os_fetchResults(r,query,os_search_timeout);
};

window.os_processKey=function(r,keypressed,targ){
if(keypressed==40&&!r.visible&&os_timer==null){


r.query='';
os_fetchResults(r,targ.value,0);
}


if(os_use_datalist){
return;
}
if(keypressed==40){
if(r.visible){
os_changeHighlight(r,r.selected,r.selected+1,true);
}
}else if(keypressed==38){
if(r.visible){
os_changeHighlight(r,r.selected,r.selected-1,true);
}
}else if(keypressed==27){
document.getElementById(r.searchbox).value=r.original;
r.query=r.original;
os_hideResults(r);
}else if(r.query!=document.getElementById(r.searchbox).value){

}
};

window.os_eventKeypress=function(e){
var targ=os_getTarget(e);
var r=os_map[targ.id];
if(r==null){
return;
}
var keypressed=os_cur_keypressed;
os_keypressed_count++;
os_processKey(r,keypressed,targ);
};

window.os_eventKeydown=function(e){
if(!e){
e=window.event;
}
var targ=os_getTarget(e);
var r=os_map[targ.id];
if(r==null){
return;
}
os_mouse_moved=false;
os_cur_keypressed=(e.keyCode==undefined)?e.which:e.keyCode;
os_keypressed_count=0;
};

window.os_eventOnsubmit=function(e){
var targ=os_getTarget(e);
os_is_stopped=true;

if(os_timer!=null&&os_timer.id!=null){
clearTimeout(os_timer.id);
os_timer=null;
}

for(i=0;i<os_autoload_inputs.length;i++){
var r=os_map[os_autoload_inputs[i]];
if(r!=null){
var b=document.getElementById(r.searchform);
if(b!=null&&b==targ){

r.query=document.getElementById(r.searchbox).value;
}
os_hideResults(r);
}
}
return true;
};

window.os_hideResults=function(r){
if(os_use_datalist){
document.getElementById(r.searchbox).setAttribute('list','');
}else{
var c=document.getElementById(r.container);
if(c!=null){
c.style.visibility='hidden';
}
}
r.visible=false;
r.selected=-1;
};
window.os_decodeValue=function(value){
if(decodeURIComponent){
return decodeURIComponent(value);
}
if(unescape){
return unescape(value);
}
return null;
};
window.os_encodeQuery=function(value){
if(encodeURIComponent){
return encodeURIComponent(value);
}
if(escape){
return escape(value);
}
return null;
};

window.os_updateResults=function(r,query,text,cacheKey){
os_cache[cacheKey]=text;
r.query=query;
r.original=query;
if(text==''){
r.results=null;
r.resultCount=0;
os_hideResults(r);
}else{
try{
var p=eval('('+text+')');
if(p.length<2||p[1].length==0){
r.results=null;
r.resultCount=0;
os_hideResults(r);
return;
}
if(os_use_datalist){
os_setupDatalist(r,p[1]);
}else{
os_setupDiv(r,p[1]);
}
}catch(e){

os_hideResults(r);
os_cache[cacheKey]=null;
}
}
};

window.os_setupDatalist=function(r,results){
var s=document.getElementById(r.searchbox);
var c=document.getElementById(r.container);
if(c==null){
c=document.createElement('datalist');
c.setAttribute('id',r.container);
document.body.appendChild(c);
}else{
c.innerHTML='';
}
s.setAttribute('list',r.container);
r.results=new Array();
r.resultCount=results.length;
r.visible=true;
for(i=0;i<results.length;i++){
var title=os_decodeValue(results[i]);
var opt=document.createElement('option');
opt.value=title;
r.results[i]=title;
c.appendChild(opt);
}
};

window.os_getNamespaces=function(r){
var namespaces='';
var elements=document.forms[r.searchform].elements;
for(i=0;i<elements.length;i++){
var name=elements[i].name;
if(typeof name!='undefined'&&name.length>2&&name[0]=='n'&&
name[1]=='s'&&(
(elements[i].type=='checkbox'&&elements[i].checked)||
(elements[i].type=='hidden'&&elements[i].value=='1')
)
){
if(namespaces!=''){
namespaces+='|';
}
namespaces+=name.substring(2);
}
}
if(namespaces==''){
namespaces=wgSearchNamespaces.join('|');
}
return namespaces;
};

window.os_updateIfRelevant=function(r,query,text,cacheKey){
var t=document.getElementById(r.searchbox);
if(t!=null&&t.value==query){
os_updateResults(r,query,text,cacheKey);
}
r.query=query;
};

window.os_delayedFetch=function(){
if(os_timer==null){
return;
}
var r=os_timer.r;
var query=os_timer.query;
os_timer=null;
var path=mw.config.get('wgMWSuggestTemplate').replace("{namespaces}",os_getNamespaces(r))
.replace("{dbname}",wgDBname)
.replace("{searchTerms}",os_encodeQuery(query));

var cached=os_cache[path];
if(cached!=null&&cached!=undefined){
os_updateIfRelevant(r,query,cached,path);
}else{
var xmlhttp=sajax_init_object();
if(xmlhttp){
try{
xmlhttp.open('GET',path,true);
xmlhttp.onreadystatechange=function(){
if(xmlhttp.readyState==4&&typeof os_updateIfRelevant=='function'){
os_updateIfRelevant(r,query,xmlhttp.responseText,path);
}
};
xmlhttp.send(null);
}catch(e){
if(window.location.hostname=='localhost'){
alert("Your browser blocks XMLHttpRequest to 'localhost', try using a real hostname for development/testing.");
}
throw e;
}
}
}
};

window.os_fetchResults=function(r,query,timeout){
if(query==''){
r.query='';
os_hideResults(r);
return;
}else if(query==r.query){
return;
}
os_is_stopped=false;


if(os_timer!=null&&os_timer.id!=null){
clearTimeout(os_timer.id);
}

if(timeout!=0){
os_timer=new os_Timer(setTimeout("os_delayedFetch()",timeout),r,query);
}else{
os_timer=new os_Timer(null,r,query);
os_delayedFetch();
}
};

window.os_getTarget=function(e){
if(!e){
e=window.event;
}
if(e.target){
return e.target;
}else if(e.srcElement){
return e.srcElement;
}else{
return null;
}
};

window.os_isNumber=function(x){
if(x==''||isNaN(x)){
return false;
}
for(var i=0;i<x.length;i++){
var c=x.charAt(i);
if(!(c>='0'&&c<='9')){
return false;
}
}
return true;
};

window.os_enableSuggestionsOn=function(inputId,formName){
os_initHandlers(inputId,formName,document.getElementById(inputId));
};

window.os_disableSuggestionsOn=function(inputId){
r=os_map[inputId];
if(r!=null){

os_timer=null;
os_hideResults(r);

document.getElementById(inputId).setAttribute('autocomplete','on');

os_map[inputId]=null;
}

var index=os_autoload_inputs.indexOf(inputId);
if(index>=0){
os_autoload_inputs[index]=os_autoload_forms[index]='';
}
};


window.os_eventBlur=function(e){
var targ=os_getTarget(e);
var r=os_map[targ.id];
if(r==null){
return;
}
if(!os_mouse_pressed){
os_hideResults(r);

r.stayHidden=true;

if(os_timer!=null&&os_timer.id!=null){
clearTimeout(os_timer.id);
}
os_timer=null;
}
};

window.os_eventFocus=function(e){
var targ=os_getTarget(e);
var r=os_map[targ.id];
if(r==null){
return;
}
r.stayHidden=false;
};

window.os_setupDiv=function(r,results){
var c=document.getElementById(r.container);
if(c==null){
c=os_createContainer(r);
}
c.innerHTML=os_createResultTable(r,results);

var t=document.getElementById(r.resultTable);
r.containerTotal=t.offsetHeight;
r.containerRow=t.offsetHeight/r.resultCount;
os_fitContainer(r);
os_trimResultText(r);
os_showResults(r);
};

window.os_createResultTable=function(r,results){
var c=document.getElementById(r.container);
var width=c.offsetWidth-os_operaWidthFix(c.offsetWidth);
var html='<table class="os-suggest-results" id="'+r.resultTable+'" style="width: '+width+'px;">';
r.results=new Array();
r.resultCount=results.length;
for(i=0;i<results.length;i++){
var title=os_decodeValue(results[i]);
r.results[i]=title;
html+='<tr><td class="os-suggest-result" id="'+r.resultTable+i+'"><span id="'+r.resultText+i+'">'+title+'</span></td></tr>';
}
html+='</table>';
return html;
};

window.os_showResults=function(r){
if(os_is_stopped){
return;
}
if(r.stayHidden){
return;
}
os_fitContainer(r);
var c=document.getElementById(r.container);
r.selected=-1;
if(c!=null){
c.scrollTop=0;
c.style.visibility='visible';
r.visible=true;
}
};
window.os_operaWidthFix=function(x){

if(typeof document.body.style.overflowX!='string'){
return 30;
}
return 0;
};

window.f_clientWidth=function(){
return f_filterResults(
window.innerWidth?window.innerWidth:0,
document.documentElement?document.documentElement.clientWidth:0,
document.body?document.body.clientWidth:0
);
};
window.f_clientHeight=function(){
return f_filterResults(
window.innerHeight?window.innerHeight:0,
document.documentElement?document.documentElement.clientHeight:0,
document.body?document.body.clientHeight:0
);
};
window.f_scrollLeft=function(){
return f_filterResults(
window.pageXOffset?window.pageXOffset:0,
document.documentElement?document.documentElement.scrollLeft:0,
document.body?document.body.scrollLeft:0
);
};
window.f_scrollTop=function(){
return f_filterResults(
window.pageYOffset?window.pageYOffset:0,
document.documentElement?document.documentElement.scrollTop:0,
document.body?document.body.scrollTop:0
);
};
window.f_filterResults=function(n_win,n_docel,n_body){
var n_result=n_win?n_win:0;
if(n_docel&&(!n_result||(n_result>n_docel))){
n_result=n_docel;
}
return n_body&&(!n_result||(n_result>n_body))?n_body:n_result;
};

window.os_availableHeight=function(r){
var absTop=document.getElementById(r.container).style.top;
var px=absTop.lastIndexOf('px');
if(px>0){
absTop=absTop.substring(0,px);
}
return f_clientHeight()-(absTop-f_scrollTop());
};

window.os_getElementPosition=function(elemID){
var offsetTrail=document.getElementById(elemID);
var offsetLeft=0;
var offsetTop=0;
while(offsetTrail){
offsetLeft+=offsetTrail.offsetLeft;
offsetTop+=offsetTrail.offsetTop;
offsetTrail=offsetTrail.offsetParent;
}
if(navigator.userAgent.indexOf('Mac')!=-1&&typeof document.body.leftMargin!='undefined'){
offsetLeft+=document.body.leftMargin;
offsetTop+=document.body.topMargin;
}
return{left:offsetLeft,top:offsetTop};
};

window.os_createContainer=function(r){
var c=document.createElement('div');
var s=document.getElementById(r.searchbox);
var pos=os_getElementPosition(r.searchbox);
var left=pos.left;
var top=pos.top+s.offsetHeight;
c.className='os-suggest';
c.setAttribute('id',r.container);
document.body.appendChild(c);


c=document.getElementById(r.container);
c.style.top=top+'px';
c.style.left=left+'px';
c.style.width=s.offsetWidth+'px';

c.onmouseover=function(event){
os_eventMouseover(r.searchbox,event);
};
c.onmousemove=function(event){
os_eventMousemove(r.searchbox,event);
};
c.onmousedown=function(event){
return os_eventMousedown(r.searchbox,event);
};
c.onmouseup=function(event){
os_eventMouseup(r.searchbox,event);
};
return c;
};

window.os_fitContainer=function(r){
var c=document.getElementById(r.container);
var h=os_availableHeight(r)-20;
var inc=r.containerRow;
h=parseInt(h/inc)*inc;
if(h<(2*inc)&&r.resultCount>1){
h=2*inc;
}
if((h/inc)>os_max_lines_per_suggest){
h=inc*os_max_lines_per_suggest;
}
if(h<r.containerTotal){
c.style.height=h+'px';
r.containerCount=parseInt(Math.round(h/inc));
}else{
c.style.height=r.containerTotal+'px';
r.containerCount=r.resultCount;
}
};

window.os_trimResultText=function(r){

var maxW=0;
for(var i=0;i<r.resultCount;i++){
var e=document.getElementById(r.resultText+i);
if(e.offsetWidth>maxW){
maxW=e.offsetWidth;
}
}
var w=document.getElementById(r.container).offsetWidth;
var fix=0;
if(r.containerCount<r.resultCount){
fix=20;
}else{
fix=os_operaWidthFix(w);
}
if(fix<4){
fix=4;
}
maxW+=fix;

var normW=document.getElementById(r.searchbox).offsetWidth;
var prop=maxW/normW;
if(prop>os_container_max_width){
prop=os_container_max_width;
}else if(prop<1){
prop=1;
}
var newW=Math.round(normW*prop);
if(w!=newW){
w=newW;
if(os_animation_timer!=null){
clearInterval(os_animation_timer.id);
}
os_animation_timer=new os_AnimationTimer(r,w);
os_animation_timer.id=setInterval("os_animateChangeWidth()",os_animation_delay);
w-=fix;
}

if(w<10){
return;
}
for(var i=0;i<r.resultCount;i++){
var e=document.getElementById(r.resultText+i);
var replace=1;
var lastW=e.offsetWidth+1;
var iteration=0;
var changedText=false;
while(e.offsetWidth>w&&(e.offsetWidth<lastW||iteration<2)){
changedText=true;
lastW=e.offsetWidth;
var l=e.innerHTML;
e.innerHTML=l.substring(0,l.length-replace)+'...';
iteration++;
replace=4;
}
if(changedText){

document.getElementById(r.resultTable+i).setAttribute('title',r.results[i]);
}
}
};

window.os_animateChangeWidth=function(){
var r=os_animation_timer.r;
var c=document.getElementById(r.container);
var w=c.offsetWidth;
var normW=document.getElementById(r.searchbox).offsetWidth;
var normL=os_getElementPosition(r.searchbox).left;
var inc=os_animation_timer.inc;
var target=os_animation_timer.target;
var nw=w+inc;
if((inc>0&&nw>=target)||(inc<=0&&nw<=target)){

c.style.width=target+'px';
clearInterval(os_animation_timer.id);
os_animation_timer=null;
}else{

c.style.width=nw+'px';
if(document.documentElement.dir=='rtl'){
c.style.left=(normL+normW+(target-nw)-os_animation_timer.target-1)+'px';
}
}
};

window.os_changeHighlight=function(r,cur,next,updateSearchBox){
if(next>=r.resultCount){
next=r.resultCount-1;
}
if(next<-1){
next=-1;
}
r.selected=next;
if(cur==next){
return;
}
if(cur>=0){
var curRow=document.getElementById(r.resultTable+cur);
if(curRow!=null){
curRow.className='os-suggest-result';
}
}
var newText;
if(next>=0){
var nextRow=document.getElementById(r.resultTable+next);
if(nextRow!=null){
nextRow.className=os_HighlightClass();
}
newText=r.results[next];
}else{
newText=r.original;
}

if(r.containerCount<r.resultCount){
var c=document.getElementById(r.container);
var vStart=c.scrollTop/r.containerRow;
var vEnd=vStart+r.containerCount;
if(next<vStart){
c.scrollTop=next*r.containerRow;
}else if(next>=vEnd){
c.scrollTop=(next-r.containerCount+1)*r.containerRow;
}
}

if(updateSearchBox){
os_updateSearchQuery(r,newText);
}
};
window.os_HighlightClass=function(){
var match=navigator.userAgent.match(/AppleWebKit\/(\d+)/);
if(match){
var webKitVersion=parseInt(match[1]);
if(webKitVersion<523){



return'os-suggest-result-hl-webkit';
}
}
return'os-suggest-result-hl';
};
window.os_updateSearchQuery=function(r,newText){
document.getElementById(r.searchbox).value=newText;
r.query=newText;
};


window.os_eventMouseover=function(srcId,e){
var targ=os_getTarget(e);
var r=os_map[srcId];
if(r==null||!os_mouse_moved){
return;
}
var num=os_getNumberSuffix(targ.id);
if(num>=0){
os_changeHighlight(r,r.selected,num,false);
}
};

window.os_getNumberSuffix=function(id){
var num=id.substring(id.length-2);
if(!(num.charAt(0)>='0'&&num.charAt(0)<='9')){
num=num.substring(1);
}
if(os_isNumber(num)){
return parseInt(num);
}else{
return-1;
}
};

window.os_eventMousemove=function(srcId,e){
os_mouse_moved=true;
};

window.os_eventMousedown=function(srcId,e){
var targ=os_getTarget(e);
var r=os_map[srcId];
if(r==null){
return;
}
var num=os_getNumberSuffix(targ.id);
os_mouse_pressed=true;
if(num>=0){
os_mouse_num=num;

}

document.getElementById(r.searchbox).focus();
return false;
};

window.os_eventMouseup=function(srcId,e){
var targ=os_getTarget(e);
var r=os_map[srcId];
if(r==null){
return;
}
var num=os_getNumberSuffix(targ.id);
if(num>=0&&os_mouse_num==num){
os_updateSearchQuery(r,r.results[num]);
os_hideResults(r);
document.getElementById(r.searchform).submit();
}
os_mouse_pressed=false;

document.getElementById(r.searchbox).focus();
};


window.os_createToggle=function(r,className){
var t=document.createElement('span');
t.className=className;
t.setAttribute('id',r.toggle);
var link=document.createElement('a');
link.setAttribute('href','javascript:void(0);');
link.onclick=function(){os_toggle(r.searchbox,r.searchform);};
var msg=document.createTextNode(wgMWSuggestMessages[0]);
link.appendChild(msg);
t.appendChild(link);
return t;
};

window.os_toggle=function(inputId,formName){
r=os_map[inputId];
var msg='';
if(r==null){
os_enableSuggestionsOn(inputId,formName);
r=os_map[inputId];
msg=wgMWSuggestMessages[0];
}else{
os_disableSuggestionsOn(inputId,formName);
msg=wgMWSuggestMessages[1];
}

var link=document.getElementById(r.toggle).firstChild;
link.replaceChild(document.createTextNode(msg),link.firstChild);
};
hookEvent('load',os_MWSuggestInit);
},{},{"search-mwsuggest-enabled":"with suggestions","search-mwsuggest-disabled":"no suggestions"});
mediaWiki.loader.implement("mediawiki.legacy.wikibits",function($,mw){

window.clientPC=navigator.userAgent.toLowerCase();
window.is_gecko=/gecko/.test(clientPC)&&
!/khtml|spoofer|netscape\/7\.0/.test(clientPC);
window.is_safari=window.is_safari_win=window.webkit_version=
window.is_chrome=window.is_chrome_mac=false;
window.webkit_match=clientPC.match(/applewebkit\/(\d+)/);
if(webkit_match){
window.is_safari=clientPC.indexOf('applewebkit')!=-1&&
clientPC.indexOf('spoofer')==-1;
window.is_safari_win=is_safari&&clientPC.indexOf('windows')!=-1;
window.webkit_version=parseInt(webkit_match[1]);


window.is_chrome=clientPC.indexOf('chrome')!==-1&&
clientPC.indexOf('spoofer')===-1;
window.is_chrome_mac=is_chrome&&clientPC.indexOf('mac')!==-1
}

window.is_ff2=/firefox\/[2-9]|minefield\/3/.test(clientPC);
window.ff2_bugs=/firefox\/2/.test(clientPC);

window.is_ff2_win=is_ff2&&clientPC.indexOf('windows')!=-1;
window.is_ff2_x11=is_ff2&&clientPC.indexOf('x11')!=-1;
window.is_opera=window.is_opera_preseven=window.is_opera_95=
window.opera6_bugs=window.opera7_bugs=window.opera95_bugs=false;
if(clientPC.indexOf('opera')!=-1){
window.is_opera=true;
window.is_opera_preseven=window.opera&&!document.childNodes;
window.is_opera_seven=window.opera&&document.childNodes;
window.is_opera_95=/opera\/(9\.[5-9]|[1-9][0-9])/.test(clientPC);
window.opera6_bugs=is_opera_preseven;
window.opera7_bugs=is_opera_seven&&!is_opera_95;
window.opera95_bugs=/opera\/(9\.5)/.test(clientPC);
}



window.ie6_bugs=false;
if(/msie ([0-9]{1,}[\.0-9]{0,})/.exec(clientPC)!=null
&&parseFloat(RegExp.$1)<=6.0){
ie6_bugs=true;
}



window.doneOnloadHook=undefined;
if(!window.onloadFuncts){
window.onloadFuncts=[];
}
window.addOnloadHook=function(hookFunct){

if(!doneOnloadHook){
onloadFuncts[onloadFuncts.length]=hookFunct;
}else{
hookFunct();
}
};
window.importScript=function(page){

var uri=wgScript+'?title='+
encodeURIComponent(page.replace(/ /g,'_')).replace(/%2F/ig,'/').replace(/%3A/ig,':')+
'&action=raw&ctype=text/javascript';
return importScriptURI(uri);
};
window.loadedScripts={};
window.importScriptURI=function(url){
if(loadedScripts[url]){
return null;
}
loadedScripts[url]=true;
var s=document.createElement('script');
s.setAttribute('src',url);
s.setAttribute('type','text/javascript');
document.getElementsByTagName('head')[0].appendChild(s);
return s;
};
window.importStylesheet=function(page){
return importStylesheetURI(wgScript+'?action=raw&ctype=text/css&title='+encodeURIComponent(page.replace(/ /g,'_')));
};
window.importStylesheetURI=function(url,media){
var l=document.createElement('link');
l.type='text/css';
l.rel='stylesheet';
l.href=url;
if(media){
l.media=media;
}
document.getElementsByTagName('head')[0].appendChild(l);
return l;
};
window.appendCSS=function(text){
var s=document.createElement('style');
s.type='text/css';
s.rel='stylesheet';
if(s.styleSheet){
s.styleSheet.cssText=text;
}else{
s.appendChild(document.createTextNode(text+''));
}
document.getElementsByTagName('head')[0].appendChild(s);
return s;
};

if(typeof stylepath!='undefined'&&skin=='monobook'){
if(opera6_bugs){
importStylesheetURI(stylepath+'/'+skin+'/Opera6Fixes.css');
}else if(opera7_bugs){
importStylesheetURI(stylepath+'/'+skin+'/Opera7Fixes.css');
}else if(opera95_bugs){
importStylesheetURI(stylepath+'/'+skin+'/Opera9Fixes.css');
}else if(ff2_bugs){
importStylesheetURI(stylepath+'/'+skin+'/FF2Fixes.css');
}
}
if('wgBreakFrames'in window&&window.wgBreakFrames){

if(window.top!=window){
window.top.location=window.location;
}
}
window.showTocToggle=function(){
if(document.createTextNode){


var linkHolder=document.getElementById('toctitle');
var existingLink=document.getElementById('togglelink');
if(!linkHolder||existingLink){

return;
}
var outerSpan=document.createElement('span');
outerSpan.className='toctoggle';
var toggleLink=document.createElement('a');
toggleLink.id='togglelink';
toggleLink.className='internal';
toggleLink.href='#';
addClickHandler(toggleLink,function(evt){toggleToc();return killEvt(evt);});
toggleLink.appendChild(document.createTextNode(mediaWiki.msg('hidetoc')));
outerSpan.appendChild(document.createTextNode('['));
outerSpan.appendChild(toggleLink);
outerSpan.appendChild(document.createTextNode(']'));
linkHolder.appendChild(document.createTextNode(' '));
linkHolder.appendChild(outerSpan);
var cookiePos=document.cookie.indexOf("hidetoc=");
if(cookiePos>-1&&document.cookie.charAt(cookiePos+8)==1){
toggleToc();
}
}
};
window.changeText=function(el,newText){

if(el.innerText){
el.innerText=newText;
}else if(el.firstChild&&el.firstChild.nodeValue){
el.firstChild.nodeValue=newText;
}
};
window.killEvt=function(evt){
evt=evt||window.event||window.Event;
if(typeof(evt.preventDefault)!='undefined'){
evt.preventDefault();
evt.stopPropagation();
}else{
evt.cancelBubble=true;
}
return false;
};
window.toggleToc=function(){
var tocmain=document.getElementById('toc');
var toc=document.getElementById('toc').getElementsByTagName('ul')[0];
var toggleLink=document.getElementById('togglelink');
if(toc&&toggleLink&&toc.style.display=='none'){
changeText(toggleLink,mediaWiki.msg('hidetoc'));
toc.style.display='block';
document.cookie="hidetoc=0";
tocmain.className='toc';
}else{
changeText(toggleLink,mediaWiki.msg('showtoc'));
toc.style.display='none';
document.cookie="hidetoc=1";
tocmain.className='toc tochidden';
}
return false;
};
window.mwEditButtons=[];
window.mwCustomEditButtons=[];

window.escapeQuotes=function(text){
var re=new RegExp("'","g");
text=text.replace(re,"\\'");
re=new RegExp("\\n","g");
text=text.replace(re,"\\n");
return escapeQuotesHTML(text);
};
window.escapeQuotesHTML=function(text){
var re=new RegExp('&',"g");
text=text.replace(re,"&amp;");
re=new RegExp('"',"g");
text=text.replace(re,"&quot;");
re=new RegExp('<',"g");
text=text.replace(re,"&lt;");
re=new RegExp('>',"g");
text=text.replace(re,"&gt;");
return text;
};

window.tooltipAccessKeyPrefix='alt-';
if(is_opera){
tooltipAccessKeyPrefix='shift-esc-';
}else if(is_chrome){
tooltipAccessKeyPrefix=is_chrome_mac?'ctrl-option-':'alt-';
}else if(!is_safari_win&&is_safari&&webkit_version>526){
tooltipAccessKeyPrefix='ctrl-alt-';
}else if(!is_safari_win&&(is_safari
||clientPC.indexOf('mac')!=-1
||clientPC.indexOf('konqueror')!=-1)){
tooltipAccessKeyPrefix='ctrl-';
}else if(is_ff2){
tooltipAccessKeyPrefix='alt-shift-';
}
window.tooltipAccessKeyRegexp=/\[(ctrl-)?(alt-)?(shift-)?(esc-)?(.)\]$/;

window.updateTooltipAccessKeys=function(nodeList){
if(!nodeList){



var linkContainers=[
'column-one',
'mw-head','mw-panel','p-logo'
];
for(var i in linkContainers){
var linkContainer=document.getElementById(linkContainers[i]);
if(linkContainer){
updateTooltipAccessKeys(linkContainer.getElementsByTagName('a'));
}
}

updateTooltipAccessKeys(document.getElementsByTagName('input'));
updateTooltipAccessKeys(document.getElementsByTagName('label'));
return;
}
for(var i=0;i<nodeList.length;i++){
var element=nodeList[i];
var tip=element.getAttribute('title');
if(tip&&tooltipAccessKeyRegexp.exec(tip)){
tip=tip.replace(tooltipAccessKeyRegexp,
'['+tooltipAccessKeyPrefix+"$5]");
element.setAttribute('title',tip);
}
}
};

window.addPortletLink=function(portlet,href,text,id,tooltip,accesskey,nextnode){
var root=document.getElementById(portlet);
if(!root){
return null;
}
var uls=root.getElementsByTagName('ul');
var node;
if(uls.length>0){
node=uls[0];
}else{
node=document.createElement('ul');
var lastElementChild=null;
for(var i=0;i<root.childNodes.length;++i){
if(root.childNodes[i].nodeType==1){
lastElementChild=root.childNodes[i];
}
}
if(lastElementChild&&lastElementChild.nodeName.match(/div/i)){

lastElementChild.appendChild(node);
}else{
root.appendChild(node);
}
}
if(!node){
return null;
}

root.className=root.className.replace(/(^| )emptyPortlet( |$)/,"$2");
var link=document.createElement('a');
link.appendChild(document.createTextNode(text));
link.href=href;

var span=document.createElement('span');
span.appendChild(link);
var item=document.createElement('li');
item.appendChild(span);
if(id){
item.id=id;
}
if(accesskey){
link.setAttribute('accesskey',accesskey);
tooltip+=' ['+accesskey+']';
}
if(tooltip){
link.setAttribute('title',tooltip);
}
if(accesskey&&tooltip){
updateTooltipAccessKeys(new Array(link));
}
if(nextnode&&nextnode.parentNode==node){
node.insertBefore(item,nextnode);
}else{
node.appendChild(item);
}
return item;
};
window.getInnerText=function(el){
if(el.getAttribute('data-sort-value')!==null){
return el.getAttribute('data-sort-value');
}
if(typeof el=='string'){
return el;
}
if(typeof el=='undefined'){
return el;
}
if(el.textContent){
return el.textContent;
}
if(el.innerText){
return el.innerText;
}
var str='';
var cs=el.childNodes;
var l=cs.length;
for(var i=0;i<l;i++){
switch(cs[i].nodeType){
case 1:
str+=ts_getInnerText(cs[i]);
break;
case 3:
str+=cs[i].nodeValue;
break;
}
}
return str;
};

window.ta=[];
window.akeytt=function(doId){
};
window.checkboxes=undefined;
window.lastCheckbox=undefined;
window.setupCheckboxShiftClick=function(){
checkboxes=[];
lastCheckbox=null;
var inputs=document.getElementsByTagName('input');
addCheckboxClickHandlers(inputs);
};
window.addCheckboxClickHandlers=function(inputs,start){
if(!start){
start=0;
}
var finish=start+250;
if(finish>inputs.length){
finish=inputs.length;
}
for(var i=start;i<finish;i++){
var cb=inputs[i];
if(!cb.type||cb.type.toLowerCase()!='checkbox'||(' '+cb.className+' ').indexOf(' noshiftselect ')!=-1){
continue;
}
var end=checkboxes.length;
checkboxes[end]=cb;
cb.index=end;
addClickHandler(cb,checkboxClickHandler);
}
if(finish<inputs.length){
setTimeout(function(){
addCheckboxClickHandlers(inputs,finish);
},200);
}
};
window.checkboxClickHandler=function(e){
if(typeof e=='undefined'){
e=window.event;
}
if(!e.shiftKey||lastCheckbox===null){
lastCheckbox=this.index;
return true;
}
var endState=this.checked;
var start,finish;
if(this.index<lastCheckbox){
start=this.index+1;
finish=lastCheckbox;
}else{
start=lastCheckbox;
finish=this.index-1;
}
for(var i=start;i<=finish;++i){
checkboxes[i].checked=endState;
if(i>start&&typeof checkboxes[i].onchange=='function'){
checkboxes[i].onchange();
}
}
lastCheckbox=this.index;
return true;
};

window.getElementsByClassName=function(oElm,strTagName,oClassNames){
var arrReturnElements=new Array();
if(typeof(oElm.getElementsByClassName)=='function'){

var arrNativeReturn=oElm.getElementsByClassName(oClassNames);
if(strTagName=='*'){
return arrNativeReturn;
}
for(var h=0;h<arrNativeReturn.length;h++){
if(arrNativeReturn[h].tagName.toLowerCase()==strTagName.toLowerCase()){
arrReturnElements[arrReturnElements.length]=arrNativeReturn[h];
}
}
return arrReturnElements;
}
var arrElements=(strTagName=='*'&&oElm.all)?oElm.all:oElm.getElementsByTagName(strTagName);
var arrRegExpClassNames=new Array();
if(typeof oClassNames=='object'){
for(var i=0;i<oClassNames.length;i++){
arrRegExpClassNames[arrRegExpClassNames.length]=
new RegExp("(^|\\s)"+oClassNames[i].replace(/\-/g,"\\-")+"(\\s|$)");
}
}else{
arrRegExpClassNames[arrRegExpClassNames.length]=
new RegExp("(^|\\s)"+oClassNames.replace(/\-/g,"\\-")+"(\\s|$)");
}
var oElement;
var bMatchesAll;
for(var j=0;j<arrElements.length;j++){
oElement=arrElements[j];
bMatchesAll=true;
for(var k=0;k<arrRegExpClassNames.length;k++){
if(!arrRegExpClassNames[k].test(oElement.className)){
bMatchesAll=false;
break;
}
}
if(bMatchesAll){
arrReturnElements[arrReturnElements.length]=oElement;
}
}
return(arrReturnElements);
};
window.redirectToFragment=function(fragment){
var match=navigator.userAgent.match(/AppleWebKit\/(\d+)/);
if(match){
var webKitVersion=parseInt(match[1]);
if(webKitVersion<420){


return;
}
}
if(window.location.hash==''){
window.location.hash=fragment;






if(is_gecko){
addOnloadHook(function(){
if(window.location.hash==fragment){
window.location.hash=fragment;
}
});
}
}
};

window.ts_image_path=stylepath+'/common/images/';
window.ts_image_up='sort_up.gif';
window.ts_image_down='sort_down.gif';
window.ts_image_none='sort_none.gif';
window.ts_europeandate=wgContentLanguage!='en';
window.ts_alternate_row_colors=false;
window.ts_number_transform_table=null;
window.ts_number_regex=null;
window.sortables_init=function(){
var idnum=0;

var tables=getElementsByClassName(document,'table','sortable');
for(var ti=0;ti<tables.length;ti++){
if(!tables[ti].id){
tables[ti].setAttribute('id','sortable_table_id_'+idnum);
++idnum;
}
ts_makeSortable(tables[ti]);
}
};
window.ts_makeSortable=function(table){
var firstRow;
if(table.rows&&table.rows.length>0){
if(table.tHead&&table.tHead.rows.length>0){
firstRow=table.tHead.rows[table.tHead.rows.length-1];
}else{
firstRow=table.rows[0];
}
}
if(!firstRow){
return;
}

for(var i=0;i<firstRow.cells.length;i++){
var cell=firstRow.cells[i];
if((' '+cell.className+' ').indexOf(' unsortable ')==-1){
$(cell).append('<a href="#" class="sortheader" '
+'onclick="ts_resortTable(this);return false;">'
+'<span class="sortarrow">'
+'<img src="'
+ts_image_path
+ts_image_none
+'" alt="&darr;"/></span></a>');
}
}
if(ts_alternate_row_colors){
ts_alternate(table);
}
};
window.ts_getInnerText=function(el){
return getInnerText(el);
};
window.ts_resortTable=function(lnk){

var span=lnk.getElementsByTagName('span')[0];
var td=lnk.parentNode;
var tr=td.parentNode;
var column=td.cellIndex;
var table=tr.parentNode;
while(table&&!(table.tagName&&table.tagName.toLowerCase()=='table')){
table=table.parentNode;
}
if(!table){
return;
}
if(table.rows.length<=1){
return;
}

if(ts_number_transform_table===null){
ts_initTransformTable();
}


var rowStart=(table.tHead&&table.tHead.rows.length>0?0:1);
var bodyRows=0;
if(rowStart==0&&table.tBodies){
for(var i=0;i<table.tBodies.length;i++){
bodyRows+=table.tBodies[i].rows.length;
}
if(bodyRows<table.rows.length)
rowStart=1;
}
var itm='';
for(var i=rowStart;i<table.rows.length;i++){
if(table.rows[i].cells.length>column){
itm=ts_getInnerText(table.rows[i].cells[column]);
itm=itm.replace(/^[\s\xa0]+/,'').replace(/[\s\xa0]+$/,'');
if(itm!=''){
break;
}
}
}

var sortfn=ts_sort_generic;
var preprocessor=ts_toLowerCase;
if(/^\d\d[\/. -][a-zA-Z]{3}[\/. -]\d\d\d\d$/.test(itm)){
preprocessor=ts_dateToSortKey;
}else if(/^\d\d[\/.-]\d\d[\/.-]\d\d\d\d$/.test(itm)){
preprocessor=ts_dateToSortKey;
}else if(/^\d\d[\/.-]\d\d[\/.-]\d\d$/.test(itm)){
preprocessor=ts_dateToSortKey;

}else if(/(^([-\u2212] *)?[\u00a3$\u20ac\u00a4\u00a5]|\u00a2$)/.test(itm)){
preprocessor=ts_currencyToSortKey;
}else if(ts_number_regex.test(itm)){
preprocessor=ts_parseFloat;
}
var reverse=(span.getAttribute('sortdir')=='down');
var newRows=new Array();
var staticRows=new Array();
for(var j=rowStart;j<table.rows.length;j++){
var row=table.rows[j];
if((' '+row.className+' ').indexOf(' unsortable ')<0){
var keyText=ts_getInnerText(row.cells[column]);
if(keyText===undefined){
keyText='';
}
var oldIndex=(reverse?-j:j);
var preprocessed=preprocessor(keyText.replace(/^[\s\xa0]+/,'').replace(/[\s\xa0]+$/,''));
newRows[newRows.length]=new Array(row,preprocessed,oldIndex);
}else{
staticRows[staticRows.length]=new Array(row,false,j-rowStart);
}
}
newRows.sort(sortfn);
var arrowHTML;
if(reverse){
arrowHTML='<img src="'+ts_image_path+ts_image_down+'" alt="&darr;"/>';
newRows.reverse();
span.setAttribute('sortdir','up');
}else{
arrowHTML='<img src="'+ts_image_path+ts_image_up+'" alt="&uarr;"/>';
span.setAttribute('sortdir','down');
}
for(var i=0;i<staticRows.length;i++){
var row=staticRows[i];
newRows.splice(row[2],0,row);
}


for(var i=0;i<newRows.length;i++){
if((' '+newRows[i][0].className+' ').indexOf(' sortbottom ')==-1){
table.tBodies[0].appendChild(newRows[i][0]);
}
}

for(var i=0;i<newRows.length;i++){
if((' '+newRows[i][0].className+' ').indexOf(' sortbottom ')!=-1){
table.tBodies[0].appendChild(newRows[i][0]);
}
}

var spans=getElementsByClassName(tr,'span','sortarrow');
for(var i=0;i<spans.length;i++){
spans[i].innerHTML='<img src="'+ts_image_path+ts_image_none+'" alt="&darr;"/>';
}
span.innerHTML=arrowHTML;
if(ts_alternate_row_colors){
ts_alternate(table);
}
};
window.ts_initTransformTable=function(){
if(typeof wgSeparatorTransformTable=='undefined'
||(wgSeparatorTransformTable[0]==''&&wgDigitTransformTable[2]==''))
{
var digitClass="[0-9,.]";
ts_number_transform_table=false;
}else{
ts_number_transform_table={};


var ascii=wgSeparatorTransformTable[0].split("\t");
var localised=wgSeparatorTransformTable[1].split("\t");
for(var i=0;i<ascii.length;i++){
ts_number_transform_table[localised[i]]=ascii[i];
}

ascii=wgDigitTransformTable[0].split("\t");
localised=wgDigitTransformTable[1].split("\t");
for(var i=0;i<ascii.length;i++){
ts_number_transform_table[localised[i]]=ascii[i];
}

var digits=['0','1','2','3','4','5','6','7','8','9',',','\\.'];
var maxDigitLength=1;
for(var digit in ts_number_transform_table){

digits.push(
digit.replace(/[\\\\$\*\+\?\.\(\)\|\{\}\[\]\-]/,
function(s){return'\\'+s;})
);
if(digit.length>maxDigitLength){
maxDigitLength=digit.length;
}
}
if(maxDigitLength>1){
var digitClass='['+digits.join('',digits)+']';
}else{
var digitClass='('+digits.join('|',digits)+')';
}
}


ts_number_regex=new RegExp(
"^("+
"[-+\u2212]?[0-9][0-9,]*(\\.[0-9,]*)?(E[-+\u2212]?[0-9][0-9,]*)?"+
"|"+
"[-+\u2212]?"+digitClass+"+%?"+
")$","i"
);
};
window.ts_toLowerCase=function(s){
return s.toLowerCase();
};
window.ts_dateToSortKey=function(date){

if(date.length==11){
switch(date.substr(3,3).toLowerCase()){
case'jan':
var month='01';
break;
case'feb':
var month='02';
break;
case'mar':
var month='03';
break;
case'apr':
var month='04';
break;
case'may':
var month='05';
break;
case'jun':
var month='06';
break;
case'jul':
var month='07';
break;
case'aug':
var month='08';
break;
case'sep':
var month='09';
break;
case'oct':
var month='10';
break;
case'nov':
var month='11';
break;
case'dec':
var month='12';
break;

}
return date.substr(7,4)+month+date.substr(0,2);
}else if(date.length==10){
if(ts_europeandate==false){
return date.substr(6,4)+date.substr(0,2)+date.substr(3,2);
}else{
return date.substr(6,4)+date.substr(3,2)+date.substr(0,2);
}
}else if(date.length==8){
var yr=date.substr(6,2);
if(parseInt(yr)<50){
yr='20'+yr;
}else{
yr='19'+yr;
}
if(ts_europeandate==true){
return yr+date.substr(3,2)+date.substr(0,2);
}else{
return yr+date.substr(0,2)+date.substr(3,2);
}
}
return'00000000';
};
window.ts_parseFloat=function(s){
if(!s){
return 0;
}
if(ts_number_transform_table!=false){
var newNum='',c;
for(var p=0;p<s.length;p++){
c=s.charAt(p);
if(c in ts_number_transform_table){
newNum+=ts_number_transform_table[c];
}else{
newNum+=c;
}
}
s=newNum;
}
var num=parseFloat(s.replace(/[, ]/g,'').replace("\u2212",'-'));
return(isNaN(num)?-Infinity:num);
};
window.ts_currencyToSortKey=function(s){
return ts_parseFloat(s.replace(/[^-\u22120-9.,]/g,''));
};
window.ts_sort_generic=function(a,b){
return a[1]<b[1]?-1:a[1]>b[1]?1:a[2]-b[2];
};
window.ts_alternate=function(table){

var tableBodies=table.getElementsByTagName('tbody');

for(var i=0;i<tableBodies.length;i++){

var tableRows=tableBodies[i].getElementsByTagName('tr');


for(var j=0;j<tableRows.length;j++){

var oldClasses=tableRows[j].className.split(' ');
var newClassName='';
for(var k=0;k<oldClasses.length;k++){
if(oldClasses[k]!=''&&oldClasses[k]!='even'&&oldClasses[k]!='odd'){
newClassName+=oldClasses[k]+' ';
}
}
tableRows[j].className=newClassName+(j%2==0?'even':'odd');
}
}
};


window.jsMsg=function(message,className){
if(!document.getElementById){
return false;
}



var messageDiv=document.getElementById('mw-js-message');
if(!messageDiv){
messageDiv=document.createElement('div');
if(document.getElementById('column-content')
&&document.getElementById('content')){

document.getElementById('content').insertBefore(
messageDiv,
document.getElementById('content').firstChild
);
}else if(document.getElementById('content')
&&document.getElementById('article')){

document.getElementById('article').insertBefore(
messageDiv,
document.getElementById('article').firstChild
);
}else{
return false;
}
}
messageDiv.setAttribute('id','mw-js-message');
messageDiv.style.display='block';
if(className){
messageDiv.setAttribute('class','mw-js-message-'+className);
}
if(typeof message==='object'){
while(messageDiv.hasChildNodes()){
messageDiv.removeChild(messageDiv.firstChild);
}
messageDiv.appendChild(message);
}else{
messageDiv.innerHTML=message;
}
return true;
};

window.injectSpinner=function(element,id){
var spinner=document.createElement('img');
spinner.id='mw-spinner-'+id;
spinner.src=stylepath+'/common/images/spinner.gif';
spinner.alt=spinner.title='...';
if(element.nextSibling){
element.parentNode.insertBefore(spinner,element.nextSibling);
}else{
element.parentNode.appendChild(spinner);
}
};

window.removeSpinner=function(id){
var spinner=document.getElementById('mw-spinner-'+id);
if(spinner){
spinner.parentNode.removeChild(spinner);
}
};
window.runOnloadHook=function(){

if(doneOnloadHook||!(document.getElementById&&document.getElementsByTagName)){
return;
}


doneOnloadHook=true;
updateTooltipAccessKeys(null);
setupCheckboxShiftClick();
jQuery(document).ready(sortables_init);

for(var i=0;i<onloadFuncts.length;i++){
onloadFuncts[i]();
}
};

window.addHandler=function(element,attach,handler){
if(element.addEventListener){
element.addEventListener(attach,handler,false);
}else if(element.attachEvent){
element.attachEvent('on'+attach,handler);
}
};
window.hookEvent=function(hookName,hookFunct){
addHandler(window,hookName,hookFunct);
};

window.addClickHandler=function(element,handler){
addHandler(element,'click',handler);
};

window.removeHandler=function(element,remove,handler){
if(window.removeEventListener){
element.removeEventListener(remove,handler,false);
}else if(window.detachEvent){
element.detachEvent('on'+remove,handler);
}
};


hookEvent('load',runOnloadHook);
if(ie6_bugs){
importScriptURI(stylepath+'/common/IEFixes.js');
}
showTocToggle();
},{},{"showtoc":"show","hidetoc":"hide"});
mediaWiki.loader.implement("mediawiki.util",function($,mw){
(function($,mw){
mediaWiki.util={

'initialised':false,
'init':function(){
if(this.initialised===false){
this.initialised=true;

$(function(){

var profile=$.client.profile();



if(profile.name=='opera'){
mw.util.tooltipAccessKeyPrefix='shift-esc-';

}else if(profile.name=='chrome'){

mw.util.tooltipAccessKeyPrefix=(profile.platform=='mac'
?'ctrl-option-':'alt-');

}else if(profile.platform!=='win'
&&profile.name=='safari'
&&profile.layoutVersion>526)
{
mw.util.tooltipAccessKeyPrefix='ctrl-alt-';


}else if(!(profile.platform=='win'&&profile.name=='safari')
&&(profile.name=='safari'
||profile.platform=='mac'
||profile.name=='konqueror')){
mw.util.tooltipAccessKeyPrefix='ctrl-';

}else if(profile.name=='firefox'&&profile.versionBase=='2'){
mw.util.tooltipAccessKeyPrefix='alt-shift-';
}

$('input[type=checkbox]:not(.noshiftselect)').checkboxShiftClick();

if(!('placeholder'in document.createElement('input'))){
$('input[placeholder]').placeholder();
}

if($('#bodyContent').length){
mw.util.$content=$('#bodyContent');
}else if($('#article').length){
mw.util.$content=$('#article');
}else{
mw.util.$content=$('#content');
}
});
return true;
}
return false;
},


'rawurlencode':function(str){
str=(str+'').toString();
return encodeURIComponent(str)
.replace(/!/g,'%21').replace(/'/g,'%27').replace(/\(/g,'%28')
.replace(/\)/g,'%29').replace(/\*/g,'%2A').replace(/~/g,'%7E');
},

'wikiUrlencode':function(str){
return this.rawurlencode(str)
.replace(/%20/g,'_').replace(/%3A/g,':').replace(/%2F/g,'/');
},

'addCSS':function(text){
var s=document.createElement('style');
s.type='text/css';
s.rel='stylesheet';
if(s.styleSheet){
s.styleSheet.cssText=text;
}else{
s.appendChild(document.createTextNode(text+''));
}
document.getElementsByTagName("head")[0].appendChild(s);
return s.sheet||s;
},

'wikiGetlink':function(str){
return wgServer+wgArticlePath.replace('$1',this.wikiUrlencode(str));
},

'getParamValue':function(param,url){
url=url?url:document.location.href;

var re=new RegExp('[^#]*[&?]'+$.escapeRE(param)+'=([^&#]*)');
var m=re.exec(url);
if(m&&m.length>1){
return decodeURIComponent(m[1]);
}
return null;
},



'tooltipAccessKeyPrefix':'alt-',

'tooltipAccessKeyRegexp':/\[(ctrl-)?(alt-)?(shift-)?(esc-)?(.)\]$/,

'updateTooltipAccessKeys':function(nodeList){
var $nodes;
if(nodeList instanceof jQuery){
$nodes=nodeList;
}else if(nodeList){
$nodes=$(nodeList);
}else{


this.updateTooltipAccessKeys(
$('#column-one a, #mw-head a, #mw-panel a, #p-logo a'));

this.updateTooltipAccessKeys($('input'));
this.updateTooltipAccessKeys($('label'));
return;
}
$nodes.each(function(i){
var tip=$(this).attr('title');
if(!!tip&&mw.util.tooltipAccessKeyRegexp.exec(tip)){
tip=tip.replace(mw.util.tooltipAccessKeyRegexp,
'['+mw.util.tooltipAccessKeyPrefix+"$5]");
$(this).attr('title',tip);
}
});
},


'$content':null,

'addPortletLink':function(portlet,href,text,id,tooltip,accesskey,nextnode){

if(arguments.length<3){
return null;
}

var $link=$('<a />').attr('href',href).text(text);


switch(skin){
case'standard':
case'cologneblue':
$("#quickbar").append($link.after('<br />'));
return $link.get(0);
case'nostalgia':
$("#searchform").before($link).before(' &#124; ');
return $link.get(0);
default:


var $portlet=$('#'+portlet);
if($portlet.length===0){
return null;
}

var $ul=$portlet.find('ul').eq(0);

if($ul.length===0){

if($portlet.find('div').length===0){
$portlet.append('<ul/>');
}else{


$portlet.find('div').eq(-1).append('<ul/>');
}

$ul=$portlet.find('ul').eq(0);
}

if($ul.length===0){
return null;
}

$portlet.removeClass('emptyPortlet');


var $item=$link.wrap('<li><span /></li>').parent().parent();

if(id){
$item.attr('id',id);
}
if(accesskey){
$link.attr('accesskey',accesskey);
tooltip+=' ['+accesskey+']';
}
if(tooltip){
$link.attr('title',tooltip);
}
if(accesskey&&tooltip){
this.updateTooltipAccessKeys($link);
}

if(nextnode&&nextnode.parentNode==$ul.get(0)){
$(nextnode).before($item);
}else{


if($ul.find(nextnode).length===0){
$ul.append($item);
}else{

$ul.find(nextnode).eq(0).before($item);
}
}
return $item.get(0);
}
},

'validateEmail':function(mailtxt){
if(mailtxt===''){
return null;
}


var rfc5322_atext="a-z0-9!#$%&'*+\\-/=?^_`{|}~",

rfc1034_ldh_str="a-z0-9\\-",
HTML5_email_regexp=new RegExp(

'^'
+

'['+rfc5322_atext+'\\.]+'
+

'@'
+

'['+rfc1034_ldh_str+']+'
+

'(?:\\.['+rfc1034_ldh_str+']+)*'
+

'$',

'i'
);
return(null!==mailtxt.match(HTML5_email_regexp));
}
};
mediaWiki.util.init();
})(jQuery,mediaWiki);
},{},{});


/* cache key: enwiki:resourceloader:filter:minify-js:3:1faddf2b7cc37a0309e97f07271b4958 */