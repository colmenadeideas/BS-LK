require.config({
	baseUrl: "http://localhost:8888/BEEAPPS/LIKES/Web/html/public/js",
	requireDefine:true,
	waitSeconds:0,
	paths: {
	        jquery:[  'assets/jquery.min', '//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min'],
			              'async': 'assets/requirejs-plugins/async',	        
	},		    
	shim: {
		'jquery': {
            exports: '$'
        },
        
        gmaps: {
         	exports: 'google',
        	exports: '$',
        },
       
        'bootstrap.min': {
            deps: ['jquery'],
            exports: '$'
        },
         'assets/all': ['jquery'],
         'assets/bootstrap.min' : ['jquery'],
         'assets/jquery.validate.min': ['jquery'],
         'assets/jquery.easing.min': ['jquery'], 
         //'assets/jquery.backstretch.min': ['jquery'],

         'functions': ['jquery', 'assets/jquery.validate.min'],

         'common': ['jquery',
                    'assets/all',
                    'assets/jquery-ui.min',
                    'assets/bootstrap.min',
                    'assets/jquery.validate.min',
                    'assets/jquery.easing.min',
                    'assets/jquery.scrollTo.min',
                    //'assets/jquery.backstretch.min',
                    //'assets/bootstrap-datetimepicker',
                    //'assets/moment.min',
                    //'assets/fullcalendar.min',
                    'functions',
                    'config'],
         'app/site':  ['common','globals', 'app/login'],
         'app/login': ['jquery','globals','assets/jquery.validate.min'],
         
         /*'assets/jquery.scrollTo.min': ['jquery'], 
         
         
       	 'assets/jquery.geocomplete.min' : ['jquery'],
       	 'assets/bootstrap-datetimepicker':['jquery','assets/bootstrap.min'],
       	 'assets/ jquery.carouFredSel-6.1.0-packed':['jquery','assets/easing.min'],
       	 'common': ['jquery','assets/all','assets/jquery-ui.min','assets/bootstrap.min','assets/jquery.validate.min','assets/jquery.easing.min','assets/jquery.scrollTo.min','assets/jquery.backstretch.min','assets/bootstrap-datetimepicker','assets/jquery.geocomplete.min','assets/moment.min','assets/fullcalendar.min','assets/jsonsql','functions','config'],
         'app/registration': ['jquery','common'],
         'app/search': ['jquery','common'],
         'app/doctor': ['jquery','common','app/search','assets/jquery.easing.min', 'assets/jquery.carouFredSel-6.1.0-packed'],
         'app/site': ['jquery','common','app/search'],
         'app/login': ['jquery','common','assets/jquery.validate.min'],
           */     
	}
});
require([
        'jquery',
        'globals', //would replace 'common' eventually
        'app/site',
        'app/login'
    ],
    function($, app, site, login) { 
        //$(document).ready(function () {
   			console.log("Loaded all"); 
          //  site.getBackground();  
            login.init();	 	  
        //});
    }
);