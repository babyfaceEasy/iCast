//here we are getting the markers from php
var markers = <?php echo $markers; ?>;
function initMap()
      {
        var mapDiv = document.getElementById("map");
        var map = new google.maps.Map(mapDiv, {
          center: {lat: 10.80, lng: 10.80},
          zoom: 6
        });

        var content = "Lagos, Nigeria";
        var geocoder = new google.maps.Geocoder;
        var infoWindow = new google.maps.InfoWindow;
        //this is to loop thru the coordinates
        for(i = 0; i < markers.length; i++){
            var latlng = {lat:parseFloat(markers[i].lat), lng: parseFloat(markers[i].lng)};
            var marker = new google.maps.Marker({
            position : latlng,
            map: map,
            //title: 'Hello world!' + i
          });

            marker.addListener('click', function(){
              //var locate = this.getPosition();
              //window.alert(locate.toString());
              this.setTitle('pls work!!');
              geocodeLatLng(geocoder, map, this.getPosition());
              infoWindow.setContent(content);
              infoWindow.open(map, this);
            });

        }
      }

      function geocodeLatLng(geocoder, map, input){
        geocoder.geocode({'location': input}, function(results, status){
          if (status === google.maps.GeocoderStatus.OK) {
              if(results[1]){
                console.log(results[1].formatted_address);
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
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtwm3h1URu87h9ap_LjJNASDE-NiMUOF0&callback=initMap"></script>

