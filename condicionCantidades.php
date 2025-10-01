<?php 


header('Access-Control-Allow-Origin: *');
require 'Modelo/funciones.php';
require 'Modelo/global.php';


      $sel =new Model();

      $ni2 = $sel->EjecutarCantidades();
      while($mue = $ni2->fetch_assoc()){                                                 

                $ObjCondPre = array();
                      
                $ObjCondPre['grupo']= $mue["grupo"];
                $ObjCondPre['CONTEO']= $mue["CONTEO"];
                
                $niCond = $sel->actualizarCant($ObjCondPre);
            
      
      }


      $niCond1 = $sel->fechaMax();
      while($mue1 = $niCond1->fetch_assoc()){
        
                $ObjCondPre1 = array();
          
                $ObjCondPre1['grupo']= $mue1["grupo"];
                $ObjCondPre1['MA']   = $mue1["MA"];
                $ObjCondPre1['ME']   = $mue1["ME"];
                
                $niCondRes = $sel->actualizarMax($ObjCondPre1);
           
       }
         
         
         


?>
                                   


