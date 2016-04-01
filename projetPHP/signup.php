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
									$good = "Votre compte a bien été créé!";
								}
								else
								{
									$erreur = "Département invalide";
								}
							}
							else
							{
								$erreur = "Vos Mots de Passe ne correspondent pas";
							}
						}
						else
						{
							$erreur = "Adresse Mail déja utilisée";
						}

					}

					else
					{
						$erreur = "Adresse Mail non valide";
					}

				}
				else
				{
					$erreur = "Vos Adresses Mail ne correspondent pas";
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
				<h1 id="noidea">Blin<span>D</span>ates</h1>
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
				            
					        <td><label for="nom">Votre Nom :</label></td>
					        <td><input type="text" placeholder="Votre Nom" name="nom" id="nom" value="<?php if(isset($nom)) {echo $nom;} ?>"/></td>
				            
				        </tr>

				        <tr>
				            
			            	<td><label for="prenom">Votre Prenom :</label></td>
				            <td><input type="text" placeholder="Votre Prenom" name="prenom" id="prenom" value="<?php if(isset($prenom)) {echo $prenom;} ?>"/>
				            </td>
				            
				        </tr>
			            
				        <tr>
				            
				            <td><label for="pseudo">Pseu<span>D</span>onyme :</label></td>
				            <td><input type="text" placeholder="Votre Pseudo" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>"/>
				            </td>
				            
			            </tr>
				            
			            <tr>
				            
					        <td><label for="mdp">Mot <span>D</span>e Passe :</label></td>
					        <td><input type="password" placeholder="Mot de Passe" name="mdp" id="mdp"/></td>
			           	</tr>
				            
				        <tr>
					            
					        <td><label for="mdp2">Confirmez le Mot <span>D</span>e Passe :</label></td>
					        <td><input type="password" placeholder="Mot de Passe" name="mdp2" id="mdp2"/></td>

					    </tr>

					     <tr>
				            
					        <td><label for="mail">A<span>d</span>resse Mail :</label></td>
					        <td><input type="email" placeholder="Adresse Mail" name="mail" id="mail" value="<?php if(isset($mail)) {echo $mail;} ?>"/></td>
			            </tr>
				            
				        <tr>
					            
					        <td><label for="mail2">Confirmez A<span>d</span>resse Mail :</label></td>
					        <td><input type="email" placeholder="Adresse mail" name="mail2" id="mail2" value="<?php if(isset($mail2)) {echo $mail2;} ?>"/></td>

					    </tr>


					    <tr>
				            
					        <td><label for="ddn"><span>D</span>ate <span>D</span>e Naissance :</label></td>
					        <td><input type="date" placeholder="Votre date de naissance" name="ddn" id="ddn" value="<?php if(isset($ddn)) {echo $ddn;} ?>"/></td>
				            
				        </tr>
				            
				        <tr>
				            
					        <td><label for="departement">Votre <span>D</span>épartement :</label></td>
					        <td><input type="text" placeholder="Votre département" name="departement" id="departement" value="<?php if(isset($departement)) {echo $departement;} ?>"/></td>
			            </tr>
					</table>
					<input type="submit" name="forminscription" value="S'inscrire" id="publier2"/>
					<a href="index.php"><input type="button" value="Retour Accueil" id="publier2"/></a>
				</form>
				<?php
		  		  		if(isset($erreur))
		  		  		{
		  		  			echo '<font color="red">'.$erreur."</font>";

		  		  		}
		  		    ?>
		  		    <?php
		  		  		if(isset($good))
		  		  		{
		  		  			echo '<font color="green">'.$good."</font>";

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
						</div>
						<div class=" col-sm-3 main-el">
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
							&#169; Copyright 2016 - <a href="/mentions-legales">Mentions légales</a> - <a href="/conditions-generales-dutilisation">Conditions générales d'utilisation</a>
						</p>     
					</div>
				</div>
			</div>
		</footer>
	</body>	
</html>	