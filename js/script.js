/*
Author: Pradeep Khodke
URL: http://www.codingcage.com/
*/

$('document').ready(function()
{ 
     /* validation */
	 $("#login-form").validate({

      rules:
	  {
			password: {
			required: false,
			},
			username: {
            required: false,
           
            },
	   },
       messages:
	   {
            password:{
                      required: "Por favor, ingrese su contraseña"
                     },
            username: "Por favor, ingrese su usuario",
       },

	   submitHandler: submitForm	
       });  
	   /* validation */
	   
	 	
	   /* login submit */
	   function submitForm()
	   {		

	   		var us = $("#username").val();
	   		var pa = $("#password").val();

	   		if(us=="" && pa==""){
	   				alert("Debes ingresar tus datos");
	   				$("#username").focus();
	   		}
	   		else{
	   			var data = $("#login-form").serialize();						
				$.ajax({				
				type : 'POST',
				url  : 'login.php',
				data : data,
				success :  function(response)
				
				   {			
					console.log(response);
					
						if(response=="1" ){
							
							setTimeout(' window.location.href = "registroPatologia.php"; ',100);
						}
						else if(response=="2"){
						    
						    setTimeout(' window.location.href = "grupoConsultaExterna.php"; ',100);
						}
						else if(response=="7"){
						    
						    setTimeout(' window.location.href = "consolidado.php?tipo=1"; ',100);
						}
						else if(response=="8"){
						    
						    setTimeout(' window.location.href = "referencias.php"; ',100);
						}
						else if(response=="4"){
						    
						    setTimeout(' window.location.href = "grupoArchivo.php"; ',100);
						}
						else if(response=="5"){
						    
						    setTimeout(' window.location.href = "emergencias.php?tipo=3"; ',100);
						}
						else if(response=="20"){
						    
						    setTimeout(' window.location.href = "registroPatologia.php"; ',100);
						}
						else{
									
							alert("Usuario y/o Contrasena incorrectos");
							$("#username").val("");
							$("#password").val("");		
						}
				  }
				});
					return false;
	   		}

			
		}
	   /* login submit */


	    $("#registro-form").validate({

			      rules:
				  {
						password: {
						required: false,
						},
						username: {
			            required: false,
			           
			            },

			             email: {
						required: false,
						},
						nom: {
			            required: false,
			           
			            },

						ape: {
						required: false,
						},
				   },
			       messages:
				   {
			            password:{
			                      required: "Por favor, ingrese su contraseña"
			                     },
			            username: "Por favor, ingrese su usuario",
			       },

				   submitHandler: submitregistrer	
			       });  
				   /* validation */
	   
	 	
	   /* login submit */
	   function submitregistrer()
	   {		

	   		var us = $("#username").val();
	   		var pa = $("#password").val();

	   		if(us=="" && pa==""){
	   				alert("Debes ingresar tus datos");
	   		}
	   		else{

	   			var data = $("#registro-form").serialize();		

				$.ajax({				
				type : 'POST',
				url  : '',
				data : data,
				success :  function(response)
				   {						
						if(response!="error"){
							
							alert("Su registro fue un éxito");
							setTimeout(' window.location.href = "mantenimiento.html?cod='+response+'"; ',1000);
						}
						else{
									
							alert("Falló en registrarse");
							setTimeout(' window.location.href = "panel.html"; ',1000);
						}
				  }
				});
					return false;
	   		}

			
		}



		$("#form1").validate({

			      rules:
				  {
						password: {
						required: false,
						},
						username: {
			            required: false,
			           
			            },

			             email: {
						required: false,
						},
						nom: {
			            required: false,
			           
			            },

						ape: {
						required: false,
						},
				   },
			       messages:
				   {
			            password:{
			                      required: "Por favor, ingrese su contraseña"
			                     },
			            username: "Por favor, ingrese su usuario",
			       },

				   submitHandler: sugerencia	
			       });  
				   /* validation */
	   
	 	
	   /* login submit */
	   function sugerencia()
	   {		

	   		var us = $("#name").val();
	   		var em = $("#email").val();
	   		var co = $("#comment").val();

	   		if(us=="" && em=="" && co=="" ){
	   				alert("Debes rellenar los campos");
	   		}
	   		else{

	   			var data = $("#form1").serialize();	
				$.ajax({				
				type : 'POST',
				url  : '',
				data : data,
				success :  function(response)
				   {			
						
						if(response=="ok"){
							
							alert("Su sugerencia y/o comentario fue enviado");
							setTimeout(' window.location.href = "panel.html"; ',1000);
						}
						else{	
							
							alert("Su sugerencia y/o comentario fue enviado.");
							setTimeout(' window.location.href = "panel.html"; ',1000);
							
						}
				  }

				});
					return false;
	   		}

			
		}
});