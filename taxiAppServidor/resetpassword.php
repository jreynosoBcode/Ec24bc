<html>
    <head>
      <meta charset="UTF-8"/>
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <style type="text/css">
      .reset-form {
        max-width: 380px;
        min-width: 300px;
        margin: 0 auto;
        background-color:#fff;
        border-radius: 10px;
        border: 2px solid rgba(0,0,0,0.1);
        box-shadow: 0px 2px 25px rgba(0, 0, 0, 1);
    }
    </style>
    <body style="position: relative;background: url(css/taxifondo.jpg);background-size:100% 850px;">
      <div style="width:100%;">
          <nav>
            <div class="nav-wrapper" style="background-color: #6a6d6c;">
              <a href="#" class="brand-logo">&nbsp;&nbsp;Sistema de Reseteo de Contrase単a</a>
            </div>
          </nav>
      </div>
      <div class="row" style="    margin-top: 80px;margin-left: 25px;">
        <form class="col s6 reset-form">
          <div class="row">
            <div class="input-field col s12">
              <input id="password1" type="password" class="validate">
              <label for="password1">Contrase単a</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="password2" type="password" class="validate">
              <label for="password2">Repite Contrase単a</label>
            </div>
          </div>
        </form>
      </div>
      <div class="row" style="margin-left: 25px;">
        <div class="col s6">
          <button class="btn waves-effect waves-light green" type="button" name="action" onclick="actualiza()">Actualizar
            <i class="material-icons right">send</i>
          </button>
        </div>
        
      </div>
      
      <!--JavaScript at end of body for optimized loading--> 
    </body>
    
    <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.2.1.js"></script>
   <script type="text/javascript" src="js/materialize.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>
    <script type="text/javascript">
    var mail;
        $(document).ready(function () {
            var c = getc("c");
            mail=c;
        });
      function actualiza() {
        if ($('#password1').val()==$('#password2').val() && $('#password1').val()!="" && $('#password2').val()!="") {
            var URL="http://localhost/taxiapp/Clientes/resetpass.php";
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    cache: false,
                    url:URL,
                    data:"pass="+$('#password1').val()+"&correo="+mail,
                           // Adjuntar los campos del formulario enviado.
                    success: function (data)
                    {   
                      console.log(data[0]);
                      if (data[0]=="1") {
                        alert('password cambiada');
                        window.location.href='https://bcodemexico.com/taxiapp/';
                      }else{
                        alert("no se encuentra correo");
                      }                   
                    },
                    error: function(e){
                        alert('Error: '+e);
                    }  
                });
        }else{
          $('#password1').val("");
          $('#password2').val("");
          alert("Completa los campos\n ó\nLas contraseñas no coinciden");
        }
      }
       function getc(variable) {
                var query = window.location.search.substring(1);
                var vars = query.split("&");
                for (var i = 0; i < vars.length; i++) {
                    var pair = vars[i].split("=");
                    if (pair[0] == variable) {
                        return pair[1];
                    }
                }
                return false;
            }
    </script>
</html>