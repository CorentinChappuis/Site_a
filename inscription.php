<html>
    <head>
        <meta charset="utf-8" />
        <title>inscription</title>
    </head>
    <body>
		<h1>Inscription</h1>
		<form method="post" action="inscription_compte.php">
			<h2>Bienvenue, ceci est un test pour une gestion de compte</h2>
			<p><input type="text" name="pseudo" autofocus/>Votre pseudo Minecraft</p>
			<p><input type="email" name="email"/>Email</p>
			<p><input type="password" name="mdp">Mot de passe <em>(min: 3 et max:120 caractère)</em></p>
			<p><input type="password" name="mdp2">Recrivez votre mot de passe</p>
			<p><input type="checkbox" name="news" checked />Etre informé des events et news à venir.</p>
			<p><input type="submit" /></p>
			<!-- Les verifications sont faites à la reception dans inscription_compte.php -->
		</form>
    </body>
</html>