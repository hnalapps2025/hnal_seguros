<?php

include 'Controlador/conexion.php';
session_start();
$db = new Conectar();
$conn = $db->conexion();
error_reporting (0);


if (mysqli_connect_errno()){
    echo "La conexion no ha sido establecida: " . mysqli_connect_error();
}


header("Access-Control-Allow-Origin: *");

	if(isset($_POST['btn-login'])){

		$usuario  = mysqli_real_escape_string($conn,$_POST['username']);
		$pass 	  = mysqli_real_escape_string($conn,$_POST['password']);
		$password = md5($pass);
		
			try
			{

			$sql = "SELECT `id`, `user`, `pass`, `estado`, `nom`, `doc`, `IdSubArea`, `cargo`, `cmp`, `rna`, `Cel`, `rol`, `email`, `fe_in`, `permisos`, `permisoEmer`, `permisoHospi`, `permisoCE`,
			`perArchivo`, `profesion`, `ofAreUnidad`,(SELECT `nombre` FROM `tbl_ipress` WHERE `id`=codEstab) AS EESS, `active`,permisoRegistro,permisoEditarPato,
			(SELECT `codigo` FROM `tbl_ipress` WHERE `id`=codEstab) AS CODEESS  from usuarios where user='$usuario' AND pass='$password' and estado='ACTIVADO' ";

			$run_user 	= mysqli_query($conn, $sql);
			$check_user = mysqli_num_rows($run_user);
			
			
			
 					while($fila = $run_user -> fetch_array()){ 
						
 							$pa = $fila["pass"];
			        	 	$_SESSION['id']=$fila["id"];
			        	 	$_SESSION['nom']=$fila["nom"];
							$_SESSION['ape']=$fila["ape"];
							$_SESSION['rol']=$fila["rol"];
							$_SESSION['EESS']=$fila["EESS"];
							$_SESSION['CODEESS']=$fila["CODEESS"];
							$_SESSION['permisoRegistro']=$fila["permisoRegistro"];
							$_SESSION['permisoEditarPato']=$fila["permisoEditarPato"];
							
			  		  }

						
						
				if($check_user >= 1 )
					{
						$_SESSION['loggedin'] = true;
						echo $_SESSION['rol'];
						

						
					}

				else 
					{   
						echo "error";
					}

			}
			catch(PDOException $e){
				echo $e->getMessage();
			}	
				

		}


?>