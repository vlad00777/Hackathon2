$(document).ready(function() {

//fix placeholder ie9
  if(!Modernizr.input.placeholder){
    $("input").each(function(){
      if($(this).val()=="" && $(this).attr("placeholder")!=""){
        $(this).val($(this).attr("placeholder"));
        $(this).focus(function(){
          if($(this).val()==$(this).attr("placeholder")) $(this).val("");
        });
        $(this).blur(function(){
          if($(this).val()=="") $(this).val($(this).attr("placeholder"));
        });
      }
    });
  }
    
    
/*    document.getElementById("file-input").onchange = function (e) {
        EXIF.getData(e.target.files[0], function () {
            var gps = EXIF.getTag(this, "GPSLatitude");
            var v1 = gps[2]['numerator'];
            var v2 = gps[2]['denominator']
            console.log(v1 / v2);
        });
    }*/

Dropzone.autoDiscover = false;
    
var md = new Dropzone(".dropzone", {
    url: "photos.php",
    maxFilesize: "5"
});
    
    
md.on("complete", function (file) {
    if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
        alert('Your action, Refresh your page here. ');
    }

   // md.removeFile(file);
});


    
});