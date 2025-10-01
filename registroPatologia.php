<?php 
//error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 

include_once ('config.php');
include (MODEL_PATH."pacientes.php");

include (MODEL_PATH."global.php");

include 'Vistas/librerias.php';  

$tic = $_GET["id"];
$hoy = date('Y-m-d');
$ReporteDesde = $ReporteDesde ?? $hoy;
$ReporteHasta = $ReporteHasta ?? $hoy;

$tile="";
if($tic==1){
    $tile="HOSPITALIZACION";        
}else if($tic==2){
    $tile="EMERGENCIA";        
}else if($tic==3){
    $tile="CONSULTA EXTERNA";        
}
?>


<script type="text/javascript">
$(document).ready(function() {

    $(".filter").remove();


    var d = new Date();
    var month = d.getMonth() + 1;
    var day = d.getDate();
    var output = d.getFullYear() + '/' +
        (('' + month).length < 2 ? '0' : '') + month + '/' +
        (('' + day).length < 2 ? '0' : '') + day;

    var toip = getParameterByName('id');
    var buscar = getParameterByName('buscar');
    var tipoEstudio = getParameterByName('tipoEstudio');


    var table = $('#pac3').DataTable({
        "bProcessing": true,
        "sAjaxSource": "./Controlador/search.php?function=listRegistroPato&buscar=" + buscar +
            "&tipoEstudio=" + tipoEstudio,
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 15,
        "order": [1, "desc"],
        "columnDefs": [{
                targets: [0, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21,
                    22],
                visible: true
            },
            {
                targets: '_all',
                visible: false

            }, {
                className: "dt-left",
                "targets": [7, 12, 14, 20]
            }, {
                className: "dt-right",
                "targets": []
            },
            {
                className: "dt-center",
                "targets": [0, 1, 2, 3, 4, 5, 6, 8, 9, 10, 11, 13, 15, 16, 17, 18, 19, 21, 22]
            }
        ],
        "aoColumns": [

            {
                mData: 'opciones'
            },
            {
                mData: 'idPato'
            },
            {
                mData: 'USERO'
            },
            {
                mData: 'nroOr'
            },
            {
                mData: 'estadoRegistro'
            },
            //{ mData: 'nroFactura' },
            {
                mData: 'USERASIX'
            },
            {
                mData: 'cuenta'
            },
            {
                mData: 'paciente'
            },
            {
                mData: 'historia'
            },
            {
                mData: 'tipodoc'
            },
            {
                mData: 'nrodoc'
            },
            {
                mData: 'finaciamiento'
            },
            {
                mData: 'servicio'
            },
            {
                mData: 'tipoEstudio'
            }, //12
            {
                mData: 'medicoSolicitante'
            }, //{ mData: 'procedimiento' },
            {
                mData: 'fechaRecepcion'
            },
            {
                mData: 'informeAp'
            },
            {
                mData: 'informeCp'
            },
            {
                mData: 'informeIHQ'
            },
            {
                mData: 'informeHQ'
            },
            {
                mData: 'medicoSolicitante'
            },
            {
                mData: 'fechaReg'
            },
            {
                mData: 'fechaModificacion'
            },
            {
                mData: 'filtroFechaRecepcion'
            },
            {
                mData: 'estadoLineal'
            },


        ],

        dom: '<fBtip>',
        buttons: [{
                extend: 'excel',
                text: 'EXPORTAR A EXCEL',
                title: 'PacientesRegistrados' + output,
                exportOptions: {
                    columns: [1, 3, 4, 5, 6, 7, 8, 10, 12, 13, 14, 15, 18, 19]
                },
                customize: function(xlsx) {
                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                    $('row[r=2] c', sheet).attr('s', '47');
                }

            }

        ], // 

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

        "deferRender": true,
        initComplete: function() {

            // 1 filtro
            var column2 = this.api().column(13);
            var select2 = $(
                    '<select class="form-control filter"  style="text-transform: uppercase;"><option value="">Todos</option></select>'
                    )
                .appendTo('#filtroTipoEst')
                .on('change', function() {
                    var val = $(this).val();
                    column2.search(val).draw()
                });

            var offices = [];
            column2.data().toArray().forEach(function(s) {
                s = s.split(',');
                s.forEach(function(d) {
                    if (!~offices.indexOf(d)) {
                        offices.push(d)
                        select2.append('<option value="' + d + '">' + d +
                            '</option>');
                    }
                })
            })




            // 1 filtro
            var columnPro = this.api().column(5);
            var selectPro = $(
                    '<select class="form-control filter" style="text-transform: uppercase;"><option value="">Todos</option></select>'
                    )
                .appendTo('#filtroProced')
                .on('change', function() {
                    var val2Pro = $(this).val();
                    columnPro.search(val2Pro).draw()
                });

            var offices2Pro = [];
            columnPro.data().toArray().forEach(function(s) {
                s = s.split(',');
                s.forEach(function(d) {
                    if (!~offices2Pro.indexOf(d)) {
                        offices2Pro.push(d)
                        selectPro.append('<option value="' + d.trim() + '">' + d +
                            '</option>');
                    }
                })
            })

            //fin filtro

            // 1 filtro
            var columnProLine = this.api().column(24);
            var selectProLine = $(
                    '<select class="form-control filter" style="text-transform: uppercase;"><option value="">Todos</option></select>'
                    )
                .appendTo('#filtroEstadoLineal')
                .on('change', function() {
                    var val2ProLine = $(this).val();
                    columnProLine.search(val2ProLine).draw()
                });

            var offices2ProLine = [];
            columnProLine.data().toArray().forEach(function(s) {
                s = s.split(',');
                s.forEach(function(d) {
                    if (!~offices2ProLine.indexOf(d)) {
                        offices2ProLine.push(d)
                        selectProLine.append('<option value="' + d.trim() + '">' +
                            d + '</option>');
                    }
                })
            })

            //fin filtro

        },

        scrollY: "550px",
        scrollX: true,
        // fin 1 filtro

    });




    $('#pac3_filter').addClass('form-group');
    $('#pac3_filter').css('text-align', 'left');
    $('#pac3_filter').css('display', 'none');
    $('.dt-buttons').css('float', 'right');
    $('#pac3_paginate').css('width', '100%');

    $('.dt-buttons').css('display', 'none');
    $('.dt-buttons').css('margin-top', '-53px');
    $('#pac3_filter label input').addClass('form-control');
    $('#pac3_length label select').addClass('form-control');

    $('#serc').on('keyup', function() {
        table.search(this.value).draw();
    });


    $("#minCie109").datepicker({
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov',
            'Dic'
        ],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        "dateFormat": "yy-mm-dd",
        "onSelect": function(date) {
            minDateFilter = new Date(date).getTime();
            console.log(minDateFilter);
            table.draw(); // Redraw the table with the filtered data.
        }
    }).keyup(function() {
        minDateFilter = new Date(this.value).getTime();
        table.draw();
    });

    $("#maxCie109").datepicker({
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov',
            'Dic'
        ],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        "dateFormat": "yy-mm-dd",
        "onSelect": function(date) {
            maxDateFilter = new Date(date).getTime();
            table.draw();
        }
    }).keyup(function() {
        maxDateFilter = new Date(this.value).getTime();
        table.draw();
    });


    minDateFilter = "";
    maxDateFilter = "";

    $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex) {
            if (typeof aData._date == 'undefined') {
                aData._date = new Date(aData[23]).getTime();
            }

            if (minDateFilter && !isNaN(minDateFilter)) {
                if (aData._date < minDateFilter) {
                    return false;
                }
            }

            if (maxDateFilter && !isNaN(maxDateFilter)) {
                if (aData._date > maxDateFilter) {
                    return false;
                }
            }

            return true;
        }
    );

    $('#pac3 tbody').on('click', 'tr', function() {

        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

    });



});

function abrirNuevaVentana() {
    let desde = document.getElementById('ReporteDesde').value;
    let hasta = document.getElementById('ReporteHasta').value;
    console.log('hasta', desde)
    console.log('ReporteDesde', hasta)

    if (!desde || !hasta) {
        alert('Debe seleccionar el rango de fechas.');
        return;
    }


    window.open(`ImprimeReporteQuirurgico.php?desde=${desde}&hasta=${hasta}`, '_blank', 'width=900, height=600');
}

function abrirNuevaVentanaCuello() {
    const desde = document.getElementById('ReporteDesde').value;
    const hasta = document.getElementById('ReporteHasta').value;
    console.log('hasta', hasta)

    if (!desde || !hasta) {
        alert('Debe seleccionar el rango de fechas.');
        return;
    }


    window.open(`ImprimeReporteCuelloUterino.php?desde=${desde}&hasta=${hasta}`, '_blank', 'width=900, height=600');
}

function abrirNuevaVentanaPuncion() {
    const desde = document.getElementById('ReporteDesde').value;
    const hasta = document.getElementById('ReporteHasta').value;

    if (!desde || !hasta) {
        alert('Debe seleccionar el rango de fechas.');
        return;
    }


    window.open(`ImprimeReportePunciones.php?desde=${desde}&hasta=${hasta}`, '_blank', 'width=900, height=600');
}



// var table = $('#pac3').DataTable();
</script>

<style>
table.dataTable tbody tr.selected {
    background-color: #0d4fcd !important;
    color: white;
}
</style>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <?php include 'Vistas/menu.php';  ?>
            <!-- top navigation -->
            <div class="top_nav">
                <?php include 'Vistas/usuario2.php';  ?>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2 style="text-transform: uppercase;font-weight: 700;">LISTA DE
                                    PACIENTES<small></small></h2>

                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">

                                <table border="0">
                                    <tbody>

                                        <tr>
                                            <form id="" action="#" method="GET">
                                                <td><label>Buscar:</label></td>
                                                <td><input name="buscar" id="buscar" type="text" class="form-control"
                                                        placeholder="Correlativo"></td>
                                                <td><label style="margin-left:25px;margin-right: 5px;">Estado:</label>
                                                </td>
                                                <td>
                                                    <p id="filtroEstadoLineal" style="margin: 0 0 -2px;"></p>
                                                </td>
                                                <td><label style="margin-left:25px;margin-right: 5px;">Estudio:</label>
                                                </td>
                                                <td><select class="form-control" id="tipoEstudio" name="tipoEstudio">
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">PATOLOGIA QUIRURGICA</option>
                                                        <option value="2">CITOLOGIA</option>
                                                    </select> </td>
                                                <td><label style="margin-left:25px;margin-right: 5px;">Usuario:</label>
                                                </td>
                                                <td>
                                                    <p id="filtroProced" style="margin: 0 0 -2px;"></p>
                                                </td>
                                                <td style="width: 100px;"><button type="submit" class="btn btn-success"
                                                        id="sa" style="margin-top: 5px;"><i class="fa fa-search"></i>
                                                        Buscar</button></a>

                                            </form>
                                        </tr>
                                    </tbody>
                                </table> <br>

                                <div class="alert alert-success alert-dismissible fade in hidden" role="alert"
                                    id="alerify">
                                    <button type="button" class="close"><span aria-hidden="true"
                                            id="closealert">×</span>
                                    </button>
                                    <strong id="pacte"></strong>
                                </div>
                                <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id="datagridConso">
                                    <table class="table jambo_table bulk_action compact" id="pac3">
                                        <thead>
                                            <tr class="headings" style="font-size: 10px;">
                                                <th class="column-title"
                                                    style="width:8%;text-transform: uppercase;text-align: center;">
                                                    OPCIONES</th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">#</th>
                                                <th class="" style="text-transform: uppercase;text-align: center;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;USUARIO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">NRO&nbsp;ORDEN
                                                </th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">ESTADO</th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    ASIGNADO&nbsp;A</th>
                                                <th class="" style="text-transform: uppercase;text-align: center;">
                                                    CUENTA</th>
                                                <th class="column-title"
                                                    style="width: 100px;text-transform: uppercase;text-align: center;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PACIENTE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">HISTORIA</th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">TIPO&nbsp;DOC
                                                </th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">NRO&nbsp;DOC
                                                </th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">FINANCIAMIENTO
                                                </th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SERVICIO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TIPO&nbsp;ESTUDIO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MEDICO&nbsp;SOLICITANTE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    F.&nbsp;RECEPCION</th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    INFORME&nbsp;AP</th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    INFORME&nbsp;CP</th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    INFORME&nbsp;IHQ</th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    INFORME&nbsp;HQ</th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MEDICO&nbsp;PATOLOGO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                </th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    FECHA&nbsp;REGISTRO</th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    FECHA&nbsp;MODIFICACION</th>
                                                <th class="column-title"
                                                    style="text-transform: uppercase;text-align: center;">
                                                    FILTRO&nbsp;FECHA&nbsp;RECEPCION</th>

                                            </tr>
                                        </thead>

                                    </table>

                                </div><br><br>
                                <div class="row">
                                    <div class="col-sm-2 ">
                                        <a href="ExportarGeneral.php" class="btn btn-primary hidden"><i
                                                class="fa fa-download"></i> Exportar EXCEL</a>
                                    </div>
                                    <div class="card">
                                         <div class="card-header">
                                             <h2>Reportes</h2>
                                         </div>
                                      

                                        <div class="card-body">

                                             <div class="card-body" style="padding: 20px;">
                                                 <table>

                                                     <tr>
                                                         <td><label for="ReporteDesde">Desde:</label></td>
                                                         <td>
                                                             <input name="ReporteDesde" id="ReporteDesde" type="date"
                                                                 value="<?php echo $ReporteDesde ?>" class="form-control"
                                                                 placeholder="Fecha Inicio" autocomplete="off"
                                                                 style="width: 140px;">
                                                         </td>

                                                         <td style="width: 20px;"></td> <!-- Espacio -->

                                                         <td><label for="ReporteHasta">Hasta:</label></td>
                                                         <td>
                                                             <input name="ReporteHasta" id="ReporteHasta" type="date"
                                                                 value="<?php echo $ReporteHasta ?>" class="form-control"
                                                                 placeholder="Fecha final" autocomplete="off"
                                                                 style="width: 140px;">
                                                         </td>

                                                         <td style="width: 20px;"></td> <!-- Espacio -->

                                                     </tr>
                                                 </table>
                                             </div>

                                             <!-- Segunda fila: Botones de reportes -->
                                             <div class="row">
                                                 <div class="col-sm-2">
                                                     <a href="javascript:void(0);" class="btn btn-danger btn-block"
                                                         onclick="abrirNuevaVentana()">
                                                         <i class="fa fa-file-alt"></i> Reporte Quirúrgico
                                                     </a>
                                                 </div>

                                                 <div class="col-sm-2">
                                                     <a href="javascript:void(0);" class="btn btn-warning btn-block"
                                                         onclick="abrirNuevaVentanaCuello()">
                                                         <i class="fa fa-user"></i> Reporte Cuello
                                                     </a>
                                                 </div>

                                                 <div class="col-sm-2">
                                                     <a href="javascript:void(0);" class="btn btn-info btn-block"
                                                         onclick="abrirNuevaVentanaPuncion()">
                                                         <i class="fa fa-syringe"></i> Reporte Puncion
                                                     </a>
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
            <div class="modal fade bs-example-modal-smResponsableAuditor" tabindex="-1" id="myModalIng" role="dialog">
                <div class="modal-dialog modal-lg" style="width: 30%;">
                    <div class="modal-content">

                        <div class="modal-header"
                            style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                            <button type="button" class="close" data-dismiss="modal"
                                style="color: white;opacity: 1;">&times;</button>
                            <h4 class="modal-title">ASIGNAR AUDITOR</h4>
                        </div>

                        <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data"
                            id="formGAudit" class="formulario form-horizontal form-label-left input_mask">
                            <div class="modal-body">
                                <input type="hidden" name="idgroux" id="idgroux">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                            aria-labelledby="home-tab"><br>

                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">AUDITOR<span
                                                        class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-9 col-sm-12 col-xs-12">
                                                    <select class="form-control" name="audi" id="audi"
                                                        required="required" tabindex="8"></select>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>

                                            <button type="button" class="btn btn-danger" id="das"
                                                onclick="RegistrarAuditor();" style="float: right;margin-bottom: 4%;"
                                                tabindex="18">GUARDAR</button>
                                            <button type="button" class="btn btn-default hidden" data-dismiss="modal"
                                                id="generaAudi">CERRAR</button>
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
            <div class="modal fade bs-example-modal-smTecnico" tabindex="-1" id="myModalIng" role="dialog">
                <div class="modal-dialog modal-lg" style="width: 30%;">
                    <div class="modal-content">

                        <div class="modal-header"
                            style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                            <button type="button" class="close" data-dismiss="modal"
                                style="color: white;opacity: 1;">&times;</button>
                            <h4 class="modal-title">ASIGNAR TECNICO</h4>
                        </div>

                        <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data"
                            id="formTecx" class="formulario form-horizontal form-label-left input_mask">
                            <div class="modal-body">
                                <input type="hidden" name="idgrouxt" id="idgrouxt">
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">

                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                            aria-labelledby="home-tab"><br>

                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">TECNICO<span
                                                        class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-9 col-sm-12 col-xs-12">
                                                    <select class="form-control" name="tecx" id="tecx"
                                                        required="required" tabindex="8"></select>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>

                                            <button type="button" class="btn btn-danger" id="das"
                                                onclick="RegistrarTecnico();" style="float: right;margin-bottom: 4%;"
                                                tabindex="18">GUARDAR</button>
                                            <button type="button" class="btn btn-default hidden" data-dismiss="modal"
                                                id="generaTedf">CERRAR</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
            <!--FIN GRUPO -->

            <div class="modal fade bs-example-modal-sm" tabindex="-1" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header"
                            style="background-image: linear-gradient(#43a2ca, #0c76a2);color: white;text-transform: uppercase;text-align: center;">
                            <button type="button" class="close" data-dismiss="modal"
                                style="color: white;opacity: 1;">&times;</button>
                            <h4 class="modal-title">REGISTRO DEL PACIENTE</h4>
                        </div>

                        <form method="POST" onsubmit="return false" action="return false" enctype="multipart/form-data"
                            id="formPaciente" class="formulario form-horizontal form-label-left input_mask">
                            <div class="modal-body">
                                <input type="hidden" name="iduser" value="<?php echo $iduser ?>" id="iduser">
                                <input type="hidden" name="ide" value="<?php echo $id ?>" id="ide">

                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs bar_tabs hidden" role="tablist">
                                        <li role="presentation" class="active" id="idDat"><a href="#tab_content1"
                                                id="home-tab" role="tab" data-toggle="tab"
                                                aria-expanded="true">DATOS</a>
                                        </li>
                                        <li role="presentation" class="hidden" id="idPad"><a href="#tab_content2"
                                                role="tab" id="profile-tab" data-toggle="tab"
                                                aria-expanded="false">PADRES</a>
                                        </li>
                                        <li role="presentation" class="hidden" id="idArch"><a href="#tab_content3"
                                                role="tab" id="profile-tab2" data-toggle="tab"
                                                aria-expanded="false">ARCHIVOS</a>
                                        </li>
                                        <li role="presentation" style="float: right;" class="MostrarCo hidden"
                                            id="MosPac">
                                        </li>
                                    </ul>
                                    <div id="myTabContent" class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content1"
                                            aria-labelledby="home-tab">
                                            <br>

                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">N° CUENTA<span
                                                        class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="input-group" style="margin-bottom:0px;">
                                                        <input type="text" class="form-control" name="Nxuenta"
                                                            id="Nxuenta" maxlength="11" required="required"
                                                            tabindex="1">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-primary"
                                                                id="cargaCuenta"><i class="fa fa-search"></i></button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">H. CLINICA
                                                    <span class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <div class="input-group" style="width: 100%;">
                                                        <input type="text" class="form-control" name="hclinica"
                                                            id="hclinica" maxlength="11" required="required"
                                                            tabindex="2">
                                                    </div>
                                                </div>
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12"
                                                    style="width: 93px;">TIPO DOC<span class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-2 col-sm-12 col-xs-12" style="width:120px;">
                                                    <select class="form-control" name="tiDocA" id="tiDocA"
                                                        required="required" tabindex="3">
                                                        <option value="DNI">DNI</option>
                                                        <option value="Carnet Ext.">Carnet Ext.</option>
                                                        <option value="Pasaporte">Pasaporte</option>
                                                        <option value="Codigo recien nacido (CUI)">Codigo recien nacido
                                                            (CUI)</option>
                                                        <option value="Doc. Ident. Extranjera">Doc. Ident. Extranjera
                                                        </option>
                                                        <option value="Sin Doc.">Sin Doc.</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">N° FUA<span
                                                        class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="input-group" style="margin-bottom:0px;">
                                                        <input type="text" class="form-control" name="fua" id="fua"
                                                            value="16918-22-" maxlength="35" required="required"
                                                            tabindex="4">

                                                    </div>
                                                </div>
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">N°DOC <span
                                                        class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <div class="input-group" style="width: 100%;">
                                                        <input type="text" class="form-control" name="dni" id="dni"
                                                            maxlength="11" required="required" tabindex="5">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">PACIENTE <span
                                                        class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <input type="text" class="form-control" required="required"
                                                        name="paciente" id="paciente" tabindex="6"
                                                        style="text-transform: uppercase;font-size: 11px;">
                                                </div>
                                                <label class="control-label col-md-1 col-sm-3 col-xs-12">PABELLON<span
                                                        class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-5 col-sm-12 col-xs-12">
                                                    <select class="form-control" name="servicio" id="servicio"
                                                        required="required" tabindex="5"
                                                        style="text-transform: uppercase;">
                                                    </select>
                                                    <!-- <input type="text" class="form-control" required="required"  name="servicio" id="servicio" tabindex="7"  style="text-transform: uppercase;" >-->
                                                </div>

                                            </div>

                                            <div class="form-group">

                                            </div>
                                            <script>
                                            $(document).ready(function() {

                                                $("#ubiSerHosp").change(function() {
                                                    var idDis = $("#ubiSerHosp").val();
                                                    cargarCodpreHospi(idDis);
                                                });

                                            });
                                            </script>
                                            <div class="form-group">
                                                <label
                                                    class="control-label col-md-2 col-sm-3 col-xs-12">COD_PRES</label>
                                                <div class="col-md-1 col-sm-12 col-xs-12">
                                                    <input type="text" class="form-control" required="required"
                                                        name="codPreHos" id="codPreHos" style="width: 55px;">
                                                </div>
                                                <label
                                                    class="control-label col-md-2 col-sm-3 col-xs-12">DENOMINACION</label>
                                                <div class="col-md-6 col-sm-12 col-xs-12">
                                                    <select class="form-control" name="ubiSerHosp" id="ubiSerHosp"
                                                        required="required" tabindex="5"
                                                        style="text-transform: uppercase;">
                                                    </select>

                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">F. INGRESO<span
                                                        class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-3 col-sm-12 col-xs-12">
                                                    <input type="date" class="form-control" required="required"
                                                        name="feingreso" id="feingreso" tabindex="8">
                                                </div>
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">F. CORTE/ALTA
                                                    <span class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-4 col-sm-12 col-xs-12">
                                                    <input type="date" class="form-control" required="required"
                                                        name="fecorte" id="fecorte" tabindex="9">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">VALORIZADO
                                                    MEDIC-INSU<span class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <input type="text" class="form-control" required="required"
                                                        name="montgal" id="montgal" tabindex="10">
                                                </div>
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">VALORIZADO
                                                    PROC-LAB<span class="required"
                                                        style="color: red;font-weight: bolder;font-size: 15px;">*</span></label>
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <input type="text" class="form-control" required="required"
                                                        name="montsifar" id="montsifar" tabindex="11">
                                                </div>
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12"
                                                    id="telefam">VALORIZADO ATENCION</label>
                                                <div class="col-md-2 col-sm-12 col-xs-12" id="inputel">
                                                    <input type="text" class="form-control" required="required"
                                                        name="valAteAudi" id="valAteAudi" readonly="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-2 col-sm-3 col-xs-12">OBSERVACIONES
                                                    DE AUDITORIA</label>
                                                <div class="col-md-9 col-sm-12 col-xs-12">
                                                    <textarea class="form-control" name="obsCpms" id="obsCpms" rows="6"
                                                        style="text-transform: uppercase;" tabindex="12"></textarea>
                                                </div>

                                            </div>
                                            <!--<div class="form-group">
                        <label for="title" class="col-sm-2 control-label">AUDITOR</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="asiAudi" id="asiAudi" style="text-transform: uppercase;" required="required" tabindex="8">
                            </select>
                        </div>
                      </div>-->

                                            <br><br>
                                            <!--<button type="button" class="btn btn-success" style="float: right;margin-bottom: 4%;" id="idDatos" ><i class="fa fa-mail-forward"></i> SIGUIENTE</button>-->
                                            <button type="button" class="btn btn-danger" id="GuardarPaciente"
                                                onclick="RegistrarPac();" style="float: right;margin-bottom: 4%;"
                                                tabindex="13">GUARDAR</button>
                                            <button type="button" class="btn btn-default hidden" data-dismiss="modal"
                                                id="cerrarpre">CERRAR</button>
                                        </div>

                                    </div>
                                </div>
                        </form>










                        <!-- footer content -->
                        <?php include 'Vistas/footer.php';
?>