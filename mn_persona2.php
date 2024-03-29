<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html lang="es-ES" dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
    <head>        
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
        <meta description="Registro y cotrol de actividades asistenciales"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <link rel="stylesheet" type="text/css" href="fonts/style.css">
        <title>Medinet</title>
    </head>
    <script language="JavaScript">
        function validar(){
            var error='';
            if(document.form1.identificacion.value==''&& document.form1.apellidos.value=='' && document.form1.nombres.value==''){
                alert("Para la busqueda, al menos se debe digitar el valor de un campon"+error);
            }
            else{
                document.form1.submit();
            }
        }
        function eliminar(id_,numiden_){
            /*if(confirm("Desea eliminar a la persona con la identifici�n\n"+numiden_)){
                window.open("mn_persona22.php?id_persona="+id_,"_self");
            }*/
            alert("Opcion NO disponible");
        }
        function editar(id_){
            window.open("mn_persona21.php?id_persona="+id_,"_self");
        }
        function paciente(id_){
            window.open("mn_persona23.php?id_persona="+id_,"_self");
        }
    </script>

<body>

<?php
require("mn_funciones.php");
require("mn_menu.php");
require("mn_menu_persona.php");
$identificacion='';
$apellidos='';
$nombres='';
$orden='';
$id_persona='';
if(isset($_POST['identificacion'])){$identificacion=$_POST['identificacion'];}
if(isset($_POST['apellidos'])){$apellidos=$_POST['apellidos'];}
if(isset($_POST['nombres'])){$nombres=$_POST['nombres'];}
if(isset($_POST['orden'])){$orden=$_POST['orden'];}
if(isset($_POST['id_persona'])){$id_persona=$_POST['id_persona'];}
?>
<form name='form1' method="post" action="mn_persona2.php">
    <span class="form-el"><input type='text' id='identificacion' name='identificacion' maxlength='20' size='20' placeholder='Identificaci�n' value="<?php echo $identificacion;?>"/></span>
    <span class="form-el"><input type='text' id='nombres' name='nombres' maxlength='30' size='30' placeholder='Nombres' value="<?php echo $nombres;?>"/></span>
    <span class="form-el"><input type='text' id='apellidos' name='apellidos' maxlength='30' size='30' placeholder='Apellidos' value="<?php echo $apellidos;?>"/></span>
    <span class="form-el">Orden
        <select id='orden' name='orden' value="<?php echo $orden;?>">
            <option value='identificacion'>Identificaci�n</option>
            <option value='papellido'>Apellidos</option>
            <option value='pnombre'>Nombres</option>
        </select>
    </span>
    <a href="#" onclick='validar();' title='Buscar'><span class="icon-magnifying-glass"></span> </a>
<?php
$condicion='';
if(!empty($id_persona)){$condicion=$condicion."id_persona='$id_persona' AND ";}
if(!empty($identificacion)){$condicion=$condicion."identificacion='$identificacion' AND ";}
if(!empty($apellidos)){$condicion=$condicion."(papellido LIKE '%$apellidos%' OR sapellido LIKE '%$apellidos%') AND ";}
if(!empty($nombres)){$condicion=$condicion."(pnombre LIKE '%$nombres%' OR snombre LIKE '%$nombres%') AND ";}
if(!empty($condicion)){
    $condicion=substr($condicion,0,-5);
    //echo "<br>".$condicion;
    if(empty($orden)){$orden='identificacion';}
    $consulta="SELECT id_persona,tipo_iden,identificacion,CONCAT(pnombre,' ',snombre,' ',papellido,' ',sapellido) AS nombre,direccion,telefono FROM persona WHERE ".$condicion." ORDER BY ".$orden;
    //echo "<br>".$consulta;
    $consulta=$link->query($consulta);
    if($consulta->num_rows<>0){
        echo "<br><br><table width='100%'>";
        echo "<th colspan='3'>Opciones</th>".
            "<th>Tp.Iden.</th>".
            "<th>Identificaci�n.</th>".
            "<th>Nombre</th>".
            "<th>Tel�fono</th>",
            "<th>Direcci�n</th>";
        while($row=$consulta->fetch_array()){
            echo "<tr>";
            echo "<td width='5%'><a href='#' onclick=editar($row[id_persona]) title='Editar' class='btnhref'><span class='icon-edit'></span></a></td>";
            echo "<td width='5%'><a href='#' onclick=eliminar($row[id_persona],$row[identificacion]) title='Eliminar' class='btnhref'><span class='icon-trash Eliminar'></span></a></td>";
            echo "<td width='5%'><a href='#' onclick=paciente($row[id_persona],$row[identificacion]) title='Informaci�n del Paciente' class='btnhref'><span class='icon-v-card'></span></a></td>"; 
            echo "<td>$row[tipo_iden]</td>";
            echo "<td>$row[identificacion]</td>";
            echo "<td>$row[nombre]</td>";
            echo "<td>$row[telefono]</td>";
            echo "<td>$row[direccion]</td>";
            echo "</tr>";
        }
    }
    echo "</table>";
}
?>
</form>
</body>
</html>
