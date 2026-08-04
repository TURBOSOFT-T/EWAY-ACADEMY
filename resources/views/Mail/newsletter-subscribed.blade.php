<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Merci pour votre abonnement</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; color:#333; padding: 30px;">
    <div style="background-color: white; border-radius: 8px; padding: 20px; max-width: 600px; margin: auto;">
        <h2 style="color:#2d89ef;">Merci pour votre abonnement à notre newsletter ! 🎉</h2>
        <p>Bonjour,</p>
        <p>Nous vous remercions d’avoir rejoint notre newsletter avec l’adresse suivante :</p>
        <p style="font-weight:bold;">{{ $email }}</p>
        <p>Vous recevrez bientôt nos offres spéciales, nouveautés et actualités directement dans votre boîte mail.</p>
        <p>À très bientôt,</p>

        {{-- <p>Si vous ne souhaitez plus recevoir nos e-mails, vous pouvez vous désabonner à tout moment en cliquant sur le lien ci-dessous :</p>

<p>
    <a href="{{ url('/newsletter/unsubscribe/' . $emailData->unsubscribe_token) }}"
       style="color:#d9534f; text-decoration:none; font-weight:bold;">
       Se désabonner
    </a>
</p> --}}


        
        <p><strong>L’équipe de {{ config('app.name') }}</strong></p>
    </div>
</body>
</html>
