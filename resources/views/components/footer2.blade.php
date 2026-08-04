@php
    $config = DB::table('configs')->first();

@endphp
<!--Site Footer Start-->





<div class="whatsapp-dark">
    <a href="https://wa.me/{{ preg_replace('/\D/', '', $config->telephone) }}" target="_blank">
        <i class="fab fa-whatsapp"></i>
    </a>
</div>

<style>
    .whatsapp-dark {
        position: fixed;
        bottom: 90px;
        right: 20px;
        width: 60px;
        height: 60px;
        background-color: #202c33;
        border: 2px solid #25D366;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .whatsapp-dark a {
        color: #25D366;
        font-size: 30px;
        text-decoration: none;
    }

    .whatsapp-dark:hover {
        background-color: #25D366;
    }

    .whatsapp-dark:hover a {
        color: white;
    }

    .whatsapp-float {
        position: fixed;
        bottom: 90px;
        right: 20px;
        background-color: #25D366;
        color: white;
        padding: 10px 15px;
        border-radius: 30px 30px 30px 0;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
        font-weight: bold;
        z-index: 1000;
    }

    .whatsapp-float i {
        font-size: 24px;
    }
</style>

<footer class="site-footer-two">
    {{-- <div class="site-footer-two__top">
        <div class="container">
            <div class="site-footer-two__top-inner">
                <a href="#" class="site-footer-two__top-content">Get Your <span>Ticket Now</span> <i
                        class="icon-arrow-up"></i></a>
            </div>
        </div>
    </div> --}}
    <div class="site-footer-two__middle">
        <div class="container">
            <div class="site-footer-two__middle-inner">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms">
                        <div class="footer-widget__column footer-widget-two__about">
                            <div class="site-footer-two__logo">
                                <a href="{{ url('/') }}"><img src="{{ Storage::url($config->logo) }} "
                                        class="logo-small" alt=""></a>
                            </div>
                            <p class="footer-widget-two__about-text">
                        {{--         {!! $config->description !!} --}}
                                   {!! \App\Helpers\TranslationHelper::TranslateText($config->description) !!} 
                            </p>

                            <div class="site-footer-two__social">
                                @if($config->facebook)
                                    <a href="{{ $config->facebook }}" title="Facebook" aria-label="Facebook"><i class="icon-facebook"></i></a>
                                @endif
                               
                                @if($config->instagram)
                                    <a href="{{ $config->instagram }}" title="Instagram" aria-label="Instagram"><i class="icon-instagram"></i></a>
                                @endif
                               
                                @if($config->youtube)
                                    <a href="{{ $config->youtube }}" title="YouTube" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                                @endif

                                @if($config->tiktok)
    <a href="{{ $config->tiktok }}" title="TikTok" aria-label="TikTok">
        <i class="fab fa-tiktok"></i>
    </a>
@endif
                            </div>
                            
                            {{-- <div class="site-footer-two__social">
                                <a href="#"><i class="icon-facebook"></i></a>
                                <a href="#"><i class="icon-fi"></i></a>
                                <a href="#"><i class="icon-instagram"></i></a>
                                <a href="#"><i class="icon-pinterest"></i></a>

                            </div> --}}
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
                        <div class="footer-widget__column footer-widget__events">
                            <div class="footer-widget__title-box">
                                <h3 class="footer-widget__title">   {!! \App\Helpers\TranslationHelper::TranslateText('Événements à venir') !!}</h3>
                            </div>
                            <ul class="footer-widget__events-list list-unstyled">
                             @foreach ($enventfooter as $event )
                             <li>
                                <p>{{ \Carbon\Carbon::parse($event->start)->format('d/m/Y') }}   {!! \App\Helpers\TranslationHelper::TranslateText('à') !!}  {{ \Carbon\Carbon::parse($event->heure)->format('H:i') }}
                                    <br>
                                    au {{ \Carbon\Carbon::parse($event->end)->format('d/m/Y') }}
                                </p>
                                <h5>{{ $event->titre ?? 'not name' }}

                                       {!! \App\Helpers\TranslationHelper::TranslateText($event->titre ?? 'not name') !!}
                                </h5>
                                <a  href="{{ route('details-events', ['id' => $event->id, 'slug'=>Str::slug(Str::limit($event->titre, 10))]) , }}">   {!! \App\Helpers\TranslationHelper::TranslateText('Reserver') !!} <span class="icon-arrow-right"></span></a>
                            </li>
                             @endforeach
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="300ms">
                        <div class="footer-widget__column footer-widget__contact">
                            <div class="footer-widget__title-box">
                                <h3 class="footer-widget__title">
                                      {!! \App\Helpers\TranslationHelper::TranslateText('Contact') !!}
                                </h3>
                            </div>
                            <div class="footer-widget__contact-inner">
                                <ul class="footer-widget__contact-list list-unstyled">
                                    <li>
                                        <div class="icon">
                                            <span class="icon-envelop"></span>
                                        </div>
                                        <div class="text">
                                            <p><a href="mailto:nafiz125@gmail.com">{{ $config->email }}</a>
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-pin"></span>
                                        </div>
                                        <div class="text">
                                            <p>{{ $config->addresse }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon">
                                            <span class="icon-call"></span>
                                        </div>
                                        <div class="text">
                                            <p> <a href="https://wa.me/{{ preg_replace('/\D/', '', $config->telephone) }}"
                                                    target="_blank">
                                                    {{ $config->telephone }}
                                                    <i class="fab fa-whatsapp"></i>

                                                </a></p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                   

                    <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
                        <div class="footer-widget__column footer-widget-two__newsletter">
                            <div class="footer-widget__title-box">
                                <h3 class="footer-widget__title">Newsletter</h3>
                            </div>
                            <p class="footer-widget-two__newsletter-text">

                                  {!! \App\Helpers\TranslationHelper::TranslateText('Vous souhaitez bénéficier d\'offres spéciales') !!}
                                <br>
                                  {!! \App\Helpers\TranslationHelper::TranslateText( ' et mises à jour des formations?') !!}
                               
                            </p>
                            <form  id="newsletter-form" class="footer-widget-two__newsletter-form "
                                action="{{ route('newsletter.subscribe') }}" method="POST" 
                                >
                                 @csrf
                                <div class="footer-widget-two__newsletter-form-input-box">
                                    <input type="email" name="email" id="newsletter-email" placeholder=" E-Email">

                                    <button type="submit" id="submit-btn" class="footer-widget-two__newsletter-btn"><span
                                            class="icon-paper-plan"></span></button>
                                </div> 
                               
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {
    // Vérifier si un message de succès ou d'erreur est dans la session
    @if(session('success'))
        Swal.fire('Succès', '{{ session('success') }}', 'success');
    @endif

    @if(session('error'))
        Swal.fire('Erreur', '{{ session('error') }}', 'error');
    @endif

    // Soumettre le formulaire newsletter avec AJAX
    $('#newsletter-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('newsletter.subscribe') }}", // Ta route d'abonnement
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                email: $('#newsletter-email').val()
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: response.message, // Message du back-end
                    timer: 3000,
                    showConfirmButton: false
                });

                $('#newsletter-email').val(''); // Réinitialiser le champ email
            },
            error: function (xhr) {
                let message = 'Erreur inconnue.';
                if (xhr.responseJSON?.errors?.email) {
                    message = xhr.responseJSON.errors.email[0]; // Afficher l'erreur de validation si elle existe
                }

                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: message // Message d'erreur
                });
            }
        });
    });
});
</script>

    


    <div class="site-footer-two__bottom">
        <div class="container">
            <div class="site-footer-two__bottom-inner">
                <p class="site-footer-two__bottom-text">(C){{ date('Y') }} COACH BELLE | All Rights Reserved</p>
                <ul class="list-unstyled site-footer-two__bottom-menu">
                    {{-- <li><a href="#">Trams & Condition</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Contact Us</a></li> --}}
                </ul>
            </div>
        </div>
    </div>
</footer>




<!--Site Footer End-->

</div><!-- /.page-wrapper -->
