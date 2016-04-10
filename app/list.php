<?php 
if(isset($_GET['time']) && isset($_GET['city'])) {
        $username = "root";
        $password = "vertrigo";
        $hostname = "localhost"; 

        //connection to the database
        $connection = mysqli_connect($hostname, $username, $password, 'road');

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        } 
        
        $time = $_GET['time'];
        $city = $_GET['city'];
        
        
        $sql = "SELECT map_id,howlong FROM info WHERE city = '$city' AND howlong <= '$time' ORDER BY id DESC";
        $res = $connection->query($sql);
    }
?>
<!DOCTYPE html />
<html>
<head>
<title>Extensive Google Maps Directions demo</title>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.0/jquery.min.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>
  <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="wContainer">
   <div class="wHeader">
       <div class="wSize">
           
       </div>
   </div>
    <div class="wSize">
        

<?php
    while($rows[] = mysqli_fetch_assoc($res));
    array_pop($rows);
    for ($i = 0; $i< count($rows); $i++){
        $mapa = $rows[$i]['map_id'];
        
    $sql2 = "SELECT * FROM maps WHERE map_id = '$mapa' ORDER BY datetime DESC";
    $maps = $connection->query($sql2); ?>
    <div class="map" id="map<?php echo $mapa; ?>">
    <div class="name_city"><?php echo $city; ?></div>
    <div class="howlong">Time for road:<?php echo $rows[$i]['howlong']; ?></div>
    <div class="owl-carousel">
<?php         
        
        
    while ($row=mysqli_fetch_row($maps))
    {
        $link = $row[1];
        $lat = $row[2];
        $lng = $row[3];?>
        
        <?php
        
        echo '<div data-lat="'.$lat.'" data-lng="'.$lng.'" data-id="'.$row[0].'" class="mapa" id="mapa'.$row[0].'">';
        echo '<a href="map.php?id='.$link.'">';
        echo '<img src="https://maps.googleapis.com/maps/api/streetview?size=300x250&location='.$lat.", ".$lng.'&key=AIzaSyAeiDYGyarnWalSY8SQCIxxhoy-8Qq541c" alt="">';
        echo '<span class="name"></span></a>';
        echo '</div>';
    }
        
        
    ?>
    </div>
    </div>
    

    <?php }
    
 
 ?>
        </div>
</div>
     <script>
 $(document).ready(function(){
         
$('.mapa').each(function (index, element) {
    var lat = element.dataset["lat"];
    var lng = element.dataset["lng"];
    var id = element.dataset["id"];
    
     $.getJSON('http://nominatim.openstreetmap.org/reverse?format=json&lat='+lat+'&lon='+lng+'&zoom=18&addressdetails=1',
        function(data) {
               $('#mapa'+id).find('span.name').html(data['display_name']);
        });

});
             
 });
         
$(window).load(function(){
    setTimeout(function(){
    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:20,
        nav:true,
        center:true,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true
    });
        }, 2000);
});
    
</script>
</body>
</html>