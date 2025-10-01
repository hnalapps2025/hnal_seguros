 <?php 


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Esta pagina es solo para usuarios registrados'); window.location='index.php';</script>";  
  exit;
} 


require 'Modelo/pacientes.php';
require 'Modelo/global.php';


$ini = $_POST["min"];
$max = $_POST["max"];
$id = $_GET["id"];

$sel =new Pacientes();
$ni = $sel->exportaCalendar($ini,$max);



header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Disposition: attachment; filename="ExportaCalendario'.date("d-m-Y").'.xls"');  



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
                              <?php if($id==1){// ?>
                                <h2 style="text-transform: uppercase;text-align: center;">ENTREGA DE CAJAS<small></small></h2>
                                <?php } else {?>
                                  <h2 style="text-transform: uppercase;text-align: center;">PROGRAMACIÓN<small></small></h2>
                                  <?php } //  ?>
                               
                                <div class="clearfix"></div>
                              </div>

                           <div class="x_content">

                              <div class="table-responsive">
                                <table class="table jambo_table bulk_action" border="1" >
                                  <thead>
                                    <tr class="headings">
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">AUDITOR </th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">DESDE</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">HASTA</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">OBSERVACIONES</th> 
                                      <?php if($id==1){?>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">RECEPCION</th> 
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">GESTION</th> 
                                      <?php } ?>
                                    </tr>
                                  </thead>

                            <tbody>
                      <?php while($mue = $ni->fetch_assoc()){ ?>
                              <tr class="even pointer">
                                <td style="text-transform: uppercase;font-size: 16px;text-align: left;"><?php echo $mue['title']; ?></td>
                                <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo $mue['start']; ?></td>
                                <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo $mue['end']; ?></td>
                                <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo $mue['observaciones']; ?></td>
                                <?php if($id==1){?>
                                <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo $mue['recepcion']; ?></td>
                                <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($mue['idgex']); ?></td>
                                <?php } ?>
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
       