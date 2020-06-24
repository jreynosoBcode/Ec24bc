
  // Note: This example requires that you consent to location sharing when
  // prompted by your browser. If you see the error "The Geolocation service
  // failed.", it means you probably did not give permission for the browser to
  // locate you.
  $("#button-back").css("display", "flex");
  var direccion_ubicacion;
  var direccion_destino;
  var markersArray=[];
  var map;
  var directionsService;
  var directionsDisplay;
  var geocoder;
  var ubicacionLng;
  var ubicacionLat;
  var destinoLng;
  var destinoLat;

function setDestino(destino) {
  var destinoLatLng = destino.getPosition();
  destinoLat=destinoLatLng.lat();
  destinoLng=destinoLatLng.lng();
  var latlng = new google.maps.LatLng(destinoLat, destinoLng);
  geocoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[0]) {
          document.getElementById("destino").value=results[0].formatted_address;
          direccion_destino=results[0].formatted_address;

          ruta(destinoLat,destinoLng);
      } else {
        alert('No results found');
      }
    } else {
      alert('Geocoder failed due to: ' + status);
    }
  });
}


  function setUbicacion(marker) {
    var markerLatLng = marker.getPosition();
    ubicacionLat=markerLatLng.lat();
    ubicacionLng=markerLatLng.lng();
    var latlng = new google.maps.LatLng(ubicacionLat, ubicacionLng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {
          document.getElementById("ubicacion").value = results[0].formatted_address;
          direccion_ubicacion=results[0].formatted_address;
          if(direccion_destino!=""){
             ruta(ubicacionLat,ubicacionLng);
          }
        } else {
          alert('No results found');
        }
      } else {
        alert('Geocoder failed due to: ' + status);
      }
    });
  }

  
  
  function initMap() {
    direccion_ubicacion="";
    direccion_destino="";
    directionsService = new google.maps.DirectionsService();
    //var directionsDisplay;
    geocoder = new google.maps.Geocoder();

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(function(position) {
          GPS_enabled(position);
      }, function() {
          GPS_disabled();
      });
    } else {
        myApp.alert('Tu dispositivo no soporta la geolocalización','ERROR');
    }
  }


  function GPS_enabled(position){
      map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: position.coords.latitude, lng: position.coords.longitude},
        zoom: 17,
        rotateControl : false,
        mapTypeControl: true,
        streetViewControl: false
      });
      custom_buttons();
      directionsDisplay = new google.maps.DirectionsRenderer(
      {
          map: map
      });
      directionsDisplay.setOptions({suppressMarkers: true});

      var icon = {
            url: "../icon/ubicacion.png",
            scaledSize: new google.maps.Size(40, 40),
            labelOrigin: new google.maps.Point(20, 15)
        };

      var marker = new google.maps.Marker({
         position:{lat:position.coords.latitude, lng: position.coords.longitude},
          map: map,
          icon: icon,
          label:{
              text: 'A',
              fontWeight: 'bold',
          },
          draggable: true 
      });
      
      marker.setMap(map); 
      markersArray.push(marker);

      setUbicacion(marker);

      google.maps.event.addListener(marker, 'dragend', function(){
          setUbicacion(marker);
      });

      google.maps.event.addListener(map, 'click', function(event) {
          var coordenadas = event.latLng;
          var lat = coordenadas.lat();
          var lng = coordenadas.lng();
          
          if(markersArray[1]){
            markersArray[1].setMap(null)
            markersArray.splice(-1,1)
          }

          var icon = {
              url: "../icon/destino.png",
              scaledSize: new google.maps.Size(40, 40),
              labelOrigin: new google.maps.Point(20, 15)
          };
          var destino = new google.maps.Marker({
            position: {lat:lat, lng:lng},
            map: map,
            icon: icon,
            label:{
                text: 'B',
                fontWeight: 'bold',
            },
            draggable: true 
          });

          destino.setMap(map); 
          markersArray.push(destino);
          google.maps.event.addListener(marker, 'dragend', function(){
                setUbicacion(marker);
                
          });
          google.maps.event.addListener(destino, 'dragend', function(){
                setDestino(destino);                
                
          });
          
          var destinoLatLng = destino.getPosition();
          
          var latitud=destinoLatLng.lat();
          var longitud=destinoLatLng.lng();

          var latlng = new google.maps.LatLng(latitud, longitud);

          geocoder.geocode({'latLng': latlng}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                  document.getElementById("destino").value=results[0].formatted_address;
                  direccion_destino=results[0].formatted_address;
                  ruta(latitud,longitud);

                } else {
                  alert('No results found');
                }
              } else {
                alert('Geocoder failed due to: ' + status);
              }
          });          
      });
  }
  

  function GPS_disabled(){
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 19.7028257, lng: -101.1923878},
        zoom: 17,
        rotateControl : false,
        mapTypeControl: true,
        streetViewControl: false
      });
      custom_buttons();
      directionsDisplay = new google.maps.DirectionsRenderer(
      {
          map: map
      });
      directionsDisplay.setOptions({suppressMarkers: true});

      var icon = {
            url: "../icon/ubicacion.png",
            scaledSize: new google.maps.Size(40, 40),
            labelOrigin: new google.maps.Point(20, 15)
        };

      var marker = new google.maps.Marker({
          position: {lat: 19.7028257, lng: -101.1923878},
          map: map,
          icon: icon,
          label:{
              text: 'A',
              fontWeight: 'bold',
          },
          draggable: true 
      });
      
      marker.setMap(map); 
      markersArray.push(marker);

      setUbicacion(marker);

      google.maps.event.addListener(marker, 'dragend', function(){
          setUbicacion(marker);
      });

      google.maps.event.addListener(map, 'click', function(event) {
          var coordenadas = event.latLng;
          var lat = coordenadas.lat();
          var lng = coordenadas.lng();
          var destino;
          if(markersArray[1]){
            markersArray[1].setMap(null)
            markersArray.splice(-1,1)
          }
          console.log(lat+" "+lng);
          destinoLat=lat;
          destinoLng=lng;
          var icon = {
              url: "../icon/destino.png",
              scaledSize: new google.maps.Size(40, 40),
              labelOrigin: new google.maps.Point(20, 15)
          };
          destino = new google.maps.Marker({
            position: {lat:lat, lng:lng},
            map: map,
            icon: icon,
            label:{
                text: 'B',
                fontWeight: 'bold',
            },
            draggable: true 
          });

          destino.setMap(map); 
          markersArray.push(destino);

          google.maps.event.addListener(marker, 'dragend', function(){
                setUbicacion(marker);
                
          });
          google.maps.event.addListener(destino, 'dragend', function(){
                setDestino(destino);                
                
          });
          
          var destinoLatLng = destino.getPosition();
          
          var latitud=destinoLatLng.lat();
          var longitud=destinoLatLng.lng();

          var latlng = new google.maps.LatLng(latitud, longitud);

          geocoder.geocode({'latLng': latlng}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {
                  document.getElementById("destino").value=results[0].formatted_address;
                  direccion_destino=results[0].formatted_address;
                  /*
                  var ll = new google.maps.LatLng(latitud, longitud);
                  var request = {
                    location: ll,
                    radius: '30',
                  };

                  var service = new google.maps.places.PlacesService(map);

                  service.nearbySearch(request, function(results, status) {
                    if (status == google.maps.places.PlacesServiceStatus.OK) {
                      $("#tabla_lugares_cercanos").empty();
                      for (var i = 0; i < results.length; i++) {
                        //var place = resul[i];
                        //console.log(place);


                        $("#tabla_lugares_cercanos").append(
                        '<li>'+
                            '<a href="#"  class="item-link item-content" onclick="">'+
                                '<div class="item-media">'+
                                    '<img src="'+results[i]['icon']+'" style="width:24px;height:25px;">'+
                                '</div>'+
                                '<div class="item-inner">'+
                                    '<div class="item-title">'+results[i]['name']+'</div>'+
                                '</div>'+
                            '</a>'+
                        '</li>');
                      }
                      $("#no_lugares").html("Lugares encontrados: "+results.length);
                    }
                  });*/
                  ruta(latitud,longitud);

                } else {
                  alert('No results found');
                }
              } else {
                alert('Geocoder failed due to: ' + status);
              }
          });
      });
  }

function ruta(latitud,longitud){
    directionsService.route({
    origin: direccion_ubicacion,
    destination: direccion_destino,
    travelMode: 'DRIVING'
  }, function(response, status) {
    if (status === 'OK') {
      directionsDisplay.setDirections(response);
       map.setCenter({
              lat : latitud,
              lng : longitud
          });
    } else {
      window.alert('Directions request failed due to ' + status);
    }
  });

}

function setDireccion_favorito(lat,lng){
    if(markersArray[1]){
        markersArray[1].setMap(null);
        markersArray.splice(-1,1);
        
    }
    map.setCenter({
        lat : lat,
        lng : lng
    });
    var icon = {
              url: "../icon/destino.png",
              scaledSize: new google.maps.Size(40, 40),
              labelOrigin: new google.maps.Point(20, 15)
          };
    var destino = new google.maps.Marker({
        position: {lat:lat, lng:lng},
        map: map,
        icon: icon,
        label:{
            text: 'B',
            fontWeight: 'bold',
        },
        draggable: true 
    });

   
    destino.setMap(map); 
    setDestino(destino);
    markersArray.push(destino);
    google.maps.event.addListener(destino, 'dragend', function(){
        setDestino(destino);                
    });
    
}
//////////////////////   CUSTOMIZED CONTROLS    ///////////////////////////////////////////// 
function custom_buttons(){
   
    var markerColor = document.createElement('div');
    //var customControl = new CustomControl(markerColor, map);
    markerColor.index = 1;
    markerColor.style.background="#fff"
    markerColor.style.boxShadow="rgba(0, 0, 0, 0.3) 0px 1px 4px -1px";
    markerColor.style.display='flex';
    markerColor.style.height='auto';
    markerColor.style.width='auto';    
    markerColor.style.margin="10px 0";
    map.controls[google.maps.ControlPosition.TOP_CENTER].push(markerColor); 

    var backAtext = document.createElement('div');
    backAtext.style.display="flex";
    backAtext.style.alignItems="center";
    backAtext.style.height="29px";
    backAtext.style.fontSize ='11px';
    backAtext.style.padding='0px 8px';
    backAtext.innerHTML='Ubicación';
    backAtext.style.cursor='pointer';
    markerColor.appendChild(backAtext);
    google.maps.event.addDomListener(backAtext, 'click', function () {
      map.setCenter({
            lat : ubicacionLat,
            lng : ubicacionLng
      });
      map.setZoom(18);
    });

    var backBtext = document.createElement('div');
    backBtext.style.display="flex";
    backBtext.style.alignItems="center";
    backBtext.style.justifyContent="center";
    backBtext.style.borderLeft="1px solid #f0f0f0";
    backBtext.style.height="29px";
    backBtext.style.padding='0px 8px';
    backBtext.style.fontSize = '11px';
    backBtext.innerHTML='Destino';
    backBtext.style.cursor='pointer';
    markerColor.appendChild(backBtext);
    google.maps.event.addDomListener(backBtext, 'click', function () {
        console.log("LATITUD "+ destinoLat);
        map.setCenter({

              lat : destinoLat,
              lng : destinoLng
        });
        map.setZoom(18);

    });

}




    