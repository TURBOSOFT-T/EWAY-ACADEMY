<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Désabonnement Newsletter</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            background-color: #f6f8fa; 
            color: #333;
            text-align: center; 
            padding: 50px;
        }
        .box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .success { color: green; }
        .error { color: red; }
        .info { color: #888; }
    </style>
</head>
<body>
    <div class="box">
        @if ($status == 'success')
            <h2 class="success">{{ $message }}</h2>
        @elseif ($status == 'error')
            <h2 class="error">{{ $message }}</h2>
        @else
            <h2 class="info">{{ $message }}</h2>
        @endif

        <p>Merci d’avoir été parmi nos abonnés ❤️</p>
        <a href="{{ url('/') }}" style="color:#2d89ef; text-decoration:none;">Retour à l'accueil</a>
    </div>
</body>
</html>
