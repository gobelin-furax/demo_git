<?php setcookie('pseudo', $_POST['pseudo'], time() + 1200, null, null, false, true); ?> <!-- ici, on définit le cookie qui va récupérer le $_POST et garder le pseudo en mémoire, sa durée de vie est fixée à 20 minutes, juste pour l'exercice --> 
<?php 
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=jmldb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
$req = $bdd->prepare('INSERT INTO tabletchat(pseudo, message, datemessage) VALUES(:pseudo, :message, NOW())'); // en ayant rajouté un champ dans la BDD pour la date et l'heure, voilà les calculs pour insérer ceux ci dans tabletchat.
$req->execute(array(
	'pseudo' => $_POST['pseudo'],
	'message' => $_POST['messagetchat'] // remarquez qu'on ne rajoute rien pour la date ici, parce que cela n'est pas nécessaire avec la fonction NOW() insérée dans VALUES, le calcul ne se faisant qu'au moment de poster.
	));
header('Location: tchat.php');
?>