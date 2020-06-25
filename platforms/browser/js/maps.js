
  // Note: This example requires that you consent to location sharing when
  // prompted by your browser. If you see the error "The Geolocation service
  // failed.", it means you probably did not give permission for the browser to
  // locate you.

  var markersArray=[];
  var map;
  var directionsService;
  var directionsDisplay;
  var geocoder;

  
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
      //center: { lat: position.coords.latitude, lng: position.coords.longitude},
      map = new google.maps.Map(document.getElementById('mapa'), {
        center: {lat: 19.7028257, lng: -101.1923878},
        zoom: 14,
        rotateControl : false,
        mapTypeControl: false,
        streetViewControl: false,
        mapTypeControl: false,
      });
      custom_buttons();
      directionsDisplay = new google.maps.DirectionsRenderer(
      {
          map: map
      });
      directionsDisplay.setOptions({suppressMarkers: true});

      
      google.maps.event.addListener(map, 'click', function(event) {
          
      });

      posicion_taxis();
  }
  

  function GPS_disabled(){
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 19.7028257, lng: -101.1923878},
        zoom: 14,
        rotateControl : false,
        mapTypeControl: false,
        streetViewControl: false,
        mapTypeControl: false,
      });
      custom_buttons();
      directionsDisplay = new google.maps.DirectionsRenderer(
      {
          map: map
      });
      directionsDisplay.setOptions({suppressMarkers: true});
      
      google.maps.event.addListener(map, 'click', function(event) {
          
      });
      posicion_taxis();
  }


//////////////////////////////   POSICIÓN TAXIS    ///////////////////////////////////////////// 

function posicion_taxis(){
    var URL="Taxistas/getCoordenadas.php";
    console.log(URL);
    $.ajax({
        type: "POST",
        dataType: 'json',
        cache: false,
        url:URL,
        success: function (data)
        { 
            var no_taxis=data.length;
            console.log(no_taxis);
            for (var i = 0; i<no_taxis; i++) {
                var latitud=data[i][2];
                var longitud=data[i][3];
                var Latlng = new google.maps.LatLng(latitud,longitud);

                switch(data[i][4]) {
                    case 'libre':
                        console.log(latitud+" "+longitud+" libre");
                        var icon = {
                              url: "icon/ubicacion.png",
                              scaledSize: new google.maps.Size(40, 40),
                              labelOrigin: new google.maps.Point(20, 15)
                        };

                        var marker = new google.maps.Marker({
                            position:Latlng,
                            map: map,
                            icon: icon,
                            label:{
                                text: 'A',
                                fontWeight: 'bold',
                            },
                            draggable: false 
                        });
                        marker.addListener('click', function() {
                            map.setZoom(19);
                            map.setCenter(marker.getPosition());
                        });
                        marker.setMap(map); 

                        break;
                    case 'ocupado':
                        console.log(latitud+" "+longitud+" ocupado");
                        var icon = {
                            url: "icon/destino.png",
                            scaledSize: new google.maps.Size(40, 40),
                            labelOrigin: new google.maps.Point(20, 15)
                        };

                      var marker = new google.maps.Marker({
                          position:Latlng,
                          map: map,
                          icon: icon,
                          label:{
                              text: 'A',
                              fontWeight: 'bold',
                          },
                          draggable: false 
                      });
                      
                       marker.addListener('click', function() {
                          map.setZoom(19);
                          map.setCenter(marker.getPosition());
                      });
                      marker.setMap(map); 

                        break;
                    case 'ss':
                        

                        break;
                }

            }
            
        },
        error: function(e){
            alert('Error: '+e);
        }  
    });
}


function custom_buttons(){
   
    var markerColor = document.createElement('div');
    //var customControl = new CustomControl(markerColor, map);
    markerColor.index = 1;
    markerColor.style.background="#fff"
    markerColor.style.boxShadow="rgba(0, 0, 0, 0.3) 0px 1px 4px -1px";
    markerColor.style.display='flex';
    markerColor.style.height='auto';
    markerColor.style.width='auto';    
    markerColor.style.margin="10px 10px";
    map.controls[google.maps.ControlPosition.LEFT_TOP].push(markerColor); 

    var backAtext = document.createElement('div');
    backAtext.style.display="flex";
    backAtext.style.background="#e04006"
    backAtext.style.color="#fff"
    backAtext.style.alignItems="center";
    backAtext.style.height="29px";
    backAtext.style.fontSize ='11px';
    backAtext.style.padding='0px 8px';
    backAtext.innerHTML='Centrar';
    backAtext.style.cursor='pointer';
    markerColor.appendChild(backAtext);
    google.maps.event.addDomListener(backAtext, 'click', function () {
      map.setCenter({
            lat: 19.7028257, lng: -101.1923878
      });
      map.setZoom(14);
    });

}


    