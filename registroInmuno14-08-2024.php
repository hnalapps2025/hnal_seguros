 <?php 


//error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 

include_once ('./../config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");

include 'Vistas/librerias.php';  


$idre = $_GET['id'];

?>
<style>
  input[type="radio"]{
      display: none;
    }
    input[type="radio"] + label span {
      display: inline-block;
      width: 20px;
      height: 20px;
      background: transparent;
      vertical-align: middle;
      border: 2px solid #f56;
      border-radius: 50%;
      padding: 2px;
      margin:0 5px;
    }
    input[type="radio"]:checked + label span {
      width: 20px;
      height: 20px;
      background: #f56;
      background-clip: content-box;
    } 
    
    .modale {
      display: none; /* Por defecto, estará oculto */
      position: fixed; /* Posición fija */
      z-index: 1; /* Se situará por encima de otros elementos de la página*/
      padding-top: 200px; /* El contenido estará situado a 200px de la parte superior */
      left: 0;
      top: 0;
      width: 100%; /* Ancho completo */
      height: 100%; /* Algura completa */
      overflow: auto; /* Se activará el scroll si es necesario */
      background-color: rgba(0,0,0,0.5); /* Color negro con opacidad del 50% */
    }
    
    /* Ventana o caja modal */
    .contenido-modal {
      position: relative; /* Relativo con respecto al contenedor -modal- */
      background-color: white;
      margin: auto; /* Centrada */
      padding: 20px;
      width: 30%;
      -webkit-animation-name: animarsuperior;
      -webkit-animation-duration: 0.5s;
      animation-name: animarsuperior;
      animation-duration: 0.5s
    }
    
    /* Animación */
    @-webkit-keyframes animatetop {
      from {top:-300px; opacity:0} 
      to {top:0; opacity:1}
    }
    
    @keyframes animarsuperior {
      from {top:-300px; opacity:0}
      to {top:0; opacity:1}
    }
    
    /* Botón cerrar */
    .close {
      color: black;
      float: right;
      font-size: 30px;
      font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }
</style>
<script>

    
  

    function deleteMuesPato(id){
    
                    
                            $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=deleteMuesPato",
                                    data: "id="+id,
                                    success: function(resp){
                                       $('#tbl_tesjidoPat').DataTable().ajax.reload(null, false);
                                       
                                }
                            }); 
                            
                       
                       
    
                }

    $( document ).ready(function() {
        
        
        var id = getParameterByName('id');
       // var formato = getParameterByName('formato');
        //var tipoest = getParameterByName('tipoest');
        editarRegistroPatologia(id);medSolicitaHqIhq();
        cargarUsersAuditorAsignado();usuarioConfirmadoPor();usuarioConfirmadoPorAP();
       
        //CargarRotulosPat(1);
        CargarRotulosPatMicro(2);
        //CargarTacosPat(1);
        //CargarTacosPatQuimioMicro(2);
        cargarListPlantilla();anaListMuestra();listTipoEstudioHisto();
        cargarlistEmbarazo();
        cargarlistMetodoAnticonceptivo();
        cargartipoEstPat();
        cargarTipoServicioPat();
        
        listTipoDocPato();cargarResultadoHisto();cargarlistTipoAnticonceptivo();
        cargarIntensidadTincion();cargaNucleosPositivos();cargarlistExamenGineco();
    
        
        listCalidEspec(1,"calidEspec");
        listCalidEspec(2,"clasificacionGen");
        listCalidEspec(3,"celulasEscamosas");
        listCalidEspec(4,"celGlandu");
        listCalidEspec(5,"celulBenignos");
        listCalidEspec(6,"cambioReactivos");
        listCalidEspec(7,"patronHormonal");
        
        
        $("select[name=tipoEstPat]").change(function(){
            var datid = $('select[name=tipoEstPat]').val();
            $("#idtipoEstPat").val(datid);
          
            
        });
        
        
        $("select[name=anaMuestra]").change(function(){
            var datid = $('select[name=anaMuestra]').val();
            
            if(datid==2){
                $("#analisisMuestraSi").removeClass("hidden");
            }else{
                $("#analisisMuestraSi").addClass("hidden");
            }
            
        });
        
        $("select[name=procedReal]").change(function(){

            var datid = $('select[name=procedReal]').val();
            var ip = getParameterByName('id');
            
            if(datid==4){
                 
                 $("#lblMarca").text("COLORACION");
                 $("#titleModalM").text("COLORACION");
                 $("#titleLblMa").text("COLORACION");
                 $('#idSelectHisto').val(datid);
                 $('#btnIhqHq').text("Generar informe HQ");
                 var link="http://seguros.hloayza.local/pdfHistoquimicaVistaPrevia.php?id="+ip;
                 $('#btnIhqHqModal').attr('href', link);

            }else{
                 
                 $("#lblMarca").text("MARCADOR");
                 $("#titleModalM").text("MARCADORES");
                 $("#titleLblMa").text("MARCADOR");
                 $('#idSelectHisto').val(datid);
                 $('#btnIhqHq').text("Generar informe IHQ");
                 var link="http://seguros.hloayza.local/pdfInmunoHistoquimicaVistaPrevia.php?id="+ip;
                 $('#btnIhqHqModal').attr('href', link);

                 var link2="http://seguros.hloayza.local/pdfAnatomoPatologicoVistaPrevia.php?id="+ip;
                 $('#btnIhqHqModalCerEspec').attr('href', link2);
                 
            }
            
        });
        
        
        
        $("select[name=procedRealCito]").change(function(){
            var datid = $('select[name=procedRealCito]').val();
            
            if(datid==4){
                $("#lblMarca").text("COLORACION");
                 $("#titleModalM").text("COLORACION");
                 $("#titleLblMa").text("COLORACION");
                 $('#idSelectHistoCito').val(datid);
                

            }else{
                $("#lblMarca").text("MARCADOR");
                $("#titleModalM").text("MARCADORES");
                 $("#titleLblMa").text("MARCADOR");
                 $('#idSelectHistoCito').val(datid);
            }
            
        });
        
        
        /* $("#tesjidoPat").keypress(function(e) {
                if(e.which == 13) {
                  e.preventDefault();
                      
                        cadena = "<tr>";
                        cadena = cadena + "<td>" + $('#tesjidoPat').val() + "</td>";
                        cadena = cadena + '<td style="text-align: center;"><input type="button" class="borrar" style="background: white;border: 1px solid white;color: red;font-weight: 800;" value="X"></td>';
                        cadena = cadena + "</tr>";
                        
                        $("#tbl_tesjidoPat tbody").append(cadena);
                        $('#tesjidoPat').val("");
                      
                }
        }); 
        
        $('#agregarCompetencia').click(function(){
            
            cadena = "<tr>";
            cadena = cadena + "<td>" + $('#tesjidoPat').val() + "</td>";
            cadena = cadena + '<td style="text-align: center;"><input type="button" class="borrar" style="background: white;border: 1px solid white;color: red;font-weight: 800;" value="X"></td>';
            cadena = cadena + "</tr>";
            
            
            $("#tbl_tesjidoPat tbody").append(cadena);
            $('#tesjidoPat').val("");
            
         });  
         
         */
         
         
         
         $('#agregarCompetencia').click(function(){
                  
                  
                  var muestra =$("#tesjidoPat").val();
                  var iduser =$("#iduser").val();
                  var tipoEstPat =$("#tipoEstPat").val();
                  var nroOrdenPat =$("#nroOrdenPat").val();
            
                 $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=regMuestraIndividualPato",
                        data:{muestra:muestra,iduser:iduser,tipoEstPat:tipoEstPat,nroOrdenPat:nroOrdenPat}
                    }).done(function(datos){               
                        
                      $('#tbl_tesjidoPat').DataTable().ajax.url("./Controlador/search.php?function=listMuestraIndi&formato="+nroOrdenPat+"&tipoest="+tipoEstPat).load();    
                      //$('#tbl_tesjidoPat').DataTable().ajax.reload(null,false);
                      $("#tesjidoPat").val("");
                      
                        
                    }); 
                  
             });
         
         
         /*  INICIA DATATABLE */
         
                var formato = getParameterByName('formato');
               var tipoest = getParameterByName('tipoest');
         
                                    var table = $('#tbl_tesjidoPat').DataTable({
                                    
                                                  "bProcessing": true,
                                                  "sAjaxSource": "./Controlador/search.php?function=listMuestraIndi&formato="+formato+"&tipoest="+tipoest,
                                                  "bPaginate":true,
                                                  "sPaginationType":"full_numbers",
                                                  "iDisplayLength":15,
                                                  "order": [0, "desc" ],
                                                  "columnDefs": [
                                                    { targets:  [0,1], visible: true,sortable: false},
                                                    { targets: '_all', visible: false},
                                                    {
                                                      className: "dt-left",
                                                      "targets": [0] 
                                                  },{
                                                    className: "dt-right",
                                                    "targets": [] 
                                                  },
                                                  {
                                                      className: "dt-center",
                                                      "targets": [1]
                                                  }],
                                                  "aoColumns": [

                                                        { mData: 'muestra' },
                                                        { mData: 'eli' },
                                                        
                                                  ],

                                                  dom: '<fBtip>',
                                                  buttons: [
                                                      /*  {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: titleExcel + output,
                                                            exportOptions: {
                                                              columns: exce
                                                            },
                                                            customize: function(xlsx) {
                                                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                              $('row[r=2] c', sheet).attr('s', '47');
                                                          }
                                                          
                                                        } */
                                                        
                                                  ],           

                                                  language: {
                                                        "decimal": "",
                                                        "searchPlaceholder": "Columna ..",
                                                        "emptyTable": "No hay registros para mostrar",
                                                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                                                        "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                                                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                                                        "infoPostFix": "",
                                                        "thousands": ",",
                                                        "lengthMenu": "Mostrar _MENU_ filas",
                                                        "loadingRecords": "Cargando...",
                                                        "processing": "Procesando...",
                                                        "search": "Buscar por: ",
                                                        "zeroRecords": "Sin resultados encontrados",
                                                        "paginate": {
                                                            "first": "Primero",
                                                            "last": "Ultimo",
                                                            "next": "Siguiente",
                                                            "previous": "Anterior"
                                                        }
                                                    },
                                                    
                                                     
                                                      
                                                    
                                                  });
                                                  
                                                  
                                                  $('#tbl_tesjidoPat_filter').addClass('form-group');
                                                $('#tbl_tesjidoPat_filter').css('text-align','left');
                                                $('#tbl_tesjidoPat_filter').css('display','none');
                                                $('#tbl_tesjidoPat_info').css('display','none');
                                                $('#tbl_tesjidoPat_paginate').css('display','none');
                                                
                                                $('#tbl_tesjidoPat_paginate').css('width','100%');
                                                $('.dt-buttons').css('float','right');
                                                $('.dt-buttons').css('margin-top','-18px');
                                                $('#tbl_tesjidoPat_filter label input').addClass('form-control');
                                                $('#tbl_tesjidoPat_length label select').addClass('form-control');
                
         
         /* FIN */
         
         
         
         
         
         $(document).on('click', '.borrar', function(event) {
          event.preventDefault();
          $(this).closest('tr').remove();
        });
        
        
        
        
    });
</script>
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
      
                  <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">
                                <h2 style="text-transform: uppercase;font-weight: 700;">REGISTRO DE PACIENTES<small></small></h2>
                                 <!--<button type="button" class="btn btn-success btn-xs" style="margin-left: 60px;">Terminado</button>
                                <button type="button" class="btn btn-warning btn-xs">Pendiente</button>
                                <button type="button" class="btn btn-default btn-xs">Sin asignacion</button>-->
                                <!--<button type="button" class="btn btn-success btn-xs">Enviado</button>
                                              <button type="button" class="btn btn-warning btn-xs">Pendiente</button>-->
                               <!-- <a class="btn btn-success"  href="imporConsol.php"  style="float: right;"><i class="fa fa-file-excel-o"></i> Importar</a>-->
                              
                            <!-- <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false" 
                                style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"><i class="fa fa-edit m-right-xs"></i> Nuevo Paquete</a>-->
                                
                                <!--<div class="btn-group" style="margin-bottom: 5px;float: right;">

                    				<button style="background: #1ABB9C;border: 1px solid #1ABB9C;" data-toggle="dropdown" class="btn btn-primary dropdown-toggle btn-xs" type="button" aria-expanded="true">Opciones <span class="caret"></span>
                    				</button>
                    				<ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #949494;">
                    					<li>
                    						<a onclick="limpiarListpaq()" data-toggle="modal" data-target=".bs-example-modal-modalPaquete"><i class="fa fa-plus"></i> Crear paquete</a>
                    					</li>
                    					<li>
                    						<a onclick="verCajaModal()" data-toggle="modal" data-target=".bs-example-modal-modalCajax"><i class="fa fa-plus"></i> Crear Caja</a>
                    					</li>
                    					
                    				</ul>
                    			</div>-->
                                
                                
                                
                                
                                  <!--<a href="especial.php" class="btn btn-success"  id="agr2" role="button" style="float: right;" "><i class="fa fa-edit m-right-xs"></i> Importar</a>-->
                               
                                <!--<a href="#" class="dropdown-toggle" data-toggle="modal" data-target=".bs-example-modal-sm" id="agr2" role="button" aria-expanded="false"><i class="fa fa-arrows"></i></a>-->
                                <!--<a href="registrosexcel.php" style="float: right;"><img style="width:30px;" src="<?php echo $path ?>images/excel.png">&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;</a>
                                <a style="float: right;">Exportar a:&nbsp;&nbsp; </a> -->
                                <div class="clearfix"></div>
                              </div>
                              

                              <div class="x_content">
                             
                              <table border="0" style="display:none;" >
                                  <tbody>
                                  
                                      <tr>
                                         <form id="" action="#" method="get">
                                              <td><label>Buscar:</label></td>
                                              <td> <select name="tipoRep" id="tipoRep" class="form-control" style="text-transform: uppercase;width: 117px;">
                                                                <option value="FUA">FUA</option>
                                                                <option value="HISTORIA">HISTORIA</option>
                                                        </select>
                                              </td>
                                              <td>
                                                  <div class="input-group" style="margin-bottom: -5px;">
                                                    <input name="busFua" id="busFua" type="text" class="form-control" >
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-primary" id="sa"><i class="fa fa-eraser"></i> Buscar</button>
                                                    </span>
                                                  </div>
                                              </td>
                                          </form>
                                          <td><label style="margin-left:25px;margin-right: 5px;">Estado:</label></td>
                                          <td><p id="filEsta" style="margin: 0 0 -2px;"></p></td>
                                         <td><label style="margin-left:25px;margin-right: 5px;">Auditor:</label></td>
                                          <td><p id="fecon" style="margin: 0 0 -2px;"></p></td>
                                          <td ><label style="margin-left: 14px;">Desde:&nbsp;&nbsp;</label></td>
                                          <td ><input name="minCie109" id="minCie109" style="width: 115px;" type="text" class="form-control" placeholder="Fecha Inicio" autocomplete="off" ></td>
                                          <td><label>&nbsp;&nbsp;Hasta:&nbsp;&nbsp;</label></td>
                                          <td ><input name="maxCie109" id="maxCie109" type="text" style="width: 115px;" class="form-control" placeholder="Fecha final" autocomplete="off" ></td>                                          
                                          <td>&nbsp;
                                        <!--<td><label style="margin-left:25px;margin-right: 5px;">Estado:</label></td>
                                          <td><p id="feces" style="margin: 0 0 -2px;"></p></td>
                                          </td>-->
                                          
                                      </tr>
                                  </tbody>
                              </table> 
                             
                                        <div class="alert alert-success alert-dismissible fade in hidden" role="alert" id="alerify">
                                              <button type="button" class="close" ><span aria-hidden="true" id="closealert">×</span>
                                              </button>
                                              <strong id="pacte"></strong>
                                          </div>
                                            <div class="col-md-12 col-sm-12 ">
                                                <div class="x_panel">
                                                <div class="x_content">
                                                
                                                <p></p>
                                                <div id="wizard" class="form_wizard wizard_horizontal">
                                                <ul class="wizard_steps anchor" style="width: 80%;">
                                                        <li id="paso1" >
                                                                <a class="selected" isdone="1" rel="1" id="rel1">
                                                                <span class="step_no" id="no1" style="cursor: pointer;">1</span>
                                                                <span class="step_descr">
                                                               Recepcion y Registro<br>
                                                                <small></small>
                                                                </span>
                                                                </a>
                                                        </li>
                                                        <li id="paso2" class="hidden">
                                                            <a  class="disabled" isdone="0" rel="2" id="rel2">
                                                            <span class="step_no" id="no2" style="cursor: pointer;">2</span>
                                                            <span class="step_descr" id="titleSocpia">
                                                            Macroscopia<br>
                                                            <small></small>
                                                             </span>
                                                            </a>
                                                        </li>
                                                        <li id="paso3" class="hidden">
                                                            <a class="disabled" isdone="0" rel="3" id="rel3">
                                                            <span class="step_no" id="no3" style="cursor: pointer;" >3</span>
                                                            <span class="step_descr">
                                                            Microscopia<br>
                                                            <small></small>
                                                            </span>
                                                            </a>
                                                        </li>
                                                        <li id="paso4" class="">
                                                            <a class="disabled" isdone="0" rel="4" id="rel4">
                                                            <span class="step_no" id="no4" style="cursor: pointer;">4</span>
                                                            <span class="step_descr" id="lblInformCi">
                                                            Informe<br>
                                                            <small></small>
                                                            </span>
                                                            </a>
                                                        </li>
                                                </ul>

                <div class="stepContainer" style="height:auto;overflow-x: inherit;"><div id="step-1" class="content" style="display: block;">
               
                <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmRegistroPacientePato" class="formulario form-horizontal form-label-left input_mask">
                <h1 style="font-size: 14px;font-weight: 800;">DATOS DEL PACIENTE</h1><hr style="margin-top: 10px;">
                
                <div class="form-group row">
                    <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">TIPO DOC<span class="required">*</span>
                    </label>
                    <div class="col-md-1 col-sm-6 ">
                        <select class="form-control" name="tipoDocPato" id="tipoDocPato" required="required" tabindex="33"></select>
                    </div>
                    <label class="col-form-label col-md-1 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">NRO DOC<span class="required">*</span>
                    </label>
                    <div class="col-md-2 col-sm-6 ">
                    <input type="text"  name="nroDocPato" id="nroDocPato" required="required" class="form-control ">
                      <input type="hidden"  name="iduser" id="iduser" value="<?php echo $iduser ?>">
                      <input type="hidden"  name="idRegPatot" id="idRegPatot" >
                    </div>
                    <label class="col-form-label col-md-1 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PACIENTE<span class="required">*</span>
                    </label>
                    <div class="col-md-4 col-sm-6 ">
                        <input type="text"  name="pacientePato" required="required"  id="pacientePato"  class="form-control " style="text-transform: uppercase;">
                    </div>
                    <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">EDAD<span class="required">*</span>
                    </label>
                    <div class="col-md-1 col-sm-6 ">
                        <input type="text" id="edadPato" name="edadPato" required="required" class="form-control  " maxlength="2">
                    </div>
                </div>
                <div class="form-group row">
                <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">SEXO<span class="required">*</span>
                </label>
                <div class="col-md-1 col-sm-6 ">
                    
                    <select class="form-control" name="sexoPat" id="sexoPat" required="required" tabindex="33">
                            <option value="">Seleccionar</option>
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                </div>
                  <label class="control-label col-md-1 col-sm-3 col-xs-12" style="font-size: 10px;">FINANCIAMIENTO</label>
                  <div class="col-md-2 col-sm-12 col-xs-12 " id="">
                        <select class="form-control" name="financiaPTO" id="financiaPTO" required="required" tabindex="33">
                            <option value="">Seleccionar</option>
                            <option value="1">PARTICULAR</option>
                            <option value="2">SIS</option>
                        </select>
                  </div>
                <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">IPRESS<span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-6 ">
                <input type="text" id="iprId" name="iprId" required="required" class="form-control" style="text-transform: uppercase;">
                </div>
                <label class="col-form-label col-md-1 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">JURISDICCION<span class="required">*</span>
                </label>
                <div class="col-md-1 col-sm-6 ">
                <input type="text"  name="juriPr" id="juriPr" required="required" class="form-control ">
                </div>
                
                </div>
                <div class="form-group row">
                <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">CUENTA<span class="required">*</span>
                </label>
                <div class="col-md-1 col-sm-6 ">
                <input type="text" id="ctinmuno" name="ctinmuno" required="required" class="form-control " style="font-size: 12px;">
                </div>
                <label class="col-form-label col-md-1 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">HISTORIA<span class="required">*</span>
                </label>
                <div class="col-md-2 col-sm-6 ">
                <input type="text"  name="historiaPat" id="historiaPat" required="required" class="form-control ">
                </div>
                    <label class="control-label col-md-1 col-sm-3 col-xs-12" style="font-size: 10px;">TIPO SERVICIO</label>
                    <div class="col-md-2 col-sm-12 col-xs-12 " id="">
                        <select class="form-control" name="tipoServicoPatl" id="tipoServicoPatl" required="required" tabindex="33"></select>
                    </div>
                    <label class="col-form-label col-md-1 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">SERVICIO<span class="required">*</span></label>
                    <div class="col-md-3 col-sm-6 ">
                         <select class="form-control" name="servicioPat" id="servicioPat" required="required" tabindex="33" style="text-transform: uppercase;"></select>
                    </div>
                </div>
                <div class="form-group row">
                        
                        <label for="middle-name" class="col-form-label col-md-1 col-sm-3 label-align"  style="text-align: right;margin-top: 4px;font-size:11px;">SALA / CAMA</label>
                        <div class="col-md-1 col-sm-6 ">
                        <input id="salacamaPat" class="form-control col" type="text" name="salacamaPat">
                        </div>
                        <label for="middle-name" class="col-form-label col-md-1 col-sm-3 label-align"  style="text-align: right;margin-top: 4px;font-size: 11px;text-align: right;">CELULAR</label>
                        <div class="col-md-2 col-sm-6 ">
                            <input id="celularPacientePatologia" class="form-control col" type="text" name="celularPacientePatologia">
                        </div>
                         <label class="control-label col-md-1 col-sm-3 col-xs-12" style="font-size: 10px;">CONVENIO</label>
                        <div class="col-md-2 col-sm-12 col-xs-12 " id="">
                            <select class="form-control" name="selecConvenio" id="selecConvenio" required="required" tabindex="33">
                                  <option value="">Seleccionar</option>
                                  <option value="2">SI</option>
                                  <option value="1">NO</option>
                            </select>
                        </div>
                        <label class="col-form-label col-md-1 col-sm-3 label-align hidden" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;" id="lblcon">IPRESS CONVENIO<span class="required">*</span></label>
                        <div class="col-md-3 col-sm-6 hidden" id="cmapconDiv">
                             <select class="form-control" name="ipressConvenio" id="ipressConvenio" required="required" tabindex="33"></select>
                        </div>
                       
                        
                </div>
                <div class="form-group row">
                
                <br>
                <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="registroPacientePatologia();" style="margin-left: 9%;" tabindex="13">GUARDAR</button>
                <button type="button" class="btn btn-success" id="GuardarPaciente" onclick="modInmuno();"  style="" tabindex="13">Modificar</button>
                </form>
                </div>
                <br>
                <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmRegistroPacientePato2" class="formulario form-horizontal form-label-left input_mask">
                <h1 style="font-size: 14px;font-weight: 800;">DATOS DE LA ORDEN</h1><hr style="margin-top: 10px;">
                <input id="idRegSec2" type="hidden" name="idRegSec2" value="<?php echo $idre ?>">
                <input id="iduser2" type="hidden" name="iduser2" value="<?php echo $iduser ?>">
                <div class="form-group row">
                <label for="middle-name" class="col-form-label col-md-1 col-sm-3 label-align"  style="text-align: right;margin-top: 4px;font-size: 11px;text-align: right;">NRO FACTURA</label>
                <div class="col-md-2 col-sm-6 ">
                    <input id="factPat" class="form-control col" type="text" name="factPat">
                </div>
                <label for="middle-name" class="col-form-label col-md-1 col-sm-3 label-align"  style="margin-top: 4px;font-size: 11px;text-align: right;">TIPO DE ESTUDIO</label>
                        <div class="col-md-2 col-sm-6 ">
                             <select class="form-control col" id="tipoEstPat" name="tipoEstPat"> 
                                
                            </select>
                            <input  id="corPat" name="corPat" type="hidden">  
                        </div>
                        <label for="middle-name" class="col-form-label col-md-1 col-sm-3 label-align"  style="margin-top: 4px;font-size: 11px;text-align: right;">PROCEDIMIENTO</label>
                        <div class="col-md-2 col-sm-6 ">
                                <select class="form-control col" id="procePat" name="procePat"></select>
                        </div>
                        <label for="middle-name" class="col-form-label col-md-1 col-sm-3 label-align hidden"  style="margin-top: 4px;font-size: 11px;text-align: right;" id="lblsubpro">SUB PROC</label>
                        <div class="col-md-2 col-sm-6 hidden" id="selesubproc">
                                <select class="form-control col" id="subProcePat" name="subProcePat">
                                    <option value="">Seleccionar</option>
                                    <option value="14">BLOQUE CELULAR</option>
                                    <option value="15">CITOLOGIA LIQUIDOS, LAVADOS Y CEPILLADO</option>
                                    <option value="16">ON SITE</option>
                                    <option value="17">BIOPSIA POR ASPIRACION DE AGUJA FINA</option>
                                </select>
                        </div>
                
                </div>
                <div class="form-group row">
                <label for="middle-name" class="col-form-label col-md-1 col-sm-3 label-align"  style="text-align: right;margin-top: 4px;font-size: 11px;">MEDICO SOLICITANTE</label>
                <div class="col-md-2 col-sm-6 ">
                <input id="mediSolicitante" name="mediSolicitante" class="form-control col" type="text" placeholder ="Autocompletado">
                </div>
                <label for="middle-name" class="col-form-label col-md-1 col-sm-3 label-align"  style="margin-top: 4px;font-size: 11px;text-align: right;">ESPECIALIDAD</label>
                <div class="col-md-3 col-sm-6 ">
                    <input id="especialPat" name="especialPat" class="form-control col" type="text" >
                </div>
                <label for="middle-name" class="col-form-label col-md-1 col-sm-3 label-align"  style="margin-top: 4px;font-size: 11px;text-align: right;">FECHA RECEPCION</label>
                <div class="col-md-3 col-sm-6 ">
                    <input id="fechaPat" class="form-control col" type="date" name="fechaPat">
                </div>
                </div>
                <div class="form-group row">
                <label for="middle-name" class="col-form-label col-md-1 col-sm-3 label-align"  style="margin-top:9px;font-size: 11px;text-align: right;">MUESTRA</label>
                <div class="col-md-2 col-sm-6 " style="margin-top: 6px;margin-left:-5px">
                        <div class="input-group">
                              <input id="tesjidoPat" class="form-control col" type="text" name="tesjidoPat" placeholder ="Autocompletado" style="text-transform: uppercase;">
                               <input id="iduser" type="hidden" name="iduser" value ="<?php echo $iduser ?>">
                               <input id="idtipoEstPat" type="hidden" name="idtipoEstPat" >
                                <span class="input-group-btn">
                                    <button type="button" id="agregarCompetencia" class="btn btn-success"> + </button>
                                </span>
                        </div>
                      
                </div>
                        <label for="middle-name" class="col-form-label col-md-1 col-sm-3 label-align"  style="margin-left: 5px;margin-top: 4px;font-size: 11px;text-align: right;">NRO ORDEN</label>
                        <div class="col-md-2 col-sm-6 ">
                            <input id="nroOrdenPat" class="form-control col" type="text" name="nroOrdenPat" readonly>
                        </div>
                     <label for="middle-name" class="col-form-label col-md-2 col-sm-3 label-align"  style="margin-top: 4px;font-size: 11px;text-align: right;">ASIGNACION</label>
                        <div class="col-md-3 col-sm-6 ">
                             <select class="form-control col" id="idAuditorAsignado" name="idAuditorAsignado"> 
                            </select>
                </div>
               
                
                </div>
                 <div class="form-group row">
                <div class="col-md-2 col-sm-6 " style="margin-left:8%">
                        <table id="tbl_tesjidoPat" style="font-size: 11px;border: 1px solid white !important;" class="compact">
                            <thead>
                              <tr>
                                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MUESTRA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th style="padding: 2px 3px;">&nbsp;&nbsp;&nbsp;&nbsp;ELIMINAR</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                
                              </tr>
                            </tbody>
                            </table>
                </div>
                </div>
                 <div class="form-group row" style="float: right;">
                     <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="registroPacientePatologia2();" style="margin-left:-52%;" tabindex="13">GUARDAR</button>
                     <button type="button" class="btn btn-success" id="GuardarPaciente" onclick="modInmuno2();"  style="" tabindex="13">Modificar</button>
                 </div>
       
                </form>
                </div>
                <div id="step-2" class="content" style="display:none;">
                 <!--<h1 style="font-size: 14px;font-weight: 800;">SOLICITUD DE ESTUDIO IHQ</h1><hr style="margin-top: 10px;">
                 <div class="form-group row">
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">PERSONAL ENTREGA LAMINAS</label>
                    <div class="col-md-4 col-sm-6 ">
                    <input type="text" id="first-name" required="required" class="form-control  ">
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">FECHA/HORA ENTREGA</label>
                    <div class="col-md-2 col-sm-6 ">
                    <input type="date" id="last-name" name="last-name" required="required" class="form-control ">
                    </div>
                 </div>
                 <div class="form-group row">
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">PERSONAL RECIBE LAMINAS</label>
                    <div class="col-md-4 col-sm-6 ">
                    <input type="text" id="first-name" required="required" class="form-control  ">
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">FECHA/HORA RECEPCION</label>
                    <div class="col-md-2 col-sm-6 ">
                    <input type="date" id="last-name" name="last-name" required="required" class="form-control ">
                    </div>
                 </div>
                 <div class="form-group row">
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">TIPIFICACION DE NEOPLASIA</label>
                    <div class="col-md-4 col-sm-6 ">
                    <input type="text" id="first-name" required="required" class="form-control  ">
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">SOLICITUD IHQ</label>
                            <div class="col-md-1 col-sm-12 col-xs-12" id="divCehck">
                                <div class="checkbox" style="margin-bottom:0px;">
                                  <input type="checkbox" class="form-control" name="liquIx" id="liquIx" tabindex="72" style="width: 20px;margin-left: 1px;margin-top: -14px;">
                                  <input type="hidden" name="idUserLiquida" id="idUserLiquida">
                                </div>
                              </div>
                    
                 </div>--><br>
                 <h1 style="font-size: 17px;font-weight: 800;" id="lblMacroHis">MACROSCOPIA</h1><hr style="margin-top: 10px;">
                 
                 <div class="form-group row">
                    <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">ROTULO</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListRo();"> + Agregar</a>
                    </div>
                     <!-- <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 2: DESPARAFINIZACION</label>
                  <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 3: HIDRATACION DE LAGRIMAS</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 4: DILUIR AGUA CORRIENTE</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>-->
                 </div><br>
                 <div class="table-responsive" id="datExrRot" style="float: left;"> </div>
                 
                   <h1 style="font-size: 17px;font-weight: 800;" id="laHisto">LABORATORIO HISTOPATOLOGIA</h1><hr style="margin-top: 10px;">
                    <!--<div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">INCLUSION</label>
                         <div class="table-responsive" id="tblinclusion" > </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">CORTE</label>
                        <div class="table-responsive" id="tblcorte" > </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">COLORACION</label>
                        <div class="table-responsive" id="tblcoloracion" > </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">MONTAJE</label>
                        <div class="table-responsive" id="tblmontaje" > </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">ENTREGA</label>
                        <div class="table-responsive" id="tblentrega" > </div>
                    </div>-->
                    
                   
                   <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel" id="plInlc">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title" style="font-weight: 700;">INCLUSION</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" style="background: white !important;border: 1px solid #e5e7e9;">
                          <div class="panel-body">
                            <div class="table" id="tblinclusion" > </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title" style="font-weight: 700;" id="lblTitlepl">CORTE</h4>
                        </a>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" style="background: white !important;border: 1px solid #e5e7e9;">
                          <div class="panel-body">
                            <div class="table" id="tblcorte" > </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title" style="font-weight: 700;">COLORACION</h4>
                        </a>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" style="background: white !important;border: 1px solid #e5e7e9;">
                          <div class="panel-body">
                           <div class="table" id="tblcoloracion" > </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title" style="font-weight: 700;">MONTAJE</h4>
                        </a>
                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" style="background: white !important;border: 1px solid #e5e7e9;">
                          <div class="panel-body">
                            <div class="table" id="tblmontaje" > </div>
                          </div>
                        </div>
                      </div>
                       <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title" style="font-weight: 700;">ENTREGA</h4>
                        </a>
                        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree" style="background: white !important;border: 1px solid #e5e7e9;">
                          <div class="panel-body">
                            <div class="table" id="tblentrega" > </div>
                          </div>
                        </div>
                      </div>
                       <div id="analisisMuestraSiCito" class="hidden">    
                      <br>
                      <h1 style="font-size: 17px;font-weight: 800;">HISTOQUIMICA | INMUNOHISTOQUIMICA </h1><hr style="margin-top: 10px;">
                      
                      <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmRegistroPacientePato3" 
                                            class="formulario form-horizontal form-label-left input_mask">
                      <div class="form-group row">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">¿Continuar análisis de la muestra?<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 ">
                                <select class="form-control" name="anaMuestraCito" id="anaMuestraCito" required="required" tabindex="33"></select>
                                <input type="hidden" name="tipoRegPatolo" id="tipoRegPatolo" >
                                <input type="hidden" name="iduserPatol" value="<?php echo $iduser ?>" id="iduserPatol">
                                <input type="hidden" name="idPat" value="<?php echo $idre ?>" id="idPat">
                            </div>
                            
                    </div>
                    <div id="viewHistoUmn" class="hidden">
                        
                                <div class="form-group row">
                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">Procedimiento a realizar<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-2 col-sm-6 ">
                                                        <select class="form-control" name="procedRealCito" id="procedRealCito" required="required" tabindex="33"></select>
                                                        <input type="hidden" id="idSelectHistoCito" name="idSelectHistoCito">
                                                        <input type="hidden" id="seleMamaTblCito" name="seleMamaTblCito">
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
                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" id="elexTaco" style="width: 235px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                        Elegir taco<span style="float: right;">:</span></label>
                                                    <div class="col-md-7 col-sm-6 ">
                                                         <span style="text-transform: none;font-weight: 100;font-style: italic;" id="txtPequ">Marque los tacos que desee analizar.</span></label>
                                                    </div>
                                            </div>
                                            <div class="form-group row" style="margin-top: -10px;">
                                                <div class="table-responsive" id="datExrRotHistoqCito" style="float: left;width:599px;padding: 8px;"> </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;" id="lblMarca">Marcador<span class="required">*</span>
                                                    </label>
                                                    <div class="col-md-2 col-sm-6 ">
                                                        <a class="btn btn-success btn-xs" onclick="limpiarMarcador();" id="marcHis" data-toggle="modal" data-target=".bs-example-modal-modalRegistroMarcador" > Agregar + </a>
                                                    </div>
                                            </div>
                                            <div class="form-group row">
                                                  <div class="table-responsive" id="datAuditObsMarcadorCito" style="float: left;width:601px;padding: 10px;"> </div>
                                            </div>
                                            <div class="form-group row">
                                                    <div class="col-md-12 col-sm-6 ">
                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;margin-left: -9px;text-transform: uppercase;">Interpretación<span class="required">*</span>
                                                    </label>
                                                        <textarea class="form-control" rows="3" id="interpretacPato" name="interpretacPato" style="text-transform: uppercase;"></textarea>
                                                    </div>
                                            </div>
                                            <div class="form-group row">
                                                    <div class="col-md-12 col-sm-6 ">
                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;margin-left: -9px;text-transform: uppercase;">COMENTARIO<span class="required">*</span>
                                                    </label>
                                                        <textarea class="form-control" rows="3" id="comentarioPatol" name="comentarioPatol" style="text-transform: uppercase;"></textarea>
                                                    </div>
                                            </div>
                                            <div class="form-group row">
                                                    <div class="col-md-12 col-sm-6 ">
                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;margin-left: -9px;text-transform: uppercase;">NOTA<span class="required">*</span>
                                                    </label>
                                                        <textarea class="form-control" rows="3" id="notaPatol" name="notaPatol" style="text-transform: uppercase;"></textarea>
                                                    </div>
                                                    <input type="hidden" id="idReportPdf" name="idReportPdf" value="<?php echo $iduser ?>">
                                                   
                                            </div>
                                           
                    </div>
                                       <div class="form-group row">
                                                <br>
                                                <button type="button" class="btn btn-danger" id="GuardarPaciente" 
                                                    onclick="registroPacientePatologia3();" style="margin-left:46%;" tabindex="13">GUARDAR</button>
                                              
                                            </div>
                        </form>     
                                  
                                    
                                    
                            </div>
                      
            
                      
                      
                    </div>
                    <!-- end of accordion -->
                   
                   
                   
                 
                 
                 <!-- FIN DE 2 PESTAÑA -->
                </div>
                <div id="step-3" class="content" style="display: none;">
                    <h1 style="font-size: 17px;font-weight: 800;">MICROSCOPIA</h1><hr style="margin-top: 10px;">
                    <!--<div class="form-group row">
                    <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">CATEGORIA</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaqueteMicro" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListRoMicro();"> + Agregar</a>
                    </div>
                 </div>-->
                 
                
                 <div class="table-responsive" id="datExrRotMicro" style="float: left;"> </div>
                 
             <div id="espcialx">
                     
                 
                 
                   <h1 style="font-size: 17px;font-weight: 800;">LABORATORIO HISTOPATOLOGIA</h1><hr style="margin-top: 10px;">
                    <!--<div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">INCLUSION</label>
                         <div class="table-responsive" id="tblinclusion" > </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">CORTE</label>
                        <div class="table-responsive" id="tblcorte" > </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">COLORACION</label>
                        <div class="table-responsive" id="tblcoloracion" > </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">MONTAJE</label>
                        <div class="table-responsive" id="tblmontaje" > </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 14px;">ENTREGA</label>
                        <div class="table-responsive" id="tblentrega" > </div>
                    </div>-->
                    
                   
                   <!-- start accordion -->
                    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwoMicro" data-toggle="collapse" data-parent="#accordion1" href="#collapseTwoMicro" aria-expanded="false" aria-controls="collapseTwoMicro">
                          <h4 class="panel-title" style="font-weight: 700;">INCLUSION</h4>
                        </a>
                        <div id="collapseTwoMicro" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwoMicro" style="background: white !important;border: 1px solid #e5e7e9;">
                          <div class="panel-body">
                            <div class="table" id="tblinclusionMicro" > </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThreeMicro2" data-toggle="collapse" data-parent="#accordion1" href="#collapseThreeMicro" aria-expanded="false" aria-controls="collapseThreeMicro2">
                          <h4 class="panel-title" style="font-weight: 700;">CORTE</h4>
                        </a>
                        <div id="collapseThreeMicro" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThreeMicro2" style="background: white !important;border: 1px solid #e5e7e9;">
                          <div class="panel-body">
                            <div class="table" id="tblcorteMicro" > </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThreeMicro3" data-toggle="collapse" data-parent="#accordion1" href="#collapseFourMicro" aria-expanded="false" aria-controls="collapseThreeMicro3">
                          <h4 class="panel-title" style="font-weight: 700;">COLORACION</h4>
                        </a>
                        <div id="collapseFourMicro" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThreeMicro3" style="background: white !important;border: 1px solid #e5e7e9;">
                          <div class="panel-body">
                           <div class="table" id="tblcoloracionMicro" > </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThreeMicro4" data-toggle="collapse" data-parent="#accordion1" href="#collapseFiveMicro" aria-expanded="false" aria-controls="collapseThreeMicro4">
                          <h4 class="panel-title" style="font-weight: 700;">MONTAJE</h4>
                        </a>
                        <div id="collapseFiveMicro" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThreeMicro4" style="background: white !important;border: 1px solid #e5e7e9;">
                          <div class="panel-body">
                            <div class="table" id="tblmontajeMicro" > </div>
                          </div>
                        </div>
                      </div>
                       <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThreeMicro5" data-toggle="collapse" data-parent="#accordion1" href="#collapseSixMicro" aria-expanded="false" aria-controls="collapseThreeMicro5">
                          <h4 class="panel-title" style="font-weight: 700;">ENTREGA</h4>
                        </a>
                        <div id="collapseSixMicro" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThreeMicro5" style="background: white !important;border: 1px solid #e5e7e9;">
                          <div class="panel-body">
                            <div class="table" id="tblentregaMicro" > </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <br>
                     <h1 style="font-size: 17px;font-weight: 800;">HISTOQUIMICA | INMUNOHISTOQUIMICA </h1><hr style="margin-top: 10px;">
                     
                  <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmRegistroPacientePato4" 
                                            class="formulario form-horizontal form-label-left input_mask">
                     <div class="form-group row">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">¿Continuar análisis de la muestra?<span class="required">*</span>
                            </label>
                            <div class="col-md-2 col-sm-6 ">
                                <select class="form-control" name="anaMuestra" id="anaMuestra" required="required" tabindex="33"></select>
                                <input type="hidden" name="tipoRegPatolo2" id="tipoRegPatolo2" >
                                <input type="hidden" name="iduserPatol2" value="<?php echo $iduser ?>" id="iduserPatol2">
                                <input type="hidden" name="idPat2" value="<?php echo $idre ?>" id="idPat2">
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
                            <div class="col-md-2 col-sm-6 ">
                                <!--<input class="form-control" name="medicoSolcit2" id="medicoSolcit2" required="required" type="text">-->
                                <select class="form-control" name="medicoSolcit2" id="medicoSolcit2" required="required" tabindex="33"></select>
                            </div>
                            
                    </div>
                    <div class="form-group row">
                            
                            <div class="col-md-6 col-sm-6 ">
                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;margin-left: -9px;">Diagnóstico clínico</label>
                                <textarea class="form-control" rows="3"  name="dxClinicoHi2" id="dxClinicoHi2" style="width: 580px;" ></textarea>
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
                                <textarea class="form-control" rows="3" id="interpretacPato2" name="interpretacPato2"></textarea>
                            </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-md-12 col-sm-6 ">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;margin-left: -9px;text-transform: uppercase;">COMENTARIO<span class="required">*</span>
                            </label>
                                <textarea class="form-control" rows="3"  id="comentarioPatol2" name="comentarioPatol2"></textarea>
                            </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-md-12 col-sm-6 ">
                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;margin-left: -9px;text-transform: uppercase;">NOTA<span class="required">*</span>
                            </label>
                                <textarea class="form-control" rows="3"  id="notaPatol2" name="notaPatol2" ></textarea>
                                 <input type="hidden" id="idReportPdf" name="idReportPdf" value="<?php echo $iduser ?>">
                            </div>
                    </div>
                    <div class="form-group row">
                                    <div class="col-md-3 col-sm-6 ">
                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">CONFIRMADO POR:<span class="required">*</span>
                                        </label>
                                        <select class="form-control" name="nomApeConfirApepat" id="nomApeConfirApepat" required="required" tabindex="33"></select>
                                    </div>
                    </div>
                                                              
                        
            </div>
    
                         <div class="form-group row">
                            <br>
                            <button type="button" class="btn btn-success" id="GuardarPaciente"  onclick="registroPacientePatologia4();" style="" tabindex="13">Guardar</button>
                            <button type="button" class="btn btn-danger" id="abrirModal"  onclick="vistaPreviaAp();" style="" tabindex="13">Generar informe AP</button>
                            <button type="button" class="btn btn-warning" id="btnIhqHq" onclick="vistaPreviaIhqHq();" style="" tabindex="13" >Generar Informe</button>
                        </div>
                        
                </form>
                       
                </div>

                <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmRegistroPacientePato55" 
                                            class="formulario form-horizontal form-label-left input_mask">
                        <div class="form-group row hidden" id="muesCerEepsc">
                            <br>
                            <button type="button" class="btn btn-success" id="GuardarPaciente"  onclick="registroPacientePatologia55();" style="" tabindex="13">Guardar</button>
                            <button type="button" class="btn btn-warning" id="btnCerEspx" onclick="vistaPreviaCerEspx();" style="" tabindex="13" >Generar Informe</button>
                            <input type="hidden" name="idPat2222" value="<?php echo $idre ?>" id="idPat2222">
                        </div>
                  </form>
                    <!-- end of accordion -->
                    
               <!--<h1 style="font-size: 14px;font-weight: 800;">PROCESAMIENTO DE LA MUESTRA</h1><hr style="margin-top: 10px;">
                 <h1 style="font-size: 12px;font-weight: 800;">FASE 2</h1>
                 <div class="form-group row">
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 1: DILUIR</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 2: AÑADIR</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 3: INCUBAR</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 4: ENFRIAR</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 5: LAVAR CON PBS</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 6: DILUIR</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                 </div><hr>
                  <h1 style="font-size: 12px;font-weight: 800;">FASE 3</h1>
                 <div class="form-group row">
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 1: BLOQUEADOR</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 2: LAVADO DE LAMINA CON PBS</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 3: ANTIGENO</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 4: LAVADO CON PBS</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                 </div><hr>
                 <h1 style="font-size: 12px;font-weight: 800;">FASE 4</h1>
                 <div class="form-group row">
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 1: CONTRASTE</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 2: DESHIDRATACION</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">PASO 3: MANEJO DE LAMINAS Y ETIQUETADO</label>
                    <div class="col-md-1 col-sm-6 ">
                        <a class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-modalPaquete" id="agr2" role="button" aria-expanded="false"
                        style="float: right;background: #1ABB9C;border: 1px solid #1ABB9C;" onclick="limpiarListpaq();"> + Agregar</a>
                    </div>
                 </div><br>
                  <h1 style="font-size: 14px;font-weight: 800;">ENTREGA DE LAMINAS</h1><hr style="margin-top: 10px;">
                        <div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">FECHA</label>
                        <div class="col-md-2 col-sm-6 ">
                        <input type="date" id="first-name" required="required" class="form-control  ">
                        </div>
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">CODIGO</label>
                        <div class="col-md-2 col-sm-6 ">
                        <input type="text" id="last-name" name="last-name" required="required" class="form-control ">
                        </div>
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">IHQ</label>
                        <div class="col-md-4 col-sm-6 ">
                        <input type="text" id="last-name" name="last-name" required="required" class="form-control ">
                        </div>
                        </div>
                        <div class="form-group row">
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">HQ</label>
                        <div class="col-md-2 col-sm-6 ">
                        <input type="text" id="first-name" required="required" class="form-control  ">
                        </div>
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">MEDICO</label>
                        <div class="col-md-2 col-sm-6 ">
                        <input type="text" id="last-name" name="last-name" required="required" class="form-control ">
                        </div>
                        <label class="col-form-label col-md-1 col-sm-3 label-align" for="last-name"  style="text-align: right;margin-top: 4px;font-size: 11px;">FIRMA</label>
                        <div class="col-md-4 col-sm-6 ">
                        <input type="text" id="last-name" name="last-name" required="required" class="form-control ">
                        </div>
                        </div>-->
                        </div>
                                <div id="step-4" class="content" style="display: none;">
                                  <br>
                                    <div class="form-group row hidden">
                                            <label class="col-form-label col-md-1 col-sm-3 label-align" for="first-name" style="text-align: right;margin-top: 4px;font-size: 11px;">MUESTRA RECIBIDA<span class="required">*</span>
                                            </label>
                                            <div class="col-md-2 col-sm-6 ">
                                                <input type="text" id="first-name" required="required" class="form-control  ">
                                            </div>
                                            <div style="float: right;margin-right: 26px;">
                                                <a style="color: white;" target="_blank" href="https://segurosmedic.com/hnal/imprimir.php?id=27269">
                                                    <img style="width:26px;" src="images/pdf.png"></a>
                                            </div>
                                            
                                    </div>
                                    <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmRegistroPacienteCervicoVaginal" 
                                                    class="formulario form-horizontal form-label-left input_mask">
                                    <div class="container">
                                        <input type="hidden"  class="form-control" name="idCervico" id="idCervico" value="<?php echo $idre; ?>">
                                        <input type="hidden"  class="form-control" name="idUserCv" id="idUserCv" value="<?php echo $iduser; ?>">
                                          <div class="row">
                                            <div class="col-md-6" style="border-right: 1px solid #c5c5c5;">
                                                    <h1 style="font-size: 17px;font-weight: 800;">HISTORIA GINECOLOGICA</h1><hr style="margin-top: 10px;">
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          FECHA DE ULTIMA REGLA (FUR)<span class="required">*</span>
                                                                        </label>
                                                                        <input type="text"  class="form-control" name="fechaUltimaRegla" id="fechaUltimaRegla" required="required" tabindex="33">
                                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          EMBARAZADA<span class="required">*</span>
                                                                        </label>
                                                                        <select class="form-control" name="listEmbarazo" id="listEmbarazo" required="required" ></select>
                                                                    </div>
                                                    </div>
                                                     <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-8 col-sm-3 label-align" for="first-name" style=";margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          USO DE METODO ANTICONCEPTIVO<span class="required">*</span>
                                                                        </label>
                                                                        <select class="form-control" name="listMetodoAnti" id="listMetodoAnti" required="required" tabindex="33"></select>
                                                                    </div>
                                                    </div>
                                                    <div class="hidden" id="viewMetdo">
                                                                <div class="form-group row">
                                                                            <div class="col-md-9 col-sm-6 ">
                                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                                  TIPO DE METODO<span class="required">*</span>
                                                                                </label>
                                                                                <select class="form-control" name="listTipoMetodoAntic" id="listTipoMetodoAntic" required="required" tabindex="33"></select>
                                                                            </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                                <div class="col-md-9 col-sm-6 ">
                                                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                                      TIEMPO DE USO<span class="required">*</span>
                                                                                    </label>
                                                                                    <input class="form-control" name="TiempoUso" id="TiempoUso" required="required" tabindex="33">
                                                                                </div>
                                                                </div>
                                                    </div>
                                                    
                                                     <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          EXAMEN GINECOLOGICO<span class="required">*</span>
                                                                        </label>
                                                                        <select class="form-control" name="listExaGineco" id="listExaGineco" required="required" tabindex="33"></select>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-9 col-sm-6 " >
                                                                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 13px;font-size: 11px;margin-left: -3px;font-weight: 300;">Especifique</label>
                                                                            <textarea class="form-control" rows="2"  name="obsExamenGinec" id="obsExamenGinec" ></textarea>
                                                                        </div>
                                                                    </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-6" style="border-right: 1px solid #c5c5c5;">
                                                <h1 style="font-size: 17px;font-weight: 800;">RESPONSABLE: OBTENCION DE MUESTRAS</h1><hr style="margin-top: 10px;">
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                         NOMBRE<span class="required">*</span>
                                                                        </label>
                                                                        <input type="text"  class="form-control" name="nomObtencionMuestras" id="nomObtencionMuestras" required="required" tabindex="33">
                                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          PROFESION/CARGO<span class="required">*</span>
                                                                        </label>
                                                                        <input type="text"  class="form-control" name="profeCargo" id="profeCargo" required="required" tabindex="33">
                                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-9 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          FECHA DE OBTENCION DE MUESTRA<span class="required">*</span>
                                                                        </label>
                                                                        <input type="date"  class="form-control" name="fechaObtencMuestra" id="fechaObtencMuestra" required="required" tabindex="33">
                                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          COLPOSCOPIA<span class="required">*</span>
                                                                        </label>
                                                                            <input type="date"  class="form-control" name="fechaColoscopia" id="fechaColoscopia" required="required" tabindex="33">
                                                                    </div>
                                                                      <div class="form-group row">
                                                                        <div class="col-md-9 col-sm-6 " >
                                                                            <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 13px;font-size: 11px;margin-left: -3px;font-weight: 300;">Especifique</label>
                                                                            <textarea class="form-control" rows="2"  name="especifColoscopia" id="especifColoscopia" ></textarea>
                                                                        </div>
                                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          5. DIAGNOSTICO ANTERIOR<span class="required">*</span>
                                                                        </label>
                                                                        <input type="text"  class="form-control" name="dxAnterior" id="dxAnterior" required="required" tabindex="33">
                                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-9 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          6. FECHA DEL DIAGNOSTICO ANTERIOR<span class="required">*</span>
                                                                        </label>
                                                                        <input type="date"  class="form-control" name="fechadxAnterior" id="fechadxAnterior" required="required" tabindex="33">
                                                                    </div>
                                                    </div>
                                            </div>
                                          </div>
                                    </div>
                                    <h1 style="font-size: 17px;font-weight: 800;">INFORME DE DIAGNOSTICO CITOLOGICO CERVICO UTERINO</h1><hr style="margin-top: 10px;">
                                      <div class="container">
                                          <div class="row">
                                            <div class="col-md-6" style="border-right: 1px solid #c5c5c5;">
                                                        
                                                        <div class="form-group row">
                                                                
                                                                <div class="col-md-9 col-sm-6 ">
                                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                      1. CALIDAD DEL ESPÉCIMEN<span class="required">*</span>
                                                                    </label>
                                                                    <select class="form-control" name="calidEspec" id="calidEspec" required="required" tabindex="33"></select>
                                                                </div>
                                                        </div>
                                                         
                                                        <div class="form-group row">
                                                            <div class="col-md-9 col-sm-6 ">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;margin-left: -9px;">ESPECIFIQUE</label>
                                                                <select class="form-control" name="especifiqueCalidadEspec" id="especifiqueCalidadEspec" required="required" tabindex="33">
                                                                        <option value="">Seleccionar</option>
                                                                        <option value="CON CELULAS ENDOCERVICALES">CON CELULAS ENDOCERVICALES</option>
                                                                        <option value="SIN CELULAS ENDOCERVICALES">SIN CELULAS ENDOCERVICALES</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="form-group row">
                                                                
                                                                <div class="col-md-9 col-sm-6 ">
                                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                    2. CLASIFICACION GENERAL<span class="required">*</span>
                                                                    </label>
                                                                    <select class="form-control" name="clasificacionGen" id="clasificacionGen" required="required" tabindex="33"></select>
                                                                </div>
                                                        </div>
                                                         
                                                        <div class="form-group row">
                                                            <div class="col-md-9 col-sm-6 ">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;margin-left: -9px;">ESPECIFIQUE</label>
                                                                <textarea class="form-control" rows="2"  name="EspecclasificacionGen" id="EspecclasificacionGen"  ></textarea>
                                                            </div>
                                                        </div>
                                                         <div class="form-group row">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                    3. INTERPRETACION DESCRIPTIVA<span class="required">*</span>
                                                                </label>
                                                        </div>
                                                        <div class="form-group row">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 370px;margin-top: 4px;font-size: 10px;text-transform: uppercase;font-weight: 500;">
                                                                    3.1 ANORMALIDADES DE CELULAS EPITELIALES<span class="required">*</span>
                                                                </label>
                                                        </div>
                                                        <div class="form-group row">
                                                                
                                                                <div class="col-md-9 col-sm-6 ">
                                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;font-weight: 400;margin-left: -9px;">
                                                                      3.1.1. Células escamosas<span class="required">*</span>
                                                                    </label>
                                                                    <select class="form-control" name="celulasEscamosas" id="celulasEscamosas" required="required" tabindex="33"></select>
                                                                </div>
                                                        </div>
                                                         <div class="form-group row">
                                                            <div class="col-md-9 col-sm-6 ">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;font-weight: 400;margin-left: -9px;">Especifique</label>
                                                                <textarea class="form-control" rows="2"  name="especelulasEscamosas" id="especelulasEscamosas"  ></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                                
                                                                <div class="col-md-9 col-sm-6 ">
                                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;font-weight: 400;margin-left: -9px;">
                                                                      3.1.2. Células glandulares<span class="required">*</span>
                                                                    </label>
                                                                    <select class="form-control" name="celGlandu" id="celGlandu" required="required" tabindex="33"></select>
                                                                </div>
                                                        </div>
                                                         <div class="form-group row">
                                                            <div class="col-md-9 col-sm-6 ">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;font-weight: 400;margin-left: -9px;">Especifique</label>
                                                                <textarea class="form-control" rows="2"  name="espeCelGlandu" id="espeCelGlandu"  ></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                
                                            </div>
                                            <div class="col-md-6">
                                                            
                                                        <div class="form-group row">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 370px;margin-top: 4px;font-size: 10px;font-weight: 500;">
                                                                    3.2 OTRAS NEOPLASIAS MALIGNAS (Especifique)<span class="required">*</span>
                                                                </label>
                                                        </div>
                                                         <div class="form-group row">
                                                            <div class="col-md-9 col-sm-6 ">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;font-weight: 400;margin-left: -9px;">ESPECIFIQUE</label>
                                                                <textarea class="form-control" rows="2"  name="otrNeoMalig" id="otrNeoMalig"  ></textarea>
                                                            </div>
                                                        </div>
                                                         <div class="form-group row">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 370px;margin-top: 4px;font-size: 10px;text-transform: uppercase;font-weight: 500;">
                                                                    3.3 CAMBIO CELULARES BENIGNOS<span class="required">*</span>
                                                                </label>
                                                        </div>
                                                        <div class="form-group row">
                                                                
                                                                <div class="col-md-9 col-sm-6 ">
                                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;margin-left: -10px;font-weight: 400;">
                                                                      3.3.1. Cambios asociados a:<span class="required">*</span>
                                                                    </label>
                                                                    <select class="form-control" name="celulBenignos" id="celulBenignos" required="required" tabindex="33"></select>
                                                                </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-9 col-sm-6 ">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;font-weight: 400;margin-left: -9px;">Especifique tipo de microorganismo</label>
                                                                <textarea class="form-control" rows="2"  name="especifTipoOrg" id="especifTipoOrg"  ></textarea>
                                                            </div>
                                                        </div>
                                                         <div class="form-group row">
                                                                
                                                                <div class="col-md-9 col-sm-6 ">
                                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;margin-left: -10px;font-weight: 400;">
                                                                      3.3.2. Cambios reactivos asociados a:<span class="required">*</span>
                                                                    </label>
                                                                    <select class="form-control" name="cambioReactivos" id="cambioReactivos" required="required" tabindex="33"></select>
                                                                </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-9 col-sm-6 ">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;font-weight: 400;margin-left: -9px;">Especifique</label>
                                                                <textarea class="form-control" rows="2"  name="espeCambioReac" id="espeCambioReac"  ></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 370px;margin-top: 4px;font-size: 11px;text-transform: uppercase;font-weight: 700;">
                                                                    4 VALORACION HORMONAL<span class="required">*</span>
                                                                </label>
                                                        </div>
                                                        <div class="form-group row">
                                                                
                                                                <div class="col-md-9 col-sm-6 ">
                                                                    <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;margin-left: -10px;font-weight: 400;">
                                                                      4.1. Patrón hormonal:<span class="required">*</span>
                                                                    </label>
                                                                    <select class="form-control" name="patronHormonal" id="patronHormonal" required="required" tabindex="33"></select>
                                                                </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-9 col-sm-6 ">
                                                                <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;font-weight: 400;margin-left: -9px;">Especifique</label>
                                                                <textarea class="form-control" rows="2"  name="especifPatronHor" id="especifPatronHor"  ></textarea>
                                                            </div>
                                                        </div>
                                                
                                            </div>
                                    </div>
                                          
                                      </div>
                                      <div class="container">
                                          <div class="row">
                                            <div class="col-md-6" style="border-right: 1px solid #c5c5c5;">
                                                    <h1 style="font-size: 17px;font-weight: 800;">CONCLUSIONES Y SUGERENCIAS</h1><hr style="margin-top: 10px;">
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          1. CONCLUSIONES<span class="required">*</span>
                                                                        </label>
                                                                        <textarea class="form-control" rows="2"  name="txtAreaConclusiones" id="txtAreaConclusiones"  ></textarea>
                                                                      
                                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          2. OBTENER NUEVA MUESTRA<span class="required">*</span>
                                                                        </label>
                                                                       <!-- <input type="date"  class="form-control" name="fechaConcySuger" id="fechaConcySuger" required="required" tabindex="33">-->
                                                                        <select  class="form-control" name="fechaConcySuger" id="fechaConcySuger"  >
                                                                             <option value="">Seleccionar</option>
                                                                            <option value="SI">SI</option>
                                                                            <option value="NO">NO</option>
                                                                        </select>
                                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-9 col-sm-3 label-align" for="first-name" style="margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          3. DIAGNOSTICO REALIZADO EN LABORATORIO<span class="required">*</span>
                                                                        </label>
                                                                        <input type="text" class="form-control" name="dxRealizadoLab" id="dxRealizadoLab" required="required" tabindex="33">
                                                                    </div>
                                                    </div>
                                                    
                                                     <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          4. FECHA<span class="required">*</span>
                                                                        </label>
                                                                        <input class="form-control" type="date" name="fechalab" id="fechalab" required="required" tabindex="33">
                                                                    </div>
                                                    </div>
                                                    
                                            </div>
                                            <div class="col-md-6" style="border-right: 1px solid #c5c5c5;">
                                                     <h1 style="font-size: 17px;font-weight: 800;">DATOS DEL PERSONAL RESPONSABLE</h1><hr style="margin-top: 10px;">
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          1. NOMBRES Y APELLIDOS<span class="required">*</span>
                                                                        </label>
                                                                        <input type="text"  class="form-control" name="datosResposanble" id="datosResposanble" required="required" tabindex="33">
                                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          2. COLEGIATURA<span class="required">*</span>
                                                                        </label>
                                                                        <input type="text"  class="form-control" name="colegioResp" id="colegioResp" required="required" tabindex="33">
                                                                    </div>
                                                    </div>
                                                    <h1 style="font-size: 17px;font-weight: 800;">CONFIRMADO POR:</h1><hr style="margin-top: 10px;">
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          1. NOMBRES Y APELLIDOS<span class="required">*</span>
                                                                        </label>
                                                                        <select class="form-control" name="nomApeConfir" id="nomApeConfir" required="required" tabindex="33"></select>
                                                                    </div>
                                                    </div>
                                                    <div class="form-group row">
                                                                    <div class="col-md-9 col-sm-6 ">
                                                                        <label class="col-form-label col-md-2 col-sm-3 label-align" for="first-name" style="width: 212px;margin-top: 4px;font-size: 11px;text-transform: uppercase;">
                                                                          2. COLEGIATURA<span class="required">*</span>
                                                                        </label>
                                                                        <input type="text"  class="form-control" name="colegConfirma" id="colegConfirma" required="required" tabindex="33">
                                                                    </div>
                                                    </div>
                                                    
                                                  
                    
                                            </div>
                                          </div>
                                          
                                            <div class="form-group row">
                
                                                        <br>
                                                        <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="registroPacienteCervicoVaginal('Los datos se guardaron correctamente.');" 
                                                        style="margin-left:30%;" tabindex="13">Guardar</button>
                                                        <button type="button" class="btn btn-success" id="GuardarPacisaente" onclick="registroPacienteCervicoVaginalId();" 
                                                         tabindex="13">Generar Informe CV</button>
                                            </div>
                                     </div>
                                    </form>
                                    <!---  FIN DIV -->
                                </div>
                                
                            </div>
                         </div>
                        </div>
                        
                        </div>
                        </div>
                        </div>
                              </div>
                            </div>
                         </div>


                  
                  </div>
        </div>

        
          <!-- INICIO -->
           <div class="modal fade bs-example-modal-modalPaquete" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="titleMoal"></h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formRotulo" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ideRo" id="ideRo">
                                                    

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs hidden" role="tablist">
                                          <li role="presentation" class="active" id="idDat"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">DATOS</a>
                                          </li>
                                          <li role="presentation" class="hidden" id="idPad"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">PADRES</a>
                                          </li>
                                          <li role="presentation" class="hidden" id="idArch"><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">ARCHIVOS</a>
                                          </li>
                                          <li role="presentation" style="float: right;" class="MostrarCo hidden" id="MosPac">
                                          </li>
                                        </ul>
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                                           
                                                      <br>

                                                         <div class="form-group hidden" id="divcalidadMuesCitoEsp">
                                                                    <!-- Guardado de descripcion -->
                                                                    <div class="col-md-3 col-sm-12 col-xs-12">
                                                                      <label class="control-label col-md-11 col-sm-3 col-xs-12" style="text-align: left;">CALIDAD DE MUESTRA</label>
                                                                      <!--<input type="text" name="calidadMuesCitoEsp" id="calidadMuesCitoEsp" class="form-control" style="text-transform: uppercase;">-->
                                                                      <select class="form-control" name="calidadMuesCitoEsp" id="calidadMuesCitoEsp"  style="text-transform: uppercase;" required="required" tabindex="17">
                                                                          <option value="0">Seleccionar</option>
                                                                          <option value="1">Insatisfactorio</option>
                                                                          <option value="2">Limitado</option>
                                                                          <option value="3">Satisfactorio</option>
                                                                        </select>
                                                                    </div>
                                                              </div>
                                            
                                                      <div class="form-group">
                                                              
                                                        
                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12">CATEGORIA</label>
                                                                   <!--<input type="text" name="categoria" id="categoria" class="form-control" placeholder="Autocompletado" style="text-transform: uppercase;">-->
                                                                    <select class="form-control" name="categoria" id="categoria" required="required" tabindex="17"></select>
                                                                    <input type="hidden" name="idcateg" id="idcateg" >
                                                                    <input type="hidden" name="tipoDecrp" id="tipoDecrp" >
                                                                    <input type="hidden" name="formatoPatologiaMac" id="formatoPatologiaMac" >
                                                                    <input type="hidden" name="filtroTipoEst" id="filtroTipoEst" >
                                                                    <input type="hidden" name="idRegRot" id="idRegRot" value="<?php echo $idre; ?>" >
                                                                </div>
                                                               
                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                   <label class="control-label col-md-8 col-sm-3 col-xs-12" style="text-align: left;">SUB CATEGORIA</label>
                                                                  <!-- <input type="text" name="rotulo" id="rotulo" class="form-control" placeholder="Autocompletado">-->
                                                                   <select class="form-control" name="rotulo" id="rotulo" required="required" tabindex="17">
                                                                  </select>
                                                                </div>
                                                                
                                                                
                                                                <div class="col-md-3 col-sm-12 col-xs-12" id="inputTac">
                                                                        <label class="control-label col-md-1 col-sm-3 col-xs-12" id="lbltac">PLANTILLA</label>
                                                                        <select class="form-control" name="plantillaApe" id="plantillaApe" required="required" tabindex="17">
                                                                        </select>
                                                                </div>
                                                      </div>
                                                       <div class="form-group" id="descDiv">
                                                            <!-- Guardado de descripcion -->
                                                            <div class="col-md-11 col-sm-12 col-xs-12">
                                                              <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: left;">DESCRIPCION</label>
                                                              <textarea class="form-control" name="descrRot" id="descrRot" rows="3" style="text-transform: uppercase;" tabindex="12"></textarea>
                                                              
                                                            </div>
                                                       </div>

                                                       <div class="form-group hidden" id="NuevoSlects">
                                                              
                                                        
                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                    <label class="control-label col-md-2 col-sm-3 col-xs-12" style="width: 146px;">SISTEMA REPORTE</label>
                                                                   <!--<input type="text" name="categoria" id="categoria" class="form-control" placeholder="Autocompletado" style="text-transform: uppercase;">-->
                                                                    <select class="form-control" name="hallazgo" id="hallazgo" required="required" tabindex="17" style="text-transform: uppercase;"></select>
                                                                    
                                                                </div>
                                                               
                                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                                   <label class="control-label col-md-8 col-sm-3 col-xs-12" style="text-align: left;">TEJIDO/ORGANO</label>
                                                                  <!-- <input type="text" name="rotulo" id="rotulo" class="form-control" placeholder="Autocompletado">-->
                                                                   <select class="form-control" name="sisReporEspex" id="sisReporEspex" required="required" tabindex="17">
                                                                  </select>
                                                                </div>
                                                                
                                                                
                                                                <div class="col-md-3 col-sm-12 col-xs-12" id="inputTac">
                                                                        <label class="control-label col-md-1 col-sm-3 col-xs-12" id="lbltac">CLASIFICACION</label>
                                                                        <select class="form-control" name="clasisEspec" id="clasisEspec" required="required" tabindex="17">
                                                                        </select>
                                                                </div>
                                                      </div>
                                                      <div class="form-group " id="NuevoTablesFrm">
                                                                                                                              
                                                                    <label class="control-label col-md-12 col-sm-3 col-xs-12" style="text-align: left;">DIAGNÓSTICO MORFOLÓGICO
                                                                    <i class="fa fa-plus-square" data-toggle="modal" data-target=".bs-example-modal-modalObservCptsCito"  onclick="vercodigMor()" style="font-size: 22px;cursor: pointer;"></i></label>
                                                                    <div class="table-responsive" id="tableDxMorf" style="float: left;"> </div>
                                                                                                                                 
                                                                
                                                      </div>
                                                       
                                                        <div class="form-group" id="">
                                                            <!-- Guardado de descripcion -->
                                                            <div class="col-md-11 col-sm-12 col-xs-12">
                                                               <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: left;">DIGITADO POR</label>
                                                               <input type="text" name="lblUserDecri" id="lblUserDecri" class="form-control" style="text-transform: uppercase;">
                                                            </div>
                                                       </div>
                                                      
                                                        <div class="form-group" id="viewCorte">
                                                            <!-- Guardado de descrin -->
                                                            <div class="col-md-11 col-sm-12 col-xs-12">
                                                                <label class="control-label col-md-2 col-sm-3 col-xs-12" style="text-align: left;" id="titleCortus">CORTES</label>
                                                              <textarea class="form-control" name="cortesRot" id="cortesRot" rows="3" style="text-transform: uppercase;" tabindex="12"></textarea>
                                                            </div>
                                                           
                                                       </div>
                                                        <div class="form-group" id="f">
                                                             
                                                                <div class="col-md-2 col-sm-12 col-xs-12" id="inputTac">
                                                                    <label class="control-label col-md-10 col-sm-3 col-xs-12" style="text-align: left;" id="titleTxus">N° TACOS</label>
                                                                    <input type="text" name="tacos" id="tacos" class="form-control  ">
                                                                </div>
                                                       </div>
                                                      <!--<div class="form-group">
                                                        <label for="title" class="col-sm-2 control-label">AUDITOR</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control" name="asiAudi" id="asiAudi" style="text-transform: uppercase;" required="required" tabindex="8">
                                                            </select>
                                                        </div>
                                                      </div>-->
                                                     
                                                        <Hr>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrRotulo();" style="float: right;margin-bottom: 4%;" tabindex="13">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrRot">CERRAR</button>
                                                       </div>
                                                     </div>
                                                 </div>
                                              </div>
                                                    
                                         </form>

                                          </div>
                                    </div>   
          </div>
          
          <!-- MODAL CREADO MANUAL AP-->
            
                <div id="ventanaModalIhqHq" class="modale">
                    <div class="contenido-modal" style="text-align: center;">
                        <span class="cerrar hidden">&times;</span>
                        <h2 style="font-size: 16px;">¿Estas seguro que desea generar el informe?. No podrá realizar ninguna modificación.</h2>
                        <br><br>
                        <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="generarInformeHistoInmunoGen();" style="" 
                        tabindex="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        <a id="btnIhqHqModal"  class="btn btn-success" target="blank" > Vista previa</a>
                    <!--<button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="generarInformeHiddddddstoInmuno();" style="" tabindex="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        <a  class="btn btn-success" href="#"> Vista previa</a>-->
                    </div>
                </div>

                <div id="ventanaModalCerEspec" class="modale">
                    <div class="contenido-modal" style="text-align: center;">
                        <span class="cerrar hidden">&times;</span>
                        <h2 style="font-size: 16px;">¿Estas seguro que desea generar el informe?. No podrá realizar ninguna modificación.</h2>
                        <br><br>
                        <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="generarInformeCervEspex();" style="" 
                        tabindex="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        <a id="btnIhqHqModalCerEspec"  class="btn btn-success" target="blank" > Vista previa</a>
                    <!--<button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="generarInformeHiddddddstoInmuno();" style="" tabindex="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        <a  class="btn btn-success" href="#"> Vista previa</a>-->
                    </div>
                </div>
          <!-- FIN MODAL CREADO MANUAL -->
          
          
          <!-- MODAL CREADO MANUAL-->
            
                <div id="ventanaModal" class="modale">
                    <div class="contenido-modal" style="text-align: center;">
                        <span class="cerrar hidden">&times;</span>
                        <h2 style="font-size: 16px;">¿Estas seguro que desea generar el informe?. No podrá realizar ninguna modificación.</h2>
                        <br><br>
                        <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="generarInformeHistoInmuno();" style="" tabindex="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        <a  class="btn btn-success" target="blank"   href="http://seguros.hloayza.local/pdfAnatomoPatologicoVistaPrevia.php?id=<?php echo $idre ?>"> Vista previa</a>
                    <!--<button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="generarInformeHiddddddstoInmuno();" style="" tabindex="13">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        <a  class="btn btn-success" href="#"> Vista previa</a>-->
                    </div>
                </div>
          <!-- FIN MODAL CREADO MANUAL -->
          <!-- INICIO -->
           <div class="modal fade bs-example-modal-modalPaqueteMicro" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="titleMoalMicro"></h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formRotulo" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ideRo" id="ideRo">
                                                    

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs hidden" role="tablist">
                                          <li role="presentation" class="active" id="idDat"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">DATOS</a>
                                          </li>
                                          <li role="presentation" class="hidden" id="idPad"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">PADRES</a>
                                          </li>
                                          <li role="presentation" class="hidden" id="idArch"><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">ARCHIVOS</a>
                                          </li>
                                          <li role="presentation" style="float: right;" class="MostrarCo hidden" id="MosPac">
                                          </li>
                                        </ul>
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                                           
                                                      <br>
                                            
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">CATEGORIA</label>
                                                        <div class="col-md-4 col-sm-12 col-xs-12">
                                                          
                                                           <input type="text" name="ro" id="roto" class="form-control" placeholder="Autocompletado">
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">SUB CATEGORIA</label>
                                                        <div class="col-md-2 col-sm-12 col-xs-12">
                                                          
                                                           <input type="text" name="roa" id="roulo" class="form-control" placeholder="Autocompletado">
                                                        </div>
                                                        
                                                        <label class="control-label col-md-1 col-sm-3 col-xs-12" id="lbltac">TACOS</label>
                                                        <div class="col-md-1 col-sm-12 col-xs-12" id="inputTac">
                                                            <input type="text" name="tacosx" id="tacosx" class="form-control  ">
                                                        </div>
                                                      </div>
                                                      <div class="form-group" id="descDiv">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">DESCRIPCION</label>
                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                              <textarea class="form-control" name="descrRotx" id="descrRotx" rows="3" style="text-transform: uppercase;" tabindex="12"></textarea>
                                                            </div>
                                                       </div>
                                                       
                                                      <!--<div class="form-group">
                                                        <label for="title" class="col-sm-2 control-label">AUDITOR</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control" name="asiAudi" id="asiAudi" style="text-transform: uppercase;" required="required" tabindex="8">
                                                            </select>
                                                        </div>
                                                      </div>-->
                                                     
                                                        <Hr>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrRotulo();" style="float: right;margin-bottom: 4%;" tabindex="13">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrRot">CERRAR</button>
                                                       </div>
                                                     </div>
                                                 </div>
                                              </div>
                                                    
                                         </form>

                                          </div>
                                    </div>   
          </div>
          
          <div class="modal fade bs-example-modal-modalObservCptsCito" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">

                                <div class="modal-header" style="background:red;color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">DIAGNOSTICOS</h4>
                                </div>
                                <div class="modal-body">
                        
                                  <form class="formulario form-horizontal form-label-left input_mask" method="POST" id="frmCptsCitoEs">
                                   
                                                  <input type="hidden" name="idProcedCito" id="idProcedCito">
                                
                                                 
                                                 <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" style="font-size: 12px;width: 54px;">CIE-O</label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12"  style="margin-left: 38px;">
                                                             <input class="form-control" id="cptCitoEs" name="cptCitoEs" type="text">
                                                          </div>
                                                          <br>
                                                 </div>
                                                 <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" style="font-size: 12px;">DESCRIPCION</label>
                                                          <div class="col-md-10 col-sm-12 col-xs-12"  style="margin-left: 46px;">
                                                              <textarea class="form-control"  name="descrEspecCito" id="descrEspecCito" rows="3" style="text-transform: uppercase;"></textarea>
                                                          </div>
                                                          <br>
                                                 </div>
                                                 <div class="form-group">
                                                    <label class="control-label col-md-1 col-sm-3 col-xs-12" style="font-size: 12px;width: 69px;">TIPO DX</label>
                                                          <div class="col-md-10 col-sm-12 col-xs-12"  style="margin-left:25px;">
                                                                <select class="form-control"  name="selecCitoEspec" id="selecCitoEspec" >
                                                                      <option value="0">Seleccionar</option>
                                                                      <option value="REPETITIVO">REPETITIVO</option>
                                                                      <option value="PRESUNTIVO">PRESUNTIVO</option>
                                                                      <option value="DEFINITIVO">DEFINITIVO</option>
                                                                </select>
                                                          </div>
                                                          <br>
                                                 </div>
                                                 
                                                <div class="form-group" style="float: right;margin-top: 20px;">
                                                        <button type="button" class="btn btn-success btn-xs" id="masExamen" onclick="agregarCptsCitoEspec();"><i class="fa fa-save"></i> Agregar</button>                                      
                                                        <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerraObsverPax">CERRAR</button>
                                                </div>
                                              

                                  </form>
                                </div>
                               
                           </div>
                    </div>
                  </div>
        <!-- fin modal OBSERVACIONES -->
          <!-- INICIO -->
           <div class="modal fade bs-example-modal-modalResptaMicroObsMicro" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="tit">OBSERVACION MICROSCOPIA</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmObsMicro" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ideMicroObs" id="ideMicroObs">
                                                    

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                                           
                                                      <br>
                                                      <div class="form-group" id="descDiv">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">RESPUESTA</label>
                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                              <textarea class="form-control" name="obsMicrotextArea" id="obsMicrotextArea" rows="3" style="text-transform: uppercase;" tabindex="12"></textarea>
                                                            </div>
                                                       </div>
                                                        <hr>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="obsMicroFrm();" style="float: right;margin-bottom: 4%;" tabindex="13">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrRotRsptDelete">CERRAR</button>
                                                       </div>
                                                     </div>
                                                 </div>
                                              </div>
                                                    
                                         </form>

                                          </div>
                                    </div>   
          </div>
          
          <!-- INICIO -->
          
          <!-- INICIO -->
           <div class="modal fade bs-example-modal-modalResptaMicro" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="tit">RESPUESTA MICROSCOPIA</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmRsptaMicro" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ideRoT" id="ideRoT">
                                                    

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                                           
                                                      <br>
                                            
                                                     
                                                      <div class="form-group" id="descDiv">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">RESPUESTA</label>
                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                              <textarea class="form-control" name="rsptaMic" id="rsptaMic" rows="3" style="text-transform: uppercase;" tabindex="12"></textarea>
                                                            </div>
                                                       </div>
                                                       
                                                     
                                                     
                                                        <Hr>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="rsptaMicro();" style="float: right;margin-bottom: 4%;" tabindex="13">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrRotRspt">CERRAR</button>
                                                       </div>
                                                     </div>
                                                 </div>
                                              </div>
                                                    
                                         </form>

                                          </div>
                                    </div>   
          </div>
          
          <!-- INICIO -->
          
           <!-- INICIO -->
           <div class="modal fade bs-example-modal-modalOsbMacrox" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="tit">OBSERVACION</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmRsptaMacro" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ideRoTMacro" id="ideRoTMacro">
                                                    

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                                           
                                                      <br>
                                            
                                                     
                                                      <div class="form-group" id="descDiv">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">RESPUESTA</label>
                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                              <textarea class="form-control" name="rsptaMacro" id="rsptaMacro" rows="3" style="text-transform: uppercase;" tabindex="12"></textarea>
                                                            </div>
                                                       </div>
                                                       
                                                     
                                                     
                                                        <Hr>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="rsptaMacroObs();" style="float: right;margin-bottom: 4%;" tabindex="13">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrRotRsptMacro">CERRAR</button>
                                                       </div>
                                                     </div>
                                                 </div>
                                              </div>
                                                    
                                         </form>

                                          </div>
                                    </div>   
          </div>
          
          <!-- INICIO -->
           <div class="modal fade bs-example-modal-modalObsroLab" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                            <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                            <h4 class="modal-title" id="tit">OBSERVACION MICROSCOPIA</h4>
                        </div>
                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmObsMicroLabMij" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ideRoTLabMicro" id="ideRoTLabMicro">
                                                    <input type="hidden" name="tipoLabMicor" id="tipoLabMicor">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                                           
                                                      <br>
                                                      <div class="form-group" id="descDiv">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">RESPUESTA</label>
                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                              <textarea class="form-control" name="rsptObsLabMij" id="rsptObsLabMij" rows="3" style="text-transform: uppercase;" tabindex="12"></textarea>
                                                            </div>
                                                       </div>
                                                        <Hr>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="obsMicroLabMix();" style="float: right;margin-bottom: 4%;" tabindex="13">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrRotRsptLabCeMix">CERRAR</button>
                                                       </div>
                                                     </div>
                                                 </div>
                                              </div>
                                                    
                                         </form>

                                          </div>
                                    </div>   
          </div>
          
           <!-- INICIO -->
          <div class="modal fade bs-example-modal-modalRegistroMarcador" tabindex="-1" id="myModalIngApModalonclick" role="dialog" >
                    <div class="modal-dialog modal-lg" style="width: 30%;">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="titleModalM">MARCADORES</h4>
                                </div>

                        <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmMarcadorHisto" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser"  id="iduser" value="<?php echo $iduser ?>">
                                                     <input type="hidden" name="idPakMar"  id="idPakMar">
                                                   
                                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                                <div id="myTabContent" class="tab-content">
                                                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                                            <div class="form-group ">
                                                                <label class="control-label col-md-2 col-sm-3 col-xs-12" id="titleLblMa">MARCADOR</label>
                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                      <input class="form-control" name="marcList" id="marcList" required="required" type="text" style="text-transform: uppercase;">
                                                                      <input class="form-control" name="fomaCervi" id="fomaCervi" type="hidden">
                                                                      <input class="form-control" name="tipoEsCervi" id="tipoEsCervi" type="hidden">
                                                                      <input class="form-control" name="idPrin" id="idPrin" type="hidden">
                                                                </div>
                                                              </div>
                                                              <div class="form-group" id="resuNorm">
                                                                     <label class="control-label col-md-2 col-sm-3 col-xs-12">RESULTADO</label>
                                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                                          <textarea class="form-control" name="resultMarcax" id="resultMarcax" rows="3" style="text-transform: uppercase;" tabindex="3"></textarea>
                                                                      </div>
                                                              </div>
                                                              
                                                              <div id="" class="">
                                                                  
                                                              
                                                                              <div class="form-group hidden" id="inum">
                                                                                     <label class="control-label col-md-2 col-sm-3 col-xs-12">RESULTADO</label>
                                                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                          <select class="form-control" name="resulDepend" id="resulDepend" style="text-transform: uppercase;" tabindex="3"></select>
                                                                                      </div>
                                                                              </div>
                                                                              <div class="form-group hidden" id="intenHid">
                                                                                     <label class="control-label col-md-8 col-sm-3 col-xs-12" style="text-align: left;">INTENSIDAD TINCIÓN</label>
                                                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                          <select class="form-control" name="intesTincion" id="intesTincion" style="text-transform: uppercase;" tabindex="3"></select>
                                                                                      </div>
                                                                              </div>
                                                                              <div class="form-group hidden">
                                                                                     <label class="control-label col-md-8 col-sm-3 col-xs-12" style="text-align: left;">SCORE</label>
                                                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                          <input class="form-control" name="scoreInten" id="puntuaCionHin" style="text-transform: uppercase;" readonly="readonly">
                                                                                      </div>
                                                                              </div>
                                                                              <div class="form-group hidden" id="hiddeNucel">
                                                                                     <label class="control-label col-md-8 col-sm-3 col-xs-12" style="text-align: left;">% NUCLEOS POSITIVOS</label>
                                                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                          <select class="form-control" name="nucleosPos" id="nucleosPos" style="text-transform: uppercase;" tabindex="3"></select>
                                                                                      </div>
                                                                              </div>
                                                                              <div class="form-group hidden">
                                                                                     <label class="control-label col-md-8 col-sm-3 col-xs-12" style="text-align: left;">SCORE</label>
                                                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                          <input class="form-control" name="scoreNucleos" id="scoreNucleos" style="text-transform: uppercase;" readonly="readonly">
                                                                                      </div>
                                                                              </div>
                                                                              <div class="form-group hidden" id="hiddenPunt">
                                                                                     <label class="control-label col-md-8 col-sm-3 col-xs-12" style="text-align: left;">PUNTUACION</label>
                                                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                          <input class="form-control" name="subtotalPun" id="subtotalPun" style="text-transform: uppercase;" readonly="readonly" >
                                                                                      </div>
                                                                              </div>
                                                                               <div class="form-group hidden" id="hidInterp">
                                                                                     <label class="control-label col-md-8 col-sm-3 col-xs-12" style="text-align: left;">INTERPRETACION</label>
                                                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                          <input class="form-control" name="interpretHi" id="interpretHi" style="text-transform: uppercase;" readonly="readonly" >
                                                                                      </div>
                                                                              </div>
                                                                              <div class="form-group hidden" id="otrosHi">
                                                                                     <label class="control-label col-md-1 col-sm-3 col-xs-12" id="lblOtroHx">OTROS</label>
                                                                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                          <textarea class="form-control" name="otMos" id="otMos" rows="3" style="text-transform: uppercase;" tabindex="3"></textarea>
                                                                                      </div>
                                                                              </div>
                                                              </div>
                                                              <button type="button" class="btn btn-danger" id="das" onclick="registroPaqueteMarcador();" style="float: right;margin-bottom: 4%;" tabindex="18">GUARDAR</button>                                      
                                                              <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarFrmPakMarcador">CERRAR</button>
                                                    </div> 
                                                </div>
                                        </div>
                                </div>
                        </form>
              </div> 
          </div>
        </div>
        <!--FIN GRUPO -->
        
        
        
          <!-- INICIO -->
           <div class="modal fade bs-example-modal-modalResptaMicroLab" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="tit">RESPUESTA MICROSCOPIA</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmRsptaMicroLab" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ideRoTLab" id="ideRoTLab">
                                                    <input type="hidden" name="tipoLab" id="tipoLab">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                                           
                                                      <br>
                                                      <div class="form-group" id="descDiv">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">RESPUESTA</label>
                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                              <textarea class="form-control" name="rsptaMicLab" id="rsptaMicLab" rows="3" style="text-transform: uppercase;" tabindex="12"></textarea>
                                                            </div>
                                                       </div>
                                                      
                                                        <Hr>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="rsptaMicroLab();" style="float: right;margin-bottom: 4%;" tabindex="13">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrRotRsptLabCe">CERRAR</button>
                                                       </div>
                                                     </div>
                                                 </div>
                                              </div>
                                                    
                                         </form>

                                          </div>
                                    </div>   
          </div>
          
            <!-- INICIO -->
           <div class="modal fade bs-example-modal-modalObsLab" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="tit">OBSERVACION</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmObsMicroLab" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ideObsRoTLab" id="ideObsRoTLab">
                                                     <input type="hidden" name="tipoMac" id="tipoMac">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                                           
                                                      <br>
                                                      <div class="form-group" id="descDiv">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">OBSERVACION</label>
                                                            <div class="col-md-8 col-sm-12 col-xs-12">
                                                              <textarea class="form-control" name="rsptaObsMicLab" id="rsptaObsMicLab" rows="3" style="text-transform: uppercase;" tabindex="12"></textarea>
                                                            </div>
                                                       </div>
                                                       
                                                     
                                                     
                                                        <Hr>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="rsptaObsMicroLab();" style="float: right;margin-bottom: 4%;" tabindex="13">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrObsRsptLabCe">CERRAR</button>
                                                       </div>
                                                     </div>
                                                 </div>
                                              </div>
                                                    
                                         </form>

                                          </div>
                                    </div>   
          </div>
          
          
          <div class="modal fade bs-example-modal-modalObsLabInfo" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="tit">OBSERVACION</h4>
                                </div>

                          
                                <div class="modal-body">
                                                
                                                <p id="lblObslab" style="text-transform: uppercase;"></p>
                                        
                                 </div>
                                        
                                        

                        </div>
                </div>   
          </div>
          
          
           <!--- modals -->
                
                 <div class="modal fade bs-example-modal-modalObslblMicro" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">
                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                            <h4 class="modal-title" id="tit">OBSERVACION</h4>
                                        </div>
                                        <div class="modal-body">
                                                <p id="lblObsMicro" style="text-transform: uppercase;"></p>
                                        </div>
                                </div>
                        </div>   
                  </div>
                  
          
          
          <!-- fin modal-->
          
          <!--- modals -->
                
                 <div class="modal fade bs-example-modal-modalRsptalblMicro" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">
                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                            <h4 class="modal-title" id="tit">RESPUESTA MICRO</h4>
                                        </div>
                                        <div class="modal-body">
                                                <p id="lblrsptaMicro" style="text-transform: uppercase;"></p>
                                        </div>
                                </div>
                        </div>   
                  </div>
                  
          
          
          <!-- fin modal-->
          
          
          
          
          <div class="modal fade bs-example-modal-modalResptaMicroLabInfoObslblMacro" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">
                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="tit">OBSERVACION MACRO</h4>
                                </div>
                                <div class="modal-body">
                                                <p id="lblobsMacro" style="text-transform: uppercase;"></p>
                                 </div>
                        </div>
                </div>   
          </div>
          
          
          <div class="modal fade bs-example-modal-modalResptaMicroLabInfoDescripMacro" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">
                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="tit">DESCRIPCION</h4>
                                </div>
                                <div class="modal-body" style="text-align: center;">
                                                <textarea id="lblDescMacro" style="text-transform: uppercase;color: black;height: 270px;width:566px;"></textarea>
                                                <br><br><a  target="blank" id="mostrarPdfMacro" class="btn btn-danger"> Imprimir </a> <br><br>
                                              <!--   <pre id="lblDescMacro" style="text-transform: uppercase;color: black;"></pre>-->
                                 </div>
                        </div>
                </div>   
          </div>
          <div class="modal fade bs-example-modal-modalMarcadorColor" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">
                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="tit">DESCRIPCION</h4>
                                </div>
                                <div class="modal-body">
                                                <pre id="lblMarcCol" style="text-transform: uppercase;color: black;"></pre>
                                 </div>
                        </div>
                </div>   
          </div>
           <div class="modal fade bs-example-modal-modalResptaMicroLabInfooBX" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="tit">RESPUESTA MICROSCOPIA</h4>
                                </div>

                          
                                <div class="modal-body">
                                                
                                                <p id="lblRsptalabOx" style="text-transform: uppercase;"></p>
                                        
                                 </div>
                                        
                                        

                        </div>
                </div>   
          </div>
          <div class="modal fade bs-example-modal-modalResptaMicroLabInfo" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="tit">RESPUESTA MICROSCOPIA</h4>
                                </div>

                          
                                <div class="modal-body">
                                                
                                                <p id="lblRsptalab" style="text-transform: uppercase;"></p>
                                        
                                 </div>
                                        
                                        

                        </div>
                </div>   
          </div>
          
          <div class="modal fade bs-example-modal-modalPaquete444444" tabindex="-1" id="myModalIng" role="dialog" >
                    <div class="modal-dialog modal-lg" >
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title">REGISTRO</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="frmPaquete" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser"  id="iduser" value="<?php echo $iduser ?>">
                                                     <input type="hidden" name="idPak"  id="idPak">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                                    <div class="form-group hidden" id="viIdfg">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">DIGITADOR</label>
                                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="listCaja" id="listCaja" required="required" tabindex="2"></select>
                                                            </div>
                                                            
                                                            <script>
                                                                         $(document).ready(function() {
                                                                             
                                                                             $('#listCaja').on('change', function() {
                                                                                        var today = new Date();
                                                                                        var date = today.toISOString().slice(0,10);
                                                                                        var time = today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds();
                                                                                        var dateTime = date + ' ' + time;
                                                                                        $('#fechaHoraAsignadoDigitador').val(dateTime);
                                                                            });
                                                                             
                                                                         });
                                                            </script>
                                                             <input type="hidden" name="fechaHoraAsignadoDigitador"  id="fechaHoraAsignadoDigitador">
                                                      </div>
                                                      <div class="form-group">
                                                             <label class="control-label col-md-2 col-sm-3 col-xs-12">DESCRIPCION</label>
                                                              <div class="col-md-12 col-sm-12 col-xs-12">
                                                                  <textarea class="form-control" name="obsPaquete" id="obsPaquete" rows="6" style="text-transform: uppercase;" tabindex="3"></textarea>
                                                              </div>
                                                      </div>
                                                    
                                    <br><hr>
                                                  
                                                      <button type="button" class="btn btn-danger" id="das" onclick="registroPaquete();" style="float: right;margin-bottom: 4%;" tabindex="18">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarFrmPak">CERRAR</button>
                                                      
                             </form>

                        </div>
                      </div>                       
                  </div>
                </div>
              </div> 
          </div>
        </div>
        <!--FIN GRUPO -->
        
         <!-- modal tranferencia-->
        
         <div class="modal fade bs-example-modal-modalCajax" tabindex="-1" id="myModal" role="dialog" aria-hidden="true" data-backdrop="static"  data-keyboard="false" >
                    <div class="modal-dialog modal-m">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title" id="pacient">ASIGNAR CAJAS</h4>
                                </div>
                                <div class="modal-body">
                        
                                  <form class="formulario form-horizontal form-label-left input_mask" method="POST" id="frmAgregarCax">
                                    <input type="hidden" name="iduserEx"  id="iduserEx" value="<?php echo $iduser; ?>">
                                    
                                                 <div class="form-group">
                                                        <label class="control-label col-md-1 col-sm-3 col-xs-12" 
                                                        style="text-align: center;margin-top: -1px;font-size: 14px;"><?php echo "CA".date("Y") ?></label>
                                                          <div class="col-md-2 col-sm-12 col-xs-12" style="margin-left: 6px;">
                                                              <input type="text" class="form-control"  name="refeCaja" id="refeCaja" readonly > 
                                                          </div>
                                                          <a class="btn btn-danger" id="guardarEnCaja"><i class="fa fa-save"></i> Asignar</a>
                                                          <a class="btn btn-default" onclick=RegistrarCjax()><i class="fa fa-plus"></i> Generar Caja</a>
                                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" style="float: right;margin-top: -1px;font-size: 14px;" id="cantidaCax"></label>
                                                     <br>
                                                 </div>
                                                 
                                                <div class="form-group hidden" style="float:right;margin-top: 20px;">
                                                        <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarExamen">CERRAR</button>
                                                </div>
                                               
                                              <div class="form-group ">
                                                      <div id="datExrCajas" style="float: left;"></div>                                  
                                              </div>
                                      <br>

                                  </form>
                                </div>
                                <div class="modal-footer" id="elFin"> 
                                </div>
                           </div>
                    </div>
                  </div>
        <!-- fin modal trasnferencia -->

           <!-- INICIO -->
           <div class="modal fade bs-example-modal-smTecnico" tabindex="-1" id="myModalIng" role="dialog" >
                    <div class="modal-dialog modal-lg" style="width: 30%;">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title">ASIGNAR TECNICO</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formTecx" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="idgrouxt"  id="idgrouxt">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab"><br>
                                                   
                                                      <div class="form-group">
                                                            <label class="control-label col-md-2 col-sm-3 col-xs-12">TECNICO<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-9 col-sm-12 col-xs-12">
                                                                  <select class="form-control" name="tecx" id="tecx" required="required" tabindex="8"></select>
                                                               </div>
                                                      </div>
                                          <br><hr>
                                                  
                                                      <button type="button" class="btn btn-danger" id="das" onclick="RegistrarTecnico();" style="float: right;margin-bottom: 4%;" tabindex="18">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="generaTedf">CERRAR</button>
                                                      
                             </form>

                        </div>
                      </div>                       
                  </div>
                </div>
              </div> 
          </div>
        </div>
        <!--FIN GRUPO -->
       
        
        
       
        
        
        <div class="modal fade bs-example-modal-sm" tabindex="-1" id="myModal" role="dialog" >
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                                <div class="modal-header" style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                                    <button type="button" class="close" data-dismiss="modal" style="color: white;opacity: 1;">&times;</button>
                                    <h4 class="modal-title">REGISTRO DEL PACIENTE</h4>
                                </div>

                          <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data" id="formPaciente" class="formulario form-horizontal form-label-left input_mask">
                                <div class="modal-body">
                                                     <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                                    <input type="hidden" name="ide" value="<?php echo $id ?>" id="ide">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                          <li role="presentation" class="active" id="idDat"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">DATOS</a>
                                          </li>
                                          <li role="presentation" class="hidden" id="idPad"><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">PADRES</a>
                                          </li>
                                          <li role="presentation" class="hidden" id="idArch"><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">ARCHIVOS</a>
                                          </li>
                                          <li role="presentation" style="float: right;" class="MostrarCo hidden" id="MosPac">
                                          </li>
                                        </ul>
                                        <div id="myTabContent" class="tab-content">
                                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">                                           
                                                      <br>
                                                      
                                                      <div class="form-group">
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">N° CUENTA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <div class="input-group" style="margin-bottom:0px;">
                                                                    <input type="text" class="form-control" name="Nxuenta" id="Nxuenta" maxlength="11" required="required" tabindex="6" >
                                                                    <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-primary" id="cargaCuenta"><i class="fa fa-search"></i></button>
                                                                    </span>
                                                                </div>
                                                              </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">H. CLINICA <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="hclinica" id="hclinica" maxlength="11" required="required" tabindex="4"  >
                                                            </div>
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">N° FUA<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                              <div class="col-md-3 col-sm-12 col-xs-12">
                                                                <div class="input-group" style="margin-bottom:0px;">
                                                                    <input type="text" class="form-control" name="fua" id="fua" value="16918-22-" maxlength="35" required="required" tabindex="6"  >
                                                                 
                                                                </div>
                                                              </div>
                                                          <label class="control-label col-md-2 col-sm-3 col-xs-12">DNI <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-3 col-sm-12 col-xs-12">
                                                            <div class="input-group" style="width: 100%;">
                                                              <input type="text" class="form-control" name="dni" id="dni" maxlength="11" required="required" tabindex="4"  >
                                                            </div>
                                                          </div>
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">PACIENTE  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="paciente" id="paciente" tabindex="5" style="text-transform: uppercase;" >
                                                        </div>

                                                       
                                                      </div>
                                                     
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">SERVICIO  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                                          <input type="text" class="form-control" required="required"  name="servicio" id="servicio" tabindex="9"  style="text-transform: uppercase;" >
                                                        </div>
                                                       
                                                      </div>
                                                      <div class="form-group">
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. INGRESO<span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                        <div class="col-md-3 col-sm-12 col-xs-12">
                                                          <input type="date" class="form-control" required="required"  name="feingreso" id="feingreso" tabindex="11" >
                                                        </div>
                                                        <label class="control-label col-md-2 col-sm-3 col-xs-12">F. CORTE/ALTA  <span class="required" style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                          <div class="col-md-4 col-sm-12 col-xs-12">
                                                            <input type="date" class="form-control" required="required" name="fecorte" id="fecorte"  tabindex="12"  >
                                                          </div>
                                                      </div>
                                                      <div class="form-group">
                                                        <label for="title" class="col-sm-2 control-label">AUDITOR</label>
                                                        <div class="col-sm-6">
                                                            <select class="form-control" name="asiAudi" id="asiAudi" style="text-transform: uppercase;" required="required" tabindex="8">
                                                            </select>
                                                        </div>
                                                      </div>
                                                     
                                    <br><br>
                                                      <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                                      <button type="button" class="btn btn-danger" id="GuardarPaciente" onclick="RegistrarPac();" style="float: right;margin-bottom: 4%;">GUARDAR</button>                                      
                                                      <button type="button" class="btn btn-default hidden" data-dismiss="modal" id="cerrarpre">CERRAR</button>
                                                      
                                           </form>

                                          </div>
                                         
                 

               

               


        <!-- footer content -->
        
       <?php include 'Vistas/footer.php';  ?>
       
       
   