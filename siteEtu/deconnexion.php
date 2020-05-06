<?php

session_start();
//On supprime le contenu de la session
$_SESSION = array();
header("Location: ./index.php");

?>