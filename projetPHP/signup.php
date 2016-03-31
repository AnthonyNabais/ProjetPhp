<?php 

$bdd = new PDO('mysql:host=127.0.0.1;dbname=users', 'root', 'root');


if(isset($_POST['forminscription']))
{
	
	$pseudo = htmlspecialchars($_POST['pseudo']);
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$mail = htmlspecialchars($_POST['mail']);
	$mail2 = htmlspecialchars($_POST['mail2']);
	$mdp = sha1($_POST['mdp']);
	$mdp2 = sha1($_POST['mdp2']);
	$ddn = htmlspecialchars($_POST['ddn']);
	$departement = htmlspecialchars($_POST['departement']);
	$sex = ($_POST["sex"]);

	if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['pseudo']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['mail']) AND !empty($_POST['mail2'])  AND !empty($_POST['ddn']) AND !empty($_POST['departement']))
	{
		

		$pseudolenght = strlen($pseudo);
		if($pseudolenght <= 25)
		{
			$reqpseudo = $bdd->prepare("SELECT * FROM inscription WHERE pseudo = ?");
			$reqpseudo->execute(array($pseudo));
			$pseudoexist = $reqpseudo->rowCount();
			if($pseudoexist == 0)
			{
				if ($mail == $mail2)
				{
					if (filter_var($mail, FILTER_VALIDATE_EMAIL))
					{
						$reqmail = $bdd->prepare("SELECT * FROM inscription WHERE mail = ?");
						$reqmail->execute(array($mail));
						$mailexist = $reqmail->rowCount();
						if($mailexist == 0)
						{
							if ($mdp == $mdp2)
							{
								if($departement > 0 && $departement < 96 || $departement > 970 && $departement < 990)	
								{	
									$insertmbr = $bdd->prepare("INSERT INTO inscription(sex, nom, prenom, pseudo, mdp, mail, ddn, departement) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
									$insertmbr->execute(array($sex, $nom, $prenom, $pseudo, $mdp, $mail, $ddn, $departement));
									$erreur = "Votre compte a bien été crée!";
								}
								else
								{
									$erreur = "Departement invalide";
								}
							}
							else
							{
								$erreur = "Vos mots de passe ne correspondent pas";
							}
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
				else
				{
					$erreur = "Vos adresse mail ne correspondent pas";
				}
			}
			else
			{
				$erreur = "Ce pseudo est déja utilisé";
			}
		}
		else
		{
			$erreur = "Votre pseudo ne doit pas dépasser 25 caractères";
		}

	}
	else
	{

		$erreur = "Tous les champs doivent être complétés";
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
				<a href="index.html"><h1 id="noidea">Blin<span>D</span>ates</h1></a>
			</div>
			<div class="header">
				<form class="navbar-form navbar-right" >
					<div>
						<input type="text" class="btn-group" role="group" ng-model="Pseudo" placeholder="Pseudonyme">
						<input type="password" class="btn-group" role="group" ng-model="password" placeholder="Mot de passe">
					</div>
					<div>
						<button type="submit" class="btn btn-default navbar-btn">Connexion</button>
						<button ui-sref="register" type="button" class="btn btn-default navbar-btn">Inscription</button>
						<a ui-sref="resetpass">
							<h6>Mot de Passe oublié ?</h6>
						</a>
					</div>
				</form>
			</div>
			<div class="formulaire" id="gris">
				<form  method="post" action="">
					<table>
						<p id="truc">Informations <span>D</span>u Compte</p>
						<br>
						<tr>
							<td><label for="Genre">Genre :</label></td>
							<td>
								<label>
									<input type="radio" id="homme" name="sex" value="homme" CHECKED/>Homme
								</label>
								<label>
									<input type="radio" id="femme" name="sex" value="femme" />Femme
								</label>
							</td>
						</tr>

						<tr>
				            
					        <td><label for="nom">Votre nom :</label></td>
					        <td><input type="text" placeholder="Votre nom" name="nom" id="nom" value="<?php if(isset($nom)) {echo $nom;} ?>"/></td>
				            
				        </tr>

				        <tr>
				            
			            	<td><label for="prenom">Votre prenom :</label></td>
				            <td><input type="text" placeholder="Votre prenom" name="prenom" id="prenom" value="<?php if(isset($prenom)) {echo $prenom;} ?>"/></td>
				            
				        </tr>
			            
				        <tr>
				            
				            <td><label for="pseudo">Nom de compte :</label></td>
				            <td><input type="text" placeholder="Votre pseudo" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>" /></td>
				            
			            </tr>
				            
			            <tr>
				            
					        <td><label for="mdp">Mot de passe :</label></td>
					        <td><input type="password" placeholder="Votre mot de passe" name="mdp" id="mdp"/></td>
			           	</tr>
				            
				        <tr>
					            
					        <td><label for="mdp2">Confirmez le mot de passe :</label></td>
					        <td><input type="password" placeholder="Confirmez votre mot de passe" name="mdp2" id="mdp2"/></td>

					    </tr>

					     <tr>
				            
					        <td><label for="mail">Adresse Email :</label></td>
					        <td><input type="email" placeholder="Votre adresse Email" name="mail" id="mail" value="<?php if(isset($mail)) {echo $mail;} ?>"/></td>
			            </tr>
				            
				        <tr>
					            
					        <td><label for="mail2">Confirmez adresse mail :</label></td>
					        <td><input type="email" placeholder="Confirmez votre adresse Email" name="mail2" id="mail2" value="<?php if(isset($mail2)) {echo $mail2;} ?>"/></td>

					    </tr>


					    <tr>
				            
					        <td><label for="ddn">Date de naissance :</label></td>
					        <td><input type="date" placeholder="Votre date de naissance" name="ddn" id="ddn" value="<?php if(isset($ddn)) {echo $ddn;} ?>"/></td>
				            
				        </tr>
				            
				        <tr>
				            
					        <td><label for="departement">Votre département :</label></td>
					        <td><input type="text" placeholder="Votre département" name="departement" id="departement" value="<?php if(isset($departement)) {echo $departement;} ?>"/></td>
			            </tr>


			           	<tr>
			           		<td></td>
			           	</tr>
					</table>
					<input type="submit" name="forminscription" value="S'inscrire" id="publier"/>
					<a href="index.php"><input type="button" value="Retour accueil" id="publier"/></a>
				</form>
				<?php
			  		  if(isset($erreur))
			  		  {
			  		  	echo $erreur;
			  		  }
			  	?>
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
	</body>	
</html>	