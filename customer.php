<html>
    <script>
// Realizado por Juan Manuel Medina Ruiz
// Muestro los datos del apartado a
window.onload = CargaDatos;

function CargaDatos(){
            var xhr = new XMLHttpRequest();
            xhr.onload = function(){
                var customer = JSON.parse(this.responseText);
                Muestra(customer);
            }
            xhr.open("GET","muestra_customer.php");
            xhr.send();
        }

        function Muestra(customer){
            var tabla = `<tr>
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Telefono</th> 
                        <th>Type</th>
                </tr>`;

            for (var i=0;i<customer.length;i++){
                if (customer[i].type == 'P'){
                    // Premium se muestra en color rojo
                    // Y redirigimos la consulta para mostrar todos los datos en consulta php
                    tabla += `<tr>
                        
                        <td><a href="consulta.php?id='${customer[i].id}'">${customer[i].name}</a></td>
                        <td>${customer[i].address}</td>
                        <td>${customer[i].phone}</td>
                        
                        <td style="color:red">${customer[i].type}</td>
                        </tr>`;
                
                }else{
              
                tabla += `<tr>
                        
                        <td><a href="consulta.php?id='${customer[i].id}'">${customer[i].name}</td>
                        <td>${customer[i].address}</td>
                        <td>${customer[i].phone}</td>
                        
                        <td>${customer[i].type}</td>
                        </tr>`;
                }
                
            }


                      
        
         
            
            document.getElementById("tabla").innerHTML = tabla;
        }

         

        function Rojo(){
            if (document.getElementByName("type").innerHTML.value == "P"){
                td.style.color = "red"
            }
        }
        // Validacion Formulario por JS
        function Validar(f){
        // Limipo todos <span> con los mensajes de error y los resalto en rojo
            
	var spans = document.querySelectorAll("span");
	for (var i=0; i<spans.length;i++){
		spans[i].innerHTML = "";
		spans[i].style.color = "red";
	}

    //Compruebo Nombre
    if (f.nombre.value.length==0){
        spans[0].innerHTML = "Introduzca un nombre";
		f.pass.focus();
		f.pass.select();
        return false;
   	}

    //Compruebo Direccion
        if (f.direccion.value.length==0){
        spans[1].innerHTML = "Introduzca una direccion";
		f.pass.focus();
		f.pass.select();
        return false;
   	}

    //Compruebo Direccion
     if (f.descripcion.value.length==0){
        spans[3].innerHTML = "Introduzca una descripcion";
		f.pass.focus();
		f.pass.select();
        return false;
   	}
    // Compruebo numero
	if (!/[0-9]{8}$/.test(f.telefono.value)){
		spans[2].innerHTML = "Introduzca un digito de 8 cifras";
		f.pass.focus();
		f.pass.select();
        return false;
		
	}
    return true;
        }
    </script>
<body>
    <!-- Formulario Apartado B --> 
    <h1>Customers</h1>
    <h2>Nuevo customer</h2>
    <form action="#" method="POST" onsubmit="return Validar(this)">
        Nombre <input type="text" name="nombre"><span></span><br>
        Direccion <input type="text" name="direccion"><span></span><br>
        <!-- Aqui controlo que sea un numero valido del apartado C --> 
        Telefono (8 digitos) <input type="text" name="telefono" min="7" max="9"><span></span><br>
        Descripcion <input type="text" name="descripcion"><span></span><br>
        <!-- Aqui controlo que solo sea P o N del apartado C --> 
        Seleccione su tipo de suscripcion <select name="pn">
            <option value="P">P</option>
            <option value="N">N</option>
        </select>
            <div name="error"></div>
        <input type="submit" name="enviar"> 
    </form>

    <table id="tabla">
    </table>
    
</body>
</html>


<?php

// Aqui realizamos la conexion con la tabla -- Apartado A, Para el apartado C he añadadido que aparte muestre el type
require("conexion.inc.php");
$c = new mysqli($host,$user,$pass,$db);
$c->query("SET NAMES utf8");
/*
$sql = "SELECT name,address,phone,type FROM customer";

json_encode($c->query($sql)->fetch_all(MYSQLI_ASSOC));
*/

// Aqui insertamos los datos en la tabla y comprobamos que los datos no esten vacios -- Apartado B
if (isset($_POST['enviar'])){
    if (strlen($_POST['nombre']) >= 1 &&
    strlen($_POST['direccion']) >= 1 && 
    strlen($_POST['telefono']) >= 1 &&
    strlen($_POST['descripcion']) >= 1) {
        $name = $_POST['nombre'];
        $address = $_POST['direccion'];
        $phone = $_POST['telefono'];
        $description = $_POST['descripcion'];
        $type = $_POST['pn'];

        $sql = "INSERT INTO customer VALUES (null,'$name','$address','$description','$phone','$type')";

        $resultado = mysqli_query($c,$sql);
        if($resultado){
            echo "Correcto";
          } else {
            echo "No valido";
          } 
        }else{
            echo "Debes rellenar todos los campos";
        }
}
?>




