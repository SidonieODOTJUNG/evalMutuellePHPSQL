            <nav>
                <button class="tibouton item"><a href="index.php?page=accueil"><span class="lnr lnr-home"></span></a></button>
            </nav>
        </div>
    </header>

<section class="pres">
    <h1>Prendre RDV avec mon conseiller</h1>

    <form action="" method="POST" id="RDV">
        <label for="object">Objet du rendez-vous</label><br>

        <select name="object" id="object">
            <option value="">-- Je choisi une option --</option>
            <option value="contrat">Parler de mon contrat ou mes options</option>
            <option value="modifier_contrat">Modifier un contrat ou une option</option>
            <option value="modifier_profil">Modifier mes coordonnées ou mes ayant-droit</option>
            <option value="solution">Résoudre un problème lié à mon contrat</option>
            <option value="autre">Autre</option>
        </select><br>

        <label for="date">Je choisi une date</label>
        <p><input type="checkbox" name="date">le (date générer par PHP) à (générer par PHP) heure </p>
        <p><input type="checkbox">le (date générer par PHP) à (générer par PHP) heure </p>
        <p><input type="checkbox">le (date générer par PHP) à (générer par PHP) heure </p>
        
    </form>
<!-- penser à mettre la class item dans button si lien -->
    <button form="RDV" class="grosbouton sanslien">Prendre RDV</button>
    <button class="grosbouton item"><a href="index.php?page=showespaceclient" >Revenir à mon profil</a></button>

</section>