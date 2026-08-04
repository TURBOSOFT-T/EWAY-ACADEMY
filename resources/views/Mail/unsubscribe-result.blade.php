<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Désabonnement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f7f7f7;
            margin: 0;
            padding: 50px;
        }
        .box {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            display: inline-block;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 { color: {{ $success ? '#28a745' : '#dc3545' }}; }
    </style>
</head>
<body>
    <div class="box">
        <h2>{{ $message }}</h2>
        <p><a href="{{ url('/') }}">← Retour à l’accueil</a></p>
    </div>
</body>
</html>
