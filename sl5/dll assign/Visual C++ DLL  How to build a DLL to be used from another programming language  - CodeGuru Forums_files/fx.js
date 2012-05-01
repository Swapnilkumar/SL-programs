//  Copyright (c) 2010 QuinStreet Inc. All Rights Reserved.
//  prod:45
function zzshuffle(xa){
for(var y9,tmp,i=xa.length;i;rnd=parseInt(Math.random()*i),tmp=xa[--i],xa[i]=xa[rnd],xa[rnd]=tmp);
return xa;
}
function zzIndexOfList(ll,obj){
for(var i=0;i<ll.length;i++){
if(ll[i]==obj){
return i;
}}
return-1;
}
function zzrnd(ii){
return(Math.floor((Math.random()* 10000000000006)% ii));
}
if(typeof zzcompete!='undefined'){
var zzshufflecats=zzshuffle(zzcompete.allcats);var ii;
zzcompete.donecats=[];
zzcompete.donecamps=[];
zzcompete.chosencamps=[];
zzcompete.chosenads=[];
zzcompete.chosencomp='';
zzcompete.chosencampstr='';
zzcompete.chosenadsstr='';
for(ii=0;ii<zzshufflecats.length;ii++){
cat=zzshufflecats[ii];
if(zzIndexOfList(zzcompete.donecats,cat)<0){
var rnd=zzrnd(zzcompete.cat2camps[cat].length);var d7=zzcompete.cat2camps[cat][rnd];
if(zzIndexOfList(zzcompete.donecamps,d7)<0){
zzcompete.chosencamps.push(d7);
for(var g8 in zzcompete.camp2cats[d7]){
zzcompete.donecats.push(zzcompete.camp2cats[d7][g8]);
for(var v4 in zzcompete.cat2camps[g8]){
zzcompete.donecamps.push(v4);
}}}}}
if(zzcompete.compcamps.length>0){
var rnd=zzrnd(zzcompete.campcount);
if(rnd<zzcompete.compcamps.length){
zzcompete.chosencomp=zzcompete.compcamps[rnd];
}}
if(zzcompete.chosencamps.length>0){
zzcompete.chosencampstr=zzcompete.chosencamps.join("~");
}
var m8=[];var rnd;
for(var v4 in zzcompete.exads){
var rnd=zzrnd(zzcompete.exads[v4].length);var y8=zzcompete.exads[v4].length;
while(y8-->0){
var m9=zzcompete.exads[v4][rnd];
tag=m9.replace(/ad[0-9]+/i,'');
if(zzIndexOfList(m8,tag)<0){
m8.push(tag);
break;
}
else{
rnd=(rnd+1)% zzcompete.exads[v4].length;
}}
zzcompete.chosenads.push(zzcompete.exads[v4][rnd]);
}
if(zzcompete.chosenads.length>0){
zzcompete.chosenadstr=zzcompete.chosenads.join("~");
}}