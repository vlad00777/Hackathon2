$(document).ready(function () {

    //fix placeholder ie9
    if (!Modernizr.input.placeholder) {
        $("input").each(function () {
            if ($(this).val() == "" && $(this).attr("placeholder") != "") {
                $(this).val($(this).attr("placeholder"));
                $(this).focus(function () {
                    if ($(this).val() == $(this).attr("placeholder")) $(this).val("");
                });
                $(this).blur(function () {
                    if ($(this).val() == "") $(this).val($(this).attr("placeholder"));
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

    var completeFiles = 0;
    var totalFiles = 0;
    var arrObjects = [];
    var object;
    var i = 0;
    var res;


    md.on("addedfile", function (file) {
        totalFiles += 1;
    });

    md.on("removedfile", function (file) {
        totalFiles -= 1;
    });



    md.on("success", function (file, responseText) {
        res = jQuery.parseJSON(responseText);
        //console.log(res);
        //object = $.extend(true, arrObjects, res);

        completeFiles += 1;
        
        arrObjects[i] = {
            'GPSLatitude': res['GPSLatitude'],
            'GPSLongitude': res['GPSLongitude'],
            'datetime': res['datetime']

        }
        i++;
        
        if (completeFiles === totalFiles) {
            
        
            console.log(arrObjects);
        }

    });
    



});