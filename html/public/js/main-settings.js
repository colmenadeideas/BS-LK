require.config({
  baseUrl: "http://localhost/BS-OK/html/public/js",
  requireDefine:true,
  waitSeconds:7,
  paths: {
          jquery:[  'assets/jquery.min', '//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min'], // 2.0.0
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
          //'assets/jquery.scrollTo.min': ['jquery'], 
          //'assets/jquery.backstretch.min': ['jquery'],
          'functions': ['jquery', 'assets/jquery.validate.min'],
          'assets/fullcalendar.min': ['jquery'/*,'assets/fullcalendar-es'*/],
         'assets/jquery.geocomplete.min' : ['jquery'],
         'assets/bootstrap-datetimepicker':['jquery','assets/bootstrap.min'],
         
         'common': ['jquery','assets/all','assets/jquery-ui.min','assets/bootstrap.min','assets/jquery.validate.min','assets/jquery.easing.min','assets/jquery.scrollTo.min','assets/jquery.backstretch.min','assets/bootstrap-datetimepicker','assets/jquery.geocomplete.min','assets/moment.min','assets/fullcalendar.min','functions','config'],
         'app/settings': ['jquery','common', 'globals'],
         
       }
     });
require([
  'jquery',
        'globals', 
        //'app/start-site',
        'app/settings'
        ],
        function($, settings ) { 
          console.log("Loaded Settings");
          //site.run();
        }
);