<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=plateforme-wiki-ynov', 'root', '');

if(isset($_POST['forminscription'])) {
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
        $pseudolength = strlen($pseudo);
        if($pseudolength <= 255) {
            if($mail == $mail2) {
                if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                    $reqmail = $bdd->prepare("SELECT * FROM users WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    if($mailexist == 0) {
                        if($mdp == $mdp2) {
                            $insertmbr = $bdd->prepare("INSERT INTO users (pseudo, mail, motdepasse) VALUES(?, ?, ?)");
                            $insertmbr->execute(array($pseudo, $mail, $mdp));
                            $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                        } else {
                            $erreur = "Vos mots de passes ne correspondent pas !";
                        }
                    } else {
                        $erreur = "Adresse mail déjà utilisée !";
                    }
                } else {
                    $erreur = "Votre adresse mail n'est pas valide !";
                }
            } else {
                $erreur = "Vos adresses mail ne correspondent pas !";
            }
        } else {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>

<html>
<head>
    <title>INSCRIPTION</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/inscription.css">
    <link rel="stylesheet" href="css/Bootstrap.css">
</head>
<body>
<div align="center">
    <img src="img/Inscription.png">
    <br /><br />
    <form method="POST" action="" role="form">
        <div class="form-group">
        <table>
            <tr>
                <td>
                    <label for="pseudo">PSEUDO :</label>
                </td>
                <td>
                    <input type="text" placeholder="Votre pseudo" class="form-control" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
                </td>
            </tr>
        </div>
        <div class="form-group">
            <tr>
                <td>
                    <label for="mail">MAIL :</label>
                </td>
                <td>
                    <input type="email" placeholder="Votre mail" class="form-control" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />
                </td>
            </tr>
            </div>
        <div class="form-group">
            <tr>
                <td >
                    <label for="mail2">CONFIRMATION DU MAIL :</label>
                </td>
                </td>
                <td>
                    <input type="email" placeholder="Confirmez votre mail" class="form-control" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />
                </td>
            </tr>
            </div>
        <div class="form-group">
            <tr>
                <td >
                    <label for="mdp">MOT DE PASSE :</label>
                </td>
                <td>
                    <input type="password" placeholder="Votre mot de passe" class="form-control" id="mdp" name="mdp" />
                </td>
            </tr>
            </div>
        <div class="form-group">
            <tr>
                <td>
                    <label for="mdp2">CONFIRMATION DE MOT DE PASSE :</label>
                </td>
                <td>
                    <input type="password" class="form-control" placeholder="Confirmez votre mdp" id="mdp2" name="mdp2" />
                </td>
            </tr>
            <tr>
                <td></td>
                <td align="center">
                    <br />
                    <input type="submit" class="form-control" name="forminscription" value="Je m'inscris" />
                </td>
            </tr>
            </div>

        </table>
    </form>
    <?php
    if(isset($erreur)) {
        echo '<font color="red">'.$erreur."</font>";
    }
    ?>
</div>
</body>
</html>
