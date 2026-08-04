@extends('front.fixe')
@section('titre', 'Contact')
@section('body')
    @php
        $config = DB::table('configs')->first();
        $service = DB::table('services')->get();

    @endphp
    <main>



        <!-- Page Contact Start -->
        <div class="page-contact  pt-4 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <!-- Contact Info Item Start -->
                        <div class="contact-info-item wow fadeInUp">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="images/icon-green-location.svg" alt="">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Contact Info Content Start -->
                            <div class="contact-info-content">
                                <h3> {{ \App\Helpers\TranslationHelper::TranslateText('Location') }}</h3>
                                <p
                                    style="color: black; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-size: 18px; line-height: 2;margin: 0;">
                                    {{ $config->addresse }}</p>
                            </div>
                            <!-- Contact Info Content End -->
                        </div>
                        <!-- Contact Info Item End -->
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <!-- Contact Info Item Start -->
                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.25s">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="images/icon-green-mail.svg" alt="">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Contact Info Content Start -->
                            <div class="contact-info-content">
                                <h3>email</h3>
                                <p>
                                    <a style="color: black; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-size: 18px; line-height: 2;margin: 0;"
                                        href="mailto:tim.jennings@example.com">{{ $config->email }}</a>

                                </p>

                            </div>
                            <!-- Contact Info Content End -->
                        </div>
                        <!-- Contact Info Item End -->
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <!-- Contact Info Item Start -->
                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.5s">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="images/icon-green-phone.svg" alt="">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Contact Info Content Start -->
                            <div class="contact-info-content">
                                <h3>{{ \App\Helpers\TranslationHelper::TranslateText('Téléphone') }}</h3>
                                <p>
                                    <a style="color: black; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-size: 18px; line-height: 2;margin: 0;"
                                        href="https://wa.me/{{ preg_replace('/\D/', '', $config->telephone) }}"
                                        target="_blank">
                                        {{ $config->telephone }}
                                        <i class="fab fa-whatsapp"></i>

                                    </a>
                                <p>
                                    {{-- <p>(+01) 789 854 856</p>
							<p>(+02) 895 867 781</p> --}}
                            </div>
                            <!-- Contact Info Content End -->
                        </div>
                        <!-- Contact Info Item End -->
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <!-- Contact Info Item Start -->
                        <div class="contact-info-item wow fadeInUp" data-wow-delay="0.75s">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="images/icon-green-hour.svg" alt="">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Contact Info Content Start -->
                            <div class="contact-info-content">
                                <h3>
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Les horaires') }}
                                </h3>
                                <p
                                    style="color: black; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-size: 18px; line-height: 2;margin: 0;">
                                    Mon to Fri : 10:00 To 6:00</p>
                                <p
                                    style="color: black; font-family: 'Times New Roman', Times, serif; font-weight: normal; font-size: 18px; line-height: 2;margin: 0;">
                                    Sat : 10:00AM To 3:00PM</p>
                            </div>
                            <!-- Contact Info Content End -->
                        </div>
                        <!-- Contact Info Item End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Contact End -->

        <!-- Contact Form Start -->
        <div class="contact-us-form  pt-4 pb-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- Contact Us Image Start -->
                        <div class="contact-us-img">
                            <figure class="reveal image-anime">
                                <img src="{{ Storage::url($config->imagecontact) }}" alt="">
                            </figure>
                        </div>
                        <!-- Contact Us Image End -->
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-form">
                            <!-- Section Title Start -->
                            <div class="section-title" style="color:#000;">
                                <h3 class="text-anime-style-2" style="color:#000;" data-cursor="-opaque">
                                    <span>{{ \App\Helpers\TranslationHelper::TranslateText('Vous avez des questions?') }}
                                    </span>
                                    {{ \App\Helpers\TranslationHelper::TranslateText(' Besoin d’un plan personnalisé ?') }}
                                </h3>
                                <h3 class="wow fadeInUp" style="color:#000;">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Nous contactez') }}</h3>

                            </div>
                            <!-- Section Title End -->
                            @livewire('Front.ContactForm')

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact Form End -->

       
    <section class="latest-newsletter__area pt-80 pb-80 overflow-hidden latest-newsletter-bg">
    <div class="container p-relative">
        <div class="row">
            <div class="col-xl-12">
                <div class="latest-newsletter__content text-center">
                    <h2 class="title wow fadeInLeft animated" data-wow-delay=".4s">Newsletter</h2>
                    <p class="title wow fadeInLeft animated" data-wow-delay=".1s">
                        {!! \App\Helpers\TranslationHelper::TranslateText('Vous souhaitez bénéficier d\'offres spéciales') !!}<br>
                        {!! \App\Helpers\TranslationHelper::TranslateText('et mises à jour ?') !!}
                    </p>

                    <form id="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <div class="search custom-search d-flex wow fadeInRight animated" data-wow-delay=".4s">
                            <input type="email" name="email" class="form-control" id="newsletter-email" placeholder="Email">
                            <button type="submit" id="submit-btn" class="btn-default">S'inscrire maintenant</button>
                        </div>
                    </form>

                    <!-- Zone des messages -->
                    <p id="newsletter-message" class="mt-3 fw-bold"></p>
                </div>
            </div>
        </div>
    </div>
</section>
        <style>
            <style>.form-control {
                color: #000;
            }

            .form-control::placeholder {
                color: #000;
                opacity: 1;
            }
        </style>
        </style>

        </body>

        </html>


    </main>
@endsection
