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
        
        
        $sql = "SELECT * FROM maps WHERE map_id = $id";
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
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var directionDisplay;
var directionsService = new google.maps.DirectionsService();
    
function initialize() {
  var latlng = new google.maps.LatLng(51.764696,5.526042);
  // set direction render options
  var rendererOptions = { draggable: false };
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
  var marker = new google.maps.Marker({
    position: latlng, 
    map: map, 
    title:"Rodderhof, Oss"
  }); 
}
function calcRoute() {
  // get the travelmode, startpoint and via point from the form   
  var travelMode = "WALKING";

  var waypoints = []; // init an empty waypoints array
    var points = [];
    

    var jqueryarray = <?php echo json_encode($rows); ?>;

    var size = <?php echo $res->num_rows ?>;
    size = parseInt(size) - 1;
    var start = jqueryarray[0]['lat']+','+jqueryarray[0]['lng'];
    var end = jqueryarray[size]['lat']+','+jqueryarray[size]['lng'];
    
    
//    console.log(start);
//    console.log(end);
    
    
    
    
 for (var i = 0; i <= size; i++) {
     points.push(jqueryarray[i]['lat']+','+jqueryarray[i]['lng']);
  }
    points.splice(-1,1);
    points.splice(1,1);
    
     for (var i = 0; i < points.length; i++) {
          waypoints.push({
              location: points[i],
              stopover: true
            });
     }

//    console.log(waypoints);
//    console.log(points);
    
    
  var request = {
    origin: start,
    destination: end,
    waypoints: waypoints,
    unitSystem: google.maps.UnitSystem.IMPERIAL,
    travelMode: google.maps.DirectionsTravelMode[travelMode]
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      $('#directionsPanel').empty(); // clear the directions panel before adding new directions
      directionsDisplay.setDirections(response);
    } else {
      // alert an error message when the route could nog be calculated.
      if (status == 'ZERO_RESULTS') {
        alert('No route could be found between the origin and destination.');
      } else if (status == 'UNKNOWN_ERROR') {
        alert('A directions request could not be processed due to a server error. The request may succeed if you try again.');
      } else if (status == 'REQUEST_DENIED') {
        alert('This webpage is not allowed to use the directions service.');
      } else if (status == 'OVER_QUERY_LIMIT') {
        alert('The webpage has gone over the requests limit in too short a period of time.');
      } else if (status == 'NOT_FOUND') {
        alert('At least one of the origin, destination, or waypoints could not be geocoded.');
      } else if (status == 'INVALID_REQUEST') {
        alert('The DirectionsRequest provided was invalid.');         
      } else {
        alert("There was an unknown error in your request. Requeststatus: nn"+status);
      }
    }
  });
}
    
    $(window).load(function(){
        calcRoute();
    });
</script>
</head>
<body onLoad="initialize()">
  <div id="map_canvas" style="width:100%; height:600px"></div>    
  <div id="directionsPanel">
    Enter a destination and click "Calculate route".
  </div>
</body>
</html>