<?php
require_once "models\Counselor.php";
 ?>


<nav>
                <button class="tibouton item"><a href="index.php?page=deconnection"><span class="lnr lnr-home"></span></a></button>
            </nav>
        </div>
    </header>

    

    <section class="pres">
        <h1>Votre espace conseiller</h1>
        <p class="pres">Bonjour <?= $_SESSION['nom']?>,</p>  
        <div>
            <h2>Vos rendez-vous...</h2>

                <button class="grosbouton item"><a href="">Valider vos RDV</a></button>

            <!-- créer un tableau pour les jours de la semaine en html -->
            <table>
                <thead>
                    <tr>
                        <th>Lundi</th>
                        <th>Mardi</th>
                        <th>Mercredi</th>
                        <th>Jeudi</th>
                        <th>Vendredi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>RVD monsieur untel</td>
                        <td>RVD madame untel</td>
                        <td>RVD monsieur trucmuche</td>
                        <td>RVD madame trucmuche</td>
                        <td>RVD monsieur bretzel</td>
                    </tr>
                </tbody>
            </table>
            <!-- sera générer en PHP -->
        </div>

        <div>
            <h2>Vos messages</h2>
                <ul>
                    <li>message 1</li>
                    <li>message 2</li>
                    <li>message 3</li>
                    <li>message 4</li>
                    <li>...</li>
                </ul>

            <!-- sera générer en PHP + cliquable pour lire le message et pouvoir répondre  -->
        </div>

        <div>
            <h2>Vos clients</h2>
            <button class="grosbouton item"><a href="index.php?page=showinsertclient">Inscrire un nouveau client</a></button>
            <button class="grosbouton item"><a href="index.php?page=showinsertmember">Inscrire un nouveau membre</a></button>
                <ul>
                    <li>Client1</li>
                    <li>Client2</li>
                    <li>Client3</li>
                    <li>Client4</li>
                    <li>...</li>
                </ul>

            <!-- sera générer en PHP 
                avec possibilité de cliquer sur le client pour acceder à ses infos 
                (si j'ai le temps)-->
        </div>

        <div>
            <!-- si temps -->
            <h2>Les options à proposer cette semaine</h2>
            <ul>
                <li>Option 1</li>
                <li>Option 2</li>
                <li>Option 3</li>
            </ul>

        </div>

    </section>  