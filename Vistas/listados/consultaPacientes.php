<?php 


include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();


$ext = $_GET["pte"];
$rest = substr($ext, -2);


$ni = $pac->consultaPacientes();




?>

<script type="text/javascript">
                                
                                    $(document).ready(function() {

                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;


                                                $('#pac').DataTable( {
                                                  "searching": true,
                                                  "pageLength": 20,
                                                  "order": [[ 0, "desc" ]],
                                                  dom: '<fBtip>',
                                                  buttons: [
                                                        {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [0, 1, 2, 3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30]
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
                                      

                                        $('#pac_filter').addClass('form-group');
                                        $('#pac_filter label input').addClass('form-control');
                                        $('#pac_length label select').addClass('form-control');
                                       
                                    } );


                                    $(document).ready(function(){
                                        $.fn.dataTable.ext.search.push(
                                        function (settings, data, dataIndex) {
                                            var min = $('#min').datepicker("getDate");
                                            var max = $('#max').datepicker("getDate");
                                            var startDate = new Date(data[23]);
                                            if (min == null && max == null) { return true; }
                                            if (min == null && startDate <= max) { return true;}
                                            if(max == null && startDate >= min) {return true;}
                                            if (startDate <= max && startDate >= min) { return true; }
                                            return false;
                                        }
                                        );                                
                                            $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                                            $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
                                            var table = $('#pac').DataTable();

                                            $('#min, #max').change(function () {
                                              //nuevo cambio    
                                                   table.draw();
                                            });
                                        });

                                </script>
                                
                                 
                                  <table class="table jambo_table bulk_action"  id="pac" >
                                    <thead>
                                      <tr class="headings" style="font-size: 10px;">
                                        <th class="column-title">ID</th>
                                        <th class="column-title" style="text-transform: uppercase;">ID PRESTACION</th>
                                        <th class="" style="text-transform: uppercase;">ID CTA ATENCION</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">NRO DOC. AUTORIZACION</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">NRO DOC.</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">APELLIDOS</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">NOMBRES</th>                    
                                        <th class="" style="text-transform: uppercase;text-align: center;">NRO HISTORIA</th>                    
                                        <th class="" style="text-transform: uppercase;text-align: center;">F. INGRESO</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">F. ALTA</th>                                        
                                        <th class="column-title" style="width: 20%;text-transform: uppercase;text-align: center;">OPCIONES DE REGISTROS</th>                                       
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php  
                                             
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>

                                                    <tr class="even pointer">
                                                      <td class=" " style="text-transform: uppercase;"><?php echo $mue["idRegistro"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;"><?php echo $mue["id_prestacion"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["IdCuentaAtencion"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;"><?php echo $mue["nro_documento_autorizacion"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;"><?php echo $mue["nro_documento_paciente"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;"><?php echo $mue["apellido_paterno_paciente"]." ".$mue["apellido_materno_paciente"]; ?></td>
                                                      <td class="" style="text-transform: uppercase;"><?php echo $mue["nombres_paciente"]; ?></td>
                                                      <td class="" style="text-transform: uppercase;text-align: center;"><?php echo $mue["nro_historia"]; ?></td>
                                                      <td class="" style="text-transform: uppercase;text-align: center;"><?php echo $mue["fecha_ingreso"]; ?></td>
                                                      <td class="" style="text-transform: uppercase;text-align: center;"><?php echo $mue["fecha_alta"]; ?></td>
                                                      
                                                      <td style="text-align: center;" > 
                                                       <!-- <a onclick="verPaciente(<?php echo $mue['idRegistro']; ?>);" data-toggle="modal" data-target=".bs-example-modal-sm" 
                                                        class="btEdit btn btn-default btn-xs" style="border-color: black;"><i class="fa fa-edit"></i> Editar</a>-->
                                                        <a href="./Cuentas.php?id=<?php echo $mue['id_prestacion']; ?>"   class="btEdit btn btn-primary btn-xs"><i class="fa fa-folder-open"></i> Detalle</a>
                                                        <a title="ELIMINAR" onclick="EliminarPac('<?php echo $mue['NroPaciente']; ?>')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Eliminar</a>
                                                      </td>                
                                                      
                                                    </tr>
                                         <?php }
                                                    
                                                     ?>
                                    </tbody>
                                  </table>

                                  <!--<style>
                                  .dataTables_length{
                                    display:none;
                                  }
                                  .dataTables_filter {
                                      float: left !important;
                                  }
                                  .dataTables_filter label {
                                      float: left !important;
                                  }

                                  </style>-->