 <?php 


error_reporting(0);
session_start();


if ($_SESSION['loggedin'] == false) {
  
  echo"<script type=\"text/javascript\">alert('Debes iniciar sesión para continuar.'); window.location='index.php';</script>";  
  exit;
} 

include 'Modelo/funciones.php';
require 'Modelo/global.php';



include 'Vistas/librerias.php';  

?>
<style>

.dt-center{
              font-size: 13px;
           }
           .dt-left{
              font-size: 13px;
           }

</style>
<script type="text/javascript">


function getActualDate() {
    var d = new Date();
    var day = addZero(d.getDate());
    var month = addZero(d.getMonth()+1);
    var year = addZero(d.getFullYear());
    return day + "-" + month + "-" + year;
}
                                    
                                    $(document).ready(function() {


                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;


                                                $('#pacie10').DataTable( {
                                               //   "scrollY":"650px",
                                                //  "scrollCollapse": true,
                                                  "searching": true,
                                                   //"oSearch": {"sSearch": "91214268" },
                                                  "bProcessing": true,
                                                  "sAjaxSource": "./Controlador/search.php?function=listCie10",
                                                  "pageLength": 20,
                                                  "order": [[ 0, "desc" ]],
                                                  "columnDefs": [
                                                        { targets: [0,1,2,3], visible: true},
                                                        { targets: '_all', visible: false 
                                                        
                                                        },  {
                                                                className: "dt-left",
                                                                "targets": [2] 
                                                            },
                                                            {
                                                                className: "dt-right",
                                                                "targets": [] 
                                                          },
                                                        {
                                                            className: "dt-center",
                                                            "targets": [0,1,3]
                                                        }],

                                                        //

                                                      "aoColumns": [

                                                            { mData: 'id' },
                                                            { mData: 'C10_CodDia' },
                                                            { mData: 'C10_Descripcion' },
                                                            { mData: 'ResolMnisterial' },
                                                            
                                                        
                                                      ],
                                                  dom: '<fBtip>',
                                                  buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PACIENTESREGISTRADOS'+ output,
                                                            exportOptions: {
                                                              columns: [0,1,2,3]
                                                            },
                                                            customize: function(xlsx) {
                                                              
                                                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                              $('row[r=2] c', sheet).attr('s', '47');
                                                              
                                                          }
                                                        }
                                                      
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
                                      
                                        $('#pacie10_filter').css('display','none');
                                        $('.dt-buttons').css('float','right');
                                        $('.dt-buttons').css('margin-top','-49px');
                                        $('#pacie10_filter').css('float','left');
                                        $('#pacie10_filter').addClass('form-group');
                                        $('#pacie10_filter label input').addClass('form-control');
                                        $('#pacie10_length label select').addClass('form-control');
                                       
                                    } );


                            $(document).ready(function(){

                                          var table = $('#pacie10').DataTable();
                                           $('#busqerh').on( 'keyup', function () {
                                                table.search( this.value ).draw();
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
                                <h2 style="text-transform: uppercase;">Lista de ENFERMEDADES RARAS Y HUERFANAS <small></small></h2>
                                
                                
                                <!--<a href="#" class="dropdown-toggle" data-toggle="modal" data-target=".bs-example-modal-sm" id="agr2" role="button" aria-expanded="false"><i class="fa fa-arrows"></i></a>-->
                                <!--<a href="registrosexcel.php" style="float: right;"><img style="width:30px;" src="<?php echo $path ?>images/excel.png">&nbsp;&nbsp;&nbsp;&nbsp;
                                &nbsp;&nbsp;</a>
                                <a style="float: right;">Exportar a:&nbsp;&nbsp; </a>  -->
                                <div class="clearfix"></div>
                              </div>
                              

                              <div class="x_content">
                              <table border="0" class="" >
                                  <tbody>
                                      <tr>
                                          <td><label>Buscar:</label></td>
                                          <td><input name="busqerh" id="busqerh" type="text" class="form-control" placeholder="Columnas" autocomplete="off"></td>
                                         
                                      </tr>
                                  </tbody>
                              </table><br>
                             <!--<input type="text" id="search-date" placeholder="search date"><br><br>-->
                                <div class="alert alert-success alert-dismissible fade in hidden" role="alert" id="alerify">
                                      <button type="button" class="close" ><span aria-hidden="true" id="closealert">×</span>
                                      </button>
                                      <strong id="pacte"></strong>
                                  </div>
                                            <div class="dataTables_wrapper form-inline dt-bootstrap no-footer" id=""> 
                                                          <table class="table jambo_table bulk_action compact"  id="pacie10" >
                                                                <thead>
                                                                  <tr class="headings" style="font-size: 10px;">
                                                                    <!--<th class="column-title">Id </th>-->
                                                                    <th class="column-title" style="text-transform: uppercase;text-align:center">ID </th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align:center">CODIGO CIE10</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align:center">DESCRIPCION</th>
                                                                    <th class="column-title" style="text-transform: uppercase;text-align:center">RESOLUCION</th>
                                                                  </tr>
                                                                </thead>
                                                              
                                                                <tbody>
                                                                  
                                                                </tbody>
                                                              </table>

                                            
                                            </div><br><br>
                                       
                              </div>
                            </div>
                         </div>


                  
                  </div>
        </div>

      

                
        <!-- /page content -->
      
                  


        <!-- footer content -->
       <?php include 'Vistas/footer.php';  ?>
   