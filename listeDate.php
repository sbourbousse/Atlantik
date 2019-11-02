<?php
//Ajout des directions
    if (isset($_GET['liaison']))
    {
        $req="SELECT DISTINCT serviceDirectionNom FROM Service_CG WHERE serviceDirectionNom != '' AND servicePoleNom = '".$_GET['pole']."' ORDER BY serviceDirectionNom";
        $res=mysqli_query($maBase,$req);
        while ($unServiceDirection = mysqli_fetch_assoc($res))
        {
            echo '<option value="'.$unServiceDirection['serviceDirectionNom'].'">'.$unServiceDirection['serviceDirectionNom'].'</option>';
        }
    }
?>