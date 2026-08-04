<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bienvenue</title>
</head>
<body>
    <h2>Bonjour {{ $user->prenom }} {{ $user->nom }},</h2>

    <p>Votre compte a été créé avec succès pour votre inscription à une formation.</p>

    <p>Voici vos identifiants de connexion :</p>
    <ul>
        <li>Email : <strong>{{ $user->email }}</strong></li>
        <li>Mot de passe temporaire : <strong>{{ $temporaryPassword }}</strong></li>
    </ul>

    <p>
        Vous pouvez vous connecter en cliquant ici :  
        <a href="#">Se connecter</a>
    </p>

    <p style="color:red;">
        ⚠️ Nous vous recommandons de changer votre mot de passe dès votre première connexion.
    </p>

    <p>Merci,<br>L’équipe</p>
</body>
</html>
