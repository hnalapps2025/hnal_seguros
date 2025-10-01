 <?php 


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Esta pagina es solo para usuarios registrados'); window.location='index.php';</script>";  
  exit;
} 

date_default_timezone_set("America/Lima");
require 'Modelo/funciones.php';
require 'Modelo/global.php';

$sel =new Model();

 
$NameArchivo = "ReporteCierre_".date("d/m/y H:m:s");

$ux = $_POST["ux"];
$inicio = $_POST["min"];
$final = $_POST["max"];
$codeMd5=date("YmdHis");
$fchaHoy = date("Y-m-d");

//agregdo nuevo
$ni = $sel->expotarCierre($ux,$inicio,$final);
$mue = $ni->fetch_assoc();
// fin agregdo nuevo
$grCe='';$usCe= '';$mueCe ='';

if($mue["idEm"]!=""){
    
    $sel::crearPaqueteCe($ux,$codeMd5,$fchaHoy);
    $ni2 = $sel->obtenerIdPaqueteCe($ux,$codeMd5);
    $mueCe = $ni2->fetch_assoc();
    $grCe= $mueCe["idGrupo"];
    $usCe= $mueCe["idUsuario"];
    
}



header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Disposition: attachment; filename="'.$NameArchivo.'.xls"');


?>


<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
</head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      
      
        <div class="top_nav">
           
        </div>
       
        <div >
      
                  <div class="row">
                      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2 style="text-transform: uppercase;text-align: center;">REPORTE DESDE EL <?php echo $inicio." HASTA ".$final ?><small></small></h2>
                                
                               
                                <div class="clearfix"></div>
                              </div>

                              <div class="x_content">

                               

            <div class="table-responsive">
              <table class="table jambo_table bulk_action" border="1" >
                <thead>
                  <tr class="headings">
                     

                                          <th class="column-title" style="text-transform: uppercase;text-align: center;">#</th>
                                          <th class="column-title" style="text-transform: uppercase;text-align: center;">ESTADO</th>
                                          <th class="column-title" style="text-transform: uppercase;text-align: center;">CUENTA</th>
                                          <th class="column-title" style="text-transform: uppercase;text-align: center;">HISTORIA</th>
                                          <th class="column-title" style="text-transform: uppercase;text-align: center;">N° FUA</th>
                                          <th class="column-title" style="text-transform: uppercase;text-align: center;">PACIENTE</th>
                                          <th class="column-title" style="text-transform: uppercase;text-align: center;">SERVICIO</th>
                                          <th class="column-title" style="text-transform: uppercase;text-align: center;">F. ATENCION</th>
                                          <th class="column-title" style="text-transform: uppercase;text-align: center;">PLAN SALUD</th>
                                          <th class="column-title" style="text-transform: uppercase;text-align: center;">REGISTRADOR</th>
                  </tr>
                </thead>

                                      <tbody>
                                          <?php  
                                           //para el excel
                                           $niCE = $sel->expotarCierre($ux,$inicio,$final);
                                           $count = 1 ;
                                           
                                           
                                           while($mueCE = $niCE->fetch_assoc()){  
                                                //insertar filas en el paquete
                                                $sel::insertFuasPaqueteCe($grCe,$mueCE["idEm"],$usCe);
                                            
                                            ?>
                                              <tr class="even pointer">                    
                                              
                          
                                                <td class=" " style="text-transform: uppercase;font-size: 9px;text-align: center;vertical-align: inherit;"><?php echo $count++ ;?> </td>
                                                <td class=" " style="text-transform: uppercase;font-size: 9px;text-align: center;vertical-align: inherit;"><?php echo strtoupper ($mueCE["ESX"]); ?></td>
                                                <td class=" " style="text-transform: uppercase;font-size: 9px;text-align: center;vertical-align: inherit;"><?php echo strtoupper ($mueCE["cuenta"]); ?></td>
                                                <td class=" " style="text-transform: uppercase;font-size: 9px;text-align: center;vertical-align: inherit;"><?php echo strtoupper ($mueCE["historiaClinica"]); ?></td>
                                                <td class=" " style="text-transform: uppercase;font-size: 9px;text-align: center;vertical-align: inherit;"><?php echo strtoupper($mueCE["nroFua"]); ?></td>
                                                <td class=" " style="text-transform: uppercase;font-size: 9px;text-align: center;vertical-align: inherit;"><?php echo strtoupper($mueCE["ApePaterno"]." ".$mueCE["ApeMaterno"]." ".$mueCE["nombres"]); ?></td>
                                                <td class=" " style="text-transform: uppercase;font-size: 9px;text-align: center;vertical-align: inherit;"><?php echo strtoupper($mueCE["regServiceCE"]); ?></td>
                                                <td class=" " style="text-transform: uppercase;font-size: 9px;text-align: center;vertical-align: inherit;"><?php echo strtoupper($mueCE["fechaIngreso"]); ?></td>
                                                <td class=" " style="text-transform: uppercase;font-size: 9px;text-align: center;vertical-align: inherit;"><?php echo strtoupper($mueCE["PS"]); ?></td>
                                                <td class=" " style="text-transform: uppercase;font-size: 9px;text-align: center;vertical-align: inherit;"><?php echo strtoupper($mueCE["pax"]); ?></td>
                                               
                                                
                                              </tr>
                    
                                        <?php }   ?>
                                        
                                        
                                      </tbody>
                                  </table>
                               
                                </div>
                              </div>
                            </div>
                         </div>


                  
                  </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
       