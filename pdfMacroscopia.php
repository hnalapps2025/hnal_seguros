 <?php 


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Esta pagina es solo para usuarios registrados'); window.location='index.php';</script>";  
  exit;
} 

include_once ('config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();


$id = $_GET["id"];
$ni = $pac->consultaXDescripcionMacro($id);

$mue = $ni->fetch_assoc();


?>
<head>
  <title> Impresión  </title>
</head>
<script language="javascript">

function printThis() {
  window.print();
  //self.close();
}
</script>
  <body class="nav-md" onLoad="printThis();" style="font-family: sans-serif;">
  <!--<body class="nav-md"  >-->
    <div class="container body">
      <div class="main_container">
    
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" >
      
                  <div class="row">
                              <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12 ">

                                    <div class="x_panel">
                                          <div class="x_title"><p style="font-size: 13px;float: right;"><?php date_default_timezone_set('America/Lima'); echo date('d/m/Y g:ia');?></p>
                                          <center>
                                              <img src="images/cabecera.png" width="550" > 
                                          </center><br>
                                            <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 17px;">MACROSCOPIA</h2>
                                            <span style="float: right;margin-top: -25px;margin-right: 25px;font-size: 15px;"><strong>N° ORDEN:</strong><?php echo $mue["NIO"]."-".$mue["CORPA"] ?></span>
                                          <br>
                                            <div class="clearfix"></div>
                                          </div>
                                          <div class="x_content" style="margin-left: 23px;margin-right: 23px;margin-bottom: -21px;">
                                       
                                          <table class="tg" style="width: 100%;">
                                                
                                                <tr>
                                                  <td style="font-size: 12px;font-weight: bolder;"></td>
                                                  <td style="font-size: 12px;" ></td>
                                                  <td style="font-size: 12px;" ></td><td style="font-size: 12px;" ></td>
                                                  <td style="font-size: 12px;" ></td><td style="font-size: 12px;" ></td>
                                                  <td style="font-size: 12px;" ></td><td style="font-size: 12px;" ></td>
                                                  <td style="font-size: 12px;" ></td><td style="font-size: 12px;" ></td>
                                                  <td style="font-size: 12px;" ></td><td style="font-size: 12px;" ></td>
                                                  <td style="font-size: 12px;" ></td><td style="font-size: 12px;" ></td>
                                                  <td  ></td>
                                                </tr>
                                               
                                          
                                                <tr>
                                                  <td style="font-size: 12px;font-weight: bolder;">NOMBRES</td>
                                                  <td style="font-size: 12px;text-transform: uppercase;"><?php echo $mue["PAX"]; ?></td>
                                                  <td style="font-size: 12px;font-weight: bolder;text-align: right;"></td>
                                                  <td style="font-size: 12px;"></td>
                                                </tr>
                                               
                                                 
                                                
                                                <tr>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                </tr>
                                                <tr>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                </tr>
                                               
                                                <tr>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                </tr>
                                                 <tr>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                  <td style="font-size: 15px;font-weight: 200;"></td>
                                                </tr>
                                                
                                              </table>
                                                            
                                          </div>
                                       </div>


                        </div>


                        

                    <!-- INICIO -->

<br>
                    <!-- form color picker -->
                        
                    
            <div class="col-md-offset-1 col-md-9 col-sm-12 col-xs-12" style="margin-left: 23px;margin-right: 23px;">
                                <div class="x_panel">
                                <div class="x_title" style="background: #6bb7f7;color: black;margin-bottom: 0px;">
                                                                                      
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id=""> 


                                              <table class="table jambo_table bulk_action"  id="pac" style="width: 100%;" >
                                                    <thead>
                                                         <tr>
                                                            <td style="text-align: left;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;" colspan="6">DESCRIPCION</td>
                                                        </tr>
                                                       
                                                    </thead>
                                                </table>    

                                               


                                              <table class="table jambo_table bulk_action"  id="pac" style="border: 1px solid rgba(12, 12, 12, 0.78);width: 100%;" >
                                                    
                                                    <tbody>
                                                        

                                                            <tr class="even pointer">
                                                  
                                                                      <td class=" " style="text-transform: uppercase;text-align: left;color: black;font-size: 11px;font-weight: 200;">
                                                                          <?php echo "<pre style='white-space: pre-wrap;       /* Since CSS 2.1 */
   white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
   white-space: -pre-wrap;      /* Opera 4-6 */
   white-space: -o-pre-wrap;    /* Opera 7 */
   word-wrap: break-word;font-family: sans-serif;  '>".$mue["descripcion"]."<pre>"; ?></td>
                                                                      
                                                            
                                                            </tr>
                                                       
                                                    </tbody>
                                                </table>  
                                                

                                        </div>                                                   
                                  </div>
                                </div>
                        </div><br>
                        

                    <!-- FIN -->




                  </div>
                  
                 
        </div>

        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
<style>
@page {
  size: A4;
  margin: 3%;
  padding: 0 0 10%;
}
@media print {
  h3 {
    position: absolute;
    page-break-before: always;
    page-break-after: always;
    bottom: 0;
    right: 0;
  }
  h3::before {
    position: relative;
    bottom: -20px;
    counter-increment: section;
    content: counter(section);
  }
  .print {
    display: none;
  }
</style> 