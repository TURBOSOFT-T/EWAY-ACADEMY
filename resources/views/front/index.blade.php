@extends('front.fixe')
@section('titre', 'Accueil')
@section('body')
<main>
    @php
    $config = DB::table('configs')->first();
    $service = DB::table('services')->get();
    $produit = DB::table('produits')->get();
    @endphp

    <!DOCTYPE html>
    <html lang="zxx">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/magnific-popup/dist/magnific-popup.css">

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/magnific-popup/dist/jquery.magnific-popup.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    <body>


        @include('front.components.banners')

        @include('front.components.formations')
        @include('front.components.about')

        <!-- Our Service Start -->
        @include('front.components.services')
        <!-- Our Service End -->


        @include('front.components.sponsor')

        <!-- Client Testimonial Start -->
        @include('front.components.testimonials')
        <!-- Client Testimonial End -->

        <!-- Our Blog Section End -->
        @include('front.components.blogs')
        <!-- Our Blog End -->


        <!-- latest-newsletter area start -->
        @include('front.components.newsletter')
        <!-- latest-newsletter area end -->





    </body>

    </html>

</main>






@endsection