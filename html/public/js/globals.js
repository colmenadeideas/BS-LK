define(['module'], function(module){
	function hash() {
	    var accessHash = $.param.fragment();
    	var accessHashPart = accessHash.split('/');
    	return accessHashPart;
	}
    return {
    	f: 'bootstrap3',
		isProcessing: false, //To Avoid multiple AJAX requests
		URL: "http://localhost/BS-LK/html/",
		urlCheck: '/html/',
		position: 2,
		hash: hash

    }
});