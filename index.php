<?php

    ini_set("display_errors",0);error_reporting(0); 
    
    $destinataire = 'kevin.dubreucq@gmail.com';

    $message_envoye = "Votre message nous est bien parvenu !";
    $message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

    $message_erreur_formulaire = "Vous devez d'abord envoyer le formulaire.";
    $message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";
    
    function isExist($var){
        if (isset($var)){
            echo $var;
          }
    }

    if(isset($_POST['submit'])){

        $options = array(
        'firstname' => FILTER_SANITIZE_STRING,
        'lastname'  => FILTER_SANITIZE_STRING,
        'email' => FILTER_VALIDATE_EMAIL,
        'message'   => FILTER_SANITIZE_STRING,
        'country'  => FILTER_SANITIZE_STRING,
        'gender' => FILTER_SANITIZE_STRING);
      
        $result = filter_input_array(INPUT_POST, $options);
        $checkResult =[];
      
        if(isset($_POST['subject'])) {
            foreach ($_POST['subject'] as $value) {
            $checkResult[] = filter_var( $value ,FILTER_SANITIZE_STRING);
            }
        }
        $result["subject"]= $checkResult;
        print_r($result);
      
        $firstname = trim($result['firstname']);
        $lastname = trim($result['lastname']);
        $email = trim($result['email']);
        $message = trim($result['message']);
        $gender = trim($result['gender']);
        $country = trim($result['country']);
      
        if(isset($firstname) AND !empty($firstname) ){
        $verif_firstname = "ok";
        }
        else {
        $verif_firstname = "pok";
        }
    
        if(isset($lastname) AND !empty($lastname) ){
        $verif_lastname = "ok";
        }
        else {
        $verif_lastname = "pok";
        }
    
        if(isset($email) AND !empty($email) ){
        $verif_email = "ok";
        }
        else {
        $verif_email = "pok";
        }
    
        if(isset($gender) AND !empty($gender) ){
        $verif_gender = "ok";
        }
        else {
        $verif_gender = "pok";
        }
    
        if(isset($country) AND !empty($country) ){
        $verif_country = "ok";
        }
        else {
        $verif_country = "pok";
        }
    
        if(isset($message) AND !empty($message) ){
        $verif_message = "ok";
        }
        else {
        $verif_message = "pok";
        }
    
        if($verif_name == "ok" AND $verif_lastname == "ok" AND $verif_email == "ok" AND $verif_message == "ok" AND $verif_pays == "ok"){
        $form_mail="Message de : $firstname $lastname\n";
        $form_mail.="Genre : $gender\n";
        $form_mail.="Email : $email\n";
        $form_mail.="Pays : $country\n";
        $form_mail.="Sujet : $choix\n";
        $form_mail.="Message : $message\n";
    
        $title ="";
        foreach ($_POST['choix'] as  $value) {
            $title .= "$value ";
        }
        echo 'test';
        mail($destinataire, $title, $form_mail);
        }
    }

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
                            <input type="text" name="firstname" placeholder="Entrez votre nom ici" value="<?= isExist($firstname); ?>"><br/>
                            <?php if($verif_firstname == 'pok'){
                                echo '<span class="error"> N\'utilisez que des lettres pour entrez votre nom s\'il vous plait. L\'utilisation de tirets est autorisée.</span>';
                            }?>
                            <input type="text" name="lastname" placeholder="Entrez votre prénom ici" value="<?= isExist($lastname); ?>"><br/>
                            <?php if($verif_lastname == 'pok'){
                                echo '<span class="error"> N\'utilisez que des lettres pour entrez votre prénom s\'il vous plait. L\'utilisation de tirets est autorisée.</span>';
                            }?>
                            <input type="radio" name="gender" value="Homme"><label>Masculin</label>
                            <input type="radio" name="gender" value="Femme"><label>Féminin</label><br/>
                            
                            <input type="email" name="email" placeholder="Entrez votre adresse mail ici" value="<?= isExist($email); ?>"><br/>
                            <?php if($verif_email == 'pok'){
                                echo '<span class="error"> Veuillez entrer votre adresse mail au format \'partie@domaine.com\'.</span>';
                            }?>
                            <input type="text" name="country" placeholder="Entrez votre pays ici" value="<?= isExist($country); ?>"><br/>
                            <?php if($verif_country == 'pok'){
                                echo '<span class="error"> Veuillez sélectionner votre pays s\'il vous plait.</span>';
                            }?>
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
                                <textarea name="champmess" id="champmess" placeholder="Entrez votre message ici"></textarea>
                                <?php if($verif_message == 'pok'){
                                    echo '<span class="error"> Veuillez nous écrire votre message!</span>';
                                }?>
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
                            echo "Identité : ".$lastname." ".$firstname."<br />".
                            "Genre : ".$gender."<br />".
                            "Adresse mail : ".$email."<br />".
                            "Pays : ".$country."<br />".
                            "Sujet : ".$choix."<br />".
                            "Motif : ".$message;
                        ?>
                </section>
            <?php endif; ?>
        </div>
    </body>
</html>