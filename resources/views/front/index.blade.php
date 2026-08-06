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


        <!-- Hero Section Start -->
        <div class="hero bg-image hero-slider">
            <div class="hero-slider-layout">
                <div class="swiper">
                    <div class="swiper-wrapper">

                        @foreach ($banners as $banner)
                        <div class="swiper-slide">
                            <div class="hero-slide">

                                <div class="hero-slider-image">
                                    <img src="{{ Storage::url($banner->image) }}" alt="">
                                </div>

                                <div class="container">
                                    <div class="row align-items-center">
                                        <div class="col-lg-12">

                                            <div class="hero-content">

                                                <div class="section-title">
                                                    {{-- <p> {{ \App\Helpers\TranslationHelper::TranslateText('Bienvenue à EWAY-ACADEMY') }}</p>
                                                    --}} <h2 class="text-anime-style-2" style="color:#003DA5;" data-cursor="-opaque">
                                                        {!! \App\Helpers\TranslationHelper::TranslateText($banner->titre ?? ' ') !!}
                                                    </h2>
                                                    <p class="wow fadeInUp" style="color:#ffffff; font-size: 22px;" data-wow-delay="0.25s"> {!! \App\Helpers\TranslationHelper::TranslateText($banner->sous_titre ?? ' ') !!}</p>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach



                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

        <style>
            .hero-slider-image {
                overflow: hidden;
                /* important */
                border-radius: 20px;
            }

            .hero-slider-image img {
                width: 100%;
                height: 600px;
                object-fit: cover;
                border: 4px solid #ffffff;
                border-radius: 20px;
            }


            /* Responsive */
            @media (max-width: 1024px) {
                .hero-slider-image img {
                    height: 450px;
                }
            }

            @media (max-width: 768px) {
                .hero-slider-image img {
                    height: 300px;
                }
            }

            .hero-slider-image {
                width: 100%;
                height: 600px;
                /* même hauteur partout */
                background-size: cover;
                /* adapte sans déformer */
                background-position: center;
            }
        </style>


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