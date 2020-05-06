<?php

session_start();
//On vide les données de session
$_SESSION = array();
header("Location: ./index.php");

?>