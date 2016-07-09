<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Base</title>

    <!-- Bootstrap -->
    <link href="{{URL::to('assets/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="{{URL::to('assets/bootstrap/css/ie10-viewport-bug-workaround.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{URL::to('assets/css/jumbotron-narrow.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">iCast</h3>
      </div>
      <!-- this is to hold the map -->
      <div class="jumbotron" id="map">

      </div>
      <!-- End-->
      <footer class="footer">
        <p>&copy; {{ date("Y") }} Dream mesh, Ltd.</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{URL::to('assets/bootstrap/js/ie10-viewport-bug-workaround.min.js')}}"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="{{URL::to('assets/bootstrap/js/jquery.min.js')}}"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{URL::to('assets/bootstrap/js/bootstrap.min.js')}}"></script>

    <script type="text/javascript">
      //here we are getting the markers from php
      var markers = <?php echo $markers; ?>;

      function initMapRef()
      {
        var mapDiv = document.getElementById("map");
        var map = new google.maps.Map(mapDiv, {
          center: {lat: 9.076479, lng: 7.398574 },
          zoom: 6
        });

        var content = "Lagos Nigeria";
        var geocoder = new google.maps.Geocoder;
        var infoWindow = new google.maps.InfoWindow;

        //this loops thru the coordinates we get
        for(i = 0; i < markers.length; i++){
          var latlng = {lat : parseFloat(markers[i].lat), lng : parseFloat(markers[i].lng)};
          var user_id = parseInt(markers[i].id);
          geocodeLatLngRef(geocoder, map, latlng, infoWindow, user_id);
        }
      }

      function geocodeLatLngRef(geocoder, map, input, infoWindow, user_id){
        geocoder.geocode({'location': input}, function(results, status){
          if (status === google.maps.GeocoderStatus.OK) {
              if(results[1]){
                //console.log(results[1].formatted_address);
                var marker = new google.maps.Marker({
                  position: input,
                  map: map,
                  title: results[1].formatted_address
                });

                marker.addListener('click', function(){
                  var img_name = returnUserRecentImage(user_id);
                  var content = '<img border="0" align="left" src="' + img_name +'">';
                  infoWindow.setContent("Lagos, Nigeria");
                  infoWindow.open(map, this);
                  //window.alert(user_id);
                  
                });
              }else{
                window.alert("No result found!!");
              }
          }//end of if(status)
          else{
            window.alert("Geocoder failed due to "+ status);
            //console.log(results);
          } 
        });
      }

      function returnUserRecentImage(user_id)
      {
        $.get("/coord-image/" + user_id, function(data){
          if (data !== "error"){
            //window.alert(data);
            return data;
          }else{
            window.alert("ERROR: in retrieving the image name");
          }

        });
      }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtwm3h1URu87h9ap_LjJNASDE-NiMUOF0&callback=initMapRef"></script>
  </body>
</html>