<?
  session_start();
  session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstraplux.css">
  <link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body style="">

<nav style="backgrund-color:#005195 !important" class="navbar navbar-expand-lg navbar-light bg-light">

  <div class="container-fluid">
    <a style="color:white" class="navbar-brand" href="#">GTicket</a>
  </div>
  <div style="margin-right:15px">
  <img width="80" src="graficos/grammer-logo.svg">
  </div>
  
</nav>

<!-- contenedor -->
<div id="centrar">

  <div id="centrar" style="border-radius:22px;border-style: solid; border-color: #005195; height: 450px;width: 400px;background: #005195;"class="row renglon">


      <!--  -->
<form action="veriLogin.php" method="post">

   <h1 align="center" style="color: #E5EEF7">LOGIN</h1>

   <div align="center">

    <div style="margin-top: 15px">
        <p align="center" class="text-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Por favor ingrese su usuario y contraseña</font></font></p>
      </div>
     
    <div style="margin-top: 35px">

      <input style="width: 300px" type="text" class="form-control" id="idEmail" placeholder="Usuario" name="usuario">
    </div>

    <div style="margin-top: 35px">
      
      <input style="width: 300px" type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña" name="contraseña">
      <br>
      <!-- por defecto el boton es submit -->
      <button style="margin-top: 15px" type="submit" type="button" class="btn btn-outline-success"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Login</font></font></button>
      
      </form></td>
    </div>



   </div>
    
    
    <!-- <input id="btn" onclick="ocultaralert()" type="button"  value="alerta"></input> -->
</form>


  </div>
</div>
  
  

</div>

</body>
</html>

