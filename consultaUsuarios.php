<?php 

require 'Modelo/funciones.php';
require 'Modelo/global.php';


$sel =new Model();



    $ni = $sel->consultaUsuariosS();
    $registros = 40;
    $contador = 1;
    $pagina = $_GET["pagina"];

    if (!$pagina) { 
        $inicio = 0; 
        $pagina = 1; 
    } else { 
        $inicio = ($pagina - 1) * $registros; 
    } 

    $resultados = $sel->paginadorUsariosS($inicio,$registros);  
    $total_registros = mysqli_num_rows($ni); 
    $total_paginas = ceil($total_registros / $registros);



?>


<table class="table jambo_table bulk_action" >
                                    <thead>
                                      <tr class="headings">
                                        <!--<th class="column-title">Id </th>-->
                                        <th class="column-title" style="width:5%;text-transform: uppercase;">ID</th>
                                        <th class="column-title" style="width:30%;text-transform: uppercase;">NOMBRES Y APELLIDOS</th>
				                              	<th class="column-title" style="width: 12%;text-transform: uppercase;">USUARIO</th>
                                        <th class="column-title" style="width: 25%;text-transform: uppercase;">EMAIL</th>
                                        <th class="column-title" style="width: 10%;text-transform: uppercase;">ESTADO</th>
                                        <th class="column-title" style="width: 20%;text-transform: uppercase;">ROL</th>
                                        <th class="column-title" style="width: 10%;text-transform: uppercase;">CELULAR</th>
                                        <th class="column-title" style="width: 5%;text-transform: uppercase;">Observaciones  </th>                              
                                        <!--<th class="column-title" style="text-align: center;width:7%;text-transform: uppercase;">Acciones</th>-->
                                       
                                      </tr>
                                    </thead>

                                    <tbody>
                                         <?php  
                                              if ($total_registros) {
                                               while($mue = $resultados->fetch_assoc()){                                                 
                                                 ?>

                                                    <tr class="even pointer">

                                                    <!-- idRegistro,cuenta,ApePaterno,ApeMaterno,sexo,TipoAtencion, HistoriaClinica,dni,Nombres -->
                                                      <td class=" "><?php echo $mue["id"]; ?></td>
                                                      <td style="text-transform: uppercase;"><?php echo $mue["nom"]; ?></td>
                                                      <td style="text-transform: uppercase;font-size: 12px;"><?php echo $mue["user"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;"><?php echo $mue["email"]; ?></td>                                                     
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;"><?php echo $mue["estado"]; ?></td>
                                                      <td class=" " style="text-transform: uppercase;font-size: 12px;font-weight: bolder;color: black;">
                                                      <?php  
                                                          if($mue["rol"]=="1"){
                                                            echo "ADMINISTRADOR";
                                                          }else if($mue["rol"]=="2"){
                                                            echo "AUDITOR";
                                                          }else if($mue["rol"]=="3"){
                                                            echo "GESTION";
                                                          } else {
                                                            echo "COORDINADOR";
                                                          }
                                                      ?>
                                                      </td>
                                                      <td class=" " style="text-transform: uppercase;"><?php echo $mue["cel"]; ?></td>
                                                     
                                                      <td class=" last" style="text-align: center;">

                                                        <a title="Editar" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                                        <!--<a title="Agregar solicitud" href="RegistrarPaciente.php?id=<?php echo $mue["cuenta"]; ?>&function=editar" class="btn btn-info btn-xs"><i class="fa fa-arrows"></i></a>-->
                                                        <a title="Eiminar" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                        
                                                        
                                                      </td>
                                                    </tr>
                                         <?php }
                                                   } 
                                                  mysqli_free_result($ni);  
                                                     ?>
                                    </tbody>
                                  </table>

                                  <ul class="pagination">
                                 
                                          <?php
                                                    if ($total_registros) {
                                                      
                                                      if (($pagina - 1) > 0) {
                                                        echo "<li ><a href='usuarios.php?pagina=".($pagina-1)."'>< Anterior</a></li>";
                                                        } else {
                                                        echo "<li ><a href='#'>< Anterior</a></li>";
                                                      }
                                                      for ($i = 1; $i <= $total_paginas; $i++) {
                                                        if ($pagina == $i) {
                                                          echo "<li class='active'><a href='#'>". $pagina ."</a></li>"; 
                                                        } else {
                                                          echo "<li ><a href='usuarios.php?pagina=$i'>$i</a> </li>"; 
                                                        } 
                                                      }
                                                      if (($pagina + 1)<=$total_paginas) {
                                                        echo "<li ><a href='usuarios.php?pagina=".($pagina+1)."'>Siguiente ></a></li>";
                                                      } else {
                                                        echo "<li ><a href='#'>Siguiente ></a></li>";
                                                      }    
                                                    }
                                              ?>  
                                  </ul>