<?php
require_once "models\Client.php";
 ?>
 
 <nav>
                <button class="tibouton item"><a href="index.php?page=deconnection"><span class="lnr lnr-home"></span></a></button>
            </nav>
        </div>
    </header>

    <section class="pres">
        <h1>Mon espace personnel</h1>
        <p>Bonjour <?= $_SESSION['nom']?>,</p>  

        <div>
            <h2>Mes services</h2>
            <button class="grosbouton item"><a href="index.php?page=showRDV">Prendre rendez-vous avec mon conseiller</a></button>
            <button class="grosbouton item"><a href="mindex.php?page=showmessageclient">Envoyer un message à mon conseiller</a></button>
        </div>

        <div>
            <h2>Mon contrat et mes options</h2>
            
            <p>Vous disposez d'un contrat formule ?(générer par PHP) </p>
            <p>Vous avez choisi l'option ? (générer par PHP)</p>

            <p>Rappel de vos garanties : Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, 
                quidem? Fugiat animi atque recusandae veritatis facilis quos porro velit aliquam 
                sit at et quisquam doloremque tenetur nam, asperiores sunt enim.</p>

            <button class="grosbouton item"><a href="">Modifier mon contrat</a></button>

            <!-- sera générer en PHP 
                avec possibilité de cliquer sur le client pour acceder à ses infos 
                (si j'ai le temps)-->
        </div>

    </section>
        