

@php
    $config = DB::table('configs')->first();
    
@endphp
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-6">
        <!-- Login -->
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
              {{ \App\Helpers\TranslationHelper::TranslateText('EWAY ACADEMY') }}
            </h4>
          
            @if (session()->has('error'))
            <div class="alert alert-danger p-3 small">
                {{ session('error') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success p-3 small">
                {{ session('success') }}
            </div>
        @endif 
            <form form wire:submit='connexion'>
                
               @csrf
              <div class="mb-6">
                <label for="email" class="form-label">Email</label>
                <input
                  type="email"
                   value="{{ old('email') }}"
                  class="form-control"
                  id="email"
                  wire:model="email"
                  placeholder="Entrez votre email"
                  autofocus />
                  @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                  
              </div>
              <div class="mb-6 form-password-toggle">
                <label class="form-label" for="password">
                  {{ \App\Helpers\TranslationHelper::TranslateText('Mot de passe') }}
                </label>
                <div class="input-group input-group-merge">
                  <input
                    type="password"
                    id="password"
                    class="form-control"
                    wire:model="password"
                    placeholder="Votre mot de passe"
                    aria-describedby="password" />
                    @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
              </div>
              <div class="my-8">
                <div class="d-flex justify-content-between">
                  <div class="form-check mb-0 ms-2">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> 
                      {{ \App\Helpers\TranslationHelper::TranslateText('Se souvenir de moi') }}
                    </label>
                  </div>
                  <a  href="{{ route('forgot_password') }}">
                    <p class="mb-0">
                      {{ \App\Helpers\TranslationHelper::TranslateText('Mot de passe oublié?') }}
                    </p>
                  </a>
                </div>
              </div>
              <div class="mb-6">
                <button class="btn btn-primary d-grid w-100" type="submit">
                  {{ \App\Helpers\TranslationHelper::TranslateText('Connexion') }}
                </button>
              </div>
            </form>

           <p class="text-center new-account">
    <span>
    {{ \App\Helpers\TranslationHelper::TranslateText('Nouvelle sur notre plateforme ? ') }}  
    </span> <br>
    <a href="{{ route('register') }}">
      {{ \App\Helpers\TranslationHelper::TranslateText('Créer un compte') }}
    </a>
</p>


        
         
          </div>
        </div>
        <!-- /Register -->
      </div>
    </div>


    
<style>
.new-account {
    font-family: 'Arial', sans-serif;
    font-size: 16px;
    color: #333;
    margin-top: 20px;
    font-weight: bold; /* Texte en gras */
}

.new-account span {
    margin-right: 8px;
}

.new-account a {
    color: #007bff;
    font-weight: bold; /* Lien en gras */
    text-decoration: none;
    transition: all 0.3s ease;
}

.new-account a:hover {
    color: #0056b3;
    text-decoration: underline;
}

/* Responsive mobile */
@media (max-width: 768px) {
    .new-account {
        font-size: 14px;
    }
}
</style>

  </div>
