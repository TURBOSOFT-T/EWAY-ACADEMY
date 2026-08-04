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
    overflow: hidden; /* important */
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
    height: 600px; /* même hauteur partout */
    background-size: cover; /* adapte sans déformer */
    background-position: center;
}




        </style>

     
 

    <!-- Gallery Carousel Section Start -->
  <div class="gallery-carousel">
    <div class="gallery-track">

        @foreach ($sponsors as $banner)
            <div class="gallery-item">
                <img src="{{ Storage::url($banner->image) }}" alt="Sponsor">
            </div>
        @endforeach

        {{-- duplication pour l’infini --}}
        @foreach ($sponsors as $banner)
            <div class="gallery-item">
                <img src="{{ Storage::url($banner->image) }}" alt="Sponsor">
            </div>
        @endforeach

    </div>
</div>
<style>
    .gallery-carousel {
    width: 100%;
    overflow: hidden;
    position: relative;
    background: #fff;
}

.gallery-track {
    display: flex;
    width: max-content;
    animation: marquee 35s linear infinite;
}

.gallery-item {
    flex-shrink: 0;
    padding: 0 40px;
}

.gallery-item img {
    width: 200px;
    height: 200px;
    object-fit: contain;
}

/* Défilement complet */
@keyframes marquee {
    0% {
        transform: translateX(100%);
    }
    100% {
        transform: translateX(-50%);
    }
}
.gallery-carousel:hover .gallery-track {
    animation-play-state: paused;
}

</style>


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

        <!-- Our Service Start -->
        <div class="our-service  pt-4 pb-4">
            <div class="container">
                <div class="row align-items-center section-row">
                    <div class="col-lg-7">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            {{-- <h3 class="wow fadeInUp">theraphist team</h3> --}}
                            <h2 class="text-anime-style-2" data-cursor="-opaque">

                                {{ \App\Helpers\TranslationHelper::TranslateText('Formations') }}
                            </h2>
                        </div>
                        <!-- Section Title End -->
                    </div>

                    <div class="col-lg-5">

                    </div>
                </div>

                <div class="row">

                    @foreach ($formations as $formation)
                    <div class="col-lg-6 col-md-6">
                        <!-- Service Item Start -->
                        <div class="service-item wow fadeInUp" data-wow-delay="0.2s">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="{{ Storage::url($formation->image) }}" {{-- width="200" height="200" --}} alt="">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Service Body Start -->
                            <div class="service-body">
                                <p style="color:#003DA5;"> {{ \App\Helpers\TranslationHelper::TranslateText($formation->titre ?? ' ')  }}</p>
                                <p  style=" font-family: 'Times New Roman';color: black;font-size: 18px; line-height: 2; text-align: justify;">

                                    {!! \App\Helpers\TranslationHelper::TranslateText( Str::limit($formation->meta_description ?? ' ', 250)) !!}
                                </p>
                            </div>
                            <!-- Service Body End -->

                            <!-- Service Footer Start -->
                            <div class="service-footer">
                                <a href="{{ route('details-formations', ['id' => $formation->id, 'slug'=>Str::slug(Str::limit($formation->titre, 10))]) , }}" class="service-btn"><img src="images/arrow-white.svg" alt="">
                                </a>
                            </div>
                            <!-- Service Footer End -->
                        </div>
                        <!-- Service Item End -->
                    </div>

                    @endforeach






                </div>
            </div>
        </div>
        <!-- Our Service End -->


  
    
        <!-- Client Testimonial Start -->
        <div class="our-testimonial parallaxie">
            <div class="container">
                <div class="row section-row">
                    <div class="col-lg-12">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp" style="color: #003DA5;">
                                {{ \App\Helpers\TranslationHelper::TranslateText('Les retours de nos clients') }}
                            </h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque">

                                {{ \App\Helpers\TranslationHelper::TranslateText('Ce que nos clients disent de leur expérience') }}

                            </h2>
                        </div>
                        <!-- Section Title End -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <!-- Testimonial Slider Start -->
                        <div class="testimonial-slider">
                            <div class="swiper">
                                <div class="swiper-wrapper" data-cursor-text="Drag">
                                    <!-- Testimonial Slide Start -->
                                    @if ($testimonials->isEmpty())
                                    <p> {{ \App\Helpers\TranslationHelper::TranslateText('Aucun témoignage disponible') }}.
                                    </p>
                                    @else
                                    @foreach ($testimonials as $testimonial)
                                    <div class="swiper-slide">
                                        <div class="testimonial-item">
                                            <div class="testimonial-header">
                                                <div class="testimonial-rating">
                                                    @for ($i = 1; $i <= 5; $i++) @if ($i <=$testimonial->stars)
                                                        <i class="fa-solid fa-star"></i>
                                                        @else
                                                        <span class="icon-star text-muted"></span>
                                                        @endif
                                                        @endfor

                                                </div>
                                                <div style="color:#0c0c0c;" class="testimonial-content">
                                                    <p style=" font-family: 'Times New Roman';color: black;font-size: 18px; line-height: 2; text-align: justify;">{!! \App\Helpers\TranslationHelper::TranslateText($testimonial->message) !!}</p>
                                                </div>
                                            </div>
                                            <div class="testimonial-body">
                                                <div class="author-image">

                                                    <figure class="image-anime">
                                                        @if ($testimonial->photo)
                                                        <img src="{{ asset('uploads/testimonials/' . $testimonial->photo) }}" alt="Photo Témoignage" width="100" height="100">
                                                        @else
                                                        <img src="images/author-1.jpg" alt="">
                                                        @endif
                                                    </figure>
                                                </div>
                                                <div class="author-content">
                                                    <h3>{{ $testimonial->name }}</h3>
                                                    {{-- <p>Student</p> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Testimonial Slide End -->
                                    @endforeach
                                    @endif
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                        <!-- Testimonial Slider End -->


                        <br><br>
                        <br>
                        <div class="col-12 d-flex justify-content-center">
                            <div class="form-group mb--0">
                                <button type="submit" class="btn-default disabled" data-bs-toggle="modal" data-bs-target="#exampleModal">


                                    {{ \App\Helpers\TranslationHelper::TranslateText('Laissez un témoignage') }}
                                    <span class="icon-arrow-right"></span></button>
                            </div>

                        </div>


                        <div id="successMessage" class="alert alert-success" style="display:none;"></div>
                        <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Client Testimonial End -->

        <!-- Our Blog Section End -->
        <div class="our-blog  pt-4 pb-4">
            <div class="container">
                <div class="row section-row align-items-center">
                    <div class="col-lg-9">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp" style="color: #003DA5;"> {{ \App\Helpers\TranslationHelper::TranslateText('Actualités') }}</h3>
                            <h2 class="text-anime-style-2" data-cursor="-opaque"><span style="color: #003DA5;"> {{ \App\Helpers\TranslationHelper::TranslateText('Restez informer') }}</span>
                            </h2>
                        </div>
                        <!-- Section Title End -->
                    </div>

                    <div class="col-lg-3">
                        <!-- Section Button Start -->
                        <div class="section-btn wow fadeInUp" data-wow-delay="0.25s">
                            {{-- <a href="#" class="btn-default"  style="color: #f3f3f6;"> {{ \App\Helpers\TranslationHelper::TranslateText('Voir tout') }}</a>
                            --}} </div>
                        <!-- Section Button End -->
                    </div>
                </div>

                <div class="row">
                    @foreach ($blogs as $blog )
                    <div class="col-lg-4 col-md-6">
                        <!-- Blog Item Start -->
                        <div class="blog-item wow fadeInUp">
                            <!-- Post Featured Image Start-->
                            <div class="post-featured-image" data-cursor-text="View">
                                <figure>
                                    <a a href="{{ route('details-blogs', ['id' => $blog->id, 'slug'=>Str::slug(Str::limit($blog->title, 10))]) , }}" class="image-anime">
                                        <img src="{{ Storage::url($blog->image) }}" alt="">
                                    </a>
                                </figure>
                            </div>
                            <!-- Post Featured Image End -->

                            <!-- post Item Content Start -->
                            <div class="post-item-content">
                                <!-- post Item Body Start -->
                                <div class="post-item-body">
                                    <h2><a a href="{{ route('details-blogs', ['id' => $blog->id, 'slug'=>Str::slug(Str::limit($blog->title, 10))]) , }}"> {{ \App\Helpers\TranslationHelper::TranslateText($blog->title) }}</a></h2>
                                </div>
                                <!-- Post Item Body End-->

                                <!-- Post Item Footer Start-->
                                <div class="post-item-footer">
                                    {{-- <a  href="{{ route('details-blogs', ['id' => $blog->id, 'slug'=>Str::slug(Str::limit($blog->title, 10))]) , }}" class="readmore-btn">

                                    {{ \App\Helpers\TranslationHelper::TranslateText('Voir plus') }}
                                    </a> --}}
                                    <a href="{{ route('details-blogs', ['id' => $blog->id, 'slug'=>Str::slug(Str::limit($blog->title, 10))]) }}" class="readmore-btn" style="color: black;">
                                        {{ \App\Helpers\TranslationHelper::TranslateText('Voir plus') }}
                                    </a>

                                </div>
                                <!-- Post Item Footer End-->
                            </div>
                            <!-- post Item Content End -->
                        </div>
                        <!-- Blog Item End -->
                    </div>

                    @endforeach


                </div>
            </div>
        </div>
        <!-- Our Blog End -->


    <!-- latest-newsletter area start -->
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
    <br>



        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ \App\Helpers\TranslationHelper::TranslateText('Témoignage') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>



                    <div class="modal-body">
                        <form id="testimonialForm" action="{{ route('testimonial.store') }}" method="POST" class="testimonial-form p-4 rounded shadow-sm bg-light">
                            @csrf
                            <div class="form-group mb-4">
                                <label class="form-label text-muted d-block mb-2">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Votre nom') }}
                                </label>
                                <input type="text" class="form-control border-0 rounded-pill shadow-sm" id="name" name="name" required>
                            </div>
                            {{-- Note par étoiles --}}
                            <div class="form-group mb-4">
                                <label class="form-label text-muted d-block mb-2">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Note') }}
                                </label>
                                <div class="star-rating">

                                    @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="stars" value="{{ $i }}" required>
                                    <label for="star{{ $i }}" title="{{ $i }} étoiles">&#9733;</label>
                                    @endfor
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="testimonial" class="form-label text-muted">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Message') }}</label>
                                <textarea class="form-control border-0 rounded-3 shadow-sm" id="testimonial" name="message" rows="8" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn-default disabled">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Envoyer') }}</button>
                            </div>
                        </form>


                        @if ($errors->any())
                        <div class="alert alert-danger mt-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (session('success'))
                        <div class="alert alert-success mt-4">
                            {{ session('success') }}
                        </div>
                        @endif
                        <style>
                            .star-rating {
                                direction: rtl;
                                display: inline-flex;
                                gap: 5px;
                            }

                            .star-rating input[type="radio"] {
                                display: none;
                            }

                            .star-rating label {
                                font-size: 2rem;
                                color: #ccc;
                                cursor: pointer;
                            }

                            .star-rating input[type="radio"]:checked~label,
                            .star-rating label:hover,
                            .star-rating label:hover~label {
                                color: #FFD700;
                                /* jaune étoile */
                            }

                            .testimonial-form {
                                max-width: 600px;
                                margin: 0 auto;
                                background-color: #f8f9fa;
                            }

                            .form-group {
                                margin-bottom: 1.5rem;
                            }

                            .form-label {
                                font-weight: 600;
                                font-size: 1rem;
                            }

                            .form-control {
                                padding: 0.75rem 1rem;
                                font-size: 1rem;
                                color: #495057;
                                background-color: #fff;
                                border-radius: 25px;
                            }

                            textarea.form-control {
                                border-radius: 15px;
                            }

                            button.btn {
                                padding: 0.5rem 2rem;
                                font-size: 1.125rem;
                                transition: background-color 0.3s ease;
                            }

                            button.btn-primary {
                                background-color: #EFB121;
                                border-color: #EFB121;
                            }

                            button.btn-primary:hover {
                                background-color: #EFB121;
                                border-color: #EFB121;
                            }

                            .alert {
                                max-width: 600px;
                                margin: 1rem auto;
                            }

                        </style>

                    </div>



                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#testimonialForm').on('submit', function(e) {
                    e.preventDefault();

                    var form = $(this);
                    var submitButton = form.find('button[type="submit"]');
                    submitButton.prop('disabled', true);

                    $.ajax({
                        url: form.attr('action')
                        , method: form.attr('method')
                        , data: form.serialize()
                        , success: function(response) {

                            $('#exampleModal').modal('hide');

                            $('#successMessage').text(
                                'Témoignage créé avec succès ! Il sera valide après confirmation des administrateurs.'
                            ).fadeIn();

                            // Réinitialise le formulaire
                            form.trigger('reset');


                            setTimeout(function() {
                                location.reload();
                            }, 5000);
                        }
                        , error: function(xhr) {

                            let errorText = 'Une erreur est survenue.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorText = xhr.responseJSON.message;
                            }
                            $('#errorMessage').text(errorText).fadeIn();


                            setTimeout(function() {
                                $('#errorMessage').fadeOut();
                            }, 5000);
                        }
                        , complete: function() {
                            submitButton.prop('disabled', false);
                        }
                    });
                });
            });

        </script>


    </body>

    </html>

</main>






@endsection
