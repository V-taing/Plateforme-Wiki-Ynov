<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=plateforme-wiki-ynov', 'root', '');

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
