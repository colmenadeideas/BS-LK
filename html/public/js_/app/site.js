define(['globals'], function(globals) {

  var getBackground = function() {
    
    var size = globals.URL;

    console.log("Function: getBackground" +size);
      
      var dir = "../uploads/";
      var fileextension = ".jpg";
      $.ajax({
        //This will retrieve the contents of the folder if the folder is configured as 'browsable'
        url: globals.URL+dir,
        success: function (data) {
        console.log('(' + data + ')');
          var n = 0;
            if (n <= 13) {
              //Lsit all png file names in the page
              $(data).find("a:contains(" + fileextension + ")").each(function () {
                n++;
                  var filename = this.href.replace(window.location.host, "").replace("http:///", "").replace("app/", "");
                  $(".back").append($("<img src=" + dir + filename + "></img>"));
                      console.log("<img src=" + dir + filename + "></img>");
              });
            };
        }
      });
  }

  return {
    getBackground: getBackground
  }

  /*return {
    // backgorund images collage loop    
    getBackground: function() {
      
      
    }

  }*/

});