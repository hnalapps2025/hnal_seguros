
function cargarDepartamento() {
    
    $.post('./Modelo/departamento.php', 	
     function(data){
		
			if (data != "[]") {
		        var item = $.parseJSON(data);
		        
				$("#departamento").append('<option value="">-- Seleccionar --</option>');
		        $.each(item, function (i, valor) {
		            
		            if (valor.id !== null) {
					    $("#departamento").append('<option value="' + valor.idDepartamento + '">' + valor.departamento + '</option>');	
					    
					}
		        });
		    }
		return false;
    });
}



function cargarProvincia(depa) {
    
    $.post('./Modelo/provincia.php', {depa : depa}, 	
     function(data){
		
			if (data != "[]") {
		        var item = $.parseJSON(data);
		        
				$("#provincia").append('<option value="">-- Seleccionar --</option>');
		        $.each(item, function (i, valor) {
		            
		            if (valor.idProvincia !== null) {
					    $("#provincia").append('<option value="' + valor.idProvincia + '">' + valor.provincia + '</option>');	
					}
		        });
		    }
		return false;
    });
}

function cargarDistrito(pro) {
    
	$.post('./Modelo/distritos.php', {pro : pro},
	function(data){
		
			if (data != "[]") {
				var item = $.parseJSON(data);
			
		       
				$("#distrito").append('<option value="">-- Seleccionar --</option>');
		        $.each(item, function (i, valor) {
		            
		            if (valor.idDistrito !== null) {
						
					    $("#distrito").append('<option value="' + valor.idDistrito + '">' + valor.distrito + '</option>');	
					}
		        });
		    }
		return false;
    });
}


  function getParameterByName(name) {
          
          name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
          var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
          results = regex.exec(location.search);
          return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
   }





$(document).ready(function () {
	
	cargarDepartamento();
    

   /* $( "#departamento" ).change(function() {
		var idPro = $("#departamento").val();
		$("#provincia").html('');
		$("#distrito").html('');
	  //  cargarProvincia(idPro);
	});*/
	
	$( "#provincia" ).change(function() {
	    var idDis = $("#provincia").val();	
		$("#distrito").html('');
		cargarDistrito(idDis);
	});
	
	
     	 var pro = getParameterByName('user');
        $("#usu").val(pro);


});