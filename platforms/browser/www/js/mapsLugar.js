
  // Note: This example requires that you consent to location sharing when
  // prompted by your browser. If you see the error "The Geolocation service
  // failed.", it means you probably did not give permission for the browser to
  // locate you.
  $("#button-back").css("display", "flex");
  var geocoder;

  var ubicacionLong;
  var ubicacionLat;
  var destinoLong;
  var destinoLat;
  var LatLugar;
  var LngLugar;
  function setDestino(destino) {
    var destinoLatLng = destino.getPosition();
    var latitud=destinoLatLng.lat();
    var longitud=destinoLatLng.lng();
    setDireccion_destino(latitud,longitud);
  }


  function setDireccion_destino(la, lo) {
    destinoLat = la;
    destinoLong = lo;
    var latlng = new google.maps.LatLng(destinoLat, destinoLong);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          document.getElementById("direccionLugarFavorito").value=results[0].formatted_address;
          destinoReal=results[0].formatted_address;
        } else {
          alert('No results found');
        }
      } else {
        alert('Geocoder failed due to: ' + status);
      }
    });
  }

  var markersArray=[];
  function initMap() {
    geocoder = new google.maps.Geocoder();

    if (navigator.geolocation) {

        var map = new google.maps.Map(document.getElementById('mapLugar'), {
          center: {lat: 19.7028257, lng: -101.1923878},
          zoom: 17,
          rotateControl : false,
          mapTypeControl: true,
          streetViewControl: false
        });
        
        google.maps.event.addListener(map, 'click', function(event) {
          var coordenadas = event.latLng;
          var lat = coordenadas.lat();
          var lng = coordenadas.lng();
          LatLugar=lat;
          LngLugar=lng;
          var destino;
          if(markersArray[0]){
            markersArray[0].setMap(null)
            markersArray.splice(-1,1)
          }

           var icon = {
            url: "icon/destino.png",
            scaledSize: new google.maps.Size(40, 40),
            labelOrigin: new google.maps.Point(20, 15)
        };

          destino = new google.maps.Marker({
            position: {lat:lat, lng:lng},
            map: map,
            icon: icon,
            label:{
              text: 'L',
              fontWeight: 'bold',
          },
            draggable: true 
          });

          destino.setMap(map); 
          markersArray.push(destino);

          google.maps.event.addListener(destino, 'dragend', function(){
                setDestino(destino);
          });
          setDestino(destino);
        });     
    } else {
        myApp.alert('Tu dispositivo no soporta la geolocalización','ERROR');
    }
  }

  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
                          'Error: The Geolocation service failed.' :
                          'Error: Your browser doesn\'t support geolocation.');
  }

  
  