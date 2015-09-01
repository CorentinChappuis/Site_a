<?php
$Erreur = 0;
if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['mdp']) && isset($_POST['mdp2']))
	{

//-----------------TEST MDP--------------------

		if (!empty($_POST['mdp']))
			{
				if ($_POST['mdp'] == $_POST['mdp2'])
					{
						if (preg_match("#^[^ ]{3,120}$#", $_POST['mdp']))
							{
								$mdp = $_POST['mdp'];
							}
						else
							{
								if (strlen($_POST['mdp']) > 120)
									{
										$Erreur['mdp_+120'] = 'true';
										$Erreur++;
									}
								elseif (strlen($_POST['mdp']) < 3)
									{
										$Erreur['mdp_-3'] = 'true';
										$Erreur++;
									}
								else
									{
										$Erreur['mdp_espace'] = 'true';
										$Erreur++;
									}
							}
					}
				else
					{
						$Erreur['mdp_identique'] = 'true';
						$Erreur++;
					}
			}
		else
			{
				$Erreur['mdp_vide'] = 'true';
				$Erreur++;
			}

//-----------------TEST PSEUDO-----------------

		if (!empty($_POST['pseudo'])
			{
				$pseudo_valid = file_get_contents("https://minecraft.net/haspaid.jsp?user=" . $_POST['pseudo']);
				if ($pseudo_valid == 'true')
					{
						try
							{
								$bdd = new PDO('mysql:host=localhost;dbname=compte;charset=utf8', 'login_bdd', 'mdp_bdd');
							}
						catch (Exception $e)
							{
								die('Erreur : ' . $e->getMessage());
							}
						$requete_pseudo = $bdd->prepare('SELECT pseudo FROM compte_user WHERE pseudo = ?');
						$requete_pseudo->execute(array($_POST['pseudo']));
						$verif_pseudo = $requete_pseudo->fetchAll();
						if (count($verif_pseudo) == 0)
							{
								$pseudo = $_POST['pseudo'];
							}
						else
							{
								$Erreur['pseudo_pris'] = 'true';
								$Erreur++;
							}
						$requete_pseudo->closeCursor;
					}
				else
					{
						$Erreur['pseudo_mc'] = 'true';
						$Erreur++;
					}
			}
		else
			{
				$Erreur['pseudo_vide'] = 'true';
				$Erreur++;
			}

//-----------------TEST EMAIL------------------

		if (preg_match("#^[a-zA-Z0-9]+@[a-z0-9._-]{2,}\.[a-zA-Z]{2,10}$#", $_POST['email']))
			{
				$requete_email = $bdd->prepare('SELECT email FROM compte_user WHERE email = ?');
				$requete_email->execute(array($_POST['email']));
				$verif_email = $requete_email->fetchAll();
				if (count($verif_email) == 0)
					{
						$email = $_POST['email'];
					}
				else
					{
						$Erreur['email_pris'] = 'true';
						$Erreur++:
					}
				$requete_email->closeCursor;
			}
		else
			{
				$Erreur['email_correct'] = 'true';
				$Erreur++;
			}
//---------------------------------------------
	}
else
	{
		$Erreur['isset'] = 'true';
		$Erreur++;
		header('Location: login.php');
	}
if ($Erreur == 0)
	{
		if ($_POST['news'] == 'on')
			{
				$news = 'true';
			}
		else
			{
				$news = 'false';
			}
		$cle = md5(uniqid(rand(), true));
		$cle_md5 = md5($cle);
		$ip_creation = $_SERVER['REMOTE_ADDR']
		$inscription = $bdd->prepare('INSERT INTO compte_user (pseudo, email, mdp, date_creation, cle, ip_creation, news) VALUES (:pseudo, :email, :mdp, NOW(), :cle, :ip_creation, :news)');
		$inscription->execute(array(
									'pseudo' => $pseudo,
									'email' => $email,
									'mdp' => $mdp,
									'cle' => $cle,
									'ip_creation' => $ip_creation,
									'news' => $news
									));
		$inscription->closeCursor;
		$inscrit = 'true';
	}
else
	{
		$Erreur['Erreur'] = 'true';
	}