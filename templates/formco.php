<nav>
                <button class="tibouton item"><a href="index.php?page=accueil"><span class="lnr lnr-home"></span></a></button>
            </nav>
        </div>
    </header>

    <section class="pres">
        <h1>Me connecter</h1>

        <form action="index.php?page=connection" method="POST">
            <input type="mail" placeholder="Mon adresse mail" name="mail" id="mail" class="co">
            <input type="text" placeholder="Mon mot de passe" name="mdp" id="mdp" class="co"> <br>
            <select name="role" id="role">
            <option value="">-- Choisir votre rôle--</option>
                <option value="client">Client</option> 
                <option value="conseiller">Conseiller</option>
            </select><br>
            <input type="submit" class="grosbouton">
        </form>
    </section>