<?php
    $serveur="localhost";
    $baseName="Atlantik";
    $mdp="";
    $user="sylvain";
    
    $maBase = new mysqli($serveur,$user,$mdp,$baseName);

    if ($maBase->connect_error) {
        die();
    }
    
?>