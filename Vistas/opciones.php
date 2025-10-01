                                                            <div class="btn-group">
                                                                <button data-toggle="dropdown" class="btn btn-info dropdown-toggle btn-xs pre" title="ETAPAS" style="background:#2c0cdc;" type="button" >
                                                                <i class="fa fa-calendar"></i> <span class="caret"></span>
                                                                </button>
                                                                <ul role="menu" class="dropdown-menu pull-right" style="box-shadow: 5px 7px 11px 0px #949494;border: 2px solid #405467;">
                                                                <li><a onclick="verPaciente(<?php echo $mue['NroPaciente']; ?>);"  data-toggle="modal" data-target=".bs-example-modal-sm" style="color: black;" ><i class="fa fa-user"></i> Datos Paciente</a>
                                                                  </li>
                                                                  <li><a onclick="verId(<?php echo $mue['NroPaciente']; ?>);"  data-toggle="modal" data-target=".bs-example-modal-sm2" style="color: black;"><i class="fa fa-hospital-o"></i> Pre-trasplante</a>
                                                                  </li>
                                                                  <li><a onclick="verIdPost(<?php echo $mue['NroPaciente']; ?>);" data-toggle="modal" data-target=".bs-example-modal-sm3" style="color: black;" ><i class="fa fa-ambulance"></i> Post-Trasplante</a>
                                                                  </li>
                                                                  <li><a onclick="verIdAmpliacion(<?php echo $mue['NroPaciente']; ?>);" data-toggle="modal" data-target=".bs-example-modal-smAmpliacion" style="color: black;" ><i class="fa fa-external-link"></i> Ampliacion</a>
                                                                  </li>
                                                                </ul>
                                                            </div>
                                                        