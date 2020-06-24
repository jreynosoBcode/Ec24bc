// Initialize app
var myApp = new Framework7();

var mainView = myApp.addView('.view-main', {
      dynamicNavbar: true
  });
var $$ = Dom7;


var mainView = myApp.addView('.view-main', {
  dynamicNavbar: true
});


// Handle Cordova Device Ready Event
$$(document).on('deviceready', function() {
    console.log("Device is ready!");
});


myApp.onPageInit('about', function (page) {

})

$$(document).on('pageInit', function (e) {
    // Get page data from event data
    var page = e.detail.page;

    if (page.name === 'about') {
        // Following code will be executed for page with data-page attribute equal to "about"
        myApp.alert('Here comes About page');
    }
})

// Option 2. Using live 'pageInit' event handlers for each page
$$(document).on('pageInit', '.page[data-page="about"]', function (e) {
    // Following code will be executed for page with data-page attribute equal to "about"
    myApp.alert('Here comes About page');
})
//popup historial de viaje
$$('.open-popup-historial').on('click', function () {
  myApp.popup('.popup-historial');
});

$$('.open-icon').on('click', function () {
    console.log("clicked icon");
    var clickedLink = this;
    myApp.popover('.popover-icon', clickedLink);
});


var ubicacion;
var destino;
function buscarTaxi(){
    ubicacion=$('#ubicacion').val();
    destino=$('#destino').val();
    if(ubicacion=="" || destino==""){
        myApp.modal({
            title:  '¡Atención!',
            text: 'Verifica que las direcciones no estén vacías',
            buttons: [
              {
                text: 'Ok',
                onClick: function() {
                 
                }
              }
            ]
        })

    }else{
        $( "#contenido_pagina" ).load( "buscarTaxi.html" );    
    }
  
}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////


function perfil() {
    $("contenido_pagina").each(function()
    {
        var
        target = $(this),
        request = new XMLHttpRequest();
         
        request.open('GET', target.attr("data-url"), true);
     
        request.onreadystatechange = function()
        {
            if(request.readyState === 4)
            {
                if(request.status === 200 || request.status === 0)
                {
                    target.html(request.responseText);
                                         
                 //   console.log('File "' + target.attr("data-url") + '" loaded to #' + target.attr("id") + ' tab!');
                }
            }
        }
         
        request.send();
    });
}

function lugaresFavoritos(){
    $( "#div-map" ).css("display","block");
    $( "#div-map" ).load( "nuevolugarmap.html" );
}

function loadHistorial(){
    var URL=ruta+"/Clientes/historialViajes.php";
    //var URL="http://localhost/taxiapp/Clientes/historialViajes.php";
    $.ajax({
        type: "POST",
        dataType : 'text',
        cache: false,
        url:URL,
        data:"id_cliente="+id_cliente,
               // Adjuntar los campos del formulario enviado.
        success: function (data)
        {
            $("#tabla-historial").html("");
            $("#tabla-historial").html(data); // Mostrar la respuestas del script PHP.
        },
        error: function(e){
            alert('Error: '+e);
        }  
    });   
}

function loadHistorialDetalles(id_traslado){
    var URL=ruta+"/Clientes/historialViajesDetalle.php";
    //var URL="http:/localhost/taxiapp/Clientes/historialViajesDetalle.php";
    $.ajax({
        type: "POST",
        dataType: 'json',
        cache: false,
        url:URL,
        data:"id_traslado="+id_traslado,
               // Adjuntar los campos del formulario enviado.
        success: function (data)
        {
            $("#fecha-viaje").html(data[0]);
            $("#horaSalida-viaje").html(data[1]);
            $("#horaLlegada-viaje").html(data[2]);
            $("#ubicacion-viaje").html(data[3]);
            $("#destino-viaje").html(data[4]);
            $("#nombreChofer-viaje").html(data[5]);
            $("#matricula-viaje").html(data[6]);
            $("#costo-viaje").html(data[7]);
        },
        error: function(e){
            alert('Error: '+e);
        }  
    });   
}
function loadPerfil(){
    $("input:checkbox").on('click', function() {
          // in the handler, 'this' refers to the box clicked on
          var $box = $(this);
          if ($box.is(":checked")) {
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            console.log(group);
            $(group).prop("checked", false);
            $box.prop("checked", true);
          } else {
            $box.prop("checked", false);
          }
        });
    var URL=ruta+"/Clientes/perfil.php";
    //var URL="http://localhost/taxiapp/Clientes/perfil.php";
    $.ajax({
        type: "POST",
        dataType: 'json',
        cache: false,
        url:URL,
        data:"id_cliente="+id_cliente,
               // Adjuntar los campos del formulario enviado.
        success: function (data)
        {
            console.log(data);
            var nom=data[0];
            var app=data[1];
            var apm=data[2];
            var calle=data[3];
            var colonia=data[4];
            var numero=data[5];
            var cp=data[6];
            var fnac=data[7];
            var genero=data[8];
            var tel=data[9];
            var cel=data[10];
            var freg=data[11];
            var email=data[12];
            var prom=data[13];
            var metodo1=data[14];
            var metodo2=data[15];


            nom=nom.charAt(0).toUpperCase() + nom.substring(1).toLowerCase();
            app=app.charAt(0).toUpperCase() + app.substring(1).toLowerCase();
            apm=apm.charAt(0).toUpperCase() + apm.substring(1).toLowerCase();
            calle=calle.charAt(0).toUpperCase() + calle.substring(1).toLowerCase();
            colonia=colonia.charAt(0).toUpperCase() + colonia.substring(1).toLowerCase();

            document.getElementById("apodo").textContent=nom;
            document.getElementById("fecha_registro").textContent=freg;
            document.getElementById("nombre").textContent=nom;
            document.getElementById("apellidos").textContent=app+" "+apm;
            document.getElementById("fecha_nacimiento").textContent=fnac;
            document.getElementById("correo").textContent=email;
            document.getElementById("tel").textContent=tel;
            document.getElementById("cel").textContent=cel;
            document.getElementById("calle").textContent=calle;
            document.getElementById("numero").textContent=numero;
            document.getElementById("colonia").textContent=colonia;
            document.getElementById("cp").textContent=cp;

            //modal
            document.getElementById("fecha_registro").value=freg;
            document.getElementById("nombre-mod").value=nom;
            document.getElementById("apellidop-mod").value=app;
            document.getElementById("apellidom-mod").value=apm;
            document.getElementById("tel-mod").value=tel;
            document.getElementById("cel-mod").value=cel;
            document.getElementById("calle-mod").value=calle;
            document.getElementById("num-mod").value=numero;
            document.getElementById("col-mod").value=colonia;
            document.getElementById("cp-mod").value=cp;

            if (genero=="M") {
                $("#my-checkbox-m").prop('checked', true);
                $("#checkbox-mod-m").prop('checked',true);

            }
            if (genero=="F") {
                $("#my-checkbox-f").prop('checked', true);
                $("#checkbox-mod-f").prop('checked',true);
            }
            if(genero==""){
                $("#my-checkbox-m").prop('checked', false);
                $("#checkbox-mod-m").prop('checked',false);
                $("#my-checkbox-f").prop('checked',false);
                $("#checkbox-mod-f").prop('checked',false);
            }
            if (metodo1=="efectivo") {
                $("#mod-efectivo").prop('checked', true);
                var efectivo = document.getElementById("met-efectivo");
                efectivo.style.display="block";
            }
            if (metodo2=="paypal") {
                $("#mod-paypal").prop('checked', true);
                var paypal = document.getElementById("met-paypal");
                paypal.style.display="block";
            }
            
        },
        error: function(e){
            console.log('Error: '+e+" loadPerfil");
        }  
    });   
}

function actualizaPerfil(){
    var genero;
    var nombre=document.getElementById("nombre-mod").value;
    var app=document.getElementById("apellidop-mod").value;
    var apm=document.getElementById("apellidom-mod").value;
    var tel=document.getElementById("tel-mod").value;
    var cel=document.getElementById("cel-mod").value;
    var calle=document.getElementById("calle-mod").value;
    var num=document.getElementById("num-mod").value;
    var col=document.getElementById("col-mod").value;
    var cp=document.getElementById("cp-mod").value;

    if ($("#checkbox-mod-m").is(":checked")) {
            genero="M";
        }
    if ($("#checkbox-mod-f").is(":checked")) {
            genero="F";
        }
    
    var URL=ruta+"/Clientes/actualizaPerfil.php";
    //var URL="http://localhost/taxiapp/Clientes/actualizaPerfil.php";
    $.ajax({
        type: "POST",
        dataType: 'text',
        cache: false,
        url:URL,
        data:"id_cliente="+id_cliente+"&nombre="+nombre+"&apellidop="+app+"&apellidom="+apm+"&tel="+tel+"&cel="+cel+"&calle="+calle+"&num="+num+"&col="+col+"&cp="+cp+"&genero="+genero,
         // Adjuntar los campos del formulario enviado.
        success: function (data)
        {
            console.log(data);
            myApp.modal({
                    title:'Datos Actualizados Correctamente',
                    text: '',
                    buttons: [
                      {
                        text: 'Ok',
                        onClick: function() { 
                            myApp.closeModal(".popup-perfil");                         
                           $( "#contenido_pagina" ).load( "perfil.html" );
                          }
                        }
                      ]
                    })            
            
        },
        error: function(e){
            console.log('Error: '+e+" loadPerfil");
        }  
    });   
}

function abremetodos(){
    myApp.popup('.popup-metodospago');
}

function agregametodospago(){
    var metodo1;
    var metodo2;
    if ($("#mod-efectivo").is(":checked")) {
            metodo1="efectivo";
        }else{
            metodo1="";
        }
    if ($("#mod-paypal").is(":checked")) {
            metodo2="paypal";
        }else{
            metodo2="";
        }
    var URL=ruta+"/Clientes/metodosPago.php";
    //var URL="http://localhost/taxiapp/Clientes/metodosPago.php";
    $.ajax({
        type: "POST",
        dataType: 'text',
        cache: false,
        url:URL,
        data:"id_cliente="+id_cliente+"&metodo1="+metodo1+"&metodo2="+metodo2,
         // Adjuntar los campos del formulario enviado.
        success: function (data)
        {
            console.log(data);
            myApp.modal({
                    title:'Datos Actualizados Correctamente',
                    text: '',
                    buttons: [
                      {
                        text: 'Ok',
                        onClick: function() { 
                            myApp.closeModal(".popup-metodospago");                         
                           $( "#contenido_pagina" ).load( "perfil.html" );
                          }
                        }
                      ]
                    })
            
        },
        error: function(e){
            console.log('Error: '+e+" loadPerfil");
        }  
    });   
}

function getfavoritos(){
    var URL=ruta+"/Clientes/Lugares/mostrarLugaresfavoritos.php";
    //var URL="http://192.168.100.13/taxiApp/Clientes/lugares/mostrarLugaresfavoritos.php";
    //var URL="http://localhost/taxiapp/Clientes/Lugares/mostrarLugaresfavoritos.php";
    console.log("ID CLIENTE "+id_cliente);
    $.ajax({
        type: "POST",
        dataType: 'json',
        cache: false,
        url:URL,
        data:"id_cliente="+id_cliente,
        success: function (data)
        {   
            console.log(data[0][0]);
            console.log(data[1][0]);
            var no_lugares=data.length;
            if ($("#tabla_lugares")) {
                $("#tabla_lugares").empty();
                for (var i = 0; i<no_lugares; i++) {
                    $("#tabla_lugares").append(
                        '<li>'+
                            '<a href="#"  class="item-link item-content close-panel" onclick="setDireccion_favorito('+data[i][4]+','+data[i][5]+')">'+
                                '<div class="item-media">'+
                                    '<i class="icon f7-icons" style="color: #0489b1">'+data[i][2]+'</i>'+
                                '</div>'+
                                '<div class="item-inner">'+
                                    '<div class="item-title">'+data[i][1]+'</div>'+
                                '</div>'+
                            '</a>'+
                        '</li>'
                    );
                }
            }

            if ($("#lista-lugaresFavoritos")) {
                $("#lista-lugaresFavoritos").empty();
                for (var j = 0; j<no_lugares; j++) {
                    $("#lista-lugaresFavoritos").append(
                        '<li style="background:#fff">'+
                            '<a href="#"  class="item-link item-content">'+
                                '<div class="item-media">'+
                                    '<i class="icon f7-icons" style="color: #0489b1">'+data[j][2]+'</i>'+
                                '</div>'+
                                '<div class="item-inner">'+
                                    '<div class="item-title">'+data[j][1]+'</div>'+
                                    '<div data-popover=".popover-more" class="more-icon open-popover">'+
                                    '<i onclick="setIdLugar('+data[j][0]+')" class="icon f7-icons" style="color: #0489b1">more_vertical_round_fill</i></div>'+
                                '</div>'+
                            '</a>'+
                        '</li>'
                    );
                }
            }
        },
        error: function(e){
            console.log('Error: '+e+" en getfavoritos");
        }  
    });   
}
var icon="add";
function setIcon(iconText,iconName){
    $("#linkIcon").html(iconText);
    $("#showIcon").html(iconName);
    icon=iconName;
}
function agregarLugar(){
    var nombreLugar=$("#nombreLugarFavorito").val();
    var direccionLugar=$("#direccionLugarFavorito").val();
    var iconLugar=$("#iconLugar select").val("val2");
    if (nombreLugar=="" || direccionLugar=="") {

    }else{
        var URL=ruta+"/Clientes/Lugares/agregarLugar.php";
        //var URL="http://localhost/taxiapp/Clientes/Lugares/agregarLugar.php";
        $.ajax({
            type: "POST",
            dataType: 'text',
            cache: false,
            url:URL,
            data:"id_cliente="+id_cliente+"&nombre="+nombreLugar+"&latitud="+LatLugar+"&longitud="+LngLugar+"&direccion="+direccionLugar+"&icon="+icon,
                   // Adjuntar los campos del formulario enviado.
            success: function (data)
            {   
                getfavoritos();
            },
            error: function(e){
                alert('Error: '+e);
            }  
        });   

    }
    
}

function setIcon(iconText,iconName){
    $("#linkIcon").html(iconText);
    $("#showIcon").html(iconName);
    icon=iconName;
}

var idLugar;
function setIdLugar(id){
    idLugar=id;
}
function popup_verLugar(){
    $('#list-verLugar').hide();
    $('#loader-verLugar').show();

    myApp.popup('.popup-verLugar');
    var URL=ruta+"/Clientes/Lugares/verLugar.php";
    //var URL="http://localhost/taxiapp/Clientes/Lugares/verLugar.php";
    $.ajax({
        type: "POST",
        dataType: 'json',
        cache: false,
        url:URL,
        data:"id_lugar="+idLugar,
               // Adjuntar los campos del formulario enviado.
        success: function (data)
        {   
            $('#loader-verLugar').hide();
            $('#list-verLugar').show();
            $('#ver-nombreLugarFavorito').val(data[0]);
            $('#ver-showIcon').html(data[1]);
            $('#ver-direccionLugar').val(data[2]);
        },
        error: function(e){
            alert('Error: '+e);
        }  
    }); 
}

function borrarLugar(){
    myApp.modal({
        title:  '¡Atención!',
        text: 'Estás seguro que deseas eliminar ese lugar',
        buttons: [
            {
                text: 'No',
                onClick: function() {
                }
            },
            {
                text: 'Sí',
                onClick: function() {
                    var URL=ruta+"/Clientes/Lugares/borrarLugar.php";
                    //var URL="http://localhost/taxiapp/Clientes/Lugares/borrarLugar.php";
                    $.ajax({
                        type: "POST",
                        dataType: 'text',
                        cache: false,
                        url:URL,
                        data:"id_lugar="+idLugar,
                               // Adjuntar los campos del formulario enviado.
                        success: function (data)
                        {   
                            getfavoritos();
                        },
                        error: function(e){
                            alert('Error: '+e);
                        }  
                    }); 
                }
            }    
        ]
    })
}

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  console.log(regex.test(email));
  return regex.test(email);
}

function registro(){
    if ($('#correo').val()!="" && $('#nombre').val()!="" && $('#apellidop').val()!="" && $('#apellidom').val()!="" && $('#fechanac').val()!="" && $('#cel').val()!="") {
        if (isEmail($('#correo').val())==true) {
                if ($('#pass1').val()==$('#pass2').val() && $('#pass1').val()!="" && $('#pass2').val()!="") {
                var data=$('#form-registro :input').serialize();

                var URL=ruta+"/Clientes/registro.php";
                //var URL="http://localhost/taxiapp/Clientes/registro.php";
                $.ajax({
                  type: "POST",
                  dataType : 'text',
                  cache: false,
                  url:URL,
                  data:data,
                  success: function (data)
                  {
                        $('#respuesta').html(data);
                      console.log(data);
                       myApp.modal({
                          title:  'Datos registrados correctamente',
                          text: '',
                          buttons: [
                            {
                              text: 'Ok',
                              onClick: function() {                          
                                    myApp.closeModal(".popup-about");
                                    window.location="index.html";
                                }
                              }
                            ]
                          })

                  },
                  error: function(e){
                      alert('Error: '+e);
                  }  
                });
            }else{
                $('#pass1').val("");
                $('#pass2').val("");
                myApp.modal({
                title:  '¡Atención!',
                text: 'Verifica las contraseñas',
                buttons: [
                    {
                      text: 'OK',
                      onClick: function() {
                       
                      }
                    }
                   
                  ]
                });
               
            }

        }else{
            myApp.modal({
            title:  '¡Atención!',
            text: 'Campo Email no tiene el formato valido',
            buttons: [
                {
                  text: 'OK',
                  onClick: function() {
                   
                  }
                }
               
              ]
            });
        }

    }else{
         myApp.modal({
            title:  '¡Atención!',
            text: 'Completa los datos ',
            buttons: [
                {
                  text: 'OK',
                  onClick: function() {
                   
                  }
                }
               
              ]
            });
               
    }
       
    
}

function cerrar_registro(){
    myApp.closeModal(".popup-about");
    window.location="index.html";
}

function resetpass(){
   if (isEmail($('#correo_reset').val())==true && $('#correo_reset').val()!="") {
        //console.log($('#correo_reset').val());
        var URL=ruta+"/Clientes/mail.php";
        console.log(URL);
        var correo=$('#correo_reset').val();
        $.ajax({
            type: "POST",
            url:URL,
            data:"correo="+correo,
                   // Adjuntar los campos del formulario enviado.
            success: function (response)
            {  
                if(response == "1"){
                    myApp.modal({
                        title:  '¡Exito!',
                        text: 'El correo se ha enviado de forma correcta.',
                        buttons: [
                            {
                              text: 'OK',
                              onClick: function() {
                                //myApp.closeModal(".popup-resetpass");
                                //window.location="index.html";
                              }
                            }
                           
                          ]
                        });
                }else{
                    myApp.modal({
                        title:  '¡Error!',
                        text: 'El correo no se pudo enviar.',
                        buttons: [
                            {
                              text: 'OK',
                              onClick: function() {
                               
                              }
                            }
                           
                          ]
                        });
                }
            },
            error: function(e){
                alert('Error: '+e);
            }  
        }); 
   }else{
    myApp.modal({
        title:  '¡Atención!',
        text: 'El correo no tiene el formato correcto o no se lleno el campo.',
        buttons: [
            {
              text: 'OK',
              onClick: function() {
               
              }
            }
           
          ]
        });
   }
    
}

function cerrar_reset(){
    myApp.closeModal(".popup-resetpass");
    window.location="index.html";
}

function login() {
    
    var URL=ruta+"/Clientes/login.php";
    //var URL="http://localhost/taxiapp/Clientes/login.php";
    var correo=$('#correoLogin').val();
    var pass=$('#passwordLogin').val();
    localStorage.user = document.getElementById("correoLogin").value;
    localStorage.pass = document.getElementById("passwordLogin").value;
    if (correo=="" || pass=="") {
        var myApp = new Framework7();
        myApp.modal({
          title: '<label style="color:red">Error<label>',
          text: 'Ingresa tu correo y contraseña',
          buttons: [
            {
              text: 'Ok',
              onClick: function() {
              }
            }
          ]
        })
    }else{
        $.ajax({
          type: "POST",
          dataType : 'json',
          cache: false,
          url:URL,
          data:"correo="+correo+"&password="+pass,
          success: function (data)
          {
                console.log(data[0]);
              if(data[0]=="UNSUCCESSFUL"){
                  var myApp = new Framework7();
                  myApp.modal({
                    title: '<label style="color:red">Error<label>',
                    text: 'Verifica que el correo o contraseña estén correctos',
                    buttons: [
                      {
                        text: 'Ok',
                        onClick: function() {
                        }
                      }
                    ]
                  })
                $('#passwordLogin').val("");
              }else{
                  window.localStorage.setItem("id_cliente", data[0]);
                  window.location="inicio.html";

              }
          },
          error: function(e){
              console.log('Error: '+e);
          }  
        });
    }   
}

function logout(){
    console.log("********************************");
    localStorage.user = "";
    localStorage.pass = "";
    window.localStorage.removeItem("id_cliente");
    window.location="index.html";
}


function termina_viaje(){
    document.getElementById("btn_termina_viaje").value="terminado";
    esperar();
}

function esperar(){
    myApp.showPreloader('Terminando Viaje');
     setTimeout(function () {
        myApp.hidePreloader();
    }, 3000);

    var idpet=document.getElementById("id_pet").value;
    $.ajax({
        type: "POST",
        dataType: 'text',
        cache: false,
        //url: "http://localhost/taxiapp/Clientes/TerminaViajeTaxi.php",
        url: ruta+"/Clientes/TerminaViajeTaxi.php",
        data: "id_peticion="+idpet,
        success: function (data) {
            console.log(data);
            
        },
        error: function (e) {
            console.log('Error: ' + e+ idpet);
        }
    });

}

function califica_taxista() {
    var formData = $("#frm_calificacion_taxista").serialize();

    $.ajax({
        url: ruta+"/Clientes/agrega_calificacion_taxista_servicio.php",
        //url: "http://localhost/taxiApp/Clientes/agrega_calificacion_taxista_servicio.php",
        type: 'POST',
        data: formData + "&id_peticion=" + idpet,
        //data: formData + "&id_peticion=1",
        success: function (data, textStatus, jqXHR) {
            console.log("correcto");
             myApp.modal({
                  title:  'Gracias por utilizar nuestro servicio',
                  text: '',
                  buttons: [
                    {
                      text: 'Ok',
                      onClick: function() {                          
                            myApp.closeModal(".popup-calificacion-taxista");
                            window.location="inicio.html";
                        }
                      }
                    ]
                  })
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log("error " + textStatus);
        }
    });
    
}
