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



$id = $_GET["id"];

$ni = $sel->consultaUserExportAll();



header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Disposition: attachment; filename="PacientesRegistrados'.date("Y-m-d").'.xls"');  



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
                                <h2 style="text-transform: uppercase;text-align: center;">FORMATO DE SOLICITUD PARA ENFERMEDADES RARAS O HUERFANAS<small></small></h2>
                                
                               
                                <div class="clearfix"></div>
                              </div>

                           <div class="x_content">

                              <div class="table-responsive">
                                <table class="table jambo_table bulk_action" border="1" >
                                  <thead>
                                    <tr class="headings">
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">NRO </th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">IPRESS (Código de RENAES)</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">FECHA SOLICITUD</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">FECHA DE INFORME MEDICO</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">TIPO DOC</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">NUMERO DOC</th>                    
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">NRO DE AFILIACION</th>                    
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">DEPARTAMENTO</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">AP PATERNO</th>  
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">AP MATERNO</th>  
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">NOMBRES</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">F. NACIMIENTO</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">FECHA HOY</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">EDAD</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">REGIMEN</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">HISTORIA CLINICA</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">SEXO</th>  
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">DIAGNÓSTICO</th>  
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">CIE10</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">DATOS DE LA MADRE</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">DNI DE LA MADRE</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">DATOS DEL PADRE</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">DNI DEL PADRE</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">N° CORREO DE SOLICITUD</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">DOCUMENTO RESPUESTA</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">FECHA DE AUTORIZACIÓN</th>
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">CONDICIÓN DE COBERTURA</th>  
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">FECHA INCIO COBERTURA</th>  
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">ESTADO DEL AFILIADO</th> 
                                      <th class="column-title" style="background: #66aaea;color: black;text-transform: uppercase;font-size: 16px;text-align: center;">OBSERVACIONES</th>     
                                    </tr>
                                  </thead>

                            <tbody>
                      <?php while($mue = $ni->fetch_assoc()){ 
                        
                        $NroPaciente= $mue['NroPaciente'] ;
                        $tipoDoc= $mue['TipoDocumento'] ;
                        $NroDoc= $mue['NroDocumento'] ;
                        $solipac= $mue['FechaSolicitud'];
                        $solimedico= $mue['solimedico'];
                        $regimen= $mue['regimen'];
                        $hclinica= $mue['hclinica'];
                        $ippress= $mue['Ippress'] ;
                        $sexo= $mue['Sexo'];
                        $tipoAf= $mue['TipoAfiliacion'];
                        $NroAf= $mue['NroAfiliacion'];
                        $nombres= $mue['Nombres'];
                        $FechaNac= $mue['FechaNacimiento'];
                        $apepa= $mue['ApePaterno'];
                        $apema= $mue['ApeMaterno'];
                        $departamento= $mue['departamento'];
                        $fecobertura= $mue['fecobertura'];
                        $cie10= $mue['Cie10'];
                        $descri= $mue['Diagnostico'];
                        $telefa= $mue['TelefonoFamilia'];
                        $edad= $mue['Edad'];
                        $dniMama= $mue['dnimama'];
                        $nombresMama= $mue['nombresMama'];
                        $apeMama= $mue['apeMama'];
                        $dniPapa= $mue['dniPapa'];
                        $nombresPapa= $mue['nombresPapa'];
                        $apePapa= $mue['apePapa'];
                        $correoSolicitud= $mue['correoSolicitud'];
                        $feiniciCobertura= $mue['feiniciCobertura'];
                        $docRespuesta= $mue['docRespuesta'];
                        $feAutoraizacion= $mue['feAutoraizacion'];
                        $cocobertura= $mue['cocobertura'];
                        $coafiliado= $mue['coafiliado'];
                        $observaciones= $mue['observaciones'];
                        
                        ?>
                    <tr class="even pointer">
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($NroPaciente); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($ippress); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($solipac); ?></td>                                                  
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($solimedico); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($tipoDoc); ?></td> 
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($NroDoc); ?></td> 
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($NroAf); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($departamento); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($apepa); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($apema); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($nombres); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($FechaNac); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo date("d-m-Y");; ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($edad); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($regimen); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($hclinica); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($sexo); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($descri); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($cie10); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php $datosMadre = $nombresMama." ".$apeMama; echo strtoupper($datosMadre); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($dniMama); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php $datosPadre = 	$nombresPapa." ".$apePapa; echo strtoupper($datosPadre); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($dniPapa); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($correoSolicitud); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($docRespuesta); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($feAutoraizacion); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($cocobertura); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($feiniciCobertura); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($coafiliado); ?></td>
                      <td style="text-transform: uppercase;font-size: 16px;text-align: center;"><?php echo strtoupper($observaciones); ?></td>
                      
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
       