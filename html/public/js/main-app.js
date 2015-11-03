require.config({
    baseUrl: "http://localhost/BS-LK/html/public/js",
    requireDefine:true,
    waitSeconds:12,
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
      'assets/jquery.scrollTo.min': ['jquery'], 
      'assets/slidebars.min': ['jquery'], 
      'functions': ['jquery', 'assets/jquery.validate.min'],
      'appassets/stepform' : ['jquery', 'globals', 'assets/jquery.validate.min'],
      'assets/handlebars.min' :['jquery'],
      'assets/bootstrap-editable.min':['jquery','assets/bootstrap.min'],
      //'assets/jquery.dataTables.min': ['jquery'],
      //'assets/jquery.maskedinput.min': ['jquery'],
      //'assets/dataTables.bootstrap': ['jquery', 'assets/bootstrap.min', 'assets/jquery.dataTables.min'], 
      //'paging': ['jquery','assets/jquery.dataTables.min'],
      //'assets/fullcalendar.min': ['jquery'/*,'assets/fullcalendar-es'*/],
        'assets/jquery.geocomplete.min' : ['jquery'],
        'assets/bootstrap-datetimepicker-v4':['jquery','assets/bootstrap.min'],
        'assets/ jquery.carouFredSel-6.1.0-packed':['jquery','assets/easing.min'],

        'common': ['jquery','assets/all','assets/jquery-ui.min','assets/bootstrap.min',
        'assets/jquery.validate.min','assets/jquery.easing.min',
        'assets/bootstrap-editable.min','assets/jquery.scrollTo.min','assets/bootstrap-datetimepicker-v4','assets/jquery.geocomplete.min','assets/moment.min','assets/fullcalendar.min','assets/jsonsql','functions','config'],
        'app/search': ['jquery','common', 'globals'],
        'app/doctor': ['jquery','common', 'globals','app/search','assets/jquery.easing.min', 'assets/jquery.carouFredSel-6.1.0-packed'],
        'app/app': ['jquery','common', 'globals','assets/jquery.validate.min', 'app/posts'],
        'app/login': ['jquery','globals','assets/jquery.validate.min'],
        'app/site':  ['globals', 'app/login'],
        'app/hashchange': ['common', 'assets/handlebars.min', 'app/site', 'app/login'],
    }
});

require([
    'jquery',
    'globals', //would replace 'common' eventually
    'app/hashchange'
    ],
    function($, app, start) { 

      var accessArray = window.location.pathname.split('/');
      var accessHash = $.param.fragment();
      
      console.log("Access:" + accessArray +" Hash:" + accessHash);
      
      switch(accessArray[3]) {
        case "app":         
          /*require(['app/app'], function(app) {              
              switch(accessHash) {
                case 'posts':
                  app.posts();
                  break;
                default: 
                  app.boards();                   
                  break;
              }                      
          }); */
          break;

        default: // CASE "SITE"
          require(['app/site', 'app/login'], function(site,login) {              
              //site.run();  
              login.run();
            }); 
          break;
      } 

    }
);