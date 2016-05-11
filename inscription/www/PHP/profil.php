<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=plateforme-wiki-ynov', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
    ?>
    <html>
    <head>
        <title>TUTO PHP</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/profil.css">
    </head>
    <body>
    <div align="center">
        <img src="img/profil.png">
        </div>
        </br>
        <div id="catégorie">

        <h1> PSEUDO </h1> <?php echo $userinfo['pseudo']; ?>
        <br />
            <h1> EMAIL </h1> <?php echo $userinfo['mail']; ?>
        </div>
        <br />
        <?php
        if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
            ?>
            <br />
            <div id="boutton">
            <a href="editionprofil.php">Editer mon profil</a> &nbsp &nbsp &nbsp &nbsp;
            <a href="connexion.php">Se déconnecter</a>
            </div>

            <?php
        }
        ?>

    </body>
    </html>
    <?php
}
?>