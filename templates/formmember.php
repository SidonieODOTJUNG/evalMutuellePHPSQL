

<nav>
                <button class="tibouton item"><a href="index.php?page=accueil"><span class="lnr lnr-home"></span></a></button>
            </nav>
        </div>
    </header>

    <section class="pres">
        <h1>Création des ayants droits</h1>

        <p>Entrez les informations des ayants droits.</p>
            <!-- si temps : algo reproduisant cette partie autant de fois que le nombre de membre de la cellule familliale -1 (client) -->
            <h2>Les ayants droits</h2>

            <form action="index.php?page=creationmembre" method="POST">
                <input type="text" placeholder="Numéro de sécurité social du client" name="secu" id="secu" class="co text"><br>
                <input type="text" placeholder="Nom de l'ayant droit" name="nom_membre" id="nom_membre" class="co text"> <br>
                <input type="text" placeholder="Prénom de l'ayant droit" name="prenom_membre" id="prenom_membre" class="co text"> <br>
                <input type="date" placeholder="Date de naissance" name="naissance_membre" id="naissance_membre" class="co"> <br>

            <!-- voir si j'ai le temps de refaire ma boucle for -->

                <input type="submit" class="grosbouton">
        </form>
    </section>