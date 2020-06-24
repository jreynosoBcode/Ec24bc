
var directionsDisplay1;
var directionsService1;
var map_m;
var geocoder1;
var marker2;
var markersArray = [];
var latitud_ubicacion_cliente;
var longitud_ubicacion_cliente;
var latitud_destino_cliente;
var longitud_destino_cliente;
var lat_chof;
var lon_chof;

var taxi_interval=setInterval(taxi_marker, 5000);


$( document ).ready(function(){
     $.ajax({
        type: "POST",
        dataType: 'json',
        cache: false,
        //url: "http://localhost/taxiapp/Clientes/rutaCliente.php",
        url: "http://bcodemexico.com/taxiApp/Clientes/rutaCliente.php",
        data: "id_peticion="+idpet,
        success: function (data) {
            console.log(data);
            latitud_ubicacion_cliente = data[0];
            longitud_ubicacion_cliente = data[1];
            latitud_destino_cliente = data[2];
            longitud_destino_cliente = data[3];

            latitud_ubicacion_cliente=parseFloat(latitud_ubicacion_cliente);
            longitud_ubicacion_cliente=parseFloat(longitud_ubicacion_cliente);
            latitud_destino_cliente=parseFloat(latitud_destino_cliente);
            longitud_destino_cliente=parseFloat(longitud_destino_cliente);

            consultar_direcciones_peticion();
            
        },
        error: function (e) {
            console.log('Error: ' + e+ idpet);
        }
    });
});

function consultar_direcciones_peticion() {
    iniciar_mapa_m();
    var latlng = new google.maps.LatLng(latitud_destino_cliente, longitud_destino_cliente);
    geocoder1.geocode({'latLng': latlng}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                document.getElementById("destino_cliente").value = results[0].formatted_address;
                //document.getElementById("txt_direccion_destino_cliente").value = results[0].formatted_address;
            } else {
                myApp.alert('Ocurrio un error al cargar la direccion de destino');
            }
        } else {
            myApp.alert('Ocurrio un problema con maps ' + status);
        }
    });
    latlng = new google.maps.LatLng(latitud_ubicacion_cliente, longitud_ubicacion_cliente);
    geocoder1.geocode({'latLng': latlng}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                document.getElementById("ubicacion_cliente").value = results[0].formatted_address;
                ubicacionCliente=document.getElementById("ubicacion_cliente").value;
                //document.getElementById("txt_direccion_ubicacion_cliente").value = results[0].formatted_address;
            } else {
                alert('Ocurrio un error al cargar la direccion de inicio');
            }
        } else {
            myApp.alert('Ocurrio un problema con maps ' + status);
        }
    });
}


function iniciar_mapa_m() {
    directionsService1 = new google.maps.DirectionsService();
    geocoder1 = new google.maps.Geocoder();
    map_m = new google.maps.Map(document.getElementById('mapSolicitud'), {
        center: {lat: latitud_destino_cliente, lng: longitud_destino_cliente},
        zoom: 18,
        rotateControl: false,
        mapTypeControl: true,
        streetViewControl: false,
    });
    directionsDisplay1 = new google.maps.DirectionsRenderer({
        map: map_m,
    });
}


function trazar_ruta() {
    directionsService1.route({
        origin: document.getElementById("ubicacion_cliente").value,
        destination: document.getElementById("destino_cliente").value,
        travelMode: 'DRIVING'
    }, function (response, status) {
        if (status === 'OK') {
            //document.getElementById("txt_metros_viaje").value = response.routes[0].legs[0].distance.value;
            directionsDisplay1.setDirections(response);

            //consulta_costo_viaje();
        } else {
            window.alert('No se pudo establecer la ruta' + status);
        }
    });
}


function taxi_marker(){ 
   //var URL="http://localhost/taxiapp/Clientes/ubicacionTaxi.php";
   var URL="http://bcodemexico.com/taxiApp/Clientes/ubicacionTaxi.php";
          $.ajax({
            type: "POST",
            dataType : 'json',
            cache: false,
            url:URL,
            data: 
                "id_chofer="+idchof,
                 // Adjuntar los campos del formulario enviado.
            success: function (data)
            {
             console.log(data);
             lat_chof=data[0];
             lon_chof=data[1];

             lat_chof=parseFloat(lat_chof);
             lon_chof=parseFloat(lon_chof);

             var directionsService = new google.maps.DirectionsService();
             var start=new google.maps.LatLng(lat_chof,lon_chof);
             var end=new google.maps.LatLng(latitud_destino_cliente,longitud_destino_cliente);

             update_marker();

             var request = {
                origin:start,
                destination:end,
                travelMode: google.maps.TravelMode.DRIVING
              };
            
              directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) {
                  var distancia=result.routes[0].legs[0].distance.value;                
                  console.log(result.routes[0].legs[0].distance.value + " meters");
                }

                if (distancia<=10) {
                  clearInterval(taxi_interval);
                  taxi_interval = undefined;
                   myApp.modal({
                    title:  'Notificacion',
                    text: 'Has llegado a tu destino',
                    buttons: [
                      {
                        text: 'Ok',
                        onClick: function() {                          
                           myApp.showPreloader('Calculando Costo');
                               setTimeout(function () {
                                  myApp.hidePreloader();
                                  calcular_costo_viaje();
                                  myApp.closeModal(".popup-verSolicitud");
                                  $( "#contenido_pagina" ).load( "DetalleViaje.html" );
                              }, 3000);  
                          }
                        }
                      ]
                    })
                  
                  }

                  var btntermina=document.getElementById("btn_termina_viaje").value;
                  if(btntermina=="terminado"){
                    clearInterval(taxi_interval);
                    taxi_interval = undefined;
                    myApp.modal({
                    title:  'Notificacion',
                    text: 'Viaje terminado',
                    buttons: [
                        {
                          text: 'Ok',
                          onClick: function() {      
                             myApp.showPreloader('Calculando Costo');
                               setTimeout(function () {
                                  myApp.hidePreloader();
                                  calcular_costo_viaje();
                                  myApp.closeModal(".popup-verSolicitud");
                                  $( "#contenido_pagina" ).load( "DetalleViaje.html" );
                              }, 3000);                   
                            //window.location="inicio.html";
                          }
                         }
                        ]
                      })
                    }

              });
                
            },
            error: function(e){
                alert('Error: '+e);
            }  
          });
  
}

 function update_marker() {
        if (markersArray[0]) {
            markersArray[0].setMap(null);
            markersArray.splice(-1, 1);
        }
        var myLatLng = {lat: lat_chof, lng: lon_chof};

        marker2 = new google.maps.Marker({
           position: myLatLng,
           map: map_m,
           title: 'taxi'
          });

        marker2.setMap(map_m);
        markersArray.push(marker2);

    }

function calcular_costo_viaje(){
  $.ajax({
        type: "POST",
        dataType: 'json',
        cache: false,
        //url: "http://localhost/taxiapp/Clientes/costoTraslado.php",
        url: "http://bcodemexico.com/taxiApp/Clientes/costoTraslado.php",
        //data: "id_peticion=1",
        data: "id_peticion="+idpet,
        success: function (data) {
            console.log(data);
            var ubicacion=data[0];
            var destino=data[1];
            var fecha=data[2];
            var hr_salida=data[3];
            var hr_llegada=data[4];
            var costo=data[5];

            document.getElementById("detalle_ubicacion").textContent=ubicacion;
            document.getElementById("detalle_destino").textContent=destino;
            document.getElementById("detalle_fecha").textContent=fecha;
            document.getElementById("detalle_hrSalida").textContent=hr_salida;
            document.getElementById("detalle_hrLlegada").textContent=hr_llegada;
            document.getElementById("detalle_costo").textContent="$"+costo;
            document.getElementById("detalle_costo").value=costo;
        },
        error: function (e) {
            console.log('Error: ' + e+ idpet);
        }
    });
}