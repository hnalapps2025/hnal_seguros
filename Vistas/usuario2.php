<?php 


//include_once('./config.php');
//include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$sel2 = new Pacientes();


$patProc = $sel2->notificacionesCount($iduser,2,1);
$countpatProc = mysqli_num_rows($patProc);

$patPend = $sel2->notificacionesCount($iduser,3,1);
$countpatPend = mysqli_num_rows($patPend);



$citProc = $sel2->notificacionesCount($iduser,2,2);
$countcitProc = mysqli_num_rows($citProc);

$citPend = $sel2->notificacionesCount($iduser,3,2);
$countcitPend = mysqli_num_rows($citPend);

$totalNot = $countpatProc + $countpatPend + $countcitProc+ $countcitPend;


$en1 = 'https://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];


$rt = '';
   if(strpos($en1 ,'consolidado.php') || strpos($en1 ,'emergencias.php') ){
            $rt = 'true';       
       
   }else{
            $rt = 'false';       
   }


 ?>

<div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
                
              <ul class="nav navbar-nav navbar-right" style="width: 90%;">
                 
                 <?php if($rt=="true"){ ?>
                <li role="presentation" style="float: left;background: lightgrey;border-radius: 13px;margin-top: 12px;margin-right: 2px;margin-left: -52px;"><a href="http://app.sis.gob.pe/SisConsultaEnLinea/Consulta/frmConsultaEnLinea.aspx" style="padding: 0px 7px 0px;font-size: 10px;font-weight: 700;" target="_blank">Consulta en línea</a></li>
                <li role="presentation" style="float: left;background: lightgrey;border-radius: 13px;margin-top: 12px;margin-right: 2px;"><a href="https://app1.susalud.gob.pe/registro/" style="padding: 0px 7px 0px;font-size: 10px;font-weight: 700;" target="_blank">SUSALUD</a></li>
                <li role="presentation" style="float: left;background: lightgrey;border-radius: 13px;margin-top: 12px;margin-right: 2px;"><a href="https://app8.susalud.gob.pe:8080/wb-siteds/login.htm" style="padding: 0px 7px 0px;font-size: 10px;font-weight: 700;" target="_blank">SITEDS</a></li>
                <li role="presentation" style="float: left;background: lightgrey;border-radius: 13px;margin-top: 12px;margin-right: 2px;"><a href="https://dondemeatiendo.essalud.gob.pe/#/consulta" style="padding: 0px 7px 0px;font-size: 10px;font-weight: 700;" target="_blank">EsSalud</a></li>
                <li role="presentation" style="float: left;background: lightgrey;border-radius: 13px;margin-top: 12px;margin-right: 2px;"><a href="https://app-cbo.saludpol.gob.pe:22085/" style="padding: 0px 7px 0px;font-size: 10px;font-weight: 700;" target="_blank">SaludPol</a></li>
                <li role="presentation" style="float: left;background: lightgrey;border-radius: 13px;margin-top: 12px;margin-right: 2px;"><a href="http://app.sis.gob.pe/sisERP/SisMenu/frmLogin.aspx" style="padding: 0px 7px 0px;font-size: 10px;font-weight: 700;" target="_blank">SIASIS</a></li>
                <li role="presentation" style="float: left;background: lightgrey;border-radius: 13px;margin-top: 12px;margin-right: 2px;"><a href="https://refcon.minsa.gob.pe/refconv02/" style="padding: 0px 7px 0px;font-size: 10px;font-weight: 700;" target="_blank">REFCON</a></li>
                <li role="presentation" style="float: left;background: lightgrey;border-radius: 13px;margin-top: 12px;margin-right: 2px;"><a href="https://contingenciasis.minsa.gob.pe/frmConsultaContingencia.aspx" style="padding: 0px 7px 0px;font-size: 10px;font-weight: 700;" target="_blank">Contingencia</a></li>
                <li role="presentation" style="float: left;background: lightgrey;border-radius: 13px;margin-top: 12px;margin-right: 2px;"><a href="https://app.hospitalloayza.gob.pe/" style="padding: 0px 7px 0px;font-size: 10px;font-weight: 700;" target="_blank">RESYS</a></li>
                 <li role="presentation" style="float: left;background: lightgrey;border-radius: 13px;margin-top: 12px;margin-right: 2px;"><a href="http://192.168.32.80:4001/" style="padding: 0px 7px 0px;font-size: 10px;font-weight: 700;" target="_blank">Dx Imagenes</a></li>
                <?php } ?>
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="text-transform: uppercase;">
                    <img src="<?php echo $logo; ?>" alt="">  <?php if($rol=="1"){echo "Bienvenido(a) ".$empresa;}else if ($rol=="2")
                    {echo "Bienvenido(a) ".$empresa;}else { echo "Bienvenido(a)  ".$empresa; }  ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                   <!-- <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>-->
                    <li><a href="cerrar.php"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesión</a></li>
                  </ul>
                </li>
                <?php if($totalNot > 0 ) { ?>
                    <li role="presentation" class="nav-item dropdown">
                            <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-red"><?php  echo $totalNot ?></span>
                            </a>
                            <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1" x-placement="bottom-start" style="position: absolute; will-change: transform; top:42px; left: 0px; transform: translate3d(-141px, 17px, 0px);box-shadow: 5px 6px 11px 7px #bfbfbf;">
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"></span>
                                        <span>
                                        <span>Patología Quirúrgica</span>
                                        <span class="time"></span>
                                        </span>
                                        <span class="message">
                                        En proceso: <?php echo $countpatProc ?>  | Pendiente: <?php echo $countpatPend ?> 
                                        </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item">
                                        <span class="image"><img src="images/img.jpg" alt="Profile Image"></span>
                                        <span>
                                        <span>Citología</span>
                                        <span class="time"></span>
                                        </span>
                                        <span class="message">
                                         En proceso: <?php echo $countcitProc ?> | Pendiente: <?php echo $countcitPend ?> 
                                        </span>
                                        </a>
                                    </li>
                            
                            </ul>
                    </li>
                <?php } ?>
              </ul>
            </nav>
          </div>