var _msdn = [ ["default.aspx",'1175',0.21],["library",'1176',0.016],["ie",'1177',0.3],["netframework",'1178',0.21],["windowsazure",'1179',0.3],["magazine",'1180',0.21], ["office",'1181',0.3],["sharepoint",'1183',0.3],["sqlserver",'1184',0.3],["subscriptions",'1185',0.21],["vbasic",'1186',0.3], ["vcsharp",'1187',0.3],["visualc",'1188',0.3],["vstudio",'1189',0.3],["windowsphone",'1191',0.3],["windows",'1190',0.3]  ];
var _technet = [ ["default.aspx",'1219',0.152],["library",'1192',0.152],["windowsserver",'1194',0.152],["forefront",'1011',0.3],["office",'1195',0.152], ["sharepoint",'1196',0.3],["sqlserver",'1197',0.3],["systemcenter",'1198',0.152],["windows",'1199',0.04],["scriptcenter",'1200',0.152],["security",'1202',0.152], ["sysinternals",'1203',0.04],["virtualization",'1205',0.3],["subscriptions",'1206',0.152],["magazine",'623',0.152],["ie",'1220',0.3],["exchange",'1221',0.3],["edge",'1222',0.152]  ];
var _SC_msdn = [ ["Forums/en-US/category",'1207',0.25] ];
var _SC_technet = [ ["Forums/en-US/category",'1208',0.152],["Forums/en/itcg/threads",'1201',0.152] ]; 
var _Freq,_Site,srchMSForumIroot="",_wtsp="",_centerW=95,_networkW=20,_spyglassW=5,_halt=false;
if(typeof(wtsp)&& typeof(wtsp)!='undefined'){ _wtsp=wtsp.toLowerCase(); if(/_technet_library_windowsserver/i.test(_wtsp)){_wtsp="_technet_library_windowsserver_";} };
var SR_url = window.location.toString().toLowerCase();
var SR_url_stripped = SR_url.split("?");
if(SR_url_stripped[0].search('social.msdn.microsoft.com') != -1){
	_Site = 1207;
	setSiteFreq("http://social.msdn.microsoft.com/", _SC_msdn);//Social MSDN center survey check
	getIroot_resetFreq();
}else if(SR_url_stripped[0].search('social.technet.microsoft.com/forums/') != -1){
	_Site = 1208;
	setSiteFreq("http://social.technet.microsoft.com/", _SC_technet);//Social TechNet center survey check*/
	getIroot_resetFreq();
}else if(SR_url_stripped[0].search('msdn.microsoft.com') != -1){
	setSiteFreq("http://msdn.microsoft.com/en-us/", _msdn);//MSDN center survey check
	checkWTSP();
}else if(SR_url_stripped[0].search('technet.microsoft.com') != -1){
	setSiteFreq("http://technet.microsoft.com/en-us/", _technet);//TechNet center survey check
	_networkW=10;
	checkWTSP();
}
function setSiteFreq(_url, _array){
	for(i=0; i< _array.length; i++){
		if(SR_url.search(_url + _array[i][0].toString().toLowerCase()) != -1){	
			_Site = _array[i][1];
			_Freq = _array[i][2];
			break;
		}
	}
}

function checkWTSP(){
	if(_Site == '1176'){
		if(!(_wtsp=="msdnlib_webdev" || _wtsp=="msdnlib_devtools_lang" || _wtsp=="windowsazure" || _wtsp=="_msdn_library_sqlserver_" || _wtsp=="_msdnlib_w32_com" || _wtsp=="msdnlib_w32_com")){
			_centerW = 0;		_halt=true;		//_networkW = 100;
		}
		if(_wtsp=="msdnlib_w32_com"){
			_Freq=0.157;
		}else if(_wtsp=="msdnlib_webdev" || _wtsp=="msdnlib_devtools_lang"){
			_Freq=0.016;
		}
	}else if(_Site=='1192'){
		if(!(_wtsp=="_technet_library_windowsserver_" || _wtsp=="_technet_prodtechnol_office_" || _wtsp=="_technet_library_sqlserver_" || _wtsp=="_sto_technet_systemcenter_" || _wtsp=="_technet_library_win7_" || _wtsp=="scriptcenter_technet" || _wtsp=="_technet_library_security_" || _wtsp=="_technet_library_ie_")){	
				_centerW = 0; _networkW=95; _spyglassW=5;
		}
		if(_wtsp=="_technet_library_win7_"){
			_Freq=0.04;
		}
	}else if(_Site=='1187'){
			_centerW = 100; _spyglassW=0;
	}
}
function getIroot_resetFreq(){
	if(document.getElementsByName('Search.MSForums.Iroot')[0] && document.getElementsByName('Search.MSForums.Iroot')[0].getAttribute('content') != null){
		srchMSForumIroot = document.getElementsByName('Search.MSForums.Iroot')[0].getAttribute('content');
		if(/systemcenter/i.test(srchMSForumIroot)){srchMSForumIroot="systemcenter";}
		if(_Site == '1207'){
			if(srchMSForumIroot=="windowsazure" || srchMSForumIroot=="office" || srchMSForumIroot=="sharepoint" || srchMSForumIroot=="sqlserver"){
				_Freq=0.3; _centerW = 100; 	_spyglassW=0;//_networkW = 20;
			}else if(srchMSForumIroot=="ie" || srchMSForumIroot=="vbasic" || srchMSForumIroot=="vcsharp" || srchMSForumIroot=="visualc" || srchMSForumIroot=="vstudio" || srchMSForumIroot=="windows"){	
				_Freq=0.3;	_centerW = 100; _spyglassW=0;//	_networkW = 20;
			}else if(/netframework/i.test(srchMSForumIroot)){	
				_Freq=0.21;	_centerW = 100; _spyglassW=0;//	_networkW = 20;
			}else{	
				_Freq=0.1218;	_centerW = 0; _spyglassW=0;//_networkW = 100;
			}
		}else if(_Site == '1208'){
			if(srchMSForumIroot=="windowsserver" || srchMSForumIroot=="office" || srchMSForumIroot=="systemcenter" || srchMSForumIroot=="scriptcenter" || srchMSForumIroot=="forefront" || srchMSForumIroot=="sharepoint" || srchMSForumIroot=="sqlserver" || srchMSForumIroot=="exchange"){	
				_Freq=0.152; //_centerW = 80; _networkW = 20;
			}else{	
				_halt=true; //_Freq=0.04;	_centerW = 0; _networkW = 100;
			}
		}
		
	}
}
var _raw_params = 'Search.MSForums.Iroot='+srchMSForumIroot+"&wtsp="+ _wtsp;
//alert("Site=" + _Site + "\n Freq=" + _Freq + "\nCenterWeight="+_centerW + "; spyglassWeight="+_spyglassW +"\n" +_raw_params);
COMSCORE.SiteRecruit.Broker.config={version:"4.6.3",testMode:false,cookie:{name:"msresearch",path:"/",domain:".microsoft.com",duration:90,rapidDuration:0,expireDate:""},prefixUrl:"",mapping:[{m:"//careers\\.microsoft\\.com/careers/en/fr/",c:"inv_c_p37116158-EN-FR-995.js",f:1,p:0},{m:"//[\\w\\.-]+/careers/en/ru/",c:"inv_c_p37116158-EN-RU.js",f:0.5,p:0},{m:"//careers\\.microsoft\\.com/careers/fr/fr/",c:"inv_c_p37116158-FR-997.js",f:1,p:0},{m:"//[\\w\\.-]+/careers/ru/ru/",c:"inv_c_p37116158-RU-RU-983.js",f:0.5,p:0},{m:"//[\\w\\.-]+/careers/en/in/",c:"inv_c_p37116158-EN-IN-964.js",f:0.25,p:0},{m:"//[\\w\\.-]+/careers/en/it/",c:"inv_c_p37116158-EN-IT-962.js",f:0.5,p:0},{m:"//careers\\.microsoft\\.com/careers/en/us/home\\.aspx",c:"inv_c_p37116158-EN-US-899.js",f:0.5,p:1},{m:"//[\\w\\.-]+/careers/it/it/",c:"inv_c_p37116158-IT-IT-960.js",f:0.5,p:0},{m:"//careers.microsoft\\.com/search\\.aspx\\?.*gl=fra&lang=fr",c:"inv_c_p37116158-FR-998.js",f:1,p:0},{m:"//[\\w\\.-]+/search\\.aspx.*\\?gl=rus&lang=en",c:"inv_c_p37116158-EN-RU-982.js",f:0.5,p:0},{m:"careers\\.microsoft\\.com/careers/en/jp/",c:"inv_c_p37116158-EN-JP-521.js",f:1,p:1},{m:"//careers\\.microsoft\\.com/careers/ja/jp/",c:"inv_c_p37116158-JA-JP-519.js",f:1,p:1},{m:"//careers\\.microsoft\\.com/search\\.aspx\\?.*gl=fra&lang=en",c:"inv_c_p37116158-EN-FR-996.js",f:1,p:0},{m:"//[\\w\\.-]+/search\\.aspx\\?gl=IND",c:"inv_c_p37116158-EN-IN.js",f:0.5,p:0},{m:"careers.microsoft.com/search\\.aspx\\?.*gl=ita&lang=en",c:"inv_c_p37116158-EN-IT-963.js",f:0.5,p:0},{m:"careers.microsoft.com/search\\.aspx\\?.*gl=ita&lang=it",c:"inv_c_p37116158-IT-IT-961.js",f:0.5,p:0},{m:"//careers\\.microsoft\\.com/search\\.aspx\\?gl=jpn&lang=en",c:"inv_c_p37116158-EN-JP-522.js",f:1,p:0},{m:"//careers\\.microsoft\\.com/search\\.aspx\\?gl=jpn&lang=ja",c:"inv_c_p37116158-JA-JP-520.js",f:1,p:0},{m:"//[\\w\\.-]+/search\\.aspx.*\\?gl=rus&lang=ru",c:"inv_c_p37116158-RU-RU-984.js",f:0.5,p:0},{m:"//careers\\.microsoft\\.com/search\\.aspx\\?.*gl=usa",c:"inv_c_p37116158-EN-US-890.js",f:0.5,p:1},{m:"/(sr-msdn|msdnstage|msdntest|msdnlive|msdn\\.microsoft)[\\w\\.-]+/de-de/",c:"inv_c_MSDN-p15466742-DE-DE.js",f:0.0096,p:1},{m:"/(sr-msdn|msdnstage|msdntest|msdnlive|msdn\\.microsoft)[\\w\\.-]+/en-au",c:"inv_c_MSDN-p15466742-en-au.js",f:0.5,p:1},{m:"/(sr-msdn|msdnstage|msdntest|msdnlive|msdn\\.microsoft)[\\w\\.-]+/en-us/((default\\.aspx)|(windows/)|(library|ie|netframework|windowsazure|magazine|office|sharepoint|sqlserver|subscriptions|vbasic|vcsharp|visualc|vstudio|windowsphone))",c:"inv_c_MSDN-p77596864_TIER5.js",f:_Freq,p:2,halt:_halt},{m:"/(sr-msdn|msdnstage|msdntest|msdnlive|msdn\\.microsoft)[\\w\\.-]+/fr-fr/",c:"inv_c_MSDN-p15466742-fr-fr.js",f:0.017,p:0},{m:"/(sr-msdn|msdnstage|msdntest|msdnlive|msdn\\.microsoft)[\\w\\.-]+/ja-jp/",c:"inv_c_MSDN-p15466742-JA.js",f:0.0012,p:0},{m:"(.*?social\\.msdn\\.microsoft)[\\w\\.-/]+/Forums/en-(us|US)/category",c:"inv_c_SC-MSDN-p77596864.js",f:0.3,p:2},{m:"(.*?social\\.technet\\.microsoft|sr-technet)[\\w\\.-]+/forums/en/(ITCG|itcg)/threads",c:"inv_c_SC-TechNet-p77596864.js",f:0.152,p:1},{m:"(.*?social\\.technet\\.microsoft|sr-technet)[\\w\\.-]+/Forums/en/category/(w7itpro|windowsvistaitpro|windowsxpitpro)",c:"inv_c_SC-TN-p77737117-1224.js",f:0.04,p:1},{m:"(.*?social\\.technet\\.microsoft|sr-technet)[\\w\\.-]+/forums/en-(us|US)/category",c:"inv_c_SC-TechNet-p77596864-1208.js",f:0.04,p:2,halt:_halt},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/de-",c:"inv_c_TN-p81712691-DE.js",f:0.05,p:1},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/de-de/",c:"inv_c_TN-p15466742-p81712691-DE.js",f:0.021,p:2},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/en-(?!us)",c:"inv_c_TN-p81712691-EN.js",f:0.0018,p:0},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/en-au",c:"inv_c_TN-p15466742-en-au.js",f:0.3,p:1},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/en-us/((default\\.aspx)|(windows/)|(library|windowsserver|forefront|office|sharepoint|sqlserver|systemcenter|scriptcenter|security|sysinternals|virtualization|subscriptions|magazine|ie|exchange|edge))",c:"inv_c_TechNet-p77596864.js",f:_Freq,p:2},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/es-",c:"inv_c_TN-p81712691-ES.js",f:0.026,p:1},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/fr-",c:"inv_c_TN-p81712691-FR.js",f:0.05,p:1},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/fr-fr/",c:"inv_c_TN-p15466742-p81712691-FR.js",f:0.02,p:2},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/ja",c:"inv_c_TN-p81712691-JA.js",f:0.003,p:0},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/ja-jp",c:"inv_c_TECHNET-p15466742-p81712691-JA.js",f:0.0071,p:1},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/ko",c:"inv_c_TN-p81712691-KO.js",f:0.124,p:0},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/zh-",c:"inv_c_TN-p81712691-ZH-CN.js",f:0.024,p:0},{m:"/(sr-technet|tnstage|tnlive|tntest|technet\\.microsoft)[\\w\\.-]+/pt",c:"inv_c_TN-p81712691-PT.js",f:0.02,p:0}]};
COMSCORE.SiteRecruit.Broker.run();