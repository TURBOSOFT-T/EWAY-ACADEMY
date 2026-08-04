<div>
    @php
    $config = DB::table('configs')->first();
    
@endphp
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="#" class="app-brand-link">
                                <img
                                src="{{ Storage::url($config->logo) }}" alt="Logo" height="80" width="80" />
                               {{--  <span class="app-brand-text demo text-heading fw-bold">COACH BELLE</span> --}}
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">

                              {{ \App\Helpers\TranslationHelper::TranslateText('EWAY ACADEMY
') }} 
                        </h4>

                        @if ($isRegistered)
                        <div class="alert alert-success">
                            
                              {{ \App\Helpers\TranslationHelper::TranslateText('Votre compte a été crée avec succès !!') }} 
                        </div>
                    @else
                        <form form wire:submit='save'>
                            @csrf
                            <div class="mb-6">
                                <label for="nom" class="form-label">
                                      {{ \App\Helpers\TranslationHelper::TranslateText('Nom') }} 
                                </label>
                                <input type="text" wire:model="nom" class="form-control" id="nom"
                                    placeholder="  {{ \App\Helpers\TranslationHelper::TranslateText('Votre nom') }} " autofocus  required/>
                            </div>
                            <div class="mb-6">
                                <label for="email" class="form-label">Email
                                    
                                </label>
                                <input type="email"  class="form-control" placeholder="Adresse email" wire:model="email" name="email"required/>
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">
                                      {{ \App\Helpers\TranslationHelper::TranslateText('Password') }} 
                                </label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control"  wire:model="password"
                                        placeholder="  {{ \App\Helpers\TranslationHelper::TranslateText('Votre mot de passe') }} "
                                        aria-describedby="password"  required/>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">
                                      {{ \App\Helpers\TranslationHelper::TranslateText('Confirmation de mot de passe') }} 
                                </label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control"  wire:model="password_confirmation"
                                        placeholder="  {{ \App\Helpers\TranslationHelper::TranslateText('Confirmation de mot de passe') }} "
                                        aria-describedby="password" required/>
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>

                        {{--     <div class="my-8">
                                <div class="form-check mb-0 ms-2">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions"
                                        name="terms" />
                                    <label class="form-check-label" for="terms-conditions">
                                        
                                          {{ \App\Helpers\TranslationHelper::TranslateText('J\'accepte') }} 
                                        <a href="javascript:void(0);"> 
                                              {{ \App\Helpers\TranslationHelper::TranslateText('La politique de confidentialité') }} 
                                            </a>
                                    </label>

                                </div>
                            </div> --}}

                            <div class="my-8">
    <div class="form-check mb-0 ms-2">
        <input class="form-check-input" type="checkbox" id="terms-conditions"
               name="terms" required />
        <label class="form-check-label" for="terms-conditions">
            {{ \App\Helpers\TranslationHelper::TranslateText("J'accepte") }}
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#privacyPolicyModal" class="ms-1">
                {{ \App\Helpers\TranslationHelper::TranslateText("La politique de confidentialité") }}
            </a>
        </label>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="privacyPolicyModal" tabindex="-1" aria-labelledby="privacyPolicyLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="privacyPolicyLabel">
            {{ \App\Helpers\TranslationHelper::TranslateText("Politique de confidentialité") }}
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body" style="max-height: 70vh; overflow-y:auto;">
        <p>
          {{ \App\Helpers\TranslationHelper::TranslateText("Chez EWAY-ACADEMY, la protection de vos données personnelles est une priorité.
Cette politique de confidentialité décrit la manière dont nous collectons, utilisons et protégeons les informations fournies lors de votre inscription à nos services.") }}
        </p> 
        <p>
            {!! \App\Helpers\TranslationHelper::TranslateText("Vos données personnelles seront conservées uniquement pendant la durée nécessaire au traitement de votre inscription et conformément aux obligations légales applicables.
      ") !!}
          </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            {{ \App\Helpers\TranslationHelper::TranslateText("Fermer") }}
        </button>
      </div>
    </div>
  </div>
</div>


                            @if ($errors->any())
                            <div class="alert alert-danger small">
                                @foreach ($errors->all() as $error)
                                    - {{ $error }} <br>
                                @endforeach
                            </div>
                        @endif
                            <button class="btn btn-primary d-grid w-100">
                                <span wire:loading>
                                    <img src="https://i.gifer.com/ZKZg.gif" height="15" alt="" srcset="">
                                </span>
                                <i class="ri-save-line me-1 fs-16 lh-1"></i>
                               
                                
                            {{ \App\Helpers\TranslationHelper::TranslateText('Confirmation') }}
                            </button>
                        </form>
                        @endif
                        
                        <br>
                    

                        <p class="text-center">
                            <span>
                                {{ \App\Helpers\TranslationHelper::TranslateText('Avez-vous déjà un compte ?') }}
                            </span>
                            <a href="{{ route('login') }}">
                                <span>
                                    {{ \App\Helpers\TranslationHelper::TranslateText('Se connecter') }}
                                </span>
                            </a>
                        </p>


                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
</div>
