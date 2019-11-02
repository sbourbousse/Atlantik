<div class="sidenav">
    <ul>
    <?php
        $requeteSecteur = "select secteurId,secteurNom from secteur";
        $res=mysqli_query($maBase,$requeteSecteur);
        $tabSecteur = mysqli_fetch_assoc($res);


        while ($unSecteur = mysqli_fetch_assoc($res))
        {
            echo '<li><a href="secteur.php?secteur='.$unSecteur['secteurId'].'">'.$unSecteur['secteurNom'].'</a></li>';
        }
    ?>
    </ul>
</div>