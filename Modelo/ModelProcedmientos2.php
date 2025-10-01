<?php 


include_once ('./../config.php');
include (CONTROLLER_PATH."conexion.php");
include (MODEL_PATH."global.php");
date_default_timezone_set('America/Lima');


header('Content-Type: text/html; charset=utf-8');
//error_reporting(0);//



class ModelProcedmientos{


                   function updateRconsideracion($procedimientos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                        if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                        }else{

                                
                                $iduser         = $procedimientos['iduser'];
                                $ide            = $procedimientos['ide'];
                                $fuaSolicitado  = $procedimientos['fuaSolicitado'];
                                $estado         = $procedimientos['estado'];
                                $fechaRe        = $procedimientos['fechaRe'];
                                $obsrAd         = $procedimientos['obsrAd'];
                                $resultado      = $procedimientos['resultado'];
                                $newOrden       = $procedimientos['newOrden'];
                                $fuare          = $procedimientos['fuare'];
                                $hiEn           = $procedimientos['hiEn'];
                                $ap =  $procedimientos['ap'];
                                $bp =  $procedimientos['bp'];
                                $cp =  $procedimientos['cp'];
                                $dp =  $procedimientos['dp'];
                                $ep =  $procedimientos['ep'];
                                $fileReconsi = $procedimientos['fileReconsi'];
                                
                                if($fileReconsi!=''){
                                    $stmt = $conn->prepare( "UPDATE `reconsideraciones` SET `FUA_SOLICITADA`= ?,FSOLIC= ?,`USUSOLIC`=? ,`ESTADO`= ?,`RESULTADO_EVAL`= ?, `observacionPost`= ?,VALORNUM=?
                                    , `fuare`= ?,hiEn=?,ap=?,bp=?,cp=?,dp=?,ep=?,fileReco=?  WHERE `FUA_OBSERVADA`= '$ide'");                                  
                                    $stmt->bind_param('sssssssssssssss', $fuaSolicitado,$fechaRe,$iduser,$estado,$resultado,$obsrAd,$newOrden,$fuare,$hiEn,$ap,$bp,$cp,$dp,$ep,$fileReconsi);
                                    $stmt->execute();
                                    printf("Error: %s.\n", $stmt->error);
                                    echo "Actualizado";
                                }else{
                                    
                                    $stmt = $conn->prepare( "UPDATE `reconsideraciones` SET `FUA_SOLICITADA`= ?,FSOLIC= ?,`USUSOLIC`=? ,`ESTADO`= ?,`RESULTADO_EVAL`= ?, `observacionPost`= ?,VALORNUM=?
                                    , `fuare`= ?,hiEn=?,ap=?,bp=?,cp=?,dp=?,ep=?  WHERE `FUA_OBSERVADA`= '$ide'");                                  
                                    $stmt->bind_param('ssssssssssssss', $fuaSolicitado,$fechaRe,$iduser,$estado,$resultado,$obsrAd,$newOrden,$fuare,$hiEn,$ap,$bp,$cp,$dp,$ep);
                                    $stmt->execute();
                                    printf("Error: %s.\n", $stmt->error);
                                    echo "Actualizado";
                                    
                                }

                                
                                
                                      
                        }

                       
                }


					function createEditProced($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                        $idPr          = $procedimientos['idPr'];
                                        $iduser        = $procedimientos['iduser'];
                                        $idpresPro     = $procedimientos['idpresPro'];
                                        $cant          = $procedimientos['cant'] ;
                                        $codCpt        = $procedimientos['codCpt'] ;
                                        $valor         = $procedimientos['valor'];
                                        $desCpt        = $procedimientos['desCpt'];
                                        $totalp        = $procedimientos['totalp'];
                                        $dx            = $procedimientos['dx'];


                                            if($idPr!=""){
                                        
                                                                $stmt = $conn->prepare( "UPDATE `a_procedimientos` SET `IdUsuario`= ?,`id_prestacion`= ?,`codigo_cpt`=?,`cantidad`=?,
                                                                `valorizacion`=?, `descripcion`=?, `total`=?,`dx`=? WHERE `IdProcedimiento`= $idPr");                                  
                                                                $stmt->bind_param('issidsdi', $iduser, $idpresPro, $codCpt,$cant,$valor,$desCpt,$totalp,$dx);
                                                                $stmt->execute();
                                                                echo "ACTUALIZADO";
                                            
                                            }else {
                                                
                                                                $consulta3 = "SELECT `IdUsuario`, `codigo_cpt` FROM `a_procedimientos` WHERE `id_prestacion`='$idpresPro' AND `codigo_cpt`='$codCpt'";
                                                                $verIf3 = mysqli_query($conn,$consulta3);
                                                                $cnt3 = mysqli_num_rows($verIf3);
                                                                
                                                            //echo $consulta3;
                                                            if($cnt3 > 0){
                                                                echo "ENCONTRADO";
                                                            }else{

                                                                $stmt = $conn->prepare( "INSERT a_procedimientos (`IdUsuario`, `id_prestacion`, `codigo_cpt`, `cantidad`, `valorizacion`, `descripcion`, `total`,dx) 
                                                                VALUES (?, ?, ?, ?, ?, ?,?,? )");
                                                                $stmt->bind_param('issidsdi', $iduser, $idpresPro, $codCpt,$cant,$valor,$desCpt,$totalp,$dx);
                                                                $stmt->execute();
                                                                echo "INSERTADO";

                                                            }
                                                

                                            }
                            }

                         

                    }
                    
                    
                    
                    function agregarAtencionAuditadaPa($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                        $id          = $procedimientos['id'];
                                        $grupo     = $procedimientos['grupo'];
                                        $user        = $procedimientos['user'];
                                        $tipo        = $procedimientos['tipo'];
                                        
                                        if($tipo=="2"){
                                            
                                                $consulta3 = "SELECT `idLi` FROM `listadoAtencionesCE` WHERE `idPaq`='$grupo' AND `idPac`='$id'";
                                                $verIf3 = mysqli_query($conn,$consulta3);
                                                $cnt3 = mysqli_num_rows($verIf3);
                                                
                                            
                                                if($cnt3 > 0){
                                                    echo "1";
                                                }else{
            
                                                    $stmt = $conn->prepare( "INSERT INTO `listadoAtencionesCE`( `idPaq`, `idPac`, `userReg`) VALUES (?, ?, ? )");
                                                    $stmt->bind_param('iii', $user, $id, $grupo);
                                                    $stmt->execute();
                                                    echo "INSERTADO";
            
                                                }
                                                
                                            
                                            
                                        }else{
                                            
                                                $consulta3 = "SELECT `idLi` FROM `listadoAtenciones` WHERE `idPaq`='$grupo' AND `idPac`='$id'";
                                                $verIf3 = mysqli_query($conn,$consulta3);
                                                $cnt3 = mysqli_num_rows($verIf3);
                                                
                                            
                                                if($cnt3 > 0){
                                                    echo "1";
                                                }else{
            
                                                    $stmt = $conn->prepare( "INSERT INTO `listadoAtenciones`( `idPaq`, `idPac`, `userReg`) VALUES (?, ?, ? )");
                                                    $stmt->bind_param('iii', $user, $id, $grupo);
                                                    $stmt->execute();
                                                    echo "INSERTADO";
            
                                                }
                                            
                                        }
                                    
                                    
                                      
                                       
                                        
                            }

                        
                    }
                    
                    
                    
                    function guardarReporteSis($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                      
                                        $nroDoc = $procedimientos['nroDoc'];
                                        $user  = $procedimientos['user'];
                                        $status = $procedimientos['status'];
                                        $regWebSis = $procedimientos['regWebSis'];
                                        $planWebSis = $procedimientos['planWebSis'];
                                        $fechaAful = $procedimientos['fechaAful'];
                                        $nroAfil = $procedimientos['nroAfil'];
                                        $fechacaducidad = $procedimientos['fechacaducidad'];
                                        $item = $procedimientos['item'];
                                        
                                        if($nroDoc!=""){
                                                $stmt = $conn->prepare( "INSERT INTO `validacionSis`(`nroDoc`, `iduser`, `regimen`, `plan`, `nroAfiliacion`, `fechaAfiliacion`, `fechaCaducidad`, `estado`,idEm) VALUES
                                                (?, ?, ? ,?,?,?,?,?,?)");
                                                $stmt->bind_param('sissssssi', $nroDoc, $user,$regWebSis,$planWebSis,$nroAfil,$fechaAful,$fechacaducidad, $status,$item);
                                                $stmt->execute();
                                                //echo "INSERTADO";    
                                        }

                                        

                                
                                        
                            }

                         

                    }
                    
                    
                    
                    function actualizarEstadoReporteSis($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                      
                            
                                        $status = $procedimientos['status'];
                                        $item = $procedimientos['item'];
                                        
                                      
                                        $stmt = $conn->prepare( "UPDATE `tbl_Emergencias` SET `status`= ? WHERE idEm='$item'");                                  
                                        $stmt->bind_param('s', $status);
                                        $stmt->execute();
                                       //echo "ACTUALIZADO";  
                            
                            }

                         

                    }
                    
                    
                    function RegistroDetallesRotulo($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                      
                                        $id = $procedimientos['id'];
                                        $code  = $procedimientos['code'];
                                        $rotulo = $procedimientos['rotulo'];
                                       
                                        if($id!=""){
                                                $stmt = $conn->prepare( "INSERT INTO `tbl_auditoriaDetalleRotulos`(`code`, `rotulo`, `iduser`) VALUES(?, ?, ? )");
                                                $stmt->bind_param('ssi', $code, $rotulo,$id);
                                                $stmt->execute();
                                                //echo "INSERTADO";    
                                        }

                                        

                                
                                        
                            }

                         

                    }
                    
                     function updatetallesRotulo($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                      
                                        $code = $procedimientos['code'];
                                        $chek = $procedimientos['chek'];
                                        $cat = $procedimientos['cat'];
                                        $id = $procedimientos['id'];
                                        $feupda = date("Y-m-d H:i:s");
                                        $gua = $procedimientos['gua'];
                                       
                                       if($gua==1){
                                           
                                                    if($cat==1){
                                                       $stmt = $conn->prepare( "UPDATE `tbl_detalleRotulo` SET `inclusion`= ?,`feModInclusion`= ?,idUserInclu= ?  WHERE `id`=$code");
                                                   }else if($cat==2){
                                                       $stmt = $conn->prepare( "UPDATE `tbl_detalleRotulo` SET `corte`= ?,`feModCorte`= ?,idUserLabCorte= ?  WHERE `id`=$code");
                                                   }else if($cat==3){
                                                       $stmt = $conn->prepare( "UPDATE `tbl_detalleRotulo` SET `coloracion`= ?,`feModColor`= ?,idUserLabColor= ?  WHERE `id`=$code");
                                                   }else if($cat==4){
                                                       $stmt = $conn->prepare( "UPDATE `tbl_detalleRotulo` SET `montaje`= ?,`feModMontaje`= ?,idUserLabMon= ?  WHERE `id`=$code");
                                                   }else if($cat==5){
                                                       $stmt = $conn->prepare( "UPDATE `tbl_detalleRotulo` SET `entrega`= ?,`feModEntrega`= ?,idUserLabEnt= ?  WHERE `id`=$code");
                                                   }
                                           
                                           
                                       }else if($gua==2){
                                           
                                           
                                                    if($cat==1){
                                                       $stmt = $conn->prepare( "UPDATE `tbl_detalleRotulo` SET `inclusion2`= ?,`feModInclusion2`= ?,idUserInclu2= ?  WHERE `id`=$code");
                                                   }else if($cat==2){
                                                       $stmt = $conn->prepare( "UPDATE `tbl_detalleRotulo` SET `corte2`= ?,`feModCorte2`= ?,idUserLabCorte2= ?  WHERE `id`=$code");
                                                   }else if($cat==3){
                                                       $stmt = $conn->prepare( "UPDATE `tbl_detalleRotulo` SET `coloracion2`= ?,`feModColor2`= ?,idUserLabColor2= ?  WHERE `id`=$code");
                                                   }else if($cat==4){
                                                       $stmt = $conn->prepare( "UPDATE `tbl_detalleRotulo` SET `montaje2`= ?,`feModMontaje2`= ?,idUserLabMon2= ?  WHERE `id`=$code");
                                                   }else if($cat==5){
                                                       $stmt = $conn->prepare( "UPDATE `tbl_detalleRotulo` SET `entrega2`= ?,`feModEntrega2`= ?,idUserLabEnt2= ?  WHERE `id`=$code");
                                                   }
                                           
                                       }
                                       
                                       
                                       
                                                
                                    
                                        $stmt->bind_param('ssi', $chek,$feupda,$id);
                                        $stmt->execute();
                                                 

                            }

                         

                    }
                    
                    
                    function updateHistoDet($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                      
                                       
                                        $chek = $procedimientos['chek'];
                                        $id = $procedimientos['id'];
                                        $user = $procedimientos['user'];
                                        $fechaHora = date("Y-m-d H:i:s");
                                       
                                     
                                        $stmt = $conn->prepare( "UPDATE `tbl_detalleRotulo` SET iduserHisto= ?,fechaUserHisto= ?,`checkHisto`= ?  WHERE `id`=$id");
                                       
                                                
                                        $stmt->bind_param('iss',$user,$fechaHora,$chek);
                                        $stmt->execute();
                                                 

                            }

                         

                    }
                    
                    
                    function insertDxHistoria($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                      
                                        $iduser = $procedimientos['iduser'];
                                        $idHis  = $procedimientos['idHis'];
                                        $tipoDx = $procedimientos['tipoDx'];
                                        $descripDx = $procedimientos['descripDx'];
                                        
                                        
                                                $consulta3 = "SELECT `idDxHis` FROM `tbl_dxHistoria` WHERE `idRef`='$idHis' AND `dx`='$descripDx'";
                                                $verIf3 = mysqli_query($conn,$consulta3);
                                                $cnt3 = mysqli_num_rows($verIf3);
                                                
                                            
                                                if($cnt3 > 0){
                                                    //echo "1";
                                                }else{
                                                        if($descripDx !="undefined" || $descripDx != ""){
                                                            $stmt = $conn->prepare( "INSERT INTO  `tbl_dxHistoria`( `iduser`, `idRef`, `dx`, `tipoDx`) VALUES (?, ?, ? ,?)");
                                                            $stmt->bind_param('iiss', $iduser, $idHis,$descripDx,$tipoDx);
                                                            $stmt->execute();
                                                            //echo "INSERTADO";
                                                        }
                                                        
                                                }
                                        
                            }

                         

                    }
                    
                    
                    
                    function insertSignosSintomas($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                      
                                        $iduser = $procedimientos['iduser'];
                                        $idHis  = $procedimientos['idHis'];
                                        $tipoDx = $procedimientos['tipoDx'];
                                        $descripDx = $procedimientos['descripDx'];
                                        
                                        
                                                $consulta3 = "SELECT `idDxHis` FROM `insertSignosSintomas` WHERE `idRef`='$idHis' AND `dx`='$descripDx'";
                                                $verIf3 = mysqli_query($conn,$consulta3);
                                                $cnt3 = mysqli_num_rows($verIf3);
                                                
                                            
                                                if($cnt3 > 0){
                                                    //echo "1";
                                                }else{
                                                        if($descripDx !="undefined" || $descripDx != ""){
                                                            $stmt = $conn->prepare( "INSERT INTO  `tbl_signosSintomas`( `iduser`, `idRef`, `dx`, `tipoDx`) VALUES (?, ?, ? ,?)");
                                                            $stmt->bind_param('iiss', $iduser, $idHis,$descripDx,$tipoDx);
                                                            $stmt->execute();
                                                            //echo "INSERTADO";
                                                        }
                                                        
                                                }
                                        
                            }

                         

                    }
                    
                    
                    
                    
                    
                    
                    
                    function insertTratHistoria($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                      
                                        $iduser = $procedimientos['iduser'];
                                        $idHis  = $procedimientos['idHis'];
                                        $tipoDx = $procedimientos['tipoDx'];
                                        $descripDx = $procedimientos['descripDx'];
                                        
                                        
                                                $consulta3 = "SELECT `idDxHis` FROM `tbl_tratHistoria` WHERE `idRef`='$idHis' AND `descripcion`='$descripDx'";
                                                $verIf3 = mysqli_query($conn,$consulta3);
                                                $cnt3 = mysqli_num_rows($verIf3);
                                                
                                            
                                                if($cnt3 > 0){
                                                    //echo "1";
                                                }else{
                                                        if($descripDx !="undefined" || $descripDx != ""){
                                                            $stmt = $conn->prepare( "INSERT INTO  `tbl_tratHistoria`( `iduser`, `idRef`, `descripcion`, `cant`) VALUES (?, ?, ? ,?)");
                                                            $stmt->bind_param('iiss', $iduser, $idHis,$descripDx,$tipoDx);
                                                            $stmt->execute();
                                                            //echo "INSERTADO";
                                                        }
                                                        
                                                }
                                        
                            }

                         

                    }
                    
                    function insertExamenesAuxi($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                      
                                        $iduser = $procedimientos['iduser'];
                                        $idHis  = $procedimientos['idHis'];
                                        $tipoDx = $procedimientos['tipoDx'];
                                        $descripDx = $procedimientos['descripDx'];
                                        
                                        
                                                $consulta3 = "SELECT `idDxHis` FROM `tbl_examenesAuxiliares` WHERE `idRef`='$idHis' AND `des`='$descripDx'";
                                                $verIf3 = mysqli_query($conn,$consulta3);
                                                $cnt3 = mysqli_num_rows($verIf3);
                                                
                                            
                                                if($cnt3 > 0){
                                                    //echo "1";
                                                }else{
                                                        if($descripDx !="undefined" || $descripDx != ""){
                                                            $stmt = $conn->prepare( "INSERT INTO `tbl_examenesAuxiliares`( `iduser`, `idRef`, `des`, `tipo`) VALUES (?, ?, ? ,?)");
                                                            $stmt->bind_param('iiss', $iduser, $idHis,$descripDx,$tipoDx);
                                                            $stmt->execute();
                                                            //echo "INSERTADO";
                                                        }
                                                        
                                                }
                                        
                            }

                         

                    }
                    
                    
                    
                    
                    
                     
                    function guardarReporteSisMasivo($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                      
                                        $nroDoc = $procedimientos['nroDoc'];
                                        $estado  = $procedimientos['status'];
                                        $tipoDoc = $procedimientos['tipoDoc'];
                                        $idVal = $procedimientos['idVal'];
                                       
                                       
                                        $stmt = $conn->prepare( "UPDATE `tbl_Emergencias` SET `status`= ? WHERE `nroDoc`='$nroDoc'");                                  
                                        $stmt->bind_param('s', $estado);
                                        $stmt->execute();

                                
                                        
                            }

                         

                    }
                    
                    
                    function guardarReglaAuditoria($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                      
                                        $iduser = $procedimientos['iduser'];
                                        $idPac = $procedimientos['idPac'];
                                        $codCpms = $procedimientos['codCpms'];
                                        $cantidad = $procedimientos['cantidad'];
                                        $descripcion = $procedimientos['descripcion'];
                                        $precio = $procedimientos['precio'];
                                        $estancia = $procedimientos['estancia'];
                                        $cntdias='';$total='';
                                        
                                        if($codCpms=='99231'){
                                            $cntdias=$estancia - 1;
                                            $total=$precio * $cntdias;
                                        }else if($codCpms=='99206'){
                                            $cntdias=$estancia;
                                            $total=$precio * $cntdias ;
                                        }else{
                                            $cntdias=$cantidad;
                                            $total=$precio;
                                        }
                                        
                                        
                                        $consulta3 = "SELECT `IdProcedimiento` FROM `a_procedimientos` WHERE `id_prestacion`='$idPac' AND `codigo_cpt`='$codCpms'";
                                        $verIf3 = mysqli_query($conn,$consulta3);
                                        $cnt3 = mysqli_num_rows($verIf3);
                                        
                                    
                                    if($cnt3 > 0){
                                        echo "1";
                                    }else{
                                        $stmt = $conn->prepare( "INSERT INTO `a_procedimientos`(`IdUsuario`, `id_prestacion`, `codigo_cpt`, `cantidad`, `valorizacion`, `descripcion`, `total`) VALUES
                                        (?, ?, ? ,?,?,?,?)");
                                        $stmt->bind_param('issidsd', $iduser, $idPac,$codCpms,$cntdias,$precio,$descripcion,$total);
                                        $stmt->execute();

                                    }
                                        
                                        
                            }

                         

                    }

                    function createEditProcedAuto($procedimientos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{

                                $idPr          = $procedimientos['idPrAuto'];
                                $iduser        = $procedimientos['iduser'];
                                $idpresPro     = $procedimientos['idpresProAuto'];
                                $cant          = $procedimientos['cantAuto'] ;
                                $codCpt        = $procedimientos['codCptAuto'] ;
                                $valor         = $procedimientos['valorAuto'];
                                $desCpt        = $procedimientos['desCptAuto'];
                                $totalp        = $procedimientos['totalpAuto'];
                                $dx        = $procedimientos['dx'];


                                    if($idPr!=""){
                                
                                        $stmt = $conn->prepare( "UPDATE `ac_procedimientos` SET `IdUsuario`= ?,`id_prestacion`= ?,`codigo_cpt`=?,`cantidad`=?,
                                        `valorizacion`=?, `descripcion`=?, `total`=?, `dx`=? WHERE `IdProcedimiento`= $idPr");                                  
                                        $stmt->bind_param('issidsds', $iduser, $idpresPro, $codCpt,$cant,$valor,$desCpt,$totalp,$dx);
                                        $stmt->execute();
                                        echo "ACTUALIZADO";
                                    
                                    }else {
                                        

                                        $consulta3 = "SELECT `IdUsuario`, `codigo_cpt` FROM `ac_procedimientos` WHERE `id_prestacion`='$idpresPro' AND `codigo_cpt`='$codCpt'";
                                        $verIf3 = mysqli_query($conn,$consulta3);
                                        $cnt3 = mysqli_num_rows($verIf3);

                                        if($cnt3 > 0){
                                            echo "ENCONTRADO";
                                        }else{

                                            $stmt = $conn->prepare( "INSERT ac_procedimientos (`IdUsuario`, `id_prestacion`, `codigo_cpt`, `cantidad`, `valorizacion`, `descripcion`, `total`, `dx`) 
                                            VALUES (?, ?, ?, ?, ?, ?,?,? )");
                                            $stmt->bind_param('issidsds', $iduser, $idpresPro, $codCpt,$cant,$valor,$desCpt,$totalp,$dx);
                                            $stmt->execute();
                                            echo "INSERTADO";

                                        }
                                        

                                    }
                    }

                    return $result;

            }
            
            
            
             function updatePasoHospi($procedimientos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{

                                        $ide = $procedimientos['ide'];
                                        $fua = $procedimientos['fua'];
                                        $hisCli = $procedimientos['hisCli'];
                                        $tipoDoc = $procedimientos['tipoDoc'];
                                        $NroDoc = $procedimientos['NroDoc'];
                                        $sexo = $procedimientos['sexo'];
                                        $cuenta = $procedimientos['cuenta'];
                                        $eessInicio = $procedimientos['eessInicio'];
                                        $nombres = $procedimientos['nombres'];
                                        $apepa = $procedimientos['apepa'];
                                        $apema = $procedimientos['apema'];
                                        $FechaNac = $procedimientos['FechaNac'];
                                        $edad = $procedimientos['edad'];
                                        $feingre = $procedimientos['feingre'];
                                        $rsatencion = $procedimientos['rsatencion'];
                                       


                                    if($ide!=""){
                                
                                        $stmt = $conn->prepare( "UPDATE `tbl_Emergencias` SET `nroFua` = ?, `historiaClinica` = ?, `tipoDoc`= ?, `nroDoc`= ?, `sexo`= ?, `cuenta`= ?, `eessInicio`= ?,
                                        `nombres`= ?, `fechaNac`= ?, `ApePaterno`= ?, `ApeMaterno`= ?, `edad`= ?,`fechaIngreso` = ?,rsatencion = ? WHERE `ideNew`= $ide");                                  
                                        $stmt->bind_param('ssssssssssssss', $fua, $hisCli, $tipoDoc,$NroDoc,$sexo,$cuenta,$eessInicio,$nombres,$FechaNac,$apepa,$apema,$edad,$feingre,$rsatencion);
                                        $stmt->execute();
                                        //echo "ACTUALIZADO";
                                    
                                    }
                    }

                    return $result;

            }


            function updatePasoPaciente($procedimientos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {
                        printf("Conexión fallida: %s\n", $conn->connect_error);
                        exit();

                    }else{

                                        $ide = $procedimientos['ide'];
                                        $fua = $procedimientos['fua'];
                                        $hisCli = $procedimientos['hisCli'];
                                        $tipoDoc = $procedimientos['tipoDoc'];
                                        $NroDoc = $procedimientos['NroDoc'];
                                        $cuenta = $procedimientos['cuenta'];
                                        $nombres = $procedimientos['nombres'];
                                        $apepa = $procedimientos['apepa'];
                                        $apema = $procedimientos['apema'];
                                        $feingre = $procedimientos['feingre'];
                                        $reciAudit  =  $procedimientos['reciAudit'];
                                        $fereinNew = substr($feingre,0,10);
                                        $feAltaAlt = $procedimientos['feAltaAlt'];
                                        $monGal = $procedimientos['monGal'];
                                        $montSif =  $procedimientos['montSif'];
                                        $monTotalCo      = $procedimientos['monTotalCo'];
                                        $tipoSeiNDes     = $procedimientos['tipoSeiNDes'];
                                        $origenEmerMod =  $procedimientos['origenEmerMod'];
                                        $paxt = $apepa." ".$apema." ".$nombres;
                                        $tipoReg = $procedimientos['tipoReg'];
                                        $cuentaHsoMod    =   $procedimientos['cuentaHsoMod'];
                                       
                                            $tipc ="";
                                        	if($tipoDoc==1){
                                			    	$tipc='DNI';
                                			}else if($tipoDoc==2){
                                			    	$tipc='Carnet Ext.';
                                			}
                                			else if($tipoDoc==3){
                                			    	$tipc='Pasaporte';
                                			}
                                			else if($tipoDoc==4){
                                			    	$tipc='Codigo recien nacido (CUI)';
                                			}
                                			else if($tipoDoc==5){
                                			    	$tipc='Doc. Ident. Extranjera';
                                			}
                                			else if($tipoDoc==6){
                                			    	$tipc='Sin Doc.';
                                			}
                                			
                                	    $conli =$cuenta;     
                                        if($tipoReg==2){
                                            
                                                     
                                                        if($origenEmerMod == '2' || $origenEmerMod == ''){
                                                                $conli =$cuenta;

                                                        }else if($origenEmerMod == '1' ){
                                                                $conli =$cuentaHsoMod;
                                                        }
                                			            echo $conli."--->NUA";
                                		}


                                    if($ide!=""){
                                            
                                            
                                            if($tipoReg==1){
                                                
                                                    $stmt = $conn->prepare( "UPDATE `paciente` SET `iduser` = ?, `F_Ingreso` = ?,`F_Alta_Medica` = ?, `Historia` = ?, `DNI` = ?, `montogal` = ?,
                                                    `montosisfar` = ?, `valorFinal` = ?, `tipoDoc` = ?,nroFua = ?,nroCuenta= ? WHERE `idEmg`= $ide");                                  
                                                    $stmt->bind_param('issssssssss', $reciAudit,$fereinNew,$feAltaAlt,$hisCli,$NroDoc, $monGal,$montSif,$monTotalCo,$tipc,$fua,$conli);
                                                    $stmt->execute();
                                                
                                                    
                                            }else{
                                                
                                                    
                                                    
                                                    $stmt = $conn->prepare( "UPDATE `paciente` SET  `F_Ingreso` = ?,`F_Alta_Medica` = ?, `Historia` = ?, `DNI` = ?, `montogal` = ?,
                                                    `montosisfar` = ?, `valorFinal` = ?, `tipoDoc` = ?,nroFua = ?,nroCuenta= ? WHERE `idEmg`= $ide");                                  
                                                    $stmt->bind_param('ssssssssss',$fereinNew,$feAltaAlt,$hisCli,$NroDoc, $monGal,$montSif,$monTotalCo,$tipc,$fua,$conli);
                                                    $stmt->execute();
                                                     
                                                       
                                            }
                                            
                                
                                       }
                                       
                                }

                            return $result;

                    }


                    function createEditPaciente($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{
                                //
                                        $iduser = $procedimientos['iduser'];
                                        $ide = $procedimientos['ide'];
                                        $tipoReg = $procedimientos['tipoReg'];
                                        $nroFuaInter = $procedimientos['nroFuaInter'];
                                        
                                        
                                        
                                        
                                      
                                        $fua ='';
                                        
                                        if($tipoReg=='3'){
                                            
                                                $exFua = explode("-",$procedimientos['nroFuaInter']);
                                            
                                                if($exFua[2]!=''){
                                                    $disa= str_pad($exFua[0],8, "0", STR_PAD_LEFT);
                                                    $lote= $exFua[1];
                                                    $numo= str_pad($exFua[2],8, "0", STR_PAD_LEFT);
                                                    $fua = $disa.'-'.$lote.'-'.$numo;
                                                }
                                              

                                        }else{
                                            
                                                $extraerFua = explode("-",$procedimientos['fua']);
                                            
                                                if($extraerFua[2]!=''){
                                                    $disa= str_pad($extraerFua[0],8, "0", STR_PAD_LEFT);
                                                    $lote= $extraerFua[1];
                                                    $numo= str_pad($extraerFua[2],8, "0", STR_PAD_LEFT);
                                                    $fua = $disa.'-'.$lote.'-'.$numo;
                                                }else{
                                                    $fua = "6207-24-";
                                                }
                                                
                                        }
                                        
                                        
                                        
                                      
                                        
                                        
                                       // $fua =$procedimientos['fua'];
                                        $hisCli = $procedimientos['hisCli'];
                                        $tipoDoc = $procedimientos['tipoDoc'];
                                        $NroDoc = $procedimientos['NroDoc'];
                                        $seguros =  $procedimientos['seguros'];
                                        $listaSeguros = $procedimientos['listaSeguros'];
                                        $ubicacion =  $procedimientos['ubicacion'];
                                        $sexo = $procedimientos['sexo'];
                                        $cuenta = trim($procedimientos['cuenta']);
                                        $NroAf = $procedimientos['NroAf'];
                                        $eess = $procedimientos['eess'];
                                        $nombres = $procedimientos['nombres'];
                                        $FechaNac = $procedimientos['FechaNac'];
                                        $apepa = $procedimientos['apepa'];
                                        $apema = $procedimientos['apema'];
                                        $telefa = $procedimientos['telefa'];
                                        $edad = $procedimientos['edad'];
                                        $espost = $procedimientos['espost'];
                                        $fefa = $procedimientos['fefa'];
                                        $referido = $procedimientos['referido'];
                                        $pabellones = $procedimientos['pabellones'];
                                        $feingre = $procedimientos['feingre'];
                                        $feAlta = $procedimientos['feAlta'];
                                        $monGal = $procedimientos['monGal'];
                                        $montSif =  $procedimientos['montSif'];
                                        $obsRes =  $procedimientos['obsRes'];
                                        $envioA =  $procedimientos['envioA'];
                                        $feuser =  $procedimientos['feuser'];
                                        $paxt = $apepa." ".$apema." ".$nombres;
                                        $actras          = $procedimientos['actras'];
                                        $validarFua      = $procedimientos['validarFua'];
                                        $financia        = $procedimientos['financia'];
                                        $regim           = $procedimientos['regim'];
                                        $planSal         = $procedimientos['planSal'];
                                        $tipoSeiN        = $procedimientos['tipoSeiN'];
                                        $feSolAte        = $procedimientos['feSolAte'];
                                        $ubicacionDes    = $procedimientos['ubicacionDes'];
                                        $tipoSeiNDes     = $procedimientos['tipoSeiNDes'];
                                        $feingreAlta     = $procedimientos['feingreAlta'];
                                        $feAltaAlt       = $procedimientos['feAltaAlt']; 
                                        $monTotalCo      = $procedimientos['monTotalCo'];
                                        $monCarGar       = $procedimientos['monCarGar'];
                                        $fuaEntre        = $procedimientos['fuaEntre'];
                                        $fechaFuaEntre   = $procedimientos['fechaFuaEntre'];
                                        $fechaAful       = $procedimientos['fechaAful'];
                                        $st ='';
                                        if($procedimientos['estaDias']=="NaN"){
                                            $st ='';
                                        }else{
                                            $st =$procedimientos['estaDias'];
                                        }
                                        
                                        //$estaDias        = $procedimientos['estaDias'];
                                        $estaDias        =  $st;
                                        $emailAuto       = $procedimientos['emailAuto'];
                                        $file            = $procedimientos['file'];
                                        
                                        
                                        $cns = $procedimientos['cns'];
                                        $campRes = $procedimientos['respbl'];
                                        $ctaHos = $procedimientos['ctaHos'];
                                        $liquIx = $procedimientos['liquIx'];
                                        
                                        
                                        $origenEmer =  $procedimientos['origenEmer'];
                                        $nroRefEmer =  $procedimientos['nroRefEmer'];
                                        $eessInicio =  $procedimientos['eessInicio'];
                                        $subirRef  =  $procedimientos['subirRef'];
                                        $nvaCta  =  $procedimientos['nvaCta'];
                                        $ctaHos   =  $procedimientos['ctaHos'];
                                        $rsatencion   =  $procedimientos['rsatencion'];
                                        $reciAudit  =  $procedimientos['reciAudit'];
                                        $registraAlta  =  $procedimientos['registraAlta'];
                                        $nroCxref = $procedimientos['nroCxref'];
                                        $segurosAl = $procedimientos['segurosAl'];
                                        
                                        //origenEmerMod
                                        $cuentaHsoMod    =   $procedimientos['cuentaHsoMod'];
                                        $origenEmerMod   =    $procedimientos['origenEmerMod'] ;
                                        $ubicacionHosX   =      $procedimientos['ubicacionHosX'];
                                        $tipoSeiNHosx    =    $procedimientos['tipoSeiNHosx'];
                                        $essHos          =   $procedimientos['essHos'] ;
                                        $nroRefHZ        =   $procedimientos['nroRefHZ'];
                                        $dxDescricon     =    $procedimientos['dxDescricon'] ;
                                        $feReefHos       =      $procedimientos['feReefHos'] ;
                                        $especialidadHos =    $procedimientos['especialidadHos'] ;
                                        $pab1Hos         = $procedimientos['pab1Hos'] ;
                                        $camHos1         =    $procedimientos['camHos1'];
                                        $pab2Hos         =   $procedimientos['pab2Hos'];
                                        $camHos2         =  $procedimientos['camHos2'] ;
                                        
                                        $aceptarTransf   =  $procedimientos['aceptarTransf'] ;
                                        $listObsFua      =  $procedimientos['listObsFua'] ;
                                        $fuaRcxHos       =  $procedimientos['fuaRcxHos'] ; 
                                        $idUserLiquida   = $procedimientos['idUserLiquida'];
                                        $statusRegPax    = $procedimientos['statusRegPax'];
                                        $prioridad    = $procedimientos['prioridad'];
                                        $tipoLiqux    = $procedimientos['tipoLiqux'];
                                        $tipocita = $procedimientos['tipocita'];
                                        $serEspecia = $procedimientos['serEspecia'];
                                
                                
                                        
                                        $tipc ="";
                                        	if($tipoDoc==1){
                                			    	$tipc='DNI';
                                			}else if($tipoDoc==2){
                                			    	$tipc='Carnet Ext.';
                                			}
                                			else if($tipoDoc==3){
                                			    	$tipc='Pasaporte';
                                			}
                                			else if($tipoDoc==4){
                                			    	$tipc='Codigo recien nacido (CUI)';
                                			}
                                			else if($tipoDoc==5){
                                			    	$tipc='Doc. Ident. Extranjera';
                                			}
                                			else if($tipoDoc==6){
                                			    	$tipc='Sin Doc.';
                                			}
                                        

                                            if($envioA=="on"){
                                                
                                                    $envioA="off"; 
                                            }
                                            //ubicacionDes
                                            
                                            $fereinNew = substr($feingre,0,10);
                                            
                                           if($ide!=""){
                                               
                                               
                                                        //VALIDAR DUPLICADOS FUA
                                                             $cnt1Dupli='0';
                                                            if($fua!='6207-24-'){
                                                                                   $coltaDupli = " SELECT idEm AS DI,'REGISTRO' as REG FROM `tbl_Emergencias` WHERE `nroFua` LIKE '%$fua'  ";
                                                                                   $veIf1Dupli = mysqli_query($conn,$coltaDupli);
                                                                                   $cnt1Dupli = mysqli_num_rows($veIf1Dupli); 
                                                                                   
                                                                                   
                                                                                   $coltaDupli2 = "SELECT idPac AS DI ,'AUDITORIA' as REG FROM `paciente` WHERE `nroFua` LIKE '%$fua'
                                                                                                   UNION ALL
                                                                                                   SELECT idEm AS DI,'CONSULTA EXTERNA' as REG FROM `tbl_consultaExterna` WHERE `nroFua` LIKE '%$fua'";
                                                                                   $veIf1Dupli2 = mysqli_query($conn,$coltaDupli2);
                                                                                   $cnt1Dupli2 = mysqli_num_rows($veIf1Dupli2); 
                                                            }
                                                            
                                                           
                                                            
                                                            //FIN  DUPLICADOS FUA  
                                                  
                                                  
                                                           /*   if($cnt1Dupli2 > 0){
                                                                  echo "2";
                                                              }else if($cnt1Dupli >= 3){
                                                                  echo "2";
                                                              }else{ */
                                                                  
                                                                                    if($tipoReg==1 && $espost =="3"){ 
                                                                                 
                                                                                 
                                                                                            $coulta1 = "SELECT `idEm` FROM `tbl_Emergencias` WHERE `ideNew`='$ide' AND nroFua='$fua' ";
                                                                                            $ver1 = mysqli_query($conn,$coulta1);
                                                                                            $cn1 = mysqli_num_rows($ver1);
                                                                                            
                                                                                            
                                                                                            if($cn1 > 0){
                                                                                                    echo "1";
                                                                                            }else{
                                                                                                
                                                                                                    $stmt = $conn->prepare( "INSERT INTO `tbl_Emergencias`( idUserRegistro,`nroFua`, `historiaClinica`, `tipoDoc`, `nroDoc`, `sexo`, `cuenta`, `nroAfiliacion`, `eess`,
                                                                                                    `nombres`, `fechaNac`, `ApePaterno`, `ApeMaterno`, `edad`, `tipoRegistro`,envioA,`cta_hospi`,origenEmer,nroRefEmer,eessInicio,subirRef,nvaCta,ctaHos,origenEmerMod,ubicacionHosX,tipoSeiNHosx
                                                                                                    ,`fechaIngreHos`, `montoToaxlHos`,rsatencion,ideNew,status) SELECT  ?, ?, `historiaClinica`, `tipoDoc`, `nroDoc`, `sexo`, `cuenta`, `nroAfiliacion`, `eess`,`nombres`, `fechaNac`, `ApePaterno`, `ApeMaterno`, 
                                                                                                    `edad`, 2 ,envioA,`cta_hospi`,origenEmer,nroRefEmer,eessInicio,subirRef,nvaCta,ctaHos,?,?,?,?,?,?,idEm,?  FROM `tbl_Emergencias` WHERE `idEm` =  $ide");                                  
                                                                                                    $stmt->bind_param('isiiissss',$iduser,$fua,$tipoReg,$ubicacion,$tipoSeiN,$feingre,$monTotalCo,$rsatencion,$statusRegPax);
                                                                                                    $stmt->execute();
                                                                                                     printf("Error: %s.\n", $stmt->error);
                                                                                             
                                                                                            }
                                                                                      
                                                                                       
                                                                                    }
                                                                                    else if($tipoReg==1 && $espost!="3" && $financia =="2" && $liquIx=="on" && $tipoSeiNDes !=""){
                                                                                        
                                                                                                         $coulta3 ="";
                                                                                                        if($fua=="6207-24-" || $fua=="00006207-24-0000null"){
                                                                                                            $coulta3 = "SELECT `idPac` FROM `paciente` WHERE `nroCuenta`='$cuenta'";
                                                                                                        }else{
                                                                                                            $coulta3 = "SELECT `idPac` FROM `paciente` WHERE `nroCuenta`='$cuenta'  OR nroFua='$fua' ";
                                                                                                        }
                                                                                                         //$coulta3 = "SELECT `idPac` FROM `paciente` WHERE `nroCuenta`='$cuenta' AND idEmg='$ide' AND nroFua='$fua'";
                                                                                                         $verI = mysqli_query($conn,$coulta3);
                                                                                                         $cn = mysqli_num_rows($verI);
                                                                                                         echo $coulta3."-->AQUI";
                                                                                                         
                                                                                                        if($cn > 0){
                                                                                                            echo "1";
                                                                                                        }else{
                                                                                                                 $stmt = $conn->prepare( "INSERT INTO `paciente`(`iduser`, `nroFua`, `nroCuenta`, `paciente`,  `F_Ingreso`, `F_Alta_Medica`, `Historia`, `DNI`, 
                                                                                                                `estado`, `montogal`, `montosisfar`, `valorFinal`, `tipoDoc`,`tipoEval`, `idEmg`,serEgreso) SELECT  ? , ?, ?, ?, ?, ?, ?, ?,'GENERADO', ? ,?, ? , ?,'2',$ide,? 
                                                                                                                FROM `tbl_Emergencias`  WHERE `idEm` =  $ide");                                  
                                                                                                                $stmt->bind_param('issssssssssss', $reciAudit,$fua,$cuenta,$paxt,$fereinNew,$feAltaAlt,$hisCli,$NroDoc, $monGal,$montSif,$monTotalCo,$tipc,$tipoSeiNDes);
                                                                                                                $stmt->execute();
                                                                                                               // printf("Error: %s.\n", $stmt->error);
                                                                                                            
                                                                                                        }
                                                                                        
                                                                                    }
                                                                                    
                                                                                    else if($tipoReg==3 && $espost!="13" && $liquIx=="on" || $tipoReg==3 && $espost!="14" && $liquIx=="on" ){
                                                                                        
                                                                                                         $coulta3 ="";
                                                                                                            if($fua=="6207-24-" || $fua=="00006207-24-0000null"){
                                                                                                                $coulta3 = "SELECT `idPac` FROM `paciente` WHERE `nroCuenta`='$cuenta'";
                                                                                                            }else{
                                                                                                                $coulta3 = "SELECT `idPac` FROM `paciente` WHERE `nroCuenta`='$cuenta'  OR nroFua='$fua' ";
                                                                                                            }
                                                                                                         //$coulta3 = "SELECT `idPac` FROM `paciente` WHERE `nroCuenta`='$cuenta' AND idEmg='$ide' AND nroFua='$fua' ";
                                                                                                         $verI = mysqli_query($conn,$coulta3);
                                                                                                         $cn = mysqli_num_rows($verI);
                                                                                                         
                                                                                                         
                                                                                                        if($cn > 0){
                                                                                                            echo "1";
                                                                                                        }else{
                                                                                                                 $stmt = $conn->prepare( "INSERT INTO `paciente`(`iduser`, `nroFua`, `nroCuenta`, `paciente`,servicio, `F_Ingreso`, `F_Alta_Medica`, `Historia`, `DNI`, 
                                                                                                                `estado`, `montogal`, `montosisfar`, `valorFinal`, `tipoDoc`,`tipoEval`, `idEmg`,serEgreso) SELECT  ? , ?, ?, ?, ?, ?, ?, ?, ?,'GENERADO', ? ,?, ? , ?,'3',$ide,? 
                                                                                                                FROM `tbl_Emergencias`  WHERE `idEm` =  $ide");                                  
                                                                                                                $stmt->bind_param('isssssssssssss', $reciAudit,$nroFuaInter,$cuenta,$paxt,$serEspecia,$fereinNew,$feAltaAlt,$hisCli,$NroDoc, $monGal,$montSif,$monTotalCo,$tipc,$tipoSeiNDes);
                                                                                                                $stmt->execute();
                                                                                                                //printf("Error: %s.\n", $stmt->error);
                                                                                                            
                                                                                                        }
                                                                                        
                                                                                        
                                                                                                   //$cta_hospi   
                                                                                    }
                                                                                     else if($tipoReg==2 && $espost!="3" && $financia =="2" && $liquIx=="on" && $pab2Hos!=""){
                                                                                                        $conli ='';     
                                                                                                       // echo $origenEmerMod."<br>";
                                                                                                        if($origenEmerMod == '2' || $origenEmerMod == ''){
                                                                                                                $conli =$cuenta;
                                                                                                                //echo $fua;
                                                                                                        }else if($origenEmerMod == '1' ){
                                                                                                                $conli =$cuentaHsoMod;
                                                                                                                //echo $cuentaHsoMod;
                                                                                                        }
                                                                                        
                                                                                                        $coulta3 ="";
                                                                                                        if($fua=="6207-24-" || $fua=="00006207-24-0000null"){
                                                                                                            $coulta3 = "SELECT `idPac` FROM `paciente` WHERE `nroCuenta`='$conli'";
                                                                                                        }else{
                                                                                                            $coulta3 = "SELECT `idPac` FROM `paciente` WHERE `nroCuenta`='$conli'  OR nroFua='$fua' ";
                                                                                                        }
                                                                                                         
                                                                                                        // $coulta3 = "SELECT `idPac` FROM `paciente` WHERE `nroCuenta`='$conli' AND idEmg='$ide' AND nroFua='$fua'";
                                                                                                         //echo $coulta3;
                                                                                                         $verI = mysqli_query($conn,$coulta3);
                                                                                                         $cn = mysqli_num_rows($verI);
                                                                                                         
                                                                                                         //1 ->Hospi
                                                                                                         //2->Emergencia
                                                                                                         //echo $conli;
                                                                                                        if($cn > 0){
                                                                                                            //echo "1";
                                                                                                        }else{
                                                                                                            //$fereinNew='2023-02-11';
                                                                                                            
                                                                                                            echo $coulta3;
                                                                                                                $stmt = $conn->prepare( "INSERT INTO `paciente`(`iduser`, `nroFua`, `nroCuenta`, `paciente`,  `F_Ingreso`, `F_Alta_Medica`, `Historia`, `DNI`, 
                                                                                                                `estado`, `montogal`, `montosisfar`, `valorFinal`, `tipoDoc`,`tipoEval`, `idEmg`,serEgreso,servicio) 
                                                                                                                SELECT  ? , ?, ?, ?, ?, ?, ?, ?,'GENERADO', ? ,?, ? , ?,'1',$ide,?,(SELECT `descripcion` FROM `pabellones` WHERE `idPa`='$pab2Hos') 
                                                                                                                FROM `tbl_Emergencias`  WHERE `idEm` =  $ide");                                  
                                                                                                                $stmt->bind_param('issssssssssss', $reciAudit,$fua,$conli,$paxt,$fereinNew,$feAltaAlt,$hisCli,$NroDoc,$monGal,$montSif,$monTotalCo,$tipc,$pab2Hos);
                                                                                                                $stmt->execute();
                                                                                                                //printf("Error: %s.\n", $stmt->error); 
                                                                                                               // echo "AQUI";
                                                                                                            
                                                                                                        }
                                                                                    
                                                                                        
                                                                                                      
                                                                                    }
                                                                        
            
                                                                                
                                                                                    if($tipoReg==3){
                                                                                        
                                                                                        
                                                                                                
                                                                                                $stmt = $conn->prepare( "UPDATE `tbl_Emergencias` SET `nroFua`=?,`historiaClinica`=?,`tipoDoc`=?,
                                                                                                `nroDoc`=?,`seguro`=?,`aseguradora`=?,`ubicacion`=?,`sexo`=?,`cuenta`=?,`nroAfiliacion`=?,`eess`=?,`nombres`=?,`fechaNac`=?,
                                                                                                `ApePaterno`=?,`ApeMaterno`=?,`teleFam`=?,`edad`=?,`destino`=?,`fechaDestino`=?,`refeContraref`=?,`servicioPabellon`=?,
                                                                                                `fechaIngreso`=?,`fechaAlta`=?,`montoGalenos`=?,`montoSisfar`=?,`Observaciones`=?,`tipoRegistro`=?,`envioA`=?,`userRecibe`=?,`fechaUserRecibe`=?
                                                                                                ,`actras`= ? ,`financia`= ? ,`regim`= ? ,`planSal`= ? ,`tipoSeiN`= ? ,`feSolAte`= ? ,`ubicacionDes`= ? ,`tipoSeiNDes`= ? ,`feingreAlta`= ? ,`feAltaAlt`= ? ,
                                                                                                `monTotalCo`= ? ,`monCarGar`= ? ,`fuaEntre`= ? ,`fechaFuaEntre`= ?,fechaAful = ?,estancia = ?,correo = ?,`contrasena` = ?, `responsable` = ?, `cta_hospi` = ?, `liquidador` = ?,
                                                                                                 origenEmer = ?,nroRefEmer = ?,eessInicio = ?,subirRef = ?,nvaCta = ?,ctaHos = ?,rsatencion = ?,reciAudit = ?,registraAlta = ?,nroCxref = ?,segurosAl = ?
                                                                                                 ,`cuentaHsoMod`= ? ,`origenEmerMod`= ? ,`ubicacionHosX`= ? ,`tipoSeiNHosx`= ? ,`essHos`= ? ,`nroRefHZ`= ? ,`dxDescricon`= ? ,`feReefHos`= ? ,`especialidadHos`= ? ,
                                                                                                 `pab1Hos`= ? ,`camHos1`= ? ,`pab2Hos`= ? ,`camHos2`= ?,`aceptarTransf`= ?,`listObsFua`= ?,`fuaRcxHos`= ?,`idUserLiquida`= ?,status = ?,prioridad = ?,tipoLiqux = ?,
                                                                                                 regServiceCE= ? ,tipoCita= ?  WHERE `idEm`= $ide");                                  
                                                                                                $stmt->bind_param('ssssiiisssssssssssssisssssissssiiiisiisssssssssssssisssssssssisiiissssiisisssssssssi', $nroFuaInter, $hisCli,$tipoDoc,$NroDoc,$seguros,$listaSeguros,$ubicacion,$sexo,
                                                                                                $cuenta,$NroAf,$eess,$nombres,$FechaNac,$apepa,$apema,$telefa,$edad,$espost,$fefa,$referido,$pabellones,$feingre,$feAlta,$monGal,$montSif,$obsRes,$tipoReg,$envioA,$iduser,$feuser,
                                                                                                $actras,$financia ,$regim,$planSal,$tipoSeiN,$feSolAte,$ubicacionDes,$tipoSeiNDes,$feingreAlta,$feAltaAlt,$monTotalCo,$monCarGar,$fuaEntre,$fechaFuaEntre,$fechaAful,
                                                                                                $estaDias,$emailAuto,$cns,$campRes,$ctaHos,$liquIx,$origenEmer,$nroRefEmer,$eessInicio,$subirRef,$nvaCta,$ctaHos,$rsatencion,$reciAudit,$registraAlta,$nroCxref,$segurosAl,
                                                                                                $cuentaHsoMod,$origenEmerMod,$ubicacionHosX,$tipoSeiNHosx,$essHos ,$nroRefHZ,$dxDescricon ,$feReefHos,$especialidadHos,$pab1Hos,$camHos1 ,$pab2Hos,$camHos2,$aceptarTransf,$listObsFua,
                                                                                                $fuaRcxHos,$idUserLiquida,$statusRegPax,$prioridad,$tipoLiqux,$serEspecia,$tipocita);
                                                                                                $stmt->execute();
                                                                                                // printf("Error: %s.\n", $stmt->error);
                                                                                                //echo "";
                                                                                        
                                                                                        
                                                                                    }else{
                                                                                            
                                                                                                
                                                                                                $stmt = $conn->prepare( "UPDATE `tbl_Emergencias` SET `nroFua`=?,`historiaClinica`=?,`tipoDoc`=?,
                                                                                                `nroDoc`=?,`seguro`=?,`aseguradora`=?,`ubicacion`=?,`sexo`=?,`cuenta`=?,`nroAfiliacion`=?,`eess`=?,`nombres`=?,`fechaNac`=?,
                                                                                                `ApePaterno`=?,`ApeMaterno`=?,`teleFam`=?,`edad`=?,`destino`=?,`fechaDestino`=?,`refeContraref`=?,`servicioPabellon`=?,
                                                                                                `fechaIngreso`=?,`fechaAlta`=?,`montoGalenos`=?,`montoSisfar`=?,`Observaciones`=?,`tipoRegistro`=?,`envioA`=?,`userRecibe`=?,`fechaUserRecibe`=?
                                                                                                ,`actras`= ? ,`financia`= ? ,`regim`= ? ,`planSal`= ? ,`tipoSeiN`= ? ,`feSolAte`= ? ,`ubicacionDes`= ? ,`tipoSeiNDes`= ? ,`feingreAlta`= ? ,`feAltaAlt`= ? ,
                                                                                                `monTotalCo`= ? ,`monCarGar`= ? ,`fuaEntre`= ? ,`fechaFuaEntre`= ?,fechaAful = ?,estancia = ?,correo = ?,`contrasena` = ?, `responsable` = ?, `cta_hospi` = ?, `liquidador` = ?,
                                                                                                 origenEmer = ?,nroRefEmer = ?,eessInicio = ?,subirRef = ?,nvaCta = ?,ctaHos = ?,rsatencion = ?,reciAudit = ?,registraAlta = ?,nroCxref = ?,segurosAl = ?
                                                                                                 ,`cuentaHsoMod`= ? ,`origenEmerMod`= ? ,`ubicacionHosX`= ? ,`tipoSeiNHosx`= ? ,`essHos`= ? ,`nroRefHZ`= ? ,`dxDescricon`= ? ,`feReefHos`= ? ,`especialidadHos`= ? ,
                                                                                                 `pab1Hos`= ? ,`camHos1`= ? ,`pab2Hos`= ? ,`camHos2`= ?,`aceptarTransf`= ?,`listObsFua`= ?,`fuaRcxHos`= ?,`idUserLiquida`= ?,status = ?,prioridad = ?,tipoLiqux = ?,
                                                                                                 regServiceCE= ? ,tipoCita= ?  WHERE `idEm`= $ide");                                  
                                                                                                $stmt->bind_param('ssssiiisssssssssssssisssssissssiiiisiisssssssssssssisssssssssisiiissssiisisssssssssi', $fua, $hisCli,$tipoDoc,$NroDoc,$seguros,$listaSeguros,$ubicacion,$sexo,
                                                                                                $cuenta,$NroAf,$eess,$nombres,$FechaNac,$apepa,$apema,$telefa,$edad,$espost,$fefa,$referido,$pabellones,$feingre,$feAlta,$monGal,$montSif,$obsRes,$tipoReg,$envioA,$iduser,$feuser,
                                                                                                $actras,$financia ,$regim,$planSal,$tipoSeiN,$feSolAte,$ubicacionDes,$tipoSeiNDes,$feingreAlta,$feAltaAlt,$monTotalCo,$monCarGar,$fuaEntre,$fechaFuaEntre,$fechaAful,
                                                                                                $estaDias,$emailAuto,$cns,$campRes,$ctaHos,$liquIx,$origenEmer,$nroRefEmer,$eessInicio,$subirRef,$nvaCta,$ctaHos,$rsatencion,$reciAudit,$registraAlta,$nroCxref,$segurosAl,
                                                                                                $cuentaHsoMod,$origenEmerMod,$ubicacionHosX,$tipoSeiNHosx,$essHos ,$nroRefHZ,$dxDescricon ,$feReefHos,$especialidadHos,$pab1Hos,$camHos1 ,$pab2Hos,$camHos2,$aceptarTransf,$listObsFua,
                                                                                                $fuaRcxHos,$idUserLiquida,$statusRegPax,$prioridad,$tipoLiqux,$serEspecia,$tipocita);
                                                                                                $stmt->execute();
                                                                                                // printf("Error: %s.\n", $stmt->error);
                                                                                                //echo "";
                                                                                            
                                                                                            
                                                                                        
                                                                                    }
            
                                                        
                                                              }
                                               
                                            
                                        /*    }  */
                                            
                                            else {
                                                
                                                 //VALIDAR CAMA 
                                                            $colta1 = "SELECT `idEm` FROM `tbl_Emergencias` WHERE `pab1Hos`='$pab1Hos' AND camHos1= '$camHos1' AND ubicacionDes IS NULL ";
                                                            $veIf1 = mysqli_query($conn,$colta1);
                                                            $cnt1 = mysqli_num_rows($veIf1);    
                                                  //FIN  CAMA      
                                                                 
                                                                if($tipoReg== 3){
                                                                    $consulta3 = "SELECT `idEm` FROM `tbl_Emergencias` WHERE `nroFua`='$nroFuaInter'";
                                                                    $verIf3 = mysqli_query($conn,$consulta3);
                                                                    $cnt3 = mysqli_num_rows($verIf3);
                                                                    
                                                                } else{
                                                                    
                                                                    $consulta3 = "SELECT `idEm` FROM `tbl_Emergencias` WHERE `cuenta`='$cuenta'";
                                                                    $verIf3 = mysqli_query($conn,$consulta3);
                                                                    $cnt3 = mysqli_num_rows($verIf3);
                                                                    
                                                                }
                                                    
                                                            
                                                         
                                                            if($cnt3 > 0){
                                                                echo "1";
                                                            }else{
                                                                             
                                                                
                                                                    if($tipoReg==3){
                                                                            
                                                                            $stmt = $conn->prepare( "INSERT INTO `tbl_Emergencias`(`idUserRegistro`, `nroFua`, `historiaClinica`, `tipoDoc`, `nroDoc`, `seguro`, `aseguradora`, `ubicacion`,
                                                                            `sexo`, `cuenta`, `nroAfiliacion`, `eess`, `nombres`, `fechaNac`, `ApePaterno`, `ApeMaterno`, `teleFam`, `edad`, `destino`, `fechaDestino`, `refeContraref`, 
                                                                            `servicioPabellon`, `fechaIngreso`, `fechaAlta`, `montoGalenos`, `montoSisfar`, `Observaciones`, `tipoRegistro`, `regim`, `planSal`, `tipoSeiN`, 
                                                                            `feSolAte`, `ubicacionDes`, `tipoSeiNDes`, `feingreAlta`, `feAltaAlt`, `monTotalCo`,`monCarGar`, `fuaEntre`, `fechaFuaEntre`,fechaAful,estancia,correo,`contrasena`,
                                                                            `responsable`, `cta_hospi`, `liquidador`,origenEmer,nroRefEmer,eessInicio,subirRef,nvaCta,ctaHos,rsatencion,reciAudit,registraAlta,nroCxref,segurosAl,`cuentaHsoMod`, 
                                                                            `origenEmerMod`, `ubicacionHosX`, `tipoSeiNHosx`, `essHos`, `nroRefHZ`, `dxDescricon`, `feReefHos`, `especialidadHos`, `pab1Hos`, `camHos1`, `pab2Hos`, `camHos2`,
                                                                            idUserLiquida,status,prioridad,tipoLiqux,regServiceCE,tipoCita)VALUES (?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                                                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, ?)");
                                                                            $stmt->bind_param('issssiiisssssssssssssisssssiiiisiisssssssssssssisssssssssisiiissssiisissssssi', $iduser, $fua, $hisCli,$tipoDoc,$NroDoc,$seguros,$listaSeguros,$ubicacion,$sexo,$cuenta,$NroAf,$eess,
                                                                            $nombres,$FechaNac,$apepa,$apema,$telefa,$edad,$espost,$fefa,$referido,$pabellones,$feingre,$feAlta,$monGal,$montSif,$obsRes,$tipoReg ,$regim,$planSal,$tipoSeiN,$feSolAte,
                                                                            $ubicacionDes,$tipoSeiNDes,$feingreAlta,$feAltaAlt,$monTotalCo,$monCarGar,$fuaEntre,$fechaFuaEntre,$fechaAful,$estaDias,$emailAuto,$cns,$campRes,$ctaHos,$liquIx,
                                                                            $origenEmer,$nroRefEmer,$eessInicio,$subirRef,$nvaCta,$ctaHos,$rsatencion,$reciAudit,$registraAlta,$nroCxref,$segurosAl,$cuentaHsoMod,$origenEmerMod,$ubicacionHosX,$tipoSeiNHosx,
                                                                            $essHos ,$nroRefHZ,$dxDescricon,$feReefHos,$especialidadHos,$pab1Hos,$camHos1,$pab2Hos,$camHos2,$idUserLiquida,$statusRegPax,$prioridad,$tipoLiqux,$serEspecia,$tipocita);
                                                                            $stmt->execute();
                                                                            printf("Error: %s.\n", $stmt->error);
                                                                            echo "INSERTADO";
                                                                    }else{
                                                                            
                                                                            $stmt = $conn->prepare( "INSERT INTO `tbl_Emergencias`(`idUserRegistro`, `nroFua`, `historiaClinica`, `tipoDoc`, `nroDoc`, `seguro`, `aseguradora`, `ubicacion`,
                                                                            `sexo`, `cuenta`, `nroAfiliacion`, `eess`, `nombres`, `fechaNac`, `ApePaterno`, `ApeMaterno`, `teleFam`, `edad`, `destino`, `fechaDestino`, `refeContraref`, 
                                                                            `servicioPabellon`, `fechaIngreso`, `fechaAlta`, `montoGalenos`, `montoSisfar`, `Observaciones`, `tipoRegistro`,`actras`, `financia`, `regim`, `planSal`, `tipoSeiN`, 
                                                                            `feSolAte`, `ubicacionDes`, `tipoSeiNDes`, `feingreAlta`, `feAltaAlt`, `monTotalCo`,`monCarGar`, `fuaEntre`, `fechaFuaEntre`,fechaAful,estancia,correo,`contrasena`,
                                                                            `responsable`, `cta_hospi`, `liquidador`,origenEmer,nroRefEmer,eessInicio,subirRef,nvaCta,ctaHos,rsatencion,reciAudit,registraAlta,nroCxref,segurosAl,`cuentaHsoMod`, 
                                                                            `origenEmerMod`, `ubicacionHosX`, `tipoSeiNHosx`, `essHos`, `nroRefHZ`, `dxDescricon`, `feReefHos`, `especialidadHos`, `pab1Hos`, `camHos1`, `pab2Hos`, `camHos2`,
                                                                            idUserLiquida,status,prioridad,tipoLiqux,regServiceCE,tipoCita)VALUES(?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                                                                            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?, ?,?,?)");
                                                                            $stmt->bind_param('issssiiisssssssssssssisssssisiiiisiisssssssssssssisssssssssisiiissssiisissssssi', $iduser, $fua, $hisCli,$tipoDoc,$NroDoc,$seguros,$listaSeguros,$ubicacion,$sexo,$cuenta,$NroAf,$eess,
                                                                            $nombres,$FechaNac,$apepa,$apema,$telefa,$edad,$espost,$fefa,$referido,$pabellones,$feingre,$feAlta,$monGal,$montSif,$obsRes,$tipoReg,$actras,$financia ,$regim,$planSal,$tipoSeiN,$feSolAte,
                                                                            $ubicacionDes,$tipoSeiNDes,$feingreAlta,$feAltaAlt,$monTotalCo,$monCarGar,$fuaEntre,$fechaFuaEntre,$fechaAful,$estaDias,$emailAuto,$cns,$campRes,$ctaHos,$liquIx,
                                                                            $origenEmer,$nroRefEmer,$eessInicio,$subirRef,$nvaCta,$ctaHos,$rsatencion,$reciAudit,$registraAlta,$nroCxref,$segurosAl,$cuentaHsoMod,$origenEmerMod,$ubicacionHosX,$tipoSeiNHosx,
                                                                            $essHos ,$nroRefHZ,$dxDescricon ,$feReefHos,$especialidadHos,$pab1Hos,$camHos1,$pab2Hos,$camHos2,$idUserLiquida,$statusRegPax,$prioridad,$tipoLiqux,$serEspecia,$tipocita);
                                                                            $stmt->execute();
                                                                            printf("Error: %s.\n", $stmt->error);
                                                                            echo "INSERTADO";
                                                                            
                                                                    }
                                                                    

                                                            }
                                                

                                            }
                                            
                                            
                            }

                         

                    }
                    
                    
                    
                    function updateEstadoEnvio($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                    $ide =     $procedimientos['ide'];
                                    $estadoA = "on";
                                    $espost = $procedimientos['espost'];
                                    $tipoReg = $procedimientos['tipoReg'];

                                     if($tipoReg==1  && $espost =="3"){
                                         
                                            $stmt = $conn->prepare( "UPDATE `tbl_Emergencias` SET `estadoA`= ? WHERE `idEm`= $ide");                                  
                                            $stmt->bind_param('s', $estadoA);
                                            $stmt->execute();
                                            
                                     }else if ($tipoReg==2  && $espost =="5"){
                                         
                                             $stmt = $conn->prepare( "UPDATE `tbl_Emergencias` SET `estadoA`= ? WHERE `idEm`= $ide");                                  
                                             $stmt->bind_param('s', $estadoA);
                                             $stmt->execute();
                                       
                                     }          
                                
                            }

                         

                    }
                    
                    function updateFechaUsuarioAudi($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                            $ide =     $procedimientos['ide'];
                                            date_default_timezone_set('America/Lima');
                                            $fechaEnvioAuditoria   = date("Y-m-d H:i:s");
                                   
                                            $stmt = $conn->prepare( "UPDATE `tbl_Emergencias` SET `fechaRegistroAltaUsuario`= ? WHERE `idEm` = $ide");                                  
                                            $stmt->bind_param('s', $fechaEnvioAuditoria);
                                            $stmt->execute();
                                
                            }

                    }
                    
                    function fechaRegistroIngresoUserf($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                            $ide =     $procedimientos['ide'];
                                            date_default_timezone_set('America/Lima');
                                            $fechaEnvioAuditoria   = date("Y-m-d H:i:s");
                                   
                                            $stmt = $conn->prepare( "UPDATE `tbl_Emergencias` SET `fechaRegistroIngresoUser`= ? WHERE `idEm` = $ide");                                  
                                            $stmt->bind_param('s', $fechaEnvioAuditoria);
                                            $stmt->execute();
                                
                            }

                    }
                    
                    
                    function createEditGrupo($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                            $idusergru = $procedimientos['idusergru'];
                                            $idgroux   = $procedimientos['idgroux'];
                                            $audiGrupo = $procedimientos['audiGrupo'];
                                            $obsGrupo  = $procedimientos['obsGrupo'];
                                            $nomPac    = $procedimientos['nomPac'];
                                            
                                            $feAsg = $procedimientos['feAsg'];
                                            $feRexc = $procedimientos['feRexc'];


                                            if($idgroux!=""){
                                        
                                                    $stmt = $conn->prepare( "UPDATE `tbl_grupoCE` SET `idAuditor`= ? ,`observacion`= ?,`namePaquete`= ?,`fechaAsig`= ?
                                                    ,`fechaRecep`= ? WHERE idGrupo = $idgroux");                                  
                                                    $stmt->bind_param('issss', $audiGrupo, $obsGrupo,$nomPac,$feAsg,$feRexc);
                                                    $stmt->execute();
                                                    //echo "ACTUALIZADO";
                                            
                                            }else {
                                                
                                                            
                                                    $stmt = $conn->prepare( "INSERT INTO `tbl_grupoCE`(`idUsuario`, `idAuditor`, `observacion`,`namePaquete`,fechaAsig,fechaRecep) 
                                                    VALUES (?, ?, ?,?,?,?)");
                                                    $stmt->bind_param('iissss', $idusergru, $audiGrupo, $obsGrupo,$nomPac,$feAsg,$feRexc);
                                                    $stmt->execute();
                                                    //echo "INSERTADO";

                                            }
                            }

                         

                    }
                    
                    
                    
                     function createEditPaquete($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                            $iduser = $procedimientos['iduser'];
                                            $idPak   = $procedimientos['idPak'];
                                            $idGroup   = $procedimientos['idGroup'];
                                            
                                            $listCaja = $procedimientos['listCaja'];
                                            $listAuditx = $procedimientos['listAuditx'];
                                            $obsPaquete  = $procedimientos['obsPaquete'];
                                            $fechaHoraAsignadoDigitador  = $procedimientos['fechaHoraAsignadoDigitador'];
                                            $fechaHoraUserAudix  = $procedimientos['fechaHoraUserAudix'];
                                            
                                           $userAsignaAudi =  $procedimientos['userAsignaAudi'];
                                           $userAsignaDigi =  $procedimientos['userAsignaDigi'];
                                           $listLix =  $procedimientos['listLix'];

                                            if($idPak!=""){
                                        
                                                    $stmt = $conn->prepare( "UPDATE `tbl_grupoArchivo` SET `observacion`= ?,`userAsignado`= ? ,`fechaHoraAsignadoDigitador`= ?,userAuditor = ? ,fechaHoraUserAuditor = ?  
                                                    ,userAsignaAudi = ? ,userAsignaDigi = ?,liquidador= ?  WHERE idGrupo = $idPak");                                  
                                                    $stmt->bind_param('sissssss',$obsPaquete,$listCaja,$fechaHoraAsignadoDigitador,$listAuditx,$fechaHoraUserAudix,$userAsignaAudi,$userAsignaDigi,$listLix);
                                                    $stmt->execute();
                                                   // echo "ACTUALIZADO";
                                            
                                            }else {
                                                
                                                    $stmt = $conn->prepare( "INSERT INTO `tbl_grupoArchivo`(`idUsuario`, `observacion`,`userAsignado`,`fechaHoraAsignadoDigitador`,tipoRegistro,userAuditor,fechaHoraUserAuditor,userAsignaAudi,userAsignaDigi,liquidador)
                                                    VALUES (?, ?,?,?,?,?,?,?,?,?)");
                                                    $stmt->bind_param('isisssssss', $iduser,$obsPaquete, $listCaja,$fechaHoraAsignadoDigitador,$idGroup,$listAuditx,$fechaHoraUserAudix,$userAsignaAudi,$userAsignaDigi,$listLix);
                                                    $stmt->execute();
                                                    //echo "INSERTADO";

                                            }
                                            
                            }

                         

                    }
                    
                    
                    function registroPacientePatologia($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                          $iduser =    $procedimientos['iduser'];
                                          $idRegPatot=  $procedimientos['idRegPatot'];
                                          $tipoDocPato =     $procedimientos['tipoDocPato'];
                                          $nroDocPato =     $procedimientos['nroDocPato'];
                                          $pacientePato =     $procedimientos['pacientePato'];
                                          $edadPato =     $procedimientos['edadPato'];
                                          $sexoPat =     $procedimientos['sexoPat'];
                                          $financiaPTO =     $procedimientos['financiaPTO'];
                                          $iprId =     $procedimientos['iprId'];
                                          $juriPr =     $procedimientos['juriPr'];
                                          $ctinmuno =     $procedimientos['ctinmuno'];
                                          $historiaPat =     $procedimientos['historiaPat'];
                                          $servicioPat =     $procedimientos['servicioPat'];
                                          $salacamaPat =     $procedimientos['salacamaPat'];
                                          $celularPacientePatologia =     $procedimientos['celularPacientePatologia'];
                                          $nroOrdenPat =     $procedimientos['nroOrdenPat'];
                                          
                                          $tipoServicoPatl =     $procedimientos['tipoServicoPatl'];
                                          $selecConvenio =     $procedimientos['selecConvenio'];
                                          $ipressConvenio =     $procedimientos['ipressConvenio'];
                                          
                                          
                                          //$corPat =     $procedimientos['corPat'];
                                          $anio = date("Y");
                                            
                                            if($idRegPatot==""){
                                                
                                                    $stmt = $conn->prepare( "INSERT INTO `tbl_registroPacientesPatologia`(`iduser`, `tipodoc`, `nrodoc`, `paciente`, `edad`, `sexo`, `finaciamiento`, 
                                                    `ipress`, `jurisdiccion`, `cuenta`, `historia`, `servicio`, `salacama`, `celular`,anio,tipoServicoPatl,selecConvenio,ipressConvenio) 
                                                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                                    $stmt->bind_param('iissssisssssssiiis', $iduser,$tipoDocPato, $nroDocPato,$pacientePato,$edadPato,$sexoPat,$financiaPTO,$iprId,$juriPr,$ctinmuno,$historiaPat,
                                                    $servicioPat,$salacamaPat,$celularPacientePatologia,$anio,$tipoServicoPatl,$selecConvenio,$ipressConvenio);
                                                    $stmt->execute();
                                                    
                                            }else{
                                                
                                                    $stmt = $conn->prepare( "UPDATE `tbl_registroPacientesPatologia` SET `tipodoc`= ? ,`nrodoc`= ? ,`paciente`= ? ,`edad`= ? ,
                                                    `sexo`= ? ,`finaciamiento`= ? ,`ipress`= ? ,`jurisdiccion`= ? ,`cuenta`= ? ,`historia`= ? ,`servicio`= ? ,`salacama`= ? ,
                                                    `celular`= ?,`tipoServicoPatl`= ?,`selecConvenio`= ?,`ipressConvenio`= ?  WHERE `idPato`='$idRegPatot'");
                                                    $stmt->bind_param('issssissssssssss', $tipoDocPato, $nroDocPato,$pacientePato,$edadPato,$sexoPat,$financiaPTO,$iprId,$juriPr,$ctinmuno,
                                                    $historiaPat,$servicioPat,$salacamaPat,$celularPacientePatologia,$tipoServicoPatl,$selecConvenio,$ipressConvenio);
                                                    $stmt->execute();
                                                
                                            }
                                                
                                            
                                            //echo "INSERTADO";

                                            
                                            
                            }

                         

                    }
                    
                    
                    function registroPacientePatologia2($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                          $iduser2 =    $procedimientos['iduser2'];
                                          $idRegSec2 =     $procedimientos['idRegSec2'];
                                          $factPat =     $procedimientos['factPat'];
                                          $tipoEstPat = $procedimientos['tipoEstPat'];
                                          $procePat = $procedimientos['procePat'];
                                          $mediSolicitante =     $procedimientos['mediSolicitante'];
                                          $especialPat =     $procedimientos['especialPat'];
                                          $fechaPat =     $procedimientos['fechaPat'];
                                          $corPat =     $procedimientos['corPat'];
                                          $idAuditorAsignado =     $procedimientos['idAuditorAsignado'];
                                                
                                            $stmt = $conn->prepare( "UPDATE `tbl_registroPacientesPatologia` SET `nroFactura`= ? ,`medicoSolicitante`= ? ,
                                            `especialidad`= ? ,`fechaRecepcion`= ?,tipoEstudio = ?,procedimiento = ?,corPat = ?,idAuditorAsignado = ?  WHERE `idPato` ='$idRegSec2'");
                                            $stmt->bind_param('ssssiiii', $factPat,$mediSolicitante,$especialPat,$fechaPat,$tipoEstPat,$procePat,$corPat,$idAuditorAsignado);
                                            $stmt->execute();
                                            //echo "INSERTADO";

                                            
                                            
                            }

                         

                    }
                    
                    function registroPacientePatologia3($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                          $iduserPatol =    $procedimientos['iduserPatol'];
                                          $idPat =     $procedimientos['idPat'];
                                          $anaMuestraCito =     $procedimientos['anaMuestraCito'];
                                          $procedRealCito = $procedimientos['procedRealCito'];
                                          $medicoSolcit = $procedimientos['medicoSolcit'];
                                          $dxClinicoHi =     $procedimientos['dxClinicoHi'];
                                          $interpretacPato =     $procedimientos['interpretacPato'];
                                          $comentarioPatol =     $procedimientos['comentarioPatol'];
                                          $notaPatol =     $procedimientos['notaPatol'];
                                          $idReportPdf =     $procedimientos['idReportPdf'];
                                          $nomApeConfirApepat =     $procedimientos['nomApeConfirApepat'];
                                          $fechaHoraReport =    date("Y-m-d H:i:s");
                                          
                                                
                                            $stmt = $conn->prepare( "UPDATE `tbl_registroPacientesPatologia` SET `anaMuestraCito`= ? ,`procedRealCito`= ? ,
                                            `medicoSolcit`= ? ,dxClinicoHi = ?,interpretacPato = ?,comentarioPatol = ? ,notaPatol = ?,fechaHoraReport = ?,nomApeConfirApepat = ?  WHERE `idPato` ='$idPat'");
                                            $stmt->bind_param('iissssssi', $anaMuestraCito,$procedRealCito,$medicoSolcit,$dxClinicoHi,$interpretacPato,$comentarioPatol,$notaPatol
                                            ,$fechaHoraReport,$nomApeConfirApepat);
                                            $stmt->execute();
                                            //echo "INSERTADO";

                                            
                                            
                            }

                         

                    }
                    
                    
                    function registroPacientePatologia4($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                          $iduserPatol =    $procedimientos['iduserPatol'];
                                          $idPat =     $procedimientos['idPat'];
                                          $fechaHoraReport =    date("Y-m-d H:i:s");
                                          
                                                
                                            $stmt = $conn->prepare( "UPDATE `tbl_registroPacientesPatologia` SET idGeneraInforme = ?,fechaidGeneraInforme = ?  WHERE `idPato` ='$idPat'");
                                            $stmt->bind_param('is', $iduserPatol,$fechaHoraReport);
                                            $stmt->execute();
                                            //echo "INSERTADO";

                                            
                                            
                            }

                         

                    }
                    
                     function registroPacientePatologia4Gen($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                          $iduserPatol =    $procedimientos['iduserPatol'];
                                          $idPat =     $procedimientos['idPat'];
                                          $fechaHoraReport =    date("Y-m-d H:i:s");
                                          
                                                
                                            $stmt = $conn->prepare( "UPDATE `tbl_registroPacientesPatologia` SET idReportPdf = ?,fechaidReportPdf = ?  WHERE `idPato` ='$idPat'");
                                            $stmt->bind_param('is', $iduserPatol,$fechaHoraReport);
                                            $stmt->execute();
                                            //echo "INSERTADO";

                                            
                                            
                            }

                         

                    }
                    
                    
                    function registroPacienteCervicoVaginal($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                          $idCervico =    $procedimientos['idCervico'];
                                          $fechaUltimaRegla =    $procedimientos['fechaUltimaRegla'];
                                          $listEmbarazo =    $procedimientos['listEmbarazo'];
                                          $listMetodoAnti =    $procedimientos['listMetodoAnti'];
                                          $listTipoMetodoAntic =    $procedimientos['listTipoMetodoAntic'];
                                          $TiempoUso =    $procedimientos['TiempoUso'];
                                          $listExaGineco =    $procedimientos['listExaGineco'];
                                          $obsExamenGinec =    $procedimientos['obsExamenGinec'];
                                          $calidEspec =    $procedimientos['calidEspec'];
                                          $especifiqueCalidadEspec =    $procedimientos['especifiqueCalidadEspec'] ;
                                          $clasificacionGen =    $procedimientos['clasificacionGen'];
                                          $EspecclasificacionGen =    $procedimientos['EspecclasificacionGen'];
                                          $celulasEscamosas =    $procedimientos['celulasEscamosas'];
                                          $especelulasEscamosas =    $procedimientos['especelulasEscamosas'];
                                          $celGlandu =    $procedimientos['celGlandu'];
                                          $espeCelGlandu =    $procedimientos['espeCelGlandu'];
                                          $fechaConcySuger =    $procedimientos['fechaConcySuger'];
                                          $dxRealizadoLab =    $procedimientos['dxRealizadoLab'];
                                          $fechalab =    $procedimientos['fechalab'] ;
                                          $nomObtencionMuestras =    $procedimientos['nomObtencionMuestras'];
                                          $profeCargo =    $procedimientos['profeCargo'] ;
                                          $fechaObtencMuestra =    $procedimientos['fechaObtencMuestra'];
                                          $fechaColoscopia =    $procedimientos['fechaColoscopia'];
                                          $especifColoscopia =    $procedimientos['especifColoscopia'];
                                          $dxAnterior =    $procedimientos['dxAnterior'];
                                          $fechadxAnterior =    $procedimientos['fechadxAnterior'];
                                          $otrNeoMalig =    $procedimientos['otrNeoMalig'];
                                          $celulBenignos =    $procedimientos['celulBenignos'] ;
                                          $especifTipoOrg =    $procedimientos['especifTipoOrg'] ;
                                          $cambioReactivos =    $procedimientos['cambioReactivos'];
                                          $espeCambioReac =    $procedimientos['espeCambioReac'];
                                          $patronHormonal =    $procedimientos['patronHormonal'];
                                          $especifPatronHor =    $procedimientos['especifPatronHor'];
                                          $datosResposanble =    $procedimientos['datosResposanble'];
                                          $colegioResp =    $procedimientos['colegioResp'] ;
                                          $nomApeConfir =    $procedimientos['nomApeConfir'];
                                          $colegConfirma =    $procedimientos['colegConfirma'];
                                          $txtAreaConclusiones = $procedimientos['txtAreaConclusiones'];
                                          
                                                
                                            $stmt = $conn->prepare( "UPDATE `tbl_registroPacientesPatologia` SET  `fechaUltimaRegla`= ? ,`listEmbarazo`= ? ,
                                            `listMetodoAnti`= ? ,`listTipoMetodoAntic`= ? ,`TiempoUso`= ? ,`listExaGineco`= ? ,`obsExamenGinec`= ? ,`calidEspec`= ? ,
                                            `especifiqueCalidadEspec`= ? ,`clasificacionGen`= ? ,`EspecclasificacionGen`= ? ,`celulasEscamosas`= ? ,`especelulasEscamosas`= ? ,
                                            `celGlandu`= ? ,`espeCelGlandu`= ? ,`fechaConcySuger`= ? ,`dxRealizadoLab`= ? ,`fechalab`= ? ,`nomObtencionMuestras`= ? ,`profeCargo`= ? ,
                                            `fechaObtencMuestra`= ? ,`fechaColoscopia`= ? ,`especifColoscopia`= ? ,`dxAnterior`= ? ,`fechadxAnterior`= ? ,`otrNeoMalig`= ? ,
                                            `celulBenignos`= ? ,`especifTipoOrg`= ? ,`cambioReactivos`= ? ,`espeCambioReac`= ? ,`patronHormonal`= ? ,`especifPatronHor`= ? ,
                                            `datosResposanble`= ? ,`colegioResp`= ? ,`nomApeConfir`= ? ,`colegConfirma`= ?,`txtAreaConclusiones`= ?  WHERE `idPato`  = '$idCervico'");
                                            $stmt->bind_param('siiisisisisisissssssssssssisisissssss', $fechaUltimaRegla ,$listEmbarazo,
                                            $listMetodoAnti,$listTipoMetodoAntic,$TiempoUso,$listExaGineco ,$obsExamenGinec,$calidEspec,$especifiqueCalidadEspec,$clasificacionGen,$EspecclasificacionGen ,
                                            $celulasEscamosas,$especelulasEscamosas,$celGlandu,$espeCelGlandu ,$fechaConcySuger,$dxRealizadoLab,$fechalab ,$nomObtencionMuestras ,
                                            $profeCargo ,$fechaObtencMuestra ,$fechaColoscopia,$especifColoscopia ,$dxAnterior ,$fechadxAnterior,$otrNeoMalig,$celulBenignos ,
                                            $especifTipoOrg ,$cambioReactivos ,$espeCambioReac ,$patronHormonal ,$especifPatronHor,$datosResposanble ,$colegioResp ,$nomApeConfir,$colegConfirma,$txtAreaConclusiones);
                                           $stmt->execute();
                                           echo "INSERTADO";

                                            
                                            
                            }

                         

                    }
                    
                    
                    function registroPacienteCervicoVaginalId($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                          $idCervico =    $procedimientos['idCervico'];
                                          $idUserCv =    $procedimientos['idUserCv'];
                                          $fechaHoraReport =    date("Y-m-d H:i:s");
                                          
                                                
                                            $stmt = $conn->prepare( "UPDATE `tbl_registroPacientesPatologia` SET  `idCvinforme`= ? ,`fechaidCvinforme`= ? WHERE `idPato`  = '$idCervico'");
                                            $stmt->bind_param('ss', $idUserCv ,$fechaHoraReport);
                                           $stmt->execute();
                                           echo "INSERTADO";

                                            
                                            
                            }

                         

                    }
                    
                    
                     function createEditPaqueteMarcador($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                            $iduser = $procedimientos['iduser'];
                                            $idPak   = $procedimientos['idPak'];
                                            $marcList   = $procedimientos['marcList'];
                                            $resultMarcax = $procedimientos['resultMarcax'];
                                            
                                            $fomaCervi = $procedimientos['fomaCervi'];
                                            $tipoEsCervi = $procedimientos['tipoEsCervi'];
                                            
                                            
                                            $resulDepend = $procedimientos['resulDepend'];
                                            $intesTincion =$procedimientos['intesTincion'];
                                            $nucleosPos =  $procedimientos['nucleosPos'];
                                            $subtotalPun = $procedimientos['subtotalPun'];
                                            $interpretHi = $procedimientos['interpretHi'];
                                            $idPrin = $procedimientos['idPrin'];
                                            
                                            
                                            
                                            if($idPak!=""){
                                                
                                                    $stmt = $conn->prepare( "UPDATE `tbl_crudMarcadores` SET `marcador`= ? ,`resultado`= ?
                                                    ,`resulDepend`= ?,`intesTincion`= ?,`nucleosPos`= ?,`subtotalPun`= ?,`interpretHi`= ? WHERE idMar ='$idPak'");
                                                    $stmt->bind_param('sssssss',$marcList, $resultMarcax,$resulDepend,$intesTincion,$nucleosPos,$subtotalPun,$interpretHi);
                                                    $stmt->execute();
                                                    
                                            }else{
                                                    
                                                    $stmt = $conn->prepare( "INSERT INTO `tbl_crudMarcadores`( `iduser`, `marcador`, `resultado`,formato,tipoest,
                                                    resulDepend,intesTincion,nucleosPos,subtotalPun,interpretHi,idPrin) VALUES (?, ?,?,?,?,?,?,?,?,?,?)");
                                                    $stmt->bind_param('isssisssssi', $iduser,$marcList, $resultMarcax,$fomaCervi,$tipoEsCervi,
                                                    $resulDepend,$intesTincion,$nucleosPos,$subtotalPun,$interpretHi,$idPrin);
                                                    $stmt->execute(); 
                                                    
                                            }
                                           
                                            
                            }

                         

                    }
                    
                    
                    
                    function createEditFechaDig($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                                    $iduser = $procedimientos['iduser'];
                                                    $idPakDig   = $procedimientos['idPakDig'];
                                                    $fechaDigitacion = $procedimientos['fechaDigitacion'];
                                                    $fechaDevolucion = $procedimientos['fechaDevolucion'];
                                                    
                                                    $digit = $procedimientos['digit'];
                                                    $motivoDif = $procedimientos['motivoDif'];
                                                    
                                        
                                                    $stmt = $conn->prepare( "UPDATE `tbl_grupoArchivo` SET `iduserdigitacioncheck`= ?,`fechadigitacioncheck`= ?,`fechaDevolucion`= ?,
                                                    `digitado`= ?,`motivodigitado`= ? WHERE idGrupo = $idPakDig");                                  
                                                    $stmt->bind_param('sssss',$iduser,$fechaDigitacion,$fechaDevolucion,$digit,$motivoDif);
                                                    $stmt->execute();
                                                   // echo "ACTUALIZADO";
                                            
                                            
                                            
                            }

                         

                    }
                    
                    function createEditPacienteCE($procedimientos){

                                $db = new Conectar();
                                $conn = $db->conexion();

                            if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                            }else{

                                            $iduserCE = $procedimientos['iduserCE'];
                                            $ideCE = $procedimientos['ideCE'];
                                            $tipoReg = $procedimientos['tipoReg'];
                                            $fuaCE = trim($procedimientos['fuaCE']);
                                            $hisCliCE = $procedimientos['hisCliCE'];
                                            $tipoDocCE = $procedimientos['tipoDocCE'];
                                            $NroDocCE = $procedimientos['NroDocCE'];
                                            $seguros =  $procedimientos['seguros'];
                                            $listaSeguros = $procedimientos['listaSeguros'];
                                            $ubicacionCE =  $procedimientos['ubicacionCE'];
                                            $sexoCE = $procedimientos['sexoCE'];
                                            $cuenta = $procedimientos['cuenta'];
                                            $NroAf = $procedimientos['NroAf'];
                                            $eess = $procedimientos['eess'];
                                            $nombresCE = $procedimientos['nombresCE'];
                                            $FechaNacCE = $procedimientos['FechaNacCE'];
                                            $apepaCE = $procedimientos['apepaCE'];
                                            $apemaCE = $procedimientos['apemaCE'];
                                            $telefa = $procedimientos['telefa'];
                                            $edadCE = $procedimientos['edadCE'];
                                            $espost = $procedimientos['espost'];
                                            $fefa = $procedimientos['fefa'];
                                            $referido = $procedimientos['referido'];
                                            $pabellones = $procedimientos['pabellones'];
                                            $feingreCE = $procedimientos['feingreCE'];
                                            $feAlta = $procedimientos['feAlta'];
                                            $monGalCE = $procedimientos['monGalCE'];
                                            $montSifCE =  $procedimientos['montSifCE'];
                                            $obsResCE =  $procedimientos['obsResCE'];
                                            $grupo =  $procedimientos['grupo'];
                                            $valAte =  $procedimientos['valAte'];
                                            $coPre = $procedimientos['coPre'];
                                            $cie10_1x = $procedimientos['cie10_1x'];
                                            $tip1 = $procedimientos['tip1'];
                                            $cie10_2x = $procedimientos['cie10_2x'];
                                            $tip2 = $procedimientos['tip2'];
                                            $cie10_3x = $procedimientos['cie10_3x'];
                                            $tip3 = $procedimientos['tip3'];
                                            $cie10_4x = $procedimientos['cie10_4x'];
                                            $tip4 = $procedimientos['tip4'];
                                            $cie10_5x = $procedimientos['cie10_5x'];
                                            $tip5 = $procedimientos['tip5'];
                                            
                                            
                                            

                                            if($ideCE!=""){
                                        
                                                                $stmt = $conn->prepare( "UPDATE `tbl_consultaExterna` SET `idUserRegistro`=?,`nroFua`=?,`historiaClinica`=?,`tipoDoc`=?,
                                                                `nroDoc`=?,`seguro`=?,`aseguradora`=?,`ubicacion`=?,`sexo`=?,`cuenta`=?,`nroAfiliacion`=?,`eess`=?,`nombres`=?,`fechaNac`=?,
                                                                `ApePaterno`=?,`ApeMaterno`=?,`teleFam`=?,`edad`=?,`destino`=?,`fechaDestino`=?,`refeContraref`=?,`servicioPabellon`=?,
                                                                `fechaIngreso`=?,`fechaAlta`=?,`montoGalenos`=?,`montoSisfar`=?,`Observaciones`=?,`tipoRegistro`=?,`grupo`=?,`montoValAtencion`=?
                                                                ,`codPre`=?,`dx1`=?,`tpdx1`=?,`dx2`=?,`tpdx2`=?,`dx3`=?,`tpdx3`=?,`dx4`=?,`tpdx4`=?,`dx5`=?,`tpdx5`=? WHERE `idEm`= $ideCE");                                  
                                                                $stmt->bind_param('issssiiissssssssssississsssiisissssssssss', $iduserCE, $fuaCE, $hisCliCE,$tipoDocCE,$NroDocCE,$seguros,$listaSeguros,$ubicacionCE,$sexoCE,$cuenta,$NroAf,$eess,
                                                                $nombresCE,$FechaNacCE,$apepaCE,$apemaCE,$telefa,$edadCE,$espost,$fefa,$referido,$pabellones,$feingreCE,$feAlta,$monGalCE,$montSifCE,
                                                                $obsResCE,$tipoReg,$grupo,$valAte,$coPre,$cie10_1x,$tip1,$cie10_2x,$tip2,$cie10_3x,$tip3,$cie10_4x,$tip4,$cie10_5x,$tip5);
                                                                $stmt->execute();
                                                               // echo "ACTUALIZADO";
                                            
                                            }else {
                                                
                                                                $consulta3 = "SELECT `idEm` FROM `tbl_consultaExterna` WHERE `nroFua`='$fuaCE'";
                                                                $verIf3 = mysqli_query($conn,$consulta3);
                                                                $cnt3 = mysqli_num_rows($verIf3);
                                                                
                                                            
                                                            if($cnt3 > 0){
                                                                echo "1";
                                                            }else{

                                                                 $stmt = $conn->prepare( "INSERT INTO `tbl_consultaExterna`(`idUserRegistro`, `nroFua`, `historiaClinica`, `tipoDoc`, `nroDoc`, `seguro`, `aseguradora`, `ubicacion`,
                                                                `sexo`, `cuenta`, `nroAfiliacion`, `eess`, `nombres`, `fechaNac`, `ApePaterno`, `ApeMaterno`, `teleFam`, `edad`, `destino`, `fechaDestino`, `refeContraref`, 
                                                                `servicioPabellon`, `fechaIngreso`, `fechaAlta`, `montoGalenos`, `montoSisfar`, `Observaciones`, `tipoRegistro`, `grupo`,`montoValAtencion`,`codPre`,`dx1`
                                                                ,`tpdx1`,`dx2`,`tpdx2`,`dx3`,`tpdx3`,`dx4`,`tpdx4`,`dx5`,`tpdx5`) VALUES (?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                                                                $stmt->bind_param('issssiiissssssssssississsssiisissssssssss', $iduserCE, $fuaCE, $hisCliCE,$tipoDocCE,$NroDocCE,$seguros,$listaSeguros,$ubicacionCE,$sexoCE,$cuenta,$NroAf,$eess,
                                                                $nombresCE,$FechaNacCE,$apepaCE,$apemaCE,$telefa,$edadCE,$espost,$fefa,$referido,$pabellones,$feingreCE,$feAlta,$monGalCE,$montSifCE,$obsResCE,$tipoReg,$grupo,$valAte,
                                                                $coPre,$cie10_1x,$tip1,$cie10_2x,$tip2,$cie10_3x,$tip3,$cie10_4x,$tip4,$cie10_5x,$tip5);
                                                                $stmt->execute();
                                                                echo "INSERTADO";

                                                            }
                                                

                                            }
                            }

                         

                    }
                    
					function eliminarPr($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `a_procedimientos` WHERE `IdProcedimiento`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                    }
                    
                    
                    function updateEstPaque($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $cod  = $deletePr['cod'];
                                                $cja  = "";
                                                $user  = "";
                                                $horaAsi  = "";
                                                $iduserdigitacioncheck  = "";
                                                $fechadigitacioncheck  = "";
                                                
                                                
                                                $stmt = $conn->prepare( "UPDATE `tbl_grupoArchivo` SET `idCaja`=?,`idUsuarioAsigCaja`=?,`fechaHoraAsignadoCaja`=?,`iduserdigitacioncheck`=?,`fechadigitacioncheck`=? WHERE `idGrupo`= '$cod'");
                                                $stmt->bind_param('issss', $cja,$user,$horaAsi,$iduserdigitacioncheck,$fechadigitacioncheck);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                    }
                    
                    function InsertEx($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iddEx    =	$examen['iddEx'];
                							$fechaex  = $examen['fechaex'];
                							$nrotrans =	$examen['nrotrans'];
                							$eessRefModal =	$examen['eessRefModal'];
                							
            						
            								$sql = "INSERT INTO `tbl_nroTransferencias`(`idPax`, `fecha`, `nrotransf`,eess) VALUES ('$iddEx','$fechaex','$nrotrans','$eessRefModal')";
            								$result = $conn->query($sql);	
            
            					}
            
            							return $result;

			        	}
			        	
			        	
			        	function registroMotivo($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iduserMo    =	$examen['iduserMo'];
                							$motivoHabiBoton  = $examen['motivoHabiBoton'];
                						    $idMo = $examen['idMo'];
                							
            						
            								$sql = "INSERT INTO `tbl_auditaHabiReg`(`usuario`,idEm, `motivo`) VALUES  ('$iduserMo','$idMo','$motivoHabiBoton')";
            								$result = $conn->query($sql);	
            
            					}
            
            							return $result;

			        	}
			        	
			        	 function InsertObserPax($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
                                            
                							$iduserObsaPax    =	$examen['iduserObsaPax'];
                							$idPaObs  = $examen['idPaObs'];
                							$obsPaix =	$examen['obsPaix'];
                							$ids =	$examen['ids'];
                							$codeXcuenta =	$examen['codeXcuenta'];
                						
                							
                							if($ids!=""){
                							    $sql = "UPDATE `tbl_observacionesPaciente`  SET detalles= '$obsPaix' WHERE idObs='$ids'";
                							    $result = $conn->query($sql);	
                							}else{
                							    $sql = "INSERT INTO `tbl_observacionesPaciente`( `iduser`, `cuenta`, `detalles`) VALUES('$iduserObsaPax','$idPaObs','$obsPaix')";
            								    $result = $conn->query($sql);	
                							}
            						
            								
            
            					}
            
            							return $result;

			        	}
			        	
			        	
			        	
			        	
			        	
			        	
			        	function InsertUsuario($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
                                            
                                            $idUSX    =	$examen['idUSX'];
                							$ide  = $examen['ide'];
                                            
                                           
                                            $profeSys = $examen['profeSys'];
                                            $areaUnid = $examen['areaUnid'];
                                            $celUsu = $examen['celUsu'];
                                            $idEstabel = $examen['idEstabel'];
                							$teleusu =	$examen['teleusu'];
                							$nomusu =	$examen['nomusu'];
                							
                							$coleUsu =	$examen['coleUsu'];
                							$cagoocu =	$examen['cagoocu'];
                						
                							$emailusu =	$examen['emailusu'];
                						    $estadousu = "DESACTIVADO";
                						    $userusu =	$examen['userusu'];
                						    $password =	md5($examen['password']);
                						    $active =	$examen['active'];
                						    $rol =	"";
                						    
                						    if($idEstabel=="478"){
                						        $rol =	"20";
                						    }else{
                						        $rol =	"8";
                						    }
                							
                							/*if($idUSX!=""){
                							    $sql = "UPDATE `usuarios`  SET user= '$userusu',pass= '$password',estado= '$estadousu',nom= '$nomusu',email= '$emailusu',doc= '$teleusu' WHERE id='$idUSX'";
                							    $result = $conn->query($sql);	
                							}else{
                							    $sql = "INSERT INTO `usuarios`(`user`, `pass`, `estado`, `nom`, `rol`, `email`,doc) VALUES ('$userusu','$password','$estadousu','$nomusu','$rol','$emailusu',$teleusu)";
            								    $result = $conn->query($sql);
            								    echo $sql;
                							}*/
                							
                							
                							$consulta3 = "SELECT `id` FROM `usuarios` WHERE `doc` ='$teleusu'";
                                            $verIf3 = mysqli_query($conn,$consulta3);
                                            $cnt3 = mysqli_num_rows($verIf3);
                                            
                                            if($cnt3 > 0){
                                                echo "1";
                                            }else{
                                                $sql = "INSERT INTO `usuarios`(`user`, `pass`, `estado`, `nom`, `rol`, `email`,doc,profesion,ofAreUnidad,codEstab,active,cmp,cargo) 
                    							VALUES ('$userusu','$password','$estadousu','$nomusu','$rol','$emailusu','$teleusu',$profeSys,$areaUnid,$idEstabel,$active,'$coleUsu',$cagoocu)";
                								$result = $conn->query($sql);
                                            }
                							
                							echo $sql;
                							
            							
            						
            
            					}
            
            							return $result;

			        	}
			        	
			        	
			        	
			        	function actualizarMasivoIduserAuditorXgrupo($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$idPak    =	$examen['idPak'];
                							$listAuditx  = $examen['listAuditx'];
                						
                							$sql = "UPDATE `paciente` SET `iduser`='$listAuditx' WHERE `idEmg` IN (SELECT `idPac` FROM `listadoAtencionesCE` WHERE `idPaq` = '$idPak')";
                							
                							echo $sql;
                							$result = $conn->query($sql);	
                						
            
            					}
            
            							return $result;

			        	}
			        	
			        	
			        	function updateContrasena($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$idContra    =	$examen['idContra'];
                							$passWordC  = md5($examen['passWordC']);
                						
                							$sql = "UPDATE `usuarios` SET `pass`='$passWordC' WHERE id='$idContra'";
                							
                							echo $sql;
                							$result = $conn->query($sql);	
                						
            
            					}
            
            							return $result;

			        	}
			        	

    			        	function InsertActiAudi($examen){
    
                					$db = new Conectar();
                					$conn = $db->conexion();
                							
                
                					if ($conn->connect_errno) {
                						printf("Conexión fallida: %s\n", $conn->connect_error);
                						exit();
                
                					}else{
                

                    						    $ide = $examen['ide'];
                                                $idActividad = $examen['idActividad'];
                                                $idUser = $examen['idUser'];
                                                $actividadAudit = $examen['actividadAudit']; 
                                                $proceAuditoria = $examen['proceAuditoria'];
                                                $dxAudito = $examen['dxAudito'];
                                                $observAuditForm = $examen['observAuditForm'];
                                                
                    							
                    							if($idActividad!=""){
                    							    $sql = "UPDATE `tbl_listActividades`  SET idActvidad= '$actividadAudit',idProc= '$proceAuditoria',diagnostico= '$dxAudito',observacion= '$observAuditForm'
                    							    WHERE idLiAc='$idActividad'";
                    							    echo $sql;
                    							    $result = $conn->query($sql);	
                    							}else{
                    							    $sql = "INSERT INTO `tbl_listActividades`( `idUser`, `idActvidad`, `idProc`, `diagnostico`, `observacion`,idRegistro) VALUES
                    							    ('$idUser','$actividadAudit','$proceAuditoria','$dxAudito','$observAuditForm','$ide')";
                    							    echo $sql;
                								    $result = $conn->query($sql);	
                    							}
                						
                								
                
                					}
                
                							return $result;
    
    			        	}
    			        	
			        	
			        	 function InsertObserPaxRotulo($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iduser   = $examen['iduser'];
                							$ideRo    = $examen['ideRo'];
                                            $rotulo   = $examen['rotulo']; 
                                            $tacos    = $examen['tacos'];
                                            $descrRot = $examen['descrRot'];
                                            $categoria = $examen['categoria'];
                                            $cortesRot = $examen['cortesRot'];
                                            $idcateg = $examen['idcateg'];
                                            $plantillaApe = $examen['plantillaApe'];
                                            $tipoDecrp = $examen['tipoDecrp'];
                                            $formatoPatologiaMac = $examen['formatoPatologiaMac'];
                                            $filtroTipoEst = $examen['filtroTipoEst'];
                                            $idRegRot = $examen['idRegRot'];
                                            $lblUserDecri = $examen['lblUserDecri'];
                                            
                                            
                                            $coulta1 = "SELECT `descripcion` FROM `tbl_tejidoOrganoExtraido` WHERE idTe='$rotulo' ";
                                            $ver1 = mysqli_query($conn,$coulta1);
                                            $fila = mysqli_fetch_assoc($ver1);
                                            $agRot = $fila['descripcion'];

                                            
                                            if($ideRo!=""){
                                                
                                                        if($tipoDecrp==1){
                                                                $sql = "UPDATE `tbl_observacionesRotulo`  SET rotulo= '$agRot',tacos= '$tacos',descripcion= '$descrRot',categoria= '$categoria',cortesRot= '$cortesRot',idMuestra= '$rotulo',
                                							    idcateg='$idcateg',plantillaApe='$plantillaApe',formatoPatoMac= '$formatoPatologiaMac',tipoEstudio= '$filtroTipoEst',idDescripMacro='$lblUserDecri' WHERE idRo='$ideRo'";
                                							    $result = $conn->query($sql);	
                                                        }else if($tipoDecrp==2){
                                                                $sql = "UPDATE `tbl_observacionesRotulo`  SET rotulo= '$agRot',tacos= '$tacos',descMicro= '$descrRot',categoria= '$categoria',cortesRot= '$cortesRot',idMuestra= '$rotulo',
                                							    idcateg='$idcateg',plantillaMicro='$plantillaApe',formatoPatoMac= '$formatoPatologiaMac',tipoEstudio= '$filtroTipoEst',idDescripMacro='$lblUserDecri'  WHERE idRo='$ideRo'";
                                							    $result = $conn->query($sql);	
                                                        }
                                                
                							   
                							    
                							}else{
                							
                    							$sql = "INSERT INTO `tbl_observacionesRotulo`(`iduser`, `rotulo`, `tacos`, `descripcion`,categoria,cortesRot,idMuestra,idcateg,plantillaApe,formatoPatoMac,
                    							tipoEstudio,idRegRot,idDescripMacro) VALUES('$iduser','$agRot','$tacos','$descrRot','$categoria',
                    							'$cortesRot','$rotulo','$idcateg','$plantillaApe','$formatoPatologiaMac','$filtroTipoEst','$idRegRot','$lblUserDecri')";
                    							
                							    $result = $conn->query($sql);
            							    
                							}
                						
            
            					}
            
            							return $result;

			        	    }
			        	    
			        	    
			        	    function rsptaMicroscopia($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iduser   = $examen['iduser'];
                							$ideRoT    = $examen['ideRoT'];
                                            $rsptaMic   = $examen['rsptaMic']; 
                
            							    $sql = "UPDATE `tbl_observacionesRotulo` SET `rsptaMicro` = '$rsptaMic',`idUserRsptaMicro`= '$iduser' WHERE `idRo`= '$ideRoT'";
            							    $result = $conn->query($sql);	
                							
                						
            
            					}
            
            							return $result;

			        	    }
			        	    
			        	    function ObsMicroscopiaFrm($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iduser   = $examen['iduser'];
                							$ideMicroObs    = $examen['ideMicroObs'];
                                            $obsMicrotextArea   = $examen['obsMicrotextArea']; 
                
            							    $sql = "UPDATE `tbl_observacionesRotulo` SET `obsMicro` = '$obsMicrotextArea' WHERE `idRo`= '$ideMicroObs'";
            							    $result = $conn->query($sql);	
                							
                						
            
            					}
            
            							return $result;

			        	    }
			        	    
			        	    function obsMacroscopia($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iduser   = $examen['iduser'];
                							$ideRoTMacro    = $examen['ideRoTMacro'];
                                            $rsptaMacro   = $examen['rsptaMacro']; 
                
            							    $sql = "UPDATE `tbl_observacionesRotulo` SET `obsMacro` = '$rsptaMacro',`idUserRsptaMicro`= '$iduser' WHERE `idRo`= '$ideRoTMacro'";
            							    $result = $conn->query($sql);	
                							
                						
            
            					}
            
            							return $result;

			        	    }
			        	    
			        	    function rsptaMicroscopiaLab($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iduser   = $examen['iduser'];
                							$ideRoTLab    = $examen['ideRoTLab'];
                                            $rsptaMicLab   = $examen['rsptaMicLab']; 
                                            $tipoLab   = $examen['tipoLab'];
                                            $sql="";
                                            if($tipoLab==1){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `rsptaLab` = '$rsptaMicLab' WHERE `id`= '$ideRoTLab'";
                                            }else if($tipoLab==2){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `rsptaLab2` = '$rsptaMicLab' WHERE `id`= '$ideRoTLab'";
                                            }else if($tipoLab==3){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `rsptaLab3` = '$rsptaMicLab' WHERE `id`= '$ideRoTLab'";
                                            }else if($tipoLab==4){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `rsptaLab4` = '$rsptaMicLab' WHERE `id`= '$ideRoTLab'";
                                            }else if($tipoLab==5){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `rsptaLab5` = '$rsptaMicLab' WHERE `id`= '$ideRoTLab'";
                                            }
                
            							    
            							    $result = $conn->query($sql);	
                							
                						
            
            					}
            
            							return $result;

			        	    }
			        	    
			        	    
			        	    function obsMicroLabMix($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iduser   = $examen['iduser'];
                							$ideRoTLabMicro    = $examen['ideRoTLabMicro'];
                                            $rsptObsLabMij   = $examen['rsptObsLabMij']; 
                                            $tipoLabMicor   = $examen['tipoLabMicor'];
                                            
                                            $sql="";
                                            if($tipoLabMicor==1){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `obsMircro1` = '$rsptObsLabMij' WHERE `id`= '$ideRoTLabMicro'";
                                            }else if($tipoLabMicor==2){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `obsMircro2` = '$rsptObsLabMij' WHERE `id`= '$ideRoTLabMicro'";
                                            }else if($tipoLabMicor==3){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `obsMircro3` = '$rsptObsLabMij' WHERE `id`= '$ideRoTLabMicro'";
                                            }else if($tipoLabMicor==4){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `obsMircro4` = '$rsptObsLabMij' WHERE `id`= '$ideRoTLabMicro'";
                                            }else if($tipoLabMicor==5){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `obsMircro5` = '$rsptObsLabMij' WHERE `id`= '$ideRoTLabMicro'";
                                            }
                
            							    
            							    $result = $conn->query($sql);	
                							
                						
            
            					}
            
            							return $result;

			        	    }
			        	    
			        	    
			        	     function rsptaObscopiaLab($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iduser   = $examen['iduser'];
                							$ideRoTLab    = $examen['ideRoTLab'];
                                            $rsptaMicLab   = $examen['rsptaMicLab'];
                                            $tipoMac   = $examen['tipoMac']; 
                
                                            if($tipoMac==1){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `obsLab1` = '$rsptaMicLab' WHERE `id`= '$ideRoTLab'";
                                            }else if($tipoMac==2){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `obsLab2` = '$rsptaMicLab' WHERE `id`= '$ideRoTLab'";
                                            }else if($tipoMac==3){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `obsLab3` = '$rsptaMicLab' WHERE `id`= '$ideRoTLab'";
                                            }else if($tipoMac==4){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `obsLab4` = '$rsptaMicLab' WHERE `id`= '$ideRoTLab'";
                                            }else if($tipoMac==5){
                                                $sql = "UPDATE `tbl_detalleRotulo` SET `obsLab5` = '$rsptaMicLab' WHERE `id`= '$ideRoTLab'";
                                            }
                                                
            							   
            							    $result = $conn->query($sql);	
                							
                						
            
            					}
            
            							return $result;

			        	    }
			        	    
			        	    
			        	    function InsertDetallePaxRotulo($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iduser   = $examen['iduser'];
                							$ideRo    = $examen['ideRo'];
                                            $rotulo   = $examen['rotulo']; 
                                            $tacos    = $examen['tacos'];
                                            $descrRot = $examen['descrRot'];
                                            $cortesRot = $examen['cortesRot'];
                                            $formatoPatologiaMac = $examen['formatoPatologiaMac'];
                                            $filtroTipoEst = $examen['filtroTipoEst'];
                                            $idRegRot = $examen['idRegRot'];
                                            
                                            $coulta11= "SELECT `descripcion` FROM `tbl_tejidoOrganoExtraido` WHERE idTe='$rotulo' ";
                                            $ver11 = mysqli_query($conn,$coulta11);
                                            $fila1 = mysqli_fetch_assoc($ver11);
                                            $agRot = $fila1['descripcion'];
                                            
                                            
                                                $coulta1 = "SELECT MAX(`correlativo`) AS COL FROM `tbl_detalleRotulo` WHERE formatoPatoMac = '$formatoPatologiaMac' AND tipoEstudio='$filtroTipoEst'";
                                                $ver1 = mysqli_query($conn,$coulta1);
                                                $fila = mysqli_fetch_row($ver1);
                                                $cor = $fila[0] + 1 ;
                                                $tacorel= $fila[0] + $tacos;
                                                //echo  $cor;
                                                
                                                for ($i = $cor; $i <= $tacorel; $i++) {
                                                    
                                                    	$sql = "INSERT INTO `tbl_detalleRotulo`( `rotulo`, `correlativo`,iduser,formatoPatoMac,tipoEstudio,idRegRot) 
                                                    	VALUES('$agRot','$i','$iduser','$formatoPatologiaMac','$filtroTipoEst','$idRegRot')";
                            							//echo  $cor;
                        							    $result = $conn->query($sql);
                                                }
                							
                    							
            							    
                							
                						
            
            					}
            
            							return $result;

			        	    }
			        	
			        	
			        	
			        	function InsertRegistroProgCirugias($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                            				$iduser                 = 	$examen['iduser'];
                                            $ide                    =   $examen['ide'];
                                            $especialCirugia        =   $examen['especialCirugia'];
                                            $tipoDocCiru            =   $examen['tipoDocCiru'];
                                            $nroDocCiru             =   $examen['nroDocCiru'];
                                            $pacienCIruProg         =   $examen['pacienCIruProg'];
                                            $edadCiruProg           =   $examen['edadCiruProg'];
                                            $historiaCiru           =   $examen['historiaCiru'];
                                            $celularCiru            =   $examen['celularCiru'];
                                            $dxcie10                =   $examen['dxcie10'];
                                            $tip3                   =   $examen['tip3'];
                                            $dxpreop                =   $examen['dxpreop'];
                                            $tipoEstPat             =   $examen['tipoEstPat'];
                                            $procedQx               =   $examen['procedQx'];
                                            $tipoAnestesiaProg      =   $examen['tipoAnestesiaProg'];
                                            $tipoCirugiaProg        =   $examen['tipoCirugiaProg'];
                                            $pabellonCirugia        =   $examen['pabellonCirugia'];
                                            $listSalaCi             =   $examen['listSalaCi'];
                                            $fechaInterve           =   $examen['fechaInterve'];
                                            $horaInterve            =   $examen['horaInterve'];
                                            $cirugiaIndicaPor       =   $examen['cirugiaIndicaPor'];
                                            $cirujanoPri            =   $examen['cirujanoPri'];
                                            $anestesiologo          =   $examen['anestesiologo'];
                                            $servicioInterCiru      =   $examen['servicioInterCiru'];
                                            $nroCamaProg            =   $examen['nroCamaProg'];
                                            $estadoCirugiaProg      =   $examen['estadoCirugiaProg'];
                                            $financiaCirugia        =   $examen['financiaCirugia'];
                                           
                                            
                                            
                                            
                                            if($ide!=""){
                							    $sql = "UPDATE `tbl_programacionCirugias` SET `especialidad`='$especialCirugia',`tipoDOc`='$tipoDocCiru',`nroDoc`='$nroDocCiru',
                							    `paciente`='$pacienCIruProg',`edad`='$edadCiruProg',`historia`='$historiaCiru',`celular`='$celularCiru',`dx`='$dxcie10',`tipoDx`='$tip3',
                							    `dxPrepa`='$dxpreop',`tipoDxPrepa`='$tipoEstPat',`procedQx`='$procedQx',`tipoAnestesia`='$tipoAnestesiaProg',`tipoCirugia`='$tipoCirugiaProg',
                							    `servicioDx`='$pabellonCirugia',`salaCirugia`='$listSalaCi',`fechaIntervencion`='$fechaInterve',`hora`='$horaInterve',`cirugiaIndicadaPor`='$cirugiaIndicaPor',
                							    `cirujanoPrincipal`='$cirujanoPri',`anestesiologo`='$anestesiologo',`servicioInterno`='$servicioInterCiru',`nroCama`='$nroCamaProg',
                							    `estadoCirugia`='$estadoCirugiaProg',`financiamiento`='$financiaCirugia' WHERE `idPro` ='$ide'";
                							    $result = $conn->query($sql);
                							    
                							    
                							}else{
                							
                    							$sql = "INSERT INTO `tbl_programacionCirugias`(`idUser`, `especialidad`, `tipoDOc`, `nroDoc`, `paciente`, `edad`, `historia`, 
                    							`celular`, `dx`, `tipoDx`, `dxPrepa`, `tipoDxPrepa`, `procedQx`, `tipoAnestesia`, `tipoCirugia`, `servicioDx`, `salaCirugia`,
                    							`fechaIntervencion`, `hora`, `cirugiaIndicadaPor`, `cirujanoPrincipal`, `anestesiologo`, `servicioInterno`, `nroCama`,
                    							`estadoCirugia`,financiamiento) VALUES('$iduser','$especialCirugia' ,'$tipoDocCiru','$nroDocCiru','$pacienCIruProg' ,'$edadCiruProg','$historiaCiru','$celularCiru','$dxcie10','$tip3',
                    							'$dxpreop','$tipoEstPat','$procedQx','$tipoAnestesiaProg','$tipoCirugiaProg','$pabellonCirugia','$listSalaCi','$fechaInterve','$horaInterve',
                    							'$cirugiaIndicaPor','$cirujanoPri','$anestesiologo','$servicioInterCiru','$nroCamaProg','$estadoCirugiaProg','$financiaCirugia')";
                							    $result = $conn->query($sql);
                							    
                							    
            							    
                							}
                						
            
            					}
            
            							return $result;

			        	    }
			        	    
			        	    
			      
			        	
			        	function regMAsiCajax($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            					    
            					            $tipo    =	$examen['tipo'];
            					            $est    =	$examen['est'];
            					            $us    =	$examen['us'];
            					            
            					            //echo "tipo-->".$tipo;
                                            if($tipo=="1"){
                                                $sql = "INSERT INTO `tbl_Cajas`( `estado`,idUsuario) VALUES ('$est','$us')";
                                            }else if($tipo=="2"){
                                                $sql = "INSERT INTO `tbl_CajasCE`( `estado`,idUsuario) VALUES ('$est','$us')";
                                            }
                                        
            								$result = $conn->query($sql);	
            								
            
            					}
            
            							return $result;

			        	}
			        	
			        	
			
			        	
			        	
			        	function RegistrarReferenciasEvalRef($procedimientos){
			        	    

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            					    
                					             $iduser = $procedimientos['iduser'];
                					             $ideHistoEvalRef = $procedimientos['ideHistoEvalRef'];
                					             
                					             
                                                 $especEval1 =  $procedimientos['especEval1'];
                                                 $especEval2 =  $procedimientos['especEval2'];
                                                 $especEvalDatoRef =  $procedimientos['especEvalDatoRef'];
                                                 $estadoRefDatRef =  $procedimientos['estadoRefDatRef'];
                                                 $derivarJefeServ = $procedimientos['derivarJefeServ'];
                                                 $motivoRecEval1 =  $procedimientos['motivoRecEval1'];
                                                 $especEval3 =  $procedimientos['especEval3'];
                                                 $obsJefeServ =  $procedimientos['obsJefeServ'];
                                                $estadoRefJefeServ =   $procedimientos['estadoRefJefeServ'];
                                                 $motivoRecEval2 =  $procedimientos['motivoRecEval2'];
                                                 $obsJefeGuardia =  $procedimientos['obsJefeGuardia'];
                                                  $estadoRefJefeGuardia = $procedimientos['estadoRefJefeGuardia'];
                                                  $motivoRecEval3 = $procedimientos['motivoRecEval3'];
                                                  $atencionPacEval = $procedimientos['atencionPacEval'];
                                                  $estFinalRef = $procedimientos['estFinalRef'];
                                                  $motivoRecEval4 = $procedimientos['motivoRecEval4'];
                                                 $obsEstFinalRef =  $procedimientos['obsEstFinalRef'];
                                                  $paxllegoEstab = $procedimientos['paxllegoEstab'];
                                                 $fechaLlegada = $procedimientos['fechaLlegada'];
                                                 $cuentaFeLlegada = $procedimientos['cuentaFeLlegada'];
                                                  $personalMedicoList = $procedimientos['personalMedicoList'];
                                                 
                                              
                                        
            					            
                                              $sql = "UPDATE `tbl_registroReferencias` SET `especEval1`='$especEval1',`especEval2`='$especEval2',`especEvalDatoRef`='$especEvalDatoRef',`estadoRefDatRef`='$estadoRefDatRef',
                                              `derivarJefeServ`='$derivarJefeServ',`motivoRecEval1`='$motivoRecEval1',`especEval3`='$especEval3',`obsJefeServ`='$obsJefeServ',`estadoRefJefeServ`='$estadoRefJefeServ',
                                              `motivoRecEval2`='$motivoRecEval2',`obsJefeGuardia`='$obsJefeGuardia',`estadoRefJefeGuardia`='$estadoRefJefeGuardia',`motivoRecEval3`='$motivoRecEval3',`atencionPacEval`='$atencionPacEval',
                                              `estFinalRef`='$estFinalRef',`motivoRecEval4`='$motivoRecEval4',`obsEstFinalRef`='$obsEstFinalRef',`paxllegoEstab`='$paxllegoEstab',`fechaLlegada`='$fechaLlegada',
                                              `cuentaFeLlegada`='$cuentaFeLlegada',`personalMedico`='$personalMedicoList' WHERE `idRef`= '$ideHistoEvalRef'";
                                              
                                              
            								  $result = $conn->query($sql);	
            								
            								
            
            					}
            
            							return $result;

			        	}
			        	
			        	
		
			        	
			        	
			        	
                        function InsertExRef($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iddExRef    =	$examen['iddExRef'];
                							$fechaexRef  = $examen['fechaexRef'];
                							$nrotransFeR =	$examen['nrotransFeR'];
                							$eesRef =	$examen['eesRef'];
                							
            						
            								$sql = "INSERT INTO `tbl_referencia`(`idPax`, `fecha`, `nrotransf`,eess) VALUES ('$iddExRef','$fechaexRef','$nrotransFeR','$eesRef')";
            								$result = $conn->query($sql);	
            
            					}
            
            							return $result;

			        	}			        	
			        	
			        	
			        	 function insertSessiones($examen){

            					$db = new Conectar();
            					$conn = $db->conexion();
            							
            
            					if ($conn->connect_errno) {
            						printf("Conexión fallida: %s\n", $conn->connect_error);
            						exit();
            
            					}else{
            
                							$iduserSe    =	$examen['iduserSe'];
                							$idSes  = $examen['idSes'];
                							$fechaSesion =	$examen['fechaSesion'];
                							$nspModal =	$examen['nspModal'];
                							$devModal =	$examen['devModal'];
                						    $obsSesion =	$examen['obsSesion'];
                						    $repoQuimi =	$examen['repoQuimi'];
            						
            								$sql = "INSERT INTO `tbl_sesiones`(`cuenta`, `user`, `sesion`, `nsp`, `devolucion`, `observacion`,reprogramar) VALUES  ('$idSes','$iduserSe','$fechaSesion'
            								,'$nspModal','$devModal','$obsSesion','$repoQuimi')";
            								$result = $conn->query($sql);	
            
            					}
            
            							return $result;

			        	}


                        function consultaExamenPersona($id){
                    
                    					$db = new Conectar();
                    					$conn = $db->conexion();
                    				
                    
                    						if ($conn->connect_errno) {
                    							printf("Conexión fallida: %s\n", $conn->connect_error);
                    							exit();
                    
                    						}else{
                    
                    
                    							$sql = "SELECT  idTran,`fecha`, `nrotransf`,eess FROM `tbl_nroTransferencias` WHERE idPax='$id' ORDER BY idTran DESC";
                    							$result = $conn->query($sql);
                    											
                    							}
                    
                    					return $result;
                    
                        }
                        
                        
                        function consultaObservacionesPciente($id){
                    
                    					$db = new Conectar();
                    					$conn = $db->conexion();
                    				
                    
                    						if ($conn->connect_errno) {
                    							printf("Conexión fallida: %s\n", $conn->connect_error);
                    							exit();
                    
                    						}else{
                    
                    
                    							$sql = "SELECT P.`idObs`,(SELECT UPPER(user) FROM usuarios WHERE id=P.iduser) as USOX, P.`cuenta`, P.`detalles`, P.`fechaRegistro`, 
                    							P.`fechaUpdate`,P.iduser FROM `tbl_observacionesPaciente`  AS P
                    							WHERE P.`cuenta`='$id' ORDER BY P.idObs DESC";
                    							$result = $conn->query($sql);
                    											
                    							}
                    
                    					return $result;
                    
                        }
                        
                        function consultaObservacionesCajas($id){
                    
                    					$db = new Conectar();
                    					$conn = $db->conexion();
                    				
                    
                    						if ($conn->connect_errno) {
                    							printf("Conexión fallida: %s\n", $conn->connect_error);
                    							exit();
                    
                    						}else{
                    
                    
                    							$sql = "SELECT P.`idObs`,(SELECT UPPER(user) FROM usuarios WHERE id=P.iduser) as USOX, P.`cuenta`, P.`detalles`, P.`fechaRegistro`, 
                    							P.`fechaUpdate`,P.iduser FROM `tbl_observacionesCajas`  AS P
                    							WHERE P.`cuenta`='$id' ORDER BY P.idObs DESC";
                    							$result = $conn->query($sql);
                    											
                    							}
                    
                    					return $result;
                    
                        }
                        
                        
                        function consultaActividadesAudit($id){
                    
                    					$db = new Conectar();
                    					$conn = $db->conexion();
                    				
                    
                    						if ($conn->connect_errno) {
                    							printf("Conexión fallida: %s\n", $conn->connect_error);
                    							exit();
                    
                    						}else{
                    
                    
                    							$sql = "SELECT L.idLiAc,(SELECT UPPER(user) FROM usuarios WHERE id=L.idUser) as UXI,(SELECT UPPER(descripcion) FROM tbl_actividad WHERE idAct =  L.`idActvidad` ) AS ACT, 
                                                (SELECT UPPER(`descripcion`) FROM `tbl_actividadProc` WHERE `idProc`=L.`idProc`) AS PRO, diagnostico, observacion, fechaReg, fechaUpdate FROM `tbl_listActividades` AS L 
                                                WHERE L.`idRegistro` ='$id' ORDER BY L.`idLiAc` DESC";
                    							$result = $conn->query($sql);
                    											
                    							}
                    
                    					return $result;
                    
                        }
                        
                        
                        function consultaRotuloPciente($tipo,$id,$tipoest){
                    
                    					$db = new Conectar();
                    					$conn = $db->conexion();
                    				
                    
                    						if ($conn->connect_errno) {
                    							printf("Conexión fallida: %s\n", $conn->connect_error);
                    							exit();
                    
                    						}else{
                    						    
                    						    
                    						    if($tipoest==3){
                    						        $tipoest = 2;    
                    						    }
                    
                    							$sql = "SELECT P.`idRo`, (SELECT UPPER(user) FROM usuarios WHERE id=P.iduser) as USOX, P.`rotulo`, P.`tacos`,P.`descripcion`, P.`fechaReg`,
                    							P.`fechaAct`,P.obsMicro,P.rsptaMicro,P.obsMacro,P.descMicro,P.formatoPatoMac  FROM `tbl_observacionesRotulo` AS P 
                    							WHERE P.formatoPatoMac='$id' and tipoEstudio='$tipoest' ORDER BY P.`idRo` ASC";
                    							$result = $conn->query($sql);
                    											
                    							}
                    
                    					return $result;
                    
                        }
                        
                        
                        function consultaMarcadoresHisto($formato,$tipoest,$id){
                    
                    					$db = new Conectar();
                    					$conn = $db->conexion();
                    				
                    
                    						if ($conn->connect_errno) {
                    							printf("Conexión fallida: %s\n", $conn->connect_error);
                    							exit();
                    
                    						}else{
                    
                    							$sql = "SELECT `idMar`, `iduser`, `marcador`, `resultado`, `fechaReg`, `fechaActualiza` 
                    							, `resulDepend`, `intesTincion`, `nucleosPos`, `subtotalPun`, `interpretHi` FROM `tbl_crudMarcadores` WHERE idPrin= '$id'";
                    							$result = $conn->query($sql);
                    											
                    							}
                    
                    					return $result;
                    
                        }
                        
                        function consultaRotuloUser($id){
                    
                    					$db = new Conectar();
                    					$conn = $db->conexion();
                    				
                    
                    						if ($conn->connect_errno) {
                    							printf("Conexión fallida: %s\n", $conn->connect_error);
                    							exit();
                    
                    						}else{
                    
                    							$sql = "SELECT (SELECT nom FROM usuarios WHERE id=AU.`iduser`) AS UREG ,feModificacion FROM `tbl_auditoriaDetalleRotulos` AS AU WHERE `rotulo`='$id' ORDER BY `idAu` DESC LIMIT 1;";
                    							$result = $conn->query($sql);
                    											
                    							}
                    
                    					return $result;
                    
                        }
                        
                        function consultaDetalleRotulo($id,$tipo,$formato,$tipoest){
                    
                    					$db = new Conectar();
                    					$conn = $db->conexion();
                    					
                    					if($tipo==3){
                    					    $tipo =2 ;
                    					}
                    				
                    
                    						if ($conn->connect_errno) {
                        							printf("Conexión fallida: %s\n", $conn->connect_error);
                        							exit();
                    
                    						}else{
                    
                        							$sql = "SELECT id ,`correlativo`,`inclusion`, `corte`, `coloracion`, `montaje`, `entrega`,feModificacion,(SELECT nom FROM usuarios 
                        							WHERE id=AU.`iduser`) AS UREG,(SELECT nom FROM usuarios WHERE id=AU.`idUserLab`) AS USERLAB,obsMicro,rsptaMicro,rsptaLab,obsLab1,
                        							rsptaLab2,obsLab2,rsptaLab3,obsLab3,rsptaLab4,obsLab4,rsptaLab5,obsLab5,`obsMircro1`, `obsMircro2`, `obsMircro3`, `obsMircro4`, `obsMircro5`
                        							,(SELECT nom FROM usuarios WHERE id= AU.iduserHisto) AS UREHISTO, `iduserHisto`, `fechaUserHisto`, `checkHisto`,formatoPatoMac
                        							, `feModInclusion`, `feModCorte`, `feModColor`, `feModMontaje`, `feModEntrega`, 
                        							(SELECT nom FROM usuarios WHERE id=AU.`idUserInclu`) AS USERLAB1,
                        							(SELECT nom FROM usuarios WHERE id=AU.`idUserLabCorte`) AS USERLAB2,
                        							(SELECT nom FROM usuarios WHERE id=AU.`idUserLabColor`) AS USERLAB3,
                        							(SELECT nom FROM usuarios WHERE id=AU.`idUserLabMon`) AS USERLAB4,
                        							(SELECT nom FROM usuarios WHERE id=AU.`idUserLabEnt`) AS USERLAB5,
                        							`idUserInclu`, `idUserLabCorte`, `idUserLabColor`,
                        							`idUserLabMon`, `idUserLabEnt` ,`inclusion2`, `corte2`, `coloracion2`, `montaje2`, `entrega2`, `feModInclusion2`, `feModCorte2`,
                        							`feModColor2`, `feModMontaje2`, `feModEntrega2`, `idUserInclu2`, `idUserLabCorte2`, `idUserLabColor2`, 
                        							`idUserLabMon2`, `idUserLabEnt2`,
                        								(SELECT nom FROM usuarios WHERE id=AU.`idUserInclu2`) AS USERLAB12,
                        							(SELECT nom FROM usuarios WHERE id=AU.`idUserLabCorte2`) AS USERLAB22,
                        							(SELECT nom FROM usuarios WHERE id=AU.`idUserLabColor2`) AS USERLAB32,
                        							(SELECT nom FROM usuarios WHERE id=AU.`idUserLabMon2`) AS USERLAB42,
                        							(SELECT nom FROM usuarios WHERE id=AU.`idUserLabEnt2`) AS USERLAB52
                        							FROM `tbl_detalleRotulo` AS AU WHERE `rotulo`='$id' AND tipoEstudio='$tipoest' AND formatoPatoMac='$formato' ";
                        							
                        							$result = $conn->query($sql);
                    											
                    							}
                    
                    					return $result;
                    
                        }
                        
                         function consultaExamenPersonaReF($id){
                    
                    					$db = new Conectar();
                    					$conn = $db->conexion();
                    				
                    
                    						if ($conn->connect_errno) {
                    							printf("Conexión fallida: %s\n", $conn->connect_error);
                    							exit();
                    
                    						}else{
                    
                        							$sql = "SELECT  idRef,`fecha`, `nrotransf`,eess FROM `tbl_referencia` WHERE idPax='$id' ORDER BY idRef DESC";
                        							$result = $conn->query($sql);
                    											
                    							}
                    
                    					return $result;
                    
                        }
                        
                        
                        function consultaSesiones($id){
                    
                    					$db = new Conectar();
                    					$conn = $db->conexion();
                    				
                    
                    						if ($conn->connect_errno) {
                    							printf("Conexión fallida: %s\n", $conn->connect_error);
                    							exit();
                    
                    						}else{
                    
                    
                    							$sql = "SELECT E.`idSe`, E.`cuenta`, (SELECT user FROM usuarios  WHERE id=E.`user` ) as usars,E.`user`, E.`sesion`, E.`nsp`, E.`devolucion`, E.`observacion`, E.`feRegistro`,
                    							E.`feUpdate`,E.reprogramar  FROM `tbl_sesiones` AS E WHERE E.`cuenta`='$id'";
                    							$result = $conn->query($sql);
                    											
                    							}
                    
                    					return $result;
                    
                        }

                    function eliminarHnalCpms($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `paciente` WHERE `idPac` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                      function eliminarRegistroPato($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $cod  = $deletePr['cod'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_registroPacientesPatologia` WHERE `idPato` = ?");
                                                $stmt->bind_param('i', $cod);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     function habilitarRegistroPato($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $cod  = $deletePr['cod'];
                                                $stmt = $conn->prepare( "UPDATE `tbl_registroPacientesPatologia` SET `turnOnOff`='1' WHERE `idPato` = ?");
                                                $stmt->bind_param('i', $cod);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                     function revertirHnalRegistro($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                //$stmt = $conn->prepare( "UPDATE `paciente` SET iduser='0' WHERE `idPac` = ?");
                                                $stmt = $conn->prepare( "DELETE FROM `paciente` WHERE `idPac` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                     function eliminarRegEmergHospi($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_Emergencias` WHERE `idEm` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     
                    
                     
                     function eliminarRegRefer($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                //$stmt = $conn->prepare( "DELETE FROM `tbl_registroReferencias` WHERE `idRef` = ?");
                                                $stmt = $conn->prepare( "UPDATE `tbl_registroReferencias` SET anulado ='1' WHERE `idRef` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     function eliminarDxHists($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_dxHistoria` WHERE `idDxHis` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     
                     function eliminarDxPreoPer($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_dxPreOperatorio` WHERE `idDxHis`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     
                     function eliminarDxPostoPer($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_DxPostOperatorio` WHERE `idDxHis`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     
                     function eliminarIntervencionReal($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_intervencionRealizada` WHERE `idDxHis`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     
                      function eliminarCirujanoAsist($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_cirujanosAsistentes` WHERE `idDxHis`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     function eliminarTratHists($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_tratHistoria` WHERE `idDxHis` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     
                     
                     function deleteExamnHist($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_examenesAuxiliares` WHERE `idDxHis` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     
                     function deleteSignosSinto($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_signosSintomas` WHERE `idDxHis` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     function deleteMuesPato($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_muestraPatologia` WHERE `idMu` =  ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     
                     function eliminarRegDePackage($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `listadoAtencionesCE` WHERE `idPac` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                     function deleteIdSesion($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_sesiones` WHERE `idSe` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                     
                      function deleteTranas($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_nroTransferencias` WHERE `idTran`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                      function deleteTranasMarcador($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_crudMarcadores` WHERE `idMar`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     function deleteTranasPaxObs($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_observacionesPaciente` WHERE `idObs`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                     function deleteTranasPaxObsCajas($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_observacionesCajas` WHERE `idObs` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                     
                     
                      function deleteActAudi($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_listActividades` WHERE `idLiAc`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                      function deleteTranasPaxObsRo($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_observacionesRotulo` WHERE `idRo`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                     function EliminarTacosXuno($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_detalleRotulo` WHERE `id` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                     
                     function deleteDetalleRo($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $ro  = $deletePr['ro'];
                                                $formato  = $deletePr['formato'];
                                                $tipoEst  = $deletePr['tipoEst'];
                                                
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_detalleRotulo` WHERE `rotulo`= '$ro' AND formatoPatoMac='$formato'  AND tipoEstudio='$tipoEst' ");
                                                $stmt->bind_param();
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                     function deleteMarcador(){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                               
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_crudMarcadores` ");
                                                $stmt->bind_param();
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                      function eliminarFuaPaq($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $tipo  = $deletePr['tipo'];
                                                
                                                if($tipo=="2"){
                                                    $stmt = $conn->prepare( "DELETE FROM `listadoAtencionesCE` WHERE `idLi`= ?");
                                                    $stmt->bind_param('i', $idDx);
                                                    $stmt->execute();
                                                }else{
                                                    $stmt = $conn->prepare( "DELETE FROM `listadoAtenciones` WHERE `idLi`= ?");
                                                    $stmt->bind_param('i', $idDx);
                                                    $stmt->execute();
                                                }
                                                
                                                	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                     
                     
                       function deleteTranasRef($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_referencia` WHERE `idRef`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                      function eliminarFuACpms($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_consultaExterna` WHERE `idEm`= ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;
                     }
                     
                     
                     function eliminarPackC($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_grupoCE` WHERE `idGrupo` = ? ");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();
                                                printf("Error: %s.\n", $stmt->error);
                                                        
                                            }

                                            return $result;
                     }
                     
                     function eliminarFuasXPaquete($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_consultaExterna` WHERE `grupo` = ? ");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();
                                                printf("Error: %s.\n", $stmt->error);
                                                        
                                            }

                                            return $result;
                     }
                     
                
                     
                     
                     
                     function eliminarCaja($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "DELETE FROM `tbl_Cajas` WHERE `idCa` = ? ");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();
                                                printf("Error: %s.\n", $stmt->error);
                                                        
                                            }

                                            return $result;
                     }
                     
                     
                     
                   function verUserPaquete($id){

						$db = new Conectar();
						$conn = $db->conexion();		

						if ($conn->connect_errno) {
							printf("Conexión fallida: %s\n", $conn->connect_error);
							exit();

						}else{
						
							$sql = "SELECT (SELECT user FROM usuarios WHERE id= G.`idUsuario`) as UA,G.`namePaquete` 
							FROM `tbl_grupoCE` AS G WHERE G.`idGrupo`='$id' ";
						
					        $result = $conn->query($sql);				

						}

						return $result;

					}
                     
                     function limpiarAsignaci($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "UPDATE `tbl_consultaExterna` SET `fechaAsignada`= '' WHERE `grupo` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }
                     
                     
                     function recepcionAoc($deletePr){

                                            $db = new Conectar();
                                            $conn = $db->conexion();

                                        if ($conn->connect_errno) {

                                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                                exit();

                                        } else{

                                                $idDx  = $deletePr['id'];
                                                $stmt = $conn->prepare( "UPDATE `tbl_consultaExterna` SET `fechaRecepcionada`= '' WHERE `grupo` = ?");
                                                $stmt->bind_param('i', $idDx);
                                                $stmt->execute();	
                                                        
                                            }

                                            return $result;

                     }

                    function eliminarPrAuto($deletePr){

                        $db = new Conectar();
                        $conn = $db->conexion();

                    if ($conn->connect_errno) {

                            printf("Conexión fallida: %s\n", $conn->connect_error);
                            exit();

                    } else{

                            $idDx  = $deletePr['id'];
                            $stmt = $conn->prepare( "DELETE FROM `ac_procedimientos` WHERE `IdProcedimiento`= ?");
                            $stmt->bind_param('i', $idDx);
                            $stmt->execute();	
                                    
                        }

                        return $result;

                    }


                    function updateAuditorMasivo($procedimientos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                        if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                        }else{

                                
                                $auditor = $procedimientos['auditor'];
                                $fua     = $procedimientos['fua'];
                              
                                $stmt = $conn->prepare( "UPDATE `tbl_consultaExterna` SET `fechaAsignada`= ? WHERE `idEm` = '$fua'");                                  
                                $stmt->bind_param('s', $auditor);
                                $stmt->execute();
                                printf("Error: %s.\n", $stmt->error);
                                echo "Actualizado";        
                                      
                        }//

                       
                     }
                     
                     
                     function regMuestraIndividualPato($procedimientos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                        if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                        }else{

                                
                                $iduser = $procedimientos['iduser'];
                                $muestra = $procedimientos['muestra'];
                                $tipoEstPat = $procedimientos['tipoEstPat'];
                                $nroOrdenPat = $procedimientos['nroOrdenPat'];
                              
                                $stmt = $conn->prepare( "INSERT INTO `tbl_muestraPatologia`(`muestra`, `iduser`,formato,tipoest) VALUES (?,?,?,?) ");                                  
                                $stmt->bind_param('sisi', $muestra,$iduser,$nroOrdenPat,$tipoEstPat);
                                $stmt->execute();
                                printf("Error: %s.\n", $stmt->error);
                                echo "Actualizado";        
                                      
                        }//

                       
                     }
                     
                     function updateAuditorMasivoCE($procedimientos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                        if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                        }else{

                                
                                $auditorCE = $procedimientos['auditorCE'];
                                $fuaCE     = $procedimientos['fuaCE'];
                              
                                $stmt = $conn->prepare( "UPDATE `paciente` SET `iduser`= ? WHERE `idPac` = '$fuaCE'");                                  
                                $stmt->bind_param('i', $auditorCE);
                                $stmt->execute();
                                printf("Error: %s.\n", $stmt->error);
                                echo "Actualizado";        
                                      
                        }//

                       
                     }
                     
                     
                     
                     function regMasivoLiq($procedimientos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                        if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                        }else{

                                
                                $auditorCE = $procedimientos['auditorCE'];
                                $fuaCE     = $procedimientos['fuaCE'];
                              
                                //$stmt = $conn->prepare( "UPDATE `paciente` SET `iduser`= ? WHERE `idPac` = '$fuaCE'");
                                $stmt = $conn->prepare( " UPDATE `listadoAtencionesCE` SET `userLiq`=? WHERE `idLi` = '$fuaCE'");
                               
                                $stmt->bind_param('i', $auditorCE);
                                $stmt->execute();
                                printf("Error: %s.\n", $stmt->error);
                                echo "Actualizado";        
                                      
                        }//

                       
                     }
                     
                     function updateAuditorMasivoCajas($procedimientos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                        if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                        }else{

                                
                                $caja = $procedimientos['caja'];
                                $id     = $procedimientos['id'];
                                $user     = $procedimientos['user'];
                                $fechaHoraAsigCaja     = $procedimientos['fechaHoraAsigCaja'];
                              
                                $stmt = $conn->prepare( "UPDATE `tbl_grupoArchivo` SET `idCaja`= ?,`idUsuarioAsigCaja`= ?,`fechaHoraAsignadoCaja`= ? WHERE `idGrupo` = '$id'");                                  
                                $stmt->bind_param('iss', $caja,$user,$fechaHoraAsigCaja);
                                $stmt->execute();
                                printf("Error: %s.\n", $stmt->error);
                                echo "Actualizado";        
                                      
                        }//

                       
                     }
                     
                     
                      function deleteFuaMasivo($procedimientos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                        if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                        }else{

                                
                                $auditor = $procedimientos['auditor'];
                                $fua     = $procedimientos['fua'];
                              
                                $stmt = $conn->prepare( "DELETE FROM `tbl_consultaExterna` WHERE `idEm` = '$fua'");                                  
                                $stmt->bind_param('s', $auditor);
                                $stmt->execute();
                                printf("Error: %s.\n", $stmt->error);
                                echo "ELIMINADO";        
                                      
                        }//

                       
                     }
                
                function updateAuditorMasivoRec($procedimientos){

                        $db = new Conectar();
                        $conn = $db->conexion();

                        if ($conn->connect_errno) {
                                printf("Conexión fallida: %s\n", $conn->connect_error);
                                exit();

                        }else{

                                
                                $auditor = $procedimientos['auditor'];
                                $fua     = $procedimientos['fua'];
                              
                                $stmt = $conn->prepare( "UPDATE `tbl_consultaExterna` SET `fechaRecepcionada`= ? WHERE `idEm` = '$fua'");                                  
                                $stmt->bind_param('s', $auditor);
                                $stmt->execute();
                                printf("Error: %s.\n", $stmt->error);
                                echo "Actualizado";        
                                      
                        }//

                       
                }

}


?>