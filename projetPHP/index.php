<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=users', 'root', 'root');


if(isset($_POST['formconnect']))
{
	$pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
	$mdpconnect = sha1($_POST['mdpconnect']);
	if(!empty($pseudoconnect) AND !empty($mdpconnect))
	{
		$requser = $bdd->prepare("SELECT * FROM inscription WHERE pseudo = ? AND mdp = ?");
		$requser->execute(array($pseudoconnect, $mdpconnect));
		$userexist = $requser->rowCount();
		if($userexist == 1)
		{
			$userinfo = $requser->fetch();
			$_SESSION['id'] = $userinfo['id'];
			$_SESSION['pseudo'] = $userinfo['pseudo'];
			$_SESSION['mail'] = $userinfo['mail'];
			header("Location: connect.php?id=".$_SESSION['id']);
		}
		else
		{
			$erreur = "mauvais pseudo ou mot de passe";
		}
	}
	else
	{
		$erreur = "Vous devez rentrer votre pseudo et votre mot de passe";
	}
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
			</div>
			<div class="header">
				<form class="navbar-form navbar-right" method="POST" action="" >
					<div>
						<input type="text" class="btn-group" role="group" ng-model="Pseudo" name="pseudoconnect" placeholder="Pseudonyme">
						<input type="password" class="btn-group" role="group" ng-model="password" name="mdpconnect" placeholder="Mot de passe">
					</div>
					<div>
						<button type="submit" class="btn btn-default navbar-btn" name="formconnect">Connexion</button>
						<a href="signup.php"><button ui-sref="register" type="button" class="btn btn-default navbar-btn">Inscription</button></a>
						<?php
			  		  		if(isset($erreur))
			  		  		{
			  		  			echo '<font color="red">'.$erreur."</font>";
			  		  		}
			  		    ?>
					</div>
				</form>
			</div>
			<div class="slogan">
				<h2>Blin<span>D</span>ates, un site de rencontre simple et efficace</h2>
			</div>
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