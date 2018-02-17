<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Inscription</title>
    </head>
    <body>
        <h2>Inscris-toi !</h2>
        <p>
        	<?php
        	$a=0;
        	try{
                $bdd = new PDO('mysql:host=localhost;dbname=MagicalBreeding;charset=utf8','root','root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }
            $reponse = $bdd->prepare('SELECT * FROM userInformation WHERE Pseudo= :pseudo OR Mail= :mail');
        	if (isset($_POST['pseudo']) AND isset($_POST['password']) AND isset($_POST['mail']) AND $_POST['confirmation']==$_POST['password']) {
        		$list = array('pseudo' => $_POST['pseudo'],'mail' => $_POST['mail']);
        		$reponse->execute($list);
        		if ($reponse->fetch()==true) {
        			echo 'Pseudo ou mail déjà pris.';
        		} else {
        			$req = $bdd->prepare('INSERT INTO userList (Pseudo,Password) VALUES (?, ?, ?)');
        			$req->execute;
        			$bdd->prepare('INSERT INTO userInformation (Pseudo,Mail,Administrator,Gold) VALUES ($_POST[\'Pseudo\'],$_POST[\'mail\'],0,2000)');
        			?>
        			<a href="premiere_page.php">Continuer...</a>
        			<?php
        			$a=1;
        		}
        	}
        	if ($a==0) {
        		?>
        		<form action="inscription.php" method="post">
        			<label for="pseudo">Pseudo</label>
        			<input type="pseudo" name="pseudo" /><br/>
        			<label for="mail">Adresse mail</label>
        			<input type="mail" name="mail" /><br/>
        			<label for="password">Mot de passe</label>
        			<input type="password" name="password" /><br/>
        			<label for="confirmation">Confirmation</label>
        			<input type="password" name="confirmation" /><br/>
        			<input type="submit" name="Valider">
        		</form>
        		<?php
        	}
        	?>
        </p>
    </body>
</html>