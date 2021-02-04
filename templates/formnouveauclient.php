

<nav>
                <button class="tibouton item"><a href="index.php?page=deconnection"><span class="lnr lnr-home"></span></a></button>
            </nav>
        </div>
    </header>

    <section class="pres">
        <h1>Création des comptes client</h1>

        <p>Entrez les informations du nouveau client.</p>

        <form action="index.php?page=creationcompte" method="POST">

            <h2>Le client</h2>
            <input type="text" placeholder="Numéro de sécurité social" name="secu" id="secu" class="co text"><br>
            <input type="text" placeholder="Nom du client" name="nom_client" id="nom_client" class="co text"> <br>
            <input type="text" placeholder="Prénom du client" name="prenom_client" id="prenom_client" class="co text"> <br>
            <input type="textarea" placeholder="Adresse" name="adresse" id="adresse" class="co text"> <br>
            <input type="number" placeholder="Nombre de membre de la cellule familliale" name="nb_membres" id="nb_membres" class="co"> <br>
            <input type="date" placeholder="Date de naissance" name="naissance_client" id="naissance_client" class="co"> <br>
            <input type="tel" placeholder="Numéro de téléphone" name="tel" id="tel" class="co"> <br>
            <input type="text" placeholder="Identifiant du conseiller" name="id_conseiller" id="id_conseiller" class="co text"> <br>
            <select name="formule" id="formule">
                <option value="">-- Choisir la formule du client--</option>
                <option value="formule1">Formule 1 </option> 
                <option value="formule2">Formule 2</option>
                <option value="formule3">Formule 3</option>
            </select><br>

            <select name="option" id="option">
                <option value="">-- Choisir l'option du client--</option>
                <option value="option1">Option 1 </option> 
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
            </select><br>

            <input type="mail" placeholder="Mail du client" name="mail" id="mail" class="co text"> <br>




            <input type="submit" class="grosbouton">
        </form>
    </section>