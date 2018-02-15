<?php
    $destinataire = 'kevin.dubreucq@gmail.com';

    $message_envoye = "Votre message nous est bien parvenu !";
    $message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

    $message_erreur_formulaire = "Vous devez d'abord envoyer le formulaire.";
    $message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";
     
    if($_POST){
        $firstname=($_POST['firstname']);
        $lastname=($_POST['lastname']);
        $gender=($_POST['gender']);
        $email=($_POST['email']);
        $country=($_POST['country']);
        $choix=($_POST['choix']);
        $message=($_POST['champmess']);
        $nettoyage="Tous les champs ont été nettoyés ! <br/>";
        $nettoyagefail="Au moins un champ n'est pas correct! <br/>";
        
        $form_mail="Message de : $firstname $lastname\n";
        $form_mail.="Genre : $gender\n";
        $form_mail.="Email : $email\n";
        $form_mail.="Pays : $country\n";
        $form_mail.="Sujet : $choix\n";
        $form_mail.="Message : $message\n";
    }

    $options = array(
        'firstname' => FILTER_SANITIZE_STRING,
        'lastName'  => FILTER_SANITIZE_STRING,
        'email'     => FILTER_VALIDATE_EMAIL,
        'choix'     => FILTER_SANITIZE_STRING,
        'message'   => FILTER_SANITIZE_STRING);
    
    $result = filter_input_array(INPUT_POST, $options); 

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Hackers Poulette</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
        <script src="main.js"></script>
    </head>
    <body>
        <div class = "page">
            <?php if (empty($_POST['lastname']) 
                OR empty($_POST['firstname']) 
                OR empty($_POST['gender']) 
                OR empty($_POST['email'])
                OR empty($_POST['country'])
                OR empty($_POST['choix'])
                OR empty($_POST['champmess'])):?>
                <header>
                    <img id="logo" src="assets/hackers-poulette-logo.png" alt="Logo Hackers Poulette"/>
                    <div id="title">
                        <h1>Hackers Poulette</h1>
                        <h2>est. 2017</h2>
                        <h4><br />Tous les champs sont obligatoires.</h4>
                    </div>
                </header>
                <section class="form">
                    <form class="formulaire" name="coordonnées" method = "post" action = "<?php echo $_SERVER['PHP_SELF'] ?>">
                    <section class="Coordonnées">
                        <div class="label">
                            <label for="firstname">Nom :</label><br />
                            <label for="lastname">Prénom :</label><br/>
                            <label for="gender">Genre :</label><br/>
                            <label for="email">Mail :</label><br/>
                            <label for="country">Pays :</label><br/>
                        </div>
                        <div class="input">
                            <input type="text" pattern="[A-Za-z-éèêëïîâôûŷöïüÿäáúíóýàỳùìòñ]{3,105}" name="firstname" placeholder="Entrez votre nom ici" required title="N'utilisez que des lettres pour entrez votre nom s'il vous plait. L'utilisation de tirets est autorisée."><br/>
                            <input type="text" pattern="[A-Za-z-éèêëïîâôûŷöïüÿäáúíóýàỳùìòñ]{3,105}" name="lastname" placeholder="Entrez votre prénom ici" required title="N'utilisez que des lettres pour entrez votre prénom s'il vous plait.  L'utilisation de tirets est autorisée."><br/>
                            <input type="radio" pattern="Homme" name="gender" value="Homme" required><label>Masculin</label>
                            <input type="radio" pattern="Femme" name="gender" value="Femme" required><label>Féminin</label><br/>
                            <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email" placeholder="Entrez votre adresse mail ici" required title="Veuillez entrer votre adresse mail au format 'partie@domaine.com' ."><br/>
                            <input type="text" pattern="[A-Za-z-' 'éèêëïîâôûŷöïüÿäáúíóýàỳùìòñ]{4,51}" name="country" placeholder="Entrez votre pays ici" required title="N'utilisez que des lettres pour entrez votre prénom s'il vous plait.  L'utilisation de tirets et d'espace est autorisée."><br/>
                        </div>
                    </section>
                    <section class="Sujet">
                        <div class="left">
                            <h3>SUJET </h3>
                        </div>
                        <div class="right">
                            <select name="choix">
                                <?php 
                                    $sujet=array ('Sujet1','Sujet2','Sujet3');
                                    foreach ($sujet as $value) {
                                        echo "<option value=".$value.">".$value."</option>";
                                    }
                                ?>   
                            </select> 
                        </div>
                    </section>
                    <section class="message">
                        <p> Message :</p>
                            <div id=$champ>
                                <textarea name="champmess" id="champmess" placeholder="Entrez votre message ici" required="Entrez votre message"></textarea>
                                <br/><input type="submit" name="valider" value="Envoyer" id="button"/>
                            </div>
                    </section>
                    </form>
                </section>
                <footer>
                    <p id="copyright">Site créé par la société Ronhin Corp® et géré par Hackers Poulette.</p>
                </footer>
            <?php endif; ?>
            
            <?php if (!empty($_POST['lastname']) AND isset($_POST['lastname']) 
            AND !empty($_POST['firstname']) AND isset($_POST['firstname'])
            AND !empty($_POST['gender']) AND isset($_POST['gender']) 
            AND !empty($_POST['email']) AND isset($_POST['email']) 
            AND !empty($_POST['country']) AND isset($_POST['country'])
            AND !empty($_POST['choix']) AND isset($_POST['choix'])
            AND !empty($_POST['champmess']) AND isset($_POST['champmess'])): ?>
                <section class="reponse">
                    <h2>Récap. Formulaire</h2>
                        <?php
                            if ($result != null AND $result != FALSE) {
                                echo "Tous les champs ont été nettoyés ! <br/>";
                            } else {
                                echo "Au moins un champ n'est pas correct! <br/>";
                            }

                            echo "Identité : ".$lastname." ".$firstname."<br />".
                            "Genre : ".$gender."<br />".
                            "Adresse mail : ".$email."<br />".
                            "Pays : ".$country."<br />".
                            "Sujet : ".$choix."<br />".
                            "Motif : ".$message;

                            mail("$destinataire","$sujet","$form_mail","From: $email");
                        ?>
                </section>
            <?php endif; ?>
        </div>
    </body>
</html>