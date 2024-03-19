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
            if(document.form1.tipo_iden.value==''){error+="Tipo de Identificaci�n\n";}
            if(document.form1.identificacion.value==''){error+="N�mero de Identificaci�n\n";}
            if(document.form1.papellido.value==''){error+="Primer Apellidos\n";}
            if(document.form1.pnombre.value==''){error+="Primer Nombres\n";}
            if(document.form1.fecha_nacim.value==''){error+="Fecha de Nacimiento\n";}
            if(document.form1.sexo.value==''){error+="Sexo\n";}
            if(document.form1.login.value==''){error+="Login\n";}
            if(document.form1.password.value==''){error+="Password\n";}
            if(document.form1.password.value!=document.form1.password2.value){error+="Verifique el Password\n";}
            if(document.form1.profesion.value==''){error+="Profesion\n";}
            if(document.form1.id_formato.value==''){error+="Formato\n";}
            if(error!=''){
                alert("Es necesario complementar la siguiente informaci�n:\n"+error);
            }
            else{
                document.form1.submit();
            }
        }
        function recargar(opc_){
            document.form1.action='mn_usuario1.php';
            document.form1.submit();
        }
        
    </script>

<body>

<?php
require("mn_funciones.php");
require("mn_menu.php");
require("mn_menu_usuario.php");
$link=conectarbd();
$tipo_iden='';
$identificacion='';
$papellido='';
$sapellido='';
$pnombre='';
$snombre='';
$fecha_nacim='';
$direccion='';
$telefono='';
$sexo='';
$login='';
$password='';
$profesion='';
$registro='';
$id_formato='';
$estado='';

if(!empty($_POST['tipo_iden'])){$tipo_iden=$_POST['tipo_iden'];}
if(!empty($_POST['identificacion'])){$identificacion=$_POST['identificacion'];}
if(!empty($_POST['papellido'])){$papellido=$_POST['papellido'];}
if(!empty($_POST['sapellido'])){$sapellido=$_POST['sapellido'];}
if(!empty($_POST['pnombre'])){$pnombre=$_POST['pnombre'];}
if(!empty($_POST['snombre'])){$snombre=$_POST['snombre'];}
if(!empty($_POST['fecha_nacim'])){$fecha_nacim=$_POST['fecha_nacim'];}
if(!empty($_POST['direccion'])){$direccion=$_POST['direccion'];}
if(!empty($_POST['telefono'])){$telefono=$_POST['telefono'];}
if(!empty($_POST['sexo'])){$sexo=$_POST['sexo'];}
if(!empty($_POST['login'])){$login=$_POST['login'];}
if(!empty($_POST['password'])){$password=$_POST['password'];}
if(!empty($_POST['profesion'])){$profesion=$_POST['profesion'];}
if(!empty($_POST['registro'])){$registro=$_POST['registro'];}
if(!empty($_POST['id_formato'])){$id_formato=$_POST['id_formato'];}
if(!empty($_POST['estado'])){$estado=$_POST['estado'];}
?>
<form name='form1' method="post" action="mn_usuario11.php">
    <?php
    require("mn_datos_persona.php");
    require("mn_datos_usuariosist.php");
    ?>
    <button type="button" id='btnguardar' onclick='validar()'><span class="icon-save"></span> Guardar</button>
    <script type="text/javascript" language='JavaScript'>
        document.form1.tipo_iden.value='<?php echo $tipo_iden;?>';
        document.form1.identificacion.value='<?php echo $identificacion;?>';
        document.form1.papellido.value='<?php echo $papellido;?>';
        document.form1.sapellido.value='<?php echo $sapellido;?>';
        document.form1.pnombre.value='<?php echo $pnombre;?>';
        document.form1.snombre.value='<?php echo $snombre;?>';
        document.form1.fecha_nacim.value='<?php echo $fecha_nacim;?>';
        document.form1.sexo.value='<?php echo $sexo;?>';
        document.form1.direccion.value='<?php echo $direccion;?>';
        document.form1.telefono.value='<?php echo $telefono;?>';
        document.form1.login.value='<?php echo $login;?>';
        document.form1.password.value='<?php echo $password;?>';
        document.form1.profesion.value='<?php echo $profesion;?>';
        document.form1.registro.value='<?php echo $registro;?>';
        document.form1.id_formato.value='<?php echo $id_formato;?>';
        <?php
        if($estado=='on'){
            ?>
            document.form1.estado.checked=true;
            <?php
        }
        ?>    
    </script>
    <?php
    if(!empty($identificacion)){
        $consulta="SELECT id_persona FROM persona WHERE tipo_iden='$tipo_iden' AND identificacion='$identificacion'";
        $consulta=$link->query($consulta);
        if($consulta->num_rows > 0){
            $msg="Existe una persona registrada con la misma identificaci�n";
            echo "<br>".$msg;
            if(!empty($msg)){
                ?>
                <script type="text/javascript" language='JavaScript'>document.form1.btnguardar.hidden=true;</script>
                <?php
            }
        }
    }
    ?>
</form>
</body>
</html>
