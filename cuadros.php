<?php


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Esta pagina es solo para usuarios registrados'); window.location='index.php';</script>";  
  exit;
} 


require 'Modelo/funciones.php';
require 'Modelo/global.php';

$sel =new Model();


include 'Vistas/librerias.php';  




?>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
         <?php include 'Vistas/menu.php';  ?>
        <!-- top navigation -->
        <div class="top_nav">
            <?php include 'Vistas/usuario.php';  ?>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
          
          <!-- /top tiles -->

          <div class="row" > 
              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2 style="float: none !important;text-align: center;">REGISTRO DE ERH POR UPSS<small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" >
                                  
                                 <table border="0" style="margin: auto;" >
                                      <tbody>
                                          <tr>
                                              <td><label>Desde:&nbsp;&nbsp;</label></td>
                                              <td><input name="minUpss" id="minUpss" type="text" class="form-control" onmouseover="cambCie10()" placeholder="Fecha Inicio" autocomplete="off"></td>
                                              <td><label>&nbsp;&nbsp;Hasta:&nbsp;&nbsp;</label></td>
                                              <td><input name="maxUpss" id="maxUpss" type="text" class="form-control" placeholder="Fecha final" autocomplete="off"></td>
                                              
                                          </tr>
                                      </tbody>
                                  </table><br>
                                  <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="consulUpss"> 
                                              
                                            
                                  </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <h2 style="float: none !important;text-align: center;">REGISTRO DE ERH POR CIE10<small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                                  <table border="0" style="margin: auto;" >
                                      <tbody>
                                          <tr>
                                              <td><label>Desde:&nbsp;&nbsp;</label></td>
                                              <td><input name="minCie10" id="minCie10" type="text" class="form-control" onmouseover="cambUpss()" placeholder="Fecha Inicio" autocomplete="off"></td>
                                              <td><label>&nbsp;&nbsp;Hasta:&nbsp;&nbsp;</label></td>
                                              <td><input name="maxCie10" id="maxCie10" type="text" class="form-control" placeholder="Fecha final" autocomplete="off"></td>
                                             
                                          </tr>
                                      </tbody>
                                  </table><br>
                                  <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="consulXcie10"> 
                                              
                                            
                                  </div>
                  </div>
                </div>
              </div>
            </div>
          <br />

          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                  <h2 style="float: none !important;text-align: center;">GRAFICO DE REGISTROS GENERAL<small></small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="row">

                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(1,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="ene">
                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(2,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="feb">
                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(3,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="mar">
                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(4,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="abr">
                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(5,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="may">
                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(6,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="jun">
                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(7,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="jul">
                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(8,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="ago">
                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(9,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="set">
                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(10,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="oct">
                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(11,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="nov">
                      <input type="hidden" value="<?php $niMes = $sel->consultaXmesGrafico(12,2019);$tot = mysqli_num_rows($niMes);  echo $tot; ?>" id="dic">
                  </div>
                  <div class="x_content" style="width: 58%;margin: auto;float: inherit;">
                    <canvas id="mybarChart2"></canvas>
                  </div>
                </div>
              </div>

             
            </div>

<!--  COEMNTARIOS DE  NUEVO -->
          
        </div>
        <!-- /page content -->

        <!-- footer content -->
        
        <?php include 'Vistas/footer.php';  ?>

        <script>
         Chart.defaults.global.legend = {
            enabled: false
           };
          var ene = $("#ene").val();var feb = $("#feb").val();var mar = $("#mar").val();var abr = $("#abr").val();
          var may = $("#may").val();var jun = $("#jun").val();var jul = $("#jul").val();var ago = $("#ago").val();
          var set = $("#set").val();


        var ctx = document.getElementById("mybarChart2");
            var mybarChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Setiembre"],
                datasets: [{
                  label: 'Cantidad de registros',
                  backgroundColor: "#26B99A",
                  data: [ene,feb,mar,abr,may,jun,jul,ago, set]
                }]
              },

              options: {
                scales: {
                  yAxes: [{
                    ticks: {
                      beginAtZero: true
                    }
                  }]
                }
              }
            });
        
        </script>