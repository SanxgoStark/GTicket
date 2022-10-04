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
<body style="background-image: radial-gradient(circle at 0% 0%, #c2ff83 0, #a3ff8d 12.5%, #81ff96 25%, #5aff9d 37.5%, #1ef3a3 50%, #00e5a7 62.5%, #00d8ac 75%, #00cdb1 87.5%, #00c4b6 100%);">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

  <div class="container-fluid">
    <a class="navbar-brand" href="#">GTicket</a>
  </div>

</nav>

<!-- contenedor -->
<div id="centrar">

  <div id="centrar" style="border-style: solid; border-color: black; height: 450px;width: 400px;background: rgba(0,0,0,0.9);"class="row renglon">


      <!--  -->
<form action="veriLogin.php" method="post">

   <h1 align="center" style="color: white">LOGIN</h1>

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

