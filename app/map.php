<?php

    if(isset($_GET['id'])) {
        $username = "root";
        $password = "vertrigo";
        $hostname = "localhost"; 

        //connection to the database
        $connection = mysqli_connect($hostname, $username, $password, 'road');

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        } 
        
        $id = $_GET['id'];
        
        
        $sql = "SELECT * FROM maps WHERE map_id = $id ORDER BY datetime ASC";
        $res = $connection->query($sql);
        
        while($rows[] = mysqli_fetch_assoc($res));
            array_pop($rows);
            
        
        
    }

?>
<!DOCTYPE html />
<html>
<head>
<title>Extensive Google Maps Directions demo</title>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
  <script src="js/moment.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
  <link rel="stylesheet" href="css/style.css">

</head>
<body onLoad="initialize()">
<script type="text/javascript">
    var pid2 = [];
var directionDisplay;
var directionsService = new google.maps.DirectionsService();
    var cty = '';
    
var toajax = [];
    
function initialize() {
    var place2;
  var latlng = new google.maps.LatLng(51.764696,5.526042);
  // set direction render options
  var rendererOptions = { draggable: false, suppressMarkers: true };
  directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
  var myOptions = {
    zoom: 14,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: false
  };
  // add the map to the map placeholder
  var map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById("directionsPanel"));
  // Add a marker to the map for the end-point of the directions.
    
    var jqueryarray = <?php echo json_encode($rows); ?>;
    var c = 0;
    
    var pid = [];
    
    for(var i = 0; i<jqueryarray.length;i++) {
        var myLatlng = new google.maps.LatLng(parseFloat(jqueryarray[i]['lat']),parseFloat(jqueryarray[i]['lng']));
          var request = {
            location: myLatlng,
            radius: '5',
            type:['bar','beauty_salon','cafe','spa']
          };
var infowindow = new google.maps.InfoWindow;
        var geocoder = new google.maps.Geocoder;
        var service = new google.maps.places.PlacesService(map);
        
        geocodeLatLng(geocoder, map, infowindow);
   
    }
    var q = 0;
    function geocodeLatLng(geocoder, map, infowindow) {
            
          var latlng = {lat: parseFloat(jqueryarray[i]['lat']), lng: parseFloat(jqueryarray[i]['lng'])};
          geocoder.geocode({'location': latlng}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                  //console.log(results[0]);
                  pid.push(results[0]);
                
                    service.getDetails({
                        placeId: pid[q]['place_id']
                      }, function(place, status) {
                        if (status === google.maps.places.PlacesServiceStatus.OK) {
                          var marker = new google.maps.Marker({
                              position: latlng,
                              map: map,
                              icon: 'https://maps.googleapis.com/maps/api/streetview?size=50x50&location='+latlng["lat"]+', '+latlng["lng"]+'&key=AIzaSyAeiDYGyarnWalSY8SQCIxxhoy-8Qq541c'
                            });

                            infowindow.setContent(place.formatted_address+" <a href='"+place.url+"'>Go to Google maps</a>");
                              //console.log(place);
                            pid2['cty'] = place.vicinity;
                          google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map, this);
                          });
                        }
                            
                      });
                
                  q++;
            } 
          });
        }

    

  // get the travelmode, startpoint and via point from the form   
  var travelMode = "WALKING";

  var waypoints = []; // init an empty waypoints array
    var points = [];
    var summtime = 0;

    var jqueryarray = <?php echo json_encode($rows); ?>;

    var size = <?php echo $res->num_rows ?>;
    size = parseInt(size) - 1;
    var start = jqueryarray[0]['lat']+','+jqueryarray[0]['lng'];
    var end = jqueryarray[size]['lat']+','+jqueryarray[size]['lng'];
    
    
    var then  = jqueryarray[0]['datetime'];
    var now = jqueryarray[size]['datetime'];

    summtime = moment.utc(moment(now,"YYYY-MM-DD HH:mm:ss").diff(moment(then,"YYYY-MM-DD HH:mm:ss"))).format("HH:mm:ss")

toajax['time'] = summtime;
    <?php $idm = $_GET['id']; ?>
toajax['id'] = <?php echo $idm ?>;
toajax['city'] = 'Lublin';
    
    //console.log(toajax);

    
    $(".places .dlina").html("Time for road: "+summtime);
    
//   console.log(jqueryarray);
//   console.log(start);
//   console.log(end);
    
    
    
    
 for (var i = 0; i <= size; i++) {
     points.push(jqueryarray[i]['lat']+','+jqueryarray[i]['lng']);
     
  }
    points.splice(0,1);
    points.splice(-1,1);
    
     for (var i = 0; i < points.length; i++) {
          waypoints.push({
              location: points[i],
              stopover: true
            });
     }

    //console.log(waypoints);
    console.log(points);
    
    
  var request = {
    origin: start,
    destination: end,
    waypoints: waypoints,
    unitSystem: google.maps.UnitSystem.METRIC,
    travelMode: google.maps.DirectionsTravelMode[travelMode]
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      $('#directionsPanel').empty(); // clear the directions panel before adding new directions
      directionsDisplay.setDirections(response);
    }
  });
    

    
}
    
    $(window).load(function(){
        var newa = [];
        var newb = [];
        newa[0] = toajax['city'];
        newa[1] = toajax['time'];
        newa[2] = toajax['id'];
        
        newb[0] = newa;
        
        console.log(newb);
        $.ajax({
                    url: "add_info.php",
                    type: "post",
                    data: {data: newb},
                    success: function (response) {
                        console.log(response);
                       
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                       alert('xyinia');
                    }
            });
    });
    
    $(document).ready(function(){
        $('.place').each(function (index, element) {
            var lat = element.dataset["lat"];
            var lng = element.dataset["lng"];
            var id = element.dataset["id"];

             $.getJSON('http://nominatim.openstreetmap.org/reverse?format=json&lat='+lat+'&lon='+lng+'&zoom=18&addressdetails=1',
                function(data) {
                       $('#place'+id).find('.name').html(data['display_name']);
                });

        });
    });
    
</script>

 <div id="map2"></div>
  <div id="map_canvas" style="width:100%; height:600px"></div>   
  <div class="block"> 
  <div id="directionsPanel" class="lr">
    Enter a destination and click "Calculate route".
  </div>
  <div class="lr places">
     <div class="dlina"></div>
      <?php 
        for($i = 0; $i<count($rows); $i++){
            $lat = $rows[$i]['lat'];
            $lng = $rows[$i]['lng']; ?>
            <div class="place" data-lat="<?php echo $lat; ?>" data-lng="<?php echo $lng; ?>"" data-id="<?php echo $i; ?>" id="place<?php echo $i; ?>">
            <p class="name"></p>
            <img src='https://maps.googleapis.com/maps/api/streetview?size=350x220&location=<?php echo $lat?>,<?php echo $lng?>&key=AIzaSyAeiDYGyarnWalSY8SQCIxxhoy-8Qq541c'>
            </div>
        <?php }
      ?>
  </div>
  </div>
  <div id="city_name"></div>
</body>
</html>