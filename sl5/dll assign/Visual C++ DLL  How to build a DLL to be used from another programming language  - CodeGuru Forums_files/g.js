	var now = new Date();
	now.setTime(now.getTime());
	var expiry_date = new Date( now.getTime() + (31536000000) );
	document.cookie = 'qsg=34; expires=' + expiry_date.toGMTString()  + '; path=/;';
