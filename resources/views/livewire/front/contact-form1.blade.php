<section class="contact-one">
    <div class="container">
        <div class="contact-one__inner">
            <h3 class="contact-one__title">

                   {!! \App\Helpers\TranslationHelper::TranslateText('Prêt à transformer votre vie ?') !!}
            </h3>
            <p class="contact-one__text">

                   {!! \App\Helpers\TranslationHelper::TranslateText('  Vous avez des questions, des objectifs à atteindre ou vous souhaitez simplement échanger ?
                   N\'hésitez pas à nous contacter !') !!} <br>
                      {!! \App\Helpers\TranslationHelper::TranslateText(' Nous sommes là pour vous accompagner. Remplissez le formulaire ci-dessous et commençons ensemble votre chemin vers le changement.
 ') !!}
                
                  
            </p>

                @livewireStyles

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
            <form class="contact-form-validated contact-one__form"wire:submit="save"
               {{--  method="post" --}} novalidate="novalidate">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="contact-one__input-box">
                           
                            <input wire:model="nom" type="text" placeholder="   {!! \App\Helpers\TranslationHelper::TranslateText('Votre nom') !!}" id="name" required="required">
                    @error('nom')
                    <span class="small text-danger">
                        {{ $message }}
                    </span>
                @enderror
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="contact-one__input-box">
                            <input  wire:model="email" type="email" placeholder="E-Mail" id="email" required="required">
                    @error('email')
                    <span class="small text-danger">
                        {{ $message }}
                    </span>
                @enderror
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="contact-one__input-box">
                            <input wire:model="telephone" type="text" placeholder="   {!! \App\Helpers\TranslationHelper::TranslateText('Votre téléphone') !!}" id="telephone" required="required">
                            @error('telephone')
                            <span class="small text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="contact-one__input-box">
                            <div class="select-box">
                                <input wire:model="sujet" type="text" placeholder="   {!! \App\Helpers\TranslationHelper::TranslateText('Sujet') !!}" id="subject" required="required">
                    @error('sujet')
                        <span class="small text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="contact-one__input-box text-message-box">
                            
                            <textarea wire:model="message"  placeholder="   {!! \App\Helpers\TranslationHelper::TranslateText('Laissez le message') !!}"  id="message" required="required"></textarea>
                            @error('message')
                            <span class="small text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                        </div>
                        <div class="contact-one__btn-box">
                            <button type="submit" class="thm-btn contact-one__btn">
                                <span wire:loading>
                                    <img src="/icons/kOnzy.gif" height="20" width="20" alt="" srcset="">
                                </span>
                             {!! \App\Helpers\TranslationHelper::TranslateText('Envoyez le message') !!}
                                <span
                                    class="icon-arrow-right"></span></button>


                        </div>
                    </div>
                </div>
            </form>
            <div class="result"></div>
        </div>
    </div>
</section>