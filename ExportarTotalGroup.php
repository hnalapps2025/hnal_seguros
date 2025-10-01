 <?php 


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Esta pagina es solo para usuarios registrados'); window.location='index.php';</script>";  
  exit;
} 


require 'Modelo/pacientes.php';
require 'Modelo/global.php';


$sel =new Pacientes();


$id = $_GET["id"];
$ni = $sel->exportarTotalesGroup($id);



header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Disposition: attachment; filename="SumaPorAutorizaciones_'.date("Y-m-d").'.xls"'); 



?>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
</head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
      
        <?php// include 'Vistas/menu.php';  ?>
        <!-- top navigation -->
        <div class="top_nav">
            <?php //include 'Vistas/usuario.php';  ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div >
      
                  <div class="row">
                      
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <!--<h2 style="text-transform: uppercase;text-align: center;">--<small></small></h2>-->
                                
                               
                                <div class="clearfix"></div>
                              </div>

                           <div class="x_content">

                              <div class="table-responsive">
                                <table class="table jambo_table bulk_action" border="1" >
                                  <thead>
                                  
                                    <tr class="headings">
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">NRO AUTORIZACION </th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">DATOS DEL PACIENTE</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">CUENTAS</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">TOTAL CUENTAS</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">SUMA CPT</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">SUMA FARMACIA</th>                    
                                    </tr>
                                  </thead>

                            <tbody>
                      <?php 
                      
                      while($mue = $ni->fetch_assoc()){ 
                        
                                     
                        
                        ?>
                    <tr class="even pointer">
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($mue['nro_documento_autorizacion']); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: left;"><?php echo strtoupper($mue['apellido_paterno_paciente']." ".$mue['apellido_materno_paciente']." ".$mue['nombres_paciente']); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: left;">
                        <?php 
                            $ni2 = $sel->exportarTotalesCuentas($mue['nro_documento_autorizacion']);
                            while($mue2 = $ni2->fetch_assoc()){ echo $mue2['IdCuentaAtencion'].","; }
                        ?>
                      </td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;">
                          <?php 
                                $ni3 = $sel->exportarTotalesCuentas($mue['nro_documento_autorizacion']);
                                $cnt = mysqli_num_rows($ni3);
                                echo $cnt;
                            ?>
                      </td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: right;">
                        
                            <?php 
                                $ni4 = $sel->sumTotalCpt($mue['nro_documento_autorizacion']);
                                $mue4= $ni4->fetch_assoc(); echo "S/ ".$mue4['Total'];
                            ?>
                      
                      </td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: right;">
                            <?php 
                                $ni5 = $sel->sumTotalIns($mue['nro_documento_autorizacion']);
                                $mue5= $ni5->fetch_assoc(); 

                                $ni6 = $sel->sumTotalMed($mue['nro_documento_autorizacion']);
                                $mue6= $ni6->fetch_assoc(); 
                                $sum = $mue5['Total'] + $mue6['Total'];
                                echo "S/ ".$sum;

                            ?>
                        
                      </td>

                    </tr>
                      <?php }  ?>
                      
                  </tbody>
                                  </table>
                                  <ul class="pagination">
                                 
                                 
                                  </ul>
                                </div>
                              </div>
                            </div>
                         </div>


                  
                  </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
       