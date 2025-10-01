window.onload = function () {

	
        var reb = getParameterByName('pagina');
        var pte = getParameterByName('pte');
        CargarPacientes(reb,pte);
        //Cargar2(reb);Cargar3(reb);Cargar4(reb);
        CargarUsuarios();
   
}


  

function getParameterByName(name) {
          
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}
  
   

function RegistrarPaciente()
{
  

    var info = $("#formPaciente").serialize();
    
    var NroDoc = $("#NroDoc").val();  

    if(NroDoc==""){

        alert("Debes llenar todos los campos vacios de DATOS DEL PACIENTE");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "registro.php?function=RegistroPaciente",
            data: info,
            

            success: function(resp){               
               
                $('#formPaciente')[0].reset();                
                $('#cerrar').click();
                var reb = getParameterByName('pagina');
                var pte = getParameterByName('pte');
                CargarPacientes(reb,pte);
               
            }
        });
        
    }   
} 


function RegistrarUsuario()
{
  
    var info = $("#formUsuario").serialize();
    var nomusu = $("#nomusu").val();  
    var apeusu = $("#apeusu").val();  
    var emailusu = $("#emailusu").val();  
    var rolusu = $("#rolusu").val();  
    var userusu = $("#userusu").val();  
    var password = $("#password").val();  
    var estadousu = $("#estadousu").val();  

    if(nomusu==""){

        alert("Debes llenar todos los campos vacios");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "registro.php?function=RegistroUsuario",
            data: info,
    
            success: function(resp){               
               
                $('#formUsuario')[0].reset();                
                $('#cerrarusuario').click();
                CargarUsuarios();
               
            }
        });
        
    }   
}  



function RegistrarPre()
{
  

    var info = $("#formpre").serialize();
    var HistCli = $("#HistCli").val();
    var tipotras = $("#tipotras").val();

    if(HistCli=="" && tipotras=="" ){

        alert("Debes llenar todos los campos vacios");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "registro.php?function=RegistroPre",
            data: info,
            
            success: function(resp){               
               
                $('#formpre')[0].reset();                
                $('#cerrarpre').click();
                /*var reb = getParameterByName('pagina');
                var pte = getParameterByName('pte');
                CargarPacientes(reb,pte);*/
               
            }
        });
        
    }   
}  




function RegistrarPost()
{
  

    var info = $("#formpost").serialize();
    var espost = $("#espost").val();
    var oficiopost = $("#oficiopost").val();

    if(espost=="" && oficiopost=="" ){

        alert("Debes llenar todos los campos vacios");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "registro.php?function=RegistroPost",
            data: info,
            
            success: function(resp){               
               
                $('#formpost')[0].reset();                
                $('#cerrarpost').click();
                              
            }
        });
        
    }   
} 

function RegistrarDona()
{
  

    var info = $("#formdonante").serialize();
    var nodona = $("#nodona").val();
    var apedona = $("#apedona").val();
    var idodn= $("#iddona").val();

    if(nodona=="" && apedona=="" ){

        alert("Debes llenar todos los campos vacios");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "registro.php?function=RegistroDona",
            data: info,
            
            success: function(resp){               
               
                $('#formdonante')[0].reset();
                CargarDonantes(idodn);
              
               
            }
        });
        
    }   
}  



function LimpiarForm(){
    $('#formPaciente')[0].reset(); 
}

function LimpiarFormPost(){
    $('#formpost')[0].reset(); 
}

function LimpiarFormPre(){
    $('#formpre')[0].reset(); 
}


function LimpiarFormDona(){
    $('#formdonante')[0].reset(); 
}

function RegistrarResponsable()
{

    var cuenta = $("#cuenta").val();
    var ide = $("#ide").val();
    var dnires = $("#dnires").val();
    var nombreres = $("#nombreres").val();
    var apepatres = $("#apepatres").val();
    var apematres = $("#apematres").val();
    var profesion = $("#profesion").val();
    var colegiatura = $("#colegiatura").val();
    var especialidad = $("#especialidad").val();
    var nrorne = $("#nrorne").val();
    var elert = dnires+"-"+cuenta+"-"+nombreres+"-"+apepatres+"-"+apematres
        
    if(elert=="----"){

        alert("Debes registrar NRO CUENTA Y/O DATOS DEL RESPONSABLE DE ATENCION");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "registro.php?function=RegistroResponsable",
            data: "ide="+ide+"&dnires="+dnires+"&cuenta="+cuenta+"&nombreres="+nombreres+"&apepatres="+apepatres+"&apematres="+apematres+"&profesion="+profesion+"&colegiatura="+colegiatura+"&especialidad="+especialidad+"&nrorne="+nrorne,

            success: function(resp){
                
                DeshabilitarResponsable();
            }
        });
        
      
    } 
   
}  


function RegistrarDiagnostico()
{

    var cuenta = $("#cuenta").val();
    var ide = $("#ide").val();
    var cie10 = $("#cie10").val();
    var descri = $("#descri").val();
    var ingreso = $("#ingreso").val();
    var tipoAt = $("#tipoAt").val();
        
    if(cuenta=="" && cie10==""){

        alert("Debes digitar CODIGO CIE10");
       
    }else{
       
        $.ajax({
            type: "POST",
            dataType: 'html',
            url: "registro.php?function=RegistroCie10",
            data: "ide="+ide+"&tipoAt="+tipoAt+"&cie10="+cie10+"&cuenta="+cuenta+"&descri="+descri+"&ingreso="+ingreso,

            success: function(resp){
                CargarDiagnostico(cuenta);
    
            }
        });
        
      
    } 
   
}  



function EliminarDiagnostico($cod)
{

    
    var cod= $cod;
    var tipo="diagnostico";
    var cuenta = $("#cuenta").val();
   

   $.ajax({
        type: "POST",
        dataType: 'html',
        url: "Eliminar.php",
        data: "cod="+cod+"&tipo="+tipo,
        success: function(resp){
            CargarDiagnostico(cuenta);
        }
    }); 

}



function EliminarDona($cod)
{

    
    var opcion = confirm("¿Estas seguro de eliminar el registro?");
    if (opcion == true) {
        var cod= $cod;
        var tipo="donante";
        var iddona = $("#iddona").val();
    
       $.ajax({
            type: "POST",
            dataType: 'html',
            url: "Eliminar.php",
            data: "cod="+cod+"&tipo="+tipo,
            success: function(resp){
                CargarDonantes(iddona);
            }
        }); 
	} else {
	    //alert("Has clickado Cancelar");
	}


    
    

}





function Close()
{
    $('.alert').css("display","none");

}

function CargarPacientes($page,$pte)
{
    $('#datagrid').load('consultaPacientes.php?pagina='+$page+'&pte='+$pte);
    

}

function CargarUsuarios()
{
    $('#datagridusuarios').load('consultaUsuarios.php');
    

}


function CargarDonantes($id)
{
    $('#datagridDona').load('consultaDonantes.php?id='+$id);
    

}

function Cargar2($numerecibo)
{
    $('#datagrid2').load('consulta2.php?number='+$numerecibo);   

}
function Cargar3($numerecibo)
{
    $('#datagrid3').load('consulta3.php?number='+$numerecibo);   

}
function Cargar4($numerecibo)
{
    $('#datagrid4').load('consulta4.php?number='+$numerecibo);   

}



function DeshabilitarPaciente()
{
   
    $("#cuenta").attr("readonly","readonly");
    $("#nombres").attr("readonly","readonly");
    $("#apepa").attr("readonly","readonly");
    $("#apema").attr("readonly","readonly");
    $("#tipo").attr("disabled","disabled");
    $("#dni").attr("readonly","readonly");
    $("#fena").attr("readonly","readonly");
    $("#sexo").attr("disabled","disabled");
    $("#historia").attr("readonly","readonly");
    $("#GuardarPaciente").addClass("hidden");
}

function DeshabilitarResponsable()
{
   

    
    $("#dnires").attr("readonly","readonly");
    $("#nombreres").attr("readonly","readonly");
    $("#apepatres").attr("readonly","readonly");
    $("#apematres").attr("readonly","readonly");
    $("#profesion").attr("readonly","readonly");
    $("#colegiatura").attr("readonly","readonly");
    $("#especialidad").attr("readonly","readonly");
    $("#nrorne").attr("readonly","readonly");
    $("#GuardarResponsable").addClass("hidden");
}



$(document).ready(function() {
    $('#cuenta').keypress(function (tecla) {
 
        if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
            return false;
        }else {
                 var len   = $('#cuenta').val().length;
                 var index = $('#cuenta').val().indexOf('.');
    
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


    $('#dni').keypress(function (tecla) {
 
        if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
            return false;
        }else {
                 var len   = $('#dni').val().length;
                 var index = $('#dni').val().indexOf('.');
    
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

    $('#historia').keypress(function (tecla) {
 
        if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) && (tecla.charCode != 8)) {
            return false;
        }else {
                 var len   = $('#historia').val().length;
                 var index = $('#historia').val().indexOf('.');
    
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

    
    $('.auto').keypress(function (tecla) {
 
        if ((tecla.charCode < 48 || tecla.charCode > 57) && (tecla.charCode != 46) 
        && (tecla.charCode != 8)) {
            return false;
            
        }else {
                 var len   = $('.auto').val().length;
                 var index = $('.auto').val().indexOf('.');
    
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


       $(".auto").autocomplete({
            source: "Modelo/search.php?function=paciente",
            minLength: 1,
            select: function( event, ui ) {
                return false;
            }
            
        }); 

        $(".dniauto").autocomplete({
            source: "Modelo/search.php?function=responsable",
            minLength: 1,
            select: function( event, ui ) {
                return false;
            }
            
        }); 

        $("#profesion").autocomplete({
            source: "Modelo/search.php?function=profesion",
            minLength: 1,
            select: function( event, ui ) {
                return false;
            }
            
        }); 

        $("#especialidad").autocomplete({
            source: "Modelo/search.php?function=especial",
            minLength: 1,
            select: function( event, ui ) {
                return false;
            }
            
        }); 


        $("#cargar").click(function(){
            $.ajax({
                    url:'Modelo/search.php?function=datos',
                    type:'GET',
                    dataType:'json',
                    data:{ dnires:$('#dnires').val()}
  
                }).done(function(datos){
                    
                    $("#apepatres").val(datos[1]);
                    $("#apematres").val(datos[2]);
                    $("#nombreres").val(datos[3]);
                    $("#colegiatura").val(datos[4]);
                    $("#especialidad").val(datos[5]);
                    $("#profesion").val(datos[6]);
                    $("#nrorne").val(datos[7]);
                    
                });
          });
         

          $("#cargarcie10").click(function(){
            
            $.ajax({
                    url:'Modelo/search.php?function=cie10',
                    type:'GET',
                    dataType:'json',
                    data:{ cie10:$('#cie10').val()}
                    
                }).done(function(datos){
                    
                    $("#descri").val(datos[0]);
                 
                });
          });




          $("#cargaDni").click(function(){
          
                $.ajax({
                    url:'Modelo/search.php?function=dni',
                    type:'GET',
                    dataType:'json',
                    data:{ NroDoc:$('#NroDoc').val()             
                },                    
                }).done(function(datos){
                    $("#tipoDoc").val(datos[0]);
                    $("#ippress").val(datos[1]);
                    $("#sexo").val(datos[2]);
                    $("#tipoAf").val(datos[3]);
                    $("#NroAf").val(datos[4]);
                    $("#nombres").val(datos[5]);
                    $("#apepa").val(datos[6]);
                    $("#apema").val(datos[7]);
                    $("#direccion").val(datos[8]);
                    $("#FechaNac").val(datos[9]);
                    $("#edad").val(datos[10]);
                    $("#telefa").val(datos[11]);                    
                    $("#dnipapa").val(datos[12]);
                    $("#dnimama").val(datos[13]);

                 
                });
          });
    
});



/* DATOS DE COBRANZA */ 



function RegistrarCobranza()
{

    var numerecibo = $("#numerecibo").val();
    var senores = $("#senores").val();
    var direc = $("#direc").val();
    var obs = $("#obs").val();
    var fe_re = $("#fe_re").val();
    var total = $("#total").val();
    var email = $("#email").val();
    var moneda = $("#moneda").val();
    var iduser = $("#iduser").val();
    
   

    var idelis = $("#idelis").val();
    var can = $("#cantidad").val();
    var descrip = $("#descri").val();
    var descri = "<pre >" + descrip + "</pre>";
    var unit = $("#unit").val();
    var imp = $("#imp").val();

    
    //$("#respuesta").html("<img src="loader.gif" /> Por favor espera un momento");
    $.ajax({
        type: "POST",
        dataType: 'html',
        url: "registroCobranza.php",
        data: "idelis="+idelis+"&cantidad="+can+"&descri="+descri+"&unit="+unit+"&imp="+imp+"&numerecibo="+numerecibo+"&senores="+senores+"&direc="+direc+"&obs="+obs+"&fe_re="+fe_re+"&total="+total+"&email="+email+"&moneda="+moneda+"&iduser="+iduser,
        
        success: function(resp){
            $('#respuesta').html(resp);
            LimpiarCobranza();
            CargarCobranza(numerecibo);
        }
    });
}  



function EliminarCobranza($cod)
{

    
    var cod= $cod;
    var lista="cobranza";
    var numerecibo = $("#numerecibo").val();
   

   $.ajax({
        type: "POST",
        dataType: 'html',
        url: "Eliminar.php",
        data: "cod="+cod+"&tipo="+lista,
        success: function(resp){
            //$('#respuesta').html(resp);
            LimpiarCobranza();
            CargarCobranza(numerecibo);
        }
    }); 

}



function GuardarCobranza()
{

    var numerecibo = $("#numerecibo").val();
    var senores = $("#senores").val();
    var direc = $("#direc").val();
    var obs = $("#obs").val();
    var fe_re = $("#fe_re").val();
    var total = $("#total").val();
    var email = $("#email").val();
    var moneda = $("#moneda").val();
    var iduser = $("#iduser").val();

   $.ajax({
        type: "POST",
        dataType: 'html',
        url: "registroCobranza.php",
        data: "numerecibo="+numerecibo+"&senores="+senores+"&direc="+direc+"&obs="+obs+"&fe_re="+fe_re+"&total="+total+"&email="+email+"&moneda="+moneda+"&iduser="+iduser,

        success: function(resp){
        
            if(senores!="" && direc!="" && obs!="" && fe_re!="" && total!=""){
                     $('.alert').css("display","block");
                     LimpiarCobranza();
                     CargarCobranza(numerecibo);
            }

        }


    }); 

    

}  


function Close()
{
    $('.alert').css("display","none");

}

function CargarCobranza($numerecibo)
{
    $('#datagrid').load('consultaCobranza.php?number='+$numerecibo);   

}
function LimpiarCobranza()
{
   
    
    $("#cantidad").val("");
    $("#descri").val("");
    $("#unit").val("");
    $("#imp").val("");
}





/* DATOS DE COTIZACION */ 




function GuardarCotizacion()
{

    var numerecibo = $("#numerecibo").val();
    var senores = $("#senores").val();
    var direc = $("#direc").val();
    var obs = $("#obs").val();
    var fe_re = $("#fe_re").val();
    var total = $("#total").val();
    var email = $("#email").val();
    var moneda = $("#moneda").val();
    var iduser = $("#iduser").val();

   $.ajax({
        type: "POST",
        dataType: 'html',
        url: "registroCotizacion.php",
        data: "numerecibo="+numerecibo+"&senores="+senores+"&direc="+direc+"&obs="+obs+"&fe_re="+fe_re+"&total="+total+"&email="+email+"&moneda="+moneda+"&iduser="+iduser,

        success: function(resp){
        
            if(senores!="" && direc!="" && obs!="" && fe_re!="" && total!=""){
                     $('.alert').css("display","block");
                     LimpiarCotizacion();
                     CargarCotizacion(numerecibo);
            }

        }


    }); 

    

}  


function Close()
{
    $('.alert').css("display","none");

}

function CargarCotizacion($numerecibo)
{
    $('#datagrid').load('consultaCotizacion.php?number='+$numerecibo);   

}
function LimpiarCotizacion()
{
   
    
    $("#cantidad").val("");
    $("#descri").val("");
    $("#unit").val("");
    $("#imp").val("");
}













$(document).ready(function(){
    $( "#cliente" ).autocomplete({
      source: "buscaralumno.php",
      minLength: 2
    });
 
    
    $("#matricula").focusout(function(){
      $.ajax({
            url:'alumno.php',
          type:'POST',
          dataType:'json',
          data:{ matricula:$('#matricula').val()}
      }).done(function(respuesta){
          $("#nombre").val(respuesta.nombre);
          $("#paterno").val(respuesta.paterno);
          $("#materno").val(respuesta.materno);
      });
    });
});
