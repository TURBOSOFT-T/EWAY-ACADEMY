

      
  

        <!-- Hero Section Start -->
        <div class="hero bg-image hero-slider">
            <div class="hero-slider-layout">
                <div class="swiper">
                    <div class="swiper-wrapper">

                        @foreach ($banners as $banner)
                        <div class="swiper-slide">
                            <div class="hero-slide">

                                <div class="hero-slider-image">
                                    <img src="{{ Storage::url($banner->image) }}" width="700" height="800" alt="">
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
            

           
        </style>



