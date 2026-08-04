<!DOCTYPE html>
<html>
<head>
    <title>Nouvelle actualité</title>
</head>
<body>
     <h1>Bienvenue chez EWAY-ACADEMY !</h1>
    <h2>Nouvelle publiée : {{ $blog->title }}</h2>
      <blockquote class="wow fadeInUp" data-wow-delay="0.4s">
                                <p     style=" font-family: 'Times New Roman';color: black;font-size: 18px; line-height: 2; text-align: justify;">
                                {!! 
                                   \App\Helpers\TranslationHelper::TranslateText($blog->meta_description) 
                                !!}     
                                </p>
                            </blockquote>
    <a href="#">Lire l’article complet</a>
</body>
</html>
