<!DOCTYPE html>
<html>

    <head>
        
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
            <script src="http://github.com/aFarkas/html5shiv/blob/master/dist/html5shiv.js"></script>
         <![endif]-->
		<title>Inclusion de HTML5shiv</title>
		<link rel="stylesheet" href="styletchat.css"/>
   
   </head>

	<div id="tchat">

		<div id="barretitretchat">
		<h3>Tchat v1.5</h3>
		</div>
	
		<div id="fenetretchat">
			<?php
				try
				{
					$bdd = new PDO('mysql:host=localhost;dbname=jmldb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
				}
				catch (Exception $e)
				{
						die('Erreur : ' . $e->getMessage());
				}

				$reponse = $bdd->query('SELECT DATE_FORMAT(datemessage, \'%d/%m/%Y %Hh%imin%ss\') AS datemess, pseudo, message FROM tabletchat ORDER BY idmessage DESC LIMIT 0, 10'); // ici nous avons le calcul pour le bon format de date !

				while ($donnees = $reponse->fetch())
				{
					echo '<p>' . htmlspecialchars($donnees['datemess']) . ' ' . '<strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>'; // ici on veut afficher l'ALIAS datemess, parce qu'on veut le résultat du calcul, si on laisse "datemessage"(ou le nom de votre champ date dans votre BDD), cela entraine des erreurs, du moins chez moi ça à été le cas.
				}

				$reponse->closeCursor();
			?>
		</div>
	
		<div id="barreformtchat">
			<form action="calcultchat.php" method="POST">
				<label for="pseudo">Pseudo : </label><input type="text" name="pseudo" size="60" value="<?php if (isset($_COOKIE['pseudo'])){ echo htmlspecialchars($_COOKIE['pseudo']); }?>" maxlength="30" /></br></br> <!-- ici on insère dans le "value:" le code php pour utiliser le cookie qui garde le pseudo en mémoire, cookie défini sur calcultchat.php, notez que le ISSET est indispensable pour ne pas avoir de surprise à la première connexion ! --> 
				<label for="messagetchat">Message : </label><input type="text" name="messagetchat" size="60" placeholder=" Inscrivez votre message ici !" /></br></br>
				<div id="boutonposter"><input type="submit" value="poster !" /></div>
			</form>
		</div>
	
	</div>
	
</html>