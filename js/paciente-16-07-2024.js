

$(document).ready(function(){
    

$("#enviar999").removeClass("hidden");
//$("#imrpesion").removeClass("hidden");
    var max_chars = 200;

    $('#max').html(max_chars);

    $('#comment').keyup(function() {
        
        var chars = $(this).val().length;
        var diff = max_chars - chars;
        $('#contador').html('Restan '+ diff+" caracteres.");  
        
       
        if(diff > 0  ){
                $("#enviar999").removeClass("hidden");
                $("#enviar").removeClass("hidden");
        }


    });
    
        
     $('#dx10').keyup(function() {
         
            var textBus = $('#dx10').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#dx10").css("background","#26b99a");
                $("#dx10").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#dx10").css("background","#6bb7f7");
                $("#dx10").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#dx10").css("background","#eea236");
                $("#dx10").css("color","white");
            }
            
    });
    
    
     $('#dx9').keyup(function() {
         
            var textBus = $('#dx9').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#dx9").css("background","#26b99a");
                $("#dx9").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#dx9").css("background","#6bb7f7");
                $("#dx9").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#dx9").css("background","#eea236");
                $("#dx9").css("color","white");
            }
            
    });
    
      $('#dx8').keyup(function() {
         
            var textBus = $('#dx8').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#dx8").css("background","#26b99a");
                $("#dx8").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#dx8").css("background","#6bb7f7");
                $("#dx8").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#dx8").css("background","#eea236");
                $("#dx8").css("color","white");
            }
            
    });
    
    
     $('#dx7').keyup(function() {
         
         
            var textBus = $('#dx7').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#dx7").css("background","#26b99a");
                $("#dx7").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#dx7").css("background","#6bb7f7");
                $("#dx7").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#dx7").css("background","#eea236");
                $("#dx7").css("color","white");
            }
            
    });
    
    $('#dx6').keyup(function() {
         
            var textBus = $('#dx6').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#dx6").css("background","#26b99a");
                $("#dx6").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#dx6").css("background","#6bb7f7");
                $("#dx6").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#dx6").css("background","#eea236");
                $("#dx6").css("color","white");
            }
            
    });
    
    
    $('#dx5').keyup(function() {
         
            var textBus = $('#dx5').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#dx5").css("background","#26b99a");
                $("#dx5").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#dx5").css("background","#6bb7f7");
                $("#dx5").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#dx5").css("background","#eea236");
                $("#dx5").css("color","white");
            }
            
    });
    
    
     $('#dx4').keyup(function() {
            var textBus = $('#dx4').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#dx4").css("background","#26b99a");
                $("#dx4").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#dx4").css("background","#6bb7f7");
                $("#dx4").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#dx4").css("background","#eea236");
                $("#dx4").css("color","white");
            }
            
    });
    
    
     $('#dx3').keyup(function() {
            var textBus = $('#dx3').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#dx3").css("background","#26b99a");
                $("#dx3").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#dx3").css("background","#6bb7f7");
                $("#dx3").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#dx3").css("background","#eea236");
                $("#dx3").css("color","white");
            }
            
    });
    
    
     $('#dx2').keyup(function() {
            var textBus = $('#dx2').val();
            
            if(textBus.indexOf('FISSAL') > -1){
                $("#dx2").css("background","#26b99a");
                $("#dx2").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#dx2").css("background","#6bb7f7");
                $("#dx2").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#dx2").css("background","#eea236");
                $("#dx2").css("color","white");
            }
            
    });
    
    
     $('#dx1').keyup(function() {
            var textBus = $('#dx1').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#dx1").css("background","#26b99a");
                $("#dx1").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#dx1").css("background","#6bb7f7");
                $("#dx1").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#dx1").css("background","#eea236");
                $("#dx1").css("color","white");
            }
            
     });
     
     
     /* DX DE CONSULTA EXTERNA */
     
     
     $('#cie10_1x').keyup(function() {
            var textBus = $('#cie10_1x').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#cie10_1x").css("background","#26b99a");
                $("#cie10_1x").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#cie10_1x").css("background","#6bb7f7");
                $("#cie10_1x").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#cie10_1x").css("background","#eea236");
                $("#cie10_1x").css("color","white");
            }
            
     });
     
     
     
     $('#cie10_2x').keyup(function() {
            var textBus = $('#cie10_2x').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#cie10_2x").css("background","#26b99a");
                $("#cie10_2x").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#cie10_2x").css("background","#6bb7f7");
                $("#cie10_2x").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#cie10_2x").css("background","#eea236");
                $("#cie10_2x").css("color","white");
            }
            
     });
     
     
      $('#cie10_3x').keyup(function() {
            var textBus = $('#cie10_3x').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#cie10_3x").css("background","#26b99a");
                $("#cie10_3x").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#cie10_3x").css("background","#6bb7f7");
                $("#cie10_3x").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#cie10_3x").css("background","#eea236");
                $("#cie10_3x").css("color","white");
            }
            
     });
     
     
     
      $('#cie10_4x').keyup(function() {
            var textBus = $('#cie10_4x').val();
            if(textBus.indexOf('FISSAL') > -1){
                 $("#cie10_4x").css("background","#26b99a");
                 $("#cie10_4x").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#cie10_4x").css("background","#6bb7f7");
                 $("#cie10_4x").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#cie10_4x").css("background","#eea236");
                 $("#cie10_4x").css("color","white");
            }
            
     });
     
     
      $('#cie10_5x').keyup(function() {
            var textBus = $('#cie10_5x').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#cie10_5x").css("background","#26b99a");
                $("#cie10_5x").css("color","white");
            }else if(textBus.indexOf('DX') > -1) {
                 $("#cie10_5x").css("background","#6bb7f7");
                $("#cie10_5x").css("color","white");
            }else if(textBus.indexOf('LERH') > -1) {
                 $("#cie10_5x").css("background","#eea236");
                $("#cie10_5x").css("color","white");
            }
            
        
     });
     
          $("#exportarCpmsAudi").click(function(){
            $(".buttons-excel").click();
          });
          
          
          
          
          
            $("#procedQx").autocomplete({
                                                        
                source: "./Controlador/search.php?function=verListbusquedaProced",
                minLength: 3,
                select: function( event, ui ) {
                    event.stopPropagation();
                }
            });


            $("#cptCitoEs").autocomplete({
                                                        
                source: "./Controlador/search.php?function=cptCitoEs",
                minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                }
            });

            
            
            $("#nomObtencionMuestras").autocomplete({
                                                        
                source: "./Controlador/search.php?function=verMedicCitologia",
                minLength: 3,
                select: function( event, ui ) {
                    event.stopPropagation();
                }
                
            });
            
            
            $("#datosResposanble").autocomplete({
                                                        
                source: "./Controlador/search.php?function=buscarUserDigi",
                minLength: 3,
                select: function( event, ui ) {
                    event.stopPropagation();
                }
                
            });
            
            $("#iprId").autocomplete({
                                                        
                source: "./Controlador/search.php?function=verListIpress",
                minLength: 3,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
            });
            
             $("#lblUserDecri").autocomplete({
                                                        
                source: "./Controlador/search.php?function=buscarUserDigi",
                minLength: 3,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
            });
            
            
            
            $("#nomApeConfir").autocomplete({
                                                        
                source: "./Controlador/search.php?function=medicoSolicitante",
                minLength: 3,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
                
            });
            
            
            /*$("#marcList").autocomplete({
                                                        
                source: "./Controlador/search.php?function=verListbusquedaMarcad",
                minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
                
            });*/
            
            
            
        $("#marcList").autocomplete({
            
                         
                source: function(request, response) {
                    
                    var seleco = '';
                        if($('#idSelectHisto').val()==""){
                            seleco = $('#idSelectHistoCito').val();
                        }else{
                            seleco = $('#idSelectHisto').val();
                        }
        
        
                    $.ajax({
                            url: './Controlador/search.php?function=verListbusquedaMarcad',
                            dataType:'json',
                            data: {
                                cat: seleco,
                                term: request.term
                            },
                            
                          success: function (data){
                              response(data);
                           }
                           
                        });
                    }
        
           }); 

            
            
             $("#medicoSolcit").autocomplete({
                                                        
                source: "./Controlador/search.php?function=listMedicoSolcit",
                minLength: 3,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
                
            });
            
             $("#medicoSolcit2").autocomplete({
                                                        
                source: "./Controlador/search.php?function=listMedicoSolcit",
                minLength: 3,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
                
            });
          
          $("#no1").click(function(){
              
               $('#step-1').css('display','block');
               $('#step-2').css('display','none');
               $('#step-3').css('display','none');
               $('#step-4').css('display','none');
               
               
               $('#rel1').addClass('selected');
               $('#rel2').removeClass('selected');
               $('#rel2').addClass('disabled');
               $('#rel3').removeClass('selected');
               $('#rel3').addClass('disabled');
               $('#rel4').removeClass('selected');
               $('#rel4').addClass('disabled');
               
              
          });
          
          $("#profile-tab4").click(function(){
              
               $('#guardarEmege').css('display','none');
          });
          
           $("#profile-tab2").click(function(){
              
               $('#guardarEmege').css('display','block');
                $('#guardarEmege').css('float','right');
               
          });
           $("#profile-tab").click(function(){
              
               $('#guardarEmege').css('display','block');$('#guardarEmege').css('float','right');
          });
           $("#home-tab").click(function(){
              
               $('#guardarEmege').css('display','block');$('#guardarEmege').css('float','right');
          });
          
          
          $("#no2").click(function(){
             
             
               $('#step-1').css('display','none');
               $('#step-2').css('display','block');
               $('#step-3').css('display','none');
               $('#step-4').css('display','none');
               
               
               $('#rel1').removeClass('disabled');
               $('#rel2').removeClass('disabled');
               $('#rel2').addClass('selected');
               $('#rel3').removeClass('selected');
               $('#rel3').addClass('disabled');
               $('#rel4').addClass('disabled');
             
             
          });
   
   
        $("#no3").click(function(){
             
             
                 
               $('#rel1').removeClass('disabled');
               $('#rel2').addClass('selected');
               $('#rel3').removeClass('disabled');
               $('#rel3').addClass('selected');
               $('#rel4').addClass('disabled');
                $('#rel4').removeClass('selected');
             
               $('#step-1').css('display','none');
               $('#step-2').css('display','none');
               $('#step-3').css('display','block');
               $('#step-4').css('display','none');
               
             
          });
          
          $("#no4").click(function(){
             
             
                 
               $('#rel1').removeClass('disabled');
               $('#rel2').addClass('selected');
               $('#rel4').removeClass('disabled');
               $('#rel4').addClass('selected');
               $('#rel3').addClass('selected');
             
             
               $('#step-1').css('display','none');
               $('#step-2').css('display','none');
               $('#step-3').css('display','none');
               $('#step-4').css('display','block');
               
             
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
        
        
         $('#NroDocRef').keypress(function (tecla) {
 
            if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
                return false;
            }else {
                     var len   = $('#NroDocRef').val().length;
                     var index = $('#NroDocRef').val().indexOf('.');
 
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
        
        
        $('#nroDocCiru').keypress(function (tecla) {
 
            if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
                return false;
            }else {
                     var len   = $('#nroDocCiru').val().length;
                     var index = $('#nroDocCiru').val().indexOf('.');
 
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
        
        
        $('#edadRef').keypress(function (tecla) {
 
            if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
                return false;
            }else {
                     var len   = $('#NroDocRef').val().length;
                     var index = $('#NroDocRef').val().indexOf('.');
 
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
        
        
        $('#edadCiruProg').keypress(function (tecla) {
 
            if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
                return false;
            }else {
                     var len   = $('#NroDocRef').val().length;
                     var index = $('#NroDocRef').val().indexOf('.');
 
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
        
        
        $('#edad').keypress(function (tecla) {
 
            if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
                return false;
            }else {
                     var len   = $('#NroDocRef').val().length;
                     var index = $('#NroDocRef').val().indexOf('.');
 
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
        
        
        $("#paxRef").bind('keypress', function(event) {
              var regex = new RegExp("^[a-zA-Z ]+$");
              var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
              if (!regex.test(key)) {
                event.preventDefault();
                return false;
              }
         });
        
        
          $("#pacienCIruProg").bind('keypress', function(event) {
              var regex = new RegExp("^[a-zA-Z ]+$");
              var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
              if (!regex.test(key)) {
                event.preventDefault();
                return false;
              }
         });
        
    
    
});

window.onload = function () {

                var prepo3Dra = $('#prepo3').DataTable();
                $('#limpimputRec').click(function() {
                      prepo3Dra.search('').draw();
                      $('#sercRecon').val('');
                });
                
 
                

      
    function getParameterByName(name) {
          
        name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
        var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
        return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
    }
    
        var reb = getParameterByName('pagina');
        var pte = getParameterByName('pte');
        var id = getParameterByName('id');

       
      //    cargarCpms();
       //   CargarCon(reb,pte);
            CargarRepo();
        
      //    CargarDiagnosticos(id); 
    
            Cargar1(id);
            cargarServicesCE();
            cargarAuditorGrupo();
      

            $('.myref').on( 'click', function() {
                if($(this).is(':checked') ){
                    $("#productoX").val("");
                } 
            });        


            $("#closealert").click(function(){
                $("#alerify").addClass("hidden");
            });
            
            
             $("#envioA").click(function(){
                      var d = new Date();
                      var month = d.getMonth()+1;
                      var day = d.getDate();
                      var output = d.getFullYear() + '-' +
                      ((''+month).length<2 ? '0' : '') + month + '-' +
                      ((''+day).length<2 ? '0' : '') + day;
                      
                      
                      if( $(this).prop('checked') ) {
                            $("#feuser").val(output);
                      }
            });
     
            $("#cargaCuenta").click(function(){
                cargaCuentaP();
            });
            
            
                
                $("#nomObtencionMuestras").keypress(function(e) {
                  
                        if(e.which == 13) {
                                 e.preventDefault();
                                 var op = $(this).val();
                                 verificarCmpResponCitologia(op);
                        }
                
                });
            
            
            
              $("#marcList").keypress(function(e) {
                  
                            if(e.which == 13) {
                                    
                                     e.preventDefault();
                                     var op = $(this).val();
                                     var formatoPatologiaMac = $("#formatoPatologiaMac").val();
                                     var filtroTipoEst = $("#filtroTipoEst").val();
                                     verificarCheckedMama(op,formatoPatologiaMac,filtroTipoEst);
                                     
                            }
                
              });
              
              
              
              $("#datosResposanble").keypress(function(e) {
                  
                        if(e.which == 13) {
                             e.preventDefault();
                             var op = $(this).val();
                             verificarCmpRespon(op);
        
                        }
                
              });
              
              
              $("#datosResposanble").keydown(function(e) {
                if(e.which == 9) {
                        e.preventDefault();
                        var op = $(this).val();
                             verificarCmpRespon(op);
                }
                
              });
              
               $("#nomObtencionMuestras").keydown(function(e) {
                if(e.which == 9) {
                        e.preventDefault();
                        var op = $(this).val();
                             verificarCmpResponCitologia(op);
                }
                
              });
              
              
              $("#marcList").keydown(function(e) {
                if(e.which == 9) {
                        e.preventDefault();
                        var op = $(this).val();
                         var formatoPatologiaMac = $("#formatoPatologiaMac").val();
                        var filtroTipoEst = $("#filtroTipoEst").val();
                        verificarCheckedMama(op,formatoPatologiaMac,filtroTipoEst);
                }
                
              });
              
              
              
            

/*           $("#Nxuenta").keypress(function(e) {
                if(e.which == 13) {
                  e.preventDefault();
                  cargaCuentaP();
                  $("#dni").focus();
                }
              });
    

              $("#Nxuenta").keydown(function(e) {
                if(e.which == 9) {
                  e.preventDefault();
                    cargaCuentaP();
                    $("#dni").focus();
                }
              });
              
              
*/
                
                $("#busNroRef").keypress(function(e) {
                    
                if(e.which == 13) {
                  e.preventDefault();
                  
                  var codipres = $("#busipres").text();
                  var anio = $("#busanio").text();
                  
                  panelHistoriaClinica(codipres,anio,$(this).val());
                  
                }
                
              });
    

              $("#busNroRef").keydown(function(e) {
                if(e.which == 9) {
                  e.preventDefault();
                  
                  var codipres = $("#busipres").text();
                  var anio = $("#busanio").text();
                  
                  panelHistoriaClinica(codipres,anio,$(this).val());
                  
                    
                }
              });
              
              
              
              $("#NroDocRefEval").keypress(function(e) {
                  
                    if(e.which == 13) {
                      e.preventDefault();
                      
                       var codipres = $("#busipresEval").text();
                       var anio = $("#busanioEval").text();
                      
                        panelHistoriaClinicaEval(codipres,anio,$(this).val());
                      
                    }
                
              });
    

              $("#NroDocRefEval").keydown(function(e) {
                if(e.which == 9) {
                  e.preventDefault();
                     var codipres = $("#busipresEval").text();
                     var anio = $("#busanioEval").text();
                  
                   panelHistoriaClinicaEval(codipres,anio,$(this).val());
                    
                }
              });
              

                
              $("#codigoFor").keypress(function(e) {
                if(e.which == 13) {
                  e.preventDefault();
                      var ter = $(this).val();
                      cargarInfoDisa(ter);
                      cargarProfesionSys();
                      cargarOfUnid();
                      
                      
                }
              });
    

              $("#codigoFor").keydown(function(e) {
                if(e.which == 9) {
                  e.preventDefault();
                       var ter = $(this).val();
                      cargarInfoDisa(ter);
                      cargarProfesionSys();
                      cargarOfUnid();
                }
              });
              
              
              $("#codigoForRef").keypress(function(e) {
                if(e.which == 13) {
                  e.preventDefault();
                      var ter = $(this).val();
                      cargarInfoDisaRef(ter);
                     
                }
              });
    

              $("#codigoForRef").keydown(function(e) {
                if(e.which == 9) {
                  e.preventDefault();
                       var ter = $(this).val();
                      cargarInfoDisaRef(ter);
                      
                }
              });
              
              
              $("#eesS").keypress(function(e) {
                if(e.which == 13) {
                  e.preventDefault();
                      var ter = $(this).val();
                      cargarInfoDisaEEss(ter);
                      cargarProfesionSys();
                      cargarOfUnid();
                }
              });
    

              $("#eesS").keydown(function(e) {
                if(e.which == 9) {
                  e.preventDefault();
                       var ter = $(this).val();
                      cargarInfoDisaEEss(ter);
                      cargarProfesionSys();
                      cargarOfUnid();
                }
              });
              
              
              $("#eesSRef").keypress(function(e) {
                if(e.which == 13) {
                  e.preventDefault();
                      var ter = $(this).val();
                      cargarInfoDisaEEssRef(ter);
                    
                }
              });
    

              $("#eesSRef").keydown(function(e) {
                if(e.which == 9) {
                  e.preventDefault();
                       var ter = $(this).val();
                      cargarInfoDisaEEssRef(ter);
                      
                }
              });
              
              
              


                            $("#Nxuenta").keypress(function(e) {
                                if(e.which == 13) {
                                  e.preventDefault();
                                  var cunx = $(this).val();
                                 buscarCuentaEmergHospi(cunx);
                                    $("#hclinica").focus();
                                }
                              });
                    
                
                              $("#Nxuenta").keydown(function(e) {
                                if(e.which == 9) {
                                  e.preventDefault();
                                    var cunx = $(this).val();
                                  buscarCuentaEmergHospi(cunx);
                                    $("#hclinica").focus();
                                }
                            });


                            $("#cptCitoEs").keypress(function(e) {
                                if(e.which == 13) {
                                  e.preventDefault();
                                  var cunx = $(this).val();
                                  buscarDxMorf(cunx);
                                    
                                }
                              });
                    
                
                              $("#cptCitoEs").keydown(function(e) {
                                if(e.which == 9) {
                                  e.preventDefault();
                                    var cunx = $(this).val();
                                    buscarDxMorf(cunx);
                                    
                                }
                            });
                            
                            
                            $("#ctinmuno").keypress(function(e) {
                                if(e.which == 13) {
                                  e.preventDefault();
                                  var cunx = $(this).val();
                                  buscarDatosPat(cunx);
                                    
                                }
                              });
                    
                
                              $("#ctinmuno").keydown(function(e) {
                                if(e.which == 9) {
                                  e.preventDefault();
                                    var cunx = $(this).val();
                                  buscarDatosPat(cunx);
                                    
                                }
                            });
                            
                            
                              $("#mediSolicitante").keypress(function(e) {
                                if(e.which == 13) {
                                  e.preventDefault();
                                  var cunx = $(this).val();
                                  buscarEspecialidad(cunx);
                                }
                                
                              });
                              
                              
                              $("#categoria").keydown(function(e) {
                                if(e.which == 9) {
                                  e.preventDefault();
                                  var cunx = $(this).val();
                                    buscarCategoria(cunx);
                                }
                                
                              });
                    
                    
                            $("#categoria").keypress(function(e) {
                                if(e.which == 13) {
                                  e.preventDefault();
                                   var cunx = $(this).val();
                                    buscarCategoria(cunx);
                                }
                                
                              });
                              
                
                              $("#mediSolicitante").keydown(function(e) {
                                if(e.which == 9) {
                                  e.preventDefault();
                                    var cunx = $(this).val();
                                   buscarEspecialidad(cunx);
                                }
                                
                            });
                            
                            

           $("#codDx").keypress(function(e) {
            if(e.which == 13) {
              e.preventDefault();
              ObtenerCie10();
            }
          });

//
          $("#codCpt").keydown(function(e) {
            if(e.which == 9) {
              e.preventDefault();
              ObtenerCpt();
              //$("#cant").val("1");
              $("#cant").focus();
            }
          });
          
          
         /* $("#ctinmuno").keypress(function(e) {
            if(e.which == 13) {
              e.preventDefault();
                    
                    $('#11').val("453222");
                
            }
          });

//
          $("#ctinmuno").keydown(function(e) {
            if(e.which == 9) {
              e.preventDefault();
              ObtenerCpt();
              //$("#cant").val("1");
              $("#cant").focus();
            }
          }); */

          $("#codCpt").keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                e.preventDefault();
                ObtenerCpt();
                //$("#cant").val("1");
                $("#cant").focus();
            }
        });
        
        
        

          $("#dx5").keypress(function(e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            if(code==13){
                e.preventDefault();
                    var textBus = $('#dx5').val();
                    //alert(textBus)
                    if(textBus.indexOf('FISSAL') > -1){
                        $("#dx5").css("background","#26b99a");
                        $("#dx5").css("color","white");
                    }
            }
        });
        
        
        
        /*$('#dx5').keyup(function() {
            var textBus = $('#dx5').val();
            if(textBus.indexOf('FISSAL') > -1){
                $("#textBus").css("background","#26b99a");
                $("#textBus").css("color","white");
            }
            
         });*/
        
        
            $("#monGalCE").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#montSifCE").val();
                var resul = parseFloat(sel) + parseFloat(rebi);
                $("#valAte").val(parseFloat(resul).toFixed(2));

            });
            
            
            $("#montSifCE").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#monGalCE").val();
                var resul = parseFloat(sel) + parseFloat(rebi);
                $("#valAte").val(parseFloat(resul).toFixed(2));

            });


                $("#presionArterial").on({
                      "focus": function(event) {
                        $(event.target).select();
                      },
                      "keyup": function(event) {
                        $(event.target).val(function(index, value) {
                          return value.replace(/\D/g, "")
                            .replace(/([0-9])([0-9]{2})$/, '$1/$2')
                            //.replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
                        });
                      }
                });


           $("#montgal").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#montsifar").val();
                var resul = parseFloat(sel) + parseFloat(rebi);
                $("#valAteAudi").val(parseFloat(resul).toFixed(2));

            });
            
            $("#rango").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#rango2").val();
                var resul = parseInt(rebi) - parseInt(sel);
                $("#cantDesig").val(resul + 1);

            });
            
            
             $("#rango2").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#rango").val();
                var resul = parseInt(sel) - parseInt(rebi);
                $("#cantDesig").val(resul + 1);

            });
            
            
            
           $("#montsifar").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#montgal").val();
                var resul = parseFloat(sel) + parseFloat(rebi);
                $("#valAteAudi").val(parseFloat(resul).toFixed(2));

            });
            
            
            
            
            
            $("#monGal").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#montSif").val();
                var resul = parseFloat(sel) + parseFloat(rebi);
                $("#monTotalCo").val(parseFloat(resul).toFixed(2));

            });
            
            
            
           $("#montSif").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#monGal").val();
                var resul = parseFloat(sel) + parseFloat(rebi);
                $("#monTotalCo").val(parseFloat(resul).toFixed(2));

            });
            
            
            $("#monCarGar").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#monTotalCo").val();
               if(sel < rebi ){
                   $("#monCarGar").css("background","red");
                   $("#monCarGar").css("color","white");
               }else{
                   $("#monCarGar").css("background","white");
                   $("#monCarGar").css("color","black");
               }

            });
            

          $("#codCptAuto").keydown(function(e) {
            if(e.which == 9) {
              e.preventDefault();
              ObtenerCptAuto();
              $("#cantAuto").val("");
              $("#cantAuto").focus();
            }
          });

          $("#codDx").keydown(function(e) {
            if(e.which == 9) {
              e.preventDefault();
              ObtenerCie10();
            }
          });
          
          
          
              $("#asgiMed").change(function(){
                    $('#audiAsgt').val($(this).val());
              });
              
              $("#recepFau").change(function(){
                    $('#audiAsgt').val($(this).val());
              });
          
        
          $('#enviar').click(function(){
                  
                  var selected = '';
                  var uni =$("#audiAsgt").val();
            
                  if(uni==0){
                      alert("Debes seleccionar una fecha");
                  }else{
            
                        $('#formid input[type=checkbox]').each(function(){
                          if (this.checked) {
                              selected = $(this).val();
            
                                  $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=regMasivo",
                                    data:{ auditor:uni,fua:selected}
                                }).done(function(datos){               
                                    
                                  $('#pac3EmerCE').DataTable().ajax.reload(null,false);
                                  $("#asgiMed").val("");
                                  $("#alla").prop("checked", false);
                                    
                                });
                          }
                      });
                      
                      alert("Asignacion correcta");
                  }    
                  
             });
             
             
            
             
             
             $('#eliminarCheckMasivo').click(function(){
                  
                  var selected = '';
                  var uni =$("#audiAsgt").val();
            
                  var opcion = confirm("¿Estas seguro de eliminar los FUAS?");
                    if (opcion == true) {
                        
                          $('#formid input[type=checkbox]').each(function(){
                          if (this.checked) {
                              selected = $(this).val();
            
                                  $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=deleteFuasMasivo",
                                    data:{ auditor:uni,fua:selected}
                                }).done(function(datos){               
                                    
                                  $('#pac3EmerCE').DataTable().ajax.reload(null,false);
                                  $("#asgiMed").val("");
                                  $("#alla").prop("checked", false);
                                    
                                });
                          }
                      });
                      alert("Eliminacion correcta");
                      
                	} else {
                	    //alert("Has clickado Cancelar");
                	}
                      
                      
                      
                  
             }); 
             
             
              $('#enviarRecp').click(function(){
                  
                  var selected = '';
                  var uni =$("#audiAsgt").val();
            
                  if(uni==0){
                      alert("Debes seleccionar una fecha");
                  }else{
            
                        $('#formid input[type=checkbox]').each(function(){
                          if (this.checked) {
                              selected = $(this).val();
            
                                  $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=regMasivoRec",
                                    data:{ auditor:uni,fua:selected}
                                }).done(function(datos){               
                                    
                                  $('#pac3EmerCE').DataTable().ajax.reload(null,false);
                                  $("#recepFau").val("");$("#allr").prop("checked", false);
                                    
                                });
                          }
                      });
                      alert("Asignacion correcta");
                  }    
                  
             });


        
            
            $("#alla").on("click", function() {
              $(".allasig").prop("checked", this.checked);
            });
            
            
            
            $("#allr").on("click", function() {
            
              $(".allrecep").prop("checked", this.checked);
            });
          
          
          

          $("#desCpt").keydown(function(e) {
              
            if(e.which ==9) {
              e.preventDefault();
              ObtenerDesx();
              $("#cant").val("1");
              $("#cant").focus();
            }

            
          });

          $("#desCpt").keypress(function(e) {
              
            if(e.which ==13) {
              e.preventDefault();
              ObtenerDesx();
              $("#cant").val("1");
              $("#cant").focus();
            }

            
          });



          $("#desCptAuto").keydown(function(e) {
              
            if(e.which ==9) {
              e.preventDefault();
              ObtenerDesxAut();
              $("#cantAuto").val("");
              $("#cantAuto").focus();
            }

            
          });

          

          $("#codSismed").keydown(function(e) {
            if(e.which == 9) {
              e.preventDefault();
              ObtenerIns();
              $("#cantIn").val("");
              $("#cantIn").focus();
            }
          });

          $("#codSismedAuto").keydown(function(e) {
            if(e.which == 9) {
              e.preventDefault();
              ObtenerInsAuto();
              $("#cantInAuto").val("");
              $("#cantInAuto").focus();
            }
          });

          $("#codSisMx").keydown(function(e) {
            if(e.which == 9) {
              e.preventDefault();
              ObtenerMed();
              $("#cantMed").val("");
              $("#cantMed").focus();
            }
          });


          $("#codSisMxAuto").keydown(function(e) {
            if(e.which == 9) {
              e.preventDefault();
              ObtenerMedAuto();
              $("#cantMedAuto").val("");
              $("#cantMedAuto").focus();
            }
          });

          $("#cargaDniAuto").click(function(){
                            
            $.ajax({
                url:'services.php',
                type:'GET',
                dataType:'json',
                data:{ NroDoc:$('#nrodoc').val()             
            },                    
            }).done(function(datos){
                
                if(datos[2]==""){
                        alert("Datos no encontrados");
                }else{
                    $("#apepaterno").val(datos[0]);
                    $("#apematerno").val(datos[1]);
                    $("#nombres").val(datos[2]);                    
                }
                
            });
        });
    

          $("#cant").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#valor").val();
                var resul = parseInt(sel) * parseFloat(rebi);
                $("#totalp").val(parseFloat(resul).toFixed(2));
               // $("#GuardarPaciente1").focus();

          });
          
          $("#cantAuto").keyup(function(){
            var sel = $(this).val();
            var rebi = $("#valorAuto").val();
            var resul = parseInt(sel) * parseFloat(rebi);
            $("#totalpAuto").val(parseFloat(resul).toFixed(2));

            });

          $("#cantIn").keyup(function(){
            var sel = $(this).val();
            var rebi = $("#valori").val();
            var resul = parseInt(sel) * parseFloat(rebi);
            $("#totali").val(parseFloat(resul).toFixed(2));

            });


            $("#cantInAuto").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#valoriAuto").val();
                var resul = parseInt(sel) * parseFloat(rebi);
                $("#totaliAuto").val(parseFloat(resul).toFixed(2));
    
                });

            $("#cantMed").keyup(function(){
                var sel = $(this).val();
                var rebi = $("#valoriMed").val();
                var resul = parseInt(sel) * parseFloat(rebi);
                $("#totalm").val(parseFloat(resul).toFixed(2));

          });

          $("#cantMedAuto").keyup(function(){
            var sel = $(this).val();
            var rebi = $("#valoriMedAuto").val();
            var resul = parseInt(sel) * parseFloat(rebi);
            $("#totalmAuto").val(parseFloat(resul).toFixed(2));

        });


            $("#NroDoc").keydown(function(e) {
                if(e.which == 9) {
                             e.preventDefault();
                            
                           //buscarDniEm();
                             $("#nombres").focus(); 
                    
                                var tipoDoc = '';
                                if($("#tipoDoc").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDoc").val();
                                }
                             var mutr = $(this).val();
                             webServiceSis2(mutr,tipoDoc); 
                    }
            });


            $("#NroDoc").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    
                   // buscarDniEm();
                    $("#nombres").focus();
                    var tipoDoc = '';
                                if($("#tipoDoc").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDoc").val();
                                }
                    var mutr = $(this).val();
                    webServiceSis2(mutr,tipoDoc);
                    
                }
            });
            
            
            
            
            $("#nroDocCiru").keydown(function(e) {
                if(e.which == 9) {
                             e.preventDefault();
                                var tipoDoc = '';
                                if($("#tipoDocCiru").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDocCiru").val();
                                }
                             var mutr = $(this).val();
                             webServiceSisCiru(mutr,tipoDoc); 
                    }
            });


            $("#nroDocCiru").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    var tipoDoc = '';
                                if($("#tipoDocCiru").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDocCiru").val();
                                }
                    var mutr = $(this).val();
                    webServiceSisCiru(mutr,tipoDoc);
                    
                }
            });
            
            
            
            $("#nroDocPato").keydown(function(e) {
                if(e.which == 9) {
                             e.preventDefault();
                                var tipoDoc = '';
                                if($("#tipoDocPato").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDocPato").val();
                                }
                             var mutr = $(this).val();
                             webServiceSisPato(mutr,tipoDoc); 
                    }
            });


            $("#nroDocPato").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    var tipoDoc = '';
                                if($("#tipoDocPato").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDocPato").val();
                                }
                    var mutr = $(this).val();
                    webServiceSisPato(mutr,tipoDoc);
                    
                }
            });
            
            
            $("#NroDocRef").keydown(function(e) {
                if(e.which == 9) {
                             e.preventDefault();
                            
                           //buscarDniEm();
                             $("#nombres").focus(); 
                    
                                var tipoDoc = '';
                                if($("#tipoDocRef").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDocRef").val();
                                }
                             var mutr = $(this).val();
                             webServiceSis2Ref(mutr,tipoDoc); 
                    }
            });


            $("#NroDocRef").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    
                   // buscarDniEm();
                    $("#nombres").focus();
                    var tipoDoc = '';
                                if($("#tipoDocRef").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDocRef").val();
                                }
                    var mutr = $(this).val();
                    webServiceSis2Ref(mutr,tipoDoc);
                    
                }
            });
            
            
            
            $("#cuenta").keydown(function(e) {
                if(e.which == 9) {
                             e.preventDefault();
                        
                             var mutr = $(this).val();
                             webServiceCuenta(mutr); 
                    }
            });


            $("#cuenta").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                  
                    var mutr = $(this).val();
                    webServiceCuenta(mutr); 
                }
            });
            
            
           
            
            
            $("#dniQuimi").keydown(function(e) {
                if(e.which == 9) {
                             e.preventDefault();
                             dniQuimi();
                    }
            });


            $("#dniQuimi").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    dniQuimi();
                }
            });
            
            
            $("#NroDocCE").keydown(function(e) {
            if(e.which == 9) {
                         e.preventDefault();
                         buscarDniEmCE();
                         $("#ubicacionCE").focus();
              
                }
            });


            $("#NroDocCE").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    buscarDniEmCE();
                    $("#ubicacionCE").focus();
                }
            });
            
            
            $("#NroDocRefRes").keydown(function(e) {
                    if(e.which == 9) {
                                 e.preventDefault();
                                 var doc = $(this).val();
                                 buscarDniEmCERef(doc,"#personalResRef");
                                 $("#profesionRefRes").focus();
                      
                        }
                    });


            $("#NroDocRefRes").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                            var doc = $(this).val();
                            buscarDniEmCERef(doc,"#personalResRef");
                            $("#profesionRefRes").focus();
                }
            });
            
            
            
            $("#NroDocRefResAcompa").keydown(function(e) {
                    if(e.which == 9) {
                                 e.preventDefault();
                                 var doc = $(this).val();
                                 buscarDniEmCERef(doc,"#personalResRefAcompa");
                                 $("#profesionRefResAcompa").focus();
                      
                        }
                    });


            $("#NroDocRefResAcompa").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                            var doc = $(this).val();
                            buscarDniEmCERef(doc,"#personalResRefAcompa");
                            $("#profesionRefResAcompa").focus();
                }
            });
            
            
            
            
            
            
            
            
     
            
            $("#teleusu").keydown(function(e) {
            if(e.which == 9) {
                         e.preventDefault();
                         buscarDniEmCEUser();
                         $("#emailusu").focus();
              
                }
            });


            $("#teleusu").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    buscarDniEmCEUser();
                    $("#emailusu").focus();
                }
            });
            
            /*  */


            $("#fuaCE").keydown(function(e) {
            if(e.which == 9) {
                         e.preventDefault();
                         buscarRepetido();
                         $("#hisCliCE").focus();
                }
            });

            $("#fuaCE").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    buscarRepetido();
                    $("#hisCliCE").focus();
                }
            });


           $("#dni").keydown(function(e) {
            if(e.which == 9) {
                         e.preventDefault();
                         buscarDniCpms();
                         $("#servicio").focus();
              
                }
            });
            
            
             $("#dni").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    buscarDniCpms();
                    $("#servicio").focus();
                }
            });


            $("#codPreHos").keydown(function(e) {
            if(e.which == 9) {
                         e.preventDefault();
                         cargaDenominacion();
                         $("#ubiSerHosp").focus();   
                }
            });
            
            $("#codPreHos").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    cargaDenominacion();
                    $("#ubiSerHosp").focus();   
                }
            });
            
            //INSERT TABLAS
            
                    
                                $("#insertDxHisto").click(function(){
                                    
                                    
                                    // signos y sintomas
            
                                     $('#tbl_sin tr').each(function () {
                                      var descripDx= $(this).find('input').eq(0).val();
                                      var tipoDx = $(this).find('select').eq(0).val();
                                      var idHis = $("#ideHisto").val();
                                      var iduser = $("#iduser").val();
                                    
                                    
                                     $.ajax({
                                          async: false,
                                          type: "POST",
                                          url: "./Controlador/controllerProcedimientos.php?function=insertSignosSintomas",
                                          data: "descripDx="+descripDx+"&tipoDx="+tipoDx+"&idHis="+idHis+"&iduser="+iduser,
                                           success: function(data) { if(data!="");}
                                    
                                          });
                                    });
                                
                                // FIN DX
                            
                            
                                // DX HISTORIA
            
                                     $('#tbl_dx tr').each(function () {
                                      var descripDx= $(this).find('input').eq(0).val();
                                      var tipoDx = $(this).find('select').eq(0).val();
                                      var idHis = $("#ideHisto").val();
                                      var iduser = $("#iduser").val();
                                    
                                    
                                     $.ajax({
                                          async: false,
                                          type: "POST",
                                          url: "./Controlador/controllerProcedimientos.php?function=insertDxHistoria",
                                          data: "descripDx="+descripDx+"&tipoDx="+tipoDx+"&idHis="+idHis+"&iduser="+iduser,
                                           success: function(data) { if(data!="");}
                                    
                                          });
                                    });
                                
                                // FIN DX
                                
                                
                                 // TRATAMIENTO HISTORIA
            
                                     $('#tbl_trat tr').each(function () {
                                      var descripDx= $(this).find('input').eq(0).val();
                                      var tipoDx = $(this).find('input').eq(1).val();
                                      var idHis = $("#ideHisto").val();
                                      var iduser = $("#iduser").val();
                                    
                                    
                                     $.ajax({
                                          async: false,
                                          type: "POST",
                                          url: "./Controlador/controllerProcedimientos.php?function=insertTratHistoria",
                                          data: "descripDx="+descripDx+"&tipoDx="+tipoDx+"&idHis="+idHis+"&iduser="+iduser,
                                           success: function(data) { if(data!="");}
                                    
                                          });
                                    });
                                
                                // FIN TRATAMIENTO
                                
                                // EXAMENES HISTORIA
                                            
                                                //PROCEDIMIENTOS
                                                
                                                 $('#tbl_pro tr').each(function () {
                                                     
                                                      var descripDx= $(this).find('input').eq(0).val();
                                                      var tipoDx = "1";
                                                      var idHis = $("#ideHisto").val();
                                                      var iduser = $("#iduser").val();
                                                
                                                
                                                      $.ajax({
                                                          async: false,
                                                          type: "POST",
                                                          url: "./Controlador/controllerProcedimientos.php?function=insertExamenesAuxi",
                                                          data: "descripDx="+descripDx+"&tipoDx="+tipoDx+"&idHis="+idHis+"&iduser="+iduser,
                                                           success: function(data) { if(data!="");}
                                                
                                                      });
                                                      
                                                });
                                                
                                                //FIN PRO
                                                
                                                
                                                //LABORATORIO
                                                
                                                 $('#tbl_lab tr').each(function () {
                                                     
                                                      var descripDx= $(this).find('input').eq(0).val();
                                                      var tipoDx = "2";
                                                      var idHis = $("#ideHisto").val();
                                                      var iduser = $("#iduser").val();
                                                
                                                
                                                      $.ajax({
                                                          async: false,
                                                          type: "POST",
                                                          url: "./Controlador/controllerProcedimientos.php?function=insertExamenesAuxi",
                                                          data: "descripDx="+descripDx+"&tipoDx="+tipoDx+"&idHis="+idHis+"&iduser="+iduser,
                                                           success: function(data) { if(data!="");}
                                                
                                                      });
                                                      
                                                });
                                                
                                                //FIN LAB
                                                
                                                //IMAGENES
                                                
                                                 $('#tbl_img tr').each(function () {
                                                     
                                                      var descripDx= $(this).find('input').eq(0).val();
                                                      var tipoDx = "3";
                                                      var idHis = $("#ideHisto").val();
                                                      var iduser = $("#iduser").val();
                                                
                                                
                                                      $.ajax({
                                                          async: false,
                                                          type: "POST",
                                                          url: "./Controlador/controllerProcedimientos.php?function=insertExamenesAuxi",
                                                          data: "descripDx="+descripDx+"&tipoDx="+tipoDx+"&idHis="+idHis+"&iduser="+iduser,
                                                           success: function(data) { if(data!="");}
                                                
                                                      });
                                                      
                                                });
                                                
                                                //FIN IMG
                                                
                                                
                                                
                                
                                // FIN EXAMENES
                                
                                
                        
                        
                    });
                    
                    
            // FIN DE INSERT
            
            
            
    
        $("#cargarcie10").click(function(){
            
            cie19();
        });


            $("#cie10").keydown(function(e) {
                if(e.which == 9) {
                  e.preventDefault();
                  cie19();
                  $("#feinicio").focus();
                  
                }
            });


            $("#cie10").keypress(function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code==13){
                    e.preventDefault();
                    cie19();
                    $("#feinicio").focus();
                }
            });
            
            


          $("#mediSolicitante").autocomplete({
            
            source: "./Controlador/search.php?function=medicoSolicitante",
            minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
            
           }); 
           
           
           $("#codigoFor").autocomplete({
            
            source: "./Controlador/search.php?function=codigoFor",
            minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
            
           }); 
           
           
            $("#codigoForRef").autocomplete({
            
            source: "./Controlador/search.php?function=codigoFor",
            minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
            
           }); 
           
           $("#eesS").autocomplete({
            
            source: "./Controlador/search.php?function=eesS",
            minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
            
           }); 
           
           $("#eesSRef").autocomplete({
            
            source: "./Controlador/search.php?function=eesS",
            minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
            
           }); 
           
           
           $("#tesjidoPat").autocomplete({
            
           /* source: "./Controlador/search.php?function=tejidoOrgan",
            minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }*/
                
                 source: function(request, response) {
                
                        $.ajax({
                                url: './Controlador/search.php?function=tejidoOrganMues',
                                dataType:'json',
                                data: {
                                    cat: $('#idtipoEstPat').val(),
                                    term: request.term
                                },
                                
                              success: function (data){
                                  response(data);
                               }
                               
                            });
                        }
            
        
           }); 
           
           
           $("#rotulo").autocomplete({
        
                
            source: function(request, response) {
                
                    $.ajax({
                            url: './Controlador/search.php?function=tejidoOrgan',
                            dataType:'json',
                            data: {
                                cat: $('#idcateg').val(),
                                term: request.term
                            },
                            
                          success: function (data){
                              response(data);
                           }
                           
                        });
                    }
        
           }); 
           
           
           
           
           
          
        
        
           
           $("#categoria").autocomplete({
            
            source: "./Controlador/search.php?function=listCategoria",
            minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
            
           }); 
           
           
           
           
           
           $("#desCpt").autocomplete({
            
            source: "./Controlador/search.php?function=autocie10",
            minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
            
           }); 
           
           $("#essHos").autocomplete({
            
            source: "./Controlador/search.php?function=listIpress",
            minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                    
                }
            
           }); 
           
           
           
           
           
           $("#dxDescricon").autocomplete({
            
            source: "./Controlador/search.php?function=dxDesc",
            minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                }
            
           }); 
           
           
            $("#eess").autocomplete({
            
                    source: "./Controlador/search.php?function=listIpress",
                    minLength: 1,
                        select: function( event, ui ) {
                            event.stopPropagation();
                        }
            
           }); 
           
           
           $("#liquIx").on( 'change', function() {
                    if( $(this).is(':checked') ) {
                        
                        $("#idUserLiquida").val($("#iduser").val());
                    }else{
                        $("#idUserLiquida").val("");
                    }
            });
           
           $("#eessRefModal").autocomplete({
            
                    source: "./Controlador/search.php?function=listIpress",
                    minLength: 1,
                        select: function( event, ui ) {
                            event.stopPropagation();
                        }
            
           }); 
           
           
            $("#eesRef").autocomplete({
            
                    source: "./Controlador/search.php?function=listIpress",
                    minLength: 1,
                        select: function( event, ui ) {
                            event.stopPropagation();
                        }
            
           }); 
           
           
           
           $("#rsatencion").autocomplete({
            
                    source: "./Controlador/search.php?function=listRsatencion",
                    minLength: 1,
                        select: function( event, ui ) {
                            event.stopPropagation();
                        }
            
           }); 
           
            $("#serEspecia").autocomplete({
            
                    source: "./Controlador/search.php?function=listSerEspecia",
                    minLength: 1,
                        select: function( event, ui ) {
                            event.stopPropagation();
                        }
            
           }); 
           
           
           
           $("#eessInicio").autocomplete({
            
                source: "./Controlador/search.php?function=listIpress",
                minLength: 1,
                    select: function( event, ui ) {
                        event.stopPropagation();
                    }
            
           }); 
           
           $("#registraAlta").autocomplete({
            
                source: "./Controlador/search.php?function=listRegistraAlta",
                minLength: 1,
                    select: function( event, ui ) {
                        event.stopPropagation();
                    }
            
           }); 
           
           
           
           $("#dx1").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
           $("#dxcie10").autocomplete({
                
                source: "./Controlador/search.php?function=busquedaDx",
                minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                }
           }); 
           
           $("#dxpreop").autocomplete({
                
                source: "./Controlador/search.php?function=busquedaDx",
                minLength: 1,
                select: function( event, ui ) {
                    event.stopPropagation();
                }
           }); 
           
           
           
           
           
           $("#filaDx2").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
            $("#dx2").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
            $("#dx3").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
           
            $("#dx4").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
            $("#dx5").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
           
           $("#dx6").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
           
           $("#dx7").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
           
           
           $("#dx8").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
           $("#dx9").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
           $("#dx10").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
           $("#dxAudito").autocomplete({
            
                    source: "./Controlador/search.php?function=busquedaDx",
                    minLength: 1,
                    select: function( event, ui ) {
                        event.stopPropagation();
                        
                    }
            
           }); 
           
           
           $("#cie10_1x").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
            }
            
           }); 
           
           
           $("#cie10_2x").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
            }
            
           }); 
           
           
           $("#cie10_3x").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
            }
            
           }); 
           
            $("#cie10_4x").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
            }
            
           }); 
           
            $("#cie10_5x").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
            }
            
           }); 
           
           
            $("#feProcQ").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
           
           
           
           
            $("#cie102Qui").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
            $("#cie103Qui").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
           
            $("#cie104Qui").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
            }
            
           }); 
           
            $("#cie105Qui").autocomplete({
            
            source: "./Controlador/search.php?function=busquedaDx",
            minLength: 1,
            select: function( event, ui ) {
                event.stopPropagation();
                
                
            }
            
           }); 
           

           $("#desCptAuto").autocomplete({

            source: "./Controlador/search.php?function=autocie10",
            
            minLength: 1,
            select: function( event, ui ) {
                 return false;
            }
            
           });

         /* $("#servicio").autocomplete({
            
            source: "./Controlador/search.php?function=servicioPabellonAuto",
            minLength: 1,
            select: function( event, ui ) {
                    event.stopPropagation();
            }
            
           }); */

           $("#descripcion").autocomplete({

            source: "./Controlador/search.php?function=dxdes",
            
            minLength: 1,
            select: function( event, ui ) {
                 return false;
            }
            
           });


           $("#descripcion").keydown(function(e) {
            if(e.which == 9) {
              e.preventDefault();
               cieDesc();
              //$("#feinicio").focus();
              
            }
            });

           $("#producto").autocomplete({

            source: "./Controlador/search.php?function=consultorio",            
            minLength: 1,
            select: function( event, ui ) {
                 return false;
            }
            
           }); 


           $("#productoX").autocomplete({

            source: "./Controlador/search.php?function=consultorio",            
            minLength: 1,
            select: function( event, ui ) {
                 return false;
            }
            
           }); 

            $("#tipoSeg").change(function() {
                var idDis = $("#tipoSeg").val();	
                $("#iafa").html('');
                cargarTipoAf(idDis);
            });
            

            $("#hallazgo").change(function() {
                var idDis = $("#hallazgo").val();
                cargarListSistemaReporte(0,idDis);
            });

            
            $("#sisReporEspex").change(function() {
                var idDis = $("#sisReporEspex").val();
                cargarListClasificacion(0,idDis);
            });

            $("#tipoServicoPatl").change(function() {
                var idDis = $("#tipoServicoPatl").val();	
                cargarTipoServicioPatSer(idDis,0);
            });
            
            
            $("#selecConvenio").change(function() {
                var idDis = $("#selecConvenio").val();
                
                if(idDis=="2"){
                    $("#lblcon").removeClass("hidden");
                    $("#cmapconDiv").removeClass("hidden");
                     cargarConvenioPatSer(idDis,0); 
                }else{
                  
                    $("#lblcon").addClass("hidden");
                    $("#cmapconDiv").addClass("hidden");
                }
                
            });
            
            $("#nomApeConfir").change(function() {
                var idDis = $("#nomApeConfir").val();	
                cargarColegiatura(idDis);
            });
            
             $("#categoria").change(function() {
                var idDis = $("#categoria").val();	
                buscarCategoria(idDis);
            });
            
            
            
            
            
            $("#listMetodoAnti").change(function() {
                var idDis = $("#listMetodoAnti").val();	
                        
                        if(idDis==1){
                            $("#viewMetdo").removeClass("hidden");
                        }else{
                             $("#viewMetdo").addClass("hidden");
                        }
                    
            });
            
            
            
            $("#anaMuestraCito").change(function() {
                var idDis = $("#anaMuestraCito").val();	
                        
                        if(idDis==2){
                            $("#viewHistoUmn").removeClass("hidden");
                        }else{
                             $("#viewHistoUmn").addClass("hidden");
                        }
                    
            });
            
            
            $("#intesTincion").change(function() {
                var idDis = $("#intesTincion").val();	
                     buscarIntensi(idDis);
            });
            
            
            
            
            $("#resulDepend").change(function() {
                var idDis = $("#resulDepend").val();	
                     if(idDis==11){
                         $("#otrosHi").removeClass("hidden");
                         $("#lblOtroHx").text("ESPECIFICAR");
                         
                     }else{
                         $("#otrosHi").addClass("hidden");
                         $("#lblOtroHx").text("OTROS");
                     }
            });
            
            
            
            $("#tipoEstPat").change(function() {
                var idDis = $("#tipoEstPat").val();
                var dsIt = $("#procePat").val();
                
                     if(idDis==1){
                         $("#paso2").removeClass("hidden");
                         $("#paso3").removeClass("hidden");
                         $("#paso3").addClass("hidden");
                         $("#no4").text("4");
                         $("#lblInformCi").text("Informe");
                         
                         $("#no4").text("4");
                         $("#lblInformCi").text("Informe");
                         $("#paso2").removeClass("hidden");
                         $("#paso3").removeClass("hidden");
                         $("#analisisMuestraSiCito").addClass("hidden");

                        $("#titleSocpia").text("Macroscopia");
                        $("#titleCortus").text("CORTES");
                        $("#titleTxus").text("N° TACOS");
                        $("#laHisto").text("LABORATORIO HISTOPATOLOGIA");
                        $("#plInlc").removeClass("hidden");
                        $("#lblTitlepl").text("CORTE");
                        $("#lblMacroHis").text("MACROSCOPIA");
                        $("#tblObsMic").removeClass("hidden");
                        $("#tblRsptaMic").removeClass("hidden");
                        $(".verDetailObsM").removeClass("hidden");
                        $(".veDetailRspta").removeClass("hidden");
                         
                         $("#acordeonObsMic").removeClass("hidden");
                          $("#acordeonRsptaMic").removeClass("hidden");
                          $(".dentroAcorde1").removeClass("hidden");
                          $(".dentroAcorde2").removeClass("hidden");
                         CargarTacosPat(1,1);
                         $("#elexTaco").text("ELEGIR TACOS");
                         $("#tileUbs").text("TACOS");
                          $(".tileInclTax").text("TACOS");
                          $("#titleMoal").text("MACROSCOPIA");
                         $("#tipoDecrp").val("");
                         
                         
                     }else{
                         
                          $("#no4").text("2");
                          $("#lblInformCi").text("Informe");
                          $("#paso2").addClass("hidden");
                          $("#paso3").addClass("hidden");
                          $("#paso4").removeClass("hidden");
                         
                     }
            });
            
             $("#procePat").change(function() {
                var idDis = $("#procePat").val();
                var tipoEstPat = $("#tipoEstPat").val();
                
                        buscarCorrelPatf(tipoEstPat,idDis);
                
                      if(idDis==13 && tipoEstPat==2){
                         
                         //alert("ALERTA");
                         $("#no4").text("3");
                         $("#lblInformCi").text("Informe Citológico");
                         $("#paso2").removeClass("hidden");
                          $("#paso3").addClass("hidden");
                          $("#paso4").removeClass("hidden");
                          $("#analisisMuestraSiCito").removeClass("hidden");
                          
                          $("#titleSocpia").text("Laboratorio");
                          $("#titleCortus").text("COLORACION");
                          $("#titleTxus").text("LAMINAS");
                          $("#laHisto").text("FASES");
                           $("#plInlc").addClass("hidden");
                           $("#lblTitlepl").text("ROTULACION");
                          $("#lblMacroHis").text("LABORATORIO");
                          
                          $("#tblObsMic").addClass("hidden");
                          $("#tblRsptaMic").addClass("hidden");
                          $(".verDetailObsM").addClass("hidden");
                          $(".veDetailRspta").addClass("hidden");
                          $("#tipoDecrp").val("3");
                         
                          $("#acordeonObsMic").addClass("hidden");
                          $("#acordeonRsptaMic").addClass("hidden");
                          $(".dentroAcorde1").addClass("hidden");
                          $(".dentroAcorde2").addClass("hidden");
                          //CargarRotulosPat(1,4);
                          CargarRotulosPatCervico();
                          CargarTacosPat(3,3);
                          CargarRotulosHistoquiCervicoVaginal(3,3)
                          $("#elexTaco").text("ELEGIR LAMINA");

                          $("#tileUbs").text("LAMINA");
                          $("#txtPequ").text("Marque las láminas que desee analizar.");
                          $(".tileInclTax").text("LAMINA");
                          $("#viewCorte").removeClass("hidden");
                          $("#titleMoal").text("LABORATORIO");
                          $("#espcialx").removeClass("hidden");
                          $("#divcalidadMuesCitoEsp").addClass("hidden");
                         
                         
                     } else if(idDis >= 1 && tipoEstPat== 1 || idDis <= 12 && tipoEstPat== 1  ){
                         
                            $("#no4").text("4");
                            $("#lblInformCi").text("Informe");
                            $("#paso2").removeClass("hidden");
                            $("#paso3").removeClass("hidden");
                            $("#paso4").addClass("hidden");
                            $("#analisisMuestraSiCito").addClass("hidden");
                            $("#titleSocpia").text("Macroscopia");
                            $("#titleCortus").text("CORTES");
                            $("#titleTxus").text("N° TACOS");
                            $("#laHisto").text("LABORATORIO HISTOPATOLOGIA");
                            $("#plInlc").removeClass("hidden");
                            $("#lblTitlepl").text("CORTE");
                            $("#lblMacroHis").text("MACROSCOPIA");
                            $("#tblObsMic").removeClass("hidden");
                            $("#tblRsptaMic").removeClass("hidden");
                            $(".verDetailObsM").removeClass("hidden");
                            $(".veDetailRspta").removeClass("hidden");
                            
                            $("#acordeonObsMic").removeClass("hidden");
                            $("#acordeonRsptaMic").removeClass("hidden");
                            $(".dentroAcorde1").removeClass("hidden");
                            $(".dentroAcorde2").removeClass("hidden");
                            CargarTacosPat(1);
                            $("#elexTaco").text("ELEGIR TACOS");
                            $("#tileUbs").text("TACOS");
                            $(".tileInclTax").text("TACOS");
                            $("#titleMoal").text("MACROSCOPIA");
                            $("#txtPequ").text("Marque los tacos que desee analizar.");
                            $("#viewCorte").removeClass("hidden");
                            $("#espcialx").removeClass("hidden");
                            $("#divcalidadMuesCitoEsp").addClass("hidden");
                         
                     }
                     
                     else if(idDis > 13 && tipoEstPat== 2 ){
                         
                            $("#no4").text("4");
                            $("#lblInformCi").text("Informe");
                            $("#paso2").removeClass("hidden");
                            $("#paso3").removeClass("hidden");
                            $("#paso4").addClass("hidden");
                            $("#analisisMuestraSiCito").addClass("hidden");
                            $("#titleSocpia").text("Macroscopia");
                            $("#titleCortus").text("CORTES");
                            $("#titleTxus").text("N° LAMINAS");
                            $("#viewCorte").addClass("hidden");
                            $("#laHisto").text("FASES");
                            $("#plInlc").addClass("hidden");
                            $("#lblTitlepl").text("CENTRIFUGACION");
                            $("#lblMacroHis").text("MACROSCOPIA");
                            $("#tblObsMic").removeClass("hidden");
                            $("#tblRsptaMic").removeClass("hidden");
                            $(".verDetailObsM").removeClass("hidden");
                            $(".veDetailRspta").removeClass("hidden");
                            
                            $("#acordeonObsMic").removeClass("hidden");
                            $("#acordeonRsptaMic").removeClass("hidden");
                            $(".dentroAcorde1").removeClass("hidden");
                            $(".dentroAcorde2").removeClass("hidden");
                            CargarTacosPat(1);
                            $("#elexTaco").text("ELEGIR LAMINAS");
                            $("#tileUbs").text("LAMINAS");
                            $(".tileInclTax").text("LAMINAS");
                            $("#titleMoal").text("MACROSCOPIA");
                            $("#txtPequ").text("Marque las laminas que desee analizar.");
                            $("#espcialx").addClass("hidden");
                            $("#divcalidadMuesCitoEsp").removeClass("hidden");
                         
                     }
                     
                     
                     
            });
            
            
            $("#nucleosPos").change(function() {
                var idDis = $("#nucleosPos").val();	
                     buscarPorceNucle(idDis);
            });
            
            
        
            $("#rotulo").change(function() {
                var idDis = $(this).val();
                $("#plantillaApe").html('');
                var procePat = $("#procePat").val();
                if(procePat==13){
                     cargarListPlantilla(0,idDis,3);
                }else{
                    cargarListPlantilla(0,idDis,1);
                }
                
            });
            
            
            $("#plantillaApe").change(function() {
                var idDis = $(this).val();
                var tip = $("#tipoDecrp").val();
                asignarPlantillaPre(idDis,tip);
            });
            
            
            
            $("#financia").change(function() {
                var idDis = $("#financia").val();
                
                if(idDis!=3){
                    $("#seguros").html('');
                    cargarIafasEm(0,idDis);
                    
                }else if(idDis ==3 || idDis ==4 ){
                    
                    $("#seguros").html('');
                    cargarIafasEm(0,idDis); 
                    cargarAseguradoras(0,idDis);
                    
                }
                else{
                    $("#seguros").html('');
                    cargarAseguradoras(0,idDis);
                }
                
                
            });
            
             $("#actividadAudit").change(function() {
                var idDis = $("#actividadAudit").val();
                
                    $("#proceAuditoria").html('');
                    cargarActividadProc(0,idDis);
               
            });
            
            $("#seguros").change(function() {
                var idDis = $("#seguros").val();	
                $("#regim").html('');
                cargarRegimen(0,idDis);
            });
            
            
            $("#cagoocu").change(function() {
                
                var idCargo = $("#cagoocu").val();	
                var idEst = $("#idEstabel").val();
                console.log(idEst);
                    if(idEst!="478"){
                         countDuplicadoCargo(idCargo,idEst);
                         console.log("ENTRO");
                    }
               
                
            });
            
            
             $("#regim").change(function() {
                var idDis = $("#regim").val();	
                $("#planSal").html('');
                cargarPlanSalud(0,idDis);
            });
            
             $("#tipoEstPat").change(function() {
                var idDis = $("#tipoEstPat").val();
                $("#procePat").html('');
                cargarprocePat(idDis,0);
               // buscarCorrelPatf(idDis);
                cargarListCategoria(idDis);
                
                
            });
            

            
             $("#planSal").change(function() {
                var idDis = $("#planSal").val();
                var tipoDoc = $("#tipoDoc").val();
                var NroDoc = $("#NroDoc").val();
               
                    if(idDis =="21" && tipoDoc=="DNI" || idDis =="22" && tipoDoc=="DNI" ){
                        $("#NroAf").val("2-"+ NroDoc);
                    }else if(tipoDoc=="Carnet Ext." && idDis =="21" ){
                        $("#NroAf").val("3-"+ NroDoc);
                    }else if(tipoDoc=="Sin Doc." && idDis =="22"){
                        $("#NroAf").val("E-"+ NroDoc);
                    }
                    
               
            });
            
            
             $("#ubicacion").change(function() {
                var idDis = $("#ubicacion").val();	
                $("#tipoSeiN").html('');
                cargarTipoSerIng(0,idDis);
            });
            
             $("#ubicacionHosX").change(function() {
                var idDis = $("#ubicacionHosX").val();	
                $("#tipoSeiNHosx").html('');
                cargarTipoSerIngHos(0,idDis);
            });
            
             $("#ubicacionDes").change(function() {
                var idDis = $("#ubicacionDes").val();	
                $("#tipoSeiNDes").html('');
                cargarTipoSerDest(0,idDis);
            });
            
            
        
            $("#ocupQui").change(function() {
                var idDis = $("#ocupQui").val();	
                $("#asiAudiQa").empty();
                cargarAuditorQuimio(idDis);
            });
             

}

// FIN LOAD WINDOWS SCARTE

            function eraseAlta(){
                
                $('#espost').val("");
                $('#ubicacionDes').val("");
                $('#tipoSeiNDes').val("");
                $('#feAltaAlt').val("");
                $('#monGal').val("");
                $('#montSif').val("");
                $('#monTotalCo').val("");
                $('#eess').val("");
                $('#rsatencion').val("");
                $('#fuaEntre').val("");
                $('#fechaFuaEntre').val("");
                $('#reciAudit').val("");
                $('#tipoLiqux').val("");
                $('#liquIx').prop('checked',false);
                $('#idUserLiquida').val("");
                $('#pab2Hos').val("");
                $('#camHos2').val("");
                $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Campos liberados"
                  });
                
                
            }
            
            function RegistrarReferenciasHistoria(){
                
               var info = $("#formReferencias").serialize();
                
                $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=RegistrarReferenciasHistoria",
                        data: info,
                        success: function(resp){               
                           
            
                                $('#formReferencias')[0].reset();                
                                $('#cerrarReferenciaModal').click();
                                $('#tableReferenciasXd').DataTable().ajax.reload(null, false);
                            
                        }
                        
                        
                    });
                
                
            }
            
            
            function RegistrarBorrador(){
                
              
                
                var info = $("#formReferencias").serialize();
                
                $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=RegistrarReferenciasHistoriaTemporal",
                        data: info,
                        success: function(resp){               
                           
            
                                $('#formReferencias')[0].reset();                
                                $('#cerrarReferenciaModal').click();
                                //$('#tableReferenciasXd').DataTable().ajax.reload(null, false);
                                location.reload();
                        }
                        
                        
                    });
                
                
            }
                        
            
             function RegistrarEvaluacionRef(id){
                
                                 
                                /* 
                                 $('#cerrarEvalRef').click();
                                 $.NotificationService.showInfoNotification({
                                              title:"Mensaje",
                                              message:"Los cambios se guardaron correctamente"
                                  }); */
                                  
                  
                   var info = $("#formEvalReferen").serialize();
                
                    $.ajax({
                            type: "POST",
                            dataType: 'html',
                            url: "./Controlador/controllerProcedimientos.php?function=RegistrarReferenciasEvalRef",
                            data: info,
                            success: function(resp){               
                               
                
                                    $('#formEvalReferen')[0].reset();                
                                    $('#cerrarEvalRef').click();
                                    $('#tableReferenciasXd').DataTable().ajax.reload(null, false);
                                
                            }
                            
                            
                        });
                
            }
            
            
            function RegistrarEvalPerRefPesta(){
                
                  
                   var info = $("#formEvalReferen").serialize();
                
                    $.ajax({
                            type: "POST",
                            dataType: 'html',
                            url: "./Controlador/controllerProcedimientos.php?function=RegistrarEvalPerRefPesta",
                            data: info,
                            success: function(resp){               
                               
                
                                    $('#formEvalReferen')[0].reset();                
                                    $('#cerrarEvalRef').click();
                                    $('#tableReferenciasXd').DataTable().ajax.reload(null, false);
                                
                            }
                            
                            
                        });
                
            }
            
            
            
            
             function RegistrarEvalJefeServicio(){
                
                  
                   var info = $("#formEvalReferen").serialize();
                
                    $.ajax({
                            type: "POST",
                            dataType: 'html',
                            url: "./Controlador/controllerProcedimientos.php?function=RegistrarEvalJefeServicio",
                            data: info,
                            success: function(resp){               
                               
                
                                    $('#formEvalReferen')[0].reset();                
                                    $('#cerrarEvalRef').click();
                                    $('#tableReferenciasXd').DataTable().ajax.reload(null, false);
                                
                            }
                            
                            
                        });
                
            }
            
            
            function RegistrarEvalJefeGuardia(){
                
                  
                   var info = $("#formEvalReferen").serialize();
                
                    $.ajax({
                            type: "POST",
                            dataType: 'html',
                            url: "./Controlador/controllerProcedimientos.php?function=RegistrarEvalJefeGuardia",
                            data: info,
                            success: function(resp){               
                               
                
                                    $('#formEvalReferen')[0].reset();                
                                    $('#cerrarEvalRef').click();
                                    $('#tableReferenciasXd').DataTable().ajax.reload(null, false);
                                
                            }
                            
                            
                        });
                
            }
            
            
            
            
            function RegistrarEvalMedicoAudi(){
                
                  
                   var info = $("#formEvalReferen").serialize();
                
                    $.ajax({
                            type: "POST",
                            dataType: 'html',
                            url: "./Controlador/controllerProcedimientos.php?function=RegistrarEvalMedicoAudi",
                            data: info,
                            success: function(resp){               
                               
                
                                    $('#formEvalReferen')[0].reset();                
                                    $('#cerrarEvalRef').click();
                                    $('#tableReferenciasXd').DataTable().ajax.reload(null, false);
                                
                            }
                            
                            
                        });
                
            }
            
            
            
            
            
             function RegistrarEvalPerRefe(){
                
                  
                   var info = $("#formEvalReferen").serialize();
                
                    $.ajax({
                            type: "POST",
                            dataType: 'html',
                            url: "./Controlador/controllerProcedimientos.php?function=RegistrarEvalPerRefe",
                            data: info,
                            success: function(resp){               
                               
                
                                    $('#formEvalReferen')[0].reset();                
                                    $('#cerrarEvalRef').click();
                                    $('#tableReferenciasXd').DataTable().ajax.reload(null, false);
                                
                            }
                            
                            
                        });
                
            }
            
            
            
            function RegistrarEvalPerRefeFinal(){
                
                  
                  
                         var opcion = confirm("¿Estas seguro de guardar la información? No podrá realizar cambio posterior.");
                            if (opcion == true) { 
                                
                                    
                                    
                                        var info = $("#formEvalReferen").serialize();
                
                                        $.ajax({
                                                type: "POST",
                                                dataType: 'html',
                                                url: "./Controlador/controllerProcedimientos.php?function=RegistrarEvalPerRefeFinal",
                                                data: info,
                                                success: function(resp){               
                                                   
                                    
                                                        $('#formEvalReferen')[0].reset();                
                                                        $('#cerrarEvalRef').click();
                                                        $('#tableReferenciasXd').DataTable().ajax.reload(null, false);
                                                    
                                                }
                                                
                                                
                                        });
                                
                                
                                
                            } else {
                        	        
                        	   alert("Cancelaste la solicitud")
                            }
                                
            }
            
            
            function RegistrarReferencias()
            {
              
            
                var info = $("#formPacienteReferencias").serialize();
                var NroDocRef = $("#NroDocRef").val();
               
                
            
                if(NroDocRef==""){
            
                    alert("Debes ingresar el TIPO DE SEGURO");
                   
                }
                
                else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=RegistrarReferencias",
                        data: info,
                        success: function(resp){               
                           
            
                                $('#formPacienteReferencias')[0].reset();                
                                $('#cerraRefe').click();
                                $('#tableReferenciasXd').DataTable().ajax.reload(null, false);
                            
                        }
                        
                        
                    });
                    
                }   
            }  
            
            function RegistrarPacienteEm()
            {
              
                handlerDiasSave();
                var info = $("#formPacienteEmergen").serialize();    
                var NroDoc = $("#NroDoc").val(); 
                var ide = $("#ide").val();     
                var nombres = $("#nombres").val();   
                var apepa = $("#apepa").val();   
                var apema =$("#apema").val();
                var dep =$("#departamento").val();
                var tipoDoc =$("#tipoDoc").val();
                var espost =$("#espost").val();
                var reciAudit =$("#reciAudit").val();
                var actras =$("#actras").val();
                var financia =$("#financia").val();
                var paciente = nombres+ " "+apepa+" "+apema;
                var cuenta =$("#cuenta").val();var hisCli =$("#hisCli").val();
                var origenEmer =$("#origenEmer").val();var tipoDoc =$("#tipoDoc").val();
                var NroDoc =$("#NroDoc").val();var apepa =$("#apepa").val();
                var apema =$("#apema").val();var nombres =$("#nombres").val();
                var FechaNac =$("#FechaNac").val();var edad =$("#edad").val();
                var sexo =$("#sexo").val();var ubicacion =$("#ubicacion").val();var tipoSeiN =$("#tipoSeiN").val();
                var feingre =$("#feingre").val();var monGal =$("#monGal").val();var montSif =$("#montSif").val();
                var seguros =$("#seguros").val();var regim =$("#regim").val();var planSal =$("#planSal").val();
                 var fechaAful =$("#fechaAful").val();var statusRegPax =$("#statusRegPax").val();
                 var NroAf =$("#NroAf").val();var segurosAl =$("#segurosAl").val();
                
                var tix2 = getParameterByName('tipo');
               
            
               
               if(cuenta =="" && tix2 != "3"){
                   alert("Debes ingresar el NRO DE CUENTA");
               }else if(hisCli==""){
                   alert("Debes ingresar la HISTORIA CLINICA");
               }else if(origenEmer==""){
                   alert("Debes ingresar la PROCEDENCIA");
               }else if(tipoDoc==""){
                   alert("Debes ingresar el TIPO DOCUMENTO");
               }/*else if(NroDoc==""){
                   alert("Debes ingresar el NRO DE DOCUMENTO");
               }*/else if(apepa==""){
                   alert("Debes ingresar el APELLIDO PATERNO");
               }else if(apema==""){
                   alert("Debes ingresar el APELLIDO MATERNO");
               }else if(nombres==""){
                   alert("Debes ingresar los NOMBRES");
               }else if(FechaNac==""){
                   alert("Debes ingresar la FECHA NACIMIENTO");
               }else if(edad==""){
                   alert("Debes ingresar la EDAD");
               }else if(sexo==""){
                   alert("Debes ingresar el SEXO");
               }else if(ubicacion==""){
                   alert("Debes ingresar el TIPO SERVICIO");
               }else if(tipoSeiN==""){
                   alert("Debes ingresar el SERVICIO INGRESO");
               }else if(NroDoc=="" && tipoDoc != 6){
            
                    alert("Debes llenar el campo NRO DOCUMENTO");
                    $("#NroDoc").css("border", "3px solid red");
                    $("#NroDoc").focus();
                   
              }else if(actras==""){
            
                    alert("Debes llenar el campo ACCIDENTE DE TRANSITO");
                    $("#actras").css("border", "3px solid red");
                    $("#actras").focus();
                   
              }else if(financia==""){
            
                    alert("Debes llenar el campo FINANCIAMIENTO");
                    $("#financia").css("border", "3px solid red");
                    $("#financia").focus();
                   
             }else if(espost == "1" && financia =="2" ){
                    
                        
                        var fuaSis2 = $("#fua").val();
                        var ubicaSis = $("#ubicacionDes").val();
                        var tipoSeSis = $("#tipoSeiNDes").val();
                        var feAltaSis = $("#feAltaAlt").val();
                        var monGalSis = $("#monGal").val();
                        var montSifSis = $("#montSif").val();
                        /*var rsatenSis = $("#rsatencion").val();
                        var fuaEntSise = $("#fuaEntre").val();
                        var fechaSisntre = $("#fechaFuaEntre").val();*/
                        var idUserLiquida = $("#idUserLiquida").val();
                        var tipoLiquxSis = $("#tipoLiqux").val();
                        
                        //rsatencion
                        if( ubicaSis ==""){
                            alert("Debes seleccionar TIPO SERVICIO");
                        }else if(tipoSeSis ==""){
                            alert("Debes seleccionar SERVICIO EGRESO");
                        }else if(feAltaSis ==""){
                            alert("Debes seleccionar FECHA ALTA");
                        }else if(monGalSis ==""){
                            alert("Debes agregar MONTO GALENOS");
                        }else if(montSifSis ==""){
                            alert("Debes agregar MONTO SISFAR");
                        }/*else if(rsatenSis ==""){
                            alert("Debes agregar RESP. ATENCION");
                        }else if(fuaEntSise ==""){
                            alert("Debes agregar FUA ENTREGADO");
                        }else if(fechaSisntre ==""){
                            alert("Debes seleccionar FECHA ENTREGA");
                        }*/else if(idUserLiquida ==""){
                            alert("Debes seleccionar LIQUIDA");
                        }else if(tipoLiquxSis ==""){
                            alert("Debes seleccionar TIPO DE LIQUIDACION");
                        }else{
                            
                                        $.ajax({
                                        type: "POST",
                                        dataType: 'html',
                                        url: "./Controlador/controllerProcedimientos.php?function=RegistroPacienteEm",
                                        data: info,
                            
                                        success: function(resp){               
                                           
                                          // alert(resp);
                                            if(resp==1){
                                                //alert("Registro duplicado");
                                                $.NotificationService.showErrorNotification({
                                                              title:"Mensaje",
                                                              message:"Registro duplicado"
                                                  });
                                                 //$('#formPacienteEmergen')[0].reset();
                                            }else if(resp==2){
                                                //alert("FUA duplicado");
                                                $.NotificationService.showErrorNotification({
                                                              title:"Mensaje",
                                                              message:"FUA duplicado"
                                                  });
                                                 
                                            }else{
                                                
                                                 $('#formPacienteEmergen')[0].reset();                
                                                 $('#cerrar').click();
                                                 $('#pac3Emer').DataTable().ajax.reload(null, false);
                                                 $.NotificationService.showInfoNotification({
                                                                      title:"Mensaje",
                                                                      message:"Los cambios se guardaron correctamente"
                                                 });
                                                
                                            }
                                           
                                        }
                                        
                                    });
                            
                        }
                    
                }else if(financia =="1" ){
                       
                        if( seguros ==""){
                            alert("Debes seleccionar IAFAS");
                        }else if(regim ==""){
                            alert("Debes seleccionar REGIMEN");
                        }else if(planSal ==""){
                            alert("Debes seleccionar PLAN DE SALUD");
                        }/*else if(NroAf ==""){
                            alert("Debes seleccionar NRO AFIL");
                        }else if(statusRegPax ==""){
                            alert("Debes seleccionar ESTADO");
                        }else if(fechaAful ==""){
                            alert("Debes seleccionar FECHA AFILIACION");
                        }*/else if(ubicacion ==""){
                            alert("Debes seleccionar TIPO SERVICIO");
                        }else if(tipoSeiN ==""){
                            alert("Debes seleccionar SERVICIO INGRESO");
                        }else if(feingre ==""){
                            alert("Debes seleccionar FECHA INGRESO");
                        }else{
                            
                                        $.ajax({
                                        type: "POST",
                                        dataType: 'html',
                                        url: "./Controlador/controllerProcedimientos.php?function=RegistroPacienteEm",
                                        data: info,
                            
                                        success: function(resp){               
                                           
                                            /*if(resp==2){
                                                alert("Pabellon y Nro Cama no se encuentra disponible.");
                                            }else */
                                            if(resp==1){
                                                //alert("Registro duplicado");
                                                $.NotificationService.showErrorNotification({
                                                              title:"Mensaje",
                                                              message:"Registro duplicado"
                                                  });
                                                 //$('#formPacienteEmergen')[0].reset();   
                                            }else if(resp==2){
                                                //alert("FUA duplicado");
                                                $.NotificationService.showErrorNotification({
                                                              title:"Mensaje",
                                                              message:"FUA duplicado"
                                                  });
                                                 
                                            }else{
                                                
                                                 $('#formPacienteEmergen')[0].reset();                
                                                 $('#cerrar').click();
                                                 $('#pac3Emer').DataTable().ajax.reload(null, false);
                                                  $.NotificationService.showInfoNotification({
                                                                      title:"Mensaje",
                                                                      message:"Los cambios se guardaron correctamente"
                                                 });
                                                
                                            }
                                           
                                        }
                                        
                                    });
                            
                            
                            
                        }
                        
                    
                    
                }else if(financia =="2" ){
                    
                    if( seguros ==""){
                            alert("Debes seleccionar IAFAS");
                        }else if(regim ==""){
                            alert("Debes seleccionar REGIMEN");
                        }else if(planSal ==""){
                            alert("Debes seleccionar PLAN DE SALUD");
                        }else if(NroAf ==""){
                            alert("Debes seleccionar NRO AFIL");
                        }else if(fechaAful ==""){
                            alert("Debes seleccionar FECHA AFILIACION");
                        }else if(statusRegPax ==""){
                            alert("Debes seleccionar ESTADO");
                        }else if(ubicacion ==""){
                            alert("Debes seleccionar TIPO SERVICIO");
                        }else if(tipoSeiN ==""){
                            alert("Debes seleccionar SERVICIO INGRESO");
                        }else if(feingre ==""){
                            alert("Debes seleccionar FECHA INGRESO");
                        }else{
                            
                                        $.ajax({
                                        type: "POST",
                                        dataType: 'html',
                                        url: "./Controlador/controllerProcedimientos.php?function=RegistroPacienteEm",
                                        data: info,
                            
                                        success: function(resp){               
                                           
                                          // alert(resp);
                                            if(resp==1){
                                                //alert("Registro duplicado");
                                                $.NotificationService.showErrorNotification({
                                                              title:"Mensaje",
                                                              message:"Registro duplicado"
                                                  });
                                                 //$('#formPacienteEmergen')[0].reset();   
                                            }else if(resp==2){
                                                //alert("FUA duplicado");
                                                $.NotificationService.showErrorNotification({
                                                              title:"Mensaje",
                                                              message:"FUA duplicado"
                                                  });
                                                 
                                            }else{
                                                
                                                 $('#formPacienteEmergen')[0].reset();                
                                                 $('#cerrar').click();
                                                 $('#pac3Emer').DataTable().ajax.reload(null, false);
                                                  $.NotificationService.showInfoNotification({
                                                                      title:"Mensaje",
                                                                      message:"Los cambios se guardaron correctamente"
                                                 });
                                                
                                            }
                                           
                                        }
                                        
                                    });
                            
                            
                            
                        }
                    
                }else if(financia =="3" ){
                    
                        if( segurosAl  ==""){
                            alert("Debes seleccionar ASEGURADORA");
                        }else if( seguros   ==""){
                            alert("Debes seleccionar IAFAS");
                        }else if(regim ==""){
                            alert("Debes seleccionar REGIMEN");
                        }else if(planSal ==""){
                            alert("Debes seleccionar PLAN DE SALUD");
                        }else if(ubicacion ==""){
                            alert("Debes seleccionar TIPO SERVICIO");
                        }else if(tipoSeiN ==""){
                            alert("Debes seleccionar SERVICIO INGRESO");
                        }else if(feingre ==""){
                            alert("Debes seleccionar FECHA INGRESO");
                        }else{
                            
                                        $.ajax({
                                        type: "POST",
                                        dataType: 'html',
                                        url: "./Controlador/controllerProcedimientos.php?function=RegistroPacienteEm",
                                        data: info,
                            
                                        success: function(resp){               
                                           
                                          // alert(resp);
                                            if(resp==1){
                                                //alert("Registro duplicado");
                                                $.NotificationService.showErrorNotification({
                                                              title:"Mensaje",
                                                              message:"Registro duplicado"
                                                  });
                                                 //$('#formPacienteEmergen')[0].reset();   
                                            }else if(resp==2){
                                                //alert("FUA duplicado");
                                                $.NotificationService.showErrorNotification({
                                                              title:"Mensaje",
                                                              message:"FUA duplicado"
                                                  });
                                                 
                                            }else{
                                                
                                                 $('#formPacienteEmergen')[0].reset();                
                                                 $('#cerrar').click();
                                                 $('#pac3Emer').DataTable().ajax.reload(null, false);
                                                  $.NotificationService.showInfoNotification({
                                                                      title:"Mensaje",
                                                                      message:"Los cambios se guardaron correctamente"
                                                 });
                                                
                                            }
                                           
                                        }
                                        
                                    });
                            
                            
                            
                        }
                    
                }else if(financia =="4" ){
                    
                        if( seguros   ==""){
                            alert("Debes seleccionar IAFAS");
                        }else if(regim ==""){
                            alert("Debes seleccionar REGIMEN");
                        }else if(planSal ==""){
                            alert("Debes seleccionar PLAN DE SALUD");
                        }else if(ubicacion ==""){
                            alert("Debes seleccionar TIPO SERVICIO");
                        }else if(tipoSeiN ==""){
                            alert("Debes seleccionar SERVICIO INGRESO");
                        }else if(feingre ==""){
                            alert("Debes seleccionar FECHA INGRESO");
                        }else{
                            
                                        $.ajax({
                                        type: "POST",
                                        dataType: 'html',
                                        url: "./Controlador/controllerProcedimientos.php?function=RegistroPacienteEm",
                                        data: info,
                            
                                        success: function(resp){               
                                           
                                          // alert(resp);
                                            if(resp==1){
                                                //alert("Registro duplicado");
                                                $.NotificationService.showErrorNotification({
                                                              title:"Mensaje",
                                                              message:"Registro duplicado"
                                                  });
                                                 //$('#formPacienteEmergen')[0].reset();   
                                            }else if(resp==2){
                                                //alert("FUA duplicado");
                                                $.NotificationService.showErrorNotification({
                                                              title:"Mensaje",
                                                              message:"FUA duplicado"
                                                  });
                                                 
                                            }else{
                                                
                                                 $('#formPacienteEmergen')[0].reset();                
                                                 $('#cerrar').click();
                                                 $('#pac3Emer').DataTable().ajax.reload(null, false);
                                                  $.NotificationService.showInfoNotification({
                                                                      title:"Mensaje",
                                                                      message:"Los cambios se guardaron correctamente"
                                                 });
                                                
                                            }
                                           
                                        }
                                        
                                    });
                            
                        }
                    
                }else{
                  //alert(espost);
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=RegistroPacienteEm",
                        data: info,
            
                        success: function(resp){               
                           
                          // alert(resp);
                            if(resp==1){
                                //alert("Registro duplicado");
                                    $.NotificationService.showErrorNotification({
                                                  title:"Mensaje",
                                                  message:"Registro duplicado"
                                      });
                                 //$('#formPacienteEmergen')[0].reset();   
                            }else if(resp==2){
                                    //alert("FUA duplicado");
                                    $.NotificationService.showErrorNotification({
                                                  title:"Mensaje",
                                                  message:"FUA duplicado"
                                      });
                                                 
                            }else{
                                
                                 $('#formPacienteEmergen')[0].reset();                
                                 $('#cerrar').click();
                                 // debugger;
                                 //jQuery.noConflict();
                                 $('#pac3Emer').DataTable().ajax.reload(null, false);
                                 $.NotificationService.showInfoNotification({
                                                      title:"Mensaje",
                                                      message:"Los cambios se guardaron correctamente"
                                 });
                                
                            }
                           
                        }
                        
                    });
                    
                }   
            } 
            
            
            function impresionMasiva (){
                
                var desde = $("#minCie109").val();var hasta = $("#maxCie109").val();var user = $("#listUserFil").val(); var tipoEv = $("#tipoEv").val();
                if(desde !="" && hasta !=""){
                     
                      window.open('http://seguros.hloayza.local/imprimirMasivo.php?user='+user+'&desde='+desde+'&hasta='+hasta+'&id='+tipoEv, '_blank');
                }else{
                    alert("Debes seleccionar un rango de fechas.");
                }
               
                
            }
            
            
                function ActualizarPaciente()
                {
                  
                   // var formGp = $("#formPaciente").serialize();
                     var formGp = new FormData($("#formPaciente")[0]);
                    
                    var id= $("#iduser").val();
                    var resultado= $("#resultado").val();
                    var fuaSolicitado= $("#fuaSolicitado").val();
            
                    if(fuaSolicitado==""){
                        alert("Debes ingresar el FUA ");
                        $("#fuaSolicitado").focus();
                    }else if(resultado==""){
                          alert("Debes ingresar el RESULTADO DE LA EVALUACION");
                          $("#resultado").focus();
                    }
                    else{
                      
                        $.ajax({
                            type: "POST",
                            dataType: 'html',
                            url: "./Controlador/controllerProcedimientos.php?function=regReconsideraciones",
                            data: formGp,
                             cache: false,
                             contentType: false,
                             processData: false,
                            
                            success: function(resp){               
                              
                                $('#formPaciente')[0].reset();                
                                $('#cerRec').click();
                                $('#prepo3').DataTable().ajax.reload(null,false);                       
                                
                            }
                        });
                        
                    }   
                }  



                function EditarReonsi(fua)
                {
            
                  var d = new Date();
            
                  var month = d.getMonth()+1;
                  var day = d.getDate();
            
                  var output = d.getFullYear() + '-' +
                      ((''+month).length<2 ? '0' : '') + month + '-' +
                      ((''+day).length<2 ? '0' : '') + day;
            
            
                    
                    $.ajax({
                        url:'./Controlador/search.php?function=busFua',
                        type:'GET',
                        dataType:'json',
                        data:{ id:fua}
                        
                    }).done(function(datos){
            
                            $("#titlePac").text(datos[0]);
                            $("#ide").val(datos[1]);
                            $("#fuaSolicitado").val(datos[2]);
                            if(datos[3]!=''){
                                $("#fechaRe").val(datos[3]);
                            }else{
                              $("#fechaRe").val(output);
                            }
                            $("#obsrAd").val(datos[4]);
                            $("#estado").val(datos[5]);
                            $("#resultado").val(datos[6]);
                            $("#newOrden").val(datos[8]);
                            
                            //$("#fuare").val(datos[9]);
                            
                            if(datos[10] == "on"){
                                $("#fuare").prop('checked', true);
                               
                              }else{
                                    $("#fuare").prop('checked', false);
                              }
                              
                              
                              if(datos[11] == "on"){
                                    $("#hiEn").prop('checked', true);
                               
                              }else{
                                    $("#hiEn").prop('checked', false);
                              }
                              
                              
                              
                              if(datos[12] == "on"){
                                    $("#ap").prop('checked', true);
                               
                              }else{
                                    $("#ap").prop('checked', false);
                              }
                              if(datos[13] == "on"){
                                    $("#bp").prop('checked', true);
                               
                              }else{
                                    $("#bp").prop('checked', false);
                              }
                              if(datos[14] == "on"){
                                    $("#cp").prop('checked', true);
                               
                              }else{
                                    $("#cp").prop('checked', false);
                              }
                              if(datos[15] == "on"){
                                    $("#dp").prop('checked', true);
                               
                              }else{
                                    $("#dp").prop('checked', false);
                              }
                              if(datos[16] == "on"){
                                    $("#ep").prop('checked', true);
                               
                              }else{
                                    $("#ep").prop('checked', false);
                              }
                            
            
                    });
                        
                       
                } 
                
                
                
                function buscarCuentaEmergHospi(cuenta)
                {
            
                 
                    $.ajax({
                        url:'./Controlador/search.php?function=cuentaSearch',
                        type:'GET',
                        dataType:'json',
                        data:{ id:cuenta}
                        
                    }).done(function(datos){
            
                            $("#hclinica").val(datos[0]);
                            $("#dni").val(datos[1]);
                            
                            if(datos[2]==1){
                                $("#tiDocA").val("DNI");
                            }else if(datos[2]==2){
                                $("#tiDocA").val("Carnet Ext.");
                            }
                            else if(datos[2]==3){
                                $("#tiDocA").val("Pasaporte");
                            }
                            else if(datos[2]==4){
                                $("#tiDocA").val("Codigo recien nacido (CUI)");
                            }
                            else if(datos[2]==5){
                                $("#tiDocA").val("Doc. Ident. Extranjera");
                            }
                            else if(datos[2]==6){
                                $("#tiDocA").val("Sin Doc.");
                            }
                           // $("#tiDocA").val(datos[2]);
                            $("#fua").val(datos[3]);
                            $("#paciente").val(datos[4]);
                            $("#servicio").val(datos[5]);
                            $("#feingreso").val(datos[6]);
                            $("#fecorte").val(datos[7]);
                            $("#montgal").val(datos[8]);
                            $("#montsifar").val(datos[9]);
                            //$("#obsCpms").val(datos[10]);
                            $("#valAteAudi").val(datos[11]);
                            
            
                    });
                        
                       
                } 


                function buscarDxMorf(cuenta)
                {
            
                 
                    $.ajax({
                        url:'./Controlador/search.php?function=buscarDxMorf',
                        type:'GET',
                        dataType:'json',
                        data:{ id:cuenta}
                        
                    }).done(function(datos){
            
                            $("#descrEspecCito").val(datos[0]);
                        
                    });
                        
                       
                } 

                function buscarDatosPat(cuenta)  {
                            
                                 
                                    $.ajax({
                                        url:'./Controlador/search.php?function=cuentaSearchPatologia',
                                        type:'GET',
                                        dataType:'json',
                                        data:{ id:cuenta}
                                        
                                    }).done(function(datos){
                            
                                            $("#historiaPat").val(datos[0]);
                                          /*  if(datos[1]==2){
                                                $("#sexoPat").val("F");    
                                            }else{
                                                $("#sexoPat").val("M");    
                                            }*/
                                            
                                            $("#pacientePat").val(datos[2]);
                                            $("#servicioPat").val(datos[3]);
                                            $("#edadPat").val(datos[4]);
                                            $("#salacamaPat").val(datos[5]);
                                            $("#nroOrdenPat").val('2024-8292');
                                            /*$.NotificationService.showInfoNotification({
                                                      title:"Mensaje",
                                                      message:"Datos encontrados correctamente"
                                            });*/
                                           
                                            
                            
                                    });
                                        
                                       
                } 
                
                
                function editarRegistroPatologia(id)  {
                            
                                 $("#idRegPatot").val(id);
                                 
                                 if(id==""){
                                     
                                       // guardarInmuno2();
                                        
                                 }else{
                                     
                                        $("#factPat").attr('readonly', false);
                                        $("#tipoEstPat").attr('readonly', false);
                                        $("#procePat").attr('readonly', false);
                                        $("#mediSolicitante").attr('readonly', false);
                                        $("#especialPat").attr('readonly',false);
                                        $("#fechaPat").attr('readonly', false);
                                        $("#tesjidoPat").attr('readonly',false);
                                        $("#muestraPat").attr('readonly', false);
                                 }
                                 
                                    $.ajax({
                                        url:'./Controlador/search.php?function=registroPatologiaEditar',
                                        type:'GET',
                                        dataType:'json',
                                        data:{ id:id}
                                        
                                    }).done(function(datos){
                                        
                                       
                                        if(datos[16]=="1" || datos[16] =="2"){
                                            $("#tipoEstPat").css("pointer-events","none");$("#tipoEstPat").css("background","#c7c7c7");
                                            $("#procePat").css("pointer-events","none");$("#procePat").css("background","#c7c7c7");
                                            
                                        } 
                                       
                                        listTipoDocPato(datos[0]);
                                        $("#nroDocPato").val(datos[1]);
                                        $("#pacientePato").val(datos[2]);
                                        $("#edadPato").val(datos[3]);
                                        $("#sexoPat").val(datos[4]);
                                        $("#financiaPTO").val(datos[5]);
                                        $("#iprId").val(datos[6]);
                                        $("#juriPr").val(datos[7]);
                                        $("#ctinmuno").val(datos[8]);
                                        $("#historiaPat").val(datos[9]);
                                        $("#servicioPat").val(datos[10]);
                                        $("#salacamaPat").val(datos[11]);
                                        $("#celularPacientePatologia").val(datos[12]);
                                        //$("#nroOrdenPat").val(datos[13]);
                                        $("#factPat").val(datos[15]);
                                        cargartipoEstPat(datos[16]);   
                                        cargarprocePat(datos[16],datos[17]);
                                        $("#filtroTipoEst").val(datos[16]);
                                        $("#tipoRegPatolo").val(datos[16]);
                                        $("#tipoRegPatolo2").val(datos[16]);
                                        $("#idtipoEstPat").val(datos[16]);
                                        cargarListCategoria(datos[16]);
                                        cargarUsersAuditorAsignado(datos[31]);
                                         
                                         if(datos[16]==1){
                                             
                                                
                                                     anaListMuestra(datos[23]);
                                                     listTipoEstudioHisto(datos[24]);
                                                     $("#medicoSolcit2").val(datos[25]);
                                                     medSolicitaHqIhq(datos[25]);
                                                     
                                                     $("#dxClinicoHi2").val(datos[26]);
                                                     $("#interpretacPato2").val(datos[27]);
                                                     $("#comentarioPatol2").val(datos[28]);
                                                     $("#notaPatol2").val(datos[29]);
                                                     
                                                     if(datos[23]==2){
                                                          $("#analisisMuestraSi").removeClass("hidden");
                                                     }else{
                                                          $("#analisisMuestraSi").addClass("hidden");
                                                     }
                                                    
                                                 
                                                    if(datos[24]==4){
                                                        
                                                         $("#lblMarca").text("COLORACION");
                                                         $("#titleModalM").text("COLORACION");
                                                         $("#titleLblMa").text("COLORACION");
                                                         $('#idSelectHisto').val(datos[24]);
                                        
                                                    }else{
                                                        
                                                         $("#lblMarca").text("MARCADOR");
                                                         $("#titleModalM").text("MARCADORES");
                                                         $("#titleLblMa").text("MARCADOR");
                                                         $('#idSelectHisto').val(datos[24]);
                                                    }
                                                
                                             
                                         }else if(datos[16]==2){
                                             
                                                     anaListMuestraCito(datos[23]);
                                                     listTipoEstudioHistoCito(datos[24]);
                                                     $("#medicoSolcit").val(datos[25]);
                                                     $("#dxClinicoHi").val(datos[26]);
                                                     $("#interpretacPato").val(datos[27]);
                                                     $("#comentarioPatol").val(datos[28]);
                                                     $("#notaPatol").val(datos[29]);
                                                     
                                                     if(datos[23]==2){
                                                          $("#viewHistoUmn").removeClass("hidden");
                                                     }else{
                                                          $("#viewHistoUmn").addClass("hidden");
                                                     }
                                                    
                                             
                                                     if(datos[24]==4){
                                                         
                                                         $("#lblMarca").text("COLORACION");
                                                         $("#titleModalM").text("COLORACION");
                                                         $("#titleLblMa").text("COLORACION");
                                                         $('#idSelectHistoCito').val(datos[24]);
        
                                        
                                                    }else{
                                                        
                                                         $("#lblMarca").text("MARCADOR");
                                                         $("#titleModalM").text("MARCADORES");
                                                         $("#titleLblMa").text("MARCADOR");
                                                         $('#idSelectHistoCito').val(datos[24]);
                                                         
                                                    }
                                             
                                             
                                         }
                                        
                                        
                                        if(datos[16]==1){
                                            
                                                    $("#paso2").removeClass("hidden");
                                                    $("#paso3").removeClass("hidden");
                                                    $("#paso4").addClass("hidden");
                                                    $("#no4").text("4");
                                                    $("#lblInformCi").text("Informe");
                                                    $("#no4").text("4");
                                                    $("#lblInformCi").text("Informe");
                                                   
                                                    $("#analisisMuestraSiCito").addClass("hidden");
                                                    $("#titleSocpia").text("Macroscopia");
                                                    $("#titleCortus").text("CORTES");
                                                    $("#titleTxus").text("N° TACOS");
                                                    $("#laHisto").text("LABORATORIO HISTOPATOLOGIA");
                                                    $("#plInlc").removeClass("hidden");
                                                    $("#lblTitlepl").text("CORTE");
                                                    $("#lblMacroHis").text("MACROSCOPIA");
                                                    $("#tblObsMic").removeClass("hidden");
                                                    $("#tblRsptaMic").removeClass("hidden");
                                                    $(".verDetailObsM").removeClass("hidden");
                                                    $(".veDetailRspta").removeClass("hidden");
                                                    $("#acordeonObsMic").removeClass("hidden");
                                                    $("#acordeonRsptaMic").removeClass("hidden");
                                                    $(".dentroAcorde1").removeClass("hidden");
                                                    $(".dentroAcorde2").removeClass("hidden");
                                                    
                                                    $("#elexTaco").text("ELEGIR TACOS");
                                                    $("#tileUbs").text("TACOS");
                                                    $(".tileInclTax").text("TACOS");
                                                    $("#titleMoal").text("MACROSCOPIA");
                                                    $("#tipoDecrp").val("");
                                                    CargarRotulosPat(datos[16],1,datos[22],datos[16]);
                                                    CargarTacosPat(datos[16],datos[22],datos[16]);
                                                    CargarRotulosPatMicro(datos[16],2,datos[22],datos[16])
                                                    CargarTacosPatQuimioMicro(datos[16],datos[22],datos[16]);
                                                    CargarMarcadoresHisto(datos[22],datos[16],datos[30]);
                                                    
                                            
                                         }else{
                         
                                                  $("#no4").text("2");
                                                  $("#lblInformCi").text("Informe");
                                                  $("#paso2").addClass("hidden");
                                                  $("#paso3").addClass("hidden");
                                                  $("#paso4").removeClass("hidden");
                                                 
                                        }

                                        
                                        if(datos[17]==13 && datos[16]==2){
                         
                                             
                                                    $("#no4").text("3");
                                                    $("#lblInformCi").text("Informe Citológico");
                                                    $("#paso2").removeClass("hidden");
                                                    $("#paso3").addClass("hidden");
                                                    $("#paso4").removeClass("hidden");
                                                    $("#analisisMuestraSiCito").removeClass("hidden");
                                                    
                                                    $("#titleSocpia").text("Laboratorio");
                                                    $("#titleCortus").text("COLORACION");
                                                    $("#titleTxus").text("LAMINAS");
                                                    $("#laHisto").text("FASES");
                                                    $("#plInlc").addClass("hidden");
                                                    $("#lblTitlepl").text("ROTULACION");
                                                    $("#lblMacroHis").text("LABORATORIO");
                                                    
                                                    $("#tblObsMic").addClass("hidden");
                                                    $("#tblRsptaMic").addClass("hidden");
                                                    $(".verDetailObsM").addClass("hidden");
                                                    $(".veDetailRspta").addClass("hidden");
                                                    $("#tipoDecrp").val("3");
                                                    
                                                    $("#acordeonObsMic").addClass("hidden");
                                                    $("#acordeonRsptaMic").addClass("hidden");
                                                    $(".dentroAcorde1").addClass("hidden");
                                                    $(".dentroAcorde2").addClass("hidden");
                                                    
                                                    CargarRotulosPatCervico(3,0,datos[22],datos[16]);
                                                    CargarTacosPat(3,datos[22],datos[16]);
                                                    CargarRotulosHistoquiCervicoVaginal(3,3,datos[22],datos[16])
                                                    $("#elexTaco").text("ELEGIR LAMINA");
                                                    
                                                    $("#tileUbs").text("LAMINA");
                                                    $("#txtPequ").text("Marque las láminas que desee analizar.");
                                                    $(".tileInclTax").text("LAMINA");
                                                    CargarMarcadoresHisto(datos[22],datos[16],datos[30]);
                                                    $("#titleMoal").text("LABORATORIO");
                                                    $("#espcialx").removeClass("hidden");
                                                    $("#divcalidadMuesCitoEsp").addClass("hidden");
                                                    $("#muesCerEepsc").addClass("hidden");
                                             
                                             
                                         }//else if(datos[17]!=13 && datos[16]==2 ||datos[17]!=13 && datos[16]==1 ){
                                            else if(datos[17] >= 1 && datos[16]== 1 || datos[17] <= 12 && datos[16]== 1 ){
                                             
                                                    $("#no4").text("4");
                                                    $("#lblInformCi").text("Informe");
                                                    $("#paso2").removeClass("hidden");
                                                    $("#paso3").removeClass("hidden");
                                                     $("#paso4").addClass("hidden");
                                                    $("#analisisMuestraSiCito").addClass("hidden");
                                                    
                                                    $("#titleSocpia").text("Macroscopia");
                                                    $("#titleCortus").text("CORTES");
                                                    $("#titleTxus").text("N° TACOS");
                                                    $("#laHisto").text("LABORATORIO HISTOPATOLOGIA");
                                                    $("#plInlc").removeClass("hidden");
                                                    $("#lblTitlepl").text("CORTE");
                                                    $("#lblMacroHis").text("MACROSCOPIA");
                                                    $("#tblObsMic").removeClass("hidden");
                                                    $("#tblRsptaMic").removeClass("hidden");
                                                    $(".verDetailObsM").removeClass("hidden");
                                                    $(".veDetailRspta").removeClass("hidden");
                                                    
                                                    $("#acordeonObsMic").removeClass("hidden");
                                                    $("#acordeonRsptaMic").removeClass("hidden");
                                                    $(".dentroAcorde1").removeClass("hidden");
                                                    $(".dentroAcorde2").removeClass("hidden");
                                                    CargarTacosPat(1,datos[22],datos[16]);
                                                    $("#elexTaco").text("ELEGIR TACOS");
                                                    $("#tileUbs").text("TACOS");
                                                    $(".tileInclTax").text("TACOS");
                                                    $("#titleMoal").text("MACROSCOPIA");
                                                    $("#txtPequ").text("Marque los tacos que desee analizar.");
                                                  $("#espcialx").removeClass("hidden");
                                                  $("#divcalidadMuesCitoEsp").addClass("hidden");
                                                  $("#muesCerEepsc").addClass("hidden");
                                             
                                         }
                                        
                                         else if(datos[17] > 13 && datos[16] == 2 ){
                         
                                                $("#no4").text("4");
                                                $("#lblInformCi").text("Informe");
                                                $("#paso2").removeClass("hidden");
                                                $("#paso3").removeClass("hidden");
                                                $("#paso4").addClass("hidden");
                                                $("#analisisMuestraSiCito").addClass("hidden");
                                                $("#titleSocpia").text("Macroscopia");
                                                $("#titleCortus").text("CORTES");
                                                $("#titleTxus").text("N° LAMINAS");
                                                $("#viewCorte").addClass("hidden");
                                                $("#laHisto").text("FASES");
                                                $("#plInlc").addClass("hidden");
                                                $("#lblTitlepl").text("CENTRIFUGACION");
                                                $("#lblMacroHis").text("MACROSCOPIA");
                                                $("#tblObsMic").removeClass("hidden");
                                                $("#tblRsptaMic").removeClass("hidden");
                                                $(".verDetailObsM").removeClass("hidden");
                                                $(".veDetailRspta").removeClass("hidden");
                                                
                                                $("#acordeonObsMic").removeClass("hidden");
                                                $("#acordeonRsptaMic").removeClass("hidden");
                                                $(".dentroAcorde1").removeClass("hidden");
                                                $(".dentroAcorde2").removeClass("hidden");
                                               // CargarTacosPat(1);
                                                
                                                CargarRotulosPat(datos[16],1,datos[22],datos[16]);
                                                CargarTacosPat(1,datos[22],datos[16]);
                                                
                                                $("#elexTaco").text("ELEGIR LAMINAS");
                                                $("#tileUbs").text("LAMINAS");
                                                $(".tileInclTax").text("LAMINAS");
                                                $("#titleMoal").text("MACROSCOPIA");
                                                $("#txtPequ").text("Marque las laminas que desee analizar.");
                                                $("#espcialx").addClass("hidden");
                                                $("#divcalidadMuesCitoEsp").removeClass("hidden");
                                                $("#muesCerEepsc").removeClass("hidden");
                                                var ip = getParameterByName('id');
                                                var link2="http://seguros.hloayza.local/pdfAnatomoPatologicoVistaPrevia2.php?id="+ip;
                                                $('#btnIhqHqModalCerEspec').attr('href', link2);

                                             
                                         }
                                        
                                        
                                        $("#mediSolicitante").val(datos[18]);
                                        
                                        $("#especialPat").val(datos[19]);
                                        $("#fechaPat").val(datos[20]);
                                        $("#corPat").val(datos[21]);
                                        if(datos[22]!="-"){
                                             $("#nroOrdenPat").val(datos[22]);
                                             $("#formatoPatologiaMac").val(datos[22]);
                                             //CargarRotulosPat(datos[16],1,datos[22]);
                                             //CargarTacosPat(datos[16],datos[22]);
                                        }else{
                                            $("#nroOrdenPat").val(datos[22]);
                                        }
                                        
                                        
                                        
                                        $("#fechaUltimaRegla").val(datos[32]);
                                        cargarlistEmbarazo(datos[33]);
                                        cargarlistMetodoAnticonceptivo(datos[34]);
                                        cargarlistTipoAnticonceptivo(datos[35]);
                                        $("#TiempoUso").val(datos[36]);
                                        cargarlistExamenGineco(datos[37]);
                                        $("#obsExamenGinec").val(datos[38]);
                                        listCalidEspec(1,"calidEspec",datos[39]);
                                        $("#especifiqueCalidadEspec").val(datos[40]);
                                        listCalidEspec(2,"clasificacionGen",datos[41]);
                                        $("#EspecclasificacionGen").val(datos[42]);
                                        listCalidEspec(3,"celulasEscamosas",datos[43]);
                                        $("#especelulasEscamosas").val(datos[44]);
                                        listCalidEspec(4,"celGlandu",datos[45]);
                                        $("#espeCelGlandu").val(datos[46]);
                                        $("#fechaConcySuger").val(datos[47]);
                                        $("#dxRealizadoLab").val(datos[48]);
                                        $("#fechalab").val(datos[49]);
                                        $("#nomObtencionMuestras").val(datos[50]);
                                        $("#profeCargo").val(datos[51]);
                                        $("#fechaObtencMuestra").val(datos[52]);
                                        $("#fechaColoscopia").val(datos[53]);
                                        $("#especifColoscopia").val(datos[54]);
                                        $("#dxAnterior").val(datos[55]);
                                        $("#fechadxAnterior").val(datos[56]);
                                        $("#otrNeoMalig").val(datos[57]);
                                        listCalidEspec(5,"celulBenignos",datos[58]);
                                        $("#especifTipoOrg").val(datos[59]);
                                        listCalidEspec(6,"cambioReactivos",datos[60]);
                                        $("#espeCambioReac").val(datos[61]);
                                        listCalidEspec(7,"patronHormonal",datos[62]);
                                        $("#especifPatronHor").val(datos[63]);
                                        $("#datosResposanble").val(datos[64]);
                                        $("#colegioResp").val(datos[65]);
                                        //$("#nomApeConfir").val(datos[66]);
                                        usuarioConfirmadoPor(datos[66]);
                                        $("#colegConfirma").val(datos[67]);
                                        $("#txtAreaConclusiones").val(datos[68]);
                                        cargarTipoServicioPat(datos[70]);
                                        cargarTipoServicioPatSer(datos[70],datos[10]);
                                        $("#selecConvenio").val(datos[71]);
                                        if(datos[71]=="2"){
                                            $("#lblcon").removeClass("hidden");
                                            $("#cmapconDiv").removeClass("hidden");
                                             cargarConvenioPatSer(datos[71],datos[72]); 
                                        }else{
                                          
                                            $("#lblcon").addClass("hidden");
                                            $("#cmapconDiv").addClass("hidden");
                                        }
                                        
                                        usuarioConfirmadoPorAP(datos[73]);
                                       
                                         
                                    });
                                        
                                       
                } 
                
                function buscarEspecialidad(cuenta)  {
                            
                                 
                                    $.ajax({
                                        url:'./Controlador/search.php?function=cuentaSearchEspecialidad',
                                        type:'GET',
                                        dataType:'json',
                                        data:{ id:cuenta}
                                        
                                    }).done(function(datos){
                            
                                            $("#especialPat").val(datos[0]);
                                           
                            
                                    });
                                        
                                       
                } 
                
                
                function buscarCategoria(cuenta)  {
                            
                                 
                                    $.ajax({
                                        url:'./Controlador/search.php?function=cuentaSearCat',
                                        type:'GET',
                                        dataType:'json',
                                        data:{ id:cuenta}
                                        
                                    }).done(function(datos){
                            
                                            $("#idcateg").val(datos[0]);
                                            cargarListSubcategoria(0,datos[0]);
                                            //$("#rotulo").focus();
                                           
                            
                                    });
                                        
                                       
                }     
                
                
                 function cargarColegiatura(cuenta)  {
                            
                                 
                                    $.ajax({
                                        url:'./Controlador/search.php?function=buscarColegiatura',
                                        type:'GET',
                                        dataType:'json',
                                        data:{ id:cuenta}
                                        
                                    }).done(function(datos){
                            
                                            $("#colegConfirma").val(datos[0]);
                                            
                            
                                    });
                                        
                                       
                }     
                
                
                function asignarPlantillaPre(id,tipo)  {
                            
                                 
                                    $.ajax({
                                        url:'./Controlador/search.php?function=asignarPlantillaPre',
                                        type:'GET',
                                        dataType:'json',
                                        data:{ id:id,tipo:tipo}
                                        
                                    }).done(function(datos){
                            
                                            $("#descrRot").val(datos[0]);
                            
                                    });
                                        
                                       
                }     
            
             function guardarInmuno(){
                        
                        $("#ctinmuno").attr('readonly', 'readonly');
                        $("#historiaPat").attr('readonly', 'readonly');
                        $("#pacientePat").attr('readonly', 'readonly');
                        $("#sexoPat").attr('readonly', 'readonly');
                        $("#edadPat").attr('readonly', 'readonly');
                        $("#servicioPat").attr('readonly', 'readonly');
                        $("#salacamaPat").attr('readonly', 'readonly');
                        $("#nroOrdenPat").attr('readonly', 'readonly');
                 
                                $.NotificationService.showInfoNotification({
                                          title:"Mensaje",
                                          message:"Datos guardados correctamente"
                                });
                
            }
            
            function modInmuno(){
                        
                        $("#ctinmuno").removeAttr('readonly');
                        $("#historiaPat").removeAttr('readonly');
                        $("#pacientePat").removeAttr('readonly');
                        $("#sexoPat").removeAttr('readonly');
                        $("#edadPat").removeAttr('readonly');
                        $("#servicioPat").removeAttr('readonly');
                        $("#salacamaPat").removeAttr('readonly');
                        $("#nroOrdenPat").removeAttr('readonly');
                 
                                $.NotificationService.showInfoNotification({
                                          title:"Mensaje",
                                          message:"Se habilitaron los campos"
                                });
            }
            
            
            function guardarInmuno2(){
                        
                        $("#factPat").attr('readonly', 'readonly');
                        $("#tipoEstPat").attr('readonly', 'readonly');
                        $("#procePat").attr('readonly', 'readonly');
                        $("#mediSolicitante").attr('readonly', 'readonly');
                        $("#especialPat").attr('readonly', 'readonly');
                        $("#fechaPat").attr('readonly', 'readonly');
                        $("#tesjidoPat").attr('readonly', 'readonly');
                        $("#muestraPat").attr('readonly', 'readonly');
                 
                                /*$.NotificationService.showInfoNotification({
                                          title:"Mensaje",
                                          message:"Datos guardados correctamente"
                                });*/
                
            }
            
            function modInmuno2(){
                        
                        $("#factPat").removeAttr('readonly');
                        $("#tipoEstPat").removeAttr('readonly');
                        $("#procePat").removeAttr('readonly');
                        $("#mediSolicitante").removeAttr('readonly');
                        $("#especialPat").removeAttr('readonly');
                        $("#fechaPat").removeAttr('readonly');
                        $("#tesjidoPat").removeAttr('readonly');
                        $("#muestraPat").removeAttr('readonly');
                 
                                $.NotificationService.showInfoNotification({
                                          title:"Mensaje",
                                          message:"Se habilitaron los campos"
                                });
            }


            function registroPaquete()
            {
              
            
                var info = $("#frmPaquete").serialize();    
               
                var iduser = $("#iduser").val(); 
               
            
            
                if(iduser=="" ){
            
                    alert("Debes iniciar sesion");
                }else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=registroPaquete",
                        data: info,
            
                        success: function(resp){               
                           
                             $('#frmPaquete')[0].reset();                
                             $('#cerrarFrmPak').click();
                             $('#pac3grupoArchivo').DataTable().ajax.reload(null, false);
                        
                           
                        }
                    });
                    
                }   
            } 
            
            
            
         function registroPacientePatologia()
            {
              
            
                var info = $("#frmRegistroPacientePato").serialize();    
                var iduser = $("#iduser").val(); 
                
                var sexoPat = $("#sexoPat").val(); 
                var financiaPTO = $("#financiaPTO").val();
                var tipoServicoPatl = $("#tipoServicoPatl").val();
                var servicioPat = $("#servicioPat").val();
                var selecConvenio = $("#selecConvenio").val();
                var ipressConvenio = $("#ipressConvenio").val();
                
              
                if(sexoPat ==""){
                            alert("Debe seleccionar el SEXO");
                }else if(financiaPTO == ""){
                            alert("Debe seleccionar el FINANCIAMIENTO");
                }else if(tipoServicoPatl == ""){
                            alert("Debe seleccionar el TIPO SERVICIO");
                }else if(servicioPat == ""){
                            alert("Debe seleccionar el SERVICIO");
                }else if(selecConvenio == ""){
                            alert("Debe seleccionar el TIPO CONVENIO");
                }else if(selecConvenio == 2 && ipressConvenio == ""){
                            alert("Debe seleccionar la IPRESS");    
                }
                else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=registroPacientePatologia",
                        data: info,
            
                        success: function(resp){               
                           
                                url = "http://seguros.hloayza.local/registroPatologia.php";
                                $(location).attr('href',url);
                           
                        }
                    });
                    
                }   
            } 
            
            
            
            function registroPacienteCervicoVaginal(msje)
            {
              
            
                var info = $("#frmRegistroPacienteCervicoVaginal").serialize();    
                var iduser = $("#iduser").val(); 
              
            
                if(iduser=="" ){
            
                    alert("Debes iniciar sesion");
                }else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=registroPacienteCervicoVaginal",
                        data: info,
            
                        success: function(resp){               
                           
                               // url = "https://sighap.com/hnal/registroPatologia.php";
                                //$(location).attr('href',url);
                                alert(msje)
                           
                        }
                        
                        
                    });
                    
                    
                }   
            } 
            
            
            function registroPacienteCervicoVaginalId()
            {
              
                
                
                var info = $("#frmRegistroPacienteCervicoVaginal").serialize();    
                var iduser = $("#iduser").val(); 
                 var nomApeConfir = $("#nomApeConfir").val(); 
                 var idAuditorAsignado = $("#idAuditorAsignado").val(); 
                 
                  if(nomApeConfir==""){
                    alert("Seleccione el médico patólogo que confirma el estudio.");
                }else if( idAuditorAsignado == "" ){
                    alert("Asigne al médico patólogo que generará el informe.")
                }else  if ( iduser == nomApeConfir && iduser == idAuditorAsignado){
                    
                       var opcion = confirm("¿Estas seguro que desea generar el informe?. No podrá realizar ninguna modificación.");
                       if (opcion == true) {
                           
                            $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=registroPacienteCervicoVaginalId",
                                data: info,
                    
                                success: function(resp){               
                                        
                                        registroPacienteCervicoVaginal("Se generó el informe correctamente");
                                        
                                        url = "http://seguros.hloayza.local/registroPatologia.php";
                                        $(location).attr('href',url);
                                       
                                   
                                }
                            });
                            
                        }else {
                            
                        }
                }else {
                     alert("Solo puede generar el informe el usuario al cual fue asignado.");
                }
              
                   
            } 
            
            
            function registroPacientePatologia2()
            {
              
            
                var info = $("#frmRegistroPacientePato2").serialize();    
                var iduser = $("#iduser").val(); 
                
                var tipoEstPat = $("#tipoEstPat").val(); 
                var procePat = $("#procePat").val(); 
                var fechaPat = $("#fechaPat").val();
                var factPat = $("#factPat").val(); 
                var mediSolicitante = $("#mediSolicitante").val(); 
                var especialPat = $("#especialPat").val(); 
                //var idAuditorAsignado = $("#idAuditorAsignado").val(); 
                
                
              if(factPat=="" ){
            
                    alert("Debes ingresar la FACTURA");
                    $("#factPat").focus();
                    
               }else if(tipoEstPat=="" ){
            
                    alert("Debes seleccionar el TIPO DE ESTUDIO");
                    $("#tipoEstPat").focus();
                    
                }else if(procePat=="" ){
            
                    alert("Debes seleccionar EL PROCEDIMIENTO");
                    $("#procePat").focus();
                    
                }else if(mediSolicitante=="" ){
            
                    alert("Debes ingresar MEDICO SOLICITANTE");
                    $("#mediSolicitante").focus();
                    
                }else if(especialPat=="" ){
            
                    alert("Debes ingresar LA ESPECIALIDAD");
                    $("#especialPat").focus();
                    
                }else if(fechaPat=="" ){
            
                    alert("Debes ingresar la FECHA DE RECEPCION");
                    $("#fechaPat").focus();
                    
                }/*else if(idAuditorAsignado=="" ){
            
                    alert("Debes seleccionar a un AUDITOR");
                    $("#idAuditorAsignado").focus();
                    
                }*/else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=registroPacientePatologia2",
                        data: info,
            
                        success: function(resp){       

                                alert("Datos guardados correctamente.");
                                url = "http://seguros.hloayza.local/registroPatologia.php";
                                $(location).attr('href',url);
                                
                           
                        }
                    });
                    
                }   
            } 
            
            function registroPacientePatologia3()
            {
              
            
                var info = $("#frmRegistroPacientePato3").serialize();    
                var iduser = $("#iduserPatol").val(); 
              
            
                if(iduser=="" ){
            
                    alert("Debes iniciar sesion");
                }else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=registroPacientePatologia3",
                        data: info,
            
                        success: function(resp){               
                           
                                //url = "https://sighap.com/hnal/registroPatologia.php";
                            //    $(location).attr('href',url);
                            
                            alert("Guardado correctamente");
                           
                        }
                    });
                    
                }   
            } 
            
            function registroPacientePatologia4()
            {
              
            
                var info = $("#frmRegistroPacientePato4").serialize();    
                var iduser = $("#iduserPatol2").val(); 
                var anaMuestra = $("#anaMuestra").val();
              
            
                if(anaMuestra=="0" ){
            
                    alert("Debes seleccionar una opcion");
                }else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=registroPacientePatologia3",
                        data: info,
            
                        success: function(resp){               
                           
                                //url = "https://sighap.com/hnal/registroPatologia.php";
                                //$(location).attr('href',url);
                                alert("Guardado correctamente");
                           
                        }
                    });
                    
                }   
            } 

            function registroPacientePatologia55()
            {
              
            
                var info = $("#frmRegistroPacientePato55").serialize();    
                var iduser = $("#idPat2222").val(); 
                
            
                if(iduser=="0" ){
            
                    alert("Debes iniciar sesion");
                }else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=registroPacientePatologia55",
                        data: info,
            
                        success: function(resp){               
                           
                                //url = "https://sighap.com/hnal/registroPatologia.php";
                                //$(location).attr('href',url);
                                alert("Guardado correctamente");
                           
                        }
                    });
                    
                }   
            } 
            
            function vistaPreviaAp(){
                
                 var idAuditorAsignado = $("#idAuditorAsignado").val();
                 var iduser = $("#iduser2").val();
                 
                 if(idAuditorAsignado != iduser ){
                     
                     alert("Solo puede generar el informe el usuario al cual fue asignado.");
                     
                 }else{
                        
                            var modal = document.getElementById("ventanaModal");

                            
                            var boton = document.getElementById("abrirModal");
                            
                            
                            var span = document.getElementsByClassName("cerrar")[0];
                            
                          
                            boton.addEventListener("click",function() {
                              modal.style.display = "block";
                            });
                            
                            
                            span.addEventListener("click",function() {
                              modal.style.display = "none";
                            });
                            
                            window.addEventListener("click",function(event) {
                              if (event.target == modal) {
                                modal.style.display = "none";
                              }
                            });
                     
                 }
                 
            } 
            
            
            
            function vistaPreviaIhqHq(){
                
                 var idAuditorAsignado = $("#idAuditorAsignado").val();
                 var nomApeConfirApepat = $("#nomApeConfirApepat").val();
                 var iduser = $("#iduser2").val();
                 
                    if(idAuditorAsignado ==""){
                                alert("Seleccione el médico patólogo que confirma el estudio.")
                                
                    }else if(nomApeConfirApepat ==""){
                        alert("Seleccione el médico patólogo que confirma el estudio.")
                        
                    }else if(nomApeConfirApepat != iduser){
                        alert("Solo puede generar el informe el usuario que confirme el estudio.")
                        
                    }else{
                        
                            var modal = document.getElementById("ventanaModalIhqHq");

                            
                            var boton = document.getElementById("btnIhqHq");
                            
                            
                            var span = document.getElementsByClassName("cerrar")[0];
                            
                          
                            boton.addEventListener("click",function() {
                              modal.style.display = "block";
                            });
                            
                            
                            span.addEventListener("click",function() {
                              modal.style.display = "none";
                            });
                            
                            window.addEventListener("click",function(event) {
                              if (event.target == modal) {
                                modal.style.display = "none";
                              }
                            });
                     
                 }
                 
            } 


            
            function vistaPreviaCerEspx(){
                
                var idAuditorAsignado = $("#idAuditorAsignado").val();
                var iduser = $("#iduser2").val();
                
                   if(idAuditorAsignado ==""){
                               alert("Seleccione el médico patólogo que confirma el estudio.")
                               
                   }else{
                       
                           var modal = document.getElementById("ventanaModalCerEspec");
                           var boton = document.getElementById("btnCerEspx");
                           var span = document.getElementsByClassName("cerrar")[0];
                           
                         
                           boton.addEventListener("click",function() {
                             modal.style.display = "block";
                           });
                           
                           
                           span.addEventListener("click",function() {
                             modal.style.display = "none";
                           });
                           
                           window.addEventListener("click",function(event) {
                             if (event.target == modal) {
                               modal.style.display = "none";
                             }
                           });
                    
                }
                
           } 
            
             function generarInformeHistoInmuno()
            {
                
                var idAuditorAsignado = $("#idAuditorAsignado").val();
                var iduser = $("#iduser").val();
                var nomApeConfirApepat = $("#nomApeConfirApepat").val();
                
                /*
                if(iduser==""){
                    alert("debes iniciar sesion");
                }
                
                else if(idAuditorAsignado == iduser ){ */
                    
                                   var anaMuestra = $("#anaMuestra").val();
                                   if(anaMuestra=="1"){
                                    /*        var opcion = confirm("¿Estas seguro que desea generar el informe?. No podrá realizar ninguna modificación.");
                                            if (opcion == true) { */
                                                
                                                        var info = $("#frmRegistroPacientePato4").serialize();    
                                                        var iduser = $("#iduserPatol2").val(); 
                                                      
                                                    
                                                        if(iduser=="" ){
                                                    
                                                            alert("Debes iniciar sesion");
                                                        }else{
                                                           
                                                            $.ajax({
                                                                type: "POST",
                                                                dataType: 'html',
                                                                url: "./Controlador/controllerProcedimientos.php?function=registroPacientePatologia4",
                                                                data: info,
                                                    
                                                                success: function(resp){               
                                                                   
                                                                        
                                                                        
                                                                        var ip = getParameterByName('id');
                                            
                                                                        reg = "http://seguros.hloayza.local/registroPatologia.php";  
                                                                        url = "/pdfAnatomoPatologico.php?id="+ ip;
                                                                        
                                                                        window.open(location.origin+url,'_blank');
                                                                        $(location).attr('href',reg);
                                                                        
                                                                        
                                                                   
                                                                }
                                                            });
                                                            
                                                        }  
                                                    
                                                
                                            /*} else {
                                        	  
                                        	}*/
                                        	
                                   }else if(anaMuestra=="2"){
                                       
                                                        var info = $("#frmRegistroPacientePato4").serialize();    
                                                        var iduser = $("#iduserPatol2").val(); 
                                                      
                                                    
                                                        if(iduser=="" ){
                                                    
                                                            alert("Debes iniciar sesion");
                                                        }else{
                                                           
                                                            $.ajax({
                                                                type: "POST",
                                                                dataType: 'html',
                                                                url: "./Controlador/controllerProcedimientos.php?function=registroPacientePatologia4",
                                                                data: info,
                                                    
                                                                success: function(resp){               
                                                                   
                                                                        url = "http://seguros.hloayza.local/registroPatologia.php";
                                                                        $(location).attr('href',url);
                                                                   
                                                                }
                                                            });
                                                            
                                                        }  
                                       
                                   }
                    
                    
            /*    }else {
                    alert("Solo puede generar el informe el usuario al cual fue asignado.");
                } */
                 
            } 
            
            
            function generarInformeHistoInmunoGen()
            {
              
                var idAuditorAsignado = $("#idAuditorAsignado").val();
                var nomApeConfirApepat = $("#nomApeConfirApepat").val();
                var procedReal = $("#procedReal").val();
                
             
                
               /* var opcion = confirm("¿Estas seguro que desea generar el informe?. No podrá realizar ninguna modificación.");
                
                if (opcion == true) { */
                    
                            var info = $("#frmRegistroPacientePato4").serialize();    
                            var iduser = $("#iduserPatol2").val(); 
                          
                        
                           /* if(idAuditorAsignado ==""){
                                alert("Seleccione el médico patólogo que confirma el estudio.")
                                
                            }else if(nomApeConfirApepat ==""){
                                alert("Seleccione el médico patólogo que confirma el estudio.")
                                
                            }else if(nomApeConfirApepat != iduser){
                                alert("Solo puede generar el informe el usuario al cual fue asignado.")
                                
                            }else{   */
                               
                                $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=registroPacientePatologia4Gen",
                                    data: info,
                        
                                    success: function(resp){
                                        
                                            var ip = getParameterByName('id');
                                            
                                            reg = "http://seguros.hloayza.local/registroPatologia.php";
                                            
                                            if(procedReal==3){
                                                url = "/pdfInmunoHistoquimica.php?id="+ ip;
                                            }else{
                                                url = "/pdfHistoquimica.php?id="+ ip;
                                            }
                                            
                                            
                                            window.open(location.origin+url,'_blank');
                                            $(location).attr('href',reg);
                                       
                                    }
                                    
                                    
                                });
                                
                        /*    }  */
                        
                    
               /* } else {
            	    //alert("Has clickado Cancelar");
            	}*/
              
            
                 
            } 


            function generarInformeCervEspex(){

                    var ip = getParameterByName('id');
                                            
                    url = url = "/pdfAnatomoPatologico2.php?id="+ ip;

                    window.open(location.origin+url,'_blank');
                    $(location).attr('href',reg);

            };
            
        function registroPaqueteMarcador()
            {
              
            
                var info = $("#frmMarcadorHisto").serialize();    
                var iduser = $("#iduser").val(); 
               
               var formatoPatologiaMac = $("#formatoPatologiaMac").val();
               var filtroTipoEst = $("#filtroTipoEst").val();
               var id = getParameterByName('id');
          
            
                if(iduser=="" ){
            
                    alert("Debes iniciar sesion");
                }else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=registroPaqueteMarcador",
                        data: info,
            
                        success: function(resp){               
                           
                             $('#frmMarcadorHisto')[0].reset();                
                             $('#cerrarFrmPakMarcador').click();
                             
                             
                             
                             CargarMarcadoresHisto(formatoPatologiaMac,filtroTipoEst,id);
                             //$('#pac3grupoArchivo').DataTable().ajax.reload(null, false);
                        
                           
                        }
                    });
                    
                }   
            } 
            
            
            
             function registroFechaDig(){
              
            
                var info = $("#frmFecha").serialize();
                var iduser = $("#iduser").val(); 
               
            
                if(iduser=="" ){
            
                    alert("Debes iniciar sesion");
                  
                }else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=registroFechaDig",
                        data: info,
            
                        success: function(resp){               
                           
                             $('#frmFecha')[0].reset();                
                             $('#cerrarFrmPakDig').click();
                             $('#pac3grupoArchivo').DataTable().ajax.reload(null, false);
                        
                           
                        }
                    });
                    
                }   
            } 
            
             function RegAuditorAsignado()
            {
              
            
                var info = $("#formGAudit").serialize();    
                var audiGrupo = $("#audiGrupo").val(); 
                var idusergru = $("#idusergru").val(); 
               
            
            
                if(idusergru=="" ){
            
                    alert("Debes iniciar sesion");
                  
                   
                }else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=RegistroAEm",
                        data: info,
            
                        success: function(resp){               
                           
                             $('#formGAudit')[0].reset();                
                             $('#generaAudi').click();
                             $('#pac3grupo').DataTable().ajax.reload(null, false);
                        
                           
                        }
                    });
                    
                }   
            } 
            
            
            function RegistroCajasObs()
            {
              
            
                var info = $("#formCajas").serialize();    
               // var audiGrupo = $("#audiGrupo").val(); 
                var iduser = $("#iduser").val(); 
               
            
            
                if(iduser=="" ){
            
                    alert("Debes iniciar sesion");
                  
                   
                }else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=RegistroCaja",
                        data: info,
            
                        success: function(resp){               
                           
                            // $('#formCajas')[0].reset();                
                             $('#cerrarModalCaja').click();
                             CargarObservacionesCajas($("#idCaja").val());$("#obsCaja").val("");
                             $('#pac3grupoCaja').DataTable().ajax.reload(null,false);
                             
                               
                            
                           
                        }
                    });
                    
                }   
            } 
            
             function RegistrarPacienteEmCE()
            {
              
            
                var info = $("#formPacienteEmergenCE").serialize();    
                var NroDoc = $("#NroDocCE").val(); 
                var ide = $("#ideCE").val();     
                var nombres = $("#nombresCE").val();   
                var apepa = $("#apepaCE").val();   
                var apema =$("#apemaCE").val();
                var dep =$("#departamento").val();
                var fuaCE =$("#fuaCE").val().length;
                var hisCliCE =$("#hisCliCE").val();
                var NroDocCE =$("#NroDocCE").val();
                var ubicacionCE =$("#ubicacionCE").val();
                var sexoCE =$("#sexoCE").val();
                var FechaNacCE =$("#FechaNacCE").val();
                var feingreCE =$("#feingreCE").val();
                var monGalCE =$("#monGalCE").val();
                var montSifCE =$("#montSifCE").val();
               
            
                var paciente = nombres+ " "+apepa+" "+apema;
            
                /*if(fuaCE<="16" ){
            
                    alert("Debes llenar el campo FUA");
                    
                    $("#fuaCE").focus();
                   
                }else */ if(hisCliCE==""){
            
                    alert("Debes llenar el campo HISTORIA CLINICA");
                   
                    $("#hisCliCE").focus();
                   
                }else if(NroDocCE==""){
            
                    alert("Debes llenar el campo NRO DOCUMENTO");
                   
                    $("#NroDocCE").focus();
                   
                }else if(ubicacionCE==""){
            
                    alert("Debes llenar el campo SERVICIO");
                   
                    $("#ubicacionCE").focus();
                   
                }else if(sexoCE==""){
            
                    alert("Debes llenar el campo SEXO");
                   
                    $("#sexoCE").focus();
                   
                }else if(FechaNacCE==""){
            
                    alert("Debes llenar el campo FECHA NACIMIENTO");
                   
                    $("#FechaNacCE").focus();
                   
                }else if(feingreCE==""){
            
                    alert("Debes llenar el campo FECHA ATENCION");
                   
                    $("#feingreCE").focus();
                   
                }else if(monGalCE==""){
            
                    alert("Debes llenar el campo VALORIZADO MEDIC-INSU");
                   
                    $("#monGalCE").focus();
                   
                }else if(montSifCE==""){
            
                    alert("Debes llenar el campo VALORIZADO PROC-LAB");
                   
                    $("#montSifCE").focus();
                   
                }else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=RegistroPacienteEmCE",
                        data: info,
            
                        success: function(resp){               
                           
                            if(resp == 1){
                                alert("El FUA ya a sido registrado")
                                $('#formPacienteEmergenCE')[0].reset(); 
                            }else{
                                
                                $('#formPacienteEmergenCE')[0].reset();                
                                // $('#cerrar').click();
                                LimpiarFormEmerCE();
                                var iul = $("#idUltimo").val();
                                  var sio = parseFloat(ide) + parseFloat(1);
                                
                                  if(sio <= iul ){
                                       verPacienteEmergenciaCE(sio);
                                  }else{
                                      alert("Fin de registros en este grupo");
                                  }
                                  
                               $('#pac3EmerCE').DataTable().ajax.reload(null, false);
                                   
                               
                            }
                           
                        }
                        
                        
                    });
                    
                }   
            } 


    
    
      function RegistrarPacienteEmCETecnico()
            {
              
            
                var info = $("#formPacienteEmergenCE").serialize();    
                var NroDoc = $("#NroDocCE").val(); 
                var ide = $("#ideCE").val();     
                var nombres = $("#nombresCE").val();   
                var apepa = $("#apepaCE").val();   
                var apema =$("#apemaCE").val();
                var dep =$("#departamento").val();
                var fuaCE =$("#fuaCE").val().length;
                var hisCliCE =$("#hisCliCE").val();
                var NroDocCE =$("#NroDocCE").val();
                var ubicacionCE =$("#ubicacionCE").val();
                var sexoCE =$("#sexoCE").val();
                var FechaNacCE =$("#FechaNacCE").val();
                var feingreCE =$("#feingreCE").val();
                var monGalCE =$("#monGalCE").val();
                var montSifCE =$("#montSifCE").val();
                
            
                var paciente = nombres+ " "+apepa+" "+apema;
            
                /*if(fuaCE<="16" ){
            
                    alert("Debes llenar el campo FUA");
                    
                    $("#fuaCE").focus();
                   
                }else */ if(hisCliCE==""){
            
                    alert("Debes llenar el campo HISTORIA CLINICA");
                   
                    $("#hisCliCE").focus();
                   
                }else if(NroDocCE==""){
            
                    alert("Debes llenar el campo NRO DOCUMENTO");
                   
                    $("#NroDocCE").focus();
                   
                }else if(ubicacionCE==""){
            
                    alert("Debes llenar el campo SERVICIO");
                   
                    $("#ubicacionCE").focus();
                   
                }else if(sexoCE==""){
            
                    alert("Debes llenar el campo SEXO");
                   
                    $("#sexoCE").focus();
                   
                }else if(FechaNacCE==""){
            
                    alert("Debes llenar el campo FECHA NACIMIENTO");
                   
                    $("#FechaNacCE").focus();
                   
                }else if(feingreCE==""){
            
                    alert("Debes llenar el campo FECHA ATENCION");
                   
                    $("#feingreCE").focus();
                   
                }else if(monGalCE==""){
            
                    alert("Debes llenar el campo VALORIZADO MEDIC-INSU");
                   
                    $("#monGalCE").focus();
                   
                }else if(montSifCE==""){
            
                    alert("Debes llenar el campo VALORIZADO PROC-LAB");
                   
                    $("#montSifCE").focus();
                   
                }else{
                   
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=RegistroPacienteEmCE",
                        data: info,
            
                        success: function(resp){               
                           
                            if(resp == 1){
                                
                                alert("El FUA ya a sido registrado")
                                $('#formPacienteEmergenCE')[0].reset(); 
                                
                            }else{
                                
                                $('#formPacienteEmergenCE')[0].reset();                
                                // $('#cerrar').click();
                                LimpiarFormEmerCE();
                                $('#pac3EmerCE').DataTable().ajax.reload(null, false);
                                   
                            }
                           
                        }
                        
                        
                    });
                    
                }   
            } 

                function buscarDniEm(){
    
                             var doc = $("#NroDoc").val();
                             $.ajax({  
                             type: "POST",  
                             url: "http://seguros.hloayza.local/apidni.php?dni="+ doc,    
                             dataType: "json", 
                             success: function (data) { 
                                
                                 $("#apepa").val(data[5]);
                                 $("#apema").val(data[6]);
                                 $("#nombres").val(data[4]);
                                 
                                
                             }, 
                         });    
    
                }
                
                function buscarDniEmCE(){
    
                             var doc = $("#NroDocCE").val();
                             $.ajax({  
                             type: "POST",  
                             url: "http://seguros.hloayza.local/apidni.php?dni="+ doc,    
                             dataType: "json", 
                             success: function (data) { 
                                
                                 $("#apepaCE").val(data[5]);
                                 $("#apemaCE").val(data[6]);
                                 $("#nombresCE").val(data[4]);
                                 
                                
                             }, 
                         });    
    
                }
                
                
                function buscarDniEmCERef(doc,campo){
    
                             
                             $.ajax({  
                             type: "POST",  
                             url: "http://seguros.hloayza.local/apidni.php?dni="+ doc,    
                             dataType: "json", 
                             success: function (data) { 
                                
                                 $(campo).val(data[5] +" "+ data[6] + " " + data[4] );
                                 
                                 
                                
                             }, 
                         });    
    
                }
                
                
                function buscarCorrelPatf(tipoEstudio,tipoproced){
    
                             var nroOrdenPat = $("#nroOrdenPat").val();
                             
                             $.ajax({  
                             type: "POST",  
                             url: "./Controlador/search.php?function=buscarCorrelPatf&tipo=" + tipoEstudio+"&proc="+tipoproced,    
                             dataType: "json", 
                             success: function (data) { 
                                
                                //alert(data[0]);
                                 $("#corPat").val(data[0]);
                                 
                                    /* if(nroOrdenPat=="-" || nroOrdenPat==""){
                                        $("#nroOrdenPat").val(data[1]);    
                                     }*/
                                 
                                 $("#nroOrdenPat").val(data[1]);
                                 $("#formatoPatologiaMac").val(data[1]);
                                 $("#filtroTipoEst").val(tipoEstudio);
                                 
                                 
                                
                             }, 
                         });    
    
                }
                
                function buscarDniEmCEUser(){
    
                             var doc = $("#teleusu").val();
                             $.ajax({  
                             type: "POST",  
                             url: "http://seguros.hloayza.local/apidni.php?dni="+ doc,    
                             dataType: "json", 
                             success: function (data) { 
                                
                                 $("#nomusu").val(data[5] +" " +data[6]+","+ data[4]);
                                
                             }, 
                         });    
    
                }
                
                
               /*  function buscarDniEm(){
    
                             var doc = $("#NroDoc").val();
                             $.ajax({  
                             type: "POST",  
                             url: "https://api.paconsultar.com/api/v1/services/query-dni?dni="+doc+"&token=efea7dd0ff3e4ac0eda1ff7829e6da934a2ac19f3052cc85b90509827d517e2f",    
                             dataType: "json", 
                             success: function (data) {  
                                
                                   $.each(data, function(i,item){
                                          
                                       if(item.data != "undefined"){
                                           $("#nombres").val(item.names);
                                           $("#apepa").val(item.surname);
                                           $("#apema").val(item.second_surname);
                                           $("#FechaNac").val(item.date_birth);
                                           $("#sexo").val(item.gender);
                                           $("#edad").val(calcularEdad($("#FechaNac").val()));
                                            
                                       }
                                     
                                     
                                    });
                             }, //End of AJAX Success function  
                         });    
    
                } */

                    function dniQuimi(){
    
                             var doc = $("#dniQuimi").val();
                             $.ajax({  
                             type: "POST",  
                             url: "https://api.paconsultar.com/api/v1/services/query-dni?dni="+doc+"&token=hIGLihjHGjacfdCagbfgTwVxWTzvVzoNqspoOnqO",    
                             dataType: "json", 
                             success: function (data) {  
                                
                                   $.each(data, function(i,item){
                                          
                                       if(item.data != "undefined"){
                                           
                                               $("#pacienteQ").val(item.surname+' '+item.second_surname+' '+item.names );
                                               $("#fechaNacQuimi").val(item.date_birth);
                                               $("#edadQuimi").val(calcularEdad($("#fechaNacQuimi").val()));
                                            
                                       }
                                     
                                    });
                                    
                             }, //End of AJAX Success function  
                             
                         });    
    
                }
                
                
                                    
            function  webServiceSis(ide){
                    
                   
                       var tipoDoc = $("#tipoDoc").val();
                    
                        $.ajax({
                            
                            url:'http://seguros.hloayza.local/webservice/index.php',
                            type:'GET',
                            dataType:'json',
                            data:{ id:ide             
                        },                    
                        }).done(function(datos){
                    
                            var idSesion = datos[0];
                           // alert(idSesion); 
                                $.ajax({
                                
                                    url:'http://seguros.hloayza.local/webservice/datos.php',
                                    type:'GET',
                                    dataType:'json',
                                    data:{ idSe:idSesion,id:ide,tipo:tipoDoc},
                                    
                                }).done(function(datos){
                                    
                                    $("#apepa").val(datos[3]);
                                    $("#apema").val(datos[4]);
                                    $("#nombres").val(datos[5]);
                                    $("#statusRegPax").val(datos[16]);
                                    $("#NroAf").val(datos[14]);
                                    $("#FechaNac").val(datos[20]);
                                    
                                    if(datos[19]=="0"){
                                        $("#sexo").val("2");
                                    }else if(datos[19]=="1"){
                                        $("#sexo").val("1");
                                    }
                                    
                                    $("#edad").val(calcularEdadRegistroHospiEmer(datos[20]));
                                    $("#regWebSis").val(datos[11]);
                                    $("#planWebSis").val(datos[12]);
                                    $("#fechaAful").val(datos[6]);
                                   
                                
                                });
                    
                        });
                    
                    
                    }
                    
                    
                    


                        function  webServiceSis2(ide,tipoDoc){
                    
                               // alert("(HTTP) 500 Internal Server Error");
                                   
                                   
                               var tipoDoc = '';
                                if($("#tipoDoc").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDoc").val();
                                }
                                
                   
                                $.ajax({
                                
                                    url:'http://seguros.hloayza.local/webservice/webservice.php',
                                    type:'GET',
                                    dataType:'json',
                                    data:{ id:ide,tipo:tipoDoc},
                                    
                                }).done(function(datos){
                                    
                                    $("#apepa").val(datos[3]);
                                    $("#apema").val(datos[4]);
                                    $("#nombres").val(datos[5]);
                                    $("#statusRegPax").val(datos[16]);
                                    $("#NroAf").val(datos[14]);
                                    $("#FechaNac").val(datos[20]);
                                    
                                    if(datos[19]=="0"){
                                        $("#sexo").val("2");
                                    }else if(datos[19]=="1"){
                                        $("#sexo").val("1");
                                    }
                                    
                                    $("#edad").val(calcularEdadRegistroHospiEmer(datos[20]));
                                    $("#regWebSis").val(datos[11]);
                                    $("#planWebSis").val(datos[12]);
                                    $("#fechaAful").val(datos[6]);
                                   
                                   if(datos[16]==''){
                                       alert('No se encontraron resultados, confirmar en la página web del SIS');
                                       $("#statusRegPax").val('');
                                   }
                                
                                });
                                
                                
                                
            
                    }

                    
                    function  webServiceSis2Ref(ide,tipoDoc){
                    
                   
                                  //alert("(HTTP) 500 Internal Server Error");
                            var tipoDoc = '';
                                if($("#tipoDocRef").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDocRef").val();
                                }
                                
                   
                                $.ajax({
                                
                                    url:'http://seguros.hloayza.local/webservice/webservice.php',
                                    type:'GET',
                                    dataType:'json',
                                    data:{ id:ide,tipo:tipoDoc},
                                    
                                }).done(function(datos){
                                    
                                    $("#paxRef").val(datos[3] +" "+datos[4]+" "+datos[5]);
                                    $("#afiliaRef").val(datos[14]);
                                    $("#FechaNacRef").val(datos[20]);
                                    
                                    if(datos[19]=="0"){
                                        $("#sexoRef").val("2");
                                    }else if(datos[19]=="1"){
                                        $("#sexoRef").val("1");
                                    }
                                    
                                    $("#edadRef").val(calcularEdadRegistroHospiEmer(datos[20]));
                                    $("#regWebSis").val(datos[11]);
                                    $("#planWebSis").val(datos[12]);
                                    $("#fechaAful").val(datos[6]);
                                    $("#caduciRef").val(datos[15]);
                                   
                                   if(datos[16]==''){
                                       alert('No se encontraron resultados, confirmar en la página web del SIS');
                                       cargarFinanciamentoRef(1);
                                       cargarPlanSaludGroup(0,1);
                                   }else{
                                        cargarFinanciamentoRef(2);
                                         cargarPlanSaludGroup(0,2);
                                   }
                                
                                });
            
                    }


                function  webServiceSisCiru(ide,tipoDoc){
                    
                   
                                $.ajax({
                                
                                    url:'http://seguros.hloayza.local/webservice/webservice.php',
                                    type:'GET',
                                    dataType:'json',
                                    data:{ id:ide,tipo:tipoDoc},
                                    
                                }).done(function(datos){
                                    
                                    if(datos[0]!="NO SE ENCONTRO AFILIACION PARA EL DNI CONSULTADO"){
                                        
                                        $("#pacienCIruProg").val(datos[3] +" "+datos[4]+" "+datos[5]);
                                        $("#edadCiruProg").val(calcularEdadRegistroHospiEmer(datos[20]));
                                        $("#financiaCirugia").val("2")
                                        
                                    }else{
                                        
                                        alert("NO SE ENOONTRÓ LOS DATOS DEL PACIENTE, CONSULTE LA PÁGINA DE CONSULTA EN LINEA.");
                                    }
                                    
                                    
                                });
                                
                                
            
                    }
                    
                    
                    function  webServiceSisPato(ide,tipoDoc){
                    
                   
                                $.ajax({
                                
                                    url:'http://seguros.hloayza.local/webservice/webservice.php',
                                    type:'GET',
                                    dataType:'json',
                                    data:{ id:ide,tipo:tipoDoc},
                                    
                                }).done(function(datos){
                                    
                                    if(datos[0]!="NO SE ENCONTRO AFILIACION PARA EL DNI CONSULTADO"){
                                        
                                        $("#pacientePato").val(datos[3] +" "+datos[4]+" "+datos[5]);
                                        $("#edadPato").val(calcularEdadRegistroHospiEmer(datos[20]));
                                        $("#financiaPTO").val("2");
                                        if(datos[19]==1){
                                             $("#sexoPat").val("M");
                                        }else{
                                             $("#sexoPat").val("F");
                                        }
                                        
                                        $("#iprId").val(datos[8]);
                                        buscarIpress(datos[7]);
                                       
                                        
                                    }else{
                                        
                                       // alert("NO SE ENOONTRÓ LOS DATOS DEL PACIENTE, CONSULTE LA PÁGINA DE CONSULTA EN LINEA.");
                                    }
                                    
                                    
                                });
                                
                                
            
                    }


                   /* function  webServiceSisCiru(ide,tipoDoc){
                    
                   
                       //var tipoDoc = $("#tipoDocCiru").val();
                    
                        $.ajax({
                            
                            url:'http://seguros.hloayza.local/webservice/index.php',
                            type:'GET',
                            dataType:'json',
                            data:{ id:ide             
                        },                    
                        }).done(function(datos){
                    
                            var idSesion = datos[0];
                           
                                $.ajax({
                                
                                    url:'http://seguros.hloayza.local/webservice/datos.php',
                                    type:'GET',
                                    dataType:'json',
                                    data:{ idSe:idSesion,id:ide,tipo:tipoDoc},
                                    
                                }).done(function(datos){
                                    
                                    
                                    $("#pacienCIruProg").val(datos[3]+ ' ' +datos[4]+ ' ' +datos[5] );
                                    $("#edadCiruProg").val(calcularEdadRegistroHospiEmer(datos[20]));
                                    
                                   
                                });
                    
                        });
                    
                    
                    }*/
                    
                    function  webServiceCuenta(ide){
                    
                               // alert("(HTTP) 500 Internal Server Error");
                            
                               var tipoDoc = '';
                                if($("#tipoDoc").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDoc").val();
                                }
                                
                   
                                $.ajax({
                                
                                    url:'http://seguros.hloayza.local/webservice/wscuenta.php',
                                    type:'GET',
                                    dataType:'json',
                                    data:{ cuenta:ide},
                                    
                                }).done(function(datos){
                                    
                                  $("#hisCli").val(datos[0]);
                                  
                                  if(datos[1]=="DNI"){
                                      $("#tipoDoc").val(1);
                                  }else{
                                      $("#tipoDoc").val(2);
                                  }
                                  
                                  $("#NroDoc").val(datos[2]);
                                  $("#apepa").val(datos[3]);
                                  $("#apema").val(datos[4]);
                                  $("#nombres").val(datos[5]);
                                  $("#sexo").val(datos[6]);
                                  $("#FechaNac").val(datos[8]);
                                  $("#edad").val(datos[9]);
                                  $("#nroFuaInter").val("00006207-24-"+datos[10]);
                                  $("#fua").val("00006207-24-"+datos[10]);
                                  $("#feingre").val(datos[14]);
                                  if(datos[15]!="1969-12-31"){
                                       $("#feAltaAlt").val(datos[15]);
                                  }
                                 
                                    if(datos[11]!=".0000"){
                                        $("#monGal").val(datos[11]);
                                    }
                                 
                                   
                                   if(datos[16]=="Hospitalización "){
                                       $("#pab1Hos option:contains("+datos[12]+")").attr('selected', true);
                                       $("#pab2Hos option:contains("+datos[13]+")").attr('selected', true);
                                   }else{
                                       $("#tipoSeiN option:contains("+datos[12]+")").attr('selected', true);
                                       $("#tipoSeiNDes option:contains("+datos[13]+")").attr('selected', true);
                                   }
                                 $("#serEspecia").val(datos[12]);
                                   $("#rsatencion").val(datos[17]);
                                   
                                   
                                });
            
                    }
                    
                    
                    function  webServiceCuentaPat(ide){
                    
                             
                            
                   
                                $.ajax({
                                
                                    url:'http://seguros.hloayza.local/webservice/wscuenta.php',
                                    type:'GET',
                                    dataType:'json',
                                    data:{ cuenta:ide},
                                    
                                }).done(function(datos){
                                    
                                  $("#historiaPat").val(datos[0]);
                                   $("#servicioPat").val(datos[12]);
                                  
                                   
                                });
            
                    }

                function  validarSis(){
                    
                    
                    //alert("(HTTP) 500 Internal Server Error");

                    
                    
                        var item = $("#ide").val();
                        var ide = $("#NroDoc").val();
                        var tipoDoc = '';
                                if($("#tipoDoc").val()=="2"){
                                    tipoDoc = '3';
                                }else{
                                    tipoDoc = $("#tipoDoc").val();
                                }
                                
                    
                        $.ajax({
                            
                            url:'http://seguros.hloayza.local/webservice/index.php',
                            type:'GET',
                            dataType:'json',
                            data:{ id:ide             
                        },                    
                        }).done(function(datos){
                    
                            var idSesion = datos[0];
                           // alert(idSesion); 
                                $.ajax({
                                
                                    url:'http://seguros.hloayza.local/webservice/datos.php',
                                    type:'GET',
                                    dataType:'json',
                                    data:{ idSe:idSesion,id:ide,tipo:tipoDoc},
                                    
                                }).done(function(datos){
                                                    if(datos[16]!="ACTIVO"){
                                                        alert("Consultar en la página web del SIS");
                                                    }
                                                    
                                                    var user = $("#iduser").val();
                                                    var status = datos[16];
                                                    var regWebSis =datos[11];
                                                    var planWebSis =datos[12];
                                                    var fechaAful =datos[6];
                                                    var nroAfil =datos[14];
                                                    var fechacaducidad =datos[15];
                                                    
                                                   
                                                   $.ajax({
                                                        type: "POST",
                                                        dataType: 'html',
                                                        url: "./Controlador/controllerProcedimientos.php?function=RegistroDatosWs",
                                                        data: "user="+user+"&status="+status+"&regWebSis="+regWebSis+"&planWebSis="+planWebSis+"&fechaAful="+fechaAful+"&nroAfil="+nroAfil+"&fechacaducidad="+fechacaducidad+"&nroDoc="+ide+"&item="+item,
                                            
                                                        success: function(resp){               
                                                           $('#pac3Emer').DataTable().ajax.reload(null, false);
                                                           alert("Actualizado correctamente");
                                                           
                                                        }
                                                        
                                                    });
                                                
                                });
                    
                         
                        });
                    
                    }
                    
                    
                    
                    function  validarSisMasivo(){
                        
                    
                        var opcion = confirm("¿Estas seguro de la validación masiva?");
                        
                            if (opcion == true) {
                                var user1 = $("#iduser").val();
                                             
                                              
                                                var ser = '';
                                                   var tix = getParameterByName('tipo');
                                                   
                                                   if(tix ==1){
                                                       ser =   $('#ser').val();
                                                   }else if(tix ==2){
                                                       ser =   $('#pa').val();
                                                   }
                                             
                                                   
                                                    $.post('./Controlador/search.php?function=obtenerData&ser='+ser+"&tipo="+tix,
                                                
                                                    function(data){
                                                    
                                                         if (data != "[]") {
                                                             
                                                            var item = $.parseJSON(data);
                                                            
                                                            $.each(item, function (i, valor) {
                                                          
                                                                        $.ajax({
                                                                                
                                                                                url:'http://seguros.hloayza.local/webservice/index.php',
                                                                                type:'GET',
                                                                                dataType:'json',
                                                                                data:{ id:valor.DOCE},
                                                                        
                                                                        }).done(function(datos){
                                                                                 
                                                                                var idSesion = datos[0];
                                                                          
                                                                                $.ajax({
                                                                                
                                                                                    url:'http://seguros.hloayza.local/webservice/datos.php',
                                                                                    type:'GET',
                                                                                    dataType:'json',
                                                                                    data:{ idSe:idSesion,id:valor.DOCE,tipo:valor.tipoDoc},
                                                                                   
                                                                                }).done(function(datos){
                                                                                    
                                                                                            var user = $("#iduser").val();
                                                                                            var status = datos[16];
                                                                                            var regWebSis =datos[11];
                                                                                            var planWebSis =datos[12];
                                                                                            var fechaAful =datos[6];
                                                                                            var nroAfil =datos[14];
                                                                                            var fechacaducidad =datos[15];
                                                                                           
                                                                                           $.ajax({
                                                                                               
                                                                                                type: "POST",
                                                                                                dataType: 'html',
                                                                                                url: "./Controlador/controllerProcedimientos.php?function=RegistroDatosWsMasivo",
                                                                                                data: "user="+user+"&status="+status+"&regWebSis="+regWebSis+"&planWebSis="+planWebSis+"&fechaAful="+fechaAful+"&nroAfil="+nroAfil+"&fechacaducidad="+fechacaducidad+"&nroDoc="+valor.DOCE+"&tipoDoc="+valor.tipoDoc+"&idVal="+valor.idEm,
                                                                                    
                                                                                                success: function(resp){
                                                                                                    
                                                                                                  // $('#pac3Emer').DataTable().ajax.reload(null, false);
                                                                                                  // $("#verEstadoMasivo").attr("src","reporteEstadoMasivo.php?ser=" + ser+"&tipo="+tix+"&user="+user);
                                                                                                   $('#verEstadoMasivo').load("reporteEstadoMasivo.php?ser=" + ser+"&tipo="+tix+"&user="+user);
                                                                                                   
                                                                                                }
                                                                                                
                                                                                            });
                                                                                                    
                                                                                });
                                                                    
                                                                            
                                                                         
                                                                         });
                                                        
                                                                 //
                                                                 
                                                                 
                                                                    });
                                                                    
                                                             
                                                                
                                                            }
                                                            
                                                          //alert("Actualizacion masiva correctamente");
                                                    });            
                                                
                                                
                                    ///FIN DE OBTENER  DATA
                                    
                                    
                                          /*  setTimeout(function (){
                                                alert("Actualizacion masiva correctamente");
                                            }, 50000);*/
                                            
                                            
                                                
                                
                            } else {
                        	        
                        	        alert("Cancelaste la solicitud")
                            }
                            
                    
                    }
                    
                    
                    
                    
                function registrarAuditoriaRotulos(id,code,rotulo,cat,guardar){
                    
                    var chek ='';
                    var procePat = $("#procePat").val();
                    var formatoPatologiaMac = $("#formatoPatologiaMac").val();
                    var filtroTipoEst = $("#filtroTipoEst").val();

                    if( $('#'+code+cat+guardar).is(':checked') ){
                        chek ='checked';
                    } 
                    
                    if(id!=""){
                          $.ajax({
                            
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=RegistroDetallesRotulo",
                                data: "id="+id+"&code="+code+"&rotulo="+rotulo+"&chek="+chek+"&cat="+cat+"&gua="+guardar,
                    
                                success: function(resp){               
                                   
                                   //alert("Actualizado correctamente");
                                  
                                     
                            
                                     if(procePat==13){
                                        
                                          CargarTacosPat(3,formatoPatologiaMac,filtroTipoEst);
                                         
                                     }else{
                                          
                                          CargarTacosPat(1,formatoPatologiaMac,filtroTipoEst)
                                     }
                                   
                        
                                   
                                   
                                }
                                
                            });
                    }else{
                        alert("Debes seleccionar una opcion");
                    }
                    
        
                    
                }
                
                
                function registrarUserHisto(id,user,cer){
                    
                    var chek ='';
                    var formatoPatologiaMac = $("#formatoPatologiaMac").val();
                     var filtroTipoEst = $("#filtroTipoEst").val();
                    
                    if( $('#'+id).is(':checked') ){
                        chek ='checked';
                    
                    }
                    
                    if(id!=""){
                          $.ajax({
                            
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=registrarUserHisto",
                                data: "id="+id+"&chek="+chek+"&user="+user,
                    
                                success: function(resp){               
                                   
                                    //CargarRotulosHistoqui(3,3,formatoPatologiaMac,filtroTipoEst);
                                  
                                   
                                   if(cer==2){
                                       CargarRotulosHistoqui(1,2,formatoPatologiaMac,filtroTipoEst);
                                   }else if(cer==3){
                                       CargarRotulosHistoquiCervicoVaginal(3,0,formatoPatologiaMac,filtroTipoEst);
                                   }
                                   
                                   
                                }
                                
                            });
                    }else{
                        alert("Debes seleccionar una opcion");
                    }
                    
        
                    
                }
                    
                    
                function disabledButton(div){
                    
                    $("#"+div+"  input").attr("disabled", false);
                    $("#btnDisabled"+div).addClass("hidden");
                    $("#btnEnabled"+div).removeClass("hidden");
                    
                }
                
                
                function enabledButton(div){
                    
                    $("#"+div+"  input").attr("disabled", true);
                     $("#btnEnabled"+div).addClass("hidden");
                     $("#btnDisabled"+div).removeClass("hidden");
                }
                
                
                function  aplicaReglaConsistencia(id){
                    
                
                        $.ajax({
                            
                            url:'./Controlador/search.php?function=buscarPacix',
                            type:'GET',
                            dataType:'json',
                            data:{ id:id             
                        },                    
                        }).done(function(datos){
                    
                    
                            
                            var iduser = datos[0];
                            var idPac = datos[1];
                            var codPre = datos[2];
                            var prioridad = datos[3];
                            var estancia = datos[4];
                            
                           if(prioridad !=""){
                               

                                    $.get('./Controlador/search.php?function=buscarReglaCons&codPre='+codPre+"&prioridad="+prioridad, 	    
                                    function(data){
                                       
                                            var item = $.parseJSON(data);
//console.log(item);
                                            $.each(item, function (i, valor) {
                                                                 
                                                        var codCpms = valor.codCpms;
                                                        var cantidad = valor.CNT;
                                                        var deno2 = valor.deno2;
                                                        var II_nivel = valor.II_nivel;
                                                        
                                                         $.ajax({
                                                            type: "POST",
                                                            dataType: 'html',
                                                            url: "./Controlador/controllerProcedimientos.php?function=RegistroReglaConsistencia",
                                                            data: "iduser="+iduser+"&idPac="+idPac+"&codCpms="+codCpms+"&cantidad="+cantidad+"&descripcion="+deno2+"&precio="+II_nivel+"&estancia="+estancia,
                                                
                                                            success: function(resp){   
                                                                
                                                                     Cargar1(idPac);
                                                            }
                                                            
                                                        });
                                                                   
                                            })
                                            
                                    });     
                                
                               }
                         
                        });
                    
                    }

                /*function buscarDniEmCE(){
    
                             var doc = $("#NroDocCE").val();
                             $.ajax({  
                             type: "POST",  
                             url: "https://api.paconsultar.com/api/v1/services/query-dni?dni="+doc+"&token=hIGLihjHGjacfdCagbfgTwVxWTzvVzoNqspoOnqO",    
                             dataType: "json", 
                             success: function (data) {  
                                
                                   $.each(data, function(i,item){
                                          
                                       if(item.data != "undefined"){
                                           $("#nombresCE").val(item.names);
                                           $("#apepaCE").val(item.surname);
                                           $("#apemaCE").val(item.second_surname);
                                           $("#FechaNacCE").val(item.date_birth);
                                           $("#sexoCE").val(item.gender);
                                           $("#edadCE").val(calcularEdad($("#FechaNacCE").val()));
                                           
                                            
                                       }
                                     
                                     
                                    });
                             }, //End of AJAX Success function  
                         });    
    
                }
*/

/*
                    function buscarDniCpms(){
    
                             var doc = $("#dni").val();
                             $.ajax({  
                             type: "POST",  
                             url: "https://api.paconsultar.com/api/v1/services/query-dni?dni="+doc+"&token=hIGLihjHGjacfdCagbfgTwVxWTzvVzoNqspoOnqO",    
                             dataType: "json", 
                             success: function (data) {  
                                
                                   $.each(data, function(i,item){
                                          
                                       if(item.data != "undefined"){
                                           
                                           $("#paciente").val(item.surname + " "+ item.second_surname +" "+item.names);
                                         
                                       }
                                     
                                     
                                    });
                             }, //End of AJAX Success function  
                         });    
    
                } */
                
                
                function buscarDniCpms(){
    
                    var doc = $("#dni").val();
                    $.ajax({  
                    type: "POST",  
                    url: "http://seguros.hloayza.local/apidni.php?dni="+ doc,    
                    dataType: "json", 
                    success: function (data) { 
                       
                        $("#paciente").val(data[7]);
                       
                       
                    }, 
                });    
                
                }


/*
function cargarAuditor() {
 
    $.get('./Controlador/search.php?function=auditor', 	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               
               $("#audi").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                       $("#audi").append('<option value="' + valor.id + '">' + valor.nom + '</option>');	
               });
           }
       return false;
   });
} */




    function cargarProfesionSys() {
    
          $.post('./Controlador/search.php?function=profesionFor', 	
          function(data){
          
            if (data != "[]") {
                  var item = $.parseJSON(data);
                  $('#profeSys').empty();
                  $("#profeSys").append('<option value="0">Seleccionar</option>');
                  $.each(item, function (i, valor) {
                      if (valor.idP !== null) {
                            $("#profeSys").append('<option value="' + valor.idP + '">' + valor.descripcion + '</option>');	
                        }
                  });

              }

          return false;
          });
   }
   
   
   function cargarResultadoHisto(id) {
    
          $.post('./Controlador/search.php?function=listResultadoHisto&id='+ id, 	
          function(data){
          
            if (data != "[]") {
                  var item = $.parseJSON(data);
                  $('#resulDepend').empty();
                  $("#resulDepend").append('<option value="0">Seleccionar</option>');
                  $.each(item, function (i, valor) {
                      if (valor.IdRecep !== null) {
                            $("#resulDepend").append('<option value="' + valor.IdRecep + '">' + valor.Descripcion + '</option>');	
                        }
                  });

              }

          return false;
          });
   }
  
  
  function cargarlistEmbarazo(id) {
    
          $.post('./Controlador/search.php?function=listEmbarazo', 	
          function(data){
          
            if (data != "[]") {
                  var item = $.parseJSON(data);
                  $('#listEmbarazo').empty();
                  $("#listEmbarazo").append('<option value="0">Seleccionar</option>');
                  $.each(item, function (i, valor) {
                      
                      if (valor.IdEmbarazo == id) {
                           $("#listEmbarazo").append('<option value="' + valor.IdEmbarazo + '" selected>' + valor.Descripcion + '</option>');
                      }else{
                           $("#listEmbarazo").append('<option value="' + valor.IdEmbarazo + '">' + valor.Descripcion + '</option>');
                      }
                     
                  });

              }

          return false;
          });
   }
  
  
  function cargarlistMetodoAnticonceptivo(id) {
    
          $.post('./Controlador/search.php?function=listMetodoAnticonceptivo', 	
          function(data){
          
            if (data != "[]") {
                  var item = $.parseJSON(data);
                  $('#listMetodoAnti').empty();
                  $("#listMetodoAnti").append('<option value="0">Seleccionar</option>');
                  $.each(item, function (i, valor) {
                      if (valor.IdUso == id) {
                            $("#listMetodoAnti").append('<option value="' + valor.IdUso + '" selected >' + valor.Descripcion + '</option>');	
                        }else {
                             $("#listMetodoAnti").append('<option value="' + valor.IdUso + '" >' + valor.Descripcion + '</option>');
                        }
                  });

              }

          return false;
          });
   }
  
  
  function cargarlistTipoAnticonceptivo(id) {
    
          $.post('./Controlador/search.php?function=listTipoMetodoAntic', 	
          function(data){
          
            if (data != "[]") {
                  var item = $.parseJSON(data);
                  $('#listTipoMetodoAntic').empty();
                  $("#listTipoMetodoAntic").append('<option value="0">Seleccionar</option>');
                  $.each(item, function (i, valor) {
                      if (valor.IdTipoMAC == id) {
                            $("#listTipoMetodoAntic").append('<option value="' + valor.IdTipoMAC + '" selected>' + valor.Descripcion + '</option>');	
                        }else{
                            $("#listTipoMetodoAntic").append('<option value="' + valor.IdTipoMAC + '">' + valor.Descripcion + '</option>');	
                        }
                  });

              }

          return false;
          });
   }
   
   function cargarlistExamenGineco(id) {
    
          $.post('./Controlador/search.php?function=listExamenGineco', 	
          function(data){
          
            if (data != "[]") {
                  var item = $.parseJSON(data);
                  $('#listExaGineco').empty();
                  $("#listExaGineco").append('<option value="0">Seleccionar</option>');
                  $.each(item, function (i, valor) {
                      if (valor.IdExamen == id) {
                            $("#listExaGineco").append('<option value="' + valor.IdExamen + '" selected>' + valor.Descripcion + '</option>');	
                        }else {
                              $("#listExaGineco").append('<option value="' + valor.IdExamen + '">' + valor.Descripcion + '</option>');
                        }
                  });

              }

          return false;
          });
   }
   
  
   function cargarIntensidadTincion() {
    
          $.post('./Controlador/search.php?function=listIntensidadTincion', 	
          function(data){
          
            if (data != "[]") {
                  var item = $.parseJSON(data);
                  $('#intesTincion').empty();
                  $("#intesTincion").append('<option value="0">Seleccionar</option>');
                  $.each(item, function (i, valor) {
                      if (valor.IdIntensidad !== null) {
                            $("#intesTincion").append('<option value="' + valor.IdIntensidad + '">' + valor.TipoIntensidad + '</option>');	
                        }
                  });

              }

          return false;
          });
   }
  
  
  
   function cargaNucleosPositivos() {
    
          $.post('./Controlador/search.php?function=listNucleosPositivos', 	
          function(data){
          
            if (data != "[]") {
                  var item = $.parseJSON(data);
                  $('#nucleosPos').empty();
                  $("#nucleosPos").append('<option value="0">Seleccionar</option>');
                  $.each(item, function (i, valor) {
                      if (valor.IdPorcentaje !== null) {
                            $("#nucleosPos").append('<option value="' + valor.IdPorcentaje + '">' + valor.PorcentCelulas + '</option>');	
                        }
                  });

              }

          return false;
          });
   }
  
  
  
  function cargoOcupa(ipress) {
    
          $.post('./Controlador/search.php?function=cargoOcupa&id='+ ipress, 	
          function(data){
          
            if (data != "[]") {
                  var item = $.parseJSON(data);
                  $('#cagoocu').empty();
                  $("#cagoocu").append('<option value="0">Seleccionar</option>');
                  $.each(item, function (i, valor) {
                      if (valor.Id !== null) {
                            $("#cagoocu").append('<option value="' + valor.Id + '">' + valor.descripcion + '</option>');	
                        }
                  });

              }

          return false;
          });
   }
  
  function cargarOfUnid() {
    
          $.post('./Controlador/search.php?function=ofiUnFor', 	
          function(data){
          
            if (data != "[]") {
                  var item = $.parseJSON(data);
                  $('#areaUnid').empty();
                  $("#areaUnid").append('<option value="0">Seleccionar</option>');
                  $.each(item, function (i, valor) {
                      if (valor.idOf !== null) {
                            $("#areaUnid").append('<option value="' + valor.idOf + '">' + valor.descripcion + '</option>');	
                        }
                  });

              }

          return false;
          });
   }
   
   function areaList() {
    
          $.post('./Controlador/search.php?function=listArea', 	
          function(data){
          
            if (data != "[]") {
                  var item = $.parseJSON(data);
                  $('#areaUnid').empty();
                  $("#areaUnid").append('<option value="0">Seleccionar</option>');
                  $.each(item, function (i, valor) {
                      if (valor.IdSubArea !== null) {
                            $("#areaUnid").append('<option value="' + valor.IdSubArea + '">' + valor.SubArea + '</option>');	
                        }
                  });

              }

          return false;
          });
   }

function cargarAuditorQuimio(id) {
 
    $.get('./Controlador/search.php?function=auditorQuimio&id='+ id, 	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               
               $("#asiAudiQa").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                       $("#asiAudiQa").append('<option value="' + valor.id + '">' + valor.auditor + '</option>');	
               });
           }
       return false;
   });
} 

function cargarServices() {
 
    $.get('./Controlador/search.php?function=services', 	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               
               $("#servicio").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                       $("#servicio").append('<option value="' + valor.servicio + '">' + valor.servicio + '</option>');	
               });
           }
       return false;
   });
}


function cargarServicesCE() {
 
    $.get('./Controlador/search.php?function=servicesCE', 	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               
               $("#ubicacionCE").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                       $("#ubicacionCE").append('<option value="' + valor.id + '">' + valor.descripcion + '</option>');	
               });
           }
       return false;
   });
}



function cargarPresHospi(id) {
 
    $.get('./Controlador/search.php?function=codPresHos', 	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               $('#ubiSerHosp').empty();
               $("#ubiSerHosp").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                   
                    if (valor.idCod == id) {
                       $("#ubiSerHosp").append('<option value="' + valor.idCod + '" selected>' + valor.descripcion + '</option>');
                    }else{ 
                         $("#ubiSerHosp").append('<option value="' + valor.idCod + '">' + valor.descripcion + '</option>');
                    }
               });
           }
       return false;
   });
}



function cargarPresHospiCE(id) {
 
    $.get('./Controlador/search.php?function=codPresHosCE', 	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               $('#ubiSerHospCE').empty();
               $("#ubiSerHospCE").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                   
                    if (valor.id == id) {
                       $("#ubiSerHospCE").append('<option value="' + valor.id + '" selected>' + valor.descripcion + '</option>');
                    }else{ 
                         $("#ubiSerHospCE").append('<option value="' + valor.id + '">' + valor.descripcion + '</option>');
                    }
               });
           }
       return false;
   });
}



function cargarPa(id) {
 
    $.get('./Controlador/search.php?function=listPabellon', 	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               
               $("#servicio").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                   if (valor.descripcion == id) {
                       $("#servicio").append('<option value="' + valor.descripcion + '" selected>' + valor.descripcion + '</option>');
                   }else{
                       
                       $("#servicio").append('<option value="' + valor.descripcion + '">' + valor.descripcion + '</option>');
                   }
               });
           }
       return false;
   });
}


function cargarIafas() {
 
    $.get('./Controlador/search.php?function=iafapaciente', 	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               
               $("#iafa").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                       $("#iafa").append('<option value="' + valor.iafa + '">' + valor.iafa + '</option>');	
               });
           }
       return false;
   });
}


function vercodigMor(){

    $('#frmCptsCitoEs')[0].reset();
    $("#ui-id-1").css("z-index", "9999999999");
}

function cargarTecnico() {
 
    $.get('./Controlador/search.php?function=tecnico', 	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               
               $("#tecx").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                       $("#tecx").append('<option value="' + valor.id + '">' + valor.nom + '</option>');	
               });
           }
       return false;
   });
}






function cie19(){

    $.ajax({
        url:'./Controlador/search.php?function=cie10',
        type:'GET',
        dataType:'json',
        data:{ cie10:$('#cie10').val()}
        
    }).done(function(datos){
        
        $("#diagnostico").val(datos[0]);
     
    });
}



function cargaCuentaP(){

    $.ajax({
        url:'./Controlador/search.php?function=CarxCuentax',
        type:'GET',
        dataType:'json',
        data:{ Nxuenta:$('#Nxuenta').val()}
        
    }).done(function(datos){
        
        $("#fua").val(datos[0]);
        $("#paciente").val(datos[1]);
        $("#hclinica").val(datos[2]);
      
    });
}



function cargarInfoDisa(dato){

    $.ajax({
        url:'./Controlador/search.php?function=cargarInfoDisa',
        type:'GET',
        dataType:'json',
        data:{ datois:dato}
        
    }).done(function(datos){
        
        $("#idEstabel").val(datos[0]);
        if(datos[0]=="478"){
            areaList();
            cargoOcupa(datos[0]);
        }else{
            cargarOfUnid();
            cargoOcupa(1);
        }
        
        countEsta(datos[0]);
        
        $("#eesS").val(datos[1]);
        $("#depaUsu").val(datos[2]);
        $("#provUsu").val(datos[3]);
        $("#distUsu").val(datos[4]);
        $("#dirisUsu").val(datos[5]);
        $("#nivelAte").val(datos[6]);
        
      
    });
}


function countEsta(dato){

    $.ajax({
        url:'./Controlador/search.php?function=countEst',
        type:'GET',
        dataType:'json',
        data:{ datois:dato}
        
    }).done(function(datos){
        
                if(dato != "478"){
                   
                        if(datos[0]>=2){
                        
                                alert("Maximo pueden ser registrados 2 usuarios por establecimiento.")
                                $("#GuardarPacienteUsr").addClass("hidden")
                                $('#formUsuario')[0].reset();
                                
                        }
                        
                }
        
    });
}



function countDuplicadoCargo(idCargo,idEst){

    $.ajax({
        url:'./Controlador/search.php?function=countDuplicadoCargo',
        type:'GET',
        dataType:'json',
        data:{ idCargo:idCargo,idEst:idEst}
        
    }).done(function(datos){
        
                if(datos[0] == 1){
                    
                    alert("Ya existe este cargo para un usuario del establecimiento.")
                    $("#GuardarPacienteUsr").addClass("hidden")
                    $('#formUsuario')[0].reset();  
                }
    
    });
}


function cargarInfoDisaRef(dato){

    $.ajax({
        url:'./Controlador/search.php?function=cargarInfoDisa',
        type:'GET',
        dataType:'json',
        data:{ datois:dato}
        
    }).done(function(datos){
        
        $("#idEstabelRef").val(datos[0]);
        $("#eesSRef").val(datos[1]);
        $("#depaUsuRef").val(datos[2]);
        $("#provUsuRef").val(datos[3]);
        $("#distUsuRef").val(datos[4]);
        $("#dirisUsuRef").val(datos[5]);
        $("#nivelAteRef").val(datos[6]);
        
      
    });
}



function cargarInfoDisaEEss(dato){

    $.ajax({
        url:'./Controlador/search.php?function=cargarInfoDisaEEss',
        type:'GET',
        dataType:'json',
        data:{ datois:dato}
        
    }).done(function(datos){
        
        $("#idEstabel").val(datos[0]);
         if(datos[0]=="478"){
            areaList();
            cargoOcupa(datos[0]);
        }else{
            cargarOfUnid();
            cargoOcupa(1);
        }
        
        countEsta(datos[0]);
        $("#codigoFor").val(datos[1]);
        $("#depaUsu").val(datos[2]);
        $("#provUsu").val(datos[3]);
        $("#distUsu").val(datos[4]);
        $("#dirisUsu").val(datos[5]);
        $("#nivelAte").val(datos[6]);
      
    });
}




function cargarInfoDisaEEssRef(dato){

    $.ajax({
        url:'./Controlador/search.php?function=cargarInfoDisaEEss',
        type:'GET',
        dataType:'json',
        data:{ datois:dato}
        
    }).done(function(datos){
        
    
        
        $("#idEstabelRef").val(datos[0]);
        $("#codigoForRef").val(datos[1]);
        $("#depaUsuRef").val(datos[2]);
        $("#provUsuRef").val(datos[3]);
        $("#distUsuRef").val(datos[4]);
        $("#dirisUsuRef").val(datos[5]);
        $("#nivelAteRef").val(datos[6]);
        
      
    });
}



function cargaDenominacion(){

    $.ajax({
        url:'./Controlador/search.php?function=cargarDeno',
        type:'GET',
        dataType:'json',
        data:{ id:$('#codPreHos').val()}
        
    }).done(function(datos){
        
        $("#ubiSerHosp").val(datos[0]);
        
     
    });
}



function cargaDenominacionCE(){

    $.ajax({
        url:'./Controlador/search.php?function=cargarDenoCE',
        type:'GET',
        dataType:'json',
        data:{ id:$('#codPreHosCE').val()}
        
    }).done(function(datos){
        
        $("#ubiSerHospCE").val(datos[0]);
        
     
    });
}

function cargarCodpre(id){

    $.ajax({
        url:'./Controlador/search.php?function=carCodpre',
        type:'GET',
        dataType:'json',
        data:{ cod:id}
        
    }).done(function(datos){
        
        $("#coPre").val(datos[0]);
     
    });
}



function cargarCodpreHospi(id){

    $.ajax({
        url:'./Controlador/search.php?function=carCodpreHospi',
        type:'GET',
        dataType:'json',
        data:{ cod:id}
        
    }).done(function(datos){
        
        $("#codPreHos").val(datos[0]);
     
    });
}

function cargarCodpreHospiCE(id){

    $.ajax({
        url:'./Controlador/search.php?function=carCodpreHospiCE',
        type:'GET',
        dataType:'json',
        data:{ cod:id}
        
    }).done(function(datos){
        
        $("#codPreHosCE").val(datos[0]);
     
    });
}

function agregarSesions(id){
    
    $("#idSes").val(id);
    CargarSesiones(id);
    
}

function verImpos(id){

    $("#ide").val(id)
    $('#asiAudi').empty();
    $('#ubiSerHosp').empty();
   // cargarAuditor();
   cargarPabellones();
  $('#servicio').empty();
  //cargarPresHospi();
   $("#ui-id-1").css("z-index", "9999999999");

    $.ajax({
        url:'./Controlador/search.php?function=editaPaci',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
      
        $("#Nxuenta").val(datos[0]);
        $("#hclinica").val(datos[1]);
        $("#fua").val(datos[2]);
        $("#dni").val(datos[3]);
        $("#paciente").val(datos[4]);
        //$("#servicio").val(datos[5]);
        cargarPa(datos[5]);
        $("#feingreso").val(datos[6]);
        $("#fecorte").val(datos[7]);
        $("#asiAudi").val(datos[8]);
        $("#montgal").val(datos[9]);
        $("#montsifar").val(datos[10]);
        $("#obsCpms").val(datos[11]);
        $("#valAteAudi").val(datos[12]);
        $("#tiDocA").val(datos[13]);
       // $("#ubiSerHosp").val(datos[14]);
        cargarPresHospi(datos[14]);
        $("#codPreHos").val(datos[15]);
        $("#serEgre12").val(datos[16]);
        $("#prioAudit").val(datos[17]);
     
    });
}



function editarUsuarios(id){

    $("#idUSX").val(id)
   
    $.ajax({
        url:'./Controlador/search.php?function=editaUsers',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
      
        $("#userusu").val(datos[0]);
        $("#password").val(datos[1]);
        $("#estadousu").val(datos[2]);
        $("#nomusu").val(datos[3]);
        $("#emailusu").val(datos[4]);
        $("#teleusu").val(datos[5]);
        
    });
}



function buscarMarcadList(id){

    //$("#idUSX").val(id)
   
    $.ajax({
        url:'./Controlador/search.php?function=buscarMarcadList',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
      cargarResultadoHisto(datos[0]);
      //inum
                    if(datos[0]=="26" || datos[0]=="27"){
                        
                         $("#inum").removeClass("hidden");
                         $("#intenHid").removeClass("hidden");
                         $("#hiddeNucel").removeClass("hidden");
                         $("#hiddenPunt").removeClass("hidden");
                         $("#hidInterp").removeClass("hidden");
                         $("#resuNorm").addClass("hidden");
                         $("#otrosHi").addClass("hidden");
                         
                        
                    }else if(datos[0]=="25"){
                        
                       
                         $("#inum").removeClass("hidden");
                         $("#intenHid").addClass("hidden");
                         $("#hiddeNucel").addClass("hidden");
                         $("#hiddenPunt").addClass("hidden");
                         $("#hidInterp").addClass("hidden");
                         $("#otrosHi").addClass("hidden");
                        
                    }else if(datos[0]=="1"){
                        
                         $("#inum").addClass("hidden");
                         $("#intenHid").addClass("hidden");
                         $("#hiddeNucel").removeClass("hidden");
                         $("#hiddenPunt").addClass("hidden");
                         $("#hidInterp").addClass("hidden");
                         $("#otrosHi").removeClass("hidden");
                         
                    }else if(datos[0]=="47" || datos[0]=="48" || datos[0]=="49" || datos[0]=="50"){
                        
                       
                         $("#inum").removeClass("hidden");
                         $("#intenHid").addClass("hidden");
                         $("#hiddeNucel").addClass("hidden");
                         $("#hiddenPunt").addClass("hidden");
                         $("#hidInterp").addClass("hidden");
                         $("#otrosHi").addClass("hidden");
                         $("#resuNorm").addClass("hidden");
                         
                        
                    }
                    else {
                            
                             $("#inum").addClass("hidden");
                             $("#resuNorm").removeClass("hidden");
                             $("#otrosHi").addClass("hidden");
                            
                    }
      
    });
    
    
}



function buscarIntensi(id){


    $.ajax({
        url:'./Controlador/search.php?function=buscarIntensi',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
           $("#puntuaCionHin").val(datos[0]);
           var sub = parseFloat(datos[0]) + parseFloat($("#scoreNucleos").val());
           $("#subtotalPun").val(sub);
           if(sub>=0 && sub <=2){
               $("#interpretHi").val("NEGATIVO");
           }else if(sub>=3 && sub <=8){
               $("#interpretHi").val("POSITIVO");
           }
       
    });
}


function verificarCheckedMama(id,p1,p2){

    
    $.ajax({
        url:'./Controlador/search.php?function=verificarCheckedMama',
        type:'GET',
        dataType:'json',
        data:{ id: id,p1:p1,p2:p2 }
        
    }).done(function(datos){
        
           $("#seleMamaTbl").val(datos[0]);
           $("#seleMamaTblCito").val(datos[0]);
           var inm =  $("#procedReal").val();
           var inm2 =  $("#procedRealCito").val();
           
           if(inm==3 && datos[0] > 0 || inm2==3 && datos[0] > 0){
                buscarMarcadList(id);    
           }
           
    });
}



function verificarCmpRespon(id){
    
    
    $.ajax({
        url:'./Controlador/search.php?function=buscarUserDigiRes',
        type:'GET',
        dataType:'json',
        data:{ id:id}
        
    }).done(function(datos){
            if(datos[0]!=""){
                $("#colegioResp").val(datos[0]);
            }else{
                $("#colegioResp").val("");
            }
           
           
    });
    
}



function verificarCmpResponCitologia(id){
    
    
    $.ajax({
        url:'./Controlador/search.php?function=buscarUserDigiResCitologia',
        type:'GET',
        dataType:'json',
        data:{ id:id}
        
    }).done(function(datos){
            if(datos[0]!=""){
                $("#profeCargo").val(datos[0]);
            }else{
                $("#profeCargo").val("");
            }
           
           
    });
    
}



function buscarPorceNucle(id){


    $.ajax({
        url:'./Controlador/search.php?function=buscarPorceNucle',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
           $("#scoreNucleos").val(datos[0]);
           var sub = parseFloat(datos[0]) + parseFloat($("#puntuaCionHin").val());
           $("#subtotalPun").val(sub);
            if(sub>=0 && sub <=2){
               $("#interpretHi").val("NEGATIVO");
           }else if(sub>=3 && sub <=8){
               $("#interpretHi").val("POSITIVO");
           }
       
    });
}


function editarMarcadorColoracion(id){

    $("#idPakMar").val(id)
   
    $.ajax({
        url:'./Controlador/search.php?function=editaMarcadorColor',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
        $("#marcList").val(datos[0]);
        $("#resultMarcax").val(datos[1]);
        
        if(datos[6]!="-"){
            $("#lblMarcCol").empty();
            $("#lblMarcCol").append("<strong>RESULTADO:</strong> "+datos[2]+" <br><strong>INTENSIDAD TINCIÓN:</strong> "+datos[3]+"<br><strong>% NUCLEOS POSITIVOS:</strong> "+datos[4]+"<br><strong>PUNTUACION:</strong> "+datos[5]+"<br><strong>INTERPRETACION:</strong> "+datos[6]);
        }else{
            $("#lblMarcCol").text(datos[1]);
        }
        
        
        
        
    });
}



function buscarIpress(id){

    
   
    $.ajax({
        url:'./Controlador/search.php?function=buscarIpress',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
                $("#juriPr").val(datos[0]);
        
    });
}



function verRegistroQuimio(id){

    
    $("#ideQa").val(id);
    
   cargarAuditorQuimio();

    $("#ui-id-1").css("z-index", "9999999999");
    $("#ui-id-2").css("z-index", "9999999999");
    $("#ui-id-3").css("z-index", "9999999999");
    $("#ui-id-4").css("z-index", "9999999999");
    $("#ui-id-5").css("z-index", "9999999999");
    $("#ui-id-6").css("z-index", "9999999999");
    $("#ui-id-7").css("z-index", "9999999999");
    $("#ui-id-8").css("z-index", "9999999999");
  
    $.ajax({
        url:'./Controlador/search.php?function=editarQuimio',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
      
        $("#pacienteQ").val(datos[0]);
        $("#hclinicaQ").val(datos[1]);
        $("#fuaQ").val(datos[2]);
         $("#NxuentaQ").val(datos[3]);
        $("#feAtenQ").val(datos[4]);
        $("#asiAudiQa").val(datos[5]);
         $("#feProcQ").val(datos[6]);
        $("#tip1Qui").val(datos[7]);
        $("#cie102Qui").val(datos[8]);
         $("#tip2Qui").val(datos[9]);
        $("#cie103Qui").val(datos[10]);
        $("#tip3Qui").val(datos[11]);
         $("#cie104Qui").val(datos[12]);
        $("#tip4Qui").val(datos[13]);
        $("#cie105Qui").val(datos[14]);
         $("#tip5Qui").val(datos[15]);
        $("#tipoDocQui").val(datos[16]);
        $("#tefQuimi").val(datos[17]);
         $("#segurosQuimi").val(datos[18]);
        $("#refQuimi").val(datos[19]);
        $("#fechaNacQuimi").val(datos[20]);
         $("#edadQuimi").val(datos[21]);
      $("#dniQuimi").val(datos[22]);
      $("#ocupQui").val(datos[23]);
       
     
    });
}




function editarPaquete(id){

    
   $("#idPak").val(id);
   $("#viIdfg").removeClass("hidden");    
  
    $.ajax({
        url:'./Controlador/search.php?function=editarPaqes',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
      
        cargarListCajas(datos[0]);
        $("#obsPaquete").val(datos[1]);
         $("#fechaHoraAsignadoDigitador").val(datos[2]);
       cargarListAuditCE(datos[3]);
       $("#fechaHoraUserAudix").val(datos[4]);
       
       $("#userAsignaAudi").val(datos[5]);
       $("#userAsignaDigi").val(datos[6]);
       cargarListLix(datos[7]);
       
     
    });
}




function verEditRef(id){
    
    $("#ui-id-1").css("z-index", "9999999999");
    $("#ui-id-2").css("z-index", "9999999999");
    $("#ideRef").val(id);
  

    $.ajax({
        url:'./Controlador/search.php?function=editarReferencias',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
      
       $("#tipoDocRef").val(datos[0]);
       $("#NroDocRef").val(datos[1]);
       $("#paxRef").val(datos[2]);
       $("#sexoRef").val(datos[3]);
       $("#FechaNacRef").val(datos[4]);
       $("#edadRef").val(datos[5]);
       $("#iafasRef").val(datos[6]);
       cargarPlanSaludGroup(datos[7],datos[6])
       $("#tipoSegRef").val(datos[7]);
       $("#afiliaRef").val(datos[8]);
       $("#caduciRef").val(datos[9]);
       $("#domiRef").val(datos[10]);
       $("#depaRef").val(datos[11]);
       $("#provRef").val(datos[12]);
       
       cargarProvincia(datos[11],datos[12]);
       cargarDistrito(datos[12],datos[13]);
       $("#disRef").val(datos[13]);
       $("#actrasRef").val(datos[14]);
       
       
         if(datos[14]=="SI" ){
                                                                                
            $( "#tipoAcVer" ).removeClass( "hidden");
            $( "#tipoAcVerList" ).removeClass( "hidden");
            $( "#vertitleDoc" ).removeClass( "hidden");
            $( "#verListDoc" ).removeClass( "hidden");
           
            
            
            
        }else{
             $( "#tipoAcVer" ).addClass( "hidden");
            $( "#tipoAcVerList" ).addClass( "hidden");
            $( "#vertitleDoc" ).addClass( "hidden");
            $( "#verListDoc" ).addClass( "hidden");
            
        }
       
       $("#tipoAccRef").val(datos[15]);
       $("#lisDocs").val(datos[16]);
       $("#ingresoReferido").val(datos[17]);
       if(datos[17]=="SI" ){
                                                                                
            $( "#mostrarEstRef" ).removeClass( "hidden");
        
        }else{
             $( "#mostrarEstRef" ).addClass( "hidden");
            
            
        }
       
       $("#idEstabelRef").val(datos[18]);
       verIpress(datos[18]);
       $("#fechaIngresoRef").val(datos[19]);
       $("#servicioOrigenRef").val(datos[20]);
       $("#servDestRef").val(datos[21]);
       $("#especialidadRef").val(datos[22]);
       $("#motivoRef").val(datos[23]);
       $("#condPcte").val(datos[24]);
       $("#caduciRef").val(datos[25]);
       $("#tipoTransRef").val(datos[26]);
       $("#dispoTransRef").val(datos[27]);
       $("#tipoDocRefRes").val(datos[28]);
       $("#NroDocRefRes").val(datos[29]);
       $("#personalResRef").val(datos[30]);
       $("#profesionRefRes").val(datos[31]);
       if(datos[31]=="7" ||  datos[31]=="19" || datos[31]=="20" ||  datos[31]=="21"  ){
                                                        
            $( "#colRef" ).addClass( "hidden");
            $( "#txtcolRef" ).addClass( "hidden");
            
            
        }else{
            
            $( "#colRef" ).removeClass( "hidden");
            $( "#txtcolRef" ).removeClass( "hidden");
            
        }
        
        
       $("#colegiaturaRef").val(datos[32]);
       $("#tipoDocRefResAcompa").val(datos[33]);
       $("#NroDocRefResAcompa").val(datos[34]);
       $("#personalResRefAcompa").val(datos[35]);
       
       if(datos[36]=="7" ||  datos[36]=="19" ||  datos[36]=="20" ||  datos[36]=="21"  ){
                                                        
                $( "#lblcole" ).addClass( "hidden");
                $( "#txtinpCol" ).addClass( "hidden");
                
                
            }else{
                
                $( "#lblcole" ).removeClass( "hidden");
                $( "#txtinpCol" ).removeClass( "hidden");
                
            }
                                                    
                                                    
       $("#profesionRefResAcompa").val(datos[36]);
       $("#colegiaturaRefAcompa").val(datos[37]);
       $("#hisRefReg").val(datos[38]);
       
      
       
       
      
    });
    
    
}





function verObsPerMed(id){
    
     $('#restEditRef').attr('onClick', 'verEditRef('+ id +');');
     $('#restEditClinicaPacte').attr('onClick', 'verHistoriaClinicaPacte('+ id +');');
     
     $.ajax({
        url:'./Controlador/search.php?function=verObsMediAudi',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
        $("#obsMediAudi").text(datos[0]);
       
    });
     
     
    
}



function verEvaluacionRef(id){
    
     $("#ideHistoEvalRef").val(id);
     
     
     $.ajax({
        url:'./Controlador/search.php?function=editarHistRefEval',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
        
       $("#especEval1").val(datos[0]);
       $("#especEval2").val(datos[1]);
       $("#especEvalDatoRef").val(datos[2]);
       estadoRefDatRef1(datos[3]);
       
       
       $("#derivarJefeServ").val(datos[4]);
       
       if(datos[3]=="2"){
                 $("#lifeMotRech").removeClass("hidden");
        }else{
                $("#lifeMotRech").addClass("hidden");
        }
       
       
      
       
       $("#motivoRecEval1").val(datos[5]);
       
       cargarMotivoRe1(datos[5]);
       
       $("#especEval3").val(datos[6]);
       $("#obsJefeServ").val(datos[7]);
       
       if(datos[4]=="SI"){
                                                                                
             $("#verPerMed").removeClass("hidden");
             $("#verPerMedSelect").removeClass("hidden");
             $("#idPadPersMed").removeClass("hidden");
            
        }else{
            
            $("#verPerMed").addClass("hidden");
            $("#verPerMedSelect").addClass("hidden");
            $("#idPadPersMed").addClass("hidden");
            
        }
       
       estadoRefDatRef3
       estadoRefDatRef2(datos[8]);
       cargarMotivoRe2(datos[9]);
       $("#obsJefeGuardia").val(datos[10]);
       
       estadoRefDatRef3(datos[11]);
       
       if(datos[11]=="2"){$("#motRechazoPerMedico").removeClass("hidden");}else{$("#motRechazoPerMedico").addClass("hidden");}
       if(datos[8]=="2"){$("#motRechazoPerMedicoSer").removeClass("hidden");}else{$("#motRechazoPerMedicoSer").addClass("hidden");}
       
      
       cargarMotivoRe3(datos[12]);
       cargarAtencionPacEval(datos[13]);
       estadoRefDatRef4(datos[14]);
       cargarMotivoRe4(datos[15]);
       
       
       $("#obsEstFinalRef").val(datos[16]);
       $("#paxllegoEstab").val(datos[17]);
       $("#fechaLlegada").val(datos[18]);
       $("#cuentaFeLlegada").val(datos[19]);
       
       panelHistoriaClinicaEval(datos[20],datos[21],datos[22]);
        cargarAtSolicitud(datos[23]);
        $("#user1per").text(datos[24]);
        $("#user2per").text(datos[25]);
        //$("#user3per").text(datos[26]);
        $("#user4per").text(datos[27]);
        $("#user4perOtros").text(datos[28]);
        $("#user4perProfes").text(datos[29]);
        
        
        $("#user5per").text(datos[30]);
        $("#user5perProfes").text(datos[31]);
        
        $("#user3per").text(datos[32]);
        $("#user3perOtros").text(datos[33]);
        $("#user3perProfes").text(datos[34]);
        
        $("#user2per").text(datos[35]);
        $("#user2perOtros").text(datos[36]);
        $("#user2perProfes").text(datos[37]);
        
        $("#user1per").text(datos[38]);
        $("#user1perProfes").text(datos[39]);
   
        $("#user6per").text(datos[40]);
        $("#user6perProfes").text(datos[41]);
        
        $("#user1perOtros").text(datos[42]);
        $("#user5perOtros").text(datos[43]);
        $("#user6perOtros").text(datos[44]);
        
        
        if(datos[45]=="1"){
                                                                                
            $("#oculDocsRef").removeClass("hidden");
            
        }else{
            
            $("#oculDocsRef").addClass("hidden");
        }
        $("#acciTranRef").val(datos[45]);
        
        
        
          if(datos[46] == "on"){
                $("#chkDocCuenta1").prop('checked', true);
           
          }else{
                $("#chkDocCuenta1").prop('checked', false);
          }
        
        
         if(datos[47] == "on"){
                $("#chkDocCuenta2").prop('checked', true);
           
          }else{
                $("#chkDocCuenta2").prop('checked', false);
          }
          
          
          if(datos[48] == "on"){
                $("#chkDocCuenta3").prop('checked', true);
           
          }else{
                $("#chkDocCuenta3").prop('checked', false);
          }
          
          
          if(datos[49] == "on"){
                $("#chkDocCuenta4").prop('checked', true);
           
          }else{
                $("#chkDocCuenta4").prop('checked', false);
          }
          
          
          if(datos[50] == "on"){
                $("#chkDocCuenta5").prop('checked', true);
           
          }else{
                $("#chkDocCuenta5").prop('checked', false);
          }
        
        
        
        
    });
     
     
    
}


function verHistoriaClinicaPacte(id){
    
   
    
   
    $("#ideHisto").val(id);
        

    $.ajax({
        url:'./Controlador/search.php?function=editarReferenciasHistoriaCli',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
       panelHistoriaClinica(datos[11],datos[12],datos[13]);
       $("#busNroRef").val(datos[13]);
       
        verTblDxHistoria(id);
        verTblTratHistoria(id);
        verTblExamenHistoria1(id,1);
        verTblExamenHistoria2(id,2);
        verTblExamenHistoria3(id,3);
        verTblSignosSintomas(id);
        
        
       $("#anamnesis").val(datos[0]);
       $("#presionArterial").val(datos[1]);
       $("#temperatura").val(datos[2]);
       $("#cardiaca").val(datos[3]);
       $("#respiratoria").val(datos[4]);
       $("#saturacion").val(datos[5]);
       $("#oxinoterapia").val(datos[6]);
       $("#litroMin").val(datos[7]);
       $("#examenClinico").val(datos[8]);
       $("#plan").val(datos[9]);
       $("#notaObservaciones").val(datos[10]);
       // $("#respirador").val(datos[14]);
       cargarRespirador(datos[14]);
       
       
        if(datos[6]=="SI"){
             $("#verCantOxi").removeClass("hidden");
         }else{
             
             $("#verCantOxi").addClass("hidden");
            
         }
      
    });
    
    
}








function verTblDxHistoria(id){
    
    
    var table = $('#tbl_dx').DataTable( {
                  "bProcessing": true,
                  "sAjaxSource": "./Controlador/search.php?function=sqlDxHistoria&id=" +id,
                  "bPaginate":true,
                  retrieve: true,
                  "sPaginationType":"full_numbers",
                  "iDisplayLength":50,
                  "order": [0, "asc" ],
                  "columnDefs": [
                    { targets: [0,1,2], visible: true,orderable: false},
                    { targets: '_all', visible: false 
                    
                    },{
                      className: "dt-left",
                      "targets": [0] 
                  },{
                    className: "dt-right",
                    "targets": [] 
                  },
            //
                  {
                      className: "dt-center",
                      "targets": [0,1,2]
                  }],
                  "aoColumns": [

                        { mData: 'dx' },
                        { mData: 'tipoDx' },
                        { mData: 'opciones' },
                       
                      
                  ],

                  dom: '<fBtip>',
                  buttons: [
                     /*   {
                            extend: 'excel',
                            text:'EXPORTAR A EXCEL',
                            title: 'Designacion_De_Fuas_'+ output,
                            exportOptions: {
                              columns: [1,2]
                            },
                            customize: function(xlsx) {
                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                              $('row[r=2] c', sheet).attr('s', '47');
                            }
                          
                        } */
                        
                  ],          // 

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
                    }

                   
                   
                    
                  });
      
                   $('#tbl_dx_filter').addClass('form-group');
                   $('#tbl_dx_filter').css('text-align','left');
                   $('#tbl_dx_filter').css('display','none');
                   $('.dt-buttons').css('float','right');
                   $('#tbl_dx_paginate').css('display','none');
                   $('#tbl_dx_info').css('display','none');
                   
    
}



function verTblDxPreoperatorio(id){
    
    
    var table = $('#tbl_dxPre').DataTable( {
                  "bProcessing": true,
                  "sAjaxSource": "./Controlador/search.php?function=sqlDxPreOperatorio&id=" +id,
                  "bPaginate":true,
                  retrieve: true,
                  "sPaginationType":"full_numbers",
                  "iDisplayLength":50,
                  "order": [0, "asc" ],
                  "columnDefs": [
                    { targets: [0,1,2], visible: true,orderable: false},
                    { targets: '_all', visible: false 
                    
                    },{
                      className: "dt-left",
                      "targets": [0] 
                  },{
                    className: "dt-right",
                    "targets": [] 
                  },
            //
                  {
                      className: "dt-center",
                      "targets": [0,1,2]
                  }],
                  "aoColumns": [

                        { mData: 'dx' },
                        { mData: 'tipoDx' },
                        { mData: 'opciones' },
                       
                      
                  ],

                  dom: '<fBtip>',
                  buttons: [
                     /*   {
                            extend: 'excel',
                            text:'EXPORTAR A EXCEL',
                            title: 'Designacion_De_Fuas_'+ output,
                            exportOptions: {
                              columns: [1,2]
                            },
                            customize: function(xlsx) {
                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                              $('row[r=2] c', sheet).attr('s', '47');
                            }
                          
                        } */
                        
                  ],          // 

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
                    }

                   
                   
                    
                  });
      
                   $('#tbl_dxPre_filter').addClass('form-group');
                   $('#tbl_dxPre_filter').css('text-align','left');
                   $('#tbl_dxPre_filter').css('display','none');
                   $('.dt-buttons').css('float','right');
                   $('#tbl_dxPre_paginate').css('display','none');
                   $('#tbl_dxPre_info').css('display','none');
                   
    
}


function verTblDxPostoperatorio(id){
    
    
    var table = $('#tbl_dxPost').DataTable( {
                  "bProcessing": true,
                  "sAjaxSource": "./Controlador/search.php?function=sqlDxPostOperatorio&id=" +id,
                  "bPaginate":true,
                  retrieve: true,
                  "sPaginationType":"full_numbers",
                  "iDisplayLength":50,
                  "order": [0, "asc" ],
                  "columnDefs": [
                    { targets: [0,1,2], visible: true,orderable: false},
                    { targets: '_all', visible: false 
                    
                    },{
                      className: "dt-left",
                      "targets": [0] 
                  },{
                    className: "dt-right",
                    "targets": [] 
                  },
            //
                  {
                      className: "dt-center",
                      "targets": [0,1,2]
                  }],
                  "aoColumns": [

                        { mData: 'dx' },
                        { mData: 'tipoDx' },
                        { mData: 'opciones' },
                       
                      
                  ],

                  dom: '<fBtip>',
                  buttons: [
                     /*   {
                            extend: 'excel',
                            text:'EXPORTAR A EXCEL',
                            title: 'Designacion_De_Fuas_'+ output,
                            exportOptions: {
                              columns: [1,2]
                            },
                            customize: function(xlsx) {
                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                              $('row[r=2] c', sheet).attr('s', '47');
                            }
                          
                        } */
                        
                  ],          // 

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
                    }

                   
                   
                    
                  });
      
                   $('#tbl_dxPost_filter').addClass('form-group');
                   $('#tbl_dxPost_filter').css('text-align','left');
                   $('#tbl_dxPost_filter').css('display','none');
                   $('.dt-buttons').css('float','right');
                   $('#tbl_dxPost_paginate').css('display','none');
                   $('#tbl_dxPost_info').css('display','none');
                   
    
}



function verTblTratHistoria(id){
    
    
    var tbl_trat = $('#tbl_trat').DataTable( {
                  "bProcessing": true,
                  "sAjaxSource": "./Controlador/search.php?function=sqlDxTratamiento&id=" +id,
                  "bPaginate":true,
                  retrieve: true,
                  "sPaginationType":"full_numbers",
                  "iDisplayLength":50,
                  "order": [0, "asc" ],
                  "columnDefs": [
                    { targets: [0,1,2], visible: true,orderable: false},
                    { targets: '_all', visible: false 
                    
                    },{
                      className: "dt-left",
                      "targets": [0] 
                  },{
                    className: "dt-right",
                    "targets": [] 
                  },
            //
                  {
                      className: "dt-center",
                      "targets": [0,1,2]
                  }],
                  "aoColumns": [

                        { mData: 'descripcion' },
                        { mData: 'cant' },
                        { mData: 'opciones' },
                       
                      
                  ],

                  dom: '<fBtip>',
                  buttons: [
                     /*   {
                            extend: 'excel',
                            text:'EXPORTAR A EXCEL',
                            title: 'Designacion_De_Fuas_'+ output,
                            exportOptions: {
                              columns: [1,2]
                            },
                            customize: function(xlsx) {
                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                              $('row[r=2] c', sheet).attr('s', '47');
                            }
                          
                        } */
                        
                  ],          // 

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
                    }

                   
                   
                    
                  });
      
                     $('#tbl_trat_filter').addClass('form-group');
                    $('#tbl_trat_filter').css('text-align','left');
                    $('#tbl_trat_filter').css('display','none');
                   $('.dt-buttons').css('float','right');
                   $('#tbl_trat_paginate').css('display','none');
                   $('#tbl_trat_info').css('display','none');
    
}




function verTblExamenHistoria1(id,tipo){
    
    
    
    var table = $('#tbl_pro').DataTable( {
                  "bProcessing": true,
                  "sAjaxSource": "./Controlador/search.php?function=sqlExamenesAuxiliares&id=" +id +"&tipo="+tipo,
                  "bPaginate":true,
                  retrieve: true,
                  "sPaginationType":"full_numbers",
                  "iDisplayLength":50,
                  "order": [0, "asc" ],
                  "columnDefs": [
                    { targets: [0,1], visible: true,orderable: false},
                    { targets: '_all', visible: false 
                    
                    },{
                      className: "dt-left",
                      "targets": [0] 
                  },{
                    className: "dt-right",
                    "targets": [] 
                  },
            //
                  {
                      className: "dt-center",
                      "targets": [1]
                  }],
                  "aoColumns": [

                        { mData: 'des' },
                        { mData: 'opciones' }
                      
                  ],

                  dom: '<fBtip>',
                  buttons: [
                     /*   {
                            extend: 'excel',
                            text:'EXPORTAR A EXCEL',
                            title: 'Designacion_De_Fuas_'+ output,
                            exportOptions: {
                              columns: [1,2]
                            },
                            customize: function(xlsx) {
                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                              $('row[r=2] c', sheet).attr('s', '47');
                            }
                          
                        } */
                        
                  ],          // 

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
                    }

                   
                   
                    
                  });
      
                    $('#tbl_pro_filter').addClass('form-group');
                    $('#tbl_pro_filter').css('text-align','left');
                    $('#tbl_pro_filter').css('display','none');
                   $('.dt-buttons').css('float','right');
                   $('#tbl_pro_paginate').css('display','none');
                   $('#tbl_trat_info').css('display','none');
                   
    
}



function verTblIntervencionRealizada(id){
    
  
    var table = $('#tbl_inter').DataTable( {
                  "bProcessing": true,
                 
                  "sAjaxSource": "./Controlador/search.php?function=sqlIntervencionRealizada&id=" +id,
                  "bPaginate":true,
                  retrieve: true,
                  "sPaginationType":"full_numbers",
                  "iDisplayLength":50,
                  "order": [0, "asc" ],
                  "columnDefs": [
                    { targets: [0,1], visible: true,orderable: false},
                    { targets: '_all', visible: false 
                    
                    },{
                      className: "dt-left",
                      "targets": [0] 
                  },{
                    className: "dt-right",
                    "targets": [] 
                  },
                  {
                      className: "dt-center",
                      "targets": [1]
                  }],
                  "aoColumns": [

                        { mData: 'des' },
                        { mData: 'opciones' }
                      
                  ],

                  dom: '<fBtip>',
                  buttons: [
                     /*   {
                            extend: 'excel',
                            text:'EXPORTAR A EXCEL',
                            title: 'Designacion_De_Fuas_'+ output,
                            exportOptions: {
                              columns: [1,2]
                            },
                            customize: function(xlsx) {
                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                              $('row[r=2] c', sheet).attr('s', '47');
                            }
                          
                        } */
                        
                  ],          // 

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
                    }

                   
                   
                    
                  });
      
                    $('#tbl_inter_filter').addClass('form-group');
                    $('#tbl_inter_filter').css('text-align','left');
                    $('#tbl_inter_filter').css('display','none');
                    $('.dt-buttons').css('float','right');
                    $('#tbl_inter_paginate').css('display','none');
                    $('#tbl_inter_info').css('display','none');
                   
    
}




function verTblCirujanosAsistentes(id){
    
  
    var table = $('#tbl_asist').DataTable( {
                  "bProcessing": true,
                 
                  "sAjaxSource": "./Controlador/search.php?function=sqlCirujanosAsistentes&id=" +id,
                  "bPaginate":true,
                  retrieve: true,
                  "sPaginationType":"full_numbers",
                  "iDisplayLength":50,
                  "order": [0, "asc" ],
                  "columnDefs": [
                    { targets: [0,1], visible: true,orderable: false},
                    { targets: '_all', visible: false 
                    
                    },{
                      className: "dt-left",
                      "targets": [0] 
                  },{
                    className: "dt-right",
                    "targets": [] 
                  },
                  {
                      className: "dt-center",
                      "targets": [1]
                  }],
                  "aoColumns": [

                        { mData: 'des' },
                        { mData: 'opciones' }
                      
                  ],

                  dom: '<fBtip>',
                  buttons: [
                     /*   {
                            extend: 'excel',
                            text:'EXPORTAR A EXCEL',
                            title: 'Designacion_De_Fuas_'+ output,
                            exportOptions: {
                              columns: [1,2]
                            },
                            customize: function(xlsx) {
                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                              $('row[r=2] c', sheet).attr('s', '47');
                            }
                          
                        } */
                        
                  ],          // 

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
                    }

                   
                   
                    
                  });
      
                    $('#tbl_asist_filter').addClass('form-group');
                    $('#tbl_asist_filter').css('text-align','left');
                    $('#tbl_asist_filter').css('display','none');
                    $('.dt-buttons').css('float','right');
                    $('#tbl_asist_paginate').css('display','none');
                    $('#tbl_asist_info').css('display','none');
                   
    
}


function verTblExamenHistoria2(id,tipo){
    
    
    var tbl_trat = $('#tbl_lab').DataTable( {
                  "bProcessing": true,
                  "sAjaxSource": "./Controlador/search.php?function=sqlExamenesAuxiliares&id=" +id + "&tipo="+tipo,
                  "bPaginate":true,
                  retrieve: true,
                  "sPaginationType":"full_numbers",
                  "iDisplayLength":50,
                  "order": [0, "asc" ],
                  "columnDefs": [
                    { targets: [0,1], visible: true,orderable: false},
                    { targets: '_all', visible: false 
                    
                    },{
                      className: "dt-left",
                      "targets": [0] 
                  },{
                    className: "dt-right",
                    "targets": [] 
                  },
            //
                  {
                      className: "dt-center",
                      "targets": [0,1]
                  }],
                  "aoColumns": [

                        { mData: 'des' },
                        { mData: 'opciones' },
                       
                      
                  ],

                  dom: '<fBtip>',
                  buttons: [
                     /*   {
                            extend: 'excel',
                            text:'EXPORTAR A EXCEL',
                            title: 'Designacion_De_Fuas_'+ output,
                            exportOptions: {
                              columns: [1,2]
                            },
                            customize: function(xlsx) {
                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                              $('row[r=2] c', sheet).attr('s', '47');
                            }
                          
                        } */
                        
                  ],          // 

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
                    }

                   
                   
                    
                  });
      
                    $('#tbl_lab_filter').addClass('form-group');
                    $('#tbl_lab_filter').css('text-align','left');
                    $('#tbl_lab_filter').css('display','none');
                   $('.dt-buttons').css('float','right');
                   $('#tbl_lab_paginate').css('display','none');
                   $('#tbl_lab_info').css('display','none');
    
}





function verTblExamenHistoria3(id,tipo){
    
    //alert("ID"+id+"|TIPO:"+tipo);
   
    var tbl_trat = $('#tbl_img').DataTable( {
                 
                  "bProcessing": true,
                  "sAjaxSource": "./Controlador/search.php?function=sqlExamenesAuxiliares&id=" +id + "&tipo="+tipo,
                  "bPaginate":true,
                  retrieve: true,
                  "sPaginationType":"full_numbers",
                  "iDisplayLength":50,
                  "order": [0, "asc" ],
                  "columnDefs": [
                    { targets: [0,1], visible: true,orderable: false},
                    { targets: '_all', visible: false 
                    
                    },{
                      className: "dt-left",
                      "targets": [0] 
                  },{
                    className: "dt-right",
                    "targets": [] 
                  },
            //
                  {
                      className: "dt-center",
                      "targets": [0,1]
                  }],
                  "aoColumns": [

                        { mData: 'des' },
                        { mData: 'opciones' },
                       
                      
                  ],

                  dom: '<fBtip>',
                  buttons: [
                     /*   {
                            extend: 'excel',
                            text:'EXPORTAR A EXCEL',
                            title: 'Designacion_De_Fuas_'+ output,
                            exportOptions: {
                              columns: [1,2]
                            },
                            customize: function(xlsx) {
                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                              $('row[r=2] c', sheet).attr('s', '47');
                            }
                          
                        } */
                        
                  ],          // 

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
                    }

                   
                   
                    
                  });
      
                    $('#tbl_img_filter').addClass('form-group');
                    $('#tbl_img_filter').css('text-align','left');
                    $('#tbl_img_filter').css('display','none');
                   $('.dt-buttons').css('float','right');
                   $('#tbl_img_paginate').css('display','none');
                   $('#tbl_img_info').css('display','none');
    
}





function verTblSignosSintomas(id){
    
    
    var tbl_trat = $('#tbl_sin').DataTable({
                  "bProcessing": true,
                  "sAjaxSource": "./Controlador/search.php?function=sqlSingosSintomas&id=" +id,
                  "bPaginate":true,
                  retrieve: true,
                  "sPaginationType":"full_numbers",
                  "iDisplayLength":50,
                  "order": [0, "asc" ],
                  "columnDefs": [
                    { targets: [0,1], visible: true,orderable: false},
                    { targets: '_all', visible: false 
                    
                    },{
                      className: "dt-left",
                      "targets": [0] 
                  },{
                    className: "dt-right",
                    "targets": [] 
                  },
                  {
                      className: "dt-center",
                      "targets": [0,1]
                  }],
                  "aoColumns": [

                        { mData: 'dx' },
                        { mData: 'opciones' },
                       
                      
                  ],

                  dom: '<fBtip>',
                  buttons: [
                     /*   {
                            extend: 'excel',
                            text:'EXPORTAR A EXCEL',
                            title: 'Designacion_De_Fuas_'+ output,
                            exportOptions: {
                              columns: [1,2]
                            },
                            customize: function(xlsx) {
                              var sheet = xlsx.xl.worksheets['sheet1.xml'];
                              $('row[r=2] c', sheet).attr('s', '47');
                            }
                          
                        } */
                        
                  ],          // 

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
                    }

                   
                   
                    
                  });
      
                    $('#tbl_sin_filter').addClass('form-group');
                    $('#tbl_sin_filter').css('text-align','left');
                    $('#tbl_sin_filter').css('display','none');
                   $('.dt-buttons').css('float','right');
                   $('#tbl_sin_paginate').css('display','none');
                   $('#tbl_sin_info').css('display','none');
    
}


function panelHistoriaClinica(ipres,anio,id){

    
    
    $.ajax({
        url:'./Controlador/search.php?function=panelHistoriaClinica',
        type:'GET',
        dataType:'json',
        data:{ ipres:ipres,anio:anio,id:id }
        
    }).done(function(datos){
    
       
       $("#refPcite").text(datos[0]);
       $("#tipoRefPax").text(datos[1]);
       $("#nrodocPaxRefEx").text(datos[2]);
       $("#histPaxRefEx").text(datos[8]);
       $("#edadPaxRefEx").text(datos[3]);
       $("#sexoPaxRefEx").text(datos[4]);
       $("#seguroPaxRefEx").text(datos[5]);
       $("#accTraPaxRefEx").text(datos[6]);
       $("#codnPaxRefEx").text(datos[7]);
       
       
        $("#pctePaxRefEx2").text(datos[0]);
       $("#tipoDocPaxRefEx2").text(datos[1]);
       $("#nroDocPaxRefEx2").text(datos[2]);
       $("#historiaPaxRefEx2").text(datos[8]);
       $("#edadPaxRefEx2").text(datos[3]);
       $("#sexoPaxRefEx2").text(datos[4]);
       $("#segPs").text(datos[5]);
       $("#accTranPaxRefEx2").text(datos[6]);
       $("#condPaxRefEx2").text(datos[7]);
       
    
     
    });
}



function panelHistoriaClinicaEval(ipres,anio,id){

    
    
    $.ajax({
        url:'./Controlador/search.php?function=panelHistoriaClinica',
        type:'GET',
        dataType:'json',
        data:{ ipres:ipres,anio:anio,id:id }
        
    }).done(function(datos){
    
       
       $("#paxEval").text(datos[0]);
       $("#tipoDocEval").text(datos[1]);
       $("#nroDocEval").text(datos[2]);
       $("#historiaEval").text(datos[8]);
       $("#edadEval").text(datos[3]);
       $("#sexoEval").text(datos[4]);
      
       
    });
    
    
}



function verIpress(id){

    
    
  
    $.ajax({
        url:'./Controlador/search.php?function=verIpress',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
    
       
       $("#codigoForRef").val(datos[0]);
       $("#eesSRef").val(datos[1]);
       $("#depaUsuRef").val(datos[2]);
       $("#provUsuRef").val(datos[3]);
       $("#distUsuRef").val(datos[4]);
       $("#dirisUsuRef").val(datos[5]);
       $("#nivelAteRef").val(datos[6]);
    
     
    });
}


function asignarFechaDig(id){

    
   $("#idPakDig").val(id);
    
    $.ajax({
        url:'./Controlador/search.php?function=editarFechaDig',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
     
        $("#fechaDigitacion").val(datos[0]);
       $("#fechaDevolucion").val(datos[1]);
        $("#digit").val(datos[2]);
        if(datos[2] =="2" ){
                                                        
            $( "#motivoDif" ).removeClass( "hidden");

        }else{
             $( "#motivoDif" ).addClass( "hidden");
        }
        
        $("#motivoDif").val(datos[3]);
     
    });
}


function editarObservacion(id){

    
   $("#ids").val(id);
  
    $.ajax({
        url:'./Controlador/search.php?function=editarObserPaxx',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
        CargarObservacionesPaciente(datos[0]);
        $("#obsPaix").val(datos[1]);

     
    });
}



function editarObservacionCaja(id){

    
   $("#ediCaja").val(id);
  
    $.ajax({
        url:'./Controlador/search.php?function=editarObserCajax',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
        
        $("#obsCaja").val(datos[0]);

     
    });
}


function editarFormActividad(id){

    
   $("#idActividad").val(id);
  
    $.ajax({
        url:'./Controlador/search.php?function=editarActiAudit',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
       $("#actividadAudit").val(datos[0]);
       cargarActividadProc(datos[1],datos[0])
       //$("#proceAuditoria").val(datos[1]);
       $("#dxAudito").val(datos[2]);
       $("#observAuditForm").val(datos[3]);
        

     
    });
}




function editarObservacionRo(id,ocu,tipo){

   $('#mostrarPdfMacro').attr('href','pdfMacroscopia.php?id=' + id );
   $("#tipoDecrp").val(tipo);
   //$("#plantillaApe").val("")
    $("#idProcedCito").val(id);
   CargarCptCitologia(id);

  var procePat = $("#procePat").val();

  if(procePat > 13 && tipo == 2){
        $("#divcalidadMuesCitoEsp").removeClass("hidden");
        $("#NuevoSlects").removeClass("hidden");
        $("#NuevoTablesFrm").removeClass("hidden");
        cargarListHallazgo(0);
        
  }else{
        $("#divcalidadMuesCitoEsp").addClass("hidden");
        $("#NuevoSlects").addClass("hidden");
        $("#NuevoTablesFrm").addClass("hidden");
        
  }

   $("#ideRo").val(id);
   $("#ui-id-2").css("z-index", "9999999999");
    $("#ui-id-3").css("z-index", "9999999999");
    $("#ui-id-4").css("z-index", "9999999999");
    $.ajax({
        url:'./Controlador/search.php?function=editarObserPaxRo',
        type:'GET',
        dataType:'json',
        data:{ id: id,tipo:tipo }
        
    }).done(function(datos){
        
        //$("#rotulo").val(datos[0]);
        cargarListCategoria(datos[3]);
        cargarListSubcategoria(datos[5],datos[6]);
        
        //$("#plantillaApe").html("");
        cargarListPlantilla(datos[7],datos[5],tipo);
        
        $("#categoria").val(datos[3]);
        $("#cortesRot").val(datos[4]);
        $("#idcateg").val(datos[6]);
            
       
        
        if(ocu==1){
        
            $("#titleMoal").text("AGREGAR");
            $("#tacos").attr("readonly", false); 
            $("#tacos").val("");
            $("#descDiv").addClass("hidden");
            $("#viewCorte").addClass("hidden");
            $("#rotulo").attr("readonly", true); 
            $("#rotulo").css("pointer-events","none"); 
            $("#rotulo").css("cursor","not-allowed"); 
            $("#categoria").attr("readonly", true); 
            
         //    $("#plantillaApe").attr("readonly", true); 
          //  $("#plantillaApe").css("pointer-events","none"); 
        //    $("#plantillaApe").css("cursor","not-allowed"); 
            
            
        }else if(ocu==2){
            $("#titleMoal").text("EDITAR DESCRIPCION");
            $("#rotulo").attr("readonly", true); 
            $("#rotulo").css("pointer-events","none"); 
            $("#rotulo").css("cursor","not-allowed"); 
            
            $("#categoria").attr("readonly", true); 
            $("#tacos").attr("readonly", true); 
            $("#tacos").val(datos[1]);
            $("#descDiv").removeClass("hidden");
            $("#viewCorte").removeClass("hidden");
            
            if(tipo==1){
                $("#viewCorte").removeClass("hidden");
            }else{
                 $("#viewCorte").addClass("hidden");
            }
            
          //  $("#plantillaApe").attr("readonly", true); 
        //    $("#plantillaApe").css("pointer-events","none"); 
          //  $("#plantillaApe").css("cursor","not-allowed"); 
            
        }
        
        
        $("#descrRot").val(datos[2]);
        $("#lblDescMacro").text(datos[2]);
        $("#lblUserDecri").val(datos[8]);

        $("#calidadMuesCitoEsp").val(datos[9]);
        cargarListHallazgo(datos[10])
        cargarListSistemaReporte(datos[11],datos[10])
        cargarListClasificacion(datos[12],datos[11])
     
    });
}


function editarRsptaRo(id){


   $("#ideRoT").val(id);
   
   
    $.ajax({
        url:'./Controlador/search.php?function=editarRsptaMicro',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
        $("#rsptaMic").val(datos[0]);
        $("#lblrsptaMicro").text(datos[0]);
  
    });
}


function editarObsMicrox(id,tipo){


   $("#ideRoTLabMicro").val(id);
   $("#tipoLabMicor").val(tipo);
   
   
    $.ajax({
        url:'./Controlador/search.php?function=editarObsMicro',
        type:'GET',
        dataType:'json',
        data:{ id: id,tipo:tipo  }
        
    }).done(function(datos){
        
        $("#rsptObsLabMij").val(datos[0]);
        $("#lblRsptalabOx").text(datos[0]);
  
    });
}



function editarObsMicroxRotulo(id,tipo){


   $("#ideMicroObs").val(id);
   $("#tipoLabMicor").val(tipo);
   
   
    $.ajax({
        url:'./Controlador/search.php?function=editarObsMicroRotu',
        type:'GET',
        dataType:'json',
        data:{ id: id,tipo:tipo  }
        
    }).done(function(datos){
        
        $("#obsMicrotextArea").val(datos[0]);
        $("#lblObsMicro").text(datos[0]);
  
    });
}


function editObsMacro(id){


   $("#ideRoTMacro").val(id);
   
   
    $.ajax({
        url:'./Controlador/search.php?function=editObsMacro',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
        $("#rsptaMacro").val(datos[0]);
        $("#lblobsMacro").text(datos[0]);
        
  
    });
}


function editarRsptaRoLab(id,tipo){


   $("#ideRoTLab").val(id);
   $("#tipoLab").val(tipo);
   
    $.ajax({
        url:'./Controlador/search.php?function=editarMicroLab',
        type:'GET',
        dataType:'json',
        data:{ id:id,tipo:tipo }
        
    }).done(function(datos){
        
        $("#rsptaMicLab").val(datos[0]);
  
    });
}



function editarRsptaRoLabInfo(id,tipo){

   
    $.ajax({
        url:'./Controlador/search.php?function=editarMicroLab',
        type:'GET',
        dataType:'json',
        data:{ id:id,tipo:tipo }
        
    }).done(function(datos){
        
        $("#lblRsptalab").text(datos[0]);
  
    });
    
}



function editarObservacionRoLab(id,tipo){


   $("#ideObsRoTLab").val(id);
   $("#tipoMac").val(tipo);
   
    $.ajax({
        url:'./Controlador/search.php?function=editarRsptaMicroLab',
        type:'GET',
        dataType:'json',
        data:{ id: id,tipo:tipo }
        
    }).done(function(datos){
        
            $("#rsptaObsMicLab").val(datos[0]);
  
    });
}




function editarObservacionRoLabInfo(id,tipo){

   
    $.ajax({
        url:'./Controlador/search.php?function=editarRsptaMicroLab',
        type:'GET',
        dataType:'json',
        data:{ id: id,tipo:tipo }
        
    }).done(function(datos){
        
            $("#lblObslab").text(datos[0]);
  
    });
}

function quitarCaja(cod)
{

    var opcion = confirm("¿Estas seguro de eliminar LA  CAJA ASIGNADA?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=quitarCaja",
                data: "cod="+cod,
                success: function(resp){
                    
                    $('#pac3grupoArchivo').DataTable().ajax.reload(null, false);
                    $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Caja eliminada"
                    });
                        
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    

}




function eliminarRegistroPato(cod)
{

    var opcion = confirm("¿Estas seguro de eliminar el registro ?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=eliminarRegistroPato",
                data: "cod="+cod,
                success: function(resp){
                    
                    $('#pac3').DataTable().ajax.reload(null, false);
                    $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Registro eliminado"
                    });
                        
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    

}


function habilitarRegistroPato(cod)
{

    var opcion = confirm("¿Estas seguro de habilitar el registro ?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=habilitarRegistroPato",
                data: "cod="+cod,
                success: function(resp){
                    
                    $('#pac3').DataTable().ajax.reload(null, false);
                    $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Registro habilitado"
                    });
                        
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    

}


function ediftarDesigFuas(id){

    
    $("#ideDes").val(id);
    $('#serviDesi').empty();
  

    $.ajax({
        url:'./Controlador/search.php?function=editarDesignacion',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
      
        $("#rango").val(datos[0]);
        //$("#serviDesi").val(datos[1]);
        cargarServicioDesignacion(datos[1]);
        $("#correoDesig").val(datos[2]);
        $("#resDis").val(datos[4]);
        $("#obsDesig").val(datos[5]);
        $("#rango2").val(datos[6]);
        $("#cantDesig").val(datos[7]);
        
       
    });
}



function buscarRepetido(){

    var fua = $("#fuaCE").val();

    $.ajax({
        url:'./Controlador/search.php?function=buscarDuplicados',
        type:'GET',
        dataType:'json',
        data:{ id: fua }
        
    }).done(function(datos){
        
        if(datos[0]=="SI"){
            alert("El FUA "+ fua +" a sido registrado anteriormente");
        }
        
     
    });
}



function verUserPaquete(id){

   
    $.ajax({
        url:'./Controlador/search.php?function=verUserPaquete',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
            $("#tituloVerUser").text("USUARIO: "+datos[0]+" | NOMBRE DE PAQUETE: "+datos[1]);
        
    });
}


function verPacienteEmergencia(id){

     $("#ide").val(id)
     $('#seguros').empty();
     $('#espost').empty();
     $("#pabellones").empty();
     $('#listaSeguros').empty();
     $('#tipoDoc').empty();
     $('#referido').empty();
     handlerDiasSave();
     CargarObsAuditoria(id);
     cargarActividad();
     
    $("#idActividad").val(""); 
    $("#actividadAudit").val(""); 
    $("#proceAuditoria").val("");  
    $("#dxAudito").val("");  
    $("#observAuditForm").val(""); 
    
     $("#ui-id-1").css("z-index", "9999999999");
     $("#ui-id-2").css("z-index", "9999999999");
     $("#ui-id-3").css("z-index", "9999999999");
     $("#ui-id-4").css("z-index", "9999999999");
     $("#ui-id-5").css("z-index", "9999999999");
     $("#ui-id-6").css("z-index", "9999999999");
     $("#ui-id-7").css("z-index", "9999999999");
     $("#ui-id-8").css("z-index", "9999999999");
     $("#ui-id-9").css("z-index", "9999999999");
     
     var dni = $("#NroDoc").val();
   
     //cargarEspecialidades();  espost
     var tik = getParameterByName('tipo');
     
     if(tik =="2"){
      $('#telcEmerHs').text('CUENTA HOSP');
     
    }else if(tik =="1") {
      $('#telcEmerHs').text('CUENTA EMERG');
      
    }else if(tik =="3") {
        //alert(tik);
      $('#telcEmerHs').text('CUENTA CE');
      
    
    }                                
                            //reciAudit              

    $.ajax({
        url:'./Controlador/search.php?function=consultaEmergencia',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
      
       if(tik==2 && datos[63]==1){
         
            $("#cuenta").attr("readonly", true);
            $("#origenEmer").attr("readonly", true);
            $("#hisCli").attr("readonly", true);
            $("#tipoDoc").attr("readonly", true);
            $("#NroDoc").attr("readonly", true);
            $("#apepa").attr("readonly", true);
            $("#apema").attr("readonly", true);
            $("#nombres").attr("readonly", true);
            $("#FechaNac").attr("readonly", true);
            $("#edad").attr("readonly", true);
            $("#sexo").attr("readonly", true);
            $("#fechaIngreHos").attr("readonly", true);
            
            $("#nroRefEmer").attr("readonly", true);
            $("#eessInicio").attr("readonly", true);
            $("#subirRef").attr("readonly", true);
            
            $("#tipoDoc").css("pointer-events", "none");
            $("#origenEmer").css("pointer-events", "none");
            $("#sexo").css("pointer-events", "none");
            $("#origenEmerMod").attr("readonly", true);
            $("#ubicacionHosX").attr("readonly", true);
            $("#tipoSeiNHosx").attr("readonly", true);
          //  nroCxref
             $("#origenEmerMod").css("pointer-events", "none");
            $("#ubicacionHosX").css("pointer-events", "none");
            $("#tipoSeiNHosx").css("pointer-events", "none");
            $("#montoToaxlHos").attr("readonly", true);
            
            $("#fua").attr("readonly", true);
            $("#rsatencion").attr("readonly", true);
            $("#acptTra").removeClass("hidden");
            $("#obsFuaHo").removeClass("hidden");
            $("#cHps").removeClass("hidden");
            $("#inpuCunx").removeClass("hidden");
            
     }
     
      reciAudit(0,tik);
      
        
        $("#hisCli").val(datos[1]);
        $("#tipoDoc").val(datos[2]);
        listTipoDoc(datos[2]);
        $("#NroDoc").val(datos[3]);
        $("#validarFua").val(datos[89]);
        
        
        
      var link= "reporteSis.php?id="+ datos[3] ;
      $('#reporteSis').attr('href', link);
        
        //$("#seguros").val(datos[4]);
        if(datos[4]==11){
             $( "#textSeg" ).removeClass( "hidden");
             $( "#listseg" ).removeClass( "hidden");
         }else{
              $( "#textSeg" ).addClass( "hidden");
              $( "#listseg" ).addClass( "hidden");
        }
         //cargarSeguros(datos[4]);
        //$("#listaSeguros").val(datos[5]);
      //  cargarAseguradoras(datos[5]);
        $("#ubicacion").val(datos[6]);
        $("#sexo").val(datos[7]);
        $("#cuenta").val(datos[8]);
        cuentaAuditada(datos[8]);
        
        
        if(datos[8] ==""){
            CargarObservacionesPaciente(datos[1]+datos[26]);
        }else{
          CargarObservacionesPaciente(datos[8]);  
        }
        
        $("#NroAf").val(datos[9]);
        $("#eess").val(datos[10]);
        $("#nombres").val(datos[11]);
        $("#FechaNac").val(datos[12]);
        $("#apepa").val(datos[13]);
        $("#apema").val(datos[14]);
        $("#telefa").val(datos[15]);
        $("#edad").val(datos[16]);
        //$("#espost").val(datos[17]);
         cargarNvaCta(datos[55]);
        
        
        
        if(datos[31]=="1" && datos[30]=="NO" ){
                                                        
                        
                              
                            $( "#muesNroAfil" ).removeClass( "hidden");
                            $( "#datoNroAf" ).removeClass( "hidden");
                            $( "#feNuevas" ).removeClass( "hidden");
                            $( "#coreoAuto" ).removeClass( "hidden");
                            $( "#mostraCampo" ).removeClass( "hidden");
                            $( "#subAdj" ).addClass( "hidden");
                            $( "#mostrAdj" ).addClass( "hidden");
                            $( "#feRtU" ).removeClass( "hidden");
                            $( "#fetOp" ).removeClass( "hidden");
                            $( "#coreoAuto" ).addClass( "hidden");
                            $( "#mostraCampo" ).addClass( "hidden");
                            $( "#moFuaxi" ).addClass( "hidden");
                            $( "#txtSegu" ).text( "IAFAS");
                            $( "#iafReg" ).removeClass( "hidden");
                            $( "#verReg" ).removeClass( "hidden");
                            $( "#verRegList" ).removeClass( "hidden");
                            $( "#verPlanSald" ).removeClass( "hidden");
                            $( "#verPlaList" ).removeClass( "hidden");
                            $("#msTfuaGaran").text("N° FUA");
                            $( "#msTfuaGaran" ).addClass( "hidden");
                            $( "#verMonGar" ).addClass( "hidden");
                            $( "#ters" ).text( "FECHA INGRESO");
                            $( "#inputel" ).addClass( "hidden");
                            $( "#iafRegSeg" ).addClass( "hidden");
                            $( "#montosAlo" ).removeClass( "hidden");
                            $( "#rowRaTEN" ).addClass( "hidden");
                            $( "#txtLi" ).addClass( "hidden");
                            $( "#divCehck" ).addClass( "hidden");
                            $( "#teleEssa" ).addClass( "hidden");
                            $( "#feRtU" ).addClass( "hidden");
                            $( "#fetOp" ).addClass( "hidden");
                             $( "#feRtU" ).text( "FECHA REPORTE");
                
            }else if(datos[31]=="2" && datos[30]=="NO" ){
                
                      
                        $( "#muesNroAfil" ).removeClass( "hidden");
                        $( "#datoNroAf" ).removeClass( "hidden");
                        $( "#feNuevas" ).removeClass( "hidden");
                        $( "#coreoAuto" ).removeClass( "hidden");
                        $( "#mostraCampo" ).removeClass( "hidden");
                        $( "#subAdj" ).removeClass( "hidden");
                        $( "#mostrAdj" ).removeClass( "hidden");
                        $( "#feRtU" ).addClass( "hidden");
                        $( "#fetOp" ).addClass( "hidden");
                        $( "#txtSegu" ).text( "IAFAS");
                        $( "#iafReg" ).removeClass( "hidden");
                        $( "#verReg" ).removeClass( "hidden");
                        $( "#verRegList" ).removeClass( "hidden");
                        $( "#verPlanSald" ).removeClass( "hidden");
                        $( "#verPlaList" ).removeClass( "hidden");
                        $("#msTfuaGaran").text("N° FUA");
                        $( "#verMonGar" ).addClass( "hidden");
                        $( "#ters" ).text( "FECHA INGRESO");
                        $( "#msTfuaGaran" ).removeClass( "hidden");
                        $( "#moFuaxi" ).removeClass( "hidden");
                        $( "#emailAuto" ).addClass( "hidden");
                        $( "#coreoAuto" ).addClass( "hidden");
                        $( "#subAdj" ).addClass( "hidden");
                        $( "#mostrAdj" ).addClass( "hidden");
                        $( "#monCarGar" ).addClass( "hidden");
                        $( "#iafRegSeg" ).addClass( "hidden");
                        $( "#montosAlo" ).removeClass( "hidden");
                        $( "#rowRaTEN" ).removeClass( "hidden");
                        $( "#txtLi" ).removeClass( "hidden");
                        $( "#divCehck" ).removeClass( "hidden");
                        $( "#teleEssa" ).removeClass( "hidden");
                        $( "#rowRaTEN" ).removeClass( "hidden");
                
            }else if(datos[31] =="4" && datos[30]=="SI" ){
                
                        $( "#muesNroAfil" ).addClass( "hidden");
                        $( "#datoNroAf" ).addClass( "hidden");
                        $( "#feNuevas" ).addClass( "hidden");
                        $( "#coreoAuto" ).addClass( "hidden");
                        $( "#mostraCampo" ).addClass( "hidden");
                        $( "#subAdj" ).addClass( "hidden");
                        $( "#mostrAdj" ).addClass( "hidden");
                        $( "#feRtU" ).removeClass( "hidden");
                        $( "#fetOp" ).removeClass( "hidden");
                        $( "#feRtU" ).text( "FECHA SOLICITUD");
                        $( "#iafReg" ).removeClass( "hidden");
                        $( "#ters" ).text( "FECHA INGRESO");
                        $( "#msTfuaGaran" ).removeClass( "hidden");
                        $( "#moFuaxi" ).removeClass( "hidden");
                        $( "#tituloFux" ).text( "EXP. ENTREGADO");
                        $( "#inputel" ).removeClass( "hidden");
                         $( "#monCarGar" ).removeClass( "hidden");
                         $( "#iafRegSeg" ).addClass( "hidden");
                         $( "#txtSegu" ).text( "IAFAS");
                        $( "#verReg" ).removeClass( "hidden");
                        $( "#verRegList" ).removeClass( "hidden");
                        $( "#verPlanSald" ).removeClass( "hidden");
                        $( "#verPlaList" ).removeClass( "hidden"); 
                        $( "#montosAlo" ).removeClass( "hidden");
                        $( "#rowRaTEN" ).removeClass( "hidden");
                        $( "#txtLi" ).removeClass( "hidden");
                        $( "#divCehck" ).removeClass( "hidden");
                        $( "#teleEssa" ).addClass( "hidden");
                        $( "#rowRaTEN" ).addClass( "hidden");
                        $("#msTfuaGaran").text("N° CARTA");
                
            }else if(datos[31]=="3" && datos[30]=="SI"   ){
                
                        $( "#muesNroAfil" ).addClass( "hidden");
                        $( "#datoNroAf" ).addClass( "hidden");
                        $( "#feNuevas" ).addClass( "hidden");
                        $( "#coreoAuto" ).addClass( "hidden");
                        $( "#mostraCampo" ).addClass( "hidden");
                        $( "#subAdj" ).addClass( "hidden");
                        $( "#mostrAdj" ).addClass( "hidden");
                        $( "#feRtU" ).removeClass( "hidden");
                        $( "#fetOp" ).removeClass( "hidden");
                        $( "#txtSegu" ).text( "IAFAS");
                        $( "#verReg" ).removeClass( "hidden");
                        $( "#verRegList" ).removeClass( "hidden");
                        $( "#verPlanSald" ).removeClass( "hidden");
                        $( "#verPlaList" ).removeClass( "hidden");
                        $("#msTfuaGaran").text("N° CARTA");
                        $( "#verMonGar" ).removeClass( "hidden");
                        $( "#ters" ).text( "FECHA INGRESO");
                        $( "#iafReg" ).removeClass( "hidden");
                        $( "#msTfuaGaran" ).removeClass( "hidden");
                        $( "#moFuaxi" ).removeClass( "hidden");
                        $( "#tituloFux" ).text( "EXP. ENTREGADO");
                        $( "#inputel" ).removeClass( "hidden");
                        $( "#monCarGar" ).removeClass( "hidden");
                        $( "#iafRegSeg" ).removeClass( "hidden");
                       // cargarSeguros();
                       $( "#montosAlo" ).removeClass( "hidden");
                        $( "#rowRaTEN" ).removeClass( "hidden");
                        $( "#txtLi" ).removeClass( "hidden");
                        $( "#divCehck" ).removeClass( "hidden");
                        $( "#teleEssa" ).addClass( "hidden");
                        $( "#rowRaTEN" ).addClass( "hidden");
                        $( "#feRtU" ).text( "FECHA REPORTE");
                        
                 
            }else if(datos[31]=="2" && datos[30]=="SI" ){
                
                        $( "#muesNroAfil" ).removeClass( "hidden");
                        $( "#datoNroAf" ).removeClass( "hidden");
                        $( "#feNuevas" ).removeClass( "hidden");
                        $( "#coreoAuto" ).removeClass( "hidden");
                        $( "#mostraCampo" ).removeClass( "hidden");
                        $( "#subAdj" ).removeClass( "hidden");
                        $( "#mostrAdj" ).removeClass( "hidden");
                        $( "#feRtU" ).addClass( "hidden");
                        $( "#fetOp" ).addClass( "hidden");
                        $( "#txtSegu" ).text( "IAFAS");
                        $( "#iafReg" ).removeClass( "hidden");
                        $( "#verReg" ).removeClass( "hidden");
                        $( "#verRegList" ).removeClass( "hidden");
                        $( "#verPlanSald" ).removeClass( "hidden");
                        $( "#verPlaList" ).removeClass( "hidden");
                        $("#msTfuaGaran").text("N° FUA");
                         $("#msTfuaGaran").removeClass("hidden");
                        $( "#verMonGar" ).addClass( "hidden");
                        $( "#ters" ).text( "FECHA INGRESO");
                        $( "#moFuaxi" ).removeClass( "hidden");
                        $( "#emailAuto" ).removeClass( "hidden");
                        $( "#iafRegSeg" ).addClass( "hidden");
                        $( "#inputel" ).addClass( "hidden");
                        $( "#montosAlo" ).removeClass( "hidden");
                        $( "#rowRaTEN" ).removeClass( "hidden");
                        $( "#txtLi" ).removeClass( "hidden");
                        $( "#divCehck" ).removeClass( "hidden");
                        $( "#teleEssa" ).removeClass( "hidden");
                        $( "#rowRaTEN" ).removeClass( "hidden");
                
            }else if(datos[31]=="1" && datos[30]=="SI" ){
                
                    
                        $( "#muesNroAfil" ).removeClass( "hidden");
                        $( "#datoNroAf" ).removeClass( "hidden");
                        $( "#feNuevas" ).removeClass( "hidden");
                        $( "#coreoAuto" ).removeClass( "hidden");
                        $( "#mostraCampo" ).removeClass( "hidden");
                        $( "#subAdj" ).addClass( "hidden");
                        $( "#mostrAdj" ).addClass( "hidden");
                        $( "#feRtU" ).removeClass( "hidden");
                        $( "#fetOp" ).removeClass( "hidden");
                        $( "#coreoAuto" ).addClass( "hidden");
                        $( "#mostraCampo" ).addClass( "hidden");
                        $( "#moFuaxi" ).addClass( "hidden");
                        $( "#txtSegu" ).text( "IAFAS");
                        $( "#iafReg" ).removeClass( "hidden");
                        $( "#verReg" ).removeClass( "hidden");
                        $( "#verRegList" ).removeClass( "hidden");
                        $( "#verPlanSald" ).removeClass( "hidden");
                        $( "#verPlaList" ).removeClass( "hidden");
                        $("#msTfuaGaran").text("N° FUA");
                        $( "#msTfuaGaran" ).addClass( "hidden");
                        $( "#verMonGar" ).addClass( "hidden");
                        $( "#ters" ).text( "FECHA INGRESO");
                        $( "#inputel" ).addClass( "hidden");
                        $( "#iafRegSeg" ).addClass( "hidden");
                        $( "#montosAlo" ).removeClass( "hidden");
                        $( "#rowRaTEN" ).addClass( "hidden");
                        $( "#txtLi" ).addClass( "hidden");
                        $( "#divCehck" ).addClass( "hidden");
                        $( "#teleEssa" ).addClass( "hidden");
                        $( "#feRtU" ).addClass( "hidden");
                        $( "#fetOp" ).addClass( "hidden");
                        $( "#feRtU" ).text( "FECHA REPORTE");
                
            }
            
            
            
            
        
         if(datos[30]=="SI" && datos[31]=="3" && datos[4]=="1" || datos[30]=="SI" && datos[31]=="4" && datos[4]=="1" || datos[30]=="SI" && datos[31]=="2" && datos[4]=="13" 
         || datos[30]=="SI" && datos[31]=="1" && datos[4]=="1" || datos[30]=="NO" && datos[31]=="2" && datos[4]=="13" || datos[30]=="NO" && datos[31]=="1" && datos[4]=="1"){
                                                        
                    $( "#datoNroAf" ).removeClass( "hidden");
                    $( "#muesNroAfil" ).removeClass( "hidden");
                    $( "#feNuevas" ).removeClass( "hidden");
                
            } else{
                   $( "#datoNroAf" ).addClass( "hidden");
                   $( "#muesNroAfil" ).addClass( "hidden");
                   $( "#feNuevas" ).addClass( "hidden");
            }
            
            
            
                    
        cargarDestinos(datos[17],tik)
        $("#fefa").val(datos[18]);
        //$("#referido").val(datos[19]);
        cargarmotivoEmer(datos[19]);
        //$("#pabellones").val(datos[20]);
        cargarPabellones(datos[20]);
        $("#feingre").val(datos[21]);
        $("#feAlta").val(datos[22]);
        $("#monGal").val(datos[23]);
        $("#montSif").val(datos[24]);
        $("#obsRes").val(datos[25]);
        $("#tipoReg").val(datos[26]);
        
       /* if (datos[17]==""){
            $("#guardarEmege").removeClass("hidden");
        }else if(datos[17]!=3 ){
            $("#guardarEmege").addClass("hidden");
        }else{
            $("#guardarEmege").removeClass("hidden");
        } 
        
        
        */
        
        if(datos[26]=='3'){
            $("#nroFuaInter").val(datos[0]);
        }else{
            $("#fua").val(datos[0]);
        }
        

          
           $("#feuser").val(datos[29]);
            $("#chis").removeClass('hidden');
      
         
         if(datos[27] == "off"){
                $("#envioA").prop('checked', true);
                
          }else{
                $("#envioA").prop('checked', false);
               
         }
         
         
          $("#actras").val(datos[30]);
          
          //$("#financia").val(datos[31]);
         // cargarSeguros(datos[32]);
          //$("#regim").val(datos[32]);
         // $("#planSal").val(datos[33]);
         // $("#tipoSeiN").val(datos[34]);
          $("#feSolAte").val(datos[35]);
          $("#ubicacionDes").val(datos[36]);
        //  $("#tipoSeiNDes").val(datos[37]);
          $("#feingreAlta").val(datos[38]);
          $("#feAltaAlt").val(datos[39]);
          $("#monTotalCo").val(datos[40]);
          $("#monCarGar").val(datos[41]);
          $("#fuaEntre").val(datos[42]);
          $("#fechaFuaEntre").val(datos[43]);
          $("#fechaAful").val(datos[44]);
          
          $("#estaDias").val(datos[45]);
          $("#emailAuto").val(datos[46]);
//fechaFuaEntre
          $("#cns").val(datos[47]);
        
        
          if(datos[47]=="CC" ){
              
                $( "#txtRs" ).removeClass( "hidden");
                $( "#campRes" ).removeClass( "hidden");
                                                
            }else{
                
                  $( "#txtRs" ).addClass( "hidden");
                  $( "#campRes" ).addClass( "hidden");
            }
        
        
        $("#respbl").val(datos[48]);
        $("#ctaHos").val(datos[49]);

        if(datos[50] == "on"){
            $("#liquIx").prop('checked', true);
           
          }else{
                $("#liquIx").prop('checked', false);
          }
          
          $("#financia").empty();
           $("#regim").empty();
        $("#planSal").empty();
          $("#tipoSeiN").empty();
         $("#tipoSeiNDes").empty();
         
            cargarFinanciamento(datos[31],datos[30])
            cargarRegimen(datos[32],datos[4]);
            cargarPlanSalud(datos[33],datos[32])
            cargarTipoSerIng(datos[34],datos[6])
            cargarTipoSerDest(datos[37],datos[36])
            
            
           
                    
                    
                    $("#origenEmer").val(datos[51]);
                    $("#nroRefEmer").val(datos[52]);
                    $("#eessInicio").val(datos[53]);
                    $("#subirRef").val(datos[54]);
                    $("#nvaCta").val(datos[55]);
                    $("#ctaHos").val(datos[56]);
                    $("#rsatencion").val(datos[57]);
                    //$("#reciAudit").val(datos[58]);
                    reciAudit(datos[58],tik);
                    $("#registraAlta").val(datos[59]);
                    $("#nroCxref").val(datos[60]);
                    //montoToaxlHos
                    
                    if(datos[2]=="6" ){
                                                        
                        $( "#mosNrodoc" ).addClass( "hidden");
                        $( "#verNrodc" ).addClass( "hidden");
                        
                        
                    }else{
                         $( "#mosNrodoc" ).removeClass( "hidden");
                        $( "#verNrodc" ).removeClass( "hidden");
                    }
                    	
                    
                    if(datos[51]=="3" ){
                                                        
                             $( "#titleRefHis" ).removeClass( "hidden");
                             $( "#txtNroReHis" ).removeClass( "hidden");
                             $( "#estableRefIni" ).removeClass( "hidden");
                            
                            
                        }else{
                             $( "#titleRefHis" ).addClass( "hidden");
                             $( "#txtNroReHis" ).addClass( "hidden");
                             $( "#estableRefIni" ).addClass( "hidden");
                        }
                        
                        
                        
                        ///datos alta
                        
                         if(datos[17]=="1" && datos[31]=="1"  ){
                             
                                  $( "#idfa" ).addClass( "hidden");
                                  $( "#idfa" ).text("ALTA_MEDICA");
                                  $( "#fallecido" ).addClass( "hidden");
                                  $( "#viewTextPabellon" ).addClass( "hidden");
                                  $( "#viewListPabellon" ).addClass( "hidden");
                                  $( "#idreF" ).addClass( "hidden");
                                  $( "#inputRef" ).addClass( "hidden");
                                  $( "#btnTrans" ).addClass( "hidden");
                                 // $( "#fuanEtk" ).removeClass( "hidden");
                                  $( "#idFCuen" ).addClass( "hidden");
                                  $( "#inpCuenx" ).addClass( "hidden");
                                  $( "#teleEssa" ).addClass( "hidden");
                                //   $( "#txtitleAudi" ).removeClass( "hidden");
                                 // $( "#txtValorAudi" ).removeClass( "hidden");
                                  $( "#fuanEtk" ).addClass( "hidden");
                                  
                                   $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                   $( "#nroCxref" ).val("");
                        //  $( "#btnRefeAgre" ).removeClass( "hidden");
                               
                        } else if(datos[17]=="1" &&  datos[31]=="2" || datos[17]=="12" &&  datos[31]=="2" ){
                                  $( "#idfa" ).addClass( "hidden");
                                  $( "#idfa" ).text("ALTA_MEDICA");
                                  $( "#fallecido" ).addClass( "hidden");
                                  $( "#viewTextPabellon" ).addClass( "hidden");
                                 $( "#viewListPabellon" ).addClass( "hidden");
                                  $( "#idreF" ).addClass( "hidden");
                                  $( "#inputRef" ).addClass( "hidden");
                                  $( "#btnTrans" ).addClass( "hidden");
                                  $( "#idFCuen" ).addClass( "hidden");
                                  $( "#inpCuenx" ).addClass( "hidden");
                                  $( "#teleEssa" ).removeClass( "hidden");
                                  $( "#titleEss" ).text("EESS CONTRAREF.");
                                  $( "#fuanEtk" ).removeClass( "hidden");
                                  $( "#txtitleAudi" ).removeClass( "hidden");
                                  $( "#txtValorAudi" ).removeClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                $( "#btnRefeAgre" ).addClass( "hidden");
                               
                                
                                $kj = $("#nroCxref").val();
                                if($kj==""){
                                     $("#nroCxref").val("6207-");
                                }
                                
                        }else if(datos[17]=="10" &&  datos[31]=="1" || datos[17]=="12" &&  datos[31]=="1" ){
                                  $( "#idfa" ).addClass( "hidden");
                                  $( "#idfa" ).text("ALTA_MEDICA");
                                  $( "#fallecido" ).addClass( "hidden");
                                  $( "#viewTextPabellon" ).addClass( "hidden");
                                  $( "#viewListPabellon" ).addClass( "hidden");
                                  $( "#idreF" ).addClass( "hidden");
                                  $( "#inputRef" ).addClass( "hidden");
                                  $( "#btnTrans" ).addClass( "hidden");
                                  $( "#idFCuen" ).addClass( "hidden");
                                  $( "#inpCuenx" ).addClass( "hidden");
                                  $( "#teleEssa" ).addClass( "hidden");
                                  $( "#btnRefeAgre" ).addClass( "hidden");
                                  $( "#fuanEtk" ).addClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                  $( "#nroCxref" ).val("");
                               
                        }else if(datos[17]=="2" &&  datos[31]=="4" ){
                            
                                  $( "#idfa" ).removeClass( "hidden");
                                  $( "#idfa" ).text("F. FALLECIDO");
                                  $( "#fallecido" ).removeClass( "hidden");
                                 $( "#viewTextPabellon" ).addClass( "hidden");
                                  $( "#viewListPabellon" ).addClass( "hidden");
                                  $( "#idreF" ).addClass( "hidden");
                                  $( "#inputRef" ).addClass( "hidden");
                                  $( "#btnTrans" ).addClass( "hidden");
                                  $( "#idFCuen" ).addClass( "hidden");
                                  $( "#inpCuenx" ).addClass( "hidden");
                                  $( "#teleEssa" ).addClass( "hidden");
                                  $( "#btnRefeAgre" ).addClass( "hidden");
                                  $( "#fuanEtk" ).removeClass( "hidden");
                                  $( "#txtitleAudi" ).removeClass( "hidden");
                                  $( "#txtValorAudi" ).removeClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                          
                        }else if(datos[17]=="2" &&  datos[31]=="3" ){
                            
                                  $( "#idfa" ).removeClass( "hidden");
                                  $( "#idfa" ).text("F. FALLECIDO");
                                  $( "#fallecido" ).removeClass( "hidden");
                                  $( "#viewTextPabellon" ).addClass( "hidden");
                                 $( "#viewListPabellon" ).addClass( "hidden");
                                  $( "#idreF" ).addClass( "hidden");
                                  $( "#inputRef" ).addClass( "hidden");
                                  $( "#btnTrans" ).addClass( "hidden");
                                  $( "#idFCuen" ).addClass( "hidden");
                                  $( "#inpCuenx" ).addClass( "hidden");
                                  $( "#teleEssa" ).addClass( "hidden");
                                  $( "#btnRefeAgre" ).addClass( "hidden");
                                  $( "#fuanEtk" ).removeClass( "hidden");
                                  $( "#txtitleAudi" ).removeClass( "hidden");
                                  $( "#txtValorAudi" ).removeClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                          
                        }else if(datos[17]=="2" &&  datos[31]=="2" ){
                            
                                  $( "#idfa" ).removeClass( "hidden");
                                  $( "#idfa" ).text("F. FALLECIDO");
                                  $( "#fallecido" ).removeClass( "hidden");
                                 $( "#viewTextPabellon" ).addClass( "hidden");
                                 $( "#viewListPabellon" ).addClass( "hidden");
                                  $( "#idreF" ).addClass( "hidden");
                                  $( "#inputRef" ).addClass( "hidden");
                                  $( "#btnTrans" ).addClass( "hidden");
                                  $( "#idFCuen" ).addClass( "hidden");
                                  $( "#inpCuenx" ).addClass( "hidden");
                                  $( "#teleEssa" ).addClass( "hidden");
                                  $( "#btnRefeAgre" ).addClass( "hidden");
                                  $( "#fuanEtk" ).removeClass( "hidden");
                                  $( "#txtitleAudi" ).removeClass( "hidden");
                                  $( "#txtValorAudi" ).removeClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                          
                        }else if(datos[17]=="2" &&  datos[31]=="1" ){
                            
                                  $( "#idfa" ).removeClass( "hidden");
                                  $( "#idfa" ).text("F. FALLECIDO");
                                  $( "#fallecido" ).removeClass( "hidden");
                                 $( "#viewTextPabellon" ).addClass( "hidden");
                                 $( "#viewListPabellon" ).addClass( "hidden");
                                  $( "#idreF" ).addClass( "hidden");
                                  $( "#inputRef" ).addClass( "hidden");
                                  $( "#btnTrans" ).addClass( "hidden");
                                  $( "#idFCuen" ).addClass( "hidden");
                                  $( "#inpCuenx" ).addClass( "hidden");
                                  $( "#teleEssa" ).addClass( "hidden");
                                  $( "#btnRefeAgre" ).addClass( "hidden");
                                  $( "#fuanEtk" ).addClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                  $( "#nroCxref" ).val("");
                          
                        }else if(datos[17]=="11" &&  datos[31]=="4"){
                            
                                   $( "#idreF" ).removeClass( "hidden");
                                   $( "#idreF" ).text("MOTIVO");
                                   $( "#inputRef" ).removeClass( "hidden");
                                   $( "#idfa" ).addClass( "hidden");
                                   $( "#fallecido").addClass( "hidden");
                                   $( "#viewTextPabellon" ).addClass( "hidden");
                                  $( "#viewListPabellon" ).addClass( "hidden");
                                   $( "#btnTrans" ).addClass( "hidden");
                                   $( "#idFCuen" ).addClass( "hidden");
                                   $( "#inpCuenx" ).addClass( "hidden");
                                   $( "#teleEssa" ).addClass( "hidden");
                                   $( "#btnRefeAgre" ).addClass( "hidden");
                                   $( "#fuanEtk" ).removeClass( "hidden");
                                   $( "#txtitleAudi" ).removeClass( "hidden");
                                   $( "#txtValorAudi" ).removeClass( "hidden");
                                     $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                          
                        }else if(datos[17]=="11" &&  datos[31]=="3"){
                            
                                   $( "#idreF" ).removeClass( "hidden");
                                   $( "#idreF" ).text("MOTIVO");
                                   $( "#inputRef" ).removeClass( "hidden");
                                   $( "#idfa" ).addClass( "hidden");
                                   $( "#fallecido").addClass( "hidden");
                                  $( "#viewTextPabellon" ).addClass( "hidden");
                                   $( "#viewListPabellon" ).addClass( "hidden");
                                   $( "#btnTrans" ).addClass( "hidden");
                                   $( "#idFCuen" ).addClass( "hidden");
                                   $( "#inpCuenx" ).addClass( "hidden");
                                   $( "#teleEssa" ).addClass( "hidden");
                                   $( "#btnRefeAgre" ).addClass( "hidden");
                                   $( "#fuanEtk" ).removeClass( "hidden");
                                   $( "#txtitleAudi" ).removeClass( "hidden");
                                   $( "#txtValorAudi" ).removeClass( "hidden");
                                   $( "#titleNvaCxt" ).removeClass( "hidden");
                                   $( "#inpNvaCta" ).removeClass( "hidden");
                                    $( "#nroCxref" ).val("");
                                  
                          
                        }else if(datos[17]=="11" &&  datos[31]=="2"){
                            
                                   $( "#idreF" ).removeClass( "hidden");
                                   $( "#idreF" ).text("MOTIVO");
                                   $( "#inputRef" ).removeClass( "hidden");
                                   $( "#idfa" ).addClass( "hidden");
                                   $( "#fallecido").addClass( "hidden");
                                   $( "#viewTextPabellon" ).addClass( "hidden");
                                   $( "#viewListPabellon" ).addClass( "hidden");
                                   $( "#btnTrans" ).addClass( "hidden");
                                   $( "#idFCuen" ).addClass( "hidden");
                                   $( "#inpCuenx" ).addClass( "hidden");
                                   $( "#teleEssa" ).addClass( "hidden");
                                   $( "#btnRefeAgre" ).addClass( "hidden");
                                   $( "#fuanEtk" ).removeClass( "hidden");
                                   $( "#txtitleAudi" ).removeClass( "hidden");
                                   $( "#txtValorAudi" ).removeClass( "hidden");
                                   $( "#titleNvaCxt" ).removeClass( "hidden");
                                   $( "#inpNvaCta" ).removeClass( "hidden");
                                    $( "#nroCxref" ).val("");
                          
                        }else if(datos[17]=="11" &&  datos[31]=="1"){
                            
                                   $( "#idreF" ).removeClass( "hidden");
                                   $( "#idreF" ).text("MOTIVO");
                                   $( "#inputRef" ).removeClass( "hidden");
                                   $( "#idfa" ).addClass( "hidden");
                                   $( "#fallecido").addClass( "hidden");
                                   $( "#viewTextPabellon" ).addClass( "hidden");
                                  $( "#viewListPabellon" ).addClass( "hidden");
                                   $( "#btnTrans" ).addClass( "hidden");
                                   $( "#idFCuen" ).addClass( "hidden");
                                   $( "#inpCuenx" ).addClass( "hidden");
                                   $( "#teleEssa" ).addClass( "hidden");
                                   $( "#btnRefeAgre" ).addClass( "hidden");
                                   $( "#fuanEtk" ).addClass( "hidden");
                                     $( "#titleNvaCxt" ).removeClass( "hidden");
                                   $( "#inpNvaCta" ).removeClass( "hidden");
                                   $( "#nroCxref" ).val("");
                          
                        }else if(datos[17]=="3" &&  datos[31]=="4"){
                                  $( "#idfa" ).addClass( "hidden");
                                  $( "#idfa" ).text("PABELLON");
                                  $( "#fallecido").addClass( "hidden");
                                 $( "#viewTextPabellon" ).removeClass( "hidden");
                                 $( "#viewListPabellon" ).removeClass( "hidden");
                                  $( "#idreF" ).addClass( "hidden");
                                  $( "#inputRef" ).addClass( "hidden");
                                  $( "#btnTrans" ).addClass( "hidden");
                                  $( "#fuanEtk" ).removeClass( "hidden");
                                  $( "#idFCuen" ).removeClass( "hidden");
                                  $( "#inpCuenx" ).removeClass( "hidden");
                                  $( "#teleEssa" ).addClass( "hidden");
                                  $( "#btnRefeAgre" ).addClass( "hidden");
                                  $( "#txtitleAudi" ).addClass( "hidden");
                                  $( "#txtValorAudi" ).addClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                   $( "#nroCxref" ).val("");
                           
                        }else if(datos[17]=="3" &&  datos[31]=="3"){
                                  $( "#idfa" ).addClass( "hidden");
                                  $( "#idfa" ).text("PABELLON");
                                  $( "#fallecido").addClass( "hidden");
                                  $( "#viewTextPabellon" ).removeClass( "hidden");
                                  $( "#viewListPabellon" ).removeClass( "hidden");
                                  $( "#idreF" ).addClass( "hidden");
                                  $( "#inputRef" ).addClass( "hidden");
                                  $( "#btnTrans" ).addClass( "hidden");
                                  $( "#fuanEtk" ).removeClass( "hidden");
                                  $( "#idFCuen" ).removeClass( "hidden");
                                  $( "#inpCuenx" ).removeClass( "hidden");
                                  $( "#teleEssa" ).addClass( "hidden");
                                  $( "#btnRefeAgre" ).addClass( "hidden");
                                  $( "#txtitleAudi" ).addClass( "hidden");
                                  $( "#txtValorAudi" ).addClass( "hidden");
                                   $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                           
                        }else if(datos[17]=="3" &&  datos[31]=="2"){
                                  $( "#idfa" ).addClass( "hidden");
                                  $( "#idfa" ).text("PABELLON");
                                  $( "#fallecido").addClass( "hidden");
                                  $( "#viewTextPabellon" ).removeClass( "hidden");
                                  $( "#viewListPabellon" ).removeClass( "hidden");
                                  $( "#idreF" ).addClass( "hidden");
                                  $( "#inputRef" ).addClass( "hidden");
                                  $( "#btnTrans" ).addClass( "hidden");
                                  $( "#fuanEtk" ).removeClass( "hidden");
                                  $( "#idFCuen" ).removeClass( "hidden");
                                  $( "#inpCuenx" ).removeClass( "hidden");
                                  $( "#teleEssa" ).addClass( "hidden");
                                  $( "#btnRefeAgre" ).addClass( "hidden");
                                  $( "#txtitleAudi" ).addClass( "hidden");
                                  $( "#txtValorAudi" ).addClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                                  
                           
                        }else if(datos[17]=="3" &&  datos[31]=="1"){
                                  $( "#idfa" ).addClass( "hidden");
                                  $( "#idfa" ).text("PABELLON");
                                  $( "#fallecido").addClass( "hidden");
                                  $( "#viewTextPabellon" ).removeClass( "hidden");
                                  $( "#viewListPabellon" ).removeClass( "hidden");
                                  $( "#idreF" ).addClass( "hidden");
                                  $( "#inputRef" ).addClass( "hidden");
                                  $( "#btnTrans" ).addClass( "hidden");
                                  $( "#idFCuen" ).removeClass( "hidden");
                                  $( "#inpCuenx" ).removeClass( "hidden");
                                  $( "#teleEssa" ).addClass( "hidden");
                                  $( "#btnRefeAgre" ).addClass( "hidden");
                                  $( "#fuanEtk" ).addClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                                  
                           
                        }else if(datos[17]=="3"){
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#idfa" ).text("PABELLON");
                                    $( "#fallecido").addClass( "hidden");
                                    $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#idreF" ).addClass( "hidden");
                                    $( "#inputRef" ).addClass( "hidden");
                                    $( "#btnTrans" ).addClass( "hidden");
                                    $( "#fuanEtk" ).removeClass( "hidden");
                                    $( "#idFCuen" ).removeClass( "hidden");
                                    $( "#inpCuenx" ).removeClass( "hidden");
                                    $( "#teleEssa" ).addClass( "hidden");
                                    $( "#btnRefeAgre" ).addClass( "hidden");
                                     $( "#txtitleAudi" ).removeClass( "hidden");
                                  $( "#txtValorAudi" ).removeClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                          
                        }else if(datos[17]=="4" &&  datos[31]=="4"){
                          
                                    $( "#btnRefeAgre" ).removeClass( "hidden");
                                    $( "#inputRef" ).addClass( "hidden");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                    $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#btnTrans" ).addClass( "hidden");
                                    $( "#fuanEtk" ).removeClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).addClass( "hidden");
                                    $( "#txtitleAudi" ).removeClass( "hidden");
                                    $( "#txtValorAudi" ).removeClass( "hidden");
                                      $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                                    
                          
                        }else if(datos[17]=="4" &&  datos[31]=="3"){
                          
                                    $( "#btnRefeAgre" ).removeClass( "hidden");
                                    $( "#inputRef" ).addClass( "hidden");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                    $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#btnTrans" ).addClass( "hidden");
                                    $( "#fuanEtk" ).removeClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).addClass( "hidden");
                                    $( "#txtitleAudi" ).removeClass( "hidden");
                                    $( "#txtValorAudi" ).removeClass( "hidden");
                                      $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                          
                        }else if(datos[17]=="4" &&  datos[31]=="2"){
                          
                                    $( "#btnRefeAgre" ).removeClass( "hidden");
                                    $( "#inputRef" ).addClass( "hidden");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                    $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#btnTrans" ).addClass( "hidden");
                                    $( "#fuanEtk" ).removeClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).addClass( "hidden");
                                    $( "#txtitleAudi" ).removeClass( "hidden");
                                    $( "#txtValorAudi" ).removeClass( "hidden");
                                      $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                                    
                          
                        }else if(datos[17]=="4" &&  datos[31]=="1"){
                          
                                    $( "#btnRefeAgre" ).removeClass( "hidden");
                                    $( "#inputRef" ).addClass( "hidden");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                    $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#btnTrans" ).addClass( "hidden");
                                    $( "#fuanEtk" ).addClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).addClass( "hidden");
                                     $( "#txtitleAudi" ).removeClass( "hidden");
                                  $( "#txtValorAudi" ).removeClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                                    
                          
                        }else if(datos[17]=="5" &&  datos[31]=="4"){
                                    $( "#idreF" ).removeClass( "hidden");
                                    $( "#inputRef" ).removeClass( "hidden");
                                    $( "#idreF" ).text( "N° CONTRAREF.");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                    $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#btnTrans" ).addClass( "hidden");
                                    $( "#fuanEtk" ).removeClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).removeClass( "hidden");
                                    $( "#btnRefeAgre" ).addClass( "hidden");
                                    $( "#txtitleAudi" ).removeClass( "hidden");
                                    $( "#txtValorAudi" ).removeClass( "hidden");
                                      $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                                  
                        }else if(datos[17]=="5" &&  datos[31]=="3"){
                                    $( "#idreF" ).removeClass( "hidden");
                                    $( "#inputRef" ).removeClass( "hidden");
                                    $( "#idreF" ).text( "N° CONTRAREF.");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                    $( "#viewTextPabellon" ).addClass( "hidden");
                                   $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#btnTrans" ).addClass( "hidden");
                                    $( "#fuanEtk" ).removeClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).removeClass( "hidden");
                                    $( "#btnRefeAgre" ).addClass( "hidden");
                                    $( "#txtitleAudi" ).removeClass( "hidden");
                                    $( "#txtValorAudi" ).removeClass( "hidden");
                                      $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                                  
                        }else if(datos[17]=="5" &&  datos[31]=="2"){
                                    $( "#idreF" ).removeClass( "hidden");
                                    $( "#inputRef" ).removeClass( "hidden");
                                    $( "#idreF" ).text( "N° CONTRAREF.");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                    $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#btnTrans" ).addClass( "hidden");
                                    $( "#fuanEtk" ).removeClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).removeClass( "hidden");
                                    $( "#btnRefeAgre" ).addClass( "hidden");
                                    $( "#txtitleAudi" ).removeClass( "hidden");
                                    $( "#txtValorAudi" ).removeClass( "hidden");
                                      $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                                  
                        }else if(datos[17]=="5" &&  datos[31]=="1"){
                                    $( "#idreF" ).removeClass( "hidden");
                                    $( "#inputRef" ).removeClass( "hidden");
                                    $( "#idreF" ).text( "N° CONTRAREF.");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                   $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#btnTrans" ).addClass( "hidden");
                                    $( "#fuanEtk" ).addClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).removeClass( "hidden");
                                    $( "#btnRefeAgre" ).addClass( "hidden");
                                      $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                                   
                        }  else if(datos[17]=="9" &&  datos[31]=="4"){
                                    $( "#btnTrans" ).removeClass( "hidden");
                                    $( "#inputRef" ).addClass( "hidden");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                 $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#idreF" ).addClass( "hidden");
                                    $( "#fuanEtk" ).removeClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).addClass( "hidden");
                                    $( "#btnRefeAgre" ).addClass( "hidden");
                                     $( "#txtitleAudi" ).removeClass( "hidden");
                                  $( "#txtValorAudi" ).removeClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                           
                        }else if(datos[17]=="9" &&  datos[31]=="3"){
                                    $( "#btnTrans" ).removeClass( "hidden");
                                    $( "#inputRef" ).addClass( "hidden");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                   $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#idreF" ).addClass( "hidden");
                                    $( "#fuanEtk" ).removeClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).addClass( "hidden");
                                    $( "#btnRefeAgre" ).addClass( "hidden");
                                     $( "#txtitleAudi" ).removeClass( "hidden");
                                  $( "#txtValorAudi" ).removeClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                           
                        }
                        else if(datos[17]=="9" &&  datos[31]=="2"){
                                    $( "#btnTrans" ).removeClass( "hidden");
                                    $( "#inputRef" ).addClass( "hidden");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                   $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#idreF" ).addClass( "hidden");
                                    $( "#fuanEtk" ).removeClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).addClass( "hidden");
                                    $( "#btnRefeAgre" ).addClass( "hidden");
                                     $( "#txtitleAudi" ).removeClass( "hidden");
                                  $( "#txtValorAudi" ).removeClass( "hidden");
                                    $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    //$( "#nroCxref" ).val("");
                                    $kj = $("#nroCxref").val();
                                    if($kj==""){
                                         $("#nroCxref").val("6207-");
                                    }
                           
                        }else if(datos[17]=="9" &&  datos[31]=="1"){
                                    $( "#btnTrans" ).removeClass( "hidden");
                                    $( "#inputRef" ).addClass( "hidden");
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido").addClass( "hidden");
                                   $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#idreF" ).addClass( "hidden");
                                    $( "#fuanEtk" ).addClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).addClass( "hidden");
                                    $( "#btnRefeAgre" ).addClass( "hidden");
                                    $( "#txtitleAudi" ).removeClass( "hidden");
                                    $( "#txtValorAudi" ).removeClass( "hidden");
                                      $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                           
                        } else{
                                    $( "#idfa" ).addClass( "hidden");
                                    $( "#fallecido" ).addClass( "hidden");
                                    $( "#idreF" ).addClass( "hidden");
                                    $( "#inputRef" ).addClass( "hidden");
                                   $( "#viewTextPabellon" ).addClass( "hidden");
                                    $( "#viewListPabellon" ).addClass( "hidden");
                                    $( "#btnTrans" ).addClass( "hidden");
                                    $( "#fuanEtk" ).removeClass( "hidden");
                                    $( "#idFCuen" ).addClass( "hidden");
                                    $( "#inpCuenx" ).addClass( "hidden");
                                    $( "#teleEssa" ).addClass( "hidden");
                                    $( "#btnRefeAgre" ).addClass( "hidden");
                                    $( "#txtitleAudi" ).removeClass( "hidden");
                                    $( "#txtValorAudi" ).removeClass( "hidden");
                                      $( "#titleNvaCxt" ).addClass( "hidden");
                                   $( "#inpNvaCta" ).addClass( "hidden");
                                    $( "#nroCxref" ).val("");
                        }
                        
          
                       
                       
                       if(datos[31]!=3){
                            $("#seguros").html('');
                            cargarIafasEm(datos[4],datos[31]);
                            
                        }else if(datos[31] ==3 || datos[31] == 4 ){
                            
                            $("#seguros").html('');
                            cargarIafasEm(datos[4],datos[31]); 
                            cargarAseguradoras(datos[61],datos[31]);
                            
                        }
                        else{
                            $("#seguros").html('');
                            cargarAseguradoras(datos[61],datos[31]);
                        }
          
          
           $("#cuentaHsoMod").val(datos[62]);
            $("#origenEmerMod").val(datos[63]);
            $("#ubicacionHosX").val(datos[64]);
            $("#tipoSeiNHosx").val(datos[65]);
            $("#essHos").val(datos[66]);
            $("#nroRefHZ").val(datos[67]);
            $("#dxDescricon").val(datos[68]);
            $("#feReefHos").val(datos[69]);
            $("#especialidadHos").val(datos[70]);
            $("#pab1Hos").val(datos[71]);
            $("#camHos1").val(datos[72]);
            $("#pab2Hos").val(datos[73]);
            $("#camHos2").val(datos[74]);
            
            $("#fechaIngreHos").val(datos[75]);
            //$("#montoToaxlHos").val(datos[76]);
            $("#montoToaxlHos").val(datos[85]);
            
             cargarTipoSerIngHos(datos[65],datos[64]);
            cargarEspecialidades(datos[70]);
            cargarPabellonesHos1(datos[71])
            cargarPabellonesHos2(datos[73]);
            cargarObservacionesFua(datos[78]);
            
            
             $("#idUserLiquida").val(datos[80]);
             $("#statusRegPax").val(datos[81]);
             
              $("#monGalHosNu").val(datos[82]);
              $("#montSifHosNu").val(datos[83]);
              $("#monTotalCoHosNu").val(datos[84]);
              $("#tipoLiqux").val(datos[86]);
             
              $("#serEspecia").val(datos[87]);
              $("#tipocita").val(datos[88]);
            
            
            if(datos[77] == "on"){
                $("#aceptarTransf").prop('checked', true);
               
              }else{
                    $("#aceptarTransf").prop('checked', false);
              }
              
              
              
               if(datos[79] == "on"){
                $("#fuaRcxHos").prop('checked', true);
               
              }else{
                    $("#fuaRcxHos").prop('checked', false);
              }
              
              
             
                    if(datos[63]=="1" && tik == 1){
                        
                        $( "#viewEmerg" ).removeClass( "hidden");
                        $( "#viewConsulExter" ).addClass( "hidden");
                        $( "#viewEmergFeinf" ).removeClass( "hidden");
                        $("#telcEmerHs").text("CUENTA EMERG");
                        
                    }else if(datos[63]=="0" && tik == 1){
                        
                        $( "#viewEmerg" ).removeClass( "hidden");
                        $( "#viewConsulExter" ).addClass( "hidden");
                        $( "#viewEmergFeinf" ).removeClass( "hidden");
                        $("#telcEmerHs").text("CUENTA EMERG");
                        
                    }else if(datos[63]=="0" && tik == 2){
                        
                        $( "#viewEmerg" ).removeClass( "hidden");
                        $( "#viewConsulExter" ).addClass( "hidden");
                        $( "#viewEmergFeinf" ).removeClass( "hidden");
                        $("#telcEmerHs").text("CUENTA HOSP");
                        
                    }else if(datos[63]=="1" && tik == 2){
                        
                        $( "#viewEmerg" ).removeClass( "hidden");
                        $( "#viewConsulExter" ).addClass( "hidden");
                        $( "#viewEmergFeinf" ).removeClass( "hidden");
                        $("#telcEmerHs").text("CUENTA EMERG");
                        
                    }else if(tik == 3){
                        
                         $("#viewEmerg" ).addClass( "hidden");
                        $("#viewConsulExter" ).removeClass( "hidden");
                        $("#viewEmergFeinf" ).addClass( "hidden");
                        $("#telcEmerHs").text("CUENTA CE");
                        
                        $("#txtSegu").text("IAFAS");
                        
                        cargarFinanciamento(0,1)
                        cargarIafasEm(datos[4],1);
                        cargarRegimen(datos[32],datos[4]);
                        
                         $("#iafReg").removeClass("hidden");
                        $("#muesNroAfil").removeClass("hidden");
                        $("#datoNroAf").removeClass("hidden");
                        $("#feNuevas").removeClass("hidden");
                        $("#feRtU").addClass("hidden");
                        $("#fetOp").addClass("hidden");
                        $("#rowRaTEN").removeClass("hidden");
                        $("#txtLi").removeClass("hidden");
                        $("#divCehck").removeClass("hidden");
                        
                        
                        
                        
                        
                    }else{
                        
                        $("#viewEmerg" ).addClass( "hidden");
                        $("#viewConsulExter" ).removeClass( "hidden");
                        $("#viewEmergFeinf" ).addClass( "hidden");
                       // $("#telcEmerHs").text("CUENTA HOSP");
                        
                        
                    }
                    
                    
                    
                    if(tik =="2"){
                       $("#txtitleAudi").addClass("hidden");
                       $("#txtValorAudi").addClass("hidden");
                     
                    }else  {
                       $("#txtitleAudi").removeClass("hidden");
                       $("#txtValorAudi").removeClass("hidden");
                      
                    }      
                    
    });
    

      
    
}




function nextForm(){

  var ieo = $("#ideCE").val();
  
  var iul = $("#idUltimo").val();
  
  var sio = parseFloat(ieo) + parseFloat(1);
  
  if(sio <= iul ){
       verPacienteEmergenciaCE(sio);
  }else{
      alert("Fin de registros en este grupo");
  }
  
}


function prevForm(){

  var ieo = $("#ideCE").val();
  var iul = $("#idInicio").val();
   var sio = parseFloat(ieo) - parseFloat(1);
   
   if(sio >= iul){
        verPacienteEmergenciaCE(sio);
   }else{
       alert("Fin de registros en este grupo");
   }
   
 
}


function verPacienteEmergenciaCE(id){

   $("#ideCE").val(id)
   $('#seguros').empty();
    $('#espost').empty();
   $("#pabellones").empty();
    $('#listaSeguros').empty();
    $("#ui-id-1").css("z-index", "9999999999");
    $("#ui-id-2").css("z-index", "9999999999");
    $("#ui-id-3").css("z-index", "9999999999");
    $("#ui-id-4").css("z-index", "9999999999");
    $("#ui-id-5").css("z-index", "9999999999");

    $.ajax({
        url:'./Controlador/search.php?function=consultaExterna',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
      
        $("#fuaCE").val(datos[0]);
        $("#hisCliCE").val(datos[1]);
        $("#tipoDocCE").val(datos[2]);
        $("#NroDocCE").val(datos[3]);
        //$("#seguros").val(datos[4]);
        if(datos[4]==11){
             $( "#textSeg" ).removeClass( "hidden");
             $( "#listseg" ).removeClass( "hidden");
         }else{
              $( "#textSeg" ).addClass( "hidden");
              $( "#listseg" ).addClass( "hidden");
        }
         cargarSeguros(datos[4]);
        //$("#listaSeguros").val(datos[5]);
        cargarAseguradoras(datos[5]);
        $("#ubicacionCE").val(datos[6]);
        $("#sexoCE").val(datos[7]);
        $("#cuenta").val(datos[8]);
        $("#NroAf").val(datos[9]);
        $("#eess").val(datos[10]);
        $("#nombresCE").val(datos[11]);
        $("#FechaNacCE").val(datos[12]);
        $("#apepaCE").val(datos[13]);
        $("#apemaCE").val(datos[14]);
        $("#telefa").val(datos[15]);
        $("#edadCE").val(datos[16]);
        //$("#espost").val(datos[17]);
       /* if(datos[17]==1){
                
                      $( "#idfa" ).removeClass( "hidden");
                      $( "#idfa" ).text("F. ALTA");
                      $( "#fallecido" ).removeClass( "hidden");
                      $( "#viewTextPabellon" ).addClass( "hidden");
                      $( "#viewListPabellon" ).addClass( "hidden");
                       $( "#idreF" ).addClass( "hidden");
                    $( "#inputRef" ).addClass( "hidden");
                    }else if(datos[17]=="2"){
                      $( "#idfa" ).removeClass( "hidden");
                      $( "#idfa" ).text("F. FALLECIDO");
                      $( "#fallecido" ).removeClass( "hidden");
                       $( "#viewTextPabellon" ).addClass( "hidden");
                      $( "#viewListPabellon" ).addClass( "hidden");
                        $( "#idreF" ).addClass( "hidden");
                    $( "#inputRef" ).addClass( "hidden");
                    }else if(datos[17]=="3"){
                      $( "#idfa" ).addClass( "hidden");
                      $( "#idfa" ).text("PABELLONES");
                      $( "#fallecido").addClass( "hidden");
                      $( "#viewTextPabellon" ).removeClass( "hidden");
                      $( "#viewListPabellon" ).removeClass( "hidden");
                      $( "#idreF" ).addClass( "hidden");
                      $( "#inputRef" ).addClass( "hidden");
                    }else if(datos[17]=="4"){
                      $( "#idreF" ).removeClass( "hidden");
                      $( "#idreF" ).text( "N° REFERENCIA");
                      $( "#inputRef" ).removeClass( "hidden");
                      $( "#idfa" ).addClass( "hidden");
                      $( "#fallecido").addClass( "hidden");
                      $( "#viewTextPabellon" ).addClass( "hidden");
                      $( "#viewListPabellon" ).addClass( "hidden");
                    }else if(datos[17]=="5"){
                      $( "#idreF" ).removeClass( "hidden");
                      $( "#inputRef" ).removeClass( "hidden");
                      $( "#idreF" ).text( "N° CONTRAREF.");
                      $( "#idfa" ).addClass( "hidden");
                      $( "#fallecido").addClass( "hidden");
                      $( "#viewTextPabellon" ).addClass( "hidden");
                      $( "#viewListPabellon" ).addClass( "hidden");
                    }else{
                      $( "#idfa" ).addClass( "hidden");
                      $( "#fallecido" ).addClass( "hidden");
                      $( "#idreF" ).addClass( "hidden");
                      $( "#inputRef" ).addClass( "hidden");
                      $( "#viewTextPabellon" ).addClass( "hidden");
                      $( "#viewListPabellon" ).addClass( "hidden");
                    }
                    
        cargarDestinos(datos[17],1)
        $("#fefa").val(datos[18]);
        $("#referido").val(datos[19]);
        //$("#pabellones").val(datos[20]);
        cargarPabellones(datos[20]); */
        $("#feingreCE").val(datos[21]);
        $("#feAlta").val(datos[22]);
        $("#monGalCE").val(datos[23]);
        $("#montSifCE").val(datos[24]);
        $("#obsResCE").val(datos[25]);
        $("#tipoReg").val(datos[26]);
        $("#valAte").val(datos[27]);
        $("#coPre").val(datos[28]);
        $("#cie10_1x").val(datos[29]);
        $("#tip1").val(datos[30]);
        
        
        
        $("#cie10_2x").val(datos[31]);
        $("#tip2").val(datos[32]);
        $("#cie10_3x").val(datos[33]);
        $("#tip3").val(datos[34]);
        $("#cie10_4x").val(datos[35]);
        $("#tip4").val(datos[36]);
        $("#cie10_5x").val(datos[37]);
        $("#tip5").val(datos[38]);
        
        
        
     
    });
}



function editarProgramacionCirugia(id){

  

    $.ajax({
        url:'./Controlador/search.php?function=idprogramacionCirugia',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
      
       cargarEspecialidadesCirugia(datos[3]);
       listTipoDocCirugia(datos[4]);
       
      
        $("#nroDocCiru").val(datos[5]);
        $("#pacienCIruProg").val(datos[6]);
        $("#edadCiruProg").val(datos[7]);
        $("#historiaCiru").val(datos[8]);
        $("#celularCiru").val(datos[9]);
        $("#dxcie10").val(datos[10]);
        $("#tip3").val(datos[11]);
        $("#dxpreop").val(datos[12]);
        $("#tipoEstPat").val(datos[13]);
        $("#procedQx").val(datos[14]);
        cargarAnestesiaProg(datos[15]);
        cargarCirugiaProg(datos[16]);
        cargarPabellonesCiru(datos[17]);
        cargarSalaCiru(datos[18],datos[17]);
        $("#fechaInterve").val(datos[19]);
        listTurnoCirugia(datos[20]);
        $("#cirugiaIndicaPor").val(datos[21]);
        $("#cirujanoPri").val(datos[22]);
        $("#anestesiologo").val(datos[23]);
        cargarSerInter(datos[24]);
        listUrpaCirugia(datos[25]);
        cargaEstadoCxMo(datos[26]);
        $("#financiaCirugia").val(datos[27]);
        

    });
}



function editarReporteOperatorio(id){

  

    $.ajax({
        url:'./Controlador/search.php?function=idReporteOperatorio',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
     
        $("#fechAhoraInicio").val(datos[1]);
        $("#fechaHoraFin").val(datos[2]);
        $("#descrReporOpe").val(datos[3]);
        $("#compliQirurgica").val(datos[4]);
        $("#cirujanoPreo").val(datos[5]);
        $("#anesteReporte").val(datos[6]);
        $("#instrumentRepo").val(datos[7]);
        $("#obserReporOpera").val(datos[8]);
        $("#muestraPato").val(datos[9]);
        

    });
}



function editarReporteOperatorioDat(id){

  

    $.ajax({
        url:'./Controlador/search.php?function=idReporteOperatorioDat',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
     
        $("#datosPx").text(datos[0]);
        $("#lbltipoDocRep").text(datos[1]);
        $("#lblNroDoc").text(datos[2]);
        $("#lblHistoria").text(datos[3]);
        $("#lblEdad").text(datos[4]);
        $("#lblFinancia").text(datos[5]);
        $("#lblEspecial").text(datos[6]);
        
        

    });
}





function verUltimoiD(id){

  
    $.ajax({
        url:'./Controlador/search.php?function=consultaIdGrupo',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
    
        $("#idUltimo").val(datos[0]);
    
    });
}



function cuentaAuditada(cuenta){

 
    $.ajax({
        url:'./Controlador/search.php?function=consultaCuenta',
        type:'GET',
        dataType:'json',
        data:{ id: cuenta }
        
    }).done(function(datos){
    
        
        if(datos[0]=="ENVIADO"){
            $("#guardarEmege").addClass("hidden");
            $("#butonAudit").removeClass("hidden");
            
        }else if(datos[0]=="NO"){
             $("#butonAudit").removeClass("hidden");
            
        }else {
              $("#guardarEmege").removeClass("hidden");
              $("#butonAudit").addClass("hidden");
        }
    
    });
}


function habilitarCuentaAuditada(){

      $("#idMo").val($("#ide").val());  
      var cuenta = $("#cuenta").val();
        
    $.ajax({
        url:'./Controlador/search.php?function=consultaCuenta',
        type:'GET',
        dataType:'json',
        data:{ id: cuenta }
        
    }).done(function(datos){
    
        
        if(datos[0]=="ENVIADO"){
            $("#motAlertM").text("MENSAJE");
            $("#sccMot").addClass("hidden");
            $("#btnGuarMo").addClass("hidden");
            $("#txtAlert").removeClass("hidden");
            
            
        }else if(datos[0]=="NO"){
            $("#motAlertM").text("MOTIVO");
            $("#sccMot").removeClass("hidden");
            $("#btnGuarMo").removeClass("hidden");
            $("#txtAlert").addClass("hidden");
            
            
            $("#guardarEmege").removeClass("hidden");
            $("#butonAudit").addClass("hidden");
            
        }
    
    });
    
}

function habilitarRegistro(){
    
         $("#guardarEmege").removeClass("hidden");
         $("#butonAudit").addClass("hidden");
    
}


function verMiniD(id){

  
    $.ajax({
        url:'./Controlador/search.php?function=consultaIdGrupoMin',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
    
        $("#idInicio").val(datos[0]);
    
    });
}

function verGrupos(id){

   $("#idgroux").val(id)
   $('#audiGrupo').empty();
  

    $.ajax({
        url:'./Controlador/search.php?function=consultaGrupos',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
    
        cargarAuditorGrupo(datos[0]);
        $("#obsGrupo").val(datos[1]);
        $("#nomPac").val(datos[2]);
        $("#feAsg").val(datos[3]);
        $("#feRexc").val(datos[4]); 
        
    
    });
}


function verPacienteHospi(id){

   $("#ide").val(id)
   $('#seguros').empty();
    $('#espost').empty();
   $("#pabellones").empty();
    $('#listaSeguros').empty();
    

    $.ajax({
        url:'./Controlador/search.php?function=consultaEmergencia',
        type:'GET',
        dataType:'json',
        data:{ id: id }
        
    }).done(function(datos){
        
      
        $("#fua").val(datos[0]);
        $("#hisCli").val(datos[1]);
        $("#tipoDoc").val(datos[2]);
        $("#NroDoc").val(datos[3]);
        //$("#seguros").val(datos[4]);
        if(datos[4]==11){
             $( "#textSeg" ).removeClass( "hidden");
             $( "#listseg" ).removeClass( "hidden");
         }else{
              $( "#textSeg" ).addClass( "hidden");
              $( "#listseg" ).addClass( "hidden");
        }
         cargarSeguros(datos[4]);
        //$("#listaSeguros").val(datos[5]);
        cargarAseguradoras(datos[5]);
        $("#ubicacion").val(datos[6]);
        $("#sexo").val(datos[7]);
        $("#cuenta").val(datos[8]);
        $("#NroAf").val(datos[9]);
        $("#eess").val(datos[10]);
        $("#nombres").val(datos[11]);
        $("#FechaNac").val(datos[12]);
        $("#apepa").val(datos[13]);
        $("#apema").val(datos[14]);
        $("#telefa").val(datos[15]);
        $("#edad").val(datos[16]);
        //$("#espost").val(datos[17]);
        
                if(datos[17]=="6"){
                      $( "#idfa" ).removeClass( "hidden");
                      $( "#idfa" ).text("F. FALLECIDO");
                      $( "#fallecido" ).removeClass( "hidden");
                      $( "#viewTextPabellon" ).addClass( "hidden");
                      $( "#viewListPabellon" ).addClass( "hidden");
                       $( "#idreF" ).addClass( "hidden");
                    $( "#inputRef" ).addClass( "hidden");
                    }else if(datos[17]=="7"){
                      $( "#idfa" ).removeClass( "hidden");
                      $( "#idfa" ).text("F. ALTA");
                      $( "#fallecido" ).removeClass( "hidden");
                       $( "#viewTextPabellon" ).addClass( "hidden");
                      $( "#viewListPabellon" ).addClass( "hidden");
                        $( "#idreF" ).addClass( "hidden");
                    $( "#inputRef" ).addClass( "hidden");
                    }else if(datos[17]=="8"){
                      $( "#idreF" ).removeClass( "hidden");
                      $( "#idreF" ).text( "FUA VINCULAR");
                      $( "#inputRef" ).removeClass( "hidden");
                      $( "#idfa" ).addClass( "hidden");
                      $( "#fallecido").addClass( "hidden");
                      $( "#viewTextPabellon" ).addClass( "hidden");
                      $( "#viewListPabellon" ).addClass( "hidden");
                    }
                    
        cargarDestinos(datos[17],2)
        $("#fefa").val(datos[18]);
        $("#referido").val(datos[19]);
        //$("#pabellones").val(datos[20]);
        cargarPabellones(datos[20]);
        $("#feingre").val(datos[21]);
        $("#feAlta").val(datos[22]);
        $("#monGal").val(datos[23]);
        $("#montSif").val(datos[24]);
        $("#obsRes").val(datos[25]);
        $("#tipoReg").val(datos[26]);
        $("#feuser").val(datos[29]);
        $("#chis").removeClass('hidden');
        
      /*  if(datos[27] == "on"){
                $("#chis").addClass('hidden');
                
          }else{
                $("#chis").addClass('hidden');
               
         }*/
         
         if(datos[27] == "off"){
                $("#envioA").prop('checked', true);
                
          }else{
                $("#envioA").prop('checked', false);
               
         }
       
     
    });
}


function cieDesc(){

    $.ajax({
        url:'./Controlador/search.php?function=dxdesTe',
        type:'GET',
        dataType:'json',
        data:{ term:$('#descripcion').val()}
        
    }).done(function(datos){
        
        $("#codDx").val(datos[0]);
     
    });
}


function verExmaen(){

 
    $("#iddEx").val($("#cuenta").val());
    $('#formExamenx')[0].reset();
    CargarExamens($("#cuenta").val());
   

}


function verObserpac(){

 if($("#cuenta").val()==""){
     var tik = getParameterByName('tipo');
     $("#idPaObs").val($("#hisCli").val()+tik);
 }else{
     
     $("#idPaObs").val($("#cuenta").val());
 }
    //$("#idPaObs").val($("#cuenta").val());
    
    $("#ids").val("");
    $('#formObsePax')[0].reset();
  
}

function verObserpaCajas(id){

    CargarObservacionesCajas(id);
    $("#obsCaja").val("");$("#ediCaja").val("");
    
    $("#idCaja").val(id);
    
        $.ajax({
          url:'./Controlador/search.php?function=buscarArvciv',
          type:'GET',
          dataType:'json',
          data:{ id:id}
    
      }).done(function(datos){
         
          $("#archix").val(datos[0]);
          
          
      });
    
  
}

function verCajaModal(){

    $("#refeCaja").val();
    var tik = getParameterByName('id');
    CargarListadoCajas(0,tik);
    var id = "1";
    $.ajax({
      url:'./Controlador/search.php?function=buscarUltimoRe&tipo='+tik,
      type:'GET',
      dataType:'json',
      data:{ NroDoc:id}

  }).done(function(datos){
     
      $("#refeCaja").val(datos[0]);
      verCantAsign(datos[0]);
      
  });

}


function verCantAsign(id){


    $.ajax({
      url:'./Controlador/search.php?function=cantidadAsig',
      type:'GET',
      dataType:'json',
      data:{ id:id}

  }).done(function(datos){
     
      $("#cantidaCax").text("TOTAL: "+datos[0]);
      
  });

}


function verExmaenRef(){

    $("#ui-id-3").css("z-index", "9999999999");
    $("#iddExRef").val($("#cuenta").val());
    $('#formExamenxRefs')[0].reset();
    CargarExamensRef($("#cuenta").val());
   

}


function verSesiones(){

 
    $("#idSes").val($("#NxuentaQ").val());
    $('#formSessions')[0].reset();
    CargarSesiones($("#NxuentaQ").val());


}






function agregarExamen()
{
  
    var info = $("#formExamenx").serialize();
    var fechaex = $("#fechaex").val();  
    var nrotrans = $("#nrotrans").val();  

    if(fechaex==""){

        alert("Debes llenar en el campo FECHA");
       
    }else if(nrotrans==""){

        alert("Debes llenar el NRO TRANSFERENCIA");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=RegistroExamen",
            data: info,
    
            success: function(resp){               
               
                $('#formExamenx')[0].reset();                
                CargarExamens($("#cuenta").val());
            }
            
        });
        
    }   
}  


function copyIdEm(){
    
    $("#idMo").val($("#ide").val());
    
}


function insertMotivoUserFecha()
{
  
    var info = $("#frmMotivo").serialize();
    var motivoHabiBoton = $("#motivoHabiBoton").val();  
    

    if(motivoHabiBoton==""){

        alert("Agregar MOTIVO para habilitar el registro.");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=registroMotivo",
            data: info,
    
            success: function(resp){               
               
                $('#frmMotivo')[0].reset();  
                $('#cerraMotivo').click();
                $("#guardarEmege").removeClass("hidden");
                $("#butonAudit").addClass("hidden");
                
            }
            
        });
        
    }   
}  



function agregarObsevPax()
{
  
    var info = $("#formObsePax").serialize();
    var obsPaix = $("#obsPaix").val();  
     

    if(obsPaix==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes llenar en el campo OBSERVACION"
          });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=RegistroObsePax",
            data: info,
    
            success: function(resp){               
               
                $('#formObsePax')[0].reset();
                $('#cerraObsverPax').click();
                
                var tik = getParameterByName('tipo');
                if($("#cuenta").val()==""){
                    CargarObservacionesPaciente($("#hisCli").val() + tik);
                }else{
                    CargarObservacionesPaciente($("#cuenta").val());
                }
                
            }
            
        });
        
    }   
}  




function agregarCptsCitoEspec()
{
  
    var info = $("#frmCptsCitoEs").serialize();
    var id = $("#idProcedCito").val();

        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=RegistroCitoEspec",
            data: info,
    
            success: function(resp){               
               
                    $('#frmCptsCitoEs')[0].reset();
                    $('#cerraObsverPax').click();
                    CargarCptCitologia(id);
                
                
            }
            
        });
        

}  



function RegistrarUsuarioInterno()
{
  
    var info = $("#formUsuarioInt").serialize();
    
    var teleusu = $("#teleusu").val();
    var nomusu = $("#nomusu").val(); 
    
    var profeSys = $("#profeSys").val();
    var areaUnid = $("#areaUnid").val();
    var emailusu = $("#emailusu").val();
    var codigoFor = $("#codigoFor").val();
    var eesS = $("#eesS").val();
    var userusu = $("#userusu").val();  
    var password = $("#password").val();  

    if(teleusu==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar el DNI del usuario"
          });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=RegistroUsuarioInt",
            data: info,
    
            success: function(resp){               
               
              
                           $('#formUsuarioInt')[0].reset();
                            $('#cerrarusuario').click();
                            $('#tableUsuarios').DataTable().ajax.reload(null,false);
                            $.NotificationService.showInfoNotification({
                                          title:"Mensaje",
                                          message:"Usuario actualizado exitosamente."
                                });
                           //$(location).attr('href','index.php');
                
            }
            
        });
        
    }   
}  



function RegistrarUsuarioExterno()
{
  
    var info = $("#formUsuario").serialize();
    
    var teleusu = $("#teleusu").val();
    var nomusu = $("#nomusu").val(); 
    
    var profeSys = $("#profeSys").val();
    var areaUnid = $("#areaUnid").val();
    var emailusu = $("#emailusu").val();
    var codigoFor = $("#codigoFor").val();
    var eesS = $("#eesS").val();
    var userusu = $("#userusu").val();  
    var password = $("#password").val();  

    if(teleusu==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar el DNI del usuario"
          });
       
    }else if(password==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar una CONTRASEÑA"
          });
       
    }else if(profeSys==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar la PROFESION"
          });
       
    }else if(areaUnid==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar la OF./AREA/UNIDAD"
          });
       
    }else if(emailusu==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar el CORREO"
          });
       
    }else if(codigoFor==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar el CODIGO"
          });
       
    }else if(eesS==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar el nombre de ESTABLECIMIENTO"
          });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=RegistroUsuario",
            data: info,
    
            success: function(resp){               
               
              
                       if(resp==1){
                           
                           $.NotificationService.showErrorNotification({
                                      title:"Mensaje",
                                      message:"El USUARIO ya ha sido registrado."
                            });
                       }else{
                            alert("Revisar su bandeja de correo para la activación de su usuario");
                           $(location).attr('href','index.php');
                       }
               
    
                
            }
            
        });
        
    }   
}  



function enviarContrasena()
{
  
  
    var info = $("#formEmail").serialize();
    
    var passWordC = $("#passWordC").val();
    

    if(passWordC==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar la NUEVA CONTRASEÑA"
          });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=envioEmail",
            data: info,
    
            success: function(resp){               
               
               alert("Se realizó el cambio correctamente");
               $(location).attr('href','https://sighap.com');
              
            }
            
        });
        
    }   
}  

function RegistrarUsuario()
{
  
    var info = $("#formUsuario").serialize();
    var nomusu = $("#nomusu").val();  
    var teleusu = $("#teleusu").val();
    var userusu = $("#userusu").val();  
    var password = $("#password").val();  

    if(teleusu==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar el DNI del usuario"
          });
       
    }else if(nomusu==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar el USUARIO"
          });
       
    }else if(password==""){

            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes ingresar una CONTRASEÑA"
          });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=RegistroUsuario",
            data: info,
    
            success: function(resp){               
               
                $('#formUsuario')[0].reset();
                $('#cerrarusuario').click();
                $('#tableUsuarios').DataTable().ajax.reload(null,false);
                $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Usuario creado exitosamente."
                    });
                
            }
            
        });
        
    }   
}  

function agregarActividaAuditoria()
{
  
   // alert($("#ide").val());
    var info = $("#frmActividadAuditoria").serialize();
    
    
  
    
    var iduser = $("#iduser").val();  
    var ide = $("#ide").val();  
    var idActividad = $("#idActividad").val(); 
    var actividadAudit = $("#actividadAudit").val(); 
    var proceAuditoria = $("#proceAuditoria").val();  
    var dxAudito = $("#dxAudito").val();  
    var observAuditForm = $("#observAuditForm").val();  
   

    if(actividadAudit==""){

          /*  $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes llenar en el campo ACTIVIDAD"
          });*/
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=registroActividadAudi",
            data: { iduser: iduser, ide:ide, actividadAudit:actividadAudit, proceAuditoria:proceAuditoria , dxAudito:dxAudito,observAuditForm:observAuditForm,idActividad:idActividad },
            
            success: function(resp){               
               
                  
                $("#idActividad").val(""); 
                $("#actividadAudit").val(""); 
                $("#proceAuditoria").val("");  
                $("#dxAudito").val("");  
                $("#observAuditForm").val(""); 
                CargarObsAuditoria(ide);
            }
            
        });
        
    }   
    
    
}  


function RegistrRotulo()
{
  
    var info = $("#formRotulo").serialize();
    var categoria = $("#categoria").val();  
    var procePat = $("#procePat").val();
    var formatoPatologiaMac = $("#formatoPatologiaMac").val();
    var filtroTipoEst = $("#filtroTipoEst").val();

    if(categoria==""){

        
            $.NotificationService.showErrorNotification({
                              title:"Mensaje",
                              message:"Debes llenar en el campo CATEGORIA"
                  });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=RegistroObsePaxRotulo",
            data: info,
    
            success: function(resp){               
               
                $('#formRotulo')[0].reset();
                $('#cerrRot').click();
                
               /*
                     CargarRotulosPat(1,3);
                     CargarTacosPat(3); */
                     
                     if(procePat==13){
                         
                          CargarRotulosPatCervico(3,0,formatoPatologiaMac,filtroTipoEst);
                          CargarTacosPat(3,formatoPatologiaMac,filtroTipoEst);
                          CargarRotulosHistoquiCervicoVaginal(3,3,formatoPatologiaMac,filtroTipoEst)
                      
                          
                          
                     }else{
                         
                          CargarRotulosPat(filtroTipoEst,1,formatoPatologiaMac,filtroTipoEst);
                          CargarTacosPat(filtroTipoEst,formatoPatologiaMac,filtroTipoEst);
                          
                     }
                   
                
               
            }
            
        });
        
    }   
}  



function obsMicroFrm()
{
  
    var info = $("#frmObsMicro").serialize();
    var obsMicrotextArea = $("#obsMicrotextArea").val(); 
    
    var procePat = $("#procePat").val(); 
    var formatoPatologiaMac = $("#formatoPatologiaMac").val(); 
    var filtroTipoEst = $("#filtroTipoEst").val(); 
    
     

    if(obsMicrotextArea==""){

        
            $.NotificationService.showErrorNotification({
                      title:"Mensaje",
                      message:"Debes llenar en el campo RESPUESTA"
            });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=ObsMicroscopiaFrm",
            data: info,
    
            success: function(resp){               
               
                $('#frmObsMicro')[0].reset();
                $('#cerrRotRsptDelete').click();
               // CargarRotulosPat(1);
                //CargarTacosPat(1);
                
                
                    if(procePat==13){
                         
                          CargarRotulosPatCervico(3,0,formatoPatologiaMac,filtroTipoEst);
                          CargarTacosPat(3,formatoPatologiaMac,filtroTipoEst);
                          CargarRotulosHistoquiCervicoVaginal(3,3,formatoPatologiaMac,filtroTipoEst)
                      
                          
                     }else{
                         
                          CargarRotulosPat(filtroTipoEst,1,formatoPatologiaMac,filtroTipoEst);
                          CargarTacosPat(filtroTipoEst,formatoPatologiaMac,filtroTipoEst);
                          
                     }
                
            }
            
            
        });
        
        
    } 
    
    
    
}  



function rsptaMicro()
{
  
    var info = $("#frmRsptaMicro").serialize();
    var rsptaMic = $("#rsptaMic").val();  
    
    
    var procePat = $("#procePat").val();  
    var formatoPatologiaMac = $("#formatoPatologiaMac").val();  
    var filtroTipoEst = $("#filtroTipoEst").val();  

    if(rsptaMic==""){

        
            $.NotificationService.showErrorNotification({
                              title:"Mensaje",
                              message:"Debes llenar en el campo RESPUESTA"
                  });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=rsptaMicroscopia",
            data: info,
    
            success: function(resp){               
               
                $('#frmRsptaMicro')[0].reset();
                $('#cerrRotRspt').click();
                CargarRotulosPat(1);
                CargarTacosPat(1);
                
                
                 if(procePat==13){
                         
                          CargarRotulosPatCervico(3,0,formatoPatologiaMac,filtroTipoEst);
                          CargarTacosPat(3,formatoPatologiaMac,filtroTipoEst);
                          CargarRotulosHistoquiCervicoVaginal(3,3,formatoPatologiaMac,filtroTipoEst)

                          
                 }else{
                     
                      CargarRotulosPat(filtroTipoEst,1,formatoPatologiaMac,filtroTipoEst);
                      CargarTacosPat(filtroTipoEst,formatoPatologiaMac,filtroTipoEst);
                      
                 }

                
                
            }
            
        });
        
    } 
    
}  


function rsptaMacroObs()
{
  
    var info = $("#frmRsptaMacro").serialize();
    var rsptaMic = $("#rsptaMacro").val();  
     var procePat = $("#procePat").val();
     
     var formatoPatologiaMac = $("#formatoPatologiaMac").val();
     var filtroTipoEst = $("#filtroTipoEst").val();

    if(rsptaMic==""){

        
            $.NotificationService.showErrorNotification({
                              title:"Mensaje",
                              message:"Debes llenar en el campo RESPUESTA"
                  });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=obsMacroscopia",
            data: info,
    
            success: function(resp){               
               
                $('#frmRsptaMacro')[0].reset();
                $('#cerrRotRsptMacro').click();
                
                   if(procePat==13){
                      // CargarRotulosPat(3)
                      //CargarRotulosPatCervico();
                       //CargarTacosPat(3);
                          CargarRotulosPatCervico(3,0,formatoPatologiaMac,filtroTipoEst);
                          CargarTacosPat(3,formatoPatologiaMac,filtroTipoEst);
                          CargarRotulosHistoquiCervicoVaginal(3,3,formatoPatologiaMac,filtroTipoEst)
                       
                   }else{
                       //CargarRotulosPat(1);
                       //CargarTacosPat(1);    
                       
                          CargarRotulosPat(filtroTipoEst,1,formatoPatologiaMac,filtroTipoEst);
                          CargarTacosPat(filtroTipoEst,formatoPatologiaMac,filtroTipoEst);
                       
                   }
            }
            
        });
        
    } 
    
}  


function obsMicroLabMix()
{
  
    var info = $("#frmObsMicroLabMij").serialize();
    var rsptObsLabMij = $("#rsptObsLabMij").val();  
     
     var filtroTipoEst = $("#filtroTipoEst").val();  
     var formatoPatologiaMac = $("#formatoPatologiaMac").val();  

    if(rsptObsLabMij==""){

        
            $.NotificationService.showErrorNotification({
                              title:"Mensaje",
                              message:"Debes llenar en el campo RESPUESTA"
                  });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=obsMicroLabMix",
            data: info,
    
            success: function(resp){               
               
                $('#frmObsMicroLabMij')[0].reset();
                $('#cerrRotRsptLabCeMix').click();
                //CargarRotulosPat(1);
                //CargarTacosPat(1);
                    CargarRotulosPat(filtroTipoEst,1,formatoPatologiaMac,filtroTipoEst);
                    CargarTacosPat(filtroTipoEst,formatoPatologiaMac,filtroTipoEst);
                
            }
            
        });
        
    } 
    
}  


function rsptaMicroLab()
{
  
    var info = $("#frmRsptaMicroLab").serialize();
    var rsptaMic = $("#rsptaMicLab").val();  
    
     var filtroTipoEst = $("#filtroTipoEst").val();  
     var formatoPatologiaMac = $("#formatoPatologiaMac").val();  
     

    if(rsptaMic==""){

        
            $.NotificationService.showErrorNotification({
                              title:"Mensaje",
                              message:"Debes llenar en el campo RESPUESTA"
                  });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=rsptaMicroscopiaLab",
            data: info,
    
            success: function(resp){               
               
                $('#frmRsptaMicroLab')[0].reset();
                $('#cerrRotRsptLabCe').click();
                //CargarRotulosPat(1);
                //CargarTacosPat(1);
                    CargarRotulosPat(filtroTipoEst,1,formatoPatologiaMac,filtroTipoEst);
                    CargarTacosPat(filtroTipoEst,formatoPatologiaMac,filtroTipoEst);
            }
            
        });
        
    } 
    
}  


function rsptaObsMicroLab()
{
  
    var info = $("#frmObsMicroLab").serialize();
    var rsptaMic = $("#rsptaObsMicLab").val();  
     var procePat = $("#procePat").val();

        var formatoPatologiaMac = $("#formatoPatologiaMac").val();
        var filtroTipoEst = $("#filtroTipoEst").val();
    

    if(rsptaMic==""){

        
            $.NotificationService.showErrorNotification({
                              title:"Mensaje",
                              message:"Debes llenar en el campo RESPUESTA"
                  });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=rsptaObscopiaLab",
            data: info,
    
            success: function(resp){               
               
                $('#frmObsMicroLab')[0].reset();
                $('#cerrObsRsptLabCe').click();
                
                
                                if(procePat==13){
                                    
                                       //CargarRotulosHistoquiCervicoVaginal(3)
                                      // CargarTacosPat(3);
                                       
                                       CargarRotulosPatCervico(3,0,formatoPatologiaMac,filtroTipoEst);
                                        CargarTacosPat(3,formatoPatologiaMac,filtroTipoEst);                         
                                        CargarRotulosHistoquiCervicoVaginal(3,3,formatoPatologiaMac,filtroTipoEst)
                                       
                                       
                                   }else if(procePat >=13){
                                    
                                       //CargarRotulosHistoquiCervicoVaginal(3)
                                      // CargarTacosPat(3);
                                       
                                       CargarRotulosPat(filtroTipoEst,1,formatoPatologiaMac,filtroTipoEst);
                                        CargarTacosPat(1,formatoPatologiaMac,filtroTipoEst);
                                       
                                       
                                   }else{
                                      // CargarRotulosPat(1);
                                       //CargarTacosPat(1);  
                                       
                                        CargarRotulosPat(filtroTipoEst,1,formatoPatologiaMac,filtroTipoEst);
                                        CargarTacosPat(filtroTipoEst,formatoPatologiaMac,filtroTipoEst);
                                        
                                        
                                   }
            
            }
            
        });
        
    } 
    
}  



function registrarDatosProgCirugia()
{
  
    var info = $("#frmProgramacioCIrugia").serialize();
    var iduser = $("#iduser").val();  
     

    if(iduser==""){
        
            $.NotificationService.showErrorNotification({
                              title:"Mensaje",
                              message:"Debes INICIAR SESION"
            });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=registroProgCirugias",
            data: info,
    
            success: function(resp){               
               
                $('#frmProgramacioCIrugia')[0].reset();
                url = "./listadoCirugias.php";
                $(location).attr('href',url);
                
            }
            
        });
        
    }   
}  





function registrarDatosReporteOperatorio()
{
    
    
    $('#tbl_dxPre tr').each(function () {
              var descripDx= $(this).find('input').eq(0).val();
              var tipoDx = $(this).find('select').eq(0).val();
              var idHis = $("#ide").val();
              var iduser = $("#iduser").val();
        
        
         $.ajax({
              async: false,
              type: "POST",
              url: "./Controlador/controllerProcedimientos.php?function=insertDxPreOpera",
              data: "descripDx="+descripDx+"&tipoDx="+tipoDx+"&idHis="+idHis+"&iduser="+iduser,
               success: function(data) { if(data!="");}
        
              });
    });
    
    
    
    
     $('#tbl_dxPost tr').each(function () {
              var descripDx= $(this).find('input').eq(0).val();
              var tipoDx = $(this).find('select').eq(0).val();
              var idHis = $("#ide").val();
              var iduser = $("#iduser").val();
        
        
         $.ajax({
              async: false,
              type: "POST",
              url: "./Controlador/controllerProcedimientos.php?function=insertDxPostOpera",
              data: "descripDx="+descripDx+"&tipoDx="+tipoDx+"&idHis="+idHis+"&iduser="+iduser,
               success: function(data) { if(data!="");}
        
              });
    });
    
    
    
    $('#tbl_inter tr').each(function () {
                                                     
          var descripDx= $(this).find('input').eq(0).val();
          var tipoDx = "1";
          var idHis = $("#ide").val();
          var iduser = $("#iduser").val();
    
    
          $.ajax({
              async: false,
              type: "POST",
              url: "./Controlador/controllerProcedimientos.php?function=insertIntervencionRealizada",
              data: "descripDx="+descripDx+"&tipoDx="+tipoDx+"&idHis="+idHis+"&iduser="+iduser,
               success: function(data) { if(data!="");}
    
          });
          
    });
    
    
     $('#tbl_asist tr').each(function () {
                                                     
          var descripDx= $(this).find('input').eq(0).val();
          var tipoDx = "1";
          var idHis = $("#ide").val();
          var iduser = $("#iduser").val();
    
    
          $.ajax({
              async: false,
              type: "POST",
              url: "./Controlador/controllerProcedimientos.php?function=insertCirujanoAsist",
              data: "descripDx="+descripDx+"&tipoDx="+tipoDx+"&idHis="+idHis+"&iduser="+iduser,
               success: function(data) { if(data!="");}
    
          });
          
    });
    
    
    
  
    var info = $("#frmReporteOperatorio").serialize();
    var iduser = $("#iduser").val();  
     

    if(iduser==""){
        
            $.NotificationService.showErrorNotification({
                              title:"Mensaje",
                              message:"Debes INICIAR SESION"
            });
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=registroDatosReporteOperatorio",
            data: info,
    
            success: function(resp){               
               
                $('#frmReporteOperatorio')[0].reset();
                url = "./listadoCirugias.php";
                $(location).attr('href',url);
                
            }
            
        });
        
    }   
}  

function agregarExamenRef()
{
  
    var info = $("#formExamenxRefs").serialize();
    var fechaex = $("#fechaexRef").val();  
    var nrotrans = $("#nrotransFe").val();  

    if(fechaex==""){

        alert("Debes llenar en el campo FECHA");
       
    }else if(nrotrans==""){

        alert("Debes llenar el NRO REFERENCIA");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=RegistroExamenRef",
            data: info,
    
            success: function(resp){               
               
                $('#formExamenxRefs')[0].reset();                
                CargarExamensRef($("#NroDoc").val());
            }
            
        });
        
    }   
}  



function agregarSesionQuimio()
{
  
    var info = $("#formSessions").serialize();
    var fechaSesion = $("#fechaSesion").val();  


    if(fechaSesion==""){

        alert("Debes llenar en el campo FECHA");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=RegistroSesion",
            data: info,
    
            success: function(resp){               
               
                $('#formSessions')[0].reset();                
                CargarSesiones($("#idSes").val());
            }
            
        });
        
    }   
}  


function CargarExamens($id)
{
    $('#datExr').load('consultaExamenes.php?id='+$id);

}


function CargarObservacionesPaciente($id)
{
    $('#datExrObs').load('consultaObservaciones.php?id='+$id);

}



function CargarCptCitologia($id)
{
    $('#tableDxMorf').load('consultaCptsCito.php?id='+$id);

}


function CargarObservacionesCajas($id)
{
    $('#datExrObsCajas').load('consultaObservacionesCajas.php?id='+$id);

}



function CargarObsAuditoria(id)
{
    $('#datAuditObs').load('consultaObsAuditoria.php?id='+id);

}



function CargarMarcadoresHisto(formato,tipoest,id)
{
    $('#datAuditObsMarcador').load('consultaMarcadores.php?formato='+formato+"&tipoest="+tipoest+"&id="+id);
    CargarMarcadoresHistoCito(formato,tipoest,id);

}



function CargarMarcadoresHistoCito(formato,tipoest,id)
{
    $('#datAuditObsMarcadorCito').load('consultaMarcadores.php?formato='+formato+"&tipoest="+tipoest+"&id="+id);

}

function cargarMicroTables()
{
    //alert("asdasd");
    CargarRotulosPatMicro(2);
    CargarTacosPatQuimioMicro(2);
    CargarRotulosHistoqui(3);

}


function CargarRotulosPat(id,view,formato,tipoest)
{
    $('#datExrRot').load('consultaRotulos.php?tipo='+id+'&vista='+view+'&formato='+formato+'&tipoest='+tipoest);
    CargarRotulosPatMicro(id,2,formato,tipoest);
    CargarRotulosHistoqui(id,3,formato,tipoest);

}


function CargarRotulosPatCervico(id,view,formato,tipoest)
{
    $('#datExrRot').load('consultaRotulosCervico.php?tipo='+id+'&vista='+view+'&formato='+formato+'&tipoest='+tipoest);
    CargarRotulosPatMicro(id,2,formato,tipoest);
    CargarRotulosHistoqui(id,3,formato,tipoest);

}



function CargarTacosPat(tipo,formato,tipoest)
{
    $('#tblinclusion').load('Vistas/tacos/inclusion.php?id=1&tipo='+tipo+'&formato='+formato+'&tipoest='+tipoest);
    $('#tblcorte').load('Vistas/tacos/inclusion.php?id=2&tipo='+tipo+'&formato='+formato+'&tipoest='+tipoest);
    $('#tblcoloracion').load('Vistas/tacos/inclusion.php?id=3&tipo='+tipo+'&formato='+formato+'&tipoest='+tipoest);
    $('#tblmontaje').load('Vistas/tacos/inclusion.php?id=4&tipo='+tipo+'&formato='+formato+'&tipoest='+tipoest);
    $('#tblentrega').load('Vistas/tacos/inclusion.php?id=5&tipo='+tipo+'&formato='+formato+'&tipoest='+tipoest);
    CargarTacosPatQuimioMicro(2,formato,tipoest);
}




function CargarRotulosPatMicro(id,view,formato,tipoest)
{
    $('#datExrRotMicro').load('consultaRotulos.php?tipo='+id+'&vista='+view+'&formato='+formato+'&tipoest='+tipoest);

}


function CargarRotulosHistoqui(id,view,formato,tipoest)
{
    $('#datExrRotHistoq').load('consultaRotulos2.php?tipo='+id+'&vista='+view+'&formato='+formato+'&tipoest='+tipoest);
    //CargarRotulosHistoquiCervicoVaginal(id,view,formato,tipoest);
}

function CargarRotulosHistoquiCervicoVaginal(id,view,formato,tipoest)
{
    $('#datExrRotHistoqCito').load('consultaRotulos3.php?tipo='+id+'&vista='+view+'&formato='+formato+'&tipoest='+tipoest);

}

function CargarDivHistos1()
{
    $('#tbl_histos1').load('consultaHisto.php');
    CargarDivHistos2();

}

function CargarDivHistos2()
{
    $('#tbl_histos2').load('consultaHisto.php');

}



function CargarTacosPatQuimioMicro(tipo,formato,tipoest)
{
    $('#tblinclusionMicro').load('Vistas/tacos/inclusion.php?id=1&tipo='+tipo+'&formato='+formato+'&tipoest='+tipoest);
    $('#tblcorteMicro').load('Vistas/tacos/inclusion.php?id=2&tipo='+tipo+'&formato='+formato+'&tipoest='+tipoest);
    $('#tblcoloracionMicro').load('Vistas/tacos/inclusion.php?id=3&tipo='+tipo+'&formato='+formato+'&tipoest='+tipoest);
    $('#tblmontajeMicro').load('Vistas/tacos/inclusion.php?id=4&tipo='+tipo+'&formato='+formato+'&tipoest='+tipoest);
    $('#tblentregaMicro').load('Vistas/tacos/inclusion.php?id=5&tipo='+tipo+'&formato='+formato+'&tipoest='+tipoest); 
}


function CargarListadoCajas($id,tipo)
{
    $('#datExrCajas').load('consultaCajas.php?tipo='+tipo);

}


function CargarExamensRef($id)
{
    $('#datExrRef').load('consultaExamenesRef.php?id='+$id);

}


function CargarSesiones($id)
{
    $('#datExrSesiones').load('consultaSesiones.php?id='+$id);

}

function EliminarExamen(cod)
{

    var opcion = confirm("¿Estas seguro de eliminar el registro?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=eliminarExan",
                data: "cod="+cod,
                success: function(resp){
                    CargarExamens($("#NroDoc").val())
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    
}


function EliminarMarcad(cod)
{


var formatoPatologiaMac = $("#formatoPatologiaMac").val();
var filtroTipoEst = $("#filtroTipoEst").val();
var id= getParameterByName('id');

    var opcion = confirm("¿Estas seguro de eliminar el registro?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=eliminarExanMarc",
                data: "cod="+cod,
                success: function(resp){
                    
                    CargarMarcadoresHisto(formatoPatologiaMac,filtroTipoEst,id);
                    
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    
}

function EliminarObserPax(cod)
{

    var opcion = confirm("¿Estas seguro de eliminar el registro?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=eliminarObsPaxc",
                data: "cod="+cod,
                success: function(resp){
                    
                   // CargarObservacionesPaciente($("#cuenta").val())
                    var tik = getParameterByName('tipo');
                    if($("#cuenta").val()==""){
                        CargarObservacionesPaciente($("#hisCli").val() + tik);
                    }else{
                        CargarObservacionesPaciente($("#cuenta").val());
                    }
                    $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Ha sido eliminado correctamente"
                    });
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    
}


function EliminarRegCitoEspec(id,cod)
{

    var opcion = confirm("¿Estas seguro de eliminar el registro?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=eliminarObsPaxcRegCitoEs",
                data: "cod="+id,
                success: function(resp){
                    
                        CargarCptCitologia(cod);
                   
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    
}



function EliminarObserCajaxs(cod)
{

    var opcion = confirm("¿Estas seguro de eliminar el registro?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=eliminarObsCajas",
                data: "cod="+cod,
                success: function(resp){
                    
                   
                    $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Ha sido eliminado correctamente"
                    });
                    CargarObservacionesCajas($("#idCaja").val());
                    
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    
}



function liberarCaja(cod)
{

    var opcion = confirm("¿Estas seguro de eliminar el registro?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=libreCajas",
                data: "cod="+cod,
                success: function(resp){
                    
                    $('#pac3grupoCaja').DataTable().ajax.reload(null,false);
                   
                    $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Caja lierada correctamente"
                    });
                    
                    
                    
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    
}


function EliminarActivAud(cod)
{

    var opcion = confirm("¿Estas seguro de eliminar el registro?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=eliminarAuditAct",
                data: "cod="+cod,
                success: function(resp){
                     var ide = $("#ide").val();
                    CargarObsAuditoria(ide);
                    $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Ha sido eliminado correctamente"
                    });
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    
}


function EliminarObsRerPaxRo(cod,rotulo,formato,tipoEst)
{

    var procePat = $("#procePat").val();
    var formatoPatologiaMac = $("#formatoPatologiaMac").val();
    var filtroTipoEst = $("#filtroTipoEst").val();


    
    var opcion = confirm("¿Estas seguro de eliminar el registro?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=EliminarObsRerPaxRo",
                data: "cod="+cod+"&ro="+rotulo+"&formato="+formato+"&tipoEst="+tipoEst,
                success: function(resp){
                    
                    if($("#procePat").val()==13){
                        
                       /* CargarRotulosPatCervico();
                          CargarTacosPat(3,3);
                          CargarRotulosHistoquiCervicoVaginal(3,3)*/
                          
                          CargarRotulosPatCervico(3,0,formatoPatologiaMac,filtroTipoEst);
                          CargarTacosPat(3,formatoPatologiaMac,filtroTipoEst);
                          CargarRotulosHistoquiCervicoVaginal(3,3,formatoPatologiaMac,filtroTipoEst)
                          
                        
                    }else{
                        
                        /* CargarRotulosPat(1)
                         CargarTacosPat(1);*/
                         
                         CargarRotulosPat(filtroTipoEst,1,formatoPatologiaMac,filtroTipoEst);
                          CargarTacosPat(filtroTipoEst,formatoPatologiaMac,filtroTipoEst);

                         
                    }
                   
                    
                    
                    $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Ha sido eliminado correctamente"
                    });
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    
}


function EliminarTacoXtaco(cod)
{
    
    var procePat = $("#procePat").val();
    var formatoPatologiaMac = $("#formatoPatologiaMac").val();
    var filtroTipoEst = $("#filtroTipoEst").val();

    var opcion = confirm("¿Estas seguro de eliminar el registro?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=EliminarTacosXuno",
                data: "cod="+cod,
                success: function(resp){
                    
                    /*CargarRotulosPat(1)
                    CargarTacosPat(1);*/
                    
                    CargarRotulosPat(filtroTipoEst,1,formatoPatologiaMac,filtroTipoEst);
                    CargarTacosPat(filtroTipoEst,formatoPatologiaMac,filtroTipoEst);

                    
                    $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Ha sido eliminado correctamente"
                    });
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    
}


function eliminarFuaFile(cod,tipo)
{

    var opcion = confirm("¿Estas seguro de eliminar la FUA del paquete?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=eliminarFuaPaq",
                data: "cod="+cod+"&tipo="+tipo,
                success: function(resp){
                   $('#pac3EmerCE').DataTable().ajax.reload(null, false);
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    

}



function EliminarExamenRef(cod)
{

    var opcion = confirm("¿Estas seguro de eliminar el registro?");
    if (opcion == true) {
        
        $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/controllerProcedimientos.php?function=eliminarExanRef",
                data: "cod="+cod,
                success: function(resp){
                    CargarExamensRef($("#NroDoc").val())
                }
            }); 
	} else {
	    //alert("Has clickado Cancelar");
	}
    

}


$(document).ready(function(){
    

    
});

function CargarPac($page,$pte)
{
   
    $('#datagrid').load('Vistas/listados/consultaPacientes.php?pagina='+$page+'&pte='+$pte);
}


/*
function CargarCon($page,$pte)
{
    
    $('#datagridConso').load('Vistas/listados/listConsol.php?pagina='+$page+'&pte='+$pte);
    
}
 */


function CargarRepo()
{
    
    $('#datagridReps').load('Vistas/listados/listRepositorio.php');
    
}

function cargarCpms()
{
    
    $('#vercp').load('Vistas/listados/grid2.php');
    
}



function cargarAtencionesAudi(id,tipo)
{
    
    $('#verAtenciones').load('Vistas/listados/atenciones2.php?id='+id+'&tipo='+tipo);
    
}


function cargarConsultaExternaSinAuditor(id)
{
    
    $('#verAtencionesSinAuditor').load('Vistas/listados/cesinauditor.php?id='+id);
    
}



function cargarVerEstadoMasivo(ser,tipo)
{
    
    $('#verEstadoMasivo').load('reporteEstadoMasivo.php?ser='+ser+"&tipo="+tipo);
    
}


function verCpms(){

    cargarCpms();
}

function verAtencionesModal(id,tipo){

    cargarAtencionesAudi(id,tipo);
}

function verConsultaExternaSinAuditor(id){

    cargarConsultaExternaSinAuditor(id);
}


function CargarCartax()
{
    $("#dvloadect").show();
    $('#datagridConsoCartas').load('Vistas/listados/listCartas.php',function(){ $("#dvloadect").hide();});
    
}


function agregarCpt(id,desc,precio){

    


    $.ajax({
        url:'./Controlador/search.php?function=bucasrCpt',
        type:'GET',
        dataType:'json',
        data:{ ide:id}
  
    }).done(function(datos){
  
  
        $("#codCpt").val(datos[0]);
        $("#desCpt").val(datos[1]);
        $("#valor").val(datos[2]);
        setTimeout(function (){
            $("#cant").focus();
        }, 500);
        $("#cerraCptms").click();
        
        
  
    });

}



function agregarAtencionAudi(id,grupo,user,tipo)
{
  
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=agregarAten",
           data:{ id:id,grupo:grupo,user:user,tipo:tipo},
    
            success: function(resp){               
               
                if(resp=="1"){
                    alert("Atencion registrada en otro grupo");
                    
                }else{
                    
                    
                     $('#pac3EmerCE').DataTable().ajax.reload(null, false);
                     $('#codcmp').DataTable().ajax.reload(null, false);
                     //var id = getParameterByName('id');
                     //cargarAtencionesAudi(id);
                      //$("#cerraModlAgrs").click();
                      //console.log("id");
                     
                }
                
                
            }
            
        });
        
     
}  


function CargarGrupox()
{
    $("#dvloadercptGru").show();
    $('#datagridGrupods').load('Vistas/auto/listgrupos.php',function(){ $("#dvloadercptGru").hide();});
    
}

function cargarAutorizaciones(id)
{
    $("#dvloadercpt").show();
    $('#datagridAutizaciones').load('Vistas/listados/listAutorizaciones.php?id='+id,function(){ $("#dvloadercpt").hide();});
    
}

function generTx(file,grupo){

  
    for (var i=1; i<6; i++) {
          $.getJSON( 'http://10.10.4.107:8089/prestacional/generartxt.php?id='+i+"&file="+file+"&grupo="+grupo, function ( results ) {} );
    }

    window.location.href = "grupos.php";

}


function CargarCuentas(id)
{
    
    $('#datagridCuentas').load('Vistas/listados/listCuentas.php?id='+id);
    
}


function CargarCuentasAutorizacion(id,es,gr)
{
    
    $('#datagridCuentasAut').load('Vistas/listados/listCuentasAuto.php?id='+id+"&es="+es+"&grupo="+gr);
    
}


function CargarDiagnosticos($id)
{
    $('#datagridDiagnostico').load('Vistas/auto/gridDiagnosticosAuto.php?id='+$id);
}

function CargarProcedimientos($id)
{
    $('#datagridProcedimientos').load('Vistas/listados/gridProcedimientos.php?id='+$id);
}

/* 1 */



function Cargar1DxHistoria(id)
{
    $('#divDxHist').load('Vistas/listados/dxHistoria.php?id='+ id);
}



function Cargar1($id)
{
    $('#datagrid1').load('Vistas/listados/grid1.php?id='+$id);
}

function Cargar2($id)
{
    $('#datagrid2').load('Vistas/listados/grid2.php?id='+$id);
}

function Cargar3($id)
{
    $('#datagrid3').load('Vistas/listados/grid3.php?id='+$id);
}

function Cargar4($id)
{
    $('#datagrid4').load('Vistas/listados/grid4.php?id='+$id);
}

function Cargar5($id)
{
    $('#datagrid5').load('Vistas/listados/grid5.php?id='+$id);
}

/* GRID AUTORIZACION */

function CargarAuto1($id)
{
    $('#autoProc').load('Vistas/auto/gridProcedimientosAuto.php?id='+$id);
}

function CargarAuto2($id)
{
    $('#datagridInsumosAuto').load('Vistas/auto/gridInsumosAuto.php?id='+$id);
}


function CargarAuto3($id)
{
    $('#datagridMedicamentosAuto').load('Vistas/auto/gridMedicamentosAuto.php?id='+$id);
}

/* */
/* 5  */

function CargarInsumos($id)
{
    $('#datagridInsumos').load('Vistas/listados/gridInsumos.php?id='+$id);
}

function CargarMedicamentos($id)
{
    $('#datagridMedicamentos').load('Vistas/listados/gridMedicamentos.php?id='+$id);
}


function listCuentasReporte()
{
    $('#dlistCuentasR').load('Vistas/listados/listCuentasReporte.php');
}




function verRegistro(id){
   
    $("#ide").val(id);
    $("#ui-id-1").css("z-index", "9999999999");
  
  $.ajax({
      url:'./Controlador/search.php?function=cartaGarantia',
      type:'GET',
      dataType:'json',
      data:{ NroDoc:id}

  }).done(function(datos){

    
      //
      $("#NroDoc").val(datos[0]);
      $("#NroCarta2").val(datos[2]);
      $("#NroCarta3").val(parseInt(datos[3]));
      $("#paciente").val(datos[4]);
      $("#fecarta").val(datos[5]);
      $("#iafa").val(datos[6]);
      $("#producto").val(datos[7]);
      $("#tarifa").val(datos[8]);
      $("#aseguradora").val(datos[9]);
      $("#poliza").val(datos[10]);
      $("#cie10").val(datos[11]);
      $("#diagnostico").val(datos[12]);
      $("#feinicio").val(datos[13]);
      $("#fevigencia").val(datos[14]);
      $("#monto").val(datos[15]);
      $("#refe").val(datos[16]);
      $("#nac").val(datos[17]);
      $("#edad").val(datos[18]);
      $("#motivo").val(datos[19]);
           

  });
  
}

function editarCuenta(id){
   
    $("#idCuenta").val(id);
    $("#ui-id-3").css("z-index", "9999999999");
  
  $.ajax({
      url:'./Controlador/search.php?function=cartaCuentx',
      type:'GET',
      dataType:'json',
      data:{ NroDoc:id}

  }).done(function(datos){


      $("#idCuenta").val(datos[0]);
      $("#nrocuenta").val(datos[2]);
      $("#hclinica").val(datos[3]);
      $("#feat").val(datos[4]);
      $("#productoX").val(datos[5]);

      if(datos[6]=="on"){
        $("#at").prop('checked', true);
      }else{
        $("#at").prop('checked', false);
      }

      if(datos[7]=="on"){
        $("#inter").prop('checked', true);
      }else{
        $("#inter").prop('checked', false);
      }

  });
  
}


function verCuentas(id){

    $('#formCuentas')[0].reset();    
    CargarCuentas(id);
    $("#ideC").val(id);
  
   
    $("#ui-id-2").css("z-index", "9999999999");
  $.ajax({
      url:'./Controlador/search.php?function=cuentasX',
      type:'GET',
      dataType:'json',
      data:{ NroDoc:id}

  }).done(function(datos){

      $("#hclinica").val(datos[0]);
      $("#titleCuen").text("CUENTAS DE: "+datos[1]);
      $("#refT").text("REFERENCIA: "+datos[2]);
      $("#productoX").val(datos[3]);
     // $("#productoX").attr("readonly","readonly");
      
  });
  
}



function verCuentasAuto(id,es,gr){

    //$('#formCuentas')[0].reset();    
    CargarCuentasAutorizacion(id,es,gr);
    //$("#ideC").val(id);
  
   
    $("#ui-id-2").css("z-index", "9999999999");
  $.ajax({
      url:'./Controlador/search.php?function=cuentasXAuto',
      type:'GET',
      dataType:'json',
      data:{ NroDoc:id}

  }).done(function(datos){

      $("#titleCuen").text("CUENTAS DE: "+datos[0]+" "+datos[1]+" "+datos[2]);
    
  });

  
}




function verPacienteX(id){
   
    $("#ide").val(id);
  
  $.ajax({
      url:'./Controlador/search.php?function=pacienteDatos',
      type:'GET',
      dataType:'json',
      data:{ NroDoc:id}

  }).done(function(datos){

      
      $("#nrofua").val(datos[0]);
      $("#NxuentaX").val(datos[1]);
      $("#pacix").val(datos[2]);
      $("#servicioX").val(datos[3]);
      $("#feingresoX").val(datos[4]);
      $("#fecorteX").val(datos[5]);
      $("#historia").val(datos[6]);
      $("#dni").val(datos[7]);
      $("#comment").val(datos[8]);
      $("#mongale").val(datos[9]);
      $("#monsisfax").val(datos[10]);
      $("#diasCont").text(datos[11]);
      $("#moatio").val(datos[12]);
      $("#deniom").val(datos[13]);
      $("#dx1").val(datos[14]);
      $("#dx2").val(datos[15]);
      $("#dx3").val(datos[16]);
      $("#dx4").val(datos[17]);
      $("#dx5").val(datos[18]);
      $("#tip1").val(datos[19]);
      $("#tip2").val(datos[20]);
      $("#tip3").val(datos[21]);
      $("#tip4").val(datos[22]);
      $("#tip5").val(datos[23]);
      
      
      
      if(datos[26]!="0"){
          $("#codPreHos").val(datos[24]);
          $("#ubiSerHosp").empty("");
           cargarPresHospi(datos[25]);
          $("#prioAudit").val(datos[26]);
      }else {
           $("#codPreHosCE").val(datos[24]);
           cargarPresHospiCE(datos[25]);
            $('#prioAudit').val("0");
           
      }
      
      
     
      if(datos[8]!== null){
            $("#enviar").removeClass("hidden");
            $("#imrpesion").removeClass("hidden");
      }
      
      $("#dx6").val(datos[27]);
      $("#tip6").val(datos[28]);
      
      $("#dx7").val(datos[29]);
      $("#tip7").val(datos[30]);
      $("#dx8").val(datos[31]);
      $("#tip8").val(datos[32]);
      $("#dx9").val(datos[33]);
      $("#tip9").val(datos[34]);
      $("#dx10").val(datos[35]);
      $("#tip10").val(datos[36]);
      
           
  });
  
}



function verPacienteXAuto(id){
   

    
    $("#ide").val(id);
  
  $.ajax({
      url:'./Controlador/search.php?function=pacienteDatosAuto',
      type:'GET',
      dataType:'json',
      data:{ NroDoc:id}

  }).done(function(datos){

      
      $("#tipodoc").val(datos[0]);
      $("#nrodoc").val(datos[1]);
      $("#apepaterno").val(datos[2]);
      $("#apematerno").val(datos[3]);
      $("#nombres").val(datos[4]);
      $("#fingreso").val(datos[5]);
      $("#fsalta").val(datos[6]);
      cargarProfesion(datos[7]);
      $("#colegio").val(datos[8]);
      cargarEspecialidad(datos[9]);
      $("#nroregistro").val(datos[10]);
      $("#condicion").val(datos[11]);
      //$("#estado").val(datos[12]);    
           
  });
  
}

function verDx(id,dx) {
 
   
    $.get('./Controlador/search.php?function=verdx', {id : id},	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               
               //$("#dx").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                  
                   if (valor.codigo_diagnostico == dx) {
                       $("#dx").append('<option value="' + valor.codigo_diagnostico + '" selected>' + valor.codigo_diagnostico + '</option>');	
                   }else{
                       $("#dx").append('<option value="' + valor.codigo_diagnostico + '">' + valor.codigo_diagnostico + '</option>');	
                   }
                   
               });
           }
       return false;
   });
}


function verDxInsu(id,dx) {
 
   
    $.get('./Controlador/search.php?function=verdx', {id : id},	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               
               //$("#dx").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                  
                   if (valor.codigo_diagnostico == dx) {
                       $("#diagAuto").append('<option value="' + valor.codigo_diagnostico + '" selected>' + valor.codigo_diagnostico + '</option>');	
                   }else{
                       $("#diagAuto").append('<option value="' + valor.codigo_diagnostico + '">' + valor.codigo_diagnostico + '</option>');	
                   }
                   
               });
           }
       return false;
   });
}



function verDxMed(id,dx) {
 
   
    $.get('./Controlador/search.php?function=verdx', {id : id},	    
    function(data){
       
           if (data != "[]") {
               var item = $.parseJSON(data);
               
               //$("#dx").append('<option value="">-- Seleccionar --</option>');
               $.each(item, function (i, valor) {
                  
                   if (valor.codigo_diagnostico == dx) {
                       $("#diagMedAuto").append('<option value="' + valor.codigo_diagnostico + '" selected>' + valor.codigo_diagnostico + '</option>');	
                   }else{
                       $("#diagMedAuto").append('<option value="' + valor.codigo_diagnostico + '">' + valor.codigo_diagnostico + '</option>');	
                   }
                   
               });
           }
       return false;
   });
}

function verDiagnostico(id){
   
    
  $.ajax({
      url:'./Controlador/search.php?function=VerDiagnostico',
      type:'GET',
      dataType:'json',
      data:{ id:id}

  }).done(function(datos){

      
      $("#idDx").val(datos[0]);
      $("#idpres").val(datos[1]);
      $("#tipoDx").val(datos[2]);
      $("#codDx").val(datos[3]);
      $("#descripcion").val(datos[4]);
     
           
  });
  
}


function verProcedimiento(id){
   
    $("#ui-id-1").css("z-index", "9999999999");
  
  $.ajax({
      url:'./Controlador/search.php?function=VerProcedimiento',
      type:'GET',
      dataType:'json',
      data:{ id:id}

  }).done(function(datos){

      
      $("#idPr").val(datos[0]);
      $("#idpresPro").val(datos[1]);
      $("#cant").val(datos[2]);
      $("#codCpt").val(datos[3]);
      $("#valor").val(datos[4]);
      $("#desCpt").val(datos[5]);
      $("#totalp").val(datos[6]);
      $("#dx").val(datos[7]);
           
  });
  
}

function verProcedimientoAuto(id){
   
    
    $("#ui-id-1").css("z-index", "9999999999");
  
  $.ajax({
      url:'./Controlador/search.php?function=VerProcedimientoAuto',
      type:'GET',
      dataType:'json',
      data:{ id:id}

  }).done(function(datos){

      
      $("#idPrAuto").val(datos[0]);
      $("#idpresProAuto").val(datos[1]);
      $("#dx").empty();
      verDx(datos[1],datos[7]);
      $("#cantAuto").val(datos[2]);
      $("#codCptAuto").val(datos[3]);
      $("#valorAuto").val(datos[4]);
      $("#desCptAuto").val(datos[5]);
      $("#totalpAuto").val(datos[6]);
           
  });
  
}


function verInsumos(id){
   
  
  $.ajax({
      url:'./Controlador/search.php?function=VerInsumo',
      type:'GET',
      dataType:'json',
      data:{ id:id}

  }).done(function(datos){

      
      $("#idIns").val(datos[0]);
      $("#idpresInsu").val(datos[1]);
      $("#codSismed").val(datos[2]);
      $("#cantIn").val(datos[3]);
      $("#diag").val(datos[4]);
      $("#valori").val(datos[5]);
      $("#des").val(datos[6]);
      $("#totali").val(datos[7]);
           
  });
  
}

function cargarAuditor() {
    
    $.post('./Controlador/search.php?function=user', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#asiAudi").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (valor.id !== null) {
                      $("#asiAudi").append('<option value="' + valor.id + '">' + valor.nom + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarListCajas(id) {
    
    $.post('./Controlador/search.php?function=listCajas', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#listCaja").empty();
            $("#listCaja").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.id == id) {
                      $("#listCaja").append('<option value="' + valor.id + '" selected>' + valor.nom + '</option>');	
                  }else{
                      $("#listCaja").append('<option value="' + valor.id + '" >' + valor.nom + '</option>');	
                  }
            });
        }
    return false;
    });
}



function anaListMuestra(id) {
    anaListMuestraCito();
    
    $.post('./Controlador/search.php?function=listAnaMuestra', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#anaMuestra").empty();
            $("#anaMuestra").append('<option value="0">Seleccione</option>');
            $.each(item, function (i, valor) {
                if (valor.IdAnalisis == id) {
                      $("#anaMuestra").append('<option value="' + valor.IdAnalisis + '" selected>' + valor.Descripcion + '</option>');	
                  }else{
                      $("#anaMuestra").append('<option value="' + valor.IdAnalisis + '" >' + valor.Descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}




function anaListMuestraCito(id) {
    
    $.post('./Controlador/search.php?function=listAnaMuestra', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#anaMuestraCito").empty();
            $("#anaMuestraCito").append('<option value="0">Seleccione</option>');
            $.each(item, function (i, valor) {
                if (valor.IdAnalisis == id) {
                      $("#anaMuestraCito").append('<option value="' + valor.IdAnalisis + '" selected>' + valor.Descripcion + '</option>');	
                  }else{
                      $("#anaMuestraCito").append('<option value="' + valor.IdAnalisis + '" >' + valor.Descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}



function listTipoEstudioHisto(id) {
    
    listTipoEstudioHistoCito();
    
    $.post('./Controlador/search.php?function=listTipoEstudioHisto', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#procedReal").empty();
            $("#procedReal").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.idTi == id) {
                      $("#procedReal").append('<option value="' + valor.idTi + '" selected>' + valor.nombre + '</option>');	
                  }else{
                      $("#procedReal").append('<option value="' + valor.idTi + '" >' + valor.nombre + '</option>');	
                  }
            });
        }
    return false;
    });
}



function listTipoEstudioHistoCito(id) {
    
    $.post('./Controlador/search.php?function=listTipoEstudioHisto', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#procedRealCito").empty();
            $("#procedRealCito").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.idTi == id) {
                      $("#procedRealCito").append('<option value="' + valor.idTi + '" selected>' + valor.nombre + '</option>');	
                  }else{
                      $("#procedRealCito").append('<option value="' + valor.idTi + '" >' + valor.nombre + '</option>');	
                  }
            });
        }
    return false;
    });
}


function listCalidEspec(id,selector,iden) {
    
  
    
    $.post('./Controlador/search.php?function=calidEspecList&tipo='+ id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#" + selector).empty();
            $("#" + selector).append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.IdTipoDxCU == iden) {
                      $("#"+ selector).append('<option value="' + valor.IdTipoDxCU + '" selected>' + valor.Descripcion + '</option>');	
                  }else{
                      $("#" + selector).append('<option value="' + valor.IdTipoDxCU + '" >' + valor.Descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}



function cargarListLix(id) {
    
    $.post('./Controlador/search.php?function=listCajasLiqui', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#listLix").empty();
            $("#listLix").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.id == id) {
                      $("#listLix").append('<option value="' + valor.id + '" selected>' + valor.nom + '</option>');	
                  }else{
                      $("#listLix").append('<option value="' + valor.id + '" >' + valor.nom + '</option>');	
                  }
            });
        }
    return false;
    });
}




function cargarListHallazgo(id) {
    
    $.post('./Controlador/search.php?function=listasHallazago', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#hallazgo").empty();
            $("#hallazgo").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.Id == id) {
                      $("#hallazgo").append('<option value="' + valor.Id + '" selected>' + valor.Sistema + '</option>');	
                  }else{
                      $("#hallazgo").append('<option value="' + valor.Id + '" >' + valor.Sistema + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarListSistemaReporte(id,hallazgo) {
    
    $.post('./Controlador/search.php?function=listSistemaReporte&tipo=' +hallazgo, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#sisReporEspex").empty();
            $("#sisReporEspex").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.Id == id) {
                      $("#sisReporEspex").append('<option value="' + valor.Id + '" selected>' + valor.ParteSistema + '</option>');	
                  }else{
                      $("#sisReporEspex").append('<option value="' + valor.Id + '" >' + valor.ParteSistema + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarListClasificacion(id,sis) {
    
    $.post('./Controlador/search.php?function=listCargarClasificacion&tipo=' +sis, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#clasisEspec").empty();
            $("#clasisEspec").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.Id == id) {
                      $("#clasisEspec").append('<option value="' + valor.Id + '" selected>' + valor.Descripcion + '</option>');	
                  }else{
                      $("#clasisEspec").append('<option value="' + valor.Id + '" >' + valor.Descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarListCategoria(id) {
    
    $.post('./Controlador/search.php?function=listasCategorias&id='+id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#categoria").empty();
            $("#categoria").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.Descripcion == id) {
                      $("#categoria").append('<option value="' + valor.Descripcion + '" selected>' + valor.Descripcion + '</option>');	
                  }else{
                      $("#categoria").append('<option value="' + valor.Descripcion + '" >' + valor.Descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}

function cargarListSubcategoria(id,tipo) {
    
    $.post('./Controlador/search.php?function=listSubCategoria&tipo=' +tipo, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#rotulo").empty();
            $("#rotulo").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.idTe == id) {
                      $("#rotulo").append('<option value="' + valor.idTe + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#rotulo").append('<option value="' + valor.idTe + '" >' + valor.descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}




function cargarListPlantilla(id,tipo,sql) {
    
    $.post('./Controlador/search.php?function=listPlantilla&tipo='+tipo+"&sql="+sql, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#plantillaApe").empty();
            $("#plantillaApe").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                  if (valor.IDE == id) {
                      $("#plantillaApe").append('<option value="' + valor.IDE + '" selected>' + valor.Nombre + '</option>');	
                  }else{
                      $("#plantillaApe").append('<option value="' + valor.IDE + '" >' + valor.Nombre + '</option>');	
                  }
            });
        }else {
             $("#plantillaApe").empty();
             $("#plantillaApe").append('<option value="0">Ninguno</option>');
        }
    return false;
    });
}

function cargarListLixPaq(id) {
    
    $.post('./Controlador/search.php?function=listCajasLiqui', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#listLixPaQ").empty();
            $("#listLixPaQ").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.id == id) {
                      $("#listLixPaQ").append('<option value="' + valor.id + '" selected>' + valor.nom + '</option>');	
                  }else{
                      $("#listLixPaQ").append('<option value="' + valor.id + '" >' + valor.nom + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarListAuditCE(id) {
    
    $.post('./Controlador/search.php?function=listAuditx', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#listAuditx").empty();
            $("#listAuditx").append('<option value="0">Ninguno</option>');
            $.each(item, function (i, valor) {
                if (valor.id == id) {
                      $("#listAuditx").append('<option value="' + valor.id + '" selected>' + valor.nom + '</option>');	
                  }else{
                      $("#listAuditx").append('<option value="' + valor.id + '" >' + valor.nom + '</option>');	
                  }
            });
        }
    return false;
    });
}




function cargarAuditorGrupo(id) {
    
    $.post('./Controlador/search.php?function=user', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#audiGrupo").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                  if (id == valor.id) {
                      $("#audiGrupo").append('<option value="' + valor.id + '" selected>' + valor.nom + '</option>');	
                  }else{
                       $("#audiGrupo").append('<option value="' + valor.id + '">' + valor.nom + '</option>');
                  }
            });
        }
    return false;
    });
}
 
 
 
 
function cargarAuditorGrupoCE(id) {
    
    $.post('./Controlador/search.php?function=userCE&tipo='+ id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#audiGrupoCE").append('<option value="0">SELECCIONAR</option>');
            $.each(item, function (i, valor) {
                 
                      $("#audiGrupoCE").append('<option value="' + valor.id + '" >' + valor.nom + '</option>');	
                 
            });
        }
    return false;
    });
}
 
function cargarPabellones(pa) {

    
    $.post('./Controlador/search.php?function=pabellones', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#pabellones").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idPa) {
                      $("#pabellones").append('<option value="' + valor.idPa + '" selected >' + valor.descripcion + '</option>');
                  }else{
                       $("#pabellones").append('<option value="' + valor.idPa + '" >' + valor.descripcion + '</option>');
                  }
            });
        }
        return false;
    });
}



function cargarSerInter(pa) {

    
    $.post('./Controlador/search.php?function=pabellones', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#servicioInterCiru").empty();
            $("#servicioInterCiru").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idPa) {
                      $("#servicioInterCiru").append('<option value="' + valor.idPa + '" selected >' + valor.descripcion + '</option>');
                  }else{
                       $("#servicioInterCiru").append('<option value="' + valor.idPa + '" >' + valor.descripcion + '</option>');
                  }
            });
        }
        return false;
    });
}


function cargaEstadoCxMo(pa) {

    
    $.post('./Controlador/search.php?function=estadoCxMot', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#estadoCirugiaProg").empty();
            $("#estadoCirugiaProg").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdEstado) {
                      $("#estadoCirugiaProg").append('<option value="' + valor.IdEstado + '" selected >' + valor.Descripcion + '</option>');
                  }else{
                       $("#estadoCirugiaProg").append('<option value="' + valor.IdEstado + '" >' + valor.Descripcion + '</option>');
                  }
            });
        }
        return false;
    });
}



function filtroEstadoCxMo(pa) {

    
    $.post('./Controlador/search.php?function=estadoCxMot', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#serCi").empty();
            $("#serCi").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdEstado) {
                      $("#serCi").append('<option value="' + valor.IdEstado + '" selected >' + valor.Descripcion + '</option>');
                  }else{
                       $("#serCi").append('<option value="' + valor.IdEstado + '" >' + valor.Descripcion + '</option>');
                  }
            });
        }
        return false;
    });
}

function cargarPabellonesHos1(pa) {

    
    $.post('./Controlador/search.php?function=pabellones', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#pab1Hos").empty();
            $("#pab1Hos").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idPa) {
                      $("#pab1Hos").append('<option value="' + valor.idPa + '" selected >' + valor.descripcion + '</option>');
                  }else{
                       $("#pab1Hos").append('<option value="' + valor.idPa + '" >' + valor.descripcion + '</option>');
                  }
            });
        }
        return false;
    });
}


function cargarPabellonesCiru(pa) {

    
    $.post('./Controlador/search.php?function=listServicioQxProg', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#pabellonCirugia").empty();
            $("#pabellonCirugia").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdServQx) {
                      $("#pabellonCirugia").append('<option value="' + valor.IdServQx + '" selected >' + valor.Descripcion + '</option>');
                  }else{
                       $("#pabellonCirugia").append('<option value="' + valor.IdServQx + '" >' + valor.Descripcion + '</option>');
                  }
            });
        }
        return false;
    });
}



function cargarSalaCiru(pa,tipo) {

    
    $.post('./Controlador/search.php?function=listSalaCirugia&tipo=' + tipo, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#listSalaCi").empty();
            $("#listSalaCi").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdSala) {
                      $("#listSalaCi").append('<option value="' + valor.IdSala + '" selected >' + valor.Nombre + '</option>');
                  }else{
                       $("#listSalaCi").append('<option value="' + valor.IdSala + '" >' + valor.Nombre + '</option>');
                  }
            });
        }
        return false;
    });
}


function cargarAnestesiaProg(pa) {

    
    $.post('./Controlador/search.php?function=listAnestesiaProg', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#tipoAnestesiaProg").empty();
            $("#tipoAnestesiaProg").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdTipoAnestesia) {
                      $("#tipoAnestesiaProg").append('<option value="' + valor.IdTipoAnestesia + '" selected >' + valor.Descripcion + '</option>');
                  }else{
                       $("#tipoAnestesiaProg").append('<option value="' + valor.IdTipoAnestesia + '" >' + valor.Descripcion + '</option>');
                  }
            });
        }
        return false;
    });
}


function cargarCirugiaProg(pa) {

    
    $.post('./Controlador/search.php?function=listCirugiaProg', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#tipoCirugiaProg").empty();
            $("#tipoCirugiaProg").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdTipoCx) {
                      $("#tipoCirugiaProg").append('<option value="' + valor.IdTipoCx + '" selected >' + valor.Descripcion + '</option>');
                  }else{
                       $("#tipoCirugiaProg").append('<option value="' + valor.IdTipoCx + '" >' + valor.Descripcion + '</option>');
                  }
            });
        }
        return false;
    });
}


function cargarPabellonesHos2(pa) {

    
    $.post('./Controlador/search.php?function=pabellones', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#pab2Hos").empty();
            $("#pab2Hos").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idPa) {
                      $("#pab2Hos").append('<option value="' + valor.idPa + '" selected >' + valor.descripcion + '</option>');
                  }else{
                       $("#pab2Hos").append('<option value="' + valor.idPa + '" >' + valor.descripcion + '</option>');
                  }
            });
        }
        return false;
    });
}




function filtroCargarPabellonesHos() {

    
    $.post('./Controlador/search.php?function=pabellones', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#pa").empty();
            $("#pa").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                       $("#pa").append('<option value="' + valor.idPa + '" >' + valor.descripcion + '</option>');
            });
        }
        return false;
    });
}



function filtroCargarEspecialidadCE() {

    
    $.post('./Controlador/search.php?function=especialidadesCe', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#espe").empty();
            $("#espe").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                       $("#espe").append('<option value="' + valor.id + '" >' + valor.descripcion + '</option>');
            });
        }
        return false;
    });
}


function filtroCargarServiciosIngreso() {

    
    $.post('./Controlador/search.php?function=serviciosIngreso', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#ser").empty();
            $("#ser").append('<option value="">Seleccionar</option>');
                    $.each(item, function (i, valor) {
                               $("#ser").append('<option value="' + valor.idTsi + '" >' + valor.nombre + '</option>');
                    });
        }
        return false;
    });
}

function cargarObservacionesFua(pa) {

    
    $.post('./Controlador/search.php?function=observacionesFua', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#listObsFua").empty();
            $("#listObsFua").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idObs) {
                      $("#listObsFua").append('<option value="' + valor.idObs + '" selected >' + valor.descripcion + '</option>');
                  }else{
                       $("#listObsFua").append('<option value="' + valor.idObs + '" >' + valor.descripcion + '</option>');
                  }
            });
        }
        return false;
    });
}



function cargarmotivoEmer(pa) {

    
    $.post('./Controlador/search.php?function=motivoEmergencias', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#referido").empty();
            $("#referido").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#referido").append('<option value="' + valor.id + '" selected >' + valor.descripcion + '</option>');
                  }else{
                       $("#referido").append('<option value="' + valor.id + '" >' + valor.descripcion + '</option>');
                  }
            });
        }
        return false;
    });
}

function cargarSeguros(pa) {
    
    $.post('./Controlador/search.php?function=seguros', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#seguros").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTipo) {
                      $("#seguros").append('<option value="' + valor.idTipo + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#seguros").append('<option value="' + valor.idTipo + '">' + valor.descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}



function cargartipoEstPat(pa) {
    
    $.post('./Controlador/search.php?function=tipoEstPat', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#tipoEstPat").empty();
            $("#tipoEstPat").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTi) {
                      $("#tipoEstPat").append('<option value="' + valor.idTi + '" selected>' + valor.nombre + '</option>');	
                  }else{
                      $("#tipoEstPat").append('<option value="' + valor.idTi + '">' + valor.nombre + '</option>');	
                  }
            });
        }
    return false;
    });
}



function cargarUsersAuditorAsignado(pa) {
    
    $.post('./Controlador/search.php?function=cargarUsersAuditorAsignado', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#idAuditorAsignado").empty();
            $("#idAuditorAsignado").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#idAuditorAsignado").append('<option value="' + valor.id + '" selected>' + valor.nom + '</option>');	
                  }else{
                      $("#idAuditorAsignado").append('<option value="' + valor.id + '">' + valor.nom + '</option>');	
                  }
            });
        }
    return false;
    });
}



function usuarioConfirmadoPor(pa) {
    
    $.post('./Controlador/search.php?function=cargarUsersAuditorAsignado', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#nomApeConfir").empty();
            $("#nomApeConfir").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#nomApeConfir").append('<option value="' + valor.id + '" selected>' + valor.nom + '</option>');	
                  }else{
                      $("#nomApeConfir").append('<option value="' + valor.id + '">' + valor.nom + '</option>');	
                  }
            });
        }
    return false;
    });
}


function usuarioConfirmadoPorAP(pa) {
    
    $.post('./Controlador/search.php?function=cargarUsersAuditorAsignado', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#nomApeConfirApepat").empty();
            $("#nomApeConfirApepat").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#nomApeConfirApepat").append('<option value="' + valor.id + '" selected>' + valor.nom + '</option>');	
                  }else{
                      $("#nomApeConfirApepat").append('<option value="' + valor.id + '">' + valor.nom + '</option>');	
                  }
            });
        }
    return false;
    });
}



function medSolicitaHqIhq(pa) {
    
    $.post('./Controlador/search.php?function=cargarUsersAuditorAsignado', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#medicoSolcit2").empty();
            $("#medicoSolcit2").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#medicoSolcit2").append('<option value="' + valor.id + '" selected>' + valor.nom + '</option>');	
                  }else{
                      $("#medicoSolcit2").append('<option value="' + valor.id + '">' + valor.nom + '</option>');	
                  }
            });
        }
    return false;
    });
}

function cargarprocePat(pa,id) {
    
    $.post('./Controlador/search.php?function=procePat&tipo='+ pa, 
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#procePat").empty();
            $("#procePat").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (id == valor.idtpo) {
                      $("#procePat").append('<option value="' + valor.idtpo + '" selected>' + valor.NombreCorto + '</option>');	
                  }else{
                      $("#procePat").append('<option value="' + valor.idtpo + '">' + valor.NombreCorto + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarNvaCta(pa) {
    
    $.post('./Controlador/search.php?function=listNvaCta', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#nvaCta").empty();
            $("#nvaCta").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#nvaCta").append('<option value="' + valor.id + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#nvaCta").append('<option value="' + valor.id + '">' + valor.descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarServicioDesignacion(pa) {
    
    $.post('./Controlador/search.php?function=ServicioDesignacion', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#serviDesi").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#serviDesi").append('<option value="' + valor.id + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#serviDesi").append('<option value="' + valor.id + '">' + valor.descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}



function cargarRespirador(pa) {
    
    $.post('./Controlador/search.php?function=cargarRespirador', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#respirador").empty();
            $("#respirador").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdRespirador) {
                      $("#respirador").append('<option value="' + valor.IdRespirador + '" selected>' + valor.NombreRespirador + '</option>');	
                  }else{
                      $("#respirador").append('<option value="' + valor.IdRespirador + '">' + valor.NombreRespirador + '</option>');	
                  }
            });
        }
    return false;
    });
}


function listTipoDoc(pa) {
    
    $.post('./Controlador/search.php?function=tipodoc', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#tipoDoc").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTipo) {
                      $("#tipoDoc").append('<option value="' + valor.idTipo + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#tipoDoc").append('<option value="' + valor.idTipo + '">' + valor.descripcion + '</option>');	
                  }
            });
            
            
            $("#tipoDocRef").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTipo) {
                      $("#tipoDocRef").append('<option value="' + valor.idTipo + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#tipoDocRef").append('<option value="' + valor.idTipo + '">' + valor.descripcion + '</option>');	
                  }
            });
            
            
            $("#tipoDocRefRes").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTipo) {
                      $("#tipoDocRefRes").append('<option value="' + valor.idTipo + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#tipoDocRefRes").append('<option value="' + valor.idTipo + '">' + valor.descripcion + '</option>');	
                  }
            });
            
            
            $("#tipoDocRefResAcompa").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTipo) {
                      $("#tipoDocRefResAcompa").append('<option value="' + valor.idTipo + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#tipoDocRefResAcompa").append('<option value="' + valor.idTipo + '">' + valor.descripcion + '</option>');	
                  }
            });
            
            
            
        }
    return false;
    });
    
    
    
}



function listTipoDocCirugia(pa) {
    
    $.post('./Controlador/search.php?function=tipodoc', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#tipoDocCiru").empty();
            $("#tipoDocCiru").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTipo) {
                      $("#tipoDocCiru").append('<option value="' + valor.idTipo + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#tipoDocCiru").append('<option value="' + valor.idTipo + '">' + valor.descripcion + '</option>');	
                  }
            });
            
            
        }
    return false;
    });

}



function listTipoDocPato(pa) {
    
    $.post('./Controlador/search.php?function=tipodoc', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#tipoDocPato").empty();
            $("#tipoDocPato").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTipo) {
                      $("#tipoDocPato").append('<option value="' + valor.idTipo + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#tipoDocPato").append('<option value="' + valor.idTipo + '">' + valor.descripcion + '</option>');	
                  }
            });
            
            
        }
    return false;
    });

}

function listTurnoCirugia(pa) {
    
    $.post('./Controlador/search.php?function=listTurno', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#horaInterve").empty();
            $("#horaInterve").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdTurno) {
                      $("#horaInterve").append('<option value="' + valor.IdTurno + '" selected>' + valor.Descripcion + '</option>');	
                  }else{
                      $("#horaInterve").append('<option value="' + valor.IdTurno + '">' + valor.Descripcion + '</option>');	
                  }
            });
            
            
        }
    return false;
    });

}


function listUrpaCirugia(pa) {
    
    $.post('./Controlador/search.php?function=listUrpa', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#nroCamaProg").empty();
            $("#nroCamaProg").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdServURPA) {
                      $("#nroCamaProg").append('<option value="' + valor.IdServURPA + '" selected>' + valor.Descripcion + '</option>');	
                  }else{
                      $("#nroCamaProg").append('<option value="' + valor.IdServURPA + '">' + valor.Descripcion + '</option>');	
                  }
            });
            
            
        }
    return false;
    });

}




function profesionRefRes(pa) {
    
    $.post('./Controlador/search.php?function=profesionRefRes', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#profesionRefRes").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idP) {
                      $("#profesionRefRes").append('<option value="' + valor.idP + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#profesionRefRes").append('<option value="' + valor.idP + '">' + valor.descripcion + '</option>');	
                  }
            });
            
            
            $("#profesionRefResAcompa").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idP) {
                      $("#profesionRefResAcompa").append('<option value="' + valor.idP + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#profesionRefResAcompa").append('<option value="' + valor.idP + '">' + valor.descripcion + '</option>');	
                  }
            });
            
            
        }
    return false;
    });
    
    
    
}



function dispoTransRef(pa) {
    
    $.post('./Controlador/search.php?function=dispoTransRef', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#dispoTransRef").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idDis) {
                      $("#dispoTransRef").append('<option value="' + valor.idDis + '" selected>' + valor.nombre + '</option>');	
                  }else{
                      $("#dispoTransRef").append('<option value="' + valor.idDis + '">' + valor.nombre + '</option>');	
                  }
            });
            
           
            
        }
    return false;
    });
    
    
    
}




function lisDocs(pa) {
    
    $.post('./Controlador/search.php?function=lisDocs', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#lisDocs").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdDocAT) {
                      $("#lisDocs").append('<option value="' + valor.IdDocAT + '" selected>' + valor.DocAT + '</option>');	
                  }else{
                      $("#lisDocs").append('<option value="' + valor.IdDocAT + '">' + valor.DocAT + '</option>');	
                  }
            });
            
           
            
        }
    return false;
    });
    
    
    
}


/*
function cargarFinanciamento(pa) {
    
    $.post('./Controlador/search.php?function=financiamiento', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#financia").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#financia").append('<option value="' + valor.id + '" selected>' + valor.nombre + '</option>');	
                  }else{
                      $("#financia").append('<option value="' + valor.id + '">' + valor.nombre + '</option>');	
                  }
            });
        }
    return false;
    });
}*/



function cargarFinanciamento(pa,id) {
    
    $.post('./Controlador/search.php?function=financiamiento&id='+id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#financia").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#financia").append('<option value="' + valor.id + '" selected>' + valor.nombre + '</option>');	
                  }else{
                      $("#financia").append('<option value="' + valor.id + '">' + valor.nombre + '</option>');	
                  }
            });
            
        }
    return false;
    });
}


function cargarAtencionPacEval(pa,id) {
    
    $.post('./Controlador/search.php?function=atencionPacEval', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#atencionPacEval").empty();
            $("#atencionPacEval").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#atencionPacEval").append('<option value="' + valor.id + '" selected>' + valor.nombre + '</option>');	
                  }else{
                      $("#atencionPacEval").append('<option value="' + valor.id + '">' + valor.nombre + '</option>');	
                  }
            });
            
        }
    return false;
    });
}



function cargarAtSolicitud(pa) {
    
    $.post('./Controlador/search.php?function=personalMedico', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#personalMedicoList").empty();
            $("#personalMedicoList").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdPersonal) {
                      $("#personalMedicoList").append('<option value="' + valor.IdPersonal + '" selected>' + valor.TipoPersonal + '</option>');	
                  }else{
                      $("#personalMedicoList").append('<option value="' + valor.IdPersonal + '">' + valor.TipoPersonal + '</option>');	
                  }
            });
            
        }
    return false;
    });
}

function cargarMotivoRe1(pa,id) {
    
    $.post('./Controlador/search.php?function=motivoRecEval1', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
              $("#motivoRecEval1").empty();
            $("#motivoRecEval1").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdMotivo) {
                      $("#motivoRecEval1").append('<option value="' + valor.IdMotivo + '" selected>' + valor.MotivoRef + '</option>');	
                  }else{
                      $("#motivoRecEval1").append('<option value="' + valor.IdMotivo + '">' + valor.MotivoRef + '</option>');	
                  }
            });
            
        }
    return false;
    });
}



function estadoRefDatRef1(pa,id) {
    
    $.post('./Controlador/search.php?function=estadoRefDatRef', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
              $("#estadoRefDatRef").empty();
            $("#estadoRefDatRef").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idEst) {
                      $("#estadoRefDatRef").append('<option value="' + valor.idEst + '" selected>' + valor.nombres + '</option>');	
                  }else{
                      $("#estadoRefDatRef").append('<option value="' + valor.idEst + '">' + valor.nombres + '</option>');	
                  }
            });
            
        }
    return false;
    });
}



function estadoRefDatRef2(pa,id) {
    
    $.post('./Controlador/search.php?function=estadoRefDatRef', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
              $("#estadoRefJefeServ").empty();
            $("#estadoRefJefeServ").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idEst) {
                      $("#estadoRefJefeServ").append('<option value="' + valor.idEst + '" selected>' + valor.nombres + '</option>');	
                  }else{
                      $("#estadoRefJefeServ").append('<option value="' + valor.idEst + '">' + valor.nombres + '</option>');	
                  }
            });
            
        }
    return false;
    });
}



function estadoRefDatRef3(pa,id) {
    
    $.post('./Controlador/search.php?function=estadoRefDatRef', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
              $("#estadoRefJefeGuardia").empty();
            $("#estadoRefJefeGuardia").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idEst) {
                      $("#estadoRefJefeGuardia").append('<option value="' + valor.idEst + '" selected>' + valor.nombres + '</option>');	
                  }else{
                      $("#estadoRefJefeGuardia").append('<option value="' + valor.idEst + '">' + valor.nombres + '</option>');	
                  }
            });
            
        }
    return false;
    });
}


function estadoRefDatRef4(pa,id) {
    
    $.post('./Controlador/search.php?function=estadoRefDatRef', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
              $("#estFinalRef").empty();
            $("#estFinalRef").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idEst) {
                      $("#estFinalRef").append('<option value="' + valor.idEst + '" selected>' + valor.nombres + '</option>');	
                  }else{
                      $("#estFinalRef").append('<option value="' + valor.idEst + '">' + valor.nombres + '</option>');	
                  }
            });
            
        }
    return false;
    });
}



function cargarMotivoRe2(pa,id) {
    
    $.post('./Controlador/search.php?function=motivoRecEval1', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
              $("#motivoRecEval2").empty();
            $("#motivoRecEval2").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdMotivo) {
                      $("#motivoRecEval2").append('<option value="' + valor.IdMotivo + '" selected>' + valor.MotivoRef + '</option>');	
                  }else{
                      $("#motivoRecEval2").append('<option value="' + valor.IdMotivo + '">' + valor.MotivoRef + '</option>');	
                  }
            });
            
        }
    return false;
    });
}



function cargarMotivoRe3(pa,id) {
    
    $.post('./Controlador/search.php?function=motivoRecEval1', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
              $("#motivoRecEval3").empty();
            $("#motivoRecEval3").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdMotivo) {
                      $("#motivoRecEval3").append('<option value="' + valor.IdMotivo + '" selected>' + valor.MotivoRef + '</option>');	
                  }else{
                      $("#motivoRecEval3").append('<option value="' + valor.IdMotivo + '">' + valor.MotivoRef + '</option>');	
                  }
            });
            
        }
    return false;
    });
}




function cargarMotivoRe4(pa,id) {
    
    $.post('./Controlador/search.php?function=motivoRecEval1', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
              $("#motivoRecEval4").empty();
            $("#motivoRecEval4").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdMotivo) {
                      $("#motivoRecEval4").append('<option value="' + valor.IdMotivo + '" selected>' + valor.MotivoRef + '</option>');	
                  }else{
                      $("#motivoRecEval4").append('<option value="' + valor.IdMotivo + '">' + valor.MotivoRef + '</option>');	
                  }
            });
            
        }
    return false;
    });
}

function cargarFinanciamentoRef(pa) {
    
    $.post('./Controlador/search.php?function=financiamientoRef', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            
            $("#iafasRef").empty();
            $("#iafasRef").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#iafasRef").append('<option value="' + valor.id + '" selected>' + valor.nombre + '</option>');	
                  }else{
                      $("#iafasRef").append('<option value="' + valor.id + '">' + valor.nombre + '</option>');	
                  }
            });
            
            
        }
    return false;
    });
}


function filtroFinanciamento() {
    
    $.post('./Controlador/search.php?function=filtrofinancia', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#fi").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                      $("#fi").append('<option value="' + valor.id + '">' + valor.nombre + '</option>');	
            });
        }
    return false;
    });
}



function listFinanciamentoCirug() {
    
    $.post('./Controlador/search.php?function=filtrofinancia', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#financiaCirugia").empty();
            $("#financiaCirugia").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                      $("#financiaCirugia").append('<option value="' + valor.id + '">' + valor.nombre + '</option>');	
            });
        }
    return false;
    });
}



function filtroAuditorCpms() {
    
    $.post('./Controlador/search.php?function=filtroAuditorCpms', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#listAuditorCpms").append('<option value="">TODOS</option>');
            $.each(item, function (i, valor) {
                      $("#listAuditorCpms").append('<option value="' + valor.iduser + '">' + valor.USER + '</option>');	
            });
        }
    return false;
    });
}


function cargarIafasEm(pa,id) {
    
    $.post('./Controlador/search.php?function=iafas&id='+id ,
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#seguros").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idIa) {
                      $("#seguros").append('<option value="' + valor.idIa + '" selected>' + valor.nombre + '</option>');	
                  }else{
                      $("#seguros").append('<option value="' + valor.idIa + '">' + valor.nombre + '</option>');	
                  }
            });
        }
    return false;
    });
}


function condPcte(pa) {
    
    $.post('./Controlador/search.php?function=condPcte',
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#condPcte").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdCond) {
                      $("#condPcte").append('<option value="' + valor.IdCond + '" selected>' + valor.CondPac + '</option>');	
                  }else{
                      $("#condPcte").append('<option value="' + valor.IdCond + '">' + valor.CondPac + '</option>');	
                  }
            });
        }
    return false;
    });
}



function tipoTransRef(pa) {
    
    $.post('./Controlador/search.php?function=tipoTransRef',
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#tipoTransRef").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdTransp) {
                      $("#tipoTransRef").append('<option value="' + valor.IdTransp + '" selected>' + valor.TipoTransp + '</option>');	
                  }else{
                      $("#tipoTransRef").append('<option value="' + valor.IdTransp + '">' + valor.TipoTransp + '</option>');	
                  }
            });
        }
    return false;
    });
}


function motivoRef(pa) {
    
    $.post('./Controlador/search.php?function=motivoRef',
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#motivoRef").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdMotivo) {
                      $("#motivoRef").append('<option value="' + valor.IdMotivo + '" selected>' + valor.MotivoRef + '</option>');	
                  }else{
                      $("#motivoRef").append('<option value="' + valor.IdMotivo + '">' + valor.MotivoRef + '</option>');	
                  }
            });
        }
    return false;
    });
}





function especialidadRef(pa) {
    
    $.post('./Controlador/search.php?function=especialidadRef',
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#especialidadRef").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#especialidadRef").append('<option value="' + valor.id + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#especialidadRef").append('<option value="' + valor.id + '">' + valor.descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarAseguradoras(pa,id) {
    
    $.post('./Controlador/search.php?function=aseguradoras&id='+id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
             $("#segurosAl").empty();
            $("#segurosAl").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idAs ) {
                      $("#segurosAl").append('<option value="' + valor.idAs + '" selected>' + valor.seguros + '</option>');	
                  }else{
                       $("#segurosAl").append('<option value="' + valor.idAs + '">' + valor.seguros + '</option>');	
                  }
            });
        }
    return false;
    });
    
    
    
}


function cargarRegimen(pa,id) {
    
    $.post('./Controlador/search.php?function=regimen&id='+id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#regim").empty();
            $("#regim").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idRe ) {
                      $("#regim").append('<option value="' + valor.idRe + '" selected>' + valor.nombre + '</option>');	
                  }else{
                       $("#regim").append('<option value="' + valor.idRe + '">' + valor.nombre + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarPlanSalud(pa,id) {
    
    $.post('./Controlador/search.php?function=plansalud&id='+id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            
            
            $("#planSal").empty();
            $("#planSal").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idPa ) {
                      $("#planSal").append('<option value="' + valor.idPa + '" selected>' + valor.nombre + '</option>');	
                  }else{
                       $("#planSal").append('<option value="' + valor.idPa + '">' + valor.nombre + '</option>');	
                  }
            });
            
            
            
        }
    return false;
    });
}



function cargarPlanSaludGroup(pa,id) {
    
    $.post('./Controlador/search.php?function=plansaludGroup&id='+id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            
            
            $("#tipoSegRef").empty();
            $("#tipoSegRef").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idPa ) {
                      $("#tipoSegRef").append('<option value="' + valor.idPa + '" selected>' + valor.nombre + '</option>');	
                  }else{
                       $("#tipoSegRef").append('<option value="' + valor.idPa + '">' + valor.nombre + '</option>');	
                  }
            });
            
            
            
        }
    return false;
    });
}


function cargarDepartamento() {
    
     $.post('./Controlador/search.php?function=listDeptos',	
     function(data){
		
			if (data != "[]") {
		        var item = $.parseJSON(data);
		        
				$("#depaRef").append('<option value="">-- Seleccionar --</option>');
		        $.each(item, function (i, valor) {
		            
		            if (valor.id !== null) {
					    $("#depaRef").append('<option value="' + valor.idDepartamento + '">' + valor.departamento + '</option>');	
					    
					}
		        });
		    }
		return false;
    });
}



function cargarProvincia(depa,pro) {
    $("#provRef").html('');
	
    $.post('./Controlador/search.php?function=listProv', {depa : depa}, 	
     function(data){
		
			if (data != "[]") {
		        var item = $.parseJSON(data);
		        
				$("#provRef").append('<option value="">-- Seleccionar --</option>');
		        $.each(item, function (i, valor) {
		            if(pro==valor.idProvincia){
						$("#provRef").append('<option value="' + valor.idProvincia + '" selected>' + valor.provincia + '</option>');
					}else{
						$("#provRef").append('<option value="' + valor.idProvincia + '">' + valor.provincia + '</option>');	
					}
		            
		        });
		    }
		return false;
    });
}

function cargarDistrito(pro,dis) {
	$("#disRef").html('');
	$.post('./Controlador/search.php?function=listDist', {pro : pro},
	function(data){
		
			if (data != "[]") {
				var item = $.parseJSON(data);			
		       
				$("#disRef").append('<option value="">-- Seleccionar --</option>');
		        $.each(item, function (i, valor) {
		            
		            if (valor.idDistrito ==dis) {
						
					    $("#disRef").append('<option value="' + valor.idDistrito + '" selected >' + valor.distrito + '</option>');	
					}
					else{
						$("#disRef").append('<option value="' + valor.idDistrito + '">' + valor.distrito + '</option>');	
					}
		        });
		    }
		return false;
    });
}



function listTipoAcc(pro,dis) {
    
	$("#tipoAccRef").html('');
	$.post('./Controlador/search.php?function=listTipoAcc', {pro : pro},
	function(data){
		
			if (data != "[]") {
				var item = $.parseJSON(data);			
		       
				$("#tipoAccRef").append('<option value="">-- Seleccionar --</option>');
		        $.each(item, function (i, valor) {
		            
		            if (valor.IdTipoAT ==dis) {
						
					    $("#tipoAccRef").append('<option value="' + valor.IdTipoAT + '" selected >' + valor.TipoAccidente + '</option>');	
					}
					else{
						$("#tipoAccRef").append('<option value="' + valor.IdTipoAT + '">' + valor.TipoAccidente + '</option>');	
					}
		        });
		    }
		return false;
    });
}


function cargarTipoSerIng(pa,id) {
    
    $.post('./Controlador/search.php?function=tipoServicioIngreso&id='+id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#tipoSeiN").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTsi ) {
                      $("#tipoSeiN").append('<option value="' + valor.idTsi + '" selected>' + valor.nombre + '</option>');	
                  }else{
                       $("#tipoSeiN").append('<option value="' + valor.idTsi + '">' + valor.nombre + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarTipoServicioPat(id) {
    
    $.post('./Controlador/search.php?function=cargarTipoServicioPat', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#tipoServicoPatl").empty();
            $("#tipoServicoPatl").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (id == valor.idSer ) {
                      $("#tipoServicoPatl").append('<option value="' + valor.idSer + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                       $("#tipoServicoPatl").append('<option value="' + valor.idSer + '">' + valor.descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}



function cargarTipoServicioPatSer(cat,id) {
    
    $.post('./Controlador/search.php?function=cargarTipoServicioPatSer&cat='+cat, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#servicioPat").empty();
            $("#servicioPat").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (id == valor.IdServ ) {
                      $("#servicioPat").append('<option value="' + valor.IdServ + '" selected>' + valor.Descripcion + '</option>');	
                  }else{
                       $("#servicioPat").append('<option value="' + valor.IdServ + '">' + valor.Descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarConvenioPatSer(cat,id) {
    if(cat=="1"){
         $("#ipressConvenio").empty();
    }else{
         $.post('./Controlador/search.php?function=cargarConvenioPatSer&cat='+cat, 	
        function(data){
        
          if (data != "[]") {
                var item = $.parseJSON(data);
                $("#ipressConvenio").empty();
                $("#ipressConvenio").append('<option value="">Seleccionar</option>');
                $.each(item, function (i, valor) {
                    if (id == valor.IdIpressConv ) {
                          $("#ipressConvenio").append('<option value="' + valor.IdIpressConv + '" selected>' + valor.nombre + '</option>');	
                      }else{
                           $("#ipressConvenio").append('<option value="' + valor.IdIpressConv + '">' + valor.nombre + '</option>');	
                      }
                });
            }
        return false;
        });
    }
    
   
}


function servicioOrigenRef(pa) {
    
    $.post('./Controlador/search.php?function=servicioOrigenRef', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#servicioOrigenRef").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdUPS ) {
                      $("#servicioOrigenRef").append('<option value="' + valor.IdUPS + '" selected>' + valor.NombreUPS + '</option>');	
                  }else{
                       $("#servicioOrigenRef").append('<option value="' + valor.IdUPS + '">' + valor.NombreUPS + '</option>');	
                  }
            });
        }
    return false;
    });
}




function servDestRef(pa) {
    
    $.post('./Controlador/search.php?function=servDestRef', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#servDestRef").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdUPS ) {
                      $("#servDestRef").append('<option value="' + valor.IdUPS + '" selected>' + valor.NombreUPS + '</option>');	
                  }else{
                       $("#servDestRef").append('<option value="' + valor.IdUPS + '">' + valor.NombreUPS + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarTipoSerIngHos(pa,id) {
    
    $.post('./Controlador/search.php?function=tipoServicioIngreso&id='+id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
              $("#tipoSeiNHosx").empty();
            $("#tipoSeiNHosx").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTsi ) {
                      $("#tipoSeiNHosx").append('<option value="' + valor.idTsi + '" selected>' + valor.nombre + '</option>');	
                  }else{
                       $("#tipoSeiNHosx").append('<option value="' + valor.idTsi + '">' + valor.nombre + '</option>');	
                  }
            });
        }
    return false;
    });
}




function cargarTipoSerIng(pa,id) {
    
    $.post('./Controlador/search.php?function=tipoServicioIngreso&id='+id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#tipoSeiN").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTsi ) {
                      $("#tipoSeiN").append('<option value="' + valor.idTsi + '" selected>' + valor.nombre + '</option>');	
                  }else{
                       $("#tipoSeiN").append('<option value="' + valor.idTsi + '">' + valor.nombre + '</option>');	
                  }
            });
        }
    return false;
    });
}

function cargarEspecialidades(pa) {
    
    $.post('./Controlador/search.php?function=cargaEspecialidad', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#especialidadHos").empty();
            $("#especialidadHos").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id ) {
                      $("#especialidadHos").append('<option value="' + valor.id+ '" selected>' + valor.descripcion + '</option>');	
                  }else{
                       $("#especialidadHos").append('<option value="' + valor.id + '">' + valor.descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}


function cargarEspecialidadesCirugia(pa) {
    
    $.post('./Controlador/search.php?function=cargaEspecialidadCiru', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#especialCirugia").empty();
            $("#especialCirugia").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdEspQx ) {
                      $("#especialCirugia").append('<option value="' + valor.IdEspQx+ '" selected>' + valor.Descripcion + '</option>');	
                  }else{
                       $("#especialCirugia").append('<option value="' + valor.IdEspQx + '">' + valor.Descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}




function filtroEspecialidadesCirugia(pa) {
    
    $.post('./Controlador/search.php?function=cargaEspecialidadCiru', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#fiCi").empty();
            $("#fiCi").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.IdEspQx ) {
                      $("#fiCi").append('<option value="' + valor.IdEspQx+ '" selected>' + valor.Descripcion + '</option>');	
                  }else{
                       $("#fiCi").append('<option value="' + valor.IdEspQx + '">' + valor.Descripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}

function cargarTipoSerDest(pa,id) {
    
    $.post('./Controlador/search.php?function=tipoServicioIngreso&id='+id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#tipoSeiNDes").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idTsi ) {
                      $("#tipoSeiNDes").append('<option value="' + valor.idTsi + '" selected>' + valor.nombre + '</option>');	
                  }else{
                       $("#tipoSeiNDes").append('<option value="' + valor.idTsi + '">' + valor.nombre + '</option>');	
                  }
            });
        }
    return false;
    });
}

/*
function cargarAseguradoras(pa,id) {
    
    $.post('./Controlador/search.php?function=aseguradoras&id='+id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#listaSeguros").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idAs ) {
                      $("#listaSeguros").append('<option value="' + valor.idAs + '" selected>' + valor.seguros + '</option>');	
                  }else{
                       $("#listaSeguros").append('<option value="' + valor.idAs + '">' + valor.seguros + '</option>');	
                  }
            });
        }
    return false;
    });
} */

function cargarDestinos(pa,id) {
    
    var des='';
    if(id==1){
        des='destinoEmer';
    }else  if(id==2){
        des='destinoHospi';
    }else  if(id==3){
        des='destinoConsultaExterna';
    }
    
    
    $.post('./Controlador/search.php?function='+des, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             
            $("#espost").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idDes) {
                      $("#espost").append('<option value="' + valor.idDes + '" selected>' + valor.decripcion + '</option>');	
                  }else{
                      $("#espost").append('<option value="' + valor.idDes + '">' + valor.decripcion + '</option>');	
                  }
            });
        }
    return false;
    });
}



function cargarActividad(pa,id) {
    
   
    $.post('./Controlador/search.php?function=listActividades', 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            
            $("#actividadAudit").empty();
            $("#actividadAudit").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idAct) {
                      $("#actividadAudit").append('<option value="' + valor.idAct + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#actividadAudit").append('<option value="' + valor.idAct + '">' + valor.descripcion + '</option>');	
                  }
            });
        }
        
    return false;
    
    });
    
}


function cargarActividadProc(pa,id) {
    
   
    $.post('./Controlador/search.php?function=listActividadesProc&id=' + id, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            
            $("#proceAuditoria").empty();
            $("#proceAuditoria").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.idProc) {
                      $("#proceAuditoria").append('<option value="' + valor.idProc + '" selected>' + valor.descripcion + '</option>');	
                  }else{
                      $("#proceAuditoria").append('<option value="' + valor.idProc + '">' + valor.descripcion + '</option>');	
                  }
            });
        }
        
    return false;
    
    });
    
}


function filtroDestinos(id) {
    
    var des='';
    if(id==1){
        des='destinoEmer';
    }else if(id==2){
        des='destinoHospiAsc';
    }else if(id==3){
        des='destinoConsultaExterna';
    }
    
    
    $.post('./Controlador/search.php?function='+des, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
            $("#des").empty();
            $("#des").append('<option value="">Seleccionar</option><option value="666">SIN ALTA</option>');
            $.each(item, function (i, valor) {
                      $("#des").append('<option value="' + valor.idDes + '">' + valor.decripcion + '</option>');
            });
        }
    return false;
    });
}

//reciAudit

function reciAudit(pa,tipo) {
    
    
    $.post('./Controlador/search.php?function=reciAuditores&tipo=' + tipo, 	
    function(data){
    
      if (data != "[]") {
            var item = $.parseJSON(data);
             $("#reciAudit").empty();
            $("#reciAudit").append('<option value="">Seleccionar</option>');
            $.each(item, function (i, valor) {
                if (pa == valor.id) {
                      $("#reciAudit").append('<option value="' + valor.id + '" selected>' + valor.nom + '</option>');	
                  }else{
                      $("#reciAudit").append('<option value="' + valor.id + '">' + valor.nom + '</option>');	
                  }
            });
        }
    return false;
    });
}



function verInsumosAuto(id){
   
  
    $.ajax({
        url:'./Controlador/search.php?function=VerInsumoAuto',
        type:'GET',
        dataType:'json',
        data:{ id:id}
  
    }).done(function(datos){
  
        
        $("#idInsAuto").val(datos[0]);
        $("#idpresInsuAuto").val(datos[1]);
        $("#codSismedAuto").val(datos[2]);
        $("#cantInAuto").val(datos[3]);
       // $("#diagAuto").val(datos[4]);
        $("#diagAuto").empty();
         verDxInsu(datos[1],datos[4]);
        $("#valoriAuto").val(datos[5]);
        $("#desAuto").val(datos[6]);
        $("#totaliAuto").val(datos[7]);
             
    });
    
  }


function verMedica(id){
   
  
    $.ajax({
        url:'./Controlador/search.php?function=VerMx',
        type:'GET',
        dataType:'json',
        data:{ id:id}
  
    }).done(function(datos){
  
        
        $("#idMedic").val(datos[0]);
        $("#idpresMedca").val(datos[1]);
        $("#codSisMx").val(datos[2]);
        $("#cantMed").val(datos[3]);
        $("#diagMed").val(datos[4]);
        $("#valoriMed").val(datos[5]);
        $("#desMed").val(datos[6]);
        $("#totalm").val(datos[7]);
             
    });
    
  }

  function verMedicaAuto(id){
   
  
    $.ajax({
        url:'./Controlador/search.php?function=VerMxAuto',
        type:'GET',
        dataType:'json',
        data:{ id:id}
  
    }).done(function(datos){
  
        
        
        $("#idMedicAuto").val(datos[0]);
        $("#idpresMedcaAuto").val(datos[1]);
        $("#codSisMxAuto").val(datos[2]);
        $("#cantMedAuto").val(datos[3]);
        $("#diagMedAuto").empty();
        verDxMed(datos[1],datos[4]);
        $("#valoriMedAuto").val(datos[5]);
        $("#desMedAuto").val(datos[6]);
        $("#totalmAuto").val(datos[7]);
             
    });
    
  }

  function datosPaciente(id){
   
  
    $.ajax({
        url:'./Controlador/search.php?function=datPacinx',
        type:'GET',
        dataType:'json',
        data:{ id:id}
  
    }).done(function(datos){
  
        
        $("#nAtencionDat").val(datos[0]);
        $("#nAutoDat").val(datos[1]);
        $("#nHistoriaDat").val(datos[2]);
        if(datos[3]==1){
            $("#tipoDocDat").val("DNI");
        }
        
        $("#nroDocDat").val(datos[4]);
        $("#aPaternoDat").val(datos[5]);
        $("#aMaternoDat").val(datos[6]);
        $("#nombresDat").val(datos[7]);
        $("#fechaIngresoDat").val(datos[8]);
        $("#fechaAltaDat").val(datos[9]);       


    });
    
  }


  function datosPacienteConsol(id){
   
  
    $.ajax({
        url:'./Controlador/search.php?function=datPacinConsol',
        type:'GET',
        dataType:'json',
        data:{ id:id}
  
    }).done(function(datos){
  
        
        $("#apter").val(datos[0]);
        $("#apmt").val(datos[1]);
        $("#fecnac").val(datos[2]);
        $("#sex").val(datos[3]);
        $("#tipan").val(datos[4]);
        $("#hclinc").val(datos[5]);
        $("#tipdo").val(datos[6]);
        $("#nrodc").val(datos[7]);
        $("#nombr").val(datos[8]);
        $("#fegre").val(datos[9]);       

    });
    
  }
//

function LimpiarForm(){
    $('#formPaciente')[0].reset();
    $("#ide").val("");
    $("#fua").val("6207-24-");
    $("#ui-id-1").css("z-index", "9999999999");
 setTimeout(function (){
            $("#Nxuenta").focus();
    }, 500);
    
    $('#ubiSerHosp').empty();
    cargarPresHospi();
   
   $('#servicio').empty();
     cargarPa()
    
}


function limpiarFormDesig(){
    
    $('#formPacienteDesigna')[0].reset();
    $("#ideDes").val("");
    
    setTimeout(function (){
            $("#rango").focus();
    }, 500);
    
    //$('#resDis').empty();
   $('#serviDesi').empty();
    cargarServicioDesignacion();
    
    
    //cargarPresHospi();
    // cargarPa()
    
}

function limpiarModalRef (){
    
    $("#ui-id-1").css("z-index", "9999999999");
    $("#ui-id-2").css("z-index", "9999999999");
    $('#formPacienteReferencias')[0].reset();
   $("#tipoSegRef").empty();
   $("#provRef").empty();
   $("#disRef").empty();  $("#iafasRef").empty();
        
}


function limpiarModalRegistroHist (){
    
    
    $('#formReferencias')[0].reset();
    
    $("#refPcite").text("");
    $("#tipoRefPax").text("");
    $("#nrodocPaxRefEx").text("");
    $("#histPaxRefEx").text("");
    $("#edadPaxRefEx").text("");
    $("#sexoPaxRefEx").text("");
    $("#seguroPaxRefEx").text("");
    $("#accTraPaxRefEx").text("");
    $("#codnPaxRefEx").text("");
    $("#pctePaxRefEx2").text("");
    $("#tipoDocPaxRefEx2").text("");
    $("#nroDocPaxRefEx2").text("");
    $("#historiaPaxRefEx2").text("");
    $("#edadPaxRefEx2").text("");
    $("#sexoPaxRefEx2").text("");
    $("#segPs").text("");
    $("#accTranPaxRefEx2").text("");
    $("#condPaxRefEx2").text("");
        
}



function limpiarModalEvaluacion (){
    
    
    $('#formEvalReferen')[0].reset();
    cargarMotivoRe1();cargarMotivoRe2();
    cargarMotivoRe3();cargarMotivoRe4();
  cargarAtencionPacEval();estadoRefDatRef1();
  estadoRefDatRef2();estadoRefDatRef3();estadoRefDatRef4();
   
        
}

function LimpiarFormEmer(){
    
    
    
    $('#formPacienteEmergen')[0].reset();
    $("#guardarEmege").removeClass("hidden");
    $("#butonAudit").addClass("hidden");
    
    $("#ide").val("");
   // $("#fua").val("6207-24-");
   $("#tab_content1").addClass("active in");
   $("#tab_content2").removeClass("active in");
   $("#tab_content3").removeClass("active in");
   $("#tab_content4").removeClass("active in");
   $("#tab_content1u").removeClass("active in");
   
   
   $("#idDat").addClass("active");
   $("#idAudria").removeClass("active");
   $("#idArch").removeClass("active");
    $("#idDatIngere").removeClass("active");
 $("#idPad").removeClass("active");
    
    
    
    
   /* setTimeout(function (){
            $("#nroCxref").val("6207-24-");
    }, 500);*/
    
    
    $("#idUserLiquida").val("");
    $('#seguros').empty();
    $('#espost').empty();
    $('#pabellones').empty();
    $('#listaSeguros').empty();
    var tipo = getParameterByName('tipo');
    
    
    if(tipo =="2"){
      $('#telcEmerHs').text('CUENTA HOSP');
      $("#feRtU").removeClass("hidden");
       $("#fetOp").removeClass("hidden");
       $("#txtitleAudi").removeClass("hidden");
       $("#txtValorAudi").removeClass("hidden");
       
      
    }else if(tipo =="1") {
      $('#telcEmerHs').text('CUENTA EMERG');
      $("#feRtU").removeClass("hidden");
       $("#fetOp").removeClass("hidden");
        $("#txtitleAudi").addClass("hidden");
         $("#txtValorAudi").addClass("hidden");
       
       
    }else if(tipo =="3") {
      
       $("#txtitleAudi").removeClass("hidden");
       $("#txtValorAudi").removeClass("hidden");
      $('#telcEmerHs').text('CUENTA CE');
      $('#iafReg').removeClass("hidden");
      $("#txtSegu").text("IAFAS");
      $("#actras").val("SI");
      //cargarFinanciamento(0,1)
      cargarIafasEm(0,1);

      $("#muesNroAfil").removeClass("hidden");
      $("#datoNroAf").removeClass("hidden");
      $("#feNuevas").removeClass("hidden");
      $("#feRtU").addClass("hidden");
      $("#fetOp").addClass("hidden");
      
      
    }
    
    
    
    $("#tipoReg").val(tipo);
    $("#reciAudit").empty();
    
    reciAudit(0,tipo);
    cargarNvaCta();
    cargarmotivoEmer();
     $("#ui-id-1").css("z-index", "9999999999");
     $("#ui-id-2").css("z-index", "9999999999");
     $("#ui-id-3").css("z-index", "9999999999");
     $("#ui-id-4").css("z-index", "9999999999");
     $("#ui-id-5").css("z-index", "9999999999");
     $("#ui-id-6").css("z-index", "9999999999");
     $("#ui-id-7").css("z-index", "9999999999");
     $("#ui-id-8").css("z-index", "9999999999");
      
      
      $("#cuenta").attr("readonly", false);
      $("#origenEmer").attr("readonly", false);
      $("#hisCli").attr("readonly", false);
      $("#tipoDoc").attr("readonly", false);
      $("#NroDoc").attr("readonly", false);
      $("#apepa").attr("readonly", false);
      $("#apema").attr("readonly", false);
      $("#nombres").attr("readonly", false);
      $("#FechaNac").attr("readonly", false);
      $("#edad").attr("readonly", false);
      $("#sexo").attr("readonly", false);
      $("#nroRefEmer").attr("readonly", false);
      $("#eessInicio").attr("readonly", false);
      $("#subirRef").attr("readonly", false);
       $("#fechaIngreHos").attr("readonly", false);
      
       $("#tipoDoc").css("pointer-events", "visible");
       $("#origenEmer").css("pointer-events", "visible");
       $("#sexo").css("pointer-events", "visible");
       
        $("#origenEmerMod").attr("readonly", false);
        $("#ubicacionHosX").attr("readonly", false);
        $("#tipoSeiNHosx").attr("readonly", false);
            
        $("#origenEmerMod").css("pointer-events", "visible");
        $("#ubicacionHosX").css("pointer-events", "visible");
        $("#tipoSeiNHosx").css("pointer-events", "visible");
        $("#montoToaxlHos").attr("readonly", false);
       
        $("#fua").attr("readonly", false);
        $("#rsatencion").attr("readonly", false);
       $("#acptTra").addClass("hidden");
       $("#obsFuaHo").addClass("hidden");
       $("#cHps").addClass("hidden");
       $("#inpuCunx").addClass("hidden");
       
       
      cargarPabellonesHos1();
      cargarPabellonesHos2();
      cargarObservacionesFua(0);
    cargarAuditor();
    cargarPabellones();
    $("#tipoDoc").empty();
    listTipoDoc();
    
    // cargarSeguros();
    
   
   cargarEspecialidades();
   
   $("#financia").empty();
   $("#seguros").empty();
   $("#regim").empty();
   $("#planSal").empty();
    cargarFinanciamento();
    cargarIafasEm();
    cargarAseguradoras();
    
    cargarDestinos(0,tipo);
    
}



function LimpiarFormEmerCE(){
    
    $('#formPacienteEmergenCE')[0].reset();
    $("#ideCE").val("");
    $("#fuaCE").val("6207-24-");
    $("#ui-id-1").css("z-index", "9999999999");
    $("#ui-id-2").css("z-index", "9999999999");
    $("#ui-id-3").css("z-index", "9999999999");
    $("#ui-id-4").css("z-index", "9999999999");
    $("#ui-id-5").css("z-index", "9999999999");
     
    setTimeout(function (){
            $("#fuaCE").focus();
    }, 500);
    
}



function limpiarMarcador(){
    
   
     $("#ui-id-1").css("z-index", "9999999999");
     $("#ui-id-2").css("z-index", "9999999999");
      $("#ui-id-4").css("z-index", "9999999999");
      $("#ui-id-6").css("z-index", "9999999999");
     $('#frmMarcadorHisto')[0].reset();
     $("#inum").addClass("hidden");
     $("#intenHid").addClass("hidden");
     $("#hiddeNucel").addClass("hidden");
     $("#hiddenPunt").addClass("hidden");
     $("#hidInterp").addClass("hidden");
     $("#otrosHi").addClass("hidden");
     $("#resuNorm").removeClass("hidden");
     $("#idPakMar").val("");
     
     $("#fomaCervi").val($("#formatoPatologiaMac").val());
     $("#tipoEsCervi").val($("#tipoEstPat").val());
     
     var idPrin = getParameterByName('id');
     $("#idPrin").val(idPrin);
     

    
}



function limpiarUsuarios(){
    
    $('#formUsuario')[0].reset();
    $("#idUSX").val("");
    
}



function limpiarFromGrupo(){
    
    $('#formGAudit')[0].reset();
    $("#idgroux").val("");
    $('#audiGrupo').empty();
    cargarAuditorGrupo();
}


function limpiarListpaq(){
    
    $('#frmPaquete')[0].reset();
    $("#idPak").val("");
    $("#fechaHoraAsignadoDigitador").val("");
    cargarListCajas();
    cargarListAuditCE();
    $("#viIdfg").addClass("hidden"); 
}

function limpiarListRo(){
    
    $('#formRotulo')[0].reset();
    $("#ideRo").val("");
    $("#ui-id-3").css("z-index", "9999999999");
    $("#ui-id-4").css("z-index", "9999999999");
    $("#ui-id-6").css("z-index", "9999999999");
    $("#ui-id-7").css("z-index", "9999999999");
    cargarListCategoria();
     
    $("#tacos").attr("readonly",false); 
    $("#categoria").attr("readonly",false); 
    //$("#titleMoal").text("MACROSCOPIA");
    
     $("#plantillaApe").html(''); 
     $("#plantillaApe").attr("readonly", false);
     $("#plantillaApe").css("pointer-events","auto"); 
     $("#plantillaApe").css("cursor","pointer"); 

    $("#rotulo").html(''); 
    $("#rotulo").attr("readonly", false);
    $("#rotulo").css("pointer-events","auto"); 
    $("#rotulo").css("cursor","pointer"); 
    
    $("#descDiv").removeClass("hidden");
    var procePat = $("#procePat").val();
    
    if(procePat > 13 ){
         $("#viewCorte").addClass("hidden");
    }else{
         $("#viewCorte").removeClass("hidden");
    }
   
    
}


function limpiarListRoMicro(){
    
    $('#formRotulo')[0].reset();
    $("#ideRo").val("");
    $("#ui-id-3").css("z-index", "9999999999");
    $("#ui-id-4").css("z-index", "9999999999");
    $("#rotulo").attr("readonly", false); 
    $("#tacos").attr("readonly",false); 
    $("#categoria").attr("readonly",false); 
    $("#titleMoal").text("MACROSCOPIA");
    
}



function limpiarFromQuimio(){
    
    $('#formPacienteQuimio')[0].reset();
    $("#ideQa").val("");
   $("#ui-id-1").css("z-index", "9999999999");
    $("#ui-id-2").css("z-index", "9999999999");
    $("#ui-id-3").css("z-index", "9999999999");
    $("#ui-id-4").css("z-index", "9999999999");
    $("#ui-id-5").css("z-index", "9999999999");
    $("#asiAudiQa").empty();
    cargarAuditorQuimio();
   
}


function LimpiarFormHospi(){
    
    $('#formPacienteEmergen')[0].reset();
    $("#ide").val("");
    $("#fua").val("6207-24-");
    $('#seguros').empty();
    $('#espost').empty();
    $('#pabellones').empty();
    $('#listaSeguros').empty();
    $("#tipoReg").val("2");
    
    
    cargarAuditor();
    cargarPabellones();
    cargarSeguros();
    cargarFinanciamento();
    cargarIafas();
    cargarAseguradoras();
    cargarDestinos(0,2);
    
}


function LimpiarFormAltas(){
    $('#formPacienteAltas')[0].reset();
    $("#fua").val("6207-24-");
    cargarServices();
    cargarIafas();
    $("#ide").val("");
    cargarAuditor();
    //
}

function LimpiarFormCartas(){
    
    $('#formCartas')[0].reset();
    $("#ide").val("");
    $("#ui-id-1").css("z-index", "9999999999");

    /*      $( "#monto" ).removeAttr( "readonly", true);
            $( "#aseguradora").removeAttr( "disabled", true);
            $( "#poliza" ).removeAttr( "readonly", true);
    */
    
    
}



function RegistrarCjax(){
  
    var tipo = getParameterByName('id');
    var iduser = $("#iduser").val() ;
    
    var opcion = confirm("¿Estas seguro de generar una nueva caja ?");
    if (opcion == true) {
                
                    var info = "";
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerProcedimientos.php?function=regMAsiCajax",
                        data: "tipo="+tipo+"&us="+iduser,
                     
                        success: function(resp){               
                           
                                alert("Caja generada");
                                //$('#cerrarExamen').click();
                                verCajaModal();
                           
                        }
                    });
                    
	    } else {
	        
                    //alert("Has clickado Cancelar");
        
        }
        
 
}  




function RegistrarPac()
{
  

    //var info = $("#formPaciente").serialize();
    var info = new FormData($("#formPaciente")[0]);
    
    var Nxuenta = $("#Nxuenta").val();
    var servicio = $("#servicio").val();
    var prioAudit = $("#prioAudit").val();
    var codPreHos = $("#codPreHos").val();
    var ubiSerHosp = $("#ubiSerHosp").val();
    
   var tipo = getParameterByName('tipo');

    if(Nxuenta==""){

        alert("Debes ingresar el TIPO DE SEGURO");
       
    }else if(servicio==""){

        alert("Debes ingresar EL PABELLON");
       
    }else if(prioAudit=="" && tipo =='2'){

        alert("Debes ingresar LA PRIORIDAD");
        $("#prioAudit").focus();
        
    }else if(codPreHos=="" && tipo =='1'){

        alert("Debes ingresar EL CODIGO PRESTACIONAL");
        $("#codPreHos").focus();
    }else if(ubiSerHosp=="" && tipo =='1'){

        alert("Debes ingresar LA DENOMINACION");
        $("#ubiSerHosp").focus();
    }
    
    else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/registro.php?function=RegistroPacx",
            data: info,
             cache: false,
             contentType: false,
             processData: false,
            success: function(resp){ 
               
                if(resp==1){

                   // alert("La CUENTA ya a sido registrada");
                    $.NotificationService.showErrorNotification({
                              title:"Mensaje",
                              message:"La CUENTA ya a sido registrada"
                  });
                     $('#formPaciente')[0].reset();

                }else{

                    $('#formPaciente')[0].reset();                
                    $('#cerrarpre').click();
                    $('#pac3').DataTable().ajax.reload(null, false);
                    $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"Los cambios se guardaron correctamente"
                    });

                }
            
            }
            
        });
        
    }   
    
}  



function guardarDesignaFuas()
{
  

    //var info = $("#formPacienteDesigna").serialize();
    var info = new FormData($("#formPacienteDesigna")[0]);
    
    var rango = $("#rango").val();


    if(rango==""){

        alert("Debes ingresar el RANGO");
       
    }
    
    else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/registro.php?function=RegistroDesignacionFuas",
            data: info,
            cache: false,
            contentType: false,
            processData: false,
            success: function(resp){               
               
                if(resp==1){

                    alert("El RANGO ya a sido registrada");
                     $('#formPacienteDesigna')[0].reset();

                }else{

                    $('#formPacienteDesigna')[0].reset();                
                    $('#cerradesrpre').click();
                    $('#tblDesig').DataTable().ajax.reload(null, false);

                }
                
               
            }
        });
        
    }   
}  





function registroQuimi()
{
  

    var info = $("#formPacienteQuimio").serialize();
    var Nxuenta = $("#Nxuenta").val();
   
    

    if(Nxuenta==""){

        alert("Debes ingresar el TIPO DE SEGURO");
       
    }
    
    else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/registro.php?function=registroQuimio",
            data: info,
            success: function(resp){               
               
                if(resp==1){

                    alert("La CUENTA ya a sido registrada");
                     $('#formPacienteQuimio')[0].reset();

                }else{

                    $('#formPacienteQuimio')[0].reset();                
                    $('#cerrarQuim').click();
                    $('#tableQuimio').DataTable().ajax.reload(null, false);

                }
            }
            
            
        });
        
    }   
}  





function guardarCajx()
{
  

    var info = $("#frmAgregarCax").serialize();
    var refeCaja = $("#refeCaja").val();
   var tik = getParameterByName('id');
    

    if(refeCaja==""){

        alert("Debes ingresar alugna REFERENCIA para el registro");
       
    }
    
    else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/registro.php?function=registroCajx",
            data: info,
            success: function(resp){               
               
                    $('#frmAgregarCax')[0].reset();
                    CargarListadoCajas(0,tik);
                
            }
            
            
        });
        
    }   
}  


function RegistrarPacAltas()
{
  

    var info = $("#formPacienteAltas").serialize();
    var Nxuenta = $("#Nxuenta").val();
    var hclinica = $("#hclinica").val();
    var iafa = $("#iafa").val();
    var paciente = $("#paciente").val();
    var servicio = $("#servicio").val();
    var feingreso = $("#feingreso").val();
    var fecorte = $("#fecorte").val();
   
    

    if(Nxuenta==""){

        alert("Debes ingresar el Nro CUENTA");
       
    }else  if(hclinica==""){

        alert("Debes ingresar la HISTORIA CLINICA");
       
    }else  if(iafa==""){

        alert("Debes ingresar la IAFA");
       
    }else  if(paciente==""){

        alert("Debes ingresar los DATOS DEL PACIENTE");
       
    }else  if(servicio==""){

        alert("Debes ingresar el SERVICIO");
       
    }else  if(feingreso==""){

        alert("Debes ingresar FECHA INGRESO");
       
    }else  if(fecorte==""){

        alert("Debes ingresar FECHA ALTA");
       
    }
    else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/registro.php?function=RegistroPacxAltas",
            data: info,
            
            success: function(resp){               
               if(resp==1){
                    alert("Ya existe el Nro de cuenta");
               }else{

                    $('#formPacienteAltas')[0].reset();                
                    $('#cerrarpre').click();
                    $('#feconIafa').empty();
                    CargarRepo();
               }
                
               
            }
        });
        
    }   
} 



function enviarObservacionEm(id)
{
  
    var comment = $("#comment").val();
    var dx1 = $("#dx1").val();
    var dx2 = $("#dx2").val();
    var dx3 = $("#dx3").val();
    var dx4 = $("#dx4").val();
    var dx5 = $("#dx5").val();
    var dx6 = $("#dx6").val();
    var dx7 = $("#dx7").val();
    var dx8 = $("#dx8").val();
    var dx9 = $("#dx9").val();
    var dx10 = $("#dx10").val();
    
    var tip1 = $("#tip1").val();
    var tip2 = $("#tip2").val();
    var tip3 = $("#tip3").val();
    var tip4 = $("#tip4").val();
    var tip5 = $("#tip5").val();
    
    var tip6 = $("#tip6").val();
    var tip7 = $("#tip7").val();
    var tip8 = $("#tip8").val();
    var tip9 = $("#tip9").val();
    var tip10 = $("#tip10").val();
   var codPreHos = $("#codPreHos").val();
   var ubiSerHosp = $("#ubiSerHosp").val();
   var prioAudit = $("#prioAudit").val();
  
   /* if(comment==""){

        //alert("Debes ingresar tu OBSERVACION");
       
    }else if(codPreHos==""){
        alert("Debes ingresar el SERVICIO");
        $("#codPreHosCE").focus();
    }
    else{
       */
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "./Controlador/registro.php?function=RegistrObsEmer",
            //data: "id="+id+"&obs="+comment,
            data:{ ide: id, obs:comment, dx1:dx1, dx2:dx2 , dx3:dx3 , dx4:dx4 , dx5:dx5 , dx6:dx6 , dx7:dx7 , dx8:dx8 , dx9:dx9 , dx10:dx10 , tip1:tip1, tip2:tip2, tip3:tip3, tip4:tip4, tip5:tip5, tip6:tip6, tip7:tip7, tip8:tip8, tip9:tip9, tip10:tip10, codPreHos:codPreHos, ubiSerHosp:ubiSerHosp,prioAudit:prioAudit },
            
            success: function(resp){      
                /*if(prioAudit!='0'){
                    location.reload();
                }*/
                
                $("#imrpesion").removeClass("hidden");
                //alert("A sido enviado con éxito.")
                $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"La información ha sido guardado correctamente."
                  });
               
            }


        });
        
   /* }   */
} 


function enviarObservacion(id)
{
  
    var comment = $("#comment").val();
    var dx1 = $("#dx1").val();
    var dx2 = $("#dx2").val();
    var dx3 = $("#dx3").val();
    var dx4 = $("#dx4").val();
    var dx5 = $("#dx5").val();
    
    var dx6 = $("#dx6").val();
    var dx7 = $("#dx7").val();
    var dx8 = $("#dx8").val();
    var dx9 = $("#dx9").val();
    var dx10 = $("#dx10").val();
    
    var tip1 = $("#tip1").val();
    var tip2 = $("#tip2").val();
    var tip3 = $("#tip3").val();
    var tip4 = $("#tip4").val();
    var tip5 = $("#tip5").val();
    
    var tip6 = $("#tip6").val();
    var tip7 = $("#tip7").val();
    var tip8 = $("#tip8").val();
    var tip9 = $("#tip9").val();
    var tip10 = $("#tip10").val();
    
    
   var codPreHos = $("#codPreHos").val();
   var ubiSerHosp = $("#ubiSerHosp").val();
   var prioAudit = $("#prioAudit").val();
  
   /* if(comment==""){

        //alert("Debes ingresar tu OBSERVACION");
       
    }else if(codPreHos==""){
        alert("Debes ingresar el SERVICIO");
        $("#codPreHosCE").focus();
    }
    else{
       */
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "./Controlador/registro.php?function=RegistrObs",
            //data: "id="+id+"&obs="+comment,
            data:{ ide: id, obs:comment, dx1:dx1, dx2:dx2 , dx3:dx3 , dx4:dx4 , dx5:dx5 , dx6:dx6 , dx7:dx7 , dx8:dx8 , dx9:dx9 , dx10:dx10 , tip1:tip1, tip2:tip2, tip3:tip3, tip4:tip4, tip5:tip5, tip6:tip6, tip7:tip7, tip8:tip8, tip9:tip9, tip10:tip10, codPreHos:codPreHos, ubiSerHosp:ubiSerHosp,prioAudit:prioAudit },
            
            success: function(resp){      
                /*if(prioAudit!='0'){
                    location.reload();
                }*/
                
                $("#imrpesion").removeClass("hidden");
                //alert("A sido enviado con éxito.")
                 $.NotificationService.showInfoNotification({
                              title:"Mensaje",
                              message:"La información ha sido guardado correctamente."
                  });
               
            }


        });
        
   /* }   */
} 


function enviarObservacion2(id)
{
  
    var comment = $("#comment").val();
    var dx1 = $("#dx1").val();
    var dx2 = $("#dx2").val();
    var dx3 = $("#dx3").val();
    var dx4 = $("#dx4").val();
    var dx5 = $("#dx5").val();
    var tip1 = $("#tip1").val();
    var tip2 = $("#tip2").val();
    var tip3 = $("#tip3").val();
    var tip4 = $("#tip4").val();
    var tip5 = $("#tip5").val();

   var codPreHos = $("#codPreHosCE").val();
   var ubiSerHosp = $("#ubiSerHospCE").val();
  
    if(comment==""){

        alert("Debes ingresar tu OBSERVACION");
       
    }else if(codPreHos==""){
        alert("Debes ingresar el SERVICIO");
        $("#codPreHosCE").focus();
    }
    else{
       
        $.ajax({
            type: "GET",
            dataType: 'html',
            url: "./Controlador/registro.php?function=RegistrObs",
            //data: "id="+id+"&obs="+comment,
            data:{ ide: id, obs:comment, dx1:dx1, dx2:dx2 , dx3:dx3 , dx4:dx4 , dx5:dx5 , tip1:tip1, tip2:tip2, tip3:tip3, tip4:tip4, tip5:tip5, codPreHos:codPreHos, ubiSerHosp:ubiSerHosp },
            
            success: function(resp){               
            
                $("#imrpesion").removeClass("hidden");
                alert("A sido enviado con éxito.")
               
            }


        });
        
    }   
} 





function asignarAudix(id){
    $('#audi').empty();
    cargarAuditor();
    $("#idgroux").val(id);
}

function asignarTecx(id){
    $('#tecx').empty();
    cargarTecnico();
    $("#idgrouxt").val(id);
}

function RegistrarAuditor()
{
  
    var info = $("#formGAudit").serialize();
  
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "./Controlador/controllerDiagnostico.php?function=Registroaut",
        data: info,
        
        success: function(resp){               
        

                $('#formGAudit')[0].reset();                
                $('#generaAudi').click(); 
               // CargarCon();
            
        }
    });
        
   
}  

function RegistrarTecnico()
{
  
    var info = $("#formTecx").serialize();
  
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "./Controlador/controllerDiagnostico.php?function=Registrtex",
        data: info,
        
        success: function(resp){               
        

                $('#formTecx')[0].reset();                
                $('#generaTedf').click(); 
                //CargarCon();
            
        }
    });
        
   
}  




function getParameterByName(name) {
          
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function RegistrarCuentas()
{
  
    var info = $("#formCuentas").serialize();
    var ide = $("#ideuser").val();
    var nrocuenta = $("#nrocuenta").val();
    var productoX = $("#productoX").val();    
    var hcli= $("#hclinica").val();

    if(nrocuenta=="" || productoX==""){
        alert("El N° CUENTA o CONSULTORIO esta vacio.");
    }
    else{
       
        var opcion = confirm("¿Esta seguro de la información registrada?");
        if (opcion == true) {

            $.ajax({
                type: "POST",
                dataType: 'html',
                url: "./Controlador/registro.php?function=RegistroCuentas",
                data: info,
                
                success: function(resp){               
                   
                    if(resp ==1){
                            alert("EL N° CUENTA ya existe.");
                    }else{
                        $('#formCuentas')[0].reset();
                        $("#idCuenta").val("");  
                        $("#hclinica").val(hcli);  
                        //$('#cerrarcssX').click();
                        var id = $("#ideC").val();;
                        CargarCuentas(id); 
                    }
                }
            });
        
        }        
    }   
}  


function clearFrmDx(id){

    $("#ui-id-2").css("z-index", "9999999999");
    $('#formDx')[0].reset();
    $("#idDx").val("");
    $("#idpres").val(id);

}


function clearFrmProc(id){

    
    $('#formPrc')[0].reset();
    $("#idPr").val("");
    $("#idpresPro").val(id);
    $("#ui-id-1").css("z-index", "9999999999");
    setTimeout(function (){
        $("#codCpt").focus();
    }, 500);

}

function clearFrmProcAuto(id){

    
    $('#formPrcAuto')[0].reset();
    $("#idPrAuto").val("");
    $("#idpresProAuto").val(id);
    $("#dx").empty();
    verDx(id,"0");
    $("#ui-id-1").css("z-index", "9999999999");


}

function clearFrmInsu(id){

    
    $('#formInsu')[0].reset();
    $("#idIns").val("");
    $("#idpresInsu").val(id);

}


function clearFrmInsuAuto(id){

    
    $('#formInsuAuto')[0].reset();
    $("#idInsAuto").val("");
    $("#idpresInsuAuto").val(id);
    $("#diagAuto").empty();
    verDxInsu(id,"0");

}

function clearFrmMedx(id){

    
    $('#formMed')[0].reset();
    $("#idMedic").val("");
    $("#idpresMedca").val(id);

}


function clearFrmMedxAuto(id){

    
    $('#formMedAuto')[0].reset();
    $("#idMedicAuto").val("");
    $("#idpresMedcaAuto").val(id);
    $("#diagMedAuto").empty();
    verDxMed(id,"0");

}


function insertDx()
{
  

    var info = $("#formDx").serialize();
    var HistCli = $("#HistCli").val();
    var tipotras = $("#tipotras").val();

    if(HistCli=="" && tipotras=="" ){

        alert("Debes llenar todos los campos vacios");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerDiagnostico.php?function=insertDx",
            data: info,
            
            success: function(resp){               
               
                $('#formDx')[0].reset();                
                $('#cerraDx').click();
                var id = getParameterByName('id');
                CargarDiagnosticos(id);
               
            }
        });
        
    }   
} 

function guardarResponsable(id)
{
  

    var info = $("#frmDatosResponx").serialize();
    var HistCli = "1";

    if(HistCli=="0" ){

        alert("Debes llenar todos los campos vacios");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerDiagnostico.php?function=insertResposanble",
            data: info,
            
            success: function(resp){               
               
                var id = $("#idcuen").val();
                $(location).attr('href',"editarCuenta.php?id="+id);
                alert("Datos actualizados correctamente.");
               
            }
        });
        
    }   
} 


function actualEstado(id)
{
  

    var HistCli = "1";
    if(HistCli=="0" ){

        alert("Debes llenar todos los campos vacios");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerDiagnostico.php?function=insertEstado",
            data: "id="+id,
            
            success: function(resp){               
               
                var id = $("#idcuen").val();
                $(location).attr('href',"editarCuenta.php?id="+id);
               alert("Datos enviados correctamente.");
                window.close();
            
               
            }
        });
        
    }   

}



function EliminarDx(id)
{

    
    var opcion = confirm("¿Estas seguro de eliminar el registro ?");
    if (opcion == true) {
       
       $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerDiagnostico.php?function=deleteDx",
            data: "id="+id,
            success: function(resp){
                var id = getParameterByName('id');
                CargarDiagnosticos(id);
                }
            }); 
	    } else {
        //alert("Has clickado Cancelar");
        
        }

}




function deleteSesions(id)
{

    var cue = $("#idSes").val();
    
    var opcion = confirm("¿Estas seguro de eliminar el registro ?");
    if (opcion == true) {
       
       $.ajax({
            type: "POST",
            dataType: 'html',
            url: "./Controlador/controllerProcedimientos.php?function=deleteSesions",
            data: "id="+id,
            success: function(resp){
                    var id = getParameterByName('id');
                    CargarSesiones(cue);
                }
            }); 
	    } else {
        //alert("Has clickado Cancelar");
        
        }

}


        function insertProc()
        {
        
            var sel = $("#cant").val();
            var rebi = $("#valor").val();
            var resul = parseInt(sel) * parseFloat(rebi);
            $("#totalp").val(parseFloat(resul).toFixed(2));

        
            var info = $("#formPrc").serialize();
            var codCpt = $("#codCpt").val();
            var cant = $("#cant").val();


            if(cant=="" ){

                alert("Falta ingresar cantidad");
                $("#cant").focus();
            
            }else{
            
                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: "./Controlador/controllerProcedimientos.php?function=insertProc",
                    data: info,
                    
                    success: function(resp){               
                    
                        //alert(resp);
                        if(resp=="ENCONTRADO"){

                            //$('#formPrc')[0].reset();

                            $("#desCpt").val("");
                            $("#cant").val("");
                            $("#codCpt").val("");
                            $("#totalp").val("");
                            $("#valor").val("");
                            alert("Código CPMS ya se encuentra registrado.");
                           // ObtenerTitulo(codCpt)
                          
                        }else{

                            $('#formPrc')[0].reset();                
                          //  $('#cerraPrc').click();
                          
                           
                            var id = getParameterByName('id');
                            $("#idpresPro").val(id);
                            Cargar1(id);
                            setTimeout(function (){
                                $("#codCpt").focus();
                            }, 500);
                           

                        }
                    }
                });
                
            }   
        } 



        function insertProcAuto()
        {
        

            var idpresProAuto = $("#idpresProAuto").val();
            var info = $("#formPrcAuto").serialize();
            var codCpt = $("#codCptAuto").val();
            var cant = $("#cantAuto").val();

            if(cant=="" ){

                alert("Falta ingresar cantidad");
            
            }else{
            
                $.ajax({
                    type: "POST",
                    dataType: 'html',
                    url: "./Controlador/controllerProcedimientos.php?function=insertProcAuto",
                    data: info,
                    
                    success: function(resp){               
                    
                        //alert(resp);
                        if(resp=="ENCONTRADO"){

                            $('#formPrcAuto')[0].reset();
                            $("#idpresProAuto").val(idpresProAuto);
                            alert("El procedimiento "+ codCpt +" ya se encuentra registrado.");
                          
                        }else{

                            $('#formPrcAuto')[0].reset();                
                            $('#cerraPrc').click();
                            var id = getParameterByName('id');
                            CargarAuto1(id);
                           
                        }
                    }
                });
                
            }   
        } 

            function EliminarPr(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=eliminarPr",
                                data: "id="+id,
                                success: function(resp){
                                    var id = getParameterByName('id');
                                    CargarProcedimientos(id);
                                    Cargar1(id);
                                    Cargar2(id);
                                    Cargar3(id);
                                    Cargar4(id);
                                    Cargar5(id);
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
            
            function eliminarCpmsHnal(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=eliminarCpmsHnal",
                                data: "id="+id,
                                success: function(resp){
                                   $('#pac3').DataTable().ajax.reload(null, false);
                                   
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
            
             function revertirCEHnal(id)
            {

                
                var opcion = confirm("¿Estas seguro de revertir el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=revertirCEHnal",
                                data: "id="+id,
                                success: function(resp){
                                   $('#pac3').DataTable().ajax.reload(null, false);
                                   
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
            
            function eliminarRegEmerHospi(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=eliminarRegEmergHospi",
                                data: "id="+id,
                                success: function(resp){
                                   $('#pac3Emer').DataTable().ajax.reload(null, false);
                                   
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
            
            function deleteRegCirugia(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=eliminarRegCirugia",
                                data: "id="+id,
                                success: function(resp){
                                   $('#pac3Emer').DataTable().ajax.reload(null, false);
                                   
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
            
            
            function eliminarRegReferencias(id)
            {

                
                var opcion = confirm("¿Estas seguro de anular el registro ?");
                
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=eliminarRegReferencias",
                                data: "id="+id,
                                success: function(resp){
                                   $('#tableReferenciasXd').DataTable().ajax.reload(null, false);
                                   
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
            
            
            
             function deleteDxHist(id)
                {
    
                    
                            $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=eliminarDxHists",
                                    data: "id="+id,
                                    success: function(resp){
                                       $('#tbl_dx').DataTable().ajax.reload(null, false);
                                       
                                }
                            }); 
                            
                       
                       
    
                }
                
                
                function deleteDxPreop(id)
                {
    
                    
                            $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=eliminarDxPreoPer",
                                    data: "id="+id,
                                    success: function(resp){
                                       $('#tbl_dxPre').DataTable().ajax.reload(null, false);
                                       
                                }
                            }); 
                            
                       
                       
    
                }
                
                
                function deleteDxPostoPer(id)
                {
    
                    
                            $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=eliminarDxPostOper",
                                    data: "id="+id,
                                    success: function(resp){
                                       $('#tbl_dxPost').DataTable().ajax.reload(null, false);
                                       
                                }
                            }); 
                            
                       
                       
    
                }
                
                
                 function deleteIntevencReal(id)
                {
    
                    
                            $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=eliminarAIntervAsis",
                                    data: "id="+id,
                                    success: function(resp){
                                       $('#tbl_inter').DataTable().ajax.reload(null, false);
                                       
                                }
                            }); 
                            
                       
                       
    
                }
                
                 function deleteCirujAsist(id)
                {
    
                    
                            $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=eliminarCiruAsis",
                                    data: "id="+id,
                                    success: function(resp){
                                       $('#tbl_asist').DataTable().ajax.reload(null, false);
                                       
                                }
                            }); 
                            
                       
                       
    
                }
                
                 function deleteTratHist(id)
                {
    
                    
                            $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=eliminarTratHists",
                                    data: "id="+id,
                                    success: function(resp){
                                       $('#tbl_trat').DataTable().ajax.reload(null, false);
                                       
                                }
                            }); 
                            
                       
                       
    
                }
                
                function deleteExamnHist(id)
                {
    
                    
                            $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=deleteExamnHist",
                                    data: "id="+id,
                                    success: function(resp){
                                       $('#tbl_pro').DataTable().ajax.reload(null, false);
                                       $('#tbl_lab').DataTable().ajax.reload(null, false);
                                       $('#tbl_img').DataTable().ajax.reload(null, false);
                                       
                                }
                            }); 
                            
                       
                       
    
                }
            
            function deleteSignosSitm(id)
                {
    
                    
                            $.ajax({
                                    type: "POST",
                                    dataType: 'html',
                                    url: "./Controlador/controllerProcedimientos.php?function=deleteSignosSinto",
                                    data: "id="+id,
                                    success: function(resp){
                                       $('#tbl_sin').DataTable().ajax.reload(null, false);
                                       
                                }
                            }); 
                            
                       
                       
    
                }
            
            function eliminarFuaHnal(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=eliminarFuaHnal",
                                data: "id="+id,
                                success: function(resp){
                                   $('#pac3EmerCE').DataTable().ajax.reload(null, false);
                                   
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
            
            function eliminarPacHnal(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ? Se eliminarán todos los registros internos");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=deletPackHnal",
                                data: "id="+id,
                                success: function(resp){
                                   $('#pac3grupo').DataTable().ajax.reload(null, false);
                                   
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
            
            
            function deleteDesigFuas(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=deleteDesignFuas",
                                data: "id="+id,
                                success: function(resp){
                                   $('#tblDesig').DataTable().ajax.reload(null, false);
                                   
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
            
            
            
            function deleteCajas(id)
            {

                var tik = getParameterByName('id');
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=deleteCjasPa",
                                data: "id="+id,
                                success: function(resp){
                                   CargarListadoCajas(0,tik);
                                   
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
            
            function eliminarAsignacionCe(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar la fecha asignada ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=limpiarAsignaci",
                                data: "id="+id,
                                success: function(resp){
                                   $('#pac3EmerCE').DataTable().ajax.reload(null, false);
                                   
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
            
            
            function eliminarRecepcionCe(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar la fecha recepcionada ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=recepcionAoc",
                                data: "id="+id,
                                success: function(resp){
                                   $('#pac3EmerCE').DataTable().ajax.reload(null, false);
                                   
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }

            function EliminarPrAuto(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerProcedimientos.php?function=eliminarPrAuto",
                                data: "id="+id,
                                success: function(resp){
                                    var id = getParameterByName('id');
                                    CargarAuto1(id);
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }

            function insertInsumos()
            {
            

                var info = $("#formInsu").serialize();
                var HistCli = $("#HistCli").val();
                var tipotras = $("#tipotras").val();

                if(HistCli=="" && tipotras=="" ){

                    alert("Debes llenar todos los campos vacios");
                
                }else{
                
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerInsumos.php?function=insertarInsumos",
                        data: info,
                        
                        success: function(resp){               
                        
                            $('#formInsu')[0].reset();                
                            $('#cerraInsu').click();
                            var id = getParameterByName('id');
                            CargarInsumos(id);
                        
                        }
                    });
                    
                }   
            } 


            function insertInsumosAuto()
            {
            

                var info = $("#formInsuAuto").serialize();
                var HistCli = $("#HistCliAuto").val();
                var tipotras = $("#tipotrasAuto").val();

                if(HistCli=="" && tipotras=="" ){

                    alert("Debes llenar todos los campos vacios");
                
                }else{
                
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerInsumos.php?function=insertarInsumosAuto",
                        data: info,
                        
                        success: function(resp){               
                        
                            $('#formInsuAuto')[0].reset();                
                            $('#cerraInsu').click();
                            var id = getParameterByName('id');
                            CargarAuto2(id);
                        
                        }
                    });
                    
                }   
            } 

            

            function EliminarInsu(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerInsumos.php?function=eliminarIn",
                                data: "id="+id,
                                success: function(resp){
                                    var id = getParameterByName('id');
                                    CargarInsumos(id);
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }


            
            function EliminarInsuAuto(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerInsumos.php?function=eliminarInAuto",
                                data: "id="+id,
                                success: function(resp){
                                    var id = getParameterByName('id');
                                    CargarAuto2(id);
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }

            function insertMedics()
            {
            

                var info = $("#formMed").serialize();
                var HistCli = $("#HistCli").val();
                var tipotras = $("#tipotras").val();

                if(HistCli=="" && tipotras=="" ){

                    alert("Debes llenar todos los campos vacios");
                
                }else{
                
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerMedicamentos.php?function=insertarMedicamts",
                        data: info,
                        
                        success: function(resp){               
                        
                            $('#formMed')[0].reset();                
                            $('#cerraMed').click();
                            var id = getParameterByName('id');
                            CargarMedicamentos(id);
                        
                        }
                    });
                    
                }   
            } 


            function insertMedicsAuto()
            {
            

                var info = $("#formMedAuto").serialize();
                var HistCli = $("#HistCliAuto").val();
                var tipotras = $("#tipotrasAuto").val();

                if(HistCli=="" && tipotras=="" ){

                    alert("Debes llenar todos los campos vacios");
                
                }else{
                
                    $.ajax({
                        type: "POST",
                        dataType: 'html',
                        url: "./Controlador/controllerMedicamentos.php?function=insertarMedicamtsAuto",
                        data: info,
                        
                        success: function(resp){               
                        
                            $('#formMedAuto')[0].reset();                
                            $('#cerraMed').click();
                            var id = getParameterByName('id');
                            CargarAuto3(id);
                        
                        }
                    });
                    
                }   
            } 


            function EliminarMedt(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerMedicamentos.php?function=eliminarMet",
                                data: "id="+id,
                                success: function(resp){
                                    var id = getParameterByName('id');
                                    CargarMedicamentos(id);
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }


            function EliminarMedtAuto(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/controllerMedicamentos.php?function=eliminarMetAuto",
                                data: "id="+id,
                                success: function(resp){
                                    var id = getParameterByName('id');
                                    CargarAuto3(id);
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }


            function EliminarRegis(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/registro.php?function=eliminarReg",
                                data: "id="+id,
                                success: function(resp){
                                    var reb = getParameterByName('pagina');
                                    var pte = getParameterByName('pte');
                                 //   CargarCon(reb,pte);
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }


            function EliminarRegisCarta(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/registro.php?function=eliminarRegCarta",
                                data: "id="+id,
                                success: function(resp){
                                    CargarCartax();  
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }

            function EliminaCuentas(id)
            {

                
                var opcion = confirm("¿Estas seguro de eliminar el registro ?");
                if (opcion == true) {
                
                        $.ajax({
                                type: "POST",
                                dataType: 'html',
                                url: "./Controlador/registro.php?function=eliminarCuenx",
                                data: "id="+id,
                                success: function(resp){
                                    var ier = $("#ideC").val();
                                    CargarCuentas(ier);  
                            }
                        }); 
                    } else {
                    //alert("Has clickado Cancelar");
                    }

            }
    
              function ObtenerCie10(){
    
                $.ajax({
                    url:'./Controlador/search.php?function=cie10',
                    type:'GET',
                    dataType:'json',
                    data:{ cie10:$('#codDx').val()}
                    
                }).done(function(datos){
                    
                    $("#descripcion").val(datos[0]);
                 
                });
                
              };

              function ObtenerTitulo(id){
    
                $.ajax({
                    url:'./Controlador/search.php?function=titulo',
                    type:'GET',
                    dataType:'json',
                    data:{ id: id}
                    
                }).done(function(datos){
                    
                        if(datos[0]==1){
                                alert("El procedimiento se encuentra registrado en HOSPITALIZACIÓN - CONSULTAS E INTERCONSULTAS");
                        }else if(datos[0]==2){
                                alert("El procedimiento se encuentra registrado en PROCEDIMIENTOS MEDICO - QUIRÚRGICOS");
                        }else if(datos[0]==3){
                                alert("El procedimiento se encuentra registrado en PROCEDIMIENTOS DE PATOLOGIA CLINICA-GENÉTICA - ANATOMIA PATOLOGICA");
                        }else if(datos[0]==4){
                                alert("El procedimiento se encuentra registrado en PROCEDIMIENTOS RADIOLÓGICOS Y RADIOLOGIA INTERVENCIONISTA");
                        }else{
                                alert("El procedimiento se encuentra registrado en PROCEDIMIENTOS BANCO DE SANGRE");
                        }

                   // $("#codCpt").val(datos[0]);
                 
                });
                
              };

              function ObtenerCpt(){
    
                $.ajax({
                    url:'./Controlador/search.php?function=cptpol',
                    type:'GET',
                    dataType:'json',
                    data:{ codCpt:$('#codCpt').val()}
                    
                }).done(function(datos){
                    
                    $("#desCpt").val(datos[0]);
                    $("#valor").val(datos[1]);
                 
                });
                
              };


              function ObtenerCptAuto(){
    
                $.ajax({
                    url:'./Controlador/search.php?function=cptpol',
                    type:'GET',
                    dataType:'json',
                    data:{ codCpt:$('#codCptAuto').val()}
                    
                }).done(function(datos){
                    
                    $("#desCptAuto").val(datos[0]);
                    $("#valorAuto").val(datos[1]);
                 
                });
                
              };


              function ObtenerDesx(){
    
                $.ajax({
                    url:'./Controlador/search.php?function=cptpolDes',
                    type:'GET',
                    dataType:'json',
                    data:{ desCpt:$('#desCpt').val()}
                    
                }).done(function(datos){
                    
                    $("#codCpt").val(datos[0]);
                    $("#valor").val(datos[1]);
                 
                });
                
              };
              

              
              function ObtenerDesxAut(){
    
                $.ajax({
                    url:'./Controlador/search.php?function=cptpolDes',
                    type:'GET',
                    dataType:'json',
                    data:{ desCpt:$('#desCptAuto').val()}
                    
                }).done(function(datos){
                    
                    $("#codCptAuto").val(datos[0]);
                    $("#valorAuto").val(datos[1]);
                 
                });
                
              };

              function ObtenerIns(){
    
                $.ajax({
                    url:'./Controlador/search.php?function=Ins',
                    type:'GET',
                    dataType:'json',
                    data:{ codSismed:$('#codSismed').val()}
                    
                }).done(function(datos){
                    
                    $("#des").val(datos[0]);
                    $("#valori").val(datos[1]);
                 
                });
                
              };

              function ObtenerInsAuto(){
    
                $.ajax({
                    url:'./Controlador/search.php?function=Ins',
                    type:'GET',
                    dataType:'json',
                    data:{ codSismed:$('#codSismedAuto').val()}
                    
                }).done(function(datos){
                    
                    $("#desAuto").val(datos[0]);
                    $("#valoriAuto").val(datos[1]);
                 
                });
                
              };


              function ObtenerMed(){
    
                $.ajax({
                    url:'./Controlador/search.php?function=Med',
                    type:'GET',
                    dataType:'json',
                    data:{ codSisMx:$('#codSisMx').val()}
                    
                }).done(function(datos){
                    
                    $("#desMed").val(datos[0]);
                    $("#valoriMed").val(datos[1]);
                 
                });
                
              };


              function ObtenerMedAuto(){
    
                $.ajax({
                    url:'./Controlador/search.php?function=Med',
                    type:'GET',
                    dataType:'json',
                    data:{ codSisMx:$('#codSisMxAuto').val()}
                    
                }).done(function(datos){
                    
                    $("#desMedAuto").val(datos[0]);
                    $("#valoriMedAuto").val(datos[1]);
                 
                });
                
              };


              function calcularDias(fecha,hoy) {
                
                         
                          var fechaI = new Date(hoy);
                          var fechaF = new Date(fecha);
                          var tiempo = fechaI.getTime() - fechaF.getTime();
                         
                          var dias = Math.floor(tiempo / (1000 * 60 * 60 * 24));
                          var valid = '';
                          
                          if(dias>=180){
                              
                            alert("Paciente requiere corte administrativo");
                            
                          }
                          
                          var er ='';
                          if(tiempo==0){
                                er=1;
                          }else{
                                er=dias + 1;
                          }
                          
                          //return dias + 2 ;
                           return er ;
               
                }
            
            
            
              function calcularDiasAlta(fecha,hoy) {
                
                         
                          var fechaI = new Date(hoy);
                          var fechaF = new Date(fecha);
                          var tiempo = fechaF.getTime() - fechaI.getTime();
                         
                          var dias = Math.floor(tiempo / (1000 * 60 * 60 * 24));
                          var valid = '';
                          
                          if(dias>=180){
                              
                            alert("Paciente requiere corte administrativo");
                            
                          }
                          
                          
                          
                           var er ='';
                          if(tiempo==0){
                                er=1;
                          }else{
                                er=dias + 1;
                          }
                          
                          //return dias + 2 ;
                           return er ;
                         // return dias + 1 ;
               
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
        
                return edad + "A " + meses + "M " + dias + "D ";
               // return edad + " A " + meses + " meses";
            }
            
            
            
            function calcularEdadRegistroHospiEmer(fecha) {
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
        
                return edad + "";
               // return edad + " A " + meses + " meses";
            }
            
                  
        
            function handler(e){
                
               
                     var actual = new Date(e.target.value);
                     var dias = 360;
                     actual.setDate(actual.getDate() + dias);
                     var twonth = ((actual.getMonth()< 9 ? '0': '') + (actual.getMonth()+1));
                     var tDate = ((actual.getDate()< 9 ? '0': '') + (actual.getDate()+1));
                     var currentDate = actual.getFullYear() + "-" + twonth + "-" + tDate;  
                     $("#fevigencia").val(currentDate);

            }
            
            
            
            
            function handlerDias(e){
                
                        var alta = $("#feAltaAlt").val(); 
                        var fecha_hoy ='';
                        
                        if(alta==""){
                            fecha_hoy  = new Date();
                        }else{
                            fecha_hoy= alta
                        }
                
                      //var fecha_hoy = new Date();
                      var actual = e.target.value;
                      //alert(actual);
                      var res = calcularDias(actual,fecha_hoy);
                        
                        $("#estaDias").val(res);


            }
            
            
            function handlerDiasSave(){
                
                        var alta = $("#feAltaAlt").val(); 
                        var feingre = $("#feingre").val();
                        var fecha_hoy ='';
                        
                        if(alta==""){
                            fecha_hoy  = new Date();
                        }else{
                            fecha_hoy= alta
                        }
                
                      
                      var actual = feingre;
                      var res = calcularDias(actual,fecha_hoy);
                        
                        $("#estaDias").val(res);


            }
            
        
            
             function handlerDiasAlta(e){
                
                        var alta = $("#feingre").val(); 
                        var fealt = alta.substr(0, alta.length-6);
                       var fecha_hoy ='';
                        
                        if(fealt==""){
                            fecha_hoy  = new Date();
                        }else{
                            fecha_hoy= fealt
                        }
                
                      
                      var actual = e.target.value;
                      var res = calcularDiasAlta(actual,fecha_hoy);
                        
                        $("#estaDias").val(res);


            }
            

            function handlerEdad(e){
                
                
                    /* var actual = new Date(e.target.value);
                     calcularEdad(actual);
                     alert(calcularEdad(actual));
                     var dias = 360;
                     actual.setDate(actual.getDate() + dias);
                     var twonth = ((actual.getMonth()< 9 ? '0': '') + (actual.getMonth()+1));
                     var tDate = ((actual.getDate()< 9 ? '0': '') + (actual.getDate()+1));
                     var currentDate = actual.getFullYear() + "-" + twonth + "-" + tDate;  
                     $("#edad").val(currentDate);*/

                        var actual = e.target.value;
                        var res = calcularEdad(actual);
                        
                        $("#edadCE").val(res);

            }
            
            
            
            function handlerFeNacEmer(e){
                
                
                        var actual = e.target.value;
                        var res = calcularEdad(actual);
                        
                        $("#edad").val(res);

            }

            function handlerEdadQuimio(e){
                
                        var actual = e.target.value;
                        var res = calcularEdad(actual);
                        
                        $("#edadQuimi").val(res);

            }


            