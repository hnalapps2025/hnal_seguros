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
$ni = $pac->mostrarPdfCervicoVaginal($id);

$mue = $ni->fetch_assoc();

?>
<head>
  <title> Impresión de <?php echo $datospac; ?>  </title>
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
                                              <img src="images/cabecera.png" width="550" > <br><br><br>
                                          </center>
										 
										
								
                                            <h2 style="text-align: center;float: none;text-transform: uppercase;font-weight: bolder;font-size: 15px;">SOLICITUD DE EVALUACION CERVICO VAGINAL</h2>
                                          <span style="float: right;margin-top: -25px;margin-right: 25px;font-size: 14px;"><strong>N° ORDEN:</strong><?php echo $mue["anio"]."-".$mue["corPat"] ?></span>
                                            <div class="clearfix"></div>
                                          </div>
										  
                                         
                                       </div>


                        	</div>
							
						


                        

                    <!-- INICIO -->
                   <table border="1" cellpadding="1" cellspacing="1" style="width:100%;border-collapse: collapse;">
						<tbody>
						
							<tr>
								<td colspan="21"><span style="font-size:12px"><strong>CODIGO DE PAGO: (Citolog&iacute;a cervico vaginal)&nbsp; </strong>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <strong>&nbsp;Codigo de laboratorio</strong></span></td>
							</tr>
							<tr>
								<td colspan="21"><span style="font-size:12px"><strong>DATOS DEL PACIENTE</strong></span></td>
							</tr>
							<tr>
								<td colspan="21" style="font-size: 12px;"><span style="font-size:12px"><strong>Apellidos y Nombres:</strong></span> <?php  echo $mue["paciente"]; ?></td>
							</tr>
							<tr>
								<td colspan="21"><span style="font-size:12px"><strong>Domicilio:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Distrito:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Tel&eacute;fono:</strong></span></td>
							</tr>
							<tr>
								<td colspan="21" style="font-size: 12px;"><span style="font-size:12px"><strong>Fecha de Nacimiento:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;N&deg;DNI:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php  echo $mue["nrodoc"]; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Edad:&nbsp; &nbsp; <?php  echo $mue["edad"]; ?>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Email:</strong></span></td>
							</tr>
							<tr>
								<td colspan="21"><span style="font-family:Arial,Helvetica,sans-serif;font-size:13px"><strong>HISTORIA GINECOLOGICA</strong></span></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px"><strong>FECHA DE ULTIMA REGLA(FUR):</strong></span>&nbsp; &nbsp;<?php echo $mue["fechaUltimaRegla"]; ?></td>
								<td colspan="10" rowspan="1"><span style="font-size:12px"><strong>EXAMEN GINECOLOGICO</strong></span></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px"><strong>EMBARAZADA:</strong></span><?php 
								
								
								if($mue["listEmbarazo"]=="1"){
											echo "SI";
										}else if($mue["listEmbarazo"]=="2"){
											echo "NO";
										}
								
								//echo $mue["listEmbarazo"]; listExaGineco ?></td>
								<td colspan="10" rowspan="1"><span style="font-size:12px"><?php 
								
								
								if($mue["listExaGineco"]=="1"){
											echo "NORMAL";
										}else if($mue["listExaGineco"]=="2"){
											echo "ANORMAL";
										}
								
								//echo $mue["listEmbarazo"]; listExaGineco ?></span></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px"><strong>USO DE METODO ANTICONCEPTIVO</strong></span>&nbsp; &nbsp;<?php   
										
										if($mue["listMetodoAnti"]=="1"){
											echo "SI";
										}else if($mue["listMetodoAnti"]=="2"){
											echo "NO";
										}
										//echo $mue["listMetodoAnti"]; 
								?></td>
								<td colspan="10" rowspan="2"><span style="font-size:12px"><strong>ESPECIFIQUE:&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></span></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px"><strong>Especifique metodo y tiempo de uso:</strong></span>&nbsp; &nbsp;<?php echo strtoupper($mue["TiempoUso"]); ?></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1"><strong style="font-size:12px">RESPONSABLE:OBTENCION DE MUESTRAS</strong></td>
								<td colspan="10" rowspan="1"><strong><span style="font-size:13px">COLOSCOPIA</span></strong></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1"><span style="font-size:12px">(Firma y sello)</span></td>
								<td colspan="10" rowspan="1"><span style="font-size:12px">( ) Normal ( ) Anormal</span></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Nombre:&nbsp; &nbsp;</span><?php echo strtoupper($mue["nomObtencionMuestras"]); ?></td>
								<td colspan="10" rowspan="1"><span style="font-size:12px">Especifique</span></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Profesi&oacute;n/Cargo</span>&nbsp; &nbsp;<?php echo strtoupper($mue["profeCargo"]); ?></td>
								<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Diagn&oacute;stico anterior:</span><?php echo strtoupper($mue["dxAnterior"]); ?></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Fecha de obtenci&oacute;n de muestra</span>&nbsp; &nbsp;<?php echo $mue["fechaObtencMuestra"]; ?></td>
								<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Fecha del diagn&oacute;stico anterior:</span>&nbsp; &nbsp;<?php echo $mue["fechadxAnterior"]; ?></td>
							</tr>
							<tr>
								<td colspan="21" style="text-align:center"><strong style="font-size:12px">INFORME DE DIAGNOSTICO CITOL&Oacute;GICO CERVICO UTERINO</strong></td>
							</tr>
							<?php if ($mue["clasificacionGen"] == 6 || $mue["clasificacionGen"] == 7 || $mue["clasificacionGen"] == 0 ) { ?>
							<tr>
								<td colspan="11" rowspan="1"><span style="font-size:13px"><strong>1) CALIDAD DE ESP&Eacute;CIMEN</strong></span></td>
								<td colspan="10" rowspan="1"><span style="font-size:13px"><strong>3.1.2&nbsp; CELULAS GLANDULARES</strong></span></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">&nbsp; &nbsp;<?php echo $mue["CE"]; ?></span></td>
								<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">&nbsp; &nbsp;<?php echo $mue["AE"]; ?></span></td>
							</tr>
							<tr>
									<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Especifique:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["especifiqueCalidadEspec"]); ?></td>
									<td colspan="10" rowspan="2" style="font-size: 12px;"><span style="font-size:12px">Especifique:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["especelulasEscamosas"]); ?></td>
							</tr>
							<tr>
									<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Especifique:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["EspecCelulasEndoCervicales"]); ?></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1"><span style="font-size:13px"><strong>2) CLASIFICACION GENERAL_&nbsp;</strong></span></td>
								<td colspan="10" rowspan="1"><strong><span style="font-size:13px">3.2 OTRAS NEOPLASIAS MALIGNAS (Especifique)</span></strong></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:13px">&nbsp; &nbsp;<?php echo $mue["CG"]; ?></span></td>
								<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:13px">&nbsp; &nbsp;<?php echo $mue["otrNeoMalig"]; ?></span></td>
							</tr>
							<tr>
							<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Especifique:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["EspecclasificacionGen"]); ?></td>
							<td colspan="10" rowspan="1"><strong><span style="font-size:13px">4) CAMBIOS CELULARES BENIGNOS</span></strong></td>
	
							</tr>
							<tr>
								<td colspan="11" rowspan="1"><span style="font-size:13px"><strong>3) INTERPRETACION DESCRIPTIVA</strong></span></td>
								<td colspan="10" rowspan="1"><strong style="font-size:12px">4.1 Cambios asociados a:&nbsp;</strong></td>

							</tr>
							<tr>
								<td colspan="11" rowspan="1"><span style="font-size:13px"><strong>3.1 ANORMALIDADES DE CELULAS EPITELIALES</strong></span></td>
								<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">&nbsp; &nbsp;<?php echo $mue["CBE"]; ?></span></td>

							</tr>
							<tr>
								<td colspan="11" rowspan="1"><strong style="font-size:12px">3.1.1. Celulas escamosas</strong></td>
								<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Especifique:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["especifTipoOrg"]); ?></td>

							</tr>
							<tr>
								<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">&nbsp; &nbsp;<?php echo $mue["CES"]; ?></span></td>
								<td colspan="10" rowspan="1"><span style="font-size:13px"><strong>4.2 Cambios reactivos asociados a:</strong></span></td>

							</tr>
						
							<tr>
								<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Especifique:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["espeCelGlandu"]); ?></td>
								<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">&nbsp; &nbsp;<?php echo $mue["CRE"]; ?></span></td>

							</tr>
							<tr>
								<td colspan="11" rowspan="1"><span style="font-size:12px"></span></td>
								<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Especifique:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["espeCambioReac"]); ?></td>
							</tr>
							
							
							<tr>
								<td colspan="11" rowspan="1"><span style="font-size:12px"></span></td>
								<td colspan="10" rowspan="1"><span style="font-size:13px"><strong>5) EVALUACION HORMONAL:</strong></span></td>
							</tr>
							<tr>
								<td colspan="11" rowspan="1"><span style="font-size:12px"></span></td>
								<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">&nbsp; &nbsp;<?php echo $mue["PH"]; ?></span></td>
							</tr>
						
							<tr>
								<td colspan="11" rowspan="2"><span style="font-size:12px"></span></td>
								<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Especifique:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["especifPatronHor"]); ?></td>
							</tr>
							<tr>
								<td colspan="10" rowspan="1"><span style="font-size:12px">Valoraci&oacute;n hormonal no posible por:&nbsp;</span></td>
							</tr>	
							
							<?php } ?>
							<?php if ($mue["clasificacionGen"] == 5) { ?>
								<tr>
									<td colspan="11" rowspan="1"><span style="font-size:13px"><strong>1) CALIDAD DE ESP&Eacute;CIMEN</strong></span></td>
									<td colspan="10" rowspan="1"><strong><span style="font-size:13px">4) CAMBIOS CELULARES BENIGNOS</span></strong></td>
								</tr>
								
								<tr>
									<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">&nbsp; &nbsp;<?php echo $mue["CE"]; ?></span></td>
									<td colspan="10" rowspan="1"><strong style="font-size:12px">4.1 Cambios asociados a:&nbsp;</strong></td>
								</tr>
								<tr>
									<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Especifique:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["especifiqueCalidadEspec"]); ?></td>
									<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">&nbsp; &nbsp;<?php echo $mue["CBE"]; ?></span></td>
								</tr>
								<tr>
									<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Especifique Endo.:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["EspecCelulasEndoCervicales"]); ?></td>
								</tr>
								<tr>
									<td colspan="11" rowspan="1"><span style="font-size:13px"><strong>2) CLASIFICACION GENERAL&nbsp;</strong></span></td>
									<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Especifique:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["especifTipoOrg"]); ?></td>

								</tr>
								<tr>
									<td colspan="11" rowspan="1" style="font-size: 12px;"><span style="font-size:13px">&nbsp; &nbsp;<?php echo $mue["CG"]; ?></span></td>
									<td colspan="10" rowspan="1"><span style="font-size:13px"><strong>4.2 Cambios reactivos asociados a:</strong></span></td>
								</tr>
								
							
								
								<tr>
									<td colspan="11" rowspan="1"><span style="font-size:13px"><strong></strong></span></td>
									<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">&nbsp; &nbsp;<?php echo $mue["CRE"]; ?></span></td>

								</tr>
								
								
								<tr>
									<td colspan="11" rowspan="1"><span style="font-size:12px"></span></td>
									<td colspan="10" rowspan="1"><span style="font-size:13px"><strong>5) EVALUACION HORMONAL:</strong></span></td>
								</tr>
								<tr>
									<td colspan="11" rowspan="1"><span style="font-size:12px"></span></td>
									<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">&nbsp; &nbsp;<?php echo $mue["PH"]; ?></span></td>
								</tr>
							
								<tr>
									<td colspan="11" rowspan="2"><span style="font-size:12px"></span></td>
									<td colspan="10" rowspan="1" style="font-size: 12px;"><span style="font-size:12px">Especifique:&nbsp;</span>&nbsp; &nbsp;<?php echo strtoupper($mue["especifPatronHor"]); ?></td>
								</tr>
								<tr>
									<td colspan="10" rowspan="1"><span style="font-size:12px">Valoraci&oacute;n hormonal no posible por:&nbsp;</span></td>
								</tr>	

							<?php } ?>
							
							
							<tr>
								<td colspan="21"><span style="font-size:13px"><strong>CONCLUSIONES Y SUGERENCIAS</strong></span></td>
							</tr>
							<?php if($mue["txtAreaConclusiones"]!="") { ?>
							<tr>
								<td colspan="21"><span style="font-size:13px"><?php echo strtoupper($mue["txtAreaConclusiones"]); ?></span></td>
							</tr>
							<?php } ?>
							<tr>
								<td colspan="21"><span style="font-size:12px">Obtener muestra: &nbsp; <?php echo strtoupper($mue["fechaConcySuger"]); ?></span></td>
							</tr>
							<tr>
								<td colspan="21"><span style="font-size:12px">Los resultados obtenidos corresponden a las muestras pertenecientes a la paciente identificada, tal como se indica en el presente informe.</span></td>
							</tr>
							<tr>
								<td colspan="7" rowspan="1" style="font-size: 12px;"><span style="font-size:13px"><strong>Diagn&oacute;stico realizado en el laboratorio:</strong></span>&nbsp; &nbsp;<?php echo strtoupper($mue["dxRealizadoLab"]); ?></td>
								<td colspan="7" rowspan="1" style="text-align:center"><span style="font-size:13px"><strong>DATOS DEL PERSONAL RESPONSABLE&nbsp;</strong></span></td>
								<td colspan="7" rowspan="1" style="text-align: center;"><span style="font-size:13px;"><strong>CONFIRMADO POR</strong></span></td>
							</tr>
							<tr>
								<td colspan="7" rowspan="1">&nbsp;</td>
								<td colspan="7" rowspan="1">&nbsp;</td>
								<td colspan="7" rowspan="3" style="font-size:9px;text-align: center;">&nbsp;<?php echo strtoupper($mue["MAPTO"]); ?><br> &nbsp;CMP:&nbsp;<?php echo strtoupper($mue["colegConfirma"]); ?></td>
							</tr>
							<tr>
								<td colspan="7" rowspan="1" style="font-size: 12px;"><span style="font-size:13px"><strong>FECHA:&nbsp;&nbsp;</strong></span>&nbsp; &nbsp;<?php echo $mue["fechalab"]; ?></td>
								<td colspan="7" rowspan="1">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="7" rowspan="1">&nbsp;</td>
								<td colspan="7" rowspan="1" style="font-size: 12px;"><strong><span style="font-size:8px">Nombres y apellidos&nbsp;&nbsp; &nbsp; <?php echo strtoupper($mue["datosResposanble"]); ?> Colegiatura&nbsp; 
								&nbsp; &nbsp; &nbsp; <?php echo strtoupper($mue["colegioResp"]); ?></span></strong></td>
							</tr>
							
						</tbody>
					</table>
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
  }}
  
</style> 