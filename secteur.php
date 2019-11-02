<?php 
    include_once "connect.php";
    include_once "functions.php";
    $error=false;

    if(!isset($_GET['secteur']))
    {
        $error=true;
    }
    else
    {
        $requeteLaisonSecteur = "select liaisonCode, portDepart, portArrive from liaison natural join secteur where secteur.secteurId=".$_GET['secteur'];
        $resLiaisonSecteur=mysqli_query($maBase,$requeteLaisonSecteur);
        while ($uneLiaison = mysqli_fetch_assoc($resLiaisonSecteur))
        {
            $tabLiaison[]='<option value="'.$uneLiaison['liaisonCode'].'">'.getPortNom($maBase,$uneLiaison['portDepart']).' - '.getPortNom($maBase,$uneLiaison['portArrive']).'</option>';
        }
    }
?>
<!doctype HTML>
<html>
    <head>
    <title>Secteur </title>
    <link href="css/style.css" rel="stylesheet" type="text/css">   
    </head>
    <body>
        <?php include "elements/sidebar.inc.php"; ?>
        <div class="main">
            <?php include "elements/navbar.inc.php"; ?>
            <div>
                <form method="POST" action="secteur.php<?php if(isset($_GET['secteur'])) echo '?secteur='.$_GET['secteur'];?>">
                    <p>Sélectionner la liaison, et la date souhaitée</p>
                    <select name="liaison" required>
                        <?php
                            foreach($tabLiaison as $uneOption)
                            {
                                echo $uneOption;
                            }
                        ?>
                    </select>
                    <input type="date" name="date" value="<?php if(isset($_POST['afficher'])) echo $_POST['date']?>" required>
                    <button type="submit" name="afficher" >afficher les traversées</button> 
                </form>
                <div class="tableauTraversee">
                <?php if(isset($_GET['secteur']) && isset($_POST['afficher']))
                { 
                    $nbCategorie=0;
                    $headerAllCategorie='';
                    $requeteTouteCategorie = "select categorieId, categorieNom from categorie";
                    $resTouteCategorie=mysqli_query($maBase,$requeteTouteCategorie);
                    while($uneCategorie = mysqli_fetch_assoc($resTouteCategorie))
                    {
                        $tabCategorieId[]=$uneCategorie['categorieId'];
                        $tabCategorieNom[]=$uneCategorie['categorieNom'];
                        $headerAllCategorie.='<th>'.$uneCategorie['categorieId'].'<br/>'.$uneCategorie['categorieNom'].'</th>';
                        $nbCategorie++;
                    }

                ?>
                    <table style="border:1px solid black">
                        <tr>
                            <th colspan="3">Traversée</th><th colspan="<?php echo $nbCategorie ?>">Places disponible par catégorie</th>
                        </tr>
                        <tr>    <!-- A mediter ( le colspan de places disponible depend du nombre de catégorie) -->
                            <th>N°</th><th>Heure</th><th>Bateau</th>
                            <?php
                                echo $headerAllCategorie;
                            ?>
                        </tr>
                        <?php
                            $requeteTouteTraversee='select traverseeId, time(traverseeHoraireDebut) as horaireDebut, bateau.bateauId, bateau.bateauNom from traversee natural join bateau where date(traverseeHoraireDebut)="'.$_POST['date'].'" AND liaisonCode='.$_POST['liaison'].' order by traverseeHoraireDebut';
                            $resTouteTraversee = mysqli_query($maBase,$requeteTouteTraversee);
                            while($uneTraversee = mysqli_fetch_assoc($resTouteTraversee))
                            {
                                $traverseeLigne='<tr><td>'.$uneTraversee['traverseeId'].'</td><td>'.$uneTraversee['horaireDebut'].'</td><td>'.$uneTraversee['bateauNom'].'</td>';

                                foreach($tabCategorieId as $uneCategorie)
                                {
                                    $reqPlaceDispo='Select nbPlaces ,(select sum(quantite) from contient natural join type natural join categorie natural join disposer natural join bateau natural join traversee where traverseeId='.$uneTraversee['traverseeId'].' and disposer.bateauId='.$uneTraversee['bateauId'].' and type.categorieId="'.$uneCategorie.'" ) 
                                    from disposer where bateauId='.$uneTraversee['bateauId'].' and categorieId="'.$uneCategorie.'"';
                                    $resPlaceDispo= mysqli_query($maBase,$reqPlaceDispo);
                                    $rowPlaceDispo= mysqli_fetch_row($resPlaceDispo);
                                    $traverseeLigne.='<td>'.($rowPlaceDispo[0]-$rowPlaceDispo[1]).'</td>';
                                }
                                $traverseeLigne.='<td><a href="reserver.php?traversee='.$uneTraversee['traverseeId'].'"><button>Reserver</button></a></td></tr>';
                                echo $traverseeLigne;
                            }
                        ?>
                    </table>
                <?php }
                ?>
                </div>
            </div>
        </div>
        
    </body>
    <script src="js/secteur_script.js"></script>
</html>
<!--<th>A<br/>Passager</th><th>B<br/>Véh.inf.2m</th><th>C<br/>Véh.Sup.2m</th>-->