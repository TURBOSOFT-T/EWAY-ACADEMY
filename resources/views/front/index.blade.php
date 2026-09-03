@extends('front.fixe')
@section('titre', 'Accueil')
@section('body')
<main>
  @php
  $config = DB::table('configs')->first();
  @endphp

  <!DOCTYPE html>
  <html lang="zxx">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/magnific-popup/dist/magnific-popup.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script> -->
  <body>
    @include('front.components.banners')
    @include('front.components.about')
    @include('front.components.categories')
    @include('front.components.services')
 
    @include('front.components.testimonials')
    @include('front.components.enseignants')
    @include('front.components.blogs')
    @include('front.components.newsletter')
  </body>
  </html>
</main>
@endsection