<html lang="fr">
	<head>
		<title>Test nb prems</title>
		<meta charset=utf-8>
	</head>
	<!--
	petit test sur les nombre premier par arnaud_weixin.
	nb max est 100 par defaut.
	-->
	<body>
		<form method="post" action="prems.php">
			<h1>Calcul des premiers nombre premiers. (test)</h1>
			<p><input type="number" name="max" autofocus/> Nombre premier max</p>
			<p><input type="submit" /></p>
		</form>
<?php
	if (!empty($_POST['max']))
		{
			$max = $_POST['max'];
		}
	else
		{
			$max = 100;
		}
function affichePremiers($max)
	{
		if ($max > 30000)
			{
				$max = 30000;
				echo "<h2>Evitez au-delà de 30 000 ^^</h2>";
			}
		elseif (max < -30000)
			{
				$max = -30000;
				echo "<h2>Evitez au-dessous de - 30 000 ^^</h2>";
			}
		echo "<p>Les nombres premiers entre 0 et " . $max . " sont : </p>";
		$negatif = false;
		if($max < 0)
			{
				$negatif = true;
				$max = -$max;
			}
//On prend chaque nombre entre 2 et n (0 et 1 n'étant pas premier)
		for($i = 2;$i <= $max;$i++)
			{
				$nbDiv = 0;
//Et on compte le nombre de diviseur    
				for($j = 1;$j <= $i;$j++)
					{
						if($i % $j == 0)
							{
								$nbDiv++;            
							}
					}
				if($nbDiv == 2)
					{
//Un nombre premier est un chiffre qui ne possède que 2 diviseur (1 et lui-même)
						if($negatif)
							{
								echo "-";
							}
						echo $i . ", ";
					}
			}
	}
affichePremiers($max);
echo "<br />";
?>
    </body>
</html>