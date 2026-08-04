<!DOCTYPE html>
<html>
<head>
    <title>Votre code de vérification</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f7f9; color: #333; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
        .header { text-align: center; border-bottom: 1px solid #eee; padding-bottom: 20px; }
        .content { padding: 30px 0; text-align: center; }
        .code { font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #7367f0; background: #f0eeff; padding: 15px 25px; border-radius: 5px; display: inline-block; margin: 20px 0; }
        .footer { text-align: center; font-size: 12px; color: #888; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>EWAY-ACADEMY</h2>
        </div>
        <div class="content">
            <p>Bonjour,</p>
            <p>Pour finaliser votre création de compte, veuillez utiliser le code de vérification suivant :</p>
            
            <div class="code">{{ $code }}</div>
            
            <p>Ce code est valide pendant <strong>15 minutes</strong>.</p>
            <p>Si vous n'avez pas tenté , vous pouvez ignorer cet email en toute sécurité.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} EWAY-ACADEMY. Tous droits réservés.
        </div>
    </div>
</body>
</html>