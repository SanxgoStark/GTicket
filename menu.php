
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="css/bootstraplux.css">
  <link rel="stylesheet" type="text/css" href="css/all.css">
  <link rel="stylesheet" type="text/css" href="css/custom.css">

</head>
<body>

<nav style="position:;" class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">GTicket</a>
    <ul class="navbar-nav me-auto">
      <li class="nav-item">
        <a style="color: white" class="nav-link" href="home_user.php"><i class="<--!aqui icono de fontawesome!-->"></i> Home</a>
        <span class="visually-hidden">(current)</span>
      </li>
    </ul>
 <div>
   <button type="button" class="btn btn-dark disabled"><?=$_SESSION['nombre_usuario'];
 ?></button>

 <button onclick="" type="button" class="btn btn-success"><a style="color:white" href="index.php"><i class="fas fa-sign-out-alt"></i></a></button>
 </div>   
 

  </div>
  
  
</nav>
</div> <!-- fin del div id fondo -->


</body>
</html>



