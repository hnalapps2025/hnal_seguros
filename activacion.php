<head><title> ACTIVACION </title></head>

<?php 



require 'Modelo/funciones.php';
require 'Modelo/global.php';

$sel =new Model();

$code = $_GET["code"];
$sel::activeUserPlat($code);


include 'Vistas/librerias.php';  

?>

                <script type="text/javascript">
                            

                                
                          $(document).ready(function() {
                              
                                        

                                            
                                       
                         });



                </script>
                

  <body class="nav-md" style="background: white;">
    <div class="container body">
      <div class="main_container">
      
      
        <!-- page content -->
        <div class="right_col" role="main">
        
      
                  
        </div>

                <div class="" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                              <div class="modal-content">
    
                                        <div class="modal-header" style="background:#61d727;color: white;text-align: center;">
                                            
                                            <h4 class="modal-title" style="text-transform: uppercase;font-weight: 900;font-size: 25px;">¡ Felicitaciones !</h4>
                                            
                                        </div><br>
                                         <center>
                                             <a href="#/check-circle"><i class="fa fa-check-circle" style="font-size: 67px;color: #61d727;"></i></a><br><br>
                                             <span style="font-size: 18px;"> Su usuario ha sido activado correctamente.</span><br><br>
                                         <a href="https://sighap.com/hnal" class="btn btn-success">Iniciar sesion </a></center>  
                                       <br>
                              </div>
                            
                              

                    </div>
                </div>
     </div>

                
        <!-- /page content -->
        
                  <!-- DODNAES-->
                

        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>