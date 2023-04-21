<section id="util_semaine">
            
            <h2>Utilisateur de la semaine !!</h2>
            <a href="visuelProfil.php?id_user=<?php echo $id_user ?>">
            <div class="carre_util_semaine">
                <div class="miniprofil">
                <img src= <?php echo $image ?> alt="introuvable" width="100" height="100" >
                <div class="description_util_semaine"> 
                     <label><?php echo $email ?></label> <br>
                     <label class = "infos_util_semaine"> <?php echo $nom . ' ' . $prenom ?> </label> <br>
                     <label class = "infos_util_semaine"> Note moyenne : <?php echo $note_moy ?> </label> <br>
                     <label class = "infos_util_semaine"> Créé le <?php echo $date ?> </label>
                </div>
                </div>
                <a href="visuelrecette.php?id=<?php echo $id_recette?>">
                <div class="recette_util_semaine ">
                        <label style="font-size:20">Meilleure recette :</label>
                           <img src= <?php echo $photo_recette ?> alt="introuvable" width="50" height="50" >
                            <div class="description_util_semaine"> 
                                <label style="font-size:30"><?php echo $nom_recette ?></label>
                                <span class='tab'></span>
                                <label> Note : <?php echo $note_recette ?> </label>
                                <span class='tab'></span>
                                <label> <?php echo $type ?> </label> 
                                <label> pour <?php echo $nombre_personnes ?> </label>
                                <span class='tab'></span>
                                <label> <?php echo $difficulte ?> </label> 
                                <span class='tab'></span>
                                <label> Cout : <?php echo $cout ?> € </label>
                            </div>
                </div>
                </a>
                
            </div>
            </a>


        </section>