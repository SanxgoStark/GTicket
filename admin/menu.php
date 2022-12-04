
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="../css/bootstraplux.css">
  <link rel="stylesheet" type="text/css" href="../css/all.css">
  <link rel="stylesheet" type="text/css" href="../css/custom.css">

</head>
<body>

<nav style="background-color:#005195 !important" class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a style="color:white" class="navbar-brand" href="#">GTicket</a>
    <ul class="navbar-nav me-auto">
      <li class="nav-item">
        <a style="color: white" class="nav-link" href="home_admin.php"><i class="<--!aqui icono de fontawesome!-->"></i> Home</a>
        <span class="visually-hidden">(current)</span>
      </li>

      <li class="nav-item">
        <a style="color: white" class="nav-link" href="gestion_emp.php"><i class=""></i>G.Empleados</a>
      </li>
    </ul>
    <div style="margin-right:30px">
  <img width="80" src="../graficos/grammer-logo.svg">
  </div>
 <div>
   <button type="button" class="btn btn-dark disabled"><?=$_SESSION['nombre_usuario'];
 ?></button>

 <button onclick="" type="button" class="btn btn-success"><a style="color:white" href="../index.php"><i class="fas fa-sign-out-alt"></i></a></button>
 </div>   
 

  </div>
  
  
</nav>
</div> <!-- fin del div id fondo -->


</body>
</html>



