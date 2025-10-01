<?php 


include_once ($_SERVER['DOCUMENT_ROOT'].'/prestacional/config.php');
include (MODEL_PATH."pacientes.php");
include (MODEL_PATH."global.php");


$pac =new Pacientes();


$ext = $_GET["pte"];
$rest = substr($ext, -2);


$ni = $pac->cartasGarantia();


?>

<script type="text/javascript">
                                
                                    $(document).ready(function() {

                                           /*  $('#search-date').on('change', function(){
    
                                            table
                                            .column(4)
                                            .search(this.value)
                                            .draw();

                                          }); */


                                              var d = new Date();
                                              var month = d.getMonth()+1;
                                              var day = d.getDate();
                                              var output = d.getFullYear() + '/' +
                                              ((''+month).length<2 ? '0' : '') + month + '/' +
                                              ((''+day).length<2 ? '0' : '') + day;


                                                $('#pac3').DataTable( {
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
                                                              columns: [0,1,2, 3,4,5,6,7]
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
                                      

                                        $('#pac3_filter').addClass('form-group');
                                        $('#pac3_filter').css('text-align','left');
                                        $('#pac3_filter').css('float','left');
                                        $('.dt-buttons').css('float','right');
                                        $('#pac3_filter label input').addClass('form-control');
                                        $('#pac3_length label select').addClass('form-control');
                                       
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
                                            var table = $('#pac3').DataTable();

                                            $('#min, #max').change(function () {
                                              //nuevo cambio    
                                                   table.draw();
                                            });
                                        });

                                </script>
                           
                                  <table class="table jambo_table bulk_action"  id="pac3" >
                                    <thead>
                                      <tr class="headings" style="font-size: 10px;">
                                        <th class="column-title" style="width:6%;text-align: center;">#</th>
                                        <th class="column-title hidden" style="width:6%">ID</th>
                                        <th class="column-title" style="width:13%;text-transform: uppercase;text-align: center;">Nro Carta</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">DNI</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">Paciente</th>
                                        <th class="" style="text-transform: uppercase;text-align: center;">Referencia</th> 
                                        <th class="" style="text-transform: uppercase;text-align: center;">Motivo</th>     
                                        <th class="column-title" style="text-transform: uppercase;text-align: center;">F. Carta</th>
                                        <!--<th class="" style="text-transform: uppercase;">IAFA</th>-->
                                        <!--<th class="" style="text-transform: uppercase;text-align: center;">Producto</th>-->
                                        <!--<th class="" style="text-transform: uppercase;text-align: center;">Tarifa</th>-->
                                                                           
                                        <!--<th class="" style="text-transform: uppercase;text-align: center;">Poliza</th>     -->                                   
                                        <th class="" style="text-transform: uppercase;text-align: center;">Inicio</th>                                        
                                        <th class="" style="text-transform: uppercase;text-align: center;">Fin</th>                                        
                                        <!--<th class="" style="text-transform: uppercase;text-align: center;">Monto</th>     -->                                                                          
                                        <th class="column-title" style="width:8%;text-transform: uppercase;text-align: center;">OPCIONES</th>                                       
                                      </tr>
                                    </thead>
                                   
                                    <tbody>
                                         <?php  
                                             
                                               while($mue = $ni->fetch_assoc()){                                                 
                                                 ?>
     
                                                    <tr class="even pointer">
                                                        <td class="" style="text-transform: uppercase;text-align: center;">
                                                            <?php 
                                                               if($mue["motivo"]==""){
                                                                    echo '<a class="btEdit btn btn-success btn-xs"  style="color: #26b99a;"> D</a>';
                                                               }else{
                                                                echo '<a class="btEdit btn btn-danger btn-xs"  style="color: #d9534f;"> D</a>';
                                                               }
                                                              ?>
                                                        </td>
                                                        <td class="hidden" style="text-transform: uppercase;text-align: center;">
                                                            <?php 
                                                               $ni2 = $pac->cartasGarantiaWhere($mue["idCar"]);
                                                                while($mue2 = $ni2->fetch_assoc())
                                                                      {echo $mue2["nrocuenta"]."<br>"; } 
                                                              ?>
                                                        </td>
                                                      <td class=" " style="text-transform: uppercase;"><?php echo $mue["NroCarta"]."".$mue["NroCarta2"]."".$mue["NroCarta3"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: left;"><?php echo $mue["nrodoc"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;text-align: left;"><?php echo $mue["Paciente"]; ?></td>
                                                      <td class="" style="text-transform: uppercase;text-align: left;cursor:pointer;"><a title="<?php echo $mue["referencia"]; ?>"><?php echo $ref = substr($mue["referencia"], 0, 15).".."; ?></a></td>
                                                      <td class="" style="text-transform: uppercase;text-align: left;cursor:pointer;"><a title="<?php echo $mue["motivo"]; ?>"><?php echo $mot = substr($mue["motivo"], 0, 15).".."; ?></a></td>
                                                      <td class=" " style="text-transform: uppercase;;text-align: center;"><?php echo date('d/m/Y',strtotime($mue["Fecha_Carta"])); ?></td>
                                                      <!--<td class=" " style="text-transform: uppercase;;text-align: center;"><?php echo $mue["IAFA"]; ?></td>-->
                                                      <!--<td class=" " style="text-transform: uppercase;text-align: left;"><?php echo $mue["Producto"]; ?></td>-->
                                                      <!--<td class=" " style="text-transform: uppercase;text-align: center;"><?php echo $mue["Tarifa"]; ?></td>-->
                                                      
                                                      <!--<td class="" style="text-transform: uppercase;text-align: center;"><?php echo $mue["Poliza"]; ?></td>-->
                                                      <td class="" style="text-transform: uppercase;text-align: center;"><?php echo date('d/m/Y',strtotime($mue["Fecha_Inicio_Vigencia"])); ?></td>
                                                      <td class="" style="text-transform: uppercase;text-align: center;"><?php echo date('d/m/Y',strtotime($mue["Fecha_Fin_Vigencia"])); ?></td>
                                                      <!-- <td class="" style="text-transform: uppercase;text-align: center;"><?php echo $mue["Monto_Ampliacion"]; ?></td>-->
                                                      
                                                      <td style="text-align: center;" > 
                                                       <a onclick="verRegistro(<?php echo $mue['idCar']; ?>);" data-toggle="modal" data-target=".bs-example-modal-smCartas" 
                                                        class="btEdit btn btn-info btn-xs" title="EDITAR"  ><i class="fa fa-edit"></i> </a>
                                                        <a onclick="verCuentas(<?php echo $mue['idCar']; ?>);" data-toggle="modal" data-target=".bs-example-modal-smCuentas" 
                                                        class="btEdit btn btn-success btn-xs" title="CUENTAS"  ><i class="fa fa-bar-chart"></i> </a>
                                                       <!-- <div class="btn-group" style="vertical-align: inherit;">
                                                                <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle btn-xs" title="Opciones" type="button" style="background: #405467;border: 1px solid #405467;">
                                                                <i class="fa fa-calendar"></i> <span class="caret"></span>
                                                                </button>
                                                                <ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                                                                  <li> 
                                                                    <?php  if($mue["estatus"]==1){ ?> 
                                                                    <a href="./ImportarCuenta.php?id=<?php echo $mue['idRegistro']; ?>" style="color:black;"  ><i class="fa fa-folder-open"></i> Modificar</a>
                                                                    <?php  }  ?> 
                                                                  </li>
                                                                  <li><a href="./imprimir.php?id=<?php echo $mue['idRegistro']; ?>"  target="blank" style="color: black;" ><i class="fa fa-file-pdf-o"></i> Imprimir Pdf</a></li>
                                                                  <li><a href="./exportar.php?id=<?php echo $mue['idRegistro']; ?>" style="color: black;"> <i class="fa fa-file-pdf-o"></i> Exportar Xls</a></li>
                                                                  <li>
                                                                    
                                                                    <?php  if($rol==1 || $rol==3){ ?> 
                                                                      <a href="./ImporConsol.php?id=<?php echo $mue['idRegistro']; ?>" style="color: black;"> <i class="fa fa-file-excel-o"></i> Importar</a>
                                                                    <?php  }  ?> 
                                                                    
                                                                    </li>
                                                                 
                                                                </ul>
                                                        </div>-->
                                                                    
                                                            <a onclick="EliminarRegisCarta(<?php echo $mue['idCar']; ?>);" class="btEdit btn btn-danger btn-xs" title="ELIMINAR" ><i class="fa fa-close"></i> </a>
                                          
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