<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=users', 'root', 'root');


if(isset($_SESSION['id']))

{
	$requser = $bdd->prepare('SELECT * FROM inscription WHERE id = ?');
	$requser->execute(array($_SESSION['id']));
	$user = $requser->fetch();


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

				<div class="formulaire2" id="gris2">
					<table>
						<p id="truc2">Informations <span>D</span>u Compte</p>
						<br>
						<tr>
							<td id="td">Sexe : <label for="Genre"><?php echo $user['sex']; ?></label></td>
						</tr>
						<tr>
							<td id="td">Pseudonyme : <label for="pseudonyme"><?php echo $user['pseudo']; ?></label></td>
						</tr>
						<tr>
							<td id="td">Adresse Mail : <label for="email"><?php echo $user['mail']; ?></label></td>
						</tr>
						<tr>
							<td id="td">Date de Naissance : <label for="ddn"><?php echo $user['ddn']; ?></label></td>
						</tr>
						<tr>
							<td id="tds">Département : <label for="depart"><?php echo $user['departement']; ?></label></td>
						</tr>
					</table>
					<a href="profile.php"><input type="submit" name="register" value="Modifier mon Profil" id="publier2"/></a>
					<input type="submit" name="register" value="Mes Messages" id="publier2"/>
					<br>
					<a href="deconnexion.php"><h4>Me déconnecter<h4></a>
				</div>
			</div>
			<div class="amesoeur">
				<p class="amesoeurtext">Pseu<span>D</span>o: Denis94</p>
				<p class="amesoeurtext">Age: 22 ans</p>
				<p class="amesoeurtext"><span>D</span>epartement: 75</p>
				<p class="amesoeurtext"><span>D</span>escription: J'aime les vidéos de phoques sur internet et la planche a voile</p>
			</div>
				<a href="recherchehommme.php"><input type="submit" name="register" value="Nouvelle recherche" id="publier3"/></a>
				<a href="connect.php"><input type="submit" name="register" value="Retour accueil" id="publier4"/></a>
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