define(['module'], function(module){
    return {
    	f: 'bootstrap3',
		isProcessing: false, //To Avoid multiple AJAX requests
		URL: "http://localhost:8888/BS-OK/html/",
		urlCheck: '/html/',
		position: 2
    }
});