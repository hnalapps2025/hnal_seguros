 <?php 

//include_once ($_SERVER['DOCUMENT_ROOT'].'/hnal/config.php');
include_once ('./../../config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();

$ni = $pac->consultaPacientesAuditados();
$gru = $_GET['id'];


?>  


<script type="text/javascript">
                                
                                    $(document).ready(function() {

                                      $(".filter").remove();
                                    
                                                $('#codcmp').DataTable( {
                                                  "searching": true,
                                                  "pageLength": 10,
                                                  "order": [0, "desc" ],
                                                  dom: '<fBtip>',
                                                  buttons: [
                                                       /* {
                                                            extend: 'excel',
                                                            text:'EXPORTAR A EXCEL',
                                                            title: 'PacientesRegistrados'+ output,
                                                            exportOptions: {
                                                              columns: [0,1,2,3,4,6,7,8,9,10]
                                                            },
                                                            customize: function(xlsx) {
                                                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                                              $('row[r=2] c', sheet).attr('s', '47');
                                                          }
                                                        }*/
                                                        
                                                  ],
                                                                                                      
                                                  language: {
                                                        "decimal": "",
                                                        "searchPlaceholder": "..",
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
                                      

                                  

                                        $('#codcmp_filter').addClass('form-group');
                                        $('#codcmp_filter').css('text-align','left');
                                        $('#codcmp_filter').css('float','left');
                                       // $('#codcmp_filter').css('display','none');
                                        $('.dt-buttons').css('display','none');
                                        //$('.dt-buttons').css('margin-top','-57px');
                                        $('#codcmp_filter label input').addClass('form-control');
                                        $('#pac3_length label select').addClass('form-control');
                                       
                                    } );


                                  

                                </script>
                                                       

                                              <table class="table jambo_table bulk_action compact"  id="codcmp" style="border: 1px solid #b9b4b4;">
                                                    <thead>
                                                    <tr class="headings" style="font-size: 11px;background: #d6d8d8;color: black;">
                                                              <th class="column-title" style="width:10px;text-transform: uppercase;text-align: center;"># </th>
                                                              <th class="column-title" style="width:50px;text-align: center;">FUA</th>
                                                              <th class="column-title" style="width:10px;text-align: center;">CUENTA</th>
                                                              <th class="column-title" style="width:200px;text-align: center;">PACIENTE</th>                                        
                                                              <th class="column-title" style="width:10px;text-align: center;">HISTORIA</th>
                                                              <th class="column-title" style="width:10px;text-align: center;">FECHA_INGRESO</th>
                                                              <th class="column-title" style="width:10px;text-align: center;">FECHA_ALTA</th>
                                                      </tr>
                                                    </thead>
                                                                              
                                                    <tbody>
                                                        <?php  
                                                              
                                                              while($mue = $ni->fetch_assoc()){                                                 
                                                                 
                                                                        ?>  
                                                                        <tr class="even pointer">    
                                                                              <td class=" " style=";text-align: center;font-size: 10px;vertical-align: inherit;"><?php  
                                                                                   echo '<a title="Seleccionar" style="font-weight: bolder;color: white;" onclick="agregarAtencionAudi('.$mue["idPac"].','.$iduser.','.$gru.');" 
                                                                                   ><i class="fa fa-check" style="font-size: 20px;color: #26b99a;cursor: pointer;"></i></a> '; 
                                                                                ?>
                                                                              </td>
                                                                              <td class=" " style="text-transform: uppercase;text-align: center;font-size: 11px;vertical-align: inherit;"><?php   echo $mue["nroFua"]; ?></td>
                                                                              <td class=" " style="text-transform: uppercase;text-align:center;font-size: 11px;vertical-align: inherit;"><?php echo $mue["nroCuenta"]; ?></td>
                                                                              <td class=" " style="text-transform: uppercase;text-align:left;font-size: 10px;vertical-align: inherit;"><?php echo $mue["paciente"]; ?></td>
                                                                              <td class=" " style="text-transform: uppercase;text-align:center;font-size: 10px;vertical-align: inherit;"><?php echo $mue["Historia"]; ?></td>
                                                                              <td class=" " style="text-transform: uppercase;text-align:center;font-size: 11px;vertical-align: inherit;"><?php echo $mue["F_Ingreso"]; ?></td>
                                                                              <td class=" " style="text-transform: uppercase;text-align:center;font-size: 11px;vertical-align: inherit;"><?php echo $mue["F_Alta_Medica"]; ?></td>
                                                                              
                                                                    </tr>
                                                                <?php  }   ?>
                                                    </tbody>
                                                </table>
                                  