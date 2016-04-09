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
            
            var lat, lng;
            var h,m,s,ii;
            var markers =[];
            
            for(ii=0;ii<totalFiles;ii++){
            
            h =  arrObjects[ii]['GPSLatitude'][0].split("/");
            m =  arrObjects[ii]['GPSLatitude'][1].split("/");
            s =  arrObjects[ii]['GPSLatitude'][2].split("/");
            var nh = parseInt(h[0]);
            var nm = parseInt(m[0]);
            var ns = parseInt(s[0])/10000;
            lat = nh + (nm / 60) + (ns / 3600);
            
            h =  arrObjects[ii]['GPSLongitude'][0].split("/");
            m =  arrObjects[ii]['GPSLongitude'][1].split("/");
            s =  arrObjects[ii]['GPSLongitude'][2].split("/");
            var nh = parseInt(h[0]);
            var nm = parseInt(m[0]);
            var ns = parseInt(s[0])/10000;
            lng = nh + (nm / 60) + (ns / 3600);
            
            var datetime = arrObjects[ii]['datetime'];
            
            markers[ii] = [lat,lng,datetime];
                
                }

             $.ajax({
                    url: "add_map.php",
                    type: "post",
                    data: {data: markers},
                    success: function (response) {
                        location.href = "map.php?id="+response;
                       
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                       alert('xyinia');
                    }
            });
            
            
        }

    });
    
    
    



});