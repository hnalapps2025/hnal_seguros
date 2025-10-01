<?php

session_start();
unset ($SESSION['loggedin'],$SESSION['nom'],$SESSION['ape'],$SESSION['id']);
session_destroy();

//header('Location: index.php');
header('Location: ./');

?>