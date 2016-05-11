<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=plateforme-wiki-ynov', 'root', '');

if(isset($_POST['formconnexion'])) {
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);
    if(!empty($mailconnect) AND !empty($mdpconnect)) {
        $requser = $bdd->prepare("SELECT * FROM users WHERE mail = ? AND motdepasse = ?");
        $requser->execute(array($mailconnect, $mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 1) {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['mail'] = $userinfo['mail'];
            header("Location: profil.php?id=".$_SESSION['id']);
        } else {
            $erreur = "Erreur Mail ou Mot de passe.";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>
<html>
<head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/Bootstrap.css">
    <link rel="stylesheet" href="css/connexion.css">
</head>
<body>
<div align="center">
    <img src="img/connexion.png">
    <br /><br />
    <br /><br />
    <form method="POST" action="">
        <br /><br />
        <input type="email" name="mailconnect" placeholder="Mail" />
        <br /><br />
        <input type="password" name="mdpconnect" placeholder="Mot de passe" />
        <br /><br />
        <input type="submit" name="formconnexion" value="Se connecter !" />
    </form>

    <?php
    if(isset($erreur)) {
        echo '<font color="red">'.$erreur."</font>";
    }
    ?>
</div>
</body>
</html>