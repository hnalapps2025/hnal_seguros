<?php 

include_once ('./../config.php');
include (MODEL_PATH."ModelProcedmientos.php");

error_reporting(0);

$sel =new ModelProcedmientos();


$function = $_GET["function"];
  


        if($function =="insertProc"){

                    
                $procedimientos = array();
                $procedimientos['iduser']      = $_POST["iduser"];
                $procedimientos['idPr']        = $_POST["idPr"];
                $procedimientos['idpresPro']   = $_POST["idpresPro"];
                $procedimientos['cant']        = $_POST["cant"];
                $procedimientos['codCpt']      = $_POST["codCpt"];
                $procedimientos['valor']       = $_POST["valor"];
                $procedimientos['desCpt']      = $_POST["desCpt"];
                $procedimientos['totalp']      = $_POST["totalp"];
                $procedimientos['dx']          = $_POST["dx"];
                
                
                $ni2 = $sel->createEditProced($procedimientos);   
                
        }


        else if($function =="agregarAten"){

                    
                $procedimientos = array();
                 $procedimientos['id']        = $_POST["id"];
                  $procedimientos['grupo']     = $_POST["grupo"];
                $procedimientos['user']      = $_POST["user"];
                 $procedimientos['tipo']      = $_POST["tipo"];
               
                
                
                $ni2 = $sel->agregarAtencionAuditadaPa($procedimientos);   
                
        }

        else if($function =="insertProcAuto"){


                $procedimientos = array();
                $procedimientos['iduser']          = $_POST["iduser"];
                $procedimientos['idPrAuto']        = $_POST["idPrAuto"];
                $procedimientos['idpresProAuto']   = $_POST["idpresProAuto"];
                $procedimientos['cantAuto']        = $_POST["cantAuto"];
                $procedimientos['codCptAuto']      = $_POST["codCptAuto"];
                $procedimientos['valorAuto']       = $_POST["valorAuto"];
                $procedimientos['desCptAuto']      = $_POST["desCptAuto"];
                $procedimientos['totalpAuto']      = $_POST["totalpAuto"];
                $procedimientos['dx']              = $_POST["dx"];
                
                $ni2 = $sel->createEditProcedAuto($procedimientos);   
                
        }
        
       else if($function =="regReconsideraciones"){

                    
                $procedimientos = array();
                $procedimientos['iduser']        = $_POST["iduser"];
                $procedimientos['ide']        = $_POST["ide"];
                $procedimientos['fuaSolicitado']   = trim($_POST["fuaSolicitado"]);
                $procedimientos['estado']   = $_POST["estado"];
                $procedimientos['fechaRe']   = $_POST["fechaRe"];
                $procedimientos['obsrAd']   = $_POST["obsrAd"];
                $procedimientos['resultado']   = $_POST["resultado"];
                $procedimientos['newOrden']   = $_POST["newOrden"];
                $procedimientos['fuare']   = $_POST["fuare"];
                $procedimientos['hiEn']   = $_POST["hiEn"];
                $procedimientos['ap']   = $_POST["ap"];
                $procedimientos['bp']   = $_POST["bp"];
                $procedimientos['cp']   = $_POST["cp"];
                $procedimientos['dp']   = $_POST["dp"];
                $procedimientos['ep']   = $_POST["ep"];
                
                $tmpFile = $_FILES['fileReconsi']['tmp_name'];
                $filename = '../pdfRECO/'. $_FILES['fileReconsi']['name'];
                move_uploaded_file($tmpFile,$filename);
                $procedimientos['fileReconsi']    = $_FILES['fileReconsi']['name'];
                

                $sel::updateRconsideracion($procedimientos);   
                
        }
        
        else if($function =="RegistroDatosWs"){



                    
                $procedimientos = array();
                $procedimientos['nroDoc'] = $_POST["nroDoc"];
                $procedimientos['user']        = $_POST["user"];
                $procedimientos['status']        = $_POST["status"];
                $procedimientos['regWebSis']   = trim($_POST["regWebSis"]);
                $procedimientos['planWebSis']   = $_POST["planWebSis"];
                $procedimientos['fechaAful']   = $_POST["fechaAful"];
                $procedimientos['nroAfil']   = $_POST["nroAfil"];
                $procedimientos['fechacaducidad']   = $_POST["fechacaducidad"];
                $procedimientos['item']   = $_POST["item"];

                $sel::guardarReporteSis($procedimientos);
                $sel::actualizarEstadoReporteSis($procedimientos);
                
                
        }
        
        
         else if($function =="RegistroDetallesRotulo"){

                    $procedimientos = array();
                    $procedimientos['id']       = $_POST["id"];
                    $procedimientos['code']     = $_POST["code"];
                    $procedimientos['rotulo']   = $_POST["rotulo"];
                    $procedimientos['chek']   = $_POST["chek"];
                    $procedimientos['cat']   = $_POST["cat"];
                    $procedimientos['gua']   = $_POST["gua"];

                    $sel::RegistroDetallesRotulo($procedimientos);
                    $sel::updatetallesRotulo($procedimientos);
                
        }
        
        
         else if($function =="registrarUserHisto"){

                    $procedimientos = array();
                    $procedimientos['id']     = $_POST["id"];
                    $procedimientos['chek']   = $_POST["chek"];
                    $procedimientos['user']   = $_POST["user"];
                
                 
                    $sel::updateHistoDet($procedimientos);
                
        }
        
        else if($function =="RegistroDatosWsMasivo"){



                    
                $procedimientos = array();
                $procedimientos['nroDoc'] = trim($_POST["nroDoc"]);
                $procedimientos['user']        = $_POST["user"];
                $procedimientos['status']        = $_POST["status"];
                $procedimientos['regWebSis']   = trim($_POST["regWebSis"]);
                $procedimientos['planWebSis']   = $_POST["planWebSis"];
                $procedimientos['fechaAful']   = $_POST["fechaAful"];
                $procedimientos['nroAfil']   = $_POST["nroAfil"];
                $procedimientos['fechacaducidad']   = $_POST["fechacaducidad"];
                $procedimientos['tipoDoc'] = trim($_POST["tipoDoc"]);
                $procedimientos['item'] = trim($_POST["idVal"]);
             

                $sel::guardarReporteSis($procedimientos);
                $sel::guardarReporteSisMasivo($procedimientos);
                
                
        }
        
        
        else if($function =="RegistroReglaConsistencia"){


                $procedimientos = array();
                $procedimientos['iduser']  = $_POST["iduser"];
                $procedimientos['idPac']   = $_POST["idPac"];
                $procedimientos['codCpms'] = $_POST["codCpms"];
                $procedimientos['cantidad'] = $_POST["cantidad"];
                $procedimientos['descripcion'] = $_POST["descripcion"];
                $procedimientos['precio'] = $_POST["precio"];
                $procedimientos['estancia'] = $_POST["estancia"];
               

                $sel::guardarReglaAuditoria($procedimientos);   
                
        }
        
        else if($function =="RegistroPacienteEm"){

                
                $procedimientos = array();
                $procedimientos['iduser']             = $_POST["iduser"];
                $procedimientos['ide']                = $_POST["ide"];
                $procedimientos['tipoReg']            = $_POST["tipoReg"];
                $procedimientos['fua']                = $_POST["fua"];
                $procedimientos['hisCli']             = $_POST["hisCli"];
                $procedimientos['tipoDoc']            = $_POST["tipoDoc"];
                $procedimientos['NroDoc']             = $_POST["NroDoc"];
                $procedimientos['seguros']            = $_POST["seguros"];
                $procedimientos['listaSeguros']       = $_POST["listaSeguros"];
                $procedimientos['ubicacion']          = $_POST["ubicacion"];
                $procedimientos['sexo']               = $_POST["sexo"];
                $procedimientos['cuenta']             = trim($_POST["cuenta"]);
                $procedimientos['NroAf']              = trim($_POST["NroAf"]);
                $procedimientos['eess']               = $_POST["eess"];
                $procedimientos['nombres']            = $_POST["nombres"];
                $procedimientos['FechaNac']           = $_POST["FechaNac"];
                $procedimientos['apepa']              = $_POST["apepa"];
                $procedimientos['apema']              = $_POST["apema"];
                $procedimientos['telefa']             = $_POST["telefa"];
                $procedimientos['edad']               = $_POST["edad"];
                $procedimientos['espost']             = $_POST["espost"];
                $procedimientos['fefa']               = $_POST["fefa"];
                $procedimientos['referido']           = $_POST["referido"];
                $procedimientos['pabellones']         = $_POST["pabellones"];
                $procedimientos['feingre']            = $_POST["feingre"];
                $procedimientos['feAlta']             = $_POST["feAlta"];
                $procedimientos['monGal']             = $_POST["monGal"];
                $procedimientos['montSif']            = $_POST["montSif"];
                $procedimientos['obsRes']             = $_POST["obsRes"];
                $procedimientos['envioA']             = $_POST["envioA"];
                $procedimientos['feuser']             = $_POST["feuser"];
                
                
                $procedimientos['actras']             = $_POST["actras"];
                $procedimientos['financia']           = $_POST["financia"];
                $procedimientos['regim']              = $_POST["regim"];
                $procedimientos['planSal']            = $_POST["planSal"];
                $procedimientos['tipoSeiN']           = $_POST["tipoSeiN"];
                $procedimientos['feSolAte']           = $_POST["feSolAte"];
                $procedimientos['ubicacionDes']       = $_POST["ubicacionDes"];
                $procedimientos['tipoSeiNDes']        = $_POST["tipoSeiNDes"];
                $procedimientos['feingreAlta']        = $_POST["feingreAlta"];
                $procedimientos['feAltaAlt']          = $_POST["feAltaAlt"]; 
                $procedimientos['monTotalCo']         = $_POST["monTotalCo"];
                $procedimientos['monCarGar']          = $_POST["monCarGar"];
                $procedimientos['fuaEntre']           = $_POST["fuaEntre"];
                $procedimientos['fechaFuaEntre']      = $_POST["fechaFuaEntre"];
                $procedimientos['fechaAful']          = $_POST["fechaAful"];
                
                $procedimientos['estaDias']          = $_POST["estaDias"];
                $procedimientos['emailAuto']         = $_POST["emailAuto"];
                $procedimientos['tipocita']          = $_POST["tipocita"];
                $procedimientos['serEspecia']        = $_POST["serEspecia"];
                $procedimientos['nroFuaInter']        = $_POST["nroFuaInter"];
                
                
                $tmpFile = $_FILES['file']['tmp_name'];
                $filename = '../pdfEmergencias/'. $_FILES['file']['name'];
                move_uploaded_file($tmpFile,$filename);

                $procedimientos['file']    = $_FILES['file']['name'];
                
                
                $procedimientos['cns']          = $_POST["cns"];
                $procedimientos['respbl']          = $_POST["respbl"];
                $procedimientos['ctaHos']          = $_POST["ctaHos"];
                $procedimientos['liquIx']          = $_POST["liquIx"];
                
                
                $procedimientos['origenEmer']          = $_POST["origenEmer"];
                $procedimientos['nroRefEmer']          = $_POST["nroRefEmer"];
                $procedimientos['eessInicio']          = $_POST["eessInicio"];
                $procedimientos['subirRef']            = $_POST["subirRef"];
                $procedimientos['nvaCta']              = trim($_POST["nvaCta"]);
                $procedimientos['ctaHos']              = trim($_POST["ctaHos"]);
                $procedimientos['rsatencion']          = $_POST["rsatencion"];
                $procedimientos['reciAudit']           = $_POST["reciAudit"];
                $procedimientos['registraAlta']        = $_POST["registraAlta"];
                $procedimientos['nroCxref']        = $_POST["nroCxref"];
                $procedimientos['segurosAl']        = $_POST["segurosAl"];
                
                
                $procedimientos['cuentaHsoMod']        = trim($_POST["cuentaHsoMod"]);
                $procedimientos['origenEmerMod']        = $_POST["origenEmerMod"];
                $procedimientos['ubicacionHosX']        = $_POST["ubicacionHosX"];
                $procedimientos['tipoSeiNHosx']        = $_POST["tipoSeiNHosx"];
                $procedimientos['essHos']        = $_POST["essHos"];
                $procedimientos['nroRefHZ']        = $_POST["nroRefHZ"];
                $procedimientos['dxDescricon']        = $_POST["dxDescricon"];
                $procedimientos['feReefHos']        = $_POST["feReefHos"];
                $procedimientos['especialidadHos']        = $_POST["especialidadHos"];
                $procedimientos['pab1Hos']        = $_POST["pab1Hos"];
                $procedimientos['camHos1']        = $_POST["camHos1"];
                $procedimientos['pab2Hos']        = $_POST["pab2Hos"];
                $procedimientos['camHos2']        = $_POST["camHos2"];
                
                $procedimientos['aceptarTransf']        = $_POST["aceptarTransf"];
                $procedimientos['listObsFua']        = $_POST["listObsFua"];
                $procedimientos['fuaRcxHos']        = $_POST["fuaRcxHos"];
                $procedimientos['idUserLiquida']    = $_POST["idUserLiquida"];
                 $procedimientos['statusRegPax']    = $_POST["statusRegPax"];
                $procedimientos['prioridad']    = $_POST["prioridad"];
                $procedimientos['tipoLiqux']    = $_POST["tipoLiqux"];
                $procedimientos['validarFua']    = $_POST["validarFua"];


                if($_POST["ide"]!=""){
                    $sel::updatePasoHospi($procedimientos);
                    $sel::updatePasoPaciente($procedimientos);
                }
                
                
                 if($_POST["idUserLiquida"]!="" ){
                     $sel::updateFechaUsuarioAudi($procedimientos);  
                 }
                 
              

                $sel::createEditPaciente($procedimientos);
                $sel::updateEstadoEnvio($procedimientos);  
                
        }
        
        
        
        else if($function =="RegistroAEm"){

                
                $procedimientos = array();
                $procedimientos['idusergru']      = $_POST["idusergru"];
                $procedimientos['idgroux']        = $_POST["idgroux"];
                $procedimientos['audiGrupo']      = $_POST["audiGrupo"];
                $procedimientos['obsGrupo']       = $_POST["obsGrupo"];
                $procedimientos['nomPac']         = $_POST["nomPac"];
                $procedimientos['feAsg']          = $_POST["feAsg"];
                $procedimientos['feRexc']         = $_POST["feRexc"];
              

                $ni2 = $sel->createEditGrupo($procedimientos);   
                
        }
        
        else if($function =="registroPaquete"){

                
                $procedimientos = array();
                $procedimientos['iduser']       = $_POST["iduser"];
                $procedimientos['idPak']        = $_POST["idPak"];
                $procedimientos['idGroup']      = $_POST["idGroup"];
                $procedimientos['listCaja']     = $_POST["listCaja"];
                 $procedimientos['listAuditx']     = $_POST["listAuditx"];
                 $procedimientos['listLix']     = $_POST["listLix"];
                $procedimientos['fechaHoraAsignadoDigitador']   = $_POST["fechaHoraAsignadoDigitador"];
                $procedimientos['fechaHoraUserAudix']   = $_POST["fechaHoraUserAudix"];
                
                
                $procedimientos['userAsignaAudi']   = $_POST["userAsignaAudi"];
                $procedimientos['userAsignaDigi']   = $_POST["userAsignaDigi"];
                
                
                $procedimientos['obsPaquete']         = $_POST["obsPaquete"];

                $ni2 = $sel->createEditPaquete($procedimientos);
                $ni2 = $sel->actualizarMasivoIduserAuditorXgrupo($procedimientos);
                
        }
        else if($function =="CreaMovimientoLaboratorio"){

                $procedimientos = array();
                $procedimientos['IdCuentaAtencion']   = $_POST["ctinmuno"];
                $procedimientos['IdPuntoCarga'] = 3; //A.P
                $procedimientos['idPersonaTomaLab']     = $_POST["idAuditorAsignado"];
                $procedimientos['idPersonaRecoge']     = $_POST["idAuditorAsignado"];
                $procedimientos['OrdenaPrueba']     = $_POST["mediSolicitante"];
                $procedimientos['idProductoCPT']     =  53375 ;
                $procedimientos['Fecha']   = $_POST["fechaPat"];
                $procedimientos['IdUsuario']       = $_POST["iduser"];
                $sel::CreaMovimientoLaboratorio($procedimientos);
               

        }
        
        
        else if($function =="registroPacientePatologia"){

                
                $procedimientos = array();
                $procedimientos['NumMovimiento']  =$_POST["NumMovimiento"];
                $procedimientos['cuentaAtencion']  =$_POST["cuentaAtencion"];
                $procedimientos['iduser']       = $_POST["iduser"];
                $procedimientos['idRegPatot']       = $_POST["idRegPatot"];
                $procedimientos['tipoDocPato']        = $_POST["tipoDocPato"];
                $procedimientos['nroDocPato']      = $_POST["nroDocPato"];
                $procedimientos['pacientePato']     = $_POST["pacientePato"];
                $procedimientos['edadPato']     = $_POST["edadPato"];
                $procedimientos['sexoPat']     = $_POST["sexoPat"];
                $procedimientos['financiaPTO']   = $_POST["financiaPTO"];
                $procedimientos['iprId']   = $_POST["iprId"];
                $procedimientos['juriPr']   = $_POST["juriPr"];
                $procedimientos['ctinmuno']   = $_POST["ctinmuno"];
                $procedimientos['historiaPat']         = $_POST["historiaPat"];
                $procedimientos['servicioPat']         = $_POST["servicioPat"];
                $procedimientos['salacamaPat']         = $_POST["salacamaPat"];
                $procedimientos['celularPacientePatologia']         = $_POST["celularPacientePatologia"];
                
                $procedimientos['tipoServicoPatl']         = $_POST["tipoServicoPatl"];
                $procedimientos['selecConvenio']         = $_POST["selecConvenio"];
                $procedimientos['ipressConvenio']         = $_POST["ipressConvenio"];
               
                
                $procedimientos['nroOrdenPat']     = $_POST["nroOrdenPat"];

                $procedimientos['nroSerie']     = $_POST["nroSerie"];
                $procedimientos['nroDocumento']     = $_POST["nroDocumento"];
                $procedimientos['ctaPadreVinculada']     = $_POST["ctaPadreVinculada"];
                $procedimientos['servPadreVincu']     = $_POST["servPadreVincu"];
                $procedimientos['nroOrdenVincuBoleta']     = $_POST["nroOrdenVincuBoleta"];
                $procedimientos['nroOrdenMovimiento']     = $_POST["NroOrdenMovimiento"];

                // // // DATOS DE ORDEN
                $procedimientos['iduser2']       = $_POST["iduser2"];
                $procedimientos['idRegSec2']        = $_POST["idRegSec2"];
                $procedimientos['factPat']      = $_POST["factPat"];
                $procedimientos['tipoEstPat']     = $_POST["tipoEstPat"];
                $procedimientos['procePat']     = $_POST["procePat"];
                $procedimientos['mediSolicitante']     = $_POST["mediSolicitante"];
                $procedimientos['especialPat']   = $_POST["especialPat"];
                $procedimientos['fechaPat']   = $_POST["fechaPat"];
                $procedimientos['corPat']     = $_POST["corPat"];
                $procedimientos['idAuditorAsignado']     = $_POST["idAuditorAsignado"];
                $procedimientos['subProcePat']     = $_POST["subProcePat"];
                $procedimientos['nroOrdenReceta']     = $_POST["nroOrdenReceta"];
                //muestras
                $procedimientos['muestras']     = $_POST["muestras"];
                $procedimientos['cantidadProce']     = $_POST["cantidadProce"];
                $procedimientos['tipoEstPatProced2']     = $_POST["tipoEstPatProced2"];
                $procedimientos['procePatProced2']     = $_POST["procePatProced2"];
                $procedimientos['subProcePatProced2']     = $_POST["subProcePatProced2"];
                $procedimientos['cantidadProcProced2']     = $_POST["cantidadProcProced2"];
                $procedimientos['NumeroProced']     = $_POST["NumeroProced"];

                $sel::registroPacientePatologia($procedimientos);
               
                
        }
        
         else if($function =="registroPacienteCervicoVaginal"){

                
                $procedimientos = array();
                $procedimientos['idCervico']       = $_POST["idCervico"];
                $procedimientos['fechaUltimaRegla']       = $_POST["fechaUltimaRegla"];
                $procedimientos['listEmbarazo']        = $_POST["listEmbarazo"];
                $procedimientos['listMetodoAnti']      = $_POST["listMetodoAnti"];
                $procedimientos['listTipoMetodoAntic']     = $_POST["listTipoMetodoAntic"];
                $procedimientos['TiempoUso']     = $_POST["TiempoUso"];
                $procedimientos['listExaGineco']     = $_POST["listExaGineco"];
                $procedimientos['obsExamenGinec']   = $_POST["obsExamenGinec"];
                $procedimientos['calidEspec']   = $_POST["calidEspec"];
                $procedimientos['especifiqueCalidadEspec']   = $_POST["especifiqueCalidadEspec"];
                $procedimientos['clasificacionGen']   = $_POST["clasificacionGen"];
                $procedimientos['EspecclasificacionGen']         = $_POST["EspecclasificacionGen"];
                $procedimientos['celulasEscamosas']         = $_POST["celulasEscamosas"];
                $procedimientos['especelulasEscamosas']         = $_POST["especelulasEscamosas"];
                $procedimientos['celGlandu']         = $_POST["celGlandu"];
                $procedimientos['espeCelGlandu']         = $_POST["espeCelGlandu"];
                $procedimientos['fechaConcySuger']         = $_POST["fechaConcySuger"];
                $procedimientos['dxRealizadoLab']         = $_POST["dxRealizadoLab"];
                $procedimientos['fechalab']         = $_POST["fechalab"];
                $procedimientos['nomObtencionMuestras']         = $_POST["nomObtencionMuestras"];
                $procedimientos['profeCargo']         = $_POST["profeCargo"];
                $procedimientos['fechaObtencMuestra']         = $_POST["fechaObtencMuestra"];
                $procedimientos['fechaColoscopia']         = $_POST["fechaColoscopia"];
                $procedimientos['especifColoscopia']         = $_POST["especifColoscopia"];
                $procedimientos['dxAnterior']         = $_POST["dxAnterior"];
                $procedimientos['fechadxAnterior']         = $_POST["fechadxAnterior"];
                $procedimientos['otrNeoMalig']         = $_POST["otrNeoMalig"];
                $procedimientos['celulBenignos']         = $_POST["celulBenignos"];
                $procedimientos['especifTipoOrg']         = $_POST["especifTipoOrg"];
                $procedimientos['cambioReactivos']         = $_POST["cambioReactivos"];
                $procedimientos['espeCambioReac']         = $_POST["espeCambioReac"];
                $procedimientos['patronHormonal']         = $_POST["patronHormonal"];
                $procedimientos['especifPatronHor']         = $_POST["especifPatronHor"];
                $procedimientos['datosResposanble']         = $_POST["datosResposanble"];
                $procedimientos['colegioResp']         = $_POST["colegioResp"];
                $procedimientos['nomApeConfir']         = $_POST["nomApeConfir"];
                $procedimientos['colegConfirma']         = $_POST["colegConfirma"];
                $procedimientos['txtAreaConclusiones']         = $_POST["txtAreaConclusiones"];
                $procedimientos['existeNeo_InformeCito']         = $_POST["existeNeo_InformeCito"];
                $procedimientos['EspecCelulasEndoCervicales']         = $_POST["EspecCelulasEndoCervicales"];
                $sel::registroPacienteCervicoVaginal($procedimientos);
               
                
        }
        else if ($function =="obtenerDatosPorMovimientos"){
                $procedimientos = array();
                $procedimientos['nroMovimiento']  = $_POST["nroMovimiento"];
                
                $sel::obtenerDatosPorMovimientos($procedimientos);

        }
        
        else if($function =="registroPacienteCervicoVaginalId"){

                
                $procedimientos = array();
                $procedimientos['idCervico']       = $_POST["idCervico"];
                $procedimientos['idUserCv']       = $_POST["idUserCv"];
               
               
                $sel::registroPacienteCervicoVaginalId($procedimientos);
               
                
        }
        
        
        else if($function =="registroPacientePatologia2"){

                
                $procedimientos = array();
                // $procedimientos['']
                $procedimientos['iduser2']       = $_POST["iduser2"];
                $procedimientos['idRegSec2']        = $_POST["idRegSec2"];
                $procedimientos['factPat']      = $_POST["factPat"];
                $procedimientos['tipoEstPat']     = $_POST["tipoEstPat"];
                $procedimientos['procePat']     = $_POST["procePat"];
                $procedimientos['mediSolicitante']     = $_POST["mediSolicitante"];
                $procedimientos['especialPat']   = $_POST["especialPat"];
                $procedimientos['fechaPat']   = $_POST["fechaPat"];
                $procedimientos['corPat']     = $_POST["corPat"];
                $procedimientos['idAuditorAsignado']     = $_POST["idAuditorAsignado"];


                $procedimientos['subProcePat']     = $_POST["subProcePat"];

                
                $sel::registroPacientePatologia2($procedimientos);
               
                
        }
        
        else if($function =="registroPacientePatologia3"){

                
                $procedimientos = array();
                
                $procedimientos['tipoRegPatolo']        = $_POST["tipoRegPatolo"];
                $procedimientos['tipoRegPatolo2']        = $_POST["tipoRegPatolo2"];
                
                if($_POST["tipoRegPatolo2"]==1){
                
                    $procedimientos['iduserPatol']       = $_POST["iduserPatol2"];
                    $procedimientos['idPat']             = $_POST["idPat2"];
                    $procedimientos['anaMuestraCito']    = $_POST["anaMuestra"];
                    $procedimientos['procedRealCito']    = $_POST["procedReal"];
                    $procedimientos['medicoSolcit']      = $_POST["medicoSolcit2"];
                    $procedimientos['dxClinicoHi']     = $_POST["dxClinicoHi2"];
                    $procedimientos['interpretacPato']   = $_POST["interpretacPato2"];
                    $procedimientos['comentarioPatol']   = $_POST["comentarioPatol2"];
                    $procedimientos['notaPatol']     = $_POST["notaPatol2"];
                    $procedimientos['idReportPdf']     = $_POST["idReportPdf"];
                    $procedimientos['nomApeConfirApepat']     = $_POST["nomApeConfirApepat"];
                    
                    
                } else if($_POST["tipoRegPatolo"]==2){
                
                    $procedimientos['iduserPatol']       = $_POST["iduserPatol"];
                    $procedimientos['idPat']        = $_POST["idPat"];
                    $procedimientos['anaMuestraCito']      = $_POST["anaMuestraCito"];
                    $procedimientos['procedRealCito']     = $_POST["procedRealCito"];
                    $procedimientos['medicoSolcit']     = $_POST["medicoSolcit"];
                    $procedimientos['dxClinicoHi']     = $_POST["dxClinicoHi"];
                    $procedimientos['interpretacPato']   = $_POST["interpretacPato"];
                    $procedimientos['comentarioPatol']   = $_POST["comentarioPatol"];
                    $procedimientos['notaPatol']     = $_POST["notaPatol"];
                    $procedimientos['idReportPdf']     = $_POST["idReportPdf"];
                    $procedimientos['nomApeConfirApepat']     = $_POST["nomApeConfirApepat"];
                    
                }
                
                
                $sel::registroPacientePatologia3($procedimientos);
                
               
                
        }
        

        else if($function =="registroPacientePatologia55"){

                
                $procedimientos = array();
                
                $procedimientos['idPat2222']        = $_POST["idPat2222"];
                $sel::registroPacientePatologia55($procedimientos);
                
               
                
        }
        
        
        else if($function =="registroPacientePatologia4"){

                
                $procedimientos = array();
                
                $procedimientos['tipoRegPatolo']        = $_POST["tipoRegPatolo"];
                $procedimientos['tipoRegPatolo2']        = $_POST["tipoRegPatolo2"];
                
                if($_POST["tipoRegPatolo2"]==1){
                
                    $procedimientos['iduserPatol']       = $_POST["iduserPatol2"];
                    $procedimientos['idPat']             = $_POST["idPat2"];
                    
                    
                    
                } else if($_POST["tipoRegPatolo"]==2){
                
                    $procedimientos['iduserPatol']       = $_POST["iduserPatol"];
                    $procedimientos['idPat']        = $_POST["idPat"];
                    
                }
                
                
                $sel::registroPacientePatologia4($procedimientos);
                
               
                
        }
        
        else if($function =="registroPacientePatologia4Gen"){

                
                $procedimientos = array();
                
                $procedimientos['tipoRegPatolo']        = $_POST["tipoRegPatolo"];
                $procedimientos['tipoRegPatolo2']        = $_POST["tipoRegPatolo2"];
                
                if($_POST["tipoRegPatolo2"]==1){
                
                    $procedimientos['iduserPatol']       = $_POST["iduserPatol2"];
                    $procedimientos['idPat']             = $_POST["idPat2"];
                    
                    
                    
                } else if($_POST["tipoRegPatolo"]==2){
                
                    $procedimientos['iduserPatol']       = $_POST["iduserPatol"];
                    $procedimientos['idPat']        = $_POST["idPat"];
                    
                }
                
                
                $sel::registroPacientePatologia4Gen($procedimientos);
                
               
                
        }
        
        
         else if($function =="registroPaqueteMarcador"){

                
                $procedimientos = array();
                $procedimientos['iduser']        = $_POST["iduser"];
                $procedimientos['idPak']         = $_POST["idPakMar"];
                $procedimientos['marcList']      = $_POST["marcList"];
                $procedimientos['resultMarcax']  = $_POST["resultMarcax"];
                
                $procedimientos['fomaCervi']  = $_POST["fomaCervi"];
                $procedimientos['tipoEsCervi']  = $_POST["tipoEsCervi"];
                
                $r1='';$r2='';$r3='';
                if($_POST["resulDepend"]==1){
                    $r1='NEGATIVO';
                }else if($_POST["resulDepend"]==2){
                    $r1='POSITIVO';
                }else if($_POST["resulDepend"]=="15"){
                    $r1='EXPRESION NUCLEAR INTACTA';
                }else if($_POST["resulDepend"]=="16"){
                    $r1='PERDIDA DE LA EXPRESION NUCLEAR';
                }else if($_POST["resulDepend"]=="17"){
                    $r1='NO PUEDE SER DETERMINADA';
                }
                
                
                if($_POST["intesTincion"]==1){
                    $r2="NINGUNA";
                }else if($_POST["intesTincion"]==2){
                    $r2="DÉBIL (+)";
                }else if($_POST["intesTincion"]==3){
                    $r2="MODERADA (++)";
                }
                else if($_POST["intesTincion"]==4){
                    $r2="INTENSA (+++)";
                }
                
                
                if($_POST["nucleosPos"]==1){
                    $r3="0";
                }else if($_POST["nucleosPos"]==2){
                    $r3="< 1%";
                }else if($_POST["nucleosPos"]==3){
                    $r3="1% a 10%";
                }else if($_POST["nucleosPos"]==4){
                    $r3="11% a 33%";
                }else if($_POST["nucleosPos"]==5){
                    $r3="34% a 66%";
                }else if($_POST["nucleosPos"]==6){
                    $r3="> 67%";
                }
                
                
                
                
                
                $procedimientos['resulDepend']  = $r1;
                $procedimientos['intesTincion']  = $r2;
                $procedimientos['nucleosPos']  = $r3;
                $procedimientos['subtotalPun']  = $_POST["subtotalPun"];
                $procedimientos['interpretHi']  = $_POST["interpretHi"];
                $procedimientos['idPrin']  = $_POST["idPrin"];
                
                
                

                $ni2 = $sel->createEditPaqueteMarcador($procedimientos);
            
                
        }
        
        else if($function =="registroFechaDig"){

                
                $procedimientos = array();
                $procedimientos['iduser']           = $_POST["iduser"];
                $procedimientos['idPakDig']            = $_POST["idPakDig"];
                $procedimientos['fechaDigitacion']  = $_POST["fechaDigitacion"];
               $procedimientos['fechaDevolucion']  = $_POST["fechaDevolucion"];
               
               $procedimientos['digit']  = $_POST["digit"];
               $procedimientos['motivoDif']  = $_POST["motivoDif"];
               

                $ni2 = $sel->createEditFechaDig($procedimientos);   
                
        }
        
        else if($function =="RegistroCaja"){

                
                $procedimientos = array();
                $procedimientos['iduser']       = $_POST["iduser"];
                $procedimientos['idCaja']         = $_POST["idCaja"];
                $procedimientos['archix']       = $_POST["archix"];
                $procedimientos['obsCaja']       = $_POST["obsCaja"];
                $procedimientos['ediCaja']       = $_POST["ediCaja"];
              

                $ni2 = $sel->createEditCaja($procedimientos);
                $ni22 = $sel->insertarObsdeCaja($procedimientos); 
                
        }
        
        
        
        else if($function =="RegistroPacienteEmCE"){

                
                $procedimientos = array();
                $procedimientos['iduserCE']          = $_POST["iduserCE"];
                $procedimientos['ideCE']        = $_POST["ideCE"];
                $procedimientos['tipoReg']   = $_POST["tipoReg"];
                $procedimientos['fuaCE']        = $_POST["fuaCE"];
                $procedimientos['hisCliCE']      = $_POST["hisCliCE"];
                $procedimientos['tipoDocCE']       = $_POST["tipoDocCE"];
                $procedimientos['NroDocCE']      = $_POST["NroDocCE"];
                $procedimientos['seguros']      = $_POST["seguros"];
                $procedimientos['listaSeguros']              = $_POST["listaSeguros"];
                $procedimientos['ubicacionCE']              = $_POST["ubicacionCE"];
                $procedimientos['sexoCE']              = $_POST["sexoCE"];
                $procedimientos['cuenta']              = $_POST["cuenta"];
                $procedimientos['NroAf']              = $_POST["NroAf"];
                $procedimientos['eess']              = $_POST["eess"];
                $procedimientos['nombresCE']              = $_POST["nombresCE"];
                $procedimientos['FechaNacCE']              = $_POST["FechaNacCE"];
                $procedimientos['apepaCE']              = $_POST["apepaCE"];
                $procedimientos['apemaCE']              = $_POST["apemaCE"];
                $procedimientos['telefa']              = $_POST["telefa"];
                $procedimientos['edadCE']              = $_POST["edadCE"];
                $procedimientos['espost']              = $_POST["espost"];
                $procedimientos['fefa']              = $_POST["fefa"];
                $procedimientos['referido']              = $_POST["referido"];
                $procedimientos['pabellones']              = $_POST["pabellones"];
                $procedimientos['feingreCE']              = $_POST["feingreCE"];
                $procedimientos['feAlta']              = $_POST["feAlta"];
                $procedimientos['monGalCE']              = $_POST["monGalCE"];
                $procedimientos['montSifCE']              = $_POST["montSifCE"];
                $procedimientos['obsResCE']              = $_POST["obsResCE"];
                $procedimientos['grupo']              = $_POST["grupo"];
                $procedimientos['valAte']              = $_POST["valAte"];
                $procedimientos['coPre']              = $_POST["coPre"];
                $procedimientos['cie10_1x']              = $_POST["cie10_1x"];
                $procedimientos['tip1']              = $_POST["tip1"];
                 $procedimientos['cie10_2x']              = $_POST["cie10_2x"];
                $procedimientos['tip2']              = $_POST["tip2"];
                 $procedimientos['cie10_3x']              = $_POST["cie10_3x"];
                $procedimientos['tip3']              = $_POST["tip3"];
                 $procedimientos['cie10_4x']              = $_POST["cie10_4x"];
                $procedimientos['tip4']              = $_POST["tip4"];
                 $procedimientos['cie10_5x']              = $_POST["cie10_5x"];
                $procedimientos['tip5']              = $_POST["tip5"];
                
                

                $ni2 = $sel->createEditPacienteCE($procedimientos);   
                
        }
        
        

        else if($function =="eliminarPr"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarPr($deletePr);

                
        }
        
         else if($function =="eliminarCpmsHnal"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarHnalCpms($deletePr);

                
        }
        
        
         else if($function =="revertirCEHnal"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->revertirHnalRegistro($deletePr);

                
        }
        
        
        else if($function =="eliminarRegEmergHospi"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarRegEmergHospi($deletePr);
                $ni22 = $sel->eliminarRegDePackage($deletePr);

                
        }
        
        else if($function =="eliminarRegCirugia"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarRegCirugia($deletePr);
    
                
        }
        
         else if($function =="eliminarRegReferencias"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarRegRefer($deletePr);
                
        }
        
        
         else if($function =="eliminarDxHists"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarDxHists($deletePr);
                
        }
        
         else if($function =="eliminarDxPreoPer"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarDxPreoPer($deletePr);
                
        }
        
        
         else if($function =="eliminarDxPostOper"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarDxPostoPer($deletePr);
                
        }
        
        
         else if($function =="eliminarAIntervAsis"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarIntervencionReal($deletePr);
                
        }
        
        
        else if($function =="eliminarCiruAsis"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarCirujanoAsist($deletePr);
                
        }
        
         else if($function =="eliminarTratHists"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarTratHists($deletePr);
                

                
        }
        
        
        
        else if($function =="deleteExamnHist"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->deleteExamnHist($deletePr);
                

                
        }
        
        
        else if($function =="deleteSignosSinto"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->deleteSignosSinto($deletePr);
                

                
        }
        
        else if($function =="deleteMuesPato"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->deleteMuesPato($deletePr);
                

                
        }
        
        
        else if($function =="quitarCaja"){

                    
                $deletePr = array();
                $deletePr['cod'] = $_POST["cod"];            
                
                $ni2 = $sel->updateEstPaque($deletePr);

                
        }
        
        
         else if($function =="eliminarRegistroPato"){

                    
                $deletePr = array();
                $deletePr['cod'] = $_POST["cod"];            
                
                $sel::eliminarRegistroPato($deletePr);

                
        }
        
        else if($function =="habilitarRegistroPato"){

                    
                $deletePr = array();
                $deletePr['cod'] = $_POST["cod"];            
                
                $sel::habilitarRegistroPato($deletePr);

                
        }
        
         else if($function =="eliminarExan"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];            
                
                $ni2 = $sel->deleteTranas($deletePr);

        }
        
        
         else if($function =="eliminarExanMarc"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];            
                
                $ni2 = $sel->deleteTranasMarcador($deletePr);

        }
        
        else if($function =="eliminarObsPaxc"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];            
                
                $ni2 = $sel->deleteTranasPaxObs($deletePr);

        }


        else if($function =="eliminarExte"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];            
                
                $ni2 = $sel->eliminarExte($deletePr);

        }

        else if($function =="eliminarObsPaxcRegCitoEs"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];            
                
                $ni2 = $sel->eliminarObsPaxcRegCitoEs($deletePr);

        }
        
        else if($function =="eliminarObsCajas"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];            
                
                $ni2 = $sel->deleteTranasPaxObsCajas($deletePr);

        }
        
        else if($function =="libreCajas"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];            
                
                $ni2 = $sel->libresCajas($deletePr);

        }
        
         else if($function =="eliminarAuditAct"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];            
                
                $ni2 = $sel->deleteActAudi($deletePr);

        }
        
        
         else if($function =="EliminarObsRerPaxRo"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];
                $deletePr['ro'] = $_POST["ro"];
                $deletePr['formato'] = $_POST["formato"];
                $deletePr['tipoEst'] = $_POST["tipoEst"];
                
                $ni2 = $sel->deleteTranasPaxObsRo($deletePr);
                $sel::deleteDetalleRo($deletePr);
                //$sel::deleteMarcador($deletePr);
                

        }
        
        else if($function =="EliminarTacosXuno"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];
               
                
                $ni2 = $sel->EliminarTacosXuno($deletePr);
               
                

        }
        
         else if($function =="eliminarFuaPaq"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];
                $deletePr['tipo'] = $_POST["tipo"]; 
                
                $ni2 = $sel->eliminarFuaPaq($deletePr);

        }
        
        
        
         else if($function =="eliminarExanRef"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["cod"];            
                
                $ni2 = $sel->deleteTranasRef($deletePr);

                
        }
        
         else if($function =="eliminarFuaHnal"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarFuACpms($deletePr);

                
        }
        
         else if($function =="deletPackHnal"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];       
                
                $ni2 = $sel->eliminarPackC($deletePr);
                $ni2 = $sel->eliminarFuasXPaquete($deletePr);
                

                
        }
        
        else if($function =="deleteDesignFuas"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];       
                
                $ni2 = $sel->eliminarDesignFux($deletePr);
             
                

                
        }
        
        else if($function =="deleteCjasPa"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];       
                
                $ni2 = $sel->eliminarCaja($deletePr);
             
                

                
        }
        
         else if($function =="limpiarAsignaci"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->limpiarAsignaci($deletePr);

                
        }
        
        
        else if($function =="recepcionAoc"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->recepcionAoc($deletePr);

                
        }
        
        
        
        else if($function == "RegistroExamen"){
        
                    
            $examen = array();
        
            $examen['iduserEx'] = $_POST["iduserEx"];
            $examen['iddEx'] = $_POST["iddEx"]; 
            $examen['fechaex']= $_POST["fechaex"];
            $examen['nrotrans']= $_POST["nrotrans"];
            $examen['eessRefModal']= $_POST["eessRefModal"];
        
            $ni2 = $sel->InsertEx($examen); 
               

        }
        
        
        else if($function == "registroMotivo"){
        
                    
            $examen = array();
        
            $examen['iduserMo'] = $_POST["iduserMo"];
            $examen['idMo'] = $_POST["idMo"];
            $examen['motivoHabiBoton']= $_POST["motivoHabiBoton"];
            
        
            $ni2 = $sel->registroMotivo($examen); 
               

        }
        
        
        else if($function == "insertDxHistoria"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['idHis'] = $_POST["idHis"]; 
            $examen['tipoDx']= $_POST["tipoDx"];
            $examen['descripDx']= $_POST["descripDx"];
            
        
            $ni2 = $sel->insertDxHistoria($examen); 
               

        }
        
        
        else if($function == "insertSignosSintomas"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['idHis'] = $_POST["idHis"]; 
            $examen['tipoDx']= $_POST["tipoDx"];
            $examen['descripDx']= $_POST["descripDx"];
            
        
            $ni2 = $sel->insertSignosSintomas($examen); 
               

        }
        
        else if($function == "insertDxPreOpera"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['idHis'] = $_POST["idHis"]; 
            $examen['tipoDx']= $_POST["tipoDx"];
            $examen['descripDx']= $_POST["descripDx"];
            
        
            $ni2 = $sel->insertDxPreOpera($examen); 
               

        }
        
        
         else if($function == "insertDxPostOpera"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['idHis'] = $_POST["idHis"]; 
            $examen['tipoDx']= $_POST["tipoDx"];
            $examen['descripDx']= $_POST["descripDx"];
            
        
            $ni2 = $sel->insertDxPostOpera($examen); 
               

        }
        
        
        else if($function == "insertTratHistoria"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['idHis'] = $_POST["idHis"]; 
            $examen['tipoDx']= $_POST["tipoDx"];
            $examen['descripDx']= $_POST["descripDx"];
            
        
            $ni2 = $sel->insertTratHistoria($examen); 
               

        }
        
        else if($function == "insertExamenesAuxi"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['idHis'] = $_POST["idHis"]; 
            $examen['tipoDx']= $_POST["tipoDx"];
            $examen['descripDx']= $_POST["descripDx"];
            
        
            $ni2 = $sel->insertExamenesAuxi($examen); 
               

        }
        
        
         else if($function == "insertIntervencionRealizada"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['idHis'] = $_POST["idHis"]; 
            $examen['tipoDx']= $_POST["tipoDx"];
            $examen['descripDx']= $_POST["descripDx"];
            
        
            $ni2 = $sel->insertIntervencionRealizada($examen); 
               

        }
        
        else if($function == "insertCirujanoAsist"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['idHis'] = $_POST["idHis"]; 
            $examen['tipoDx']= $_POST["tipoDx"];
            $examen['descripDx']= $_POST["descripDx"];
            
        
            $ni2 = $sel->insertCirujanoAsist($examen); 
               

        }
        
        else if($function == "RegistroObsePax"){
        
                    
            $examen = array();
        
            $examen['iduserObsaPax'] = $_POST["iduserObsaPax"];
            $examen['idPaObs'] = $_POST["idPaObs"]; 
            $examen['obsPaix']= $_POST["obsPaix"];
            $examen['ids']= $_POST["ids"];
            $examen['codeXcuenta']= $_POST["codeXcuenta"];
           
            $ni2 = $sel->InsertObserPax($examen); 
               

        }

        else if($function == "RegistroCitoEspec"){
        
                    
                $examen = array();
            
                $examen['idProcedCito'] = $_POST["idProcedCito"];
                $examen['cptCitoEs'] = $_POST["cptCitoEs"]; 
                $examen['descrEspecCito']= $_POST["descrEspecCito"];
                $examen['selecCitoEspec']= $_POST["selecCitoEspec"];
                             
                $ni2 = $sel->RegistroCitoEspec($examen); 
                   
    
            }
            else if($function == "RegistroCitoEspec_InformeCito"){
        
                    
                $examen = array();
            
                $examen['idRegPatot_InformeCito'] = $_POST["idRegPatot_InformeCito"];
                $examen['cptCitoEs_informeCito'] = $_POST["cptCitoEs_informeCito"]; 
                $examen['descrEspecCito_informeCito']= $_POST["descrEspecCito_informeCito"];
                $examen['selecCitoEspec']= $_POST["selecCitoEspec"];
                             
                $ni2 = $sel->RegistroCitoEspec_InformeCito($examen); 
                   
    
            }
        
         else if($function == "RegistroUsuario"){
        
                    
            $examen = array();
            
            $examen['idUSX'] = $_POST["idUSX"];
            $examen['ide'] = $_POST["ide"];
            
            $examen['teleusu']= $_POST["teleusu"];
            $examen['nomusu']= $_POST["nomusu"];
            $examen['profeSys']= $_POST["profeSys"];
            $examen['areaUnid']= $_POST["areaUnid"];
            $examen['celUsu']= $_POST["celUsu"];
            $examen['emailusu']= $_POST["emailusu"];
            $examen['estadousu']= $_POST["estadousu"];
            $examen['password']= $_POST["password"];
            $examen['idEstabel']= $_POST["idEstabel"];
           
           
            $user = explode(",", $_POST['nomusu']);
    		$userApellidos = $user[0];
    		$userNombres = $user[1];
    		$letr1 = $userNombres[0];
    		
    		$deli= explode(" ", $userApellidos);
    		$Ape1 = $deli[0];
    		$Ape2 = $deli[1];
    		$ini =$Ape2[0];
    		
    		$userusu =	strtoupper($letr1.$Ape1.$ini);
            $examen['userusu']= $userusu;
            $codu=date("YmdHis");
            $examen['active']= $codu;
            
            $examen['coleUsu']= $_POST["coleUsu"];
            $examen['cagoocu']= $_POST["cagoocu"];
           
            $ni2 = $sel->InsertUsuario($examen); 
            $sel::envioCorreoUsuario($examen['emailusu'],$examen['nomusu'],$userusu,$examen['password'],$examen['active']);
            
        }
        
        
         else if($function == "RegistroUsuarioInt"){
        
                    
            $examen = array();
            
            $examen['idUSX'] = $_POST["idUSX"];
            $examen['ide'] = $_POST["ide"];
            
            $examen['teleusu']= $_POST["teleusu"];
            $examen['nomusu']= $_POST["nomusu"];
            $examen['emailusu']= $_POST["emailusu"];
            $examen['estadousu']= $_POST["estadousu"];
            $examen['userusu']= $_POST["userusu"];
            $examen['password']= $_POST["password"];
            
            
            $ni2 = $sel->InsertUsuarioInterno($examen); 
            
            
        }
        
        
        else if($function == "envioEmail"){
        
                    
            $examen = array();
            
            $examen['idContra'] = $_POST["idContra"];
            $examen['passWordC'] = $_POST["passWordC"];
           
            $ni2 = $sel->updateContrasena($examen); 
            
            
        }
        
        
         else if($function == "registroActividadAudi"){
        
                    
            $examen = array();
       
            $examen['ide'] = $_POST["ide"];
            $examen['idUser'] = $_POST["iduser"];
            $examen['idActividad'] = $_POST["idActividad"];
            $examen['actividadAudit'] = $_POST["actividadAudit"]; 
            $examen['proceAuditoria']= $_POST["proceAuditoria"];
            $examen['dxAudito']= $_POST["dxAudito"];
            $examen['observAuditForm']= $_POST["observAuditForm"];
           
            $ni2 = $sel->InsertActiAudi($examen); 
               

        }
        
        
        else if($function == "RegistroObsePaxRotulo"){
        
                    
                $examen = array();
            
                $examen['iduser'] = $_POST["iduser"];
                $examen['ideRo'] = $_POST["ideRo"];
                $examen['rotulo'] = $_POST["rotulo"]; 
                $examen['tacos']= $_POST["tacos"];
                $examen['descrRot']= $_POST["descrRot"];
                $examen['categoria']= $_POST["categoria"];
                $examen['cortesRot']= $_POST["cortesRot"];
                $examen['idcateg']= $_POST["idcateg"];
                $examen['plantillaApe']= $_POST["plantillaApe"];
                $examen['tipoDecrp']= $_POST["tipoDecrp"];
                $examen['formatoPatologiaMac']= $_POST["formatoPatologiaMac"];
                $examen['filtroTipoEst']= $_POST["filtroTipoEst"];
                $examen['idRegRot']= $_POST["idRegRot"];
                $examen['lblUserDecri']= $_POST["lblUserDecri"];
    
    
                $examen['calidadMuesCitoEsp']= $_POST["calidadMuesCitoEsp"];
                $examen['hallazgo']= $_POST["hallazgo"];
                $examen['sisReporEspex']= $_POST["sisReporEspex"];
                $examen['clasisEspec']= $_POST["clasisEspec"];
                $examen['existeNeo'] = $_POST["existeNeo"];
               
                $ni2 = $sel->InsertObserPaxRotulo($examen);
                
                if($_POST["ideRo"]==""){
                     $ni2 = $sel->InsertDetallePaxRotulo($examen);
                }else if($_POST["tipoDecrp"]==0){
                    $ni2 = $sel->InsertDetallePaxRotulo($examen);
                }
               
                
                   
    
            }


        else if($function == "RegistroExtension"){
        
                    
                $examen = array();
            
                $examen['iduserExt']    = $_POST["iduserExt"];
                $examen['ideExtns']     = $_POST["ideExtns"];
                $examen['tipoExtse']    = $_POST["tipoExtse"]; 
                $examen['dxExten']      = $_POST["dxExten"];
                $examen['interExten']   = $_POST["interExten"];
                $examen['comeExtsn']    = $_POST["comeExtsn"];
                $examen['notaExten']    = $_POST["notaExten"];
               
                $ni2 = $sel->InsertRegistroExtension($examen);
                
    
            }
        
        
         else if($function == "rsptaMicroscopia"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['ideRoT'] = $_POST["ideRoT"];
            $examen['rsptaMic'] = $_POST["rsptaMic"];
           
            $ni2 = $sel->rsptaMicroscopia($examen);
          

        }
        
        else if($function == "ObsMicroscopiaFrm"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['ideMicroObs'] = $_POST["ideMicroObs"];
            $examen['obsMicrotextArea'] = $_POST["obsMicrotextArea"];
           
            $ni2 = $sel->ObsMicroscopiaFrm($examen);
          

        }
        
         else if($function == "obsMacroscopia"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['ideRoTMacro'] = $_POST["ideRoTMacro"];
            $examen['rsptaMacro'] = $_POST["rsptaMacro"];
           
            $ni2 = $sel->obsMacroscopia($examen);
          

        }
        
         else if($function == "rsptaMicroscopiaLab"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['ideRoTLab'] = $_POST["ideRoTLab"];
            $examen['rsptaMicLab'] = $_POST["rsptaMicLab"];
            $examen['tipoLab'] = $_POST["tipoLab"];
           
           $ni2 = $sel->rsptaMicroscopiaLab($examen);
          

        }
        
        else if($function == "obsMicroLabMix"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['ideRoTLabMicro'] = $_POST["ideRoTLabMicro"];
            $examen['rsptObsLabMij'] = $_POST["rsptObsLabMij"];
            $examen['tipoLabMicor'] = $_POST["tipoLabMicor"];
           
           $ni2 = $sel->obsMicroLabMix($examen);
          

        }
        
        
         else if($function == "rsptaObscopiaLab"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['ideRoTLab'] = $_POST["ideObsRoTLab"];
            $examen['rsptaMicLab'] = $_POST["rsptaObsMicLab"];
            $examen['tipoMac'] = $_POST["tipoMac"];
           
            $ni2 = $sel->rsptaObscopiaLab($examen);
          

        }
        
         else if($function == "registroProgCirugias"){
        
                    
            $examen = array();
        
            $examen['iduser'] = $_POST["iduser"];
            $examen['ide'] = $_POST["ide"];
            $examen['especialCirugia'] = $_POST["especialCirugia"];
            $examen['tipoDocCiru'] = $_POST["tipoDocCiru"];
            $examen['nroDocCiru'] = $_POST["nroDocCiru"];
            $examen['pacienCIruProg'] = $_POST["pacienCIruProg"];
            $examen['edadCiruProg'] = $_POST["edadCiruProg"];
            $examen['historiaCiru'] = $_POST["historiaCiru"];
            $examen['celularCiru'] = $_POST["celularCiru"];
            
            $examen['dxcie10'] = $_POST["dxcie10"];
            $examen['tip3'] = $_POST["tip3"];
            $examen['dxpreop'] = $_POST["dxpreop"];
            $examen['tipoEstPat'] = $_POST["tipoEstPat"];
            $examen['procedQx'] = $_POST["procedQx"];
            $examen['tipoAnestesiaProg'] = $_POST["tipoAnestesiaProg"];
            $examen['tipoCirugiaProg'] = $_POST["tipoCirugiaProg"];
            $examen['pabellonCirugia'] = $_POST["pabellonCirugia"];
            $examen['listSalaCi'] = $_POST["listSalaCi"];
            $examen['fechaInterve'] = $_POST["fechaInterve"];
            $examen['horaInterve'] = $_POST["horaInterve"];
            $examen['cirugiaIndicaPor'] = $_POST["cirugiaIndicaPor"];
            $examen['cirujanoPri'] = $_POST["cirujanoPri"];
            $examen['anestesiologo'] = $_POST["anestesiologo"];
            $examen['servicioInterCiru'] = $_POST["servicioInterCiru"];
            $examen['nroCamaProg'] = $_POST["nroCamaProg"];
            $examen['estadoCirugiaProg'] = $_POST["estadoCirugiaProg"];
            $examen['financiaCirugia'] = $_POST["financiaCirugia"];
           
            
        
           
            $ni2 = $sel->InsertRegistroProgCirugias($examen); 
               

        }
        
        
         else if($function == "registroDatosReporteOperatorio"){
        
                    
            $examen = array();
            $examen['ide']             = $_POST["ide"];
            $examen['iduser']          = $_POST["iduser"];
            $examen['fechAhoraInicio'] = $_POST["fechAhoraInicio"];
            $examen['fechaHoraFin']    = $_POST["fechaHoraFin"];
            $examen['descrReporOpe']   = $_POST["descrReporOpe"];
            $examen['compliQirurgica'] = $_POST["compliQirurgica"];
            $examen['cirujanoPreo']    = $_POST["cirujanoPreo"];
            $examen['anesteReporte']   = $_POST["anesteReporte"];
            $examen['instrumentRepo']  = $_POST["instrumentRepo"];
            $examen['obserReporOpera'] = $_POST["obserReporOpera"];
            $examen['muestraPato'] = $_POST["muestraPato"];
           
            $ni2 = $sel->modelRegisterReporteOperatorio($examen); 
               

        }
        
        else if($function == "RegistroExamenRef"){
        
                    
            $examen = array();
        
            $examen['iduserEx'] = $_POST["iduserEx"];
            $examen['iddExRef'] = $_POST["iddExRef"]; 
            $examen['fechaexRef']= $_POST["fechaexRef"];
            $examen['nrotransFeR']= $_POST["nrotransFeR"];
            $examen['eesRef']= $_POST["eesRef"];
        
            $ni2 = $sel->InsertExRef($examen); 
               

        }
        
        else if($function == "RegistroSesion"){
        
                    
            $examen = array();
        
            $examen['iduserSe'] = $_POST["iduserSe"];
            $examen['idSes'] = $_POST["idSes"]; 
            $examen['fechaSesion']= $_POST["fechaSesion"];
            $examen['nspModal']= $_POST["nspModal"];
            $examen['devModal']= $_POST["devModal"];
            $examen['obsSesion']= $_POST["obsSesion"];
            $examen['repoQuimi']= $_POST["repoQuimi"];
        
            $ni2 = $sel->insertSessiones($examen); 
               
        //
        }
        
        else if($function =="eliminarPrAuto"){

                    
                $deletePr = array();
                $deletePr['id'] = $_POST["id"];            
                
                $ni2 = $sel->eliminarPrAuto($deletePr);   
                
        }


        else if($function =="regMasivo"){

                    
                $procedimientos = array();
                
                $procedimientos['auditor']    = $_POST["auditor"];
                $procedimientos['fua']        = $_POST["fua"];

                $sel::updateAuditorMasivo($procedimientos);   
                
        }
        
         else if($function =="regMuestraIndividualPato"){

                    
                $procedimientos = array();
                
                $procedimientos['iduser']    = $_POST["iduser"];
                $procedimientos['muestra']   = $_POST["muestra"];
                $procedimientos['tipoEstPat']   = $_POST["tipoEstPat"];
                $procedimientos['nroOrdenPat']   = $_POST["nroOrdenPat"];
                $procedimientos['id']   = $_POST["id"];

                $sel::regMuestraIndividualPato($procedimientos);   
                
        }
        
        
         else if($function =="regMasivoCE"){

                    
                $procedimientos = array();
                
                $procedimientos['auditorCE']    = $_POST["auditorCE"];
                $procedimientos['fuaCE']        = $_POST["fuaCE"];

                $sel::updateAuditorMasivoCE($procedimientos);   
                
        }
        
        else if($function =="regMasivoLiq"){

                    
                $procedimientos = array();
                
                $procedimientos['auditorCE']    = $_POST["auditorCE"];
                $procedimientos['fuaCE']        = $_POST["fuaCE"];

                $sel::regMasivoLiq($procedimientos);   
                
        }
        
         else if($function =="regMasivoCAja"){

                    
                $procedimientos = array();
                
                $procedimientos['caja']             = $_POST["caja"];
                $procedimientos['id']               = $_POST["id"];
                $procedimientos['user']             = $_POST["user"];
                $procedimientos['fechaHoraAsigCaja']= $_POST["fechaHoraAsigCaja"];

                $sel::updateAuditorMasivoCajas($procedimientos);   
                
        }
        
        else if($function =="deleteFuasMasivo"){

                    
                $procedimientos = array();
                
                $procedimientos['fua']        = $_POST["fua"];

                $sel::deleteFuaMasivo($procedimientos);   
                
        }
        
        
        
        
         else if($function =="deleteSesions"){

                    
                $procedimientos = array();
                
                $procedimientos['id']        = $_POST["id"];

                $sel::deleteIdSesion($procedimientos);   
                
        }
        
        
        else if($function =="regMasivoRec"){

                    
                $procedimientos = array();
                
                $procedimientos['auditor']    = $_POST["auditor"];
                $procedimientos['fua']        = $_POST["fua"];

                $sel::updateAuditorMasivoRec($procedimientos);   
                
        }
        
        
        else if($function =="regMAsiCajax"){

                    
                $procedimientos = array();
                $procedimientos['est']    = "1";
                $procedimientos['tipo']    = $_POST["tipo"];
                $procedimientos['us']    = $_POST["us"];
                $sel::regMAsiCajax($procedimientos);   
                
        }
        
        
         else if($function =="RegistrarReferencias"){

                    
                $procedimientos = array();
         
                 $procedimientos['iduser']    = $_POST["iduser"];
                 $procedimientos['ideRef']    = $_POST["ideRef"];
                 $procedimientos['tipoDocRef']    = $_POST["tipoDocRef"];
                 $procedimientos['NroDocRef']    = $_POST["NroDocRef"];
                 $procedimientos['paxRef']    = $_POST["paxRef"];
                 $procedimientos['sexoRef']    = $_POST["sexoRef"];
                 $procedimientos['FechaNacRef']    = $_POST["FechaNacRef"];
                 $procedimientos['edadRef']    = $_POST["edadRef"];
                 $procedimientos['iafasRef']    = $_POST["iafasRef"];
                 $procedimientos['tipoSegRef']    = $_POST["tipoSegRef"];
                 $procedimientos['afiliaRef']    = $_POST["afiliaRef"];
                 $procedimientos['caduciRef']    = $_POST["caduciRef"];
                 $procedimientos['domiRef']    = $_POST["domiRef"];
                 $procedimientos['depaRef']    = $_POST["depaRef"];
                 $procedimientos['provRef']    = $_POST["provRef"];
                 $procedimientos['disRef']    = $_POST["disRef"];
                 $procedimientos['actrasRef']    = $_POST["actrasRef"];
                 $procedimientos['tipoAccRef']    = $_POST["tipoAccRef"];
                 $procedimientos['lisDocs']    = $_POST["lisDocs"];
                 $procedimientos['ingresoReferido']    = $_POST["ingresoReferido"];
                 $procedimientos['idEstabelRef']    = $_POST["idEstabelRef"];
                 $procedimientos['fechaIngresoRef']    = $_POST["fechaIngresoRef"];
                 $procedimientos['servicioOrigenRef']    = $_POST["servicioOrigenRef"];
                 $procedimientos['servDestRef']    = $_POST["servDestRef"];
                 $procedimientos['especialidadRef']    = $_POST["especialidadRef"];
                 $procedimientos['motivoRef']    = $_POST["motivoRef"];
                 $procedimientos['condPcte']    = $_POST["condPcte"];
                 $procedimientos['tipoTransRef']    = $_POST["tipoTransRef"];
                 $procedimientos['dispoTransRef']    = $_POST["dispoTransRef"];
                 $procedimientos['tipoDocRefRes']    = $_POST["tipoDocRefRes"];
                 $procedimientos['NroDocRefRes']    = $_POST["NroDocRefRes"];
                 $procedimientos['personalResRef']    = $_POST["personalResRef"];
                 $procedimientos['profesionRefRes']    = $_POST["profesionRefRes"];
                 $procedimientos['colegiaturaRef']    = $_POST["colegiaturaRef"];
                 $procedimientos['tipoDocRefResAcompa']    = $_POST["tipoDocRefResAcompa"];
                 $procedimientos['NroDocRefResAcompa']    = $_POST["NroDocRefResAcompa"];
                 $procedimientos['personalResRefAcompa']    = $_POST["personalResRefAcompa"];
                 $procedimientos['profesionRefResAcompa']    = $_POST["profesionRefResAcompa"];
                 $procedimientos['colegiaturaRefAcompa']    = $_POST["colegiaturaRefAcompa"];
                $procedimientos['hisRefReg']    = $_POST["hisRefReg"];
                
                $procedimientos['CODEESS'] = $_POST["CODEESS"];
                $procedimientos['anio']    = $_POST["anio"];
            
                
                $sel::RegistrarReferencias($procedimientos);   
                
        }
        
        else if($function =="RegistrarReferenciasHistoria"){

                    
                $procedimientos = array();
         
                 $procedimientos['iduser']    = $_POST["iduser"];
                 $procedimientos['busNroRefHistoria']    = $_POST["busNroRef"];
                 
                
                 
                
                $sel::RegistrarReferenciasHistoria($procedimientos); 
                
                
        }
        
        
         else if($function =="RegistrarReferenciasHistoriaTemporal"){

                    
                $procedimientos = array();
         
                 $procedimientos['iduser']    = $_POST["iduser"];
                 $procedimientos['busNroRefHistoria']    = $_POST["ideHisto"];
                 $procedimientos['anamnesis']    = $_POST["anamnesis"];
                 $procedimientos['presionArterial']    = $_POST["presionArterial"];
                 $procedimientos['temperatura']    = $_POST["temperatura"];
                 $procedimientos['cardiaca']    = $_POST["cardiaca"];
                 $procedimientos['respiratoria']    = $_POST["respiratoria"];
                 $procedimientos['saturacion']    = $_POST["saturacion"];
                 $procedimientos['oxinoterapia']    = $_POST["oxinoterapia"];
                 $procedimientos['litroMin']    = $_POST["litroMin"];
                 $procedimientos['examenClinico']    = $_POST["examenClinico"];
                 $procedimientos['plan']    = $_POST["plan"];
                 $procedimientos['notaObservaciones']    = $_POST["notaObservaciones"];
                 $procedimientos['respirador']    = $_POST["respirador"];
                 
                
                $sel::RegistrarReferenciasHistoriaTemporal($procedimientos); 
                
                
        }
        


        else if($function =="RegistrarReferenciasEvalRef"){

                    
                $procedimientos = array();
         
                 $procedimientos['iduser']    = $_POST["iduser"];
                 $procedimientos['ideHistoEvalRef']    = $_POST["ideHistoEvalRef"];
                 
                 $procedimientos['especEval1']    = $_POST["especEval1"];
                 $procedimientos['especEval2']    = $_POST["especEval2"];
                 $procedimientos['especEvalDatoRef']    = $_POST["especEvalDatoRef"];
                 $procedimientos['estadoRefDatRef']    = $_POST["estadoRefDatRef"];
                 $procedimientos['derivarJefeServ']    = $_POST["derivarJefeServ"];
                 $procedimientos['motivoRecEval1']    = $_POST["motivoRecEval1"];
                 $procedimientos['especEval3']    = $_POST["especEval3"];
                 $procedimientos['obsJefeServ']    = $_POST["obsJefeServ"];
                 $procedimientos['estadoRefJefeServ']    = $_POST["estadoRefJefeServ"];
                 $procedimientos['motivoRecEval2']    = $_POST["motivoRecEval2"];
                 $procedimientos['obsJefeGuardia']    = $_POST["obsJefeGuardia"];
                 $procedimientos['estadoRefJefeGuardia']    = $_POST["estadoRefJefeGuardia"];
                 $procedimientos['motivoRecEval3']    = $_POST["motivoRecEval3"];
                 $procedimientos['atencionPacEval']    = $_POST["atencionPacEval"];
                 $procedimientos['estFinalRef']    = $_POST["estFinalRef"];
                 $procedimientos['motivoRecEval4']    = $_POST["motivoRecEval4"];
                 $procedimientos['obsEstFinalRef']    = $_POST["obsEstFinalRef"];
                 $procedimientos['paxllegoEstab']    = $_POST["paxllegoEstab"];
                 $procedimientos['fechaLlegada']    = $_POST["fechaLlegada"];
                 $procedimientos['cuentaFeLlegada']    = $_POST["cuentaFeLlegada"];
                 $procedimientos['idEvalRef']    = $_POST["idEvalRef"];
                 $procedimientos['personalMedicoList']    = $_POST["personalMedicoList"];
                 
                 
                
                $sel::RegistrarReferenciasEvalRef($procedimientos); 
                
                
        }
        
        
         else if($function =="RegistrarEvalPerRefPesta"){

                    
                $procedimientos = array();
         
                 $procedimientos['iduser']    = $_POST["iduser"];
                 $procedimientos['ideHistoEvalRef']    = $_POST["ideHistoEvalRef"];
                 $procedimientos['especEval1']    = $_POST["especEval1"];
                 $procedimientos['especEval2']    = $_POST["especEval2"];
                 $procedimientos['especEvalDatoRef']    = $_POST["especEvalDatoRef"];
                 $procedimientos['estadoRefDatRef']    = $_POST["estadoRefDatRef"];
                 $procedimientos['derivarJefeServ']    = $_POST["derivarJefeServ"];
                 $procedimientos['personalMedicoList']    = $_POST["personalMedicoList"];
                 
                $sel::RegistrarEvalPerRefPesta($procedimientos); 
            
        }
        
         else if($function =="RegistrarEvalJefeServicio"){

                    
                $procedimientos = array();
         
                 $procedimientos['iduserJefeServ']    = $_POST["iduserJefeServ"];
                 $procedimientos['ideHistoEvalRef']    = $_POST["ideHistoEvalRef"];
                 $procedimientos['obsJefeServ']    = $_POST["obsJefeServ"];
                 $procedimientos['estadoRefJefeServ']    = $_POST["estadoRefJefeServ"];
                 $procedimientos['motivoRecEval2']    = $_POST["motivoRecEval2"];
                 
                $sel::RegistrarEvalJefeServicio($procedimientos); 
            
        }
        
        
        
         else if($function =="RegistrarEvalJefeGuardia"){

                    
                $procedimientos = array();
         
                 $procedimientos['iduserJefeGuardia']    = $_POST["iduserJefeGuardia"];
                 $procedimientos['ideHistoEvalRef']    = $_POST["ideHistoEvalRef"];
                 $procedimientos['obsJefeGuardia']    = $_POST["obsJefeGuardia"];
                 $procedimientos['estadoRefJefeGuardia']    = $_POST["estadoRefJefeGuardia"];
                 $procedimientos['motivoRecEval3']    = $_POST["motivoRecEval3"];
                 
                $sel::RegistrarEvalJefeGuardia($procedimientos); 
            
        }
        
        
        
        else if($function =="RegistrarEvalMedicoAudi"){

                    
                $procedimientos = array();
         
                 $procedimientos['idMedicoAudi']    = $_POST["idMedicoAudi"];
                 $procedimientos['ideHistoEvalRef']    = $_POST["ideHistoEvalRef"];
                 $procedimientos['atencionPacEval']    = $_POST["atencionPacEval"];
                 $procedimientos['acciTranRef']    = $_POST["acciTranRef"];
                 
                 $procedimientos['chkDocCuenta1']    = $_POST["chkDocCuenta1"];
                 $procedimientos['chkDocCuenta2']    = $_POST["chkDocCuenta2"];
                 $procedimientos['chkDocCuenta3']    = $_POST["chkDocCuenta3"];
                 $procedimientos['chkDocCuenta4']    = $_POST["chkDocCuenta4"];
                 $procedimientos['chkDocCuenta5']    = $_POST["chkDocCuenta5"];
                 

                 
                $sel::RegistrarEvalMedicoAudi($procedimientos); 
            
        }
        
        
        
        
        else if($function =="RegistrarEvalPerRefe"){

                    
                $procedimientos = array();
         
                 $procedimientos['idPerRef']    = $_POST["idPerRef"];
                $procedimientos['ideHistoEvalRef']    = $_POST["ideHistoEvalRef"];
                 $procedimientos['paxllegoEstab']    = $_POST["paxllegoEstab"];
                 $procedimientos['fechaLlegada']    = $_POST["fechaLlegada"];
                 $procedimientos['cuentaFeLlegada']    = $_POST["cuentaFeLlegada"];
                
                
                $sel::RegistrarEvalPerRefe($procedimientos); 
                
                
        }
        
        
         else if($function =="RegistrarEvalPerRefeFinal"){

                    
                $procedimientos = array();
         
                 $procedimientos['idPerRefinal']    = $_POST["idPerRefinal"];
                 $procedimientos['ideHistoEvalRef']    = $_POST["ideHistoEvalRef"];
                 $procedimientos['estFinalRef']    = $_POST["estFinalRef"];
                 $procedimientos['motivoRecEval4']    = $_POST["motivoRecEval4"];
                 $procedimientos['obsEstFinalRef']    = $_POST["obsEstFinalRef"];
                 
                
                $sel::RegistrarEvalPerRefeFinal($procedimientos); 
                
                
        }
        

 ?>