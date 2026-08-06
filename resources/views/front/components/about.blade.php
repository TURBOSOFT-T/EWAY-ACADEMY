    <div class="about-us  pt-4 pb-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- About Us Content Start -->
                        <div class="about-content">
                            <!-- Section Title Start -->
                            <div class="section-title">
                                <h5 style="color:#003DA5;" class="wow fadeInUp"> {!! \App\Helpers\TranslationHelper::TranslateText($config->titre_home ?? ' ') !!}</h3>
                                
                                {{-- <h5 class="text-anime-style-2" data-cursor="-opaque"> {!! \App\Helpers\TranslationHelper::TranslateText($config->sous_titre_home ?? ' ') !!}
                                </h5> --}}
                                
                                <p class="wow fadeInUp" data-wow-delay="0.25s"  style=" font-family: 'Times New Roman';color: black;font-size: 18px; line-height: 2; text-align: justify;">
                                    {!! \App\Helpers\TranslationHelper::TranslateText($config->des_home ?? ' ') !!}
                                </p>

                            </div>



                        </div>
                        <!-- About Us Content End -->
                    </div>
                    <div class="col-lg-6">
                        <!-- About Image Start -->
                        <div class="about-us-image">
                            <div class="about-img">
                                <figure class="reveal image-anime">
                                    <img src="{{ Storage::url($config->image1_home) }}" alt="">
                                </figure>

                                <!-- Company Experience Box Start -->
                                <div class="company-experience">
                                    <div class="icon-box">
                                        <img src="images/icon-experience.svg" alt="">
                                    </div>
                                    <div class="company-experience-content">
                                        <h3><span class="counter"> {{ \App\Helpers\TranslationHelper::TranslateText($config->annees_experience) }}</span>+</h3>
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
