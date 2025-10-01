<?php
	define('DB_SERVER', '202.15.1.45');
	define('DB_USER', 'csaravia');
	define('DB_PASSWORD', 'csaravia2020..');
	define('DB_NAME', 'segurosm_hnal');
	define('DB_PORT', '3306');
	class Conectar{
	    public static function conexion(){
			$conexion=new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);	
	        $conexion->query("SET NAMES 'utf8'");
	        return $conexion;
	    }		
	}
?>