<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Connexion</title>
    </head>
    <body>
        <h2>Connecte-toi !</h2>
        <p>
        	<?php
            $a=1;
            try{
                $bdd = new PDO('mysql:host=localhost;dbname=MagicalBreeding;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }
            $reponse = $bdd->prepare('SELECT * FROM userList WHERE Pseudo= :pseudo AND Password= :password');
            if ((isset($_POST['pseudo']) AND isset($_POST['password'])) OR isset($_SESSION['pseudo'])){
                $liste = array('pseudo' => $_POST['pseudo'],'password' => $_POST['password']);
                $reponse->execute($liste);
                if ($reponse->fetch()==true){
                    ?>
                    <a href="premiere_page.php">Bienvenue</a>
                    <?php
                    $a=0;
                }
            } if ($a==1) {
                ?>
                <form action="connexion.php" method="post">
                    <label for="pseudo">Pseudo</label>
                    <input type="pseudo" name="pseudo" /><br/>
                    <label for="password">Password</label>
                    <input type="password" name="password" /><br/>
                    <input type="submit" value="Connexion" />
                </form>
                <?php
            }
            ?>
        </p>
    </body>
</html>