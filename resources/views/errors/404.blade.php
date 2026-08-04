@extends('front.fixe')

@section('body')
    <main>
        {{-- <div class="breadcrumb">
            <div class="container">
                <h2>Page introuvable</h2>

            </div>
        </div> --}}
        <!-- error area start -->
        <div class="tp-error-area pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="tp-error-content-box text-center">
                            <div class="tp-error-thumb-box pb-95">
                                <img src="assets/images/404/404.png" width="50" height="200" class="img">


                            </div>
                            <style>
                                @media (max-width: 767px) {
                                    .tp-error-content {
                                        font-size: 30px;
                                        text-align: center;
                                    }
                                }
                            </style>
                            <div class="tp-error-content" style=" font-size: 18px;">
                                <h4 class="tp-section-title pb-10">Désolé, page introuvable</h4>
                                <p class="mb-45">La page que vous recherchez ne se ferme pas. Veuillez l'essayer.</p>
                                <a class="tp-btn-theme" href="{{ route('home') }}">
                                    <span>
                                        Retour a l'Accueil
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- error area end -->
    </main>


    <style>
        .img {
            max-width: 100%;
            width: 500px;
        }
    </style>
@endsection
