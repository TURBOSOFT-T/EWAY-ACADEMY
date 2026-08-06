@extends('front.fixe')
@section('titre', 'A propos de nous')
@section('body')

@php
$config = DB::table('configs')->first();

@endphp
<main>





    <!-- About Us Start -->
    <div class="about-us page-about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <!-- About Us Content Start -->
                    <div class="about-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp" style="color: #003DA5;">
                                {{ \App\Helpers\TranslationHelper::TranslateText('A propos de nous') }}
                            </h3>

                            <p class="wow fadeInUp custom-paragraph" data-wow-delay="0.25s" style=" font-family: 'Times New Roman';color: black;font-size: 18px; line-height: 2; text-align: justify;">

                                {!! \App\Helpers\TranslationHelper::TranslateText($config->des_apropos ?? '') !!}
                            </p>

                            <style>
                                .custom-paragraph {
                                    font-size: 20px;
                                    /* ajuste la taille selon ton besoin */
                                    line-height: 1.6;
                                    font-weight: 500;
                                }
                            </style>
                        </div>
                        <!-- Section Title End -->


                        <!-- About Us Footer End -->
                    </div>
                    <!-- About Us Content End -->
                </div>
                <div class="col-lg-6">
                    <!-- About Image Start -->
                    <div class="about-us-image">
                        <div class="about-img">
                            <figure class="reveal image-anime">
                                <img {{-- src="images/about-img.jpg" --}}src="{{ Storage::url($config->imageenteteabout) }}"
                                    alt="">
                            </figure>

                            <!-- Company Experience Box Start -->
                            <div class="company-experience">
                                <div class="icon-box">
                                    <img src="images/icon-experience.svg" alt="">
                                </div>
                                <div class="company-experience-content">
                                    <h3><span class="counter">
                                            {{ \App\Helpers\TranslationHelper::TranslateText($config->annees_experience) }}</span>+
                                    </h3>
                                    <p> {{ \App\Helpers\TranslationHelper::TranslateText('candidats formés') }}</p>
                                </div>
                            </div>
                            <!-- Company Experience Box End -->
                        </div>
                    </div>
                    <!-- About Image End -->
                </div>

            </div>
        </div>
    </div>
    <!--  About Us End -->

    <!-- Mission Vision Start -->
    <div class="mission-vision">
        <div class="container">


            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <!-- Mva Item Start -->
                    <div class="our-mva-item wow fadeInUp">
                        <!-- Icon Box Start -->
                        <div class="icon-box">
                            <img src="images/icon-our-mission.svg" alt="">
                        </div>
                        <!-- Icon Box End -->

                        <!-- Mva Content Start -->
                        <div class="mva-item-content">
                            <h3>
                                {{ \App\Helpers\TranslationHelper::TranslateText('Notre mission') }}
                            </h3>
                            <p style=" font-family: 'Times New Roman';color: black;font-size: 18px; line-height: 2; text-align: justify;"> {!! \App\Helpers\TranslationHelper::TranslateText($config->des_apropos1 ?? '') !!}</p>
                        </div>
                        <!-- Mva Content End -->
                    </div>
                    <!-- Mva Item End -->
                </div>

                <div class="col-lg-4  col-md-6">
                    <!-- Mva Item Start -->
                    <div class="our-mva-item wow fadeInUp" data-wow-delay="0.25s">
                        <!-- Icon Box Start -->
                        <div class="icon-box">
                            <img src="images/icon-our-vision.svg" alt="">
                        </div>
                        <!-- Icon Box End -->

                        <!-- Mva Content Start -->
                        <div class="mva-item-content">
                            <h3>
                                {{ \App\Helpers\TranslationHelper::TranslateText('Notre vision') }}
                            </h3>
                            <p style=" font-family: 'Times New Roman';color: black;font-size: 18px; line-height: 2; text-align: justify;"> {!! \App\Helpers\TranslationHelper::TranslateText($config->des_apropos2 ?? '') !!}</p>
                        </div>
                        <!-- Mva Content End -->
                    </div>
                    <!-- Mva Item End -->
                </div>

                <div class="col-lg-4 col-md-6">
                    <!-- Mva Item Start -->
                    <div class="our-mva-item wow fadeInUp" data-wow-delay="0.5s">
                        <!-- Icon Box Start -->
                        <div class="icon-box">
                            <img src="images/icon-our-approch.svg" alt="">
                        </div>
                        <!-- Icon Box End -->

                        <!-- Mva Content Start -->
                        <div class="mva-item-content">
                            <h3>
                                {{ \App\Helpers\TranslationHelper::TranslateText('Notre objectif') }}
                            </h3>
                            <p style=" font-family: 'Times New Roman';color: black;font-size: 18px; line-height: 2; text-align: justify;"> {!! \App\Helpers\TranslationHelper::TranslateText($config->des_apropos3 ?? '') !!}</p>
                        </div>
                        <!-- Mva Content End -->
                    </div>
                    <!-- Mva Item End -->
                </div>
            </div>

            <!-- Call To Action Start -->

            <!-- Call To Action End -->
        </div>
    </div>
    <!-- Mission Vision End -->





    <!-- latest-newsletter area start -->
   
        <!-- latest-newsletter area start -->
        @include('front.components.newsletter')
        <!-- latest-newsletter area end -->
        


    <br>





</main>
@endsection