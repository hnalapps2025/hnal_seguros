<?php 

include 'Modelo/global.php';
$idrol = $_SESSION['rol'] ?? null;
 $idEditar= $_SESSION['permisoEditarPato'] ?? null;
 ?>


<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="#" class="site_title"><span>SEGUROS HNAL</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="profile_pic">
                <img src="<?php echo $logo; ?>" alt="" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span style="color: #2a3f53;line-height: 0px;">.</span>
                <h2 style="font-size: 12px;font-weight: 700;"><?php echo $EESS; ?></h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3 style="color: #2a3f54;text-shadow: 1px 1px #2a3f54;">General</h3>
                <ul class="nav side-menu">
                <?php
                      if ($idEditar == 30 && $idrol == 20) {
                         
                        } else{
                          echo '<li ><a><i class="fa fa-home"></i> Auditoria <span class="fa fa-chevron-down"></span></a>
                                  <ul class="nav child_menu" >
                                      <li><a href="consolidado.php?tipo=1">Hospitalización</a></li>
                                      <li><a href="consolidado.php?tipo=2">Emergencia</a></li>
                                      <li><a href="consolidado.php?tipo=3">Consulta externa</a></li>
                                      

                                  </ul>
                                </li>';
                         

                        }
                  ?>
                  <!-- <li ><a><i class="fa fa-home"></i> Auditoria <span class="fa fa-chevron-down"></span></a>
                                  <ul class="nav child_menu" >
                                      <li><a href="consolidado.php?tipo=1">Hospitalización</a></li>
                                      <li><a href="consolidado.php?tipo=2">Emergencia</a></li>
                                      <li><a href="consolidado.php?tipo=3">Consulta externa</a></li>
                                      

                                  </ul>
                  </li> -->
                 
                </ul>
              
                <ul class="nav side-menu">
                <?php
                                    if ($idEditar == 30 && $idrol == 20) {
                                  
                                  } else{
                                    echo '   <li ><a><i class="fa fa-building-o"></i> Registros <span class="fa fa-chevron-down"></span></a>
                                  <ul class="nav child_menu" >
                                  <li><a href="emergencias.php?tipo=1">Emergencias</a></li>
                                          <li><a href="emergencias.php?tipo=2">Hospitalizacion</a></li>
                                          <li><a href="emergencias.php?tipo=3">Consulta externa</a></li>';
                                    

                                  }
                      ?>
                          <!--
                            <li ><a><i class="fa fa-building-o"></i> Registros <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" >
                                  
                  
                            <li><a href="emergencias.php?tipo=1">Emergencias</a></li>
                            <li><a href="emergencias.php?tipo=2">Hospitalizacion</a></li>
                            <li><a href="emergencias.php?tipo=3">Consulta externa</a></li> -->
                    
                                
                    </ul>
                   
                    </li>
                </ul>
            
                 
                <ul class="nav side-menu">
                  <li ><a><i class="fa fa-archive"></i> Anatomía Patológica <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" >
                         
                       <!-- <li><a href="registroInmuno.php">Registros</a></li>
                         <li><a href="registroPatologia.php">Pacientes</a></li>
                         <li><a href="panelControl.php">Reporte</a></li> -->
                    

                     <?php
                        if ($idEditar == 30 && $idrol == 20) {
                          echo '<li><a href="registroPatologia.php">Pacientes</a></li>';
                        } else{
                          echo '<li><a href="registroInmuno.php">Registros</a></li>';
                          echo '<li><a href="registroPatologia.php">Pacientes</a></li>';
                          echo ' <li><a href="panelControl.php">Reporte</a></li>';

                        }
                      ?>
                    </ul>
                  </li>
                </ul>
             </div>
            </div>
            <!-- /sidebar menu -->  
          </div>
        </div>

        