@extends('front.fixe')
@section('titre', $formation->titre)
@section('body')
    @php
        $config = DB::table('configs')->first();

    @endphp

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    </head>

    <!--Contact One Start-->



    <section class="contact-one">
        <div class="container">
            <div class="contact-one__inner">


                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @guest
                    <div class="alert alert-info mt-3">
                        {{ \App\Helpers\TranslationHelper::TranslateText(
                            'Un compte sera automatiquement créé pour vous. 
                                                                                     Votre identifiant sera votre adresse e-mail et 
                                                                                     votre mot de passe provisoire sera créé. 
                                                                                     Vous recevrez un e-mail de confirmation avec vos informations de connexion.',
                        ) }}
                    </div>
                @endguest

                <form id="formationForm" class="contact-form-validated contact-one__form" method="POST"
                    {{-- action="{{ route('event.confirm') }}" --}}>
                    @csrf
                    <input type="hidden" name="formation_id" value="{{ $formation->id }}">
                    <div class="row">




                        <div class="form-group col-md-6 mb-4">
                            <div class="contact-one__input-box">
                                <input class="form-control" name="nom" type="text"
                                    placeholder=" {{ \App\Helpers\TranslationHelper::TranslateText('Votre nom') }}"
                                    @if (Auth::user()) value="{{ Auth::user()->nom ?? '' }}" @endif
                                    required="required">
                                @error('nom')
                                    <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6 mb-4">
                            <div class="contact-one__input-box">
                                <input class="form-control" name="prenom" type="text"
                                    placeholder=" {{ \App\Helpers\TranslationHelper::TranslateText('Votre prénom') }}"
                                    @if (Auth::user()) value="{{ Auth::user()->prenom ?? '' }}" @endif
                                    required="required">
                                @error('prenom')
                                    <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <div class="contact-one__input-box">
                                <input name="email" class="form-control" type="email" placeholder=" Email"
                                    @if (Auth::user()) value="{{ Auth::user()->email ?? '' }}" @endif
                                    required="required">
                                @error('email')
                                    <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Autres champs comme téléphone, adresse, message -->
                        <div class="form-group col-md-6 mb-4">
                            <div class="contact-one__input-box">
                                <input name="addresse" class="form-control" type="text"
                                    placeholder=" {{ \App\Helpers\TranslationHelper::TranslateText('Votre adresse') }}"
                                    @if (Auth::user()) value="{{ Auth::user()->adresse ?? '' }}" @endif>
                                @error('addresse')
                                    <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <div class="contact-one__input-box">


                                <select name="country_id" id="country_id" class="form-control"
                                    style=" background-color: #e0dfe5">
                                    <option value="">
                                        {{ \App\Helpers\TranslationHelper::TranslateText('--Choisir pays--') }}</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"data-code="{{ $country->phonecode }}">
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <div class="contact-one__input-box">
                                <input class="form-control" name="ville" type="text"
                                    placeholder=" {{ \App\Helpers\TranslationHelper::TranslateText('Votre ville') }}"
                                    required>
                                @error('ville')
                                    <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6 mb-4">
                            <div class="contact-one__input-box whatsapp-box">
                                <select id="phone_country" class="form-control">
                                    <option value="">{{ \App\Helpers\TranslationHelper::TranslateText('Pays') }}
                                    </option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" data-code="{{ $country->phonecode }}">
                                            {{ $country->name }} (+{{ $country->phonecode }})
                                        </option>
                                    @endforeach
                                </select>

                                <input id="telephone" name="telephone" type="tel" class="form-control"
                                    placeholder="{{ \App\Helpers\TranslationHelper::TranslateText('Votre Téléphone') }}"
                                    required>
                            </div>

                            @error('telephone')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        {{--  <div class="form-group col-md-6 mb-4">
                            <div class="contact-one__input-box">
                                <input name="telephone" id="phones" class="form-control" type="text"
                                    placeholder=" {{ \App\Helpers\TranslationHelper::TranslateText('Votre téléphone') }}"
                                    @if (Auth::user()) value="{{ Auth::user()->phone ?? '' }}" @endif
                                    required="required">
                                @error('telephone')
                                    <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
 
                         <script>
                            const phonesInputField = document.querySelector("#phones");
                            const phonesInput = window.intlTelInput(phonesInputField, {
                                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                            });
                        </script> --}}

                        <div class="form-group col-md-6 mb-4">
                            <div class="contact-one__input-box whatsapp-box">
                                <select id="whatsapp_country" class="form-control">
                                    <option value="">Pays WhatsApp</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" data-code="{{ $country->phonecode }}">
                                            {{ $country->name }} (+{{ $country->phonecode }})
                                        </option>
                                    @endforeach
                                </select>

                                <input id="whatsapp" name="whatsapp" type="tel" class="form-control"
                                    placeholder="{{ \App\Helpers\TranslationHelper::TranslateText('Votre WhatsApp') }}"
                                    required>
                            </div>

                            @error('whatsapp')
                                <span class="small text-danger">{{ $message }}</span>
                            @enderror
                        </div>





{{-- Champs spécifiques selon le type de formation --}}
@if($type === 'traduction')
    <div class="form-group col-md-6 mb-4">
        <label>Langue source *</label>
        <select name="langue_source" class="form-control" required>
            @foreach(['arabe','anglais','mandarin','espagnol','français'] as $lang)
                <option value="{{ $lang }}">{{ ucfirst($lang) }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-6 mb-4">
        <label>Langue destination *</label>
        <select name="langue_destination" class="form-control" required>
            @foreach(['arabe','anglais','mandarin','espagnol','français'] as $lang)
                <option value="{{ $lang }}">{{ ucfirst($lang) }}</option>
            @endforeach
        </select>
    </div>

@elseif($type === 'formation')
    <div class="form-group col-md-6 mb-4">
        <label>Test officiel *</label>
        <select name="test_officiel" class="form-control" required>
            @foreach(['TCF','TEF','TECFEE','Examen universel de français','SEL','Bright'] as $test)
                <option value="{{ $test }}">{{ $test }}</option>
            @endforeach
        </select>
    </div>

@elseif($type === 'cours de français')
    <div class="form-group col-md-6 mb-4">
        <label>Type de cours *</label>
        <select name="type_cours" class="form-control" required>
            @foreach(['cours pour adulte','cours pour enfants','cours pour entreprises et professionnel'] as $cours)
                <option value="{{ $cours }}">{{ $cours }}</option>
            @endforeach
        </select>
    </div>

@elseif($type === 'etudes')
    <div class="form-group col-md-6 mb-4">
        <label>Diplôme le plus élevé *</label>
        <select name="diplome_plus_eleve" class="form-control" required>
            @foreach([
                'diplôme de fin d’études secondaire',
                'diplôme universitaire 2 ans',
                'diplôme universitaire 3 ans',
                'diplôme universitaire 4 ans / 5 ans'
            ] as $diplome)
                <option value="{{ $diplome }}">{{ $diplome }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-md-6 mb-4">
        <label>Domaine d'étude *</label>
        <input type="text" name="domaine_etude" class="form-control" required>
    </div>

    <div class="form-group col-md-6 mb-4">
        <label>Spécialité *</label>
        <input type="text" name="specialite" class="form-control" required>
    </div>

    <div class="form-group col-md-12 mb-4">
        <label>Projet d'études</label>
        <textarea name="projet_etudes" class="form-control"></textarea>
    </div>

    <div class="form-group col-md-6 mb-4">
        <label>Domaine d'études visées</label>
        <input type="text" name="domaine_etudes_visees" class="form-control">
    </div>

    <div class="form-group col-md-6 mb-4">
        <label>Spécialité visée</label>
        <input type="text" name="specialite_visee" class="form-control">
    </div>

    <div class="form-group col-md-12 mb-4">
        <label>Motivation études Canada</label>
        <textarea name="motivation_etudes_canada" class="form-control"></textarea>
    </div>
@endif





                        <div class="col-xl-12">
                            <div class="contact-one__input-box text-message-box">
                                <textarea name="message" class="form-control"
                                    placeholder=" {{ \App\Helpers\TranslationHelper::TranslateText('Laisser une note') }}"></textarea>
                                @error('message')
                                    <span class="small text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <br>
                            <div class="contact-one__btn-box">
                                <button type="submit" class="btn-default disabled">
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Confirmation') }} <span
                                        class="icon-arrow-right"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="result"></div>
            </div>
        </div>
        <br>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                $('#formationForm').on('submit', function(e) {
                    e.preventDefault();

                    let form = $(this);
                    let formData = form.serialize();

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('formation.confirm') }}', // Assure-toi que cette route est correcte
                        data: formData,
                        success: function(response) {
                            if (response.status === 'duplicate') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Déjà inscrit',
                                    text: response.message
                                });
                            } else {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Inscription réussie',
                                    text: response.message
                                });
                                form[0].reset(); // Réinitialiser le formulaire
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                let errorMessages = '';
                                $.each(errors, function(key, value) {
                                    errorMessages += value + '<br>';
                                });

                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreurs de validation',
                                    html: errorMessages
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Erreur',
                                    text: 'Une erreur est survenue. Veuillez réessayer.'
                                });
                            }
                        }
                    });
                });
            });
        </script>

        <script>
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    confirmButtonColor: '#d33'
                });
            @endif
        </script>



<script>
    $(document).ready(function () {
        function bindCountrySelector(selectId, inputId) {
            const $select = $(selectId);
            const $input = $(inputId);

            // Quand le pays change → mettre le code
            $select.on('change', function () {
                let code = $(this).find(':selected').data('code');
                if (code) {
                    let current = $input.val();
                    if (!current.startsWith('+' + code)) {
                        $input.val('+' + code + ' ');
                    }
                }
            });

            // Quand on tape dans l'input → détecter le pays
            $input.on('input', function () {
                let val = $(this).val();
                if (val.startsWith('+')) {
                    let matches = val.match(/^\+(\d{1,4})/);
                    if (matches) {
                        let code = matches[1];
                        let found = false;
                        $select.find('option').each(function () {
                            if ($(this).data('code') == code) {
                                $(this).prop('selected', true);
                                found = true;
                            }
                        });
                        if (!found) $select.val('');
                    } else {
                        $select.val('');
                    }
                } else {
                    $select.val('');
                }
            });
        }

        // On initialise pour téléphone et WhatsApp
        bindCountrySelector('#phone_country', '#telephone');
        bindCountrySelector('#whatsapp_country', '#whatsapp');
    });
</script>




        <style>
            .whatsapp-box {
                display: flex;
                gap: 8px;
            }

            .whatsapp-box select {
                max-width: 40%;
                /* largeur du select */
            }

            .whatsapp-box input {
                flex: 1;
                /* prend tout l’espace restant */
            }
        </style>

<style>
/* Container flex pour que select + input soient alignés */
.whatsapp-box {
    display: flex;
    gap: 10px;
}

/* Style du select */
.whatsapp-box select {
    flex: 0 0 35%; /* largeur fixe à 35% */
    border: 1px solid #ced4da;
    border-radius: 6px;
    padding: 8px 10px;
    background-color: #f9f9f9;
    font-size: 14px;
    transition: all 0.3s ease;
}

/* Changement couleur au focus */
.whatsapp-box select:focus {
    border-color: #007bff;
    background-color: #fff;
    outline: none;
}

/* Style de l'input */
.whatsapp-box input {
    flex: 1; /* prend tout l’espace restant */
    border: 1px solid #ced4da;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 14px;
    transition: all 0.3s ease;
}

/* Changement couleur au focus */
.whatsapp-box input:focus {
    border-color: #007bff;
    outline: none;
}

/* Gestion responsive mobile */
@media (max-width: 768px) {
    .whatsapp-box {
        flex-direction: column;
    }

    .whatsapp-box select,
    .whatsapp-box input {
        flex: 1;
        width: 100%;
    }
}
</style>


    </section>


    </main>
@endsection
