<div>
    @if ($step == 1)
        <form wire:submit="form_1">
            <br>
            <br>
            <div class="container-xxl">
                <div class="authentication-wrapper authentication-basic container-p-y">
                  <div class="authentication-inner py-6">
                    <!-- Forgot Password -->
                    <div class="card">
                      <div class="card-body">
                        <!-- Logo -->
                    
                        <!-- /Logo -->
                        <h4 class="mb-1">Mot de passe oublié? 🔒</h4>
                        <p class="mb-6">Entrez votre email et nous vous enverrons des instructions pour réinitialiser votre mot de passe</p>
                        <form id="formAuthentication" class="mb-6" action="auth-reset-password-basic.html" method="GET">
                          <div class="mb-6">
                            <label for="email" class="form-label">Email</label>
                            <input
                              type="text"
                              class="form-control"
                              id="email"
                               wire:model="email"
                              name="email"
                              placeholder="Votre mail"
                              autofocus />
                          </div>
                          <br>
                        {{--   <button class="btn btn-primary d-grid w-100">Envoyer le lien de réinitialisation</button> --}}
                        <button class="btn btn-primary d-grid w-100" type="submit">
                            <span wire:loading>
                                <img src="/icons/kOnzy.gif" height="20" width="20" alt="" srcset="">
                            </span>
                            <span>Envoyer le code de verification</span>
                        </button>
                        
                        </form>
                        <div class="text-center">
                          <a href="{{ route('login') }}" class="d-flex justify-content-center">
                            <i class="ti ti-chevron-left scaleX-n1-rtl me-1_5"></i>
                            Retour connexion
                          </a>
                        </div>
                      </div>
                    </div>
                    <!-- /Forgot Password -->
                  </div>
                </div>
              </div>
        </form>
    @endif

    @if ($step == 2)
        <div class="text-center">
            <form wire:submit="form_2">
                <img width="100" height="100" src="https://img.icons8.com/glyph-neue/100/578b07/private2.png"
                    alt="private2" />
                <br>
                <h5 class="tp-section-title pb-10">Code de Sécurité !</h5>
                <p>
                    Veuillez saisir le code de verification que vous avez reçu par email.
                </p>
                <div class="form-group mb-6">
                    <div class="tp-contact-input-box p-relative">
                        <input type="TEXT" class="form-control" id="enter_code" name="enter_code"
                            wire:model="enter_code" placeholder="XXXXXX" />
                        <span class="tp-contact-icon">
                            <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9886 0.666687C10.5459 0.666687 12.6036 2.67901 12.6036 5.16336V6.44114C14.0389 6.88915 15.0846 8.18847 15.0846 9.74036V13.8544C15.0846 15.7757 13.4918 17.3334 11.5282 17.3334H4.4753C2.51077 17.3334 0.917969 15.7757 0.917969 13.8544V9.74036C0.917969 8.18847 1.96459 6.88915 3.39904 6.44114V5.16336C3.40751 2.67901 5.46519 0.666687 7.9886 0.666687ZM7.99707 10.1536C7.59061 10.1536 7.26037 10.4766 7.26037 10.874V12.7125C7.26037 13.1182 7.59061 13.4412 7.99707 13.4412C8.41199 13.4412 8.74224 13.1182 8.74224 12.7125V10.874C8.74224 10.4766 8.41199 10.1536 7.99707 10.1536ZM8.00554 2.11589C6.28657 2.11589 4.88938 3.474 4.88091 5.1468V6.26144H11.1217V5.16336C11.1217 3.48228 9.7245 2.11589 8.00554 2.11589Z"
                                    fill="#578B07" />
                            </svg>
                        </span>
                    </div>
                    @error('enter_code')
                        <span class="small text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <br>
                <button class="w-100  btn btn-primary d-grid w-100" type="submit">
                    <span wire:loading>
                        <img src="/icons/kOnzy.gif" height="20" width="20" alt="" srcset="">
                    </span>
                    <span>Vérifier</span>
                </button>
            </form>
        </div>
    @endif

<br>

    @if ($step == 3)
        <div class="text-center">
            <form wire:submit="form_3">
                <img width="100" height="100" src="https://img.icons8.com/external-vitaliy-gorbachev-lineal-vitaly-gorbachev/100/e6bd00/external-password-internet-security-vitaliy-gorbachev-lineal-vitaly-gorbachev.png" alt="external-password-internet-security-vitaliy-gorbachev-lineal-vitaly-gorbachev"/>
                <br>
                <h5 class="tp-section-title pb-10">Nouveau mot de passe</h5>
                <p>
                    Veuillez entrer votre nouveau mot de passe !
                </p>
                <div class="form-group mb-6">
                    <div class="tp-contact-input-box p-relative">
                        <input type="TEXT" class="form-control" id="password" name="password"
                            wire:model="password" placeholder="Mot de passe" />
                        <span class="tp-contact-icon">
                            <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9886 0.666687C10.5459 0.666687 12.6036 2.67901 12.6036 5.16336V6.44114C14.0389 6.88915 15.0846 8.18847 15.0846 9.74036V13.8544C15.0846 15.7757 13.4918 17.3334 11.5282 17.3334H4.4753C2.51077 17.3334 0.917969 15.7757 0.917969 13.8544V9.74036C0.917969 8.18847 1.96459 6.88915 3.39904 6.44114V5.16336C3.40751 2.67901 5.46519 0.666687 7.9886 0.666687ZM7.99707 10.1536C7.59061 10.1536 7.26037 10.4766 7.26037 10.874V12.7125C7.26037 13.1182 7.59061 13.4412 7.99707 13.4412C8.41199 13.4412 8.74224 13.1182 8.74224 12.7125V10.874C8.74224 10.4766 8.41199 10.1536 7.99707 10.1536ZM8.00554 2.11589C6.28657 2.11589 4.88938 3.474 4.88091 5.1468V6.26144H11.1217V5.16336C11.1217 3.48228 9.7245 2.11589 8.00554 2.11589Z"
                                    fill="#578B07" />
                            </svg>
                        </span>
                    </div>
                    @error('password')
                        <span class="small text-danger"> {{ $message }} </span>
                    @enderror

                    <div class="tp-contact-input-box p-relative">
                        <input type="TEXT" class="form-control" id="password_confirmation" name="password_confirmation"
                            wire:model="password_confirmation" placeholder="Confirmation du mot de passre" />
                        <span class="tp-contact-icon">
                            <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.9886 0.666687C10.5459 0.666687 12.6036 2.67901 12.6036 5.16336V6.44114C14.0389 6.88915 15.0846 8.18847 15.0846 9.74036V13.8544C15.0846 15.7757 13.4918 17.3334 11.5282 17.3334H4.4753C2.51077 17.3334 0.917969 15.7757 0.917969 13.8544V9.74036C0.917969 8.18847 1.96459 6.88915 3.39904 6.44114V5.16336C3.40751 2.67901 5.46519 0.666687 7.9886 0.666687ZM7.99707 10.1536C7.59061 10.1536 7.26037 10.4766 7.26037 10.874V12.7125C7.26037 13.1182 7.59061 13.4412 7.99707 13.4412C8.41199 13.4412 8.74224 13.1182 8.74224 12.7125V10.874C8.74224 10.4766 8.41199 10.1536 7.99707 10.1536ZM8.00554 2.11589C6.28657 2.11589 4.88938 3.474 4.88091 5.1468V6.26144H11.1217V5.16336C11.1217 3.48228 9.7245 2.11589 8.00554 2.11589Z"
                                    fill="#578B07" />
                            </svg>
                        </span>
                    </div>
                    @error('password_confirmation')
                        <span class="small text-danger"> {{ $message }} </span>
                    @enderror
                </div>
                <br>
                <button class="tp-btn-theme btn btn-primary w-100" type="submit">
                    <span wire:loading>
                        <img src="/icons/kOnzy.gif" height="20" width="20" alt="" srcset="">
                    </span>
                    <span>
                        Enregistrer
                    </span>
                </button>
            </form>
        </div>
    @endif

<br>
</div>
