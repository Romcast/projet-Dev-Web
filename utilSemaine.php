<section id="util_semaine">
            
            <h2>Utilisateur de la semaine !!</h2>
            <a href="visuelProfil.php?id_user=<?php echo $id_user ?>">
            <div class="carre_util_semaine">
                <div class="miniprofil">
                <img class="image_profil" src= <?php echo $image ?> alt="introuvable" width="100" height="100" >
                <div class="description_util_semaine"> 
                     <label><?php echo $email ?></label> <br>
                     <label class = "infos_util_semaine"> <?php echo $nom . ' ' . $prenom ?> </label> <br>
                     <label class = "infos_util_semaine"> Note moyenne : <?php echo $note_moy ?> </label> <br>
                     <label class = "infos_util_semaine"> Créé le <?php echo $date ?> </label>
                </div>
                </div>
                <div class="recette_util_semaine ">
                        <h3> Meilleure recette <h3>
                </div>
                
            </div>
            </a>


        </section>