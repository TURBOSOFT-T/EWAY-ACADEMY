
        <!-- Modal -->
        
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
        
        
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            {{ \App\Helpers\TranslationHelper::TranslateText('Témoignage') }}
                        </h5>
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
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        success: function(response) {

                            $('#exampleModal').modal('hide');

                            $('#successMessage').text(
                                'Témoignage créé avec succès ! Il sera valide après confirmation des administrateurs.'
                            ).fadeIn();

                            // Réinitialise le formulaire
                            form.trigger('reset');


                            setTimeout(function() {
                                location.reload();
                            }, 5000);
                        },
                        error: function(xhr) {

                            let errorText = 'Une erreur est survenue.';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorText = xhr.responseJSON.message;
                            }
                            $('#errorMessage').text(errorText).fadeIn();


                            setTimeout(function() {
                                $('#errorMessage').fadeOut();
                            }, 5000);
                        },
                        complete: function() {
                            submitButton.prop('disabled', false);
                        }
                    });
                });
            });
        </script>
