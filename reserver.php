<?php
    include_once "connect.php";
    include_once "functions.php";

    if(!isset($_GET['traversee']))
    {
        $error=true;
    }
    else
    {
        $req="select traverseeHoraireDebut, portDepart, portArrive from traversee natural join liaison where traverseeId=".$_GET['traversee'];
        $res=mysqli_query($maBase,$req);
        $row= mysqli_fetch_row($res);
    }
?>
<!doctype HTML>
<html>
    <head>
    <title>Traversee</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
        <?php include "elements/sidebar.inc.php"; ?>
        <div class="main">
            <?php include "elements/navbar.inc.php"; ?>
            <p><?php echo 'Liaison '.getPortNom($maBase,$row[1]).' - '.getPortNom($maBase,$row[2]); ?></p>
            <p><?php echo 'Traversée n°'.$_GET['traversee'].' le '.convertDate($row[0]); ?></p>
            <p>Saisir les informations relatives à la reservation</p>

            <form  method="POST" action="confirm.php">
                <div class="input-row">
                    <label for="nom">Nom : </label>
                    <input type="text" name="nom" placeholder="Votre nom">
                </div>
                <div class="input-row">
                    <label for="adresse">Adresse : </label>
                    <input type="text" name="adresse" placeholder="Votre adresse">
                </div>
                <div class="input-row">
                    <label for="codePostale">Code Postale : </label>
                    <input type="text" name="codePostale" maxlength="5" placeholder="00000">
                    <label for="ville">Ville : </label>
                    <input type="text" name="ville" placeholder="Votre ville">
                </div>
                <div>
                    <table style="border:1px solid black">
                        <tr>
                            <th></th><th>Tarif en €</th><th>Quantite</th>
                        </tr>
                        <?php
                            $reqReservationTableau='select typeLibelle, prix, type.categorieId, type.typeId from type natural join tarif natural join liaison natural join traversee where traversee.traverseeId='.$_GET['traversee'].' and periodeId=(select distinct periode.periodeId from periode natural join tarif natural join liaison natural join traversee where date(traverseeHoraireDebut) between periodeDateDebut and periodeDateFin)';

                            $resReservationTableau= mysqli_query($maBase,$reqReservationTableau);
                            while($uneLigne = mysqli_fetch_assoc($resReservationTableau))
                            {
                                echo '<tr><td>'.$uneLigne['typeLibelle'].'</td><td>'.$uneLigne['prix'].'</td><td><input type="number" name="'.$uneLigne['categorieId'].$uneLigne['typeId'].'"></td></tr>';
                            }
                        ?>
                    </table>
                    <input type="submit" name="valider">
                </div>


            </form>
        </div>
    </body>

</html>