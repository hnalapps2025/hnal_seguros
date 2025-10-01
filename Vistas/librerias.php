<?php 

include 'Modelo/global.php';

 ?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Expires" content="0">
 
    <meta http-equiv="Last-Modified" content="0">
     
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
     
    <meta http-equiv="Pragma" content="no-cache">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>.:: SISTEMA ::.</title>
    <link rel="stylesheet" href="css/jquery.growl.css">
  
  <!-- </style> -->
  

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="css/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="css/green.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <!-- bootstrap-progressbar -->
    <link href="css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="css/jqvmap.min.css" rel="stylesheet"/>
    <script type="text/javascript" src="js/paciente.js"></script> 
   <link rel="shortcut icon" href="images/ico.png" />
  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css" rel="stylesheet">

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <!--<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>-->
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <!--<script src="js/ajax.js"></script>-->
    <!--<script src="js/validaton.js"></script>-->


    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">
    <style>
        .messages{
                float: left;
                font-family: sans-serif;
                display: none;
            }

         .info{
                color: orange;
                font-size: 13px;
                font-weight: bold;
            }
            .before{
                color: blue;
                font-size: 13px;
                font-weight: bold;
            }
            .success{
                   color: green;
                font-size: 13px;
                font-weight: bold;
            }
            .error{
                    color: red;
                    font-size: 13px;
                    font-weight: bold;
            }
            
            pre{
            	    background: white;
    		    border: 1px solid white;
                    color: #73879c;
                    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
            }
            /*.form-control {
            }*/

            input:focus {
              background-color: #e5fff9;
              color:black;
              border: 2px solid #337ab7;
            }

            select:focus {
              background-color: #e5fff9;
              color:black;
              border: 2px solid #337ab7;
            }
            
            textarea:focus {
              background-color: #e5fff9;
              color:black;
              border: 2px solid #337ab7;
            }
            .ui-autocomplete {
            max-height: 600px;
            max-width: 1080px;
            overflow-y: auto;
            /* prevent horizontal scrollbar */
            overflow-x: hidden;
            /* add padding to account for vertical scrollbar */
            padding-right: 20px;
           } 

           .dt-center{
              font-size: 10px;
             
           }
           .dt-left{
              font-size: 10px;
             
           }.dt-right{
              font-size: 10px;
              
           }
    </style>
    
   
  </head>