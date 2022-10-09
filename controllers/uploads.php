<?php 

    include "../class/classBaseDatos.php";
	// al agregar el sesion start se puudieron guaradr las varires de session en la sesion de nueva venta
	// session_start();
    // var_dump($_SESSION['listadodecompra']);
    // array para productos agregados
    // $listado = $_SESSION['listadodecompra'];
    // $total = $_SESSION['total'];
 
    // $_SESSION['listadodecompra'] = $_SESSION['listadodecompra'] + $listado;
    // var_dump($_SESSION['listadodecompra']);
    // die();
    // var_dump($_POST['accion']);
    $accion = isset($_POST['accion'])?$_POST['accion']:"default";    
    // die();
    switch ($accion) {

        case 'llenar':
                if (empty($_SESSION['listadodecompra'])) {}else{
                    llenart();
                }
            break;
        case 'venta':

                generarV();

                die();
                // armado de cadena de insersion
                    $cad="INSERT INTO producto set ";
                    //var_dump($_POST); //para checar que esta enviando
                    // todas las variables conn $_ son arrglos asociativos
                    // con el foreachme traigo todos los campos y armare la cadena de insercion
                    foreach ($_POST as $nombCampo => $valor) 
                        // con este if se elimina el accion de la consulta, para que se pueda ejecutar en la base de datos
                        if($nombCampo!="accion")
                            // los '' en la linea de abajo se agrega para el tipo de dato que se este jalando de la base de datos, en este caso los '' se utilizan si el campo es numerico o texto
                            $cad.=$nombCampo."='".$valor."',";
                        
                    // funcion que me trae una cadena dentro de otras cadena
                       // (cadena,start,end)    
                    $cad = substr($cad,0,-1); // con el -1 indicamos que no queremos el ultimo caracter de la cadena (esto para eliminar una como que salia demas en la consulta)
                    // echo $cad;

                    //ejecuta la cadena
                    $this->consulta($cad);
                    $result.=$this->proceso('list');
            break;    
        
        default:

            if (isset($_POST['idp']) && isset($_POST['cantNew'])) {
                // variables para actualizar cantidad de producto en sesion
                $idp = $_POST['idp'];
                $cantNew = $_POST['cantNew'];
                // print_r("id".$idp."catidadNew".$cantNew);

                for ($i=0; $i < sizeof($_SESSION['listadodecompra']); $i++) {

                     if ($idp == $_SESSION['listadodecompra'][$i]["id_p"]) {
                         $_SESSION['listadodecompra'][$i]["cantidad_p"] = $cantNew + 1;

                         // calculo de total
                         // $total = $total + ;
                         $total = $total + $_SESSION['listadodecompra'][$i]["precio_p"];
                         $_SESSION['total'] = $total;
                         ///////////////////
                     }
                    
                }

                

                unset($_POST['idp']);
                unset($_POST['cantNew']);

                print_r($total);
            }else{

                $id = $_POST['i'];
                $producto = $_POST['producto'];
                $contenido= $_POST['contenido'];
                $precio= $_POST['precio'];

                $total = $total + $precio;
                $_SESSION['total'] = $total; 

                // var_dump($id);
                // var_dump($producto);
                // var_dump($contenido);
                // var_dump($precio);

                $producto = array(

                    "id_p" => $id,
                    "producto_p" => $producto,
                    "contenido_p" => $contenido,
                    "precio_p" => $precio,
                    "cantidad_p" => 1

                );

                // agregacion de producto a listado
                $listado[] = $producto;
                $_SESSION['listadodecompra'] = $_SESSION['listadodecompra'] + $listado;
                // var_dump($listado);
                // var_dump($_SESSION['listadodecompra']);
                print_r($total);
                // var_dump(sizeof($listado));
                // var_dump("modificado desde aqui");
            }
            break;
    }
    
    
    
    function llenart(){

            // var_dump($_SESSION['listadodecompra'][0]["idp"]);
        echo "<tr><td>" ."#". "</td><td>" ."Producto". "</td><td>" ."Precio". "</td><td>" ."Cantidad". "</td></tr>";

       for ($j = 0; $j < sizeof($_SESSION['listadodecompra']); $j++) {

            $idpc = $_SESSION['listadodecompra'][$j]['id_p'];

                echo "<tr><td>" . $_SESSION['listadodecompra'][$j]['id_p'] . "</td><td>" . $_SESSION['listadodecompra'][$j]['producto_p']."<br>".$_SESSION['listadodecompra'][$j]['contenido_p'] . "</td><td>" . $_SESSION['listadodecompra'][$j]['precio_p'] . "</td><td id='cant".$idpc."' >" . $_SESSION['listadodecompra'][$j]['cantidad_p'] . "</td></tr>";

       }

    }

    // funcion´para generar una venta
    function generarV(){
            $cad="INSERT INTO venta
            (fk_id_emp,fecha,hora) 
            values(".$_SESSION["Id"].",'2021-01-01','17:20:44')";

            consult($cad);
    }

        // funcion para despliegue de tabla venta_detalle
        function Vdetalle(){

            $cad2 = "SELECT nomb_prod as Producto,precio_prod as Precio,cantidad as Cantidad FROM venta_detalle VD join producto P on VD.fk_id_prod = P.Id WHERE VD.Id ='1'";

                    $result=$this->imprimeTabla2($cad2,true);

                    return $result;

                    // var_dump($_POST['idRegistro']);
                    // seccion de total de vendat detalle
                    $res="SELECT SUM(cantidad*precio_prod) as resultado FROM venta_detalle VD join producto P on VD.fk_id_prod = P.Id  where VD.Id='1'";

                    $total = $this->consult($res);
                    // var_dump($total);

                    // volcar datos, provenientes de una consulta mysql, dentro de un array php
                    $consultaqt = mysqli_fetch_array($total);
                    $totalt = $consultaqt['resultado'];

                    $totalf = substr($totalt,0,-2); // le quitamos 2 ceros

                    // var_dump($totalt);

                    echo "<div style='margin-top:380px;position:absolute;margin-left:70%'><h1>Total: $".$totalf."</h1></div>";
        }
    
?>
