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
									$insertmbr = $bdd->prepare("INSERT INTO inscription(nom, prenom, pseudo, mdp, mail, ddn, departement) VALUES (?, ?, ?, ?, ?, ?, ?)");
									$insertmbr->execute(array($nom, $prenom, $pseudo, $mdp, $mail, $ddn, $departement));
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
		 <meta http-equiv="Content-Language" content="fr" />
		 <link rel="stylesheet" href="css/accueil.css">
		 <title>Squelette</title>
	</head>

	<body>
			<div class="contenuInscription">
				
				<div class="formulaire">
					<form  method="POST" action="">
	        
			            <table>

			            	<p>Informations du compte</p>


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
					            <td><input type="date" placeholder="Votre date de naissance" name="ddn" id="ddn"/></td>
				            
				            </tr>
				            
				            <tr>
				            
					            <td><label for="departement">Votre département :</label></td>
					            <td><input type="text" placeholder="Votre département" name="departement" id="departement"/></td>
			           		 </tr>


			           		 <tr>
			           		 	<td></td>
			           		 	<td><input type="submit" name="forminscription" value="S'inscrire"/></td>
			           		 </tr>
				            
				            </table>
				    
			        
			  		  </form>

			  		  <?php
			  		  		if(isset($erreur))
			  		  		{
			  		  			echo $erreur;
			  		  		}
			  		  ?>
			  	</div>
	
			</div>

			
	
</html>	