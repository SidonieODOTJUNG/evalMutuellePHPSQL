

        <nav>
            <button class="tibouton item"><a href="index.php?page=accueil"><span class="lnr lnr-home"></span></a></button>
        </nav>
    </div>
</header>

<section class="pres">
    <h1>Mon message</h1>

    <form action="" method="POST" id="envoyer_message">
        <label for="object">Objet du message</label><br>

        <select name="object" id="object">
            <option value="">-- Je choisi une option --</option>
            <option value="contrat">Parler de mon contrat ou mes options</option>
            <option value="modifier_contrat">Modifier un contrat ou une option</option>
            <option value="modifier_profil">Modifier mes coordonnées ou mes ayant-droit</option>
            <option value="solution">Résoudre un problème lié à mon contrat</option>
            <option value="autre">Autre</option>
        </select><br>

        <textarea name="message" id="message" placeholder="Entrer mon message ici" cols="30" rows="10"></textarea>
    </form>
<!-- penser à mettre la class item dans button si lien -->
    <button form="envoyer_message" class="grosbouton sanslien">Envoyer mon message</button>
    <button class="grosbouton item"><a href="index.php?page=showespaceclient">Revenir à mon profil</a></button>

</section>