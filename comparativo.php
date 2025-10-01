<?php

error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 

include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (CONTROLLER_PATH."conexion.php");
include (MODEL_PATH."global.php");
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');


$inicio= $_POST["min"];
$fin= $_POST["max"];

$db = new Conectar();
$conn = $db->conexion();

if (isset($_POST["import"]))
{


  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = 'temp/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);

        $sheetCount = count($Reader->sheets());

                for($i=0;$i< $sheetCount;$i++)
                {
                    
                        if($i==0){

                            $Reader->ChangeSheet($i);
                    
                                    foreach ($Reader as $Row)
                                    {
                                                       
                                    
                                            $Dat0 = mysqli_real_escape_string($conn,$Row[0]);
                                            $Dat1 = mysqli_real_escape_string($conn,$Row[1]);
                                            $Dat2 = mysqli_real_escape_string($conn,$Row[2]);
                                            $Dat3 = mysqli_real_escape_string($conn,$Row[3]);
                                            $Dat4 = mysqli_real_escape_string($conn,$Row[4]);
                                            $Dat5 = mysqli_real_escape_string($conn,$Row[5]);
                                            $fecha = DateTime::createFromFormat('d/m/Y', $Row[6]);
                                            $Dat6 = $fecha->format('Y-m-d');
                                            $Dat7 = mysqli_real_escape_string($conn,$Row[7]);
                                            $Dat8 = mysqli_real_escape_string($conn,$Row[8]);
            

                                            $sqlNum = "SELECT `id` FROM `imp_data` WHERE `nrocuenta`='$Dat1'";
                                            $resultNum = $conn->query($sqlNum);
                                            $fil = $resultNum->num_rows ;

                                            if($fil==0){

                                                    $query = "INSERT INTO  `imp_data`(`hclinica`, `nrocuenta`, `apMaterno`, `apPaterno`, `pNombre`,
                                                    `sNombre`, `fatencion`, `estado`,descripcion) VALUES ('".$Dat0."','".$Dat1."','".$Dat2."','".$Dat3."','".$Dat4."'
                                                    ,'".$Dat5."','".$Dat6."','".$Dat7."','".$Dat8."')";
                                                    $result = mysqli_query($conn, $query);
                                                
                                                    if (!empty($result)) {
                                                        $class = "";
                                                        $type = "success";
                                                        $message = "Datos de Excel importados correctamente a la base de datos";
                                                    } else {
                                                        $class = "display:none;";
                                                        $type = "error";
                                                        $message = "Problema al importar datos de Excel";
                                                    }

                                            }
                                    }

                         }
                }            
        
         }
  }

  else 
  {    
        $type = "error";
        $message = "Debe seleccionar un archivo excel";
  }



?>

<!DOCTYPE html>
<html>    
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >


<script src="js/jquery.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
  
    <script type="text/javascript" src="js/paciente.js"></script> 
    <link rel="shortcut icon" href="http://www.insnsb.gob.pe/wp-content/uploads/2015/09/favicon.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<style>    
body {
	font-family: Arial;
	text-align: center;
}

.outer-container {
	background: #F0F0F0;
	border: #e0dfdf 1px solid;
	padding: 40px 20px;
	border-radius: 2px;
}

.btn-submit {
	background: #ff0d0d;
    border: #ff0d0d 1px solid;
    border-radius: 2px;
	color: #f0f0f0;
	cursor: pointer;
    padding: 5px 20px;
    font-size:0.9em;
}

.btn-success {
	background: white;
    border: black 1px solid;
    border-radius: 2px;
    color: black;
    cursor: pointer;
    padding: 11px 39px;
    font-size: 0.9em;
    text-decoration: none;
}
.tutorial-table {
    margin-top: 40px;
    font-size: 0.8em;
	border-collapse: collapse;
	width: 100%;
}

.tutorial-table th {
    background: #f0f0f0;
    border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

.tutorial-table td {
    background: #FFF;
	border-bottom: 1px solid #dddddd;
	padding: 8px;
	text-align: left;
}

#response {
    padding: 10px;
    margin-top: 10px;
    border-radius: 2px;
    display:none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}

</style>

<script type="text/javascript">
                                
                                    $(document).ready(function() {

                                      

                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;


                                                $('#coincidencias').DataTable( {
                                                  "searching": true,
                                                  "pageLength": 10000,
                                                  "order": [[ 0, "desc" ]],
                                                  dom: '<fBtip>',
                                                  buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [0,1,2,3,4,5,6,7]
                                                            },
                                                            customize: function(xlsx) {
                                                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                              $('row[r=2] c', sheet).attr('s', '47');
                                                          }
                                                        }
                                                        
                                                  ],                                                     
                                                  language: {
                                                        "decimal": "",
                                                        "searchPlaceholder": "Columna ..",
                                                        "emptyTable": "No hay registros para mostrar",
                                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                                                        "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                                                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                                                        "infoPostFix": "",
                                                        "thousands": ",",
                                                        "lengthMenu": "Mostrar _MENU_ filas",
                                                        "loadingRecords": "Cargando...",
                                                        "processing": "Procesando...",
                                                        "search": "Buscar por: ",
                                                        "zeroRecords": "Sin resultados encontrados",
                                                        "paginate": {
                                                            "first": "Primero",
                                                            "last": "Ultimo",
                                                            "next": "Siguiente",
                                                            "previous": "Anterior"
                                                        }
                                                    },
                                                    
                                                                                         
                                    
                                    
                                            "deferRender": true,
                                                    initComplete: function() {

                                                    // 1 filtro
                                                    var column = this.api().column(6);
                                                    var select = $('<select style="margin-left:10px"><option value="" >Todos</option></select>')
                                                        .appendTo('#coin')
                                                        .on('change', function() {
                                                        var val = $(this).val();
                                                        column.search(val).draw()
                                                        });

                                                    var offices = []; 
                                                    column.data().toArray().forEach(function(s) {
                                                        s = s.split(',');
                                                        s.forEach(function(d) {
                                                            if (!~offices.indexOf(d)) {
                                                            offices.push(d)
                                                            select.append('<option value="' + d + '">' + d + '</option>');}
                                                        })
                                                    })

                                                    // fin 1 filtro
                                                    $('#coincidencias_filter').css('display','none');
                                                    $('.dataTables_info').css('display','none');
                                                    $('.dt-buttons').css('display','none');
                                                    $('#coincidencias_paginate').css('display','none');
                                                }

                                        });
                                    });

         </script>
</head>

<body>
    <h2>Importar tu archivo excel</h2>
    
    <div class="outer-container">
        <form action="" method="post"  name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <input type="file" name="file" id="file" accept=".xls,.xlsx" style="width: 20%;">
                <button type="submit" id="submit" name="import"  class="btn-submit">Importar</button>
            </div>
        
        </form>
        
    </div>
    <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?>
    
    </div>
    
         <div class="col-md-6 col-xs-12" style="<?php  echo $class; ?> margin-left:6px;width:65%;margin-top: 30px; ">
                 
                <form class="form-horizontal form-label-left input_mask" method="POST"  name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">

                              <table border="0" class="">
                                  <tbody>
                                      <tr>
                                        <td><label style="margin-bottom: 0px;">Leyenda:</label></td>
                                        <td style="color:green;font-weight: 800;">Atendido</td>
                                        <td>|</td>
                                        <td style="color:red;font-weight: 800;">No_atendido</td>
                                          <td style="color:white;">dfsdfsdfsdf</td>
                                          <td style="color:white;">sdfsdfsdfsdf</td>
                                          <td style="color:white;">dfsdfsdfsdf</td>
                                          <td><label>Desde: </label></td>
                                          <td><input name="min" id="min" type="date" class="form-control hasDatepicker" placeholder="Fecha Inicio" autocomplete="off"></td>
                                          <td><label>&nbsp;&nbsp;Hasta: </label></td>
                                          <td><input name="max" id="max" type="date" class="form-control hasDatepicker" placeholder="Fecha final" autocomplete="off"></td>
                                          <td> <button type="submit" id="submit" name="procesar"  class="btn btn-success" style="padding-top: 8px;padding-bottom: 8px;margin-left: 56px;">Procesar</button></td>
                                      </tr>
                                  </tbody>
                              </table>
                            
                </form>
                            
                               
         </div>

         <div class="row" style="<?php  echo $class; ?> width: 98%; margin-top: 20px;margin-left:1%;">
                
                            <table class="table table-bordered jambo_table bulk_action"  id="coincidencias" style="width:100%;" >
                                    <thead>
                                       <tr class="headings" style="font-size: 10px;color: white;background: #405467;">
                                            <th class="column-title" style="width: 100%;text-transform: uppercase;text-align: center;font-size: 14px;" colspan="6">
                                                <a id="filas"></a>
                                                <a id="coin" style="margin-left: 80px;">
                                                
                                                </a>
                                                
                                            </th>
                                                  
                                            
                                      </tr>
                                      <tr class="headings" style="font-size: 10px;color: white;background: #405467;">
                                            <th class="column-title" style="width:5%;text-transform: uppercase;text-align: center;">ESTAD0</th>
                                            <th class="column-title" style="width:11%;text-transform: uppercase;text-align: center;">H. CLINICA</th>
                                            <th class="column-title" style="width:11%;text-transform: uppercase;text-align: center;">CUENTA</th>
                                            <th class="" style="width:40%;text-transform: uppercase;text-align: center;">PACIENTE</th>
                                            <th class="" style="width:6%;text-transform: uppercase;text-align: center;">SISTEMA</th>
                                            <th class="" style="width:12%;text-transform: uppercase;text-align: center;">GALENOS</th>
                                            <th class="" style="visibility: hidden;"></th>
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php  
                                              $query = "SELECT A.idCuenta,A.estado AS AE ,B.estado as BE,B.pNombre,B.sNombre,B.apPaterno,B.apMaterno,A.nrocuenta,B.hclinica 
                                              FROM cuentas as A
                                              INNER JOIN imp_data as B ON A.nrocuenta = B.nrocuenta
                                              WHERE A.fatencion BETWEEN '$inicio' AND '$fin' AND  B.fatencion BETWEEN '$inicio' AND '$fin'";
                                              
                                              $ni = mysqli_query($conn,$query);
                                              
                                               while($mue = mysqli_fetch_assoc($ni)){       
                                                                               
                                                 ?>                                                   
                                                    <tr class="even pointer">
                                                            <td class=" " style="text-transform: uppercase;font-size: 11px;">
                                                                 
                                                                 <?php 
                                                                  if($mue["AE"]=="on"){
                                                                            echo '<input type="checkbox" class="chkEstatus" checked value="'.$mue['idCuenta'].'">';
                                                                  }else{
                                                                            echo '<input type="checkbox" class="chkEstatus" value="'.$mue['idCuenta'].'">';
                                                                  }
                                                                 ?>
                                                            </td>
                                                            <td class=" " style="text-transform: uppercase;font-size: 11px;"><?php echo $mue["hclinica"]; ?></td>
                                                            <td class=" " style="text-transform: uppercase;text-align: center;font-size: 11px;"><?php echo $mue["nrocuenta"]; ?></td>
                                                            <td class=" " style="text-transform: uppercase;text-align: left;font-size: 11px;"><?php echo $mue["pNombre"]." ".$mue["sNombre"]." ".$mue["apPaterno"]." ".$mue["apMaterno"]; ?></td>
                                                            <?php  
                                                                if($mue["AE"]=="on"){
                                                                    echo '<td style="color: green;text-transform: uppercase;text-align: center;font-size: 11px;">
                                                                    <button class="btn btn-success" style="margin: 0px;padding: 7px;padding-left: 20px;padding-right: 20px;background: #1c7430;border-color: #1c7430;"></button></td>';
                                                                }else if($mue["AE"]=="OF" || $mue["AE"]==""){
                                                                    echo '<td style="color: red;text-transform: uppercase;text-align: center;font-size: 11px;">
                                                                    <button class="btn btn-danger" style="margin: 0px;padding: 7px;padding-left: 20px;padding-right: 20px;background: red;border-color: red;"></button></td>';
                                                                }
                                                                
                                                                if($mue["BE"]=="Cerrado - Pagado"){
                                                                    echo '<td style="text-transform: uppercase;text-align: center;font-size: 11px;">
                                                                    <button class="btn btn-success" style="margin: 0px;padding: 7px;padding-left: 20px;padding-right: 20px;background: #1c7430;border-color: #1c7430;"></button></td>';
                                                                }else if($mue["BE"]=="Cerrado" ){
                                                                    echo '<td style="text-transform: uppercase;text-align: center;font-size: 11px;">
                                                                    <button class="btn btn-danger" style="margin: 0px;padding: 7px;padding-left: 20px;padding-right: 20px;background: red;border-color: red;"></button></td>';
                                                                }
                                                                
                                                                ?>
                                                                <td class="buac" style="visibility: hidden;">
                                                                    <?php 
                                                                        $comparar = $mue["AE"].$mue["BE"];
                                                                        $comparar2 = $mue["AE"].$mue["BE"];
                                                                        $comparar3 = $mue["AE"].$mue["BE"];

                                                                         if($comparar=="onCerrado - Pagado" || $comparar2=="OFCerrado" || $comparar3=="Cerrado" ){
                                                                            echo "SI";
                                                                        }else{
                                                                            echo "NO";
                                                                        }
                                                                    ?>
                                                                </td>
                                                     
                                                    </tr>
                                         <?php }                                                  
                                                     ?>
                                    </tbody>
                                  </table>

                                  <table class="table table-bordered jambo_table bulk_action"  id="pac3ddd"  style="width: 27%;margin-left: 1%;">
                                    <thead>
                                       <tr class="headings" style="font-size: 10px;color: white;background: #405467;">
                                            <th class="column-title" style="width: 20%;text-align: center;font-size: 14px;" colspan="3">NOT EXIT SYSTEM HOME</th>                         
                                      </tr>
                                      <tr class="headings" style="font-size: 10px;color: white;background: #405467;">
                                            <th class="column-title" style="width: 20%;text-transform: uppercase;text-align: center;">H. CLINICA</th>
                                            <th class="column-title" style="width: 20%;text-transform: uppercase;text-align: center;">N. CUENTA</th>
                                            <th class="" style="width:60%;text-transform: uppercase;text-align: center;">PACIENTE</th>                                      
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php  
                                              $queryH = "SELECT hclinica,nrocuenta,`apMaterno`, `apPaterno`, `pNombre`, `sNombre` FROM imp_data 
                                              WHERE imp_data.nrocuenta NOT IN (SELECT nrocuenta FROM cuentas WHERE fatencion BETWEEN '$inicio' AND '$fin') 
                                              AND  imp_data.fatencion BETWEEN '$inicio' AND '$fin'";
                                              
                                              $niH = mysqli_query($conn,$queryH);
                                               while($mue = mysqli_fetch_assoc($niH)){       
                                                                               
                                                 ?>

                                                    <tr class="even pointer">
                                                      <td class=" " style="text-transform: uppercase;font-size: 11px;"><?php echo $mue["hclinica"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;font-size: 11px;"><?php echo $mue["nrocuenta"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: left;font-size: 11px;"><?php echo $mue["pNombre"]." ".$mue["sNombre"]." ".$mue["apPaterno"]." ".$mue["apMaterno"]; ?></td>
                                                    </tr>
                                         <?php }
                                                    
                                                     ?>
                                    </tbody>
                                  </table>

                                  <table class="table table-bordered jambo_table bulk_action"  id="pac32"  style="width: 27%;margin-left: 1%;">
                                    <thead>
                                       <tr class="headings" style="font-size: 10px;color: white;background: #405467;">
                                            <th class="column-title" style="width: 20%;text-align: center;font-size: 14px;" colspan="3">NOT EXIT GALENOS</th>                         
                                      </tr>
                                      <tr class="headings" style="font-size: 10px;color: white;background: #405467;">
                                            <th class="column-title" style="width: 20%;text-transform: uppercase;text-align: center;">H CLINICA</th>
                                            <th class="column-title" style="width: 20%;text-transform: uppercase;text-align: center;">N CUENTA</th>
                                            <th class="" style="width:60%;text-transform: uppercase;text-align: center;">PACIENTE</th>                                      
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php  
                                              $query2 = "SELECT historia,nrocuenta,c.paciente FROM cuentas 
                                              INNER JOIN cartagarantia as C ON cuentas.idprestacion= C.idCar
                                              WHERE cuentas.nrocuenta NOT IN (SELECT nrocuenta FROM imp_data WHERE fatencion BETWEEN '$inicio' AND '$fin') 
                                              AND  cuentas.fatencion BETWEEN '$inicio' AND '$fin'";
                                              
                                              $ni2 = mysqli_query($conn,$query2);
                                               while($mue = mysqli_fetch_assoc($ni2)){       
                                                                               
                                                 ?>

                                                    <tr class="even pointer">
                                                      <td class=" " style="text-transform: uppercase;font-size: 11px;"><?php echo $mue["historia"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;font-size: 11px;"><?php echo $mue["nrocuenta"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: left;font-size: 11px;"><?php echo $mue["paciente"]; ?></td>
                                                    </tr>
                                         <?php }
                                                    
                                                     ?>
                                    </tbody>
                                  </table>
               
         </div>
           
         <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
</body>
</html>