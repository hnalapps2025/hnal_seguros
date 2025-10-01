<?php 


/*$pac =new Pacientes();

$niCont = $pac->consultaXvencer();

$totalXvencer = mysqli_num_rows($niCont);*/

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
        
          
              </ul>
            </nav>
          </div>