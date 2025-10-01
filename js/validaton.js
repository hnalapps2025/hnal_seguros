$(document).ready(function() {


    $("#cargaDniP").click(function(){
           
        var dniP = $("#dnido").val();
        //alert(dniP);
        consultar_ruc(dniP);
});

$("#ui-id-1").css("z-index", "9999999999");

$("#idDatos").click(function(){
    $('#idPad').addClass("active");
    $('#tab_content2').addClass("active in");
    $('#tab_content1').removeClass("active in");
    
    $('#idDat').removeClass("active");
    $('#idArch').removeClass("active");
    $('#profile-tab').click();
});


$("#idPadres").click(function(){
    $('#idArch').addClass("active");
    $('#idPad').removeClass("active");

    $('#tab_content3').addClass("active in");
    $('#tab_content1').removeClass("active in");
    $('#tab_content2').removeClass("active in");
});



    $('#dnipapa').keypress(function (tecla) {
 
        if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
            return false;
        }else {
                 var len   = $('#dnipapa').val().length;
                 var index = $('#dnipapa').val().indexOf('.');

                 if (index > 0 && tecla.charCode == 46) {
                     return false;
                 }

                 if (index > 0) {
                     var CharAfterdot = (len + 1) - index;
                     if (CharAfterdot > 3) {
                         return false;
                     }
                 }
        }

        return true;
    });

    $('#dnimama').keypress(function (tecla) {
 
        if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
            return false;
        }else {
                 var len   = $('#dnimama').val().length;
                 var index = $('#dnimama').val().indexOf('.');

                 if (index > 0 && tecla.charCode == 46) {
                     return false;
                 }

                 if (index > 0) {
                     var CharAfterdot = (len + 1) - index;
                     if (CharAfterdot > 3) {
                         return false;
                     }
                 }
        }

        return true;
    });


    $('#telefa').keypress(function (tecla) {
 
        if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
            return false;
        }else {
                 var len   = $('#telefa').val().length;
                 var index = $('#telefa').val().indexOf('.');

                 if (index > 0 && tecla.charCode == 46) {
                     return false;
                 }

                 if (index > 0) {
                     var CharAfterdot = (len + 1) - index;
                     if (CharAfterdot > 3) {
                         return false;
                     }
                 }
        }

        return true;
    });

    
    $('#NroDoc').keypress(function (tecla) {
 
        if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
            return false;
        }else {
                 var len   = $('#NroDoc').val().length;
                 var index = $('#NroDoc').val().indexOf('.');

                 if (index > 0 && tecla.charCode == 46) {
                     return false;
                 }

                 if (index > 0) {
                     var CharAfterdot = (len + 1) - index;
                     if (CharAfterdot > 3) {
                         return false;
                     }
                 }
        }

        return true;
    });
  
    $('#FechaNac').keypress(function (tecla) {
            
        if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
            return false;
        }else {
                 var len   = $('#FechaNac').val().length;
                 var index = $('#FechaNac').val().indexOf('.');

                 if (index > 0 && tecla.charCode == 46) {
                     return false;
                 }

                 if (index > 0) {
                     var CharAfterdot = (len + 1) - index;
                     if (CharAfterdot > 3) {
                         return false;
                     }
                 }
        }

        return true;
    });

    $('#HistCli').keypress(function (tecla) {
 
        if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
            return false;
        }else {
                 var len   = $('#HistCli').val().length;
                 var index = $('#HistCli').val().indexOf('.');

                 if (index > 0 && tecla.charCode == 46) {
                     return false;
                 }

                 if (index > 0) {
                     var CharAfterdot = (len + 1) - index;
                     if (CharAfterdot > 3) {
                         return false;
                     }
                 }
        }

        return true;
    });


    $('select#tipoAf').on('change',function(){
        var valor = $(this).val();
        var nRo = $("#NroDoc").val();
        if(valor=="2"){
            $("#NroAf").val(valor+"-"+nRo);
        }else{
            $("#NroAf").val(valor+"-");
        }
        
        
    });



});

    function verId(id){

          $("#idpre").val(id);
          $("#donatPac").attr("onClick", "verIdDona("+id+");");
          $("#doowewna").attr("onClick", "verIdFiles("+id+");");
          $("#cargoEUpload").attr("onClick", "verIdCargoE("+id+");");
          $("#cargoEApro").attr("onClick", "verIdCargoE("+id+");");
          verIdPX(id);

          

        $.ajax({
            url:'Modelo/search.php?function=pre',
            type:'GET',
            dataType:'json',
            data:{ NroDoc:$('#idpre').val()}

        }).done(function(datos){
            
            $("#tipotras").val(datos[0]);
            $("#HistCli").val(datos[1]);
            $("#emailcena").val(datos[2]);
            $("#fecensol").val(datos[3]);
            $("#emailcAproFis").val(datos[4]);
            $("#fecaprosol").val(datos[5]);
            $("#observaciones").val(datos[6]);
            
            if(datos[7]!=""){
                $( ".VerCargoE" ).removeClass( "hidden" );
                var link = "cargo/"+datos[7];
                $('.VerCargoE').attr('href', link);
            }else{
                $( ".VerCargoE" ).addClass( "hidden" );
            }
            
            
            if(datos[8]!=""){
                $( ".VerCargoR" ).removeClass( "hidden" );
                var link = "cargo/"+datos[8];
                $('.VerCargoR').attr('href', link);
            }else{
                $( ".VerCargoR" ).addClass( "hidden" );
            }
            
        });
        
    }


    function verIdPX(id){

              

      $.ajax({
          url:'Modelo/search.php?function=preP',
          type:'GET',
          dataType:'json',
          data:{ NroDoc:id}

      }).done(function(datos){
          
          $("#pacient").text("PRE-TRASPLANTE DE "+datos[1]+" "+datos[2]+" "+datos[3]);
          
      });
      
  }


  function verIdPostX(id){

              

    $.ajax({
        url:'Modelo/search.php?function=postP',
        type:'GET',
        dataType:'json',
        data:{ NroDoc:id}

    }).done(function(datos){
        
        var dt =datos[0];

        if(dt=="RENAL" || dt=="HEPATICO"){
            $("#renal").css("display","block");
            $("#tph").css("display","none");
            //$("#pacientpost").text("Aun no cuenta con tipo trasplante "); 
            $("#pacientpost").text("POST-TRASPLANTE: "+dt); 
        }
        else{
            $("#tph").css("display","block");
            $("#renal").css("display","none");
            $("#pacientpost").text("POST-TRASPLANTE: "+dt); 
            //$("#pacientpost").text("POST-TRASPLANTE: "+dt);
            /*if(dt=="TRASPLANTE DE PROGENITORES HEMATOPOYETICOS"){
                $("#tph").css("display","block");
                alert("TPH");
            }else if(dt=="RENAL" || dt=="HEPATICO"){
                $("#renal").css("display","block");
                alert("renal o hepatico");
            }*/
        }
        
        
    });
    
}


    


    function verPaciente(id){
        $("#iddRe").val(id);
        $("#ide").val(id);
        $("#iddCarg").val(id);
        $("#ui-id-1").css("z-index", "9999999999");
        //$("#ui-id-2").css("z-index", "9999999999");
        $("#subriArchivos").removeClass("hidden");
        $("#cargX").removeClass("hidden");
        $("#VerCargoRecPost").removeClass("hidden");

       
        
      
      $.ajax({
          url:'Modelo/search.php?function=pacienteDatos',
          type:'GET',
          dataType:'json',
          data:{ NroDoc:id}

      }).done(function(datos){

          $("#ippress").val(datos[0]);
          $("#solipac").val(datos[1]);
          $("#solimedico").val(datos[2]);
          $("#tipoDoc").val(datos[3]);
          $("#NroDoc").val(datos[4]);
         
          $("#NroAf").val(datos[6]);
          $("#departamento").val(datos[7]);
          $("#apepa").val(datos[8]);
          $("#apema").val(datos[9]);
          $("#nombres").val(datos[10]);
          $("#FechaNac").val(datos[11]);
          $("#edad").val(datos[12]);
          $("#sexo").val(datos[13]);
          $("#descri").val(datos[14]);
          $("#cie10").val(datos[15]);
          $("#regimen").val(datos[16]);
          $("#regimen").trigger("change");
          $("#tipoAf").val(datos[5]);
          // 
          $("#hclinica").val(datos[17]);
          $("#telefa").val(datos[18]);
          $("#dniMama").val(datos[19]);
          $("#nombresMama").val(datos[20]);
          $("#apeMama").val(datos[21]);
          $("#dniPapa").val(datos[22]);
          $("#nombresPapa").val(datos[23]);
          $("#apePapa").val(datos[24]);
          $("#correoSolicitud").val(datos[25]);
          $("#feiniciCobertura").val(datos[26]);
          $("#docRespuesta").val(datos[27]);
          $("#feAutoraizacion").val(datos[28]);
          $("#cocobertura").val(datos[29]);
          $("#coafiliado").val(datos[30]);
          $("#observaciones").val(datos[31]);
          $("#VerCargoRecPost").val(datos[32]);
          $("#upss").val(datos[33]);
          $("#tipoDocPapa").val(datos[34]);
          $("#tipoDocMama").val(datos[35]);


          $("#coses").val(datos[36]);
          $("#ObsSeguro").val(datos[37]);
          $("#fefa").val(datos[38]);


          var dat = datos[36];
          if(dat=="ANULADO" ){
            $( "#obsase" ).removeClass( "hidden");
            $( "#textSeguro" ).removeClass( "hidden");
          }else{
            $( "#obsase" ).addClass( "hidden");
            $( "#textSeguro" ).addClass( "hidden");
          }



          var dat2 = datos[30];
          if(dat2=="FALLECIDO" ){
            $( "#idfa" ).removeClass( "hidden");
            $( "#fallecido" ).removeClass( "hidden");
          }else{
            $( "#idfa" ).addClass( "hidden");
            $( "#fallecido" ).addClass( "hidden");
          }



          if(id!=""){
            $("#MosPac").removeClass("hidden");
                if(datos[29]=="RECHAZADO"){
                    $(".MostrarCo").html("");
                    $(".MostrarCo").append("<a style='background: red;color: white;font-weight: bolder;'>RECHAZADO</a>");
                }else if(datos[29]=="PENDIENTE"){
                    $(".MostrarCo").html("");
                    $(".MostrarCo").append("<a style='background: #f0ad4e;color: white;font-weight: bolder;'>PENDIENTE</a>");
                }
                else if(datos[29]=="APROBADO"){
                    $(".MostrarCo").html("");
                    $(".MostrarCo").append("<a style='background: #367d36;color: white;font-weight: bolder;'>APROBADO</a>");
                }
            
            
            }else{
                $(".MostrarCo").html("");
                $("#MosPac").addClass("hidden");
            }
        

          if(datos[32]!=""){
            $( "#VerCargoRecPost" ).removeClass( "hidden" );
            var link = "cargo/"+datos[32];
            $('#VerCargoRecPost').attr('href', link);
        }else{
            $( "#VerCargoRecPost" ).addClass( "hidden" );
        }
        
                      
          
      });
      
  }
  
  
    function modalEliminar(id){

        var upladid = $("#iduser").val();   
        $("#iduserReg").val(upladid);
        $("#iddReg").val(id);     
    
    }
  
  
    function FinalProceso(id){

        var upladid = $("#iduser").val();   
        $("#iduserTermino").val(upladid);
        $("#iddTer").val(id);    

    }
  

    function verIdPost(id){
        $("#idpost").val(id);
        $("#doowewnaPost").attr("onClick", "verIdFilesPost("+id+");");
        $("#cargoEUploadPostEnvio").attr("onClick", "verIdCargoEPostE("+id+");");
        $("#cargoAUploadPostApro").attr("onClick", "verIdFilesAPostA("+id+");");
        verIdPostX(id);

      $.ajax({
          url:'Modelo/search.php?function=post',
          type:'GET',
          dataType:'json',
          data:{ NroDoc:$('#idpost').val()}

      }).done(function(datos){
          
        
         
         $("#oficiopost").val(datos[0]);
          $("#fechapost").val(datos[1]);
          $("#ofiauto").val(datos[2]);
          $("#feauto").val(datos[3]);
          $("#fetras").val(datos[4]);
          $("#lugarTrans").val(datos[5]);
          $("#nrotr").val(datos[6]);
         
         
          if(datos[7]=="HERMANO COMPATIBLE PLENO"){
            $("#radio1").attr('checked','checked');
          }
          else if(datos[7]=="HAPLOIDENTICO"){
            $("#radio2").attr('checked','checked');
          }
          else if(datos[7]=="AUTOLOGO"){
            $("#radio3").attr('checked','checked');
          }
          else if(datos[7]=="NO EMPARENTADO"){
            $("#radio4").attr('checked','checked');
          }
          else if(datos[7]=="VIVO NO RELACIONADO"){
            $("#radio5").attr('checked','checked');
          }
          else if(datos[7]=="VIVO RELACIONADO"){
            $("#radio6").attr('checked','checked');
          }
          else if(datos[7]=="CADAVERICO"){
            $("#radio7").attr('checked','checked');
          }else{
            $("#radio1").attr('checked','unchecked');
            $("#radio2").attr('checked','unchecked');
            $("#radio3").attr('checked','unchecked');
            $("#radio4").attr('checked','unchecked');
            $("#radio5").attr('checked','unchecked');
            $("#radio6").attr('checked','unchecked');
            $("#radio7").attr('checked','unchecked');
          }



          if(datos[8]!=""){
                $( ".VerCargoPost" ).removeClass( "hidden" );
                var link = "cargo/"+datos[8];
                $('.VerCargoPost').attr('href', link);
            }else{
                $( ".VerCargoPost" ).addClass( "hidden" );
            }
            
            
            if(datos[9]!=""){
                $( ".VerCargoRecPost" ).removeClass( "hidden" );
                var link = "cargo/"+datos[9];
                $('.VerCargoRecPost').attr('href', link);
            }else{
                $( ".VerCargoRecPost" ).addClass( "hidden" );
            }


            var ofc = $("#oficiopost").val();
            if(ofc==""){
                $("#oficiopost").val("CORREO ELECTRONICO  N° XXX  -20XX- ESPP-UAD/INSN-SB");
            };
            
          
      });
      
  }



  function verIdAmpliacion(id){
    var idus = $("#iduser").val();
    $("#iduserAmp").val(idus);
    $("#idAmp").val(id);
    $("#ArchiAmp").attr("onClick", "verIdFilesAmp("+id+");");
    $("#cargoAmpEnvio").attr("onClick", "verIdCargoAmpe("+id+");");
    $("#cargoAmpRecepcion").attr("onClick", "verIdCargoAproAmp("+id+");");
    //verIdPostX(id);

  $.ajax({
      url:'Modelo/search.php?function=amp',
      type:'GET',
      dataType:'json',
      data:{ NroDoc:$('#idAmp').val()}

  }).done(function(datos){
      
 
      $("#oficiopostAmp").val(datos[0]);
      $("#fechaAmp").val(datos[1]);
      $("#ofiautoAmp").val(datos[2]);
      $("#feautoAmp").val(datos[3]);
      $("#fetrasAmp").val(datos[4]);
      $("#lugarTransAmp").val(datos[5]);
      $("#finCob").val(datos[6]);


       if(datos[7]!=""){
                $( ".VerCargoAmp" ).removeClass( "hidden" );
                var link = "cargo/"+datos[7];
                $('.VerCargoAmp').attr('href', link);
            }else{
                $( ".VerCargoAmp" ).addClass( "hidden" );
            }
            
            
            if(datos[8]!=""){
                $( ".VerCargoAutoAmp" ).removeClass( "hidden" );
                var link = "cargo/"+datos[8];
                $('.VerCargoAutoAmp').attr('href', link);
            }else{
                $( ".VerCargoAutoAmp" ).addClass( "hidden" );
            }
      
    /* if(datos[7]=="HERMANO COMPATIBLE PLENO"){
        $("#radio1").attr('checked','checked');
      }
      else if(datos[7]=="HAPLOIDENTICO"){
        $("#radio2").attr('checked','checked');
      }
      else if(datos[7]=="AUTOLOGO"){
        $("#radio3").attr('checked','checked');
      }
      else if(datos[7]=="NO EMPARENTADO"){
        $("#radio4").attr('checked','checked');
      }
      else if(datos[7]=="VIVO NO RELACIONADO"){
        $("#radio5").attr('checked','checked');
      }
      else if(datos[7]=="VIVO RELACIONADO"){
        $("#radio6").attr('checked','checked');
      }
      else if(datos[7]=="CADAVERICO"){
        $("#radio7").attr('checked','checked');
      }else{
        $("#radio1").attr('checked','unchecked');
        $("#radio2").attr('checked','unchecked');
        $("#radio3").attr('checked','unchecked');
        $("#radio4").attr('checked','unchecked');
        $("#radio5").attr('checked','unchecked');
        $("#radio6").attr('checked','unchecked');
        $("#radio7").attr('checked','unchecked');
      } */
      
  });
  
}



    function verIdDona(id){

            $("#iddona").val(id);
            CargarDonat(id);
    }


    function verIdFiles(id){
        //$('#formupload')[0].reset();
       
        $("#iddpac").val(id);
       var upladid = $("#iduser").val();        
        $("#iduserupload").val(upladid);
       
    }

    function verIdFilesPost(id){
           
        $("#iddpacPost").val(id);
       var upladid = $("#iduser").val();        
        $("#iduseruploadPost").val(upladid);
       
    }

    function verIdFilesAmp(id){
           
        $("#iddAmpliacion").val(id);
       var upladid = $("#iduser").val();        
        $("#iduserAmpliacion").val(upladid);
       
    }

    function verIdCargoE(id){
        
       
        $("#iddcargo").val(id);
        $("#iddcargoApro").val(id);

       var upladid = $("#iduser").val();
       var upladidApro = $("#iduser").val();        
        $("#iduseruploadCargo").val(upladid);
        $("#iduseruploadCargoApro").val(upladidApro);
       
    }


    function verIdCargoEPostE(id){
        
        var upladid = $("#iduser").val();   
        $("#iduseruploadCargoPost").val(upladid);
        $("#iddcargoPost").val(id);

       
    }


    function verIdFilesAPostA(id){
        
       
     
       var upladid = $("#iduser").val();    
        $("#iduserAproCargoPost").val(upladid);
        $("#iddcargoAproPost").val(id);
       
    }




  function verIdCargoAmpe(id){
        
        var upladid = $("#iduser").val();   
        $("#iduserAmpEnvio").val(upladid);
        $("#iddEnvioAmp").val(id);

       
    }


    function verIdCargoAproAmp(id){
               // COMNENTARIO DE PRUEBA 
       var upladid = $("#iduser").val();    
        $("#iduseAmpEx").val(upladid);
        $("#iddcargoAmpRex").val(id);
       
    }

    /*function verIdCargoAp(id){
        
       
        $("#iddcargo").val(id);
        $("#iddcargoApro").val(id);

       var upladid = $("#iduser").val();
       var upladidApro = $("#iduser").val();        
        $("#iduseruploadCargo").val(upladid);
        $("#iduseruploadCargoApro").val(upladidApro);
       
    } */

    
    function CargarDonat($id)
    {   
        $('#datagridDona').load('consultaDonantes.php?id='+$id);
        $('#datagridEfectivo').load('consultaEfectivo.php?id='+$id);
    }


    function calcularEdad(fecha) {
        // Si la fecha es correcta, calculamos la edad

        if (typeof fecha != "string" && fecha && esNumero(fecha.getTime())) {
            fecha = formatDate(fecha, "yyyy-MM-dd");
        }

        var values = fecha.split("-");
        var dia = values[2];
        var mes = values[1];
        var ano = values[0];

        // cogemos los valores actuales
        var fecha_hoy = new Date();
        var ahora_ano = fecha_hoy.getYear();
        var ahora_mes = fecha_hoy.getMonth() + 1;
        var ahora_dia = fecha_hoy.getDate();

        // realizamos el calculo
        var edad = (ahora_ano + 1900) - ano;
        if (ahora_mes < mes) {
            edad--;
        }
        if ((mes == ahora_mes) && (ahora_dia < dia)) {
            edad--;
        }
        if (edad > 1900) {
            edad -= 1900;
        }

        // calculamos los meses
        var meses = 0;

        if (ahora_mes > mes && dia > ahora_dia)
            meses = ahora_mes - mes - 1;
            //update install php <= 345
        else if (ahora_mes > mes)
            meses = ahora_mes - mes
        if (ahora_mes < mes && dia < ahora_dia)
            meses = 12 - (mes - ahora_mes);
        else if (ahora_mes < mes)
            meses = 12 - (mes - ahora_mes + 1);
        if (ahora_mes == mes && dia > ahora_dia)
            meses = 11;

        // calculamos los dias
        var dias = 0;
        if (ahora_dia > dia)
            dias = ahora_dia - dia;
        if (ahora_dia < dia) {
            ultimoDiaMes = new Date(ahora_ano, ahora_mes - 1, 0);
            dias = ultimoDiaMes.getDate() - (dia - ahora_dia);
        }

        return edad + "A " + meses + "M " + dias + "D";
       // return edad + " A " + meses + " meses";
    }
    
   
    


    function handler(e){
        
       
        var actual = e.target.value;
        var res = calcularEdad(actual);
        
        $("#edad").val(res);

    }


    function handlerDo(e){
        
       
        var actual = e.target.value;
        var ano = (new Date).getFullYear();
        var resDo = parseInt(ano) - parseInt(actual);
        
        $("#edado").val(resDo+" AÑOS");

    }


    

    /*function consultar_ruc(ruc) {
        $.ajax({
             url : 'consulta_sunat.php',
             method :  'GET',
             dataType : "json",
             data:'ruc='+ruc,

             success: function(data)
            {
                $("#nodona").val(data[0][0].Nombres);
                $("#apedona").val(data[0][0].ApellidoPaterno+" "+data[0][0].ApellidoMaterno);
                $("#fedot").val(data[0][0].FechaNacimiento);
            }  
            

         });
     }
  */



  
 function consultar_ruc(ruc) {
    $.ajax({
         url : 'consulta_sunat.php',
         method :  'GET',
         dataType : "json",
         data:'ruc='+ruc,

         success: function(data)
        {
            $("#nodona").val(data[0][0].Nombres);
            $("#apedona").val(data[0][0].ApellidoPaterno+" "+data[0][0].ApellidoMaterno);
            $("#fedot").val("2004-10-08");
            /*var fena = data[0][0].FechaNacimiento;
            var strArray = myStr.split("\/");
            
            // Display array values on page
            for(var i = 0; i < strArray.length; i++){
               alert(strArray[i]);
            }*/






        }  
        

     });
 }

 

 /*   function cargarProvincia(depa) {
    
        $.post('./Modelo/provincia.php', {depa : depa}, 	
         function(data){
            
                if (data != "[]") {
                    var item = $.parseJSON(data);
                    
                    $("#provincia").append('<option value="0">-- Seleccionar --</option>');
                    $.each(item, function (i, valor) {
                        
                        if (valor.idProvincia !== null) {
                            $("#provincia").append('<option value="' + valor.idProvincia + '">' + valor.provincia + '</option>');	
                        }
                    });
                }
            return false;
        });
    }
*/

