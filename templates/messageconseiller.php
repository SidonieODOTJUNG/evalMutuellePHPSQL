
        <nav>
            <button class="tibouton item"><a href="index.php?page=accueil"><span class="lnr lnr-home"></span></a></button>
        </nav>
    </div>
</header>
<section class="pres">
    <h1>Message</h1>

    <p>Votre client : ???(généré par PHP) (identifiant : ??? généré par PHP) vous à envoyer une demande : </p>

    <p> L'objet du message : object généré par PHP</p>

    <p>Le message : </p>

    <p>message généré par PHP</p>
<!-- penser à mettre la class item dans button si lien -->
    <button form="repondre_message" class="grosbouton sanslien">Répondre au client</button>
    <button form="contact_client" class="grosbouton sanslien">Contacter le client (génère le numéro de téléphone)</button>

<!-- répondre au message renvoie sur cette partie -->
    <form action="" method="POST" id="envoyer_message">

        <label for="object">Objet du message (reprend l'objet du client en PHP)</label><br>

        <textarea name="message" id="message" placeholder="Entrer la réponse ici" cols="30" rows="10"></textarea>
    
    </form>
<!-- penser à mettre class item dans button si lien -->
    <button form="envoyer_message" class="grosbouton sanslien">Envoyer le message</button>
    <button class="grosbouton item"><a href="espacepersoconseiller.html" >Revenir à mon profil</a></button>


<!-- contacter le client renvoie le numéro de tel généré par PHP -->

</section>