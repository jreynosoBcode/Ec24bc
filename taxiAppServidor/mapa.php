<?php

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Administradores</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="author" content="GSM" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link rel="stylesheet" href="css/custom.css">

        <!-- Compiled and minified JavaScript -->
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjGHdi53xmyV8C4zP3vPBp-NVYZiAKJFk&libraries=places&callback=initMap" async defer></script>
        <script type="text/javascript" src="js/maps.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
        <script type="text/javascript">
            
            $(document).ready(function() {
                $("#panel-taxistas").hide();
                $('select').material_select();
            });
        </script>

  </head>

  <body>
    <nav>
      <div class="nav-wrapper">
        <div class="brand-logo right">
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li id="taxistas"><a ><i class="material-icons left">person</i>Ver taxistas</a></li>
            </ul>
        </div>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
          <li><a href="mapa.php"><i class="material-icons left">view_comfy</i>Inicio</a></li>
        </ul>
      </div>
    </nav>   
    <div class="row">
        <div class="col s10">
            <div style="position: absolute;top: 65px;bottom: 0px;right:0;left: 0px" id="mapa"></div>
        </div>
        <div class="col s2 panel-taxistas" id="panel-taxistas">
            <div class="row" style="margin: 0">
                <div class="col s12" style="padding: 0">
                 <div class="input-field" style="margin:20px 0px 0px 0px">
                    <i class="material-icons prefix">search</i>
                    <input id="icon_prefix" type="text" class="validate" style="margin:0px 0px 0px 45px">
                    <label for="icon_prefix">Busqueda avanzada</label>
                  </div>
                  <ul class="collection with-header">
                    <li class="collection-item">
                        <div>
                            <div>
                                <div>Alvin</div>
                                <div>Alvin</div>
                            </div>
                            <a href="#!" class="secondary-content"><i class="material-icons">send</i></a>
                        </div>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
    </div>
    
    
      
  </body>
</html>
