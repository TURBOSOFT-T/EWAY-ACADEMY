<div>
    @include('components.alert')

    <form wire:submit="update_user">


        <div class="row gx-3 mb-3">
          
            <div class=" col-md-6 input-validator">
                <label class="small mb-1" for="nom">{!! \App\Helpers\TranslationHelper::TranslateText('Votre nom') !!}</label>
                <input wire:model="nom" type="text" {{ Auth::user()->nom }} class= "form-control"
                    style="font-size: 18px; color:black">
                @error('nom')
                    <span class="small text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>

         
            <div class=" col-md-6 input-validator">
                <label class="small mb-1" for="prenom">{!! \App\Helpers\TranslationHelper::TranslateText('Prénom') !!}</label>
                <input wire:model="prenom" type="text" {{ Auth::user()->prenom }} class= "form-control"
                    style="font-size: 18px; color:black">
                @error('prenom')
                    <span class="small text-danger">
                        {{ $message }}
                    </span>
                @enderror

            </div>
        </div>

        <div class="row gx-3 mb-3">

            <div class="col-md-6">
                <label class="small mb-1" for="inputOrgName">Email</label>

                <input type="text" value=" {{ Auth::user()->email }}" wire:model="email" class= "form-control"
                    style="font-size: 18px; color:black">
                @error('email')
                    <span class="text-danger small"> {{ $message }} </span>
                @enderror
            </div>

            <div class="col-md-6">
                <label class="small mb-1" for="inputLocation">{!! \App\Helpers\TranslationHelper::TranslateText('Téléphone') !!}</label>

                <input value=" {{ Auth::user()->phone }}" wire:model="phone" id="inputLocation" type="text"
                    class= "form-control" style="font-size: 18px; color:black">
                @error('phone')
                    <span class="text-danger small"> {{ $message }} </span>
                @enderror
            </div>
        </div>

        <div class="mb-3">

            <label class="small mb-1" for="adresse">{!! \App\Helpers\TranslationHelper::TranslateText('Adresse') !!}</label>
            <input type="text" value=" {{ Auth::user()->adresse }}" wire:model="adresse"
                style="font-size: 18px; color:black" class= "form-control">
            @error('adresse')
                <span class="text-danger small"> {{ $message }} </span>
            @enderror
        </div>

        <div class="comment-one__btn-box">
             <button  class="btn-default disabled"   type="submit">

               
               {!! \App\Helpers\TranslationHelper::TranslateText(' Confirmer les changements') !!}
            </button> 

          
        </div>
    </form>


</div>
