<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="style.css" />
<title>Ramassage Scolaire</title>
</head>
<body>
	<div id="rose">
		<!--ligne rose-->

	</div>
	<div id="bleu">
		<!--ligne rose-->

	</div>
	<div id="page">
		<header>
			<div id="image">
				<!--image de villepinte-->
				<img src="image/villepinte.png" width=230 height=120
					alt="Villepinte" />

			</div>
			<nav>
				<!--le menu-->
				<ul id="barre">
					<li><a href="ajouter.php">Ajouter</a></li>
					<li><a href="supprimer.php">Supprimer</a></li>
					<li><a style="color: #FA9F01;" href="#">Liste d'&eacute;l&egrave;ve</a></li>
					<li><a href="modifier.php">Modifier</a></li>
					<li><a href="">Statistique</a>
						<ul id="menu">
							<li><a href="mensuel.php">Mensuel</a></li>
							<li><a href="individuel.php">Individuel</a></li>
							<li><a href="bus.php">Bus</a></li>
						</ul></li>
					<li><a href="imprimer.php">Imprimer</a></li>
					<li><a href="tablette.php">Mise à jour</a></li>

				</ul>

			</nav>
		</header>

		<section id="afficher">
			<!-- on affiche tous les information dans un tableau -->

			<table id="listeE">
				<tr>
					<th>Lien et Nom du premier responsable</th>
					<th>Numéro de téléphone</th>
					<th>Lien et Nom du second responsable</th>
					<th>Numéro de téléphone</th>

					<th>Nom de l'élève</th>
					<th>Prenom de l'élève</th>
					<th>Niveau Scolaire</th>
					<th>Ecole</th>
					<th>Arret</th>
					<th>Rentre seul</th>

				</tr>
	<?php
	include 'fonction.php';
	include 'connect.php';
	$reponse = $connect->query ( 'SELECT count(*) FROM eleves' );
	// On affiche chaque entr�e une � une
	while ( $donnees = $reponse->fetch () ) {
		$nb = $donnees ['count(*)'];
	}
	echo '<h1 id="titre">Il y a  au total ' . $nb . ' élèves</h1>';
	$reponse = $connect->query ( 'SELECT count(*) FROM eleves' );
	// On affiche chaque entr�e une � une
	while ( $donnees = $reponse->fetch () ) {
		$nb = $donnees ['count(*)'];
	}
	$nombreDeMessagesParPage = 15; // Essayez de changer ce nombre pour voir
	$totalDesMessages = $nb;
	// On calcule le nombre de pages à créer
	$nombreDePages = ceil ( $totalDesMessages / $nombreDeMessagesParPage );
	// Puis on fait une boucle pour écrire les liens vers chacune des pages echo 'Page : ';
	
	// Maintenant, on va afficher les messages
	if (isset ( $_GET ['page'] )) {
		$page = $_GET ['page']; // On récupère le numéro de la page indiqué dans l'adresse (livreor.php?page=4)
	} else // La variable n'existe pas, c'est la première fois qu'on charge la page
{
		$page = 1; // On se met sur la page 1 (par défaut)
	}
	// On calcule le numéro du premier message qu'on prend pour le LIMIT de MySQL
	
	$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;
	
	$reponse = $connect->query ( 'SELECT * FROM eleves ORDER BY nom DESC LIMIT ' . $premierMessageAafficher . ', ' . $nombreDeMessagesParPage );
	
	while ( $donnees = $reponse->fetch () ) {
		
		?>
<tr>
					<td><?php echo  $donnees['lien_parente'].': '.$donnees['responsable_legal'];?></td>
					<td><?php echo $donnees['numero_tel_rl'];?></td>
					<td><?php echo  $donnees['lien_parente2'].': '.$donnees['responsable_legal2'];?></td>
					<td><?php echo $donnees['numero_tel_rl2'];?></td>
					<td><?php echo $donnees['nom'];?></td>
					<td><?php echo $donnees['prenom'];?></td>
					<td><?php echo $donnees['niveau_scolaire'];?></td>
					<td><?php echo $donnees['ecole'];?></td>
					<td><?php
		$nom = nomArret ( $donnees ['arret_idarret'] );
		echo $nom;
		?></td>
		<td><?php
		if($donnees['rentre_seul']==1){
		echo "oui";}
		else{
			echo"non";
		}
		?></td>
				</tr>


<?php
	}
	
	?>
</table>
<?php
echo '<br> <p id="lien_page">Page: ';
for($i = 1; $i <= $nombreDePages; $i ++) {
	echo '<a href="liste.php?page=' . $i . '">' . $i . '</a></p>
';
}
?>

		</section>

	</div>

</body>
</html>