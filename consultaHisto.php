
 <?php 



session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 


include 'Vistas/librerias.php';  

?>


<hr>
<h1 style="font-size: 17px;font-weight: 800;">HISTOQUIMICA | INMUNOHISTOQUIMICA </h1><hr style="margin-top: 10px;">
                     <div class="form-group row">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">¿Continuar análisis de la muestra?<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 ">
                                <select class="form-control" name="anaMuestra" id="anaMuestra" required="required" tabindex="33"></select>
                            </div>
                            
                    </div>
                     <div id="analisisMuestraSi" class="hidden">      
                    
                    
                    
                    <div class="form-group row">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">Procedimiento a realizar<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 ">
                                <select class="form-control" name="procedReal" id="procedReal" required="required" tabindex="33"></select>
                                <input type="hidden" id="idSelectHisto" name="idSelectHisto">
                                <input type="hidden" id="seleMamaTbl" name="seleMamaTbl">
                            </div>
                            
                    </div>
                    <div class="form-group row">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">Médico solicitante<span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 ">
                                <input class="form-control" name="medicoSolcit" id="medicoSolcit" required="required" type="text">
                            </div>
                            
                    </div>
                    <div class="form-group row">
                            
                            <div class="col-md-6 col-sm-6 ">
                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;margin-left: -9px;">Diagnóstico clínico</label>
                                <textarea class="form-control" rows="3"  name="dxClinicoHi" id="dxClinicoHi" style="width: 580px;" ></textarea>
                            </div>
                            
                    </div>
                    <div class="form-group row" style="margin-top:17px;margin-bottom: 10px;">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 235px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                Elegir taco<span style="float: right;">:</span></label>
                            <div class="col-md-7 col-sm-6 ">
                                 <span style="text-transform: none;font-weight: 100;font-style: italic;">Marque los tacos que desee analizar.</span></label>
                            </div>
                    </div>
                    <div class="form-group row" style="margin-top: -10px;">
                        <div class="table-responsive" id="datExrRotHistoq" style="float: left;width:599px;padding: 8px;"> </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;" id="lblMarca">Marcador<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 ">
                                <a class="btn btn-success btn-xs" onclick="limpiarMarcador();" id="marcHis" data-toggle="modal" data-target=".bs-example-modal-modalRegistroMarcador" > Agregar + </a>
                            </div>
                    </div>
                    <div class="form-group row">
                          <div class="table-responsive" id="datAuditObsMarcador" style="float: left;width:601px;padding: 10px;"> </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-md-12 col-sm-6 ">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;margin-left: -9px;text-transform: uppercase;">Interpretación<span class="required">*</span>
                            </label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-md-12 col-sm-6 ">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;margin-left: -9px;text-transform: uppercase;">COMENTARIO<span class="required">*</span>
                            </label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-md-12 col-sm-6 ">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;margin-left: -9px;text-transform: uppercase;">NOTA<span class="required">*</span>
                            </label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                    </div>
            </div>