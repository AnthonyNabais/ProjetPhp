<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=users', 'root', 'root');
if(isset($_SESSION['id']))
{
	$requser = $bdd->prepare('SELECT * FROM inscription WHERE id = ?');
	$requser->execute(array($_SESSION['id']));
	$user = $requser->fetch();
	if(!empty($_POST['newpseudo']))
	{
		$reqpseudo = $bdd->prepare("SELECT * FROM inscription WHERE pseudo = ?");
		$reqpseudo->execute(array($_POST['newpseudo']));
		$pseudoexist = $reqpseudo->rowCount();
		
		if($pseudoexist == 0)
		{	
			$newpseudo = htmlspecialchars($_POST['newpseudo']);
			$insertpseudo = $bdd->prepare("UPDATE inscription SET pseudo = ? WHERE id = ?");
			$insertpseudo->execute(array($newpseudo, $_SESSION['id']));
			header('Location: connect.php?id='.$_SESSION['id']);
		}
		else
		{
			$erreur = "Pseudo déja utilisé";
		}
	}
	if(!empty($_POST['newmail']))
	{
		if (filter_var($_POST['newmail'], FILTER_VALIDATE_EMAIL))
		{
			$reqmail = $bdd->prepare("SELECT * FROM inscription WHERE mail = ?");
			$reqmail->execute(array($_POST['newmail']));
			$mailexist = $reqmail->rowCount();
			
			if($mailexist == 0)
			{
				$newmail = htmlspecialchars($_POST['newmail']);
				$insertmail = $bdd->prepare("UPDATE inscription SET mail = ? WHERE id = ?");
				$insertmail->execute(array($newmail, $_SESSION['id']));
				header('Location: connect.php?id='.$_SESSION['id']);
			}
			else
			{
				$erreur = "Adresse mail déja utilisée";
			}
		}
		else
		{
			$erreur = "Adresse mail non valide";
		}
		
	}
	if(isset($_POST['newmdp']) AND !empty($_POST['newmdp']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2']))
	{
		$mdp = sha1($_POST['newmdp']);
		$mdp2 = sha1($_POST['newmdp2']);
		if($mdp == $mdp2)
		{
			$insertmdp = $bdd->prepare("UPDATE inscription SET mdp = ? WHERE id = ?");
			$insertmdp->execute(array($mdp, $_SESSION['id']));
			header('Location: connect.php?id='.$_SESSION['id']);
		}
		else
		{
			$erreur= "Vos mots de passe sont différents";
		}
		
	}
	if(isset($_POST['newpseudo']) AND $_POST['newpseudo'] == $user['pseudo'])
	{
		header('Location: connect.php?id='.$_SESSION['id']);
	}
?>


<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<meta http-equiv="Content-Language" content="fr" />
		<link rel="stylesheet" href="css/accueil.css">
		<title>BlinDates</title>
	</head>

	<body>
		<div class="contenu">
			<div class="titre" id="un">
				<h1>Blin<span>D</span>ates</h1>
				<h3>Profil de <?php echo $user['pseudo']; ?></h3>
			</div>
			<form action="" method="POST" id="formulaire3">
				<label for="">Pseu<span>D</span>o :</label>
				<input id="profil2" type="text" name="newpseudo" placeholder="Nouveau pseudo" value="<?php echo $user['pseudo']; ?>"><br>
				<label for="">A<span>D</span>resse Mail :</label>
				<input id="profil" type="text" name="newmail" placeholder="Nouveau mail" value="<?php echo $user['mail']; ?>"><br>
				<label for=""><span>D</span>épartement :</label>
				<input id="profil" type="text" name="newdepartement" placeholder="Nouveau departement" value="<?php echo $user['departement']; ?>"><br>
				<label for="">Nouveau Mot <span>D</span>e Passe :</label>
				<input id="profil" type="password" name="newmdp" placeholder="Nouveau Mot de Passe"><br>
				<label for="">Confirmation Mot <span>D</span>e Passe :</label>
				<input id="profil" type="password" name="newmdp2" placeholder="Confirmez Mot de Passe"><br>
				<label for=""><span>D</span>escription :</label><br>
				<textarea class="form-control" rows="7"></textarea>
				<input type="submit" value="Confirmer" id="publier">
			</form>
			<?php
			  		  if(isset($erreur))
			  		  {
			  		  	echo '<font color="red">'.$erreur."</font>";
			  		  }
			  	?>
		</div>
		

		<footer>
			<div id="footer">
				<div class="container">
					<div class="row">
						<div class="contactinfo col-sm-3 main-el">
							<div class="divider divider-5">
								<h5>Contact Info</h5>
							</div>
							<div class="contact-widget">
								<div class="line">
									<i class="address"></i> <div class="text">27 avenue de Fontarrabie 75020 Paris</div>
								</div>
								<div class="line">
									<i class="phone"></i>
									<div class="text">01.64.49.72.11</div>
								</div>
								<div class="line">
									<i class="mail"></i>
									<div class="text">contact @ BlinDates.com</div>
								</div>
								<div class="line">
									<i class="site"></i>
									<div class="text"><a href="" target="_blank">www.BlinDates.com</a></div>
								</div>
							</div>
						</div><div class=" col-sm-3 main-el">
						<div class="textwidget"><div class="divider divider-5"><h5>Services</h5><div class="separator"></div></div>
							<i class="bas"></i><a href="" title="Partenaires">Partenaires</a>
							<br/><i class="bas"></i><a href="" title="espaces publicitaires localisés">Espaces publicitaires</a><br/><i class="bas"></i>
							<a href="">Comment ça marche ?</a><br/>
						</div>
						</div>
					</div>
				</div>
				<br>
				<div id="botbar">
					<div class="container">
						<p class="copyright-text">
							&#169; Copyright 2016 - <a href="/mentions-legales">Mentions légales</a> - <a href="/conditions-generales-dutilisation">Conditions générales
							d'utilisation</a>
						</p>     
					</div>
				</div>
			</div>
		</footer>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	</body>
</html>	


<?php
}
else
{
	header("Location: index.php");
}
?>